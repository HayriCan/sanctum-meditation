<?php

namespace App\Repository\Eloquent;

use App\Exceptions\CustomException;
use App\Http\Requests\MeditationFinishRequest;
use App\Models\MeditationRecord;
use App\Repository\MeditationRecordRepositoryInterface;
use App\Traits\ApiResponser;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class MeditationRecordRepository implements MeditationRecordRepositoryInterface
{
    use ApiResponser;

    /**
     * @var Model
     */
    protected $model;

    /**
     * BaseRepository constructor.
     *
     * @param MeditationRecord $model
     */
    public function __construct(MeditationRecord $model)
    {
        $this->model = $model;
    }

    /**
     * @throws CustomException
     */
    public function storeMeditationRecord(MeditationFinishRequest $request): JsonResponse
    {
        DB::beginTransaction();
        try {
            $this->model->create([
                'user_id' => $request->user()->id,
                'meditation_id' => $request->meditation_id,
            ]);

            DB::commit();
            return $this->success(null,"Meditation Finished",JsonResponse::HTTP_CREATED);
        } catch(\Exception $e) {
            DB::rollBack();
            throw new CustomException(null,$e->getMessage(), JsonResponse::HTTP_BAD_REQUEST);
        }
    }

    public function yearlyCompletedMeditations($user_id)
    {
        return MeditationRecord::where('user_id',$user_id)
            ->whereYear('created_at', date('Y'))
            ->count();
    }

    public function yearlyMaximumStreak($user_id): array
    {
        return DB::table('meditation_records')
            ->where('user_id',$user_id)
            ->whereYear('created_at', date('Y'))
            ->select(['created_at'])
            ->distinct()
            ->orderBy('created_at')
            ->get()
            ->toArray();
    }

    public function yearlyMeditationDuration($user_id)
    {
        return  DB::table('meditation_records')
            ->join('meditations','meditations.id','=','meditation_records.meditation_id')
            ->where('meditation_records.user_id',$user_id)
            ->whereYear('meditation_records.created_at', date('Y'))
            ->sum('meditations.duration');
    }

    public function monthlyCompletedMeditations($user_id)
    {
        return MeditationRecord::where('user_id',$user_id)
            ->whereMonth('created_at', date('m'))
            ->whereYear('created_at', date('Y'))
            ->count();
    }

    public function monthlyMaximumStreak($user_id): array
    {
        return DB::table('meditation_records')
            ->where('user_id',$user_id)
            ->whereMonth('created_at', date('m'))
            ->whereYear('created_at', date('Y'))
            ->select(['created_at'])
            ->distinct()
            ->orderBy('created_at')
            ->get()
            ->toArray();
    }

    public function monthlyMeditationDuration($user_id)
    {
        return DB::table('meditation_records')
            ->join('meditations','meditations.id','=','meditation_records.meditation_id')
            ->where('meditation_records.user_id',$user_id)
            ->whereMonth('meditation_records.created_at', date('m'))
            ->whereYear('meditation_records.created_at', date('Y'))
            ->sum('meditations.duration');
    }

    public function sevenDaysDurations($user_id): array
    {
        return  DB::table('meditation_records')
            ->join('meditations','meditations.id','=','meditation_records.meditation_id')
            ->where('meditation_records.user_id',$user_id)
            ->whereDate('meditation_records.created_at','>=',Carbon::now()->subDays(6)->startOfDay())
            ->select(DB::raw('DATE(meditation_records.created_at) as date'),DB::raw('SUM(meditations.duration) as duration'))
            ->groupBy('date')
            ->get()
            ->pluck('duration','date')
            ->all();
    }

    public function monthlyMeditationDays($user_id): array
    {
        return  DB::table('meditation_records')
            ->where('user_id',$user_id)
            ->whereBetween(DB::raw('created_at'), [Carbon::now()->startOfMonth(),Carbon::now()])
            ->select(DB::raw('DATE(created_at) as date'),DB::raw('count(*) as count'))
            ->groupBy('date')
            ->get()
            ->pluck('count','date')
            ->all();
    }


}

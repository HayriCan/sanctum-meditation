<?php

namespace App\Http\Controllers;

use App\Repository\Eloquent\MeditationRecordRepository;
use App\Traits\ApiResponser;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * @group Reporting
 *
 * API endpoints for meditation reports
 *
 * @unauthenticated
 */
class ReportController extends Controller
{
    use ApiResponser;
    private $meditationRecordRepository;

    public function __construct(MeditationRecordRepository $meditationRecordRepository)
    {
        $this->meditationRecordRepository = $meditationRecordRepository;
    }

    public function reportFirstItemArray($user_id): array
    {
        return array(
            'yearly_completed_meditation' => $this->meditationRecordRepository->yearlyCompletedMeditations($user_id),
            'yearly_max_streak ' => calculateStreak($this->meditationRecordRepository->yearlyMaximumStreak($user_id)),
            'yearly_meditation_duration ' => secondsForHumans($this->meditationRecordRepository->yearlyMeditationDuration($user_id)),
            'monthly_completed_meditation' => $this->meditationRecordRepository->monthlyCompletedMeditations($user_id),
            'monthly_max_streak ' => calculateStreak($this->meditationRecordRepository->monthlyMaximumStreak($user_id)),
            'monthly_meditation_duration ' => secondsForHumans($this->meditationRecordRepository->monthlyMeditationDuration($user_id)),
        );
    }

    /**
     * First Item Endpoint.
     *
     * This endpoint allows you to retrieve user's completed meditation count,
     * meditation streak and total duration on monthly and yearly basis.
     *
     * @response 200 {"error":false,"message":"Meditation Report First Item","data":{"yearly_completed_meditation":18,"yearly_max_streak ":5,"yearly_meditation_duration ":"2 hours 38 minutes 22 seconds","monthly_completed_meditation":18,"monthly_max_streak ":5,"monthly_meditation_duration ":"2 hours 38 minutes 22 seconds"}}
     * @response 401 {"message":"Unauthenticated"}
     */
    public function reportFirstItem(Request $request): JsonResponse
    {
        return $this->success($this->reportFirstItemArray($request->user()->id),"Meditation Report First Item",JsonResponse::HTTP_OK);
    }

    /**
     * Second Item Endpoint.
     *
     * This endpoint allows you to retrieve user's meditation duration for last 7 days.
     *
     * @response 200 {"error":false,"message":"Meditation Report Second Item","data":{"2021-07-24":0,"2021-07-25":"5 minutes 25 seconds","2021-07-26":"13 minutes 12 seconds","2021-07-27":0,"2021-07-28":"17 minutes 12 seconds","2021-07-29":0,"2021-07-30":"45 minutes 16 seconds"}}
     * @response 401 {"message":"Unauthenticated"}
     */
    public function reportSecondItem(Request $request): JsonResponse
    {
        $mapped_array = array_map(function ($array_item){
            return secondsForHumans($array_item);
        },$this->meditationRecordRepository->sevenDaysDurations($request->user()->id));

        return $this->success(array_replace(createDatePeriodOfDays(),$mapped_array),"Meditation Report Second Item",JsonResponse::HTTP_OK);
    }

    /**
     * Third Item Endpoint.
     *
     * This endpoint allows you to retrieve days which user meditated in this month.
     *
     * @response 200 {"error":false,"message":"Meditation Report Third Item","data":{"2021-07-01":false,"2021-07-02":false,"2021-07-03":false,"2021-07-04":false,"2021-07-05":false,"2021-07-06":false,"2021-07-07":false,"2021-07-08":false,"2021-07-09":false,"2021-07-10":true,"2021-07-11":true,"2021-07-12":true,"2021-07-13":false,"2021-07-14":true,"2021-07-15":true,"2021-07-16":false,"2021-07-17":true,"2021-07-18":true,"2021-07-19":true,"2021-07-20":true,"2021-07-21":true,"2021-07-22":false,"2021-07-23":false,"2021-07-24":false,"2021-07-25":true,"2021-07-26":true,"2021-07-27":false,"2021-07-28":true,"2021-07-29":false,"2021-07-30":true}}
     * @response 401 {"message":"Unauthenticated"}
     */
    public function reportThirdItem(Request $request): JsonResponse
    {
        $mapped_array = array_map(function (){
            return true;
        },$this->meditationRecordRepository->monthlyMeditationDays($request->user()->id));

        return $this->success(array_replace(createDatePeriodOfMonth(),$mapped_array),"Meditation Report Third Item",JsonResponse::HTTP_OK);
    }
}

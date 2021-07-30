<?php

namespace App\Http\Controllers;

use App\Http\Requests\MeditationFinishRequest;
use App\Repository\Eloquent\MeditationRecordRepository;
use App\Traits\ApiResponser;
use Illuminate\Http\JsonResponse;

/**
 * @group Meditation Finish
 *
 * API endpoint for finishing meditation
 *
 * @unauthenticated
 */
class MeditationFinish extends Controller
{
    use ApiResponser;
    private $meditationRecordRepository;

    public function __construct(MeditationRecordRepository $meditationRecordRepository)
    {
        $this->meditationRecordRepository = $meditationRecordRepository;
    }

    /**
     * Meditation Finish Endpoint.
     *
     * This endpoint allows you to finish meditation.
     *
     * @bodyParam   meditation_id    integer  required    The id of meditation.     Example: 4
     *
     * @response 201 {"error":false,"message":"Meditation Finished","data":null}
     * @response 422 {"error":true,"message":"MeditationFinishRequest validation failed","data":{"meditation_id":["The meditation id field is required."]}}
     *
     * @throws \App\Exceptions\CustomException
     */
    public function __invoke(MeditationFinishRequest $request): JsonResponse
    {
        return $this->meditationRecordRepository->storeMeditationRecord($request);
    }
}

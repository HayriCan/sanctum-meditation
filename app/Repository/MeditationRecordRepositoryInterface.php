<?php

namespace App\Repository;

use App\Http\Requests\MeditationFinishRequest;

interface MeditationRecordRepositoryInterface
{
    public function storeMeditationRecord(MeditationFinishRequest $request);

    public function yearlyCompletedMeditations($user_id);
    public function yearlyMaximumStreak($user_id);
    public function yearlyMeditationDuration($user_id);

    public function monthlyCompletedMeditations($user_id);
    public function monthlyMaximumStreak($user_id);
    public function monthlyMeditationDuration($user_id);

    public function sevenDaysDurations($user_id);

    public function monthlyMeditationDays($user_id);
}

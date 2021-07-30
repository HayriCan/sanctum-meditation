<?php

use Carbon\Carbon;
use Carbon\CarbonInterval;

if (! function_exists('secondsForHumans')) {
    function secondsForHumans($seconds): string
    {
        return ($seconds == 0) ? 0 : CarbonInterval::seconds($seconds)->cascade()->forHumans();
    }
}

if (! function_exists('calculateStreak')) {
    function calculateStreak($queryArray): int
    {
        $currentStreak = 0;
        $longestStreak = 0;
        $lastDate = null;

        foreach ($queryArray as $key => $day){
            $date = Carbon::parse($day->created_at)->format('Y-m-d');
            if($key == 0){ $currentStreak++; $longestStreak++; $lastDate = $date; continue; }
            $yesterday = Carbon::parse($day->created_at)->subDays()->format('Y-m-d');
            if ($yesterday == $lastDate){
                $currentStreak++;
                if ($currentStreak > $longestStreak){ $longestStreak = $currentStreak; }
            }
            else{ $currentStreak = 1; }
            $lastDate = $date;
        }

        return $longestStreak;
    }
}

if (! function_exists('createDatePeriod')) {
    function createDatePeriodOfDays($days = 6): array
    {
        $range = [];
        $period = new DatePeriod( new DateTime(Carbon::now()->subDays($days)->startOfDay()), new DateInterval('P1D'), new DateTime(Carbon::now()));
        foreach ($period as $date) {
            $range[$date->format("Y-m-d")] = 0;
        }

        return $range;
    }
}

if (! function_exists('createDatePeriod')) {
    function createDatePeriodOfMonth(): array
    {
        $range = [];
        $period = new DatePeriod( new DateTime(Carbon::now()->startOfMonth()), new DateInterval('P1D'), new DateTime(Carbon::now()));
        foreach ($period as $date) {
            $range[$date->format("Y-m-d")] = false;
        }

        return $range;
    }
}

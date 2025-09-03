<?php

namespace App\Helpers;

use App\Models\Holiday;
use Carbon\Carbon;

class DateHelper
{
    /**
     * Calculate the number of working days between two dates, excluding weekends and holidays.
     *
     * @param string $startDate
     * @param string $endDate
     * @return int
     */
    public static function calculateWorkingDays($startDate, $endDate)
    {
        $start = Carbon::parse($startDate);
        $end = Carbon::parse($endDate);

        // Get all holidays between the dates
        $holidays = Holiday::whereBetween('date', [$start->toDateString(), $end->toDateString()])
            ->pluck('date')
            ->map(function ($date) {
                return Carbon::parse($date)->toDateString();
            })
            ->toArray();

        $workingDays = 0;
        $current = $start->copy();

        while ($current->lte($end)) {
            // Check if it's a weekday (Monday to Friday) and not a holiday
            if ($current->isWeekday() && !in_array($current->toDateString(), $holidays)) {
                $workingDays++;
            }
            $current->addDay();
        }

        return $workingDays;
    }
}

<?php

if (!function_exists("convertToDatetime")) {
    /**
     * @param int $year
     * @param int $month
     * @param int $day
     * @return DateTime
     */
    function convertToDatetime(int $year, int $month, int $day): string
    {
        return date('Y-m-d H:i:s',strtotime("$year-$month-$day"));
    }
}

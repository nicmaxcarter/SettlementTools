<?php

namespace Nicmaxcarter\SettlementTools;

class Dates
{
    /**
     * @return array<Mixed>
     */
    public static function datesForWeekEnding(
        int $weeks,
        \DateTime $currentDate = null
    ): array {
        if (is_null($currentDate)) {
            $currentDate = new \DateTime();
        }

        // set empty array to house dates
        $weekEndings = [];

        $recentWeekEnding = false;

        for ($i = 0; $i < $weeks; $i++) {
            // the first iteration will fetch the most recent date
            if (!$recentWeekEnding) {
                $recentWeekEnding = self::recentWeekEnding($currentDate);
                $weekEndings[$i] = $recentWeekEnding;
                continue;
            }

            $time = strtotime($recentWeekEnding);

            if (!$time) {
                continue;
            }

            $date = strtotime('-7 days', $time);
            $recentWeekEnding = date('Y-m-d', $date);

            $weekEndings[$i] = $recentWeekEnding;
        }

        return $weekEndings;
    }

    public static function recentWeekEnding(
        \DateTime $currDate = null,
        \DateTime $lastFriday = null
    ): string {
        if (is_null($currDate)) {
            // current date time
            $currDate = new \DateTime();
        }

        if (is_null($lastFriday)) {
            // last friday date time
            $lastFriday = clone $currDate;
            $lastFriday->modify('last friday');
        }

        // get difference between the two dates
        $diff = date_diff($currDate, $lastFriday)->days;

        // if the diff is less than 5 (as in, before wednesday)
        if ($diff < 5) {
            // go back to the prior friday
            $lastFriday->modify('-7 days');
        }

        return $lastFriday->format('Y-m-d');
    }

    // when supplied with Y-m-d or Y/m/d
    // this function should return the date as m/d/Y,
    // slashes, not dashes
    public static function weekEndText(string $givenDate): string
    {
        $time = strtotime($givenDate);

        if ($time === false) {
            return date('m/d/Y');
        }

        return date('m/d/Y', $time);
    }

    // given string of Y-m-d or Y/m/d
    // this function returns datetime of the starting saturday
    public static function weekStartDate(string $date): \DateTime|false
    {
        $date = new \DateTime($date);

        $date->setTime(0, 0, 0);

        if ($date->format('N') == 6) {
            // If the date is already a Saturday, return it as-is
            return $date;
        } else {
            // Otherwise, return the date of the nearest Friday
            return $date->modify('last Saturday');
        }
    }

    // given string of Y-m-d or Y/m/d
    // this function returns text date of the starting saturday
    public static function weekStart(string $date): string|false
    {
        $startDate = self::weekStartDate($date);

        if ($startDate === false) {
            return false;
        }

        return $startDate->format('Y-m-d');
    }
}

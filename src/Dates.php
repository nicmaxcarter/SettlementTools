<?php

namespace Nicmaxcarter\SettlementTools;

class Dates
{
    /**
     * @return array<Mixed>
     */
    public static function getWeekEndingDates(
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

    /**
     * @return array<string>
     */
    public static function getDatesForWeekEnding(string|\DateTime $weekEnding): array
    {
        if ($weekEnding instanceof \DateTime) {
            $weekEnding = clone $weekEnding;
        } elseif (!$weekEnding) {
            $weekEnding = new \DateTime();
        } else {
            $weekEnding = new \DateTime($weekEnding);
        }

        $weekEnding->setTime(0, 0, 0);

        $dates = [];

        for ($i = 6; $i >= 0; $i--) {
            $dates[$i] = $weekEnding->format('Y-m-d');
            $weekEnding->modify('-1 day');
        }
        // sort array by keys
        usort(
            $dates,
            function ($a, $b) {
                if ($a > $b) {
                    return 1;
                } else {
                    return -1;
                }
            }
        );

        return $dates;
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
    public static function getWeekEndText(string $givenDate): string
    {
        $time = strtotime($givenDate);

        if ($time === false) {
            return date('m/d/Y');
        }

        return date('m/d/Y', $time);
    }

    // COME BACK TO THIS
    public static function getSampleEndOfWeekDate(string|\DateTime $date = null): \DateTime|false
    {
        if ($date instanceof \DateTime) {
            $date = clone $date;
        } elseif (!$date) {
            $date = new \DateTime();
        } else {
            $date = new \DateTime($date);
        }

        $date->setTime(0, 0, 0);

        if ($date->format('N') == 5) {
            // If the date is already a Friday, return it as-is
            return $date;
        } else {
            // Otherwise, return the date of the nearest Friday
            return $date->modify('this Friday');
        }
    }

    // COME BACK TO THIS
    public static function getSampleStartOfWeekDate(string|\DateTime $date = null): \DateTime|false
    {
        if ($date instanceof \DateTime) {
            $date = clone $date;
        } elseif (!$date) {
            $date = new \DateTime();
        } else {
            $date = new \DateTime($date);
        }

        $date->setTime(0, 0, 0);

        if ($date->format('N') == 6) {
            // If the date is already a Saturday, return it as-is
            return $date;
        } else {
            // Otherwise, return the date of the nearest Friday
            return $date->modify('this Saturday');
        }
    }
}

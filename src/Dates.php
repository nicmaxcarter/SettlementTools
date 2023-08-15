<?php

namespace Nicmaxcarter\SettlementTools;

class Dates
{
    public static function getWeekEndingDates(int $weeks) : Array
    {
        // set empty array to house dates
        $weekEndings = [];

        $currentDate = false;

        for($i = 0; $i < $weeks; $i++)
        {
            // the first iteration will fetch the most recent date
            if(!$currentDate) {
                $currentDate = self::recentWeekEnding();
                $weekEndings[$i] = $currentDate;
                continue;
            }

            $time = strtotime($currentDate);
            $date = strtotime('-7 days', $time);
            $currentDate = date('Y-m-d', $date);

            $weekEndings[$i] = $currentDate;
        }

        return $weekEndings;
    }

    public static function getDatesForWeekEnding($weekEnding)
    {
        if ($weekEnding instanceof \DateTime) {
            $weekEnding = clone $weekEnding;
        } else if (!$weekEnding) {
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
            function ($a, $b)
            {
                return $a > $b;
            }
        );
        return $dates;
    }

    public static function recentWeekEnding(
        \DateTime $currDate = null,
        \DateTime $lastFriday = null
    )
    {
        if(is_null($currDate)) {
            // current date time
            $currDate = new \DateTime();
        }

        if(is_null($lastFriday)) {
            // last friday date time
            $lastFriday = new \DateTime();
            $lastFriday->modify('last friday');
        }

        $lastFriday->format('Y-m-d');
        $currDate->format('Y-m-d');

        // get difference between the two dates
        $diff = date_diff($currDate, $lastFriday)->days;

        // if the diff is less than 5 (as in, before wednesday)
        if ($diff < 5) {
            // go back to the prior friday
            $lastFriday->modify('-7 days')->format('Y-m-d');
        }

        return $lastFriday->format('Y-m-d');
    }

    public static function getWeekEndDate($givenDate)
    {
        if($givenDate === 'last'){
            return self::recentWeekEnding();
        }

        return date('Y-m-d', strtotime($givenDate));
    }

    public static function getWeekEndText($givenDate)
    {
        return date('m/d/Y', strtotime($givenDate));
    }

    public static function getSampleEndOfWeekDate($date = null)
    {
        if ($date instanceof \DateTime) {
            $date = clone $date;
        } else if (!$date) {
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


    public static function getSampleStartOfWeekDate($date = null)
    {
        if ($date instanceof \DateTime) {
            $date = clone $date;
        } else if (!$date) {
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

<?php

namespace Nicmaxcarter\SettlementTools;

class Dates
{
    /**
     * @param \DateTime $currDate
     * @param \DateTime $lastFriday
     * @return string
     */
    public static function recentWeekEnding(
        \DateTime $currDate = null,
        \DateTime $lastFriday = null
    ): string {

        if (is_null($currDate)) {
            // current date time
            $currDate = new \DateTime();
        }

        // if the time zone is not EST
        if (self::notESTTime($currDate)) {
            // set the time zone to New York / EST
            $currDate->setTimezone(self::EST());
        }

        if (is_null($lastFriday)) {
            // last friday date time
            $lastFriday = clone $currDate;
            $lastFriday->modify('last friday');
        } else {
            // set the time zone to New York / EST
            $lastFriday->setTimezone(self::EST());
        }

        // always set this to 9:01 pm so
        // that we can be sure that anything
        // less than 4 will revert to the prior week
        $lastFriday->setTime(21, 1, 0, 0);

        $diff = date_diff($lastFriday, $currDate)->days;

        // if the diff is less than 4 (as in, before 9:01pm on Tuesday)
        if ($diff < 4) {
            // go back to the prior friday
            $lastFriday->modify('-7 days');
        }

        return $lastFriday->format('Y-m-d');
    }

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

    /**
     * @return array<Mixed>
     */
    // given a valid week ending date, this will return
    // prior week endings including the given date
    public static function priorWeekEndings(
        string $weekEndingDate,
        int $numOfWeeks
    ): array {

        $dates = [];

        $dates[] = $weekEndingDate;
        $numOfWeeks--;

        for ($i = 0; $i < $numOfWeeks; $i++) {
            $date = new \DateTime($weekEndingDate);
            $dates[] = $date->modify('-7 days')->format('Y-m-d');
            $weekEndingDate = $date->format('Y-m-d');
        }

        return $dates;
    }

    /**
     * @return array<Mixed>
     */
    // given a valid week ending date, this will return
    // prior week start and ending including the given date
    public static function priorWeekDates(
        string $weekEndingDate,
        int $numOfWeeks
    ): array {

        $dates = self::priorWeekEndings($weekEndingDate, $numOfWeeks);

        $newDates = [];

        foreach ($dates as $weekEnd) {
            $end = $weekEnd;
            $start = self::weekStart($end);

            $newDates[] = [
                'start' => $start,
                'end' => $end
            ];
        }

        return $newDates;
    }

    /**
     * @return array<Mixed>
     */
    // given a valid week ending date, this will return
    // prior week start and ending including the given date
    // as Aug 21, 2023
    public static function priorWeekDatesPretty(
        string $weekEndingDate,
        int $numOfWeeks
    ): array {

        $dates = self::priorWeekDates($weekEndingDate, $numOfWeeks);

        $newDates = [];

        foreach ($dates as $week) {
            $start = new \DateTime($week['start']);
            $end = new \DateTime($week['end']);

            $newDates[$week['end']] = [
                'start' => $start->format('M j, Y'),
                'end' => $end->format('M j, Y')
            ];
        }

        return $newDates;
    }

    /**
     * @return array<String>
     */
    public static function yearsSpanned(
        string $firstDate,
        string $lastDate
    ): array {
        // Convert start and end dates to DateTime objects
        $start = new \DateTime($firstDate);
        $end = new \DateTime($lastDate);


        // Initialize an empty array to store the years
        $years = [];

        if ($end < $start) {
            return $years;
        }

        // Loop through each year and add it to the array
        while ($start <= $end) {
            $years[] = $start->format('Y');
            $start->modify('+1 year');
        }

        return $years;
    }

    /**
     * @return array<String>
     */
    public static function fridaysInYear(int $year): array
    {
        $fridays = array();

        // Create a DateTime object for the first day of the year
        $date = new \DateTime("$year-01-01");

        // Loop through the year, checking each day
        while ($date->format('Y') == $year) {
            // Check if the current day is a Friday (5 represents Friday in DateTime)
            if ($date->format('N') == 5) {
                $fridays[] = $date->format('Y-m-d');
                $date->modify('+7 days');
                continue;
            }

            // Move to the next day
            $date->modify('+1 day');
        }

        return $fridays;
    }

    /**
     * given a date like 2023-01-13, this function will return
     * the number week that belongs to, such as 2.
     * The week has been adjusted from sunday-saturday -> saturday-friday
     */
    public static function weekNumber(string $dateStr): int|false
    {
        // Convert the input date string to a DateTime object
        $date = new \DateTime($dateStr);

        if ($date->format('N') != 5) {
            return false;
        }

        // Get the year of the input date
        $year = $date->format('Y');

        // Initialize a counter for the Friday number
        $fridayNumber = 1;

        // Create a DateTime object for the first day of the year
        $startDate = new \DateTime("$year-01-01");

        // Loop from the start of the year to the input date
        while ($startDate <= $date) {
            // Check if the current day is a Friday (5 represents Friday in DateTime)
            if ($startDate->format('N') == 5) {
                // If it's a Friday, check if it's not the same as the input date
                if ($startDate != $date) {
                    $fridayNumber++;
                } else {
                    break; // Exit the loop when we reach the input date
                }
            }

            // Move to the next day
            $startDate->modify('+1 day');
        }

        return $fridayNumber;
    }

    public static function startOfAPastYear(
        string $dateStr,
        int $years = 0
    ): string {

        // Create a DateTime object from the input date string
        $date = new \DateTime($dateStr);

        // Subtract three years from the date
        $date->modify("-$years years");

        // Format and return the result as a Y-m-d string
        return $date->format('Y') . '-01-01';
    }

    /**
     * if you give this function a tuesday,
     * it should return that friday of the same week
     * @param \DateTime|string $date
     * @return \DateTime|false
     */
    public static function weekEndingOfDate(
        \DateTime|string $date
    ): \DateTime|false {

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

    /**
     * given two dates, first find the corresponding weekEnding date
     * of each, and then compare to make sure the first date is
     * the week prior to the second date
     * @param \DateTime $dateOne
     * @param \DateTime $dateTwo
     * @return bool
     */
    public static function confirmAdjacentWeeks(
        \DateTime|string $dateOne,
        \DateTime|string $dateTwo
    ): bool {
        // calculate the week ending from the first date
        $firstWeek = self::weekEndingOfDate($dateOne);

        // calculate the week ending from the second date
        $secondWeek = self::weekEndingOfDate($dateTwo);

        if (!$firstWeek || !$secondWeek) {
            return false;
        }

        // compare the difference between two dates
        $diff = intval($firstWeek->diff($secondWeek)->format("%r%a"));

        // if it is 7, true
        return ($diff === 7);
    }

    /**
     * given two dates, compare to make sure the first date exactly
     * one day prior to the second date
     * @param string $dateOne
     * @param string $dateTwo
     * @return bool
     */
    public static function confirmAdjacentDates(
        string $dateOne,
        string $dateTwo
    ): bool {
        $dateOne = new \DateTime($dateOne);
        $dateTwo = new \DateTime($dateTwo);

        // compare the difference between two dates
        $diff = intval($dateOne->diff($dateTwo)->format("%r%a"));

        // there should only be a difference of one day
        if ($diff === 1) {
            return true;
        }

        return false;
    }

    /**
     * @param \DateTime $date
     * @return bool
     */
    public static function notESTTime(\DateTime $date): bool
    {
        $zone = $date->getTimezone()->getName();

        return ($zone !== 'America/New_York');
    }

    /**
     * @return \DateTimeZone
     */
    public static function EST(): \DateTimeZone
    {
        return new \DateTimeZone("America/New_York");
    }

    /**
     * @return \DateTimeZone
     */
    public static function UTC(): \DateTimeZone
    {
        return new \DateTimeZone("UTC");
    }
}

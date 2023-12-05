<?php

declare(strict_types=1);

namespace App;

use PHPUnit\Framework\TestCase;
use Nicmaxcarter\SettlementTools\Dates;

final class GetWeekEndingDatesTest extends TestCase
{
    /** @test */
    public function recentWeekEndingBeforeWednesday(): void
    {
        // given a number of weeks
        $weeks = 5;

        // and a current week ending date
        $currentDate = new \DateTime('2023-07-25 10:00');

        // when the function is called
        $resultingDates = Dates::datesForWeekEnding($weeks, $currentDate);

        // the function should return this date
        $checkDates = [
            date('Y-m-d', strtotime('2023-07-14')),
            date('Y-m-d', strtotime('2023-07-07')),
            date('Y-m-d', strtotime('2023-06-30')),
            date('Y-m-d', strtotime('2023-06-23')),
            date('Y-m-d', strtotime('2023-06-16'))
        ];

        $this->assertSame($resultingDates, $checkDates);
    }

    /** @test */
    public function recentWeekEndingOnWednesday(): void
    {
        // given a number of weeks
        $weeks = 6;

        // and a current week ending date
        $currentDate = new \DateTime('2023-07-26 10:00');

        // when the function is called
        $resultingDates = Dates::datesForWeekEnding($weeks, $currentDate);

        // the function should return this date
        $checkDates = [
            date('Y-m-d', strtotime('2023-07-21')),
            date('Y-m-d', strtotime('2023-07-14')),
            date('Y-m-d', strtotime('2023-07-07')),
            date('Y-m-d', strtotime('2023-06-30')),
            date('Y-m-d', strtotime('2023-06-23')),
            date('Y-m-d', strtotime('2023-06-16'))
        ];

        $this->assertSame($resultingDates, $checkDates);
    }

    /** @test */
    public function recentWeekEndingOnThursday(): void
    {
        // given a number of weeks
        $weeks = 5;

        // and a current week ending date
        $currentDate = new \DateTime('2023-07-27 10:00');

        // when the function is called
        $resultingDates = Dates::datesForWeekEnding($weeks, $currentDate);

        // the function should return this date
        $checkDates = [
            date('Y-m-d', strtotime('2023-07-21')),
            date('Y-m-d', strtotime('2023-07-14')),
            date('Y-m-d', strtotime('2023-07-07')),
            date('Y-m-d', strtotime('2023-06-30')),
            date('Y-m-d', strtotime('2023-06-23'))
        ];

        $this->assertSame($resultingDates, $checkDates);
    }

    /** @test */
    public function recentWeekEndingOnFriday(): void
    {
        // given a number of weeks
        $weeks = 5;

        // and a current week ending date
        $currentDate = new \DateTime('2023-07-28 10:00');

        // when the function is called
        $resultingDates = Dates::datesForWeekEnding($weeks, $currentDate);

        // the function should return this date
        $checkDates = [
            date('Y-m-d', strtotime('2023-07-21')),
            date('Y-m-d', strtotime('2023-07-14')),
            date('Y-m-d', strtotime('2023-07-07')),
            date('Y-m-d', strtotime('2023-06-30')),
            date('Y-m-d', strtotime('2023-06-23'))
        ];

        $this->assertSame($resultingDates, $checkDates);
    }
}

<?php

declare(strict_types=1);

namespace App;

use PHPUnit\Framework\TestCase;
use Nicmaxcarter\SettlementTools\Dates;

final class RecentWeekEnding2022Test extends TestCase
{
    /** @test */
    public function recentWeekEndingBeforeWednesday(): void
    {
        // given this date that is BEFORE Wednesday
        $currDate = new \DateTime('2022-03-08 10:00');

        // and this date that is the recent Friday
        $lastFriday = new \DateTime('2022-03-04 10:00');

        // when the function is called
        $resultDate = Dates::recentWeekEnding($currDate, $lastFriday);

        // the function should return this date
        $checkDate = date('Y-m-d', strtotime('2022-02-25'));

        $this->assertSame($checkDate, $resultDate);
    }

    /** @test */
    public function recentWeekEndingWednesday(): void
    {
        // given this date that IS Wednesday
        $currDate = new \DateTime('2022-03-09 10:00', Dates::EST());

        // set the timezone back to UTC to simulate the server
        $currDate->setTimezone(new \DateTimeZone("UTC"));

        // and this date that is the recent Friday
        $lastFriday = new \DateTime('2022-03-04 10:00');

        // when the function is called
        $resultDate = Dates::recentWeekEnding($currDate, $lastFriday);

        // the function should return this date
        $checkDate = date('Y-m-d', strtotime('2022-03-04'));

        $this->assertSame($checkDate, $resultDate);
    }

    /** @test */
    public function recentWeekEndingAfterWednesday(): void
    {
        // given this date that is AFTER Wednesday
        $currDate = new \DateTime('2022-03-10 10:00', Dates::EST());

        // set the timezone back to UTC to simulate the server
        $currDate->setTimezone(new \DateTimeZone("UTC"));

        // and this date that is the recent Friday
        $lastFriday = new \DateTime('2022-03-04 10:00');

        // when the function is called
        $resultDate = Dates::recentWeekEnding($currDate, $lastFriday);

        // the function should return this date
        $checkDate = date('Y-m-d', strtotime('2022-03-04'));

        $this->assertSame($checkDate, $resultDate);
    }

    /** @test */
    public function recentWeekEndingBeforeWednesdayNoLastFriday(): void
    {
        // given this date that is BEFORE 9:01pm on Tuesday
        $currDate = new \DateTime('2022-03-08 21:00', Dates::EST());

        // set the timezone back to UTC to simulate the server
        $currDate->setTimezone(new \DateTimeZone("UTC"));

        // when the function is called
        $resultDate = Dates::recentWeekEnding($currDate);

        // the function should return this date
        $checkDate = date('Y-m-d', strtotime('2022-02-25 10:00'));

        $this->assertSame($checkDate, $resultDate);
    }

    /** @test */
    public function recentWeekEndingWednesdayNoLastFriday(): void
    {
        // given this date that IS Wednesday early morning EST
        $currDate = new \DateTime('2022-03-09 10:00', Dates::EST());

        // set the timezone back to UTC to simulate the server
        $currDate->setTimezone(new \DateTimeZone("UTC"));

        // when the function is called
        $resultDate = Dates::recentWeekEnding($currDate);

        // the function should return this date
        $checkDate = date('Y-m-d', strtotime('2022-03-04 10:00'));

        $this->assertSame($checkDate, $resultDate);
    }

    /** @test */
    public function recentWeekEndingTuesdayNightNoLastFriday(): void
    {
        // given this date that exactly 9:01pm on Tuesday EST
        $currDate = new \DateTime('2022-03-08 21:01', Dates::EST());

        // set the timezone back to UTC to simulate the server
        $currDate->setTimezone(new \DateTimeZone("UTC"));

        // when the function is called
        $resultDate = Dates::recentWeekEnding($currDate);

        // the function should return this date
        $checkDate = date('Y-m-d', strtotime('2022-03-04 10:00'));

        $this->assertSame($checkDate, $resultDate);
    }

    /** @test */
    public function recentWeekEndingAfterWednesdayNoLastFriday(): void
    {
        // given this date that is AFTER Wednesday EST
        $currDate = new \DateTime('2022-03-10 10:00', Dates::EST());

        // set the timezone back to UTC to simulate the server
        $currDate->setTimezone(new \DateTimeZone("UTC"));

        // when the function is called
        $resultDate = Dates::recentWeekEnding($currDate);

        // the function should return this date
        $checkDate = date('Y-m-d', strtotime('2022-03-04'));

        $this->assertSame($checkDate, $resultDate);
    }
}

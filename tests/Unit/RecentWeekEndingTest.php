<?php

declare(strict_types=1);

namespace App;

use PHPUnit\Framework\TestCase;
use Nicmaxcarter\SettlementTools\Dates;

final class RecentWeekEndingTest extends TestCase
{
    /** @test */
    public function recentWeekEndingBeforeWednesday(): void
    {
        // given this date that is BEFORE Wednesday
        $currDate = new \DateTime('2022-03-08');

        // and this date that is the recent Friday
        $lastFriday = new \DateTime('2022-03-04');

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
        $currDate = new \DateTime('2022-03-09');

        // and this date that is the recent Friday
        $lastFriday = new \DateTime('2022-03-04');

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
        $currDate = new \DateTime('2022-03-10');

        // and this date that is the recent Friday
        $lastFriday = new \DateTime('2022-03-04');

        // when the function is called
        $resultDate = Dates::recentWeekEnding($currDate, $lastFriday);

        // the function should return this date
        $checkDate = date('Y-m-d', strtotime('2022-03-04'));

        $this->assertSame($checkDate, $resultDate);
    }

    /** @test */
    public function recentWeekEndingBeforeWednesdayNoLastFriday(): void
    {
        // given this date that is BEFORE Wednesday
        $currDate = new \DateTime('2022-03-08');

        // when the function is called
        $resultDate = Dates::recentWeekEnding($currDate);

        // the function should return this date
        $checkDate = date('Y-m-d', strtotime('2022-02-25'));

        $this->assertSame($checkDate, $resultDate);
    }

    /** @test */
    public function recentWeekEndingWednesdayNoLastFriday(): void
    {
        // given this date that IS Wednesday
        $currDate = new \DateTime('2022-03-09');

        // when the function is called
        $resultDate = Dates::recentWeekEnding($currDate);

        // the function should return this date
        $checkDate = date('Y-m-d', strtotime('2022-03-04'));

        $this->assertSame($checkDate, $resultDate);
    }

    /** @test */
    public function recentWeekEndingAfterWednesdayNoLastFriday(): void
    {
        // given this date that is AFTER Wednesday
        $currDate = new \DateTime('2022-03-10');

        // when the function is called
        $resultDate = Dates::recentWeekEnding($currDate);

        // the function should return this date
        $checkDate = date('Y-m-d', strtotime('2022-03-04'));

        $this->assertSame($checkDate, $resultDate);
    }
}

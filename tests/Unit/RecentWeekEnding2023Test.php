<?php

declare(strict_types=1);

namespace App;

use PHPUnit\Framework\TestCase;
use Nicmaxcarter\SettlementTools\Dates;

final class RecentWeekEnding2023Test extends TestCase
{
    /** @test */
    public function recentWeekEndingAfter901pmOnTuesday(): void
    {
        // given this date that is BEFORE Wednesday
        $currDate = new \DateTime('2023-11-28', new \DateTimeZone("America/New_York"));
        $currDate->setTime(21,1,0,1234);

        // when the function is called
        $resultDate = Dates::recentWeekEnding($currDate);

        // the function should return this date
        $checkDate = date('Y-m-d', strtotime('2023-11-24'));

        $this->assertSame($checkDate, $resultDate);
    }

    /** @test */
    public function recentWeekEndingBefore901pmOnTuesday(): void
    {
        // given this date that is BEFORE Wednesday
        $currDate = new \DateTime('2023-11-28', new \DateTimeZone("America/New_York"));
        $currDate->setTime(21,0,0,1234);

        // when the function is called
        $resultDate = Dates::recentWeekEnding($currDate);

        // the function should return this date
        $checkDate = date('Y-m-d', strtotime('2023-11-17'));

        $this->assertSame($checkDate, $resultDate);
    }

    /** @test */
    public function recentWeekEndingAfter1001pmOnTuesday(): void
    {
        // given this date that is BEFORE Wednesday
        $currDate = new \DateTime('2023-11-28', new \DateTimeZone("America/New_York"));
        $currDate->setTime(22,0,0,0);

        // when the function is called
        $resultDate = Dates::recentWeekEnding($currDate);

        // the function should return this date
        $checkDate = date('Y-m-d', strtotime('2023-11-24'));

        $this->assertSame($checkDate, $resultDate);
    }

    /** @test */
    public function recentWeekEndingBefore801pmOnTuesday(): void
    {
        // given this date that is BEFORE Wednesday
        $currDate = new \DateTime('2023-11-28', new \DateTimeZone("America/New_York"));
        $currDate->setTime(20,0,0,1234);

        // when the function is called
        $resultDate = Dates::recentWeekEnding($currDate);

        // the function should return this date
        $checkDate = date('Y-m-d', strtotime('2023-11-17'));

        $this->assertSame($checkDate, $resultDate);
    }

    /** @test */
    public function recentWeekEndingMonday(): void
    {
        // given this date that is BEFORE Wednesday
        $currDate = new \DateTime('2023-11-27', new \DateTimeZone("America/New_York"));
        $currDate->setTime(20,0,0,1234);

        // when the function is called
        $resultDate = Dates::recentWeekEnding($currDate);

        // the function should return this date
        $checkDate = date('Y-m-d', strtotime('2023-11-17'));

        $this->assertSame($checkDate, $resultDate);
    }

    /** @test */
    public function recentWeekEndingSaturday(): void
    {
        // given this date that is BEFORE Wednesday
        $currDate = new \DateTime('2023-11-25', new \DateTimeZone("America/New_York"));
        $currDate->setTime(20,0,0,1234);

        // when the function is called
        $resultDate = Dates::recentWeekEnding($currDate);

        // the function should return this date
        $checkDate = date('Y-m-d', strtotime('2023-11-17'));

        $this->assertSame($checkDate, $resultDate);
    }

    /** @test */
    public function recentWeekEndingWednesday(): void
    {
        // given this date that is BEFORE Wednesday
        $currDate = new \DateTime('2023-11-29', new \DateTimeZone("America/New_York"));
        $currDate->setTime(3,0,0,1234);

        // when the function is called
        $resultDate = Dates::recentWeekEnding($currDate);

        // the function should return this date
        $checkDate = date('Y-m-d', strtotime('2023-11-24'));

        $this->assertSame($checkDate, $resultDate);
    }

    /** @test */
    public function recentWeekEndingCheckTimezone(): void
    {
        // given this date that is BEFORE Wednesday
        $currDate = new \DateTime('2023-11-29');
        $currDate->setTime(3,0,0,1234);

        // when the function is called
        $resultDate = Dates::recentWeekEnding($currDate);

        // the function should return this date
        $checkDate = date('Y-m-d', strtotime('2023-11-24'));

        $this->assertSame($checkDate, $resultDate);
    }
}

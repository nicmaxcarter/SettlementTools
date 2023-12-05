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
        $currDate = new \DateTime('2023-11-28', Dates::EST());
        $currDate->setTime(21, 1, 0, 1234);
        // set the timezone back to UTC to simulate the server
        $currDate->setTimezone(Dates::UTC());

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
        $currDate = new \DateTime('2023-11-28', Dates::EST());
        $currDate->setTime(21, 0, 0, 1234);
        // set the timezone back to UTC to simulate the server
        $currDate->setTimezone(Dates::UTC());

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
        $currDate = new \DateTime('2023-11-28', Dates::EST());
        $currDate->setTime(22, 0, 0, 0);
        // set the timezone back to UTC to simulate the server
        $currDate->setTimezone(Dates::UTC());

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
        $currDate = new \DateTime('2023-11-28', Dates::EST());
        $currDate->setTime(20, 0, 0, 1234);
        // set the timezone back to UTC to simulate the server
        $currDate->setTimezone(Dates::UTC());

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
        $currDate = new \DateTime('2023-11-27', Dates::EST());
        $currDate->setTime(20, 0, 0, 1234);
        // set the timezone back to UTC to simulate the server
        $currDate->setTimezone(Dates::UTC());

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
        $currDate = new \DateTime('2023-11-25', Dates::EST());
        $currDate->setTime(20, 0, 0, 1234);
        // set the timezone back to UTC to simulate the server
        $currDate->setTimezone(Dates::UTC());

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
        $currDate = new \DateTime('2023-11-29', Dates::EST());
        $currDate->setTime(3, 0, 0, 1234);
        // set the timezone back to UTC to simulate the server
        $currDate->setTimezone(Dates::UTC());

        // when the function is called
        $resultDate = Dates::recentWeekEnding($currDate);

        // the function should return this date
        $checkDate = date('Y-m-d', strtotime('2023-11-24'));

        $this->assertSame($checkDate, $resultDate);
    }

    /** @test */
    public function recentWeekEndingCheckTimezoneBefore9pmAfterConversion(): void
    {
        // given this date that is a Tuesday at 9pm, but UTC time
        $currDate = new \DateTime('2023-11-28');
        $currDate->setTime(21, 2, 0, 1234);

        // when the function is called
        // it should convert the time to EST
        $resultDate = Dates::recentWeekEnding($currDate);

        // the function should return this date
        // and after the timezone conversion, our time will be 4pm EST
        // and we should receive two weeks back
        // since it is not technically past 9pm
        $checkDate = date('Y-m-d', strtotime('2023-11-17'));

        $this->assertSame($checkDate, $resultDate);
    }

    /** @test */
    public function recentWeekEndingCheckTimezoneAfter9pmAfterConversion(): void
    {
        // given this date that is a Wednesday at 3am, but UTC time
        $currDate = new \DateTime('2023-11-29');
        $currDate->setTime(2, 2, 0, 1234);

        // when the function is called
        // it should convert the time to EST
        $resultDate = Dates::recentWeekEnding($currDate);

        // the function should return this date
        // after the timezone conversion, our time should be 9:02pm EST
        // we should still get 11-24, unlike the function above
        $checkDate = date('Y-m-d', strtotime('2023-11-24'));

        $this->assertSame($checkDate, $resultDate);
    }
}

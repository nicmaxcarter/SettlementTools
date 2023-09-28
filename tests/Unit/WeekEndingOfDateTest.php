<?php

declare(strict_types=1);

namespace App;

use PHPUnit\Framework\TestCase;
use Nicmaxcarter\SettlementTools\Dates;

final class WeekEndingOfDateTest extends TestCase
{
    /** @test */
    public function weekEndingOfDate_FridayDateTime(): void
    {
        // given this datetime object that is a Friday
        $currDate = new \DateTime('2023-09-08');

        // when the function is called
        $resultDate = Dates::weekEndingOfDate($currDate);

        // the function should return this date
        $checkDate = new \DateTime('2023-09-08');

        $this->assertEquals($checkDate, $resultDate);
    }

    /** @test */
    public function weekEndingOfDate_FridayDateString(): void
    {
        // given this datetime string that is a Friday
        $currDate = '2023-09-08';

        // when the function is called
        $resultDate = Dates::weekEndingOfDate($currDate);

        // the function should return this date
        $checkDate = new \DateTime('2023-09-08');

        $this->assertEquals($checkDate, $resultDate);
    }

    /** @test */
    public function weekEndingOfDate_WednesdayDateTime(): void
    {
        // given this datetime object that is a Wednesday
        $currDate = new \DateTime('2023-09-06');

        // when the function is called
        $resultDate = Dates::weekEndingOfDate($currDate);

        // the function should return this date
        $checkDate = new \DateTime('2023-09-08');

        $this->assertEquals($checkDate, $resultDate);
    }

    /** @test */
    public function weekEndingOfDate_WednesdayDateString(): void
    {
        // given this datetime string that is a Wednesday
        $currDate = '2023-09-06';

        // when the function is called
        $resultDate = Dates::weekEndingOfDate($currDate);

        // the function should return this date
        $checkDate = new \DateTime('2023-09-08');

        $this->assertEquals($checkDate, $resultDate);
    }

    /** @test */
    public function weekEndingOfDate_SaturdayDateTime(): void
    {
        // given this datetime object that is a Saturday
        $currDate = new \DateTime('2023-09-02');

        // when the function is called
        $resultDate = Dates::weekEndingOfDate($currDate);

        // the function should return this date
        $checkDate = new \DateTime('2023-09-08');

        $this->assertEquals($checkDate, $resultDate);
    }

    /** @test */
    public function weekEndingOfDate_SaturdayDateString(): void
    {
        // given this datetime string that is a Saturday
        $currDate = '2023-09-02';

        // when the function is called
        $resultDate = Dates::weekEndingOfDate($currDate);

        // the function should return this date
        $checkDate = new \DateTime('2023-09-08');

        $this->assertEquals($checkDate, $resultDate);
    }
}

<?php

declare(strict_types=1);

namespace App;

use PHPUnit\Framework\TestCase;
use Nicmaxcarter\SettlementTools\Dates;

final class WeekStartTextTest extends TestCase
{
    /** @test */
    public function CheckWeekStartTextFridayDashes(): void
    {
        // given this date
        $givenDate = '2023-08-11';

        // when the function is called
        $resultDate = Dates::weekStart($givenDate);

        // the function should return this formatted string
        $checkDate = '2023-08-05';
        $this->assertEquals($checkDate, $resultDate);
    }

    /** @test */
    public function CheckWeekStartTextFridaySlashes(): void
    {
        // given this date
        $givenDate = '2023/08/11';

        // when the function is called
        $resultDate = Dates::weekStart($givenDate);

        // the function should return this formatted string
        $checkDate = '2023-08-05';
        $this->assertEquals($checkDate, $resultDate);
    }

    /** @test */
    public function CheckWeekStartTextWednesdayDashes(): void
    {
        // given this date
        $givenDate = '2023-08-09';

        // when the function is called
        $resultDate = Dates::weekStart($givenDate);

        // the function should return this formatted string
        $checkDate = '2023-08-05';
        $this->assertEquals($checkDate, $resultDate);
    }

    /** @test */
    public function CheckWeekStartTextWednesdaySlashes(): void
    {
        // given this date
        $givenDate = '2023/08/09';

        // when the function is called
        $resultDate = Dates::weekStart($givenDate);

        // the function should return this formatted string
        $checkDate = '2023-08-05';
        $this->assertEquals($checkDate, $resultDate);
    }

    /** @test */
    public function CheckWeekStartTextSaturdayDashes(): void
    {
        // given this date
        $givenDate = '2023-08-12';

        // when the function is called
        $resultDate = Dates::weekStart($givenDate);

        // the function should return this formatted string
        $checkDate = '2023-08-12';
        $this->assertEquals($checkDate, $resultDate);
    }

    /** @test */
    public function CheckWeekStartTextSaturdaySlashes(): void
    {
        // given this date
        $givenDate = '2023/08/12';

        // when the function is called
        $resultDate = Dates::weekStart($givenDate);

        // the function should return this formatted string
        $checkDate = '2023-08-12';
        $this->assertEquals($checkDate, $resultDate);
    }
}

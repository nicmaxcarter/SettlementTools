<?php

declare(strict_types=1);

namespace App;

use PHPUnit\Framework\TestCase;
use Nicmaxcarter\SettlementTools\Dates;

final class GetWeekStartDateTest extends TestCase
{
    /** @test */
    public function CheckGetWeekStartDateFridayDashes(): void
    {
        // given this date
        $givenDate = '2023-08-11';

        // when the function is called
        $resultDate = Dates::weekStartDate($givenDate);

        // the function should return this formatted string
        //$checkDate = '2023-08-05';
        $checkDate = new \DateTime('2023-08-05');
        $this->assertEquals($checkDate, $resultDate);
    }

    /** @test */
    public function CheckGetWeekStartDateFridaySlashes(): void
    {
        // given this date
        $givenDate = '2023/08/11';

        // when the function is called
        $resultDate = Dates::weekStartDate($givenDate);

        // the function should return this formatted string
        $checkDate = new \DateTime('2023-08-05');
        $this->assertEquals($checkDate, $resultDate);
    }

    /** @test */
    public function CheckGetWeekStartDateWednesdayDashes(): void
    {
        // given this date
        $givenDate = '2023-08-09';

        // when the function is called
        $resultDate = Dates::weekStartDate($givenDate);

        // the function should return this formatted string
        $checkDate = new \DateTime('2023-08-05');
        $this->assertEquals($checkDate, $resultDate);
    }

    /** @test */
    public function CheckGetWeekStartDateWednesdaySlashes(): void
    {
        // given this date
        $givenDate = '2023/08/09';

        // when the function is called
        $resultDate = Dates::weekStartDate($givenDate);

        // the function should return this formatted string
        $checkDate = new \DateTime('2023-08-05');
        $this->assertEquals($checkDate, $resultDate);
    }

    /** @test */
    public function CheckGetWeekStartDateSaturdayDashes(): void
    {
        // given this date
        $givenDate = '2023-08-12';

        // when the function is called
        $resultDate = Dates::weekStartDate($givenDate);

        // the function should return this formatted string
        $checkDate = new \DateTime('2023-08-12');
        $this->assertEquals($checkDate, $resultDate);
    }

    /** @test */
    public function CheckGetWeekStartDateSaturdaySlashes(): void
    {
        // given this date
        $givenDate = '2023/08/12';

        // when the function is called
        $resultDate = Dates::weekStartDate($givenDate);

        // the function should return this formatted string
        $checkDate = new \DateTime('2023-08-12');
        $this->assertEquals($checkDate, $resultDate);
    }
}

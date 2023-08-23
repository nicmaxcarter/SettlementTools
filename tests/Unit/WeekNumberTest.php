<?php

declare(strict_types=1);

namespace App;

use PHPUnit\Framework\TestCase;
use Nicmaxcarter\SettlementTools\Dates;

final class WeekNumberTest extends TestCase
{
    /** @test */
    public function CheckWeekOneFriday(): void
    {
        // given this date
        $givenDate = '2023-01-06';

        // when the function is called
        $resultNumber = Dates::weekNumber($givenDate);
        $legacyResult = Dates::weekNumberLegacy($givenDate);

        // the function should return this formatted string
        $checkNumber = 1;
        $this->assertEquals($checkNumber,$resultNumber);
        $this->assertEquals($checkNumber,$legacyResult);
    }

    /** @test */
    public function Check35Week(): void
    {
        // given this date
        $givenDate = '2022-09-02';

        // when the function is called
        $resultNumber = Dates::weekNumber($givenDate);
        $legacyResult = Dates::weekNumberLegacy($givenDate);

        // the function should return this formatted string
        $checkNumber = 35;
        $this->assertEquals($checkNumber,$resultNumber);
        $this->assertEquals($checkNumber,$legacyResult);
    }

    /** @test */
    public function Check28Week(): void
    {
        // given this date
        $givenDate = '2023-07-14';

        // when the function is called
        $resultNumber = Dates::weekNumber($givenDate);
        $legacyResult = Dates::weekNumberLegacy($givenDate);

        // the function should return this formatted string
        $checkNumber = 28;
        $this->assertEquals($checkNumber,$resultNumber);
        $this->assertEquals($checkNumber,$legacyResult);
    }

    /** @test */
    public function CheckLastWeek(): void
    {
        // given this date
        $givenDate = '2022-12-30';

        // when the function is called
        $resultNumber = Dates::weekNumber($givenDate);
        $legacyResult = Dates::weekNumberLegacy($givenDate);

        // the function should return this formatted string
        $checkNumber = 52;
        $this->assertEquals($checkNumber,$resultNumber);
        $this->assertEquals($checkNumber,$legacyResult);
    }

    /** @test */
    public function CheckFalseReturn(): void
    {
        // given this date
        $givenDate = '2023-01-07';

        // when the function is called
        $resultNumber = Dates::weekNumber($givenDate);
        $legacyResult = Dates::weekNumberLegacy($givenDate);

        // the function should return this formatted string
        $checkNumber = false;
        $this->assertEquals($checkNumber,$resultNumber);
        $this->assertEquals($checkNumber,$legacyResult);
    }
}

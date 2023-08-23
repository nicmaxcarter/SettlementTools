<?php


declare(strict_types=1);

namespace App;

use PHPUnit\Framework\TestCase;
use Nicmaxcarter\SettlementTools\Dates;

final class YearsSpannedTest extends TestCase
{
    /** @test */
    public function CheckYearsSpanned6(): void
    {
        // given these dates
        $firstDate = '2018-02-02';
        $lastDate = '2023-07-28';

        // when the function is called
        $resultYears = Dates::yearsSpanned(
            $firstDate,
            $lastDate
        );

        // the function should return this formatted string
        $expectedArray = [2018,2019,2020,2021,2022,2023];
        $this->assertEquals($expectedArray,$resultYears);
    }

    /** @test */
    public function CheckYearsSpannedExpect1(): void
    {
        // given these dates
        $firstDate = '2023-02-02';
        $lastDate = '2023-07-28';

        // when the function is called
        $resultYears = Dates::yearsSpanned(
            $firstDate,
            $lastDate
        );

        // the function should return this formatted string
        $expectedArray = [2023];
        $this->assertEquals($expectedArray,$resultYears);
    }

    /** @test */
    public function CheckYearsSpannedExpectEmpty(): void
    {
        // given these dates
        $firstDate = '2018-02-02';
        $lastDate = '2023-07-28';

        // when the function is called
        $resultYears = Dates::yearsSpanned(
            $lastDate,
            $firstDate
        );

        // the function should return this formatted string
        $expectedArray = [];
        $this->assertEquals($expectedArray,$resultYears);
    }
}

<?php

declare(strict_types=1);

namespace App;

use PHPUnit\Framework\TestCase;
use Nicmaxcarter\SettlementTools\Dates;

final class StartOfPastYearTest extends TestCase
{
    /** @test */
    public function firstDayOfThreeYearsAgo(): void
    {
        // given this date
        $givenDate = '2023-06-22';

        // when the function is called
        $result = Dates::startOfAPastYear($givenDate, 3);

        // the function should return this formatted string
        $checkDate = '2020-01-01';
        $this->assertEquals($checkDate,$result);
    }

    /** @test */
    public function firstDayOfTwoYearsAgo(): void
    {
        // given this date
        $givenDate = '2023-06-22';

        // when the function is called
        $result = Dates::startOfAPastYear($givenDate, 2);

        // the function should return this formatted string
        $checkDate = '2021-01-01';
        $this->assertEquals($checkDate,$result);
    }

    /** @test */
    public function firstDayOfCurrentYear(): void
    {
        // given this date
        $givenDate = '2023-06-22';

        // when the function is called
        $result = Dates::startOfAPastYear($givenDate);

        // the function should return this formatted string
        $checkDate = '2023-01-01';
        $this->assertEquals($checkDate,$result);
    }
}

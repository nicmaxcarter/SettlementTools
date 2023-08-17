<?php

declare(strict_types=1);

namespace App;

use PHPUnit\Framework\TestCase;
use Nicmaxcarter\SettlementTools\Dates;

final class PriorWeekEndingsTest extends TestCase
{
    /** @test */
    public function CheckPriorWeekEndings5(): void
    {
        // given this date
        $givenDate = '2023-09-08';

        // when the function is called
        $resultDate = Dates::priorWeekEndings($givenDate, 5);

        // the function should return this formatted string
        $checkArray = [
            '2023-09-08',
            '2023-09-01',
            '2023-08-25',
            '2023-08-18',
            '2023-08-11',
        ];

        $this->assertEquals($checkArray, $resultDate);
    }
}

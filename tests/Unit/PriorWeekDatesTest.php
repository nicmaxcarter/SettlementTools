<?php

declare(strict_types=1);

namespace App;

use PHPUnit\Framework\TestCase;
use Nicmaxcarter\SettlementTools\Dates;

final class PriorWeekDatesTest extends TestCase
{
    /** @test */
    public function CheckPriorWeekDates5(): void
    {
        // given this date
        $givenDate = '2023-09-08';

        // when the function is called
        $resultDate = Dates::priorWeekDates($givenDate, 5);

        // the function should return this formatted string
        $checkArray = [
            [
            'start' =>'2023-09-02',
            'end' =>'2023-09-08'
            ],
            [
            'start' =>'2023-08-26',
            'end' =>'2023-09-01'
            ],
            [
            'start' =>'2023-08-19',
            'end' =>'2023-08-25'
            ],
            [
            'start' =>'2023-08-12',
            'end' =>'2023-08-18'
            ],
            [
            'start' =>'2023-08-05',
            'end' =>'2023-08-11'
            ]
        ];

        $this->assertEquals($checkArray, $resultDate);
    }
}

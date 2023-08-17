<?php

declare(strict_types=1);

namespace App;

use PHPUnit\Framework\TestCase;
use Nicmaxcarter\SettlementTools\Dates;

final class PriorWeekDatesPrettyTest extends TestCase
{
    /** @test */
    public function CheckPriorWeekDatesPretty3(): void
    {
        // given this date
        $givenDate = '2023-09-08';

        // when the function is called
        $resultDate = Dates::priorWeekDatesPretty($givenDate, 3);

        // the function should return this formatted string
        $checkArray = [
            '2023-09-08' => [
                'start' => 'Sep 2, 2023',
                'end' => 'Sep 8, 2023'
            ],
            '2023-09-01' => [
                'start' => 'Aug 26, 2023',
                'end' => 'Sep 1, 2023'
            ],
            '2023-08-25' => [
                'start' => 'Aug 19, 2023',
                'end' => 'Aug 25, 2023'
            ]
        ];

        $this->assertEquals($checkArray, $resultDate);
    }
}

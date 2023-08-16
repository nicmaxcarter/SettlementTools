<?php

declare(strict_types=1);

namespace App;

use PHPUnit\Framework\TestCase;
use Nicmaxcarter\SettlementTools\Dates;

final class GetWeekEndTextTest extends TestCase
{
    /** @test */
    public function CheckWeekEndTextWithDashes_Ymd(): void
    {
        // given this date
        $givenDate = '2022-02-18';

        // when the function is called
        $resultDate = Dates::weekEndText($givenDate);

        // the function should return this formatted string
        $checkDate = '02/18/2022';
        $this->assertSame($checkDate, $resultDate);
    }

    /** @test */
    public function CheckWeekEndTextWithSlashes_Ymd(): void
    {
        // given this date
        $givenDate = '2022/02/18';

        // when the function is called
        $resultDate = Dates::weekEndText($givenDate);

        // the function should return this formatted string
        $checkDate = '02/18/2022';
        $this->assertSame($checkDate, $resultDate);
    }

    /** @test */
    public function CheckWeekEndTextWithDashes_dmY(): void
    {
        // given this date
        $givenDate = '03-02-1995';

        // when the function is called
        $resultDate = Dates::weekEndText($givenDate);

        // the function should return this formatted string
        $checkDate = '02/03/1995';
        $this->assertSame($checkDate, $resultDate);
    }

    /** @test */
    public function CheckWeekEndTextWithSlashes_mdY(): void
    {
        // given this date
        $givenDate = '03/02/1995';

        // when the function is called
        $resultDate = Dates::weekEndText($givenDate);

        // the function should return this formatted string
        $checkDate = '03/02/1995';
        $this->assertSame($checkDate, $resultDate);
    }
}

<?php

declare(strict_types=1);

namespace App;

use PHPUnit\Framework\TestCase;
use Nicmaxcarter\SettlementTools\Dates;

final class ConfirmAdjacentWeeksTest extends TestCase
{
    /** @test */
    public function confirmAdjacentWeeks_true_twoSaturdays(): void
    {
        // given this datetime object that is a Friday
        $dateOne = new \DateTime('2023-09-09');
        $dateTwo = new \DateTime('2023-09-16');

        // when the function is called
        $check = Dates::ConfirmAdjacentWeeks(
            $dateOne,
            $dateTwo
        );

        $this->assertTrue($check);
    }

    /** @test */
    public function confirmAdjacentWeeks_true_notTwoSaturdays(): void
    {
        // given this datetime object that is a Friday
        $dateOne = new \DateTime('2023-09-10');
        $dateTwo = new \DateTime('2023-09-16');

        // when the function is called
        $check = Dates::ConfirmAdjacentWeeks(
            $dateOne,
            $dateTwo
        );

        $this->assertTrue($check);
    }

    /** @test */
    public function confirmAdjacentWeeks_false_dateOneTooFarAhead(): void
    {
        // given this datetime object that is a Friday
        $dateOne = new \DateTime('2023-09-08');
        $dateTwo = new \DateTime('2023-09-16');

        // when the function is called
        $check = Dates::ConfirmAdjacentWeeks(
            $dateOne,
            $dateTwo
        );

        $this->assertFalse($check);
    }

    /** @test */
    public function confirmAdjacentWeeks_false_dateOneComesAfter(): void
    {
        // given this datetime object that is a Friday
        $dateOne = new \DateTime('2023-09-23');
        $dateTwo = new \DateTime('2023-09-16');

        // when the function is called
        $check = Dates::ConfirmAdjacentWeeks(
            $dateOne,
            $dateTwo
        );

        $this->assertFalse($check);
    }
}

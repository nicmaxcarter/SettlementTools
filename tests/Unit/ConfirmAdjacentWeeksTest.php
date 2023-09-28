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
        $check = Dates::confirmAdjacentWeeks(
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
        $check = Dates::confirmAdjacentWeeks(
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
        $check = Dates::confirmAdjacentWeeks(
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
        $check = Dates::confirmAdjacentWeeks(
            $dateOne,
            $dateTwo
        );

        $this->assertFalse($check);
    }

    /** @test */
    public function confirmAdjacentWeeks_true_twoSaturdays_string(): void
    {
        $dateOne = '2023-09-09';
        $dateTwo = '2023-09-16';

        // when the function is called
        $check = Dates::confirmAdjacentWeeks(
            $dateOne,
            $dateTwo
        );

        $this->assertTrue($check);
    }

    /** @test */
    public function confirmAdjacentWeeks_true_notTwoSaturdays_string(): void
    {
        $dateOne = '2023-09-10';
        $dateTwo = '2023-09-16';

        // when the function is called
        $check = Dates::confirmAdjacentWeeks(
            $dateOne,
            $dateTwo
        );

        $this->assertTrue($check);
    }

    /** @test */
    public function confirmAdjacentWeeks_false_dateOneTooFarAhead_string(): void
    {
        $dateOne = '2023-09-08';
        $dateTwo = '2023-09-16';

        // when the function is called
        $check = Dates::confirmAdjacentWeeks(
            $dateOne,
            $dateTwo
        );

        $this->assertFalse($check);
    }

    /** @test */
    public function confirmAdjacentWeeks_false_dateOneComesAfter_string(): void
    {
        $dateOne = '2023-09-23';
        $dateTwo = '2023-09-16';

        // when the function is called
        $check = Dates::confirmAdjacentWeeks(
            $dateOne,
            $dateTwo
        );

        $this->assertFalse($check);
    }

    /** @test */
    public function twoWeekEndingsOrderedAdjacent_yymmdd_true(): void
    {
        $this->assertTrue(
            Dates::confirmAdjacentWeeks(
                '2023-03-04',
                '2023-03-11'
            )
        );

        $this->assertTrue(
            Dates::confirmAdjacentWeeks(
                '2022-9-13',
                '2022-09-21'
            )
        );
    }

    /** @test */
    public function twoWeekEndingsOrderedAdjacent_yymmdd_false(): void
    {
        $this->assertFalse(
            Dates::confirmAdjacentWeeks(
                '2023-03-11',
                '2023-03-04'
            )
        );

        $this->assertFalse(
            Dates::confirmAdjacentWeeks(
                '2023-03-11',
                '2023-03-11'
            )
        );

        $this->assertFalse(
            Dates::confirmAdjacentWeeks(
                '2022-9-05',
                '2022-09-21'
            )
        );
        $this->assertFalse(
            Dates::confirmAdjacentWeeks(
                '2022-09-29',
                '2022-09-21'
            )
        );
    }

    /** @test */
    public function twoWeekEndingsOrderedAdjacent_ddMyy_true(): void
    {
        $this->assertTrue(
            Dates::confirmAdjacentWeeks(
                "05-MAR-2023",
                "13-MAR-2023"
            )
        );

        $this->assertTrue(
            Dates::confirmAdjacentWeeks(
                "06-AUG-2022",
                "14-AUG-2022"
            )
        );
    }

    /** @test */
    public function twoWeekEndingsOrderedAdjacent_ddMyy_false(): void
    {
        $this->assertFalse(
            Dates::confirmAdjacentWeeks(
                "05-MAR-2023",
                "22-MAR-2023"
            )
        );

        $this->assertFalse(
            Dates::confirmAdjacentWeeks(
                "01-AUG-2022",
                "14-AUG-2022"
            )
        );

        $this->assertFalse(
            Dates::confirmAdjacentWeeks(
                "14-AUG-2022",
                "14-AUG-2022"
            )
        );
        $this->assertFalse(
            Dates::confirmAdjacentWeeks(
                "22-AUG-2022",
                "14-AUG-2022"
            )
        );
    }
}

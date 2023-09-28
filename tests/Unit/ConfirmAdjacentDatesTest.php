<?php

declare(strict_types=1);

namespace App;

use PHPUnit\Framework\TestCase;
use Nicmaxcarter\SettlementTools\Dates;

final class ConfirmAdjacentDatesTest extends TestCase
{

    protected function setUp(): void
    {
        parent::setUp();
    }

    /** @test */
    public function twoDatesOrderedAdjacent_yymmdd_true(): void
    {
        $this->assertTrue(
            Dates::confirmAdjacentDates(
                '2023-03-10',
                '2023-03-11'
            )
        );

        $this->assertTrue(
            Dates::confirmAdjacentDates(
                '2022-9-20',
                '2022-09-21'
            )
        );
    }

    /** @test */
    public function twoDatesOrderedAdjacent_yymmdd_false(): void
    {
        $this->assertFalse(
            Dates::confirmAdjacentDates(
                '2023-03-11',
                '2023-03-10'
            )
        );

        $this->assertFalse(
            Dates::confirmAdjacentDates(
                '2023-03-11',
                '2023-03-11'
            )
        );

        $this->assertFalse(
            Dates::confirmAdjacentDates(
                '2022-09-21',
                '2022-9-05'
            )
        );
        $this->assertFalse(
            Dates::confirmAdjacentDates(
                '2022-09-30',
                '2022-09-29'
            )
        );
    }

    /** @test */
    public function twoDatesOrderedAdjacent_ddMyy_true(): void
    {
        $this->assertTrue(
            Dates::confirmAdjacentDates(
                "12-MAR-2023",
                "13-MAR-2023"
            )
        );

        $this->assertTrue(
            Dates::confirmAdjacentDates(
                "13-AUG-2022",
                "14-AUG-2022"
            )
        );
    }

    /** @test */
    public function twoDatesOrderedAdjacent_ddMyy_false(): void
    {
        $this->assertFalse(
            Dates::confirmAdjacentDates(
                "23-MAR-2023",
                "22-MAR-2023"
            )
        );

        $this->assertFalse(
            Dates::confirmAdjacentDates(
                "14-AUG-2022",
                "13-AUG-2022"
            )
        );

        $this->assertFalse(
            Dates::confirmAdjacentDates(
                "14-AUG-2022",
                "14-AUG-2022"
            )
        );
        $this->assertFalse(
            Dates::confirmAdjacentDates(
                "22-AUG-2022",
                "14-AUG-2022"
            )
        );
    }
}

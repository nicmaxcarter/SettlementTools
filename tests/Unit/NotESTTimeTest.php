<?php

declare(strict_types=1);

namespace App;

use PHPUnit\Framework\TestCase;
use Nicmaxcarter\SettlementTools\Dates;

final class NotESTTimeTest extends TestCase
{
    /** @test */
    public function notESTTimeTestFalseGivenEST(): void
    {
        // given this date that is set to EST timezone
        $date = new \DateTime('2022-03-08 10:00');
        $date->setTimezone(new \DateTimeZone("America/New_York"));

        $this->assertFalse(Dates::notESTTime($date));
    }

    /** @test */
    public function notESTTimeTestTrueGivenUTC(): void
    {
        // given this date that is set to UTC timezone
        $date = new \DateTime('2022-03-08 10:00');
        $date->setTimezone(new \DateTimeZone("UTC"));

        $this->assertTrue(Dates::notESTTime($date));
    }

    /** @test */
    public function notESTTimeTestTrueGivenDefaultUTC(): void
    {
        // given this date that should default to UTC timezone
        $date = new \DateTime('2022-03-08 10:00');

        $this->assertTrue(Dates::notESTTime($date));
    }
}

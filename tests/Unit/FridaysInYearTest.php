<?php

declare(strict_types=1);

namespace App;

use PHPUnit\Framework\TestCase;
use Nicmaxcarter\SettlementTools\Dates;

final class FridaysInYearTest extends TestCase
{
    /** @test */
    public function CheckFridaysIn2023(): void
    {
        // given this year
        $year = 2023;

        // when the function is called
        $result = Dates::fridaysInYear($year);

        // the function should return this formatted string
        $expectedArray = self::fridaysIn2023();
        $this->assertEquals($expectedArray, $result);
        $this->assertEquals(52, count($result));
    }

    /** @test */
    public function CheckFridaysIn2022(): void
    {
        // given this year
        $year = 2022;

        // when the function is called
        $result = Dates::fridaysInYear($year);

        // the function should return this formatted string
        $expectedArray = self::fridaysIn2022();
        $this->assertEquals($expectedArray, $result);
        $this->assertEquals(52, count($result));
    }

    /** @test */
    public function CheckFridaysIn2021(): void
    {
        // given this year
        $year = 2021;

        // when the function is called
        $result = Dates::fridaysInYear($year);

        // the function should return this formatted string
        $expectedArray = self::fridaysIn2021();
        $this->assertEquals($expectedArray, $result);
        $this->assertEquals(53, count($result));
    }

    /** @test */
    public function CheckFridaysIn2020(): void
    {
        // given this year
        $year = 2020;

        // when the function is called
        $result = Dates::fridaysInYear($year);

        // the function should return this formatted string
        $expectedArray = self::fridaysIn2020();
        $this->assertEquals($expectedArray, $result);
        $this->assertEquals(52, count($result));
    }

    /** @test */
    public function CheckFridaysIn2019(): void
    {
        // given this year
        $year = 2019;

        // when the function is called
        $result = Dates::fridaysInYear($year);

        // the function should return this formatted string
        $expectedArray = self::fridaysIn2019();
        $this->assertEquals($expectedArray, $result);
        $this->assertEquals(52, count($result));
    }

    /**
     * @return array<mixed>
     */
    private static function fridaysIn2023(): array
    {
        $str = "2023-01-06,2023-01-13,2023-01-20,2023-01-27,2023-02-03,2023-02-10,2023-02-17,2023-02-24,2023-03-03,2023-03-10,2023-03-17,2023-03-24,2023-03-31,2023-04-07,2023-04-14,2023-04-21,2023-04-28,2023-05-05,2023-05-12,2023-05-19,2023-05-26,2023-06-02,2023-06-09,2023-06-16,2023-06-23,2023-06-30,2023-07-07,2023-07-14,2023-07-21,2023-07-28,2023-08-04,2023-08-11,2023-08-18,2023-08-25,2023-09-01,2023-09-08,2023-09-15,2023-09-22,2023-09-29,2023-10-06,2023-10-13,2023-10-20,2023-10-27,2023-11-03,2023-11-10,2023-11-17,2023-11-24,2023-12-01,2023-12-08,2023-12-15,2023-12-22,2023-12-29";

        return explode(",", $str);
    }

    /**
     * @return array<mixed>
     */
    private static function fridaysIn2022(): array
    {
        $str = "2022-01-07,2022-01-14,2022-01-21,2022-01-28,2022-02-04,2022-02-11,2022-02-18,2022-02-25,2022-03-04,2022-03-11,2022-03-18,2022-03-25,2022-04-01,2022-04-08,2022-04-15,2022-04-22,2022-04-29,2022-05-06,2022-05-13,2022-05-20,2022-05-27,2022-06-03,2022-06-10,2022-06-17,2022-06-24,2022-07-01,2022-07-08,2022-07-15,2022-07-22,2022-07-29,2022-08-05,2022-08-12,2022-08-19,2022-08-26,2022-09-02,2022-09-09,2022-09-16,2022-09-23,2022-09-30,2022-10-07,2022-10-14,2022-10-21,2022-10-28,2022-11-04,2022-11-11,2022-11-18,2022-11-25,2022-12-02,2022-12-09,2022-12-16,2022-12-23,2022-12-30";

        return explode(",", $str);
    }

    /**
     * @return array<mixed>
     */
    private static function fridaysIn2021(): array
    {
        $str = "2021-01-01,2021-01-08,2021-01-15,2021-01-22,2021-01-29,2021-02-05,2021-02-12,2021-02-19,2021-02-26,2021-03-05,2021-03-12,2021-03-19,2021-03-26,2021-04-02,2021-04-09,2021-04-16,2021-04-23,2021-04-30,2021-05-07,2021-05-14,2021-05-21,2021-05-28,2021-06-04,2021-06-11,2021-06-18,2021-06-25,2021-07-02,2021-07-09,2021-07-16,2021-07-23,2021-07-30,2021-08-06,2021-08-13,2021-08-20,2021-08-27,2021-09-03,2021-09-10,2021-09-17,2021-09-24,2021-10-01,2021-10-08,2021-10-15,2021-10-22,2021-10-29,2021-11-05,2021-11-12,2021-11-19,2021-11-26,2021-12-03,2021-12-10,2021-12-17,2021-12-24,2021-12-31";

        return explode(",", $str);
    }

    /**
     * @return array<mixed>
     */
    private static function fridaysIn2020(): array
    {
        $str = "2020-01-03,2020-01-10,2020-01-17,2020-01-24,2020-01-31,2020-02-07,2020-02-14,2020-02-21,2020-02-28,2020-03-06,2020-03-13,2020-03-20,2020-03-27,2020-04-03,2020-04-10,2020-04-17,2020-04-24,2020-05-01,2020-05-08,2020-05-15,2020-05-22,2020-05-29,2020-06-05,2020-06-12,2020-06-19,2020-06-26,2020-07-03,2020-07-10,2020-07-17,2020-07-24,2020-07-31,2020-08-07,2020-08-14,2020-08-21,2020-08-28,2020-09-04,2020-09-11,2020-09-18,2020-09-25,2020-10-02,2020-10-09,2020-10-16,2020-10-23,2020-10-30,2020-11-06,2020-11-13,2020-11-20,2020-11-27,2020-12-04,2020-12-11,2020-12-18,2020-12-25";

        return explode(",", $str);
    }

    /**
     * @return array<mixed>
     */
    private static function fridaysIn2019(): array
    {
        $str = "2019-01-04,2019-01-11,2019-01-18,2019-01-25,2019-02-01,2019-02-08,2019-02-15,2019-02-22,2019-03-01,2019-03-08,2019-03-15,2019-03-22,2019-03-29,2019-04-05,2019-04-12,2019-04-19,2019-04-26,2019-05-03,2019-05-10,2019-05-17,2019-05-24,2019-05-31,2019-06-07,2019-06-14,2019-06-21,2019-06-28,2019-07-05,2019-07-12,2019-07-19,2019-07-26,2019-08-02,2019-08-09,2019-08-16,2019-08-23,2019-08-30,2019-09-06,2019-09-13,2019-09-20,2019-09-27,2019-10-04,2019-10-11,2019-10-18,2019-10-25,2019-11-01,2019-11-08,2019-11-15,2019-11-22,2019-11-29,2019-12-06,2019-12-13,2019-12-20,2019-12-27";

        return explode(",", $str);
    }
}

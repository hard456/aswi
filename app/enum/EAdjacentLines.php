<?php

namespace App\Enum;


class EAdjacentLines
{
    const LINES_0 = 0;
    const LINES_1 = 1;
    const LINES_2 = 2;
    const LINES_3 = 3;
    const LINES_5 = 5;
    const LINES_10 = 10;
    const LINES_15 = 15;

    public static $lines = [
        self::LINES_0,
        self::LINES_1,
        self::LINES_2,
        self::LINES_3,
        self::LINES_5,
        self::LINES_10,
        self::LINES_15
    ];

    public static $selectValues = [
        self::LINES_0 => '0',
        self::LINES_1 => '1',
        self::LINES_2 => '2',
        self::LINES_3 => '3',
        self::LINES_5 => '5',
        self::LINES_10 => '10',
        self::LINES_15 => '15'
    ];

    public static $defaultLines = self::LINES_0;
}
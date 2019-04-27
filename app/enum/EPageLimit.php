<?php

namespace App\Enum;


class EPageLimit
{
    const LIMIT_1 = 1;
    const LIMIT_2 = 2;
    const LIMIT_3 = 3;
    const LIMIT_5 = 5;
    const LIMIT_10 = 10;
    const LIMIT_15 = 15;
    const LIMIT_30 = 30;

    public static $limits = [
        self::LIMIT_1,
        self::LIMIT_2,
        self::LIMIT_3,
        self::LIMIT_5,
        self::LIMIT_10,
        self::LIMIT_15,
        self::LIMIT_30
    ];

    public static $selectValues = [
        self::LIMIT_1 => '1',
        self::LIMIT_2 => '2',
        self::LIMIT_3 => '3',
        self::LIMIT_5 => '5',
        self::LIMIT_10 => '10',
        self::LIMIT_15 => '15',
        self::LIMIT_30 => '30'
    ];

    public static $defaultLimit = self::LIMIT_5;
}
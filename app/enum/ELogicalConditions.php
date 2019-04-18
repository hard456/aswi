<?php

namespace App\Enum;


class ELogicalConditions
{
    const NOT_USED = '';
    const AND = 'and';
    const OR = 'or';
    const AND_NOT = 'and_not';

    public static $selectValues = [
        self::NOT_USED => '- NOT USED -',
        self::AND => 'AND',
        self::OR => 'OR',
        self::AND_NOT => 'AND NOT'
    ];
}
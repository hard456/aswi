<?php

namespace App\Enum;


class ESearchFormOperators
{
    const NOT_USED = '';
    const AND = 'and';
    const OR = 'or';
    const AND_NOT = 'and_not';

    const EQUALS = 'eq';
    const NOT_EQUALS = 'neq';
    const CONTAINS = 'con';
    const BEGINS_WITH = 'bw';
    const ENDS_WITH = 'ew';

    const IS = 'is';
    const IS_NOT = 'is_not';


    public static $wordSelectLabels = [
        self::NOT_USED => '- NOT USED -',
        self::AND => 'AND',
        self::OR => 'OR',
        self::AND_NOT => 'AND NOT'
    ];

    public static $wordWhereCondition = [
        self::AND => 'AND',
        self::OR => 'OR',
        self::AND_NOT => 'AND NOT'
    ];


    public static $selectLikeOperatorLabels = [
        self::EQUALS => 'Equals',
        self::NOT_EQUALS => 'Not equals',
        self::CONTAINS => 'Contains',
        self::BEGINS_WITH => 'Begins with',
        self::ENDS_WITH => 'Ends with'
    ];

    public static $selectLikeOperatorQueryCondition = [
        self::EQUALS => ' = ? ',
        self::NOT_EQUALS => ' <> ? ',
        self::CONTAINS => ' LIKE ? ',
        self::BEGINS_WITH => ' LIKE ? ',
        self::ENDS_WITH => ' LIKE ? '
    ];


    public static $selectEqualsOperatorLabels = [
        self::IS => 'Is',
        self::IS_NOT => 'Is not'
    ];

    public static $selectEqualsOperatorQueryCondition = [
        self::IS => ' = ? ',
        self::IS_NOT => ' <> ? '
    ];
}
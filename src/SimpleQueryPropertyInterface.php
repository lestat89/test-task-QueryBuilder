<?php

namespace App;

/**
 * Interface SimpleQueryPropertyInterface
 * @package App
 */
interface SimpleQueryPropertyInterface
{
    /** @var array */
    public const WHERE_TYPE_CONDITIONS = [
        'AND',
        'OR',
    ];

    /** @var array */
    public const WHERE_OPERATORS = [
        '<',
        '>',
        '=',
        '!=',
        '<>',
        '<=>',
        '<=',
        '>=',
        'in',
        'not in',
    ];

    /** @var array */
    public const SORT_TYPES = [
        'ASC',
        'DESC',
    ];
}

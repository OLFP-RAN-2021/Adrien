<?php

namespace Framework\Databases;

class SQL
{
    const JOIN_NATURAL = 0;
    const JOIN_INNER = 1;
    const JOIN_OUTER = 2;
    const JOIN_LEFT = 4;
    const JOIN_RIGHT = 6;
    const JOIN_EQUI = 7;
    const JOIN_NONEQUI = 8;
    const JOIN_FULLOUTER = 9;
    const JOIN_CROSS = 10;

    const EQUAL = '=';
    const NOT = '!=';
    const HIGHTER = '>';
    const HIGHTEROREQUAL = '>=';
    const LOWER = '<';
    const LOWEROREQUAL = '<=';
    const BETWEEN = 'BETWEEN';
    const LIKE = 'LIKE';
    const IN = 'IN';
}

<?php

namespace Framework\Databases;

class SQL
{
    const ON_UPDATE_CASCADE = 'ON UPDATE CASCADE';
    const ON_UPDATE_STRICT = 'ON UPDATE STRICT';
    const ON_UPDATE_DEFAULT = 'ON UPDATE DEFAULT';
    const ON_DELETE_CASCADE = 'ON DELETE CASCADE';
    const ON_DELETE_STRICT = 'ON DELETE STRICT';
    const ON_DELETE_DEFAULT = 'ON DELETE DEFAULT';

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

    const INT = 'INT';
    const INT_UNSIGNED = 'INT';
    const FLOAT = 'FLOAT';
    const DOUBLE = 'DOUBLE';
    const BIN = 'BINARY';
    const BINARY = 'BINARY';
    const BOOL = 'BOOL';

    const CHAR = 'CHAR';
    const VARCHAR = 'VARCHAR';
    const TEXT = 'TEXT';
    const LONGTEXT = 'LONGTEXT';
    const BLOB = 'BLOB';
    const LONGBLOB = 'LONGBLOB';

    const DATE = 'DATE';
    const DATETIME = 'DATETIME';
    const TIMESTAMP = 'TIMESTAMP';
    const TIME = 'TIME';
    const YEAR = 'YEAR';
}

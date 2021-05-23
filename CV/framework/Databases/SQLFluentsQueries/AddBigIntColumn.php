<?php

namespace Framework\Databases;

class AddBigIntColumn
{

    function __construct(string $colname, bool $signed = false)
    {
        if ($signed) {
            $max = 9223372036854775808;
        } else {
            $max = 18446744073709551616;
        }
        $this->request = ' ADD ' . $colname . ' BIGINT(' . $max . ')';
    }
}

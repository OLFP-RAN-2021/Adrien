<?php

namespace Framework\Databases;

class EntitiesParser
{
    function __construct()
    {
    }


    function parser(array $data)
    {
        foreach ($data as $row) {
            $colname = $row[0];
        }
    }
}

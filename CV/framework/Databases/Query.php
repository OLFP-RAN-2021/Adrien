<?php

namespace Framework\Databases;

use ReflectionClass;

class Query
{
    static function __callStatic(string $funcname, array $args)
    {
        if ('on' == $funcname)
            return new QueryHandler($args[0]);
    }
}

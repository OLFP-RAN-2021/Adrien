<?php

namespace Framework\Databases\SQLElements\Keys;

class UniqueKey extends Keys
{
    function __construct()
    {
        $this->is_unique = true;
    }
}

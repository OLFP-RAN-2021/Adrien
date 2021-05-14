<?php

use Framework\Databases\SQLElements\Keys\Factory;
use Framework\Databases\SQLElements\Keys\Keys;

class Data
{


    public function __construct(
        private string $colname,
        private string $type,
        private string $default,
        private int $max,
        private bool $isPrimary = false,
        private bool $isUnique = false,
        private Keys $key = null,
    ) {
    }
}

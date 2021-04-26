<?php

class DevMod
{
    /**
     * Class DevMod : 
     */
    public function __construct(bool $mod = false)
    {
        define('DEV', $mod);
        if (DEV === true) {
        }
    }

    public function __destruct()
    {
    }
}

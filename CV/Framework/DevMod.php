<?php

class DevMod
{
    /**
     * 
     */
    public function __construct(bool $mod = false)
    {
        define('DEV', $mod);
        if (DEV === true) {
        }
    }
}

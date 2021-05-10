<?php

namespace Framework\Autoloader;

include_once __DIR__ . "/AutoloaderOBJ";

class AutoloadTrigger
{
    /**
     * Start autoloader
     */
    static function registre()
    {
        AutoloaderOBJ::getIstance();
        spl_autoload_register(['AutoloaderOBJ', 'loader']);
    }

    /**
     * 
     */
    static function unregistre()
    {
        spl_autoload_unregister(['AutoloaderOBJ', 'unloader']);
    }
}

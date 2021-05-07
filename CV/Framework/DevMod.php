<?php

namespace Framework;

class DevMod
{

    /**
     * @var $devmod : singleton DevMod 
     */
    static $devmod = null;

    /**
     * @static : set/get the singleton
     * 
     * @param ...$params : voir DevMod::__construct();
     * @return selfMyNamespace
     */
    static function getInstance(...$params)
    {
        if (null == self::$devmod)
            self::$devmod = new self(...$params);
        return self::$devmod;
    }

    /**
     *  
     */
    public function __construct()
    {
        Debbuger::getInstance();
    }

    /**
     * 
     */
    public function __destruct()
    {
    }
}

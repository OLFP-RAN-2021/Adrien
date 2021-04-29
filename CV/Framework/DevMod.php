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
    static function singleton(...$params)
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
        ini_set('display_errors', '1');
        $this->debbuger = new Debbuger();
    }

    /**
     * 
     */
    public function __destruct()
    {
    }
}

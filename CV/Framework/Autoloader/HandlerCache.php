<?php

namespace Framework\Autoloader;

// get cache
include_once __DIR__ . '/Autoloader.php';
include_once  __DIR__ . '/functions.php';

/**
 * 
 */
class HandlerCache
{
    const PATH = __DIR__ . '/cache/Handler.php';

    function __construct()
    {
        $this->config = include self::PATH;
    }

    function save()
    {
        $data = format($this->config);
        file_put_contents(self::PATH, $data);
    }
}

<?php

namespace Framework\Autoloader;

// get cache
include_once __DIR__ . '/Autoloader.php';

/**
 * 
 */
class Handler
{
    static array $list = [];

    /**
     * Create new autoloader
     */
    static function new(string $appnamespace, string $appfolder, bool $registre = true)
    {
        $name = 'autoloader_' . sha1($appnamespace . $appfolder);
        $autoloader = new Autoloader(
            $name,
            [
                $appnamespace => $appfolder,
            ]
        );
        if ($registre) $autoloader->register();
        self::$list[$name] = $autoloader;
    }

    /**
     * 
     */
    static function update(string $name = null)
    {
        if (!empty($name) && isset(self::$list[$name])) {
            $autoloader = self::$list[$name];
            $autoloader->cleanCache();
        }
    }

    /**
     * 
     */
    static function delete(string $name = null)
    {
    }
}

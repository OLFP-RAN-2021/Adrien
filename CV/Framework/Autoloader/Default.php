<?php

namespace Framework\Autoloader;

// get cache
include_once __DIR__ . '/Autoloader.php';

/**
 * Static Class to include manualy. 
 * Used to include once each class file from dedicated folder following PSR-4 standard compatible.
 * 
 * @see https://www.php-fig.org/psr/psr-4/
 *  
 */
class DefaultAutoloader
{
    function __construct(string $appnamespace, string $appfolder)
    {
        $autoloader = new Autoloader(
            sha1($appnamespace . $appfolder),
            [
                $appnamespace => $appfolder,
            ]
        );

        var_dump($autoloader);

        // load class
        $autoloader->register();

        // cleaning
        if (true === DEV)
            $autoloader->cleanCache();
    }


    static function registre()
    {
        return spl_autoload_register();
    }
}

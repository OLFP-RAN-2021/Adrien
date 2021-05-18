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
class DefaultAutoloader extends Autoloader
{
    function __construct(string $appnamespace, string $appfolder)
    {
        /**
         * Insert config app like
         *      $namespace => $folder
         */
        self::loadConfig(
            [
                $appnamespace => $appfolder,
            ]
        );

        try {
            if (true === DEV || !self::loadCache()) {
                self::register();
                self::cleanCache();
            } else {
                self::unregiste();
            }
        } catch (\Exception $e) {
            echo $e->getMessage();
            // Debbuger::add();
        }
    }
}

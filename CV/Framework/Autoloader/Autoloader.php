<?php

namespace Autoloader;

use Exception;

// get cache
include_once __DIR__ . '/Cache.php';

/**
 *  class autoloader : 
 *  
 */
class Autoloader
{
    /**
     * @use trait Cache
     */
    use Cache;

    /**
     * 
     */
    static $config;

    /**
     * Registre from array 
     * 
     * @param $array 
     *              [
     *                  ' namespace ' => ' folder/ ',
     *              ]
     */
    public static function register(array $config =  ['App\\' => 'src/']): bool
    {
        self::$config = $config;
        return spl_autoload_register([__CLASS__, 'loader']);
    }

    /**
     * loader : colled by register above. And try to load config file if exists
     * @param string classname
     * @return void
     */
    public static function loader($class): void
    {
        if (self::inCache($class)) return;
        else {
            $path = self::globalBrowser($class);
            // var_dump($path);
            // if ($path != null)
            // self::addCache($class, $path);
        }
    }

    /**
     * 
     */
    static function globalBrowser($class): string
    {
        $s = DIRECTORY_SEPARATOR;
        $classname = str_replace(['\\'], [$s], $class);

        // explode
        foreach (self::$config as $folder) {
            $path = $folder . $s . $classname . '.php';

            var_dump($path);
            if (file_exists($path)) {
                include_once $path;
                break;
            } else {
                $classname = end(explode('\\', $class));
                if (is_string($folder))
                    $path = self::recursiveBrowser($folder, $classname);
            }
        }
        return $path;
    }

    /**
     * @param string $folder
     * @param string $pattern
     */
    static function recursiveBrowser(string $folder, string $pattern): string
    {
        $path = '';
        foreach (glob($folder . '/*') as $file) {
            if (is_file($file) && strpos($file, $pattern) !== false) {
                include_once $file;
                $path = $file;
            } else if (is_dir($file)) {
                $path = self::recursiveBrowser($file, $pattern);
            } else {
                // A garder ? 
                // throw new Exception('Links not supported yet.');
            }
        }
        return $path;
    }
}

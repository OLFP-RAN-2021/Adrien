<?php

namespace Framework\Autoloader;

use Framework\Debbuger;
use LogicException;

// get cache
include_once __DIR__ . '/Cache.php';

/**
 * Static Class to include manualy. 
 * Used to include once each class file from dedicated folder following PSR-4 standard compatible.
 * 
 * 
 * @see https://www.php-fig.org/psr/psr-4/
 *  
 */
class AutoloaderOBJ
{
    static $singleton;

    static $config;

    use Cache;

    /**
     * 
     */
    static function getIstance(...$args)
    {
        if (null === self::$singleton) {
            self::$singleton = new self(...$args);
        }
        return self::$singleton;
    }

    /**
     * 
     */
    static function loader(string $class)
    {
        self::getIstance()->globalBrowser($class);
    }

    /**
     * 
     */
    static function unloader()
    {
    }


    /**
     * Load config array;
     * 
     * @param array $array 
     *      [
     *          ' namespace ' => ' folder/ ',
     *      ]
     * @return void
     */
    static function loadConfig(array $config =  ['App\\' => 'src/'])
    {
        self::$config = array_merge(include 'registre.php', $config);
    }

    /**
     * Loader : Browse files to found PSR-4 compatible PHP files.
     * 
     * @param string $class Class name sto load.
     * @return void 
     */
    static function globalBrowser(string $class)
    {
        // directory separator
        $s = DIRECTORY_SEPARATOR;

        // get namespace root
        $namespaceRoot =  explode('\\', $class)[0];

        // format : MyNamspace\folder\class
        // to : folder/class.php 
        $replace = ['\\', $namespaceRoot . $s];
        $with = [$s, ''];
        $classpath = str_replace($replace, $with, $class);

        // Get config : 
        if (array_key_exists($namespaceRoot, self::$config)) {
            $folder = self::$config[$namespaceRoot];
        } else {
            $folder = self::$config['*'];
        }

        $folder = str_replace(['\\', '/'], $s, $folder);

        $path = $folder . $s . $classpath . '.php';

        // Include path logicly PSR-4 standard  compatible.
        // And prefer namespaces matching folders.
        if (file_exists($path)) {
            include_once $path;
            self::addCache($class, $path);
        }

        // include other bullshits
        else {
            // check if wa can save some loops.
            if (file_exists($folder . $s . strtolower($namespaceRoot)))
                $folder = $folder . $s . strtolower($namespaceRoot);
            if (file_exists($folder . $s . 'src'))
                $folder = $folder . $s . 'src';

            self::recursiveBrowser($folder, $class);
        }
    }

    /**
     * Parcourir les fichiers récursivement.
     * 
     * @param string $folder
     * @param string $class
     * @return 
     */
    static function recursiveBrowser(string $folder, string $class)
    {
        $classname = end(explode('\\', $class));
        $path = '';
        foreach (glob($folder . '/*') as $file) {
            if (is_dir($file)) {
                $path = self::recursiveBrowser($file, $class);
            }
            if (is_file($file) && basename($file) == $classname . '.php') {
                if (include_once $file) {
                    self::addCache($class, $file);
                }
            }
        }
    }
}

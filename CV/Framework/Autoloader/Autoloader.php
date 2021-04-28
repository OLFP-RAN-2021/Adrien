<?php

namespace Framework\Autoloader;

// get cache
include_once __DIR__ . '/Cache.php';

/**
 *  Class autoloader.
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
     * @param array $array 
     *                  [
     *                      ' namespace ' => ' folder/ ',
     *                  ]
     * @return 
     */
    public static function register(): bool
    {
        return spl_autoload_register([__CLASS__, 'loader']);
    }

    /**
     * get a config
     */
    static function getConfig(array $config =  ['App\\' => 'src/'])
    {
        self::$config = $config;
    }

    /**
     * Loader : colled by register above. And try to load config file if exists.
     * 
     * @param string $classname Nom de la classe.
     * @return void 
     */
    public static function loader($class): void
    {
        if (!self::loadFromCache($class))
            self::globalBrowser($class);
    }

    /**
     * 
     */
    static function globalBrowser(string $class, string $s = DIRECTORY_SEPARATOR)
    {
        $classname = end(explode('\\', $class));
        $namespaceRoot =  explode('\\', $class)[0];

        // array(3) { ["Vendor"]=> string(7) "Vendor/" ["Framework"]=> string(10) "Framework/" ["App\"]=> string(16) "App/src/includes" } 
        // var_dump(self::$config);

        if (in_array($namespaceRoot, array_keys(self::$config)))
            $folder = self::$config[$namespaceRoot];
        else {
            $folder = self::$config['*'];
        }

        // escape path to working on current OS
        $folder = str_replace(['\\', '/'], $s, $folder);

        // include path logicly PSR-4 standard  compatible
        $classpath = str_replace('\\', $s, $class);
        $path = $folder . $s . $classpath . '.php';
        if (file_exists($path)) {
            include_once $path;
            self::addCache($class, $file);
        }
        // include other bullshit
        else {
            self::recursiveBrowser($folder, $class, $s);
        }
    }

    /**
     * Parcourir les fichiers récursivement.
     * 
     * @param string $folder
     * @param string $pattern
     */
    static function recursiveBrowser(string $folder, string $class, string $s = DIRECTORY_SEPARATOR)
    {
        $classname = end(explode('\\', $class));
        $path = '';
        foreach (glob($folder . '/*') as $file) {
            if (is_dir($file)) {
                $path = self::recursiveBrowser($file, $class, $s);
            }
            if (is_file($file) && basename($file) == $classname . '.php') {

                if (include_once $file) {
                    self::addCache($class, $file);
                }
            }
        }
    }
}

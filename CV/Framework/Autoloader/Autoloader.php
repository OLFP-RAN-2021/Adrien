<?php

namespace Framework\Autoloader;

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
     * Registre from array. 
     * 
     * @param void
     * @return bool
     */
    public static function register(): bool
    {
        return spl_autoload_register([__CLASS__, 'loader']);
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
     * Loader : called by register above. And try to load config file if exists.
     * 
     * @param string $classname Nom de la classe.
     * @return void 
     */
    public static function loader($class): void
    {
        if (null != DEV && true === DEV)
            self::cleanCache();
        if (!self::loadFromCache($class))
            self::globalBrowser($class);
    }

    /**
     * Browse files to found PSR-4 compatible PHP files.
     * 
     * @param string $class Class name sto load.
     * @param string $s [DIRECTORY_SEPARATOR] 
     * @return void 
     */
    static function globalBrowser(string $class, string $s = DIRECTORY_SEPARATOR)
    {
        $namespaceRoot =  explode('\\', $class)[0];
        $classpath = str_replace('\\', $s, $class);

        // array(3) { ["Vendor"]=> string(7) "Vendor/" ["Framework"]=> string(10) "Framework/" ["App\"]=> string(16) "App/src/includes" } 
        // var_dump(self::$config);

        if (array_key_exists($namespaceRoot, self::$config)) {
            $folder = self::$config[$namespaceRoot];
        } else {
            $folder = self::$config['*'];
        }

        // escape path to working on current OS
        $folder = str_replace(['\\', '/'], $s, $folder);

        // build path
        $path = $folder . $s . $classpath . '.php';

        // Include path logicly PSR-4 standard  compatible.
        // And prefer namespaces matching folders.
        if (file_exists($path)) {
            include_once $path;
            self::addCache($class, $file);
        }
        // include other bullshits
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

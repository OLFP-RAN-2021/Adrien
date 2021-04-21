<?php

/**
 * class autoloader : 
 *
 */
class Autoloader
{

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
        foreach (self::$config as $namespace => $folder) {
            if (strpos($class, $namespace, 0) !== false) {

                $s = DIRECTORY_SEPARATOR;
                $path = str_replace([$namespace, '\\'], [$folder . $s,  $s], $class) . '.php';
                if (file_exists($path)) {
                    include_once $path;
                    return;
                }
            }
        }
    }
}

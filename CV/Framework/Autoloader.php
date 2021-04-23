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
        // explode
        $path = explode('\\', $class);

        // get system directory separator
        $s = DIRECTORY_SEPARATOR;

        if (array_key_exists($path[0], self::$config)) {
            $foler = self::$config[$path[0]];
        } else {
            $foler = 'vendor/' . $path[0] . '/src/';
        }

        $dir[] = $path[0] . '/src/includes/' . str_replace('\\', $s, $class) . '.php';
        $dir[] = 'vendor/' . $path[0] . '/src/' . str_replace('\\', $s, $class) . '.php';

        foreach ($dir as $path) {
            if (file_exists($path)) {
                include_once $path;
                return;
            }
        }
    }
}

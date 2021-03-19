<?php
namespace app\autoloader;

/**
 * class autoloader
 *
 */
class Autoloader {

    static $config;

    /**
     * call spl register test
     */
    public static function register()
    {
        return spl_autoload_register(array(__CLASS__, 'loader'));
    }

    /**
     * loader : colled by register above. And try to load config file if exists
     * @param string classname
     * @return void
     */
    public static function loader($class)
    {
        /**
         * Import config
         */
        (!isset(self::$config)) ? self::$config = include_once __DIR__.'/configs/Autoloader.php' : [];
    
        foreach(self::$config['namespaces'] as $namespace => $path) {
                        
            if (strpos($class, $namespace, 0) !== false) {
            
                // var_dump($class);
                // var_dump($namespace);
                
                $classpath = str_replace($namespace, '', $class);
                $classpath = str_replace(['\\','/'], DIRECTORY_SEPARATOR, $classpath); 
                
                $filepath = $path['path'] .= $classpath.'.php';
                $basename = basename($filepath);

                // var_dump($filepath);
                // var_dump(DIRECTORY_SEPARATOR);
                
                if (isset($path['prefixes'])){
                    foreach($path['prefixes'] as $prefix){

                        if (stripos($class, $prefix)) {
                            $prefixedpath = $prefix.$basename;
                        }
                        $prefixedpath = str_replace($basename, $prefix.$basename, $filepath);
                        
                        // var_dump($prefixedpath);
                        if (file_exists($prefixedpath)){
                            include_once $prefixedpath;
                            break 2;
                        }
                    }
                }

                else if (file_exists($filepath)){
                    include_once $filepath;
                    break;
                } 
                else {
                    $error = debug_backtrace();
                    var_dump($error);
                }


            }
        }

    }
}

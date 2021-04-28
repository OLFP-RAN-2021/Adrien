<?php

namespace Framework\Autoloader;



/**
 * Trait Cache
 * 
 */
trait Cache
{


    /**
     * Cache Data MUST be stored like :
     * \NAMSPACE\ClassName::/path/to/file.php
     */
    static $CACHE = __DIR__ . '/cache/classlist.txt';
    static $separator = '::';

    /**
     * Load unique class.
     * May i'll really keep it ??? 
     * 
     * @param string $class
     * @return bool
     */
    static function loadFromCache(string $class)
    {
        if (file_exists(self::$CACHE)) {
            foreach (file(self::$CACHE) as $row) {
                $classname = explode(self::$separator, $row)[0];
                if ($classname == $class) {
                    $file = explode(self::$separator, $row)[1];
                    $file = str_replace("\n", '', $file);
                    if (include_once $file) {
                        // var_dump($file);
                        // echo '<br>';
                        // var_dump($class);
                        // echo '<br>';
                        return true;
                    }
                }
            }
        }
        return false;
    }

    /**
     * Clean empty path.
     * Use it in dev mod.
     * 
     * @param void
     * @return void
     */
    static function cleanCache(): void
    {
        $append = null;
        foreach (file(self::$CACHE) as $row) {
            $path = end(explode(self::$separator, $row));
            if (file_exists($path)) {
                file_put_contents(self::$CACHE, $row, $append);
                $append = FILE_APPEND;
            }
        }
    }

    /**
     * Load cache.
     * 
     * @param void
     * @return void
     */
    static function loadCache(): void
    {
        foreach (file(self::$CACHE) as $row)
            include_once explode(self::$separator, $row)[1];
    }

    /**
     * Add class and path to cache file.
     * 
     * @param string $classname
     * @param string $filename
     * @return bool
     */
    static function addCache(string $classname, string $filename): bool
    {
        $filename = str_replace('/', DIRECTORY_SEPARATOR, $filename);
        $string = $classname . self::$separator . $filename . "\n";
        return file_put_contents(self::$CACHE, $string, FILE_APPEND);
    }
}

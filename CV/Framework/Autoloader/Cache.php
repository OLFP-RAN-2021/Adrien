<?php

namespace Framework\Autoloader;

/**
 * Trait Cache
 * 
 * Add to Autoloader classe availability to handle a cache.
 * 
 */
trait Cache
{

    /**
     * @var $CACHE Data MUST be stored like
     * \NAMSPACE\ClassName::/path/to/file.php
     */
    static $CACHE = __DIR__ . '/cache/classlist.txt';

    /**
     * @var $separator
     */
    static $separator = '::';

    /**
     * Format data to string to store in cache file.
     * 
     * @param string $class
     * 
     * @param string $filename
     * 
     * @return string
     */
    static function format(string $class, string $filename): string
    {
        $filename = str_replace('/', DIRECTORY_SEPARATOR, $filename);
        return $class . self::$separator . $filename . "\n";
    }

    /**
     * Read a cache row.
     * 
     * @param string $row
     * 
     * @return array 
     */
    static function unformat(string $filrow): array
    {
        return explode(self::$separator, str_replace("\n", "", $filrow));
    }


    /**
     * Load unique class.
     * 
     * @param string $class
     * 
     * @return bool
     */
    static function loadFromCache(string $class): bool
    {
        $cache = self::readCache($class);
        if ('' !== $cache && include_once $cache)
            // echo 'autoloader : from cache.<br>';
            return true;
        return false;
    }

    /**
     * Check if class is registred. Return a string, empty one if not found.
     * 
     * @param string $class
     * 
     * @return string 
     */
    static function readCache(string $class): string
    {
        if (file_exists(self::$CACHE)) {
            foreach (file(self::$CACHE) as $row) {
                $p = self::unformat($row);
                if ($p[0] == $class) {
                    // var_dump($p[1]);
                    return $p[1];
                }
            }
        }
        return '';
    }

    /**
     * Clean empty path.
     * Use it in dev mod (to don't overload running)
     * 
     * @param void
     * 
     * @return void
     */
    static function cleanCache(): void
    {
        $append = null;
        if (file_exists(self::$CACHE))
            foreach (file(self::$CACHE) as $row) {
                $p = self::unformat($row);
                if (file_exists($p[1])) {
                    file_put_contents(self::$CACHE, $row, $append);
                    $append = FILE_APPEND;
                }
            }
    }

    /**
     * Load cached file.
     * 
     * @param void
     * 
     * @return void
     */
    static function loadCache(): void
    {
        if (file_exists(self::$CACHE))
            foreach (file(self::$CACHE) as $row) {
                $p = self::unformat($row);
                include_once $p[1];
            }
    }

    /**
     * Add class and path to cache file.
     * 
     * @param string $classname
     * 
     * @param string $filename
     * 
     * @return bool
     */
    static function addCache(string $classname, string $filename): bool
    {
        $string = self::format($classname, $filename);
        return file_put_contents(self::$CACHE, $string, FILE_APPEND);
    }
}

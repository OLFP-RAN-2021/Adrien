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
     * @var $file
     */
    static string $cacheFile = __DIR__ . '/cache/classlist.php';

    /**
     * @var array class $list
     */
    static array $listClass = [];

    /**
     * Add class and path to cache list.
     * 
     * @param string $classname
     * @param string $filename
     * @return bool
     */
    static function addCache(string $classname, string $filename): bool
    {
        if (file_exists($filename)) {
            self::$listClass[$classname] = $filename;
            if (self::writeCache()) {
                return true;
            }
        }
        return false;
    }

    /**
     * Clean empty path.
     * 
     * @param void
     * @return void
     */
    static function cleanCache(): bool
    {
        foreach (self::$listClass as $namespace => $path) {
            if (!file_exists($path)) {
                unset(self::$listClass[$namespace]);
            }
        }
        return self::writeCache();
    }

    /**
     * Load cached file.
     * 
     * @param void
     * @return void
     */
    static function loadCache(): void
    {
        if (self::readCache()) {
            foreach (include self::$cacheFile as $path) {
                if (file_exists($path)) {
                    // var_dump($path);
                    include_once $path;
                }
            }
        }
    }

    /**
     * Read cache from file.
     * 
     * @param void
     * @return void
     * @throw Exception If cache not found  
     */
    static function readCache(): bool
    {
        if (file_exists(self::$cacheFile)) {
            self::$listClass = include self::$cacheFile;
            return true;
        } else {
            throw new \Exception('Autoloader has no cache file.');
            return false;
        }
    }

    /**
     * Ecrire le fichier cache.
     * 
     * @param void
     * @return bool
     */
    static function writeCache(): bool
    {
        $str = "<?php\nreturn [\n";
        foreach (self::$listClass as $key => $value) {
            $str .= "\t '" . $key . "' => '" . $value . "',\n";
        }
        $str .= "\n];";
        return (bool) file_put_contents(self::$cacheFile, $str);
    }
}

<?php

namespace Framework\Autoloader;

/**
 * Trait Cache
 * 
 * Add to Autoloader classe availability to handle a cache.
 * 
 */
class Cache
{

    /**
     * @var $file
     */
    private string $cacheFile = __DIR__ . '/cache/classlist.php';

    /**
     * @var array class list
     *      'namspace' => 'file';
     */
    private array $listClass = [];

    /**
     * @var array class map 
     *      'namespace' => [ 'classename', ... ]
     */
    private array $classMap = [];

    /**
     * @var array class map 
     *      'namespace' => [ 'classename', ... ]
     */
    // private array $devMap = [];

    /**
     * 
     */
    function __construct(string $name)
    {
        $this->cacheFile = __DIR__ . '/cache/' . $name . '.php';;
    }

    /**
     * Add class and path to cache list.
     * 
     * @param string $classname
     * @param string $filename
     */
    function addCache(string $classname, string $filename): void
    {
        if (file_exists($filename)) {
            $this->listClass[$classname] = $filename;
            $parts = explode('\\', $classname);
            $classname = array_pop($parts);
            $namespace = implode('\\', $parts);
            $this->classMap[$namespace][] = $classname;
            $this->writeCache();
        }
    }

    /**
     * 
     */
    function isRegistred(string $class): bool
    {
        return isset($this->listClass[$class]);
    }

    /**
     * 
     */
    function loadClassFile(string $class): void
    {
        if (file_exists($this->listClass[$class]))
            include_once $this->listClass[$class];
    }

    /**
     * Clean empty path.
     * 
     * @param void
     * @return void
     */
    function cleanCache(): void
    {
        foreach ($this->listClass as $namespace => $path) {
            if (!file_exists($path)) {
                unset($this->listClass[$namespace]);
            }
        }
        $this->writeCache();
    }

    /**
     * Load cached files from list.
     * 
     * @param void
     * @return void
     */
    function loadCache(): void
    {
        foreach ($this->cacheFile['classList'] as $path) {
            include_once $path;
        }
    }

    /**
     * Get map
     */
    // function getMap(?string $key = null)
    // {
    //     if (null != $key && array_key_exists($key, $this->classMap))
    //         return $this->classMap[$key];
    //     else
    //         return $this->classMap;
    // }

    /**
     * Read cache from file.
     * 
     * @param void
     * @return void
     * @throw Exception If cache not found  
     */
    function readCache(): void
    {
        if (file_exists($this->cacheFile)) {
            $cache = include $this->cacheFile;
            $this->listClass = $cache['classList'];
            $this->classMap = $cache['classMap'];
        }
    }

    /**
     * Write the cache file.
     * 
     */
    function writeCache(): void
    {
        $date = date('H:i:s @ m/d/Y');
        $str = <<<TXT
        <?php
            // cache auto built
            // refreshed the $date. 
        TXT;

        $str .= self::format([
            'infos' => [
                'version' => 0,
                'date' => $date,
            ],
            'classList' => $this->listClass,
            'classMap' => $this->classMap
        ]);

        file_put_contents($this->cacheFile, $str);
    }

    /**
     * 
     */
    private static function format(array $array, int $lvl = 0): string
    {
        $t = str_repeat("\t", $lvl);
        $str = (0 === $lvl) ? "\nreturn [\n" : " [";
        foreach ($array as $key => $value) {
            if (is_array($value)) {
                $str .=  "\n$t'" . $key . "' => " . self::format($value, $lvl + 1);
            } else {
                if (!is_int($key))
                    $str .= "\n$t'" . $key . "' => '" . $value . "',";
                else
                    $str .= "\n$t'" . $value . "', ";
            }
        }
        $str .= (0 === $lvl) ? $t . "\n];" : "\n$t],";

        return $str;
    }
}

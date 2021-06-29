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

    private array $infos = [
        'version' => 1,
        'classes' => 0,
        'date' => null
    ];

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
    private array $devMap = [];

    /**
     * 
     */
    function __construct(string $name, private array &$config)
    {
        $this->cacheFile = __DIR__ . '/cache/' . $name . '.php';
        $this->readCache();
    }

    /**
     * Add class and path to cache list.
     * 
     * @param string $classname
     * @param string $filename
     */
    function addCache(string $classname, string $filename, bool $devonly = false): void
    {
        if (file_exists($filename)) {
            $this->listClass[$classname] = $filename;
            $parts = explode('\\', $classname);
            $classname = array_pop($parts);
            $namespace = implode('\\', $parts);
            if (
                !isset($this->classMap[$namespace])
                or !in_array($classname, $this->classMap[$namespace])
            ) {
                $this->classMap[$namespace][] = $classname;
            }
            if ($devonly) {
                $this->devMap[] = $classname;
            }
            $this->infos['classes']++;
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
     * Load class file if exists
     */
    function loadClassFile(string $class): void
    {
        if (isset($this->listClass[$class]))
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
                $this->infos['classes']--;
            }
        }
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
     * Return mapped classes.
     * 
     * @param null|string $key namespace to scan. Keep empty to get all.
     * @return array
     */
    function getMap(?string $key = null): array
    {
        if (null == $key)
            return $this->classMap;
        else if (in_array($key, $this->classMap))
            return $this->classMap[$key];
    }

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
            foreach (include $this->cacheFile as $key => $value) {
                $this->$key = $value;
            }
        }
    }

    /**
     * Write the cache file.
     * 
     */
    function writeCache(): void
    {
        // $this->infos['version']++;
        $this->infos['date'] = date('H:i:s @ m/d/Y');
        $str = self::format(get_object_vars($this));
        file_put_contents($this->cacheFile, $str);
    }

    /**
     * 
     */
    private static function format(array $array, int $lvl = 1): string
    {
        $t = str_repeat("\t", $lvl);
        $str = (1 === $lvl) ? "<?php return [" : " [";
        foreach ($array as $key => $value) {
            // escape anti-slashes
            $key = (is_string($key)) ? str_replace(['\\'], '\\\\', $key) : $key;
            if (is_array($value)) {
                $str .=  "\n$t'" . $key . "' => " . self::format($value, $lvl + 1);
            } else {
                $value = (is_string($value)) ? str_replace(['\\'], '\\\\', $value) : $value;
                if (!is_int($key))
                    $str .= "\n$t'" . $key . "' => '" . $value . "',";
                else
                    $str .= "\n$t'" . $value . "', ";
            }
        }
        $str .= (1 === $lvl) ? "\n];\n" : "\n$t],";
        return $str;
    }
}

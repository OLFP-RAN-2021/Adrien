<?php

namespace Framework\Autoloader;

// get cache
include_once __DIR__ . '/Cache.php';
include_once __DIR__ . '/FileBrowser.php';
include_once __DIR__ . '/ClassScanner.php';

/**
 * Static Class to include manualy. 
 * Used to include once each class file from dedicated folder following PSR-4 standard compatible.
 * 
 * 
 * @see https://www.php-fig.org/psr/psr-4/
 *  
 */
class Autoloader extends Cache
{
    private string $name = 'default';
    private array $config =  [
        '*' => 'Vendor',
        'Framework' => 'Framework'
    ];

    /**
     * 
     */
    function __construct(
        string $name = 'default',
        array $config =  ['App\\' => 'src/']
    ) {
        $this->name = $name;
        $this->config = array_merge($this->config, $config);
        parent::__construct($name, $this->config);
    }

    /**
     * Registre from array. 
     * 
     * @param void
     * @return
     */
    public function register()
    {
        return spl_autoload_register(function ($class) {
            $this->loader($class);
        });
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
    function loadConfig(array $array)
    {
        $this->config = array_merge($array, $this->config);
    }

    /**
     * Parse automaticly all class/trait/interface in all namespaces.
     * 
     * 
     */
    function scanner(): void
    {
        foreach ($this->config as $namespace => $folder) {
            if (file_exists($folder . '/composer.json')) {
                // if DEV classes & similar stuffs
            }
            $scanner = new ClassScanner();
            foreach ($scanner->scanRecursive($folder) as $classname => $file) {
                $this->addCache($classname, $file);
            }
            $this->writeCache();
        }
    }

    /**
     * Loader : Browse files to found PSR-4 compatible PHP files.
     * 
     * @param string $class Class name sto load.
     * @return void 
     */
    function loader(string $class)
    {
        if ($this->isRegistred($class)) {
            $this->loadClassFile($class);
            return;
        }
        foreach ($this->config as $namespace => $folder)
            if (strpos($class, $namespace, 0) === 0) {
                $browser = new FileBrowser($folder);
                if (null !== ($file = $browser->search($class))) {
                    $this->addCache($class, $file);
                    $this->writeCache();
                    include_once $file;
                }
            }
    }
}

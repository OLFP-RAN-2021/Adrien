<?php

namespace Framework\Autoloader;

// get cache
include_once __DIR__ . '/Cache.php';
include_once __DIR__ . '/FileBrowser.php';

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

    /**
     * 
     */
    function __construct(
        string $autoloaderName = 'default',
        private array $config =  ['App\\' => 'src/']
    ) {
        parent::__construct($autoloaderName);
    }

    /**
     * Registre from array. 
     * 
     * @param void
     * @return
     */
    public function register()
    {
        return spl_autoload_register([__CLASS__, 'loader']);
    }

    /**
     * Unregistre 
     * 
     * @param void
     * @return
     */
    public function unregiste()
    {
        return spl_autoload_unregister([__CLASS__, 'loader']);
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
    function loadConfig()
    {
        $this->config = array_merge(include 'registre.php', $config);
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
        } else {
            foreach ($this->config as $namespace => $folder) {
                $browser = new FileBrowser($namespace, $folder);
                if (($file = $browser->search($class))) {
                    $this->addCache($class, $file);
                    $this->writeCache();
                }
            }
        }
    }
}

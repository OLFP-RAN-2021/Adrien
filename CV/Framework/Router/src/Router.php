<?php

namespace Router;


/**
 * Like Wordpress : formating locales urls
 */
function home(string $url = null)
{
    return RELPATH . '/' . $url;
}

/**
 * 
 */
class Router
{

    public $callStack = [];
    public $urlStack;

    /**
     * 
     */
    function __construct()
    {
        $this->urlStack = explode('/', $_SERVER['PATH_INFO']);
        array_shift($this->urlStack);

        // define('PARENT', function () {
        //     return dirname(__DIR__);
        // });
        define('ABSPATH', getcwd());
        define('RELPATH', str_replace($_SERVER['DOCUMENT_ROOT'], '', ABSPATH));
    }


    /**
     * Associer une callable à une objet URL
     */
    function bindCall(int $lvl = null, callable $callable = null)
    {
        if ($lvl > 0)
            $this->callStack[$lvl][] = $callable;
        else if ($lvl == 0)
            $this->callStack[$lvl] = $callable;
        else
            throw "Error : Router can't handle a negative urls.";
    }

    /**
     * 
     */
    function route()
    {
        if (!empty($this->urlStack)) {
            $i = 1;
            $herited = null;
            foreach ($this->urlStack as $pathElem) {
                if (isset($this->callStack[$i]))
                    foreach ($this->callStack[$i] as $callable) {
                        array_unshift($this->urlStack);
                        $herited = $callable((array)$this->urlStack, (string)$pathElem, $herited);
                    }

                // iter
                $i++;
            }
        } else {
            $this->callStack[0]();
        }
    }

    /**
     * @static default() : Execute router as default;
     * 
     * @param array : use an other callback
     * @return void
     */
    static function default(array $config = null)
    {
        $router = new self;

        // get config
        $config = $config ?? include dirname(__DIR__) . '/config/Config.php';
        foreach ($config as $callable)
            $router->bindCall(
                $callable['lvl'],
                $callable['call']
            );

        $router->route();
    }
}

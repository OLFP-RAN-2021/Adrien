<?php

namespace Framework\Router;

use LogicException;
use ReflectionClass;

/**
 * Router is required to rooting user on app.
 * 
 * - Must work as singleton (cause only one instance is required to routing). 
 * - Can load a default routing isntead of App routing.
 * 
 */
class Router
{

    /**
     * @var static $singleton Instance of Router.
     */
    static $singleton = null;

    /**
     * Return unique instance of Router.
     * 
     * @param ...$args : see __construct()
     * @return self
     */
    static function getInstance(...$args): self
    {
        if (null === self::$singleton) {
            self::$singleton = new self(...$args);
        }
        return self::$singleton;
    }

    /**
     * @var array $callStack Stack of callalbe.
     */
    private $callStack = [];

    /**
     * @var object 
     */
    private $behaviour;


    /**
     * Build a Router.
     * 
     * Import behaviour
     * 
     * Execute routing
     *  
     * @param void
     */
    private function __construct()
    {
    }

    /**
     * 
     * 
     * @param string|null 
     */
    function import(?string $fileToGet)
    {
        if (null != $fileToGet && file_exists($fileToGet)) {

            $class = include $fileToGet;
            if (null !== ($reflection = new ReflectionClass($class))) {
                if (false !== ($parent = $reflection->getParentClass())) {

                    if ('Framework\Router\RouterCallable' == $parent->name) {
                        $this->behaviour = $class;
                    };
                } else {
                    throw new LogicException("The behavior class require to extends \Framework\Router\RouterCallable");
                }
            } else {
                throw new LogicException("Router require a behavior class.");
            }
        } else {
            throw new LogicException("Router require a a valid file.");
        }
    }

    /**
     * Binding callalble.
     * 
     * @param int $lvl : 0 = default, 1, 2, 3... 
     * @param callable $callable 
     */
    function bindCall(int $lvl, string $key, callable $callable, ?array $args)
    {
        if ($lvl >= 0) {
            ('default' === $key)  ? $key = -1 : null;
            $this->callStack[$lvl][$key] = [$callable, $args];
            return end(array_keys($this->callStack[$lvl]));
        } else {
            throw new \Exception("Error : Router can't handle a negative urls.");
        }
    }

    /**
     * Start routing.
     * 
     * @param void
     * @return void
     */
    function route()
    {
        $url = new Url(PATHINFO);
        // var_dump($url);

        foreach ($url as $key => $elemt) {
            $herited = null;

            var_dump($url);
            // var_dump($key);

            foreach ($this->callStack[$key] as $tagname => $registredCallable) {
                $callable = $registredCallable[0];
                $args = $registredCallable[1];
                $herited =  $callable($url, $herited, ...$args);
            }
        }

        // if (!empty($urlStack)) {
        //     $i = 0;
        //     $herited = null;
        //     foreach ($url as $pathElem) {

        //         if (isset($this->callStack[$i])) {
        //             foreach ($this->callStack[$i] as $registredCallable) {

        //                 $callable = $registredCallable[0];
        //                 $args = $registredCallable[1];

        //                 array_unshift($urlStack);
        //                 $herited =  $callable($urlStack, $pathElem, $herited, ...$args);
        //             }
        //             $i++;
        //         }
        //     }
        // } else {
        //     $callable = $this->callStack[0][0];
        //     $args = $this->callStack[0][1];
        //     $callable($urlStack, null, null, ...$args);
        // }
    }
}

<?php

namespace Framework\Router;

use Exception;
use Framework\Exception as FrameworkException;
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
     * Import behavior class from a file.
     * 
     * @param string|null 
     * @throw 
     */
    function import(?string $fileToGet): void
    {
        if (null != $fileToGet && file_exists($fileToGet)) {
            include_once $fileToGet;;
        } else {
            throw new FrameworkException([
                "message" => "Router require a valid behavior file.",
                "code" => 400,
                "description" => "Router require a valid behavior file. See Framework/Router/readme.md to know more."
            ]);
        }
    }

    /**
     * Binding callalble.
     * 
     * @param int $lvl : 0 = default, 1, 2, 3... 
     * @param callable $callable 
     */
    function bindCall(int $lvl, string $key, array $callable, ?array $args): string|null
    {
        if ($lvl >= 0) {
            ('default' === $key)  ? $key = -1 : null;
            $this->callStack[$lvl][$key] = [$callable, $args];
            $keys = array_keys($this->callStack[$lvl]);
            return end($keys);
        } else {
            throw new FrameworkException([
                "message" => " Router can't handle a negative urls.",
                "code" => 400,
                "description" => " Router can't handle a negative urls."
            ]);
        }
    }

    /**
     * Start routing.
     * 
     * @param Url 
     * @return void
     */
    function route(&$url = null, &$hineritence = null): void
    {
        if (null === $url) {
            $url = new Url(PATHINFO);
        }
        foreach ($this->callStack[$url->key()] as $registredCallable) {

            $callable = $registredCallable[0][0];
            $callable = new $callable();
            $method = $registredCallable[0][1];
            $args = $registredCallable[1];

            $hineritence =  $callable->$method($url, $hineritence, ...$args);
            if (null != $hineritence) {
                break;
            }
        }

        if (null != $hineritence) {
            $url->next();
            $this->route($url, $hineritence);
        }
    }
}

<?php

/**
 *  Default router Behaviours.
 *  Copy this model to build your !    
 * 
 */
return new class extends \Framework\Router\RouterCallable
{
    function __construct()
    {
        $this->bind(0, 'default', [self::class, 'routeObjController'], []);
        $this->bind(0, 'switcher', [self::class, 'switcher'], []);
        $this->bind(1, 'routeObjMethode',  [self::class, 'routeObjMethode'], []);
        // $this->bind(1,);
        // $this->bind(2,);
        // $this->bind(3,);
    }

    /**
     * Switcher : if 
     */
    function switcher(Framework\Router\Url $url, $inheritence = null, ...$args)
    {
        // at root
        if ("/" == $url->current()) {
            $class = APP['router']['default']['call'];
            if (class_exists($class, true)) {
                return new $class($url, ...APP['router']['default']['args']);
            }
        }
        // is page
        else if (stripos($url->current(), '.html', -5)) {
            $class = APP['router']['default']['call'];
            if (class_exists($class, true)) {
                return new $class($url, ...APP['router']['default']['args']);
            }
        }
        // wtf ? 
        else {
        }
    }

    // "router" => [
    //     "controllers" => "App\\controllers\\",
    //     "default" => [
    //         "call" => "App\\controllers\\Page",
    //         "args" => ["home.html"]
    //     ],
    //     "behaviur" => ""
    // ],

    /**
     * Try to instance object if class exists.
     * 
     * @param Framework\Router\Url $url 
     * @param mixed $inheritence
     * @param ...$args additionnal arguments for constructor
     * @return object|null
     */
    function routeObjController(Framework\Router\Url $url, $inheritence = null, ...$args)
    {
        // var_dump($url->current());
        $class =  APP['router']['controllers'] . $url->current();
        if (
            class_exists($class, true) &&
            ($reflection = new \ReflectionClass($class)) !== null &&
            $reflection->isInstantiable()
        ) {
            return $reflection->newInstance($url, ...$args);
        } else {
            return null;
        }
    }

    /**
     * Apply method on herites object.
     * 
     * @param Framework\Router\Url $url 
     * @param object $inheritence
     * @param ...$args additionnal arguments for constructor
     * @return mixed|null
     */
    function routeObjMethode(Framework\Router\Url $url, object $inheritence, ...$args)
    {
        $methodName = $url->current();
        if (method_exists($inheritence, $methodName)) {
            return $inheritence->$methodName($url, ...$args);
        } else {
            return null;
        }
    }
};

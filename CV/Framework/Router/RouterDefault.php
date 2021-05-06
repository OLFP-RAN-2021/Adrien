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
        $this->bind(1, 'routeObjMethode',  [self::class, 'routeObjMethode'], []);
        // $this->bind(1,);
        // $this->bind(2,);
        // $this->bind(3,);
    }


    /**
     * @param array $url 
     * @param string $pathElem
     * @param mixed $inheritence
     * @param ...$args arguments for constructor
     * @return object
     */
    function routeObjController(Framework\Router\Url $url, $inheritence = null, ...$args)
    {
        $class =  APP['router']['controllers'] . $url->current();
        if (
            class_exists($class, true) &&
            ($class = new \ReflectionClass($class)) !== null &&
            $class->isInstantiable()
        ) {
            return new $class->newInstance($url, ...$args);
        }
    }

    /**
     * 
     */
    function routeObjMethode(Framework\Router\Url $url, object $inheritence, ...$args)
    {
        $methodName = $url->current();
        if (is_object($inheritence) && method_exists($inheritence, $methodName)) {
            return $inheritence->$methodName($url, ...$args);
        }
    }
};

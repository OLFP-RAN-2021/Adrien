<?php

namespace Framework\Router;

trait RouterDefault
{

    /**
     * 
     */
    function routeObj($url, $pathElem, $herited)
    {
        $class =  APP['router']['controllers'] . $pathElem;
        if (
            class_exists($class, true) &&
            ($class = new \ReflectionClass($class)) !== null &&
            $class->isInstantiable()
        ) {
            return new $class->isInstantiable();
        }
    }

    function routeMethode($url, $pathElem, $herited)
    {
    }
}

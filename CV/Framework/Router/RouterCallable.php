<?php

namespace Framework\Router;

/**
 * This class give bind methods to bind 
 */
abstract class RouterCallable
{


    /**
     * Function to add behavior to Router.
     * 
     * @param int 
     * @param string 
     * @param callable 
     * @param array
     * @return void 
     */
    final function bind(int $lvl, string $key, array $callable, array $args = []): void
    {
        Router::getInstance()->bindCall($lvl, $key, $callable, $args);
    }
}

<?php

namespace Framework\Databases;

use ReflectionClass;

trait QueryFactory
{
    // string las cmd given
    private $lastCmd;

    // Array stack
    private array $stack = [];

    /**
     * Build or return factorised SQL query elements.
     * 
     */
    function factory(string $name, ...$args)
    {
        if (!isset($this->stack[$name])) {
            $classname = __NAMESPACE__ . '\SQLFluentsQueries\\' . $name;
            if (class_exists($classname, true)) {
                $reflection = new ReflectionClass($classname);
                if ($reflection->isInstantiable()) {
                    $this->stack[$name] = $reflection->newInstance($this);
                }
            }
        }
        $this->lastCmd = $name;
        $this->stack[$name]->callback(...$args);
        return $this;
    }

    /**
     * 
     */
    function __get(string $name)
    {
        if (isset($this->stack[$name]))
            return $this->stack[$name];
    }


    /**
     * At query executing : execute query elements.
     * 
     */
    function runStack()
    {
        foreach ($this->stack as $stack) {
            if (isset($stack->request))
                $this->request .= $stack->request;
            if (isset($stack->data))
                $this->data = array_merge($this->data, (array)$stack->data);
        }

        return $this;
    }
}

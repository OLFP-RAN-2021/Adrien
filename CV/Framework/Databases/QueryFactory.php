<?php

namespace Framework\Databases;

use ReflectionClass;

trait QueryFactory
{
    // string las cmd given

    // Array stack
    private array $stack = [];

    /**
     * Build or return factorised SQL query elements.
     * 
     */
    private function factory(string $name, ...$args)
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
        if (!$this->stack[$name]->callonce or 0 == $this->stack[$name]->called) {
            $this->stack[$name]->callback(...$args);
        }
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
            $array = $stack->return();
            $this->request .= (string) $array[0];
            $this->data = array_merge($this->data, (array)$array[1]);
        }
        return $this;
    }
}

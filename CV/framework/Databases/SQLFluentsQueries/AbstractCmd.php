<?php

namespace Framework\Databases\SQLFluentsQueries;

abstract class AbstractCmd
{
    public array $args = [];
    public string $request = '';
    public array $data = [];

    /**
     * 
     */
    abstract function callback();
    // abstract function solve();

    /**
     * 
     * @return array 
     *  [
     *      string  $request
     *      array   $data
     *  ]
     */
    function return(): array
    {
        if (method_exists($this, 'solve')) {
            call_user_func([$this, 'solve']);
        }
        return [$this->request, $this->data];
    }

    /**
     * 
     */
    function esc_var_list(string $string): string
    {
        return preg_replace('#[^\w ,*]#i', '', $string);
    }

    /**
     * 
     */
    function esc_var(string $string): string
    {
        return preg_replace('#[^\w]#i', '', $string);
    }
}

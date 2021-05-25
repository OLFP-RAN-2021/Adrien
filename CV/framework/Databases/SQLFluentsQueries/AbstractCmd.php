<?php

namespace Framework\Databases\SQLFluentsQueries;

use Framework\Databases\Query;

abstract class AbstractCmd
{
    public array $args = [];
    public string $request = '';
    public array $data = [];
    public bool $callonce = false;
    public int $called = 0;

    /**
     * 
     */
    function constuct()
    {
    }

    /**
     * Callback can be called any time.
     */
    abstract function callback(): void;

    /**
     * solve will be called at end.
     * Just before merge request & data in main request.
     */
    abstract function solve(): void;

    /**
     * 
     * @return array 
     *  [
     *      string  $request
     *      array   $data
     *  ]
     */
    final function return(): array
    {
        call_user_func([$this, 'solve']);
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

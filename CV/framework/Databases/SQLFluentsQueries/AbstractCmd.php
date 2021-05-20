<?php

namespace Framework\Databases\SQLFluentsQueries;

abstract class AbstractCmd
{
    static int $count = 0;
    public array $args = [];
    public string $request = '';
    public array $data = [];

    function constuct()
    {
        $this->name = 'CMD#' . ++self::$count;
    }

    /**
     * 
     */
    function merge(array $data = [])
    {
        $keys = [];
        foreach ($data as $key => $value) {
            $nkey = $this->name . ':' . $key;
            $this->data[$nkey] = $value;
            $keys[] = $nkey;
        }
        return $keys;
    }

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

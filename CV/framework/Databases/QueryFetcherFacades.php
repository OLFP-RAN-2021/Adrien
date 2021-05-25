<?php

namespace Framework\Databases;

trait QueryFetcherFacades
{

    /**
     * 
     */
    function fetchClass(string $class)
    {
    }

    /**
     * 
     */
    function fetchObj(object $obj)
    {
    }

    /**
     * 
     */
    function fetch(...$fetchMethod)
    {
        return $this->fetcher(false, null,  ...$fetchMethod);
    }

    /**
     * 
     */
    function fetchAll(...$fetchMethod)
    {
        return $this->fetcher(true, null,  ...$fetchMethod);
    }

    /**
     * 
     */
    function fetchCall(callable $callback, ...$fetchMethod)
    {
        return $this->fetcher(false, $callback,  ...$fetchMethod);
    }

    /**
     * 
     */
    function fetchAllCall(callable $callback, ...$fetchMethod)
    {
        return $this->fetcher(true, $callback,  ...$fetchMethod);
    }
}

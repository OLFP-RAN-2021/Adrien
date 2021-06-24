<?php

namespace Framework\Databases;

use PDO;

trait QueryFetcherFacades
{

    /**
     * 
     */
    function fetchClass(string $classname)
    {
        return $this->fetcher(false, null, PDO::FETCH_CLASS, $classname);
    }

    /**
     * 
     */
    function fetchObj()
    {
        return $this->fetcher(false, null, PDO::FETCH_OBJ);
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

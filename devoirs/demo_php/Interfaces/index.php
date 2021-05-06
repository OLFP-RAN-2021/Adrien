<?php

/**
 * 
 */
class compagny
{
    function makeBalais(employes $worker): array
    {
        $reciepes = [];
        return $worker->work($reciepes);
    }
}

/**
 * 
 */
interface employes
{
    function work(array $stuff): array;
}

/**
 * 
 */
class worker implements employes
{
    function work(array $stuff): array
    {
        return $stuff;
    }
}

/**
 * 
 */
class tourist
{
    function work(array $stuff): array
    {
        return $stuff;
    }
}



$co = new compagny();
$co->makeBalais(new worker());

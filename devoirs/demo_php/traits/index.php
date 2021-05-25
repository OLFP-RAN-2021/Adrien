<?php

// trait focal implements interfacetrait : Marche pas !

trait focal
{
    private $focale;

    function getFocale()
    {
        return $this->focale;
    }
}

trait lentille
{
    // $this->getFocale(); Marche pas ! 
}

class objectif_photo
{
    use focal, lentille;
}

class objectif_video
{
    use focal;
}

trait meta
{
    private array $array = [];
}

trait Options
{
    use meta;

    private function graisselaporte()
    {
        echo "graisee\n";
    }
}

class A
{
    use Options {
        // pas beau mais faisable
        graisselaporte as public david;
    }

    function getArray()
    {
        return $this->array;
    }
}

class B extends A
{
}

$b = new B();
$b->david();
var_dump($b);

<?php

trait meta
{
    public $array;
}

trait meta2
{
    use meta;
}

trait options
{
    private function afficher()
    {
        var_dump($this);
    }
}

class B
{
    use options {
        afficher as public;
    }
}

$b = new B();
$b->afficher();

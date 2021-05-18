<?php

namespace Framework\Databases\SQLFluentsQueries;

class AbstractCmd
{



    public array $args = [];

    function esc_var_list(string $string): string
    {
        return preg_replace('#[^\w ,*]#i', '', $string);
    }

    function esc_var(string $string): string
    {
        return preg_replace('#[^\w]#i', '', $string);
    }
}

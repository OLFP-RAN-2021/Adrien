<?php

namespace Framework\Autoloader;


/**
 * function to serialize php array.
 * 
 */
function format(array $array, int $lvl = 1): string
{
    $t = str_repeat("\t", $lvl);
    $str = (1 === $lvl) ? "<?php return [" : " [";
    foreach ($array as $key => $value) {
        // escape anti-slashes
        $key = (is_string($key)) ? str_replace(['\\'], '\\\\', $key) : $key;
        if (is_array($value)) {
            $str .=  "\n$t'" . $key . "' => " . format($value, $lvl + 1);
        } else {
            $value = (is_string($value)) ? str_replace(['\\'], '\\\\', $value) : $value;
            if (!is_int($key))
                $str .= "\n$t'" . $key . "' => '" . $value . "',";
            else
                $str .= "\n$t'" . $value . "', ";
        }
    }
    $str .= (1 === $lvl) ? "\n];\n" : "\n$t],";
    return $str;
}

<?php

namespace Framework\Config;

/**
 * 
 */
class Config
{
    /**
     * Auto include file.
     * 
     */
    function __construct(
        string $path = 'Framework/Config/storage/%s/default.php'
    ) {
        if (strpos($path, '/%s/') !== false) {
            $subPath = str_replace('\\', '/', get_called_class());
            $path = sprintf($path, $subPath);
        }

        if (!file_exists(dirname($path))) mkdir($path, 0733, true);
        if (file_exists($path)) {
            $this->path = $path;
            foreach (include $path as $key => $value)
                $this->$key = $value;
        }
    }

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
                $str .=  "\n$t'" . $key . "' => " . $this->format($value, $lvl + 1);
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

    /**
     * Save data.
     */
    function save()
    {
        $data = $this->format(get_object_vars($this));
        file_put_contents($this->path, $data);
    }

    function __destruct()
    {
    }
}

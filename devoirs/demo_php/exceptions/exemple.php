<?php

/**
 * Créer une exception personalisée.
 */
class MathException extends LogicException
{

    /**
     * Sert à serializer l'objet à la volée.
     * 
     * @param void
     * @return string
     */
    function __toString(): string
    {
        $error = end($this->getTrace());

        $string = $this->getCode() . ' : ' . $this->getMessage() . ' ';
        return $string . ' on file  <b>' . $error['file'] . '</b> on line <b>' . $error['line'] . "</b>.<br>\n";
    }
}


/**
 * Ma petite librairie de méthodes mathématiques.
 */
class Math
{
    /**
     * Diviser une valeur.
     * 
     * @param int|float $a
     * @param int|float $b
     * @return float
     */
    function divide($a, $b): float
    {
        if (0 == $b) {
            throw new MathException("Je ne peux pas diviser par 0.", 1);
            return null;
        } else {
            return $a / $b;
        }
    }
}

/**
 * Diviser une valeur.
 * 
 * @param int|float $a
 * @param int|float $b
 * @return float
 */
function diviser($a, $b): float
{
    $math = new Math;
    return $math->divide($a, $b);
}

/**
 * Exemple : je tente de diviser par 0.
 * J'attrape les erreurs avec catch(Exception $error) 
 */
try {
    echo diviser(4, 0) . "\n";
} catch (Exception $error) {
    echo $error;
}

echo "\n";

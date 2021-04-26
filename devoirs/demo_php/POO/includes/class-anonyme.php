<?php

/**
 * La classe anonyme se déclare dans une variable.
 * Elle conserve les propriétés d'une class normale,
 * à ceci près que la class n'est accessible que par
 * la variable dans laquelle on l'a déclaré.
 *
 * Elle s'instencie comme une fonction "closure".
 *
 * @see https://www.php.net/manual/fr/language.oop5.anonymous.php;
 */
$CartoucheEncre = new class
{
    // private :
    private int $quantite = 100;

    private string $color;

    public function __construct(string $color = 'red')
    {
        $this->color = $color;
    }

    public function getColor(): string
    {
        return $this->color;
    }

    /**
     * Finale signifie que la méthode ne sera pas modifialble
     * par les enfants.
     */
    final public function couler(): bool
    {
        if ($this->quantite > 0) {
            --$this->quantite;

            return true;
        }

        return false;
    }
};
// Elle s'instencie comme une fonction "closure".
// $obj = new $CartoucheEncre('red');
// var_dump($obj);
// var_dump(get_class($obj));

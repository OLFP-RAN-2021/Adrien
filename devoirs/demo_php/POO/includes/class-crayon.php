<?php

/**
 * Crayon objet generique simple.
 *  Il étend un crayon "abstrait".
 *  Il implémente une intreface "écrire".
 *  Il utilise le trait "trouer".
 */
class crayon extends abstractCrayon implements ecrire
{
    /*
     * @use Importer le trait trouer.
     * Ce qui permet au crayon de trouer les feuilles...
     */
    use trouer;

    /**
     * @var string contient la couleur du crayon
     */
    private string $color;

    /**
     * @static Compter le nombre de crayon (tout genre confodus)
     * NB : la proprétié static appartient à la CLASS (pas des instances)
     */
    public static int $nbrDeCrayon = 0;

    /**
     * constructeur de crayon.
     */
    public function __construct()
    {
        // je compte un crayon de plus
        ++self::$nbrDeCrayon;
    }

    /**
     * function dessiner
     * ecrase la fonction abstraite.
     */
    public function dessiner($param): void
    {
        // ...
    }
}

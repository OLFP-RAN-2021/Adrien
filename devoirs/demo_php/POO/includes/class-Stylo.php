<?php

/**
 * Le stylo est une forme de crayon.
 * Il hérite donc de certaines propriétées et méthodes du crayon.
 */
class stylo extends crayon
{
    /**
     * @var object cartouche d'encre
     */
    private $encre;

    /**
     * @static objet unique instencié depuis la classe courante et stocké par mla classe
     */
    static $singleton = null;

    /**
     * Constructeur du stylo.
     *
     * @param string color
     */
    public function __construct(object $cartouche)
    {
        // j'initialise le parent
        // parent:: est un 'appel static'
        // Je change la couleur par dfault du crayon par celle du stylo
        parent::__construct();

        $this->encre = $cartouche;
    }

    /**
     * Instancie l'objet de la class et le stock dans ma variable singleton.
     *
     * @param mixed : Paramètres du constructeur de classe
     *
     * @return \stylo : Retourne le singleton : un instance de style.
     *
     * C'est quoi ...$param ?
     * Pour des raisons pratique : j'utilise un spread operator !
     * Il sert à représenter un tableau de paramètres.
     *
     * @see : https://www.php.net/manual/fr/migration56.new-features.php
     */
    static function getSingleton(...$params): self
    {
        if (null == self::$singleton) {
            self::$singleton = new self(...$params);
        }

        return self::$singleton;
    }

    /**
     * Methode pour ecrire en parcourant les caractères.
     * Mon stylo perds 1 encre par charactère écris.
     *
     * @param string $mssg : text to print
     *
     * @return void
     */
    final public function rediger(string $mssg): self
    {
        $ecrire = '';

        //parcourir chaque caractères
        foreach (str_split($mssg) as $caracter) {
            // si il me reste de l'encre
            if ($this->encre->couler()) {
                // ajouter à la chaine de
                $ecrire .= $caracter;
            }
        }

        // j'écris le message
        $mssg = '<span style="color:' . $this->encre->getColor() . ';">' . $ecrire . '</span><br>';
        parent::ecrire($mssg);

        // pour ecrire plusieur fois avec le même stylo
        return $this;
    }
}

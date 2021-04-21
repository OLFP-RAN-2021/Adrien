<?php
namespace App;

class Page
{
    use SaveAsFile;

    public static $list = [];
    public $current = null;

    public function __construct($filename = null)
    {
        if ($filename != null && self::exists($filename))
        self::$list[$filename] = self::load($filename);
    }

    /**
     * Create a page entite.
     *
     * @param string
     */
    public function new(string $filename, array $opts = [])
    {
        self::$list[$filename] = new PageEntitie($filename, $opts);
        $this->current = $filename;
    }

    /**
     * 
     */
    public function registre(string $filename = null)
    {
        self::save($this->current, self::$list[$this->current]);
    }


}

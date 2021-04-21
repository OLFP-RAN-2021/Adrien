<?php
namespace App;

/**
 * Page entitie
 */
class PageEntitie
{
    public string $filename = 'unnamed.html';
    public string $title = '';
    public $content = '';
    public string $description = '';
    public string $categorie = '';
    public array $keywords = [];
    private int $ownerID = 0;
    public int $publication = 0;
    public int $edition = 0;
    public bool $isDraft = true;
    public bool $isArchived = false;

    /**
     * @param string $filename
     */
    public function __construct(string $filename, array $values)
    {
        $this->filename = $filename . '.html';
        $this->ownerID = $_SESSION['ID'];
        foreach($values as $key => $val){
            if (isset($this->$key))
            $this->$key = $val;
        }
    }


}

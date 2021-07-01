<?php

namespace App\models\entities;

use Framework\Databases\SQL;

/**
 * [ 
 *      SQLTYPE(string), 
 *      nullable(bool),  
 *      default(mixed), 
 *          primary (bool:true) || Foreign.key (string)  
 *      is_auto_increment(bool)
 *      optionnal indexes [ 
 *          [
 *              indexname(string), 
 *              isunique(bool)
 *          ], 
 *          etc.
 *      ]
 * ]
 */
class PageEntity
{
    public $id =               [SQL::INT,       false,  0,  true,       true];
    public $urlid =            [SQL::INT,       false,  0,  'urls.id',  false];
    public $authorid =         [SQL::INT,       false,  0,  'users.id', false];
    public $title =            [SQL::VARCHAR,   true,   'default'];
    public $publication =      [SQL::DATETIME,  true];
    public $edition =          [SQL::DATETIME,  true];
    public $description =      [SQL::TEXT,      true];
    public $contentType =      [SQL::VARCHAR,   true];
    public $content =          [SQL::TEXT,      true];
}

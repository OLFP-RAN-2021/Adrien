<?php

namespace App\models\entities;

/**
 * [ 
 *      default(mixed), 
 *      
 *      'TYPE'(string), 
 *      
 *      max(int),
 *      
 *      is_primary_key (bool:true), 
 *      Foreign.key (string)     // is foreign key (can't be primary)
 *      
 *      is_auto_increment(bool)
 *      
 *      optionnal indexes [ 
 *          [
 *              indexname(string), 
 *              isunique(bool)
 *          ], 
 *          etc.
 *      ]
 *  
 * ]
 */
class PageEntity
{
    public $ID =               [0,                 'INTEGER',    16,     true,  true];
    public $FGID =             [0,                 'INTEGER',    16,     'registre_urls.id',  true, []];
    public $title =            ['default',         'VARCHAR',    150];
    public $owner_id =         [0,                 'INTEGER',    16];
    public $publication =      [null,              'DATETIME'];
    public $edition =          [null,              'DATETIME'];
    public $description =      ['default',         'TEXT',  500];
    public $content =          ['',                'TEXT'];
}

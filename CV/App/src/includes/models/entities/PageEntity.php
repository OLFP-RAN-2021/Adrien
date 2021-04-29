<?php

namespace App\models\entities;

/**
 * 
 * [ 
 *      default(mixed), 
 *      'TYPE'(string), 
 *      max(int), 
 *      is_primary_key(bool), 
 *      is_auto_increment(bool)  
 * ]
 */
class PageEntity
{
    protected $ID =               [0,                 'INTEGER',    16,     true,   true];
    protected $url =              ['default.html',    'VARCHAR',    256];
    protected $title =            ['default',         'VARCHAR',    50];
    protected $owner_id =         [0,                 'INTEGER',    16];
    protected $publication =      [null,              'DATETIME'];
    protected $edition =          [null,              'DATETIME'];
    protected $description =      ['default',         'TEXT'];
    protected $content =          ['',                'TEXT'];
}

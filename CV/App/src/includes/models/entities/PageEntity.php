<?php

namespace App\models\entities;

use Framework\Databases\SQLElements\Field;
use Framework\Databases\SQLElements\Key\ForeignKey;
use Framework\Databases\SQLElements\Key\Key;
use Framework\Databases\SQLElements\Key\PrimaryKey;
use Framework\Databases\SQLElements\Table;
use Framework\Databases\SQLElements\TableDataset;
use Framework\Databases\SQLElements\TableFieldset;
use Framework\Databases\SQLElements\Type;

/**
 * [ 
 *      default(mixed), 
 *      
 *      'SQL_TYPE'(string), 
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
    public $FGID =             [0,                 'INT',   16,     'urls.id',    true];
    public $title =            ['default',         'VARCHAR',   150];
    public $owner_id =         [0,                 'INT',   16];
    public $publication =      [null,              'DATETIME'];
    public $edition =          [null,              'DATETIME'];
    public $description =      ['default',         'TEXT',      500];
    public $contentType =      ['SELF',            'VARCHAR',   150];
    public $content =          ['',                'TEXT'];
}


// $pages = new Table(
//     'pages',
//     new TableFieldset([
//         new Field('id', new PrimaryKey('id'), new Type(Type::INT, null, 16, false, 0)),
//         new Field('urlid', new ForeignKey('urls.id'), new Type(Type::INT, null, 16, false, 0)),
//         new Field('ownerid', new ForeignKey('users.id'), new Type(Type::INT, null, 16, false, 0)),
//         new Field('title', new Key('title'), new Type(Type::VARCHAR, null, 150, true, 0)),
//     ]),
//     new TableDataset([null, null, null, 'default',  null, null, '', '', '']),
// );

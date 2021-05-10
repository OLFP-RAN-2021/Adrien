<?php

namespace Framework;

use Framework\Exceptions\GenericException;

/**
 * Framework Exceptions extends natives PHP Exceptions.
 * 
 * Color title depend of code : 
 * - default : gray
 * - &gt;= 100 : blue (info)
 * - &gt;= 200 : green (success)
 * - &gt;= 300 : orange (warning)
 * - &gt;= 400 : red (alert)
 * - &gt;= 500 : purple (unicorn)
 * 
 * @param array $options 
 * Natives :
 * - "message"   (string)    => "You're message"
 * - "code"      (integer)   => 200
 * - "thowable"  (object)    => object thowable
 * 
 * Added :
 * - "description"   (string)   => "You're message"
 * - "refs"          (array)    => ['see this doc' => "http://php.net/", etc. ]
 * 
 * @return self
 */
class Exception extends GenericException
{
}

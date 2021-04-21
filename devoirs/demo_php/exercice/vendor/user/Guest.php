<?php

namespace Vendor\user;


session_start();

class User extends User
{
    /**
     * 
     */
    public function __construct()
    {
        parent::__construct('guest', 0);
    }
}
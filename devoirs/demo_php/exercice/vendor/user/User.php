<?php

namespace Vendor\user;


session_start();

class User
{
    /**
     * 
     * @param int $grant 
     */
    public function __construct(string $login, int $grant)
    {
        $this->login = $login;
        $this->grant = $grant;
    }
}
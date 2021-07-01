<?php

class User
{
    private int $ID;
    private string $email;
    private string $login;
    private string $password;

    function __construct()
    {
        session_start();
    }

    public function addCookie(string $key, int $lifetime = 86600)
    {
        if (!in_array($key, ['password', 'login', 'email'])) {
            if (isset($this->$key)) {
                setcookie($key, $this->$key, (time() + $lifetime));
            }
        }
    }

    public function rmCookie(string $key)
    {
        if (isset($_COOKIE[$key])) {
            setcookie($key, null, 1);
        }
    }

    public function login()
    {
    }

    public function unlogin()
    {
    }

    public function create()
    {
    }

    public function delete()
    {
    }


    /**
     * Get the value of ID
     *
     * @return  int
     */
    public function getID()
    {
        return $this->ID;
    }

    /**
     * Set the value of ID
     *
     * @param  int  $ID
     *
     * @return  self
     */
    public function setID(int $ID)
    {
        $this->ID = $ID;
        return $this;
    }

    /**
     * Get the value of email
     *
     * @return  string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the value of email
     *
     * @param  string  $email
     *
     * @return  self
     */
    public function setEmail(string $email)
    {
        $this->email = $email;
        return $this;
    }

    /**
     * Get the value of email
     *
     * @return  string
     */
    public function getLogin()
    {
        return $this->email;
    }

    /**
     * Set the value of email
     *
     * @param  string  $email
     *
     * @return  self
     */
    public function setLogin(string $email)
    {
        $this->email = $email;
        return $this;
    }

    /**
     * Get the value of password
     *
     * @return  string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set the value of password
     *
     * @param  string  $password
     *
     * @return  self
     */
    public function setPassword(string $password)
    {
        $this->password = $password;
        return $this;
    }
}

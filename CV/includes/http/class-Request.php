<?php 
namespace app\http;

class Request {

    public function __construct()
    {
        if (isset($_POST) && !empty($_POST))
        {
            $this->POST = $_POST;
        }

        if (isset($_GET) && !empty($_GET))
        {
            $this->POST = $_POST;
        }
    }


 
}
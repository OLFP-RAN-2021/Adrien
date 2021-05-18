<?php

namespace app\http;

use stdClass;

class Request
{

    public function __construct()
    {
        if (isset($_POST) && !empty($_POST)) {
            $this->POST = new stdClass;
            foreach ($_POST as $key => $val)
                $this->POST->$key = $val;
        }

        if (isset($_GET) && !empty($_GET)) {
            $this->GET = new stdClass;
            $this->GET->pathinfo = PATHINFO;
            foreach ($_GET as $key => $val)
                $this->GET->$key = $val;
        }
    }

    /**
     * 
     */
    public function addHook()
    {
    }
}

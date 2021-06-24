<?php 
namespace app\forms;

class form {
    
    public array $request = [];
    public array $response = [];

    public function __construct()
    {
        $this->response = (isset($_POST) && !empty($_POST)) ? $_POST : [];
        
    }


    



    public function __destruct()
    {

    }


}
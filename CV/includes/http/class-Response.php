<?php 
namespace app\http;

use ReflectionClass;

class Response {

    public bool $sendAuto = true;
    public string $type = 'application/json';
    public $container;

    /**
     * @param string $type type mime 
     * @param $content [optional] 
     * @return void
     */
    public function __construct(string $type = 'json', ...$params)
    {
        $type = __NAMESPACE__.'\entities\\'.$type;
        if (class_exists($type, true)){
            $reflexion = new ReflectionClass($type);
            if($reflexion->isInstantiable())
            {
                $this->container = $reflexion->newInstanceArgs($params);
            }
        }
        else {
            trigger_error('Response object is not initialized', E_USER_ERROR);
        }
    }

    /**
     * @param void 
     * @return void
     */
    public function __destruct()
    {
        if ($this->sendAuto === true){
            header('Content-Type:'.$this->container->mime);
            unset($this->container->mime);
            echo $this->container;
            exit;
        }
    }
}
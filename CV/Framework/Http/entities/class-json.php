<?php 
namespace app\http\entities;

class json {

    /**
     * @var string $mime type mime
     */
    public $mime = 'application/json';

    /**
     * Unserialize json from http request
     * 
     * @param string $json [optional]
     * @return object
     */
    public function __construct(string $json = null)
    {
        if (isset($json))
        foreach(json_decode($json) as $var => $value) $this->$var = $value;
    }

    /**
     * Seliraze in JSON object values (to send response)
     * 
     * @param void
     * @return string
     */
    public function __toString() : string
    {
        $data = get_object_vars($this);
        return json_encode($data, JSON_PRETTY_PRINT|JSON_INVALID_UTF8_IGNORE);
    }

}
<?php

class InteriorColor{

    public $id;
    public $name;
    public $code;
    public $hex_code;


    public function __construct($id, $name, $code, $hex_code)
    {
        
        $this->id = $id;
        $this->name = $name;
        $this->code = $code;
        $this->hex_code = $hex_code;

    }
}

?>
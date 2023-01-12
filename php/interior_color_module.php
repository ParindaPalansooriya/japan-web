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

    /**
     * Get the value of name
     */ 
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the value of name
     *
     * @return  self
     */ 
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get the value of code
     */ 
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Set the value of code
     *
     * @return  self
     */ 
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * Get the value of hex_code
     */ 
    public function getHex_code()
    {
        return $this->hex_code;
    }

    /**
     * Set the value of hex_code
     *
     * @return  self
     */ 
    public function setHex_code($hex_code)
    {
        $this->hex_code = $hex_code;

        return $this;
    }

    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }
}

?>
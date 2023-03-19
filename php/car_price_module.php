<?php

class CarPrice{

    public $car_id;
    public $buying;
    public $selling;
    public $public;
    public $price1;
    public $price2;


    public function __construct($car_id, $buying, $selling, $public, $price1, $price2)
    {
        
        $this->car_id = $car_id;
        $this->buying = $buying;
        $this->selling = $selling;
        $this->public = $public;
        $this->price1 = $price1;
        $this->price2 = $price2;

    }

    /**
     * Get the value of car_id
     */ 
    public function getCar_id()
    {
        return $this->car_id;
    }

    /**
     * Set the value of car_id
     *
     * @return  self
     */ 
    public function setCar_id($car_id)
    {
        $this->car_id = $car_id;

        return $this;
    }

    /**
     * Get the value of buying
     */ 
    public function getBuying()
    {
        return $this->buying;
    }

    /**
     * Set the value of buying
     *
     * @return  self
     */ 
    public function setBuying($buying)
    {
        $this->buying = $buying;

        return $this;
    }

    /**
     * Get the value of selling
     */ 
    public function getSelling()
    {
        return $this->selling;
    }

    /**
     * Set the value of selling
     *
     * @return  self
     */ 
    public function setSelling($selling)
    {
        $this->selling = $selling;

        return $this;
    }

    /**
     * Get the value of public
     */ 
    public function getPublic()
    {
        return $this->public;
    }

    /**
     * Set the value of public
     *
     * @return  self
     */ 
    public function setPublic($public)
    {
        $this->public = $public;

        return $this;
    }

    /**
     * Get the value of price1
     */ 
    public function getPrice1()
    {
        return $this->price1;
    }

    /**
     * Set the value of price1
     *
     * @return  self
     */ 
    public function setPrice1($price1)
    {
        $this->price1 = $price1;

        return $this;
    }

    /**
     * Get the value of price2
     */ 
    public function getPrice2()
    {
        return $this->price2;
    }

    /**
     * Set the value of price2
     *
     * @return  self
     */ 
    public function setPrice2($price2)
    {
        $this->price2 = $price2;

        return $this;
    }
}

?>
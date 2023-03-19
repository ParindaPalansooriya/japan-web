<?php

class CarAdditinal{

    public $car_id;
    public $supplier;
    public $perfecture;
    public $bank;


    public function __construct($car_id, $supplier, $perfecture, $bank)
    {
        $this->car_id = $car_id;
        $this->supplier = $supplier;
        $this->perfecture = $perfecture;
        $this->bank = $bank;

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
     * Get the value of supplier
     */ 
    public function getSupplier()
    {
        return $this->supplier;
    }

    /**
     * Set the value of supplier
     *
     * @return  self
     */ 
    public function setSupplier($supplier)
    {
        $this->supplier = $supplier;

        return $this;
    }

    /**
     * Get the value of perfecture
     */ 
    public function getPerfecture()
    {
        return $this->perfecture;
    }

    /**
     * Set the value of perfecture
     *
     * @return  self
     */ 
    public function setPerfecture($perfecture)
    {
        $this->perfecture = $perfecture;

        return $this;
    }

    /**
     * Get the value of bank
     */ 
    public function getBank()
    {
        return $this->bank;
    }

    /**
     * Set the value of bank
     *
     * @return  self
     */ 
    public function setBank($bank)
    {
        $this->bank = $bank;

        return $this;
    }
}

?>
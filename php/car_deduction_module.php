<?php

class CarDeduction{

    public $car_id;
    public $rtax;
    public $atax;
    public $au_cha;
    public $trasport;
    public $storage;
    public $insurance;
    public $repair;
    public $other;

    public function __construct($car_id, $rtax, $atax, $au_cha,$trasport,$storage,$insurance,$repair,$other)
    {
        $this->car_id = $car_id;
        $this->rtax = $rtax;
        $this->atax = $atax;
        $this->au_cha = $au_cha;
        $this->trasport = $trasport;
        $this->storage = $storage;
        $this->insurance = $insurance;
        $this->repair = $repair;
        $this->other = $other;

    }


    /**
     * Get the value of other
     */ 
    public function getOther()
    {
        return $this->other;
    }

    /**
     * Set the value of other
     *
     * @return  self
     */ 
    public function setOther($other)
    {
        $this->other = $other;

        return $this;
    }

    /**
     * Get the value of repair
     */ 
    public function getRepair()
    {
        return $this->repair;
    }

    /**
     * Set the value of repair
     *
     * @return  self
     */ 
    public function setRepair($repair)
    {
        $this->repair = $repair;

        return $this;
    }

    /**
     * Get the value of insurance
     */ 
    public function getInsurance()
    {
        return $this->insurance;
    }

    /**
     * Set the value of insurance
     *
     * @return  self
     */ 
    public function setInsurance($insurance)
    {
        $this->insurance = $insurance;

        return $this;
    }

    /**
     * Get the value of storage
     */ 
    public function getStorage()
    {
        return $this->storage;
    }

    /**
     * Set the value of storage
     *
     * @return  self
     */ 
    public function setStorage($storage)
    {
        $this->storage = $storage;

        return $this;
    }

    /**
     * Get the value of trasport
     */ 
    public function getTrasport()
    {
        return $this->trasport;
    }

    /**
     * Set the value of trasport
     *
     * @return  self
     */ 
    public function setTrasport($trasport)
    {
        $this->trasport = $trasport;

        return $this;
    }

    /**
     * Get the value of au_cha
     */ 
    public function getAu_cha()
    {
        return $this->au_cha;
    }

    /**
     * Set the value of au_cha
     *
     * @return  self
     */ 
    public function setAu_cha($au_cha)
    {
        $this->au_cha = $au_cha;

        return $this;
    }

    /**
     * Get the value of atax
     */ 
    public function getAtax()
    {
        return $this->atax;
    }

    /**
     * Set the value of atax
     *
     * @return  self
     */ 
    public function setAtax($atax)
    {
        $this->atax = $atax;

        return $this;
    }

    /**
     * Get the value of rtax
     */ 
    public function getRtax()
    {
        return $this->rtax;
    }

    /**
     * Set the value of rtax
     *
     * @return  self
     */ 
    public function setRtax($rtax)
    {
        $this->rtax = $rtax;

        return $this;
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
}

?>
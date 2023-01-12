<?php

class CarImagers{

    public $car_id;
    public $id;
    public $image;
    public $is_main;

    public function __construct($id, $car_id, $image, $is_main)
    {
        $this->image = $image;
        $this->car_id = $car_id;
        $this->is_main = $is_main;
        $this->id = $id;
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

    /**
     * Get the value of image
     */ 
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set the value of image
     *
     * @return  self
     */ 
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get the value of is_main
     */ 
    public function getIs_main()
    {
        return $this->is_main;
    }

    /**
     * Set the value of is_main
     *
     * @return  self
     */ 
    public function setIs_main($is_main)
    {
        $this->is_main = $is_main;

        return $this;
    }
}

?>
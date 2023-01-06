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
}

?>
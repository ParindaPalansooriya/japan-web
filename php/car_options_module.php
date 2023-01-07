<?php

class CarOptions{

    public $id;
    public $car_id;
    public $option_id;

    public function __construct($id, $car_id, $option_id)
    {
        $this->id = $id;
        $this->car_id = $car_id;
        $this->option_id = $option_id;
    }
}

?>
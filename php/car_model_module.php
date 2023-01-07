<?php

class CarModel{

    public $id;
    public $image;
    public $name;

    public function __construct($id, $image, $name)
    {
        $this->image = $image;
        $this->name = $name;
        $this->id = $id;
    }
}

?>
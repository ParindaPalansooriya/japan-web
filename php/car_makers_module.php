<?php

class CarMakers{

    public $name;
    public $id;
    public $image;
    public $is_active;

    public function __construct($id, $name, $image, $is_active)
    {
        $this->image = $image;
        $this->name = $name;
        $this->is_active = $is_active;
        $this->id = $id;
    }
}

?>
<?php

class CarActionType{

    public $id;
    public $name;
    public $is_active;

    public function __construct($id, $name, $is_active)
    {
        $this->id = $id;
        $this->name = $name;
        $this->is_active = $is_active;
    }
}

?>
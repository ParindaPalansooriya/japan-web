<?php

class ControlUsers{

    public $id;
    public $user_name;
    public $password;
    public $user_type;
    public $is_active;


    public function __construct($id, $user_name, $password, $user_type, $is_active)
    {
        
        $this->id = $id;
        $this->user_name = $user_name;
        $this->password = $password;
        $this->user_type = $user_type;
        $this->is_active = $is_active;

    }
}

?>
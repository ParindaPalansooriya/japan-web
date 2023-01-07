<?php

class UserInquary{

    public $id;
    public $car_id;
    public $user_name;
    public $email;
    public $mobile;
    public $nearest_port;
    public $message;


    public function __construct($id, $car_id, $user_name, $email, $mobile, $nearest_port, $message)
    {
        
        $this->id = $id;
        $this->car_id = $car_id;
        $this->user_name = $user_name;
        $this->email = $email;
        $this->mobile = $mobile;
        $this->nearest_port = $nearest_port;
        $this->message = $message;
        

    }
}

?>
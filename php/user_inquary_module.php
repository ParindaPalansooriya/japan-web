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
     * Get the value of user_name
     */ 
    public function getUser_name()
    {
        return $this->user_name;
    }

    /**
     * Set the value of user_name
     *
     * @return  self
     */ 
    public function setUser_name($user_name)
    {
        $this->user_name = $user_name;

        return $this;
    }

    /**
     * Get the value of email
     */ 
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the value of email
     *
     * @return  self
     */ 
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get the value of mobile
     */ 
    public function getMobile()
    {
        return $this->mobile;
    }

    /**
     * Set the value of mobile
     *
     * @return  self
     */ 
    public function setMobile($mobile)
    {
        $this->mobile = $mobile;

        return $this;
    }

    /**
     * Get the value of nearest_port
     */ 
    public function getNearest_port()
    {
        return $this->nearest_port;
    }

    /**
     * Set the value of nearest_port
     *
     * @return  self
     */ 
    public function setNearest_port($nearest_port)
    {
        $this->nearest_port = $nearest_port;

        return $this;
    }

    /**
     * Get the value of message
     */ 
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * Set the value of message
     *
     * @return  self
     */ 
    public function setMessage($message)
    {
        $this->message = $message;

        return $this;
    }
}

?>
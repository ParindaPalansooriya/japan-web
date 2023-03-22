<?php

class ContactUs{

    public $id;
    public $username;
    public $contact1;
    public $contact2;
    public $message;
    public $status;


    public function __construct($id, $username,$contact1, $contact2, $message,$status)
    {
        
        $this->id = $id;
        $this->username = $username;
        $this->contact1 = $contact1;
        $this->contact2 = $contact2;
        $this->message = $message;
        $this->status = $status;

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
     * Get the value of username
     */ 
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set the value of username
     *
     * @return  self
     */ 
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Get the value of contact1
     */ 
    public function getContact1()
    {
        return $this->contact1;
    }

    /**
     * Set the value of contact1
     *
     * @return  self
     */ 
    public function setContact1($contact1)
    {
        $this->contact1 = $contact1;

        return $this;
    }

    /**
     * Get the value of contact2
     */ 
    public function getContact2()
    {
        return $this->contact2;
    }

    /**
     * Set the value of contact2
     *
     * @return  self
     */ 
    public function setContact2($contact2)
    {
        $this->contact2 = $contact2;

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

    /**
     * Get the value of status
     */ 
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set the value of status
     *
     * @return  self
     */ 
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }
}

?>
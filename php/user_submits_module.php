<?php

class UserSubmits{

    public $id;
    public $user_id;
    public $date;
    public $time;
    public $sales_name;
    public $customer_name;
    public $customer_contact;
    public $note;


    public function __construct($id, $user_id,$date, $time, $sales_name,$customer_name,$customer_contact, $note)
    {
        
        $this->id = $id;
        $this->user_id = $user_id;
        $this->date = $date;
        $this->time = $time;
        $this->sales_name = $sales_name;
        $this->note = $note;
        $this->customer_name = $customer_name;
        $this->customer_contact = $customer_contact;

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
     * Get the value of user_id
     */ 
    public function getUser_id()
    {
        return $this->user_id;
    }

    /**
     * Set the value of user_id
     *
     * @return  self
     */ 
    public function setUser_id($user_id)
    {
        $this->user_id = $user_id;

        return $this;
    }

    /**
     * Get the value of date
     */ 
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set the value of date
     *
     * @return  self
     */ 
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get the value of time
     */ 
    public function getTime()
    {
        return $this->time;
    }

    /**
     * Set the value of time
     *
     * @return  self
     */ 
    public function setTime($time)
    {
        $this->time = $time;

        return $this;
    }

    /**
     * Get the value of sales_name
     */ 
    public function getSales_name()
    {
        return $this->sales_name;
    }

    /**
     * Set the value of sales_name
     *
     * @return  self
     */ 
    public function setSales_name($sales_name)
    {
        $this->sales_name = $sales_name;

        return $this;
    }

    /**
     * Get the value of note
     */ 
    public function getNote()
    {
        return $this->note;
    }

    /**
     * Set the value of note
     *
     * @return  self
     */ 
    public function setNote($note)
    {
        $this->note = $note;

        return $this;
    }

    /**
     * Get the value of customer_name
     */ 
    public function getCustomer_name()
    {
        return $this->customer_name;
    }

    /**
     * Set the value of customer_name
     *
     * @return  self
     */ 
    public function setCustomer_name($customer_name)
    {
        $this->customer_name = $customer_name;

        return $this;
    }

    /**
     * Get the value of customer_contact
     */ 
    public function getCustomer_contact()
    {
        return $this->customer_contact;
    }

    /**
     * Set the value of customer_contact
     *
     * @return  self
     */ 
    public function setCustomer_contact($customer_contact)
    {
        $this->customer_contact = $customer_contact;

        return $this;
    }
}

?>
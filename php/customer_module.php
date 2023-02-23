<?php
class Customer{

    public $id;
    public $name;
    public $contact_num1;
    public $contact_num2;
    public $bday;
    public $address;


    public function __construct($id, $name, $contact_num1, $contact_num2, $bday,$address)
    {
        
        $this->id = $id;
        $this->name = $name;
        $this->contact_num1 = $contact_num1;
        $this->contact_num2 = $contact_num2;
        $this->bday = $bday;
        $this->address = $address;

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
     * Get the value of name
     */ 
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the value of name
     *
     * @return  self
     */ 
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get the value of contact_num1
     */ 
    public function getContact_num1()
    {
        return $this->contact_num1;
    }

    /**
     * Set the value of contact_num1
     *
     * @return  self
     */ 
    public function setContact_num1($contact_num1)
    {
        $this->contact_num1 = $contact_num1;

        return $this;
    }

    /**
     * Get the value of contact_num2
     */ 
    public function getContact_num2()
    {
        return $this->contact_num2;
    }

    /**
     * Set the value of contact_num2
     *
     * @return  self
     */ 
    public function setContact_num2($contact_num2)
    {
        $this->contact_num2 = $contact_num2;

        return $this;
    }

    /**
     * Get the value of bday
     */ 
    public function getBday()
    {
        return $this->bday;
    }

    /**
     * Set the value of bday
     *
     * @return  self
     */ 
    public function setBday($bday)
    {
        $this->bday = $bday;

        return $this;
    }

    /**
     * Get the value of address
     */ 
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Set the value of address
     *
     * @return  self
     */ 
    public function setAddress($address)
    {
        $this->address = $address;

        return $this;
    }
}

?>
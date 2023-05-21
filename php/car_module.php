<?php

class Cars{

    public $maker_id;
    public $model_id;
    public $interior_color_id;
    public $exterior_color_id;
    public $current_action_id;
    public $body_style_id;
    public $passengers;
    public $doors;
    public $name;
    public $grade;
    public $power;
    public $model_year;
    public $evaluation;
    public $running;
    public $cooling;
    public $note;
    public $fuel;
    public $chassis;
    public $dimensions_L;
    public $dimensions_W;
    public $dimensions_H;
    public $transmission_shift;
    public $id;
    public $is_public;
    public $is_used;
    public $is_two_weel;
    public $is_steering_right;
    public $date;
    public $ex_color;
    public $in_color;

    
    public $bank_date;
    public $country;
    public $topic;
    public $options;

    public function __construct($maker_id, $model_id, $interior_color_id, $exterior_color_id, $current_action_id, $body_style_id,$passengers, 
    $doors, $name, $grade, $power, $model_year, $evaluation, $running, $cooling, $note, $fuel, $chassis, $dimensions_L, $dimensions_W, $dimensions_H, 
    $transmission_shift, $id, $is_public, $is_used, $is_two_weel, $is_steering_right,
    $interior_color,
    $exterior_color,$bank_date,$country,$topic,$options)
    {
        $this->maker_id = $maker_id;
        $this->model_id = $model_id;
        $this->interior_color_id = $interior_color_id;
        $this->exterior_color_id = $exterior_color_id;
        $this->current_action_id = $current_action_id;
        $this->body_style_id = $body_style_id;
        $this->passengers = $passengers;
        $this->doors = $doors;
        $this->name = $name;
        $this->grade = $grade;
        $this->power = $power;
        $this->model_year = $model_year;
        $this->evaluation = $evaluation;
        $this->running = $running;
        $this->cooling = $cooling;
        $this->note = $note;
        $this->fuel = $fuel;
        $this->chassis = $chassis;
        $this->dimensions_L = $dimensions_L;
        $this->dimensions_W = $dimensions_W;
        $this->dimensions_H = $dimensions_H;
        $this->transmission_shift = $transmission_shift;
        $this->id = $id;
        $this->is_public = $is_public;
        $this->is_used = $is_used;
        $this->is_two_weel = $is_two_weel;
        $this->is_steering_right = $is_steering_right;
        $this->in_color = $interior_color;
        $this->ex_color = $exterior_color;
        $this->bank_date = $bank_date;
        $this->country = $country;
        $this->topic = $topic;
        $this->options = $options;
    }

    
    public $image;
    public $style;
    public $maker;
    public $model;
    
    public $price;

    public $userInwuary;
    public $additional;
    public $deductions;

    /**
     * Get the value of in_color
     */ 
    public function getIn_color()
    {
        return $this->in_color;
    }

    /**
     * Set the value of in_color
     *
     * @return  self
     */ 
    public function setIn_color($in_color)
    {
        $this->in_color = $in_color;

        return $this;
    }

    /**
     * Get the value of ex_color
     */ 
    public function getEx_color()
    {
        return $this->ex_color;
    }

    /**
     * Set the value of ex_color
     *
     * @return  self
     */ 
    public function setEx_color($ex_color)
    {
        $this->ex_color = $ex_color;

        return $this;
    }

    /**
     * Get the value of model
     */ 
    public function getModel()
    {
        return $this->model;
    }

    /**
     * Set the value of model
     *
     * @return  self
     */ 
    public function setModel($model)
    {
        $this->model = $model;

        return $this;
    }

    /**
     * Get the value of maker
     */ 
    public function getMaker()
    {
        return $this->maker;
    }

    /**
     * Set the value of maker
     *
     * @return  self
     */ 
    public function setMaker($maker)
    {
        $this->maker = $maker;

        return $this;
    }

    /**
     * Get the value of style
     */ 
    public function getStyle()
    {
        return $this->style;
    }

    /**
     * Set the value of style
     *
     * @return  self
     */ 
    public function setStyle($style)
    {
        $this->style = $style;

        return $this;
    }

    /**
     * Get the value of image
     */ 
    public function getImage()
    {
        if(!isset($this->image) || empty($this->image)){
            return "noimage.png";
        }
        return $this->image;
    }

    /**
     * Set the value of image
     *
     * @return  self
     */ 
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get the value of maker_id
     */ 
    public function getMaker_id()
    {
        return $this->maker_id;
    }

    /**
     * Set the value of maker_id
     *
     * @return  self
     */ 
    public function setMaker_id($maker_id)
    {
        $this->maker_id = $maker_id;

        return $this;
    }

    /**
     * Get the value of model_id
     */ 
    public function getModel_id()
    {
        return $this->model_id;
    }

    /**
     * Set the value of model_id
     *
     * @return  self
     */ 
    public function setModel_id($model_id)
    {
        $this->model_id = $model_id;

        return $this;
    }

    /**
     * Get the value of interior_color_id
     */ 
    public function getInterior_color_id()
    {
        return $this->interior_color_id;
    }

    /**
     * Set the value of interior_color_id
     *
     * @return  self
     */ 
    public function setInterior_color_id($interior_color_id)
    {
        $this->interior_color_id = $interior_color_id;

        return $this;
    }

    /**
     * Get the value of exterior_color_id
     */ 
    public function getExterior_color_id()
    {
        return $this->exterior_color_id;
    }

    /**
     * Set the value of exterior_color_id
     *
     * @return  self
     */ 
    public function setExterior_color_id($exterior_color_id)
    {
        $this->exterior_color_id = $exterior_color_id;

        return $this;
    }

    /**
     * Get the value of current_action_id
     */ 
    public function getCurrent_action_id()
    {
        return $this->current_action_id;
    }

    public function getCurrent_action_text()
    {

        $exportText = $this->is_public==1?" - Export":"";

        if($this->current_action_id==0){
            return "No Block".$exportText;
        }
        if($this->current_action_id==1){
            return "1 Kojo".$exportText;
        }
        if($this->current_action_id==2){
            return "1 Sale".$exportText;
        }
        if($this->current_action_id==3){
            return "2 Kojo".$exportText;
        }
        if($this->current_action_id==4){
            return "2 Sale".$exportText;
        }
        if($this->current_action_id==5){
            return "3 Kojo".$exportText;
        }
        if($this->current_action_id==6){
            return "3 Sale".$exportText;
        }
        if($this->current_action_id==7){
            return "Miho Kojo".$exportText;
        }
        if($this->current_action_id==-1){
            return "Export".$exportText;
        }
        if($this->current_action_id==8){
            return "USS".$exportText;
        }
        if($this->current_action_id==9){
            return "CAA".$exportText;
        }
        if($this->current_action_id==10){
            return "Other Option".$exportText;
        }
        if($this->current_action_id==11){
            return "Parts".$exportText;
        }
        return $this->current_action_id.$exportText;
    }

    /**
     * Set the value of current_action_id
     *
     * @return  self
     */ 
    public function setCurrent_action_id($current_action_id)
    {
        $this->current_action_id = $current_action_id;

        return $this;
    }

    /**
     * Get the value of body_style_id
     */ 
    public function getBody_style_id()
    {
        return $this->body_style_id;
    }

    /**
     * Set the value of body_style_id
     *
     * @return  self
     */ 
    public function setBody_style_id($body_style_id)
    {
        $this->body_style_id = $body_style_id;

        return $this;
    }

    /**
     * Get the value of passengers
     */ 
    public function getPassengers()
    {
        return $this->passengers;
    }

    /**
     * Set the value of passengers
     *
     * @return  self
     */ 
    public function setPassengers($passengers)
    {
        $this->passengers = $passengers;

        return $this;
    }

    /**
     * Get the value of doors
     */ 
    public function getDoors()
    {
        return $this->doors;
    }

    /**
     * Set the value of doors
     *
     * @return  self
     */ 
    public function setDoors($doors)
    {
        $this->doors = $doors;

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
     * Get the value of grade
     */ 
    public function getGrade()
    {
        return $this->grade;
    }

    /**
     * Set the value of grade
     *
     * @return  self
     */ 
    public function setGrade($grade)
    {
        $this->grade = $grade;

        return $this;
    }

    /**
     * Get the value of power
     */ 
    public function getPower()
    {
        return $this->power;
    }

    /**
     * Set the value of power
     *
     * @return  self
     */ 
    public function setPower($power)
    {
        $this->power = $power;

        return $this;
    }

    /**
     * Get the value of model_year
     */ 
    public function getModel_year()
    {
        return $this->model_year;
    }

    /**
     * Set the value of model_year
     *
     * @return  self
     */ 
    public function setModel_year($model_year)
    {
        $this->model_year = $model_year;

        return $this;
    }

    /**
     * Get the value of evaluation
     */ 
    public function getEvaluation()
    {
        return $this->evaluation;
    }

    /**
     * Set the value of evaluation
     *
     * @return  self
     */ 
    public function setEvaluation($evaluation)
    {
        $this->evaluation = $evaluation;

        return $this;
    }

    /**
     * Get the value of running
     */ 
    public function getRunning()
    {
        return $this->running;
    }

    /**
     * Set the value of running
     *
     * @return  self
     */ 
    public function setRunning($running)
    {
        $this->running = $running;

        return $this;
    }

    /**
     * Get the value of cooling
     */ 
    public function getCooling()
    {
        return $this->cooling;
    }

    /**
     * Set the value of cooling
     *
     * @return  self
     */ 
    public function setCooling($cooling)
    {
        $this->cooling = $cooling;

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
     * Get the value of fuel
     */ 
    public function getFuel()
    {
        return $this->fuel;
    }

    /**
     * Set the value of fuel
     *
     * @return  self
     */ 
    public function setFuel($fuel)
    {
        $this->fuel = $fuel;

        return $this;
    }

    /**
     * Get the value of chassis
     */ 
    public function getChassis()
    {
        return $this->chassis;
    }

    /**
     * Set the value of chassis
     *
     * @return  self
     */ 
    public function setChassis($chassis)
    {
        $this->chassis = $chassis;

        return $this;
    }

    /**
     * Get the value of dimensions_L
     */ 
    public function getDimensions_L()
    {
        return $this->dimensions_L;
    }

    /**
     * Set the value of dimensions_L
     *
     * @return  self
     */ 
    public function setDimensions_L($dimensions_L)
    {
        $this->dimensions_L = $dimensions_L;

        return $this;
    }

    /**
     * Get the value of dimensions_W
     */ 
    public function getDimensions_W()
    {
        return $this->dimensions_W;
    }

    /**
     * Set the value of dimensions_W
     *
     * @return  self
     */ 
    public function setDimensions_W($dimensions_W)
    {
        $this->dimensions_W = $dimensions_W;

        return $this;
    }

    /**
     * Get the value of dimensions_H
     */ 
    public function getDimensions_H()
    {
        return $this->dimensions_H;
    }

    /**
     * Set the value of dimensions_H
     *
     * @return  self
     */ 
    public function setDimensions_H($dimensions_H)
    {
        $this->dimensions_H = $dimensions_H;

        return $this;
    }

    /**
     * Get the value of transmission_shift
     */ 
    public function getTransmission_shift()
    {
        return $this->transmission_shift;
    }

    /**
     * Set the value of transmission_shift
     *
     * @return  self
     */ 
    public function setTransmission_shift($transmission_shift)
    {
        $this->transmission_shift = $transmission_shift;

        return $this;
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
     * Get the value of is_public
     */ 
    public function getIs_public()
    {
        return $this->is_public;
    }

    /**
     * Set the value of is_public
     *
     * @return  self
     */ 
    public function setIs_public($is_public)
    {
        $this->is_public = $is_public;

        return $this;
    }

    /**
     * Get the value of is_used
     */ 
    public function getIs_used()
    {
        return $this->is_used;
    }

    /**
     * Set the value of is_used
     *
     * @return  self
     */ 
    public function setIs_used($is_used)
    {
        $this->is_used = $is_used;

        return $this;
    }

    /**
     * Get the value of is_two_weel
     */ 
    public function getIs_two_weel()
    {
        return $this->is_two_weel;
    }

    /**
     * Set the value of is_two_weel
     *
     * @return  self
     */ 
    public function setIs_two_weel($is_two_weel)
    {
        $this->is_two_weel = $is_two_weel;

        return $this;
    }

    /**
     * Get the value of is_steering_right
     */ 
    public function getIs_steering_right()
    {
        return $this->is_steering_right;
    }

    /**
     * Set the value of is_steering_right
     *
     * @return  self
     */ 
    public function setIs_steering_right($is_steering_right)
    {
        $this->is_steering_right = $is_steering_right;

        return $this;
    }

    /**
     * Get the value of price
     */ 
    public function getPrice()
    {
        if(!isset($this->price) || empty($this->price)){
            return 0;
        }
        return $this->price;
    }

    public function getPriceObject()
    {
        return $this->price;
    }

    /**
     * Set the value of price
     *
     * @return  self
     */ 
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get the value of userInwuary
     */ 
    public function getUserInwuary()
    {
        return $this->userInwuary;
    }

    /**
     * Set the value of userInwuary
     *
     * @return  self
     */ 
    public function setUserInwuary($userInwuary)
    {
        $this->userInwuary = $userInwuary;

        return $this;
    }

    /**
     * Get the value of additional
     */ 
    public function getAdditional()
    {
        return $this->additional;
    }

    /**
     * Set the value of additional
     *
     * @return  self
     */ 
    public function setAdditional($additional)
    {
        $this->additional = $additional;

        return $this;
    }

    /**
     * Get the value of deductions
     */ 
    public function getDeductions()
    {
        return $this->deductions;
    }

    /**
     * Set the value of deductions
     *
     * @return  self
     */ 
    public function setDeductions($deductions)
    {
        $this->deductions = $deductions;

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
     * Get the value of bank_date
     */ 
    public function getBank_date()
    {
        return $this->bank_date;
    }

    /**
     * Set the value of bank_date
     *
     * @return  self
     */ 
    public function setBank_date($bank_date)
    {
        $this->bank_date = $bank_date;

        return $this;
    }

    /**
     * Get the value of country
     */ 
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * Set the value of country
     *
     * @return  self
     */ 
    public function setCountry($country)
    {
        $this->country = $country;

        return $this;
    }

    /**
     * Get the value of topic
     */ 
    public function getTopic()
    {
        return $this->topic;
    }

    /**
     * Set the value of topic
     *
     * @return  self
     */ 
    public function setTopic($topic)
    {
        $this->topic = $topic;

        return $this;
    }

    /**
     * Get the value of options
     */ 
    public function getOptions()
    {
        return $this->options;
    }

    /**
     * Set the value of options
     *
     * @return  self
     */ 
    public function setOptions($options)
    {
        $this->options = $options;

        return $this;
    }
}

?>
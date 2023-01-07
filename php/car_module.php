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

    public function __construct($maker_id, $model_id, $interior_color_id, $exterior_color_id, $current_action_id, $body_style_id,$passengers, 
    $doors, $name, $grade, $power, $model_year, $evaluation, $running, $cooling, $note, $fuel, $chassis, $dimensions_L, $dimensions_W, $dimensions_H, 
    $transmission_shift, $id, $is_public, $is_used, $is_two_weel, $is_steering_right)
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
    }

    
    public $image;
    public $style;
    public $maker;
    public $model;
    public $ex_color;
    public $in_color;

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
            return "images/unnamed.png";
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
}

?>
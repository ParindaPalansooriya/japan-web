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
}

?>
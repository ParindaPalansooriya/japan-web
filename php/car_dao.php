<?php

function insertCarFull($link,
    $maker_id,
    $model_id,
    $interior_color_id,
    $exterior_color_id,
    $current_action_id,
    $body_style_id,
    $passengers,
    $doors,
    $name,
    $grade,
    $power,
    $model_year,
    $evaluation,
    $running,
    $cooling,
    $note,
    $fuel,
    $chassis,
    $dimensions_L,
    $dimensions_W,
    $dimensions_H,
    $transmission_shift,
    $is_used,
    $is_two_weel,
    $is_steering_right
)
{
    $sql = "INSERT INTO cars (maker_id, model_id, interior_color_id, exterior_color_id, current_action_id, body_style_id, 
    passengers, doors, name, grade, power, model_year, evaluation, running, cooling, note, fuel, chassis, dimensions_L, dimensions_W, dimensions_H,
    transmission_shift, is_used, is_two_weel, is_steering_right,is_public) VALUES ($maker_id,
    $model_id,
    $interior_color_id,
    $exterior_color_id,
    $current_action_id,
    $body_style_id,
    '$passengers',
    $doors,
    '$name',
    '$grade',
    '$power',
    '$model_year',
    '$evaluation',
    '$running',
    '$cooling',
    '$note',
    '$fuel',
    '$chassis',
    '$dimensions_L',
    '$dimensions_W',
    '$dimensions_H',
    '$transmission_shift',
    $is_used,
    $is_two_weel,
    $is_steering_right,0)";

    mysqli_query($link, $sql);

    $retuen_val = 0;
    require_once "config.php";
    $sql2 = "SELECT MAX(id) as max FROM cars";

    if($result = mysqli_query($link, $sql2)){
        while($row = mysqli_fetch_array($result)){
            $retuen_val = $row['max'];
        }
        mysqli_free_result($result);
    }
    return $retuen_val;
}

function getAllCars($link){
    $retuen_val = [];
    require_once "car_module.php";
    $sql2 = "SELECT * FROM cars";

    if($result = mysqli_query($link, $sql2)){
        while($row = mysqli_fetch_array($result)){
            $car = new Cars(
                $row['maker_id'],
                $row['model_id'],
                $row['interior_color_id'],
                $row['exterior_color_id'],
                $row['current_action_id'],
                $row['body_style_id'],
                $row['passengers'],
                $row['doors'],
                $row['name'],
                $row['grade'],
                $row['power'],
                $row['model_year'],
                $row['evaluation'],
                $row['running'],
                $row['cooling'],
                $row['note'],
                $row['fuel'],
                $row['chassis'],
                $row['dimensions_L'],
                $row['dimensions_W'],
                $row['dimensions_H'],
                $row['transmission_shift'],
                $row['id'],
                $row['is_public'],
                $row['is_used'],
                $row['is_two_weel'],
                $row['is_steering_right']
            );
            array_push($retuen_val,$car);
        }
        mysqli_free_result($result);
    }
    return $retuen_val;
}

function getMaxId($link){
    $retuen_val = 0;
    $sql2 = "SELECT MAX(id) as max FROM cars";

    if($result = mysqli_query($link, $sql2)){
        while($row = mysqli_fetch_array($result)){
            $retuen_val = $row['max'];
        }
        mysqli_free_result($result);
    }
    return $retuen_val;
}

function searchString($link,$val,$modulId,$makerId){
    $retuen_val = [];
    require_once "car_module.php";
    if(empty($a)){
        if(isset($modulId) && !isset($makerId)){
            $sql2 = "SELECT * FROM cars where model_id = $modulId";
        }else if(!isset($modulId) && isset($makerId)){
            $sql2 = "SELECT * FROM cars where maker_id = $makerId";
        }else if(isset($modulId) && isset($makerId)){
            $sql2 = "SELECT * FROM cars where model_id = $modulId and maker_id = $makerId";
        }else{
            $sql2 = "SELECT * FROM cars";
        }
    }else{
        if(isset($modulId) && !isset($makerId)){
            $sql2 = "SELECT * FROM cars where model_id = $modulId and name like '%$val%' or grade like '%$val%' or note like '%$val%'";
        }else if(!isset($modulId) && isset($makerId)){
            $sql2 = "SELECT * FROM cars where maker_id = $makerId and name like '%$val%' or grade like '%$val%' or note like '%$val%'";
        }else if(isset($modulId) && isset($makerId)){
            $sql2 = "SELECT * FROM cars where model_id = $modulId and maker_id = $makerId and name like '%$val%' or grade like '%$val%' or note like '%$val%'";
        }else{
            $sql2 = "SELECT * FROM cars";
        }
    }

    if($result = mysqli_query($link, $sql2)){
        while($row = mysqli_fetch_array($result)){
            $car = new Cars(
                $row['maker_id'],
                $row['model_id'],
                $row['interior_color_id'],
                $row['exterior_color_id'],
                $row['current_action_id'],
                $row['body_style_id'],
                $row['passengers'],
                $row['doors'],
                $row['name'],
                $row['grade'],
                $row['power'],
                $row['model_year'],
                $row['evaluation'],
                $row['running'],
                $row['cooling'],
                $row['note'],
                $row['fuel'],
                $row['chassis'],
                $row['dimensions_L'],
                $row['dimensions_W'],
                $row['dimensions_H'],
                $row['transmission_shift'],
                $row['id'],
                $row['is_public'],
                $row['is_used'],
                $row['is_two_weel'],
                $row['is_steering_right']
            );
            array_push($retuen_val,$car);
        }
        mysqli_free_result($result);
    }
    return $retuen_val;
}

?>
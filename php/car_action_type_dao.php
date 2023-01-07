<?php

function insertCarActionType($link,
    $name,
    $is_active
)
{
    $sql = "INSERT INTO car_action_type (name, is_active) VALUES ('$name','$is_active')";

    mysqli_query($link, $sql);
}

function getAllCarActionType($link){
    $retuen_val = [];
    require_once "car_action_type_module.php";
    $sql2 = "SELECT * FROM car_action_type";

    if($result = mysqli_query($link, $sql2)){
        while($row = mysqli_fetch_array($result)){
            $car = new CarActionType(
                $row['id'],
                $row['name'],
                $row['is_active']
            );
            array_push($retuen_val,$car);
        }
        mysqli_free_result($result);
    }
    return $retuen_val;
}

?>
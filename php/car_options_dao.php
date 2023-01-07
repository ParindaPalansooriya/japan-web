<?php

function insertCarOptions($link,
    $car_id,
    $option_id
)
{
    $sql = "INSERT INTO car_options (car_id, option_id) VALUES ('$car_id','$option_id')";

    mysqli_query($link, $sql);
}

function getAllCarOptions($link){
    $retuen_val = [];
    require_once "car_options_module.php";
    $sql2 = "SELECT * FROM car_options";

    if($result = mysqli_query($link, $sql2)){
        while($row = mysqli_fetch_array($result)){
            $car = new CarOptions(
                $row['id'],
                $row['car_id'],
                $row['option_id']
            );
            array_push($retuen_val,$car);
        }
        mysqli_free_result($result);
    }
    return $retuen_val;
}

?>
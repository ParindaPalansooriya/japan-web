<?php

function insertCarMaker($link,
    $image,
    $is_active,
    $name
)
{
    $sql = "INSERT INTO car_makers (name, image, is_active) VALUES (
    '$name',
    '$image',
    $is_active)";

    mysqli_query($link, $sql);
}

function getAllCarMakers($link){
    $retuen_val = [];
    require_once "car_makers_module.php";
    $sql2 = "SELECT * FROM car_makers";

    if($result = mysqli_query($link, $sql2)){
        while($row = mysqli_fetch_array($result)){
            $car = new CarMakers(
                $row['id'],
                $row['name'],
                $row['image'],
                $row['is_active']
            );
            array_push($retuen_val,$car);
        }
        mysqli_free_result($result);
    }
    return $retuen_val;
}

?>
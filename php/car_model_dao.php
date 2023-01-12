<?php

function insertCarModel($link,
    $image,
    $name
)
{
    $sql = "INSERT INTO car_model (name, image) VALUES ('$name','$image')";

    mysqli_query($link, $sql);
}

function getAllCarModels($link){
    $retuen_val = [];
    require_once "car_model_module.php";
    $sql2 = "SELECT * FROM car_model";

    if($result = mysqli_query($link, $sql2)){
        while($row = mysqli_fetch_array($result)){
            $car = new CarModel(
                $row['id'],
                $row['image'],
                $row['name']
            );
            array_push($retuen_val,$car);
        }
        mysqli_free_result($result);
    }
    return $retuen_val;
}

?>
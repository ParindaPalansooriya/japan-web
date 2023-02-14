<?php

function insertCarImagers($link,
    $image,
    $is_main,
    $car_id
)
{
    $myArray = explode('/', $image);
    try{
        // print_r(end($myArray));
        $sql0 = "DELETE FROM car_imagers WHERE car_id = $car_id && image = '".end($myArray)."'";
        mysqli_query($link, $sql0);
    }catch (Throwable $th) {
        console_log($th);
    }
    $sql = "INSERT INTO car_imagers (car_id, image, is_main) VALUES ($car_id,'".end($myArray)."',$is_main)";

    mysqli_query($link, $sql);
}

function deleteImage($link,$car_id,$image)
{
    $myArray = explode('/', $image);
    $sql = "DELETE FROM car_imagers WHERE car_id = $car_id && image = '".end($myArray)."'";
    return mysqli_query($link, $sql);
}

function getAllCarImagers($link,$car_id){
    $retuen_val = [];
    require_once "car_image_module.php";
    $sql2 = "SELECT * FROM car_imagers where car_id = ".$car_id;

    if($result = mysqli_query($link, $sql2)){
        while($row = mysqli_fetch_array($result)){
            $car = new CarImagers(
                $row['id'],
                $row['car_id'],
                $row['image'],
                $row['is_main']
            );
            array_push($retuen_val,$car);
        }
        mysqli_free_result($result);
    }
    return $retuen_val;
}

?>
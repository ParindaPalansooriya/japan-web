<?php

function insertCarImagers($link,
    $image,
    $is_main,
    $car_id
)
{
    $myArray = explode('/', $image);
    try{
        $sql0 = "DELETE FROM car_imagers WHERE car_id = $car_id && image = '".end($myArray)."'";
        mysqli_query($link, $sql0);
    }catch (Throwable $th) {
        console_log($th);
    }

    if(isset($type) && $type==1){
        $is_main=3;
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

function deleteAllImage($link,$car_id)
{
    $sql = "DELETE FROM car_imagers WHERE car_id = $car_id";
    return mysqli_query($link, $sql);
}

function getAllCarImagers($link,$car_id,$type){
    $retuen_val = [];
    require_once "car_image_module.php";

    if(session_status()!=2){
        ob_start();
        session_start();
    }

    if(isset($type) && $type==1){
        $sql2 = "SELECT * FROM car_imagers where car_id = ".$car_id;
    }else{
        $sql2 = "SELECT * FROM car_imagers where car_id = ".$car_id." AND is_main != 3";
    }

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
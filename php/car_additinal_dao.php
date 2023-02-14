<?php

function insertCarAdditinal($link,
        $car_id,
        $supplier,
        $perfecture,
        $bank
)
{
    $sql2 = "SELECT * FROM car_additinal where car_id = $car_id";
    if(mysqli_query($link, $sql2)){
        $sql = "INSERT INTO car_additinal (car_id, supplier, perfecture, bank) VALUES ($car_id,'$supplier','$perfecture','$bank')";
        return mysqli_query($link, $sql);
    }else{
        $sql3 = "UPDATE car_additinal SET supplier = $supplier , perfecture = $perfecture, bank = $bank WHERE car_id = $car_id ;";
        return mysqli_query($link, $sql3);
    }
}

function updateCarAdditinal($link,$car_id,$supplier,$perfecture,$bank){
    $sql2 = "UPDATE car_additinal SET supplier = $supplier , perfecture = $perfecture, bank = $bank WHERE car_id = $car_id ;";
    return mysqli_query($link, $sql2);
}

function getCarAdditinal($link,$carId){
    $retuen_val = null;
    require_once "car_additinal_module.php";
    $sql2 = "SELECT * FROM car_additinal where car_id = $carId";

    if($result = mysqli_query($link, $sql2)){
        while($row = mysqli_fetch_array($result)){
            $retuen_val = new CarAdditinal(
                $row['car_id'],
                $row['supplier'],
                $row['perfecture'],
                $row['bank']

            );
        }
        mysqli_free_result($result);
    }
    return $retuen_val;
}

?>
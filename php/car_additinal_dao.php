<?php

function insertCarAdditinal($link,
        $car_id,
        $supplier,
        $perfecture,
        $bank
)
{
    try{
        $sql0 = "DELETE FROM car_additinal WHERE car_id = $car_id";
        mysqli_query($link, $sql0);
    }catch (Throwable $th) {
        console_log($th);
    }

    $sql = "INSERT INTO car_additinal (car_id, supplier, perfecture, bank) VALUES ($car_id,'$supplier','$perfecture','$bank')";
    
    return mysqli_query($link, $sql);

    // $sql2 = "SELECT * FROM car_additinal where car_id = $car_id";
    // if(mysqli_query($link, $sql2)){
        
    // }else{
    //     $sql3 = "UPDATE car_additinal SET supplier = $supplier , perfecture = $perfecture, bank = $bank WHERE car_id = $car_id ;";
    //     return mysqli_query($link, $sql3);
    // }
}

function deleteAddition($link,$car_id)
{
    $sql = "DELETE FROM car_additinal WHERE car_id = $car_id";
    return mysqli_query($link, $sql);
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
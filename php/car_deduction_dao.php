<?php

function insertCarDeduction($link,
    $car_id, 
    $rtax, 
    $atax, 
    $au_cha,
    $trasport,
    $storage,
    $insurance,
    $repair,
    $other,
    $with_tax,
    $recycle
)
{
    $sql2 = "SELECT * FROM car_deductions where car_id = $car_id";
    if(mysqli_query($link, $sql2)){
        $sql = "INSERT INTO car_deductions (
            car_id, 
            rtax, 
            atax, 
            au_cha, 
            trasport, 
            storage, 
            insurance, 
            repair, 
            other,
            with_tax,
            recycle
            ) VALUES (
                $car_id,
                '$rtax',
                '$atax',
                '$au_cha',
                '$trasport',
                '$storage',
                '$insurance',
                '$repair',
                '$other',
                '$with_tax',
                '$recycle'
                )";
        return mysqli_query($link, $sql);
    }else{
        $sql3 = "UPDATE car_deductions SET 
        rtax = '$rtax' , 
        atax = '$atax' , 
        au_cha = '$au_cha' , 
        trasport = '$trasport' , 
        storage = '$storage' , 
        insurance = '$insurance' , 
        repair = '$repair' , 
        other = '$other' ,
        with_tax = '$with_tax' , 
        recycle = '$recycle' 
        WHERE car_id = $car_id ;";
        return mysqli_query($link, $sql3);
    }
}

function getCarDeduction($link,$carId){
    $retuen_val = null;
    require_once "car_deduction_module.php";
    $sql2 = "SELECT * FROM car_deductions where car_id = $carId";

    if($result = mysqli_query($link, $sql2)){
        while($row = mysqli_fetch_array($result)){
            $retuen_val = new CarDeduction(
                $row['car_id'],
                $row['rtax'],
                $row['atax'],
                $row['au_cha'],
                $row['trasport'],
                $row['storage'],
                $row['insurance'],
                $row['repair'],
                $row['other'],
                $row['with_tax'],
                $row['recycle']
            );
        }
        mysqli_free_result($result);
    }
    return $retuen_val;
}

?>
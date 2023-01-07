<?php

function insertCarPrice($link,
        $car_id,
        $buying,
        $selling,
        $public,
        $price1,
        $price2
)
{
    $sql = "INSERT INTO car_price (car_id, buying, selling, public, price1, price2) VALUES ('$car_id','$buying','$selling','$public','$price1','$price2')";

    mysqli_query($link, $sql);
}

function getAllCarPrice($link){
    $retuen_val = [];
    require_once "car_price_module.php";
    $sql2 = "SELECT * FROM car_price";

    if($result = mysqli_query($link, $sql2)){
        while($row = mysqli_fetch_array($result)){
            $car = new CarPrice(
                $row['car_id'],
                $row['buying'],
                $row['selling'],
                $row['public'],
                $row['price1'],
                $row['price2']
            );
            array_push($retuen_val,$car);
        }
        mysqli_free_result($result);
    }
    return $retuen_val;
}

?>
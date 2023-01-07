<?php

function insertOptions($link,
    $name
)
{
    $sql = "INSERT INTO options (name) VALUES ('$name')";

    mysqli_query($link, $sql);
}

function getAllOptions($link){
    $retuen_val = [];
    require_once "options_module.php";
    $sql2 = "SELECT * FROM options";

    if($result = mysqli_query($link, $sql2)){
        while($row = mysqli_fetch_array($result)){
            $car = new Options(
                $row['id'],
                $row['name']
            );
            array_push($retuen_val,$car);
        }
        mysqli_free_result($result);
    }
    return $retuen_val;
}

?>
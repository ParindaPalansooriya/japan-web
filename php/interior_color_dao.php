<?php

function insertInteriorColor($link,
        $id,
        $name,
        $code,
        $hex_code
)
{
    $sql = "INSERT INTO interior_color (id, name, code, hex_code) VALUES ('$id','$name','$code','$hex_code')";

    mysqli_query($link, $sql);
}

function getAllInteriorColor($link){
    $retuen_val = [];
    require_once "interior_color_module.php";
    $sql2 = "SELECT * FROM interior_color";

    if($result = mysqli_query($link, $sql2)){
        while($row = mysqli_fetch_array($result)){
            $car = new InteriorColor(
                $row['id'],
                $row['name'],
                $row['code'],
                $row['hex_code']
                
            );
            array_push($retuen_val,$car);
        }
        mysqli_free_result($result);
    }
    return $retuen_val;
}

?>
<?php

function insertBodyStyle($link,
    $name,
    $image
)
{
    $sql = "INSERT INTO body_style (name, image) VALUES ('$name','$image')";

    mysqli_query($link, $sql);
}

function getAllBodyStyle($link){
    $retuen_val = [];
    require_once "body_style_module.php";
    $sql2 = "SELECT * FROM body_style";

    if($result = mysqli_query($link, $sql2)){
        while($row = mysqli_fetch_array($result)){
            $car = new BodyStyle(
                $row['id'],
                $row['name'],
                $row['image']
            );
            array_push($retuen_val,$car);
        }
        mysqli_free_result($result);
    }
    return $retuen_val;
}

?>
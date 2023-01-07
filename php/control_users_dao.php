<?php

function insertControlUsers($link,
        $id,
        $user_name,
        $password,
        $user_type,
        $is_active
)
{
    $sql = "INSERT INTO user_inquary (id, user_name, password, user_type, is_active) VALUES ('$id','$user_name','$password','$user_type','$is_active')";

    mysqli_query($link, $sql);
}

function getAllControlUsers($link){
    $retuen_val = [];
    require_once "control_users_module.php";
    $sql2 = "SELECT * FROM control_users";

    if($result = mysqli_query($link, $sql2)){
        while($row = mysqli_fetch_array($result)){
            $car = new ControlUsers(
                $row['id'],
                $row['user_name'],
                $row['password'],
                $row['user_type'],
                $row['is_active']
            );
            array_push($retuen_val,$car);
        }
        mysqli_free_result($result);
    }
    return $retuen_val;
}

?>
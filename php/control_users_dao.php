<?php

function insertControlUsers($link,
        $id,
        $user_name,
        $password,
        $user_type,
        $is_active
)
{

    if(!empty(getAllControlUsersByUserName($link,$user_name))){
        return -2;
    }

    $sql = "INSERT INTO control_users (id, username, password1, user_type, is_active) VALUES ('$id','$user_name','$password','$user_type','$is_active')";

    return mysqli_query($link, $sql);
}

function getAllControlUsers($link){
    $retuen_val = [];
    require_once "control_users_module.php";
    $sql2 = "SELECT * FROM control_users";

    if($result = mysqli_query($link, $sql2)){
        while($row = mysqli_fetch_array($result)){
            $car = new ControlUsers(
                $row['id'],
                $row['username'],
                $row['password1'],
                $row['user_type'],
                $row['is_active']
            );
            array_push($retuen_val,$car);
        }
        mysqli_free_result($result);
    }
    return $retuen_val;
}

function getAllControlUsersByUserName($link,$userName){
    $retuen_val = [];
    require_once "control_users_module.php";
    $sql2 = "SELECT * FROM control_users where username = '$userName'";

    if($result = mysqli_query($link, $sql2)){
        while($row = mysqli_fetch_array($result)){
            $car = new ControlUsers(
                $row['id'],
                $row['username'],
                $row['password1'],
                $row['user_type'],
                $row['is_active']
            );
            array_push($retuen_val,$car);
        }
        mysqli_free_result($result);
    }
    return $retuen_val;
}

function updateUserStatus($link,$id,$action){
    $sql2 = "UPDATE control_users SET is_active = $action WHERE id = $id ;";
    return mysqli_query($link, $sql2);
}

function getlogin($link,$userName, $password){
    $retuen_val = null;
    require_once "control_users_module.php";
    $sql2 = "SELECT * FROM control_users where username = '$userName' and password1 = '$password'";

    if($result = mysqli_query($link, $sql2)){
        while($row = mysqli_fetch_array($result)){
            $retuen_val = new ControlUsers(
                $row['id'],
                $row['username'],
                $row['password1'],
                $row['user_type'],
                $row['is_active']
            );
        }
        mysqli_free_result($result);
    }
    return $retuen_val;
}

?>
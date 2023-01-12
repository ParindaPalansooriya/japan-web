<?php

function insertUserInquary($link,
        $car_id,
        $user_name,
        $email,
        $mobile,
        $nearest_port,
        $message
)
{
    $sql = "INSERT INTO user_inquary (car_id, username, email, mobile, nearest_port, message) VALUES ($car_id,'$user_name','$email','$mobile','$nearest_port','$message')";
    return mysqli_query($link, $sql);
}

function insertUserSellingInquary($link,
        $car_id,
        $user_name,
        $email,
        $mobile
)
{
    $sql = "INSERT INTO user_inquary (car_id,type, username, email, mobile) VALUES ($car_id,1,'$user_name','$email','$mobile')";
    return mysqli_query($link, $sql);
}

function updateInuaryStatus($link,$id,$action){
    $sql2 = "UPDATE user_inquary SET status = $action WHERE id = $id ;";
    return mysqli_query($link, $sql2);
}

function deleteUserInueary($link,$id)
{
    $sql = "DELETE FROM user_inquary WHERE id = $id";
    return mysqli_query($link, $sql);
}

function getAllUserInquary($link){
    $retuen_val = [];
    require_once "user_inquary_module.php";
    $sql2 = "SELECT * FROM user_inquary";

    if($result = mysqli_query($link, $sql2)){
        while($row = mysqli_fetch_array($result)){
            $car = new UserInquary(
                $row['id'],
                $row['car_id'],
                $row['username'],
                $row['email'],
                $row['mobile'],
                $row['nearest_port'],
                $row['message']

            );
            array_push($retuen_val,$car);
        }
        mysqli_free_result($result);
    }
    return $retuen_val;
}

function getUserInquary($link,$carId){
    $retuen_val = null;
    require_once "user_inquary_module.php";
    $sql2 = "SELECT * FROM user_inquary where car_id = $carId";

    if($result = mysqli_query($link, $sql2)){
        while($row = mysqli_fetch_array($result)){
            $retuen_val = new UserInquary(
                $row['id'],
                $row['car_id'],
                $row['username'],
                $row['email'],
                $row['mobile'],
                $row['nearest_port'],
                $row['message']

            );
        }
        mysqli_free_result($result);
    }
    return $retuen_val;
}

function getUserInquaryById($link,$id){
    $retuen_val = null;
    require_once "user_inquary_module.php";
    $sql2 = "SELECT * FROM user_inquary where id = $id";

    if($result = mysqli_query($link, $sql2)){
        while($row = mysqli_fetch_array($result)){
            $retuen_val = new UserInquary(
                $row['id'],
                $row['car_id'],
                $row['username'],
                $row['email'],
                $row['mobile'],
                $row['nearest_port'],
                $row['message']

            );
        }
        mysqli_free_result($result);
    }
    return $retuen_val;
}
?>
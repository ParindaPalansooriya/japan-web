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
    $sql = "INSERT INTO user_inquary (car_id, user_name, email, mobile, nearest_port, message) VALUES ('$car_id','$user_name','$email','$nearest_port','$message')";

    mysqli_query($link, $sql);
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
                $row['user_name'],
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

?>
<?php

function insertUserDaySubmits($link,
        $user_id,
        $date,
        $time,
        $sales_name,
        $note
)
{
    try{
        $sql = "INSERT INTO user_day_submits (user_id, date, time, sales_name, note, type ) VALUES ($user_id,'$date','$time','$sales_name','$note',0)";
        echo $sql;
    return mysqli_query($link, $sql);
    }catch(Throwable $tt){
        echo $tt;
    }
}

function insertUserSubmits($link,
        $user_id,
        $date,
        $time,
        $sales_name,
        $note,
        $customer_name,
        $customer_contact
)
{
    $sql = "INSERT INTO user_day_submits (user_id, date, time, sales_name, note, type, customer_name, customer_contact ) 
    VALUES ($user_id,'$date','$time','$sales_name','$note',1,'$customer_name','$customer_contact')";

    return mysqli_query($link, $sql);
}

function getAllUserSubmits($link){
    $retuen_val = [];
    require_once "user_submits_module.php";
    $sql2 = "SELECT * FROM user_day_submits";

    if($result = mysqli_query($link, $sql2)){
        while($row = mysqli_fetch_array($result)){
            $car = new UserSubmits(
                $row['id'],
                $row['user_id'],
                $row['date'],
                $row['time'],
                $row['sales_name'],
                $row['customer_name'],
                $row['customer_contact'],
                $row['note']
            );
            array_push($retuen_val,$car);
        }
        mysqli_free_result($result);
    }
    return $retuen_val;
}

function getAllUserSubmitsWithDate($link,$date,$userId){
    $retuen_val = [];
    require_once "user_submits_module.php";
    if(isset($userId)){
        $sql2 = "SELECT * FROM user_day_submits WHERE type=1 AND date like '$date%' AND user_id = $userId";
    }else{
        $sql2 = "SELECT * FROM user_day_submits WHERE type=1 AND date like '$date%' ";
    }
    
    if($result = mysqli_query($link, $sql2)){
        while($row = mysqli_fetch_array($result)){
            $car = new UserSubmits(
                $row['id'],
                $row['user_id'],
                $row['date'],
                $row['time'],
                $row['sales_name'],
                $row['customer_name'],
                $row['customer_contact'],
                $row['note']
            );
            array_push($retuen_val,$car);
        }
        mysqli_free_result($result);
    }
    return $retuen_val;
}

function getAllUserDaySubmitsWithDate($link,$date,$userId){
    $retuen_val = [];
    require_once "user_submits_module.php";
    if(isset($userId)){
        $sql2 = "SELECT * FROM user_day_submits WHERE type=0 AND date like '$date%' AND user_id = $userId";
    }else{
        $sql2 = "SELECT * FROM user_day_submits WHERE type=0 AND date like '$date%' ";
    }
    
    if($result = mysqli_query($link, $sql2)){
        while($row = mysqli_fetch_array($result)){
            $car = new UserSubmits(
                $row['id'],
                $row['user_id'],
                $row['date'],
                $row['time'],
                $row['sales_name'],
                $row['customer_name'],
                $row['customer_contact'],
                $row['note']
            );
            array_push($retuen_val,$car);
        }
        mysqli_free_result($result);
    }
    return $retuen_val;
}

?>
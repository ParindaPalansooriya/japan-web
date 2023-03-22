<?php

function insertCustomer($link,
        $chassis,
        $name,
        $contact_num1,
        $contact_num2,
        $address,
        $bday,
        $valid
)
{
    $sql = "INSERT INTO customers (chassis,name, contact_num1, contact_num2, bday ,address,valid) VALUES ('$chassis','$name','$contact_num1','$contact_num2','$bday','$address','$valid')";
    return mysqli_query($link, $sql);
}

function getAllCustomers($link, $date, $name, $removeUniqe){
    $retuen_val = [];
    require_once "customer_module.php";
    if(isset($date) && !empty($date)){
        $sql2 = "SELECT * FROM customers where bday like '%$date%'".($name!==null?" and name like '%$name%'":"");
    }else{
        $sql2 = "SELECT * FROM customers".($name!==null?" where name like '%$name%'":"").($removeUniqe!==null && $removeUniqe?" group by name,address":"");
    }

    if($result = mysqli_query($link, $sql2)){
        while($row = mysqli_fetch_array($result)){
            $car = new Customer(
                $row['id'],
                $row['name'],
                $row['contact_num1'],
                $row['contact_num2'],
                $row['bday'],
                $row['address'],
                $row['valid'],
                $row['last_send_date'],
                $row['chassis']
            );
            array_push($retuen_val,$car);
        }
        mysqli_free_result($result);
    }
    return $retuen_val;
}

function getAllCustomersToSendPostCard($link){
    $retuen_val = [];
    require_once "customer_module.php";
    $sql2 = "SELECT * , DATE_ADD(bday, INTERVAL valid MONTH) as next 
    FROM customers where DATEDIFF(DATE_ADD(bday, INTERVAL valid MONTH),CURRENT_DATE())<=14";

    if($result = mysqli_query($link, $sql2)){
        while($row = mysqli_fetch_array($result)){
            $car = new Customer(
                $row['id'],
                $row['name'],
                $row['contact_num1'],
                $row['contact_num2'],
                $row['bday'],
                $row['address'],
                $row['valid'],
                $row['last_send_date'],
                $row['chassis']
            );
            array_push($retuen_val,$car);
        }
        mysqli_free_result($result);
    }
    return $retuen_val;
}




function getCustomersById($link, $id){
    $retuen_val = null;
    require_once "customer_module.php";
    $sql2 = "SELECT * FROM customers where id = $id";
    if($result = mysqli_query($link, $sql2)){
        while($row = mysqli_fetch_array($result)){
            $retuen_val = new Customer(
                $row['id'],
                $row['name'],
                $row['contact_num1'],
                $row['contact_num2'],
                $row['bday'],
                $row['address'],
                $row['valid'],
                $row['last_send_date'],
                $row['chassis']
            );
        }
        mysqli_free_result($result);
    }
    return $retuen_val;
}

function updateLastSendDate($link,$id){
    $sql = "UPDATE customers SET last_send_date = CURDATE() WHERE id = $id ;";
    return mysqli_query($link, $sql);
}

function updateLastSackanDate($link,$id,$date){
    if($date!==null){
        $sql = "UPDATE customers SET bday = $date WHERE id = $id ;";
    }else{
        $sql = "UPDATE customers SET bday = CURDATE() WHERE id = $id ;";
    }
    return mysqli_query($link, $sql);
}

function updateValide($link,$id,$valid){
    $sql = "UPDATE customers SET valid = $valid WHERE id = $id ;";
    return mysqli_query($link, $sql);
}

?>
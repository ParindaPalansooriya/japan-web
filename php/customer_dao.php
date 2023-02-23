<?php

function insertCustomer($link,
        $name,
        $contact_num1,
        $contact_num2,
        $address,
        $bday
)
{
    $sql = "INSERT INTO customers (name, contact_num1, contact_num2, bday ,address) VALUES ('$name','$contact_num1','$contact_num2','$bday','$address')";

    return mysqli_query($link, $sql);
}

function getAllCustomers($link, $date){
    $retuen_val = [];
    require_once "customer_module.php";
    if(isset($date) && !empty($date)){
        $sql2 = "SELECT * FROM customers where bday like '%$date%'";
    }else{
        $sql2 = "SELECT * FROM customers";
    }

    if($result = mysqli_query($link, $sql2)){
        while($row = mysqli_fetch_array($result)){
            $car = new Customer(
                $row['id'],
                $row['name'],
                $row['contact_num1'],
                $row['contact_num2'],
                $row['bday'],
                $row['address']
            );
            array_push($retuen_val,$car);
        }
        mysqli_free_result($result);
    }
    return $retuen_val;
}

// function getlogin($link,$userName, $password){
//     $retuen_val = null;
//     require_once "control_users_module.php";
//     $sql2 = "SELECT * FROM control_users where username = '$userName' and password1 = '$password'";

//     if($result = mysqli_query($link, $sql2)){
//         while($row = mysqli_fetch_array($result)){
//             $retuen_val = new ControlUsers(
//                 $row['id'],
//                 $row['username'],
//                 $row['password1'],
//                 $row['user_type'],
//                 $row['is_active']
//             );
//         }
//         mysqli_free_result($result);
//     }
//     return $retuen_val;
// }

?>
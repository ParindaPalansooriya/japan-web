<?php

function insertUserInquary($link,
    $username,
    $contact1, 
    $contact2, 
    $message
)
{
    $sql = "INSERT INTO contact_us (username, contact1, contact2, message) VALUES ($username,'$contact1','$contact2','$message')";
    return mysqli_query($link, $sql);
}

function updateContactUsStatus($link,$id,$action){
    $sql2 = "UPDATE contact_us SET status = $action WHERE id = $id ;";
    return mysqli_query($link, $sql2);
}

function deleteContactUsInueary($link,$id)
{
    $sql = "DELETE FROM contact_us WHERE id = $id";
    return mysqli_query($link, $sql);
}

function getAllContactUs($link){
    $retuen_val = [];
    require_once "contat_us_module.php";
    $sql2 = "SELECT * FROM contact_us";

    if($result = mysqli_query($link, $sql2)){
        while($row = mysqli_fetch_array($result)){
            $car = new ContactUs(
                $row['id'],
                $row['username'],
                $row['contact1'],
                $row['contact2'],
                $row['message'],
                $row['status']
            );
            array_push($retuen_val,$car);
        }
        mysqli_free_result($result);
    }
    return $retuen_val;
}

function getContactUs($link,$id){
    $retuen_val = null;
    require_once "contat_us_module.php";
    $sql2 = "SELECT * FROM contact_us where id = $id";

    if($result = mysqli_query($link, $sql2)){
        while($row = mysqli_fetch_array($result)){
            $retuen_val = new ContactUs(
                $row['id'],
                $row['username'],
                $row['contact1'],
                $row['contact2'],
                $row['message'],
                $row['status']
            );
        }
        mysqli_free_result($result);
    }
    return $retuen_val;
}
?>
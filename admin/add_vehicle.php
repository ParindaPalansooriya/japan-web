<?php

ob_start();
session_start();

$id = $_SESSION['id'];
$type = $_SESSION['type'];

if(!isset($id) || !isset($_SESSION['timeout']) || ($_SESSION['timeout']+(60*30)) < time()){
    header("Location: login.php"); 
}else{
    $_SESSION['timeout'] = time();
}


require_once('../php/config.php');
require_once('../php/car_makers_dao.php');
require_once('../php/car_model_dao.php');
require_once('../php/body_style_dao.php');
require_once('../php/interior_color_dao.php');
require_once('../php/exterior_color_dao.php');
require_once('../php/car_dao.php');
require_once('../php/car_image_dao.php');
require_once('../php/car_additinal_dao.php');
require_once('../php/car_deduction_dao.php');

$carId = null;
$car = null;
$filepath = array();

if(isset($_REQUEST['carId']) && !empty($_REQUEST['carId'])){
    $carId = $_REQUEST['carId'];
    $car = getCarsForReport($link,$carId);
    if(isset($car)){
        $carImagersList = getAllCarImagers($link,$carId);
        if(isset($carImagersList) && !empty($carImagersList)){
            foreach ($carImagersList as $key => $value) {
                if(!in_array("../images/cars/".$value->getImage(),$filepath)){
                    array_push($filepath,"../images/cars/".$value->getImage());
                }
            }
        }
        $carImagersList = null;
    }
}

$style = getAllBodyStyle($link);
$in_cor = getAllInteriorColor($link);
$ex_cor = getAllExteriorColor($link);
$maker = getAllCarMakers($link);

if(isset($_REQUEST['filepath'])){
    $filepath = $_REQUEST['filepath'];
}
if(isset($_POST['Submit1']))
{ 
    foreach($_FILES["files"]["tmp_name"] as $key=>$tmp_name) {
        $file_name=$_FILES["files"]["name"][$key];
        $file_tmp=$_FILES["files"]["tmp_name"][$key];
        $filepathTemp = "../images/cars/".microtime_float().$file_name;
        if(move_uploaded_file($_FILES["files"]["tmp_name"][$key], $filepathTemp)) 
        {
            array_push($filepath,$filepathTemp);
        } 
    }
} 

function microtime_float()
{
    list($usec, $sec) = explode(" ", microtime());
    return ((float)$usec + (float)$sec);
}


if(isset($_POST['Delete']))
{ 
    $filepath = $_REQUEST['filepath'];
    $filepathTemp = $_REQUEST['file_name'];
    $pos = array_search($filepathTemp, $filepath,true);
    if ($pos !== false) {
        if (file_exists($filepath[$pos])) {
            unlink($filepath[$pos]);
         }
         if(isset($carId)){
            deleteImage($link,$carId,$filepath[$pos]);
         }
        array_splice($filepath,$pos,1);
    }
}

if(isset($_POST['Submit']))
{ 
    require_once('../php/car_dao.php');
    require_once('../php/car_image_dao.php');
    require_once('../php/car_price_dao.php');
    require_once('../php/user_inquary_dao.php');
    require_once('../php/car_additinal_dao.php');
    require_once('../php/car_deduction_dao.php');

    if(isset($carId)){
        $maxId = insertCarFullWithId($link,$carId,
            $_REQUEST['maker_id'],
            1,
            1,
            1,
            0,
            $_REQUEST['body_style_id'],
            $_REQUEST['passengers'],
            $_REQUEST['doors'],
            $_REQUEST['name'],
            $_REQUEST['grade'],
            $_REQUEST['power'],
            $_REQUEST['model_year'],
            $_REQUEST['evaluation'],
            $_REQUEST['running'],
            $_REQUEST['cooling'],
            $_REQUEST['note'],
            $_REQUEST['fuel'],
            $_REQUEST['chassis'],
            $_REQUEST['dimensions_L'],
            $_REQUEST['dimensions_W'],
            $_REQUEST['dimensions_H'],
            $_REQUEST['transmission_shift'],
            $_REQUEST['is_used'],
            $_REQUEST['is_two_weel'],
            $_REQUEST['is_steering_right'],
            $_REQUEST['in_col'],
            $_REQUEST['ex_col']
            );
    }else{
        $maxId = insertCarFull($link,
            $_REQUEST['maker_id'],
            1,
            1,
            1,
            0,
            $_REQUEST['body_style_id'],
            $_REQUEST['passengers'],
            $_REQUEST['doors'],
            $_REQUEST['name'],
            $_REQUEST['grade'],
            $_REQUEST['power'],
            $_REQUEST['model_year'],
            $_REQUEST['evaluation'],
            $_REQUEST['running'],
            $_REQUEST['cooling'],
            $_REQUEST['note'],
            $_REQUEST['fuel'],
            $_REQUEST['chassis'],
            $_REQUEST['dimensions_L'],
            $_REQUEST['dimensions_W'],
            $_REQUEST['dimensions_H'],
            $_REQUEST['transmission_shift'],
            $_REQUEST['is_used'],
            $_REQUEST['is_two_weel'],
            $_REQUEST['is_steering_right'],
            $_REQUEST['in_col'],
            $_REQUEST['ex_col']
            );
    }
    if($maxId>0){
        if(isset($filepath)){
            foreach ($filepath as $key2 => $value1) {
                insertCarImagers($link,$value1,$key2!=0?0:1,$maxId);
            }
        }
        insertCarPrice($link,$maxId,$_REQUEST['buy'],$_REQUEST['sell'],$_REQUEST['public'],0,0);
        if($type==1){
            insertCarAdditinal($link,$maxId,$_REQUEST['supplier'],$_REQUEST['per'],$_REQUEST['bank']);
            insertCarDeduction($link,$maxId,$_REQUEST['rtax'],$_REQUEST['auto_t'],$_REQUEST['au']
            ,$_REQUEST['trans'],$_REQUEST['storage'],$_REQUEST['insu'],$_REQUEST['repair'],$_REQUEST['other'],
            $_REQUEST['with_tax'],$_REQUEST['recycle']);
        }
        $filepath=array();
        echo '<script>alert("Vehicle Successfully inserted")</script>';
    }else{
        echo '<script>alert("Vehicle Not inserted")</script>';
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <!-- Basic -->
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <!-- Site Metas -->
    <meta name="keywords" content="" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <link rel="shortcut icon" href="../images/logo.png" type="">
    <title>Vehicle seller page</title>
    <!-- bootstrap core css -->
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.css" />
    <!-- font awesome style -->
    <link href="../css/font-awesome.min.css" rel="stylesheet" />
    <!-- Custom styles for this template -->
    <link href="../css/style.css" rel="stylesheet" />
    <!-- responsive style -->
    <link href="../css/responsive.css" rel="stylesheet" />
</head>

<style>
    /*  button section   */
    * {
        box-sizing: border-box;
    }
    .button_search {
        border: 3px solid orange;
        border-radius: 5px;
        background-color: orange;
        color: white;

    }
    .bttn {
        border: 3px solid black;
        border-radius: 10px;
        background-color: white;
        color: black;
        padding: 8px 28px;
        font-size: 16px;
        font-weight: 800;

    }
    .bttn2 {
        border: 3px solid orange;
        border-radius: 10px;
        background-color: orange;
        color: white;
        padding: 8px 28px;
        font-size: 16px;
        font-weight: 800;

    }
    .delete {
        border: 3px solid white;
        border-radius: 10px;
        background-color: white;
        color: white;
        padding: 0;
        height: 20px;
    }
    .Bu_one {
        border-color: #04AA6D;
        color: green;
    }

    .Bu_two {
        border-color: #ff9800;
        color: orange;
    }

    .Bu_three {
        border-color: #f44336;
        color: red
    }
    .Bu_border {
        border-color: #ffad06;
        color: #ffc000
    }

    /* end button section   */
    * {
        box-sizing: border-box;
    }
    body {
        margin: 0;
    }
    .container-width{
        width:90%;
        max-width:1150px;
        margin:0 auto;
    }
    .am-sect{
        padding-top:100px;
        padding-bottom:100px;
        font-family:Helvetica, serif;
    }
    #i3xfj{
        border:0 solid black;
    }
    .gjs-row{
        display:flex;
        justify-content:flex-start;
        align-items:stretch;
        flex-wrap:nowrap;
        padding:10px;
    }
    .gjs-cell{
        min-height:250px;
        flex-grow:1;
        flex-basis:100%;
    }
    #i91j{
        flex-basis:250px;

    }
    #i88c{
        flex-basis:250px;
    }
    #i14q{
        height:90%;
    }
    @keyframes fadeEffect{
        from{
            opacity:0;
        }
        to{
            opacity:1;
        }
    }
    @media (max-width: 768px){
        .gjs-row{
            flex-wrap:wrap;
        }
    }
/* image grid container */
    .grid-container {
        display: grid;
        grid-template-columns: auto auto ;
        background-color: #ffffff;
        padding: 10px;
    }
    .grid-item {
        padding: 0px;
        font-size: 30px;
        text-align: center;

    }
    /* End image grid container */

    /*  header class divide css code   */
    * {
        box-sizing: border-box;
    }
    body {
        margin: 0;

    }
    .gjs-row{
        display:flex;
        justify-content:flex-start;
        align-items:stretch;
        flex-wrap:nowrap;
        padding:10px;

    }
    .gjs-cell{
        min-height:75px;
        flex-grow:1;
        flex-basis:100%;
    }
    @media (max-width: 768px){
        .gjs-row{
            flex-wrap:wrap;
        }
    }
    /*  end header class divide css code   */
#btnStart {
  position: fixed;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
}

#message {
  width: 200px;
  height: 100px;
  position: absolute;
  top: 0;
  right: 0;
  bottom: 0;
  left: 0;
  color: #fff;
  margin: auto;
  text-align: center;
  display: none;
}
</style>

<body class="sub_page">

<!-- box with filter section -->
<body class="animsition">
<section class="bg0 p-t-23 p-b-140">
    <div class="container-width">
        <form id="formSubmit" action="add_vehicle.php" enctype="multipart/form-data" method="post">

        <div id="i14q" class="gjs-row">
            <div id="i91j" class="gjs-cell">
                <h5>Vehicle Details</h5>
                <div >
                <label for="awesomeness" style="font-size:0.8em; color:#f44336" class="col-sm-6 col-form-label">
                                <?php echo isset($filepath) && !empty($filepath) ? "":"Please Upload Images First" ?></label>
                    <div class="box" style="display: <?php echo isset($filepath) && !empty($filepath) ? "block":"none" ?>;" >
                    <form id="formAwesome" action="add_vehicle.php" enctype="multipart/form-data" method="post">
                            <div class="modal-body">
                            <input type="hidden" id="carId" name="carId" value="<?php echo $carId;?>">
                            <div class="form-group row">
                                <label for="awesomeness" style="font-size:0.8em" class="col-sm-6 col-form-label">
                                Maker</label>
                                <div class="col-sm-6">
                                <select class="form-control" name="maker_id" id="awesomeness" style="font-size:0.8em">
                                    <?php 
                                    if(isset($maker)){
                                        foreach ($maker as $key => $value) {
                                            ?><option value="<?php echo $value->getId() ?>" <?php echo $car !== null && ($car->getMaker_id())==($value->getId())? "selected":"" ;?>><?php echo $value->getName() ?></option><?php
                                        }
                                    }
                                    ?>
                                </select>
                                </div>
                            </div>
                            <!-- <div class="form-group row">
                                <label for="awesomeness" style="font-size:0.8em" class="col-sm-6 col-form-label">
                                Interior Color</label>
                                <div class="col-sm-6">
                                <select class="form-control" name="interior_color_id" id="awesomeness" style="font-size:0.8em">
                                    <?php 
                                    if(isset($in_cor)){
                                        foreach ($in_cor as $key => $value) {
                                            ?><option value="<?php echo $value->getId() ?>" <?php echo $car !== null && ($car->getInterior_color_id())==($value->getId())? "selected":"" ;?>><?php echo $value->getName() ?></option><?php
                                        }
                                    }
                                    ?>
                                </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="awesomeness" style="font-size:0.8em" class="col-sm-6 col-form-label">
                                Exterior Color</label>
                                <div class="col-sm-6">
                                <select class="form-control" name="exterior_color_id" id="awesomeness" style="font-size:0.8em">
                                    <?php 
                                    if(isset($ex_cor)){
                                        foreach ($ex_cor as $key => $value) {
                                            ?><option value="<?php echo $value->getId() ?>" <?php echo $car !== null && ($car->getExterior_color_id())==($value->getId())? "selected":"" ;?>><?php echo $value->getName() ?></option><?php
                                        }
                                    }
                                    ?>
                                </select>
                                </div>
                            </div> -->
                            <div class="form-group row">
                                <label for="awesomeness" style="font-size:0.8em" class="col-sm-6 col-form-label">
                                Body Style</label>
                                <div class="col-sm-6">
                                <select class="form-control" name="body_style_id" id="awesomeness" style="font-size:0.8em">
                                    <?php 
                                    if(isset($style)){
                                        foreach ($style as $key => $value) {
                                            ?><option value="<?php echo $value->getId() ?>" <?php echo $car !== null && ($car->getBody_style_id())==($value->getId())? "selected":"" ;?>><?php echo $value->getName() ?></option><?php
                                        }
                                    }
                                    ?>
                                </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="awesomeness" style="font-size:0.8em" class="col-sm-6 col-form-label">
                                Fual</label>
                                <div class="col-sm-6">
                                <select class="form-control" name="fuel" id="awesomeness" style="font-size:0.8em">
                                    <option value="gasoline" <?php echo $car !== null && $car->getFuel()=="gasoline"? "selected":"" ;?>>gasoline</option>
                                    <option value="diesel" <?php echo $car !== null && $car->getFuel()=="diesel"? "selected":"" ;?>>diesel</option>
                                    <option value="Hybrid" <?php echo $car !== null && $car->getFuel()=="Hybrid"? "selected":"" ;?>>Hybrid</option>
                                    <option value="Electric" <?php echo $car !== null && $car->getFuel()=="Electric"? "selected":"" ;?>>Electric</option>
                                    <option value="Hydrogen" <?php echo $car !== null && $car->getFuel()=="Hydrogen"? "selected":"" ;?>>Hydrogen</option>
                                </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="awesomeness" style="font-size:0.8em" class="col-sm-6 col-form-label">
                                doors</label>
                                <div class="col-sm-6">
                                <select class="form-control" name="doors" id="awesomeness" style="font-size:0.8em">
                                    <option value="0" <?php echo $car !== null && $car->getDoors()=="0"? "selected":"" ;?>>0</option>
                                    <option value="1" <?php echo $car !== null && $car->getDoors()=="1"? "selected":"" ;?>>1</option>
                                    <option value="2" <?php echo $car !== null && $car->getDoors()=="2"? "selected":"" ;?>>2</option>
                                    <option value="3" <?php echo $car !== null && $car->getDoors()=="3"? "selected":"" ;?>>3</option>
                                    <option value="4" <?php echo $car !== null && $car->getDoors()=="4"? "selected":"" ;?>>4</option>
                                    <option value="5" <?php echo $car !== null && $car->getDoors()=="5"? "selected":"" ;?>>5</option>
                                </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="awesomeness" style="font-size:0.8em" class="col-sm-6 col-form-label">
                                Cooling</label>
                                <div class="col-sm-6">
                                <select class="form-control" name="cooling" id="awesomeness" style="font-size:0.8em">
                                    <option value="A/C" <?php echo $car !== null && $car->getCooling()=="A/C"? "selected":"" ;?>>A/C</option>
                                    <option value="Non A/C" <?php echo $car !== null && $car->getCooling()=="Non A/C"? "selected":"" ;?>>Non A/C</option>
                                </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="awesomeness" style="font-size:0.8em" class="col-sm-6 col-form-label">
                                Transmission</label>
                                <div class="col-sm-6">
                                <select class="form-control" name="transmission_shift" id="awesomeness" style="font-size:0.8em">
                                    <option value="Auto" <?php echo $car !== null && $car->getTransmission_shift()=="Auto"? "selected":"" ;?>>Auto</option>
                                    <option value="Manual" <?php echo $car !== null && $car->getTransmission_shift()=="Manual"? "selected":"" ;?>>Manual</option>
                                    <option value="Tiptronic" <?php echo $car !== null && $car->getTransmission_shift()=="Tiptronic"? "selected":"" ;?>>Tiptronic</option>
                                </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="awesomeness" style="font-size:0.8em" class="col-sm-6 col-form-label">
                                Condition</label>
                                <div class="col-sm-6">
                                <select class="form-control" name="is_used" id="awesomeness" style="font-size:0.8em">
                                    <option value="0" <?php echo $car !== null && $car->getIs_used()=="0"? "selected":"" ;?>>New</option>
                                    <option value="1" <?php echo $car !== null && $car->getIs_used()=="1"? "selected":"" ;?>>Used</option>
                                    <option value="2" <?php echo $car !== null && $car->getIs_used()=="2"? "selected":"" ;?>>Accident Repair</option>
                                </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="awesomeness" style="font-size:0.8em" class="col-sm-6 col-form-label">
                                Weel</label>
                                <div class="col-sm-6">
                                <select class="form-control" name="is_two_weel" id="awesomeness" style="font-size:0.8em">
                                    <option value="0" <?php echo $car !== null && $car->getIs_two_weel()=="0"? "selected":"" ;?>>4 Weel</option>
                                    <option value="1" <?php echo $car !== null && $car->getIs_two_weel()=="1"? "selected":"" ;?>>2 Weel</option>
                                </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="awesomeness" style="font-size:0.8em" class="col-sm-6 col-form-label">
                                Steering</label>
                                <div class="col-sm-6">
                                <select class="form-control" name="is_steering_right" id="awesomeness" style="font-size:0.8em">
                                    <option value="0" <?php echo $car !== null && $car->getIs_steering_right()=="0"? "selected":"" ;?>>Left</option>
                                    <option value="1" <?php echo $car !== null && $car->getIs_steering_right()=="1"? "selected":"" ;?>>Right</option>
                                </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="firstName" style="font-size:0.8em" class="col-sm-6 col-form-label">
                                Vehicle Name
                                </label>
                                <div class="col-sm-6">
                                <input type="text" name="name" value= "<?php echo $car !== null ? $car->getName():"" ;?>" style="font-size:0.8em" class="form-control" id="firstName" placeholder="John" <?php if($type!=1){echo 'required';}?>>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="lastName" style="font-size:0.8em" class="col-sm-6 col-form-label">
                                Grade
                                </label>
                                <div class="col-sm-6">
                                <input type="text" name="grade" value= "<?php echo $car !== null ? $car->getGrade():"" ;?>"  style="font-size:0.8em" class="form-control" id="lastName" placeholder="Doe" <?php if($type!=1){echo 'required';}?>>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="text" style="font-size:0.8em" class="col-sm-6 col-form-label">
                                Power
                                </label>
                                <div class="col-sm-6">
                                <input type="text" name="power" value= "<?php echo $car !== null ? $car->getPower():"" ;?>"  style="font-size:0.8em" class="form-control" id="email" placeholder="john.doe@email.com" <?php if($type!=1){echo 'required';}?>>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="text" name="name" style="font-size:0.8em" class="col-sm-6 col-form-label">
                                Model Year
                                </label>
                                <div class="col-sm-6">
                                <input type="number" name="model_year" value= "<?php echo $car !== null ? $car->getModel_year():"" ;?>"  style="font-size:0.8em" class="form-control" id="email" placeholder="john.doe@email.com" <?php if($type!=1){echo 'required';}?>>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="text" name="name" style="font-size:0.8em" class="col-sm-6 col-form-label">
                                Evaluation
                                </label>
                                <div class="col-sm-6">
                                <input type="text" name="evaluation" value= "<?php echo $car !== null ? $car->getEvaluation():"" ;?>"  style="font-size:0.8em" class="form-control" id="email" placeholder="john.doe@email.com" <?php if($type!=1){echo 'required';}?>>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="lastName" style="font-size:0.8em" class="col-sm-6 col-form-label">
                                Interior Color
                                </label>
                                <div class="col-sm-6">
                                <input type="text" name="in_col" value= "<?php echo $car !== null ? $car->getIn_color():"" ;?>"  style="font-size:0.8em" class="form-control" id="lastName" placeholder="Doe" <?php if($type!=1){echo 'required';}?>>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="lastName" style="font-size:0.8em" class="col-sm-6 col-form-label">
                                Exterior Color
                                </label>
                                <div class="col-sm-6">
                                <input type="text" name="ex_col" value= "<?php echo $car !== null ? $car->getEx_color():"" ;?>"  style="font-size:0.8em" class="form-control" id="lastName" placeholder="Doe" <?php if($type!=1){echo 'required';}?>>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="text" name="name" style="font-size:0.8em" class="col-sm-6 col-form-label">
                                Running
                                </label>
                                <div class="col-sm-6">
                                <input type="number" name="running" value= "<?php echo $car !== null ? $car->getRunning():"" ;?>"  style="font-size:0.8em" class="form-control" id="email" placeholder="john.doe@email.com" <?php if($type!=1){echo 'required';}?>>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="text" name="name" style="font-size:0.8em" class="col-sm-6 col-form-label">
                                Dimensions Length
                                </label>
                                <div class="col-sm-6">
                                <input type="number" name="dimensions_L" value= "<?php echo $car !== null ? $car->getDimensions_L():"" ;?>"  style="font-size:0.8em" class="form-control" id="email" placeholder="john.doe@email.com" <?php if($type!=1){echo 'required';}?>>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="text" name="name" style="font-size:0.8em" class="col-sm-6 col-form-label">
                                Dimensions Width
                                </label>
                                <div class="col-sm-6">
                                <input type="number" name="dimensions_W" value= "<?php echo $car !== null ? $car->getDimensions_W():"" ;?>" style="font-size:0.8em" class="form-control" id="email" placeholder="john.doe@email.com" <?php if($type!=1){echo 'required';}?>>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="text" name="name" style="font-size:0.8em" class="col-sm-6 col-form-label">
                                Dimensions Hight
                                </label>
                                <div class="col-sm-6">
                                <input type="number" name="dimensions_H" value= "<?php echo $car !== null ? $car->getDimensions_H():"" ;?>" style="font-size:0.8em" class="form-control" id="email" placeholder="john.doe@email.com" <?php if($type!=1){echo 'required';}?>>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="text" name="name" style="font-size:0.8em" class="col-sm-6 col-form-label">
                                Passengers
                                </label>
                                <div class="col-sm-6">
                                <input type="number" name="passengers" value= "<?php echo $car !== null ? $car->getPassengers():"" ;?>" style="font-size:0.8em" class="form-control" id="email" placeholder="john.doe@email.com" <?php if($type!=1){echo 'required';}?>>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="text" name="name" style="font-size:0.8em" class="col-sm-6 col-form-label">
                                Note
                                </label>
                                <div class="col-sm-6">
                                <input type="text" name="note" value= "<?php echo $car !== null ? $car->getNote():"" ;?>" style="font-size:0.8em" class="form-control" id="email" placeholder="john.doe@email.com" <?php if($type!=1){echo 'required';}?>>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="text" name="name" style="font-size:0.8em" class="col-sm-6 col-form-label">
                                Chassis
                                </label>
                                <div class="col-sm-6">
                                <input type="text" name="chassis" value= "<?php echo $car !== null ? $car->getChassis():"" ;?>"  style="font-size:0.8em" class="form-control" id="email" placeholder="john.doe@email.com" required <?php if($type!=1){echo 'readonly';}?>>
                                </div>
                            </div>
                            <hr>
                            <?php if($type==1){ ?>
                            <div class="form-group row">
                                <label for="text" name="name" style="font-size:0.8em" class="col-sm-6 col-form-label">
                                Supplier
                                </label>
                                <div class="col-sm-6">
                                <input type="text" name="supplier" value= "<?php 
                                    if($car !== null){
                                        if( $car->getAdditional() !== null && $car->getAdditional()->getSupplier()!==null && !empty($car->getAdditional()->getSupplier())){
                                            echo $car->getAdditional()->getSupplier();
                                        }else if( $car->getUserInwuary() !== null && $car->getUserInwuary()->getUser_name()!==null && !empty($car->getUserInwuary()->getUser_name())){
                                            echo $car->getUserInwuary()->getUser_name()." ( FROM INQUARY )";
                                        }else{
                                            echo "";
                                        }
                                    }else{
                                        echo "";
                                    }
                                ?>"
                                 style="font-size:0.8em" class="form-control" id="supplier" placeholder="john.">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="text" name="name" style="font-size:0.8em" class="col-sm-6 col-form-label">
                                Perfecture
                                </label>
                                <div class="col-sm-6">
                                <input type="text" name="per" value= "<?php 
                                    if($car !== null){
                                        if( $car->getAdditional() !== null && $car->getAdditional()->getPerfecture()!==null && !empty($car->getAdditional()->getPerfecture())){
                                            echo $car->getAdditional()->getPerfecture();
                                        }else if( $car->getUserInwuary() !== null && $car->getUserInwuary()->getNearest_port()!==null && !empty($car->getUserInwuary()->getNearest_port())){
                                            echo $car->getUserInwuary()->getNearest_port()." ( FROM INQUARY )";
                                        }else{
                                            echo "";
                                        }
                                    }else{
                                        echo "";
                                    }
                                ?>" 
                                style="font-size:0.8em" class="form-control" id="per" placeholder="john" >
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="text" name="name" style="font-size:0.8em" class="col-sm-6 col-form-label">
                                Bank
                                </label>
                                <div class="col-sm-6">
                                <input type="text" name="bank" value= "<?php echo $car !== null && $car->getAdditional() !== null ? $car->getAdditional()->getBank():"" ;?>" style="font-size:0.8em" class="form-control" id="bank" placeholder="john.dom">
                                </div>
                            </div>
                            <hr>
                            <div class="form-group row">
                                <label for="text" name="name" style="font-size:0.8em" class="col-sm-6 col-form-label">
                                Buying
                                </label>
                                <div class="col-sm-6">
                                <input onchange="myFunction()" type="number" value= "<?php echo $car !== null && $car->getPriceObject() !== null ? $car->getPriceObject()->getBuying():"" ;?>" name="buy" style="font-size:0.8em" class="form-control" id="buy" placeholder="john." required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="text" name="name" style="font-size:0.8em" class="col-sm-6 col-form-label">
                                Rice With Tax
                                </label>
                                <div class="col-sm-6">
                                <input  onchange="myFunction()" type="number" value= "<?php echo $car !== null && $car->getDeductions() !== null ? $car->getDeductions()->getWith_tax():"" ;?>" name="with_tax" style="font-size:0.8em" class="form-control" id="with_tax" placeholder="john." required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="text" name="name" style="font-size:0.8em" class="col-sm-6 col-form-label">
                                Recycle
                                </label>
                                <div class="col-sm-6">
                                <input  onchange="myFunction()"  type="number" value= "<?php echo $car !== null && $car->getDeductions() !== null ? $car->getDeductions()->getRecycle():"" ;?>"  name="recycle" style="font-size:0.8em" class="form-control" id="recycle" placeholder="john" >
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="text" name="name" style="font-size:0.8em" class="col-sm-6 col-form-label">
                                R TAX
                                </label>
                                <div class="col-sm-6">
                                <input  onchange="myFunction()" type="number" value= "<?php echo $car !== null && $car->getDeductions() !== null ? $car->getDeductions()->getRtax():"" ;?>" name="rtax" style="font-size:0.8em" class="form-control" id="rtax" placeholder="john." >
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="text" name="name" style="font-size:0.8em" class="col-sm-6 col-form-label">
                                Automobile TAX
                                </label>
                                <div class="col-sm-6">
                                <input  onchange="myFunction()"  type="number" value= "<?php echo $car !== null && $car->getDeductions() !== null ? $car->getDeductions()->getAtax():"" ;?>"  name="auto_t" style="font-size:0.8em" class="form-control" id="auto_t" placeholder="john" >
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="text" name="name" style="font-size:0.8em" class="col-sm-6 col-form-label">
                                AU Chargers
                                </label>
                                <div class="col-sm-6">
                                <input  onchange="myFunction()"  type="number" value= "<?php echo $car !== null && $car->getDeductions() !== null ? $car->getDeductions()->getAu_cha():"" ;?>"  name="au" style="font-size:0.8em" class="form-control" id="au" placeholder="john.dom" >
                                </div>
                            </div>
                            <hr>
                            <div class="form-group row">
                                <label for="text" name="name" style="font-size:0.8em" class="col-sm-6 col-form-label">
                                Trasport
                                </label>
                                <div class="col-sm-6">
                                <input  onchange="myFunction()"  type="number" value= "<?php echo $car !== null && $car->getDeductions() !== null ? $car->getDeductions()->getTrasport():"" ;?>"  name="trans" style="font-size:0.8em" class="form-control" id="trans" placeholder="john." >
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="text" name="name" style="font-size:0.8em" class="col-sm-6 col-form-label">
                                Storage
                                </label>
                                <div class="col-sm-6">
                                <input  onchange="myFunction()"  type="number" value= "<?php echo $car !== null && $car->getDeductions() !== null ? $car->getDeductions()->getStorage():"" ;?>"  name="storage" style="font-size:0.8em" class="form-control" id="storage" placeholder="john" >
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="text" name="name" style="font-size:0.8em" class="col-sm-6 col-form-label">
                                Insurance
                                </label>
                                <div class="col-sm-6">
                                <input  onchange="myFunction()"  type="number" value= "<?php echo $car !== null && $car->getDeductions() !== null ? $car->getDeductions()->getInsurance():"" ;?>"  name="insu" style="font-size:0.8em" class="form-control" id="insu" placeholder="john.dom" >
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="text" name="name" style="font-size:0.8em" class="col-sm-6 col-form-label">
                                Repair
                                </label>
                                <div class="col-sm-6">
                                <input  onchange="myFunction()"  type="number" name="repair" value= "<?php echo $car !== null && $car->getDeductions() !== null ? $car->getDeductions()->getRepair():"" ;?>"  style="font-size:0.8em" class="form-control" id="repair" placeholder="john.dom" >
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="text" name="name" style="font-size:0.8em" class="col-sm-6 col-form-label">
                                Other
                                </label>
                                <div class="col-sm-6">
                                <input  onchange="myFunction()"  type="number" name="other" value= "<?php echo $car !== null && $car->getDeductions() !== null ? $car->getDeductions()->getOther():"" ;?>"  style="font-size:0.8em" class="form-control" id="other" placeholder="john.dom" >
                                </div>
                            </div>
                            <hr>
                            <?php }else {?>
                            <div class="form-group row">
                                <label for="text" name="name" style="font-size:0.8em; display: none;" class="col-sm-6 col-form-label">
                                Buying
                                </label>
                                <div class="col-sm-6">
                                <input onchange="myFunction()" type="hidden" value= "<?php echo $car !== null && $car->getPriceObject() !== null ? $car->getPriceObject()->getBuying():"" ;?>" name="buy" style="font-size:0.8em" class="form-control" id="buy" placeholder="john." required>
                                </div>
                            </div>
                                <?php } ?>
                            <div class="form-group row">
                                <label for="text" name="name" style="font-size:0.8em" class="col-sm-6 col-form-label">
                                Total Cost
                                </label>
                                <div class="col-sm-6">
                                <input type="number" name="sell" value= "<?php echo $car !== null && $car->getPriceObject() !== null ? $car->getPriceObject()->getSelling():"" ;?>" style="font-size:0.8em" class="form-control" id="sell" placeholder="john" required <?php if($type!=1){echo 'readonly';}?>>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="text" name="name" style="font-size:0.8em" class="col-sm-6 col-form-label">
                                Public Price
                                </label>
                                <div class="col-sm-6">
                                <input type="number" name="public" value= "<?php echo $car !== null && $car->getPriceObject() !== null ? $car->getPriceObject()->getPublic():"" ;?>" style="font-size:0.8em" class="form-control" id="public" placeholder="john.dom">
                                </div>
                            </div>
                                <div class="modal-footer">
                                <?php
                                if(isset($filepath)){
                                    foreach ($filepath as $key2 => $value1) {
                                        echo '<input type="hidden" name="filepath['.$key2.']" value="'.$value1.'" />';
                                    }
                                }
                                ?>
                                <label for="awesomeness" style="font-size:0.8em; color:#f44336" class="col-sm-6 col-form-label">
                                <?php echo isset($filepath) && !empty($filepath) ? "":"Please Upload Images First" ?></label>
                                <button type="submit" style="font-size:0.8em; " class=" bttn2" value="Submit" name="Submit" 
                                <?php echo isset($filepath) && !empty($filepath) ? "":"disabled" ?>>Submit</button>
                            </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>


            <div id="i88c" class="gjs-cell">
                <h5>Pick Your Imagers</h5>
                <div class="heading_center">
                <form action="add_vehicle.php" enctype="multipart/form-data" method="post">
                                <?php
                                if(isset($filepath)){
                                    foreach ($filepath as $key2 => $value1) {
                                        echo '<input type="hidden" name="filepath['.$key2.']" value="'.$value1.'" />';
                                    }
                                }
                                ?>
                            <label for="awesomeness" style="font-size:0.8em" class="col-sm-6 col-form-label">
                                Pick Your Vehicle Imagers</label>
                                
                            <input type="hidden" id="carId" name="carId" value="<?php echo $carId;?>">
                            <input type="file" style="margin-left: 20px; font-size:0.8em" name="files[]" multiple><br/><br/>
                            <input type="submit" class="bttn2" style="font-size:0.8em;" value="Upload" name="Submit1"> <br/>
                            </form>
                        <div class="box">
                            <div class="grid-container">
                                <?php 
                                if(isset($filepath)){
                                    foreach ($filepath as $key1 => $value2) { ?>
                                    <div class='grid-item'> 
                                        <img src=<?php echo $value2 ?> height="auto" width="150" />
                                        <form action="add_vehicle.php" enctype="multipart/form-data" method="post">
                                            <?php
                                            if(isset($filepath)){
                                                foreach ($filepath as $key => $value3) {
                                                    echo '<input type="hidden" name="filepath['.$key.']" value="'.$value3.'" />';
                                                }
                                            }
                                            ?>
                                        <input type="text" style="display:none" name="file_name" value=<?php echo $value2 ?>>
                                        <input type="hidden" id="carId" name="carId" value="<?php echo $carId;?>">
                                        <input type="submit" class="delete" style="background-color:#fff; color:#f44336; font-size: xx-small; padding: 0;" value="Delete" name="Delete">
                                        </form>
                                    </div>
                                    <?php } 
                                }?>
                    </div>
                        </div>
                </div>
            </div>
        </div>
        </form>
    </div>
</section>
</body>
<!-- end box with filter section -->

<script>
function myFunction() {
  var buy = document.getElementById("buy");
  var rtax = document.getElementById("rtax");
  var auto_t = document.getElementById("auto_t");
  var au = document.getElementById("au");
  var trans = document.getElementById("trans");
  var storage = document.getElementById("storage");
  var insu = document.getElementById("insu");
  var repair = document.getElementById("repair");
  var other = document.getElementById("other");
  var sell = document.getElementById("sell");
  var public = document.getElementById("public");
  var with_tax = document.getElementById("with_tax");
  var recycle = document.getElementById("recycle");
  with_tax.value = Math.floor(Math.floor(buy.value)*1.1);
  sell.value = Math.floor(buy.value)+Math.floor(rtax.value)+Math.floor(auto_t.value)+
  Math.floor(au.value)+Math.floor(trans.value)+Math.floor(storage.value)+Math.floor(insu.value)+
  Math.floor(repair.value)+Math.floor(other.value)+Math.floor(with_tax.value)+Math.floor(recycle.value);
//   public.value = sell.value;
}
</script>


<!-- jQery -->
<script src="../js/jquery-3.4.1.min.js"></script>
<!-- popper js -->
<script src="../js/popper.min.js"></script>
<!-- bootstrap js -->
<script src="../js/bootstrap.js"></script>
<!-- custom js -->
<script src="../js/custom.js"></script>
<!--===============================================================================================-->
<script src="../vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
<script src="../vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
<script src="../vendor/bootstrap/js/popper.js"></script>
<script src="../vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
<script src="../vendor/select2/select2.min.js"></script>
<script>
    $(".js-select2").each(function(){
        $(this).select2({
            minimumResultsForSearch: 20,
            dropdownParent: $(this).next('.dropDownSelect2')
        });
    })
</script>
<!--===============================================================================================-->
<script src="../vendor/daterangepicker/moment.min.js"></script>
<script src="../vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
<script src="../vendor/slick/slick.min.js"></script>
<script src="../js/slick-custom.js"></script>
<!--===============================================================================================-->
<script src="../vendor/parallax100/parallax100.js"></script>
<script>
    $('.parallax100').parallax100();
</script>
<!--===============================================================================================-->
<script src="../vendor/MagnificPopup/jquery.magnific-popup.min.js"></script>
<script>
    $('.gallery-lb').each(function() { // the containers for all your galleries
        $(this).magnificPopup({
            delegate: 'a', // the selector for gallery item
            type: 'image',
            gallery: {
                enabled:true
            },
            mainClass: 'mfp-fade'
        });
    });
</script>
<!--===============================================================================================-->
<script src="../vendor/isotope/isotope.pkgd.min.js"></script>
<!--===============================================================================================-->
<script src="../vendor/sweetalert/sweetalert.min.js"></script>
<script>
    $('.js-addwish-b2').on('click', function(e){
        e.preventDefault();
    });

    $('.js-addwish-b2').each(function(){
        var nameProduct = $(this).parent().parent().find('.js-name-b2').html();
        $(this).on('click', function(){
            swal(nameProduct, "is added to wishlist !", "success");

            $(this).addClass('js-addedwish-b2');
            $(this).off('click');
        });
    });

    $('.js-addwish-detail').each(function(){
        var nameProduct = $(this).parent().parent().parent().find('.js-name-detail').html();

        $(this).on('click', function(){
            swal(nameProduct, "is added to wishlist !", "success");

            $(this).addClass('js-addedwish-detail');
            $(this).off('click');
        });
    });

    /*---------------------------------------------*/

    $('.js-addcart-detail').each(function(){
        var nameProduct = $(this).parent().parent().parent().parent().find('.js-name-detail').html();
        $(this).on('click', function(){
            swal(nameProduct, "is added to cart !", "success");
        });
    });

</script>
<!--===============================================================================================-->
<script src="../vendor/perfect-scrollbar/perfect-scrollbar.min.js"></script>
<script>
    $('.js-pscroll').each(function(){
        $(this).css('position','relative');
        $(this).css('overflow','hidden');
        var ps = new PerfectScrollbar(this, {
            wheelSpeed: 1,
            scrollingThreshold: 1000,
            wheelPropagation: false,
        });

        $(window).on('resize', function(){
            ps.update();
        })
    });
</script>

<script>

var form = document.getElementById("formAwesome");
form.addEventListener("submit", onSubmitForm);

function onSubmitForm(e) {
  e.preventDefault();
  $('#formModal').modal('hide');
  $('#btnStart').hide();
  $('#message').show();
}

    </script>
<!--===============================================================================================-->
<script src="../js/main.js"></script>
</body>
</html>
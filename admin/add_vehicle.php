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
        $carImagersList = getAllCarImagers($link,$carId,$type);
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
        // $file_tmp=$_FILES["files"]["tmp_name"][$key];
        $file_name=str_replace(' ', '_', $file_name);
        $filepathTemp = "../images/cars/".microtime_float().$file_name;

        $image = imagecreatefromjpeg($_FILES["files"]["tmp_name"][$key]);
        imagejpeg($image,$filepathTemp, 60);
        imagedestroy($image);
        
        if(file_exists($filepathTemp)) 
        {
            array_push($filepath,$filepathTemp);
        }else{
            echo '<script>alert("Imager upload error. Try again please")</script>';
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
    require_once('../php/car_module.php');
    require_once('../php/car_additinal_module.php');
    require_once('../php/car_deduction_module.php');
    require_once('../php/car_price_module.php');

    $car = new Cars(
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
        $carId,
        0,
        $_REQUEST['is_used'],
        $_REQUEST['is_two_weel'],
        $_REQUEST['is_steering_right'],
        $_REQUEST['in_col'],
        $_REQUEST['ex_col'],
        $_REQUEST['bank_date'],
        $_REQUEST['country'],
        $_REQUEST['topic'],
        $_REQUEST['option']
    );
    $car->setPrice(new CarPrice(
        $carId,$_REQUEST['buy']??0,$_REQUEST['sell']??0,$_REQUEST['public']??0,0,0
    ));
    
    $car->setDeductions(new CarDeduction(
        $carId,
        $_REQUEST['rtax'],$_REQUEST['auto_t'],$_REQUEST['au']
            ,$_REQUEST['trans'],$_REQUEST['storage'],$_REQUEST['insu'],$_REQUEST['repair'],$_REQUEST['other'],
            $_REQUEST['with_tax'],$_REQUEST['recycle']
    ));

    $car->setAdditional(new CarAdditinal(
        $carId,$_REQUEST['supplier'],$_REQUEST['per'],$_REQUEST['bank']
    ));

    if(addVehicle($link,$carId,$filepath)==1 && !isset($carId)){
        $car = null;
    }
}

function addVehicle($link,$carId,$filepath){
    $type = $_SESSION['type'];
    require_once('../php/car_dao.php');
    require_once('../php/car_image_dao.php');
    require_once('../php/car_price_dao.php');
    require_once('../php/user_inquary_dao.php');
    require_once('../php/car_additinal_dao.php');
    require_once('../php/car_deduction_dao.php');

    $list = getCarsFromChesse($link,$_REQUEST['chassis']);

    if(isset($list)  && !empty($list) && !isset($carId)){
        echo '<script>alert("Vehicle Chassis Number Exist. Please check!")</script>';
        return 0;
    }

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
            $_REQUEST['ex_col'],
            $_REQUEST['bank_date'],
            $_REQUEST['country'],
            $_REQUEST['topic'],
            $_REQUEST['option']
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
            $_REQUEST['ex_col'],
            $_REQUEST['bank_date'],
            $_REQUEST['country'],
            $_REQUEST['topic'],
            $_REQUEST['option']
            );
    }
    if($maxId>0){
        if(isset($filepath)){
            foreach ($filepath as $key2 => $value1) {
                if($type==1){
                    $ISMAIN = 3;
                }else{
                    $ISMAIN =$key2!=0?0:1;
                }
                insertCarImagers($link,$value1,$ISMAIN,$maxId);
            }
        }
        insertCarPrice($link,$maxId,$_REQUEST['buy']??0,$_REQUEST['sell']??0,$_REQUEST['public']??0,0,0);
        if($type==1){
            insertCarAdditinal($link,$maxId,$_REQUEST['supplier'],$_REQUEST['per'],$_REQUEST['bank']);
            insertCarDeduction($link,$maxId,$_REQUEST['rtax'],$_REQUEST['auto_t'],$_REQUEST['au']
            ,$_REQUEST['trans'],$_REQUEST['storage'],$_REQUEST['insu'],$_REQUEST['repair'],$_REQUEST['other'],
            $_REQUEST['with_tax'],$_REQUEST['recycle']);
        }
        $filepath=array();
        echo '<script>alert("Vehicle Successfully inserted")</script>';
        return 1;
    }else{
        echo '<script>alert("Vehicle Not inserted")</script>';
        return 0;
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

    <!-- Required library -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" ></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.24/webcam.js"></script>
	<!-- Bootstrap theme -->
	<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css"> -->
	<!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script> -->
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
                <!-- <label for="awesomeness" style="font-size:0.8em; color:#f44336" class="col-sm-6 col-form-label">
                                <?php echo isset($filepath) && !empty($filepath) ? "":"Please Upload Images First" ?></label> -->
                    <div class="box" >
                    <!-- style="display: <?php echo isset($filepath) && !empty($filepath) ? "block":"none" ?>;" -->
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
                                            ?><option value="<?php echo $value->getId() ?>" <?php echo $car !== null && ($car->getMaker_id())==($value->getId())? "selected":"" ;?>>
                                            <?php echo $value->getId()==1?"Select":$value->getName() ?></option><?php
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
                                <option value="0" <?php echo $car !== null && ($car->getBody_style_id())==0? "selected":"" ;?>>Select</option>
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
                                    <option value="--" <?php echo $car !== null && $car->getFuel()=="--"? "selected":"" ;?>>Select</option>
                                    <option value="gasoline" <?php echo $car !== null && $car->getFuel()=="Gasoline"? "selected":"" ;?>>Gasoline</option>
                                    <option value="diesel" <?php echo $car !== null && $car->getFuel()=="Diesel"? "selected":"" ;?>>Diesel</option>
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
                                    <option value="--" <?php echo $car !== null && $car->getCooling()=="--"? "selected":"" ;?>>Select</option>
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
                                    <option value="--" <?php echo $car !== null && $car->getTransmission_shift()=="--"? "selected":"" ;?>>Select</option>
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
                                    <option value="-1" <?php echo $car !== null && $car->getIs_used()=="-1"? "selected":"" ;?>>Select</option>
                                    <option value="0" <?php echo $car !== null && $car->getIs_used()=="0"? "selected":"" ;?>>New</option>
                                    <option value="1" <?php echo $car !== null && $car->getIs_used()=="1"? "selected":"" ;?>>Used</option>
                                    <option value="2" <?php echo $car !== null && $car->getIs_used()=="2"? "selected":"" ;?>>Accident Repair</option>
                                </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="awesomeness" style="font-size:0.8em" class="col-sm-6 col-form-label">
                                Wheel</label>
                                <div class="col-sm-6">
                                <select class="form-control" name="is_two_weel" id="awesomeness" style="font-size:0.8em">
                                    <option value="-1" <?php echo $car !== null && $car->getIs_two_weel()=="-1"? "selected":"" ;?>>Select</option>
                                    <option value="0" <?php echo $car !== null && $car->getIs_two_weel()=="0"? "selected":"" ;?>>4 Wheel</option>
                                    <option value="1" <?php echo $car !== null && $car->getIs_two_weel()=="1"? "selected":"" ;?>>2 Wheel</option>
                                </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="awesomeness" style="font-size:0.8em" class="col-sm-6 col-form-label">
                                Steering</label>
                                <div class="col-sm-6">
                                <select class="form-control" name="is_steering_right" id="awesomeness" style="font-size:0.8em">
                                    <option value="-1" <?php echo $car !== null && $car->getIs_steering_right()=="-1"? "selected":"" ;?>>Select</option>
                                    <option value="0" <?php echo $car !== null && $car->getIs_steering_right()=="0"? "selected":"" ;?>>Left</option>
                                    <option value="1" <?php echo $car !== null && $car->getIs_steering_right()=="1"? "selected":"" ;?>>Right</option>
                                </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="firstName" style="font-size:0.9em; font-weight: bold;" class="col-sm-6 col-form-label">
                                Vehicle Name
                                </label>
                                <div class="col-sm-6">
                                <input type="text" name="name" value= "<?php echo $car !== null ? $car->getName():"" ;?>" style="font-size:0.9em; font-weight: bold;" class="form-control" id="firstName" placeholder="John" <?php if($type!=1){echo 'required';}?>>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="lastName" style="font-size:0.8em" class="col-sm-6 col-form-label">
                                Topic
                                </label>
                                <div class="col-sm-6">
                                <input type="text" name="topic" value= "<?php echo $car !== null ? $car->getTopic():"" ;?>"  style="font-size:0.8em" class="form-control" id="lastName" placeholder="Doe" <?php if($type!=1){echo 'required';}?>>
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
                                <datalist id="suggestions">
                                    <option value="No Country">No Country</option>
                                    <option value="Afghanistan">Afghanistan</option>
                                    <option value="Aland Islands">Åland Islands</option>
                                    <option value="Albania">Albania</option>
                                    <option value="Algeria">Algeria</option>
                                    <option value="American Samoa">American Samoa</option>
                                    <option value="Andorra">Andorra</option>
                                    <option value="Angola">Angola</option>
                                    <option value="Anguilla">Anguilla</option>
                                    <option value="Antarctica">Antarctica</option>
                                    <option value="Antigua and Barbuda">Antigua & Barbuda</option>
                                    <option value="Argentina">Argentina</option>
                                    <option value="Armenia">Armenia</option>
                                    <option value="Aruba">Aruba</option>
                                    <option value="Australia">Australia</option>
                                    <option value="Austria">Austria</option>
                                    <option value="Azerbaijan">Azerbaijan</option>
                                    <option value="Bahamas">Bahamas</option>
                                    <option value="Bahrain">Bahrain</option>
                                    <option value="Bangladesh">Bangladesh</option>
                                    <option value="Barbados">Barbados</option>
                                    <option value="Belarus">Belarus</option>
                                    <option value="Belgium">Belgium</option>
                                    <option value="Belize">Belize</option>
                                    <option value="Benin">Benin</option>
                                    <option value="Bermuda">Bermuda</option>
                                    <option value="Bhutan">Bhutan</option>
                                    <option value="Bolivia">Bolivia</option>
                                    <option value="Bonaire, Sint Eustatius and Saba">Caribbean Netherlands</option>
                                    <option value="Bosnia and Herzegovina">Bosnia & Herzegovina</option>
                                    <option value="Botswana">Botswana</option>
                                    <option value="Bouvet Island">Bouvet Island</option>
                                    <option value="Brazil">Brazil</option>
                                    <option value="British Indian Ocean Territory">British Indian Ocean Territory</option>
                                    <option value="Brunei Darussalam">Brunei</option>
                                    <option value="Bulgaria">Bulgaria</option>
                                    <option value="Burkina Faso">Burkina Faso</option>
                                    <option value="Burundi">Burundi</option>
                                    <option value="Cambodia">Cambodia</option>
                                    <option value="Cameroon">Cameroon</option>
                                    <option value="Canada">Canada</option>
                                    <option value="Cape Verde">Cape Verde</option>
                                    <option value="Cayman Islands">Cayman Islands</option>
                                    <option value="Central African Republic">Central African Republic</option>
                                    <option value="Chad">Chad</option>
                                    <option value="Chile">Chile</option>
                                    <option value="China">China</option>
                                    <option value="Christmas Island">Christmas Island</option>
                                    <option value="Cocos (Keeling) Islands">Cocos (Keeling) Islands</option>
                                    <option value="Colombia">Colombia</option>
                                    <option value="Comoros">Comoros</option>
                                    <option value="Congo">Congo - Brazzaville</option>
                                    <option value="Congo, Democratic Republic of the Congo">Congo - Kinshasa</option>
                                    <option value="Cook Islands">Cook Islands</option>
                                    <option value="Costa Rica">Costa Rica</option>
                                    <option value="Cote D'Ivoire">Côte d’Ivoire</option>
                                    <option value="Croatia">Croatia</option>
                                    <option value="Cuba">Cuba</option>
                                    <option value="Curacao">Curaçao</option>
                                    <option value="Cyprus">Cyprus</option>
                                    <option value="Czech Republic">Czechia</option>
                                    <option value="Denmark">Denmark</option>
                                    <option value="Djibouti">Djibouti</option>
                                    <option value="Dominica">Dominica</option>
                                    <option value="Dominican Republic">Dominican Republic</option>
                                    <option value="Ecuador">Ecuador</option>
                                    <option value="Egypt">Egypt</option>
                                    <option value="El Salvador">El Salvador</option>
                                    <option value="Equatorial Guinea">Equatorial Guinea</option>
                                    <option value="Eritrea">Eritrea</option>
                                    <option value="Estonia">Estonia</option>
                                    <option value="Ethiopia">Ethiopia</option>
                                    <option value="Falkland Islands (Malvinas)">Falkland Islands (Islas Malvinas)</option>
                                    <option value="Faroe Islands">Faroe Islands</option>
                                    <option value="Fiji">Fiji</option>
                                    <option value="Finland">Finland</option>
                                    <option value="France">France</option>
                                    <option value="French Guiana">French Guiana</option>
                                    <option value="French Polynesia">French Polynesia</option>
                                    <option value="French Southern Territories">French Southern Territories</option>
                                    <option value="Gabon">Gabon</option>
                                    <option value="Gambia">Gambia</option>
                                    <option value="Georgia">Georgia</option>
                                    <option value="Germany">Germany</option>
                                    <option value="Ghana">Ghana</option>
                                    <option value="Gibraltar">Gibraltar</option>
                                    <option value="Greece">Greece</option>
                                    <option value="Greenland">Greenland</option>
                                    <option value="Grenada">Grenada</option>
                                    <option value="Guadeloupe">Guadeloupe</option>
                                    <option value="Guam">Guam</option>
                                    <option value="Guatemala">Guatemala</option>
                                    <option value="Guernsey">Guernsey</option>
                                    <option value="Guinea">Guinea</option>
                                    <option value="Guinea-Bissau">Guinea-Bissau</option>
                                    <option value="Guyana">Guyana</option>
                                    <option value="Haiti">Haiti</option>
                                    <option value="Heard Island and Mcdonald Islands">Heard & McDonald Islands</option>
                                    <option value="Holy See (Vatican City State)">Vatican City</option>
                                    <option value="Honduras">Honduras</option>
                                    <option value="Hong Kong">Hong Kong</option>
                                    <option value="Hungary">Hungary</option>
                                    <option value="Iceland">Iceland</option>
                                    <option value="India">India</option>
                                    <option value="Indonesia">Indonesia</option>
                                    <option value="Iran, Islamic Republic of">Iran</option>
                                    <option value="Iraq">Iraq</option>
                                    <option value="Ireland">Ireland</option>
                                    <option value="Isle of Man">Isle of Man</option>
                                    <option value="Israel">Israel</option>
                                    <option value="Italy">Italy</option>
                                    <option value="Jamaica">Jamaica</option>
                                    <option value="Japan">Japan</option>
                                    <option value="Jersey">Jersey</option>
                                    <option value="Jordan">Jordan</option>
                                    <option value="Kazakhstan">Kazakhstan</option>
                                    <option value="Kenya">Kenya</option>
                                    <option value="Kiribati">Kiribati</option>
                                    <option value="Korea, Democratic People's Republic of">North Korea</option>
                                    <option value="Korea, Republic of">South Korea</option>
                                    <option value="Kosovo">Kosovo</option>
                                    <option value="Kuwait">Kuwait</option>
                                    <option value="Kyrgyzstan">Kyrgyzstan</option>
                                    <option value="Lao People's Democratic Republic">Laos</option>
                                    <option value="Latvia">Latvia</option>
                                    <option value="Lebanon">Lebanon</option>
                                    <option value="Lesotho">Lesotho</option>
                                    <option value="Liberia">Liberia</option>
                                    <option value="Libyan Arab Jamahiriya">Libya</option>
                                    <option value="Liechtenstein">Liechtenstein</option>
                                    <option value="Lithuania">Lithuania</option>
                                    <option value="Luxembourg">Luxembourg</option>
                                    <option value="Macao">Macao</option>
                                    <option value="Macedonia, the Former Yugoslav Republic of">North Macedonia</option>
                                    <option value="Madagascar">Madagascar</option>
                                    <option value="Malawi">Malawi</option>
                                    <option value="Malaysia">Malaysia</option>
                                    <option value="Maldives">Maldives</option>
                                    <option value="Mali">Mali</option>
                                    <option value="Malta">Malta</option>
                                    <option value="Marshall Islands">Marshall Islands</option>
                                    <option value="Martinique">Martinique</option>
                                    <option value="Mauritania">Mauritania</option>
                                    <option value="Mauritius">Mauritius</option>
                                    <option value="Mayotte">Mayotte</option>
                                    <option value="Mexico">Mexico</option>
                                    <option value="Micronesia, Federated States of">Micronesia</option>
                                    <option value="Moldova, Republic of">Moldova</option>
                                    <option value="Monaco">Monaco</option>
                                    <option value="Mongolia">Mongolia</option>
                                    <option value="Montenegro">Montenegro</option>
                                    <option value="Montserrat">Montserrat</option>
                                    <option value="Morocco">Morocco</option>
                                    <option value="Mozambique">Mozambique</option>
                                    <option value="Myanmar">Myanmar (Burma)</option>
                                    <option value="Namibia">Namibia</option>
                                    <option value="Nauru">Nauru</option>
                                    <option value="Nepal">Nepal</option>
                                    <option value="Netherlands">Netherlands</option>
                                    <option value="Netherlands Antilles">Curaçao</option>
                                    <option value="New Caledonia">New Caledonia</option>
                                    <option value="New Zealand">New Zealand</option>
                                    <option value="Nicaragua">Nicaragua</option>
                                    <option value="Niger">Niger</option>
                                    <option value="Nigeria">Nigeria</option>
                                    <option value="Niue">Niue</option>
                                    <option value="Norfolk Island">Norfolk Island</option>
                                    <option value="Northern Mariana Islands">Northern Mariana Islands</option>
                                    <option value="Norway">Norway</option>
                                    <option value="Oman">Oman</option>
                                    <option value="Pakistan">Pakistan</option>
                                    <option value="Palau">Palau</option>
                                    <option value="Palestinian Territory, Occupied">Palestine</option>
                                    <option value="Panama">Panama</option>
                                    <option value="Papua New Guinea">Papua New Guinea</option>
                                    <option value="Paraguay">Paraguay</option>
                                    <option value="Peru">Peru</option>
                                    <option value="Philippines">Philippines</option>
                                    <option value="Pitcairn">Pitcairn Islands</option>
                                    <option value="Poland">Poland</option>
                                    <option value="Portugal">Portugal</option>
                                    <option value="Puerto Rico">Puerto Rico</option>
                                    <option value="Qatar">Qatar</option>
                                    <option value="Reunion">Réunion</option>
                                    <option value="Romania">Romania</option>
                                    <option value="Russian Federation">Russia</option>
                                    <option value="Rwanda">Rwanda</option>
                                    <option value="Saint Barthelemy">St. Barthélemy</option>
                                    <option value="Saint Helena">St. Helena</option>
                                    <option value="Saint Kitts and Nevis">St. Kitts & Nevis</option>
                                    <option value="Saint Lucia">St. Lucia</option>
                                    <option value="Saint Martin">St. Martin</option>
                                    <option value="Saint Pierre and Miquelon">St. Pierre & Miquelon</option>
                                    <option value="Saint Vincent and the Grenadines">St. Vincent & Grenadines</option>
                                    <option value="Samoa">Samoa</option>
                                    <option value="San Marino">San Marino</option>
                                    <option value="Sao Tome and Principe">São Tomé & Príncipe</option>
                                    <option value="Saudi Arabia">Saudi Arabia</option>
                                    <option value="Senegal">Senegal</option>
                                    <option value="Serbia">Serbia</option>
                                    <option value="Serbia and Montenegro">Serbia</option>
                                    <option value="Seychelles">Seychelles</option>
                                    <option value="Sierra Leone">Sierra Leone</option>
                                    <option value="Singapore">Singapore</option>
                                    <option value="Sint Maarten">Sint Maarten</option>
                                    <option value="Slovakia">Slovakia</option>
                                    <option value="Slovenia">Slovenia</option>
                                    <option value="Solomon Islands">Solomon Islands</option>
                                    <option value="Somalia">Somalia</option>
                                    <option value="South Africa">South Africa</option>
                                    <option value="South Georgia and the South Sandwich Islands">South Georgia & South Sandwich Islands</option>
                                    <option value="South Sudan">South Sudan</option>
                                    <option value="Spain">Spain</option>
                                    <option value="Sri Lanka">Sri Lanka</option>
                                    <option value="Sudan">Sudan</option>
                                    <option value="Suriname">Suriname</option>
                                    <option value="Svalbard and Jan Mayen">Svalbard & Jan Mayen</option>
                                    <option value="Swaziland">Eswatini</option>
                                    <option value="Sweden">Sweden</option>
                                    <option value="Switzerland">Switzerland</option>
                                    <option value="Syrian Arab Republic">Syria</option>
                                    <option value="Taiwan, Province of China">Taiwan</option>
                                    <option value="Tajikistan">Tajikistan</option>
                                    <option value="Tanzania, United Republic of">Tanzania</option>
                                    <option value="Thailand">Thailand</option>
                                    <option value="Timor-Leste">Timor-Leste</option>
                                    <option value="Togo">Togo</option>
                                    <option value="Tokelau">Tokelau</option>
                                    <option value="Tonga">Tonga</option>
                                    <option value="Trinidad and Tobago">Trinidad & Tobago</option>
                                    <option value="Tunisia">Tunisia</option>
                                    <option value="Turkey">Turkey</option>
                                    <option value="Turkmenistan">Turkmenistan</option>
                                    <option value="Turks and Caicos Islands">Turks & Caicos Islands</option>
                                    <option value="Tuvalu">Tuvalu</option>
                                    <option value="Uganda">Uganda</option>
                                    <option value="Ukraine">Ukraine</option>
                                    <option value="United Arab Emirates">United Arab Emirates</option>
                                    <option value="United Kingdom">United Kingdom</option>
                                    <option value="United States">United States</option>
                                    <option value="United States Minor Outlying Islands">U.S. Outlying Islands</option>
                                    <option value="Uruguay">Uruguay</option>
                                    <option value="Uzbekistan">Uzbekistan</option>
                                    <option value="Vanuatu">Vanuatu</option>
                                    <option value="Venezuela">Venezuela</option>
                                    <option value="Viet Nam">Vietnam</option>
                                    <option value="Virgin Islands, British">British Virgin Islands</option>
                                    <option value="Virgin Islands, U.s.">U.S. Virgin Islands</option>
                                    <option value="Wallis and Futuna">Wallis & Futuna</option>
                                    <option value="Western Sahara">Western Sahara</option>
                                    <option value="Yemen">Yemen</option>
                                    <option value="Zambia">Zambia</option>
                                    <option value="Zimbabwe">Zimbabwe</option>
                                </datalist>
                                <label for="firstName" style="font-size:0.8em;" class="col-sm-6 col-form-label">
                                Country
                                </label>
                                <div class="col-sm-6">
                                <input type="text" name="country" autoComplete="on" list="suggestions" value= "<?php echo $car !== null ? $car->getCountry():"" ;?>" style="font-size:0.8em;" class="form-control" id="firstName" placeholder="No Country">
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
                                Options
                                </label>
                                <div class="col-sm-6">
                                <input type="text" name="option" value= "<?php echo $car !== null ? $car->getOptions():"" ;?>"  style="font-size:0.8em" class="form-control" id="email" placeholder="john.doe@email.com">
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
                                <label for="text" name="name" style="font-size:0.9em; font-weight: bold;" class="col-sm-6 col-form-label">
                                Chassis
                                </label>
                                <div class="col-sm-6">
                                <input type="text" name="chassis" value= "<?php echo $car !== null ? $car->getChassis():"" ;?>"  style="font-size:0.9em; font-weight: bold;" class="form-control" id="email" placeholder="john.doe@email.com" required <?php if($type!=1){echo 'readonly';}?>>
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
                            <div class="form-group row">
                                <label for="text" name="name" style="font-size:0.8em" class="col-sm-6 col-form-label">
                                Bank Date
                                </label>
                                <div class="col-sm-6">
                                    <input type="date" name="bank_date" value= "<?php echo $car !== null && $car->getBank_date()!== null ? $car->getBank_date():"";?>" style="font-size:0.8em" class="form-control" id="bank" placeholder="john.dom">
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
                                <label for="text" name="name" style="font-size:0.9em; font-weight: bold;" class="col-sm-6 col-form-label">
                                Total Cost
                                </label>
                                <div class="col-sm-6">
                                <input type="number" name="sell" value= "<?php echo $car !== null && $car->getPriceObject() !== null ? $car->getPriceObject()->getSelling():"" ;?>" style="font-size:0.9em; font-weight: bold;" class="form-control" id="sell" placeholder="john" required <?php if($type!=1){echo 'readonly';}?>>
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
                            <hr>
                            <div class="form-group row">
                                <label for="text" name="name" style="font-size:0.8em" class="col-sm-6 col-form-label">
                                Note
                                </label>
                                <textarea name="note"><?php echo $car !== null ? $car->getNote():"" ;?></textarea>
                            </div>
                                <div class="modal-footer">
                                <?php
                                if(isset($filepath)){
                                    foreach ($filepath as $key2 => $value1) {
                                        echo '<input type="hidden" name="filepath['.$key2.']" value="'.$value1.'" />';
                                    }
                                }
                                ?>
                                <!-- <label for="awesomeness" style="font-size:0.8em; color:#f44336" class="col-sm-6 col-form-label">
                                <?php echo isset($filepath) && !empty($filepath) ? "":"Please Upload Images First" ?></label> -->
                                <button type="submit" style="font-size:0.8em; " class=" bttn2" value="Submit" name="Submit" >Submit</button>
                                <!-- <?php echo isset($filepath) && !empty($filepath) ? "":"disabled" ?> -->
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
                            <input type="hidden" id="m_image" name="m_image">
                            <input type="file" style="margin-left: 20px; font-size:0.8em" name="files[]" multiple>
                            <!-- <hr/>
                            <h6 > Capcher Your Vehicle Image from Camera</h6>
                            <div Class="bttn2" style="max-width: 130px;" onClick="openCanera()" value="10">Capcher</div><br/><br/>
                            <div id="results"></div>
                            <hr/> -->
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

<!-- 
<div id="myModal" class="modal">
    <div class="modal-content">
        <div class="container">
        <div class="box">
            <div class="heading_container heading_center" >
                <h4 id="title" style="padding-bottom: 15px; margin-top: 10px;">Please Conform</h4>
                <div id="my_camera" style="aspect-ratio: 16/9;" class="pre_capture_frame" ></div>
                <row>
                <button id="Bttn212" Class="bttn2" onClick="take_snapshot()" name="Action" value="10">Capcher</button>
                <button id="Bttn213" Class="swal-button" onClick="close_cam()" name="Action" value="11">Close</button>
            </row>
            </div>
        </div>
    </div>
    </div>

</div> -->

</body>
<!-- end box with filter section -->
<!-- 
<script language="JavaScript">
    var modal = document.getElementById("myModal");
        Webcam.reset();
	
    function openCanera(){
        Webcam.reset();
        modal.style.display = "block";
        Webcam.set({
            width: 320,
     height: 240,
     dest_width: 320,
     dest_height: 240,
        image_format: 'jpeg',
        jpeg_quality: 90
        });
        Webcam.attach( '#my_camera' );
    }
	
	function take_snapshot() {
        Webcam.snap( function(data_uri) {
            document.getElementById('results').innerHTML = 
            '<img name="mobile_image" class="after_capture_frame" style="max-width: 320px;" src="'+data_uri+'"/>';
            $("#m_image").val(data_uri);
            Webcam.reset();
            modal.style.display = "none";
        });	 
	}

    function close_cam(){
        Webcam.reset();
        modal.style.display = "none";
    }

	function saveSnap(){
	var base64data = $("#captured_image_data").val();
	 $.ajax({
			type: "POST",
			dataType: "json",
			url: "capture_image_upload.php",
			data: {image: base64data},
			success: function(data) { 
				alert(data);
			}
		});
	}
</script> -->

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
  with_tax.value = Math.floor(Math.floor(buy.value)*0.1);
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
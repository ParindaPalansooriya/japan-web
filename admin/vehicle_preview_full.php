
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

$queries = array();
$carId=null;

parse_str($_SERVER['QUERY_STRING'], $queries);
if(isset($queries) && !empty($queries)){
   if(isset($queries['id']) && !empty($queries['id'])){
      $carId = $queries['id'];
   }
}

require_once('../php/config.php');
require_once "../php/car_module.php";
require_once "../php/car_dao.php";
require_once "../php/car_image_module.php";
require_once "../php/car_image_dao.php";
require_once "../php/user_inquary_dao.php";
require_once "../php/car_price_dao.php";

$imagers = array();

if(isset($carId)){
    $user_inquary = getUserInquary($link,$carId);
    if(isset($_POST['update'])){
        if(getCarPriceUpdate($link,$carId,$_REQUEST['sell'],$_REQUEST['pub'],$_REQUEST['buy'],$_REQUEST['ub'])>0){
            echo '<script>alert("Prices Update success")</script>';
        }
    }
    if(isset($_POST['Action'])){
        if($_POST['Action']!=0){
            if(updateAction($link,$carId,$_POST['Action'])>0){
                echo '<script>alert("Block Updated success")</script>';
            }
        }else if($_POST['Action']==0){
            moveCarToSoledList($link,$carId,-2);
            echo "<script>window.close();</script>";
        }
    }
    $car = getCarsByIdWithbidPrice($link,$carId);
    $imagers = getAllCarImagers($link,$carId);
    $prices = getCarPrice($link,$carId);
    if(!isset($imagers) || empty($imagers)){
        array_push($imagers,"images/noimage.jpg");
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
    <title>Vehicle Preview</title>
    <!-- bootstrap core css -->
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.css" />
    <!-- font awesome style -->
    <link href="../css/font-awesome.min.css" rel="stylesheet" />
    <!-- Custom styles for this template -->
    <link href="../css/style.css" rel="stylesheet" />
    <!-- responsive style -->
    <link href="../css/responsive.css" rel="stylesheet" />
    <!-- Image preview  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css'>
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.3.0/ekko-lightbox.css'>
    <link rel="stylesheet" href="../css/style_image.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/prefixfree/1.0.7/prefixfree.min.js"></script>


    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--===============================================================================================-->
    <link rel="icon" type="image/png" href="../images/icons/favicon.png"/>
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="../vendor/bootstrap/css/bootstrap.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="../fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="../fonts/iconic/css/material-design-iconic-font.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="../fonts/linearicons-v1.0.0/icon-font.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="../vendor/animate/animate.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="../vendor/css-hamburgers/hamburgers.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="../vendor/animsition/css/animsition.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="../vendor/select2/select2.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="../vendor/daterangepicker/daterangepicker.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="../vendor/slick/slick.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="../vendor/MagnificPopup/magnific-popup.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="../vendor/perfect-scrollbar/perfect-scrollbar.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="../css/util.css">
    <link rel="stylesheet" type="text/css" href="../css/main.css">
    <!--===============================================================================================-->
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
        border: 2px solid black;
        border-radius: 5px;
        background-color: white;
        color: black;
        padding: 8px 28px;
        font-size: 16px;

    }
    .bttn2 {
        border: 3px solid orange;
        border-radius: 5px;
        background-color: white;
        color: green;
        padding: 8px 28px;
        font-size: 13px;
        font-weight: 600;

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

    /*  Class for button and header  */
    * {
        box-sizing: border-box;
    }
    body {
        margin: 0;
    }
    .container-width{
        width:95%;
        /* max-width:1150px; */
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
    /* End class for button and header  */

    /* image grid container */
    .grid-container {
        display: grid;
        grid-template-columns: auto auto auto auto auto auto;
        background-color: #ffffff;
        padding: 10px;
    }
    .grid-item {
        background-color: rgba(255, 255, 255, 0.8);
        border: 2px solid rgba(196, 196, 196, 0.8);
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
        min-height:10px;
        flex-grow:1;
        flex-basis:100%;
    }
    @media (max-width: 768px){
        .gjs-row{
            flex-wrap:wrap;
        }
    }
    /*  end header class divide css code   */

    /*  popup box css  */
    body {font-family: Arial, Helvetica, sans-serif;}

    /* The Modal (background) */
    .modal {
        display: none; /* Hidden by default */
        position: fixed; /* Stay in place */
        z-index: 1; /* Sit on top */
        padding-top: 100px; /* Location of the box */
        left: 0;
        top: 0;
        width: 100%; /* Full width */
        height: 100%; /* Full height */
        overflow: auto; /* Enable scroll if needed */
        background-color: rgb(0,0,0); /* Fallback color */
        background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
    }

    /* Modal Content */
    .modal-content {
        background-color: #fefefe;
        margin: auto;
        padding: 20px;
        border: 1px solid #888;
        width: 80%;
    }

    /* The Close Button */
    .close {
        color: #aaaaaa;
        float: right;
        font-size: 28px;
        font-weight: bold;
    }
    .close:hover,
    .close:focus {
        color: #000;
        text-decoration: none;
        cursor: pointer;
    }
    /*  end popup box css  */

    /*    Header left/center/right code*/
    #header-wrap {
        display: flex;                   /* 1 */
        align-items: flex-start;         /* 2 */
        justify-content: space-between;  /* 3 */
        text-align: center;
        padding: 1rem 0;
    }

    #header-blue   { margin-bottom: 20px; background-color: #ffffff; color: #000000; }
    .header-left   { border: 1px solid #2b2d9e; width: 250px; }
    .header-right  { border: 1px solid #804848; width: 150px; }
    .header-center { border: 1px solid #359a2e; width: 630px; }
    /*   end  Header left/center/right code*/

    /* Two Equal Columns */
    * {
        box-sizing: border-box;
    }

    /* Create two equal columns that floats next to each other */
    .column {
        float: left;
        width: 50%;
        padding: 10px;
        height: 300px; /* Should be removed. Only for demonstration */
    }

    /* Clear floats after the columns */
    .row:after {
        content: "";
        display: table;
        clear: both;
    }
    .box img {
        width: 100%;
        height: 100%;
    }

    .box1 img {
        object-fit: cover;
    }

    .box2 img {
        object-fit: contain;
    }
    /* End Two Equal Columns */

</style>

<body>
<!-- Button section -->
<header class="header_section">
    <div class="gjso-row" id="i7xa">
        <div class="gjs-cell">
            <div class="gjs-row" id="ivs4">
                <div class="gjs-cell" id="injr">
                    <div class="heading_container heading_center">
                        <div class="col-center">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
<!-- End color buttons -3  section -->
<body class="">
    <?php 
    if(isset($car)){
    ?>
    <div class="container-width">

        <div id="i14q" class="gjs-row">
            <div id="i91j" class="gjs-cell">
                <div class="col">
                    <div class="container mt-5">
                        <div class="carousel-container position-relative row">

                            <!-- Sorry! Lightbox doesn't work - yet. -->

                            <div id="myCarousel" class="carousel slide" data-ride="carousel">
                                <div class="carousel-inner" style="max-width: 800px; object-fit: contain;">
                                    <?php if(isset($imagers)){
                                        foreach ($imagers as $key => $value) { ?>
                                            <div class="carousel-item <?php if($key==0){echo "active";} ?>"  style="max-width: 800px; object-fit: contain;" data-slide-number=<?php echo $key; ?>>
                                                <img src="<?php echo "../images/cars/".$value->getImage(); ?>"  style="max-width: 800px; object-fit: contain;" alt="...">
                                            </div>
                                       <?php }
                                    }?>
                                </div>
                            </div>
                        </div> <!-- /row -->
                    </div> <!-- /container -->

                    <div class="container mt-5">
                        <div id="carousel-thumbs" class="carousel slide" data-ride="carousel">
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <div class="row mx-0">
                                        <?php if(isset($imagers)){
                                            foreach ($imagers as $key => $value) { ?>
                                            <div id="carousel-selector-0" class="thumb col-4 col-sm-2 px-1 py-2 <?php if($key==0){echo 'selected';}?>" data-target="#myCarousel" data-slide-to=<?php echo $key; ?>>
                                                <img src="<?php echo "../images/cars/".$value->getImage(); ?>" style="width: 100%; aspect-ratio: 6/4; " class="img-fluid" alt="...">
                                            </div>
                                        <?php }
                                        }?>
                                    </div>
                                </div>
                            </div>
                        </div> <!-- /row -->
                    </div> <!-- /container -->
                </div>
        </div>

            <div id="i91j" class="gjs-cell" style="margin-top: 40px;">
                <div class="shadow">
                    <div class="box">
                        <div class="container-fluid" style="padding: 20px;">
                        <div class="table-responsive">

                            <table class="table custom-table">
                        <thead>
                            <tr>
                                <th scope="col" style="width:70%"><h4><?php echo $car->getName(); ?></h4></th>
                                <th scope="col"><h4><?php echo $car->getCurrent_action_text(); ?></h4></th>
                            </tr>
                        </thead>
                            </table></div>
                            <div class="row">
                                <div  class="col-sm-6" style="background-color:#ffffff;">
                                    <p style="padding-bottom: 5px; margin-top: 10px;">Code : <?php echo sprintf(" (VEH_%05d)", $car->getId()); ?></p>
                                    <p style="padding-bottom: 5px; margin-top: 10px;">Make : <?php echo $car->getMaker(); ?></p>
                                    <p style="padding-bottom: 5px;">Model : <?php echo $car->getModel(); ?></p>
                                    <p style="padding-bottom: 5px;">Body Style : <?php echo $car->getStyle(); ?></p>
                                    <p style="padding-bottom: 5px;">Interior Color : <?php echo $car->getIn_color(); ?></p>
                                    <p style="padding-bottom: 5px;">Exterior Color : <?php echo $car->getEx_color(); ?></p>
                                    <p style="padding-bottom: 5px;">Transmission : <?php echo $car->getTransmission_shift(); ?></p>
                                    <p style="padding-bottom: 5px;">Passengers : <?php echo $car->getPassengers(); ?></p>
                                    <p style="padding-bottom: 5px;">Doors : <?php echo $car->getDoors(); ?></p>
                                    <p style="padding-bottom: 5px;">Grade : <?php echo $car->getGrade(); ?></p>
                                    <p style="padding-bottom: 5px;">Evaluation : <?php echo $car->getEvaluation(); ?></p>
                                    <p style="padding-bottom: 5px;">Running : <?php echo $car->getRunning(); ?></p>
                                    </br>
                                </div>
                                <div class="col-sm-6" style="background-color:#ffffff;">
                                    <p style="padding-bottom: 5px; margin-top: 10px;">Fuel : <?php echo $car->getFuel(); ?></p>
                                    <p style="padding-bottom: 5px;">Year : <?php echo $car->getModel_year(); ?></p>
                                    <p style="padding-bottom: 5px;">Chassis : <?php echo $car->getChassis(); ?></p>
                                    <p style="padding-bottom: 5px;">Cooling : <?php echo $car->getCooling(); ?></p>
                                    <p style="padding-bottom: 5px;">Lenght : <?php echo $car->getDimensions_L(); ?></p>
                                    <p style="padding-bottom: 5px;">Width : <?php echo $car->getDimensions_W(); ?></p>
                                    <p style="padding-bottom: 5px;">Hight : <?php echo $car->getDimensions_H(); ?></p>
                                    <p style="padding-bottom: 5px;">Condition : <?php echo $car->getIs_used()==0?"New":"Used"; ?></p>
                                    <p style="padding-bottom: 5px;">Weel : <?php echo $car->getIs_two_weel()==0?"4 Weel":"2 Weel"; ?></p>
                                    <p style="padding-bottom: 5px;">Steering : <?php echo $car->getIs_steering_right()==0?"Left":"Right"; ?></p>
                                    </br>
                                </div>
                            </div>
                            <?php if( null !== $car->getNote() && !empty($car->getNote())){?>
                                <p style="padding-bottom: 15px; margin-top: 10px;">note : <?php echo $car->getNote(); ?></p>
                            <?php } ?>

                            <?php 
                            
                            if(isset($user_inquary)){
                            
                            ?>
                            <p style="padding-bottom: 15px;"><h5> User Ditails</h5></p>
                                <div class="gjs-cell">
                                    
                                    <div class="heading_container heading_center" style="padding-top: 15px;">
                                        <table class="table custom-table">
                                            <thead>
                                                <tr>
                                                    <th scope="col"><?php echo $user_inquary->getUser_name(); ?></th>
                                                    <th scope="col"><?php echo $user_inquary->getMobile(); ?></th>
                                                    <th scope="col"><?php echo $user_inquary->getEmail(); ?></th>
                                                </tr>
                                            </thead>
                                        </table>
                                    </div>
                                </div>
                        <?php 
                            }
                            if(isset($user_inquary)){
                            
                            ?>
                            <p style="padding-bottom: 15px;"><h5> Price Ditails</h5></p>
                                <div class="gjs-cell">
                                    <form action="vehicle_preview_full.php?id=<?php echo $carId;?>" method="post">
                                    <div class="heading_container heading_center" style="padding-top: 15px;">
                                        <table class="table custom-table">
                                            <tbody>
                                                <tr>
                                                    <th scope="col">Selling</th>
                                                    <th scope="col">Public</th>
                                                    <th scope="col">Buying</th>
                                                    <th scope="col">User Bid</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <th scope="col">
                                                        <input type="text" name="sell" style="font-size:0.8em" class="form-control" id="email" value="<?php echo $prices->getSelling(); ?>" required>
                                                    </th>
                                                    <th scope="col">
                                                        <input type="text" name="pub" style="font-size:0.8em" class="form-control" id="email" value="<?php echo $prices->getPublic(); ?>" required>
                                                    </th>
                                                    <th scope="col">
                                                        <input type="text" name="buy" style="font-size:0.8em" class="form-control" id="email" value="<?php echo $prices->getBuying(); ?>" required>
                                                    </th>
                                                    <th scope="col">
                                                        <input type="text" name="ub" style="font-size:0.8em" class="form-control" id="email" value="<?php echo $prices->getPrice1(); ?>" required>
                                                    </th>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="heading_container heading_center">
                                        <button Class="bttn" name="update">Update Price</button>
                                    </div>
                                    </form>
                                </div>
                        <?php 
                            }
                        ?>
                        </div>
                    </div>
                </div>
                    <table class="table custom-table">
                        <thead>
                            <tr>
                                <th scope="col">
                                        <button id="Bttn1" Class="swal-button" name="Action" value="0">Remove</button>
                                </th>
                                <th scope="col">
                                        <button id="Bttn2" Class="bttn2" name="Action" value="1">1 Kojo</button>
                                </th>
                                <th scope="col">
                                        <button id="Bttn3" Class="bttn2" name="Action" value="2">1Sale</button>
                                </th>
                                <th scope="col">
                                        <button id="Bttn4" Class="bttn2" name="Action" value="3">2 Kojo</button>
                                </th>
                                <th scope="col">
                                        <button id="Bttn5" Class="bttn2" name="Action" value="4">2Sale</button>
                                </th>
                            </tr>
                        </thead>
                        <thead>
                            <tr>
                                </th>
                                <th scope="col">
                                        <button id="Bttn6" Class="bttn2" name="Action" value="5">3 Kojo</button>
                                </th>
                                <th scope="col">
                                        <button id="Bttn7" Class="bttn2" name="Action" value="6">3Sale</button>
                                </th>
                                <th scope="col">
                                        <button id="Bttn8" Class="bttn2" name="Action" value="7">Miho Kojo</button>
                                </th>
                                <th scope="col">
                                        <button id="Bttn9" Class="bttn2" name="Action" value="-1">Export</button>
                                </th>
                            </tr>
                        </thead>
                    </table>
            </div>
        </div>
    </div>
    <?php }?>

<!-- Trigger/Open The Modal -->
<!-- The Modal -->
<div id="myModal" class="modal">

    <!-- Modal content -->
    <div class="modal-content">
        <div class="container-width">
        <div class="box">
            <form action="vehicle_preview_full.php?id=<?php echo $carId;?>" method="post">
            <div class="heading_container heading_center" >
                <h4 id="title" style="padding-bottom: 15px; margin-top: 10px;">Please Conform</h4>
                <button id="Bttn21" Class="swal-button" name="Action" value="0">Remove</button>
                <button id="Bttn22" Class="bttn2" name="Action" value="1">1 Kojo</button>
                <button id="Bttn23" Class="bttn2" name="Action" value="2">1Sale</button>
                <button id="Bttn24" Class="bttn2" name="Action" value="3">2 Kojo</button>
                <button id="Bttn25" Class="bttn2" name="Action" value="4">2Sale</button>
                <button id="Bttn26" Class="bttn2" name="Action" value="5">3 Kojo</button>
                <button id="Bttn27" Class="bttn2" name="Action" value="6">3Sale</button>
                <button id="Bttn28" Class="bttn2" name="Action" value="7">Miho Kojo</button>
                <button id="Bttn29" Class="bttn2" name="Action" value="-1">Export</button>
            </div>
            </form>
        </div>
    </div>
    </div>

</div>



<!-- Popup box-->
<script>
    // Get the modal
    var modal = document.getElementById("myModal");

    // Get the button that opens the modal
    var btn1 = document.getElementById("Bttn1");
    var btn2 = document.getElementById("Bttn2");
    var btn3 = document.getElementById("Bttn3");
    var btn4 = document.getElementById("Bttn4");
    var btn5 = document.getElementById("Bttn5");
    var btn6 = document.getElementById("Bttn6");
    var btn7 = document.getElementById("Bttn7");
    var btn8 = document.getElementById("Bttn8");
    var btn9 = document.getElementById("Bttn9");

    
    var btn21 = document.getElementById("Bttn21");
    var btn22 = document.getElementById("Bttn22");
    var btn23 = document.getElementById("Bttn23");
    var btn24 = document.getElementById("Bttn24");
    var btn25 = document.getElementById("Bttn25");
    var btn26 = document.getElementById("Bttn26");
    var btn27 = document.getElementById("Bttn27");
    var btn28 = document.getElementById("Bttn28");
    var btn29 = document.getElementById("Bttn29");

    var title = document.getElementById("title");

    btn1.onclick = function() {
        modal.style.display = "block";
        btn22.style.display = "none";
        btn23.style.display = "none";
        btn24.style.display = "none";
        btn25.style.display = "none";
        btn26.style.display = "none";
        btn27.style.display = "none";
        btn28.style.display = "none";
        btn29.style.display = "none";
        btn21.style.display = "block";
        title.innerHTML = "Please conform to remove this Item";
    }

    btn2.onclick = function() {
        modal.style.display = "block";
        btn21.style.display = "none";
        btn23.style.display = "none";
        btn24.style.display = "none";
        btn22.style.display = "block";
        btn25.style.display = "none";
        btn26.style.display = "none";
        btn27.style.display = "none";
        btn28.style.display = "none";
        btn29.style.display = "none";
        title.innerHTML = "Please conform to Add this Item to 1 Kojo";
    }

    btn3.onclick = function() {
        modal.style.display = "block";
        btn21.style.display = "none";
        btn22.style.display = "none";
        btn23.style.display = "block";
        btn24.style.display = "none";
        btn25.style.display = "none";
        btn26.style.display = "none";
        btn27.style.display = "none";
        btn28.style.display = "none";
        btn29.style.display = "none";
        title.innerHTML = "Please conform to Add this Item to 1 Sale";
    }

    btn4.onclick = function() {
        modal.style.display = "block";
        btn21.style.display = "none";
        btn23.style.display = "none";
        btn24.style.display = "block";
        btn22.style.display = "none";
        btn25.style.display = "none";
        btn26.style.display = "none";
        btn27.style.display = "none";
        btn28.style.display = "none";
        btn29.style.display = "none";
        title.innerHTML = "Please conform to Add this Item to 2 Kojo";
    }

    btn5.onclick = function() {
        modal.style.display = "block";
        btn21.style.display = "none";
        btn23.style.display = "none";
        btn24.style.display = "none";
        btn25.style.display = "block";
        btn22.style.display = "none";
        btn26.style.display = "none";
        btn27.style.display = "none";
        btn28.style.display = "none";
        btn29.style.display = "none";
        title.innerHTML = "Please conform to Add this Item to 2 Sale";
    }

    btn6.onclick = function() {
        modal.style.display = "block";
        btn21.style.display = "none";
        btn23.style.display = "none";
        btn24.style.display = "none";
        btn25.style.display = "none";
        btn22.style.display = "none";
        btn26.style.display = "block";
        btn27.style.display = "none";
        btn28.style.display = "none";
        btn29.style.display = "none";
        title.innerHTML = "Please conform to Add this Item to 3 Kojo";
    }

    btn7.onclick = function() {
        modal.style.display = "block";
        btn21.style.display = "none";
        btn23.style.display = "none";
        btn24.style.display = "none";
        btn25.style.display = "none";
        btn22.style.display = "none";
        btn26.style.display = "none";
        btn27.style.display = "block";
        btn28.style.display = "none";
        btn29.style.display = "none";
        title.innerHTML = "Please conform to Add this Item to 3 Sale";
    }

    btn8.onclick = function() {
        modal.style.display = "block";
        btn21.style.display = "none";
        btn23.style.display = "none";
        btn24.style.display = "none";
        btn25.style.display = "none";
        btn22.style.display = "none";
        btn26.style.display = "none";
        btn27.style.display = "none";
        btn28.style.display = "block";
        btn29.style.display = "none";
        title.innerHTML = "Please conform to Add this Item to Miho Kojo";
    }

    btn9.onclick = function() {
        modal.style.display = "block";
        btn21.style.display = "none";
        btn23.style.display = "none";
        btn24.style.display = "none";
        btn25.style.display = "none";
        btn22.style.display = "none";
        btn26.style.display = "none";
        btn27.style.display = "none";
        btn28.style.display = "none";
        btn29.style.display = "block";
        title.innerHTML = "Please conform to Add this Item to Export";
    }

    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
</script>


</body>
<!-- end box with filter section -->
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
<!--===============================================================================================-->
<script src="../js/main.js"></script>

<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js'></script>
<script src='https://stackpath.bootstrapcdn.com/bootstrap/4.3.0/js/bootstrap.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.3.0/ekko-lightbox.js'></script>
<script  src="../js/script.js"></script>

</body>
</html>
<?php

ob_start();
session_start();

$id = $_SESSION['id'];
$type = $_SESSION['type'];

if(!isset($id) || !isset($type) || $type>1 || !isset($_SESSION['timeout']) || ($_SESSION['timeout']+(60*30)) < time()){
    header("Location: login.php"); 
}else{
    $_SESSION['timeout'] = time();
}

use Shuchkin\SimpleXLSXGen;

$today = date("Y-m-d");
require_once('../php/config.php');
require_once('../php/car_dao.php');

$summery = getAllSoledCarsForReport($link);

if(isset($_POST['download']))
{
    $data = [];

    $titles = [
        '<style height="50"><b><middle><center>Code</center></middle></b></style>',
        '<style height="50"><b><middle><center>Date</center></middle></b></style>',
        '<style height="50"><b><middle><center>Store</center></middle></b></style>',
        '<style height="50"><b><middle><center>Supplier</center></middle></b></style>',
        '<style height="50"><b><middle><center>Perfecture</center></middle></b></style>',
        '<style height="50"><b><middle><center>Car Model</center></middle></b></style>',
        '<style height="50"><b><middle><center>Maker</center></middle></b></style>',
        '<style height="50"><b><middle><center>Model Year</center></middle></b></style>',
        '<style height="50"><b><middle><center>Chassis</center></middle></b></style>'
    ];

    if($userType==1){
        array_push($titles,'<style height="50"><b><middle><center>Bank</center></middle></b></style>');
        array_push($titles,'<style height="50"><b><middle><center>Bid</center></middle></b></style>');
        array_push($titles,'<style height="50"><b><middle><center>Buying</center></middle></b></style>');
        array_push($titles,'<style height="50"><b><middle><center>R TAX</center></middle></b></style>');
        array_push($titles,'<style height="50"><b><middle><center>Automobile TAX</center></middle></b></style>');
        array_push($titles,'<style height="50"><b><middle><center>AU Chargers</center></middle></b></style>');
        array_push($titles,'<style height="50"><b><middle><center>Trasport</center></middle></b></style>');
        array_push($titles,'<style height="50"><b><middle><center>Storage</center></middle></b></style>');
        array_push($titles,'<style height="50"><b><middle><center>Insurance</center></middle></b></style>');
        array_push($titles,'<style height="50"><b><middle><center>Repair</center></middle></b></style>');
        array_push($titles,'<style height="50"><b><middle><center>Other</center></middle></b></style>');
        array_push($titles,'<style height="50"><b><middle><center>Selling</center></middle></b></style>');
    }

    array_push($titles,'<style height="50"><b><middle><center>Public</center></middle></b></style>');

    array_push($data,$titles);

    foreach ($summery as $key => $value) {
        $temp = [
            sprintf("VEH_%05d", $value->getId()),
            $value->getDate()!==null?$value->getDate():"--",
            $value->getCurrent_action_text()!==null?$value->getCurrent_action_text():"--",
            $value->getAdditional()!==null?($value->getAdditional()->getSupplier()??""):"--",
            $value->getAdditional()!==null?($value->getAdditional()->getPerfecture()??""):"--",
            $value->getModel()!==null?$value->getModel():"--",
            $value->getMaker()!==null?$value->getMaker():"--",
            $value->getModel_year()!==null?$value->getModel_year():"--",
            $value->getChassis()!==null?$value->getChassis():"--"
        ];

        if($userType==1){
            array_push($temp,$value->getAdditional()!==null?($value->getAdditional()->getBank()??"--"):"--");
            array_push($temp,$value->getPriceObject()!==null?$value->getPriceObject()->getPrice1()??"--":"--");
            array_push($temp,$value->getPriceObject()!==null?$value->getPriceObject()->getBuying()??"--":"--");
            array_push($temp,$value->getDeductions()!==null?$value->getDeductions()->getRtax()??"--":"--");
            array_push($temp,$value->getDeductions()!==null?$value->getDeductions()->getAtax()??"--":"--");
            array_push($temp,$value->getDeductions()!==null?$value->getDeductions()->getAu_cha()??"--":"--");
            array_push($temp,$value->getDeductions()!==null?$value->getDeductions()->getTrasport()??"--":"--");
            array_push($temp,$value->getDeductions()!==null?$value->getDeductions()->getStorage()??"--":"--");
            array_push($temp,$value->getDeductions()!==null?$value->getDeductions()->getInsurance()??"--":"--");
            array_push($temp,$value->getDeductions()!==null?$value->getDeductions()->getRepair()??"--":"--");
            array_push($temp,$value->getDeductions()!==null?$value->getDeductions()->getOther()??"--":"--");
            array_push($temp,$value->getPriceObject()!==null?$value->getPriceObject()->getSelling()??"--":"--");
        }

        if($value->getPriceObject()!==null){
            array_push($temp,$value->getPriceObject()!==null?$value->getPriceObject()->getPublic()??"--":"--");
        }else{
            array_push($temp,"--");
        }
        
        array_push($data,$temp);
    }

    // print_r($data);
    require_once "./sheet/SimpleXLSXGen.php";

    $file_url = './sheet/sale_report_'.$today.'.xlsx';

    SimpleXLSXGen::fromArray($data)->saveAs($file_url);

    ob_end_clean();
    header('Content-Description: File Transfer');
    header('Content-Type: xlsx');
    header("Content-Transfer-Encoding: Binary");
    header("Content-disposition: attachment; filename=\"" . basename($file_url) . "\"");
    header('Content-Transfer-Encoding: binary');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    readfile($file_url);
    if (file_exists($file_url)) {
        unlink($file_url);
    }
}

?>


<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/html" xmlns="http://www.w3.org/1999/html">
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
    <title>Attendance_form</title>
    <!-- bootstrap core css -->
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.css" />
    <!-- font awesome style -->
    <link href="../css/font-awesome.min.css" rel="stylesheet" />
    <!-- Custom styles for this template -->
    <link href="../css/style.css" rel="stylesheet" />
    <!-- responsive style -->
    <link href="../css/responsive.css" rel="stylesheet" />

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

    <!-- <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script> -->
</head>

<style>
    /*  button section   */
    * {
        box-sizing: border-box;
    }

    .bttn {
        border: 2px solid black;
        border-radius: 5px;
        background-color: white;
        color: black;
        padding: 8px 28px;
        font-size: 16px;

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

    /* end button section   */

    /*  button2 section   */
    * {
        box-sizing: border-box;
    }

    .butt {
        border: 2px solid #ffad06;
        border-radius: 5px;
        background-color: white;
        color: #ffad06;
        padding: 8px 28px;
        font-size: 16px;

    }
    /* end button2 section   */

    /*  button3 section   */
    * {
        box-sizing: border-box;
    }

    .butt2 {
        border: 2px solid #ffad06;
        border-radius: 5px;
        background-color: #ffffff;
        color: #ffad06;
        padding: 8px 28px;
        font-size: 16px;

    }
    /* End button3 section   */

    /*  Class for button and header  */
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
        min-height:75px;
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
    .header-left   { border: 1px solid #ffffff; width: 250px; }
    .header-right  { border: 1px solid #ffffff; width: 250px; }
    .header-center { border: 1px solid #ffffff; width: 630px; }
.table-responsive {
    margin: 30px 0;
}
.table-wrapper {
  	min-width: 1000px;
    background: #fff;
    padding: 20px 25px;
    border-radius: 3px;
    box-shadow: 0 1px 1px rgba(0,0,0,.05);
}
.table-title {
    color: #fff;
    background: #40b2cd;		
    padding: 16px 25px;
    margin: -20px -25px 10px;
    border-radius: 3px 3px 0 0;
}
.table-title h2 {
    margin: 5px 0 0;
    font-size: 24px;
}
.search-box {
    position: relative;
    float: right;
}
.search-box .input-group {
    min-width: 300px;
    position: absolute;
    right: 0;
}
.search-box .input-group-addon, .search-box input {
    border-color: #ddd;
    border-radius: 0;
}	
.search-box input {
    height: 34px;
    padding-right: 35px;
    background: #f4fcfd;
    border: none;
    border-radius: 2px !important;
}
.search-box input:focus {
    background: #fff;
}
.search-box input::placeholder {
    font-style: italic;
}
.search-box .input-group-addon {
    min-width: 35px;
    border: none;
    background: transparent;
    position: absolute;
    right: 0;
    z-index: 9;
    padding: 6px 0;
}
.search-box i {
    color: #a0a5b1;
    font-size: 19px;
    position: relative;
    top: 2px;
 }
</style>

<body>

<div class="hero_area">
    <!-- Button section -->
<header class="header_section">
    <div class="gjso-row" id="i7xa">
        <div class="gjs-cell">
            <div class="gjs-row" id="ivs4">
                <div class="gjs-cell" id="injr">
                    <div class="heading_container heading_center">
                        <div class="col-center">
                            <h3>Current Store</h3>
                        </div>
                    </div>
                </div>
                <div class="gjs-cell" id="ijl1">
                    <div class="heading_container heading_center">
                        <div class="col-center">
                            <form class="form-inline" method="post">
                                <div class="form-group">
                                    <button class="bttn Bu_one" class="form-control" name="download" >Download</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
    <!-- End color buttons -3  section -->

    <!-- Attendance list section -->
<section>

    <div class="content">

        <div class="container">			
                    <div class="row">
                        <div class="col-sm-6">
                        </div>
                        <div class="col-sm-6">
                            <div class="search-box">
                                <input type="text" id="search" class="form-control" placeholder="Search by Code">
                            </div>
                        </div>
                    </div>
            <div class="table-responsive">

                <table class="table custom-table">
                    <thead>
                    <tr>
                        <th scope="col">Code</th>
                        <th scope="col">Date</th>
                        <th scope="col">Store</th>
                        <th scope="col">Supplier</th>
                        <th scope="col">Perfecture</th>
                        <th scope="col">Bank</th>
                        <th scope="col">Name</th>
                        <th scope="col">Car Model</th>
                        <th scope="col">Maker</th>
                        <th scope="col">Model Year</th>
                        <th scope="col">Chassis</th>
                        <?php if($userType==1){
                            ?>
                        <th scope="col">Bank</th>
                        <th scope="col">Bid</th>
                        <th scope="col">Buying</th>
                        <th scope="col">R TAX</th>
                        <th scope="col">Automobile TAX</th>
                        <th scope="col">AU Chargers</th>
                        <th scope="col">Trasport</th>
                        <th scope="col">Storage</th>
                        <th scope="col">Insurance</th>
                        <th scope="col">Repair</th>
                        <th scope="col">Other</th>
                        <th scope="col">Selling</th>
                            <?php
                        } ?>
                        <th scope="col">Public</th>
                        <th scope="col"></th>
                    </tr>
                    </thead>
                    <tbody>
<!--   1st details row-->
                    <?php
                        foreach ($summery as $key => $value) {
                    ?>
                        <tr>
                            <td><?php echo sprintf("(VEH_%05d)", $value->getId()??0); ?></td>
                            <td><?php echo $value->getDate()!==null?$value->getDate():"--"; ?></td>
                            <td><?php echo $value->getCurrent_action_text()??"--"; ?></td>
                            <td><?php echo $value->getAdditional()!==null?$value->getAdditional()->getSupplier()??"--":"--"; ?></td>
                            <td><?php echo $value->getAdditional()!==null?$value->getAdditional()->getPerfecture()??"--":"--"; ?></td>
                            <td><?php echo $value->getAdditional()!==null?$value->getAdditional()->getBank()??"--":"--"; ?></td>
                            <td><?php echo $value->getName()??"--"; ?></td>
                            <td><?php echo $value->getModel()??"--"; ?></td>
                            <td><?php echo $value->getMaker()??"--"; ?></td>
                            <td><?php echo $value->getModel_year()??"--"; ?></td>
                            <td><?php echo $value->getChassis()??"--"; ?></td>
                                <?php if($userType==1){
                                    ?>
                                        <td><?php echo $value->getAdditional()!==null?($value->getAdditional()->getBank()??"--"):"--"; ?></td>
                                        <td><?php echo $value->getPriceObject()!==null?$value->getPriceObject()->getPrice1()??"--":"--"; ?></td>
                                        <td><?php echo $value->getPriceObject()!==null?$value->getPriceObject()->getBuying()??"--":"--"; ?></td>
                                        <td><?php echo $value->getDeductions()!==null?$value->getDeductions()->getRtax()??"--":"--"; ?></td>
                                        <td><?php echo $value->getDeductions()!==null?$value->getDeductions()->getAtax()??"--":"--"; ?></td>
                                        <td><?php echo $value->getDeductions()!==null?$value->getDeductions()->getAu_cha()??"--":"--"; ?></td>
                                        <td><?php echo $value->getDeductions()!==null?$value->getDeductions()->getTrasport()??"--":"--"; ?></td>
                                        <td><?php echo $value->getDeductions()!==null?$value->getDeductions()->getStorage()??"--":"--"; ?></td>
                                        <td><?php echo $value->getDeductions()!==null?$value->getDeductions()->getInsurance()??"--":"--"; ?></td>
                                        <td><?php echo $value->getDeductions()!==null?$value->getDeductions()->getRepair()??"--":"--"; ?></td>
                                        <td><?php echo $value->getDeductions()!==null?$value->getDeductions()->getOther()??"--":"--"; ?></td>
                                        <td><?php echo $value->getPriceObject()!==null?$value->getPriceObject()->getSelling()??"--":"--"; ?></td>
                                    <?php
                                } ?>
                            <td><?php echo $value->getPriceObject()!==null?$value->getPriceObject()->getPublic()??"--":"--"; ?></td>
                            <td><form class="form-inline" action="add_vehicle.php" method="post">
                                <div class="form-group">
                                    <input type="hidden" id="carId" name="carId" value="<?php echo $value->getId();?>">
                                    <button class="bttn Bu_one" class="form-control" name="download" >Edit</button>
                                </div>
                            </form></td>
                        </tr>
                    <?php
                        }
                    ?>
<!--  End of 1st details row-->
<!--  2nd details row    Samples    -->

<!--  End of 2nd details row-->
<!--  3rd details row Samples -->

<!--  end of 3rd details row-->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
<!-- End Attendance list section -->

</div>

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
<script src="vendor/parallax100/parallax100.js"></script>
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

<script>
$(document).ready(function(){
	// Activate tooltips
	$('[data-toggle="tooltip"]').tooltip();
    
	// Filter table rows based on searched term
    $("#search").on("keyup", function() {
        var term = $(this).val().toLowerCase();
        $("table tbody tr").each(function(){
            $row = $(this);
            var name = $row.find("td:nth-child(1)").text().toLowerCase();
            console.log(name);
            if(name.search(term) < 0){                
                $row.hide();
            } else{
                $row.show();
            }
        });
    });
});
</script>
</body>
</html>
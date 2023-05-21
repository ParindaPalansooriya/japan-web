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

$day1 = null;
$day2 = null;
require_once('../php/config.php');
require_once('../php/car_dao.php');

$summery = [];

if(isset($_POST['delete-car']) && isset($_POST['carId']) && !empty($_POST['carId'])){
    moveCarBackToStore($link,$_POST['carId']);
}

if(isset($_POST['all'])){
    $day1 = null;
    $day2 = null;
    $summery = getAllSoledCarsForReport($link,null,null);
}else{
    if(isset($_POST['date1']) && !empty($_POST['date1']) && isset($_POST['date2']) && !empty($_POST['date2'])){
        $day1 = $_POST['date1'];
        $day2 = $_POST['date2'];
        $summery = getAllSoledCarsForReport($link,$_POST['date1'],$_POST['date2']);
    }else{
        $day1 = null;
        $day2 = null;
        $summery = getAllSoledCarsForReport($link,null,null);
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
    <title>Sales Report</title>
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
    <!-- <link rel="icon" type="image/png" href="../images/icons/favicon.png"/> -->
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
    <script type="text/javascript" src="https://unpkg.com/xlsx@0.15.1/dist/xlsx.full.min.js"></script>
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
                            <h3>Sales Report</h3>
                        </div>
                    </div>
                </div>
                <div class="gjs-cell" id="ijl1">
                    <div class="heading_container heading_center">
                        <div class="col-center">
                            <div class="form-inline" >
                                <form method="post">
                                    <div class="form-group">
                                        <input class="bttn Bu_one" id="date1" name="date1" style="margin-right: 10px;" type="date" value="<?php echo $day1;?>">
                                        <h5 style=" padding-right: 10px; font-weight: bold;">TO</h5>
                                        <input class="bttn Bu_one" id="date2" name="date2" style="margin-right: 10px;" type="date" value="<?php echo $day2;?>">
                                        <button class="bttn Bu_one" class="form-control" name="pick" style="margin-right: 10px;" >Pick Date</button>
                                        <button class="bttn Bu_one" class="form-control" name="all" >See All</button>
                                    </div>
                                </form>
                                <div class="form-group">
                                    <button class="bttn Bu_one" onclick=" htmlTableToExcel('xlsx') " class="form-control" name="download" >Download</button>
                                </div> 
                            </div>
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
                            <div class="form-inline">
                                <div class="form-control" style="margin-right: 10px; margin-bottom: 10px; max-width: 150px;">
                                    <div class="form-inline">
                                        <input style="width: 20px; height: 20px;" type="checkbox" id="checkbox0" >
                                        <a style="padding-left: 10px;"> No Block</a>
                                    </div>
                                </div>
                                <div class="form-control" style="margin-right: 10px; margin-bottom: 10px; max-width: 150px;">
                                    <div class="form-inline">
                                        <input style="width: 20px; height: 20px;" type="checkbox" id="checkbox1" >
                                        <a style="padding-left: 10px;"> 1 Kojo</a>
                                    </div>
                                </div>
                                <div class="form-control" style="margin-right: 10px; margin-bottom: 10px; max-width: 150px;">
                                    <div class="form-inline">
                                        <input style="width: 20px; height: 20px;" type="checkbox" id="checkbox2" >
                                        <a style="padding-left: 10px;"> Sale 1</a>
                                    </div>
                                </div>
                                <div class="form-control" style="margin-right: 10px; margin-bottom: 10px; max-width: 150px;">
                                    <div class="form-inline">
                                        <input style="width: 20px; height: 20px;" type="checkbox" id="checkbox3" >
                                        <a style="padding-left: 10px;"> 2 Kojo</a>
                                    </div>
                                </div>
                                <div class="form-control" style="margin-right: 10px; margin-bottom: 10px; max-width: 150px;">
                                    <div class="form-inline">
                                        <input style="width: 20px; height: 20px;" type="checkbox" id="checkbox4" >
                                        <a style="padding-left: 10px;"> Sale 2</a>
                                    </div>
                                </div>
                                <div class="form-control" style="margin-right: 10px; margin-bottom: 10px; max-width: 150px;">
                                    <div class="form-inline">
                                        <input style="width: 20px; height: 20px;" type="checkbox" id="checkbox5" >
                                        <a style="padding-left: 10px;"> 3 Kojo</a>
                                    </div>
                                </div>
                                <div class="form-control" style="margin-right: 10px; margin-bottom: 10px; max-width: 150px;">
                                    <div class="form-inline">
                                        <input style="width: 20px; height: 20px;" type="checkbox" id="checkbox6" >
                                        <a style="padding-left: 10px;"> Sale 3</a>
                                    </div>
                                </div>
                                <div class="form-control" style="margin-right: 10px; margin-bottom: 10px; max-width: 150px;">
                                    <div class="form-inline">
                                        <input style="width: 20px; height: 20px;" type="checkbox" id="checkbox7" >
                                        <a style="padding-left: 10px;"> Miho Kojo</a>
                                    </div>
                                </div>
                                <div class="form-control" style="margin-right: 10px; margin-bottom: 10px; max-width: 150px;">
                                    <div class="form-inline">
                                        <input style="width: 20px; height: 20px;" type="checkbox" id="checkbox8" >
                                        <a style="padding-left: 10px;"> Export</a>
                                    </div>
                                </div>
                                <div class="form-control" style="margin-right: 10px; margin-bottom: 10px; max-width: 150px;">
                                    <div class="form-inline">
                                        <input style="width: 20px; height: 20px;" type="checkbox" id="checkbox9" >
                                        <a style="padding-left: 10px;"> USS</a>
                                    </div>
                                </div>
                                <div class="form-control" style="margin-right: 10px; margin-bottom: 10px; max-width: 150px;">
                                    <div class="form-inline">
                                        <input style="width: 20px; height: 20px;" type="checkbox" id="checkbox10" >
                                        <a style="padding-left: 10px;"> CAA</a>
                                    </div>
                                </div>
                                <div class="form-control" style="margin-right: 10px; margin-bottom: 10px; max-width: 150px;">
                                    <div class="form-inline">
                                        <input style="width: 20px; height: 20px;" type="checkbox" id="checkbox11" >
                                        <a style="padding-left: 10px;"> Other Option</a>
                                    </div>
                                </div>
                                <div class="form-control" style="margin-right: 10px; margin-bottom: 10px; max-width: 150px;">
                                    <div class="form-inline">
                                        <input style="width: 20px; height: 20px;" type="checkbox" id="checkbox12" >
                                        <a style="padding-left: 10px;"> Parts</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="search-box">
                                <input type="text" id="search" class="form-control" placeholder="Search by Chassis Or Code">
                            </div>
                        </div>
                    </div>
            <div class="table-responsive">

                <table class="table custom-table" id="tblToExcl">
                    <thead>
                    <tr>
                        <th scope="col">Code</th>
                        <th scope="col">Sold Date</th>
                        <th scope="col">Store</th>
                        <th scope="col">Supplier</th>
                        <th scope="col">Perfecture</th>
                        <th scope="col">Name</th>
                        <th scope="col">Maker</th>
                        <th scope="col">Model Year</th>
                        <th scope="col">Chassis</th>
                        <?php if($type==1){
                            ?>
                        <th scope="col">Bank</th>
                        <th scope="col">Bank Date</th>
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
                        <th scope="col">Total Cost</th>
                            <?php
                        } ?>
                        <th scope="col">Sold Price</th>
                        <!-- <th scope="col"></th> -->
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
                            <td><?php echo $value->getName()??"--"; ?></td>
                            <td><?php echo $value->getMaker()??"--"; ?></td>
                            <td><?php echo $value->getModel_year()??"--"; ?></td>
                            <td><?php echo $value->getChassis()??"--"; ?></td>
                                <?php if($type==1){
                                    ?>
                                        <td><?php echo $value->getAdditional()!==null?($value->getAdditional()->getBank()??"--"):"--"; ?></td>
                                        <td><?php echo $value->getBank_date()??"--"; ?></td>
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
                            <td><?php echo $value->getPriceObject()!==null?$value->getPriceObject()->getPrice2()??"--":"--"; ?></td>
                            <td>
                                <a>
                                <button class="bttn Bu_one" style="margin-top: 5px;" onclick="viewDelete(<?php echo $value->getId();?>)" id="delete" >RESTOCK</button>
                                </a></td>
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

<!-- Trigger/Open The Modal -->
<!-- The Modal -->
<div id="myModal" class="modal">

    <!-- Modal content -->
    <div class="modal-content">
        <span class="close">&times;</span>
        <p>Please conform to Re-Stock</p>
        <div class="container-width">
        <div class="box">
                        <form id="formAwesome" enctype="multipart/form-data" method="post">
                            <div class="modal-body">
                            <div class="gjs-cell">
                                <div class="heading_container heading_center">
                                    <input type="hidden" id="carId" name="carId">
                                    <button id="Bttn" Class="swal-button" name="delete-car">RESTOCK</button>
                                </div>
                            </div>
                            </div>
                        </form>
                    </div>
    </div>
    </div>

</div>

</div>
<!-- Popup box-->
<script>
    // Get the modal
    var modal = document.getElementById("myModal");

    // Get the button that opens the modal
    // var delete1 = document.getElementById("delete");

    // Get the <span> element that closes the modal
    var span = document.getElementsByClassName("close")[0];

    // When the user clicks the button, open the modal
    // delete1.onclick = function() {
    //     modal.style.display = "block";
    // }

    function viewDelete(id){
        modal.style.display = "block";
        document.getElementById("carId").value = id;
    }

    // When the user clicks on <span> (x), close the modal
    span.onclick = function() {
        modal.style.display = "none";
    }

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
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
	var array = [];
    var term = null;

	// Activate tooltips
	$('[data-toggle="tooltip"]').tooltip();
    
	// Filter table rows based on searched term
    $("#search").on("keyup", function() {
        term = $(this).val().toLowerCase();
        $("table tbody tr").each(function(){
            $row = $(this);
            var name = $row.find("td:nth-child(10)").text().toLowerCase();
            var block = $row.find("td:nth-child(1)").text().toLowerCase();
            const index = array.indexOf(block);
            if(name.search(term) < 0){                
                $row.hide();
            } else{
                if(array.length === 0){
                    $row.show();
                }else{
                    if(index < 0){                
                        $row.hide();
                    } else{
                        $row.show();
                    }
                }
            }

            var code = $row.find("td:nth-child(1)").text().toLowerCase();
            if(code.search(term) >= 0){                
                if(array.length === 0){
                    $row.show();
                }else{
                    if(index < 0){                
                        $row.hide();
                    } else{
                        $row.show();
                    }
                }
            }
        });
    });

    $("#checkbox0").on("change", function() {
        if(this.checked){
            array.push("no block");
        }else{
            const index = array.indexOf("no block");
            console.log(index);
            if (index > -1) {
                array.splice(index, 1);
            }
        }
        showRows();
    });

    $("#checkbox1").on("change", function() {
        if(this.checked){
            array.push("1 kojo");
        }else{
            const index = array.indexOf("1 kojo");
            console.log(index);
            if (index > -1) {
                array.splice(index, 1);
            }
        }
        showRows();
    });

    $("#checkbox2").on("change", function() {
        if(this.checked){
            array.push("1 sale");
        }else{
            const index = array.indexOf("1 sale");
            console.log(index);
            if (index > -1) {
                array.splice(index, 1);
            }
        }
        showRows();
    });

    $("#checkbox3").on("change", function() {
        if(this.checked){
            array.push("2 kojo");
        }else{
            const index = array.indexOf("2 kojo");
            console.log(index);
            if (index > -1) {
                array.splice(index, 1);
            }
        }
        showRows();
    });

    $("#checkbox4").on("change", function() {
        if(this.checked){
            array.push("2 sale");
        }else{
            const index = array.indexOf("2 sale");
            console.log(index);
            if (index > -1) {
                array.splice(index, 1);
            }
        }
        showRows();
    });

    $("#checkbox5").on("change", function() {
        if(this.checked){
            array.push("3 kojo");
        }else{
            const index = array.indexOf("3 kojo");
            console.log(index);
            if (index > -1) {
                array.splice(index, 1);
            }
        }
        showRows();
    });

    $("#checkbox6").on("change", function() {
        if(this.checked){
            array.push("3 sale");
        }else{
            const index = array.indexOf("3 sale");
            console.log(index);
            if (index > -1) {
                array.splice(index, 1);
            }
        }
        showRows();
    });

    $("#checkbox7").on("change", function() {
        if(this.checked){
            array.push("miho kojo");
        }else{
            const index = array.indexOf("miho kojo");
            console.log(index);
            if (index > -1) {
                array.splice(index, 1);
            }
        }
        showRows();
    });

    $("#checkbox8").on("change", function() {
        if(this.checked){
            array.push("export");
        }else{
            const index = array.indexOf("export");
            console.log(index);
            if (index > -1) {
                array.splice(index, 1);
            }
        }
        showRows();
    });

    $("#checkbox9").on("change", function() {
        if(this.checked){
            array.push("uss");
        }else{
            const index = array.indexOf("uss");
            console.log(index);
            if (index > -1) {
                array.splice(index, 1);
            }
        }
        showRows();
    });

    $("#checkbox10").on("change", function() {
        if(this.checked){
            array.push("caa");
        }else{
            const index = array.indexOf("caa");
            console.log(index);
            if (index > -1) {
                array.splice(index, 1);
            }
        }
        showRows();
    });

    $("#checkbox11").on("change", function() {
        if(this.checked){
            array.push("other option");
        }else{
            const index = array.indexOf("other option");
            console.log(index);
            if (index > -1) {
                array.splice(index, 1);
            }
        }
        showRows();
    });

    $("#checkbox12").on("change", function() {
        if(this.checked){
            array.push("parts");
        }else{
            const index = array.indexOf("parts");
            console.log(index);
            if (index > -1) {
                array.splice(index, 1);
            }
        }
        showRows();
    });

    function showRows(){
        document.getElementById('search').value = ''
        $("table tbody tr").each(function(){
            $row = $(this);
            if(array.length === 0){
                $row.show();
            }else{
                const exportIndex = array.indexOf("export");
                var name = $row.find("td:nth-child(3)").text().toLowerCase();
                console.log(name);
                const index = array.indexOf(name.replace(" - export", ""));

                if(exportIndex>=0 ){
                    if(array.length==1 && name.endsWith("export")){
                        $row.show();
                    }else if(index >= 0 && name.endsWith("export")){
                        $row.show();
                    }else{
                        $row.hide();
                    }
                }else{
                    if(index >= 0){
                        $row.show();
                    }else{
                        $row.hide();
                    }
                }
            }
        });
    }
});

function htmlTableToExcel(type){
    var data = document.getElementById('tblToExcl');
    var date1 = document.getElementById('date1');
    var date2 = document.getElementById('date2');

    var excelFile = XLSX.utils.table_to_book(data, {sheet: "sheet1"});
    XLSX.write(excelFile, { bookType: type, bookSST: true, type: 'base64' });
    if(date1.value=="" && date2.value==""){
        XLSX.writeFile(excelFile, 'Sales full report.' + type);
    }else{
        XLSX.writeFile(excelFile, 'Sales report '+date1.value+' to '+date2.value+'.' + type);
    }
}
</script>
</body>
</html>
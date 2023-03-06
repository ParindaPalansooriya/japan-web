
<?php 
$queries = array();
$carId=null;

parse_str($_SERVER['QUERY_STRING'], $queries);
if(isset($queries) && !empty($queries)){
   if(isset($queries['id']) && !empty($queries['id'])){
      $carId = $queries['id'];
   }
}

require_once('./php/config.php');
require_once "./php/car_module.php";
require_once "./php/car_dao.php";
require_once "./php/car_image_module.php";
require_once "./php/car_image_dao.php";
require_once "./php/user_inquary_dao.php";

$imagers = array();


if (isset($carId) && isset($_POST['submit'])) {
    // print_r($_POST['submit']);
    $user_name = $_REQUEST['user_name'];
    $email = $_REQUEST['email'];
    $mobile = $_REQUEST['mobile'];
    $nearest_port = $_REQUEST['nearest_port'];
    $message = $_REQUEST['message'];
    if(insertUserInquary($link,$carId,$user_name,$email,$mobile,$nearest_port,$message)>0){
        echo '<script>alert("Successfully submited")</script>';
        header("Location: index.php"); 
        exit();
    }else{
        echo '<script>alert("Submit Error!")</script>';
    }
}

if(isset($carId)){
    $car = getCarsById($link,$carId);
    // if(isset($car)){
    //     echo $car->id;
    // }
    $imagers = getAllCarImagers($link,$carId);
    if(!isset($imagers) || empty($imagers)){
        array_push($imagers,"images/noimage.jpg");
    }
    // print_r($imagers);
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
    <link rel="shortcut icon" href="images/logo.png" type="">
    <title>Vehicle Preview</title>
    <!-- bootstrap core css -->
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css" />
    <!-- font awesome style -->
    <link href="css/font-awesome.min.css" rel="stylesheet" />
    <!-- Custom styles for this template -->
    <link href="css/style.css" rel="stylesheet" />
    <!-- responsive style -->
    <link href="css/responsive.css" rel="stylesheet" />
    <!-- Image preview  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css'>
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.3.0/ekko-lightbox.css'>
    <link rel="stylesheet" href="./css/style_image.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/prefixfree/1.0.7/prefixfree.min.js"></script>


    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--===============================================================================================-->
    <link rel="icon" type="image/png" href="images/icons/favicon.png"/>
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="fonts/iconic/css/material-design-iconic-font.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="fonts/linearicons-v1.0.0/icon-font.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/slick/slick.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/MagnificPopup/magnific-popup.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/perfect-scrollbar/perfect-scrollbar.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="css/util.css">
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <!--===============================================================================================-->
</head>

<style>
    /*  button section   */
    * {
        box-sizing: border-box;
    }
      .button {
         display: inline-block;
         border-radius: 4px;
         background-color: #f4511e;
         border: none;
         border-color: teal;
         color: #FFFFFF;
         text-align: center;
         font-size: 20px;
         padding: 10px;
         width: 200px;
         transition: all 0.5s;
         cursor: pointer;
         margin: 5px;
         }

         .button span {
         cursor: pointer;
         display: inline-block;
         position: relative;
         transition: 0.5s;
         }

         .button span:after {
         content: '\00bb';
         position: absolute;
         opacity: 0;
         top: 0;
         right: -20px;
         transition: 0.5s;
         }

         .button:hover span {
         padding-right: 25px;
         border-color: teal;
         }
         .button:hover {
            color: black;
         }

         .button:hover span:after {
         opacity: 1;
         right: 0;
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
        border-radius: 10px;
        background-color: orange;
        color: white;
        padding: 8px 28px;
        font-size: 16px;
        font-weight: 800;

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
                <div class="gjs-cell" id="ijl1">
                    <div class="heading_container heading_center">
                        <div class="col-center">
                            <a href="https://www.carsensor.net/shop/ibaraki/226235001/" target="_blank">
                                <button  id="butt2" Class="button" name="Action" style="vertical-align:middle; background-color: green"><span>Sale 1</span></button>
                            </a>
                            <a href="https://www.carsensor.net/shop/ibaraki/226235002/" target="_blank">
                                <button  id="butt2" Class="button" name="Action" style="vertical-align:middle; background-color: orange"><span>Sale 2</span></button>
                            </a>
                            <a href="https://www.carsensor.net/shop/ibaraki/226235003/" target="_blank">
                                <button  id="butt2" Class="button" name="Action" style="vertical-align:middle; background-color: red"><span>Sale 3</span></button>
                            </a>
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
                                                <img src="<?php echo "images/cars/".$value->getImage(); ?>"  style="max-width: 800px; object-fit: contain;" alt="...">
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
                                                <img src="<?php echo "images/cars/".$value->getImage(); ?>" style="width: 100%; aspect-ratio: 6/4; " class="img-fluid" alt="...">
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
                                        <th scope="col"><h4><?php echo $car->getPrice(); ?></h4></th>
                                    </tr>
                                </thead>
                            </table></div>
                            <div class="row">
                                <div  class="col-sm-6" style="background-color:#ffffff;">
                                    <p style="padding-bottom: 5px; margin-top: 10px;">Code : <?php echo sprintf(" (VEH_%05d)", $car->getId()); ?></p>
                                    <p style="padding-bottom: 5px; margin-top: 10px;">Make : <?php echo $car->getMaker(); ?></p>
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
                                    <p style="padding-bottom: 5px;">Condition : <?php echo $car->getIs_used()==2?"Accident Repair":($car->getIs_used()==0?"New":"Used"); ?></p>
                                    <p style="padding-bottom: 5px;">Weel : <?php echo $car->getIs_two_weel()==0?"4 Weel":"2 Weel"; ?></p>
                                    <p style="padding-bottom: 5px;">Steering : <?php echo $car->getIs_steering_right()==0?"Left":"Right"; ?></p>
                                    </br>
                                </div>
                            </div>
                            <?php if( null !== $car->getNote() && !empty($car->getNote())){?>
                                <p style="padding-bottom: 15px; margin-top: 10px;">note : <?php echo $car->getNote(); ?></p>
                            <?php } ?>
                        <div class="gjs-cell">
                            <div class="heading_container heading_center">
                                <button id="Bttn" Class="swal-button" name="Action">Action</button>
                            </div>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php }?>
</body>
<!-- end box with filter section -->


<!-- Trigger/Open The Modal -->
<!-- The Modal -->
<div id="myModal" class="modal">

    <!-- Modal content -->
    <div class="modal-content">
        <span class="close">&times;</span>
        <p>Please Fill All Details</p>
        <div class="container-width">
        <div class="box">
                    <form id="formAwesome" action="vehicle_preview.php?id=<?php echo $carId; ?>" enctype="multipart/form-data" method="post">
                            <div class="modal-body">
                            <div class="form-group row">
                                <label for="text" style="font-size:0.8em" class="col-sm-6 col-form-label">
                                Your Name
                                </label>
                                <input type="text" name="user_name" style="font-size:0.8em" class="form-control" id="user_name"  required>
                            </div>
                            <div class="form-group row">
                                <label for="text" style="font-size:0.8em" class="col-sm-6 col-form-label">
                                Email Address
                                </label>
                                <input type="email" name="email" style="font-size:0.8em" class="form-control" id="email"  required>
                            </div>
                            <div class="form-group row">
                                <label for="text" style="font-size:0.8em" class="col-sm-6 col-form-label">
                                Contact Number
                                </label>
                                <input type="text" name="mobile" style="font-size:0.8em" class="form-control" id="mobile" required>
                            </div>
                            <div class="form-group row">
                                <label for="text" style="font-size:0.8em" class="col-sm-6 col-form-label">
                                Nearest Port
                                </label>
                                <input type="text" name="nearest_port" style="font-size:0.8em" class="form-control" id="nearest_port"  required>
                            </div>
                            <div class="form-group row">
                                <label for="text" style="font-size:0.8em" class="col-sm-6 col-form-label">
                                Special Message
                                </label>
                                <input type="text" name="message" style="font-size:0.8em" class="form-control" id="message">
                            </div>
                            <div class="gjs-cell">
                                <div class="heading_container heading_center">
                                    <button id="Bttn" Class="swal-button" name="submit">Action</button>
                                </div>
                            </div>
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
    var btn = document.getElementById("Bttn");

    // Get the <span> element that closes the modal
    var span = document.getElementsByClassName("close")[0];

    // When the user clicks the button, open the modal
    btn.onclick = function() {
        modal.style.display = "block";
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
<script src="js/jquery-3.4.1.min.js"></script>
<!-- popper js -->
<script src="js/popper.min.js"></script>
<!-- bootstrap js -->
<script src="js/bootstrap.js"></script>
<!-- custom js -->
<script src="js/custom.js"></script>
<!--===============================================================================================-->
<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
<script src="vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
<script src="vendor/bootstrap/js/popper.js"></script>
<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
<script src="vendor/select2/select2.min.js"></script>
<script>
    $(".js-select2").each(function(){
        $(this).select2({
            minimumResultsForSearch: 20,
            dropdownParent: $(this).next('.dropDownSelect2')
        });
    })
</script>
<!--===============================================================================================-->
<script src="vendor/daterangepicker/moment.min.js"></script>
<script src="vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
<script src="vendor/slick/slick.min.js"></script>
<script src="js/slick-custom.js"></script>
<!--===============================================================================================-->
<script src="vendor/parallax100/parallax100.js"></script>
<script>
    $('.parallax100').parallax100();
</script>
<!--===============================================================================================-->
<script src="vendor/MagnificPopup/jquery.magnific-popup.min.js"></script>
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
<script src="vendor/isotope/isotope.pkgd.min.js"></script>
<!--===============================================================================================-->
<script src="vendor/sweetalert/sweetalert.min.js"></script>
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
<script src="vendor/perfect-scrollbar/perfect-scrollbar.min.js"></script>
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
<script src="js/main.js"></script>

<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js'></script>
<script src='https://stackpath.bootstrapcdn.com/bootstrap/4.3.0/js/bootstrap.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.3.0/ekko-lightbox.js'></script>
<script  src="./js/script.js"></script>

</body>
</html>
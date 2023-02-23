
<?php
ob_start();
session_start();
if(!isset($_SESSION['id']) || !isset($_SESSION['timeout']) || ($_SESSION['timeout']+(60*30)) < time()){
    header("Location: login.php"); 
}else{
    $_SESSION['timeout'] = time();
}

    require_once '../php/config.php';
    require_once "../php/car_module.php";
    require_once "../php/car_dao.php";
    require_once "../php/contact_us_dao.php";
    require_once "../php/customer_dao.php";

    $sellingCount = sizeof(getAllUserSellingCarsForAdminLists($link));
    $buyingCount = sizeof(getAllUserBuyingCarsForAdminLists($link));
    $contactCount = sizeof(getAllContactUs($link,false));
    $bdyCount = sizeof(getAllCustomers($link,date("Y-m-d")));


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
</head>

<style>
    /*  button section   */
    * {
        box-sizing: border-box;
    }

    .bttn_st {
        border: 2px solid red;
        border-radius: 5px;
        background-color: red;
        color: white;
        padding: 8px 28px;
        font-size: 16px;
        font-weight: bold;

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

    .butt3 {
        border: 2px solid #04AA6D;
        border-radius: 5px;
        background-color: #ffffff;
        color: #04AA6D;
        padding: 8px 28px;
        font-size: 16px;

    }

    .butt4 {
        border: 2px solid #f44336;
        border-radius: 5px;
        background-color: #ffffff;
        color: #f44336;
        padding: 8px 28px;
        font-size: 16px;

    }

    .butt5 {
        border: 2px solid palevioletred;
        border-radius: 5px;
        background-color: #ffffff;
        color: palevioletred;
        padding: 8px 28px;
        font-size: 16px;

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
    /*   end  Header left/center/right code*/
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
                        <h3>Admin Panel</h3>
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
            <br>
            <h4>Notifications</h4>
            <br>
            <div class="table-responsive">

                <table class="table custom-table">
                    <thead>
                    <tr>
                        <th scope="col" style="width:70%">User Contact Requests</th>
                        <th scope="col"><?php echo $contactCount ?></th>
                    </tr>
                    <tr>
                        <th scope="col" style="width:70%">User Selling Request</th>
                        <th scope="col"><?php echo $sellingCount ?></th>
                    </tr>
                    <tr>
                        <th scope="col" style="width:70%">User Orders</th>
                        <th scope="col"><?php echo $buyingCount ?></th>
                    </tr>
                    <tr>
                        <th scope="col" style="width:70%">Today Birthday Loyalty Customers</th>
                        <th scope="col"><?php echo $bdyCount ?></th>
                    </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</section>
<!-- End Attendance list section -->

    <br>
    <br>
    <br>

    <!-- List 2 section -->
    <section>
        <div class="content">
            <div class="container">
                <div class="table-responsive">
                    <table class="table custom-table">
                        <tbody>
                        <!--   1st details row-->
                        <tr>
                            <td style="padding-top: 100px;">
                                <a href="contact_us_list.php">
                                    <button  id="butt2" Class="butt2" name="Action">Contact Requests</button>
                                </a>
                            </td>
                            <td style="padding-top: 100px;">
                                <a href="user_selling_requests.php">
                                    <button  id="butt3" Class="butt3" name="Action">Selling Request</button>
                                </a>
                            </td>
                            <td style="padding-top: 100px;">
                                <a href="user_buying_requests.php">
                                    <button  id="butt4" Class="butt4" name="Action">Orders</button>
                                </a>
                            </td>
                            <td style="padding-top: 100px;">
                                <a href="car_listed_page.php">
                                    <button  id="butt5" Class="butt5" name="Action">Store Manage</button>
                                </a>
                            </td>
                            <td style="padding-top: 100px;">
                                <a href="add_vehicle.php" target="_blank">
                                    <button  id="butt5" Class="bttn_st" name="Action">Add to Store</button>
                                </a>
                            </td>
                        </tr>
                        </tbody>
                        <div>
                        <h3>Admin Panel</h3>
                        </div>
                        <tbody>
                        <!--  1st details row-->
                        <tr>
                            <td style="padding-top: 20px;">
                                <a href="day_end_submit.php" target="_blank">
                                    <button  id="butt2" Class="butt2" name="Action">Day Summery</button>
                                </a>
                            </td>
                            <td style="padding-top: 20px;">
                                <a href="day_end_customer_submit.php" target="_blank">
                                    <button  id="butt3" Class="butt3" name="Action">Custom Summery</button>
                                </a>
                            </td>
                            <td style="padding-top: 20px;">
                                <a href="day_end_submit_list.php" target="_blank">
                                    <button  id="butt4" Class="butt4" name="Action">Day Summery List</button>
                                </a>
                            </td>
                            <td style="padding-top: 20px;">
                                <a href="day_end_customer_submit_list.php" target="_blank">
                                    <button  id="butt5" Class="butt5" name="Action">Custom Summery List</button>
                                </a>
                            </td>
                        </tr>
                        </tbody>
                        <tbody>
                            <tr>
                                <td style="padding-top: 100px;">
                                <!-- <a>Pick Youe Report Date</a>
                                    <input class="bttn Bu_one" name="date" style="margin-right: 10px;" type="date" value="<?php echo $today;?>"> -->
                                </td>
                            </tr>
                        </tbody>
                        <tbody>
                        <tr>
                            <td style="padding-top: 20px;">
                                <a href="insert_customer.php" target="_blank">
                                    <button  id="butt1" Class="butt2" name="Action">Add Customer</button>
                                </a>
                            </td>
                            <td style="padding-top: 20px;">
                                <a href="customer_list.php" target="_blank">
                                    <button  id="butt2" Class="butt3" name="Action">Custom List</button>
                                </a>
                            </td>
                            <td style="padding-top: 20px;">
                                <a href="sales_report.php" target="_blank">
                                    <button  id="butt4" Class="butt4" name="Action">Sales Reprots</button>
                                </a>
                            </td>
                            <td style="padding-top: 20px;">
                                <a href="store_reports.php" target="_blank">
                                    <button  id="butt5" Class="butt5" name="Action">Store Reprots</button>
                                </a>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- Trigger/Open The Modal -->
<!-- The Modal -->
<div id="myModal" class="modal">

    <!-- Modal content -->
    <div class="modal-content">
        <span class="close">&times;</span>
        <p>Some text in the Modal..</p>
    </div>

</div>



<!-- Popup box-->
<script>
    // Get the modal
    var modal = document.getElementById("myModal");

    // Get the button that opens the modal
    var btn = document.getElementById("bttn");

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
</body>
</html>
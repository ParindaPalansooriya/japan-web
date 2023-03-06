
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

require_once('../php/config.php');
require_once('../php/customer_dao.php');

$customer = null;
$selectedCustomer = null;
$status=0;

if(isset($_POST['Search'])){
    $customer = getAllCustomers($link,null,$_REQUEST['c_name'],true);
    $status=1;
}

if(isset($_POST['Select'])){
    $selectedCustomer = getCustomersById($link,$_REQUEST['c_id']);
    $status=2;
}

if(isset($_POST['Submit']))
{ 
    if(insertCustomer($link,$_REQUEST['chassis'],$_REQUEST['c_name'],$_REQUEST['c_1'],$_REQUEST['c_2'],$_REQUEST['address'],$_REQUEST['date'],$_REQUEST['valid'])>0){
        echo '<script>alert("Successfuly Submited")</script>';
    }else{
        echo '<script>alert("Submition Error")</script>';
    }
}
// print_r($_POST);
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
<!-- End color buttons -3  section -->

<!-- box with filter section -->
<body class="animsition">
<section class="bg0 p-t-23 p-b-140">
    <div class="container-width">
        <div id="i14q" class="gjs-row">
            <div id="i91j" class="gjs-cell">
                <h5>Add Loyalty Customer</h5>
                <div >
                    <div class="box" >
                    <form action="insert_customer.php" enctype="multipart/form-data" method="post">
                            <div class="modal-body">
                                <?php 
                                if($status==0){
                                ?> 
                                    <div class="form-group row">
                                        <label for="text" name="name" style="font-size:0.8em" class="col-sm-6 col-form-label">
                                        Customer Name
                                        </label>
                                        <div class="col-sm-6">
                                            <input type="text" name="c_name" style="font-size:0.8em" class="form-control" id="sale" placeholder="john.doe@email.com" <?php echo $customer==null?'required':'' ?>>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" style="font-size:0.8em; " class=" bttn2" value="Search" name="Search" >Search</button>
                                    </div>
                                <?php
                                }else if($status==1 && isset($customer) && !empty($customer)){
                                    ?>
                                    <div class="table-responsive">
                                        <table class="table custom-table">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Chassis</th>
                                                    <th scope="col">Name</th>
                                                    <th scope="col">Address</th>
                                                    <th scope="col">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                                foreach ($customer as $key => $value) {
                                            ?>
                                                <tr>
                                                    <td><?php echo $value->getChassis(); ?></td>
                                                    <td><?php echo $value->getName(); ?></td>
                                                    <td><?php echo $value->getAddress(); ?></td>
                                                    <td>
                                                        <form id="formAwesome" action="customer_list.php" enctype="multipart/form-data" method="post">
                                                            <input type="hidden" id="c_id" name="c_id" value="<?php echo $value->getId();?>">
                                                            <button Class="bttn2" name="Select">Select</button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            <?php
                                                }
                                            ?>
                                            </tbody>
                                        </table>
                                        </div>
                                    
                                    <?php
                                }else{
                                ?>
                                <div class="form-group row">
                                    <label for="text" name="name" style="font-size:0.8em" class="col-sm-6 col-form-label">
                                    Customer Name
                                    </label>
                                    <div class="col-sm-6">
                                    <input type="text" value='<?php echo $selectedCustomer!==null?($selectedCustomer->getName()):""; ?>' name="c_name" style="font-size:0.8em" class="form-control" id="sale" placeholder="john.doe@email.com" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="text" name="name" style="font-size:0.8em" class="col-sm-6 col-form-label">
                                    Registered Date
                                    </label>
                                    <div class="col-sm-6">
                                    <input type="date" name="date" style="font-size:0.8em" class="form-control" id="date" value="<?php echo date("Y-m-d");?> " required>
                                    </div>
                                </div><div class="form-group row">
                                    <label for="text" name="name" style="font-size:0.8em" class="col-sm-6 col-form-label">
                                    Shakan Valid Period (Months)
                                    </label>
                                    <div class="col-sm-6">
                                    <input type="number" name="valid" style="font-size:0.8em" class="form-control" id="sale" placeholder="john.doe@email.com" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="text" name="name" style="font-size:0.8em" class="col-sm-6 col-form-label">
                                    Chassis Number
                                    </label>
                                    <div class="col-sm-6">
                                    <input type="text" name="chassis" style="font-size:0.8em" class="form-control" id="sale" placeholder="john.doe@email.com" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="text" name="name" style="font-size:0.8em" class="col-sm-6 col-form-label">
                                    Contact Number 1
                                    </label>
                                    <div class="col-sm-6">
                                    <input type="text" value='<?php echo $selectedCustomer!==null?($selectedCustomer->getContact_num1()):""; ?>' name="c_1" style="font-size:0.8em" class="form-control" id="sale" placeholder="john.doe@email.com" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="text" name="name" style="font-size:0.8em" class="col-sm-6 col-form-label">
                                    Contact Email Address
                                    </label>
                                    <div class="col-sm-6">
                                    <input type="text" value='<?php echo $selectedCustomer!==null?($selectedCustomer->getContact_num2()):""; ?>' name="c_2" style="font-size:0.8em" class="form-control" id="sale" placeholder="john.doe@email.com" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="text" name="name" style="font-size:0.8em" class="col-sm-6 col-form-label">
                                    Address
                                    </label>
                                    <div class="col-sm-6">
                                    <textarea name="address" style="font-size:0.8em" class="form-control" id="done" placeholder="john.doe@email.com" required><?php echo $selectedCustomer!==null?($selectedCustomer->getAddress()):""; ?></textarea>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" style="font-size:0.8em; " class=" bttn2" value="Submit" name="Submit" > Submit </button>
                                </div>
                                <?php } ?>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
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

<?php


require_once('./php/config.php');
require_once('./php/car_makers_dao.php');
require_once('./php/car_model_dao.php');
require_once('./php/body_style_dao.php');
require_once('./php/interior_color_dao.php');
require_once('./php/exterior_color_dao.php');

$style = getAllBodyStyle($link);
$in_cor = getAllInteriorColor($link);
$ex_cor = getAllExteriorColor($link);
$maker = getAllCarMakers($link);

$filepath = array();
if(isset($_REQUEST['filepath'])){
    $filepath = $_REQUEST['filepath'];
}
if(isset($_POST['Submit1']))
{ 
    $filepathTemp = "images/cars/".microtime_float().".png";
    if(move_uploaded_file($_FILES["file"]["tmp_name"], $filepathTemp)) 
    {
        array_push($filepath,$filepathTemp);
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
        array_splice($filepath,$pos,1);
    }
}

if(isset($_POST['Submit']))
{ 
    require_once('./php/car_dao.php');
    require_once('./php/car_image_dao.php');
    require_once('./php/car_price_dao.php');
    require_once('./php/user_inquary_dao.php');
    $maxId = insertCarFull($link,
    getData('maker_id',1),
    getData('model_id',1),
    getData('interior_color_id',1),
    getData('exterior_color_id',1),
    0,
    getData('body_style_id',0),
    getData('passengers',0),
    getData('doors',0),
    getData('name',"No Data"),
    getData('grade',0),
    getData('power',0),
    getData('model_year',0),
    getData('evaluation',"No Data"),
    getData('running',"No Data"),
    getData('cooling',"No Data"),
    getData('model',"No Data"),
    getData('fuel',"No Data"),
    getData('chassis',"No Data"),
    getData('dimensions_L',0),
    getData('dimensions_W',0),
    getData('dimensions_H',0),
    getData('transmission_shift',0),
    getData('is_used',0),
    getData('is_two_weel',0),
    getData('is_steering_right',0),
    getData('in_col',"No Data"),
    getData('ex_col',"No Data")
    );
    if(isset($filepath)){
        foreach ($filepath as $key2 => $value1) {
            insertCarImagers($link,$value1,$key2!=0?0:1,$maxId);
        }
    }
    insertCarPrice($link,$maxId,0,0,0,0,0);
    insertUserSellingInquary($link,$maxId,getData('c_name',"No Data"),getData('email',"No Data"),getData('mobile',"No Data"));
    echo '<script>alert("Successfully submited")</script>';
    header("Location: index.php"); 
    exit();
}


function getData($key,$defualt){
    if(array_key_exists($key,$_REQUEST)){
        return $_REQUEST[$key];
    }
    return $defualt;
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
    <link rel="shortcut icon" href="images/logo.png" type="">
    <title>Vehicle seller page</title>
    <!-- bootstrap core css -->
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css" />
    <!-- font awesome style -->
    <link href="css/font-awesome.min.css" rel="stylesheet" />
    <!-- Custom styles for this template -->
    <link href="css/style.css" rel="stylesheet" />
    <!-- responsive style -->
    <link href="css/responsive.css" rel="stylesheet" />
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

<!-- Button section -->
<!-- <header class="header_section">
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
</header> -->
<!-- End color buttons -3  section -->


<!-- Text field section -->
<section class="arrival_section" style="margin-top: 100px;">
    <div class="container">
        <div class="heading_container heading_center">
            <div class="heading_container">
                <h3>
                    WE ARE THE BEST SELLERS
                </h3>
            </div>
            <p style="margin-top: 20px;margin-bottom: 30px;">
                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                Ut enim ad minim veniam, quis nostrud             </p>
        </div>
    </div>
</section>
<!-- end Text field section -->

<!-- box with filter section -->
<body class="animsition">
<section class="bg0 p-t-23 p-b-140">
    <div class="container-width">
        <form id="formSubmit" action="vehicle_selling_page.php" enctype="multipart/form-data" method="post">

        <div id="i14q" class="gjs-row">
            <div id="i91j" class="gjs-cell">
                <h5>車両詳細</h5>
                <div >
                    <div class="box" >
                    <form id="formAwesome" action="vehicle_selling_page.php" enctype="multipart/form-data" method="post">
                            <div class="modal-body">
                            <div class="form-group row">
                                <label for="firstName" style="font-size:0.8em" class="col-sm-6 col-form-label">
                                車名
                                </label>
                                <div class="col-sm-6">
                                <input type="text" name="name" style="font-size:0.8em" class="form-control" id="firstName" placeholder="Nissan">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="firstName" style="font-size:0.8em" class="col-sm-6 col-form-label">
                                車両型式
                                </label>
                                <div class="col-sm-6">
                                <input type="text" name="model" style="font-size:0.8em" class="form-control" id="firstName" placeholder="Nissan">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="firstName" style="font-size:0.8em" class="col-sm-6 col-form-label">
                                車台番号
                                </label>
                                <div class="col-sm-6">
                                <input type="text" name="chassis" style="font-size:0.8em" class="form-control" id="firstName" placeholder="Nissan">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="firstName" style="font-size:0.8em" class="col-sm-6 col-form-label">
                                グレード
                                </label>
                                <div class="col-sm-6">
                                <input type="text" name="grade" style="font-size:0.8em" class="form-control" id="firstName" placeholder="Nissan">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="firstName" style="font-size:0.8em" class="col-sm-6 col-form-label">
                                走行距離
                                </label>
                                <div class="col-sm-6">
                                <input type="text" name="running" style="font-size:0.8em" class="form-control" id="firstName" placeholder="Nissan">
                                </div>
                            </div>
                            <hr>
                            <div class="form-group row">
                                <label for="text" name="name" style="font-size:0.8em" class="col-sm-6 col-form-label">
                                連絡先
                                </label>
                                <div class="col-sm-6">
                                <input type="text" name="c_name" style="font-size:0.8em" class="form-control" id="email" placeholder="Jone" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="text" name="name" style="font-size:0.8em" class="col-sm-6 col-form-label">
                                連絡先番号
                                </label>
                                <div class="col-sm-6">
                                <input type="text" name="mobile" style="font-size:0.8em" class="form-control" id="email" placeholder="0X-XXXX-XXXX" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="text" name="name" style="font-size:0.8em" class="col-sm-6 col-form-label">
                                連絡先メールアドレス
                                </label>
                                <div class="col-sm-6">
                                <input type="email" name="email" style="font-size:0.8em" class="form-control" id="email" placeholder="john@email.com">
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
                                <button type="submit" style="font-size:0.8em; " class=" bttn2" value="Submit" name="Submit">送信</button>
                            </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>


            <div id="i88c" class="gjs-cell">
                <h5>イメージャーを選ぶ</h5>
                <div class="heading_center">
                <form action="vehicle_selling_page.php" enctype="multipart/form-data" method="post">
                                <?php
                                if(isset($filepath)){
                                    foreach ($filepath as $key2 => $value1) {
                                        echo '<input type="hidden" name="filepath['.$key2.']" value="'.$value1.'" />';
                                    }
                                }
                                ?>
                            <label for="awesomeness" style="font-size:0.8em" class="col-sm-6 col-form-label">
                               車両イメージャを選択</label>
                            <input type="file" style="margin-left: 20px; font-size:0.8em" name="file"><br/><br/>
                            <input type="submit" class="bttn2" style="font-size:0.8em;" value="アップロード" name="Submit1"> <br/>
                            </form>
                        <div class="box">
                            <div class="grid-container">
                                <?php 
                                if(isset($filepath)){
                                    foreach ($filepath as $key1 => $value2) { ?>
                                    <div class='grid-item'> 
                                        <img src=<?php echo $value2 ?> height="auto" width="150" />
                                        <form action="vehicle_selling_page.php" enctype="multipart/form-data" method="post">
                                            <?php
                                            if(isset($filepath)){
                                                foreach ($filepath as $key => $value3) {
                                                    echo '<input type="hidden" name="filepath['.$key.']" value="'.$value3.'" />';
                                                }
                                            }
                                            ?>
                                        <input type="text" style="display:none" name="file_name" value=<?php echo $value2 ?>>
                                        <input type="submit" class="delete" style="background-color:#fff; color:#f44336; font-size: xx-small; padding: 0;" value="消去" name="Delete">
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
<script src="js/main.js"></script>
</body>
</html>
<?php 
$queries = array();
$selectedMakers=array();
$searchString=null;

parse_str($_SERVER['QUERY_STRING'], $queries);
if(isset($queries) && !empty($queries)){

   if(array_key_exists("fill",$queries)){
      $fillIds = $queries['fill'];
      if(isset($fillIds) &&!empty($fillIds)){
         $_selectedMakersTemp =  preg_split ("/\,/", $fillIds);
         foreach ($_selectedMakersTemp as $key => $value) {
            if(in_array($value,$selectedMakers)){
               $pos = array_search($value, $selectedMakers,true);
               array_splice($selectedMakers,$pos,1);
            }else{
               array_push($selectedMakers,$value);
            }
         }
      }
   }

   if(isset($queries['search']) && !empty($queries['search'])){
      $searchString = $queries['search'];
   }
}

if(isset($_POST['Search'])){
   if(isset($_REQUEST['search-product']) && !empty($_REQUEST['search-product'])){
      $searchString=$_REQUEST['search-product'];
   }
}
require_once('./php/config.php');

require_once "./php/car_module.php";
require_once "./php/car_dao.php";

require_once "./php/car_makers_dao.php";
require_once "./php/car_makers_module.php";

$makersList = getAllCarMakers($link);

$new_cars = searchStringArray($link,$searchString,$selectedMakers,null);
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
      <link rel="shortcut icon" href="images/car_logo_sample.jpg" type="">
      <title>Buy New Car</title>
      <!-- bootstrap core css -->
      <link rel="stylesheet" type="text/css" href="css/bootstrap.css" />
      <!-- font awesome style -->
      <link href="css/font-awesome.min.css" rel="stylesheet" />
      <!-- Custom styles for this template -->
      <link href="css/style.css" rel="stylesheet" />
      <!-- responsive style -->
      <link href="css/responsive.css" rel="stylesheet" />
      <!-- Card  -->
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

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

      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
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

      /* Card css*/
      .container {
         background-color: #f6f6f6,
      }


      h5.itemtitle{
         text-transform:uppercase;
      }

      .addtocart_button{
         background-color:#fec200!important;
         font-weight: bold;
         color: #fff;
      }
      .addtocart_icon{
         background-color:#ffe266!important;
         font-weight: bold;
         color: #fff;
      }

      .addtocart_button:hover{
         background-color:#f0b802!important;
         font-weight: bold;
         color: #fff;
      }
      .addtocart_icon:hover{
         background-color:#ffd416!important;
         font-weight: bold;
         color: #fff;
      }

      .pricetext{
         color: #fdc101;
         font-weight:700;
         font-family:Tahoma,Verdana,Segoe,sans-serif;
      }

      .car_manufacturer{
         color:#d0caca !important;
      }

      .featurebadge {
         border: 2px solid #ffd416; background-color: white; color: black;
         font-size:11px;
      }
    .bttn2 {
        border: 2px solid orange;
        border-radius: 5px;
        background-color: rgb(255, 255, 255);
        color: orange;
        /* padding: 8px 28px; */
        height: 40px;
        margin-left: 10px;
        width: 150px;
        font-size: 16px;
        font-weight: 800;
    }

      .featuremain{
         display: inline-block;
      }
      .featuremain > small{
         color: #a8a8a8;
      }


      .card .featuremain{
         margin-right:10px;
         display:inline-block;
         transform:translatex(0px) translatey(0px) !important;
      }

      .card .featuremain  small.featuremain_tag{
         font-size:9px;
      }
      /* End Card css*/
   </style>

   <body class="sub_page">

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
                              <button class="bttn Bu_one"> Button </button>
                              <button class="bttn Bu_two"> Button </button>
                              <button class="bttn Bu_three"> Button </button>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </header>
       <!-- End color buttons -3  section -->

      <!-- Text field section -->
      <section class="arrival_section">
         <div class="container">
            <div class="heading_container heading_center">
               <div class="heading_container">
                  <h3>
                     OUR LISTED VEHICLES
                  </h3>
               </div>
               <p style="margin-top: 20px;margin-bottom: 30px;">
                  Vitae fugiat laboriosam officia perferendis provident aliquid voluptatibus dolorem, fugit ullam sit earum id eaque nisi hic? Tenetur commodi, nisi rem vel, ea eaque ab ipsa, autem similique ex unde!
               </p>
            </div>
         </div>
      </section>
      <!-- end Text field section -->

      <!-- box with filter section -->
      <body class="animsition">
         <section class="bg0 p-t-23 p-b-140">
            <div class="container">

               <div class="flex-w flex-sb-m p-b-52">


                  <div class="flex-w flex-c-m m-tb-10">
                     <div class="flex-c-m stext-106 cl6 size-104 bor4 pointer hov-btn3 trans-04 m-r-8 m-tb-4 js-show-filter">
                        <i class="icon-filter cl2 m-r-6 fs-15 trans-04 zmdi zmdi-filter-list"></i>
                        <i class="icon-close-filter cl2 m-r-6 fs-15 trans-04 zmdi zmdi-close dis-none"></i>
                        Filter
                     </div>
                     <?php 
                     
                        $url2 = "buy_new_car.php";
                        if(isset($selectedMakers) && !empty($selectedMakers)){
                           $url2 = $url2."?fill=".implode(',', $selectedMakers);
                        }
                     ?>
                     <form class="form-inline" action=<?php echo $url2 ?> enctype="multipart/form-data" method="post">
                        <div class="form-group">
                           <div class="flex-c-m stext-106 cl6 size-105 bor4 pointer trans-04 m-tb-4">
                              <input class="mtext-107 cl2 size-114 plh2 p-r-15" 
                              type="text" 
                              <?php if(isset($searchString) && !empty($searchString)){ echo "value='".$searchString."'";} ?> 
                              name="search-product" placeholder="Search">
                           </div>
                        </div>
                        <div class="form-group">
                           <button type="submit" style="font-size:0.8em;" class="bttn2" value="Search" name="Search" >Search</button> 
                        </div>
                      </form>

                  <!-- Filter -->
                  <div class="dis-none panel-filter w-full p-t-10">
                     <div class="wrap-filter flex-w bg6 w-full p-lr-40 p-t-27 p-lr-15-sm">
                        <div class="filter-col1 p-r-15 p-b-27">
                           <div class="mtext-102 cl2 p-b-15">
                              Maker
                           </div>

                           <ul>
                           <?php
                              if(isset($makersList)){
                                 foreach ($makersList as $key2 => $value1) {
                                    $url = "buy_new_car.php?fill=";
                                    if(isset($selectedMakers) && !empty($selectedMakers)){
                                       $url = $url.implode(',', $selectedMakers).",";
                                    }
                                    $url = $url.$value1->id;
                                    if(isset($searchString) && !empty($searchString)){
                                       $url = $url."&search=".$searchString;
                                    }
                                    ?> 
                                    <li class="p-b-6">
                                       <a href=<?php echo $url ?> class="filter-link stext-106 trans-04 <?php if(in_array($value1->id,$selectedMakers)) {echo "filter-link-active";} ?>">
                                          <?php echo $value1->name; ?>
                                       </a>
                                    </li>
                                 <?php 
                                 }
                              } ?>
                           </ul>
                        </div>

                        <div class="filter-col2 p-r-15 p-b-27">
                           <div class="mtext-102 cl2 p-b-15">
                              Price
                           </div>

                           <ul>
                              <li class="p-b-6">
                                 <a href="#" class="filter-link stext-106 trans-04 filter-link-active">
                                    All
                                 </a>
                              </li>

                              <li class="p-b-6">
                                 <a href="#" class="filter-link stext-106 trans-04">
                                    $0.00 - $50.00
                                 </a>
                              </li>

                              <li class="p-b-6">
                                 <a href="#" class="filter-link stext-106 trans-04">
                                    $50.00 - $100.00
                                 </a>
                              </li>

                              <li class="p-b-6">
                                 <a href="#" class="filter-link stext-106 trans-04">
                                    $100.00 - $150.00
                                 </a>
                              </li>

                              <li class="p-b-6">
                                 <a href="#" class="filter-link stext-106 trans-04">
                                    $150.00 - $200.00
                                 </a>
                              </li>

                              <li class="p-b-6">
                                 <a href="#" class="filter-link stext-106 trans-04">
                                    $200.00+
                                 </a>
                              </li>
                           </ul>
                        </div>

                        <div class="filter-col3 p-r-15 p-b-27">
                           <div class="mtext-102 cl2 p-b-15">
                              Color
                           </div>

                           <ul>
                              <li class="p-b-6">
									<span class="fs-15 lh-12 m-r-6" style="color: #222;">
										<i class="zmdi zmdi-circle"></i>
									</span>

                                 <a href="#" class="filter-link stext-106 trans-04">
                                    Black
                                 </a>
                              </li>

                              <li class="p-b-6">
									<span class="fs-15 lh-12 m-r-6" style="color: #4272d7;">
										<i class="zmdi zmdi-circle"></i>
									</span>

                                 <a href="#" class="filter-link stext-106 trans-04 filter-link-active">
                                    Blue
                                 </a>
                              </li>

                              <li class="p-b-6">
									<span class="fs-15 lh-12 m-r-6" style="color: #b3b3b3;">
										<i class="zmdi zmdi-circle"></i>
									</span>

                                 <a href="#" class="filter-link stext-106 trans-04">
                                    Grey
                                 </a>
                              </li>

                              <li class="p-b-6">
									<span class="fs-15 lh-12 m-r-6" style="color: #00ad5f;">
										<i class="zmdi zmdi-circle"></i>
									</span>

                                 <a href="#" class="filter-link stext-106 trans-04">
                                    Green
                                 </a>
                              </li>

                              <li class="p-b-6">
									<span class="fs-15 lh-12 m-r-6" style="color: #fa4251;">
										<i class="zmdi zmdi-circle"></i>
									</span>

                                 <a href="#" class="filter-link stext-106 trans-04">
                                    Red
                                 </a>
                              </li>

                              <li class="p-b-6">
									<span class="fs-15 lh-12 m-r-6" style="color: #aaa;">
										<i class="zmdi zmdi-circle-o"></i>
									</span>

                                 <a href="#" class="filter-link stext-106 trans-04">
                                    White
                                 </a>
                              </li>
                           </ul>
                        </div>

                        <div class="filter-col4 p-b-27">
                           <div class="mtext-102 cl2 p-b-15">
                              Tags
                           </div>

                           <div class="flex-w p-t-4 m-r--5">
                              <a href="#" class="flex-c-m stext-107 cl6 size-301 bor7 p-lr-15 hov-tag1 trans-04 m-r-5 m-b-5">
                                 Fashion
                              </a>

                              <a href="#" class="flex-c-m stext-107 cl6 size-301 bor7 p-lr-15 hov-tag1 trans-04 m-r-5 m-b-5">
                                 Lifestyle
                              </a>

                              <a href="#" class="flex-c-m stext-107 cl6 size-301 bor7 p-lr-15 hov-tag1 trans-04 m-r-5 m-b-5">
                                 Denim
                              </a>

                              <a href="#" class="flex-c-m stext-107 cl6 size-301 bor7 p-lr-15 hov-tag1 trans-04 m-r-5 m-b-5">
                                 Streetstyle
                              </a>

                              <a href="#" class="flex-c-m stext-107 cl6 size-301 bor7 p-lr-15 hov-tag1 trans-04 m-r-5 m-b-5">
                                 Crafts
                              </a>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>

               <div class="row isotope-grid">

                     <div class="container-fluid">
                        <div class="row">
                           <?php
                              if(isset($new_cars)){
                                 foreach ($new_cars as $key2 => $value1) {
                                    ?> 
                                    <div class="col-sm-12 col-md-6 col-lg-4">
                                       <div class="card border rounded m-3">
                                          <div class="shadow">
                                             <div class="card-body">
                                                <div class="row d-flex  justify-content-between align-items-center px-0">
                                                   <div class="col-7 text-left">
                                                      <h5 class="card-title itemtitle"><?php echo $value1->name; ?></h5>
                                                   </div>
                                                   <div class="col-5 text-right">
                                                      <div class="btn-group btn-addtocart float-end " role="group" aria-label="Basic mixed styles">
                                                      <a href="vehicle_preview.php?id=<?php echo $value1->id; ?>">
                                                         <button type="button" class="btn btn-sm  addtocart_button ">Buy This</button>
                                                         <!-- <button type="button" class="btn btn-sm  addtocart_icon" disabled>>></button> -->
                                                      </a>
                                                      </div>
                                                   </div>
                                                </div>
                                                <div class="row d-flex mt-0 mb-3  justify-content-between  align-items-center ">


                                                   <div class="col-6 text-left">
                                                      <p class="card-text pricetext font-weigh-bold"><?php echo $value1->getPrice(); ?></p>
                                                   </div>
                                                   <div class="col-6 text-right">
                                                      <p class="card-text car_manufacturer float-end"><?php echo $value1->maker; ?></p>
                                                   </div>

                                                </div>
                                                <div class="row mt-4  px-0">
                                                   <div class="col-12  px-0">
                                                      <img src="<?php echo $value1->getImage(); ?>" class="w-100 img-fluid  px-0" alt="Full width image">
                                                   </div>
                                                </div>
                                                <!-- <div class="row mt-4 ">
                                                   <div class=" d-flex row mt-4">
                                                      <div class="col-md-12">
                                                         <span class="badge badge-warning mx-2 featurebadge">ABS</span>
                                                         <span class="badge badge-warning mx-2 featurebadge">FULL A/C</span>
                                                         <span class="badge badge-warning mx-2 featurebadge">POWER STEERING</span>
                                                      </div>
                                                   </div>
                                                </div> -->
                                                <div class=" d-flex row mt-4">
                                                   <div class="col-md-12">
                                                      <div class=" p-2 featuremain">
                                                         <h4><?php echo $value1->power; ?> cc</h4>
                                                         <small  class="featuremain_tag">Capacity</small>
                                                      </div>
                                                      <div class=" p-2 featuremain">
                                                         <h4><?php echo $value1->model_year; ?></h4>
                                                         <small class="featuremain_tag">Registered Year</small>
                                                      </div>
                                                      <div class=" p-2 featuremain">
                                                         <h4><?php echo $value1->running; ?><small>k</small></h4>
                                                         <small class="featuremain_tag">Kilometers Span</small>
                                                      </div>
                                                   </div>

                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                    <?php
                                 }
                              }
                           ?>
                        </div>
                     </div>

               <!-- Load more -->
<!--               <div class="flex-c-m flex-w w-full p-t-45">-->
<!--                  <a href="#" class="flex-c-m stext-101 cl5 size-103 bg2 bor1 hov-btn1 p-lr-15 trans-04">-->
<!--                     Load More-->
<!--                  </a>-->
<!--               </div>-->
               </div>
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
      <!--        -->
         <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
         <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

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
   </body>
</html>
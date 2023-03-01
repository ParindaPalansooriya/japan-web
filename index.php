<?php 
require_once './php/config.php';
require_once "./php/car_module.php";
require_once "./php/car_dao.php";
$new_cars = getAllFirld10Cars($link);
$recoment_foryou_cars = getAllFirld10Cars($link);
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
      <title>Web title</title>
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

  <link rel="stylesheet" href="assets/theme/css/style.css">


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
      .bttn {
         border: 3px solid black;
        border-radius: 10px;
        background-color: white;
        color: black;
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
   /*   img resize*/
      .img-res {
         width: 100%;
         height: auto;
      }
      /*  end img resize*/

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
         border: 3px solid #ffd416; background-color: white; color: black;
         font-size:11px;
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

      #menu ul {
         list-style: none;
         margin: 0;
         padding: 0;
      }

      #menu li {
         display: inline-block;
      }

      .scroll-container {
         display: flex;
         flex-wrap: no-wrap;
         overflow-x: auto;
         margin: 0px;
      }
      /* width */
      ::-webkit-scrollbar {
         width: 4px;
         height: 10px;
      }
      /* Track */
      ::-webkit-scrollbar-track {
         background: #f1f1f1; 
      }
      
      /* Handle */
      ::-webkit-scrollbar-thumb {
         background: #888; 
      }

      /* Handle on hover */
      ::-webkit-scrollbar-thumb:hover {
         background: #555; 
      }
      ::-webkit-scrollbar-thumb:horizontal{
        background: #555;
        border-radius: 5px;
    }

    /* ===========================
   ====== Search Box ====== 
   =========================== */

.search
{
	border: 2px solid orange;
	overflow: auto;
	border-radius: 5px;
	-moz-border-radius: 5px;
	-webkit-border-radius: 5px;
}

.search input[type="text"]
{
	border: 0px;
	width: 50%;
   background: rgba(76, 175, 80, 0.0);
	padding: 10px 10px;
}

.search input[type="text"]:focus
{
	outline: 0;
}

.search input[type="submit"]
{
	border: 0px;
	background: none;
	background-color: orange;
	color: #fff;
	float: right;
	/* padding: 10px; */
	-moz-border-radius-top-right: 5px;
	-webkit-border-radius-top-right: 5px;
	-moz-border-radius-bottom-right: 5px;
	-webkit-border-radius-bottom-right: 5px;
        cursor:pointer;
}

/* ===========================
   ====== Medua Query for Search Box ====== 
   =========================== */

   @media (max-width: 700px) {
        .card-columns.custom-columns {
            column-count: 1;
        }
    }
    @media (min-width: 700px) {
        .card-columns.custom-columns {
            column-count: 2;
        }
    }
    @media (min-width: 1000px) {
        .card-columns.custom-columns {
            column-count: 3;
        }
    }
    @media (min-width: 1400px) {
        .card-columns.custom-columns {
            column-count: 4;
        }
    }

@media only screen and (min-width : 150px) and (max-width : 780px)
{
	.search
	{
		width: 100%;
		margin: 0 auto;
	}

}

   </style>
   <body>
      <div class="hero_area">
      <!-- head section -->

      <section data-bs-version="5.1" class="header18  mbr-fullscreen" id="header18-k" style="background-image: url('images/back.png'); height: 100vh">
         <div class="align-center container">
            <div class="row justify-content-center">
               <div class="col-12 col-lg-10">
                                    <div class="detail-box">
                                          <img src="images/logo.png" style="margin-bottom: 50px; object-fit: contain;" width="200px" height="200px">
                                          <h2 style="margin-bottom: 30px;">
                                             GET THE LATEST NEW OR USED CAR AT A FAIR PRICE
                                          </h2>
                                          <p style="margin-bottom: 50px;">
                                             Passenger cars, vans, light trucks and even margin cars or damaged vehicles,
                                             you’re sure to find what you’re looking for.  </p>

                                             <div class="search">
                                                <form  action="buy_new_car.php" enctype="multipart/form-data" method="post">
                                                   <input type="text" style="text-align: center;" name="search-product" placeholder="Search for Maker, Name, Grade">
                                                   <input type="submit" value="Submit" name="Search">
                                                </form>
                                             </div>
                                    </div>
               </div>
            </div>
         </div>
         </section>

         <!-- <section class="slider_section ">
            <div class="slider_bg_box">

               <img src="images/Car_full_photo.png">
            </div>
            <div id="customCarousel1" class="carousel slide" data-ride="carousel">
               <div class="carousel-inner">
                  <div class="carousel-item active">
                     <div class="container-fluid">
                        <div class="row">
                           <div class="col-md-7 col-lg-0 ">
                              <div class="detail-box" style="max-width: 800px;">
                                 <div class="heading_container heading_center">
                                 <img src="images/logo.png" style="margin-bottom: 50px;" width="150" height="150">
                                 </div>
                                 <h2>
                                    GET THE LATEST NEW OR <br>USED CAR AT A FAIR PRICE
                                 </h2>
                                 <p>
                                    Passenger cars, vans, light trucks and even margin cars or damaged vehicles,
                                    you’re sure to find what you’re looking for.  </p>

                                 <div class="form_sub">
                                    <div class="search">
                                       <form class="search-form" action="buy_new_car.php" enctype="multipart/form-data" method="post">
                                          <input type="text" name="search-product" placeholder="Search for Maker, Name, Grade">
                                          <input type="submit" value="Submit" name="Search">
                                       </form>
                                    </div>
                                 </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               </div>
            </div>
         </section> -->

      <!-- color buttons -3  section -->
         <div class="heading_container heading_center"  style="margin-top: 100px;">
            <div class="col-center">
               <a href="https://www.carsensor.net/shop/ibaraki/226235001/" target="_blank">
                  <button  id="butt2" Class="bttn Bu_one" name="Action">1 sale</button>
               </a>
               <a href="https://www.carsensor.net/shop/ibaraki/226235002/" target="_blank">
                  <button  id="butt2" Class="bttn Bu_two" name="Action">2 sale</button>
               </a>
               <a href="https://www.carsensor.net/shop/ibaraki/226235003/" target="_blank">
                  <button  id="butt2" Class="bttn Bu_three" name="Action">3 sale</button>
               </a>
            </div>
            <!-- End color buttons -3  section -->
         </div>
      </div>
      <!-- shadow box section -->
      <section class="why_section layout_padding">
         <div class="container">
            <div class="shadow">
            <div class="row">
               <div class="col-md-4">
               <a style="text-decoration: none" href="buy_new_car.php">
                  <div class="box ">
                     <div class="img-box">
                        <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" viewBox="0 0 50 50">
                           <g id="Group_74" data-name="Group 74" transform="translate(0 0.161)">
                              <g id="Ellipse_6" data-name="Ellipse 6" transform="translate(0 -0.161)" fill="none" stroke="#4e4e4e" stroke-width="2">
                                 <circle cx="25" cy="25" r="25" stroke="none"/>
                                 <circle cx="25" cy="25" r="24" fill="none"/>
                              </g>
                              <g id="key" transform="translate(12.021 11.873)">
                                 <g id="Group_69" data-name="Group 69" transform="translate(0 11.866)">
                                    <g id="Group_68" data-name="Group 68">
                                       <path id="Path_54" data-name="Path 54" d="M20.864,166.228l-3.522-3.534a.584.584,0,0,0-.824,0l-2.1,2.1a.584.584,0,0,0,0,.824l.356.356-7.465,7.471a.584.584,0,0,0-.169.4l-.058,3.1a.584.584,0,0,0,.584.584h2.453a.584.584,0,0,0,.415-.169l1.378-1.378a.584.584,0,0,0,.169-.4l.035-1.25,1,.123a.584.584,0,0,0,.485-.169l.87-.847a.584.584,0,0,0,.169-.356l.111-1.168,1.425-.315a.584.584,0,0,0,.45-.467l.286-1.583,1.53-.239a.584.584,0,0,0,.321-.164l2.1-2.1A.584.584,0,0,0,20.864,166.228Z" transform="translate(-7.085 -162.525)" fill="#4e4e4e"/>
                                    </g>
                                 </g>
                                 <g id="Group_71" data-name="Group 71" transform="translate(8.721 0)">
                                    <g id="Group_70" data-name="Group 70">
                                       <path id="Path_55" data-name="Path 55" d="M142.6,5.535h0l-4.515-4.509a2.92,2.92,0,0,0-4.445,0l-6.758,6.758a1.256,1.256,0,0,0,0,1.752l7.184,7.184a1.256,1.256,0,0,0,1.752,0L142.6,9.98A2.89,2.89,0,0,0,142.6,5.535Zm-2.52,2.888-.009.009.006.023a.584.584,0,0,1-.824,0L135.195,4.4a.584.584,0,1,1,.824-.824L140.072,7.6A.584.584,0,0,1,140.081,8.423Z" transform="translate(-126.527 0)" fill="#4e4e4e"/>
                                    </g>
                                 </g>
                              </g>
                           </g>
                        </svg>
                     </div>
                     <div class="detail-box">
                        <h5>
                           BUY A CAR
                        </h5>
                        <h6>
                           MORE THAT 1,250 CARS LISTED
                        </h6>
                        <div class="form_sub1">

                           <svg class="img-res" xmlns="http://www.w3.org/2000/svg" width="261" height="41" viewBox="0 0 261 41">
                              <g id="Group_82" data-name="Group 82" transform="translate(0 0.161)">
                                 <rect id="Rectangle_7" data-name="Rectangle 7" width="261" height="41" transform="translate(0 -0.161)" fill="#fec200"/>
                                 <rect id="Rectangle_8" data-name="Rectangle 8" width="41" height="41" transform="translate(220 -0.161)" fill="#ffe266"/>
                                 <text id="FIND_YOUR_NEW_CAR" data-name="FIND YOUR NEW CAR" transform="translate(106 25.839)" fill="#fff" font-size="13" font-family="Montserrat-Light, Montserrat" font-weight="300" letter-spacing="0.07em"><tspan x="-78.624" y="0">FIND YOUR NEW CAR</tspan></text>
                                 <g id="right-arrow" transform="translate(236.99 17.125)">
                                    <g id="Group_73" data-name="Group 73" transform="translate(0 0.003)">
                                       <path id="Path_56" data-name="Path 56" d="M213.751.2a.242.242,0,0,0-.342.342l5.144,5.145-5.145,5.144a.242.242,0,1,0,.336.348l.006-.006,5.315-5.315a.242.242,0,0,0,0-.342Z" transform="translate(-208.987 -0.134)" fill="#fff" stroke="#fff" stroke-width="1"/>
                                       <path id="Path_57" data-name="Path 57" d="M27.067,5.517,21.752.2a.242.242,0,0,0-.342.342l5.144,5.145L21.41,10.832a.242.242,0,0,0,.336.348l.006-.006,5.315-5.315A.242.242,0,0,0,27.067,5.517Z" transform="translate(-21.336 -0.134)" fill="#fff" stroke="#fff" stroke-width="1"/>
                                    </g>
                                    <path id="Path_58" data-name="Path 58" d="M213.7,11.265a.242.242,0,0,1-.171-.413l5.145-5.144L213.529.564a.242.242,0,0,1,.342-.342l5.315,5.315a.242.242,0,0,1,0,.342l-5.315,5.315A.241.241,0,0,1,213.7,11.265Z" transform="translate(-209.107 -0.151)" fill="#fff" stroke="#fff" stroke-width="1"/>
                                    <path id="Path_59" data-name="Path 59" d="M21.7,11.113a.242.242,0,0,1-.171-.413l5.145-5.144L21.529.413a.242.242,0,1,1,.342-.342l5.315,5.315a.242.242,0,0,1,0,.342l-5.315,5.315A.242.242,0,0,1,21.7,11.113Z" transform="translate(-21.455 0)" fill="#fff" stroke="#fff" stroke-width="1"/>
                                 </g>
                              </g>
                           </svg>

                        </div>
                     </div>
                  </div>
               </a>
               </div>

               <div class="col-md-4">
               <a style="text-decoration: none" href="vehicle_selling_page.php">
                  <div class="box ">
                     <div class="img-box">
                        <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" viewBox="0 0 50 50">
                           <g id="Group_76" data-name="Group 76" transform="translate(0 0.161)">
                              <g id="Ellipse_6" data-name="Ellipse 6" transform="translate(0 -0.161)" fill="none" stroke="#4e4e4e" stroke-width="2">
                                 <circle cx="25" cy="25" r="25" stroke="none"/>
                                 <circle cx="25" cy="25" r="24" fill="none"/>
                              </g>
                              <g id="hand-holding-up-a-key" transform="translate(10.799 13.481)">
                                 <path id="Path_60" data-name="Path 60" d="M30.15,29.456c-.09-.493-12.034-7.075-15.732-7.329C10.375,21.85,0,21.938,0,21.938l.009,7.2c.645-.161,3.533.05,4.5.9A14.788,14.788,0,0,0,8.342,32.4c1.3.579,3.241,1.711,3.693,1.967,2.7,1.527,3.031,1.925,4.4,2.642a1.26,1.26,0,0,0,.553.153,4.349,4.349,0,0,0,.1.456,3.32,3.32,0,0,0-.431.183.583.583,0,0,0-.292.34,5.853,5.853,0,0,0,0,3.857.582.582,0,0,0,.292.34,4.876,4.876,0,0,0,.865.348v1.255a.291.291,0,0,0,.086.206l.266.267-.266.266a.292.292,0,0,0-.086.206v.071a.291.291,0,0,0,.086.206l.266.266-.266.266a.292.292,0,0,0-.086.206v.066a.291.291,0,0,0,.086.206l.266.266-.266.266a.292.292,0,0,0-.086.206v1a.292.292,0,0,0,.085.206l.464.466a.292.292,0,0,0,.413,0l.464-.466a.292.292,0,0,0,.085-.206V42.689a4.864,4.864,0,0,0,.865-.348.583.583,0,0,0,.293-.34,5.86,5.86,0,0,0,0-3.857.584.584,0,0,0-.293-.34,3.318,3.318,0,0,0-.429-.182,5.065,5.065,0,0,0,.183-1.378,5.5,5.5,0,0,0-.031-.579c.819.43,1.647.389,1.664-.112a48.229,48.229,0,0,0-.233-5.788,4.036,4.036,0,0,0-.952-1.9c.347.149.682.289,1.022.415,1.969.731,5.583,2.655,7.091,2.748C29.011,31.074,30.325,30.421,30.15,29.456Zm-13.756,3.02a8.583,8.583,0,0,1-2.5-2.427c-.547-.932,1.018-2.378,2.113-1.491a7.992,7.992,0,0,1,1.685,1.813c.219,1.4.341,3.035.344,3.056.008.06.019.118.03.176a.921.921,0,0,0-.339.169A4.619,4.619,0,0,0,16.393,32.477ZM19.329,38.6c0,.237-.47.429-1.05.429s-1.05-.192-1.05-.429a.308.308,0,0,1,.181-.241.96.96,0,0,0,1.739,0A.306.306,0,0,1,19.329,38.6Zm-1.05-1.193c-.106,0-.211.006-.312.016a3.436,3.436,0,0,1-.134-.644,2.234,2.234,0,0,0,.332-2.073.754.754,0,0,1,.124-.189,2.424,2.424,0,0,1,.467,1.727,3.909,3.909,0,0,1-.164,1.178C18.491,37.412,18.386,37.406,18.279,37.406Z" transform="translate(0 -21.925)" fill="#4e4e4e"/>
                              </g>
                           </g>
                        </svg>
                     </div>
                     <div class="detail-box">
                        <h5>
                           車を売る
                        </h5>
                        <h6>
                           2,120台以上の中古車がリストされています
                        </h6>
                        <div class="form_sub1">
                           <svg class="img-res" xmlns="http://www.w3.org/2000/svg" width="261" height="41" viewBox="0 0 261 41">
                              <g id="Group_82" data-name="Group 82" transform="translate(0 0.161)">
                                 <rect id="Rectangle_7" data-name="Rectangle 7" width="261" height="41" transform="translate(0 -0.161)" fill="#fec200"/>
                                 <rect id="Rectangle_8" data-name="Rectangle 8" width="41" height="41" transform="translate(220 -0.161)" fill="#ffe266"/>
                                 <text id="FIND_YOUR_NEW_CAR" data-name="FIND YOUR NEW CAR" transform="translate(106 25.839)" fill="#fff" font-size="13" font-family="Montserrat-Light, Montserrat" font-weight="300" letter-spacing="0.07em"><tspan x="-78.624" y="0">あなたの車を売る</tspan></text>
                                 <g id="right-arrow" transform="translate(236.99 17.125)">
                                    <g id="Group_73" data-name="Group 73" transform="translate(0 0.003)">
                                       <path id="Path_56" data-name="Path 56" d="M213.751.2a.242.242,0,0,0-.342.342l5.144,5.145-5.145,5.144a.242.242,0,1,0,.336.348l.006-.006,5.315-5.315a.242.242,0,0,0,0-.342Z" transform="translate(-208.987 -0.134)" fill="#fff" stroke="#fff" stroke-width="1"/>
                                       <path id="Path_57" data-name="Path 57" d="M27.067,5.517,21.752.2a.242.242,0,0,0-.342.342l5.144,5.145L21.41,10.832a.242.242,0,0,0,.336.348l.006-.006,5.315-5.315A.242.242,0,0,0,27.067,5.517Z" transform="translate(-21.336 -0.134)" fill="#fff" stroke="#fff" stroke-width="1"/>
                                    </g>
                                    <path id="Path_58" data-name="Path 58" d="M213.7,11.265a.242.242,0,0,1-.171-.413l5.145-5.144L213.529.564a.242.242,0,0,1,.342-.342l5.315,5.315a.242.242,0,0,1,0,.342l-5.315,5.315A.241.241,0,0,1,213.7,11.265Z" transform="translate(-209.107 -0.151)" fill="#fff" stroke="#fff" stroke-width="1"/>
                                    <path id="Path_59" data-name="Path 59" d="M21.7,11.113a.242.242,0,0,1-.171-.413l5.145-5.144L21.529.413a.242.242,0,1,1,.342-.342l5.315,5.315a.242.242,0,0,1,0,.342l-5.315,5.315A.242.242,0,0,1,21.7,11.113Z" transform="translate(-21.455 0)" fill="#fff" stroke="#fff" stroke-width="1"/>
                                 </g>
                              </g>
                           </svg>
                        </div>
                     </div>
                  </div>
               </a>
               </div>

               <div class="col-md-4">
               <a style="text-decoration: none" href="contact.php" target="_blank">
                  <div class="box ">
                     <div class="img-box">
                        <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" viewBox="0 0 50 50">
                           <g id="Group_78" data-name="Group 78" transform="translate(0 0.161)">
                              <g id="Ellipse_6" data-name="Ellipse 6" transform="translate(0 -0.161)" fill="none" stroke="#4e4e4e" stroke-width="2">
                                 <circle cx="25" cy="25" r="25" stroke="none"/>
                                 <circle cx="25" cy="25" r="24" fill="none"/>
                              </g>
                              <g id="insurance-agent" transform="translate(13.922 11.742)">
                                 <g id="XMLID_855_">
                                    <circle id="XMLID_932_" cx="2.223" cy="2.223" r="2.223" transform="translate(3.867)" fill="#4e4e4e"/>
                                    <path id="XMLID_951_" d="M85.015,235.584s0,10.146,0,11.435a1.287,1.287,0,0,0,2.574,0v-10a.289.289,0,0,1,.289-.289.266.266,0,0,1,.266.266v10.02a1.287,1.287,0,0,0,2.574,0L90.7,235.1C87.424,236.848,87.99,236.829,85.015,235.584Z" transform="translate(-81.792 -221.303)" fill="#4e4e4e"/>
                                    <path id="XMLID_973_" d="M191.515,209.642l-1.576.841.01,2.024a1.072,1.072,0,0,0,1.072,1.067h.006a1.072,1.072,0,0,0,1.067-1.078l-.016-3.277A2.3,2.3,0,0,1,191.515,209.642Z" transform="translate(-180.558 -196.94)" fill="#4e4e4e"/>
                                    <path id="XMLID_1096_" d="M252.763,4.445a2.223,2.223,0,1,0-2.223-2.223A2.223,2.223,0,0,0,252.763,4.445Z" transform="translate(-237.602 0)" fill="#4e4e4e"/>
                                    <path id="XMLID_1100_" d="M292.893,401.325v2.161a1.287,1.287,0,0,0,2.574,0V401.48H293.6A1.7,1.7,0,0,1,292.893,401.325Z" transform="translate(-277.469 -377.769)" fill="#4e4e4e"/>
                                    <path id="XMLID_1107_" d="M53.575,100.17a.533.533,0,0,0-.533-.533H51.869v-1.37a.625.625,0,0,0-.625-.625h-.534l-.037-7.315A2.543,2.543,0,0,0,48.136,87.8H41.589a1.072,1.072,0,0,0-1.009.708l-1.466,4.064-3.282,1.752-3.36-1.405.854-2.975h0v2.008l2.439,1.02,2.356-1.257c.132-.367,1.377-3.8,1.425-3.913l-7.031,0a1.072,1.072,0,0,0-1.031.777l-1.34,4.668a1.076,1.076,0,0,0,.614,1.284h0l4.7,1.964a1.119,1.119,0,0,0,.939-.041l0,0h0l4.085-2.18a1.089,1.089,0,0,0,.5-.582c.2-.543,1.405-3.735,1.409-3.744,0,.268,0,18.418,0,18.418a1.287,1.287,0,1,0,2.574,0V105.8a1.7,1.7,0,0,1-.441-1.144V100.17a1.7,1.7,0,0,1,.441-1.144v-.667a.28.28,0,0,1,.28-.28.276.276,0,0,1,.276.276v.263a1.694,1.694,0,0,1,.634-.153v-.2a1.876,1.876,0,0,1,1.917-1.874V90.344a.224.224,0,0,1,.449-.006l.037,7.3h-.528a.625.625,0,0,0-.625.625v.2h0v1.174H46.24a.533.533,0,0,0-.533.533v4.483a.533.533,0,0,0,.533.533h6.8a.533.533,0,0,0,.533-.533V100.17Z" transform="translate(-30.106 -82.649)" fill="#4e4e4e"/>
                                 </g>
                              </g>
                           </g>
                        </svg>
                     </div>
                     <div class="detail-box">
                        <h5>
                           CONTACT US
                        </h5>
                        <h6>
                           FIND THE PERFECT DEAL FOR THEIR CARS
                        </h6>
                        <div class="form_sub1">
                           <svg class="img-res" xmlns="http://www.w3.org/2000/svg" width="261" height="41" viewBox="0 0 261 41">
                              <g id="Group_82" data-name="Group 82" transform="translate(0 0.161)">
                                 <rect id="Rectangle_7" data-name="Rectangle 7" width="261" height="41" transform="translate(0 -0.161)" fill="#fec200"/>
                                 <rect id="Rectangle_8" data-name="Rectangle 8" width="41" height="41" transform="translate(220 -0.161)" fill="#ffe266"/>
                                 <text id="FIND_YOUR_NEW_CAR" data-name="FIND YOUR NEW CAR" transform="translate(106 25.839)" fill="#fff" font-size="13" font-family="Montserrat-Light, Montserrat" font-weight="300" letter-spacing="0.07em"><tspan x="-78.624" y="0">GO TO PAGE</tspan></text>
                                 <g id="right-arrow" transform="translate(236.99 17.125)">
                                    <g id="Group_73" data-name="Group 73" transform="translate(0 0.003)">
                                       <path id="Path_56" data-name="Path 56" d="M213.751.2a.242.242,0,0,0-.342.342l5.144,5.145-5.145,5.144a.242.242,0,1,0,.336.348l.006-.006,5.315-5.315a.242.242,0,0,0,0-.342Z" transform="translate(-208.987 -0.134)" fill="#fff" stroke="#fff" stroke-width="1"/>
                                       <path id="Path_57" data-name="Path 57" d="M27.067,5.517,21.752.2a.242.242,0,0,0-.342.342l5.144,5.145L21.41,10.832a.242.242,0,0,0,.336.348l.006-.006,5.315-5.315A.242.242,0,0,0,27.067,5.517Z" transform="translate(-21.336 -0.134)" fill="#fff" stroke="#fff" stroke-width="1"/>
                                    </g>
                                    <path id="Path_58" data-name="Path 58" d="M213.7,11.265a.242.242,0,0,1-.171-.413l5.145-5.144L213.529.564a.242.242,0,0,1,.342-.342l5.315,5.315a.242.242,0,0,1,0,.342l-5.315,5.315A.241.241,0,0,1,213.7,11.265Z" transform="translate(-209.107 -0.151)" fill="#fff" stroke="#fff" stroke-width="1"/>
                                    <path id="Path_59" data-name="Path 59" d="M21.7,11.113a.242.242,0,0,1-.171-.413l5.145-5.144L21.529.413a.242.242,0,1,1,.342-.342l5.315,5.315a.242.242,0,0,1,0,.342l-5.315,5.315A.242.242,0,0,1,21.7,11.113Z" transform="translate(-21.455 0)" fill="#fff" stroke="#fff" stroke-width="1"/>
                                 </g>
                              </g>
                           </svg>
                        </div>
                     </div>
                  </div>
               </a>
               </div>
            </div>
            </div>

         </div>
      </section>
      <!-- end shadow box section -->
      
      <!-- text section -->
      <section class="arrival_section" style="margin-top: 100px;">
         <div class="container">
                  <div class="heading_container heading_center">
                     <div class="heading_container">
                        <h3>
                           NEWLY LISTED VEHICLES
                        </h3>
                     </div>
                     <p style="margin-top: 20px;margin-bottom: 30px;">
                        Vitae fugiat laboriosam officia perferendis provident aliquid voluptatibus dolorem, fugit ullam sit earum id eaque nisi hic? Tenetur commodi, nisi rem vel, ea eaque ab ipsa, autem similique ex unde!
                     </p>

                  </div>
         </div>
      </section>
      <!-- text section section -->
      
      <!-- Card section -->

      <div class="scroll-container">
      <?php
         if(isset($new_cars)){
            foreach ($new_cars as $key2 => $value1) {
               ?> 
               <div class="col-sm-12 col-md-6 col-lg-4"  style="min-width: 500px;">
                  <div class="card border rounded m-3">
                     <div class="shadow">
                        <div class="card-body" style="min-width: 400px;">
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
                                       <!-- <i class="fas fa-arrow-right"></i> -->

                                       <!-- remove below after adding the fontawesome icons -->
                                       <!-- >>
                                    </button> -->
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
                              <p class="card-text car_manufacturer float-end" style="font-size: smaller;"><?php echo sprintf(" (VEH_%05d)", $value1->id); ?></p>
                           </div>
                           <div class="row mt-4  px-0">
                              
                              <div class="col-12  px-0">
                                 <img src="<?php echo file_exists("images/cars/".$value1->getImage())?"images/cars/".$value1->getImage():"images/cars/noimage.jpg"; ?>" class="w-100 img-fluid  px-0" style="max-height: 300px; object-fit: cover;" alt="Full width image">
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


      <!-- End two arrow and line -->

      <section data-bs-version="5.1" class="header18 " id="header18-k" 
      style="background-image: url('images/back2.png'); background-position: center; margin-top: 100px; margin-bottom: 100px; padding-top: 170px; height: 100vh">
         <div class="container">
            <div class="row justify-content-center">
               <div class="col-12 col-lg-10">
               <div class="container-fuild">
                  <div class="box">
                     <div class="subscribe_form ">
                        <div class="heading_container heading_center">
                           <p style="font-weight: 300; color: #f6f6f6; font-size: x-large;" >We are the largest website that deals with buying & selling cars in the world, Lorem ipsum dolor sit amet, consectetur  adipiscing
                           elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud </p>
                           <br/>
                           <h7 style="font-weight: bold; color: #f6f6f6;">DAVID S, MARVIN OWNER</h7>
                        </div>
                     </div>
                  </div>
               </div>
               </div>
            </div>
         </div>
         </section>

      <!-- 2nd text section -->
      <section class="arrival_section">
         <div class="container">
            <div class="heading_container heading_center">
               <div class="heading_container">
                  <h3>
                     RECOMMENDED VEHICLES LIST
                  </h3>
               </div>
               <p style="margin-top: 20px;margin-bottom: 30px;">
                  Vitae fugiat laboriosam officia perferendis provident aliquid voluptatibus dolorem, fugit ullam sit earum id eaque nisi hic? Tenetur commodi, nisi rem vel, ea eaque ab ipsa, autem similique ex unde!
               </p>
            </div>
         </div>
      </section>
      <!-- end 2nd text section -->

      <!-- Recommended vehical card section -->
      <div class="scroll-container">
      <?php
         if(isset($recoment_foryou_cars)){
            foreach ($recoment_foryou_cars as $key2 => $value1) {
               ?> 
               <div class="col-sm-12 col-md-6 col-lg-4" style="min-width: 500px;">
                  <div class="card border rounded m-3">
                     <div class="shadow">
                        <div class="card-body" style="min-width: 400px;">
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
                                       <!-- <i class="fas fa-arrow-right"></i> -->

                                       <!-- remove below after adding the fontawesome icons -->
                                       <!-- >>
                                    </button> -->
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
                                 <img src="<?php echo file_exists("images/cars/".$value1->getImage())?"images/cars/".$value1->getImage():"images/cars/noimage.jpg"; ?>" class="w-100 img-fluid  px-0" style="max-height: 300px; object-fit: cover;"  alt="Full width image">
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
      <!-- End recommended vehical card section -->






      <!--   card     -->
      <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

      <script src="js/jquery-3.4.1.min.js"></script>
      <!-- popper js -->
      <script src="js/popper.min.js"></script>
      <!-- bootstrap js -->
      <script src="js/bootstrap.js"></script>
      <!-- custom js -->
      <script src="js/custom.js"></script>
   </body>
</html>
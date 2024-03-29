<?php

if(isset($_POST['Submit']))
{ 
    require_once('./php/config.php');
    require_once('./php/contact_us_dao.php');
    require_once('./php/contat_us_module.php');

    if(insertContactUs($link,$_REQUEST['Name'],$_REQUEST['email'],$_REQUEST['Number'],$_REQUEST['msg'])>0){
        echo '<script>alert("Thank You for conatct us.Yor request submited")</script>';
        echo "<script>window.close();</script>";
    }else{
        echo '<script>alert("Submit Error!")</script>';
    }

}
?>


<!DOCTYPE html>
<html>
   <head>
      <title>Contact Us</title>
      <meta charset="UTF-8">
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
      <link rel="stylesheet" type="text/css" href="vendor/perfect-scrollbar/perfect-scrollbar.css">
   <!--===============================================================================================-->
      <link rel="stylesheet" type="text/css" href="css/util.css">
      <link rel="stylesheet" type="text/css" href="css/main.css">
   <!--===============================================================================================-->

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
			border-radius: 10px;
			background-color: orange;
			color: white;
			padding: 8px 28px;
			font-size: 16px;
			font-weight: 800;

		}
		.bttn3 {
			border: 3px solid rgb(0, 255, 106);
			border-radius: 10px;
			background-color: rgb(0, 255, 106);
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
             width:50%;
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

      </style>      

   </head>


	<!-- Content page -->
	<section class="bg0 p-t-104 p-b-116" >
		<div class="container">
			<div class="flex-w flex-tr">
				<div class="size-210 bor10 p-lr-70 p-t-55 p-b-70 p-lr-15-lg w-full-md">
					<form  action="contact.php" enctype="multipart/form-data" method="post">
						<h4 class="mtext-105 cl2 txt-center p-b-30">
							Send Us A Message
						</h4>
                  		<div class="bor8 m-b-20 how-pos4-parent">
							<input class="stext-111 cl2 plh3 size-116 p-l-28 p-r-30" type="text" name="Name" placeholder="Your name">
						</div>

						<div class="bor8 m-b-20 how-pos4-parent">
							<input class="stext-111 cl2 plh3 size-116 p-l-28 p-r-30" type="text" name="email" placeholder="Your email address">
						</div>

                  		<div class="bor8 m-b-20 how-pos4-parent">
							<input class="stext-111 cl2 plh3 size-116 p-l-28 p-r-30" type="text" name="Number" placeholder="Phone number">
						</div>

						<div class="bor8 m-b-30">
							<textarea class="stext-111 cl2 plh3 size-120 p-lr-28 p-tb-25" name="msg" placeholder="How Can We Help? "></textarea>
						</div>

						<button class="flex-c-m stext-101 cl0 size-121 bg3 bor1 p-lr-15 trans-04 pointer bttn2" name="Submit" >
							Submit
						</button>
					</form>
				</div>

				<div class="size-210 bor10 flex-w flex-col-m p-lr-93 p-tb-30 p-lr-15-lg w-full-md">
					<div class="flex-w w-full p-b-42">
						<span class="fs-18 cl5 txt-center size-211">
							<span class="lnr lnr-map-marker"></span>
						</span>

						<div class="size-212 p-t-2">
							<span class="mtext-110 cl2">
								Address
							</span>

							<p class="stext-115 cl6 size-213 p-t-18">
								Car Store Center, 6-Chome-14-3 Ginza, Chuo City, Tokyo, Japan
							</p>
						</div>
					</div>

					<div class="flex-w w-full p-b-42">
						<span class="fs-18 cl5 txt-center size-211">
							<span class="lnr lnr-phone-handset"></span>
						</span>

						<div class="size-212 p-t-2">
							<span class="mtext-110 cl2">
								Lets Talk
							</span>

							<p class="stext-115 cl1 size-213 p-t-18">
								+81 012 3456 7890
							</p>
						</div>
					</div>

					<div class="flex-w w-full p-b-42">
						<span class="fs-18 cl5 txt-center size-211">
							<span class="lnr lnr-envelope"></span>
						</span>

						<div class="size-212 p-t-2">
							<span class="mtext-110 cl2">
								Custom Support
							</span>

							<p class="stext-115 cl6 size-213 p-t-18">
								contactus@gmail.com
							</p>
  
						</div>


					</div>

               <!-- <div class="flex-w w-full p-b-42">
						<span class="fs-18 cl5 txt-center size-211">
							<span class="lnr lnr-phone-handset"></span>
						</span>

						<div class="size-212 p-t-2">
							<span class="mtext-110 cl2">
								Chat with us!
							</span>

                     <p class="stext-115 cl1 size-213 p-t-18">
								
							</p>
							<button class="flex-c-m stext-101 cl0 size-103 bg1 bor1 hov-btn2 p-lr-15 trans-04 bttn3">
                        Live Chat
                     </button> 
  
						</div>


					</div> -->
               

				</div>
			</div>
		</div>
	</section>	

	<!-- Back to top -->
	<div class="btn-back-to-top" id="myBtn">
		<span class="symbol-btn-back-to-top">
			<i class="zmdi zmdi-chevron-up"></i>
		</span>
	</div>

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
	<script src="vendor/MagnificPopup/jquery.magnific-popup.min.js"></script>
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
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAKFWBqlKAGCeS1rMVoaNlwyayu0e0YRes"></script>
	<script src="js/map-custom.js"></script>
<!--===============================================================================================-->
	<script src="js/main.js"></script>

      <!-- jQery -->
      <script src="js/jquery-3.4.1.min.js"></script>
      <!-- popper js -->
      <script src="js/popper.min.js"></script>
      <!-- bootstrap js -->
      <script src="js/bootstrap.js"></script>
      <!-- custom js -->
      <script src="js/custom.js"></script>
   </body>
</html>
<?php 
$queries = array();
$selectedMakers=array();
$searchString=null;
$country=null;

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

   if(isset($queries['country']) && !empty($queries['country'])){
      $country = $queries['country'];
   }else{
      $country="All Country";
   }
}

if(isset($_POST['Search'])){
   if(isset($_REQUEST['search-product']) && !empty($_REQUEST['search-product'])){
      $searchString=$_REQUEST['search-product'];
   }
   if(isset($_REQUEST['search-country']) && !empty($_REQUEST['search-country'])){
      $country=$_REQUEST['search-country'];
   }else{
      $country="All Country";
   }
}
require_once('./php/config.php');

require_once "./php/car_module.php";
require_once "./php/car_dao.php";

require_once "./php/car_makers_dao.php";
require_once "./php/car_makers_module.php";

$makersList = getAllCarMakers($link);

$new_cars = searchStringArray($link,$searchString,null,$selectedMakers,$country);
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
      <link rel="shortcut icon" href="./images/logo.png" type="">
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
      <!-- <link rel="icon" type="image/png" href="images/icons/favicon.png"/> -->
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
      
.float{
	position:fixed;
	width:60px;
	height:60px;
	bottom:40px;
	right:40px;
	background-color:#25d366;
	color:#FFF;
	border-radius:50px;
	text-align:center;
  font-size:30px;
	box-shadow: 2px 2px 3px #999;
  z-index:100;
}

.my-float{
	margin-top:16px;
}
   </style>

   <body class="sub_page">

<a href="https://api.whatsapp.com/send?phone=0716625919&text=hi,%20This%20massage%20from%20web.%20If%20you%20have%20a%20free%20time%20please%20let%20me%20know." class="float" target="_blank">
<i class="fa fa-whatsapp my-float"></i>
</a>
      <!-- Text field section -->
      <section class="arrival_section">
         <div class="container">
            <div class="heading_container heading_center">
               <div class="heading_container">
                  <h3>
                     OUR LISTED VEHICLES
                  </h3>
               </div>
               <p style="margin-top: 20px;margin-bottom: 30px;">At OrientJapan, we pride ourselves on being the best sellers of high-quality vehicles in the area. But our commitment to excellence doesn't stop there, we're also dedicated to providing our customers with the best possible experience when it comes to selling their own vehicles. 

So if you're looking to sell a vehicle, look no further than OrientJapan. With our commitment to excellence and dedication to customer service, we're the best choice for all your buying and selling needs. Contact us for more!</p>
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
                        <datalist id="suggestions">
                                    <option value="All Country">All Countries</option>
                                    <option value="Afghanistan">Afghanistan</option>
                                    <option value="Aland Islands">Åland Islands</option>
                                    <option value="Albania">Albania</option>
                                    <option value="Algeria">Algeria</option>
                                    <option value="American Samoa">American Samoa</option>
                                    <option value="Andorra">Andorra</option>
                                    <option value="Angola">Angola</option>
                                    <option value="Anguilla">Anguilla</option>
                                    <option value="Antarctica">Antarctica</option>
                                    <option value="Antigua and Barbuda">Antigua & Barbuda</option>
                                    <option value="Argentina">Argentina</option>
                                    <option value="Armenia">Armenia</option>
                                    <option value="Aruba">Aruba</option>
                                    <option value="Australia">Australia</option>
                                    <option value="Austria">Austria</option>
                                    <option value="Azerbaijan">Azerbaijan</option>
                                    <option value="Bahamas">Bahamas</option>
                                    <option value="Bahrain">Bahrain</option>
                                    <option value="Bangladesh">Bangladesh</option>
                                    <option value="Barbados">Barbados</option>
                                    <option value="Belarus">Belarus</option>
                                    <option value="Belgium">Belgium</option>
                                    <option value="Belize">Belize</option>
                                    <option value="Benin">Benin</option>
                                    <option value="Bermuda">Bermuda</option>
                                    <option value="Bhutan">Bhutan</option>
                                    <option value="Bolivia">Bolivia</option>
                                    <option value="Bonaire, Sint Eustatius and Saba">Caribbean Netherlands</option>
                                    <option value="Bosnia and Herzegovina">Bosnia & Herzegovina</option>
                                    <option value="Botswana">Botswana</option>
                                    <option value="Bouvet Island">Bouvet Island</option>
                                    <option value="Brazil">Brazil</option>
                                    <option value="British Indian Ocean Territory">British Indian Ocean Territory</option>
                                    <option value="Brunei Darussalam">Brunei</option>
                                    <option value="Bulgaria">Bulgaria</option>
                                    <option value="Burkina Faso">Burkina Faso</option>
                                    <option value="Burundi">Burundi</option>
                                    <option value="Cambodia">Cambodia</option>
                                    <option value="Cameroon">Cameroon</option>
                                    <option value="Canada">Canada</option>
                                    <option value="Cape Verde">Cape Verde</option>
                                    <option value="Cayman Islands">Cayman Islands</option>
                                    <option value="Central African Republic">Central African Republic</option>
                                    <option value="Chad">Chad</option>
                                    <option value="Chile">Chile</option>
                                    <option value="China">China</option>
                                    <option value="Christmas Island">Christmas Island</option>
                                    <option value="Cocos (Keeling) Islands">Cocos (Keeling) Islands</option>
                                    <option value="Colombia">Colombia</option>
                                    <option value="Comoros">Comoros</option>
                                    <option value="Congo">Congo - Brazzaville</option>
                                    <option value="Congo, Democratic Republic of the Congo">Congo - Kinshasa</option>
                                    <option value="Cook Islands">Cook Islands</option>
                                    <option value="Costa Rica">Costa Rica</option>
                                    <option value="Cote D'Ivoire">Côte d’Ivoire</option>
                                    <option value="Croatia">Croatia</option>
                                    <option value="Cuba">Cuba</option>
                                    <option value="Curacao">Curaçao</option>
                                    <option value="Cyprus">Cyprus</option>
                                    <option value="Czech Republic">Czechia</option>
                                    <option value="Denmark">Denmark</option>
                                    <option value="Djibouti">Djibouti</option>
                                    <option value="Dominica">Dominica</option>
                                    <option value="Dominican Republic">Dominican Republic</option>
                                    <option value="Ecuador">Ecuador</option>
                                    <option value="Egypt">Egypt</option>
                                    <option value="El Salvador">El Salvador</option>
                                    <option value="Equatorial Guinea">Equatorial Guinea</option>
                                    <option value="Eritrea">Eritrea</option>
                                    <option value="Estonia">Estonia</option>
                                    <option value="Ethiopia">Ethiopia</option>
                                    <option value="Falkland Islands (Malvinas)">Falkland Islands (Islas Malvinas)</option>
                                    <option value="Faroe Islands">Faroe Islands</option>
                                    <option value="Fiji">Fiji</option>
                                    <option value="Finland">Finland</option>
                                    <option value="France">France</option>
                                    <option value="French Guiana">French Guiana</option>
                                    <option value="French Polynesia">French Polynesia</option>
                                    <option value="French Southern Territories">French Southern Territories</option>
                                    <option value="Gabon">Gabon</option>
                                    <option value="Gambia">Gambia</option>
                                    <option value="Georgia">Georgia</option>
                                    <option value="Germany">Germany</option>
                                    <option value="Ghana">Ghana</option>
                                    <option value="Gibraltar">Gibraltar</option>
                                    <option value="Greece">Greece</option>
                                    <option value="Greenland">Greenland</option>
                                    <option value="Grenada">Grenada</option>
                                    <option value="Guadeloupe">Guadeloupe</option>
                                    <option value="Guam">Guam</option>
                                    <option value="Guatemala">Guatemala</option>
                                    <option value="Guernsey">Guernsey</option>
                                    <option value="Guinea">Guinea</option>
                                    <option value="Guinea-Bissau">Guinea-Bissau</option>
                                    <option value="Guyana">Guyana</option>
                                    <option value="Haiti">Haiti</option>
                                    <option value="Heard Island and Mcdonald Islands">Heard & McDonald Islands</option>
                                    <option value="Holy See (Vatican City State)">Vatican City</option>
                                    <option value="Honduras">Honduras</option>
                                    <option value="Hong Kong">Hong Kong</option>
                                    <option value="Hungary">Hungary</option>
                                    <option value="Iceland">Iceland</option>
                                    <option value="India">India</option>
                                    <option value="Indonesia">Indonesia</option>
                                    <option value="Iran, Islamic Republic of">Iran</option>
                                    <option value="Iraq">Iraq</option>
                                    <option value="Ireland">Ireland</option>
                                    <option value="Isle of Man">Isle of Man</option>
                                    <option value="Israel">Israel</option>
                                    <option value="Italy">Italy</option>
                                    <option value="Jamaica">Jamaica</option>
                                    <option value="Japan">Japan</option>
                                    <option value="Jersey">Jersey</option>
                                    <option value="Jordan">Jordan</option>
                                    <option value="Kazakhstan">Kazakhstan</option>
                                    <option value="Kenya">Kenya</option>
                                    <option value="Kiribati">Kiribati</option>
                                    <option value="Korea, Democratic People's Republic of">North Korea</option>
                                    <option value="Korea, Republic of">South Korea</option>
                                    <option value="Kosovo">Kosovo</option>
                                    <option value="Kuwait">Kuwait</option>
                                    <option value="Kyrgyzstan">Kyrgyzstan</option>
                                    <option value="Lao People's Democratic Republic">Laos</option>
                                    <option value="Latvia">Latvia</option>
                                    <option value="Lebanon">Lebanon</option>
                                    <option value="Lesotho">Lesotho</option>
                                    <option value="Liberia">Liberia</option>
                                    <option value="Libyan Arab Jamahiriya">Libya</option>
                                    <option value="Liechtenstein">Liechtenstein</option>
                                    <option value="Lithuania">Lithuania</option>
                                    <option value="Luxembourg">Luxembourg</option>
                                    <option value="Macao">Macao</option>
                                    <option value="Macedonia, the Former Yugoslav Republic of">North Macedonia</option>
                                    <option value="Madagascar">Madagascar</option>
                                    <option value="Malawi">Malawi</option>
                                    <option value="Malaysia">Malaysia</option>
                                    <option value="Maldives">Maldives</option>
                                    <option value="Mali">Mali</option>
                                    <option value="Malta">Malta</option>
                                    <option value="Marshall Islands">Marshall Islands</option>
                                    <option value="Martinique">Martinique</option>
                                    <option value="Mauritania">Mauritania</option>
                                    <option value="Mauritius">Mauritius</option>
                                    <option value="Mayotte">Mayotte</option>
                                    <option value="Mexico">Mexico</option>
                                    <option value="Micronesia, Federated States of">Micronesia</option>
                                    <option value="Moldova, Republic of">Moldova</option>
                                    <option value="Monaco">Monaco</option>
                                    <option value="Mongolia">Mongolia</option>
                                    <option value="Montenegro">Montenegro</option>
                                    <option value="Montserrat">Montserrat</option>
                                    <option value="Morocco">Morocco</option>
                                    <option value="Mozambique">Mozambique</option>
                                    <option value="Myanmar">Myanmar (Burma)</option>
                                    <option value="Namibia">Namibia</option>
                                    <option value="Nauru">Nauru</option>
                                    <option value="Nepal">Nepal</option>
                                    <option value="Netherlands">Netherlands</option>
                                    <option value="Netherlands Antilles">Curaçao</option>
                                    <option value="New Caledonia">New Caledonia</option>
                                    <option value="New Zealand">New Zealand</option>
                                    <option value="Nicaragua">Nicaragua</option>
                                    <option value="Niger">Niger</option>
                                    <option value="Nigeria">Nigeria</option>
                                    <option value="Niue">Niue</option>
                                    <option value="Norfolk Island">Norfolk Island</option>
                                    <option value="Northern Mariana Islands">Northern Mariana Islands</option>
                                    <option value="Norway">Norway</option>
                                    <option value="Oman">Oman</option>
                                    <option value="Pakistan">Pakistan</option>
                                    <option value="Palau">Palau</option>
                                    <option value="Palestinian Territory, Occupied">Palestine</option>
                                    <option value="Panama">Panama</option>
                                    <option value="Papua New Guinea">Papua New Guinea</option>
                                    <option value="Paraguay">Paraguay</option>
                                    <option value="Peru">Peru</option>
                                    <option value="Philippines">Philippines</option>
                                    <option value="Pitcairn">Pitcairn Islands</option>
                                    <option value="Poland">Poland</option>
                                    <option value="Portugal">Portugal</option>
                                    <option value="Puerto Rico">Puerto Rico</option>
                                    <option value="Qatar">Qatar</option>
                                    <option value="Reunion">Réunion</option>
                                    <option value="Romania">Romania</option>
                                    <option value="Russian Federation">Russia</option>
                                    <option value="Rwanda">Rwanda</option>
                                    <option value="Saint Barthelemy">St. Barthélemy</option>
                                    <option value="Saint Helena">St. Helena</option>
                                    <option value="Saint Kitts and Nevis">St. Kitts & Nevis</option>
                                    <option value="Saint Lucia">St. Lucia</option>
                                    <option value="Saint Martin">St. Martin</option>
                                    <option value="Saint Pierre and Miquelon">St. Pierre & Miquelon</option>
                                    <option value="Saint Vincent and the Grenadines">St. Vincent & Grenadines</option>
                                    <option value="Samoa">Samoa</option>
                                    <option value="San Marino">San Marino</option>
                                    <option value="Sao Tome and Principe">São Tomé & Príncipe</option>
                                    <option value="Saudi Arabia">Saudi Arabia</option>
                                    <option value="Senegal">Senegal</option>
                                    <option value="Serbia">Serbia</option>
                                    <option value="Serbia and Montenegro">Serbia</option>
                                    <option value="Seychelles">Seychelles</option>
                                    <option value="Sierra Leone">Sierra Leone</option>
                                    <option value="Singapore">Singapore</option>
                                    <option value="Sint Maarten">Sint Maarten</option>
                                    <option value="Slovakia">Slovakia</option>
                                    <option value="Slovenia">Slovenia</option>
                                    <option value="Solomon Islands">Solomon Islands</option>
                                    <option value="Somalia">Somalia</option>
                                    <option value="South Africa">South Africa</option>
                                    <option value="South Georgia and the South Sandwich Islands">South Georgia & South Sandwich Islands</option>
                                    <option value="South Sudan">South Sudan</option>
                                    <option value="Spain">Spain</option>
                                    <option value="Sri Lanka">Sri Lanka</option>
                                    <option value="Sudan">Sudan</option>
                                    <option value="Suriname">Suriname</option>
                                    <option value="Svalbard and Jan Mayen">Svalbard & Jan Mayen</option>
                                    <option value="Swaziland">Eswatini</option>
                                    <option value="Sweden">Sweden</option>
                                    <option value="Switzerland">Switzerland</option>
                                    <option value="Syrian Arab Republic">Syria</option>
                                    <option value="Taiwan, Province of China">Taiwan</option>
                                    <option value="Tajikistan">Tajikistan</option>
                                    <option value="Tanzania, United Republic of">Tanzania</option>
                                    <option value="Thailand">Thailand</option>
                                    <option value="Timor-Leste">Timor-Leste</option>
                                    <option value="Togo">Togo</option>
                                    <option value="Tokelau">Tokelau</option>
                                    <option value="Tonga">Tonga</option>
                                    <option value="Trinidad and Tobago">Trinidad & Tobago</option>
                                    <option value="Tunisia">Tunisia</option>
                                    <option value="Turkey">Turkey</option>
                                    <option value="Turkmenistan">Turkmenistan</option>
                                    <option value="Turks and Caicos Islands">Turks & Caicos Islands</option>
                                    <option value="Tuvalu">Tuvalu</option>
                                    <option value="Uganda">Uganda</option>
                                    <option value="Ukraine">Ukraine</option>
                                    <option value="United Arab Emirates">United Arab Emirates</option>
                                    <option value="United Kingdom">United Kingdom</option>
                                    <option value="United States">United States</option>
                                    <option value="United States Minor Outlying Islands">U.S. Outlying Islands</option>
                                    <option value="Uruguay">Uruguay</option>
                                    <option value="Uzbekistan">Uzbekistan</option>
                                    <option value="Vanuatu">Vanuatu</option>
                                    <option value="Venezuela">Venezuela</option>
                                    <option value="Viet Nam">Vietnam</option>
                                    <option value="Virgin Islands, British">British Virgin Islands</option>
                                    <option value="Virgin Islands, U.s.">U.S. Virgin Islands</option>
                                    <option value="Wallis and Futuna">Wallis & Futuna</option>
                                    <option value="Western Sahara">Western Sahara</option>
                                    <option value="Yemen">Yemen</option>
                                    <option value="Zambia">Zambia</option>
                                    <option value="Zimbabwe">Zimbabwe</option>
                                </datalist>
                           <div class="flex-c-m stext-106 cl6 size-105 bor4 pointer trans-04 m-tb-4">
                              <input class="mtext-107 cl2 size-114 plh2 p-r-15" type="text"  style="background-color: #f6f6f6; padding-left: 20px; border-radius: 5px;"
                              <?php if(isset($searchString) && !empty($searchString)){ echo "value='".$searchString."'";} ?> 
                              name="search-product" placeholder="Search">
                              
                              <input class="mtext-107 cl2 size-114 plh2 p-r-15" type="text" style="background-color: #f6f6f6; margin-left: 10px; padding-left: 20px; border-radius: 5px;"
                              <?php if(isset($country) && !empty($country)){ echo "value='".$country."'";} ?> 
                              name="search-country"  autoComplete="on" list="suggestions"  placeholder="Country">

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
                                    <div class="col-sm-12 col-md-6 col-lg-4"  style="min-width: 500px;">
                                       <div class="card border rounded m-3">
                                          <div class="shadow">
                                             <div class="card-body" style="min-width: 400px;">
                                                <div class="row d-flex  justify-content-between align-items-center px-0">
                                                   <div class="col-7 text-left">
                                                      <p class="card-text car_manufacturer float-start" style="color: black;"><?php echo $value1->maker; ?></p>
                                                   </div>
                                                   <div class="col-5 text-right">
                                                      <div class="btn-group btn-addtocart float-end " role="group" aria-label="Basic mixed styles">
                                                         <a href="vehicle_preview.php?id=<?php echo $value1->id; ?>">
                                                            <button type="button" class="btn btn-sm  addtocart_button ">Buy This</button>
                                                         </a>
                                                      </div>
                                                   </div>
                                                </div>
                                                <div class="row d-flex mt-0 mb-3  justify-content-between  align-items-center " style="margin-left: -6px;">
                                                   <a style="font-size: xx-large;"><?php echo $value1->name; ?><span style="font-size: medium;"><?php echo $value1->grade; ?></span></a>
                                                </div>
                                                <div class="row d-flex  justify-content-between align-items-center px-0">
                                                   <div class="col-4 text-left">
                                                      <p class="card-text car_manufacturer float-start" style="font-size: smaller;"><?php echo sprintf(" (VEH_%05d)", $value1->id); ?></p>
                                                   </div>
                                                   <div class="col-7 text-right">
                                                      <p class="card-text pricetext font-weigh-bold" style="font-size: xx-large;">FOB <?php echo number_format($value1->getPrice()); ?> ¥</p>
                                                   </div>
                                                </div>

                                                <div class="row mt-4  px-0">
                                                   
                                                   <div class="col-12  px-0">
                                                      <img src="<?php echo file_exists("images/cars/".$value1->getImage())?"images/cars/".$value1->getImage():"images/cars/noimage.jpg"; ?>" class="w-100 img-fluid  px-0" style="max-height: 300px; object-fit: cover;" alt="Full width image">
                                                   </div>
                                                </div>
                                                <div class=" d-flex row mt-3" style="align-content: center;">
                                                   <div class="col-md-12" style="align-content: center;">
                                                      <div class=" p-2 featuremain" style="align-content: center;">
                                                         <h4><?php echo $value1->power; ?> cc</h4>
                                                         <small  class="featuremain_tag">Capacity</small>
                                                      </div>
                                                      <div class=" p-2 featuremain">
                                                         <h4><?php echo $value1->model_year; ?></h4>
                                                         <small class="featuremain_tag">Registered Year</small>
                                                      </div>
                                                      <div class=" p-2 featuremain">
                                                         <h4><?php echo $value1->running; ?><small> KM</small></h4>
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
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

parse_str($_SERVER['QUERY_STRING'], $queries);
if(isset($queries) && !empty($queries)){
   if(isset($queries['id']) && !empty($queries['id'])){
        $customer = getCustomersById($link,$queries['id']);
        if(!isset($customer)){
            echo "<script>window.close();</script>";
        }
   }else{
    echo "<script>window.close();</script>";
   }
}else{
    echo "<script>window.close();</script>";
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <link rel="shortcut icon" href="../images/logo.png" type="">
    <title>Print Postcard</title>

    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
  
    <script type="text/javascript">
        $("#btnPrint").live("click", function () {
            var divContents = $("#text").html();
            var printWindow = window.open('', '', 'height=800,width=600');
            printWindow.document.write('<html><head><title>Html to PDF</title>');
            printWindow.document.write('<style>* {box-sizing: border-box;}.row {display: flex;}.column {flex: 50%;padding: 10px;height: 300px; }</style>');
            printWindow.document.write('</head><body >');
            printWindow.document.write(divContents);
            printWindow.document.write('</body></html>');
            printWindow.document.close();
            printWindow.print();
        });
    </script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
<style>
* {
  box-sizing: border-box;
}

.row {
  display: flex;
}

.column {
  flex: 50%;
  padding: 10px;
  height: 300px; 
}
</style>
</head>
<body>

<div id="text" style="<?php if(!isset($customer) || $customer==null){echo 'display: none';} ?>" >
      <div class="row" style="width: 520px; height: 340px; border-style: solid;">
        <div class="column" style="width: 260px; ">
        </div>
        <div class="column" style="width: 260px; height: 340px; margin-top: 80px;">
            <h3><?php echo $customer->getName(); ?></h3>
            <p> <?php echo $customer->getAddress(); ?> </p>
        </div>
      </div>
    </div>

    <input type="button" value="Print Div Contents" id="btnPrint" />

</body>
</html>


<!-- <!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Postcard from Sri Lanka</title>
    <style>
     .postcard {
  border: 1px solid black;
  width: 400px;
  height: 600px;
  margin: 0 auto;
  box-shadow: 5px 5px 5px #888;
  overflow: hidden;
  position: relative;
}

.postcard-image {
  width: 100%;
  height: 50%;
  overflow: hidden;
}

.postcard-image img {
  width: 100%;
  height: 100%;
  object-fit: cover;
}

.postcard-message {
  padding: 20px;
  position: absolute;
  bottom: 0;
  width: 100%;
  height: 50%;
  background-color: #fff;
}

.postcard-message h2 {
  margin-top: 0;
}

.postcard-message p {
  font-size: 16px;
  line-height: 1.5;
}

    </style>
  </head>
  <body>
  <div class="postcard">
  <div class="postcard-image">
    <img src="https://example.com/postcard-image.jpg" alt="Postcard image">
  </div>
  <div class="postcard-message">
    <h2>Postcard Title</h2>
    <p>Dear [recipient name],<br>
    [message content]<br>
    Sincerely,<br>
    [your name]</p>
  </div>
</div>
  </body>
</html> -->


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
</head>
<body>
<?php
    require_once "./php/car_dao.php";
    // FunctionName(null);
    // insertCarFull(1,1,1,1,1,1,1,1,"ww","ww","ww","ww","ww","ww","ww","ww","ww","ww","ww","ww","ww","ww",1,1,1);
    $arra = getAllCars();
    for ($i=0; $i < sizeof($arra); $i++) { 
        echo $arra[$i]->maker_id;
        echo '</br>';
    }
?>
</body>
</html>

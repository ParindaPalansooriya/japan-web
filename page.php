
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
</head>
<body>
<?php
    require_once "./php/car_dao.php";
    $arra = searchString("w",null,null);
    for ($i=0; $i < sizeof($arra); $i++) { 
        echo $arra[$i]->maker_id;
        echo '</br>';
    }
    echo '</br>';

    $arra = searchString("w",null,null);
    for ($i=0; $i < sizeof($arra); $i++) { 
        echo $arra[$i]->maker_id;
        echo '</br>';
    }
    echo '</br>';

    $arra = searchString("e",null,null);
    for ($i=0; $i < sizeof($arra); $i++) { 
        echo $arra[$i]->maker_id;
        echo '</br>';
    }
    echo '</br>';

    $arra = searchString("g",null,null);
    for ($i=0; $i < sizeof($arra); $i++) { 
        echo $arra[$i]->maker_id;
        echo '</br>';
    }
    echo '</br>';

    $arra = searchString("n",null,null);
    for ($i=0; $i < sizeof($arra); $i++) { 
        echo $arra[$i]->maker_id;
        echo '</br>';
    }
    echo '</br>';

    $arra = searchString("w",5,null);
    for ($i=0; $i < sizeof($arra); $i++) { 
        echo $arra[$i]->maker_id;
        echo '</br>';
    }
    echo '</br>';

    $arra = searchString("w",null,2);
    for ($i=0; $i < sizeof($arra); $i++) { 
        echo $arra[$i]->maker_id;
        echo '</br>';
    }
    echo '</br>';

    $arra = searchString("e",null,2);
    for ($i=0; $i < sizeof($arra); $i++) { 
        echo $arra[$i]->maker_id;
        echo '</br>';
    }
    echo '</br>';
?>
</body>
</html>

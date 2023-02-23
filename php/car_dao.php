<?php

function insertCarFull($link,
    $maker_id,
    $model_id,
    $interior_color_id,
    $exterior_color_id,
    $current_action_id,
    $body_style_id,
    $passengers,
    $doors,
    $name,
    $grade,
    $power,
    $model_year,
    $evaluation,
    $running,
    $cooling,
    $note,
    $fuel,
    $chassis,
    $dimensions_L,
    $dimensions_W,
    $dimensions_H,
    $transmission_shift,
    $is_used,
    $is_two_weel,
    $is_steering_right
)
{
    $sql = "INSERT INTO cars (maker_id, model_id, interior_color_id, exterior_color_id, current_action_id, body_style_id, 
    passengers, doors, name, grade, power, model_year, evaluation, running, cooling, note, fuel, chassis, dimensions_L, dimensions_W, dimensions_H,
    transmission_shift, is_used, is_two_weel, is_steering_right,is_public) VALUES ($maker_id,
    $model_id,
    $interior_color_id,
    $exterior_color_id,
    $current_action_id,
    $body_style_id,
    '$passengers',
    $doors,
    '$name',
    '$grade',
    '$power',
    '$model_year',
    '$evaluation',
    '$running',
    '$cooling',
    '$note',
    '$fuel',
    '$chassis',
    '$dimensions_L',
    '$dimensions_W',
    '$dimensions_H',
    '$transmission_shift',
    $is_used,
    $is_two_weel,
    $is_steering_right,0)";

    mysqli_query($link, $sql);

    $retuen_val = 0;
    require_once "config.php";
    $sql2 = "SELECT MAX(id) as max FROM cars";

    if($result = mysqli_query($link, $sql2)){
        while($row = mysqli_fetch_array($result)){
            $retuen_val = $row['max'];
        }
        mysqli_free_result($result);
    }
    return $retuen_val;
}

function insertCarFullWithId($link, $car_id,
    $maker_id,
    $model_id,
    $interior_color_id,
    $exterior_color_id,
    $current_action_id,
    $body_style_id,
    $passengers,
    $doors,
    $name,
    $grade,
    $power,
    $model_year,
    $evaluation,
    $running,
    $cooling,
    $note,
    $fuel,
    $chassis,
    $dimensions_L,
    $dimensions_W,
    $dimensions_H,
    $transmission_shift,
    $is_used,
    $is_two_weel,
    $is_steering_right
)
{

    try{
        $sql0 = "DELETE FROM cars WHERE id = $car_id";
        mysqli_query($link, $sql0);
    }catch (Throwable $th) {
        console_log($th);
    }

    $sql = "INSERT INTO cars (id, maker_id, model_id, interior_color_id, exterior_color_id, current_action_id, body_style_id, 
    passengers, doors, name, grade, power, model_year, evaluation, running, cooling, note, fuel, chassis, dimensions_L, dimensions_W, dimensions_H,
    transmission_shift, is_used, is_two_weel, is_steering_right,is_public) VALUES ($car_id,$maker_id,
    $model_id,
    $interior_color_id,
    $exterior_color_id,
    $current_action_id,
    $body_style_id,
    '$passengers',
    $doors,
    '$name',
    '$grade',
    '$power',
    '$model_year',
    '$evaluation',
    '$running',
    '$cooling',
    '$note',
    '$fuel',
    '$chassis',
    '$dimensions_L',
    '$dimensions_W',
    '$dimensions_H',
    '$transmission_shift',
    $is_used,
    $is_two_weel,
    $is_steering_right,0)";

    mysqli_query($link, $sql);
    return $car_id;
}

function moveCarToSoledList($link,$carId,$inquaryId)
{
    require_once "car_module.php";
    $sql2 = "SELECT * FROM cars where id = $carId;";

    if($result = mysqli_query($link, $sql2)){
        while($row = mysqli_fetch_array($result)){
            $car = new Cars(
                $row['maker_id'],
                $row['model_id'],
                $row['interior_color_id'],
                $row['exterior_color_id'],
                $row['current_action_id'],
                $row['body_style_id'],
                $row['passengers'],
                $row['doors'],
                $row['name'],
                $row['grade'],
                $row['power'],
                $row['model_year'],
                $row['evaluation'],
                $row['running'],
                $row['cooling'],
                $row['note'],
                $row['fuel'],
                $row['chassis'],
                $row['dimensions_L'],
                $row['dimensions_W'],
                $row['dimensions_H'],
                $row['transmission_shift'],
                $row['id'],
                $row['is_public'],
                $row['is_used'],
                $row['is_two_weel'],
                $row['is_steering_right']
            );
            $sql = "INSERT INTO soled_cars (id,inquary_id,maker_id, model_id, interior_color_id, exterior_color_id, current_action_id, body_style_id, 
            passengers, doors, name, grade, power, model_year, evaluation, running, cooling, note, fuel, chassis, dimensions_L, dimensions_W, dimensions_H,
            transmission_shift, is_used, is_two_weel, is_steering_right,is_public) VALUES ({$car->getId()},$inquaryId,{$car->getMaker_id()},
            {$car->getModel_id()},
            {$car->getInterior_color_id()},
            {$car->getExterior_color_id()},
            {$car->getCurrent_action_id()},
            {$car->getBody_style_id()},
            '{$car->getPassengers()}',
            {$car->getDoors()},
            '{$car->getName()}',
            '{$car->getGrade()}',
            '{$car->getPower()}',
            '{$car->getModel_year()}',
            '{$car->getEvaluation()}',
            '{$car->getRunning()}',
            '{$car->getCooling()}',
            '{$car->getNote()}',
            '{$car->getFuel()}',
            '{$car->getChassis()}',
            '{$car->getDimensions_L()}',
            '{$car->getDimensions_W()}',
            '{$car->getDimensions_H()}',
            '{$car->getTransmission_shift()}',
            {$car->getIs_used()},
            {$car->getIs_two_weel()},
            {$car->getIs_steering_right()},
            {$car->getIs_public()})";

            $count = mysqli_query($link, $sql);
            // print_r($count);
            if($count>0){
                $sql3 = "DELETE FROM cars where id = $carId";
                mysqli_query($link, $sql3);
            }
        }
        mysqli_free_result($result);
    }
}

function getAllCars($link){
    $retuen_val = [];
    require_once "car_module.php";
    $sql2 = "SELECT * FROM cars";

    if($result = mysqli_query($link, $sql2)){
        while($row = mysqli_fetch_array($result)){
            $car = new Cars(
                $row['maker_id'],
                $row['model_id'],
                $row['interior_color_id'],
                $row['exterior_color_id'],
                $row['current_action_id'],
                $row['body_style_id'],
                $row['passengers'],
                $row['doors'],
                $row['name'],
                $row['grade'],
                $row['power'],
                $row['model_year'],
                $row['evaluation'],
                $row['running'],
                $row['cooling'],
                $row['note'],
                $row['fuel'],
                $row['chassis'],
                $row['dimensions_L'],
                $row['dimensions_W'],
                $row['dimensions_H'],
                $row['transmission_shift'],
                $row['id'],
                $row['is_public'],
                $row['is_used'],
                $row['is_two_weel'],
                $row['is_steering_right']
            );
            array_push($retuen_val,$car);
        }
        mysqli_free_result($result);
    }
    return $retuen_val;
}

function getAllCarsForReport($link){
    $retuen_val = [];
    require_once "car_module.php";
    $sql2 = "SELECT *,
    (select image from car_imagers where cars.id=car_imagers.car_id and car_imagers.is_main=1) as image ,
    (select name from car_makers where cars.maker_id=car_makers.id) as maker ,
    (select name from car_model where cars.model_id=car_model.id) as model ,
    (select name from exterior_color where cars.exterior_color_id=exterior_color.id) as exterior_color ,
    (select name from interior_color where cars.interior_color_id=interior_color.id) as interior_color ,
    (select name from body_style where cars.body_style_id=body_style.id) as body_style 
    FROM cars;";

    if($result = mysqli_query($link, $sql2)){
        while($row = mysqli_fetch_array($result)){
            $car = new Cars(
                $row['maker_id'],
                $row['model_id'],
                $row['interior_color_id'],
                $row['exterior_color_id'],
                $row['current_action_id'],
                $row['body_style_id'],
                $row['passengers'],
                $row['doors'],
                $row['name'],
                $row['grade'],
                $row['power'],
                $row['model_year'],
                $row['evaluation'],
                $row['running'],
                $row['cooling'],
                $row['note'],
                $row['fuel'],
                $row['chassis'],
                $row['dimensions_L'],
                $row['dimensions_W'],
                $row['dimensions_H'],
                $row['transmission_shift'],
                $row['id'],
                $row['is_public'],
                $row['is_used'],
                $row['is_two_weel'],
                $row['is_steering_right']
            );
            $car->setImage($row['image']);
            $car->setStyle($row['body_style']);
            $car->setEx_color($row['exterior_color']);
            $car->setIn_color($row['interior_color']);
            $car->setMaker($row['maker']);
            $car->setModel($row['model']);

            require_once "car_additinal_dao.php";
            require_once "car_deduction_dao.php";
            require_once "car_price_dao.php";
            require_once "user_inquary_dao.php";

            $car->setPrice(getCarPrice($link,$row['id']));
            $car->setDeductions(getCarDeduction($link,$row['id']));
            $car->setAdditional(getCarAdditinal($link,$row['id']));
            $car->setUserInwuary(getUserInquary($link,$row['id']));

            array_push($retuen_val,$car);
        }
        mysqli_free_result($result);
    }
    return $retuen_val;
}

function getAllSoledCarsForReport($link){
    $retuen_val = [];
    require_once "car_module.php";
    $sql2 = "SELECT *,
    (select image from car_imagers where soled_cars.id=car_imagers.car_id and car_imagers.is_main=1) as image ,
    (select name from car_makers where soled_cars.maker_id=car_makers.id) as maker ,
    (select name from car_model where soled_cars.model_id=car_model.id) as model ,
    (select name from exterior_color where soled_cars.exterior_color_id=exterior_color.id) as exterior_color ,
    (select name from interior_color where soled_cars.interior_color_id=interior_color.id) as interior_color ,
    (select name from body_style where soled_cars.body_style_id=body_style.id) as body_style 
    FROM soled_cars;";

    if($result = mysqli_query($link, $sql2)){
        while($row = mysqli_fetch_array($result)){
            $car = new Cars(
                $row['maker_id'],
                $row['model_id'],
                $row['interior_color_id'],
                $row['exterior_color_id'],
                $row['current_action_id'],
                $row['body_style_id'],
                $row['passengers'],
                $row['doors'],
                $row['name'],
                $row['grade'],
                $row['power'],
                $row['model_year'],
                $row['evaluation'],
                $row['running'],
                $row['cooling'],
                $row['note'],
                $row['fuel'],
                $row['chassis'],
                $row['dimensions_L'],
                $row['dimensions_W'],
                $row['dimensions_H'],
                $row['transmission_shift'],
                $row['id'],
                $row['is_public'],
                $row['is_used'],
                $row['is_two_weel'],
                $row['is_steering_right']
            );
            $car->setImage($row['image']);
            $car->setStyle($row['body_style']);
            $car->setEx_color($row['exterior_color']);
            $car->setIn_color($row['interior_color']);
            $car->setMaker($row['maker']);
            $car->setModel($row['model']);
            $car->setDate($row['date']);

            require_once "car_additinal_dao.php";
            require_once "car_deduction_dao.php";
            require_once "car_price_dao.php";
            require_once "user_inquary_dao.php";

            $car->setPrice(getCarPrice($link,$row['id']));
            $car->setDeductions(getCarDeduction($link,$row['id']));
            $car->setAdditional(getCarAdditinal($link,$row['id']));
            $car->setUserInwuary(getUserInquary($link,$row['id']));

            array_push($retuen_val,$car);
        }
        mysqli_free_result($result);
    }
    return $retuen_val;
}

function getAllSoledCarsForReportWithDate($link,$date){
    $retuen_val = [];
    require_once "car_module.php";
    $sql2 = "SELECT *,
    (select image from car_imagers where soled_cars.id=car_imagers.car_id and car_imagers.is_main=1) as image ,
    (select name from car_makers where soled_cars.maker_id=car_makers.id) as maker ,
    (select name from car_model where soled_cars.model_id=car_model.id) as model ,
    (select name from exterior_color where soled_cars.exterior_color_id=exterior_color.id) as exterior_color ,
    (select name from interior_color where soled_cars.interior_color_id=interior_color.id) as interior_color ,
    (select name from body_style where soled_cars.body_style_id=body_style.id) as body_style 
    FROM soled_cars where date like '%$date%';";

    if($result = mysqli_query($link, $sql2)){
        while($row = mysqli_fetch_array($result)){
            $car = new Cars(
                $row['maker_id'],
                $row['model_id'],
                $row['interior_color_id'],
                $row['exterior_color_id'],
                $row['current_action_id'],
                $row['body_style_id'],
                $row['passengers'],
                $row['doors'],
                $row['name'],
                $row['grade'],
                $row['power'],
                $row['model_year'],
                $row['evaluation'],
                $row['running'],
                $row['cooling'],
                $row['note'],
                $row['fuel'],
                $row['chassis'],
                $row['dimensions_L'],
                $row['dimensions_W'],
                $row['dimensions_H'],
                $row['transmission_shift'],
                $row['id'],
                $row['is_public'],
                $row['is_used'],
                $row['is_two_weel'],
                $row['is_steering_right']
            );
            $car->setImage($row['image']);
            $car->setStyle($row['body_style']);
            $car->setEx_color($row['exterior_color']);
            $car->setIn_color($row['interior_color']);
            $car->setMaker($row['maker']);
            $car->setModel($row['model']);
            $car->setDate($row['date']);

            require_once "car_additinal_dao.php";
            require_once "car_deduction_dao.php";
            require_once "car_price_dao.php";
            require_once "user_inquary_dao.php";

            $car->setPrice(getCarPrice($link,$row['id']));
            $car->setDeductions(getCarDeduction($link,$row['id']));
            $car->setAdditional(getCarAdditinal($link,$row['id']));
            $car->setUserInwuary(getUserInquary($link,$row['id']));

            array_push($retuen_val,$car);
        }
        mysqli_free_result($result);
    }
    return $retuen_val;
}

function getCarsForReport($link,$car_id){
    $car = null;
    require_once "car_module.php";
    $sql2 = "SELECT *,
    (select image from car_imagers where cars.id=car_imagers.car_id and car_imagers.is_main=1) as image ,
    (select name from car_makers where cars.maker_id=car_makers.id) as maker ,
    (select name from car_model where cars.model_id=car_model.id) as model ,
    (select name from exterior_color where cars.exterior_color_id=exterior_color.id) as exterior_color ,
    (select name from interior_color where cars.interior_color_id=interior_color.id) as interior_color ,
    (select name from body_style where cars.body_style_id=body_style.id) as body_style 
    FROM cars where id = $car_id;";

    // echo $sql2;

    if($result = mysqli_query($link, $sql2)){
        while($row = mysqli_fetch_array($result)){
            $car = new Cars(
                $row['maker_id'],
                $row['model_id'],
                $row['interior_color_id'],
                $row['exterior_color_id'],
                $row['current_action_id'],
                $row['body_style_id'],
                $row['passengers'],
                $row['doors'],
                $row['name'],
                $row['grade'],
                $row['power'],
                $row['model_year'],
                $row['evaluation'],
                $row['running'],
                $row['cooling'],
                $row['note'],
                $row['fuel'],
                $row['chassis'],
                $row['dimensions_L'],
                $row['dimensions_W'],
                $row['dimensions_H'],
                $row['transmission_shift'],
                $row['id'],
                $row['is_public'],
                $row['is_used'],
                $row['is_two_weel'],
                $row['is_steering_right']
            );
            $car->setImage($row['image']);
            $car->setStyle($row['body_style']);
            $car->setEx_color($row['exterior_color']);
            $car->setIn_color($row['interior_color']);
            $car->setMaker($row['maker']);
            $car->setModel($row['model']);

            require_once "car_additinal_dao.php";
            require_once "car_deduction_dao.php";
            require_once "car_price_dao.php";
            require_once "user_inquary_dao.php";

            $car->setPrice(getCarPrice($link,$row['id']));
            $car->setDeductions(getCarDeduction($link,$row['id']));
            $car->setAdditional(getCarAdditinal($link,$row['id']));
            $car->setUserInwuary(getUserInquary($link,$row['id']));
        }
        mysqli_free_result($result);
    }
    return $car;
}

function getAllCarsForLists($link){
    $retuen_val = [];
    require_once "car_module.php";
    $sql2 = "SELECT *,
    (select image from car_imagers where cars.id=car_imagers.car_id and car_imagers.is_main=1) as image ,
    (select name from car_makers where cars.maker_id=car_makers.id) as maker ,
    (select name from car_model where cars.model_id=car_model.id) as model ,
    (select name from exterior_color where cars.exterior_color_id=exterior_color.id) as exterior_color ,
    (select name from interior_color where cars.interior_color_id=interior_color.id) as interior_color ,
    (select name from body_style where cars.body_style_id=body_style.id) as body_style 
    FROM cars;";

    if($result = mysqli_query($link, $sql2)){
        while($row = mysqli_fetch_array($result)){
            $car = new Cars(
                $row['maker_id'],
                $row['model_id'],
                $row['interior_color_id'],
                $row['exterior_color_id'],
                $row['current_action_id'],
                $row['body_style_id'],
                $row['passengers'],
                $row['doors'],
                $row['name'],
                $row['grade'],
                $row['power'],
                $row['model_year'],
                $row['evaluation'],
                $row['running'],
                $row['cooling'],
                $row['note'],
                $row['fuel'],
                $row['chassis'],
                $row['dimensions_L'],
                $row['dimensions_W'],
                $row['dimensions_H'],
                $row['transmission_shift'],
                $row['id'],
                $row['is_public'],
                $row['is_used'],
                $row['is_two_weel'],
                $row['is_steering_right']
            );
            $car->setImage($row['image']);
            $car->setStyle($row['body_style']);
            $car->setEx_color($row['exterior_color']);
            $car->setIn_color($row['interior_color']);
            $car->setMaker($row['maker']);
            $car->setModel($row['model']);
            array_push($retuen_val,$car);
        }
        mysqli_free_result($result);
    }
    return $retuen_val;
}

function getAllUserSellingCarsForAdminLists($link){
    $retuen_val = [];
    require_once "car_module.php";
    require_once "user_inquary_module.php";
    $sql2 = "SELECT *,
    user_inquary.id AS inquary_id,
    (select image from car_imagers where cars.id=car_imagers.car_id and car_imagers.is_main=1) as image ,
    (select name from car_makers where cars.maker_id=car_makers.id) as maker ,
    (select name from car_model where cars.model_id=car_model.id) as model ,
    (select price1 from car_price where cars.id=car_price.car_id) as price ,
    (select name from exterior_color where cars.exterior_color_id=exterior_color.id) as exterior_color ,
    (select name from interior_color where cars.interior_color_id=interior_color.id) as interior_color ,
    (select name from body_style where cars.body_style_id=body_style.id) as body_style 
    FROM cars INNER JOIN user_inquary ON cars.id=user_inquary.car_id 
    WHERE user_inquary.type=1 AND user_inquary.status=0 AND cars.current_action_id=0;";

    if($result = mysqli_query($link, $sql2)){
        while($row = mysqli_fetch_array($result)){
            $car = new Cars(
                $row['maker_id'],
                $row['model_id'],
                $row['interior_color_id'],
                $row['exterior_color_id'],
                $row['current_action_id'],
                $row['body_style_id'],
                $row['passengers'],
                $row['doors'],
                $row['name'],
                $row['grade'],
                $row['power'],
                $row['model_year'],
                $row['evaluation'],
                $row['running'],
                $row['cooling'],
                $row['note'],
                $row['fuel'],
                $row['chassis'],
                $row['dimensions_L'],
                $row['dimensions_W'],
                $row['dimensions_H'],
                $row['transmission_shift'],
                $row['car_id'],
                $row['is_public'],
                $row['is_used'],
                $row['is_two_weel'],
                $row['is_steering_right']
            );
            $car->setImage($row['image']);
            $car->setStyle($row['body_style']);
            $car->setEx_color($row['exterior_color']);
            $car->setIn_color($row['interior_color']);
            $car->setMaker($row['maker']);
            $car->setModel($row['model']);
            $car->setPrice($row['price']);
            $car->setUserInwuary(new UserInquary(
                $row['inquary_id'],$row['car_id'],$row['username'],$row['email'],$row['mobile'],$row['nearest_port'],$row['message']
            ));
            array_push($retuen_val,$car);
        }
        mysqli_free_result($result);
    }
    return $retuen_val;
}

function getAllUserBuyingCarsForAdminLists($link){
    $retuen_val = [];
    require_once "car_module.php";
    require_once "user_inquary_module.php";
    $sql2 = "SELECT *,
    user_inquary.id AS inquary_id,
    (select image from car_imagers where cars.id=car_imagers.car_id and car_imagers.is_main=1) as image ,
    (select name from car_makers where cars.maker_id=car_makers.id) as maker ,
    (select name from car_model where cars.model_id=car_model.id) as model ,
    (select public from car_price where cars.id=car_price.car_id) as price ,
    (select name from exterior_color where cars.exterior_color_id=exterior_color.id) as exterior_color ,
    (select name from interior_color where cars.interior_color_id=interior_color.id) as interior_color ,
    (select name from body_style where cars.body_style_id=body_style.id) as body_style 
    FROM cars INNER JOIN user_inquary ON cars.id=user_inquary.car_id 
    WHERE user_inquary.type=0 AND user_inquary.status=0;";

    if($result = mysqli_query($link, $sql2)){
        while($row = mysqli_fetch_array($result)){
            $car = new Cars(
                $row['maker_id'],
                $row['model_id'],
                $row['interior_color_id'],
                $row['exterior_color_id'],
                $row['current_action_id'],
                $row['body_style_id'],
                $row['passengers'],
                $row['doors'],
                $row['name'],
                $row['grade'],
                $row['power'],
                $row['model_year'],
                $row['evaluation'],
                $row['running'],
                $row['cooling'],
                $row['note'],
                $row['fuel'],
                $row['chassis'],
                $row['dimensions_L'],
                $row['dimensions_W'],
                $row['dimensions_H'],
                $row['transmission_shift'],
                $row['car_id'],
                $row['is_public'],
                $row['is_used'],
                $row['is_two_weel'],
                $row['is_steering_right']
            );
            $car->setImage($row['image']);
            $car->setStyle($row['body_style']);
            $car->setEx_color($row['exterior_color']);
            $car->setIn_color($row['interior_color']);
            $car->setMaker($row['maker']);
            $car->setModel($row['model']);
            $car->setPrice($row['price']);
            $car->setUserInwuary(new UserInquary(
                $row['inquary_id'],$row['car_id'],$row['username'],$row['email'],$row['mobile'],$row['nearest_port'],$row['message']
            ));
            array_push($retuen_val,$car);
        }
        mysqli_free_result($result);
    }
    return $retuen_val;
}

function getAllCarsForAdminLists($link){
    $retuen_val = [];
    require_once "car_module.php";
    require_once "car_price_module.php";
    require_once "user_inquary_module.php";
    $sql2 = "SELECT *,
    (select image from car_imagers where cars.id=car_imagers.car_id and car_imagers.is_main=1) as image ,
    (select name from car_makers where cars.maker_id=car_makers.id) as maker ,
    (select name from car_model where cars.model_id=car_model.id) as model ,
    (select name from exterior_color where cars.exterior_color_id=exterior_color.id) as exterior_color ,
    (select name from interior_color where cars.interior_color_id=interior_color.id) as interior_color ,
    (select name from body_style where cars.body_style_id=body_style.id) as body_style 
    FROM cars INNER JOIN car_price ON cars.id=car_price.car_id;";

    if($result = mysqli_query($link, $sql2)){
        while($row = mysqli_fetch_array($result)){
            $car = new Cars(
                $row['maker_id'],
                $row['model_id'],
                $row['interior_color_id'],
                $row['exterior_color_id'],
                $row['current_action_id'],
                $row['body_style_id'],
                $row['passengers'],
                $row['doors'],
                $row['name'],
                $row['grade'],
                $row['power'],
                $row['model_year'],
                $row['evaluation'],
                $row['running'],
                $row['cooling'],
                $row['note'],
                $row['fuel'],
                $row['chassis'],
                $row['dimensions_L'],
                $row['dimensions_W'],
                $row['dimensions_H'],
                $row['transmission_shift'],
                $row['car_id'],
                $row['is_public'],
                $row['is_used'],
                $row['is_two_weel'],
                $row['is_steering_right']
            );
            $car->setImage($row['image']);
            $car->setStyle($row['body_style']);
            $car->setEx_color($row['exterior_color']);
            $car->setIn_color($row['interior_color']);
            $car->setMaker($row['maker']);
            $car->setModel($row['model']);
            $car->setPrice(new CarPrice(
                $row['car_id'],
                $row['buying'],
                $row['selling'],
                $row['public'],
                $row['price1'],
                $row['price2']
            ));
            array_push($retuen_val,$car);
        }
        mysqli_free_result($result);
    }
    return $retuen_val;
}

function getAllFirld10Cars($link){
    $retuen_val = [];
    require_once "car_module.php";
    $sql2 = "SELECT *,
    (select image from car_imagers where cars.id=car_imagers.car_id and car_imagers.is_main=1) as image ,
    (select name from car_makers where cars.maker_id=car_makers.id) as maker ,
    (select name from car_model where cars.model_id=car_model.id) as model ,
    (select public from car_price where cars.id=car_price.car_id) as price ,
    (select name from exterior_color where cars.exterior_color_id=exterior_color.id) as exterior_color ,
    (select name from interior_color where cars.interior_color_id=interior_color.id) as interior_color ,
    (select name from body_style where cars.body_style_id=body_style.id) as body_style 
    FROM cars where current_action_id = -1 LIMIT 10;";

    if($result = mysqli_query($link, $sql2)){
        while($row = mysqli_fetch_array($result)){
            $car = new Cars(
                $row['maker_id'],
                $row['model_id'],
                $row['interior_color_id'],
                $row['exterior_color_id'],
                $row['current_action_id'],
                $row['body_style_id'],
                $row['passengers'],
                $row['doors'],
                $row['name'],
                $row['grade'],
                $row['power'],
                $row['model_year'],
                $row['evaluation'],
                $row['running'],
                $row['cooling'],
                $row['note'],
                $row['fuel'],
                $row['chassis'],
                $row['dimensions_L'],
                $row['dimensions_W'],
                $row['dimensions_H'],
                $row['transmission_shift'],
                $row['id'],
                $row['is_public'],
                $row['is_used'],
                $row['is_two_weel'],
                $row['is_steering_right']
            );
            $car->setImage($row['image']);
            $car->setStyle($row['body_style']);
            $car->setEx_color($row['exterior_color']);
            $car->setIn_color($row['interior_color']);
            $car->setMaker($row['maker']);
            $car->setModel($row['model']);
            $car->setPrice($row['price']);
            array_push($retuen_val,$car);
        }
        mysqli_free_result($result);
    }
    return $retuen_val;
}

function getCarsById($link,$car_id){
    require_once "car_module.php";
    $car = null; 
    $sql2 = "SELECT *,
    (select image from car_imagers where cars.id=car_imagers.car_id and car_imagers.is_main=1) as image ,
    (select name from car_makers where cars.maker_id=car_makers.id) as maker , 
    (select public from car_price where cars.id=car_price.car_id) as price,
    (select name from car_model where cars.model_id=car_model.id) as model ,
    (select name from exterior_color where cars.exterior_color_id=exterior_color.id) as exterior_color ,
    (select name from interior_color where cars.interior_color_id=interior_color.id) as interior_color ,
    (select name from body_style where cars.body_style_id=body_style.id) as body_style 
    FROM cars where id = $car_id;";

    if($result = mysqli_query($link, $sql2)){
        while($row = mysqli_fetch_array($result)){
            $car = new Cars(
                $row['maker_id'],
                $row['model_id'],
                $row['interior_color_id'],
                $row['exterior_color_id'],
                $row['current_action_id'],
                $row['body_style_id'],
                $row['passengers'],
                $row['doors'],
                $row['name'],
                $row['grade'],
                $row['power'],
                $row['model_year'],
                $row['evaluation'],
                $row['running'],
                $row['cooling'],
                $row['note'],
                $row['fuel'],
                $row['chassis'],
                $row['dimensions_L'],
                $row['dimensions_W'],
                $row['dimensions_H'],
                $row['transmission_shift'],
                $row['id'],
                $row['is_public'],
                $row['is_used'],
                $row['is_two_weel'],
                $row['is_steering_right']
            );
            $car->setImage($row['image']);
            $car->setStyle($row['body_style']);
            $car->setEx_color($row['exterior_color']);
            $car->setIn_color($row['interior_color']);
            $car->setMaker($row['maker']);
            $car->setModel($row['model']);
            $car->setPrice($row['price']);
        }
        mysqli_free_result($result);
    }
    return $car;
}

function getCarsByIdWithbidPrice($link,$car_id){
    require_once "car_module.php";
    $car = null; 
    $sql2 = "SELECT *,
    (select image from car_imagers where cars.id=car_imagers.car_id and car_imagers.is_main=1) as image ,
    (select name from car_makers where cars.maker_id=car_makers.id) as maker , 
    (select price1 from car_price where cars.id=car_price.car_id) as price,
    (select name from car_model where cars.model_id=car_model.id) as model ,
    (select name from exterior_color where cars.exterior_color_id=exterior_color.id) as exterior_color ,
    (select name from interior_color where cars.interior_color_id=interior_color.id) as interior_color ,
    (select name from body_style where cars.body_style_id=body_style.id) as body_style 
    FROM cars where id = $car_id;";

    if($result = mysqli_query($link, $sql2)){
        while($row = mysqli_fetch_array($result)){
            $car = new Cars(
                $row['maker_id'],
                $row['model_id'],
                $row['interior_color_id'],
                $row['exterior_color_id'],
                $row['current_action_id'],
                $row['body_style_id'],
                $row['passengers'],
                $row['doors'],
                $row['name'],
                $row['grade'],
                $row['power'],
                $row['model_year'],
                $row['evaluation'],
                $row['running'],
                $row['cooling'],
                $row['note'],
                $row['fuel'],
                $row['chassis'],
                $row['dimensions_L'],
                $row['dimensions_W'],
                $row['dimensions_H'],
                $row['transmission_shift'],
                $row['id'],
                $row['is_public'],
                $row['is_used'],
                $row['is_two_weel'],
                $row['is_steering_right']
            );
            $car->setImage($row['image']);
            $car->setStyle($row['body_style']);
            $car->setEx_color($row['exterior_color']);
            $car->setIn_color($row['interior_color']);
            $car->setMaker($row['maker']);
            $car->setModel($row['model']);
            $car->setPrice($row['price']);
        }
        mysqli_free_result($result);
    }
    return $car;
}

function updateAction($link,$carId,$action){
    $sql2 = "UPDATE cars SET current_action_id = $action WHERE id = $carId ;";
    return mysqli_query($link, $sql2);
}

function updatePublic($link,$carId,$action){
    $sql2 = "UPDATE cars SET is_public = $action WHERE id = $carId ;";
    return mysqli_query($link, $sql2);
}

function getMaxId($link){
    $retuen_val = 0;
    $sql2 = "SELECT MAX(id) as max FROM cars";

    if($result = mysqli_query($link, $sql2)){
        while($row = mysqli_fetch_array($result)){
            $retuen_val = $row['max'];
        }
        mysqli_free_result($result);
    }
    return $retuen_val;
}

function searchStringArray($link,$val,$modulId,$makerId){
    $retuen_val = [];
    $modulIdString=null;
    $makerIdString=null;
    if(isset($modulId) && !empty($modulId)){
        $modulIdString = implode(',', $modulId);
    }
    if(isset($makerId) && !empty($makerId)){
        $makerIdString = implode(',', $makerId);
    }
    require_once "car_module.php";
    if(empty($val)){
        if(isset($modulIdString) && !isset($makerIdString)){
            $sql2 = "SELECT *,
            (select image from car_imagers where cars.id=car_imagers.car_id and car_imagers.is_main=1) as image ,
            (select name from car_makers where cars.maker_id=car_makers.id) as maker ,
            (select name from car_model where cars.model_id=car_model.id) as model , 
            (select public from car_price where cars.id=car_price.car_id) as price,
            (select name from exterior_color where cars.exterior_color_id=exterior_color.id) as exterior_color ,
            (select name from interior_color where cars.interior_color_id=interior_color.id) as interior_color ,
            (select name from body_style where cars.body_style_id=body_style.id) as body_style 
             FROM cars where current_action_id=-1 and model_id in ($modulIdString)";
        }else if(!isset($modulIdString) && isset($makerIdString)){
            $sql2 = "SELECT *,
            (select image from car_imagers where cars.id=car_imagers.car_id and car_imagers.is_main=1) as image ,
            (select name from car_makers where cars.maker_id=car_makers.id) as maker ,
            (select name from car_model where cars.model_id=car_model.id) as model , 
            (select public from car_price where cars.id=car_price.car_id) as price,
            (select name from exterior_color where cars.exterior_color_id=exterior_color.id) as exterior_color ,
            (select name from interior_color where cars.interior_color_id=interior_color.id) as interior_color ,
            (select name from body_style where cars.body_style_id=body_style.id) as body_style 
             FROM cars where current_action_id=-1 and maker_id in ($makerIdString)";
        }else if(isset($modulIdString) && isset($makerIdString)){
            $sql2 = "SELECT *,
            (select image from car_imagers where cars.id=car_imagers.car_id and car_imagers.is_main=1) as image ,
            (select name from car_makers where cars.maker_id=car_makers.id) as maker ,
            (select name from car_model where cars.model_id=car_model.id) as model , 
            (select public from car_price where cars.id=car_price.car_id) as price,
            (select name from exterior_color where cars.exterior_color_id=exterior_color.id) as exterior_color ,
            (select name from interior_color where cars.interior_color_id=interior_color.id) as interior_color ,
            (select name from body_style where cars.body_style_id=body_style.id) as body_style 
             FROM cars where current_action_id=-1 and model_id in ($modulIdString) and maker_id in ($makerIdString)";
        }else{
            $sql2 = "SELECT *,
            (select image from car_imagers where cars.id=car_imagers.car_id and car_imagers.is_main=1) as image ,
            (select name from car_makers where cars.maker_id=car_makers.id) as maker ,
            (select name from car_model where cars.model_id=car_model.id) as model , 
            (select public from car_price where cars.id=car_price.car_id) as price,
            (select name from exterior_color where cars.exterior_color_id=exterior_color.id) as exterior_color ,
            (select name from interior_color where cars.interior_color_id=interior_color.id) as interior_color ,
            (select name from body_style where cars.body_style_id=body_style.id) as body_style 
             FROM cars where current_action_id=-1";
        }
    }else{
        if(isset($modulIdString) && !isset($makerIdString)){
            $sql2 = "SELECT *,
            (select image from car_imagers where cars.id=car_imagers.car_id and car_imagers.is_main=1) as image ,
            (select name from car_makers where cars.maker_id=car_makers.id) as maker ,
            (select name from car_model where cars.model_id=car_model.id) as model , 
            (select public from car_price where cars.id=car_price.car_id) as price,
            (select name from exterior_color where cars.exterior_color_id=exterior_color.id) as exterior_color ,
            (select name from interior_color where cars.interior_color_id=interior_color.id) as interior_color ,
            (select name from body_style where cars.body_style_id=body_style.id) as body_style 
             FROM cars where current_action_id=-1 and model_id in ($modulIdString) and ( name like '%$val%' or grade like '%$val%' or note like '%$val%' ) ";
        }else if(!isset($modulIdString) && isset($makerIdString)){
            $sql2 = "SELECT *,
            (select image from car_imagers where cars.id=car_imagers.car_id and car_imagers.is_main=1) as image ,
            (select name from car_makers where cars.maker_id=car_makers.id) as maker ,
            (select name from car_model where cars.model_id=car_model.id) as model , 
            (select public from car_price where cars.id=car_price.car_id) as price,
            (select name from exterior_color where cars.exterior_color_id=exterior_color.id) as exterior_color ,
            (select name from interior_color where cars.interior_color_id=interior_color.id) as interior_color ,
            (select name from body_style where cars.body_style_id=body_style.id) as body_style 
             FROM cars where current_action_id=-1 and maker_id in ($makerIdString) and ( name like '%$val%' or grade like '%$val%' or note like '%$val%' ) ";
        }else if(isset($modulIdString) && isset($makerIdString)){
            $sql2 = "SELECT *,
            (select image from car_imagers where cars.id=car_imagers.car_id and car_imagers.is_main=1) as image ,
            (select name from car_makers where cars.maker_id=car_makers.id) as maker ,
            (select name from car_model where cars.model_id=car_model.id) as model , 
            (select public from car_price where cars.id=car_price.car_id) as price,
            (select name from exterior_color where cars.exterior_color_id=exterior_color.id) as exterior_color ,
            (select name from interior_color where cars.interior_color_id=interior_color.id) as interior_color ,
            (select name from body_style where cars.body_style_id=body_style.id) as body_style 
             FROM cars where current_action_id=-1 and model_id in ($modulIdString) and maker_id in ($makerIdString) and ( name like '%$val%' or grade like '%$val%' or note like '%$val%' ) ";
        }else{
            $sql2 = "SELECT *,
            (select image from car_imagers where cars.id=car_imagers.car_id and car_imagers.is_main=1) as image ,
            (select name from car_makers where cars.maker_id=car_makers.id) as maker ,
            (select name from car_model where cars.model_id=car_model.id) as model , 
            (select public from car_price where cars.id=car_price.car_id) as price,
            (select name from exterior_color where cars.exterior_color_id=exterior_color.id) as exterior_color ,
            (select name from interior_color where cars.interior_color_id=interior_color.id) as interior_color ,
            (select name from body_style where cars.body_style_id=body_style.id) as body_style 
             FROM cars where current_action_id=-1 and ( name like '%$val%' or grade like '%$val%' or note like '%$val%' ) ";
        }
    }
    if($result = mysqli_query($link, $sql2)){
        while($row = mysqli_fetch_array($result)){
            $car = new Cars(
                $row['maker_id'],
                $row['model_id'],
                $row['interior_color_id'],
                $row['exterior_color_id'],
                $row['current_action_id'],
                $row['body_style_id'],
                $row['passengers'],
                $row['doors'],
                $row['name'],
                $row['grade'],
                $row['power'],
                $row['model_year'],
                $row['evaluation'],
                $row['running'],
                $row['cooling'],
                $row['note'],
                $row['fuel'],
                $row['chassis'],
                $row['dimensions_L'],
                $row['dimensions_W'],
                $row['dimensions_H'],
                $row['transmission_shift'],
                $row['id'],
                $row['is_public'],
                $row['is_used'],
                $row['is_two_weel'],
                $row['is_steering_right']
            );
            $car->setImage($row['image']);
            $car->setStyle($row['body_style']);
            $car->setEx_color($row['exterior_color']);
            $car->setIn_color($row['interior_color']);
            $car->setMaker($row['maker']);
            $car->setModel($row['model']);
            $car->setPrice($row['price']);
            array_push($retuen_val,$car);
        }
        mysqli_free_result($result);
    }
    return $retuen_val;
}

?>
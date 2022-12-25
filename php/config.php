<?php
/* Database credentials. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'japan_web');
 
/* Attempt to connect to MySQL database */
$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
 
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}else{
    try {
        $car_action_type = "CREATE TABLE IF NOT EXISTS car_action_type ( 
            id INT NOT NULL PRIMARY KEY AUTO_INCREMENT, 
            name VARCHAR(255) NOT NULL DEFAULT 'No_Name', 
            is_active INT(1) NOT NULL DEFAULT 0
            )";
        mysqli_query($link, $car_action_type);
    } catch (Throwable $th) {
        console_log($th);
    }

    try {
        $car_makers = "CREATE TABLE IF NOT EXISTS car_makers ( 
            id INT NOT NULL PRIMARY KEY AUTO_INCREMENT, 
            name VARCHAR(255) NOT NULL DEFAULT 'No_Name', 
            image TEXT , 
            is_active INT(1) NOT NULL DEFAULT 0
            )";
        mysqli_query($link, $car_makers);
    } catch (Throwable $th) {
        console_log($th);
    }

    try {
        $interior_color = "CREATE TABLE IF NOT EXISTS interior_color ( 
            id INT NOT NULL PRIMARY KEY AUTO_INCREMENT, 
            name VARCHAR(255) NOT NULL DEFAULT 'No_Name', 
            code VARCHAR(100) NOT NULL DEFAULT 'No_Color', 
            hex_code VARCHAR(10) NOT NULL DEFAULT 'No_Color'
            )";
        mysqli_query($link, $interior_color);
    } catch (Throwable $th) {
        console_log($th);
    }

    try {
        $exterior_color = "CREATE TABLE IF NOT EXISTS exterior_color ( 
            id INT NOT NULL PRIMARY KEY AUTO_INCREMENT, 
            name VARCHAR(255) NOT NULL DEFAULT 'No_Name', 
            code VARCHAR(100) NOT NULL DEFAULT 'No_Color', 
            hex_code VARCHAR(10) NOT NULL DEFAULT 'No_Color'
            )";
        mysqli_query($link, $exterior_color);
    } catch (Throwable $th) {
        console_log($th);
    }

    try {
        $car_imagers = "CREATE TABLE IF NOT EXISTS car_imagers ( 
            id INT NOT NULL PRIMARY KEY AUTO_INCREMENT, 
            car_id INT NOT NULL DEFAULT 0, 
            image TEXT, 
            is_main INT(1) NOT NULL DEFAULT 0
            )";
        mysqli_query($link, $car_imagers);
    } catch (Throwable $th) {
        console_log($th);
    }

    try {
        $control_users = "CREATE TABLE IF NOT EXISTS control_users ( 
            id INT NOT NULL PRIMARY KEY AUTO_INCREMENT, 
            username VARCHAR(255) NOT NULL DEFAULT 'null', 
            password1 VARCHAR(255) NOT NULL DEFAULT 'null', 
            user_type INT(1) NOT NULL DEFAULT 0,
            is_active INT(1) NOT NULL DEFAULT 0
            )";
        mysqli_query($link, $control_users);
    } catch (Throwable $th) {
        console_log($th);
    }

    try {
        $car_price = "CREATE TABLE IF NOT EXISTS car_price ( 
            car_id INT NOT NULL PRIMARY KEY , 
            buying VARCHAR(15) NOT NULL DEFAULT '0', 
            selling VARCHAR(15) NOT NULL DEFAULT '0', 
            public VARCHAR(15) NOT NULL DEFAULT '0', 
            price1 VARCHAR(15) NOT NULL DEFAULT '0', 
            price2 VARCHAR(15) NOT NULL DEFAULT '0'
            )";
        mysqli_query($link, $car_price);
    } catch (Throwable $th) {
        console_log($th);
    }

    try {
        $body_style = "CREATE TABLE IF NOT EXISTS body_style ( 
            id INT NOT NULL PRIMARY KEY AUTO_INCREMENT, 
            name VARCHAR(255) NOT NULL DEFAULT 'No_Name', 
            image TEXT
            )";
        mysqli_query($link, $body_style);
    } catch (Throwable $th) {
        console_log($th);
    }

    try {
        $options = "CREATE TABLE IF NOT EXISTS options ( 
            id INT NOT NULL PRIMARY KEY AUTO_INCREMENT, 
            name VARCHAR(255) NOT NULL DEFAULT 'No_Name'
            )";
        mysqli_query($link, $options);
    } catch (Throwable $th) {
        console_log($th);
    }

    try {
        $car_options = "CREATE TABLE IF NOT EXISTS car_options ( 
            id INT NOT NULL PRIMARY KEY AUTO_INCREMENT, 
            car_id INT NOT NULL DEFAULT 0, 
            option_id INT NOT NULL DEFAULT 0
            )";
        mysqli_query($link, $car_options);
    } catch (Throwable $th) {
        console_log($th);
    }

    try {
        $car_model = "CREATE TABLE IF NOT EXISTS car_model ( 
            id INT NOT NULL PRIMARY KEY AUTO_INCREMENT, 
            name VARCHAR(255) NOT NULL DEFAULT 'No_Name', 
            image TEXT 
            )";
        mysqli_query($link, $car_model);
    } catch (Throwable $th) {
        console_log($th);
    }

    try {
        $user_inquary = "CREATE TABLE IF NOT EXISTS user_inquary ( 
            id INT NOT NULL PRIMARY KEY AUTO_INCREMENT, 
            car_id INT NOT NULL DEFAULT 0, 
            username VARCHAR(100) NOT NULL DEFAULT 'No_Name', 
            email VARCHAR(150) NOT NULL DEFAULT 'No_data', 
            mobile VARCHAR(20) NOT NULL DEFAULT 'No_data', 
            nearest_port VARCHAR(150) NOT NULL DEFAULT 'No_data',
            message TEXT
            )";
        mysqli_query($link, $user_inquary);
    } catch (Throwable $th) {
        console_log($th);
        
    }

    try {
        $cars = "CREATE TABLE IF NOT EXISTS cars ( 
            id INT NOT NULL PRIMARY KEY AUTO_INCREMENT, 
            maker_id INT NOT NULL DEFAULT 1, 
            model_id INT NOT NULL DEFAULT 1, 
            interior_color_id INT NOT NULL DEFAULT 1, 
            exterior_color_id INT NOT NULL DEFAULT 1, 
            current_action_id INT NOT NULL DEFAULT 1, 
            body_style_id INT NOT NULL DEFAULT 1, 
            passengers INT(1) NOT NULL DEFAULT 0, 
            doors INT(1) NOT NULL DEFAULT 0, 
            name VARCHAR(100) NOT NULL DEFAULT '--', 
            grade VARCHAR(50) NOT NULL DEFAULT '--', 
            power VARCHAR(20) NOT NULL DEFAULT '--', 
            model_year VARCHAR(10) NOT NULL DEFAULT '--', 
            evaluation VARCHAR(100) NOT NULL DEFAULT '--', 
            running VARCHAR(20) NOT NULL DEFAULT '--', 
            cooling VARCHAR(10) NOT NULL DEFAULT '--', 
            note TEXT , 
            fuel VARCHAR(10) NOT NULL DEFAULT '--', 
            chassis VARCHAR(150) NOT NULL DEFAULT '--', 
            dimensions_L VARCHAR(10) NOT NULL DEFAULT '--', 
            dimensions_W VARCHAR(10) NOT NULL DEFAULT '--', 
            dimensions_H VARCHAR(10) NOT NULL DEFAULT '--', 
            transmission_shift VARCHAR(10) NOT NULL DEFAULT '--', 
            is_used INT(1) NOT NULL DEFAULT 0, 
            is_two_weel INT(1) NOT NULL DEFAULT 0, 
            is_steering_right INT(1) NOT NULL DEFAULT 0, 
            is_public INT(1) NOT NULL DEFAULT 0 
            )";
        mysqli_query($link, $cars);
    } catch (Throwable $th) {
        console_log($th);
    }

    try {
        $soled_cars = "CREATE TABLE IF NOT EXISTS soled_cars ( 
            id INT NOT NULL PRIMARY KEY AUTO_INCREMENT, 
            maker_id INT NOT NULL DEFAULT 1, 
            model_id INT NOT NULL DEFAULT 1, 
            interior_color_id INT NOT NULL DEFAULT 1, 
            exterior_color_id INT NOT NULL DEFAULT 1, 
            current_action_id INT NOT NULL DEFAULT 1, 
            body_style_id INT NOT NULL DEFAULT 1, 
            passengers INT(1) NOT NULL DEFAULT 0, 
            doors INT(1) NOT NULL DEFAULT 0, 
            name VARCHAR(100) NOT NULL DEFAULT '--', 
            grade VARCHAR(50) NOT NULL DEFAULT '--', 
            power VARCHAR(20) NOT NULL DEFAULT '--', 
            model_year VARCHAR(10) NOT NULL DEFAULT '--', 
            evaluation VARCHAR(100) NOT NULL DEFAULT '--', 
            running VARCHAR(20) NOT NULL DEFAULT '--', 
            cooling VARCHAR(10) NOT NULL DEFAULT '--', 
            note TEXT, 
            fuel VARCHAR(10) NOT NULL DEFAULT '--', 
            chassis VARCHAR(150) NOT NULL DEFAULT '--', 
            dimensions_L VARCHAR(10) NOT NULL DEFAULT '--', 
            dimensions_W VARCHAR(10) NOT NULL DEFAULT '--', 
            dimensions_H VARCHAR(10) NOT NULL DEFAULT '--', 
            transmission_shift VARCHAR(10) NOT NULL DEFAULT '--', 
            is_used INT(1) NOT NULL DEFAULT 0, 
            is_two_weel INT(1) NOT NULL DEFAULT 0, 
            is_steering_right INT(1) NOT NULL DEFAULT 0, 
            is_public INT(1) NOT NULL DEFAULT 0 
            )";
        mysqli_query($link, $soled_cars);
    } catch (Throwable $th) {
        console_log($th);
    }

}

function console_log($val){
    echo $val;
}
?>
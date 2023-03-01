<?php
/* Database credentials. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
 
/* Attempt to connect to MySQL database */
$link = mysqli_connect('localhost', 'root', '', 'japan_web');
// $link = mysqli_connect('sql303.epizy.com', 'epiz_33557197', 'zspoqJEknmtJb', 'epiz_33557197_japan_web');
 
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
        $user_day_submits = "CREATE TABLE IF NOT EXISTS user_day_submits ( 
            id INT NOT NULL PRIMARY KEY AUTO_INCREMENT, 
            user_id INT NOT NULL DEFAULT 0, 
            date VARCHAR(15) NOT NULL DEFAULT 'null', 
            time VARCHAR(7) NOT NULL DEFAULT 'null', 
            sales_name VARCHAR(255) NOT NULL DEFAULT 'null', 
            customer_name VARCHAR(255) DEFAULT 'null', 
            customer_contact VARCHAR(30) DEFAULT 'null', 
            type INT(1) NOT NULL DEFAULT 0,
            note VARCHAR(500) NOT NULL DEFAULT 'null'
            )";
        mysqli_query($link, $user_day_submits);
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
        $contact_us = "CREATE TABLE IF NOT EXISTS contact_us ( 
            id INT NOT NULL PRIMARY KEY AUTO_INCREMENT, 
            username VARCHAR(100) NOT NULL DEFAULT 'No_Name', 
            contact1 VARCHAR(150) NOT NULL DEFAULT 'No_data', 
            contact2 VARCHAR(150) NOT NULL DEFAULT 'No_data',
            status INT(1) NOT NULL DEFAULT 0, 
            message TEXT
            )";
        mysqli_query($link, $contact_us);
    } catch (Throwable $th) {
        console_log($th);
        
    }

    try {
        $customers = "CREATE TABLE IF NOT EXISTS customers ( 
            id INT NOT NULL PRIMARY KEY AUTO_INCREMENT, 
            name VARCHAR(250) NOT NULL DEFAULT 'No_Name', 
            address VARCHAR(250) NOT NULL DEFAULT 'No_data', 
            contact_num1 VARCHAR(20) NOT NULL DEFAULT 'No_data',
            contact_num2 VARCHAR(20) NOT NULL DEFAULT 'No_data',
            bday VARCHAR(15) NOT NULL DEFAULT 'No_data'
            )";
        mysqli_query($link, $customers);
    } catch (Throwable $th) {
        console_log($th);
        
    }

    try {
        $car_additinal = "CREATE TABLE IF NOT EXISTS car_additinal ( 
            car_id INT NOT NULL PRIMARY KEY, 
            supplier VARCHAR(100) NOT NULL DEFAULT 'No_Name', 
            perfecture VARCHAR(150) NOT NULL DEFAULT 'No_data', 
            bank VARCHAR(30) NOT NULL DEFAULT 'No_data'
            )";
        mysqli_query($link, $car_additinal);
    } catch (Throwable $th) {
        console_log($th);
        
    }

    try {
        $car_deductions = "CREATE TABLE IF NOT EXISTS car_deductions ( 
            car_id INT NOT NULL PRIMARY KEY, 
            rtax VARCHAR(20) NOT NULL DEFAULT '0', 
            atax VARCHAR(20) NOT NULL DEFAULT '0', 
            au_cha VARCHAR(20) NOT NULL DEFAULT '0', 
            trasport VARCHAR(20) NOT NULL DEFAULT '0', 
            storage VARCHAR(20) NOT NULL DEFAULT '0', 
            insurance VARCHAR(20) NOT NULL DEFAULT '0', 
            repair VARCHAR(20) NOT NULL DEFAULT '0', 
            other VARCHAR(20) NOT NULL DEFAULT '0'
            )";
        mysqli_query($link, $car_deductions);
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
            inquary_id INT NOT NULL DEFAULT 0, 
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

    

    try {
        $user_inquary_add_status = "ALTER TABLE `user_inquary` ADD `status` int(1) NOT NULL default '0'";
        mysqli_query($link, $user_inquary_add_status);
    } catch (Throwable $th) {
        console_log($th);
    }

    try { // 1: selling, 0:buying
        $user_inquary_add_type = "ALTER TABLE `user_inquary` ADD `type` int(1) NOT NULL default '0'";
        mysqli_query($link, $user_inquary_add_type);
    } catch (Throwable $th) {
        console_log($th);
    }

    try {
        $car_deductions_add_with_tax = "ALTER TABLE `car_deductions` ADD `with_tax` int(20) NOT NULL default '0'";
        mysqli_query($link, $car_deductions_add_with_tax);
    } catch (Throwable $th) {
        console_log($th);
    }

    try {
        $car_deductions_add_recycle = "ALTER TABLE `car_deductions` ADD `recycle` int(20) NOT NULL default '0'";
        mysqli_query($link, $car_deductions_add_recycle);
    } catch (Throwable $th) {
        console_log($th);
    }

    try {
        $cars_add_interior_color = "ALTER TABLE `cars` ADD `interior_color` VARCHAR(150) NOT NULL default '0'";
        mysqli_query($link, $cars_add_interior_color);
    } catch (Throwable $th) {
        console_log($th);
    }

    try {
        $cars_add_exterior_color = "ALTER TABLE `cars` ADD `exterior_color` VARCHAR(150) NOT NULL default '0'";
        mysqli_query($link, $cars_add_exterior_color);
    } catch (Throwable $th) {
        console_log($th);
    }

    try { // 1: selling, 0:buying
        $user_inquary_add_status = "ALTER TABLE `soled_cars` ADD `date` VARCHAR(12) NOT NULL default CURDATE()";
        mysqli_query($link, $user_inquary_add_status);
    } catch (Throwable $th) {
        console_log($th);
    }

    try {
        $cars_add_interior_color = "ALTER TABLE `soled_cars` ADD `interior_color` VARCHAR(150) NOT NULL default '0'";
        mysqli_query($link, $cars_add_interior_color);
    } catch (Throwable $th) {
        console_log($th);
    }

    try {
        $cars_add_exterior_color = "ALTER TABLE `soled_cars` ADD `exterior_color` VARCHAR(150) NOT NULL default '0'";
        mysqli_query($link, $cars_add_exterior_color);
    } catch (Throwable $th) {
        console_log($th);
    }

    try {
        $customers_add_valid = "ALTER TABLE `customers` ADD `valid` VARCHAR(10) NOT NULL default '0'";
        mysqli_query($link, $customers_add_valid);
    } catch (Throwable $th) {
        console_log($th);
    }

    try {
        $customers_add_last_send_date = "ALTER TABLE `customers` ADD `last_send_date` VARCHAR(12) NOT NULL default '0'";
        mysqli_query($link, $customers_add_last_send_date);
    } catch (Throwable $th) {
        console_log($th);
    }

    try {
        $customers_add_last_send_date = "ALTER TABLE `customers` ADD `chassis` VARCHAR(150) NOT NULL default '0'";
        mysqli_query($link, $customers_add_last_send_date);
    } catch (Throwable $th) {
        console_log($th);
    }

}

function console_log($val){
    // echo $val;
}
?>
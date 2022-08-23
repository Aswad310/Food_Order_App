<?php

    // Start Session 
    session_start();
    // Site URL
    define('SITEURL', 'http://localhost/food-order/');

    // create constants to store non-repeating values

    define('LOCALHOST', 'localhost');
    define('DB_USERNAME', 'root');
    define('DB_PASSWORD', '');
    define('DB_NAME', 'food-order');
    
    $conn= mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die('error'.mysqli_error($conn)); //Database Connection
    $db_select= mysqli_select_db($conn, DB_NAME) or die('error'.mysqli_error($conn)); //Select Database
?>
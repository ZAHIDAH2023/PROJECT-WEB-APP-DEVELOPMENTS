<?php 

    //Start Session
    session_start();


    //Create constant to store non repeting values
    define('SITEURL','http://localhost/pj%20web%20design/');
    define('LOCALHOST', 'localhost');
    define ('DB_USERNAME', 'root');
    define('DB_PASSWORD', '');
    define('DB_NAME', 'project');

    $conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error());// Database Connection 
    $db_select = mysqli_select_db($conn, DB_NAME) or die(mysqli_error());// Selecting Database



?>
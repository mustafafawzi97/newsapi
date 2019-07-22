<?php
header("Access-Control-Allow-Origin: http://localhost:4200");
header("Access-Control-Max-Age: 1000");
header("Access-Control-Allow-Headers: X-Requested-With, Content-Type, Origin, Authorization, Accept, Client-Security-Token, Accept-Encoding");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS, DELETE, PUT");

// db credentials
$servername = "localhost";
$username = "root";
$password = "";
$database = "news";
$ERROR_MSG = ['error' => 'Connected failed'];

// Create connection
$con = new mysqli($servername, $username, $password, $database);

// Check connection
if ($con->connect_error) {
    echo json_encode($ERROR_MSG);
    die("Connection failed: " . $con->connect_error);
}


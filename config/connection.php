<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: PUT, GET, POST, DELETE");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
header('Content-Type: application/json');
$servername = "localhost";
$username = "root";
$password = "";
$database = "news";
$ERROR_MSG = [ 'error' => 'Connected failed'];

// Create connection
$con = new mysqli($servername, $username, $password, $database);

// Check connection
if ($con->connect_error) {
    echo json_encode( $ERROR_MSG );
    die("Connection failed: " . $con->connect_error);
}

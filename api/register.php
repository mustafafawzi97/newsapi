<?php
require '../config/connection.php';

$operation = [];

if (isset($_POST['fullname']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['is_admin'])) {
    // EXTRACT DATA

    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $is_admin = $_POST['is_admin'];

    // INSERT DATA.
    $sql = "INSERT INTO login(`fullname`, `email`, `password`, `is_admin`) VALUES ('{$fullname}','{$email}','{$password}','{$is_admin}')";

    if (mysqli_query($con, $sql)) {
        $operation['register'] = "successful";
        echo json_encode($operation);
        return http_response_code(201);
    } else {
        $operation['register'] = "failed";
        echo json_encode($operation);
        return http_response_code(422);
    }
} else {
    $ERROR = ['Error' => 'BAD REQUEST!'];
    echo json_encode($ERROR);
    return http_response_code(400);
}

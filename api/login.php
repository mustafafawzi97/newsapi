<?php
require '../config/connection.php';

$user_exist = [];
if (isset($_POST['email']) && isset($_POST['password'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    if (!empty($email) && !empty($password)) {
        $sql = "SELECT fullname, email, is_admin FROM login WHERE email = {$email} and password = {$password}";

        if ($result = mysqli_query($con, $sql)) {
            $row = mysqli_fetch_assoc($result);
            $user_exist['exist'] = true;
            $user_exist['fullname'] = $row['fullname'];
            $user_exist['email'] = $row['email'];
            $user_exist['is_admin'] = $row['is_admin'];
            echo json_encode($user_exist);
            return http_response_code(201);
        } else {
            $user_exist['exist'] = false;
            echo json_encode($user_exist);
            return http_response_code(404);
        }
    } else {
        $user_exist['exist'] = false;
        echo json_encode($user_exist);
        return http_response_code(404);
    }
} else {
    $ERROR = ['Error' => 'BAD REQUEST!'];
    echo json_encode($ERROR);
    return http_response_code(400);
}

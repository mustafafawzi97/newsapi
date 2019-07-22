<?php
require '../config/connection.php';

// Get the posted data.
$postdata = file_get_contents("php://input");

if (isset($postdata) && !empty($postdata)) {
    // Extract the data.
    $request = json_decode($postdata);

    // Validate.
    if (trim($request->data->fullname) == '' || trim($request->data->email) == ''
        || trim($request->data->password) == '' || trim($request->data->is_admin) == '') {
        return http_response_code(400);
    }

    // Sanitize.
    $fullname = mysqli_real_escape_string($con, trim($request->data->fullname));
    $email = mysqli_real_escape_string($con, trim($request->data->email));
    $password = mysqli_real_escape_string($con, trim($request->data->password));
    $is_admin = mysqli_real_escape_string($con, trim($request->data->is_admin));
    $sql = "INSERT INTO login(fullname, email, password, is_admin) VALUES ('$fullname', '$email', '$password', '$is_admin')";

    if (mysqli_query($con, $sql)) {
        http_response_code(201);
        $user = [
            'register' => true
        ];
        echo json_encode($user);
    } else {
        http_response_code(422);
    }
}

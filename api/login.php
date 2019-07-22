<?php
require '../config/connection.php';

// Get the posted data.
$postdata = file_get_contents("php://input");

if (isset($postdata) && !empty($postdata)) {
    // Extract the data.
    $request = json_decode($postdata);

    // Validate.
    if (trim($request->data->email) == '' || trim($request->data->password) == '') {
        return http_response_code(400);
    }

    // Sanitize.
    $email = mysqli_real_escape_string($con, trim($request->data->email));
    $password = mysqli_real_escape_string($con, trim($request->data->password));
    $sql = "SELECT id FROM login WHERE email = '$email' and password = '$password'";
    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
    $count = mysqli_num_rows($result);

    if ($count == 1) {
        http_response_code(201);
        $user = [
            'exist' => true
        ];
        echo json_encode($user);
    } else {
        http_response_code(422);
    }
}

<?php
require '../../config/connection.php';

// Get the posted data.
$postdata = file_get_contents("php://input");

if (isset($postdata) && !empty($postdata)) {

    // Extract the data.
    $request = json_decode($postdata);

    // Validate.
    if (trim($request->data->id) == '') {
        return http_response_code(400);
    }

    // Sanitize.
    $id =  mysqli_real_escape_string($con, trim($request->data->id));


    // INSERT DATA.
    $sql = "DELETE FROM notify WHERE id ='$id'";

    if (mysqli_query($con, $sql)) {
        http_response_code(201);
        $user = [
            'delete' => true
        ];
        echo json_encode($user);
    } else {
        http_response_code(422);
    }
}

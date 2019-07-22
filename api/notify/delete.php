<?php
require '../../config/connection.php';

$operation = [];

if (isset($_POST['id'])) {

    // EXTRACT DATA
    $id = $_POST['id'];

    // INSERT DATA.
    $sql = "DELETE FROM  notify WHERE 'id' = '${id}'";

    if (mysqli_query($con, $sql)) {
        $operation['delete'] = "successful";
        echo json_encode($operation);
        return http_response_code(201);
    } else {
        echo mysqli_errno($con);
        $operation['delete'] = "failed";
        echo json_encode($operation);
        return http_response_code(422);
    }
} else {
    $ERROR = ['Error' => 'BAD REQUEST!'];
    echo json_encode($ERROR);
    return http_response_code(400);
}


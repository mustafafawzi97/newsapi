<?php
require '../../config/connection.php';

// Get the posted data.
$postdata = file_get_contents("php://input");

if (isset($postdata) && !empty($postdata)) {

    // Extract the data.
    $request = json_decode($postdata);

    // Validate.
    if (trim($request->data->id) == '' ||
        trim($request->data->title) == '' ||
        trim($request->data->content) == '' ||
        trim($request->data->date) == '') {
        return http_response_code(400);
    }

    // Sanitize.
    $id =  mysqli_real_escape_string($con, trim($request->data->id));
    $title = mysqli_real_escape_string($con, trim($request->data->title));
    $content = mysqli_real_escape_string($con, trim($request->data->content));
    $date = mysqli_real_escape_string($con, trim($request->data->date));
    $image = mysqli_real_escape_string($con, trim($request->data->image));


    // INSERT DATA.
    $sql = "UPDATE articles set title='$title', content='$content', date='$date', image='$image' WHERE id ='$id'";

    if (mysqli_query($con, $sql)) {
        http_response_code(201);
        $user = [
            'update' => true
        ];
        echo json_encode($user);
    } else {
        http_response_code(422);
    }
}

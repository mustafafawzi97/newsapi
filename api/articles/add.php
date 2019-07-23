<?php
require '../../config/connection.php';

// Get the posted data.
$postdata = file_get_contents("php://input");

if (isset($postdata) && !empty($postdata)) {

    // Extract the data.
    $request = json_decode($postdata);

    // Validate.
    if (trim($request->data->title) == '' || trim($request->data->content) == '' ||
        trim($request->data->date) == '') {
        return http_response_code(400);
    }

    // Sanitize.
    $title = mysqli_real_escape_string($con, trim($request->data->title));
    $content = mysqli_real_escape_string($con, trim($request->data->content));
    $date = mysqli_real_escape_string($con, trim($request->data->date));
    $image = mysqli_real_escape_string($con, trim($request->data->image));


    // INSERT DATA.
    $sql = "INSERT INTO articles(title, content, date, image) VALUES ('$title', '$content' ,'$date', '$image')";

    if (mysqli_query($con, $sql)) {
        http_response_code(201);
        $user = [
            'add' => true
        ];
        echo json_encode($user);
    } else {
        http_response_code(422);
    }
}

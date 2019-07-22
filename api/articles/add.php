<?php
require '../../config/connection.php';

$operation = [];

if (isset($_POST['title']) && isset($_POST['content']) && isset($_POST['date'])) {

    // EXTRACT DATA
    $title = $_POST['title'];
    $content = $_POST['content'];
    $date = $_POST['date'];
    $imgname = $_FILES["image"]["name"];
    $image = file_get_contents($_FILES['image']['tmp_name']);

    // INSERT DATA.
    $sql = "INSERT INTO articles(`title`, `content`, `date`, `image`, `imgname`) VALUES ('{$title}','{$content}','{$date}', '${image}', '${$imgname}')";

    if (mysqli_query($con, $sql)) {
        $operation['add'] = "successful";
        echo json_encode($operation);
        return http_response_code(201);
    } else {
        $operation['add'] = "failed";
        echo json_encode($operation);
        return http_response_code(422);
    }
} else {
    $ERROR = ['Error' => 'BAD REQUEST!'];
    echo json_encode($ERROR);
    return http_response_code(400);
}


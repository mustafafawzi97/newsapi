<?php
require '../../config/connection.php';

$operation = [];

if (isset($_POST['id']) && isset($_POST['title']) && isset($_POST['content']) && isset($_POST['date'])) {

    // EXTRACT DATA
    $id = $_POST['id'];
    $title = $_POST['title'];
    $content = $_POST['content'];
    $date = $_POST['date'];
    $imgname = $_FILES["image"]["name"];
    $image = file_get_contents($_FILES['image']['tmp_name']);

    // INSERT DATA.
    $sql = "UPDATE articles set 'title' = '${title}', 'content' = '${content}', 'date' = '${date}', 'image'='{$image}', 'imgname'='{$imgname}' WHERE 'id' = '${id}'";

    if (mysqli_query($con, $sql)) {
        $operation['update'] = "successful";
        echo json_encode($operation);
        return http_response_code(201);
    } else {
        echo mysqli_errno($con);
        $operation['update'] = "failed";
        echo json_encode($operation);
        return http_response_code(422);
    }
} else {
    $ERROR = ['Error' => 'BAD REQUEST!'];
    echo json_encode($ERROR);
    return http_response_code(400);
}

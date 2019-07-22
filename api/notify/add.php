<?php
require '../../config/connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $operation = [];

    if (isset($_POST['title']) && isset($_POST['content']) && isset($_POST['date'])) {

        // EXTRACT DATA
        $title = $_POST['title'];
        $content = $_POST['content'];
        $date = $_POST['date'];

        // INSERT DATA.
        $sql = "INSERT INTO notify(`title`, `content`, `date`) VALUES ('{$title}','{$content}','{$date}')";

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
} else {
    $ERROR = ['Error' => 'you are not allowed to access to this api'];
    echo json_encode($ERROR);
    return http_response_code(401);
}

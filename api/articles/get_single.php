<?php
require '../../config/connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $article = [];
    $id = $_GET['id'];
    $sql = "SELECT * FROM articles WHERE 'id' = '${id}'";

    if ($result = mysqli_query($con, $sql)) {
        $row = mysqli_fetch_assoc($result);
            $article['id'] = $row['id'];
            $article['title'] = $row['title'];
            $article['content'] = $row['content'];
            $article['date'] = $row['date'];
        echo json_encode($article);
        return http_response_code(201);
    } else {
        $user_exist['article'] = "no article available";
        echo json_encode($user_exist);
        return http_response_code(404);
    }

} else {
    $ERROR = ['Error' => 'you are not allowed to access to this api'];
    echo json_encode($ERROR);
    return http_response_code(401);
}


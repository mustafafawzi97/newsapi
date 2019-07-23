<?php
require '../../config/connection.php';

if (isset($_GET['id'])) {
    $article = [];
    $id = $_GET['id'];
    $sql = "SELECT * FROM articles WHERE 'id' = '${id}'";

    if ($result = mysqli_query($con, $sql)) {
        $row = mysqli_fetch_assoc($result);
        $article['id'] = $row['id'];
        $article['title'] = $row['title'];
        $article['content'] = $row['content'];
        $article['date'] = $row['date'];
        $article['image'] = $row['image'];
        echo json_encode($article);
        http_response_code(201);
    } else {
        http_response_code(422);
    }
}



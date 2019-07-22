<?php
require '../../config/connection.php';

$articles = [];
$sql = "SELECT * FROM articles";

if ($result = mysqli_query($con, $sql)) {
    $i = 0;
    while ($row = mysqli_fetch_assoc($result)) {
        $articles[$i]['id'] = $row['id'];
        $articles[$i]['title'] = $row['title'];
        $articles[$i]['content'] = $row['content'];
        $articles[$i]['date'] = $row['date'];
        $i++;
    }
    echo json_encode($articles);
    return http_response_code(201);
} else {
    $user_exist['articles'] = "no articles available";
    echo json_encode($user_exist);
    return http_response_code(404);
}



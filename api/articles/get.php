<?php
require '../../config/connection.php';

$articles = [];
$sql = "SELECT * FROM articles";

if ($result = mysqli_query($con, $sql)) {
    http_response_code(201);
    $i = 0;
    while ($row = mysqli_fetch_assoc($result)) {
        $articles[$i]['id'] = $row['id'];
        $articles[$i]['title'] = $row['title'];
        $articles[$i]['content'] = $row['content'];
        $articles[$i]['date'] = $row['date'];
        $articles[$i]['image'] = $row['image'];
        $i++;
    }
    echo json_encode($articles);
} else {
    http_response_code(422);
}



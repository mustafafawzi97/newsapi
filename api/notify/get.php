<?php
require '../../config/connection.php';

$notifys = [];
$sql = "SELECT * FROM notify";

if ($result = mysqli_query($con, $sql)) {
    http_response_code(201);
    $i = 0;
    while ($row = mysqli_fetch_assoc($result)) {
        $notifys[$i]['id'] = $row['id'];
        $notifys[$i]['title'] = $row['title'];
        $notifys[$i]['content'] = $row['content'];
        $notifys[$i]['date'] = $row['date'];
        $i++;
    }
    echo json_encode($notifys);
} else {
    http_response_code(422);
}



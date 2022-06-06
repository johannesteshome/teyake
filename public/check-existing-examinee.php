<?php

include_once "../shared/includes/database.php";
$payload = json_decode(file_get_contents('php://input'), true);

$retrieve_examinee_query = "SELECT * FROM examinee WHERE ExamKey = '".$payload["examKey"]."' AND Email = '".$payload["email"]."'";
$retrieve_examinee_row = mysqli_query($conn, $retrieve_examinee_query);
echo json_encode(mysqli_num_rows($retrieve_examinee_row));


?>
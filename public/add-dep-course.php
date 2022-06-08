<?php

    include_once "../shared/includes/database.php";

    $payload = json_decode(file_get_contents('php://input'), true);

    
    if(isset($payload["addDep"]) && $payload["addDep"]){
        $department = $payload["dep"];
        $insert_exam_query = $conn->prepare('INSERT INTO requests (type, input) VALUES (\'D\',?)');
        $insert_exam_query->bind_param("s", $department);
        $insert_exam_query->execute();
        echo json_encode(true);
    }
    if(isset($payload["addCourse"]) && $payload["addCourse"]){
        $department = $payload["course"];
        $insert_exam_query = $conn->prepare('INSERT INTO requests (type, input) VALUES (\'C\',?)');
        $insert_exam_query->bind_param("s", $department);
        $insert_exam_query->execute();
        echo json_encode(true);
    }
    echo json_encode(false)

?>
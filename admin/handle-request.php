<?php

include_once "../shared/includes/database.php";

$payload = json_decode(file_get_contents('php://input'), true);


if(isset($payload["displayInst"]) && $payload["displayInst"]){
    $request_dep = mysqli_query($conn, "SELECT input FROM requests WHERE type='I'");

    if(mysqli_num_rows($request_dep)>0){
        echo json_encode($row = mysqli_fetch_all($request_dep));
    }
    else echo json_encode(array("status"=>"false"));

}
if(isset($payload["displayDep"]) && $payload["displayDep"]){
    $request_dep = mysqli_query($conn, "SELECT input FROM requests WHERE type='D'");

    if(mysqli_num_rows($request_dep)>0){
        echo json_encode($row = mysqli_fetch_all($request_dep));
    }
    else echo json_encode(array("status"=>false));

}
if(isset($payload["displayCourse"]) && $payload["displayCourse"]){
    $request_dep = mysqli_query($conn, "SELECT input FROM requests WHERE type='C'");
    
    if(mysqli_num_rows($request_dep)>0){
        echo json_encode($row = mysqli_fetch_all($request_dep));
    }
    else echo json_encode(array("status"=>false));
    

}
if(isset($payload["approve"]) && $payload["approve"]){
    $table = '';
    switch($payload['type']){
        case 'I';
        $table = 'institution';
        break;
        case 'C';
        $table = 'course';
        break;
        case 'D';
        $table = 'department';
        break;
    }

    $response = mysqli_query($conn, "DELETE FROM requests WHERE type='".$payload['type']."' AND input='".$payload['data']."'");
    $input = $payload["data"];
    $insert_exam_query = $conn->prepare('INSERT INTO '.$table.' (Name) VALUES (?)');
    $insert_exam_query->bind_param("s", $input);
    $insert_exam_query->execute();
    echo json_encode(true);

}
if(isset($payload["drop"]) && $payload["drop"]){
    $response = mysqli_query($conn, "DELETE FROM requests WHERE type='".$payload['type']."' AND input='".$payload['data']."'");
    echo json_encode(true);
}


// ?>
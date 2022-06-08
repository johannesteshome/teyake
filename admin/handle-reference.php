<?php

include_once "../shared/includes/database.php";

$payload = json_decode(file_get_contents('php://input'), true);


if(isset($payload["displayInst"]) && $payload["displayInst"]){
    $request_dep = mysqli_query($conn, "SELECT Name FROM institution");

    if(mysqli_num_rows($request_dep)>0){
        echo json_encode($row = mysqli_fetch_all($request_dep));
    }
    else echo json_encode(array("status"=>"false"));

}
if(isset($payload["displayDep"]) && $payload["displayDep"]){
    $request_dep = mysqli_query($conn, "SELECT Name FROM department");

    if(mysqli_num_rows($request_dep)>0){
        echo json_encode($row = mysqli_fetch_all($request_dep));
    }
    else echo json_encode(array("status"=>false));

}
if(isset($payload["displayCourse"]) && $payload["displayCourse"]){
    $request_dep = mysqli_query($conn, "SELECT Name FROM course");
    
    if(mysqli_num_rows($request_dep)>0){
        echo json_encode($row = mysqli_fetch_all($request_dep));
    }
    else echo json_encode(array("status"=>false));
    

}



?>
<?php

    include_once "../shared/includes/database.php";

    $payload = json_decode(file_get_contents('php://input'), true);

    $examiner = "SELECT * FROM examiner WHERE id ='".$payload["userID"]."'";
        $result = mysqli_query($conn, $examiner);
        $row = mysqli_fetch_assoc($result);
        

    if(isset($payload["verifyPass"]) && $payload["verifyPass"]){
        $is_valid = password_verify($payload['pass'], $row["Password"]);
        echo json_encode($is_valid);
    }
    
    if(isset($payload["updatePass"]) && $payload["updatePass"]){
        $pass = password_hash($payload["pass"], PASSWORD_DEFAULT);

        mysqli_query($conn, "UPDATE examiner SET Password = '" . $pass . "' WHERE examiner.ID=\"".$payload["userID"]."\"");
        echo json_encode(true);
    }
    
    
?>
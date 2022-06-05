<?php

    include_once "../shared/includes/database.php";

    $payload = json_decode(file_get_contents('php://input'), true);
   
    if(isset($payload["examKey"])){
        $query_exam_duration = mysqli_query($conn, ("SELECT duration FROM exam WHERE ExamKey=\"".$payload["examKey"]."\""));
    if (mysqli_num_rows($query_exam_duration) > 0) {
            $row = mysqli_fetch_assoc($query_exam_duration);
            $exam_duration = $row["duration"];
      }
      date_default_timezone_set("Africa/Addis_Ababa");
    if (isset($payload['addEntry']) && $payload['addEntry']) {
        $examineeEmail = $payload["email"];
        $examKey = $payload["examKey"];
        $endTime = date("Y-m-d H:i:s", strtotime(+$exam_duration." minutes"));
        $answerList = json_encode([]);
    
        try{
        $insert_examinee_query = $conn->prepare('INSERT INTO inprogressexams (Email, ExamKey,AnswerList, EndTime) VALUES (?,?,?,?)');
        $insert_examinee_query->bind_param("ssss",$examineeEmail ,$examKey ,$answerList, $endTime);
        $insert_examinee_query->execute();
            echo json_encode(["id"=>$insert_examinee_query->insert_id]);
        }catch(\Throwable $err){
            echo $err;
        }
        exit;
    }
}else if(!isset($payload['trackProgress'])){

    try{
        $id = 0;
        $select_inprogress_id = mysqli_query($conn,"SELECT id FROM `inprogressexams` WHERE Email='".$payload["email"]."'");
        if ($select_inprogress_id) {
            $row = mysqli_fetch_assoc($select_inprogress_id);
            $id = $row["id"];
          } 
        echo json_encode(["id"=>$id]);
    }catch(\Throwable $err){
        echo $err;
    }
    exit;
}
if (isset($payload['trackProgress']) && $payload['trackProgress']) {
    $answerList = $payload['answers'];
    $ansList = json_encode($answerList);
    $updateProgressQuery = $conn->prepare('UPDATE inprogressexams SET AnswerList = ? WHERE id = ' . $payload['examId']);
    $updateProgressQuery->bind_param('s', $ansList); 
    $updateProgressQuery->execute();
    exit;
}
?>
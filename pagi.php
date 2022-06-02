<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="public/css/style-reset.css">
    <link rel="stylesheet" href="public/css/dashboard.css">
    <link rel="stylesheet" href="pagi.css">

    <title>Document</title>
</head>

<body>
    <div class="pagination">
        <div class="tableList" id="listingTable">

        </div>


        <div class="pagination-block">
            <span class="pageButton outline-none" id="button_prev">Prev</span>
            <span id="page_number" class="outline-none"></span>
            <span class="pageButton outline-none" id="button_next">Next</span>
        </div>

        <div class="exam-bank-table">
            <?php 

                $_SESSION["id"] = 1;
                include_once "shared/includes/database.php";
                include_once "shared/core.php";

                $examList = [];

                $exam_select_row = mysqli_query($conn, "SELECT * FROM `exam` WHERE `ExaminerID`='".$_SESSION['id']."'" );
                // 
                while($row = mysqli_fetch_assoc($exam_select_row)){
                    // echo "<pre>";
                    //     var_dump($row);
                    // echo "</pre>";

                    $exam = new Exam();

                    $exam->name = $row["Name"];
                    $exam->teacherID = $row["ExaminerID"];
                    $exam->key = $row["ExamKey"];
                    $exam->date = $row["Date"];
                    $exam->status = $row["Status"];
                    $exam->duration = $row["Duration"];
                    
                    $question_row = mysqli_query($conn, "SELECT * FROM `question` WHERE `ExamKey`='".$row['ExamKey']."'" );
                    if($q_row = mysqli_fetch_assoc($question_row)){
                        $exam->questions = json_decode($q_row["QuestionList"]);
                    }
                    
                    $answer_row = mysqli_query($conn, "SELECT * FROM `answer` WHERE `ExamKey`='".$row['ExamKey']."'" );
                    if($a_row = mysqli_fetch_assoc($answer_row)){
                        $ans = json_decode($a_row["AnswerList"]);

                    }
                    // var_dump($ans);
                    
                    for ($i=0; $i < count($exam->questions) ; $i++) { 
                        array_push($exam->questions[$i], $ans[$i]);
                    }
                    array_push($examList, $exam);
                }
                
                        // var_dump($examList);
                        $examList = json_encode($examList);
                    // var_dump($examList);
                    // echo "<br>";
                    // echo "<br>";
                    // $examListEnc = str_replace( "\\", "", $examListEnc );
                    // $examListEnc = str_replace( "\"", "\\\"", $examListEnc );
                    // echo "<br>";
                    // var_dump($examListEnc);


                    echo "<p class=\"hidden\" id=\"all-exams\">".$examList."</p>"
            ?>
        </div>
        <script src="test.js"></script>
</body>

</html>
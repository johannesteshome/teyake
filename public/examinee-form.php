<?php
include_once "../shared/includes/database.php";


if(!isset($_GET["exam-key"])){
  header('Location: ../index.php');
}

$exam_key = $_GET["exam-key"];

$dummy_key = $exam_key;

$retrieve_exam_query = "SELECT * FROM exam WHERE ExamKey = " . $exam_key;
$retrieve_exam_row = mysqli_query($conn, $retrieve_exam_query);
if (!mysqli_num_rows($retrieve_exam_row)) {
  header('Location: ../index.php?exam=none');
}



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/takeexam.css">
</head>

<body>
    <div class="container">
        <div class="modal">
            <div class="modal-content">
                <h1 style="text-align: center">Enter Exam</h1>
                <form action="/teyake/takeexam/takeexam.php" method="POST" class="flex flex-col gap-4">
                    <input type="text" placeholder="Name" id="student-name" name="examineeName" required />
                    <input type="email" placeholder="Email" id="student-email" name="examineeEmail" required />
                    <input type="text" placeholder="ID" id="student-id" name="examineeID" required />
                    <input type="text" placeholder="Key" id="exam-key" name="examKey" value="<?php echo $dummy_key ?>"
                        disabled />
                    <input type="hidden" placeholder="Key" id="exam-key" name="examKey"
                        value="<?php echo $exam_key ?>" />
                    <button type="submit" id="enter-exam">Enter</button>
                </form>
                <p id="errorMsg"></p>
            </div>
        </div>
    </div>
    <script src="js/examinee-form.js" type="module"></script>
</body>

</html>
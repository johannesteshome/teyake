<?php
include_once "../shared/includes/database.php";


if(!isset($_GET["exam-key"])){
  header('Location: ../index.php');
}

$exam_key = $_GET["exam-key"];

$dummy_key = $exam_key;

$retrieve_exam_query = "SELECT * FROM exam WHERE ExamKey = '".$exam_key."' AND Status = 'open'";
$retrieve_exam_row = mysqli_query($conn, $retrieve_exam_query);
if (!mysqli_num_rows($retrieve_exam_row)) {
  header('Location: ../index.php?exam=none');
}

$retrieve_institution_query = "SELECT Name, ID FROM institution";
$retrieve_institution_result = mysqli_query($conn, $retrieve_institution_query);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="css/style-reset.css">
    <link rel="stylesheet" href="css/takeexam.css">
    <link rel="stylesheet" href="css/examinee-form.css">
</head>

<body>
    <div class="container">
        <div class="modal">
            <div class="modal-content">
                <h1 style="text-align: center">Enter Exam</h1>
                <form action="takeexam.php?new-exam=true" method="POST" class="flex flex-col gap-4 examinee-form">
                    <input type="text" placeholder="Name" id="student-name" name="examineeName" required />
                    <input type="email" placeholder="Email" id="student-email" name="examineeEmail" required />
                    <input type="text" placeholder="ID" id="student-id" name="examineeID" required />
                    <select name="sex" id="sex">
                        <option value="" disabled selected>Gender</option>
                        <option value="M">Male</option>
                        <option value="F">Female</option>
                    </select>
                    <select name="institution" id="institution">
                        <option value="" disabled selected>Institution</option>
                        <?php 
              while($row = mysqli_fetch_assoc($retrieve_institution_result)){
                echo "<option value=\"".$row["ID"]."\">".$row["Name"]."</option>";
              }
              ?>
                        <!-- <option value="none">Not Listed</option> -->
                    </select>
                    <input type="text" placeholder="Section" id="student-section" name="examineeSection"
                        maxlength="1" />
                    <input type="text" placeholder="Key" id="key" value="<?php echo $dummy_key ?>" disabled />
                    <input type="hidden" placeholder="Key" id="exam-key" name="examKey"
                        value="<?php echo $exam_key ?>" />
                    <button type="submit" id="enter-exam">Enter</button>
                </form>
                <p id="errorMsg"></p>
                <p id="in-progress-link" style="padding:0.5rem;border:1px solid black;border-radius:0.5rem">Do you have
                    an Exam in progress?
                </p>
            </div>
        </div>
        <div class="in-progress-window hidden">
            <div class="overlay"></div>
            <div class="in-progress-modal">
                <h3 class="text-center">Enter your Email</h3>
                <form action="in-progress.php" method="POST">
                    <input type=" text" name="email" placeholder="Email">
                    <input type="hidden" name="key" value="<?php echo $exam_key ?>">
                    <button type="submit">Go</button>
                </form>
            </div>
        </div>

    </div>
    <script src="js/examinee-form.js" type="module"></script>
</body>

</html>
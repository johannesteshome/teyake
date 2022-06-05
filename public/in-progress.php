<?php
$action = "";
var_dump($_POST);
date_default_timezone_set("Africa/Addis_Ababa");
if(isset($_POST['email']) && $_POST["email"]){
    include_once "../shared/includes/database.php";
    $inProgressExaminee = mysqli_query($conn, ("SELECT * FROM inprogressexams WHERE Email=\"".$_POST['email']."\" AND ExamKey = \"".$_POST['key']."\""));
        if (mysqli_num_rows($inProgressExaminee) > 0) {
                $row = mysqli_fetch_assoc($inProgressExaminee);
                $endTime = strtotime($row["EndTime"]);
                $now = strtotime(date("Y-m-d H:i:s"));
                $remaining = ($endTime - $now) * 1000;
                $answerList = $row["AnswerList"];
            }
            else{
                echo "Query Failed";
            }
            $action = "takeexam.php?inProgress=true&key=".$_POST["key"];
}else{
    header("Location: ../index.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form action='<?php echo $action?>' method="POST">
        <input type="hidden" name="answer-list" value="<?php echo $answerList?>">
        <input type="hidden" name="remaining" value="<?php echo $remaining?>">
        <input type="hidden" name="email" value="<?php echo $_POST['email']?>">
    </form>
</body>
<script>
document.forms[0].submit();
</script>

</html>
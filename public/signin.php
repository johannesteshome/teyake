<?php
session_start();
$error = '';

try {
  $pdo = new PDO("mysql:host=localhost; port=3306;dbname=teyake", "root", "");
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e){
  $error = "Connection Failed".$e->getMessage();
}
$statement = $pdo->prepare('SELECT * FROM examiner');
$statement->execute();
$examiners = $statement->fetchAll(PDO::FETCH_ASSOC);




if($_SERVER["REQUEST_METHOD"]==='POST'){
  $email = $_POST['Email'];
  $password = $_POST['Password'];
 $count = 0;
  foreach($examiners as $i => $examiner){
      if($email == $examiner['Email'] && password_verify($password ,$examiner['Password'])){
        $_SESSION["login"] = "ok";
        $_SESSION["id"] = $examiner["ID"];
        header('Location: dashboard.php');
        $count++;
      }
}
if($count == 0){
  unset($_POST);
  $error =  "Username or Password is INCORRECT.";
}
}

?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Sign up | Teyake</title>
    <link rel="stylesheet" href="css/style-reset.css" />
    <link rel="stylesheet" href="css/signin.css" />
</head>

<body>
    <div class="container text-white">


        <?php include "../shared/includes/header.php" ?>



        <main class="sign-in-page flex items-center justify-center">
            <div class="login-container flex flex-col items-center justify-center">
                <h1>Sign In</h1>
                <form class="text-primary flex flex-col" method="post" action="">
                    <div class="inputs">
                        <label for="uname">
                            <input class="text-field" name="Email" type="text" id="uname" placeholder="Email" />
                        </label>
                        <label for="pass">
                            <input class="text-field" name="Password" type="password" id="pass"
                                placeholder="Password" />
                        </label>
                    </div>
                    <a style="color:white" href="forgot-password.php">Forgot Password?</a>
                    <span id="errorMsg">
                        <php? echo $error; ?>
                    </span>
                    <button type="submit">Sign In</button>
                </form>
            </div>
        </main>
    </div>
</body>
<!-- <script src="signin.js" type="module"></script> -->

</html>
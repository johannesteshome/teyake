<?php 
include_once "../shared/includes/database.php";

if(isset($_POST["password"])){

    $pass = password_hash($_POST["password"], PASSWORD_DEFAULT);

    if(mysqli_query($conn, "UPDATE examiner SET Password = '" . $pass . "' WHERE examiner.email=\"".$_GET['email']."\"")){
        echo "<h1>Successful</h1>";
    }
    else{
        echo "<h1>Unsuccessful</h1>";
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
    <style>
    .login-container {
        overflow: hidden;
        padding: 2rem;
    }
    </style>
</head>

<body>
    <div class="container text-white">
        <?php include "../shared/includes/header.php" ?>
        <main class="sign-in-page flex items-center justify-center">
            <div class="login-container flex flex-col items-center justify-center">
                <form action="" method="post">
                    <label for="password">Password</label>
                    <input type="password" name="password">
                    <input type="password" name="confirm-password">
                    <button type="submit">Submit</button>
                </form>
            </div>
        </main>
    </div>
</body>
<!-- <script src="signin.js" type="module"></script> -->

</html>
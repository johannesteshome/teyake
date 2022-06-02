<?php
include_once '../shared/includes/function.php';

if(isset($_GET['status'])){
    echo "<script>alert(\"Verfication Code Invalid. Please check Again.\");</script>";
}

if(isset($_POST['verify'])){
    //ensure the received code is verified.
    if(password_verify($_POST["verify"], $_POST["key"])){
        if(!isset($_GET['reset'])){
            $pdo = new PDO('mysql:host=localhost;port=3306;dbname=teyake', 'root', '');
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $statement = $pdo->prepare("UPDATE examiner SET verified=\"1\" WHERE Email=\"".$_GET['email']."\"");
            $statement->execute();
            header('Location: signin.php');
        }
        else{
            header('Location: change-password.php?email='.$_GET['email']);
        }
    }else{
        if(isset($_GET['reset'])){
            header('Location: email-verification.php?email='.$_GET['email'].'&status=not-verified&reset=true');
        }
        else{
            header('Location: email-verification.php?email='.$_GET['email'].'&status=not-verified');
            }
    }
}else{
        $verificationKey = randomString(5);
        $email = $_GET['email'];
        //send a mail
        send_mail($email, 'Email Verification', "your code is ".$verificationKey);
        $verificationKey = password_hash($verificationKey, PASSWORD_DEFAULT);
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
                    <label for="verify">Verification Code</label>
                    <input type="text" name="verify" id="verify">
                    <input type="hidden" name="key" id="key" value="<?php echo $verificationKey ?>">
                    <button type="submit">Submit</button>
                </form>
            </div>
        </main>
    </div>
</body>

</html>
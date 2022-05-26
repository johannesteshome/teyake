<?php
include_once '../shared/includes/function.php';

if(isset($_GET['status'])){
    echo "<script>alert(\"Verfication Code Invalid. Please check Again.\");</script>";
}

if(isset($_POST['verify'])){
    //ensure the received code is verified.
    $pdo = new PDO('mysql:host=localhost;port=3306;dbname=teyake', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    if($_POST['verify'] == $_POST['key']){
        $statement = $pdo->prepare("UPDATE examiner SET verified=\"1\" WHERE Email=\"".$_GET['email']."\"");
        $statement->execute();
        header('Location: signin.php');
    }else{

        header('Location: email-verification.php?email='.$_GET['email'].'&status=not-verified');
    }
}else{

    
        $verificationKey = randomString(5);
        $email = $_GET['email'];
        //send a mail
        send_mail($email, 'Email Verification', "your code is ".$verificationKey);



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
    <link rel="stylesheet" href="css/signup.css" />
</head>

<body>
    <div class="container">
        <div class="header">
            <div class="header-left">
                <img src="./media/images/teyake_white_fill.png" class="logo" />
                <nav>
                    <ul class="primary-nav flex">
                        <li class=""><a href="../index.php">Home</a></li>
                        <li class="nav-active"><a href="#">Sign Up</a></li>
                    </ul>
                </nav>
            </div>
            <div class="header-right flex items-center">
                <div class="sign-in flex gap-4">
                    <a href="signin.php"><button type="button">Sign In</button></a>
                    <!-- <button type="button">Sign Up</button> -->
                </div>
                <!-- Exam Key input Section -->
                <div class="flex flex-col items-center gap-2">
                    <form action="#" class="enter-exam-head flex text-center items-center">
                        <div class="enter-exam-input">
                            <input type="text" name="exam-key" id="exam-key" placeholder="Enter Exam Key" />
                            <button type="submit" class="btn enter-exam-btn enter-exam-head-btn">
                                Next
                            </button>
                        </div>
                    </form>
                </div>
                <!-- End of exam key input section -->
            </div>
        </div>
        <main class="sign-up-page flex items-center justify-center">
            <div class="auth-box flex flex-col items-center justify-center">
                <form action="" method="post">
                    <input type="text" name="verify" id="verify" class="auth-input">
                    <input type="hidden" name="key" id="key" value="<?php echo $verificationKey ?>">
                    <button type="submit" class="btn">Verify</button>
                </form>

            </div>
        </main>
    </div>
</body>

</html>
<?php

$pdo = new PDO('mysql:host=localhost;port=3306;dbname=teyake', 'root', '');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


$pass = '';
class Teacher{
  public $fullname;
  public $gender;
  public $password;
  public $phoneNo;
  public $email;
  public $institution;
}

$newTeacher = new Teacher();


if($_SERVER['REQUEST_METHOD'] == 'POST'){
  $newTeacher->fullname = $_POST['fullname'];
  $newTeacher->gender = $_POST['gender'];
  $newTeacher->password = $_POST['pass'];
  $newTeacher->phoneNo = $_POST['phoneNo'];
  $newTeacher->email = $_POST['email'];
  $newTeacher->institution = $_POST['institution'];

 $statement = $pdo->prepare("INSERT INTO examiner(FullName,Email, Password, Sex, PhoneNo) 
 VALUES (:FullName,:Email,:Password, :Sex, :PhoneNo)");
$statement->bindValue(':FullName', $newTeacher->fullname);
$statement->bindValue(':Email', $newTeacher->email);
$statement->bindValue(':Password', password_hash($newTeacher->password, PASSWORD_DEFAULT) );
$statement->bindValue(':Sex', $newTeacher->gender);
$statement->bindValue(':PhoneNo', $newTeacher->phoneNo);

$statement->execute();
header('Location: email-verification.php?email='.$newTeacher->email);
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
                        <li class="nav-active"><a href="signup.php">Sign Up</a></li>
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
                <div class="sign-up-form">
                    <div class="signup-header">
                        <h2>register an account</h2>
                        <div class="progress-container">
                            <div class="progress-step current-progress">
                                <span class="num num-active">1</span>User
                            </div>
                            <div class="progress-step">
                                <span class="num">2</span>Details
                            </div>
                        </div>
                    </div>

                    <form method="post" enctype="multipart/form-data" id="form2">
                        <div class="first-form forms">
                            <div class="form-container">
                                <div>
                                    <label for="fullname">Name: </label>
                                </div>
                                <div>
                                    <input type="text" name="fullname" class="auth-input" id="fullname-input"
                                        placeholder="Input Full Name" value="<?php echo $newTeacher->fullname; ?>"
                                        required />
                                </div>
                                Gender:
                                <div class="gender-container">
                                    <div>
                                        <label for="male">Male</label>
                                        <input type="radio" name="gender" id="male" value="M" />
                                    </div>
                                    <div>
                                        <label for="female">Female</label>
                                        <input type="radio" name="gender" id="female" value="F" />
                                    </div>

                                </div>



                                <div>
                                    <label for="password">Password:</label>
                                </div>
                                <div>
                                    <input type="password" class="auth-input" name="pass" id="password-input"
                                        placeholder="Input Password" value="<?php echo $pass; ?>" />
                                </div>
                                <div>

                                    <label for="comfirm">Comfirm Password:</label>
                                </div>
                                <div>
                                    <input type="password" class="auth-input" id="comfirm-password"
                                        placeholder="Comfirm Entered Password" />
                                </div>
                            </div>
                        </div>
                </div>
                <div class="second-form forms hidden">
                    <div class="form-container">
                        <div>
                            <label for="phone-input">Phone Number: </label>
                        </div>
                        <div>
                            <input type="tel" name="phoneNo" class="auth-input" id="phone-input"
                                placeholder="Input Phone Number" value="<?php echo $newTeacher->phoneNo ?>" required />
                        </div>
                        <div>
                            <label for="email-input">Email: </label>
                        </div>
                        <div>
                            <input type="email" name="email" class="auth-input" id="email-input"
                                placeholder="Input Email Address" value="<?php echo $newTeacher->email ?>" required />
                        </div>
                        <div>
                            <label for="institution" class="flex gap-4 items-center">
                                Institution</label>
                        </div>
                        <div>

                            <input list="institution" name="institution" id="institution-input" class="auth-input">
                            <datalist id="institution">
                                <option value="AASTU">
                                <option value="AAU">
                                <option value="UNLISTED">
                            </datalist>


                        </div>
                    </div>
                </div>
                </form>

                <p id="errorMsg"></p>
                <div>
                    <button class="btn-signup" id="pre-signup" disabled>
                        Previous
                    </button>
                    <button class="btn-signup" id="next-signup">
                        Next
                    </button>
                </div>

            </div>
        </main>
    </div>
</body>
<script src="js/signup.js" type="module"></script>

</html>
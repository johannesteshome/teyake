<?php
    session_start();

    if($_SESSION['login'] != 'ok')
        header('Location: signin.php');


    include "../shared/includes/database.php";

    $rec_examineer_row = mysqli_query($conn, ("SELECT FullName, Email, Password, PhoneNo FROM `examiner` WHERE ID=\"".$_SESSION['id']."\""));

    if (mysqli_num_rows($rec_examineer_row) > 0) {
        $row = mysqli_fetch_assoc($rec_examineer_row);
                $name = $row['FullName'];
                $email = $row['Email'];
                $password = $row['Password'];
                $PhoneNo = $row['PhoneNo'];
        }


    if(isset($_POST['save-profile'])){
        
    }

    ?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <link rel="stylesheet" href="css/style-reset.css">
    <link rel="stylesheet" href="css/my-profile.css" />
    <script src="js/my-profile.js" defer type="module"></script>
</head>

<body>
    <div class="container">
        <div class="box">
            <h2 id="head">My Profile</h2>
            <form action="" method="post" name="save-profile">
                <div class="paded">
                    <div>
                        <label for="name">Name </label>
                        <input type="text" name="name" id="name" class="text" value="<?php echo $name ?>" required />
                    </div>
                    <div>
                        <label for="phone">Phone Number </label>
                        <input type="tel" name="name" id="phone" class="text" value="<?php echo $PhoneNo ?>" required />
                    </div>
                    <div>
                        <div>
                            <label for="email">Email </label>
                            <input type="email" name="email" id="email" class="text" value="<?php echo $email ?>"
                                required placeholder="Email" min="6" max="32" />
                        </div>
                        <div>
                            <label for="institution">Institution </label>
                            <input type="text" name="institution" id="institution" class="text" required />
                        </div>
                        <p id="errorMsg"></p>
                        <button type="button" name="name" id="save-edit-btn" class="btn">Save</button>


                        <div class="password-container">
                            <label for="password">password</label>
                            <input type="button" name="password" id="changepass-btn" class="btn"
                                value="Change password" />
                            <div class="password-changer hidden">
                                <label for="password">Previous Password:</label>
                                <input type="password" class="text" name="pass" id="prev-password-input"
                                    placeholder="Input Previous Password" />
                                <label for="password">Password:</label>
                                <input type="password" class="text" name="pass" id="password-input"
                                    placeholder="Input New Password" />

                                <label for="comfirm">Comfirm Password:</label>
                                <input type="password" class="text" name="comfirm" id="comfirm-password"
                                    placeholder="Comfirm Entered Password" />

                                <p id="PasserrorMsg"></p>
                                <input type="button" name="password" id="save-pass" class="btn" value="Save" />
                            </div>
                        </div>


                        <div>

                        </div>
                    </div>
                </div>

            </form>
</body>

</html>
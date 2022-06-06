<?php

 
        session_start();

        if($_SESSION['login'] != 'ok'){
          header("Location: signin.php");
        }

        $conn= mysqli_connect("localhost","root",'',"teyake");// create a connection to database
        $user_id = $_SESSION['id'];
        $sql_email = "SELECT Email FROM examiner WHERE id =$user_id";
$result = mysqli_query($conn, $sql_email);
$row = mysqli_fetch_assoc($result);
$user_email = $row['Email'];
$user_email_dir = str_replace(".", "_", $user_email);

if(isset($_POST['upload'])){



echo $user_id;

$filename = $_FILES['uploadfile']['name'];
$ext = pathinfo($filename, PATHINFO_EXTENSION);
mkdir('uploads/' . $user_email_dir);
$image_name = $user_email.time().'.'.$ext;
$destination_path = getcwd().DIRECTORY_SEPARATOR;;
$target = $destination_path.'uploads/' . $user_email_dir.'/'.$image_name;



if(move_uploaded_file($_FILES['uploadfile']['tmp_name'], $target)){
    $sql = "UPDATE examiner SET imageURL='$image_name' WHERE id=$user_id";
    mysqli_query($conn, $sql);
    header("Location: dashboard.php");
}

}
      

$user_id = $_SESSION['id'];

$sql_email = "SELECT * FROM examiner WHERE id =$user_id";
$result = mysqli_query($conn, $sql_email);
$row = mysqli_fetch_assoc($result);
$image_url = $row['ImageURL'];


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>My Profile</title>
    <link rel="stylesheet" href="css/style-reset.css">
    <link rel="stylesheet" href="css/my-profile.css" />
    <!-- <script src="js/dashboard.js" defer type="module"></script> -->
    <script src="js/my-profile.js" defer type="module"></script>

    <script>
    function triggerClick() {
        document.querySelector("#profileImage").click();
    }

    function displayImage(e) {
        if (e.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                document
                    .querySelector("#profileDisplay")
                    .setAttribute("src", e.target.result);
            };
            reader.readAsDataURL(e.files[0]);
        }
    }
    </script>
</head>

<body>
    <div class="container">
        <div class="box">
            <h2 id="head">My Profile</h2>
            <form action="" method="POST" enctype="multipart/form-data">
                <div class="paded">
                    <div class="profile-pic">
                        <label for="confirm" class="profile-pic-label" style="cursor: pointer;">

                            <?php if($image_url == NULL): ?>
                            <img src="../public/media/images/user.png" alt="User Icon" onclick="triggerClick()"
                                width="150px" height="150px" id="profileDisplay">
                            <?php elseif($image_url !=NULL): ?>
                            <img src=<?php echo"../public/uploads/".$user_email_dir.'/'.$image_url ?> alt="User Icon"
                                onclick="triggerClick()" width="150px" height="150px" id="profileDisplay">
                            <?php endif; ?>
                            <br>
                            Change Profile Picture<br>
                            <input type="file" accept="image/*" name="uploadfile" style="display: none;"
                                id="profileImage" onchange="displayImage(this)">
                        </label>
                    </div>
                    <label for="name">Name </label>
                    <input type="text" name="name" id="name" class="text" />


                    <label for="name">Username </label>
                    <input type="text" name="name" id="username" class="text" />


                    <label for="phone">Phone Number </label>
                    <input type="tel" name="name" id="phone" class="text" />


                    <label for="email">Email </label>
                    <input type="email" name="email" id="email" class="text" placeholder="Email" min="6" max="32" />

                    <label for="institution">Institution </label>
                    <label for="course">Course</label>
                    <label for="institution">Institution </label>
                    <input type="text" name="institution" id="institution" class="text" />

                    <p id="errorMsg"></p>



                    <div class="password-container">
                        <label for="password">Password</label>
                        <!-- <input type="button" name="password" id="changepass-btn" class="btn" value="Change password" /> -->
                        <div class="password-changer">
                            <label for="password">Previous Password:</label>
                            <input type="password" class="text" name="pass" id="prev-password-input"
                                placeholder="Input Previous Password" />
                            <label for="password">Password:</label>
                            <input type="password" class="text" name="pass" id="password-input"
                                placeholder="Input New Password" />

                            <label for="comfirm">Confirm Password:</label>
                            <input type="password" class="text" name="comfirm" id="comfirm-password"
                                placeholder="Comfirm Entered Password" />

                            <p id="PasserrorMsg"></p>
                            <!-- <input type="button" name="password" id="save-pass" class="btn" value="Save" /> -->
                        </div>
                    </div>



                    <button type="submit" name="upload" id="save-edit-btn" class="btn">Save</button>


                </div>
            </form>

        </div>
    </div>
</body>

</html>
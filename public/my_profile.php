<?php
        session_start();
        if($_SESSION['login'] != 'ok'){
          header("Location: signin.php");
        }

        $conn= mysqli_connect("localhost","root",'',"teyake");// create a connection to database
        $user_id = $_SESSION['id'];
        $sql_email = "SELECT * FROM examiner WHERE id =$user_id";
        $result = mysqli_query($conn, $sql_email);
        $row = mysqli_fetch_assoc($result);
        $user_email = $row['Email'];
        $user_email_dir = str_replace(".", "_", $user_email);
        $instID = $row["InstID"];
        $deptID = $row["DeptID"];
        $courseID = $row["CourseID"];

if(isset($_POST['upload'])){
$filename = $_FILES['uploadfile']['name'];
$ext = pathinfo($filename, PATHINFO_EXTENSION);

if(!file_exists('uploads/' . $user_email_dir)){
    mkdir('uploads/' . $user_email_dir);
}
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
            <form action="" method="POST" enctype="multipart/form-data" autocomplete="off">
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
                    <input type="text" name="name" id="name" class="text" value="<?php echo $row["FullName"] ?>" />


                    <label for="phone">Phone Number </label>
                    <input type="tel" name="name" id="phone" class="text" value="<?php echo $row["PhoneNo"] ?>" />


                    <label for="email">Email </label>
                    <input type="email" name="email" id="email" class="text" placeholder="Email" min="6" max="32"
                        value="<?php echo $row["Email"] ?>" />

                    <div for="institution">Institution
                        <select name="institution" id="institution">
                            <option value="" disabled selected>Select an Institution</option>
                            <?php 
                            $retrieve_institution_query = "SELECT Name, ID FROM institution";
                            $retrieve_institution_result = mysqli_query($conn, $retrieve_institution_query);                            
                                while($row = mysqli_fetch_assoc($retrieve_institution_result)){
                                    echo "<option ".($instID==$row["ID"]? " selected ":" ")." value=\"".$row["ID"]."\">".$row["Name"]."</option>";
                                }

                                ?>
                        </select>
                        <button type="button" id="add-new-inst">Request New</button>
                    </div>
                    <div for="department">Department
                        <select name="department" id="department">
                            <option value="" disabled selected>Select a Department</option>
                            <?php 
                            $retrieve_department_query = "SELECT Name, ID FROM department";
                            $retrieve_department_result = mysqli_query($conn, $retrieve_department_query);                            
                                while($row = mysqli_fetch_assoc($retrieve_department_result)){
                                    echo "<option ".($deptID==$row["ID"]? " selected " : ""). "value=\"".$row["ID"]."\">".$row["Name"]."</option>";
                                }
                                ?>
                        </select>
                        <button type="button" id="add-new-dep">Request New</button>
                    </div>
                    <div for="course">Course
                        <select name="course" id="course">
                            <option value="" disabled selected>Select a Course</option>
                            <?php 
                            $retrieve_course_query = "SELECT Name, ID FROM course";
                            $retrieve_course_result = mysqli_query($conn, $retrieve_course_query);                            
                                while($row = mysqli_fetch_assoc($retrieve_course_result)){
                                    echo "<option ".($courseID==$row["ID"]? " selected " : ""). "value=\"".$row["ID"]."\">".$row["Name"]."</option>";
                                }
                                ?>
                        </select>
                        <button type="button" id="add-new-course">Request New</button>
                    </div>

                    <p id="errorMsg"></p>

                    <div class="password-container">
                        <label for="password">Password</label>
                        <!-- <input type="button" name="password" id="changepass-btn" class="btn" value="Change password" /> -->
                        <div class="password-changer">
                            <label for="password">Previous Password:</label>
                            <input type="password" class="text" name="pass" id="prev-password-input"
                                placeholder="Input Previous Password" autocomplete="off" />
                            <label for="password">Password:</label>
                            <input type="password" class="text" name="pass" id="password-input"
                                placeholder="Input New Password" />

                            <label for="comfirm">Confirm Password:</label>
                            <input type="password" class="text" name="comfirm" id="comfirm-password"
                                placeholder="Comfirm Entered Password" />
                            <button type="button" id="save-pass">Save Password</button>
                            <p id="PasserrorMsg"></p>
                            <!-- <input type="button" name="password" id="save-pass" class="btn" value="Save" /> -->
                        </div>
                    </div>
                    <div class="btns-container">
                        <button type="submit" name="upload" id="save-edit-btn" class="btn">Save</button>
                        <button type="button" id="back-btn" class="btn">Back</button>
                    </div>
                </div>
            </form>
            <div class="add-dep-window hidden">
                <div class="dep-overlay"></div>
                <div class="in-progress-modal">
                    <h3 class="text-center">Enter the Department</h3>
                    <form action="">
                        <input type=" text" name="department" placeholder="Department" id="dep-input">
                        <button type="button" id="add-dep">Add</button>
                    </form>
                </div>
            </div>
            <div class="add-course-window hidden">
                <div class="course-overlay"></div>
                <div class="in-progress-modal">
                    <h3 class="text-center">Enter the Course</h3>
                    <form action="">
                        <input type=" text" name="course" placeholder="Course" id="course-input">
                        <button type="button" id="add-course">Add</button>
                    </form>
                </div>
            </div>
            <div class="add-inst-window hidden">
                <div class="inst-overlay"></div>
                <div class="in-progress-modal">
                    <h3 class="text-center">Enter the Course</h3>
                    <form action="">
                        <input type=" text" name="institution" placeholder="Institution" id="institution-input">
                        <button type="button" id="add-inst">Add</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
    const userID = <?php echo $user_id?>
    </script>
</body>

</html>
<?php

session_start();
require '../vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet; 
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

        if($_SESSION['login'] != 'ok'){
          header("Location: signin.php");
        }

       include_once "../shared/includes/database.php";

        $examiner_list = "SELECT * FROM examiner";
        $examinee_list = "SELECT * FROM examinee";
        // $examinee_list = "SELECT examinee.ID, FullName, Email, Sex, Section, Score, department.Name AS DepName, institution.Name AS instName FROM examinee JOIN department ON examinee.DeptID = department.ID JOIN institution ON examinee.InstID = institution.ID;";
        $exam_list = "SELECT * FROM exam";
        // $exam_list = "SELECT exam.Name AS examName, FullName, Status, Duration, Date, course.Name AS courseName FROM exam JOIN course ON course.ID = exam.CourseID JOIN examiner ON exam.ExaminerID = examiner.ID;";
        $result_examiner = mysqli_query($conn, $examiner_list);
        $result_examinee = mysqli_query($conn, $examinee_list);
        $result_exam = mysqli_query($conn, $exam_list);

        $spreadsheet = new Spreadsheet(); 
            $sheet = $spreadsheet->getActiveSheet(); 
            
            $examinerList = [];

            $result_examiner_report = mysqli_query($conn, $examiner_list);

            if (mysqli_num_rows($result_examiner_report) > 0) {
                while($row = mysqli_fetch_assoc($result_examiner_report)){
                    array_push($examinerList, $row);
                }
            }
            $sheet->setCellValue("A1", "ID");
$sheet->setCellValue("B1", "Full Name");
$sheet->setCellValue("C1", "Email");
$sheet->setCellValue("D1", "Sex");
$sheet->setCellValue("E1", "Department");
$sheet->setCellValue("F1", "Institution");
$sheet->setCellValue("G1", "Phone No.");


for ($i=0; $i < count($examinerList); $i++) { 
    $sheet->setCellValue("A".($i+2), $examinerList[$i]['ID']);
    $sheet->setCellValue("B".($i+2), $examinerList[$i]['FullName']);
    $sheet->setCellValue("C".($i+2), $examinerList[$i]['Email']);
    $sheet->setCellValue("D".($i+2), $examinerList[$i]['Sex']);
    $sheet->setCellValue("E".($i+2), $examinerList[$i]['DeptID']);  
    $sheet->setCellValue("F".($i+2), $examinerList[$i]['InstID']);  
    $sheet->setCellValue("G".($i+2), $examinerList[$i]['PhoneNo']);  
}

// Write an .xlsx file  
$writer = new Xlsx($spreadsheet); 
  
// Save .xlsx file to the files directory 
$writer->save('Examiners_List.xlsx');

$spreadsheet = new Spreadsheet(); 
            $sheet = $spreadsheet->getActiveSheet(); 
            
            $examineeList = [];

            $result_examinee_report = mysqli_query($conn, $examinee_list);

            if (mysqli_num_rows($result_examinee_report) > 0) {
                while($row = mysqli_fetch_assoc($result_examinee_report)){
                    array_push($examineeList, $row);
                }
            }
            $sheet->setCellValue("A1", "ID");
$sheet->setCellValue("B1", "Full Name");
$sheet->setCellValue("C1", "Email");
$sheet->setCellValue("D1", "Sex");
$sheet->setCellValue("E1", "Section");
$sheet->setCellValue("F1", "Department");
$sheet->setCellValue("G1", "Score");
$sheet->setCellValue("H1", "Institution");



for ($i=0; $i < count($examineeList); $i++) { 
    $sheet->setCellValue("A".($i+2), $examineeList[$i]['ID']);
    $sheet->setCellValue("B".($i+2), $examineeList[$i]['FullName']);
    $sheet->setCellValue("C".($i+2), $examineeList[$i]['Email']);
    $sheet->setCellValue("D".($i+2), $examineeList[$i]['Sex']);
    $sheet->setCellValue("E".($i+2), $examineeList[$i]['Section']);  
    $sheet->setCellValue("F".($i+2), $examineeList[$i]['DeptID']);  
    $sheet->setCellValue("G".($i+2), $examineeList[$i]['Score']);  
    $sheet->setCellValue("H".($i+2), $examineeList[$i]['InstID']);  
}

// Write an .xlsx file  
$writer = new Xlsx($spreadsheet); 
  
// Save .xlsx file to the files directory 
$writer->save('Examinees_List.xlsx');


$spreadsheet = new Spreadsheet(); 
            $sheet = $spreadsheet->getActiveSheet(); 
            
            $examList = [];

            $result_exam_report = mysqli_query($conn, $exam_list);

            if (mysqli_num_rows($result_exam_report) > 0) {
                while($row = mysqli_fetch_assoc($result_exam_report)){
                    array_push($examList, $row);
                }
            }
            $sheet->setCellValue("A1", "Exam Name");
$sheet->setCellValue("B1", "Course Name");
$sheet->setCellValue("C1", "Examiner");
$sheet->setCellValue("D1", "Status");
$sheet->setCellValue("E1", "Duration");
$sheet->setCellValue("F1", "Date");


for ($i=0; $i < count($examList); $i++) { 
    $sheet->setCellValue("A".($i+2), $examList[$i]['Name']);
    $sheet->setCellValue("B".($i+2), $examList[$i]['CourseID']);
    $sheet->setCellValue("C".($i+2), $examList[$i]['ExaminerID']);
    $sheet->setCellValue("D".($i+2), $examList[$i]['Status']);
    $sheet->setCellValue("E".($i+2), $examList[$i]['Duration']);  
    $sheet->setCellValue("F".($i+2), $examList[$i]['Date']);  
    
}

// Write an .xlsx file  
$writer = new Xlsx($spreadsheet); 
  
// Save .xlsx file to the files directory 
$writer->save('Exams_List.xlsx');


        if(isset($_POST['examinerReport'])){
            

        }
        else if(isset($_POST['examineeReport'])){
            

        }
        else if(isset($_POST['examReport'])){
            

        }
        


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../public/css/style-reset.css" />
    <link rel="stylesheet" href="admin-panel.css" />
    <title>Admin Panel</title>
</head>

<body>
    <header class="bg-primary">
        <div class="logo-box bg-secondary">
            <img src="../public/media/teyake_white_fill.png" alt="Teyake Logo" class="logo" />
        </div>
        <div class="nav-right">

            </a>
            <a href="../index.php?action=logout" class="transition" id="logout">Log Out</a>
        </div>
    </header>


    <main>
        <nav class="sidebar bg-primary">
            <div class="nav-list">
                <ul>
                    <li class="list-item active">
                        <a href="#">General Stats</a>
                    </li>
                    <li class="list-item"><a href="#">Examiners</a></li>
                    <li class="list-item"><a href="#">Examinees</a></li>
                    <li class="list-item"><a href="#">Exams</a></li>
                </ul>
            </div>
        </nav>
        <div class="page dashboard-home">
            <h1>Admin Panel</h1>
            <div class="stat-container">

                <div class="stat-card">
                    <svg xmlns="http://www.w3.org/2000/svg" class="account transition" viewBox="0 0 512 512">
                        <title>Person Circle</title>
                        <path
                            d="M258.9 48C141.92 46.42 46.42 141.92 48 258.9c1.56 112.19 92.91 203.54 205.1 205.1 117 1.6 212.48-93.9 210.88-210.88C462.44 140.91 371.09 49.56 258.9 48zm126.42 327.25a4 4 0 01-6.14-.32 124.27 124.27 0 00-32.35-29.59C321.37 329 289.11 320 256 320s-65.37 9-90.83 25.34a124.24 124.24 0 00-32.35 29.58 4 4 0 01-6.14.32A175.32 175.32 0 0180 259c-1.63-97.31 78.22-178.76 175.57-179S432 158.81 432 256a175.32 175.32 0 01-46.68 119.25z">
                        </path>
                        <path
                            d="M256 144c-19.72 0-37.55 7.39-50.22 20.82s-19 32-17.57 51.93C191.11 256 221.52 288 256 288s64.83-32 67.79-71.24c1.48-19.74-4.8-38.14-17.68-51.82C293.39 151.44 275.59 144 256 144z">
                        </path>
                    </svg>
                    <p>Students - <span id="studCount">3</span></p>
                </div>
                <div class="stat-card">
                    <svg xmlns="http://www.w3.org/2000/svg" class="account transition" viewBox="0 0 512 512">
                        <title>Person Circle</title>
                        <path
                            d="M258.9 48C141.92 46.42 46.42 141.92 48 258.9c1.56 112.19 92.91 203.54 205.1 205.1 117 1.6 212.48-93.9 210.88-210.88C462.44 140.91 371.09 49.56 258.9 48zm126.42 327.25a4 4 0 01-6.14-.32 124.27 124.27 0 00-32.35-29.59C321.37 329 289.11 320 256 320s-65.37 9-90.83 25.34a124.24 124.24 0 00-32.35 29.58 4 4 0 01-6.14.32A175.32 175.32 0 0180 259c-1.63-97.31 78.22-178.76 175.57-179S432 158.81 432 256a175.32 175.32 0 01-46.68 119.25z">
                        </path>
                        <path
                            d="M256 144c-19.72 0-37.55 7.39-50.22 20.82s-19 32-17.57 51.93C191.11 256 221.52 288 256 288s64.83-32 67.79-71.24c1.48-19.74-4.8-38.14-17.68-51.82C293.39 151.44 275.59 144 256 144z">
                        </path>
                    </svg>
                    <p>Exams - <span id="examCount">2</span></p>
                </div>

            </div>

        </div>

        <div class="page exam-list hidden" style="width: 100%;">
            <div class="center-content">

                <table>
                    <tr>
                        <th>ID</th>
                        <th>Full Name</th>
                        <th>E-mail</th>
                        <th>Sex</th>
                        <th>Department</th>
                        <th>Institution</th>
                        <th>Phone Number</th>
                    </tr>
                    <?php  while($row_examiner =  mysqli_fetch_assoc($result_examiner)):?>
                    <tr>
                        <td><?php echo $row_examiner['ID'];?></td>
                        <td><?php echo $row_examiner['FullName'];?></td>
                        <td><?php echo $row_examiner['Email'];?></td>
                        <td><?php echo $row_examiner['Sex'];?></td>
                        <td><?php echo $row_examiner['DepName'];?></td>
                        <td><?php echo $row_examiner['instName'];?></td>
                        <td><?php echo $row_examiner['PhoneNo'];?></td>

                    </tr>
                    <?php endwhile;?>

                </table>
                <!-- <form action="" method="POST"> -->
                <div class="btn-container">
                    <a href="Examiners_List.xlsx" class="bg-primary text-white transition report-btn">Generate
                        Report</a>
                </div>
                <!-- </form> -->
            </div>
        </div>

        <div class="page add-exam-container hidden" style="width: 100%;">
            <div class="center-content">

                <table>
                    <tr>
                        <th>ID</th>
                        <th>Full Name</th>
                        <th>E-mail</th>
                        <th>Sex</th>
                        <th>Section</th>
                        <th>Department</th>
                        <th>Score</th>
                        <th>Institution</th>

                    </tr>
                    <?php  while($row_examinee =  mysqli_fetch_assoc($result_examinee)):?>
                    <tr>
                        <td><?php echo $row_examinee['ID'];?></td>
                        <td><?php echo $row_examinee['FullName'];?></td>
                        <td><?php echo $row_examinee['Email'];?></td>
                        <td><?php echo $row_examinee['Sex'];?></td>
                        <td><?php echo $row_examinee['Section'];?></td>
                        <td><?php echo $row_examinee['DepName'];?></td>
                        <td><?php echo $row_examinee['Score'];?></td>
                        <td><?php echo $row_examinee['instName'];?></td>

                    </tr>
                    <?php endwhile;?>
                </table>
                <!-- <form action="" method="POST"> -->
                <div class="btn-container">
                    <a href="Examinees_List.xlsx" class="bg-primary text-white transition report-btn">Generate
                        Report</a>
                </div>
                <!-- </form> -->
            </div>
        </div>


        <div class="results-page flex flex-col items-center hidden" style="width: 100%;">
            <div class="center-content">

                <table>
                    <tr>

                        <th>Exam Name</th>
                        <th>Course Name</th>
                        <th>Examiner</th>
                        <th>Status</th>
                        <th>Duration</th>
                        <th>Date</th>

                    </tr>
                    <?php  while($row_exam =  mysqli_fetch_assoc($result_exam)):?>
                    <tr>

                        <td><?php echo $row_exam['examName'];?></td>
                        <td><?php echo $row_exam['courseName'];?></td>
                        <td><?php echo $row_exam['FullName'];?></td>
                        <td><?php echo $row_exam['Status'];?></td>
                        <td><?php echo $row_exam['Duration'];?></td>
                        <td><?php echo $row_exam['Date'];?></td>


                    </tr>
                    <?php endwhile;?>
                </table>
                <!-- <form action="" method="POST"> -->
                <div class="btn-container">

                    <a href="Exams_List.xlsx" class="bg-primary text-white transition report-btn">Generate Report</a>
                </div>
                <!-- </form> -->
            </div>
        </div>
    </main>
</body>

<script src="admin-panel.js" type="module"></script>

</html>
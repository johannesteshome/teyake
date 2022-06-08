<?php

session_start();
require '../vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet; 
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

        if($_SESSION['login'] != 'ok'){
          header("Location: signin.php");
        }

        $conn= mysqli_connect("localhost","root",'',"teyake");// create a connection to database

        $examiner_list = "SELECT examiner.ID, FullName, Email, Sex, PhoneNo, department.Name AS DepName, institution.Name AS instName FROM examiner JOIN department ON examiner.DeptID = department.ID JOIN institution ON examiner.InstID = institution.ID;";
        $examinee_list = "SELECT examinee.ID, FullName, Email, Sex, Section, Score, department.Name AS DepName, institution.Name AS instName FROM examinee JOIN department ON examinee.DeptID = department.ID JOIN institution ON examinee.InstID = institution.ID;";
        $exam_list = "SELECT exam.Name AS examName, FullName, Status, Duration, Date, course.Name AS courseName FROM exam JOIN course ON course.ID = exam.CourseID JOIN examiner ON exam.ExaminerID = examiner.ID;";

        $dep_list = "SELECT * FROM department";
        $inst_list = "SELECT * FROM institution";
        $examiner = "SELECT * FROM examiner";
        $examinee = "SELECT * FROM examinee";
        $exam = "SELECT * FROM exam";
       

        $result_examiner = mysqli_query($conn, $examiner);
        $result_examinee = mysqli_query($conn, $examinee);
        $result_exam = mysqli_query($conn, $exam_list);

        $result_dep = mysqli_query($conn, $dep_list);
        $result_inst = mysqli_query($conn, $inst_list);
$deps = array();
        while($row_dep = mysqli_fetch_assoc($result_dep)){
array_push($deps, $row_dep);
        }     
     
        $inst = array();
        while($row_inst = mysqli_fetch_assoc($result_inst)){
            array_push($inst, $row_inst);
                    } 

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
    $sheet->setCellValue("A".($i+2), $examList[$i]['examName']);
    $sheet->setCellValue("B".($i+2), $examList[$i]['courseName']);
    $sheet->setCellValue("C".($i+2), $examList[$i]['FullName']);
    $sheet->setCellValue("D".($i+2), $examList[$i]['Status']);
    $sheet->setCellValue("E".($i+2), $examList[$i]['Duration']);  
    $sheet->setCellValue("F".($i+2), $examList[$i]['Date']);  
    
}

// Write an .xlsx file  
$writer = new Xlsx($spreadsheet); 
  
// Save .xlsx file to the files directory 
$writer->save('Exams_List.xlsx');

   


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../public/css/style-reset.css" />
    <link rel="stylesheet" href="./admin-panel.css" />
    <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>

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
                    <li class="list-item"><a href="#">Requests</a></li>
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
                <div class="stat-card">
                    <svg xmlns="http://www.w3.org/2000/svg" class="account transition" viewBox="0 0 512 512">
                        <title>Person Circle</title>
                        <path
                            d="M256 144c-19.72 0-37.55 7.39-50.22 20.82s-19 32-17.57 51.93C191.11 256 221.52 288 256 288s64.83-32 67.79-71.24c1.48-19.74-4.8-38.14-17.68-51.82C293.39 151.44 275.59 144 256 144z">
                        </path>
                    </svg>
                    <p>Average Score - <span id="avgScore">1</span></p>
                </div>
            </div>

        </div>

        <div class="page exam-list hidden" style="width: 100%;">
            <div class="center-content">

                <table style="height: 300px; overflow:scroll;">
                    <tr>
                        <th>ID</th>
                        <th>Full Name</th>
                        <th>E-mail</th>
                        <th>Sex</th>
                        <th>Department</th>
                        <th>Institution</th>
                        <th>Phone Number</th>
                    </tr>
                    <?php  

$spreadsheet = new Spreadsheet(); 
$sheet = $spreadsheet->getActiveSheet(); 

// $examinerList = [];  
$dept = '';
$insts = '';

                             $sheet->setCellValue("A1", "ID");
                             $sheet->setCellValue("B1", "Full Name");
                             $sheet->setCellValue("C1", "Email");
                             $sheet->setCellValue("D1", "Sex");
                             $sheet->setCellValue("E1", "Department");
                             $sheet->setCellValue("F1", "Institution");
                             $sheet->setCellValue("G1", "Phone No.");
                             
                             
                                 
                             
                             
                             $i = 0;
                            while($row_examiner =  mysqli_fetch_assoc($result_examiner)){
                               
                                // array_push($examinerList, $row);
                            echo '<tr>';
                                echo '<td>'.$row_examiner['ID'].'</td>';
                                $sheet->setCellValue("A".($i+2), $row_examiner['ID']);
                                echo '<td>'.$row_examiner['FullName'].'</td>';
                                $sheet->setCellValue("B".($i+2), $row_examiner['FullName']);
                                echo '<td>'.$row_examiner['Email'].'</td>';
                                $sheet->setCellValue("C".($i+2), $row_examiner['Email']);
                                echo '<td>'.$row_examiner['Sex'].'</td>';
                                $sheet->setCellValue("D".($i+2), $row_examiner['Sex']);
                                foreach($deps as $value) {
                                    if($row_examiner['DeptID'] == $value['ID']){
                                        echo '<td>'.$value['Name'].'</td>';
                                        $dept = $value['Name'];
                                        break;
                                    }
                                    if($row_examiner['DeptID'] == NULL ){
                                        echo '<td>-</td>';
                                        $dept = '-';
                                        break;
                                    }
                                }
                                $sheet->setCellValue("E".($i+2), $dept);     
                                foreach($inst as $value) {
                                    if($row_examiner['InstID'] == $value['ID']){
                                        echo '<td>'.$value['Name'].'</td>';
                                        $insts = $value['Name'];
                                        break;
                                    }
                                    if($row_examiner['InstID'] == NULL ){
                                        echo '<td>-</td>';
                                        $insts = '-';
                                        break;
                                    }
                                }
                                $sheet->setCellValue("F".($i+2), $insts);  

                                echo '<td>'.$row_examiner['PhoneNo'].'</td>';  
                                $sheet->setCellValue("G".($i+2), $row_examiner['PhoneNo']);  

                            echo '</tr>';
                            $i++;
                        }
                              // Write an .xlsx file  
                              $writer = new Xlsx($spreadsheet); 
                               
                              // Save .xlsx file to the files directory 
                              $writer->save('Examiners_List.xlsx');
                            
                            ?>

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
                    <?php  
                           
                           $spreadsheet = new Spreadsheet(); 
            $sheet = $spreadsheet->getActiveSheet(); 

            $insts = '';
            $dep = '';

            $sheet->setCellValue("A1", "ID");
$sheet->setCellValue("B1", "Full Name");
$sheet->setCellValue("C1", "Email");
$sheet->setCellValue("D1", "Sex");
$sheet->setCellValue("E1", "Section");
$sheet->setCellValue("F1", "Department");
$sheet->setCellValue("G1", "Score");
$sheet->setCellValue("H1", "Institution");


                           
                        $i=0;
                           while($row_examinee =  mysqli_fetch_assoc($result_examinee)){
                            echo '<tr>';
                                echo '<td>'.$row_examinee['ID'].'</td>';
                                $sheet->setCellValue("A".($i+2), $row_examinee['ID']);
                                echo '<td>'.$row_examinee['FullName'].'</td>';
    $sheet->setCellValue("B".($i+2), $row_examinee['FullName']);

                                echo '<td>'.$row_examinee['Email'].'</td>';
    $sheet->setCellValue("C".($i+2), $row_examinee['Email']);

                                echo '<td>'.$row_examinee['Sex'].'</td>';
    $sheet->setCellValue("D".($i+2), $row_examinee['Sex']);

    echo '<td>'.$row_examinee['Section'].'</td>';
    $sheet->setCellValue("E".($i+2), $row_examinee['Section']);  

                                foreach($deps as $value) {
                                    if($row_examinee['DeptID'] == $value['ID']){
                                        echo '<td name="dept">'.$value['Name'].'</td>';
                                        $dep = $value['Name'];
                                        break;
                                    }
                                    if($row_examinee['DeptID'] == NULL ){
                                        echo '<td>-</td>';
                                        $dep = '-';
                                        break;
                                    }
                                }
    $sheet->setCellValue("F".($i+2), $dep);  
                                    
                                foreach($inst as $value) {
                                    if($row_examinee['InstID'] == $value['ID']){
                                        echo '<td>'.$value['Name'].'</td>';
                                        $insts = $value['Name'];
                                        break;
                                    }
                                    if($row_examinee['InstID'] == NULL ){
                                        echo '<td>-</td>';
                                        $insts = '-';
                                        break;
                                    }
                                }
    $sheet->setCellValue("H".($i+2), $insts);  

                                echo '<td>'.$row_examinee['Score'].'</td>'; 
    $sheet->setCellValue("G".($i+2), $row_examinee['Score']);  

                            echo '</tr>';
                            $i++;
                            }
                            // Write an .xlsx file  
$writer = new Xlsx($spreadsheet); 
  
// Save .xlsx file to the files directory 
$writer->save('Examinees_List.xlsx');
                            ?>

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

        <div class="required-page flex flex-col items-center hidden" style="width: 100%;">
            <div class="search-filter">
                <div class="custom-select">
                    <select name="" id="request-type">
                        <option value="D">Department</option>
                        <option value="I">Institution</option>
                        <option value="C">Course</option>
                    </select>
                </div>


            </div>
            <div class="required-view">
                <div class="center-content">


                    <table class="required-table" id="request-table">
                        <thead>

                            <th>Requested Entry</th>
                            <th>Action</th>
                        </thead>
                        <tbody id="request-table-body">

                            <?php 
                         $request_dep = mysqli_query($conn, "SELECT input FROM requests WHERE type='D'");

                        if(mysqli_num_rows($request_dep)>0){
                            while($request_dep_list = mysqli_fetch_assoc($request_dep)){
                            echo '<tr class="request-item">';
                            echo '<td>'.$request_dep_list['input'].'</td>';
                            echo '<td class="table-btn"><button class="table-btn-appr"><svg width="24px" height="24px"
                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"
                            aria-labelledby="verifiedIconTitle" stroke="#000000" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round" fill="none" color="#000000">
                            <title id="verifiedIconTitle">Verified</title>
                            <path d="M8 12.5L10.5 15L16 9.5" />
                            <path
                                d="M12 22C13.2363 22 14.2979 21.2522 14.7572 20.1843C14.9195 19.8068 15.4558 19.5847 15.8375 19.7368C16.9175 20.1672 18.1969 19.9453 19.0711 19.0711C19.9452 18.1969 20.1671 16.9175 19.7368 15.8376C19.5847 15.4558 19.8068 14.9195 20.1843 14.7572C21.2522 14.2979 22 13.2363 22 12C22 10.7637 21.2522 9.70214 20.1843 9.24282C19.8068 9.08046 19.5847 8.54419 19.7368 8.16246C20.1672 7.08254 19.9453 5.80311 19.0711 4.92894C18.1969 4.05477 16.9175 3.83286 15.8376 4.26321C15.4558 4.41534 14.9195 4.1932 14.7572 3.8157C14.2979 2.74778 13.2363 2 12 2C10.7637 2 9.70214 2.74777 9.24282 3.81569C9.08046 4.19318 8.54419 4.41531 8.16246 4.26319C7.08254 3.83284 5.80311 4.05474 4.92894 4.92891C4.05477 5.80308 3.83286 7.08251 4.26321 8.16243C4.41534 8.54417 4.1932 9.08046 3.8157 9.24282C2.74778 9.70213 2 10.7637 2 12C2 13.2363 2.74777 14.2979 3.81569 14.7572C4.19318 14.9195 4.41531 15.4558 4.26319 15.8375C3.83284 16.9175 4.05474 18.1969 4.92891 19.0711C5.80308 19.9452 7.08251 20.1671 8.16243 19.7368C8.54416 19.5847 9.08046 19.8068 9.24282 20.1843C9.70213 21.2522 10.7637 22 12 22Z" />
                        </svg></button>
                    <button class="table-btn-disappr"><svg width="24px" height="24px" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M12,2 C17.5228475,2 22,6.4771525 22,12 C22,17.5228475 17.5228475,22 12,22 C6.4771525,22 2,17.5228475 2,12 C2,6.4771525 6.4771525,2 12,2 Z M12,4 C7.581722,4 4,7.581722 4,12 C4,16.418278 7.581722,20 12,20 C16.418278,20 20,16.418278 20,12 C20,7.581722 16.418278,4 12,4 Z M7.29325,7.29325 C7.65417308,6.93232692 8.22044527,6.90456361 8.61296051,7.20996006 L8.70725,7.29325 L12.00025,10.58625 L15.29325,7.29325 C15.68425,6.90225 16.31625,6.90225 16.70725,7.29325 C17.0681731,7.65417308 17.0959364,8.22044527 16.7905399,8.61296051 L16.70725,8.70725 L13.41425,12.00025 L16.70725,15.29325 C17.09825,15.68425 17.09825,16.31625 16.70725,16.70725 C16.51225,16.90225 16.25625,17.00025 16.00025,17.00025 C15.7869167,17.00025 15.5735833,16.9321944 15.3955509,16.796662 L15.29325,16.70725 L12.00025,13.41425 L8.70725,16.70725 C8.51225,16.90225 8.25625,17.00025 8.00025,17.00025 C7.74425,17.00025 7.48825,16.90225 7.29325,16.70725 C6.93232692,16.3463269 6.90456361,15.7800547 7.20996006,15.3875395 L7.29325,15.29325 L10.58625,12.00025 L7.29325,8.70725 C6.90225,8.31625 6.90225,7.68425 7.29325,7.29325 Z" />
                        </svg></button>
                </td>';
                            echo '</tr>';
            
                                        }

                        }else{
                            echo '<tr>';
                            echo '<td>No Result</td>';
                            echo '</tr>';
                        }
                        
                        ?>
                        </tbody>

                    </table>


                    <!-- </form> -->
                </div>
                <div class="center-content">



                    <table class="required-table">
                        <thead>

                            <th>No</th>
                            <th>Name</th>
                        </thead>
                        <tbody id="reference-body">

                            <?php 
                             $result_deps = mysqli_query($conn, $dep_list);
                            $num = 1;
                            while($row_deps = mysqli_fetch_assoc($result_deps)){
                            echo '<tr>';
                            echo '<td>'.$num++.'</td>';
                            echo '<td>'.$row_deps['Name'].'</td>';
                            echo '</tr>';
            
                                        }
                            
                            ?>

                        </tbody>



                    </table>

                    <!-- </form> -->
                </div>
            </div>
        </div>
    </main>
</body>

<script src="./admin-panel.js" type="module"></script>

</html>
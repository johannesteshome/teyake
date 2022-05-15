<?php
    
      if(isset($_POST["finishedTest"])){
        $exam = json_decode($_POST["finishedTest"]);
        // var_dump($exam);
        $answers = [];
        for($x = 0; $x < count($exam->questions);$x++){
           array_push($answers, $exam->questions[$x][count($exam->questions[$x])-1]);
        }
        for($x = 0; $x < count($exam->questions);$x++){
           array_pop($exam->questions[$x]);
        }
        for($x = 0; $x < count($exam->questions);$x++){
            echo "<pre>";
            var_dump($exam->questions[$x]);
            echo "</pre>";
        }

    };

        // for($x = 0; $x < count($answers);$x++){
        //     
        //     }
        // }



        // header('Location: ../dashboard/dashboard.php');

    
?>
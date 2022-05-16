<?php

class Exam{
            public $name;
            public $teacherID;
            public $questions;
            public $key;
            public $date;
            public $status;
            public $duration;
        function __construct()
        {
            $teacherID = 0;
            $name = "";
            $questions = [];
            $key = 0;
            $date = date("Y-m-d");
            $status = "open";
            $duration = 0;
        }

    };
    ?>
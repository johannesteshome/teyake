-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 08, 2022 at 10:43 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `teyake`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `answer`
--

CREATE TABLE `answer` (
  `ID` int(11) NOT NULL,
  `ExamKey` varchar(11) NOT NULL,
  `AnswerList` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `answer`
--

INSERT INTO `answer` (`ID`, `ExamKey`, `AnswerList`) VALUES
(8, 'BIVke', '[3,2,1]'),
(9, 'beEit', '[3,1]'),
(10, 'WQusP', '[1,3,1]'),
(11, 'duuAM', '[1,4]'),
(12, 'gXqzY', '[2,3,3,2]'),
(13, 'KfYOa', '[1,1]'),
(14, 'iCkIi', '[2]');

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE `course` (
  `ID` int(11) NOT NULL,
  `Name` varchar(35) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`ID`, `Name`) VALUES
(1, 'Internet Programming'),
(2, 'Advanced Programming'),
(3, 'Data Structure'),
(4, 'Computer Architecture'),
(5, 'Software requirement'),
(6, 'Introduction to programming'),
(7, 'Discrete Mathematics'),
(8, 'Dynamics');

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `ID` int(11) NOT NULL,
  `Name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`ID`, `Name`) VALUES
(2, 'Software Engineering'),
(3, 'Electrical engineering'),
(8, 'Mechanical Engineering'),
(9, 'Architecture'),
(10, 'Electro-Mechanical Engineering'),
(11, 'Civil Engineering'),
(12, 'Food Engineering');

-- --------------------------------------------------------

--
-- Table structure for table `exam`
--

CREATE TABLE `exam` (
  `Name` varchar(60) NOT NULL,
  `CourseID` int(11) DEFAULT NULL,
  `ExamKey` varchar(5) NOT NULL,
  `QuestionID` int(11) DEFAULT NULL,
  `AnswerID` int(11) DEFAULT NULL,
  `ExaminerID` int(11) NOT NULL,
  `Status` varchar(10) DEFAULT NULL,
  `Duration` int(10) NOT NULL,
  `Date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `exam`
--

INSERT INTO `exam` (`Name`, `CourseID`, `ExamKey`, `QuestionID`, `AnswerID`, `ExaminerID`, `Status`, `Duration`, `Date`) VALUES
('Test 2', NULL, 'beEit', 14, 9, 1, 'open', 30, '2003-06-22'),
('Exam1', NULL, 'BIVke', 13, 8, 1, 'close', 30, '2003-06-22'),
('The Then Them', NULL, 'duuAM', 16, 11, 1, 'open', 40, '2006-06-22'),
('test', NULL, 'gXqzY', 17, 12, 1, 'open', 15, '2008-06-22'),
('This is New', NULL, 'iCkIi', 19, 14, 5, 'open', 25, '2022-06-08'),
('test11', NULL, 'KfYOa', 18, 13, 1, 'close', 60, '2022-06-08'),
('New Test', NULL, 'WQusP', 15, 10, 1, 'open', 20, '2003-06-22');

-- --------------------------------------------------------

--
-- Table structure for table `examinee`
--

CREATE TABLE `examinee` (
  `ID` int(11) NOT NULL,
  `FullName` varchar(60) NOT NULL,
  `Email` varchar(60) NOT NULL,
  `Section` varchar(2) DEFAULT NULL,
  `InstID` int(11) DEFAULT NULL,
  `ExamKey` varchar(25) NOT NULL,
  `Sex` char(1) NOT NULL,
  `Score` float DEFAULT 0,
  `AnswerList` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `SchoolID` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `examinee`
--

INSERT INTO `examinee` (`ID`, `FullName`, `Email`, `Section`, `InstID`, `ExamKey`, `Sex`, `Score`, `AnswerList`, `SchoolID`) VALUES
(1, 'Yohannes Fantahun', 'fantish@mail.com', 'A', 3, 'WQusP', 'M', 2, '[1,2,1]', '0702/12'),
(5, 'test person', 'test@mail.com', 'A', 2, 'duuAM', 'M', 0, '[2,2]', '111'),
(6, 'Abex Abelew', 'abex@mail.com', 'e', 2, 'duuAM', 'M', 1, '[1,2]', '111');

-- --------------------------------------------------------

--
-- Table structure for table `examiner`
--

CREATE TABLE `examiner` (
  `ID` int(11) NOT NULL,
  `FullName` varchar(60) NOT NULL,
  `Email` varchar(60) NOT NULL,
  `Password` varchar(60) NOT NULL,
  `Sex` varchar(1) NOT NULL,
  `DeptID` int(11) DEFAULT NULL,
  `InstID` int(11) DEFAULT NULL,
  `CourseID` int(11) DEFAULT NULL,
  `PhoneNo` bigint(20) NOT NULL,
  `ImageURL` varchar(60) DEFAULT NULL,
  `verified` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `examiner`
--

INSERT INTO `examiner` (`ID`, `FullName`, `Email`, `Password`, `Sex`, `DeptID`, `InstID`, `CourseID`, `PhoneNo`, `ImageURL`, `verified`) VALUES
(1, 'Yohannes Assefa', 'yoniassefayoni@gmail.com', '$2y$10$58j0zYP0/TkLtiSg0Sji6eltxiir6KZ1DinHbh8NExEbPCHfOCD2G', 'M', 11, 3, 3, 912121212, 'yoniassefayoni@gmail.com1654711832.png', 1),
(5, 'Shewe Yefetene', 'assefayohannes123@gmail.com', '$2y$10$SE8u0P6OT54bx3WS.MaSUOKdjBc0Koja83bR0c.UkbexVqzlqT9Uy', 'M', 0, NULL, NULL, 912121212, 'assefayohannes123@gmail.com1654713196.png', 1),
(6, 'Shewe seks', 'assefayohannes5@gmail.com', '$2y$10$7WL3F50MN0q/s88aQhxDeeY7MKSH86a5pZK.4yjWwKNuTgIpOfHkO', 'M', 0, NULL, NULL, 912121212, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `inprogressexams`
--

CREATE TABLE `inprogressexams` (
  `id` int(11) NOT NULL,
  `Email` varchar(60) NOT NULL,
  `ExamKey` varchar(5) NOT NULL,
  `AnswerList` longtext NOT NULL,
  `EndTime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `institution`
--

CREATE TABLE `institution` (
  `ID` int(11) NOT NULL,
  `Name` varchar(60) NOT NULL,
  `Address` varchar(60) DEFAULT NULL,
  `Phone` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `institution`
--

INSERT INTO `institution` (`ID`, `Name`, `Address`, `Phone`) VALUES
(1, 'Addis Ababa Science and Technology University', 'Akaki-Kality Sub City, Addis Ababa', '0912121212'),
(2, 'Addis Ababa University', '6 Kilo, Addis Ababa', '0911111111'),
(3, 'Unity University College', 'Bole SubCity, Addis Ababa', '0910101010'),
(4, 'Not Listed', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `question`
--

CREATE TABLE `question` (
  `ID` int(11) NOT NULL,
  `ExamKey` varchar(11) NOT NULL,
  `QuestionList` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `question`
--

INSERT INTO `question` (`ID`, `ExamKey`, `QuestionList`) VALUES
(13, 'BIVke', '[[\"What is X?\",\"12\",\"55\",\"76\",null,null],[\"This is the what. you know?\",\"Yes\",\"No\",null,null,null],[\"Final one, Are you on?\",\"Fo Sho!\",\"Heeeell Nah\",null,null,null]]'),
(14, 'beEit', '[[\"This is a second one?\",\"Maybe\",\"Probably\",\"Yes\",null,null],[\"Applebeans\",\"Based\",\"Cap\",null,null,null]]'),
(15, 'WQusP', '[[\"Test the what?\",\"Big Yes\",\"Nah fam\",null,null,null],[\"This is a second one?\",\"Maybe\",\"Probably\",\"Yes\",null,null],[\"Applebeans\",\"Based\",\"Cap\",null,null,null]]'),
(16, 'duuAM', '[[\"What is the?\",\"Naaa Bruv\",\"Yee\",null,null,null],[\"This is a second one?\",\"Maybe\",\"Probably\",\"Yes\",\"Nope\",null]]'),
(17, 'gXqzY', '[[\"This is my Question\",\"Is it?\",\"Yes\",null,null,null],[\"What is X?\",\"12\",\"55\",\"76\",null,null],[\"This is the that\",\"Yes\",\"No\",\"Embi\",null,null],[\"This is the what. you know?\",\"Yes\",\"No\",null,null,null]]'),
(18, 'KfYOa', '[[\"Final one, Are you on?\",\"Fo Sho!\",\"Heeeell Nah\",null,null,null],[\"What is the?\",\"Naaa Bruv\",\"Yee\",null,null,null]]'),
(19, 'iCkIi', '[[\"Testing Test Tester\",\"Yes\",\"No\",null,null,null]]');

-- --------------------------------------------------------

--
-- Table structure for table `requests`
--

CREATE TABLE `requests` (
  `id` int(11) NOT NULL,
  `type` varchar(100) NOT NULL,
  `input` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `requests`
--

INSERT INTO `requests` (`id`, `type`, `input`) VALUES
(8, 'D', 'test'),
(9, 'C', 'Dynamics');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `answer`
--
ALTER TABLE `answer`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `ans_exam_key` (`ExamKey`);

--
-- Indexes for table `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `exam`
--
ALTER TABLE `exam`
  ADD PRIMARY KEY (`ExamKey`),
  ADD KEY `exam_ans_id` (`AnswerID`),
  ADD KEY `exam_course_id` (`CourseID`),
  ADD KEY `exam_examiner_id` (`ExaminerID`),
  ADD KEY `exam_question_id` (`QuestionID`);

--
-- Indexes for table `examinee`
--
ALTER TABLE `examinee`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `examiner`
--
ALTER TABLE `examiner`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `examiner_dept_id` (`DeptID`),
  ADD KEY `examiner_inst_id` (`InstID`),
  ADD KEY `examiner_course_id` (`CourseID`);

--
-- Indexes for table `inprogressexams`
--
ALTER TABLE `inprogressexams`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `institution`
--
ALTER TABLE `institution`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `question`
--
ALTER TABLE `question`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `question_exam_key` (`ExamKey`);

--
-- Indexes for table `requests`
--
ALTER TABLE `requests`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `answer`
--
ALTER TABLE `answer`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `course`
--
ALTER TABLE `course`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `examinee`
--
ALTER TABLE `examinee`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `examiner`
--
ALTER TABLE `examiner`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `inprogressexams`
--
ALTER TABLE `inprogressexams`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

--
-- AUTO_INCREMENT for table `institution`
--
ALTER TABLE `institution`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `question`
--
ALTER TABLE `question`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `requests`
--
ALTER TABLE `requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `answer`
--
ALTER TABLE `answer`
  ADD CONSTRAINT `ans_exam_key` FOREIGN KEY (`ExamKey`) REFERENCES `exam` (`ExamKey`);

--
-- Constraints for table `exam`
--
ALTER TABLE `exam`
  ADD CONSTRAINT `exam_ans_id` FOREIGN KEY (`AnswerID`) REFERENCES `answer` (`ID`),
  ADD CONSTRAINT `exam_course_id` FOREIGN KEY (`CourseID`) REFERENCES `course` (`ID`),
  ADD CONSTRAINT `exam_examiner_id` FOREIGN KEY (`ExaminerID`) REFERENCES `examiner` (`ID`),
  ADD CONSTRAINT `exam_question_id` FOREIGN KEY (`QuestionID`) REFERENCES `question` (`ID`);

--
-- Constraints for table `examiner`
--
ALTER TABLE `examiner`
  -- ADD CONSTRAINT `examiner_course_id` FOREIGN KEY (`CourseID`) REFERENCES `course` (`ID`),
  -- ADD CONSTRAINT `examiner_dept_id` FOREIGN KEY (`DeptID`) REFERENCES `department` (`ID`),
  ADD CONSTRAINT `examiner_inst_id` FOREIGN KEY (`InstID`) REFERENCES `institution` (`ID`);

--
-- Constraints for table `question`
--
ALTER TABLE `question`
  ADD CONSTRAINT `question_exam_key` FOREIGN KEY (`ExamKey`) REFERENCES `exam` (`ExamKey`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

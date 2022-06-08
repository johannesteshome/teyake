-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jun 08, 2022 at 04:17 PM
-- Server version: 8.0.11
-- PHP Version: 7.4.26

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
-- Table structure for table `answer`
--

DROP TABLE IF EXISTS `answer`;
CREATE TABLE IF NOT EXISTS `answer` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `ExamKey` varchar(11) NOT NULL,
  `AnswerList` longtext NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `ans_exam_key` (`ExamKey`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `answer`
--

INSERT INTO `answer` (`ID`, `ExamKey`, `AnswerList`) VALUES
(8, 'BIVke', '[3,2,1]'),
(9, 'beEit', '[3,1]'),
(10, 'WQusP', '[1,3,1]'),
(11, 'duuAM', '[1,4]');

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

DROP TABLE IF EXISTS `course`;
CREATE TABLE IF NOT EXISTS `course` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(35) NOT NULL,
  `DeptID` int(11) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `course_dept_id` (`DeptID`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`ID`, `Name`, `DeptID`) VALUES
(1, 'Internet Programming', 2),
(2, 'Advanced Programming', 2),
(3, 'Data Structure', 2),
(4, 'Computer Architecture', 2),
(5, 'Software requirement', 2),
(6, 'Introduction to programming', 2),
(7, 'Discrete Mathematics', 2),
(8, 'Dynamics', 2);

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

DROP TABLE IF EXISTS `department`;
CREATE TABLE IF NOT EXISTS `department` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(30) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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

DROP TABLE IF EXISTS `exam`;
CREATE TABLE IF NOT EXISTS `exam` (
  `Name` varchar(60) NOT NULL,
  `CourseID` int(11) DEFAULT NULL,
  `ExamKey` varchar(5) NOT NULL,
  `QuestionID` int(11) DEFAULT NULL,
  `AnswerID` int(11) DEFAULT NULL,
  `ExaminerID` int(11) NOT NULL,
  `Status` varchar(10) DEFAULT NULL,
  `Duration` int(10) NOT NULL,
  `Date` date NOT NULL,
  PRIMARY KEY (`ExamKey`),
  KEY `exam_ans_id` (`AnswerID`),
  KEY `exam_course_id` (`CourseID`),
  KEY `exam_examiner_id` (`ExaminerID`),
  KEY `exam_question_id` (`QuestionID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `exam`
--

INSERT INTO `exam` (`Name`, `CourseID`, `ExamKey`, `QuestionID`, `AnswerID`, `ExaminerID`, `Status`, `Duration`, `Date`) VALUES
('Test 2', NULL, 'beEit', 14, 9, 1, 'close', 30, '2003-06-22'),
('Exam1', NULL, 'BIVke', 13, 8, 1, 'open', 30, '2003-06-22'),
('The Then Them', NULL, 'duuAM', 16, 11, 1, 'open', 40, '2006-06-22'),
('New Test', NULL, 'WQusP', 15, 10, 1, 'open', 20, '2003-06-22');

-- --------------------------------------------------------

--
-- Table structure for table `examinee`
--

DROP TABLE IF EXISTS `examinee`;
CREATE TABLE IF NOT EXISTS `examinee` (
  `ID` int(11) NOT NULL,
  `FullName` varchar(60) NOT NULL,
  `Email` varchar(60) NOT NULL,
  `Section` varchar(2) DEFAULT NULL,
  `DeptID` int(11) DEFAULT NULL,
  `InstID` int(11) DEFAULT NULL,
  `ExamKey` varchar(25) NOT NULL,
  `Sex` char(1) NOT NULL,
  `Score` float DEFAULT '0',
  `AnswerList` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin,
  `SchoolID` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `examiner`
--

DROP TABLE IF EXISTS `examiner`;
CREATE TABLE IF NOT EXISTS `examiner` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `FullName` varchar(60) NOT NULL,
  `Email` varchar(60) NOT NULL,
  `Password` varchar(60) NOT NULL,
  `Sex` varchar(1) NOT NULL,
  `DeptID` int(11) DEFAULT NULL,
  `InstID` int(11) DEFAULT NULL,
  `PhoneNo` bigint(20) NOT NULL,
  `ImageURL` varchar(60) DEFAULT NULL,
  `verified` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`ID`),
  KEY `examiner_dept_id` (`DeptID`),
  KEY `examiner_inst_id` (`InstID`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `examiner`
--

INSERT INTO `examiner` (`ID`, `FullName`, `Email`, `Password`, `Sex`, `DeptID`, `InstID`, `PhoneNo`, `ImageURL`, `verified`) VALUES
(1, 'Yohannes Assefa', 'yoniassefayoni@gmail.com', '$2y$10$58j0zYP0/TkLtiSg0Sji6eltxiir6KZ1DinHbh8NExEbPCHfOCD2G', 'M', NULL, NULL, 912121212, 'yoniassefayoni@gmail.com1654535862.png', 1),
(5, 'Shewe Yefetene', 'assefayohannes123@gmail.com', '$2y$10$SE8u0P6OT54bx3WS.MaSUOKdjBc0Koja83bR0c.UkbexVqzlqT9Uy', 'M', NULL, NULL, 912121212, NULL, 1),
(6, 'Shewe seks', 'assefayohannes5@gmail.com', '$2y$10$7WL3F50MN0q/s88aQhxDeeY7MKSH86a5pZK.4yjWwKNuTgIpOfHkO', 'M', NULL, NULL, 912121212, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `inprogressexams`
--

DROP TABLE IF EXISTS `inprogressexams`;
CREATE TABLE IF NOT EXISTS `inprogressexams` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Email` varchar(60) NOT NULL,
  `ExamKey` varchar(5) NOT NULL,
  `AnswerList` longtext NOT NULL,
  `EndTime` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=77 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `institution`
--

DROP TABLE IF EXISTS `institution`;
CREATE TABLE IF NOT EXISTS `institution` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(60) NOT NULL,
  `Address` varchar(60) NOT NULL,
  `Phone` varchar(20) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `institution`
--

INSERT INTO `institution` (`ID`, `Name`, `Address`, `Phone`) VALUES
(1, 'Addis Ababa Science and Technology University', 'Akaki-Kality Sub City, Addis Ababa', '0912121212'),
(2, 'Addis Ababa University', '6 Kilo, Addis Ababa', '0911111111'),
(3, 'Unity University College', 'Bole SubCity, Addis Ababa', '0910101010');

-- --------------------------------------------------------

--
-- Table structure for table `question`
--

DROP TABLE IF EXISTS `question`;
CREATE TABLE IF NOT EXISTS `question` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `ExamKey` varchar(11) NOT NULL,
  `QuestionList` longtext NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `question_exam_key` (`ExamKey`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `question`
--

INSERT INTO `question` (`ID`, `ExamKey`, `QuestionList`) VALUES
(13, 'BIVke', '[[\"What is X?\",\"12\",\"55\",\"76\",null,null],[\"This is the what. you know?\",\"Yes\",\"No\",null,null,null],[\"Final one, Are you on?\",\"Fo Sho!\",\"Heeeell Nah\",null,null,null]]'),
(14, 'beEit', '[[\"This is a second one?\",\"Maybe\",\"Probably\",\"Yes\",null,null],[\"Applebeans\",\"Based\",\"Cap\",null,null,null]]'),
(15, 'WQusP', '[[\"Test the what?\",\"Big Yes\",\"Nah fam\",null,null,null],[\"This is a second one?\",\"Maybe\",\"Probably\",\"Yes\",null,null],[\"Applebeans\",\"Based\",\"Cap\",null,null,null]]'),
(16, 'duuAM', '[[\"What is the?\",\"Naaa Bruv\",\"Yee\",null,null,null],[\"This is a second one?\",\"Maybe\",\"Probably\",\"Yes\",\"Nope\",null]]');

-- --------------------------------------------------------

--
-- Table structure for table `requests`
--

DROP TABLE IF EXISTS `requests`;
CREATE TABLE IF NOT EXISTS `requests` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `input` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `answer`
--
ALTER TABLE `answer`
  ADD CONSTRAINT `ans_exam_key` FOREIGN KEY (`ExamKey`) REFERENCES `exam` (`examkey`);

--
-- Constraints for table `course`
--
ALTER TABLE `course`
  ADD CONSTRAINT `course_dept_id` FOREIGN KEY (`DeptID`) REFERENCES `department` (`id`);

--
-- Constraints for table `exam`
--
ALTER TABLE `exam`
  ADD CONSTRAINT `exam_ans_id` FOREIGN KEY (`AnswerID`) REFERENCES `answer` (`id`),
  ADD CONSTRAINT `exam_course_id` FOREIGN KEY (`CourseID`) REFERENCES `course` (`id`),
  ADD CONSTRAINT `exam_examiner_id` FOREIGN KEY (`ExaminerID`) REFERENCES `examiner` (`id`),
  ADD CONSTRAINT `exam_question_id` FOREIGN KEY (`QuestionID`) REFERENCES `question` (`id`);

--
-- Constraints for table `examiner`
--
ALTER TABLE `examiner`
  ADD CONSTRAINT `examiner_dept_id` FOREIGN KEY (`DeptID`) REFERENCES `department` (`id`),
  ADD CONSTRAINT `examiner_inst_id` FOREIGN KEY (`InstID`) REFERENCES `institution` (`id`);

--
-- Constraints for table `question`
--
ALTER TABLE `question`
  ADD CONSTRAINT `question_exam_key` FOREIGN KEY (`ExamKey`) REFERENCES `exam` (`examkey`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

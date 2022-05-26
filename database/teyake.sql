-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 26, 2022 at 10:14 AM
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
(4, 'NDAX8', '[1]');

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE `course` (
  `ID` int(11) NOT NULL,
  `Name` varchar(35) NOT NULL,
  `DeptID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `ID` int(11) NOT NULL,
  `Name` varchar(30) NOT NULL,
  `InstID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  `Date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `exam`
--

INSERT INTO `exam` (`Name`, `CourseID`, `ExamKey`, `QuestionID`, `AnswerID`, `ExaminerID`, `Status`, `Duration`, `Date`) VALUES
('test', NULL, 'NDAX8', 9, 4, 1, 'open', 12, '2026-05-22');

-- --------------------------------------------------------

--
-- Table structure for table `examinee`
--

CREATE TABLE `examinee` (
  `ID` int(11) NOT NULL,
  `FullName` varchar(60) NOT NULL,
  `Email` varchar(60) NOT NULL,
  `Section` varchar(2) DEFAULT NULL,
  `DeptID` int(11) DEFAULT NULL,
  `InstID` int(11) DEFAULT NULL,
  `ExamKey` varchar(25) NOT NULL,
  `Sex` char(1) NOT NULL,
  `Score` float DEFAULT NULL,
  `AnswerList` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `SchoolID` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  `PhoneNo` bigint(20) NOT NULL,
  `ImageURL` varchar(60) DEFAULT NULL,
  `verified` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `examiner`
--

INSERT INTO `examiner` (`ID`, `FullName`, `Email`, `Password`, `Sex`, `DeptID`, `InstID`, `PhoneNo`, `ImageURL`, `verified`) VALUES
(1, 'Yohannes Assefa', 'yoniassefayoni@gmail.com', '$2y$10$xw5lPmWnGLK3GePi98To4.iRmfB527q6QPhpkr4EboINC/nzk0xGW', 'M', NULL, NULL, 912121212, NULL, 1),
(5, 'Shewe Yefetene', 'assefayohannes123@gmail.com', '$2y$10$SE8u0P6OT54bx3WS.MaSUOKdjBc0Koja83bR0c.UkbexVqzlqT9Uy', 'M', NULL, NULL, 912121212, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `institution`
--

CREATE TABLE `institution` (
  `ID` int(11) NOT NULL,
  `Name` varchar(60) NOT NULL,
  `Address` varchar(60) NOT NULL,
  `Phone` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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

CREATE TABLE `question` (
  `ID` int(11) NOT NULL,
  `ExamKey` varchar(11) NOT NULL,
  `QuestionList` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `question`
--

INSERT INTO `question` (`ID`, `ExamKey`, `QuestionList`) VALUES
(9, 'NDAX8', '[[\"alstkdfa\",\"asdg\",\"asdga\",null,null,null]]');

--
-- Indexes for dumped tables
--

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
  ADD PRIMARY KEY (`ID`),
  ADD KEY `course_dept_id` (`DeptID`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `dept_inst_id` (`InstID`);

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
  ADD PRIMARY KEY (`ID`),
  ADD KEY `examinee_dept_id` (`DeptID`),
  ADD KEY `examinee_exam_key` (`ExamKey`);

--
-- Indexes for table `examiner`
--
ALTER TABLE `examiner`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `examiner_dept_id` (`DeptID`),
  ADD KEY `examiner_inst_id` (`InstID`);

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
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `answer`
--
ALTER TABLE `answer`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `course`
--
ALTER TABLE `course`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `examinee`
--
ALTER TABLE `examinee`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `examiner`
--
ALTER TABLE `examiner`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `institution`
--
ALTER TABLE `institution`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `question`
--
ALTER TABLE `question`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `answer`
--
ALTER TABLE `answer`
  ADD CONSTRAINT `ans_exam_key` FOREIGN KEY (`ExamKey`) REFERENCES `exam` (`ExamKey`);

--
-- Constraints for table `course`
--
ALTER TABLE `course`
  ADD CONSTRAINT `course_dept_id` FOREIGN KEY (`DeptID`) REFERENCES `department` (`ID`);

--
-- Constraints for table `department`
--
ALTER TABLE `department`
  ADD CONSTRAINT `dept_inst_id` FOREIGN KEY (`InstID`) REFERENCES `institution` (`ID`);

--
-- Constraints for table `exam`
--
ALTER TABLE `exam`
  ADD CONSTRAINT `exam_ans_id` FOREIGN KEY (`AnswerID`) REFERENCES `answer` (`ID`),
  ADD CONSTRAINT `exam_course_id` FOREIGN KEY (`CourseID`) REFERENCES `course` (`ID`),
  ADD CONSTRAINT `exam_examiner_id` FOREIGN KEY (`ExaminerID`) REFERENCES `examiner` (`ID`),
  ADD CONSTRAINT `exam_question_id` FOREIGN KEY (`QuestionID`) REFERENCES `question` (`ID`);

--
-- Constraints for table `examinee`
--
ALTER TABLE `examinee`
  ADD CONSTRAINT `examinee_dept_id` FOREIGN KEY (`DeptID`) REFERENCES `department` (`ID`),
  ADD CONSTRAINT `examinee_exam_key` FOREIGN KEY (`ExamKey`) REFERENCES `exam` (`ExamKey`);

--
-- Constraints for table `examiner`
--
ALTER TABLE `examiner`
  ADD CONSTRAINT `examiner_dept_id` FOREIGN KEY (`DeptID`) REFERENCES `department` (`ID`),
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

-- phpMyAdmin SQL Dump
-- version 2.11.7
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 23, 2015 at 12:37 AM
-- Server version: 5.0.51
-- PHP Version: 5.2.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `ourdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `area_assign`
--

CREATE TABLE IF NOT EXISTS `area_assign` (
  `areaID` int(30) NOT NULL,
  `studentID` varchar(30) NOT NULL,
  PRIMARY KEY  (`areaID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `area_assign`
--


-- --------------------------------------------------------

--
-- Table structure for table `attendance_faculty`
--

CREATE TABLE IF NOT EXISTS `attendance_faculty` (
  `attendId` int(11) NOT NULL auto_increment,
  `userID` int(30) NOT NULL,
  `subject` varchar(40) NOT NULL,
  `date` date NOT NULL,
  `timeIn` time NOT NULL,
  `timeOut` time NOT NULL,
  `Infraction` varchar(40) NOT NULL,
  `Cause` varchar(40) NOT NULL,
  PRIMARY KEY  (`attendId`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=332 ;

--
-- Dumping data for table `attendance_faculty`
--

INSERT INTO `attendance_faculty` (`attendId`, `userID`, `subject`, `date`, `timeIn`, `timeOut`, `Infraction`, `Cause`) VALUES
(331, 123, 'Physics', '2015-03-17', '15:11:41', '15:11:47', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `attendance_student`
--

CREATE TABLE IF NOT EXISTS `attendance_student` (
  `attendId` int(20) NOT NULL auto_increment,
  `userID` int(20) NOT NULL,
  `subject` varchar(40) NOT NULL,
  `date` date NOT NULL,
  `timeIn` time NOT NULL,
  `timeOut` time NOT NULL,
  `Infraction` varchar(50) NOT NULL,
  `Cause` varchar(60) NOT NULL,
  PRIMARY KEY  (`attendId`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=57 ;

--
-- Dumping data for table `attendance_student`
--


-- --------------------------------------------------------

--
-- Table structure for table `audit`
--

CREATE TABLE IF NOT EXISTS `audit` (
  `auditNo` int(20) NOT NULL,
  `auditLog` varchar(60) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  PRIMARY KEY  (`auditNo`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `audit`
--


-- --------------------------------------------------------

--
-- Table structure for table `class_faculty`
--

CREATE TABLE IF NOT EXISTS `class_faculty` (
  `classID` int(11) NOT NULL auto_increment,
  `userID` int(30) NOT NULL,
  `Subject` varchar(40) NOT NULL,
  `Days` varchar(60) NOT NULL,
  `startClass` time NOT NULL,
  `endClass` time NOT NULL,
  `locationDescr` varchar(50) NOT NULL,
  PRIMARY KEY  (`classID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=320 ;

--
-- Dumping data for table `class_faculty`
--

INSERT INTO `class_faculty` (`classID`, `userID`, `Subject`, `Days`, `startClass`, `endClass`, `locationDescr`) VALUES
(316, 123, 'Physics', 'Saturday', '10:30:00', '11:30:00', 'Physics Lab'),
(315, 123, 'Physics', 'Thursday', '10:30:00', '11:30:00', 'Physics Lab'),
(314, 123, 'Physics', 'Tuesday', '10:30:00', '11:30:00', 'Physics Lab'),
(313, 123, 'Science', 'Thursday', '00:00:10', '00:00:00', ''),
(309, 457, 'MIS', 'Saturday', '10:30:00', '11:30:00', 'Drawing Lab'),
(310, 457, 'MIS', 'Sunday', '10:30:00', '11:30:00', 'Drawing Lab'),
(308, 457, 'MIS', 'Friday', '10:30:00', '11:30:00', 'Drawing Lab'),
(307, 1010, 'Social Science', 'Sunday', '17:00:00', '19:00:00', 'Drawing Lab'),
(305, 1010, 'Social Science', 'Friday', '17:00:00', '19:00:00', 'Drawing Lab'),
(306, 1010, 'Social Science', 'Saturday', '17:00:00', '19:00:00', 'Drawing Lab'),
(319, 1010, 'Dynamic Web', 'Saturday', '10:30:00', '11:30:00', 'Laboratory'),
(317, 1010, 'Dynamic Web', 'Tuesday', '10:30:00', '11:30:00', 'Laboratory'),
(318, 1010, 'Dynamic Web', 'Thursday', '10:30:00', '11:30:00', 'Laboratory');

-- --------------------------------------------------------

--
-- Table structure for table `class_student`
--

CREATE TABLE IF NOT EXISTS `class_student` (
  `classID` int(20) NOT NULL auto_increment,
  `userID` int(20) NOT NULL,
  `Subject` varchar(40) NOT NULL,
  `Days` varchar(30) NOT NULL,
  `startClass` time NOT NULL,
  `endClass` time NOT NULL,
  `locationDescr` varchar(40) NOT NULL,
  PRIMARY KEY  (`classID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `class_student`
--

INSERT INTO `class_student` (`classID`, `userID`, `Subject`, `Days`, `startClass`, `endClass`, `locationDescr`) VALUES
(1, 444, 'Physics 1', 'Friday', '13:00:00', '14:00:00', ''),
(2, 444, 'Physics 1', 'Saturday', '13:00:00', '14:00:00', ''),
(3, 444, 'Physics 1', 'Sunday', '13:00:00', '14:00:00', ''),
(4, 444, 'English', 'Tuesday', '11:00:00', '12:00:00', 'Drawing Lab'),
(5, 444, 'English', 'Thursday', '11:00:00', '12:00:00', 'Drawing Lab'),
(6, 444, 'English', 'Saturday', '11:00:00', '12:00:00', 'Drawing Lab');

-- --------------------------------------------------------

--
-- Table structure for table `job_schedule`
--

CREATE TABLE IF NOT EXISTS `job_schedule` (
  `areaID` int(20) NOT NULL auto_increment,
  `areaDesc` varchar(50) NOT NULL,
  `Building` enum('Main','Training','Nursing') NOT NULL,
  PRIMARY KEY  (`areaID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=99 ;

--
-- Dumping data for table `job_schedule`
--

INSERT INTO `job_schedule` (`areaID`, `areaDesc`, `Building`) VALUES
(1, 'CR', 'Main'),
(98, 'To', ''),
(97, 'Hi', ''),
(96, 'Helo', ''),
(93, 'Engineering Drawing Lab.', 'Main'),
(92, 'Computer Laboratory 1', 'Training');

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE IF NOT EXISTS `login` (
  `username` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL,
  `userLevel` varchar(40) NOT NULL,
  `timeIn` time NOT NULL,
  `timeOut` time NOT NULL,
  `status` varchar(30) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`username`, `password`, `userLevel`, `timeIn`, `timeOut`, `status`) VALUES
('mikay', 'tizon', 'Admin', '20:43:14', '20:43:05', 'Active'),
('ws', 'mam', 'Adviser', '19:46:37', '15:47:10', 'Active'),
('admin', '12345', 'Admin', '19:42:39', '19:46:10', 'Inactive'),
('malyn', 'bertudazo', 'Admin', '21:54:33', '22:54:03', 'Inactive');

-- --------------------------------------------------------

--
-- Table structure for table `subject`
--

CREATE TABLE IF NOT EXISTS `subject` (
  `SubjNo` int(11) NOT NULL,
  `SubjCode` varchar(50) NOT NULL,
  `SubjDescr` varchar(60) NOT NULL,
  PRIMARY KEY  (`SubjNo`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subject`
--


-- --------------------------------------------------------

--
-- Table structure for table `user_faculty`
--

CREATE TABLE IF NOT EXISTS `user_faculty` (
  `userID` varchar(20) NOT NULL,
  `lastName` varchar(40) NOT NULL,
  `firstName` varchar(60) NOT NULL,
  `mi` varchar(10) NOT NULL,
  `age` varchar(10) NOT NULL,
  `status` varchar(30) NOT NULL,
  `gender` varchar(30) NOT NULL,
  `userType` varchar(40) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_faculty`
--

INSERT INTO `user_faculty` (`userID`, `lastName`, `firstName`, `mi`, `age`, `status`, `gender`, `userType`) VALUES
('1010', 'Bughao', 'Ryan', '', '32', 'Single', 'Female', 'Faculty'),
('123', 'Joscoro', 'Cantero', 'A', '32', 'Single', 'Male', 'Faculty'),
('457', 'Tarre', 'Cheryl', '', '30', 'Married', 'Female', 'Faculty');

-- --------------------------------------------------------

--
-- Table structure for table `user_student`
--

CREATE TABLE IF NOT EXISTS `user_student` (
  `userID` int(20) NOT NULL,
  `lastName` varchar(40) NOT NULL,
  `firstName` varchar(60) NOT NULL,
  `mi` varchar(20) NOT NULL,
  `age` int(20) NOT NULL,
  `status` varchar(20) NOT NULL,
  `gender` varchar(30) NOT NULL,
  `userType` varchar(30) NOT NULL,
  PRIMARY KEY  (`userID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_student`
--

INSERT INTO `user_student` (`userID`, `lastName`, `firstName`, `mi`, `age`, `status`, `gender`, `userType`) VALUES
(444, 'Tizon', 'Mitzi Hazel           ', 'D', 19, 'Single', 'Female           ', 'Student'),
(443, 'Soria', 'Fatima Mae      ', 'G', 19, 'Single', 'Female  ', 'Student'),
(455, 'Bertudazo', 'Romalyn  ', 'B', 19, 'Single', 'Female  ', 'Student');

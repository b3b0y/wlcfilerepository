-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 03, 2015 at 06:21 PM
-- Server version: 5.5.8
-- PHP Version: 5.3.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `repository`
--

-- --------------------------------------------------------

--
-- Table structure for table `fr_course`
--

CREATE TABLE IF NOT EXISTS `fr_course` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `CCode` varchar(50) NOT NULL,
  `CDesc` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `fr_course`
--

INSERT INTO `fr_course` (`id`, `CCode`, `CDesc`) VALUES
(1, 'BSIT', 'Bachelor of Science in Inforamtion Technology'),
(2, 'BSCS', 'Bachelor of Science in Computer Science'),
(3, 'ACT', 'Associate in Computer Technology'),
(4, 'BSCOE', 'Bachelor of Science in Computer Engineering');

-- --------------------------------------------------------

--
-- Table structure for table `fr_folder_owner`
--

CREATE TABLE IF NOT EXISTS `fr_folder_owner` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Fid` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=53 ;

--
-- Dumping data for table `fr_folder_owner`
--

INSERT INTO `fr_folder_owner` (`ID`, `Fid`, `uid`) VALUES
(1, 1, 1),
(20, 11, 2),
(21, 1, 2),
(36, 27, 10),
(46, 36, 18),
(47, 37, 19),
(49, 8, 18),
(50, 38, 25),
(51, 39, 24),
(52, 42, 26);

-- --------------------------------------------------------

--
-- Table structure for table `fr_ins_subject`
--

CREATE TABLE IF NOT EXISTS `fr_ins_subject` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `Course` varchar(100) NOT NULL,
  `Subject` varchar(50) NOT NULL,
  `SubPath` varchar(1000) NOT NULL,
  `Folder_Owner` int(11) NOT NULL,
  `Parent_F` int(11) NOT NULL,
  `Date_Created` date NOT NULL,
  `Time_Created` time NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `fr_ins_subject`
--

INSERT INTO `fr_ins_subject` (`ID`, `uid`, `Course`, `Subject`, `SubPath`, `Folder_Owner`, `Parent_F`, `Date_Created`, `Time_Created`) VALUES
(6, 18, '', 'IT17', 'C:/xampp/htdocs/WLCFileRepoRev/Data/Instructor/Cantero, Joscoro/IT17', 1, 36, '2016-10-15', '22:45:50'),
(7, 18, '', 'IT8', 'C:/xampp/htdocs/WLCFileRepoRev/Data/Instructor/Cantero, Joscoro/IT8', 1, 36, '2016-10-15', '22:45:50'),
(8, 18, '', 'Group', 'C:/xampp/htdocs/WLCFileRepoRev/Data/Instructor/Cantero, Joscoro/IT17/Group', 18, 6, '2015-10-16', '17:20:14');

-- --------------------------------------------------------

--
-- Table structure for table `fr_path`
--

CREATE TABLE IF NOT EXISTS `fr_path` (
  `pathID` int(11) NOT NULL AUTO_INCREMENT,
  `pathName` varchar(1000) NOT NULL,
  `Folder_Name` varchar(100) NOT NULL,
  `Parent_F` int(11) NOT NULL,
  PRIMARY KEY (`pathID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=43 ;

--
-- Dumping data for table `fr_path`
--

INSERT INTO `fr_path` (`pathID`, `pathName`, `Folder_Name`, `Parent_F`) VALUES
(1, 'C:/xampp/htdocs/WLCFileRepoRev/Data', 'Data', 1),
(10, 'C:/xampp/htdocs/WLCFileRepoRev/Data/Dean', 'Dean', 1),
(11, 'C:/xampp/htdocs/WLCFileRepoRev/Data/Dean/Tarre, Cheryl', 'Tarre, Cheryl', 10),
(25, 'C:/xampp/htdocs/WLCFileRepoRev/Data/Student', 'Student', 1),
(26, 'C:/xampp/htdocs/WLCFileRepoRev/Data/Student/BSIT', 'BSIT', 25),
(27, 'C:/xampp/htdocs/WLCFileRepoRev/Data/Student/BSIT/Marapoc-552', 'Marapoc-552', 26),
(35, 'C:/xampp/htdocs/WLCFileRepoRev/Data/Instructor', 'Instructor', 1),
(36, 'C:/xampp/htdocs/WLCFileRepoRev/Data/Instructor/Cantero, Joscoro', 'Cantero, Joscoro', 35),
(37, 'C:/xampp/htdocs/WLCFileRepoRev/Data/Instructor/Marapoc, Leo', 'Marapoc, Leo', 35),
(38, 'C:/xampp/htdocs/WLCFileRepoRev/Data/Student/BSIT/Bertudazo-443', 'Bertudazo-443', 26),
(39, 'C:/xampp/htdocs/WLCFileRepoRev/Data/Student/BSIT/Mancera-445', 'Mancera-445', 26),
(40, 'C:/xampp/htdocs/WLCFileRepoRev/Data/Student', 'Student', 1),
(41, 'C:/xampp/htdocs/WLCFileRepoRev/Data/Student/BSBA', 'BSBA', 25),
(42, 'C:/xampp/htdocs/WLCFileRepoRev/Data/Student/BSBA/Larazzabal-123', 'Larazzabal-123', 41);

-- --------------------------------------------------------

--
-- Table structure for table `fr_rep`
--

CREATE TABLE IF NOT EXISTS `fr_rep` (
  `repID` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `Description` varchar(250) NOT NULL,
  `DateMod` datetime NOT NULL,
  `UserLvl` int(11) NOT NULL,
  PRIMARY KEY (`repID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=115 ;

--
-- Dumping data for table `fr_rep`
--

INSERT INTO `fr_rep` (`repID`, `uid`, `Description`, `DateMod`, `UserLvl`) VALUES
(41, 1, ' Admin Added new Account  Tarre Cheryl', '2016-10-15 13:49:31', 5),
(42, 1, ' Admin Added new Account   ', '2016-10-15 13:49:54', 5),
(43, 2, 'tarre1 Last Log-in ', '2016-10-15 20:01:54', 4),
(44, 1, 'admin Last Log-in ', '2016-10-15 20:12:44', 5),
(45, 2, 'tarre1 Last Log-in ', '2016-10-15 20:13:04', 4),
(46, 2, 'tarre1 is Created a New Folder bb', '2016-10-15 14:14:48', 0),
(47, 1, 'admin is Created a New Folder bb', '2016-10-15 14:23:35', 0),
(48, 2, 'tarre1 is Created a New Folder bb', '2016-10-15 14:40:09', 0),
(49, 2, 'tarre1 is Created a New Folder bb', '2016-10-15 14:43:11', 0),
(50, 2, 'tarre1 is Created a New Folder bb', '2016-10-15 14:45:19', 0),
(51, 2, 'tarre1 is Created a New Folder bb', '2016-10-15 14:48:48', 0),
(52, 1, ' Admin Added new Generated Account  ', '2016-10-15 15:10:01', 5),
(53, 4, 'Leo MarapocAccount has been Activated ', '2016-10-15 21:10:28', 0),
(54, 4, ' Last Log-in ', '2016-10-15 21:10:30', 1),
(55, 1, ' Admin Added new Generated Account  ', '2016-10-15 15:16:37', 5),
(56, 5, 'Leo MarapocAccount has been Activated ', '2016-10-15 21:16:50', 0),
(57, 5, ' Last Log-in ', '2016-10-15 21:16:52', 1),
(58, 1, ' Admin Added new Generated Account  ', '2016-10-15 15:22:20', 5),
(59, 6, 'Leo MarapocAccount has been Activated ', '2016-10-15 21:23:36', 0),
(60, 6, ' Last Log-in ', '2016-10-15 21:23:41', 1),
(61, 1, ' Admin Added new Generated Account  ', '2016-10-15 15:25:12', 5),
(62, 7, 'Leo MarapocAccount has been Activated ', '2016-10-15 21:25:27', 0),
(63, 7, ' Last Log-in ', '2016-10-15 21:26:05', 1),
(64, 1, ' Admin Added new Generated Account  ', '2016-10-15 15:27:10', 5),
(65, 8, 'Leo MarapocAccount has been Activated ', '2016-10-15 21:27:38', 0),
(66, 8, ' Last Log-in ', '2016-10-15 21:27:40', 1),
(67, 1, ' Admin Added new Generated Account  ', '2016-10-15 15:28:34', 5),
(68, 9, 'Leo MarapocAccount has been Activated ', '2016-10-15 21:28:47', 0),
(69, 9, ' Last Log-in ', '2016-10-15 21:29:25', 1),
(70, 1, 'admin Last Log-in ', '2016-10-15 21:30:28', 5),
(71, 1, ' Admin Added new Generated Account  ', '2016-10-15 15:30:51', 5),
(72, 10, 'Leo MarapocAccount has been Activated ', '2016-10-15 21:31:05', 0),
(73, 10, ' Last Log-in ', '2016-10-15 21:31:06', 1),
(74, 10, 'marapoc is Created a New Folder aaa', '2016-10-15 15:31:36', 0),
(75, 10, 'marapoc is Created a New Folder aaa', '2016-10-15 16:02:25', 0),
(76, 2, 'tarre1 Last Log-in ', '2016-10-15 22:08:50', 4),
(77, 2, 'tarre1 Last Log-in ', '2016-10-15 22:11:57', 4),
(78, 1, 'admin Last Log-in ', '2016-10-15 22:13:40', 5),
(79, 1, ' Admin Added new Account   ', '2016-10-15 16:15:09', 5),
(80, 1, ' Admin Added new Account  Cantero Joscoro', '2016-10-15 16:23:29', 5),
(81, 2, 'Cheryl Tarre Added new Account  marapoc Leo', '2016-10-15 16:24:39', 4),
(82, 2, 'Cheryl Tarre Added new Account   ', '2016-10-15 16:24:46', 4),
(83, 1, ' Admin Added new Account   ', '2016-10-15 16:27:03', 5),
(84, 1, ' Admin Added new Account  Cantero Joscoro', '2016-10-15 16:29:34', 5),
(85, 1, ' Admin Added new Account   ', '2016-10-15 16:29:46', 5),
(86, 1, ' Admin Added new Account  Cantero Joscoro', '2016-10-15 16:37:30', 5),
(87, 2, 'Cheryl Tarre Added new Account  Marapoc Leo', '2016-10-15 16:40:02', 4),
(88, 10, 'marapoc Last Log-in ', '2016-10-15 22:46:19', 1),
(89, 18, 'cantero Last Log-in ', '2016-10-15 22:46:38', 3),
(90, 18, 'cantero is Created a New Folder BSIT', '2016-10-15 16:46:45', 0),
(91, 18, 'cantero Last Log-in ', '2016-10-15 22:49:21', 3),
(92, 18, 'cantero Last Log-in ', '2018-10-15 20:51:02', 3),
(93, 18, 'cantero Last Log-in ', '2027-10-15 00:33:40', 3),
(94, 1, 'admin Last Log-in ', '2027-10-15 00:35:57', 5),
(95, 18, 'cantero Last Log-in ', '2027-10-15 00:54:16', 3),
(96, 1, ' Admin Added new Generated Account  ', '2026-10-15 19:24:53', 5),
(97, 1, 'admin Last Log-in ', '2031-10-15 15:16:30', 5),
(98, 18, 'cantero Last Log-in ', '2031-10-15 15:43:06', 3),
(99, 18, 'cantero Last Log-in ', '2031-10-15 15:46:39', 3),
(100, 25, 'Romalyn BertudazoAccount has been Activated ', '2031-10-15 16:06:02', 0),
(101, 25, ' Last Log-in ', '2031-10-15 16:06:03', 1),
(102, 10, 'marapoc Last Log-in ', '2031-10-15 16:08:23', 1),
(103, 18, 'cantero Last Log-in ', '2031-10-15 16:16:41', 3),
(104, 10, 'marapoc Last Log-in ', '2031-10-15 16:17:15', 1),
(105, 25, 'romalyn Last Log-in ', '2031-10-15 16:18:28', 1),
(106, 24, 'Sheila ManceraAccount has been Activated ', '2031-10-15 16:19:57', 0),
(107, 24, ' Last Log-in ', '2031-10-15 16:19:59', 1),
(108, 18, 'cantero Last Log-in ', '2031-10-15 16:20:33', 3),
(109, 18, 'cantero Last Log-in ', '2031-10-15 18:52:33', 3),
(110, 26, 'Trina LarazzabalAccount has been Activated ', '2031-10-15 18:53:27', 0),
(111, 26, ' Last Log-in ', '2031-10-15 18:53:28', 1),
(112, 1, 'admin Last Log-in ', '2031-10-15 19:46:38', 5),
(113, 26, 'tambok Last Log-in ', '2031-10-15 19:46:55', 1),
(114, 25, 'romalyn Last Log-in ', '2031-10-15 19:47:08', 1);

-- --------------------------------------------------------

--
-- Table structure for table `fr_share_folder`
--

CREATE TABLE IF NOT EXISTS `fr_share_folder` (
  `shareID` int(11) NOT NULL AUTO_INCREMENT,
  `studID` int(11) NOT NULL,
  `Sub_Name` varchar(100) NOT NULL,
  `Folder_Name` varchar(1000) NOT NULL,
  `subID` int(11) NOT NULL,
  `Folder_Owner` int(11) NOT NULL,
  `Date_Created` date NOT NULL,
  `Time_Created` time NOT NULL,
  PRIMARY KEY (`shareID`),
  UNIQUE KEY `studID` (`studID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `fr_share_folder`
--

INSERT INTO `fr_share_folder` (`shareID`, `studID`, `Sub_Name`, `Folder_Name`, `subID`, `Folder_Owner`, `Date_Created`, `Time_Created`) VALUES
(1, 10, 'IT17-Group', 'Group', 6, 18, '2015-10-31', '16:01:22'),
(10, 25, 'IT17-Group', 'Group', 6, 18, '2015-10-31', '16:17:39'),
(13, 24, 'IT17-Group', 'Group', 6, 18, '2015-10-31', '16:21:05');

-- --------------------------------------------------------

--
-- Table structure for table `fr_staff`
--

CREATE TABLE IF NOT EXISTS `fr_staff` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `FirstN` varchar(50) NOT NULL,
  `LastN` varchar(50) NOT NULL,
  `midN` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `fr_staff`
--

INSERT INTO `fr_staff` (`id`, `uid`, `FirstN`, `LastN`, `midN`) VALUES
(1, 1, '', 'Admin', ''),
(7, 2, 'Cheryl', 'Tarre', ''),
(8, 18, 'Joscoro', 'Cantero', '');

-- --------------------------------------------------------

--
-- Table structure for table `fr_stud`
--

CREATE TABLE IF NOT EXISTS `fr_stud` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `ControlNo` int(11) NOT NULL,
  `FName` varchar(50) NOT NULL,
  `LName` varchar(50) NOT NULL,
  `Mname` varchar(50) NOT NULL,
  `Course` varchar(30) NOT NULL,
  `Year` varchar(30) NOT NULL,
  `size` int(11) NOT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `ControlNo` (`ControlNo`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=23 ;

--
-- Dumping data for table `fr_stud`
--

INSERT INTO `fr_stud` (`ID`, `uid`, `ControlNo`, `FName`, `LName`, `Mname`, `Course`, `Year`, `size`) VALUES
(9, 10, 552, 'Leo', 'Marapoc', '', 'BSIT', '4th Year', 0),
(17, 24, 445, 'Sheila', 'Mancera', '', 'BSIT', '4th Year', 0),
(18, 25, 443, 'Romalyn', 'Bertudazo', '', 'BSIT', '4th Year', 0),
(22, 26, 123, 'Trina', 'Larazzabal', '', 'BSBA', '3rd Year', 0);

-- --------------------------------------------------------

--
-- Table structure for table `fr_stud_subject`
--

CREATE TABLE IF NOT EXISTS `fr_stud_subject` (
  `sID` int(11) NOT NULL AUTO_INCREMENT,
  `studID` int(11) NOT NULL,
  `Folder_Name` varchar(1000) NOT NULL,
  `SubPath` varchar(1000) NOT NULL,
  `subID` int(11) NOT NULL,
  `Date_Created` date NOT NULL,
  `Time_Created` time NOT NULL,
  `status` enum('APPROVED','DISAPPROVED') NOT NULL,
  PRIMARY KEY (`sID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `fr_stud_subject`
--

INSERT INTO `fr_stud_subject` (`sID`, `studID`, `Folder_Name`, `SubPath`, `subID`, `Date_Created`, `Time_Created`, `status`) VALUES
(3, 10, '552-Marapoc-IT17', 'C:/xampp/htdocs/WLCFileRepoRev/Data/Instructor/Cantero, Joscoro/IT17/552-Marapoc-IT17', 6, '2015-10-16', '22:50:23', 'APPROVED'),
(4, 25, '443-Bertudazo-IT17', 'C:/xampp/htdocs/WLCFileRepoRev/Data/Instructor/Cantero, Joscoro/IT17/443-Bertudazo-IT17', 6, '2015-10-31', '16:16:51', 'APPROVED'),
(5, 24, '445-Mancera-IT17', 'C:/xampp/htdocs/WLCFileRepoRev/Data/Instructor/Cantero, Joscoro/IT17/445-Mancera-IT17', 6, '2015-10-31', '16:20:56', 'APPROVED'),
(6, 26, '123-Larazzabal-IT17', 'C:/xampp/htdocs/WLCFileRepoRev/Data/Instructor/Cantero, Joscoro/IT17/123-Larazzabal-IT17', 6, '2015-10-31', '19:28:50', 'APPROVED'),
(7, 26, '123-Larazzabal-IT8', 'C:/xampp/htdocs/WLCFileRepoRev/Data/Instructor/Cantero, Joscoro/IT8/123-Larazzabal-IT8', 7, '2015-10-31', '19:29:45', 'APPROVED'),
(8, 25, '443-Bertudazo-IT8', 'C:/xampp/htdocs/WLCFileRepoRev/Data/Instructor/Cantero, Joscoro/IT8/443-Bertudazo-IT8', 7, '0000-00-00', '00:00:00', 'DISAPPROVED');

-- --------------------------------------------------------

--
-- Table structure for table `fr_subject`
--

CREATE TABLE IF NOT EXISTS `fr_subject` (
  `subID` int(11) NOT NULL AUTO_INCREMENT,
  `SubCode` varchar(250) NOT NULL,
  `Description` varchar(500) NOT NULL,
  `status` enum('ASSIGNED','NOT ASSIGNED') NOT NULL DEFAULT 'NOT ASSIGNED',
  PRIMARY KEY (`subID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `fr_subject`
--

INSERT INTO `fr_subject` (`subID`, `SubCode`, `Description`, `status`) VALUES
(1, 'IT17', 'Information Security System', 'ASSIGNED'),
(2, 'IT8', 'Operating System', 'ASSIGNED'),
(3, 'IT5', 'Computer Fundamentals', 'NOT ASSIGNED'),
(4, 'IT 12', 'Modeling & Simulation', 'NOT ASSIGNED');

-- --------------------------------------------------------

--
-- Table structure for table `fr_user`
--

CREATE TABLE IF NOT EXISTS `fr_user` (
  `UserID` int(11) NOT NULL AUTO_INCREMENT,
  `UserName` varchar(20) NOT NULL,
  `UserPass` varchar(20) NOT NULL,
  `UserLvl` enum('1','2','3','4','5') NOT NULL,
  `last_login_date` datetime NOT NULL,
  `last_logout_date` datetime NOT NULL,
  `activate` int(11) NOT NULL DEFAULT '1',
  `UserStat` enum('live','pending','offline') NOT NULL DEFAULT 'pending',
  PRIMARY KEY (`UserID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=27 ;

--
-- Dumping data for table `fr_user`
--

INSERT INTO `fr_user` (`UserID`, `UserName`, `UserPass`, `UserLvl`, `last_login_date`, `last_logout_date`, `activate`, `UserStat`) VALUES
(1, 'admin', '12345', '5', '2015-10-31 07:46:38', '2015-10-31 07:46:46', 1, 'offline'),
(2, 'tarre1', '12345', '4', '2015-10-16 10:11:57', '2015-10-16 10:46:14', 1, 'offline'),
(10, 'marapoc', '12345', '1', '2015-10-31 04:17:14', '2015-10-31 04:20:29', 1, 'offline'),
(18, 'cantero', '12345', '3', '2015-10-31 06:52:33', '2015-10-31 04:18:24', 1, 'live'),
(19, 'leo123', '12345', '3', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'offline'),
(24, 'sheila', '12345', '1', '2015-10-31 04:19:59', '2015-10-31 06:52:15', 1, 'offline'),
(25, 'romalyn', '12345', '1', '2015-10-31 07:47:08', '2015-10-31 04:19:31', 1, 'live'),
(26, 'Tambok', '12345', '1', '2015-10-31 07:46:55', '2015-10-31 07:46:59', 1, 'offline');

-- --------------------------------------------------------

--
-- Table structure for table `fr_user_permissions`
--

CREATE TABLE IF NOT EXISTS `fr_user_permissions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `upload` int(11) NOT NULL,
  `download` int(11) NOT NULL,
  `download_folders` int(11) NOT NULL,
  `create_folders` int(11) NOT NULL,
  `share` int(11) NOT NULL,
  `change_pass` int(11) NOT NULL,
  `rename_F` int(11) NOT NULL,
  `delete_F` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=25 ;

--
-- Dumping data for table `fr_user_permissions`
--

INSERT INTO `fr_user_permissions` (`id`, `uid`, `upload`, `download`, `download_folders`, `create_folders`, `share`, `change_pass`, `rename_F`, `delete_F`) VALUES
(1, 1, 1, 1, 1, 1, 1, 1, 0, 0),
(9, 2, 1, 1, 1, 0, 0, 1, 0, 0),
(16, 10, 1, 1, 1, 0, 0, 1, 0, 0),
(20, 18, 1, 1, 1, 0, 0, 1, 0, 0),
(21, 19, 1, 1, 1, 0, 0, 1, 0, 0),
(22, 25, 1, 1, 1, 0, 0, 1, 0, 0),
(23, 24, 1, 1, 1, 0, 0, 1, 0, 0),
(24, 26, 1, 1, 1, 0, 0, 1, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

CREATE TABLE IF NOT EXISTS `notification` (
  `not_id` int(11) NOT NULL AUTO_INCREMENT,
  `notification` varchar(500) NOT NULL,
  PRIMARY KEY (`not_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `notification`
--


-- --------------------------------------------------------

--
-- Table structure for table `position`
--

CREATE TABLE IF NOT EXISTS `position` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Position` varchar(50) NOT NULL,
  `UserLvl` int(11) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `position`
--

INSERT INTO `position` (`ID`, `Position`, `UserLvl`) VALUES
(1, 'admin', 5),
(2, 'Dean', 4),
(3, 'Instructor', 3),
(4, 'Working', 2),
(5, 'Student', 1);

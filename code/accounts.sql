-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jun 16, 2021 at 07:15 AM
-- Server version: 5.7.31
-- PHP Version: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `accounts`
--

DELIMITER $$
--
-- Procedures
--
DROP PROCEDURE IF EXISTS `add_pc_cl`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `add_pc_cl` ()  begin
		UPDATE Credit_Debit
		SET Credit_Debit.Amount=(Select Credit_Debit.Amount From Credit_Debit where Credit_Debit.ID=User.ID and User.ID=Service.takerID and Service.Service_ID=Payment.Service_ID) + (Select Price From Service where User.ID=Service.takerID) ;
        
    end$$

DROP PROCEDURE IF EXISTS `change_ver_cl`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `change_ver_cl` ()  begin
		UPDATE Payment
		SET credit_debit.Amount=(Select credit_debit.Amount From credit_debit where credit_debit.ID=user.ID and user.ID=service.takerID and service.Service_ID=payment.Service_ID) + (Select Price From service where user.ID=service.takerID) ;
        
    end$$

DROP PROCEDURE IF EXISTS `change_ver_cr`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `change_ver_cr` ()  begin
		UPDATE Payment
		SET Payment.verif_cr=""; 
        
    end$$

DROP PROCEDURE IF EXISTS `remove_pc_cr`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `remove_pc_cr` ()  begin
		UPDATE Credit_Debit
		SET Credit_Debit.Amount=(Select Credit_Debit.Amount From Credit_Debit where Credit_Debit.ID=User.ID and Payment.ID=User.ID and Service.Service_ID=Payment.Service_ID) - (Select Price From Service where Service.Service_ID=Payment.Service_ID and Payment.ID=User.ID) ;
        
    end$$

DROP PROCEDURE IF EXISTS `search_res`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `search_res` ()  begin
		SELECT  *
		FROM    Service
		WHERE   Service_Interests.Interests COLLATE UTF8_GENERAL_CI LIKE User.Interests and  Service_Interests.Service_ID=Service.Service_ID;
	
    end$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `bonds`
--

DROP TABLE IF EXISTS `bonds`;
CREATE TABLE IF NOT EXISTS `bonds` (
  `requested` varchar(3) DEFAULT 'NO',
  `accepted` varchar(3) DEFAULT 'NO',
  `friends` varchar(3) NOT NULL DEFAULT 'NO',
  `ID` int(11) NOT NULL,
  `requestingID` int(11) DEFAULT NULL,
  KEY `ID` (`ID`),
  KEY `requestingID` (`requestingID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bonds`
--

INSERT INTO `bonds` (`requested`, `accepted`, `friends`, `ID`, `requestingID`) VALUES
('NO', 'NO', 'NO', 34, NULL),
('NO', 'NO', 'NO', 35, NULL),
('NO', 'NO', 'NO', 36, NULL),
('NO', 'NO', 'NO', 37, NULL),
('NO', 'NO', 'NO', 39, NULL),
('NO', 'NO', 'NO', 40, NULL),
('YES', 'NO', 'NO', 37, 40),
('YES', 'YES', 'YES', 36, 40),
('YES', 'YES', 'YES', 35, 40),
('YES', 'YES', 'YES', 39, 40);

-- --------------------------------------------------------

--
-- Table structure for table `credit_debit`
--

DROP TABLE IF EXISTS `credit_debit`;
CREATE TABLE IF NOT EXISTS `credit_debit` (
  `Amount` int(12) NOT NULL DEFAULT '10000000',
  `CVV_CV2` int(3) DEFAULT NULL,
  `MM` int(2) DEFAULT NULL,
  `YY` int(2) DEFAULT NULL,
  `ID` int(11) NOT NULL,
  `Card_Number` varchar(16) NOT NULL,
  KEY `ID` (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `credit_debit`
--

INSERT INTO `credit_debit` (`Amount`, `CVV_CV2`, `MM`, `YY`, `ID`, `Card_Number`) VALUES
(10000000, 434, 11, 11, 37, '53534535'),
(10000000, 222, 11, 11, 36, '0'),
(10000000, 111, 11, 11, 38, '131313131'),
(10000000, 112, 11, 11, 39, '424242424'),
(10000000, 343, 11, 45, 40, '45353535'),
(10000000, 532, 4, 34, 34, '535342431313'),
(10000000, 111, 11, 11, 35, '242424242');

-- --------------------------------------------------------

--
-- Table structure for table `list_appl`
--

DROP TABLE IF EXISTS `list_appl`;
CREATE TABLE IF NOT EXISTS `list_appl` (
  `ID` int(11) NOT NULL,
  `Service_ID` int(11) NOT NULL,
  `Applied` varchar(3) NOT NULL DEFAULT 'No',
  PRIMARY KEY (`ID`,`Service_ID`),
  KEY `Service_ID` (`Service_ID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `list_appl`
--

INSERT INTO `list_appl` (`ID`, `Service_ID`, `Applied`) VALUES
(40, 30, 'Yes'),
(40, 36, 'Yes'),
(40, 33, 'Yes');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

DROP TABLE IF EXISTS `messages`;
CREATE TABLE IF NOT EXISTS `messages` (
  `time_s` datetime NOT NULL,
  `Message` varchar(1000) NOT NULL,
  `ID` int(11) NOT NULL,
  `senderID` int(11) NOT NULL,
  PRIMARY KEY (`time_s`),
  KEY `ID` (`ID`),
  KEY `senderID` (`senderID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`time_s`, `Message`, `ID`, `senderID`) VALUES
('2021-06-16 02:24:32', 'cpo ben', 40, 35),
('2021-06-16 02:25:16', 'ja rrijme bejme projekte', 35, 40),
('2021-06-16 02:21:59', 'hiiiiiiiiiiiiiii', 40, 35),
('2021-06-16 02:24:05', 'hiiiiii!?', 35, 40);

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

DROP TABLE IF EXISTS `payment`;
CREATE TABLE IF NOT EXISTS `payment` (
  `verif_cr` varchar(3) NOT NULL DEFAULT 'NO',
  `verif_cl` varchar(3) NOT NULL DEFAULT 'NO',
  `complet` varchar(11) NOT NULL DEFAULT 'UNCOMPLETED',
  `Service_ID` int(11) NOT NULL,
  `ID` int(11) NOT NULL,
  PRIMARY KEY (`Service_ID`,`ID`),
  KEY `ID` (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `rating`
--

DROP TABLE IF EXISTS `rating`;
CREATE TABLE IF NOT EXISTS `rating` (
  `Rating` int(11) NOT NULL,
  `Feedback` varchar(300) NOT NULL,
  `ID` int(11) NOT NULL,
  `Service_ID` int(11) NOT NULL,
  PRIMARY KEY (`ID`,`Service_ID`),
  KEY `Service_ID` (`Service_ID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `service`
--

DROP TABLE IF EXISTS `service`;
CREATE TABLE IF NOT EXISTS `service` (
  `Description` varchar(200) NOT NULL,
  `Location` varchar(30) NOT NULL,
  `Report` varchar(400) DEFAULT NULL,
  `Service_ID` int(11) NOT NULL AUTO_INCREMENT,
  `Titles` varchar(25) NOT NULL,
  `Time_created` datetime DEFAULT NULL,
  `Time_ended` datetime DEFAULT NULL,
  `Price` int(12) NOT NULL,
  `ID` int(11) NOT NULL,
  `takerID` int(11) DEFAULT NULL,
  `type_j_s` varchar(7) NOT NULL,
  `type_cash_cd` varchar(6) NOT NULL,
  PRIMARY KEY (`Service_ID`),
  KEY `ID` (`ID`),
  KEY `takerID` (`takerID`)
) ENGINE=MyISAM AUTO_INCREMENT=37 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `service`
--

INSERT INTO `service` (`Description`, `Location`, `Report`, `Service_ID`, `Titles`, `Time_created`, `Time_ended`, `Price`, `ID`, `takerID`, `type_j_s`, `type_cash_cd`) VALUES
('1 kile ulli ....', 'durres', NULL, 32, 'groceries', '2021-06-15 00:06:51', NULL, 45, 35, NULL, 'service', 'cd'),
('lonely and hungry, bring snacks', 'tirane', NULL, 31, 'company', '2021-06-14 23:54:43', NULL, 69, 35, NULL, 'service', 'cash'),
('tule dhjam', 'has', NULL, 35, 'buk me gjiz', '2021-06-15 18:12:07', NULL, 3, 40, NULL, 'service', 'cash'),
('This is a test post, do not take this seriously', 'test', NULL, 33, 'test', '2021-06-15 04:29:29', NULL, 476, 40, NULL, 'service', 'cd'),
('This is a test post, do not take this seriously', 'tirane', NULL, 34, 'second test', '2021-06-15 05:19:27', NULL, 69, 40, NULL, 'service', 'cash'),
('this a service', 'tirane', NULL, 30, 'haha', '2021-06-14 16:24:09', NULL, 3434, 37, NULL, 'service', 'cd'),
('better and salty', 'durres', NULL, 36, 'buk e djath', '2021-06-15 18:21:51', NULL, 65, 40, NULL, 'job', 'cash');

-- --------------------------------------------------------

--
-- Table structure for table `service_interests`
--

DROP TABLE IF EXISTS `service_interests`;
CREATE TABLE IF NOT EXISTS `service_interests` (
  `Interests` varchar(50) NOT NULL,
  `Service_ID` int(11) NOT NULL,
  PRIMARY KEY (`Interests`,`Service_ID`),
  KEY `Service_ID` (`Service_ID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `Last_Name` varchar(40) NOT NULL,
  `First_Name` varchar(40) NOT NULL,
  `Email` varchar(40) NOT NULL,
  `Phone_Nr` varchar(15) NOT NULL,
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Password` varchar(50) NOT NULL,
  `Status` varchar(8) NOT NULL DEFAULT 'Inactive',
  `Bio` varchar(250) DEFAULT NULL,
  `Joined_date` datetime DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=41 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`Last_Name`, `First_Name`, `Email`, `Phone_Nr`, `ID`, `Password`, `Status`, `Bio`, `Joined_date`) VALUES
('me', 'test', 'testme@gmail.com', '7567', 40, '098f6bcd4621d373cade4e832627b4f6', 'Inactive', 'this account is a test', '2021-06-15 03:53:36'),
('Ndokaj', 'Emiljan', 'endokaj18@epoka.edu.al', '0694522039', 34, 'd41d8cd98f00b204e9800998ecf8427e', 'Inactive', 'Don\'t judge a fish by the ability to climb a tree', '2021-06-13 22:43:40'),
('sholli', 'ina', 'isholli18@epoka.edu.al', '25615611', 35, '9cdfb439c7876e703e307864c9167a15', 'Inactive', 'Here for fun', '2021-06-14 01:27:44'),
('marku', 'elion', 'emarku18@epoka.edu.al', '655561', 36, 'd41d8cd98f00b204e9800998ecf8427e', 'Inactive', 'Hi all it\'s me , ya boi ....', '2021-06-14 02:04:54'),
('duka', 'enxhi', 'eduka18@epoka.edu.al', '2166515', 37, 'd41d8cd98f00b204e9800998ecf8427e', 'Active', 'CHILE so anyways soo.......', '2021-06-14 03:27:32'),
('lala', 'arber', 'ala@epoka.com', '265262', 39, '9cdfb439c7876e703e307864c9167a15', 'Inactive', 'Life is a jumper that you need to knit yourself .', '2021-06-14 16:27:10');

-- --------------------------------------------------------

--
-- Table structure for table `user_interests`
--

DROP TABLE IF EXISTS `user_interests`;
CREATE TABLE IF NOT EXISTS `user_interests` (
  `Interests` varchar(50) NOT NULL,
  `ID` int(11) NOT NULL,
  PRIMARY KEY (`Interests`,`ID`),
  KEY `ID` (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

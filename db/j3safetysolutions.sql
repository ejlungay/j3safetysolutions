-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 10, 2016 at 07:47 AM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `j3safetysolutions`
--

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE IF NOT EXISTS `course` (
  `course_id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) DEFAULT NULL,
  `course_name` varchar(200) DEFAULT NULL,
  `date_added` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`course_id`),
  KEY `fk_course_to_user_id_idx` (`uid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`course_id`, `uid`, `course_name`, `date_added`) VALUES
(1, 1, 'BOSH-COSH', '2016-02-10 11:58:40');

-- --------------------------------------------------------

--
-- Table structure for table `delegates`
--

CREATE TABLE IF NOT EXISTS `delegates` (
  `delegate_id` int(11) NOT NULL AUTO_INCREMENT,
  `training_id` int(11) DEFAULT NULL,
  `firstname` varchar(50) DEFAULT NULL,
  `middlename` varchar(50) DEFAULT NULL,
  `lastname` varchar(50) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `company` varchar(200) DEFAULT NULL,
  `company_position` varchar(50) DEFAULT NULL,
  `image` blob,
  PRIMARY KEY (`delegate_id`),
  KEY `fk_delegate_training_id_idx` (`training_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `delegates`
--

INSERT INTO `delegates` (`delegate_id`, `training_id`, `firstname`, `middlename`, `lastname`, `email`, `phone`, `company`, `company_position`, `image`) VALUES
(2, 3, 'Tae jon', 'GOvi', 'lungay', 'eltonjonlungay@gmail.com', '09367133136', 'j3safetysolutions', 'OJT', 0x6e756c6c),
(3, 3, 'Elton Jon', 'GOvi', 'lungay', 'eltonjonlungay@gmail.com', '09367133136', 'j3safetysolutions', 'OJT', 0x6e756c6c);

-- --------------------------------------------------------

--
-- Table structure for table `speakers`
--

CREATE TABLE IF NOT EXISTS `speakers` (
  `speaker_id` int(11) NOT NULL AUTO_INCREMENT,
  `training_id` int(11) DEFAULT NULL,
  `firstname` varchar(50) DEFAULT NULL,
  `middlename` varchar(50) DEFAULT NULL,
  `lastname` varchar(50) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `company` varchar(200) DEFAULT NULL,
  `company_position` varchar(200) DEFAULT NULL,
  `image` blob,
  PRIMARY KEY (`speaker_id`),
  KEY `fk_speaker_training_id_idx` (`training_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `speakers`
--

INSERT INTO `speakers` (`speaker_id`, `training_id`, `firstname`, `middlename`, `lastname`, `email`, `phone`, `company`, `company_position`, `image`) VALUES
(2, 3, 'Tae jon', 'GOvi', 'lungay', 'eltonjonlungay@gmail.com', '09367133136', 'j3safetysolutions', 'OJT', 0x6e756c6c);

-- --------------------------------------------------------

--
-- Table structure for table `trainings`
--

CREATE TABLE IF NOT EXISTS `trainings` (
  `training_id` int(11) NOT NULL AUTO_INCREMENT,
  `course_id` int(11) DEFAULT NULL,
  `date` datetime DEFAULT CURRENT_TIMESTAMP,
  `location` varchar(200) DEFAULT NULL,
  `fee` double DEFAULT NULL,
  PRIMARY KEY (`training_id`),
  KEY `fk_trainings_course_id_idx` (`course_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `trainings`
--

INSERT INTO `trainings` (`training_id`, `course_id`, `date`, `location`, `fee`) VALUES
(3, 1, '2016-02-10 13:58:55', 'tae mo', 62712);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `uid` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(200) DEFAULT NULL,
  `firstname` varchar(50) DEFAULT NULL,
  `middlename` varchar(50) DEFAULT NULL,
  `lastname` varchar(50) DEFAULT NULL,
  `image` mediumblob,
  `user_type` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`uid`, `username`, `password`, `firstname`, `middlename`, `lastname`, `image`, `user_type`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'Ej', 'Govino', 'Lungay', NULL, 'admin');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `course`
--
ALTER TABLE `course`
  ADD CONSTRAINT `fk_course_to_user_id` FOREIGN KEY (`uid`) REFERENCES `users` (`uid`);

--
-- Constraints for table `delegates`
--
ALTER TABLE `delegates`
  ADD CONSTRAINT `fk_delegate_training_id` FOREIGN KEY (`training_id`) REFERENCES `trainings` (`training_id`);

--
-- Constraints for table `speakers`
--
ALTER TABLE `speakers`
  ADD CONSTRAINT `fk_speaker_training_id` FOREIGN KEY (`training_id`) REFERENCES `trainings` (`training_id`);

--
-- Constraints for table `trainings`
--
ALTER TABLE `trainings`
  ADD CONSTRAINT `fk_trainings_course_id` FOREIGN KEY (`course_id`) REFERENCES `course` (`course_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

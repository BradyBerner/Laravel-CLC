-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Feb 15, 2019 at 03:37 AM
-- Server version: 5.7.21
-- PHP Version: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `laravelCLC`
--

-- --------------------------------------------------------

--
-- Table structure for table `ADDRESS`
--

CREATE TABLE `ADDRESS` (
  `IDADDRESS` int(11) NOT NULL,
  `STREET` varchar(45) DEFAULT NULL,
  `CITY` varchar(45) DEFAULT NULL,
  `STATE` varchar(45) DEFAULT NULL,
  `ZIP` varchar(45) DEFAULT NULL,
  `USERS_IDUSERS` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ADDRESS`
--

INSERT INTO `ADDRESS` (`IDADDRESS`, `STREET`, `CITY`, `STATE`, `ZIP`, `USERS_IDUSERS`) VALUES
(1, 'test', 'Loveland', 'Colorado', '80537', 1),
(3, 'example', 'City', 'State', '0987', 10),
(4, NULL, NULL, NULL, NULL, 11);

-- --------------------------------------------------------

--
-- Table structure for table `EDUCATION`
--

CREATE TABLE `EDUCATION` (
  `IDEDUCATION` int(11) NOT NULL,
  `DEGREE` varchar(45) NOT NULL,
  `FIELD` varchar(45) NOT NULL,
  `GPA` float NOT NULL,
  `STARTYEAR` int(11) NOT NULL,
  `ENDYEAR` int(11) NOT NULL,
  `USERS_IDUSERS` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `EXPERIENCE`
--

CREATE TABLE `EXPERIENCE` (
  `IDEXPERIENCE` int(11) NOT NULL,
  `TITLE` varchar(45) NOT NULL,
  `COMPANY` varchar(45) NOT NULL,
  `CURRENT` varchar(45) NOT NULL,
  `STARTYEAR` varchar(45) NOT NULL,
  `ENDYEAR` varchar(45) DEFAULT NULL,
  `DESCRIPTION` varchar(45) DEFAULT NULL,
  `USERS_IDUSERS` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `JOBS`
--

CREATE TABLE `JOBS` (
  `IDJOBS` int(11) NOT NULL,
  `TITLE` varchar(45) NOT NULL,
  `COMPANY` varchar(45) NOT NULL,
  `STATE` varchar(45) NOT NULL,
  `CITY` varchar(45) NOT NULL,
  `DESCRIPTION` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `USERS`
--

CREATE TABLE `USERS` (
  `IDUSERS` int(11) NOT NULL,
  `USERNAME` varchar(100) NOT NULL,
  `PASSWORD` varchar(100) NOT NULL,
  `EMAIL` varchar(100) NOT NULL,
  `FIRSTNAME` varchar(100) NOT NULL,
  `LASTNAME` varchar(100) NOT NULL,
  `STATUS` int(11) NOT NULL DEFAULT '1',
  `ROLE` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `USERS`
--

INSERT INTO `USERS` (`IDUSERS`, `USERNAME`, `PASSWORD`, `EMAIL`, `FIRSTNAME`, `LASTNAME`, `STATUS`, `ROLE`) VALUES
(1, 'tester', 'testing', 'tester@testing.test', 'Brady', 'Berner', 1, 1),
(10, 'test', 'test', 'test@test.test', 'test', 'test', 1, 0),
(11, 'testing', 'testing', 'test@test.test', 'testing', 'testing', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `USER_INFO`
--

CREATE TABLE `USER_INFO` (
  `IDUSER_INFO` int(11) NOT NULL,
  `DESCRIPTION` mediumtext,
  `PHONE` varchar(45) DEFAULT NULL,
  `AGE` int(11) DEFAULT NULL,
  `GENDER` varchar(45) DEFAULT NULL,
  `USERS_IDUSERS` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `USER_INFO`
--

INSERT INTO `USER_INFO` (`IDUSER_INFO`, `DESCRIPTION`, `PHONE`, `AGE`, `GENDER`, `USERS_IDUSERS`) VALUES
(3, 'this is an admin account for testing', '4441115555', 19, 'Male', 1),
(5, 'this is just a test user', '123985', 12, 'Female', 10),
(6, NULL, NULL, NULL, NULL, 11);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ADDRESS`
--
ALTER TABLE `ADDRESS`
  ADD PRIMARY KEY (`IDADDRESS`),
  ADD KEY `fk_ADDRESS_USERS_idx` (`USERS_IDUSERS`);

--
-- Indexes for table `EDUCATION`
--
ALTER TABLE `EDUCATION`
  ADD PRIMARY KEY (`IDEDUCATION`),
  ADD KEY `fk_EDUCATION_USERS1_idx` (`USERS_IDUSERS`);

--
-- Indexes for table `EXPERIENCE`
--
ALTER TABLE `EXPERIENCE`
  ADD PRIMARY KEY (`IDEXPERIENCE`),
  ADD KEY `fk_EXPERIENCE_USERS1_idx` (`USERS_IDUSERS`);

--
-- Indexes for table `JOBS`
--
ALTER TABLE `JOBS`
  ADD PRIMARY KEY (`IDJOBS`);

--
-- Indexes for table `USERS`
--
ALTER TABLE `USERS`
  ADD PRIMARY KEY (`IDUSERS`);

--
-- Indexes for table `USER_INFO`
--
ALTER TABLE `USER_INFO`
  ADD PRIMARY KEY (`IDUSER_INFO`),
  ADD KEY `fk_USER_INFO_USERS1_idx` (`USERS_IDUSERS`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ADDRESS`
--
ALTER TABLE `ADDRESS`
  MODIFY `IDADDRESS` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `EDUCATION`
--
ALTER TABLE `EDUCATION`
  MODIFY `IDEDUCATION` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `EXPERIENCE`
--
ALTER TABLE `EXPERIENCE`
  MODIFY `IDEXPERIENCE` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `JOBS`
--
ALTER TABLE `JOBS`
  MODIFY `IDJOBS` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `USERS`
--
ALTER TABLE `USERS`
  MODIFY `IDUSERS` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `USER_INFO`
--
ALTER TABLE `USER_INFO`
  MODIFY `IDUSER_INFO` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `ADDRESS`
--
ALTER TABLE `ADDRESS`
  ADD CONSTRAINT `fk_ADDRESS_USERS` FOREIGN KEY (`USERS_IDUSERS`) REFERENCES `USERS` (`IDUSERS`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `EDUCATION`
--
ALTER TABLE `EDUCATION`
  ADD CONSTRAINT `fk_EDUCATION_USERS1` FOREIGN KEY (`USERS_IDUSERS`) REFERENCES `USERS` (`IDUSERS`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `EXPERIENCE`
--
ALTER TABLE `EXPERIENCE`
  ADD CONSTRAINT `fk_EXPERIENCE_USERS1` FOREIGN KEY (`USERS_IDUSERS`) REFERENCES `USERS` (`IDUSERS`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `USER_INFO`
--
ALTER TABLE `USER_INFO`
  ADD CONSTRAINT `fk_USER_INFO_USERS1` FOREIGN KEY (`USERS_IDUSERS`) REFERENCES `USERS` (`IDUSERS`) ON DELETE CASCADE ON UPDATE NO ACTION;

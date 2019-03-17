-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Mar 17, 2019 at 06:22 AM
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
  `ZIP` int(5) DEFAULT NULL,
  `USERS_IDUSERS` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ADDRESS`
--

INSERT INTO `ADDRESS` (`IDADDRESS`, `STREET`, `CITY`, `STATE`, `ZIP`, `USERS_IDUSERS`) VALUES
(1, 'tester', 'Loveland', 'Colorado', 80537, 1),
(3, 'example', 'City', 'State', 987, 10),
(4, NULL, NULL, NULL, NULL, 11);

-- --------------------------------------------------------

--
-- Table structure for table `AFFINITYGROUPMEMBER`
--

CREATE TABLE `AFFINITYGROUPMEMBER` (
  `AFFINITYGROUPS_IDAFFINITYGROUPS` int(11) NOT NULL,
  `USERS_IDUSERS` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `AFFINITYGROUPMEMBER`
--

INSERT INTO `AFFINITYGROUPMEMBER` (`AFFINITYGROUPS_IDAFFINITYGROUPS`, `USERS_IDUSERS`) VALUES
(2, 1),
(3, 11);

-- --------------------------------------------------------

--
-- Table structure for table `AFFINITYGROUPS`
--

CREATE TABLE `AFFINITYGROUPS` (
  `IDAFFINITYGROUPS` int(11) NOT NULL,
  `NAME` varchar(45) NOT NULL,
  `DESCRIPTION` text NOT NULL,
  `FOCUS` varchar(45) NOT NULL,
  `USERS_IDUSERS` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `AFFINITYGROUPS`
--

INSERT INTO `AFFINITYGROUPS` (`IDAFFINITYGROUPS`, `NAME`, `DESCRIPTION`, `FOCUS`, `USERS_IDUSERS`) VALUES
(2, 'testing', 'testing', 'PHP', 1),
(3, 'test2', 'test2', 'PHP', 10);

-- --------------------------------------------------------

--
-- Table structure for table `EDUCATION`
--

CREATE TABLE `EDUCATION` (
  `IDEDUCATION` int(11) NOT NULL,
  `SCHOOL` varchar(50) NOT NULL,
  `DEGREE` varchar(45) NOT NULL,
  `FIELD` varchar(45) NOT NULL,
  `GPA` float NOT NULL,
  `STARTYEAR` int(11) NOT NULL,
  `ENDYEAR` int(11) NOT NULL,
  `USERS_IDUSERS` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `EDUCATION`
--

INSERT INTO `EDUCATION` (`IDEDUCATION`, `SCHOOL`, `DEGREE`, `FIELD`, `GPA`, `STARTYEAR`, `ENDYEAR`, `USERS_IDUSERS`) VALUES
(1, 'Grand Canyon University', 'Computer Programming', 'Computer Science', 3.8, 2017, 2021, 1),
(5, 'test', 'test', 'etst', 3, 2019, 2020, 10),
(7, 'test', 'test', 'test', 3.9, 2018, 2019, 1);

-- --------------------------------------------------------

--
-- Table structure for table `EXPERIENCE`
--

CREATE TABLE `EXPERIENCE` (
  `IDEXPERIENCE` int(11) NOT NULL,
  `TITLE` varchar(45) NOT NULL,
  `COMPANY` varchar(45) NOT NULL,
  `CURRENT` int(11) NOT NULL,
  `STARTYEAR` varchar(45) NOT NULL,
  `ENDYEAR` varchar(45) DEFAULT NULL,
  `DESCRIPTION` text,
  `USERS_IDUSERS` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `EXPERIENCE`
--

INSERT INTO `EXPERIENCE` (`IDEXPERIENCE`, `TITLE`, `COMPANY`, `CURRENT`, `STARTYEAR`, `ENDYEAR`, `DESCRIPTION`, `USERS_IDUSERS`) VALUES
(1, 'testing', 'testing', 0, '2018', '2019', 'this is a test job', 1),
(7, 'test', 'test', 0, '2019', '2020', 'testing', 10),
(9, 'tester', 'testers testing', 1, '2020', NULL, 'this is a test', 1);

-- --------------------------------------------------------

--
-- Table structure for table `JOBAPPLICANTS`
--

CREATE TABLE `JOBAPPLICANTS` (
  `JOBS_IDJOBS` int(11) NOT NULL,
  `USERS_IDUSERS` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `JOBAPPLICANTS`
--

INSERT INTO `JOBAPPLICANTS` (`JOBS_IDJOBS`, `USERS_IDUSERS`) VALUES
(5, 1),
(7, 1);

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
  `DESCRIPTION` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `JOBS`
--

INSERT INTO `JOBS` (`IDJOBS`, `TITLE`, `COMPANY`, `STATE`, `CITY`, `DESCRIPTION`) VALUES
(5, 'test', 'test', 'test1', 'test', 'test'),
(6, 'tester', 'tester', 'tester', 'tester', 'tester'),
(7, 'PHP Developer', 'Amazon', 'Washington', 'Seattle', 'You will be developing web applications'),
(8, 'Java Developer', 'Oracle', 'Arizona', 'Phoenix', 'You will be writing java applications');

-- --------------------------------------------------------

--
-- Table structure for table `SKILLS`
--

CREATE TABLE `SKILLS` (
  `IDSKILLS` int(11) NOT NULL,
  `SKILL` varchar(45) NOT NULL,
  `DESCRIPTION` text NOT NULL,
  `USERS_IDUSERS` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `SKILLS`
--

INSERT INTO `SKILLS` (`IDSKILLS`, `SKILL`, `DESCRIPTION`, `USERS_IDUSERS`) VALUES
(9, 'test', 'test', 10),
(10, 'PHP', 'I have a good deal of experience with creating php applications', 1),
(12, 'Java', 'Can make java stuff sometimes', 1),
(14, 'test', 'testing_validation', 1);

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
(3, 'this is an admin account for testing', '4441115555', 18, 'Male', 1),
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
-- Indexes for table `AFFINITYGROUPMEMBER`
--
ALTER TABLE `AFFINITYGROUPMEMBER`
  ADD PRIMARY KEY (`AFFINITYGROUPS_IDAFFINITYGROUPS`,`USERS_IDUSERS`),
  ADD KEY `fk_AFFINITYGROUPS_has_USERS_USERS1_idx` (`USERS_IDUSERS`),
  ADD KEY `fk_AFFINITYGROUPS_has_USERS_AFFINITYGROUPS1_idx` (`AFFINITYGROUPS_IDAFFINITYGROUPS`);

--
-- Indexes for table `AFFINITYGROUPS`
--
ALTER TABLE `AFFINITYGROUPS`
  ADD PRIMARY KEY (`IDAFFINITYGROUPS`),
  ADD KEY `fk_AFFINITYGROUPS_USERS1_idx` (`USERS_IDUSERS`);

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
-- Indexes for table `JOBAPPLICANTS`
--
ALTER TABLE `JOBAPPLICANTS`
  ADD PRIMARY KEY (`JOBS_IDJOBS`,`USERS_IDUSERS`),
  ADD KEY `fk_JOBS_has_USERS_USERS1_idx` (`USERS_IDUSERS`),
  ADD KEY `fk_JOBS_has_USERS_JOBS1_idx` (`JOBS_IDJOBS`);

--
-- Indexes for table `JOBS`
--
ALTER TABLE `JOBS`
  ADD PRIMARY KEY (`IDJOBS`);

--
-- Indexes for table `SKILLS`
--
ALTER TABLE `SKILLS`
  ADD PRIMARY KEY (`IDSKILLS`),
  ADD KEY `fk_SKILLS_USERS1_idx` (`USERS_IDUSERS`);

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
-- AUTO_INCREMENT for table `AFFINITYGROUPS`
--
ALTER TABLE `AFFINITYGROUPS`
  MODIFY `IDAFFINITYGROUPS` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `EDUCATION`
--
ALTER TABLE `EDUCATION`
  MODIFY `IDEDUCATION` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `EXPERIENCE`
--
ALTER TABLE `EXPERIENCE`
  MODIFY `IDEXPERIENCE` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `JOBS`
--
ALTER TABLE `JOBS`
  MODIFY `IDJOBS` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `SKILLS`
--
ALTER TABLE `SKILLS`
  MODIFY `IDSKILLS` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

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
-- Constraints for table `AFFINITYGROUPMEMBER`
--
ALTER TABLE `AFFINITYGROUPMEMBER`
  ADD CONSTRAINT `fk_AFFINITYGROUPS_has_USERS_AFFINITYGROUPS1` FOREIGN KEY (`AFFINITYGROUPS_IDAFFINITYGROUPS`) REFERENCES `AFFINITYGROUPS` (`IDAFFINITYGROUPS`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_AFFINITYGROUPS_has_USERS_USERS1` FOREIGN KEY (`USERS_IDUSERS`) REFERENCES `USERS` (`IDUSERS`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `AFFINITYGROUPS`
--
ALTER TABLE `AFFINITYGROUPS`
  ADD CONSTRAINT `fk_AFFINITYGROUPS_USERS1` FOREIGN KEY (`USERS_IDUSERS`) REFERENCES `USERS` (`IDUSERS`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `EDUCATION`
--
ALTER TABLE `EDUCATION`
  ADD CONSTRAINT `fk_EDUCATION_USERS1` FOREIGN KEY (`USERS_IDUSERS`) REFERENCES `USERS` (`IDUSERS`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `EXPERIENCE`
--
ALTER TABLE `EXPERIENCE`
  ADD CONSTRAINT `fk_EXPERIENCE_USERS1` FOREIGN KEY (`USERS_IDUSERS`) REFERENCES `USERS` (`IDUSERS`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `JOBAPPLICANTS`
--
ALTER TABLE `JOBAPPLICANTS`
  ADD CONSTRAINT `fk_JOBS_has_USERS_JOBS1` FOREIGN KEY (`JOBS_IDJOBS`) REFERENCES `JOBS` (`IDJOBS`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_JOBS_has_USERS_USERS1` FOREIGN KEY (`USERS_IDUSERS`) REFERENCES `USERS` (`IDUSERS`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `SKILLS`
--
ALTER TABLE `SKILLS`
  ADD CONSTRAINT `fk_SKILLS_USERS1` FOREIGN KEY (`USERS_IDUSERS`) REFERENCES `USERS` (`IDUSERS`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `USER_INFO`
--
ALTER TABLE `USER_INFO`
  ADD CONSTRAINT `fk_USER_INFO_USERS1` FOREIGN KEY (`USERS_IDUSERS`) REFERENCES `USERS` (`IDUSERS`) ON DELETE CASCADE ON UPDATE NO ACTION;

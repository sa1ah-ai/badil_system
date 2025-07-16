-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 28, 2023 at 12:50 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `badil_mansa`
--

-- --------------------------------------------------------

--
-- Table structure for table `cases`
--

CREATE TABLE `cases` (
  `case_id` int(11) NOT NULL,
  `case_submit_date` datetime DEFAULT current_timestamp(),
  `case_creator` int(5) NOT NULL,
  `isChecked` tinyint(1) DEFAULT 0,
  `case_judge_id` int(11) DEFAULT NULL,
  `is_executed` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `case_details`
--

CREATE TABLE `case_details` (
  `case_details_id` int(11) NOT NULL,
  `offender_name` varchar(100) DEFAULT NULL,
  `offender_age` varchar(100) DEFAULT NULL,
  `offender_sex` varchar(100) DEFAULT NULL,
  `crime_type` varchar(100) DEFAULT NULL,
  `offender_edu_level` varchar(100) DEFAULT NULL,
  `crime_details` varchar(3000) DEFAULT NULL,
  `case_date` date DEFAULT NULL,
  `case_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `citizen`
--

CREATE TABLE `citizen` (
  `citizen_id` int(5) NOT NULL,
  `first_name` varchar(20) NOT NULL,
  `last_name` varchar(20) NOT NULL,
  `ID_Number` int(20) DEFAULT NULL,
  `ID_Number_type` varchar(20) DEFAULT NULL,
  `phone_number` int(15) DEFAULT NULL,
  `email` varchar(30) DEFAULT NULL,
  `username` varchar(50) NOT NULL,
  `passwd` varchar(200) NOT NULL,
  `no_upload_c` int(3) DEFAULT 0,
  `no_checked_c` int(3) DEFAULT 0,
  `no_agreed_c` int(11) DEFAULT 0,
  `no_no_c` int(5) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `executive_authority`
--

CREATE TABLE `executive_authority` (
  `authority_id` int(11) NOT NULL,
  `authority_name` varchar(50) DEFAULT NULL,
  `governorate` varchar(50) NOT NULL,
  `authority_username` varchar(50) NOT NULL,
  `authority_password` varchar(300) NOT NULL,
  `no_excuted_c` int(11) DEFAULT 0,
  `no_waited_c` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `executive_authority`
--

INSERT INTO `executive_authority` (`authority_id`, `authority_name`, `governorate`, `authority_username`, `authority_password`, `no_excuted_c`, `no_waited_c`) VALUES
(1, ' شرطة منطقة مكة المكرمة', 'مكه', 'mkh', 'mkh', 0, 0),
(2, ' ‏مركز شرطة المنصور', 'مكه', 'mnsor', 'mnsor', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `judge`
--

CREATE TABLE `judge` (
  `judge_id` int(11) NOT NULL,
  `judge_name` varchar(50) NOT NULL,
  `judge_username` varchar(50) NOT NULL,
  `judge_password` varchar(50) NOT NULL,
  `no_checked_c` int(5) DEFAULT 0,
  `no_yes_c` int(5) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `judge`
--

INSERT INTO `judge` (`judge_id`, `judge_name`, `judge_username`, `judge_password`, `no_checked_c`, `no_yes_c`) VALUES
(1, 'Salem Mohmmed', 's123', '123', 0, 0),
(2, 'abdallah ali', 'a123', '123', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `ruling_report`
--

CREATE TABLE `ruling_report` (
  `report_id` int(11) NOT NULL,
  `alternative_judgment` varchar(200) NOT NULL,
  `explanation` varchar(200) DEFAULT NULL,
  `case_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cases`
--
ALTER TABLE `cases`
  ADD PRIMARY KEY (`case_id`),
  ADD KEY `case_cfk` (`case_creator`),
  ADD KEY `case_judge_id` (`case_judge_id`);

--
-- Indexes for table `case_details`
--
ALTER TABLE `case_details`
  ADD PRIMARY KEY (`case_details_id`),
  ADD KEY `case_id` (`case_id`);

--
-- Indexes for table `citizen`
--
ALTER TABLE `citizen`
  ADD PRIMARY KEY (`citizen_id`);

--
-- Indexes for table `executive_authority`
--
ALTER TABLE `executive_authority`
  ADD PRIMARY KEY (`authority_id`);

--
-- Indexes for table `judge`
--
ALTER TABLE `judge`
  ADD PRIMARY KEY (`judge_id`);

--
-- Indexes for table `ruling_report`
--
ALTER TABLE `ruling_report`
  ADD PRIMARY KEY (`report_id`),
  ADD KEY `case_id` (`case_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cases`
--
ALTER TABLE `cases`
  MODIFY `case_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `case_details`
--
ALTER TABLE `case_details`
  MODIFY `case_details_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `citizen`
--
ALTER TABLE `citizen`
  MODIFY `citizen_id` int(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `executive_authority`
--
ALTER TABLE `executive_authority`
  MODIFY `authority_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `judge`
--
ALTER TABLE `judge`
  MODIFY `judge_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `ruling_report`
--
ALTER TABLE `ruling_report`
  MODIFY `report_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cases`
--
ALTER TABLE `cases`
  ADD CONSTRAINT `case_cfk` FOREIGN KEY (`case_creator`) REFERENCES `citizen` (`citizen_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `cases_ibfk_1` FOREIGN KEY (`case_judge_id`) REFERENCES `judge` (`judge_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `case_details`
--
ALTER TABLE `case_details`
  ADD CONSTRAINT `case_details_ibfk_1` FOREIGN KEY (`case_id`) REFERENCES `cases` (`case_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `ruling_report`
--
ALTER TABLE `ruling_report`
  ADD CONSTRAINT `ruling_report_ibfk_1` FOREIGN KEY (`case_id`) REFERENCES `cases` (`case_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;


SELECT cases.case_id, cases.isChecked, cases.is_executed, case_details.case_date, citizen.first_name,
 case_details.offender_name, case_details.offender_sex, case_details.crime_type, case_details.crime_details,
 
 FROM cases 
 JOIN citizen ON cases.case_creator = citizen.citizen_id
JOIN case_details ON cases.case_id = case_details.case_id 

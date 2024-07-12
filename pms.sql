-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/

-- Database: `pms`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `email` varchar(25) NOT NULL,
  `password` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`email`, `password`) VALUES
('placementteam@uvce.com', 'uvce@123');

-- --------------------------------------------------------

--
-- Table structure for table `applications`
--

CREATE TABLE `applications` (
  `appid` int NOT NULL,
  `user_id` varchar(30) NOT NULL,
  `company_id` varchar(30) NOT NULL,
  `application_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `applications`
--

INSERT INTO `applications` (`appid`, `user_id`, `company_id`, `application_date`) VALUES
(1, 'U03NM21T064059', '3', '2024-06-17 13:36:19'),
(2, 'U03NM21T064059', '5', '2024-06-17 13:39:04'),
(3, 'U03NM21T064043', 'Google123', '2024-06-17 14:38:58'),
(4, 'U03NM21T064059', '1', '2024-06-19 09:01:27'),
(5, 'U03NM21T064043', '4', '2024-06-19 17:48:12'),
(6, 'U03NM21T064059', '5', '2024-06-21 08:20:07');

-- --------------------------------------------------------

--
-- Table structure for table `company`
--

CREATE TABLE `company` (
  `compid` varchar(20) NOT NULL,
  `compname` varchar(20) NOT NULL,
  `category` varchar(20) NOT NULL,
  `profile` varchar(30) NOT NULL,
  `branch` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `batch` varchar(10) NOT NULL,
  `location` varchar(50) NOT NULL,
  `criteria` varchar(50) NOT NULL,
  `intern_duration` varchar(15) NOT NULL,
  `mode` varchar(15) NOT NULL,
  `offer` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `company`
--

INSERT INTO `company` (`compid`, `compname`, `category`, `profile`, `branch`, `batch`, `location`, `criteria`, `intern_duration`, `mode`, `offer`) VALUES
('1', 'rtCamp', 'Internship', 'Software Engineer', 'CSE,ISE,AIML,ECE', '2025', 'Bangalore ', '7 CGPA in BTech (No Backlogs allowed)', '6 Months', 'Hybrid', '12-18 LPA'),
('3', 'rtCamp', 'Software Engineer', 'Software Engineer', 'CSE,ISE,AIML,ECE', '2025', 'Bangalore ', '7 CGPA in BTech (No Backlogs allowed)', '6 Months', 'Hybrid', '12-18 LPA'),
('4', 'SAP', 'Internship', 'Software Engineer', 'CSE,ISE,AIML,ECE', '2025,2026', 'Bangalore ', '7 CGPA in BTech (No Backlogs allowed)', '3 months', 'Hybrid', '23 LPA'),
('5', 'Juniper Networks', 'Internship', 'Software Engineer', 'CSE,ISE,AIML,ECE,CIVIL,MECH,EEE', '2025', 'Bangalore ', '7 CGPA in BTech (No Backlogs allowed)', '6 Months', 'Hybrid', '50 LPA'),
('Google123', 'Google', 'Internship', 'Data Analyst', 'CSE,ISE,AIML,ECE,CIVIL,MECH,EEE', '2024 ,2025', 'Bangalore ', '7 CGPA in BTech (No Backlogs allowed)', '6 Months', 'Hybrid', '50 LPA'),
('PWC1', 'PWC', 'Full Time', 'Software Engineer', 'CSE ,ISE', '2025', 'Pune', '7 CGPA in BTech (No Backlogs allowed)', '', 'Hybrid', '20LPA');

-- --------------------------------------------------------

--
-- Table structure for table `resume`
--

CREATE TABLE `resume` (
  `usn` varchar(20) NOT NULL,
  `resume_name` varchar(255) NOT NULL,
  `resume_path` varchar(255) NOT NULL,
  `uploaded_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `resume`
--

INSERT INTO `resume` (`usn`, `resume_name`, `resume_path`, `uploaded_at`) VALUES
('U03NM21T064053', 'PPLab(5).ipynb - Colaboratory (1).pdf', 'uploads/PPLab(5).ipynb - Colaboratory (1).pdf', '2024-06-06 08:03:22'),
('U03NM21T064059', '1st sem results.pdf', 'uploads/1st sem results.pdf', '2024-06-06 07:56:06');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `USN` varchar(20) NOT NULL,
  `name` varchar(25) NOT NULL,
  `year` varchar(9) NOT NULL,
  `email` varchar(30) NOT NULL,
  `mobile` varchar(15) NOT NULL,
  `password` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`USN`, `name`, `year`, `email`, `mobile`, `password`) VALUES
('U03NM21T029060', 'Skanda Gowda', '2025', 'skanda@gmail.com', '9876543210', 'Skanda@123'),
('U03NM21T064043', 'Rupnar Vishwajeet Dilip', '2025', 'vishwajeet@gmail.com', '999999999', '09876'),
('U03NM21T064053', 'Suchitra', '2025', 'suchitra@gmail.com', '251738148', 'vasudha'),
('U03NM21T064059', 'Vasudha R prabhu', '2025', 'vasudharp84@gmail.com', '7098614818', '123456'),
('U03NM21T064060', 'Vyshnavi Shetty S', '2025', 'vyshnavi@gmail.com', '87592549253', 'vaish@123'),
('U03NM21T064061', 'Yashaswini', '2025', 'yash@gmail.com', '01286383591', '09876'),
('U03NM21T064098', 'xyz', '2025', 'xyz@gmail.com', '70986148187', '098765');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `applications`
--
ALTER TABLE `applications`
  ADD PRIMARY KEY (`appid`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `company_id` (`company_id`);

--
-- Indexes for table `company`
--
ALTER TABLE `company`
  ADD PRIMARY KEY (`compid`);

--
-- Indexes for table `resume`
--
ALTER TABLE `resume`
  ADD PRIMARY KEY (`usn`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`USN`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `applications`
--
ALTER TABLE `applications`
  MODIFY `appid` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `applications`
--
ALTER TABLE `applications`
  ADD CONSTRAINT `applications_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`USN`),
  ADD CONSTRAINT `applications_ibfk_2` FOREIGN KEY (`company_id`) REFERENCES `company` (`compid`);

--
-- Constraints for table `resume`
--
ALTER TABLE `resume`
  ADD CONSTRAINT `resume_ibfk_1` FOREIGN KEY (`usn`) REFERENCES `user` (`USN`);
COMMIT;


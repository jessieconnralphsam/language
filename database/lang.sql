-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 17, 2024 at 01:20 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lang`
--

-- --------------------------------------------------------

--
-- Table structure for table `assigned_quiz`
--

CREATE TABLE `assigned_quiz` (
  `assigned_id` int(25) NOT NULL,
  `id` int(11) NOT NULL,
  `quizID` int(25) NOT NULL,
  `cdate` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `assigned_quiz`
--

INSERT INTO `assigned_quiz` (`assigned_id`, `id`, `quizID`, `cdate`) VALUES
(14, 12, 8, '2024-03-17 18:55:40'),
(15, 12, 8, '2024-03-17 18:57:13');

-- --------------------------------------------------------

--
-- Table structure for table `quiz`
--

CREATE TABLE `quiz` (
  `quizID` int(25) NOT NULL,
  `quiz` varchar(255) NOT NULL,
  `quiz_link` varchar(255) NOT NULL,
  `monitor_link` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `quiz`
--

INSERT INTO `quiz` (`quizID`, `quiz`, `quiz_link`, `monitor_link`) VALUES
(8, 'Sample Quiz', 'https://www.youtube.com/watch?v=xvFZjo5PgG0', 'https://www.youtube.com/watch?v=xvFZjo5PgG0');

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `roleID` int(10) NOT NULL,
  `role_name` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`roleID`, `role_name`) VALUES
(1, 'teacher'),
(2, 'student');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `roleID` int(10) NOT NULL,
  `username` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `roleID`, `username`, `name`, `password`) VALUES
(6, 1, 'admin', 'gerlie paclibar', 'admin'),
(12, 2, 'jessie', 'gerlie ng mundo', 'jessie');

-- --------------------------------------------------------

--
-- Table structure for table `video_tutorial`
--

CREATE TABLE `video_tutorial` (
  `videoID` int(11) NOT NULL,
  `tutorial_name` varchar(255) NOT NULL,
  `embed_key` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `video_tutorial`
--

INSERT INTO `video_tutorial` (`videoID`, `tutorial_name`, `embed_key`) VALUES
(1, 'Chocolate', 'pxyi6YW8gOE'),
(5, 'Hello', 'FVjpLa8GqeM'),
(6, 'headline', '9eVsgjBYAqU'),
(7, 'HI', 'rhfJGeMDMzQ');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `assigned_quiz`
--
ALTER TABLE `assigned_quiz`
  ADD PRIMARY KEY (`assigned_id`),
  ADD KEY `fk_user_id` (`id`),
  ADD KEY `fk_quizID` (`quizID`);

--
-- Indexes for table `quiz`
--
ALTER TABLE `quiz`
  ADD PRIMARY KEY (`quizID`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`roleID`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_user_role` (`roleID`);

--
-- Indexes for table `video_tutorial`
--
ALTER TABLE `video_tutorial`
  ADD PRIMARY KEY (`videoID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `assigned_quiz`
--
ALTER TABLE `assigned_quiz`
  MODIFY `assigned_id` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `quiz`
--
ALTER TABLE `quiz`
  MODIFY `quizID` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `roleID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `video_tutorial`
--
ALTER TABLE `video_tutorial`
  MODIFY `videoID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `assigned_quiz`
--
ALTER TABLE `assigned_quiz`
  ADD CONSTRAINT `fk_quizID` FOREIGN KEY (`quizID`) REFERENCES `quiz` (`quizID`),
  ADD CONSTRAINT `fk_user_id` FOREIGN KEY (`id`) REFERENCES `user` (`id`);

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `fk_user_role` FOREIGN KEY (`roleID`) REFERENCES `role` (`roleID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 16, 2022 at 12:42 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 7.4.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mdrafm_new`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_program_directors`
--

CREATE TABLE `tbl_program_directors` (
  `id` int(11) NOT NULL,
  `program_id` int(11) NOT NULL,
  `trng_type` int(11) NOT NULL,
  `course_director` int(11) NOT NULL,
  `asst_course_director` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_program_directors`
--

INSERT INTO `tbl_program_directors` (`id`, `program_id`, `trng_type`, `course_director`, `asst_course_director`) VALUES
(9, 19, 4, 5, 8);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_program_directors`
--
ALTER TABLE `tbl_program_directors`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_program_directors`
--
ALTER TABLE `tbl_program_directors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

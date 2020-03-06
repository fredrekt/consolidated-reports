-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 04, 2020 at 04:09 PM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.1.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `php`
--

-- --------------------------------------------------------

--
-- Table structure for table `consolidate`
--

CREATE TABLE `consolidate` (
  `id` int(11) NOT NULL,
  `gradeandsection` text NOT NULL,
  `teacher` text NOT NULL,
  `eng_m` double NOT NULL,
  `eng_mps` double NOT NULL,
  `math_m` double NOT NULL,
  `math_mps` double NOT NULL,
  `fil_m` double NOT NULL,
  `fil_mps` double NOT NULL,
  `sci_m` double NOT NULL,
  `sci_mps` double NOT NULL,
  `mtb_m` double NOT NULL,
  `mtb_mps` double NOT NULL,
  `aral_m` double NOT NULL,
  `aral_mps` double NOT NULL,
  `mapeh_m` double NOT NULL,
  `mapeh_mps` double NOT NULL,
  `epp_m` double NOT NULL,
  `epp_mps` double NOT NULL,
  `esp_m` double NOT NULL,
  `esp_mps` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `consolidate`
--

INSERT INTO `consolidate` (`id`, `gradeandsection`, `teacher`, `eng_m`, `eng_mps`, `math_m`, `math_mps`, `fil_m`, `fil_mps`, `sci_m`, `sci_mps`, `mtb_m`, `mtb_mps`, `aral_m`, `aral_mps`, `mapeh_m`, `mapeh_mps`, `epp_m`, `epp_mps`, `esp_m`, `esp_mps`) VALUES
(1, '1 and gold', 'fred', 80.2, 79.25, 99.25, 81.25, 87.25, 97.25, 78.25, 79.25, 99.25, 61.8, 12.8, 21.59, 58.12, 51.51, 85.59, 29.99, 21.23, 56.21),
(2, '2 and gold', 'fred', 80.2, 79.25, 99.25, 81.25, 87.25, 97.25, 78.25, 79.25, 99.25, 61.8, 12.8, 21.59, 58.12, 51.51, 85.59, 29.99, 21.23, 56.21),
(3, '4-Daisy', 'karen', 80.2, 79.25, 99.25, 81.25, 87.25, 97.25, 78.25, 79.25, 99.25, 61.8, 12.8, 21.59, 58.12, 51.51, 85.59, 29.99, 21.23, 56.21);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `consolidate`
--
ALTER TABLE `consolidate`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `consolidate`
--
ALTER TABLE `consolidate`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

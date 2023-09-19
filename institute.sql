-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 19, 2023 at 10:15 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `institute`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `a_id` int(255) NOT NULL,
  `c_id` int(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `source` varchar(255) NOT NULL,
  `description` int(255) NOT NULL,
  `credit` varchar(255) NOT NULL DEFAULT current_timestamp(),
  `debit` varchar(255) NOT NULL,
  `netbalance` varchar(255) NOT NULL,
  `date` varchar(255) NOT NULL,
  `other` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`a_id`, `c_id`, `type`, `source`, `description`, `credit`, `debit`, `netbalance`, `date`, `other`) VALUES
(31, 1, 'rent', 'bank account', 4000, '2022-10-30', '', '', '', ''),
(32, 2, 'rent', 'easypasa', 3000, '2022-10-20', '', '', '', ''),
(33, 2, 'rent', 'jazzcash', 3000, '2022-10-30', '', '', '', ''),
(34, 2, 'rent', 'jazzcash', 5000, '2022-10-30', '', '', '', ''),
(35, 1, 'rent', 'jazzcash', 5000, '2022-11-01', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `a_student`
--

CREATE TABLE `a_student` (
  `id` int(255) NOT NULL,
  `c_id` int(255) NOT NULL,
  `a_id` int(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `f_name` varchar(255) NOT NULL,
  `st_gender` varchar(255) NOT NULL,
  `contact_no` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `reference` varchar(255) NOT NULL,
  `cnic` varchar(255) NOT NULL,
  `course` varchar(255) NOT NULL,
  `c_duration` varchar(255) NOT NULL,
  `upcoming_installment` varchar(255) NOT NULL,
  `ad_date` date NOT NULL DEFAULT current_timestamp(),
  `total_fee` int(255) NOT NULL,
  `per_installment` int(255) NOT NULL,
  `total_installments` int(255) NOT NULL,
  `advance` int(255) NOT NULL,
  `remaning_amount` int(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `st_status` varchar(255) NOT NULL,
  `fee_status` varchar(255) NOT NULL,
  `end_date` varchar(255) NOT NULL,
  `rg_fee` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `campus`
--

CREATE TABLE `campus` (
  `c_id` int(255) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `campus`
--

INSERT INTO `campus` (`c_id`, `name`) VALUES
(1, 'pakpattan'),
(2, 'arifwala');

-- --------------------------------------------------------

--
-- Table structure for table `expense`
--

CREATE TABLE `expense` (
  `ex_id` int(255) NOT NULL,
  `c_id` int(255) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `expense`
--

INSERT INTO `expense` (`ex_id`, `c_id`, `name`) VALUES
(1, 1, 'Bill'),
(2, 1, 'Rent'),
(3, 1, 'Bottle'),
(4, 1, 'Cleaning'),
(5, 1, 'Tea'),
(6, 1, 'test'),
(7, 1, 'CoC'),
(8, 1, 'Bilal');

-- --------------------------------------------------------

--
-- Table structure for table `expense_detail`
--

CREATE TABLE `expense_detail` (
  `d_id` int(255) NOT NULL,
  `ex_id` int(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `amount` int(255) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `expense_detail`
--

INSERT INTO `expense_detail` (`d_id`, `ex_id`, `description`, `amount`, `date`) VALUES
(1, 1, '', 2000, '2023-03-26'),
(2, 2, 'Institur Rent', 5500, '2023-03-26'),
(3, 3, 'Guest ', 100, '2023-03-26'),
(4, 2, 'Institute rent', 5000, '2023-04-26'),
(5, 2, 'rent', 5000, '2023-05-26'),
(6, 3, 'test', 500, '2023-03-26'),
(7, 5, 'for guest', 200, '2023-03-27'),
(8, 5, 'tea ', 400, '2023-03-26'),
(9, 7, 'coc for guest', 500, '2023-03-27'),
(10, 1, 'by test', 1000, '2023-03-10'),
(11, 1, 'Electric bill', 3000, '2023-06-08');

-- --------------------------------------------------------

--
-- Table structure for table `installments`
--

CREATE TABLE `installments` (
  `i_id` int(255) NOT NULL,
  `id` int(255) NOT NULL,
  `a_id` int(255) NOT NULL,
  `c_id` int(255) NOT NULL,
  `remaning_amount` int(255) NOT NULL,
  `date` date NOT NULL,
  `installment_no` int(255) NOT NULL,
  `upcoming_installment` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `u_id` int(255) NOT NULL,
  `c_id` int(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL,
  `other` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`u_id`, `c_id`, `username`, `password`, `role`, `other`) VALUES
(1, 1, 'l2e', '12', 'admin', ''),
(2, 2, 'athar', '120', 'employ', ''),
(3, 3, 'shahzaib', '130', 'ceo', '');

-- --------------------------------------------------------

--
-- Table structure for table `main_account`
--

CREATE TABLE `main_account` (
  `a_id` int(255) NOT NULL,
  `c_id` int(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `netbalance` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `main_account`
--

INSERT INTO `main_account` (`a_id`, `c_id`, `name`, `netbalance`) VALUES
(1, 1, 'Learn2Earn Pakpattan', 12506),
(2, 2, 'Learn2Earn Arifwala', 4000),
(5, 1, 'Shahzaib Malik', 25000),
(6, 1, 'Bilal Raza', 0);

-- --------------------------------------------------------

--
-- Table structure for table `m_instalment`
--

CREATE TABLE `m_instalment` (
  `m_id` int(255) NOT NULL,
  `id` int(255) NOT NULL,
  `c_id` int(255) NOT NULL,
  `month` varchar(255) NOT NULL,
  `year` varchar(255) NOT NULL,
  `f_status` varchar(255) NOT NULL,
  `remaning_amount` int(255) NOT NULL,
  `date` date NOT NULL,
  `installment_no` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `m_instalment`
--

INSERT INTO `m_instalment` (`m_id`, `id`, `c_id`, `month`, `year`, `f_status`, `remaning_amount`, `date`, `installment_no`) VALUES
(75, 257, 1, 'July', '2023', 'pending', 0, '0000-00-00', 0),
(76, 257, 1, 'August', '2023', 'pending', 0, '0000-00-00', 0),
(77, 257, 1, 'September', '2023', 'pending', 0, '0000-00-00', 0),
(78, 257, 1, 'October', '2023', 'pending', 0, '0000-00-00', 0),
(79, 257, 1, 'November', '2023', 'pending', 0, '0000-00-00', 0),
(80, 257, 1, 'December', '2023', 'pending', 0, '0000-00-00', 0),
(81, 258, 1, 'July', '2023', 'pending', 0, '2023-06-20', 0),
(82, 258, 1, 'August', '2023', 'pending', 0, '2023-06-20', 0),
(83, 258, 1, 'September', '2023', 'pending', 0, '2023-06-20', 0),
(84, 258, 1, 'October', '2023', 'pending', 0, '2023-06-20', 0),
(85, 258, 1, 'November', '2023', 'pending', 0, '2023-06-20', 0),
(86, 258, 1, 'December', '2023', 'pending', 0, '2023-06-20', 0),
(87, 259, 2, 'July', '2023', 'pending', 0, '2023-06-20', 0),
(88, 259, 2, 'August', '2023', 'pending', 0, '2023-06-20', 0),
(89, 259, 2, 'September', '2023', 'pending', 0, '2023-06-20', 0),
(90, 259, 2, 'October', '2023', 'pending', 0, '2023-06-20', 0),
(91, 259, 2, 'November', '2023', 'pending', 0, '2023-06-20', 0),
(92, 259, 2, 'December', '2023', 'pending', 0, '2023-06-20', 0),
(93, 260, 1, 'July', '2023', 'pending', 40000, '2023-06-20', 0),
(94, 260, 1, 'August', '2023', 'pending', 40000, '2023-06-20', 0),
(95, 260, 1, 'September', '2023', 'pending', 40000, '2023-06-20', 0),
(96, 260, 1, 'October', '2023', 'pending', 40000, '2023-06-20', 0),
(97, 260, 1, 'November', '2023', 'pending', 40000, '2023-06-20', 0),
(98, 260, 1, 'December', '2023', 'pending', 40000, '2023-06-20', 0),
(99, 261, 1, 'July', '2023', 'pending', 0, '2023-06-21', 0),
(100, 261, 1, 'August', '2023', 'pending', 0, '2023-06-21', 0),
(101, 261, 1, 'September', '2023', 'pending', 0, '2023-06-21', 0),
(102, 261, 1, 'October', '2023', 'pending', 0, '2023-06-21', 0),
(103, 261, 1, 'November', '2023', 'pending', 0, '2023-06-21', 0),
(104, 261, 1, 'December', '2023', 'pending', 0, '2023-06-21', 0),
(105, 262, 1, 'July', '2023', 'pending', 0, '2023-06-21', 0),
(106, 262, 1, 'August', '2023', 'pending', 0, '2023-06-21', 0),
(107, 262, 1, 'September', '2023', 'pending', 0, '2023-06-21', 0),
(108, 262, 1, 'October', '2023', 'pending', 0, '2023-06-21', 0),
(109, 262, 1, 'November', '2023', 'pending', 0, '2023-06-21', 0),
(110, 263, 1, 'July', '2023', 'pending', 0, '2023-06-21', 0),
(111, 263, 1, 'August', '2023', 'pending', 0, '2023-06-21', 0),
(112, 263, 1, 'September', '2023', 'pending', 0, '2023-06-21', 0),
(113, 263, 1, 'October', '2023', 'pending', 0, '2023-06-21', 0),
(114, 263, 1, 'November', '2023', 'pending', 0, '2023-06-21', 0),
(115, 263, 1, 'December', '2023', 'pending', 0, '2023-06-21', 0),
(116, 264, 1, 'July', '2023', 'pending', 0, '2023-06-21', 0),
(117, 264, 1, 'August', '2023', 'pending', 0, '2023-06-21', 0),
(118, 264, 1, 'September', '2023', 'pending', 0, '2023-06-21', 0);

-- --------------------------------------------------------

--
-- Table structure for table `team`
--

CREATE TABLE `team` (
  `e_id` int(255) NOT NULL,
  `c_id` int(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `f_name` varchar(255) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `contact_no` int(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `cinic` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `team`
--

INSERT INTO `team` (`e_id`, `c_id`, `name`, `f_name`, `gender`, `contact_no`, `address`, `cinic`) VALUES
(1, 1, 'Usman', 'Ghulam Hussian', 'Male', 879797, 'Pakpattan', 78999),
(2, 1, 'raan roky', 'roky', 'Male', 456789, 'pakppatn', 0),
(3, 1, 'haris', '56789', 'Male', 456789, 'pakpttan', 0),
(4, 1, 'suny', 'kamran', 'Male', 456890, 'pakpttan', 4567890),
(8, 1, 'tanveer', 'haji', 'Male', 46789, 'chan per', 456789);

-- --------------------------------------------------------

--
-- Table structure for table `team_detail`
--

CREATE TABLE `team_detail` (
  `id` int(255) NOT NULL,
  `e_id` int(255) NOT NULL,
  `debit` int(255) NOT NULL,
  `credit` int(255) NOT NULL,
  `net_balance` int(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `date` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `team_detail`
--

INSERT INTO `team_detail` (`id`, `e_id`, `debit`, `credit`, `net_balance`, `description`, `date`) VALUES
(1, 1, 200, 2000, 1800, 'loan', '230327'),
(2, 13, 0, 2000, 2000, 'test', '230603'),
(3, 13, 1000, 0, 1000, 'test', '230603');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `t_id` int(255) NOT NULL,
  `a_id` int(255) NOT NULL,
  `c_id` int(255) NOT NULL,
  `from` int(255) NOT NULL,
  `to` int(255) NOT NULL,
  `debit` int(255) NOT NULL,
  `credit` int(255) NOT NULL,
  `netbalance` int(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `t_date` date NOT NULL,
  `other` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`t_id`, `a_id`, `c_id`, `from`, `to`, `debit`, `credit`, `netbalance`, `type`, `description`, `t_date`, `other`) VALUES
(46, 1, 1, 1, 1, 0, 1000, 25300, 'addmission', 'student addmission', '2022-11-08', 0),
(47, 1, 1, 1, 1, 0, 1000, 26300, 'Addmission', 'Student Addmission', '2022-11-08', 0),
(48, 3, 2, 3, 3, 0, 5000, 5000, 'Addmission', 'Student Addmission', '2023-03-18', 0),
(49, 1, 1, 1, 1, 0, 20000, 46300, 'Addmission', 'Student Addmission', '2023-03-18', 0),
(50, 1, 1, 1, 1, 0, 20000, 66300, 'Addmission', 'Student Addmission', '2023-03-18', 0),
(51, 1, 7, 1, 1, 0, 5000, 5000, 'Addmission', 'Student Addmission', '2023-03-18', 0),
(52, 1, 1, 1, 1, 0, 10000, 76300, 'Addmission', 'Student Addmission', '2023-03-18', 0),
(53, 3, 1, 3, 3, 0, 0, 5000, 'Installment', 'Student Installment', '2023-03-19', 0),
(54, 3, 1, 3, 3, 0, 0, 5000, 'Installment', 'Student Installment', '2023-03-19', 0),
(55, 3, 1, 3, 3, 0, 0, 10000, 'Installment', 'Student Installment', '2023-03-19', 0),
(56, 1, 1, 1, 1, 0, 0, 86300, 'Installment', 'Student Installment', '2023-03-19', 0),
(57, 1, 1, 1, 1, 0, 0, 86500, 'Installment', 'Student Installment', '2023-03-19', 0),
(58, 1, 1, 1, 1, 0, 10000, 96500, 'Addmission', 'Student Addmission', '2023-03-20', 0),
(59, 1, 1, 1, 1, 0, 0, 106500, 'Installment', 'Student Installment', '2023-03-20', 0),
(60, 1, 1, 1, 1, 0, 0, 116500, 'Installment', 'Student Installment', '2023-03-20', 0),
(61, 1, 1, 1, 1, 0, 10000, 126500, 'Addmission', 'Student Addmission', '2023-03-20', 0),
(62, 1, 1, 1, 1, 0, 5000, 131500, 'Addmission', 'Student Addmission', '2023-03-21', 0),
(63, 1, 1, 1, 1, 0, 10000, 141500, 'Addmission', 'Student Addmission', '2023-03-21', 0),
(64, 1, 1, 1, 1, 0, 0, 143500, 'Installment', 'Student Installment', '2023-03-21', 0),
(65, 1, 1, 1, 1, 0, 10000, 153500, 'Addmission', 'Student Addmission', '2023-03-21', 0),
(66, 1, 1, 1, 1, 0, 0, 158500, 'Installment', 'Student Installment', '2023-03-21', 0),
(67, 1, 1, 1, 1, 0, 0, 160500, 'Installment', 'Student Installment', '2023-03-21', 0),
(68, 1, 1, 1, 1, 0, 0, 163500, 'Installment', 'Student Installment', '2023-03-21', 0),
(69, 1, 1, 1, 1, 0, 0, 172500, 'Installment', 'Student Installment', '2023-03-21', 0),
(70, 1, 1, 1, 1, 0, 5000, 177500, 'Addmission', 'Student Addmission', '2023-03-21', 0),
(71, 1, 1, 1, 1, 0, 0, 182500, 'Installment', 'Student Installment', '2023-03-21', 0),
(72, 1, 1, 1, 1, 0, 0, 184500, 'Installment', 'Student Installment', '2023-03-22', 0),
(73, 1, 1, 1, 1, 0, 0, 185500, 'Installment', 'Student Installment', '2023-03-22', 0),
(74, 1, 1, 1, 1, 0, 0, 187500, 'Installment', 'Student Installment', '2023-03-22', 0),
(75, 0, 1, 0, 0, 2000, 0, 185500, 'expense', '', '2023-03-26', 0),
(76, 0, 1, 0, 0, 5500, 0, 180000, 'expense', 'Institur Rent', '2023-03-26', 0),
(77, 0, 1, 0, 0, 100, 0, 179900, 'expense', 'Guest ', '2023-03-26', 0),
(78, 0, 1, 0, 0, 5000, 0, 174900, 'expense', 'Institute rent', '2023-04-26', 0),
(79, 0, 1, 0, 0, 5000, 0, 169900, 'expense', 'rent', '2023-05-26', 0),
(80, 0, 1, 0, 0, 500, 0, 169400, 'expense', 'test', '2023-03-26', 0),
(81, 0, 1, 0, 0, 200, 0, 169200, 'expense', 'for guest', '2023-03-27', 0),
(82, 0, 1, 0, 0, 400, 0, 168800, 'expense', 'tea ', '2023-03-26', 0),
(83, 0, 1, 0, 0, 0, 5000, 173800, 'Installment', 'Student Installment', '2023-03-27', 0),
(84, 0, 1, 0, 0, 0, 5000, 178800, 'Advance Fee', 'Student Advance Fee', '2023-03-27', 0),
(85, 0, 1, 0, 0, 500, 0, 178300, 'expense', 'coc for guest', '2023-03-27', 0),
(86, 0, 1, 0, 0, 200, 2000, 180100, 'Team Member', 'loan', '2023-03-27', 0),
(87, 0, 1, 0, 0, 1000, 0, 179100, 'expense', 'by test', '2023-03-10', 0),
(88, 0, 1, 0, 0, 0, 5000, 184100, 'Installment', 'Student Installment', '2023-06-02', 0),
(89, 0, 1, 0, 0, 0, 123123123, 123307223, 'Advance Fee', 'Student Advance Fee', '2023-06-03', 0),
(90, 0, 1, 0, 0, 0, 23232123, 146539346, 'Advance Fee', 'Student Advance Fee', '2023-06-03', 0),
(91, 0, 1, 0, 0, 0, 3454325, 149993671, 'Advance Fee', 'Student Advance Fee', '2023-06-03', 0),
(92, 0, 1, 0, 0, 0, 425, 149994096, 'Advance Fee', 'Student Advance Fee', '2023-06-03', 0),
(93, 0, 1, 0, 0, 0, 2000, 149996096, 'Team Member', 'test', '2023-06-03', 0),
(94, 0, 1, 0, 0, 1000, 0, 149995096, 'Team Member', 'test', '2023-06-03', 0),
(95, 0, 1, 0, 0, 0, 3000, 149998096, 'Advance Fee', 'Student Advance Fee', '2023-06-03', 0),
(96, 0, 1, 0, 0, 0, 10000, 150008096, 'Installment', 'Student Installment', '2023-06-03', 0),
(97, 0, 1, 0, 0, 0, 40000, 150048096, 'Installment', 'Student Installment', '2023-06-03', 0),
(98, 0, 1, 0, 0, 0, 0, 150048096, 'Installment', 'Student Installment', '2023-06-05', 0),
(99, 0, 1, 0, 0, 0, 5000, 150053096, 'Installment', 'Student Installment', '2023-06-05', 0),
(100, 0, 1, 0, 0, 0, 10000, 150063096, 'Installment', 'Student Installment', '2023-06-05', 0),
(101, 0, 1, 0, 0, 0, 5000, 150068096, 'Advance Fee', 'Student Advance Fee', '2023-06-05', 0),
(102, 0, 1, 0, 0, 0, 1000, 150069096, 'Advance Fee', 'Student Advance Fee', '2023-06-05', 0),
(103, 0, 1, 0, 0, 0, 100, 150069196, 'Advance Fee', 'Student Advance Fee', '2023-06-05', 0),
(104, 0, 1, 0, 0, 0, 28000, 150097196, 'Installment', 'Student Installment', '2023-06-05', 0),
(105, 0, 1, 0, 0, 0, 2000, 150099196, 'Installment', 'Student Installment', '2023-06-05', 0),
(106, 0, 1, 0, 0, 0, 300000, 150399196, 'Installment', 'Student Installment', '2023-06-05', 0),
(107, 0, 1, 0, 0, 0, 0, 150399196, 'Installment', 'Student Installment', '2023-06-05', 0),
(108, 0, 1, 0, 0, 0, 12311, 150411507, 'Installment', 'Student Installment', '2023-06-05', 0),
(109, 0, 1, 0, 0, 0, 10000, 150421507, 'Installment', 'Student Installment', '2023-06-05', 0),
(110, 0, 1, 0, 0, 0, 2000, 150423507, 'Installment', 'Student Installment', '2023-06-05', 0),
(111, 0, 1, 0, 0, 0, 4000, 150427507, 'Advance Fee', 'Student Advance Fee', '2023-06-05', 0),
(112, 0, 1, 0, 0, 0, 1000, 150428507, 'Advance Fee', 'Student Advance Fee', '2023-06-05', 0),
(113, 0, 1, 0, 0, 0, 2500, 150431007, 'Installment', 'Student Installment', '2023-06-05', 0),
(114, 0, 1, 0, 0, 0, 5000, 150436007, 'Installment', 'Student Installment', '2023-06-05', 0),
(115, 0, 1, 0, 0, 0, 2000, 150438007, 'Installment', 'Student Installment', '2023-06-05', 0),
(116, 0, 1, 0, 0, 0, 1000, 150439007, 'Installment', 'Student Installment', '2023-06-05', 0),
(117, 0, 1, 0, 0, 0, 2000, 150441007, 'Installment', 'Student Installment', '2023-06-05', 0),
(118, 0, 1, 0, 0, 0, 1000, 150442007, 'Advance Fee', 'Student Advance Fee', '2023-06-05', 0),
(119, 0, 1, 0, 0, 0, 2000, 150444007, 'Installment', 'Student Installment', '2023-06-05', 0),
(120, 0, 1, 0, 0, 0, 2000, 150446007, 'Installment', 'Student Installment', '2023-06-05', 0),
(121, 0, 1, 0, 0, 0, 2000, 150448007, 'Installment', 'Student Installment', '2023-06-05', 0),
(122, 0, 1, 0, 0, 0, 2000, 150450007, 'Installment', 'Student Installment', '2023-06-05', 0),
(123, 0, 1, 0, 0, 0, 1000, 150451007, 'Installment', 'Student Installment', '2023-06-05', 0),
(124, 0, 1, 0, 0, 0, 1000, 150452007, 'Installment', 'Student Installment', '2023-06-05', 0),
(125, 0, 1, 0, 0, 0, 1000, 150453007, 'Installment', 'Student Installment', '2023-06-05', 0),
(126, 0, 1, 0, 0, 0, 1000, 150454007, 'Installment', 'Student Installment', '2023-06-05', 0),
(127, 0, 1, 0, 0, 0, 5000, 150459007, 'Advance Fee', 'Student Advance Fee', '2023-06-05', 0),
(128, 0, 1, 0, 0, 0, 10000, 150469007, 'Installment', 'Student Installment', '2023-06-05', 0),
(129, 0, 1, 0, 0, 0, 5000, 150474007, 'Advance Fee', 'Student Advance Fee', '2023-06-07', 0),
(130, 0, 1, 0, 0, 0, 5000, 150479007, 'Installment', 'Student Installment', '2023-06-07', 0),
(131, 0, 1, 0, 0, 0, 2000, 150481007, 'Advance Fee', 'Student Advance Fee', '2023-06-07', 0),
(132, 0, 1, 0, 0, 0, 1000, 150482007, 'Installment', 'Student Installment', '2023-06-07', 0),
(133, 0, 1, 0, 0, 0, 5000, 150487007, 'Advance Fee', 'Student Advance Fee', '2023-06-07', 0),
(134, 0, 1, 0, 0, 0, 1000, 150488007, 'Advance Fee', 'Student Advance Fee', '2023-06-07', 0),
(135, 0, 1, 0, 0, 0, 10000, 150498007, 'Installment', 'Student Installment', '2023-06-07', 0),
(136, 0, 1, 0, 0, 0, 1000, 150499007, 'Advance Fee', 'Student Advance Fee', '2023-06-07', 0),
(137, 0, 1, 0, 0, 0, 10000, 150509007, 'Advance Fee', 'Student Advance Fee', '2023-06-07', 0),
(138, 0, 1, 0, 0, 0, 1000, 150510007, 'Advance Fee', 'Student Advance Fee', '2023-06-07', 0),
(139, 0, 1, 0, 0, 0, 1111, 150511118, 'Advance Fee', 'Student Advance Fee', '2023-06-07', 0),
(140, 0, 1, 0, 0, 0, 10000, 150521118, 'Installment', 'Student Installment', '2023-06-07', 0),
(141, 0, 1, 0, 0, 0, 1000, 150522118, 'Advance Fee', 'Student Advance Fee', '2023-06-07', 0),
(142, 0, 1, 0, 0, 0, 1000, 150523118, 'Advance Fee', 'Student Advance Fee', '2023-06-07', 0),
(143, 0, 1, 0, 0, 0, 10000, 150533118, 'Installment', 'Student Installment', '2023-06-07', 0),
(144, 0, 1, 0, 0, 0, 10000, 150543118, 'Installment', 'Student Installment', '2023-06-07', 0),
(145, 0, 1, 0, 0, 0, 1000, 150544118, 'Installment', 'Student Installment', '2023-06-07', 0),
(146, 0, 1, 0, 0, 0, 2000, 150546118, 'Advance Fee', 'Student Advance Fee', '2023-06-07', 0),
(147, 0, 1, 0, 0, 0, 5000, 150551118, 'Installment', 'Student Installment', '2023-06-07', 0),
(148, 0, 1, 0, 0, 0, 5000, 150556118, 'Installment', 'Student Installment', '2023-06-07', 0),
(149, 0, 1, 0, 0, 6, 6, 1, '2000', '20000', '2023-06-08', 0),
(150, 0, 1, 0, 0, 1, 1, 6, '20000', '2000', '2023-06-08', 0),
(151, 0, 1, 0, 0, 0, 1000, 1006, 'Advance Fee', 'Student Advance Fee', '2023-06-08', 0),
(152, 0, 1, 0, 0, 3000, 0, -1994, 'expense', 'Electric bill', '2023-06-08', 0),
(153, 0, 1, 0, 0, 0, 2000, 6, 'Advance Fee', 'Student Advance Fee', '2023-06-08', 0),
(154, 0, 1, 0, 0, 0, 7500, 7506, 'Installment', 'Student Installment', '2023-06-08', 0),
(155, 0, 1, 0, 0, 0, 2000, 9506, 'Advance Fee', 'Student Advance Fee', '2023-06-08', 0),
(156, 0, 1, 0, 0, 0, 1000, 10506, 'Advance Fee', 'Student Advance Fee', '2023-06-08', 0),
(157, 0, 1, 0, 0, 0, 1000, 11506, 'Advance Fee', 'Student Advance Fee', '2023-06-12', 0),
(158, 0, 1, 0, 0, 0, 1000, 12506, 'Advance Fee', 'Student Advance Fee', '2023-06-12', 0),
(159, 0, 3, 0, 0, 2, 2, 6, '0', '1000', '2023-06-13', 0),
(160, 0, 3, 0, 0, 6, 6, 2, '1000', '0', '2023-06-13', 0),
(161, 0, 1, 0, 0, 1, 1, 6, '0', '1000', '2023-06-13', 0),
(162, 0, 1, 0, 0, 6, 6, 1, '1000', '0', '2023-06-13', 0),
(163, 0, 1, 0, 0, 0, 1111, 1112, 'Advance Fee', 'Student Advance Fee', '2023-06-13', 0),
(164, 0, 1, 0, 0, 0, 20000, 21112, 'Installment', 'Student Installment', '2023-06-13', 0),
(165, 0, 1, 0, 0, 0, 400, 21512, 'Advance Fee', 'Student Advance Fee', '2023-06-14', 0),
(166, 0, 1, 0, 0, 0, 400, 21912, 'Advance Fee', 'Student Advance Fee', '2023-06-14', 0),
(167, 0, 1, 0, 0, 0, 500, 22412, 'Advance Fee', 'Student Advance Fee', '2023-06-14', 0),
(168, 0, 1, 0, 0, 0, 500, 22912, 'Advance Fee', 'Student Advance Fee', '2023-06-14', 0),
(169, 0, 1, 0, 0, 0, 500, 23412, 'Advance Fee', 'Student Advance Fee', '2023-06-14', 0),
(170, 0, 1, 0, 0, 0, 5000, 28412, 'Installment', 'Student Installment', '2023-06-14', 0),
(171, 0, 1, 0, 0, 0, 500, 28912, 'Advance Fee', 'Student Advance Fee', '2023-06-16', 0),
(172, 0, 1, 0, 0, 0, 500, 29412, 'Advance Fee', 'Student Advance Fee', '2023-06-16', 0),
(173, 0, 1, 0, 0, 0, 500, 29912, 'Advance Fee', 'Student Advance Fee', '2023-06-16', 0),
(174, 0, 1, 0, 0, 0, 500, 30412, 'Advance Fee', 'Student Advance Fee', '2023-06-16', 0),
(175, 0, 1, 0, 0, 0, 500, 30912, 'Advance Fee', 'Student Advance Fee', '2023-06-16', 0),
(176, 0, 1, 0, 0, 0, 500, 31412, 'Advance Fee', 'Student Advance Fee', '2023-06-16', 0),
(177, 0, 1, 0, 0, 0, 500, 31912, 'Advance Fee', 'Student Advance Fee', '2023-06-16', 0),
(178, 0, 1, 0, 0, 0, 500, 32412, 'Advance Fee', 'Student Advance Fee', '2023-06-16', 0),
(179, 0, 1, 0, 0, 0, 500, 32912, 'Advance Fee', 'Student Advance Fee', '2023-06-16', 0),
(180, 0, 2, 0, 0, 0, 4, 5004, 'Advance Fee', 'Student Advance Fee', '2023-06-16', 0),
(181, 0, 2, 0, 0, 0, 4, 5008, 'Advance Fee', 'Student Advance Fee', '2023-06-16', 0),
(182, 0, 1, 0, 0, 0, 400, 33312, 'Installment', 'Student Installment', '2023-06-16', 0),
(183, 0, 1, 0, 0, 0, 400, 33712, 'Installment', 'Student Installment', '2023-06-16', 0),
(184, 0, 1, 0, 0, 0, 400, 34112, 'Installment', 'Student Installment', '2023-06-16', 0),
(185, 0, 1, 0, 0, 0, 40, 34152, 'Installment', 'Student Installment', '2023-06-17', 0),
(186, 0, 1, 0, 0, 0, 400, 34552, 'Advance Fee', 'Student Advance Fee', '2023-06-20', 0),
(187, 0, 1, 0, 0, 0, 5000, 39552, 'Advance Fee', 'Student Advance Fee', '2023-06-20', 0),
(188, 0, 1, 0, 0, 0, 0, 39552, 'Advance Fee', 'Student Advance Fee', '2023-06-20', 0),
(189, 0, 1, 0, 0, 0, 0, 39552, 'Advance Fee', 'Student Advance Fee', '2023-06-20', 0),
(190, 0, 1, 0, 0, 0, 0, 39552, 'Advance Fee', 'Student Advance Fee', '2023-06-20', 0),
(191, 0, 1, 0, 0, 0, 0, 39552, 'Advance Fee', 'Student Advance Fee', '2023-06-20', 0),
(192, 0, 1, 0, 0, 0, 0, 39552, 'Advance Fee', 'Student Advance Fee', '2023-06-20', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`a_id`);

--
-- Indexes for table `a_student`
--
ALTER TABLE `a_student`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `campus`
--
ALTER TABLE `campus`
  ADD PRIMARY KEY (`c_id`);

--
-- Indexes for table `expense`
--
ALTER TABLE `expense`
  ADD PRIMARY KEY (`ex_id`);

--
-- Indexes for table `expense_detail`
--
ALTER TABLE `expense_detail`
  ADD PRIMARY KEY (`d_id`);

--
-- Indexes for table `installments`
--
ALTER TABLE `installments`
  ADD PRIMARY KEY (`i_id`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`u_id`);

--
-- Indexes for table `main_account`
--
ALTER TABLE `main_account`
  ADD PRIMARY KEY (`a_id`);

--
-- Indexes for table `m_instalment`
--
ALTER TABLE `m_instalment`
  ADD PRIMARY KEY (`m_id`);

--
-- Indexes for table `team`
--
ALTER TABLE `team`
  ADD PRIMARY KEY (`e_id`);

--
-- Indexes for table `team_detail`
--
ALTER TABLE `team_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`t_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
  MODIFY `a_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `a_student`
--
ALTER TABLE `a_student`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `campus`
--
ALTER TABLE `campus`
  MODIFY `c_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `expense`
--
ALTER TABLE `expense`
  MODIFY `ex_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `expense_detail`
--
ALTER TABLE `expense_detail`
  MODIFY `d_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `installments`
--
ALTER TABLE `installments`
  MODIFY `i_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=300;

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `u_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `main_account`
--
ALTER TABLE `main_account`
  MODIFY `a_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `m_instalment`
--
ALTER TABLE `m_instalment`
  MODIFY `m_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=119;

--
-- AUTO_INCREMENT for table `team`
--
ALTER TABLE `team`
  MODIFY `e_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `team_detail`
--
ALTER TABLE `team_detail`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `t_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=193;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

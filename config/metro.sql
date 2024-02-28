-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 18, 2024 at 01:59 PM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `metro`
--

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE `account` (
  `acct_id` int(11) NOT NULL,
  `acct_no` varchar(225) NOT NULL,
  `pic` varchar(225) NOT NULL,
  `uname` varchar(225) NOT NULL,
  `fname` varchar(225) NOT NULL,
  `lname` varchar(225) NOT NULL,
  `pass` varchar(500) NOT NULL,
  `dob` varchar(225) NOT NULL,
  `email` varchar(400) NOT NULL,
  `phone` varchar(225) NOT NULL,
  `addr` varchar(225) NOT NULL,
  `sex` varchar(225) NOT NULL,
  `marry` varchar(225) NOT NULL,
  `work` varchar(225) NOT NULL,
  `country` varchar(225) NOT NULL,
  `state` varchar(225) NOT NULL,
  `currency` varchar(225) NOT NULL,
  `type` varchar(225) NOT NULL,
  `status` enum('ACTIVE','DORMANT','CLOSED','SUSPENDED','REGISTERED') NOT NULL,
  `otp` int(11) DEFAULT NULL,
  `billing_code` enum('OTP','COT','PIN') NOT NULL,
  `a_bal` int(11) NOT NULL,
  `pin` int(200) NOT NULL,
  `imf` int(200) NOT NULL,
  `cot` int(200) NOT NULL,
  `date` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`acct_id`, `acct_no`, `pic`, `uname`, `fname`, `lname`, `pass`, `dob`, `email`, `phone`, `addr`, `sex`, `marry`, `work`, `country`, `state`, `currency`, `type`, `status`, `otp`, `billing_code`, `a_bal`, `pin`, `imf`, `cot`, `date`) VALUES
(11, '2147483647', 'assets/img/user.png', '0078309531', 'Obinabo', 'Walter', '$2y$10$EIhy0mYUNLlmtknHKh1u2uxIs8bH.rP9M7XOZHw9tabjq8vlmtIuW', '05/26/1995', 'walterobinabo@gmail.com', '+2348064263988', 'No 7 Chidera Nwosu Street Nkwelle Awka', 'Male', 'Single', 'Student', 'nigeria', 'ANAMBRA', '', 'Savings', 'DORMANT', NULL, 'OTP', 0, 0, 0, 0, '01/01/2024'),
(15, '3525539401', 'assets/img/user.png', 'Wally', 'Obinabo', 'Walter', '$2y$10$Gz3SorSvYcF9QP/pMTeEsuX5viO8YFR6LQIdGUxlP/JZE.Y1v6Vbe', '26/05/1995', 'wallyobinabo@gmail.com', '+2348064263988', 'No 7 Chidera Nwosu Street Nkwelle Awka', 'Male', 'Single', 'Student', 'nigeria', 'ANAMBRA', '', 'Savings', 'DORMANT', NULL, 'OTP', 0, 0, 0, 0, '01/01/2024'),
(16, '3517199107', 'view/uploads/392051bfae.jpg', 'Wally008', 'Obinabo', 'Walter', '$2y$10$15TEy.1F9yTaKlDGaEm4d.qlDQENoo8tam9PoAbjiaMed4vK7GMJm', '26/05/1995', 'walcodeobinabo@gmail.com', '+2348064263988', 'No 7 Chidera Nwosu Street Nkwelle Awka', 'Male', 'Single', 'Student', 'nigeria', 'ANAMBRA', '', 'Savings', 'ACTIVE', 808518, 'OTP', 410, 153999, 0, 1539, '01/01/2024');

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `uname` varchar(225) NOT NULL,
  `email` varchar(225) NOT NULL,
  `pass` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `uname`, `email`, `pass`) VALUES
(1, 'Sergeant', 'support@americanexpressfinances.com', '40b37dddf5359c45c4a03e032082319c');

-- --------------------------------------------------------

--
-- Table structure for table `cards`
--

CREATE TABLE `cards` (
  `id` int(11) NOT NULL,
  `acct_no` int(11) NOT NULL,
  `card_no` varchar(225) NOT NULL,
  `card_expiry` varchar(225) NOT NULL,
  `card_cvv` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `ticket`
--

CREATE TABLE `ticket` (
  `id` int(11) NOT NULL,
  `acct_id` int(11) NOT NULL,
  `uname` varchar(225) NOT NULL,
  `subject` varchar(225) NOT NULL,
  `body` text NOT NULL,
  `date` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ticket`
--

INSERT INTO `ticket` (`id`, `acct_id`, `uname`, `subject`, `body`, `date`) VALUES
(0, 16, 'Wally008', 'Pending Transactions', 'I need someone to listen to me', '17/02/2024 12:43:46');

-- --------------------------------------------------------

--
-- Table structure for table `transfer`
--

CREATE TABLE `transfer` (
  `id` int(11) NOT NULL,
  `acct_id` int(11) NOT NULL,
  `acct_number` int(11) NOT NULL,
  `acct_name` varchar(225) NOT NULL,
  `bank` varchar(225) NOT NULL,
  `amount` int(11) NOT NULL,
  `rout_no` varchar(100) NOT NULL,
  `type` varchar(225) NOT NULL,
  `status` varchar(225) NOT NULL,
  `trx_id` varchar(225) NOT NULL,
  `date` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transfer`
--

INSERT INTO `transfer` (`id`, `acct_id`, `acct_number`, `acct_name`, `bank`, `amount`, `rout_no`, `type`, `status`, `trx_id`, `date`) VALUES
(1, 16, 1122334455, 'Angela Ude', 'Fidelity bank', 500, '', 'Debit', 'Completed', 'ff34fb70f0e3225', '17/02/2024 04:33:57'),
(2, 16, 22334455, 'Obinabo Walter', 'GTBank', 20, '', 'Debit', 'Completed', '9f622ec94fee5f5', '17/02/2024 04:49:25'),
(3, 16, 2147483647, 'Ude Chiamaka', 'Wema Bank', 20, '', 'Debit', 'Completed', 'ddbf8aa8507554a', '17/02/2024 04:56:11'),
(4, 16, 1212345677, 'Udegbunam Angel', 'Fidelity bank', 30, '', 'Debit', 'Completed', '405a29f67ba3ea0', '17/02/2024 05:38:54'),
(5, 16, 1277722990, 'Obrian', 'uzundu', 20, '', 'Debit', 'Completed', '34cf7f403149311', '17/02/2024 07:52:18');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`acct_id`);

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cards`
--
ALTER TABLE `cards`
  ADD PRIMARY KEY (`id`),
  ADD KEY `acct_no` (`acct_no`);

--
-- Indexes for table `ticket`
--
ALTER TABLE `ticket`
  ADD KEY `acct_id` (`acct_id`);

--
-- Indexes for table `transfer`
--
ALTER TABLE `transfer`
  ADD PRIMARY KEY (`id`),
  ADD KEY `acct_id` (`acct_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account`
--
ALTER TABLE `account`
  MODIFY `acct_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cards`
--
ALTER TABLE `cards`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `transfer`
--
ALTER TABLE `transfer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cards`
--
ALTER TABLE `cards`
  ADD CONSTRAINT `cards_ibfk_1` FOREIGN KEY (`acct_no`) REFERENCES `account` (`acct_id`);

--
-- Constraints for table `ticket`
--
ALTER TABLE `ticket`
  ADD CONSTRAINT `ticket_ibfk_1` FOREIGN KEY (`acct_id`) REFERENCES `account` (`acct_id`);

--
-- Constraints for table `transfer`
--
ALTER TABLE `transfer`
  ADD CONSTRAINT `transfer_ibfk_1` FOREIGN KEY (`acct_id`) REFERENCES `account` (`acct_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

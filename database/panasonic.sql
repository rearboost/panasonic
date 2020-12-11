-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 11, 2020 at 05:08 PM
-- Server version: 10.1.10-MariaDB
-- PHP Version: 5.5.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `panasonic`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `category_id` int(11) NOT NULL,
  `category_name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `category_name`) VALUES
(2, 'MANGANESE'),
(3, 'ALKALINE'),
(4, 'EVOLTA'),
(5, 'RECHARGABLE'),
(6, 'CHARGERS'),
(7, 'LITHIUM COIN');

-- --------------------------------------------------------

--
-- Table structure for table `item`
--

CREATE TABLE `item` (
  `item_id` int(11) NOT NULL,
  `category` text NOT NULL,
  `item_name` text NOT NULL,
  `batch_no` text NOT NULL,
  `size` text NOT NULL,
  `purchase_cost` double(10,2) NOT NULL,
  `sales_cost` double(10,2) NOT NULL,
  `warehouse_stock` int(11) NOT NULL,
  `lorry_stock` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `item`
--

INSERT INTO `item` (`item_id`, `category`, `item_name`, `batch_no`, `size`, `purchase_cost`, `sales_cost`, `warehouse_stock`, `lorry_stock`) VALUES
(1, 'MANGANESE', 'R6NT/1B12', '1', 'AA', 100.00, 110.00, 150, 32),
(2, 'CHARGERS', 'R6NT/1B123S', '3', 'AAAA', 160.00, 180.00, 180, 50);

-- --------------------------------------------------------

--
-- Table structure for table `trxn`
--

CREATE TABLE `trxn` (
  `trxn_id` int(11) NOT NULL,
  `category` text NOT NULL,
  `item` text NOT NULL,
  `size` text NOT NULL,
  `load_bal` int(11) NOT NULL,
  `bf_bal` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `S1` text NOT NULL,
  `S2` text NOT NULL,
  `S3` text NOT NULL,
  `S4` text NOT NULL,
  `S5` text NOT NULL,
  `S6` text NOT NULL,
  `S7` text NOT NULL,
  `S8` text NOT NULL,
  `S9` text NOT NULL,
  `S10` text NOT NULL,
  `S11` text NOT NULL,
  `S12` text NOT NULL,
  `S13` text NOT NULL,
  `S14` text NOT NULL,
  `S15` text NOT NULL,
  `S16` text NOT NULL,
  `sale` int(11) NOT NULL,
  `free` int(11) NOT NULL,
  `af_bal` int(11) NOT NULL,
  `create_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `trxn`
--

INSERT INTO `trxn` (`trxn_id`, `category`, `item`, `size`, `load_bal`, `bf_bal`, `total`, `S1`, `S2`, `S3`, `S4`, `S5`, `S6`, `S7`, `S8`, `S9`, `S10`, `S11`, `S12`, `S13`, `S14`, `S15`, `S16`, `sale`, `free`, `af_bal`, `create_date`) VALUES
(1, 'CHARGERS', 'R6NT/5N123S', 'AAAA', 150, 100, 250, '', '', '3/12', '', '3/12', '', '', '', '', '0/6', '', '', '', '0/24', '', '', 54, 6, 190, '2020-12-08'),
(2, 'MANGANESE', 'R6NT/1B123S', 'AA', 200, 50, 250, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 60, 12, 178, '0000-00-00'),
(4, 'EVOLTA', 'R6NT/1B12', 'AA', 150, 50, 200, '3/12', '', '', '', '', '0/3', '', '', '', '', '', '', '', '', '', '', 12, 3, 182, '0000-00-00'),
(6, 'MANGANESE', 'R6NT/1B12', 'AA', 50, 0, 50, '3/12', '', '', '', '', '0/3', '', '', '', '', '', '', '', '', '', '', 12, 3, 32, '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `username`, `password`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `item`
--
ALTER TABLE `item`
  ADD PRIMARY KEY (`item_id`);

--
-- Indexes for table `trxn`
--
ALTER TABLE `trxn`
  ADD PRIMARY KEY (`trxn_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `item`
--
ALTER TABLE `item`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `trxn`
--
ALTER TABLE `trxn`
  MODIFY `trxn_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

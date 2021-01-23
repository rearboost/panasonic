-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 23, 2021 at 02:32 AM
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
-- Table structure for table `bill`
--

CREATE TABLE `bill` (
  `B_id` int(11) NOT NULL,
  `bill_no` varchar(20) NOT NULL,
  `shop` varchar(100) NOT NULL,
  `b_date` varchar(100) NOT NULL,
  `bill_amount` double(10,2) NOT NULL DEFAULT '0.00',
  `discount` double(10,2) NOT NULL DEFAULT '0.00',
  `discounted_amt` double(10,2) NOT NULL DEFAULT '0.00',
  `cost` double(10,2) NOT NULL,
  `cash` double(10,2) NOT NULL DEFAULT '0.00',
  `credit` double(10,2) NOT NULL DEFAULT '0.00',
  `cheque` double(10,2) NOT NULL DEFAULT '0.00',
  `cheque_no` varchar(25) NOT NULL,
  `cheque_date` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bill`
--

INSERT INTO `bill` (`B_id`, `bill_no`, `shop`, `b_date`, `bill_amount`, `discount`, `discounted_amt`, `cost`, `cash`, `credit`, `cheque`, `cheque_no`, `cheque_date`) VALUES
(4, '0004', 'shop3', '2021-01-12', 350.00, 0.00, 350.00, 250.00, 350.00, 0.00, 0.00, '', ''),
(5, '00000005', '', '2021-01-12', 1500.00, 150.00, 1350.00, 500.00, 1350.00, 0.00, 0.00, '', '');

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
  `free_stock` int(11) NOT NULL,
  `lorry_stock` int(11) NOT NULL,
  `lorry_free_stock` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `item`
--

INSERT INTO `item` (`item_id`, `category`, `item_name`, `batch_no`, `size`, `purchase_cost`, `sales_cost`, `warehouse_stock`, `free_stock`, `lorry_stock`, `lorry_free_stock`) VALUES
(1, 'MANGANESE', 'R6NT/1B12', '1', 'AA', 100.00, 110.00, 985, 75, 150, 15),
(2, 'CHARGERS', 'R6NT/1B123S', '3', 'AAAA', 160.00, 180.00, 770, 50, 68, 0),
(3, 'ALKALINE', 'LR6T/4B', '2', 'AAA', 100.00, 125.00, 45, 9, 50, 0),
(4, 'ALKALINE', 'LR6T2B', '2', 'AAA', 100.00, 175.00, 750, 45, 250, 0),
(5, 'EVOLTA', 'MD/W12', '3', 'AA', 45.00, 75.00, 1250, 60, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `profit`
--

CREATE TABLE `profit` (
  `P_id` int(11) NOT NULL,
  `cdate` varchar(100) NOT NULL,
  `sales` double(10,2) NOT NULL DEFAULT '0.00',
  `purchase_cost` double(10,2) NOT NULL,
  `expenses` double(10,2) NOT NULL DEFAULT '0.00',
  `daily_profit` double(10,2) NOT NULL DEFAULT '0.00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `profit`
--

INSERT INTO `profit` (`P_id`, `cdate`, `sales`, `purchase_cost`, `expenses`, `daily_profit`) VALUES
(1, '2021-01-12', 1700.00, 750.00, 350.00, 600.00);

-- --------------------------------------------------------

--
-- Table structure for table `sale_items`
--

CREATE TABLE `sale_items` (
  `sale_id` int(11) NOT NULL,
  `bill_no` varchar(20) NOT NULL,
  `item` varchar(150) NOT NULL,
  `total` int(11) NOT NULL DEFAULT '0',
  `sale` int(11) NOT NULL DEFAULT '0',
  `free` int(11) NOT NULL DEFAULT '0',
  `af_bal` int(11) NOT NULL DEFAULT '0',
  `total_free` int(11) NOT NULL,
  `af_free` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sale_items`
--

INSERT INTO `sale_items` (`sale_id`, `bill_no`, `item`, `total`, `sale`, `free`, `af_bal`, `total_free`, `af_free`) VALUES
(6, '0004', 'R6NT/1B12', 150, 12, 3, 135, 0, 0),
(7, '00000005', 'R6NT/1B123S', 83, 12, 3, 68, 0, 0);

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
  `free_load` int(11) NOT NULL,
  `bf_bal` int(11) NOT NULL,
  `bf_free` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `tot_free` int(11) NOT NULL,
  `create_date` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `trxn`
--

INSERT INTO `trxn` (`trxn_id`, `category`, `item`, `size`, `load_bal`, `free_load`, `bf_bal`, `bf_free`, `total`, `tot_free`, `create_date`) VALUES
(1, 'MANGANESE', 'R6NT/1B12', 'AA', 25, 0, 100, 0, 125, 0, '2021-01-02'),
(2, 'CHARGERS', 'R6NT/1B123S', 'AAAA', 70, 0, 0, 0, 70, 0, '2021-01-02'),
(3, 'ALKALINE', 'LR6T/4B', 'AAA', 50, 0, 0, 0, 50, 0, '2021-01-02'),
(4, 'ALKALINE', 'LR6T2B', 'AAA', 100, 0, 150, 0, 250, 0, '2021-01-02'),
(5, 'MANGANESE', 'R6NT/1B12', 'AA', 100, 0, 80, 0, 180, 0, '2021-01-12'),
(6, 'CHARGERS', 'R6NT/1B123S', 'AAAA', 20, 0, 63, 0, 83, 0, '2021-01-12'),
(7, 'ALKALINE', 'LR6T/4B', 'AAA', 15, 0, 35, 0, 50, 0, '2021-01-12'),
(8, 'ALKALINE', 'LR6T2B', 'AAA', 0, 0, 250, 0, 0, 0, '2021-01-12'),
(9, 'EVOLTA', 'MD/W12', 'AA', 0, 0, 0, 0, 0, 0, '2021-01-12'),
(10, 'MANGANESE', 'R6NT/1B12', 'AA', 0, 0, 135, 0, 0, 0, '2021-01-13'),
(11, 'CHARGERS', 'R6NT/1B123S', 'AAAA', 0, 0, 68, 0, 0, 0, '2021-01-13'),
(12, 'ALKALINE', 'LR6T/4B', 'AAA', 0, 0, 50, 0, 0, 0, '2021-01-13'),
(13, 'ALKALINE', 'LR6T2B', 'AAA', 0, 0, 250, 0, 0, 0, '2021-01-13'),
(14, 'EVOLTA', 'MD/W12', 'AA', 0, 0, 0, 0, 0, 0, '2021-01-13'),
(15, 'MANGANESE', 'R6NT/1B12', 'AA', 15, 15, 135, 0, 150, 15, '2021-01-14'),
(16, 'CHARGERS', 'R6NT/1B123S', 'AAAA', 0, 0, 68, 0, 0, 0, '2021-01-14'),
(17, 'ALKALINE', 'LR6T/4B', 'AAA', 0, 0, 50, 0, 0, 0, '2021-01-14'),
(18, 'ALKALINE', 'LR6T2B', 'AAA', 0, 0, 250, 0, 0, 0, '2021-01-14'),
(19, 'EVOLTA', 'MD/W12', 'AA', 0, 0, 0, 0, 0, 0, '2021-01-14');

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
-- Indexes for table `bill`
--
ALTER TABLE `bill`
  ADD PRIMARY KEY (`B_id`);

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
-- Indexes for table `profit`
--
ALTER TABLE `profit`
  ADD PRIMARY KEY (`P_id`);

--
-- Indexes for table `sale_items`
--
ALTER TABLE `sale_items`
  ADD PRIMARY KEY (`sale_id`);

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
-- AUTO_INCREMENT for table `bill`
--
ALTER TABLE `bill`
  MODIFY `B_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `item`
--
ALTER TABLE `item`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `profit`
--
ALTER TABLE `profit`
  MODIFY `P_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `sale_items`
--
ALTER TABLE `sale_items`
  MODIFY `sale_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `trxn`
--
ALTER TABLE `trxn`
  MODIFY `trxn_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

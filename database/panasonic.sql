-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 24, 2021 at 04:59 PM
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
  `month` int(5) NOT NULL,
  `year` int(5) NOT NULL,
  `bill_amount` double(10,2) NOT NULL DEFAULT '0.00',
  `discount` double(10,2) NOT NULL DEFAULT '0.00',
  `discounted_amt` double(10,2) NOT NULL DEFAULT '0.00',
  `cost` double(10,2) NOT NULL DEFAULT '0.00',
  `cash` double(10,2) NOT NULL DEFAULT '0.00',
  `credit` double(10,2) NOT NULL DEFAULT '0.00',
  `cheque` double(10,2) NOT NULL DEFAULT '0.00',
  `cheque_no` varchar(25) NOT NULL,
  `cheque_date` varchar(100) NOT NULL,
  `cheque_status` smallint(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bill`
--

INSERT INTO `bill` (`B_id`, `bill_no`, `shop`, `b_date`, `month`, `year`, `bill_amount`, `discount`, `discounted_amt`, `cost`, `cash`, `credit`, `cheque`, `cheque_no`, `cheque_date`, `cheque_status`) VALUES
(4, '00000004', 'shop 3', '2021-01-12', 1, 2021, 350.00, 0.00, 350.00, 250.00, 150.00, 250.00, 0.00, '', '', 0),
(5, '00000003', 'shop 4', '2021-01-12', 1, 2021, 1500.00, 150.00, 1350.00, 500.00, 1350.00, 0.00, 0.00, '', '', 0),
(6, '00000005', 'Shop 3', '2021-01-13', 1, 2021, 6480.00, 0.00, 6480.00, 5520.00, 0.00, 1480.00, 5000.00, '125478459', '2021-02-06', 1),
(7, '00000006', 'shop 5', '2021-01-13', 1, 2021, 1320.00, 0.00, 1320.00, 1200.00, 1320.00, 0.00, 0.00, '-', '', 0),
(8, '00000007', 'shop 1', '2021-02-14', 2, 2021, 3000.00, 0.00, 3000.00, 2400.00, 0.00, 3000.00, 0.00, '', '', 0),
(9, '00000008', 'Shop 2', '2021-01-14', 1, 2021, 1320.00, 0.00, 1320.00, 1200.00, 1320.00, 0.00, 0.00, '', '', 0),
(10, '00000009', '', '2021-02-14', 2, 2021, 2160.00, 0.00, 2160.00, 1920.00, 2160.00, 0.00, 0.00, '', '', 0),
(11, '00000010', 'shop 5', '2021-02-15', 2, 2021, 3000.00, 0.00, 3000.00, 2400.00, 0.00, 0.00, 3000.00, '14789455', '2021-03-01', 0),
(12, '00000011', 'shop 4', '2021-01-25', 1, 2021, 2160.00, 0.00, 2160.00, 1920.00, 0.00, 2160.00, 0.00, '', '', 0),
(13, '00000012', 'shop 4', '2021-01-24', 1, 2021, 1320.00, 0.00, 1320.00, 1200.00, 1320.00, 0.00, 0.00, '', '', 0),
(14, '00000013', 'shop 2', '2021-01-29', 1, 2021, 2160.00, 0.00, 2160.00, 1920.00, 160.00, 2000.00, 0.00, '', '', 0),
(15, '00000014', 'shop 2', '2021-01-29', 1, 2021, 4320.00, 0.00, 4320.00, 3840.00, 320.00, 0.00, 4000.00, '1478914', '2021-02-06', 1);

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
-- Table structure for table `credit`
--

CREATE TABLE `credit` (
  `c_id` int(11) NOT NULL,
  `invoice_no` varchar(25) NOT NULL,
  `cdate` varchar(100) NOT NULL,
  `month` int(5) NOT NULL,
  `year` int(5) NOT NULL,
  `amount` double(10,2) NOT NULL,
  `type` varchar(10) NOT NULL,
  `remain` double(10,2) NOT NULL,
  `credit_status` smallint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `credit`
--

INSERT INTO `credit` (`c_id`, `invoice_no`, `cdate`, `month`, `year`, `amount`, `type`, `remain`, `credit_status`) VALUES
(1, 'PS1001', '2021-01-23', 1, 2021, 12500.00, 'invoice', 12500.00, 0),
(2, 'PS1001', '2021-01-25', 1, 2021, 2000.00, 'payment', 10500.00, 0),
(3, 'PS1002', '2021-01-29', 1, 2021, 24000.00, 'invoice', 24000.00, 1),
(4, 'PS1002', '2021-01-29', 1, 2022, 4000.00, 'payment', 20000.00, 0),
(5, 'PS1003', '2021-02-22', 2, 2021, 10000.00, 'invoice', 10000.00, 1),
(6, 'PS1004', '2021-02-22', 2, 2021, 5000.00, 'invoice', 5000.00, 1),
(7, 'PS1001', '2021-02-07', 2, 2021, 5500.00, 'payment', 5000.00, 0),
(8, 'PS1001', '2021-02-10', 2, 2021, 5000.00, 'payment', 0.00, 0);

-- --------------------------------------------------------

--
-- Table structure for table `debt`
--

CREATE TABLE `debt` (
  `d_id` int(11) NOT NULL,
  `shop` varchar(100) NOT NULL,
  `ddate` varchar(100) NOT NULL,
  `month` int(5) NOT NULL,
  `year` int(5) NOT NULL,
  `amt` double(10,2) NOT NULL DEFAULT '0.00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `debt`
--

INSERT INTO `debt` (`d_id`, `shop`, `ddate`, `month`, `year`, `amt`) VALUES
(1, 'shop 3', '2021-01-16', 1, 2021, 230.00),
(3, 'shop 3', '2021-01-23', 1, 2021, 250.00),
(5, 'shop 5', '2021-01-29', 1, 2021, 3000.00),
(6, 'shop 3', '2021-01-29', 1, 2021, 250.00),
(7, 'shop 1', '2021-02-01', 2, 2021, 250.00),
(8, 'Shop 2', '2021-02-02', 2, 2021, 230.00);

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
(1, 'MANGANESE', 'R6NT/1B12', '1', 'AA', 100.00, 110.00, 745, 60, 282, 6),
(2, 'CHARGERS', 'R6NT/1B123S', '3', 'AAAA', 160.00, 180.00, 670, 25, 64, 7),
(3, 'ALKALINE', 'LR6T/4B', '2', 'AAA', 100.00, 125.00, 520, 40, 199, 1),
(4, 'ALKALINE', 'LR6T2B', '2', 'AAA', 100.00, 175.00, 1750, 60, 250, 0),
(5, 'EVOLTA', 'MD/W12', '3', 'AA', 45.00, 75.00, 1250, 84, 0, 0);

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
(1, '2021-01-12', 1700.00, 750.00, 250.00, 700.00),
(3, '2021-01-13', 7800.00, 6720.00, 220.00, 860.00),
(4, '2021-01-24', 1320.00, 1200.00, 0.00, 120.00);

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
(6, '00000004', 'R6NT/1B12', 150, 12, 3, 135, 0, 0),
(7, '00000003', 'R6NT/1B123S', 83, 12, 3, 68, 0, 0),
(8, '00000005', 'LR6T/4B', 50, 24, 0, 26, 0, 0),
(9, '00000005', 'R6NT/1B12', 150, 12, 3, 138, 15, 12),
(10, '00000005', 'R6NT/1B123S', 68, 12, 0, 56, 0, 0),
(11, '00000006', 'LR6T/4B', 26, 12, 0, 14, 0, 0),
(12, '00000006', 'R6NT/1B12', 138, 24, 5, 114, 12, 7),
(13, '00000006', 'R6NT/1B12', 114, 12, 3, 102, 7, 4),
(14, '00000007', 'LR6T/4B', 259, 12, 3, 247, 14, 11),
(15, '00000007', 'R6NT/1B12', 342, 24, 6, 318, 19, 13),
(16, '00000007', 'LR6T/4B', 247, 24, 6, 223, 11, 5),
(17, '00000008', 'R6NT/1B12', 318, 12, 3, 306, 13, 10),
(18, '00000008', 'R6NT/1B12', 306, 12, 3, 294, 10, 7),
(19, '00000009', 'R6NT/1B123S', 156, 12, 3, 144, 25, 22),
(20, '00000010', 'LR6T/4B', 223, 24, 4, 199, 5, 1),
(21, '00000011', 'R6NT/1B123S', 144, 12, 3, 132, 22, 19),
(22, '00000011', 'R6NT/1B123S', 132, 12, 0, 120, 19, 19),
(23, '00000012', 'R6NT/1B12', 294, 12, 1, 282, 7, 6),
(24, '00000013', 'R6NT/1B123S', 120, 20, 4, 100, 19, 15),
(25, '00000013', 'R6NT/1B123S', 100, 12, 2, 88, 15, 13),
(26, '00000014', 'R6NT/1B123S', 88, 24, 6, 64, 13, 7);

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
(20, 'MANGANESE', 'R6NT/1B12', 'AA', 240, 15, 102, 4, 342, 19, '2021-01-14'),
(21, 'CHARGERS', 'R6NT/1B123S', 'AAAA', 100, 25, 56, 0, 156, 25, '2021-01-14'),
(22, 'ALKALINE', 'LR6T/4B', 'AAA', 245, 14, 14, 0, 259, 14, '2021-01-14'),
(23, 'ALKALINE', 'LR6T2B', 'AAA', 0, 0, 250, 0, 0, 0, '2021-01-14'),
(24, 'EVOLTA', 'MD/W12', 'AA', 0, 0, 0, 0, 0, 0, '2021-01-14');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `role` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `username`, `password`, `role`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 1),
(2, 'user', 'ee11cbb19052e40b07aac0ca060c23ee', 2);

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
-- Indexes for table `credit`
--
ALTER TABLE `credit`
  ADD PRIMARY KEY (`c_id`);

--
-- Indexes for table `debt`
--
ALTER TABLE `debt`
  ADD PRIMARY KEY (`d_id`);

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
  MODIFY `B_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `credit`
--
ALTER TABLE `credit`
  MODIFY `c_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `debt`
--
ALTER TABLE `debt`
  MODIFY `d_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `item`
--
ALTER TABLE `item`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `profit`
--
ALTER TABLE `profit`
  MODIFY `P_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `sale_items`
--
ALTER TABLE `sale_items`
  MODIFY `sale_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
--
-- AUTO_INCREMENT for table `trxn`
--
ALTER TABLE `trxn`
  MODIFY `trxn_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

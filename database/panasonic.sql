-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 24, 2021 at 09:35 PM
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
  `credit` double(10,2) NOT NULL DEFAULT '0.00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bill`
--

INSERT INTO `bill` (`B_id`, `bill_no`, `shop`, `b_date`, `month`, `year`, `bill_amount`, `discount`, `discounted_amt`, `cost`, `cash`, `credit`) VALUES
(1, '00000001', 'Shop 1', '2021-02-21', 2, 2021, 3480.00, 0.00, 3480.00, 3120.00, 480.00, 1000.00),
(2, '00000002', 'Shop 2', '2022-01-04', 1, 2022, 1320.00, 0.00, 1320.00, 1200.00, 320.00, 0.00),
(3, '00000003', 'Shop 3', '2021-01-02', 1, 2021, 7020.00, 0.00, 7020.00, 4800.00, 20.00, 3000.00);

-- --------------------------------------------------------

--
-- Table structure for table `cash_summary`
--

CREATE TABLE `cash_summary` (
  `cash_id` int(11) NOT NULL,
  `year` varchar(10) NOT NULL,
  `month` varchar(10) NOT NULL,
  `cash` decimal(10,2) NOT NULL DEFAULT '0.00',
  `debt` decimal(10,2) NOT NULL DEFAULT '0.00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cash_summary`
--

INSERT INTO `cash_summary` (`cash_id`, `year`, `month`, `cash`, `debt`) VALUES
(1, '2021', '03', '480.00', '2250.00'),
(2, '2021', '01', '20.00', '0.00'),
(3, '2021', '02', '0.00', '0.00'),
(4, '2021', '04', '0.00', '1000.00'),
(5, '2021', '05', '0.00', '0.00'),
(6, '2021', '06', '0.00', '0.00'),
(7, '2021', '07', '0.00', '0.00'),
(8, '2021', '08', '0.00', '0.00'),
(9, '2021', '09', '0.00', '0.00'),
(10, '2021', '10', '0.00', '0.00'),
(11, '2021', '11', '0.00', '0.00'),
(12, '2021', '12', '0.00', '0.00'),
(13, '2020', '01', '0.00', '0.00'),
(14, '2020', '02', '0.00', '1000.00'),
(15, '2020', '03', '0.00', '0.00'),
(16, '2020', '04', '0.00', '0.00'),
(17, '2020', '05', '0.00', '0.00'),
(18, '2020', '06', '0.00', '0.00'),
(19, '2020', '07', '0.00', '0.00'),
(20, '2020', '08', '0.00', '0.00'),
(21, '2020', '09', '0.00', '0.00'),
(22, '2020', '10', '0.00', '0.00'),
(23, '2020', '11', '0.00', '0.00'),
(24, '2020', '12', '0.00', '0.00'),
(25, '2022', '01', '320.00', '250.00'),
(26, '2022', '02', '0.00', '0.00'),
(27, '2022', '03', '0.00', '0.00'),
(28, '2022', '04', '0.00', '0.00'),
(29, '2022', '05', '0.00', '0.00'),
(30, '2022', '06', '0.00', '0.00'),
(31, '2022', '07', '0.00', '0.00'),
(32, '2022', '08', '0.00', '0.00'),
(33, '2022', '09', '0.00', '0.00'),
(34, '2022', '10', '0.00', '0.00'),
(35, '2022', '11', '0.00', '0.00'),
(36, '2022', '12', '0.00', '0.00');

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
-- Table structure for table `cheques`
--

CREATE TABLE `cheques` (
  `id` int(11) NOT NULL,
  `bill_no` varchar(20) NOT NULL,
  `amount` decimal(10,2) NOT NULL DEFAULT '0.00',
  `cheque_no` varchar(100) NOT NULL,
  `valid_date` text NOT NULL,
  `cheque_status` smallint(6) NOT NULL,
  `ex_date` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cheques`
--

INSERT INTO `cheques` (`id`, `bill_no`, `amount`, `cheque_no`, `valid_date`, `cheque_status`, `ex_date`) VALUES
(1, '00000001', '1000.00', 'A0001', '2021-03-21', 0, '2021-04-01'),
(2, '00000001', '1000.00', 'A0002', '2021-04-21', 1, ''),
(3, '00000002', '500.00', 'A0003', '2022-01-31', 1, ''),
(4, '00000002', '500.00', 'A0004', '2022-02-28', 1, ''),
(5, '00000003', '1000.00', 'BN147853', '2021-03-02', 1, ''),
(6, '00000003', '1000.00', 'BN147854', '2021-04-02', 1, ''),
(7, '00000003', '2000.00', 'BN147852', '2021-02-02', 0, '2021-03-01');

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
(2, 'Shop 1', '2021-03-21', 3, 2021, 250.00),
(4, 'Shop 1', '2021-04-01', 4, 2021, 1000.00),
(5, 'Shop 1', '2022-01-05', 1, 2022, 250.00),
(6, 'Shop 3', '2021-03-01', 3, 2021, 2000.00);

-- --------------------------------------------------------

--
-- Table structure for table `debt_summary`
--

CREATE TABLE `debt_summary` (
  `debt_id` int(11) NOT NULL,
  `shop` varchar(100) NOT NULL,
  `debt` decimal(10,2) NOT NULL DEFAULT '0.00',
  `received` decimal(10,2) NOT NULL DEFAULT '0.00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `debt_summary`
--

INSERT INTO `debt_summary` (`debt_id`, `shop`, `debt`, `received`) VALUES
(1, 'Shop 1', '3000.00', '1500.00'),
(2, 'Shop 2', '1000.00', '0.00'),
(3, 'Shop 3', '7000.00', '2000.00');

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
(1, 'MANGANESE', 'R6NT/1B12', '1', 'AA', 100.00, 110.00, 2905, 6000, 486, 57),
(2, 'CHARGERS', 'R6NT/1B123S', '3', 'AAAA', 160.00, 180.00, 1870, 325, 46, 3),
(3, 'ALKALINE', 'LR6T/4B', '2', 'AAA', 100.00, 125.00, 520, 40, 163, -8),
(4, 'ALKALINE', 'LR6T2B', '2', 'AAA', 100.00, 175.00, 1750, 60, 226, -6),
(5, 'EVOLTA', 'MD/W12', '3', 'AA', 45.00, 75.00, 890, -6, 360, 90);

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
(1, '2021-01-12', 1700.00, 750.00, 150.00, 800.00),
(3, '2021-01-13', 7800.00, 6720.00, 220.00, 860.00),
(4, '2021-01-24', 1320.00, 1200.00, 0.00, 120.00),
(5, '2021-01-02', 7020.00, 4800.00, 200.00, 2020.00);

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
(1, '00000001', 'R6NT/1B12', 270, 12, 3, 258, 3, 0),
(2, '00000001', 'R6NT/1B123S', 58, 12, 3, 46, 6, 3),
(3, '00000002', 'R6NT/1B12', 258, 12, 3, 246, 0, -3),
(4, '00000003', 'LR6T/4B', 175, 12, 3, 163, -5, -8),
(5, '00000003', 'LR6T2B', 250, 24, 6, 226, 0, -6),
(6, '00000003', 'R6NT/1B12', 246, 12, 3, 234, -3, -6);

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
(24, 'EVOLTA', 'MD/W12', 'AA', 0, 0, 0, 0, 0, 0, '2021-01-14'),
(25, 'MANGANESE', 'R6NT/1B12', 'AA', 240, 60, 246, -3, 486, 57, '2021-03-21'),
(26, 'CHARGERS', 'R6NT/1B123S', 'AAAA', 0, 0, 46, 3, 0, 0, '2021-03-21'),
(27, 'ALKALINE', 'LR6T/4B', 'AAA', 0, 0, 175, -5, 0, 0, '2021-03-21'),
(28, 'ALKALINE', 'LR6T2B', 'AAA', 0, 0, 250, 0, 0, 0, '2021-03-21'),
(29, 'EVOLTA', 'MD/W12', 'AA', 360, 90, 0, 0, 360, 90, '2021-03-21');

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
(2, 'user', '202cb962ac59075b964b07152d234b70', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bill`
--
ALTER TABLE `bill`
  ADD PRIMARY KEY (`B_id`);

--
-- Indexes for table `cash_summary`
--
ALTER TABLE `cash_summary`
  ADD PRIMARY KEY (`cash_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `cheques`
--
ALTER TABLE `cheques`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `debt_summary`
--
ALTER TABLE `debt_summary`
  ADD PRIMARY KEY (`debt_id`);

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
  MODIFY `B_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `cash_summary`
--
ALTER TABLE `cash_summary`
  MODIFY `cash_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;
--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `cheques`
--
ALTER TABLE `cheques`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `credit`
--
ALTER TABLE `credit`
  MODIFY `c_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `debt`
--
ALTER TABLE `debt`
  MODIFY `d_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `debt_summary`
--
ALTER TABLE `debt_summary`
  MODIFY `debt_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `item`
--
ALTER TABLE `item`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `profit`
--
ALTER TABLE `profit`
  MODIFY `P_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `sale_items`
--
ALTER TABLE `sale_items`
  MODIFY `sale_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `trxn`
--
ALTER TABLE `trxn`
  MODIFY `trxn_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

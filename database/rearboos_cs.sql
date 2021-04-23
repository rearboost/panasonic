-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Apr 23, 2021 at 10:37 AM
-- Server version: 5.6.38
-- PHP Version: 7.2.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `rearboos_cs`
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
(1, 'Manganese'),
(2, 'Alkaline'),
(3, 'Evolta'),
(4, 'Rechargable'),
(5, 'Chargers'),
(6, 'Lithium Coin'),
(7, 'Torch'),
(8, 'LED Bulb'),
(9, 'Emergency bulb'),
(10, 'GLS bulb'),
(11, 'Maxmo Glue'),
(12, 'Tape'),
(13, 'Maxmo D'),
(14, 'Sticks'),
(15, 'Pen');

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
(1, '00000003', '0.00', '', '', 0, '');

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
(1, 'Manganese', '1B12 ', '1', 'AA', 40.00, 44.00, 4848, 1576, 0, 0),
(2, 'Manganese', '2B24', '2', 'AAA', 80.00, 88.00, 3915, 1275, 0, 0),
(3, 'Maxmo', '3G120', '3', '3G', 40.00, 44.00, 640, 162, 0, 0),
(4, 'Maxmo', '4G122', '4', '4G', 56.00, 61.60, 768, 192, 0, 0),
(5, 'Maxmo', 'Max D 20MT/2s', '5', 'D', 176.00, 193.60, 306, 53, 0, 0),
(7, 'Manganese', 'R20DT/2s', '6', 'D', 200.00, 220.00, 234, 20, 0, 0),
(8, 'Emergency', '7w emergency bulb', '7', '7w', 1240.00, 1364.00, 52, 0, 0, 0),
(9, 'Pen', 'Pen', '8', 'Speed', 8.00, 8.50, 10638, 0, 0, 0),
(10, 'Tape', 'Tape', '9', 'Bl', 56.00, 61.60, 714, 179, 0, 0),
(11, 'Sticks', 'Sticks', '10', '31g', 64.00, 70.40, 750, 150, 0, 0),
(12, 'LED', '3w LED ', '12', '3w', 264.00, 290.40, 250, 77, 0, 0),
(13, 'LED', '5w LED ', '12', '5w', 312.00, 343.20, 180, 65, 0, 0),
(14, 'LED', '7w LED ', '12', '7w', 392.00, 431.20, 170, 52, 0, 0),
(15, 'LED', '9w LED ', '12', '9w', 472.00, 519.20, 100, 35, 0, 0),
(16, 'LED', '12w LED ', '12', '12w', 632.00, 695.20, 100, 31, 0, 0),
(17, 'LED', '15w LED ', '12', '15w', 712.00, 783.20, 55, 20, 0, 0),
(18, 'Alkaline', 'AL AA', '11', 'AA', 200.00, 220.00, 36, 0, 0, 0),
(19, 'Alkaline', 'AL AAA', '11', 'AAA', 200.00, 220.00, 62, 0, 0, 0),
(20, 'Manganese', '9V 22DT/1S', '13', '9V', 148.00, 162.80, 10, 0, 0, 0),
(21, 'Manganese', '9V 22DT/1B', '13', '9V', 152.00, 167.20, 23, 0, 0, 0),
(22, 'Manganese', '9V 22NT/1B', '13', '9V', 160.00, 176.00, 92, 0, 0, 0),
(23, 'Manganese', 'C 14DT/2S', '13', 'C', 152.00, 167.20, 72, 0, 0, 0),
(24, 'Manganese', 'C 14NT/2B', '13', 'C', 160.00, 176.00, 38, 0, 0, 0),
(25, 'Torch', '3507', '14', '2S', 136.00, 149.60, 156, 13, 0, 0),
(26, 'Torch', '3017', '14', '2S', 200.00, 220.00, 102, 16, 0, 0),
(27, 'Lithium', 'A23 LR-V08', '15', 'A23', 0.00, 149.60, 0, 0, 0, 0),
(28, 'GLS', 'GLS maxmo', '16', 'W', 72.00, 79.20, 23, 4, 0, 0);

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

-- --------------------------------------------------------

--
-- Table structure for table `temp`
--

CREATE TABLE `temp` (
  `id` int(11) NOT NULL,
  `item` varchar(200) NOT NULL,
  `tot_sale` varchar(200) NOT NULL,
  `sale` varchar(200) NOT NULL,
  `af_sale` varchar(200) NOT NULL,
  `tot_free` varchar(200) NOT NULL,
  `free` varchar(200) NOT NULL,
  `af_free` varchar(200) NOT NULL,
  `tot_pur` varchar(200) NOT NULL,
  `tot_sales` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `temp_cheque`
--

CREATE TABLE `temp_cheque` (
  `id` int(11) NOT NULL,
  `cheque` varchar(200) NOT NULL,
  `cheque_no` varchar(200) NOT NULL,
  `cheque_date` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
(1, 'Manganese', '1B12 ', 'AA', 0, 0, 0, 0, 0, 0, '2021-04-19'),
(2, 'Manganese', '2B24', 'AAA', 0, 0, 0, 0, 0, 0, '2021-04-19'),
(3, 'Maxmo', '3G120', '3G', 0, 0, 0, 0, 0, 0, '2021-04-19'),
(4, 'Maxmo', '4G122', '4G', 0, 0, 0, 0, 0, 0, '2021-04-19'),
(5, 'Maxmo', 'Max D 20MT/2s', 'D', 0, 0, 0, 0, 0, 0, '2021-04-19'),
(6, 'Manganese', 'R20DT/2s', 'D', 0, 0, 0, 0, 0, 0, '2021-04-19'),
(7, 'Emergency', '7w emergency bulb', '7w', 0, 0, 0, 0, 0, 0, '2021-04-19'),
(8, 'Pen', 'Pen', 'Speed', 0, 0, 0, 0, 0, 0, '2021-04-19'),
(9, 'Tape', 'Tape', 'Bl', 0, 0, 0, 0, 0, 0, '2021-04-19'),
(10, 'Sticks', 'Sticks', '31g', 0, 0, 0, 0, 0, 0, '2021-04-19'),
(11, 'LED', '3w LED ', '3w', 0, 0, 0, 0, 0, 0, '2021-04-19'),
(12, 'LED', '5w LED ', '5w', 0, 0, 0, 0, 0, 0, '2021-04-19'),
(13, 'LED', '7w LED ', '7w', 0, 0, 0, 0, 0, 0, '2021-04-19'),
(14, 'LED', '9w LED ', '9w', 0, 0, 0, 0, 0, 0, '2021-04-19'),
(15, 'LED', '12w LED ', '12w', 0, 0, 0, 0, 0, 0, '2021-04-19'),
(16, 'LED', '15w LED ', '15w', 0, 0, 0, 0, 0, 0, '2021-04-19'),
(17, 'Alkaline', 'AL AA', 'AA', 0, 0, 0, 0, 0, 0, '2021-04-19'),
(18, 'Alkaline', 'AL AAA', 'AAA', 0, 0, 0, 0, 0, 0, '2021-04-19'),
(19, 'Manganese', '9V 22DT/1S', '9V', 0, 0, 0, 0, 0, 0, '2021-04-19'),
(20, 'Manganese', '9V 22DT/1B', '9V', 0, 0, 0, 0, 0, 0, '2021-04-19'),
(21, 'Manganese', '9V 22NT/1B', '9V', 0, 0, 0, 0, 0, 0, '2021-04-19'),
(22, 'Manganese', 'C 14DT/2S', 'C', 0, 0, 0, 0, 0, 0, '2021-04-19'),
(23, 'Manganese', 'C 14NT/2B', 'C', 0, 0, 0, 0, 0, 0, '2021-04-19'),
(24, 'Torch', '3507', '2S', 0, 0, 0, 0, 0, 0, '2021-04-19'),
(25, 'Torch', '3017', '2S', 0, 0, 0, 0, 0, 0, '2021-04-19'),
(26, 'Lithium', 'A23 LR-V08', 'A23', 0, 0, 0, 0, 0, 0, '2021-04-19'),
(27, 'GLS', 'GLS maxmo', 'W', 0, 0, 0, 0, 0, 0, '2021-04-19');

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
-- Indexes for table `temp`
--
ALTER TABLE `temp`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `temp_cheque`
--
ALTER TABLE `temp_cheque`
  ADD PRIMARY KEY (`id`);

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
  MODIFY `B_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cash_summary`
--
ALTER TABLE `cash_summary`
  MODIFY `cash_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `cheques`
--
ALTER TABLE `cheques`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `credit`
--
ALTER TABLE `credit`
  MODIFY `c_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `debt`
--
ALTER TABLE `debt`
  MODIFY `d_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `debt_summary`
--
ALTER TABLE `debt_summary`
  MODIFY `debt_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `item`
--
ALTER TABLE `item`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `profit`
--
ALTER TABLE `profit`
  MODIFY `P_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sale_items`
--
ALTER TABLE `sale_items`
  MODIFY `sale_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `temp`
--
ALTER TABLE `temp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `temp_cheque`
--
ALTER TABLE `temp_cheque`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `trxn`
--
ALTER TABLE `trxn`
  MODIFY `trxn_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

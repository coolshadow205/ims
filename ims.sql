-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 01, 2020 at 04:35 PM
-- Server version: 10.3.16-MariaDB
-- PHP Version: 7.3.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ims`
--

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `cust_id` int(11) NOT NULL,
  `cust_fname` varchar(25) NOT NULL,
  `cust_lname` varchar(25) NOT NULL,
  `cust_email` text NOT NULL,
  `cust_phone` varchar(15) NOT NULL,
  `cust_gender` varchar(10) NOT NULL,
  `cust_alt_phone` varchar(15) NOT NULL,
  `cust_state` varchar(25) NOT NULL,
  `cust_city` varchar(25) NOT NULL,
  `cust_code` varchar(10) NOT NULL,
  `cust_address` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`cust_id`, `cust_fname`, `cust_lname`, `cust_email`, `cust_phone`, `cust_gender`, `cust_alt_phone`, `cust_state`, `cust_city`, `cust_code`, `cust_address`) VALUES
(1, 'Mehul', 'Gajinkar', 'mg@gmail.com', '8523697410', 'male', '', 'Maharashtra', 'Mumbai', '400025', 'Nahur'),
(2, 'Jay', 'Ashra', 'jay@gmail.com', '0123456789', 'male', '9632587410', 'Maharashtra', 'Mumbai', '502362', 'SomeAddress'),
(3, 'Aniket', 'Konkar', 'ak@gmail.com', '2587413690', 'male', '2587413690', 'Maharashtra', 'Mumbai', '254136', 'Thane'),
(4, 'Rahul', 'Bhanushali', 'rmb@gmail.com', '8524697130', 'male', '', 'Maharashtra', 'Mumbai', '254136', 'Dombivali');

-- --------------------------------------------------------

--
-- Table structure for table `invoice`
--

CREATE TABLE `invoice` (
  `invoice_number` int(11) NOT NULL,
  `cust_id` int(11) NOT NULL,
  `grand_total` float NOT NULL,
  `invoice_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `invoice`
--

INSERT INTO `invoice` (`invoice_number`, `cust_id`, `grand_total`, `invoice_date`) VALUES
(1, 1, 1200.63, '2020-03-18'),
(2, 1, 1300.63, '2020-03-18'),
(3, 1, 1300.63, '2020-03-18'),
(4, 3, 1300.63, '2020-03-15'),
(5, 1, 68000, '2020-03-25'),
(6, 1, 68000, '2020-03-25'),
(7, 1, 68000, '2020-03-25'),
(8, 1, 68000, '2020-03-25'),
(9, 1, 68000, '2020-03-25'),
(10, 1, 68000, '2020-03-25'),
(11, 1, 68000, '2020-03-25'),
(12, 1, 68000, '2020-03-25'),
(13, 1, 92540, '2020-03-25'),
(14, 1, 16000, '2020-03-27'),
(15, 1, 167500, '2020-03-27'),
(16, 1, 92000, '2020-03-27'),
(17, 1, 92000, '2020-03-27'),
(18, 1, 92000, '2020-03-27'),
(19, 1, 92000, '2020-03-27'),
(20, 1, 92000, '2020-03-27'),
(21, 1, 68040, '2020-03-27'),
(22, 1, 4520, '2020-03-27'),
(23, 1, 93020, '2020-03-27'),
(24, 1, 72500, '2020-03-27'),
(25, 1, 68020, '2020-03-27'),
(26, 1, 84000, '2020-03-27'),
(27, 1, 68020, '2020-03-27'),
(28, 1, 128000, '2020-03-27'),
(29, 1, 105000, '2020-03-27'),
(30, 1, 120000, '2020-03-27'),
(31, 1, 188000, '2020-03-27'),
(32, 1, 60000, '2020-03-27'),
(33, 1, 89500, '2020-03-27'),
(34, 1, 75000, '2020-03-27'),
(35, 1, 134000, '2020-03-27'),
(36, 1, 163020, '2020-03-27'),
(37, 1, 125000, '2020-03-27'),
(38, 1, 104000, '2020-03-27'),
(39, 1, 72500, '2020-03-27'),
(40, 1, 35020, '2020-03-27'),
(41, 1, 16020, '2020-03-27'),
(42, 1, 51020, '2020-03-27'),
(43, 1, 72500, '2020-03-27'),
(44, 1, 50000, '2020-03-27'),
(45, 3, 231020, '2020-03-27'),
(46, 2, 706000, '2020-03-27'),
(47, 3, 91000, '2020-03-27'),
(48, 4, 17800, '2020-03-28'),
(49, 3, 113000, '2020-03-24'),
(50, 1, 6775000, '2020-04-01');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `prod_id` int(11) NOT NULL,
  `supp_id` int(11) NOT NULL,
  `prod_name` text NOT NULL,
  `prod_company_name` text NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` float NOT NULL,
  `prod_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`prod_id`, `supp_id`, `prod_name`, `prod_company_name`, `quantity`, `price`, `prod_date`) VALUES
(2, 1, 'i7', 'Intel', 0, 68000, '2020-03-25'),
(12, 9, 'SteelsSeries Sensei', 'SteelSeries', 488, 4000, '2020-03-21'),
(13, 1, 'Predator Helios 300', 'Acer', 79, 80000, '2020-03-21'),
(14, 5, 'Nvidia Geforce GTX 1050 Ti', 'Nvidia', 499, 14800, '2020-03-21'),
(15, 5, 'Razer DeathAdder', 'Razer', 3997, 3000, '2020-03-22'),
(16, 1, 'OnePlus 5T', 'OnePlus', 100, 35000, '2020-03-22'),
(17, 1, 'OnePlus 3T', 'OnePlus', 23, 25000, '2020-03-22'),
(18, 1, 'Mouse', 'Mouse1234', 10, 4500, '2020-03-24');

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `sale_id` int(11) NOT NULL,
  `invoice_number` int(11) NOT NULL,
  `prod_id` int(11) NOT NULL,
  `quantity` int(10) NOT NULL,
  `amount` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`sale_id`, `invoice_number`, `prod_id`, `quantity`, `amount`) VALUES
(1, 3, 1, 2, 1300.63),
(2, 4, 2, 2, 1300.63),
(3, 4, 2, 2, 1300),
(4, 8, 0, 1, 68000),
(5, 9, 0, 1, 68000),
(6, 10, 2, 1, 68000),
(7, 12, 2, 1, 68000),
(8, 13, 12, 2, 20),
(9, 13, 13, 5, 4500),
(10, 13, 16, 2, 35000),
(11, 14, 14, 1, 16000),
(12, 15, 16, 2, 35000),
(13, 16, 14, 2, 16000),
(14, 16, 16, 1, 35000),
(15, 17, 14, 2, 16000),
(16, 18, 14, 2, 16000),
(17, 19, 14, 2, 16000),
(18, 20, 16, 1, 35000),
(19, 20, 17, 1, 25000),
(20, 20, 14, 2, 16000),
(21, 21, 12, 2, 20),
(22, 21, 2, 1, 68000),
(23, 22, 12, 1, 20),
(24, 22, 13, 1, 4500),
(25, 23, 2, 1, 68000),
(26, 23, 12, 1, 20),
(27, 23, 17, 1, 25000),
(28, 24, 2, 1, 68000),
(29, 24, 13, 1, 4500),
(30, 25, 2, 1, 68000),
(31, 25, 12, 1, 20),
(32, 26, 2, 1, 68000),
(33, 26, 14, 1, 16000),
(34, 27, 2, 1, 68000),
(35, 28, 2, 1, 68000),
(36, 29, 15, 2, 15000),
(37, 30, 17, 2, 25000),
(38, 31, 2, 1, 68000),
(39, 31, 17, 2, 25000),
(40, 31, 16, 2, 35000),
(41, 32, 16, 1, 35000),
(42, 32, 17, 1, 25000),
(43, 33, 13, 1, 4500),
(44, 33, 16, 1, 35000),
(45, 33, 17, 2, 25000),
(46, 34, 15, 1, 15000),
(47, 34, 16, 1, 35000),
(48, 34, 17, 1, 25000),
(49, 35, 2, 1, 68000),
(50, 35, 16, 1, 35000),
(51, 35, 14, 1, 16000),
(52, 35, 15, 1, 15000),
(53, 36, 12, 1, 20),
(54, 36, 16, 2, 35000),
(55, 36, 17, 1, 25000),
(56, 36, 2, 1, 68000),
(57, 37, 17, 2, 25000),
(58, 37, 17, 3, 25000),
(59, 42, 12, 1, 20),
(60, 42, 14, 1, 16000),
(61, 42, 16, 1, 35000),
(62, 44, 15, 1, 15000),
(63, 44, 16, 1, 35000),
(64, 45, 12, 1, 20),
(65, 45, 2, 2, 68000),
(66, 45, 16, 2, 35000),
(67, 45, 17, 1, 25000),
(68, 46, 2, 2, 68000),
(69, 46, 16, 2, 35000),
(70, 46, 17, 20, 25000),
(71, 47, 13, 1, 80000),
(72, 47, 15, 1, 3000),
(73, 47, 12, 2, 4000),
(74, 48, 14, 1, 14800),
(75, 48, 15, 1, 3000),
(76, 49, 18, 10, 4500),
(77, 49, 2, 1, 68000),
(78, 50, 2, 99, 68000),
(79, 50, 12, 10, 4000),
(80, 50, 15, 1, 3000);

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `supp_id` int(11) NOT NULL,
  `supp_fname` varchar(25) NOT NULL,
  `supp_lname` varchar(25) NOT NULL,
  `supp_email` text NOT NULL,
  `supp_phone` varchar(15) NOT NULL,
  `business_name` varchar(25) NOT NULL,
  `business_address` text NOT NULL,
  `business_email` text NOT NULL,
  `business_phone` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`supp_id`, `supp_fname`, `supp_lname`, `supp_email`, `supp_phone`, `business_name`, `business_address`, `business_email`, `business_phone`) VALUES
(1, 'Jay', 'Ashra', 'jayashra@gmail.com', '4567891230', 'dontknow', '0123456789', 'Room no:06, Mulji Ladha BLDG , Khot Lane , Ghatkopar(W)', 'jay.ashra251198'),
(5, 'Jennifer', 'Goot', 'jen@gmail.com', '0123456789', 'business', '', '0123456789', ''),
(10, 'Mehul', 'Gajinkar', 'mg@gmail.com', '7531598462', 'UIDesigner', '3578946122', 'Address', 'ui@gmail.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`cust_id`);

--
-- Indexes for table `invoice`
--
ALTER TABLE `invoice`
  ADD PRIMARY KEY (`invoice_number`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`prod_id`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`sale_id`);

--
-- Indexes for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`supp_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `cust_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `invoice`
--
ALTER TABLE `invoice`
  MODIFY `invoice_number` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `prod_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `sale_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `supp_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 23, 2023 at 03:33 PM
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
-- Database: `myproject`
--

-- --------------------------------------------------------

--
-- Table structure for table `brand`
--

CREATE TABLE `brand` (
  `brand_id` int(3) UNSIGNED ZEROFILL NOT NULL COMMENT 'รหัสยี่ห้อ',
  `brand_name` varchar(50) NOT NULL COMMENT 'ชื่อยี่ห้อ'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `brand`
--

INSERT INTO `brand` (`brand_id`, `brand_name`) VALUES
(001, 'Honda'),
(005, 'Suzuki'),
(002, 'Yamaha');

-- --------------------------------------------------------

--
-- Table structure for table `model`
--

CREATE TABLE `model` (
  `model_id` int(3) UNSIGNED ZEROFILL NOT NULL COMMENT 'รหัสรุ่น',
  `model_name` varchar(50) NOT NULL COMMENT 'ชื่อรุ่น'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `model`
--

INSERT INTO `model` (`model_id`, `model_name`) VALUES
(004, 'Honda Click 160'),
(001, 'Honda New Winner X'),
(006, 'Suzuki Burgman 400 '),
(005, 'Suzuki GSX-S 750'),
(003, 'Yamaha Aerox '),
(007, 'Yamaha E01');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `pro_id` varchar(50) NOT NULL COMMENT 'ทะเบียนรถ',
  `model_id` int(3) UNSIGNED ZEROFILL NOT NULL COMMENT 'รหัสรุ่น',
  `brand_id` int(3) UNSIGNED ZEROFILL NOT NULL COMMENT 'รหัสยี่ห้อ',
  `price` float NOT NULL COMMENT 'ราคา',
  `image` varchar(100) NOT NULL COMMENT 'รูปภาพ'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`pro_id`, `model_id`, `brand_id`, `price`, `image`) VALUES
('HJ321', 001, 001, 220, 'pro_63bef7f8259f8.jpg'),
('JAV888', 001, 001, 190, 'pro_63eda8441f906.jpg'),
('JK333', 003, 002, 600, 'pro_63f6e5f87136e.png'),
('JKK889', 006, 005, 580, 'pro_63d513f16f3c1.jpg'),
('SK770', 005, 005, 770, 'pro_63bef77e80851.jpg'),
('YU778', 007, 002, 780, 'pro_63bef48f52780.jpg'),
('กบ335', 005, 005, 800, 'pro_63beeefd6c3e0.jpg'),
('ขต191', 006, 005, 191, 'pro_63bef86314116.png'),
('ฑศ333', 006, 005, 333, 'pro_63bef40094362.png'),
('ดว255', 007, 002, 255, 'pro_63bef8893d2b3.jpg'),
('ทศ515', 001, 001, 515, 'pro_63bef7231bfe1.jpg'),
('ธษ660', 004, 001, 660, 'pro_63bef3cf2a3ab.png'),
('นง888', 003, 002, 556, 'pro_63ae89040e8d3.JPG'),
('นย222', 004, 001, 222, 'pro_63bef8137dba7.png'),
('มง445น', 006, 005, 366, 'pro_63eba3df4b15f.png'),
('สง779', 003, 002, 770, 'pro_63eba369cd672.JPG');

-- --------------------------------------------------------

--
-- Table structure for table `promise`
--

CREATE TABLE `promise` (
  `promise_id` int(4) UNSIGNED ZEROFILL NOT NULL COMMENT 'รหัสใบเช่า',
  `pro_id` varchar(50) NOT NULL COMMENT 'ทะเบียน',
  `image` varchar(100) NOT NULL COMMENT 'รูปรถ',
  `price` float NOT NULL COMMENT 'ราคา',
  `firstname` varchar(50) NOT NULL COMMENT 'ชื่อคนเช่า',
  `lastname` varchar(50) NOT NULL COMMENT 'สกุลคนเช่า',
  `date_get` date NOT NULL COMMENT 'วันที่เช่า',
  `date_return` date NOT NULL COMMENT 'วันที่คืน'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `promise`
--

INSERT INTO `promise` (`promise_id`, `pro_id`, `image`, `price`, `firstname`, `lastname`, `date_get`, `date_return`) VALUES
(0045, 'HJ321', 'pro_63bef7f8259f8.jpg', 880, 'ปรีชา', 'สามารถ', '2023-02-23', '2023-02-27'),
(0046, 'JKK889', 'pro_63d513f16f3c1.jpg', 1160, 'เสกฝรร', 'ฟันหมอ', '2023-02-23', '2023-02-25'),
(0047, 'JAV888', 'pro_63eda8441f906.jpg', 950, 'เสกฝรร', 'ฟันหมอ', '2023-02-23', '2023-02-28');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(4) UNSIGNED ZEROFILL NOT NULL COMMENT 'รหัสคนเช่า',
  `user_email` varchar(50) NOT NULL COMMENT 'อีเมล',
  `password` varchar(128) NOT NULL COMMENT 'รหัสผ่านคนเช่า',
  `title_name` varchar(10) NOT NULL COMMENT 'คำนำหน้า',
  `fname` varchar(50) NOT NULL COMMENT 'ชื่อคนเช่า',
  `lname` varchar(50) NOT NULL COMMENT 'นามสกุลคนเช่า',
  `phone` varchar(10) NOT NULL COMMENT 'เบอร์โทรศัพท์'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `user_email`, `password`, `title_name`, `fname`, `lname`, `phone`) VALUES
(0018, 'fung@hotmail.com', '2c438800b1837ad2561f0013da0e150e558f68fae5bc533d26e5580d0ba4ff1549be2904328f6c9a399a01df9fc336041d011e4e7568cede9ec02dd30ced265c', 'นาย', 'ณัฐวัตร ', 'ทนันชัย', '0630750064'),
(0020, 'bizskit@hotmail.ac.th', '2c438800b1837ad2561f0013da0e150e558f68fae5bc533d26e5580d0ba4ff1549be2904328f6c9a399a01df9fc336041d011e4e7568cede9ec02dd30ced265c', 'นาง', 'nattawat', 'thnunchai', '0849774834');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `brand`
--
ALTER TABLE `brand`
  ADD PRIMARY KEY (`brand_id`),
  ADD UNIQUE KEY `brand_name` (`brand_name`);

--
-- Indexes for table `model`
--
ALTER TABLE `model`
  ADD PRIMARY KEY (`model_id`),
  ADD UNIQUE KEY `model_name` (`model_name`) USING BTREE;

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`pro_id`),
  ADD KEY `model_id` (`model_id`),
  ADD KEY `brand_id` (`brand_id`);

--
-- Indexes for table `promise`
--
ALTER TABLE `promise`
  ADD PRIMARY KEY (`promise_id`),
  ADD UNIQUE KEY `pro_id` (`pro_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `user_email` (`user_email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `brand`
--
ALTER TABLE `brand`
  MODIFY `brand_id` int(3) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT COMMENT 'รหัสยี่ห้อ', AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `model`
--
ALTER TABLE `model`
  MODIFY `model_id` int(3) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT COMMENT 'รหัสรุ่น', AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `promise`
--
ALTER TABLE `promise`
  MODIFY `promise_id` int(4) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT COMMENT 'รหัสใบเช่า', AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(4) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT COMMENT 'รหัสคนเช่า', AUTO_INCREMENT=38;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`model_id`) REFERENCES `model` (`model_id`),
  ADD CONSTRAINT `product_ibfk_2` FOREIGN KEY (`brand_id`) REFERENCES `brand` (`brand_id`);

--
-- Constraints for table `promise`
--
ALTER TABLE `promise`
  ADD CONSTRAINT `fk_proid` FOREIGN KEY (`pro_id`) REFERENCES `product` (`pro_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

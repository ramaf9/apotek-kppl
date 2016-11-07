-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 07, 2016 at 01:44 PM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 5.5.37

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `apotek-kppl`
--

-- --------------------------------------------------------

--
-- Table structure for table `obat`
--

CREATE TABLE `obat` (
  `o_id` int(11) NOT NULL,
  `o_name` varchar(255) NOT NULL,
  `o_price` int(11) NOT NULL,
  `o_unit` varchar(255) NOT NULL,
  `o_quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `obat`
--

INSERT INTO `obat` (`o_id`, `o_name`, `o_price`, `o_unit`, `o_quantity`) VALUES
(1, 'Vitamin c', 2000, 'BOTOL', 15),
(2, 'Betadin', 3000, 'PIL', -16);

-- --------------------------------------------------------

--
-- Table structure for table `pengadaan_obat`
--

CREATE TABLE `pengadaan_obat` (
  `po_id` int(11) NOT NULL,
  `po_obat` int(11) NOT NULL,
  `po_quantity` int(11) NOT NULL,
  `po_vendor` varchar(255) NOT NULL,
  `po_status` int(11) NOT NULL,
  `po_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pengadaan_obat`
--

INSERT INTO `pengadaan_obat` (`po_id`, `po_obat`, `po_quantity`, `po_vendor`, `po_status`, `po_date`) VALUES
(1, 1, 30, 'PT MEDIA', 1, '2016-10-10'),
(2, 2, 30, 'PT MEDIA', 0, '2016-10-10');

-- --------------------------------------------------------

--
-- Table structure for table `request_obat`
--

CREATE TABLE `request_obat` (
  `ro_id` int(11) NOT NULL,
  `ro_obat` int(11) NOT NULL,
  `ro_quantity` int(11) NOT NULL,
  `ro_pasien` varchar(255) NOT NULL,
  `ro_status` int(11) NOT NULL,
  `ro_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `request_obat`
--

INSERT INTO `request_obat` (`ro_id`, `ro_obat`, `ro_quantity`, `ro_pasien`, `ro_status`, `ro_date`) VALUES
(1, 1, 10, 'Rama rahmanda', 1, '2016-10-10'),
(2, 1, 5, 'Kuntoy', 1, '2016-10-10'),
(3, 2, 1, 'anon', 0, '2016-11-05'),
(4, 2, 1, 'anon', 0, '2016-11-05'),
(5, 2, 1, 'anon', 0, '2016-11-05'),
(6, 2, 1, 'anon', 0, '2016-11-05'),
(7, 2, 1, 'anon', 0, '2016-11-05'),
(8, 2, 1, 'anon', 0, '2016-11-05'),
(9, 2, 1, 'anon', 0, '2016-11-05'),
(10, 2, 1, 'anon', 0, '2016-11-05'),
(11, 2, 1, 'anon', 0, '2016-11-05'),
(12, 2, 1, 'anon', 0, '2016-11-05'),
(13, 2, 1, 'anon', 0, '2016-11-05'),
(14, 2, 1, 'anon', 0, '2016-11-05'),
(15, 2, 1, 'anon', 0, '2016-11-05'),
(17, 2, 1, 'anon', 0, '2016-11-05'),
(18, 2, 1, 'anon', 1, '2016-11-05'),
(19, 2, 1, 'anon', 1, '2016-11-05'),
(20, 2, 1, 'anon', 1, '2016-11-05'),
(21, 2, 1, 'anon', 1, '2016-11-05'),
(22, 2, 1, 'anon', 1, '2016-11-07'),
(23, 2, 1, 'anon', 1, '2016-11-07'),
(24, 2, 1, 'anon', 1, '2016-11-07'),
(25, 2, 1, 'anon', 1, '2016-11-07'),
(26, 2, 1, 'anon', 1, '2016-11-07'),
(27, 2, 1, 'anon', 1, '2016-11-07'),
(28, 2, 1, 'anon', 1, '2016-11-07'),
(29, 2, 1, 'anon', 1, '2016-11-07'),
(30, 2, 1, 'anon', 1, '2016-11-07'),
(31, 2, 1, 'anon', 1, '2016-11-07'),
(32, 2, 1, 'anon', 1, '2016-11-07'),
(33, 2, 1, 'anon', 1, '2016-11-07'),
(34, 2, 1, 'anon', 1, '2016-11-07');

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `r_id` int(11) NOT NULL,
  `r_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`r_id`, `r_name`) VALUES
(1, 'pemilik'),
(2, 'admin'),
(3, 'kasir'),
(4, 'apoteker'),
(5, 'petugas pengadaan');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `u_id` int(11) NOT NULL,
  `u_name` varchar(255) NOT NULL,
  `u_username` varchar(255) NOT NULL,
  `u_password` varchar(255) NOT NULL,
  `u_email` varchar(255) NOT NULL,
  `u_telp` varchar(255) NOT NULL,
  `u_role` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`u_id`, `u_name`, `u_username`, `u_password`, `u_email`, `u_telp`, `u_role`) VALUES
(1, 'rama', 'rama', 'e04f28cc33cb20274dd3ff44e600a923', 'yey@ahoy', '00000', 2),
(2, 'rama', 'rama2', '94adb63732daedf231b8785ce735fb59', 'asd@go.co', '123', 4),
(3, 'rama', 'rama3', 'cc2ff02a2e8ad3e9abd757b33336621c', 'rama@ad.co', '123123', 5),
(4, 'rama', 'rama4', '17c88d1388b27e7f8c762758815d3b24', 'asd@go.co', '12313', 3),
(51, 'rama', 'rama5', '53fe1f67423e15a18bd9fae5f3c4f41a', 'yeyrama@gmail.com', '000000', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `obat`
--
ALTER TABLE `obat`
  ADD PRIMARY KEY (`o_id`);

--
-- Indexes for table `pengadaan_obat`
--
ALTER TABLE `pengadaan_obat`
  ADD PRIMARY KEY (`po_id`),
  ADD KEY `po_obat` (`po_obat`);

--
-- Indexes for table `request_obat`
--
ALTER TABLE `request_obat`
  ADD PRIMARY KEY (`ro_id`),
  ADD KEY `ro_obat` (`ro_obat`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`r_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`u_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `obat`
--
ALTER TABLE `obat`
  MODIFY `o_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `pengadaan_obat`
--
ALTER TABLE `pengadaan_obat`
  MODIFY `po_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `request_obat`
--
ALTER TABLE `request_obat`
  MODIFY `ro_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `u_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `pengadaan_obat`
--
ALTER TABLE `pengadaan_obat`
  ADD CONSTRAINT `FK_POBAT_OBAT` FOREIGN KEY (`po_obat`) REFERENCES `obat` (`o_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `request_obat`
--
ALTER TABLE `request_obat`
  ADD CONSTRAINT `FK_ROBAT_OBAT` FOREIGN KEY (`ro_obat`) REFERENCES `obat` (`o_id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

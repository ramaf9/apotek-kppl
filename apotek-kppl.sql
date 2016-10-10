-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 10, 2016 at 01:03 PM
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
(1, 'Vitamin c', 2000, 'BOTOL', 0),
(2, 'Betadin', 3000, 'PIL', 1);

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
(1, 1, 30, 'PT MEDIA', 0, '2016-10-10'),
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
(2, 1, 5, 'Kuntoy', 0, '2016-10-10');

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
(1, 'rama', 'rama', 'rama', 'yey@ahoy', '00000', 3);

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
  ADD PRIMARY KEY (`po_id`);

--
-- Indexes for table `request_obat`
--
ALTER TABLE `request_obat`
  ADD PRIMARY KEY (`ro_id`);

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
  MODIFY `o_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `pengadaan_obat`
--
ALTER TABLE `pengadaan_obat`
  MODIFY `po_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `request_obat`
--
ALTER TABLE `request_obat`
  MODIFY `ro_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `u_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

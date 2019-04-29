-- phpMyAdmin SQL Dump
-- version 4.1.6
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 25, 2019 at 08:19 PM
-- Server version: 5.6.16
-- PHP Version: 5.5.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `car`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `id_admin` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(10) NOT NULL,
  `password` varchar(10) NOT NULL,
  `name` varchar(100) NOT NULL,
  `no` varchar(100) NOT NULL,
  PRIMARY KEY (`id_admin`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id_admin`, `username`, `password`, `name`, `no`) VALUES
(1, 'ashim', 'ashim1106', 'Ahmad Ashim Abdulhakim', '628953714');

-- --------------------------------------------------------

--
-- Table structure for table `caring`
--

CREATE TABLE IF NOT EXISTS `caring` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `no` varchar(100) NOT NULL,
  `date` datetime NOT NULL,
  `status` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `caring`
--

INSERT INTO `caring` (`id`, `type`, `name`, `no`, `date`, `status`) VALUES
(8, 'Inspection', 'Ashim', '0877777', '2019-04-17 07:00:00', 'Requested');

-- --------------------------------------------------------

--
-- Table structure for table `coating`
--

CREATE TABLE IF NOT EXISTS `coating` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `no` varchar(100) NOT NULL,
  `date` datetime NOT NULL,
  `status` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `coating`
--

INSERT INTO `coating` (`id`, `type`, `name`, `no`, `date`, `status`) VALUES
(1, 'Glass', 'Ashim', '0895371532364', '2019-04-11 21:09:00', 'Booked'),
(2, 'Body', 'Bima', '0895371532364', '2019-04-11 08:08:00', 'Requested'),
(3, 'Both', 'Hammam', '0895371532364', '2019-04-11 19:06:00', 'Booked');

-- --------------------------------------------------------

--
-- Table structure for table `detailing`
--

CREATE TABLE IF NOT EXISTS `detailing` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `no` varchar(100) NOT NULL,
  `date` datetime NOT NULL,
  `status` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `detailing`
--

INSERT INTO `detailing` (`id`, `type`, `name`, `no`, `date`, `status`) VALUES
(1, 'Interior', 'Ashim', '0895371532364', '2019-04-11 21:09:00', 'Booked'),
(2, 'Exterior', 'Bima', '0895371532364', '2019-04-11 08:08:00', 'Requested'),
(3, 'Engine Bay', 'Hammam', '0895371532364', '2019-04-11 19:06:00', 'Booked'),
(5, 'Undercarriage', 'Coba', '0000000', '2019-04-12 03:03:00', 'Requested');

-- --------------------------------------------------------

--
-- Table structure for table `kaki`
--

CREATE TABLE IF NOT EXISTS `kaki` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `F1` varchar(100) NOT NULL,
  `F2` varchar(100) NOT NULL,
  `F3` varchar(100) NOT NULL,
  `F4` varchar(100) NOT NULL,
  `goal` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=923 ;

--
-- Dumping data for table `kaki`
--

INSERT INTO `kaki` (`id`, `F1`, `F2`, `F3`, `F4`, `goal`) VALUES
(215, 'tidak stabil', 'terlalu empuk', 'rembes', 'berbunyi', 'ganti shock breaker'),
(922, 'stabil', 'normal', 'tidak rembes', 'tidak berbunyi', 'spooring & balancing');

-- --------------------------------------------------------

--
-- Table structure for table `kondisi_kaki`
--

CREATE TABLE IF NOT EXISTS `kondisi_kaki` (
  `id` int(11) NOT NULL,
  `field` varchar(100) NOT NULL,
  `nama_field` varchar(100) NOT NULL,
  `kondisi` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kondisi_kaki`
--

INSERT INTO `kondisi_kaki` (`id`, `field`, `nama_field`, `kondisi`) VALUES
(1, 'F1', 'Kestabilan Saat Berbelok', 'tidak stabil'),
(2, 'F1', 'Kestabilan Saat Berbelok', 'stabil'),
(3, 'F2', 'Bantingan Suspensi', 'terlalu empuk'),
(4, 'F2', 'Bantingan Suspensi', 'terlalu keras'),
(5, 'F2', 'Bantingan Suspensi', 'normal'),
(6, 'F3', 'Shock Breaker', 'rembes'),
(7, 'F3', 'Shock Breaker', 'tidak rembes'),
(8, 'F4', 'Bunyi Saat Mobil Mengayun', 'berbunyi'),
(9, 'F4', 'Bunyi Saat Mobil Mengayun', 'tidak berbunyi'),
(10, 'goal', 'Hasil', 'ganti shock breaker'),
(11, 'goal', 'Hasil', 'spooring & balancing');

-- --------------------------------------------------------

--
-- Table structure for table `kondisi_mesin`
--

CREATE TABLE IF NOT EXISTS `kondisi_mesin` (
  `id` int(11) NOT NULL,
  `field` varchar(100) NOT NULL,
  `nama_field` varchar(100) NOT NULL,
  `kondisi` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kondisi_mesin`
--

INSERT INTO `kondisi_mesin` (`id`, `field`, `nama_field`, `kondisi`) VALUES
(1, 'F1', 'Menghidupkan Mesin', 'sulit'),
(2, 'F1', 'Menghidupkan Mesin', 'mudah'),
(3, 'F2', 'Suara Mesin', 'kasar'),
(4, 'F2', 'Suara Mesin', 'sedikit kasar'),
(5, 'F2', 'Suara Mesin', 'halus'),
(6, 'F3', 'Tarikan Mesin', 'menurun'),
(7, 'F3', 'Tarikan Mesin', 'standart'),
(8, 'F4', 'Konsumsi BBM', 'boros'),
(9, 'F4', 'Konsumsi BBM', 'irit'),
(10, 'goal', 'Hasil', 'tune up mesin'),
(11, 'goal', 'Hasil', 'ganti oli saja');

-- --------------------------------------------------------

--
-- Table structure for table `mesin`
--

CREATE TABLE IF NOT EXISTS `mesin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `F1` varchar(100) NOT NULL,
  `F2` varchar(100) NOT NULL,
  `F3` varchar(100) NOT NULL,
  `F4` varchar(100) NOT NULL,
  `goal` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=923 ;

--
-- Dumping data for table `mesin`
--

INSERT INTO `mesin` (`id`, `F1`, `F2`, `F3`, `F4`, `goal`) VALUES
(1, 'sulit', 'kasar', 'menurun', 'boros', 'tune up mesin'),
(2, 'mudah', 'halus', 'standart', 'irit', 'ganti oli saja');

-- --------------------------------------------------------

--
-- Table structure for table `wash`
--

CREATE TABLE IF NOT EXISTS `wash` (
  `id_wash` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `no` varchar(100) NOT NULL,
  `date` datetime NOT NULL,
  `status` varchar(100) NOT NULL,
  PRIMARY KEY (`id_wash`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `wash`
--

INSERT INTO `wash` (`id_wash`, `type`, `name`, `no`, `date`, `status`) VALUES
(5, 'Regular', 'Bima', '0895371532364', '2019-04-11 08:08:00', 'Requested'),
(6, 'Regular', 'Hammam', '0895371532364', '2019-04-11 19:06:00', 'Booked'),
(7, 'Regular', 'Ashim', '0895371532365', '2019-04-26 14:00:00', 'Booked'),
(8, 'Premium', 'Anjar', '0895371532364', '2019-04-27 12:59:00', 'Requested');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

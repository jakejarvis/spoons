-- phpMyAdmin SQL Dump
-- version 3.3.10.4
-- http://www.phpmyadmin.net
--
-- Host: mysql.jakejarvis.dreamhosters.com
-- Generation Time: May 19, 2013 at 08:43 AM
-- Server version: 5.1.56
-- PHP Version: 5.2.17

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `spoons`
--

-- --------------------------------------------------------

--
-- Table structure for table `spooners`
--

CREATE TABLE IF NOT EXISTS `spooners` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_num` int(11) NOT NULL,
  `first` text NOT NULL,
  `last` text NOT NULL,
  `staff` int(1) NOT NULL DEFAULT '0',
  `spooned` int(1) NOT NULL DEFAULT '0',
  `time_spooned` timestamp NOT NULL DEFAULT '2013-01-01 00:00:00',
  `spooned_by` int(11) NOT NULL DEFAULT '0',
  `target_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

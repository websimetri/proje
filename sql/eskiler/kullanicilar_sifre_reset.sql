-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 28, 2015 at 05:17 PM
-- Server version: 5.5.43-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `bulut`
--

-- --------------------------------------------------------

--
-- Table structure for table `kullanicilar_sifre_reset`
--

CREATE TABLE IF NOT EXISTS `kullanicilar_sifre_reset` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kul_id` int(11) NOT NULL COMMENT 'kullanıcının kullanıcılar tablosundaki id si',
  `reset_key` varchar(50) COLLATE utf8_bin NOT NULL COMMENT 'kullanıcıya gönderdiğimiz random key',
  `reset_time` datetime NOT NULL COMMENT 'kullanıcının şifre yenileme isteği yaptığı tarih',
  `kullanildi` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `reset_key` (`reset_key`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='şifre yenileme isteği yapan kullanıcıya ait bilgiler' AUTO_INCREMENT=2 ;

--
-- Dumping data for table `kullanicilar_sifre_reset`
--

INSERT INTO `kullanicilar_sifre_reset` (`id`, `kul_id`, `reset_key`, `reset_time`, `kullanildi`) VALUES
(1, 5, 'qweasd', '2015-04-28 16:35:14', 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

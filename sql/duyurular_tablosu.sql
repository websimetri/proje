-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 21, 2015 at 03:17 PM
-- Server version: 5.5.41-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.7

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
-- Table structure for table `duyurular`
--

CREATE TABLE IF NOT EXISTS `duyurular` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_kullanici` int(11) NOT NULL,
  `okunma` tinyint(1) NOT NULL DEFAULT '0',
  `konu` varchar(150) COLLATE utf8_bin NOT NULL,
  `mesaj` text COLLATE utf8_bin NOT NULL,
  `tarih_gonderi` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=37 ;

--
-- Dumping data for table `duyurular`
--

INSERT INTO `duyurular` (`id`, `id_kullanici`, `okunma`, `konu`, `mesaj`, `tarih_gonderi`) VALUES
(1, 2, 0, 'Yasin Merhaba.', 'Burada mesaj yer alacak.', '2015-04-21 03:08:08'),
(2, 2, 1, 'Okunmus mesaj', 'Burası okundu falan.', '2015-04-20 00:00:00'),
(9, 1, 0, 'Bütün Kullanıcılar', 'Bütün kullanıcılara deneme mesajı', '2015-04-21 13:56:57'),
(10, 2, 0, 'Bütün Kullanıcılar', 'Bütün kullanıcılara deneme mesajı', '2015-04-21 13:56:57'),
(11, 3, 0, 'Bütün Kullanıcılar', 'Bütün kullanıcılara deneme mesajı', '2015-04-21 13:56:57'),
(12, 5, 0, 'Bütün Kullanıcılar', 'Bütün kullanıcılara deneme mesajı', '2015-04-21 13:56:57'),
(17, 2, 0, 'Bütün Şirket Adminleri', 'Bütün şirket adminlerine deneme mesajı', '2015-04-21 13:57:46'),
(18, 5, 0, 'Bütün Şirket Adminleri', 'Bütün şirket adminlerine deneme mesajı', '2015-04-21 13:57:46'),
(29, 2, 0, 'Şirket Adminlerine mesaj', 'Bütün şirket adminlerine mesaj.', '2015-04-21 14:11:53'),
(30, 5, 0, 'Şirket Adminlerine mesaj', 'Bütün şirket adminlerine mesaj.', '2015-04-21 14:11:53'),
(31, 2, 0, 'Şirket adminleri TinyMCE', '<p>TinyMCE ile&nbsp;<strong>mesaj yollama</strong> işlemi.</p>', '2015-04-21 14:18:53'),
(32, 5, 0, 'Şirket adminleri TinyMCE', '<p>TinyMCE ile&nbsp;<strong>mesaj yollama</strong> işlemi.</p>', '2015-04-21 14:18:54'),
(33, 1, 0, 'Kullanıcılar', '<p>Deneme kullanıcılar.&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<p><strong>asdadsasdasda</strong></p>\r\n<p>&nbsp;</p>\r\n<p>14:36:32</p>', '2015-04-21 14:36:44'),
(34, 2, 0, 'Kullanıcılar', '<p>Deneme kullanıcılar.&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<p><strong>asdadsasdasda</strong></p>\r\n<p>&nbsp;</p>\r\n<p>14:36:32</p>', '2015-04-21 14:36:44'),
(35, 3, 0, 'Kullanıcılar', '<p>Deneme kullanıcılar.&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<p><strong>asdadsasdasda</strong></p>\r\n<p>&nbsp;</p>\r\n<p>14:36:32</p>', '2015-04-21 14:36:44'),
(36, 5, 0, 'Kullanıcılar', '<p>Deneme kullanıcılar.&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<p><strong>asdadsasdasda</strong></p>\r\n<p>&nbsp;</p>\r\n<p>14:36:32</p>', '2015-04-21 14:36:44');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

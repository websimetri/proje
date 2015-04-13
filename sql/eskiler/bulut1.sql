-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 10, 2015 at 08:08 PM
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
-- Table structure for table `kullanicilar`
--

CREATE TABLE IF NOT EXISTS `kullanicilar` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Kullanıcı d''si',
  `adi` varchar(100) COLLATE utf8_bin NOT NULL COMMENT 'Kullanıcı adı.',
  `soyadi` varchar(100) COLLATE utf8_bin NOT NULL COMMENT 'Kullanıcı soyadı.',
  `mail` varchar(100) COLLATE utf8_bin NOT NULL COMMENT 'Kullanıcı mail''i.',
  `sifre` varchar(32) COLLATE utf8_bin NOT NULL COMMENT 'Kullanıcı şifresi',
  `tarih_kayit` datetime NOT NULL COMMENT 'Kullanıcı kayıt tarihi.',
  `tarih_son_giris` datetime NOT NULL COMMENT 'Kullanıcı son giriş.',
  PRIMARY KEY (`id`),
  UNIQUE KEY `mail` (`mail`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=6 ;

--
-- Dumping data for table `kullanicilar`
--

INSERT INTO `kullanicilar` (`id`, `adi`, `soyadi`, `mail`, `sifre`, `tarih_kayit`, `tarih_son_giris`) VALUES
(1, 'Serkan', 'Serkan', 'mail@mail.com', '827ccb0eea8a706c4c34a16891f84e7b', '2015-04-07 05:08:09', '2015-04-10 00:00:00'),
(2, 'Yasin', 'Kesim', 'yasin@yasin', '827ccb0eea8a706c4c34a16891f84e7b', '2015-04-09 00:00:00', '2015-04-09 00:00:00'),
(3, 'Yasinin', 'Çalışanı', 'calisan@yasin.com', '827ccb0eea8a706c4c34a16891f84e7b', '2015-04-10 00:00:00', '2015-04-10 00:00:00'),
(4, 'Yasinin', 'Müşterisi', 'musteri@yasin.com', '827ccb0eea8a706c4c34a16891f84e7b', '2015-04-10 00:00:00', '2015-04-10 00:00:00'),
(5, 'Serkan', 'Serkan', 'serkan.ongan.web@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', '2015-04-10 00:00:00', '2015-04-10 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `kullanicilar_roller`
--

CREATE TABLE IF NOT EXISTS `kullanicilar_roller` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_kullanici` int(11) NOT NULL,
  `id_rol` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=6 ;

--
-- Dumping data for table `kullanicilar_roller`
--

INSERT INTO `kullanicilar_roller` (`id`, `id_kullanici`, `id_rol`) VALUES
(1, 1, 0),
(2, 2, 1),
(3, 3, 2),
(4, 4, 3),
(5, 5, 1);

-- --------------------------------------------------------

--
-- Table structure for table `kullanicilar_sifre_reset`
--

CREATE TABLE IF NOT EXISTS `kullanicilar_sifre_reset` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kul_id` int(11) NOT NULL COMMENT 'kullanıcının kullanıcılar tablosundaki id si',
  `reset_key` varchar(50) COLLATE utf8_bin NOT NULL COMMENT 'kullanıcıya gönderdiğimiz random key',
  `reset_time` datetime NOT NULL COMMENT 'kullanıcının şifre yenileme isteği yaptığı tarih',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='şifre yenileme isteği yapan kullanıcıya ait bilgiler' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `kullanicilar_sirket`
--

CREATE TABLE IF NOT EXISTS `kullanicilar_sirket` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_kullanici` int(11) NOT NULL,
  `id_sirket` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=5 ;

--
-- Dumping data for table `kullanicilar_sirket`
--

INSERT INTO `kullanicilar_sirket` (`id`, `id_kullanici`, `id_sirket`) VALUES
(1, 2, 1),
(2, 3, 1),
(3, 4, 1),
(4, 5, 2);

-- --------------------------------------------------------

--
-- Table structure for table `roller`
--

CREATE TABLE IF NOT EXISTS `roller` (
  `id` int(11) NOT NULL,
  `rol` varchar(50) COLLATE utf8_bin NOT NULL,
  `aciklama` text COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `roller`
--

INSERT INTO `roller` (`id`, `rol`, `aciklama`) VALUES
(0, 'Super Admin', 'Süper Admin.Biziz yani.'),
(1, 'Şirket Admin', 'Şirketin admini veya sahibi.'),
(2, 'Şirket Kullanıcısı', 'Şirketin çalışanları.'),
(3, 'Şirket Müşterisi', 'Şirketlerin Müşterileri.');

-- --------------------------------------------------------

--
-- Table structure for table `sektor`
--

CREATE TABLE IF NOT EXISTS `sektor` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sektor_adi` varchar(100) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=5 ;

--
-- Dumping data for table `sektor`
--

INSERT INTO `sektor` (`id`, `sektor_adi`) VALUES
(1, 'Enerji'),
(2, 'Mobilya'),
(3, 'Teknoloji'),
(4, 'Emlak');

-- --------------------------------------------------------

--
-- Table structure for table `sirket`
--

CREATE TABLE IF NOT EXISTS `sirket` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Şirket id.',
  `id_sektor` int(11) NOT NULL COMMENT 'Şirketin sektör id.',
  `adi` varchar(255) COLLATE utf8_bin NOT NULL COMMENT 'Şirket adı.',
  `adres` varchar(255) COLLATE utf8_bin NOT NULL COMMENT 'Şirket adres.',
  `tel` varchar(20) COLLATE utf8_bin NOT NULL COMMENT 'Şirket telefon.',
  `logo` text COLLATE utf8_bin NOT NULL COMMENT 'Şirket logosu linki.',
  `premium` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'Premium durumu.',
  `ref_kod` varchar(255) COLLATE utf8_bin NOT NULL COMMENT 'Şirket API''si için.',
  `yetkili_adi` varchar(100) COLLATE utf8_bin NOT NULL,
  `yetkili_soyadi` varchar(100) COLLATE utf8_bin NOT NULL,
  `yetkili_mail` varchar(100) COLLATE utf8_bin NOT NULL,
  `yetkili_sifre` varchar(32) COLLATE utf8_bin NOT NULL,
  `tarih_kayit` datetime NOT NULL COMMENT 'Şirket kayıt tarihi.',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=3 ;

--
-- Dumping data for table `sirket`
--

INSERT INTO `sirket` (`id`, `id_sektor`, `adi`, `adres`, `tel`, `logo`, `premium`, `ref_kod`, `yetkili_adi`, `yetkili_soyadi`, `yetkili_mail`, `yetkili_sifre`, `tarih_kayit`) VALUES
(1, 4, 'Yasin Emlak', 'Karşıda bir yerler.', '+90 212 999 99 99', 'logo.png', 0, 'yasin_ref_kod', 'Yasin', 'Kesim', 'yasin@yasin.com', '827ccb0eea8a706c4c34a16891f84e7b', '2015-04-09 00:00:00'),
(2, 1, 'Serkan LTD.', 'Çıkmaz sokak.', '+90 212 999 99 88', 'logo.png', 0, 'serkan_ref_kod', 'Serkan', 'Serkan', 'serkan.ongan.web@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', '2015-04-10 00:00:00');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

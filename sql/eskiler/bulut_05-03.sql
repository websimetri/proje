-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 03, 2015 at 05:53 PM
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
-- Table structure for table `anket_secenek`
--

CREATE TABLE IF NOT EXISTS `anket_secenek` (
  `id` int(11) NOT NULL,
  `sirket_id` int(11) NOT NULL,
  `anket_id` int(11) NOT NULL,
  `secenek` varchar(300) COLLATE utf8_bin NOT NULL COMMENT 'ankete verilecek cevaplar',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `anket_yonetimi`
--

CREATE TABLE IF NOT EXISTS `anket_yonetimi` (
  `anket_id` int(11) NOT NULL,
  `sirket_id` int(11) NOT NULL,
  `anket_baslik` varchar(500) COLLATE utf8_bin NOT NULL COMMENT 'anket soruları',
  PRIMARY KEY (`anket_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `begenme_yonetimi`
--

CREATE TABLE IF NOT EXISTS `begenme_yonetimi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sirket_id` int(11) NOT NULL,
  `kul_id` varchar(50) NOT NULL,
  `urun_id` varchar(50) NOT NULL,
  `eklenme_tarihi` datetime NOT NULL,
  `oylama` int(3) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `begenme_yonetimi`
--

INSERT INTO `begenme_yonetimi` (`id`, `sirket_id`, `kul_id`, `urun_id`, `eklenme_tarihi`, `oylama`) VALUES
(1, 1, '1', '1', '2015-04-30 09:15:12', 1),
(2, 1, '1', '3', '2015-04-30 09:15:16', 0),
(3, 1, '1', '2', '2015-04-30 09:15:34', 0),
(4, 1, '2', '4', '2015-04-30 09:16:24', 0),
(5, 1, '2', '1', '2015-04-30 10:28:14', -1),
(6, 1, '2', '2', '2015-04-30 10:28:30', 0),
(7, 1, '2', '3', '2015-05-01 21:49:45', 5),
(11, 1, '1', '7', '2015-05-01 22:32:31', 5);

-- --------------------------------------------------------

--
-- Table structure for table `duyuru`
--

CREATE TABLE IF NOT EXISTS `duyuru` (
  `id` int(11) NOT NULL,
  `sirket_id` int(11) NOT NULL,
  `duyuru_baslik` varchar(300) COLLATE utf8_bin NOT NULL,
  `duyuru_detay` varchar(500) COLLATE utf8_bin NOT NULL,
  `durum` enum('0','1') COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=39 ;

--
-- Dumping data for table `duyurular`
--

INSERT INTO `duyurular` (`id`, `id_kullanici`, `okunma`, `konu`, `mesaj`, `tarih_gonderi`) VALUES
(1, 2, 1, 'Yasin Merhaba.', 'Burada mesaj yer alacak.', '2015-04-21 03:08:08'),
(9, 1, 0, 'Bütün Kullanıcılar', 'Bütün kullanıcılara deneme mesajı', '2015-04-21 13:56:57'),
(10, 2, 1, 'Bütün Kullanıcılar', 'Bütün kullanıcılara deneme mesajı', '2015-04-21 13:56:57'),
(11, 3, 0, 'Bütün Kullanıcılar', 'Bütün kullanıcılara deneme mesajı', '2015-04-21 13:56:57'),
(12, 5, 0, 'Bütün Kullanıcılar', 'Bütün kullanıcılara deneme mesajı', '2015-04-21 13:56:57'),
(17, 2, 0, 'Bütün Şirket Adminleri', 'Bütün şirket adminlerine deneme mesajı. <p>Deneme kullanıcılar.&nbsp;</p>\n<p>&nbsp;</p>\n<p><strong>asdadsasdasda</strong></p>\n<p>&nbsp;</p>\n<p>14:36:32</p> <p>Deneme kullanıcılar.&nbsp;</p>\n<p>&nbsp;</p>\n<p><strong>asdadsasdasda</strong></p>\n<p>&nbsp;</p>\n<p>14:36:32</p><p>Deneme kullanıcılar.&nbsp;</p>\n<p>&nbsp;</p>\n<p><strong>asdadsasdasda</strong></p>\n<p>&nbsp;</p>\n<p>14:36:32</p>', '2015-04-21 13:57:46'),
(18, 5, 1, 'Bütün Şirket Adminleri', 'Bütün şirket adminlerine deneme mesajı', '2015-04-21 13:57:46'),
(29, 2, 0, 'Şirket Adminlerine mesaj', 'Bütün şirket adminlerine mesaj.', '2015-04-21 14:11:53'),
(30, 5, 0, 'Şirket Adminlerine mesaj', 'Bütün şirket adminlerine mesaj.', '2015-04-21 14:11:53'),
(32, 5, 0, 'Şirket adminleri TinyMCE', '<p>TinyMCE ile&nbsp;<strong>mesaj yollama</strong> işlemi.</p>', '2015-04-21 14:18:54'),
(33, 1, 0, 'Kullanıcılar', '<p>Deneme kullanıcılar.&nbsp;</p>\n<p>&nbsp;</p>\n<p><strong>asdadsasdasda</strong></p>\n<p>&nbsp;</p>\n<p>14:36:32</p>\n\n', '2015-04-21 14:36:44'),
(34, 2, 1, 'Kullanıcılar', '<p>Deneme kullanıcılar.&nbsp;</p>\n<p>&nbsp;</p>\n<p><strong>asdadsasdasda</strong></p>\n<p>&nbsp;</p>\n<p>14:36:32</p>', '2015-04-21 14:36:44'),
(35, 3, 0, 'Kullanıcılar', '<p>Deneme kullanıcılar.&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<p><strong>asdadsasdasda</strong></p>\r\n<p>&nbsp;</p>\r\n<p>14:36:32</p>', '2015-04-21 14:36:44'),
(36, 5, 0, 'Kullanıcılar', '<p>Deneme kullanıcılar.&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<p><strong>asdadsasdasda</strong></p>\r\n<p>&nbsp;</p>\r\n<p>14:36:32</p>', '2015-04-21 14:36:44'),
(37, 2, 0, 'Merhaba Şirket Adminleri', '<p><strong>nabersiniz?</strong></p>\r\n<p>lorem falan ipsum.</p>', '2015-04-21 17:32:49'),
(38, 5, 0, 'Merhaba Şirket Adminleri', '<p><strong>nabersiniz?</strong></p>\r\n<p>lorem falan ipsum.</p>', '2015-04-21 17:32:49');

-- --------------------------------------------------------

--
-- Table structure for table `formlar`
--

CREATE TABLE IF NOT EXISTS `formlar` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_sirket` int(11) NOT NULL,
  `adi` varchar(100) COLLATE utf8_bin NOT NULL,
  `html` text COLLATE utf8_bin NOT NULL,
  `json` text COLLATE utf8_bin NOT NULL,
  `tarih` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=9 ;

--
-- Dumping data for table `formlar`
--

INSERT INTO `formlar` (`id`, `id_sirket`, `adi`, `html`, `json`, `tarih`) VALUES
(6, 1, 'New Form', '<form class="form-horizontal" >\r\n<fieldset>\r\n\r\n\r\n<legend>New Form</legend>\r\n\r\n\r\n<div class="control-group">\r\n  <label class="control-label" for="textinput-0">Text Input</label>\r\n  <div class="controls">\r\n    <input id="textinput-0" name="textinput-0" type="text" placeholder="placeholder" class="input-xlarge">\r\n    <p class="help-block">help</p>\r\n  </div>\r\n</div>\r\n\r\n\r\n<div class="control-group">\r\n  <label class="control-label" for="passwordinput-0">Password Input</label>\r\n  <div class="controls">\r\n    <input id="passwordinput-0" name="passwordinput-0" type="password" placeholder="placeholder" class="input-xlarge">\r\n    <p class="help-block">help</p>\r\n  </div>\r\n</div>\r\n\r\n</fieldset>\r\n</form>\r\n', '{\n    "tag": "html",\n    "children": [\n        {\n            "tag": "body",\n            "children": [\n                {\n                    "tag": "form",\n                    "class": "form-horizontal",\n                    "html": "\\r\\n",\n                    "children": [\n                        {\n                            "tag": "fieldset",\n                            "children": [\n                                {\n                                    "tag": "legend",\n                                    "html": "New Form"\n                                },\n                                {\n                                    "tag": "div",\n                                    "class": "control-group",\n                                    "html": "\\r\\n",\n                                    "children": [\n                                        {\n                                            "tag": "label",\n                                            "class": "control-label",\n                                            "for": "textinput-0",\n                                            "html": "Text Input"\n                                        },\n                                        {\n                                            "tag": "div",\n                                            "class": "controls",\n                                            "html": "\\r\\n  ",\n                                            "children": [\n                                                {\n                                                    "tag": "input",\n                                                    "id": "textinput-0",\n                                                    "name": "textinput-0",\n                                                    "type": "text",\n                                                    "placeholder": "placeholder",\n                                                    "class": "input-xlarge"\n                                                },\n                                                {\n                                                    "tag": "p",\n                                                    "class": "help-block",\n                                                    "html": "help"\n                                                }\n                                            ]\n                                        }\n                                    ]\n                                },\n                                {\n                                    "tag": "div",\n                                    "class": "control-group",\n                                    "html": "\\r\\n",\n                                    "children": [\n                                        {\n                                            "tag": "label",\n                                            "class": "control-label",\n                                            "for": "passwordinput-0",\n                                            "html": "Password Input"\n                                        },\n                                        {\n                                            "tag": "div",\n                                            "class": "controls",\n                                            "html": "\\r\\n  ",\n                                            "children": [\n                                                {\n                                                    "tag": "input",\n                                                    "id": "passwordinput-0",\n                                                    "name": "passwordinput-0",\n                                                    "type": "password",\n                                                    "placeholder": "placeholder",\n                                                    "class": "input-xlarge"\n                                                },\n                                                {\n                                                    "tag": "p",\n                                                    "class": "help-block",\n                                                    "html": "help"\n                                                }\n                                            ]\n                                        }\n                                    ]\n                                }\n                            ],\n                            "html": "\\r\\n\\r\\n"\n                        }\n                    ]\n                }\n            ]\n        }\n    ]\n}', '2015-04-27 16:47:35'),
(7, 1, 'Form Name', '<form class="form-horizontal" >\r\n<fieldset>\r\n\r\n\r\n<legend>Form Name</legend>\r\n\r\n\r\n<div class="control-group">\r\n  <label class="control-label" for="textinput-0">Text Input</label>\r\n  <div class="controls">\r\n    <input id="textinput-0" name="textinput-0" type="text" placeholder="placeholder" class="input-xlarge">\r\n    <p class="help-block">help</p>\r\n  </div>\r\n</div>\r\n\r\n</fieldset>\r\n</form>\r\n', '{\n    "tag": "html",\n    "children": [\n        {\n            "tag": "body",\n            "children": [\n                {\n                    "tag": "form",\n                    "class": "form-horizontal",\n                    "html": "\\r\\n",\n                    "children": [\n                        {\n                            "tag": "fieldset",\n                            "children": [\n                                {\n                                    "tag": "legend",\n                                    "html": "Form Name"\n                                },\n                                {\n                                    "tag": "div",\n                                    "class": "control-group",\n                                    "html": "\\r\\n",\n                                    "children": [\n                                        {\n                                            "tag": "label",\n                                            "class": "control-label",\n                                            "for": "textinput-0",\n                                            "html": "Text Input"\n                                        },\n                                        {\n                                            "tag": "div",\n                                            "class": "controls",\n                                            "html": "\\r\\n  ",\n                                            "children": [\n                                                {\n                                                    "tag": "input",\n                                                    "id": "textinput-0",\n                                                    "name": "textinput-0",\n                                                    "type": "text",\n                                                    "placeholder": "placeholder",\n                                                    "class": "input-xlarge"\n                                                },\n                                                {\n                                                    "tag": "p",\n                                                    "class": "help-block",\n                                                    "html": "help"\n                                                }\n                                            ]\n                                        }\n                                    ]\n                                }\n                            ],\n                            "html": "\\r\\n\\r\\n"\n                        }\n                    ]\n                }\n            ]\n        }\n    ]\n}', '2015-04-27 16:56:00'),
(8, 1, 'Form Name', '<form class="form-horizontal" >\r\n<fieldset>\r\n\r\n\r\n<legend>Form Name</legend>\r\n\r\n\r\n<div class="control-group">\r\n  <label class="control-label" for="textinput-0">Text Input</label>\r\n  <div class="controls">\r\n    <input id="textinput-0" name="textinput-0" type="text" placeholder="placeholder" class="input-xlarge">\r\n    <p class="help-block">help</p>\r\n  </div>\r\n</div>\r\n\r\n\r\n<div class="control-group">\r\n  <label class="control-label" for="singlebutton-0">Single Button</label>\r\n  <div class="controls">\r\n    <button id="singlebutton-0" name="singlebutton-0" class="btn btn-primary">Button</button>\r\n  </div>\r\n</div>\r\n\r\n</fieldset>\r\n</form>\r\n', '{\n    "tag": "html",\n    "children": [\n        {\n            "tag": "body",\n            "children": [\n                {\n                    "tag": "form",\n                    "class": "form-horizontal",\n                    "html": "\\r\\n",\n                    "children": [\n                        {\n                            "tag": "fieldset",\n                            "children": [\n                                {\n                                    "tag": "legend",\n                                    "html": "Form Name"\n                                },\n                                {\n                                    "tag": "div",\n                                    "class": "control-group",\n                                    "html": "\\r\\n",\n                                    "children": [\n                                        {\n                                            "tag": "label",\n                                            "class": "control-label",\n                                            "for": "textinput-0",\n                                            "html": "Text Input"\n                                        },\n                                        {\n                                            "tag": "div",\n                                            "class": "controls",\n                                            "html": "\\r\\n  ",\n                                            "children": [\n                                                {\n                                                    "tag": "input",\n                                                    "id": "textinput-0",\n                                                    "name": "textinput-0",\n                                                    "type": "text",\n                                                    "placeholder": "placeholder",\n                                                    "class": "input-xlarge"\n                                                },\n                                                {\n                                                    "tag": "p",\n                                                    "class": "help-block",\n                                                    "html": "help"\n                                                }\n                                            ]\n                                        }\n                                    ]\n                                },\n                                {\n                                    "tag": "div",\n                                    "class": "control-group",\n                                    "html": "\\r\\n",\n                                    "children": [\n                                        {\n                                            "tag": "label",\n                                            "class": "control-label",\n                                            "for": "singlebutton-0",\n                                            "html": "Single Button"\n                                        },\n                                        {\n                                            "tag": "div",\n                                            "class": "controls",\n                                            "html": "\\r\\n  ",\n                                            "children": [\n                                                {\n                                                    "tag": "button",\n                                                    "id": "singlebutton-0",\n                                                    "name": "singlebutton-0",\n                                                    "class": "btn btn-primary",\n                                                    "html": "Button"\n                                                }\n                                            ]\n                                        }\n                                    ]\n                                }\n                            ],\n                            "html": "\\r\\n\\r\\n"\n                        }\n                    ]\n                }\n            ]\n        }\n    ]\n}', '2015-04-28 17:26:20');

-- --------------------------------------------------------

--
-- Table structure for table `galeriler`
--

CREATE TABLE IF NOT EXISTS `galeriler` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_sirket` int(11) NOT NULL,
  `isim` varchar(100) COLLATE utf8_bin NOT NULL,
  `aciklama` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `on_resim` int(11) NOT NULL,
  `aktif` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=4 ;

-- --------------------------------------------------------

--
-- Table structure for table `galeriler_resimler`
--

CREATE TABLE IF NOT EXISTS `galeriler_resimler` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_galeri` int(11) NOT NULL,
  `url` text COLLATE utf8_bin NOT NULL,
  `alt` varchar(255) COLLATE utf8_bin DEFAULT NULL COMMENT 'resim açıklaması',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=13 ;

-- --------------------------------------------------------

--
-- Table structure for table `haberler`
--

CREATE TABLE IF NOT EXISTS `haberler` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_sirket` int(11) NOT NULL,
  `kategori_id` int(11) NOT NULL,
  `baslik` varchar(200) COLLATE utf8_bin NOT NULL,
  `kisa_aciklama` varchar(500) COLLATE utf8_bin NOT NULL,
  `uzun_aciklama` text COLLATE utf8_bin NOT NULL,
  `resim` varchar(500) COLLATE utf8_bin NOT NULL,
  `tarih` datetime NOT NULL,
  `durum` int(11) NOT NULL DEFAULT '1' COMMENT '1 aktif, 2 pasif',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=8 ;

--
-- Dumping data for table `haberler`
--

INSERT INTO `haberler` (`id`, `id_sirket`, `kategori_id`, `baslik`, `kisa_aciklama`, `uzun_aciklama`, `resim`, `tarih`, `durum`) VALUES
(1, 1, 3, 'Haberlerin 1.', 'Haber kısa açıklama. Değişik.', 'Buralar değişecek. Umarım.\r\n\r\nBakalım.', '', '2015-04-22 00:00:00', 1),
(2, 1, 5, 'İkinci Haber', '2. Kısa', '2. Uzun', '', '2015-04-13 00:00:00', 1),
(3, 1, 1, 'Pasif Haber', 'Pasif Kısa', 'Pasif Uzun', 'http://www.followingthenerd.com/site/wp-content/uploads/avatar.jpg_274898881.jpg', '2015-04-07 00:00:00', 2),
(4, 1, 5, 'sdada', 'dsada', 'dasdadadad', 'collide1.jpg', '2015-04-30 18:00:28', 1),
(5, 1, 5, 'Son Haber', 'Son Haber Açıklama', 'Deneme bir iki. Dosyasız.', '', '2015-04-30 18:01:25', 1),
(6, 1, 1, 'Dosyalı', 'asdadad', 'asdadsadadsadsada', 'collide1.jpg', '2015-04-30 18:01:45', 2),
(7, 1, 4, 'asdad', 'asdasd', 'asdasdadsasda', 'collide.png', '2015-04-30 18:28:01', 1);

-- --------------------------------------------------------

--
-- Table structure for table `haber_kategori`
--

CREATE TABLE IF NOT EXISTS `haber_kategori` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_sirket` int(11) NOT NULL,
  `adi` varchar(100) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=9 ;

--
-- Dumping data for table `haber_kategori`
--

INSERT INTO `haber_kategori` (`id`, `id_sirket`, `adi`) VALUES
(1, 1, 'Spor'),
(3, 1, 'Kitap'),
(4, 1, 'Duyuru'),
(5, 1, 'Deneme'),
(6, 2, 'Adsada'),
(7, 2, 'asdasda'),
(8, 1, 'Merhaba');

-- --------------------------------------------------------

--
-- Table structure for table `icerik_yonetimi`
--

CREATE TABLE IF NOT EXISTS `icerik_yonetimi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sirket_id` int(11) NOT NULL,
  `baslik` varchar(100) COLLATE utf8_bin NOT NULL,
  `kisa_aciklama` varchar(255) COLLATE utf8_bin NOT NULL,
  `detay` varchar(500) COLLATE utf8_bin NOT NULL,
  `eklenme_tarihi` datetime NOT NULL,
  `durum` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `id_2` (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=18 ;

--
-- Dumping data for table `icerik_yonetimi`
--

INSERT INTO `icerik_yonetimi` (`id`, `sirket_id`, `baslik`, `kisa_aciklama`, `detay`, `eklenme_tarihi`, `durum`) VALUES
(1, 1, 'ID:1', 'KISA', '<p>ADasdasda</p>', '2015-05-19 00:00:00', 0),
(2, 1, 'adfasf', 'asdadad', '0', '2015-05-03 15:39:39', 1),
(13, 1, 'asdadsadq', 'qewqeqe', '<p>adadadad</p>\r\n<p>da</p>\r\n<p>sdasd</p>\r\n<p>a da d</p>\r\n<p>&nbsp;</p>\r\n<p><strong>adasdasdad</strong></p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>', '2015-05-03 16:50:42', 1),
(15, 1, 'YYYYYY', 'asdassda', '<p>adadab&nbsp;<strong>afasdasd&nbsp;</strong></p>', '2015-05-03 16:52:26', 1);

-- --------------------------------------------------------

--
-- Table structure for table `kategoriler`
--

CREATE TABLE IF NOT EXISTS `kategoriler` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_sirket` int(11) NOT NULL,
  `id_ust_kategori` int(11) NOT NULL,
  `kategori_adi` varchar(100) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=17 ;

--
-- Dumping data for table `kategoriler`
--

INSERT INTO `kategoriler` (`id`, `id_sirket`, `id_ust_kategori`, `kategori_adi`) VALUES
(1, 1, 0, 'Telefon'),
(2, 1, 0, 'Bilgisayar'),
(5, 1, 1, 'Nokia'),
(6, 1, 1, 'Samsung'),
(7, 1, 2, 'Laptop'),
(8, 1, 2, 'Desktop'),
(9, 1, 1, 'İphone'),
(16, 1, 7, 'Sony'),
(15, 1, 6, 'Galaxy S3');

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=7 ;

--
-- Dumping data for table `kullanicilar`
--

INSERT INTO `kullanicilar` (`id`, `adi`, `soyadi`, `mail`, `sifre`, `tarih_kayit`, `tarih_son_giris`) VALUES
(1, 'Serkan', 'Mail', 'mail@mail.com', '827ccb0eea8a706c4c34a16891f84e7b', '2015-04-07 05:08:09', '2015-04-10 00:00:00'),
(2, 'Yasin', 'Kesim', 'yasin@yasin.com', '827ccb0eea8a706c4c34a16891f84e7b', '2015-04-09 00:00:00', '2015-04-09 00:00:00'),
(3, 'Yasinin', 'Çalışanı', 'calisan@yasin.com', '827ccb0eea8a706c4c34a16891f84e7b', '2015-04-10 00:00:00', '2015-04-10 00:00:00'),
(5, 'Serkan', 'Serkan', 'serkan.ongan.web@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', '2015-04-10 00:00:00', '2015-04-10 00:00:00'),
(6, 'Yasin''in Diğer', 'Çalışanı', 'yasin@calisan2.com', '827ccb0eea8a706c4c34a16891f84e7b', '2015-04-14 00:00:00', '2015-04-15 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `kullanicilar_roller`
--

CREATE TABLE IF NOT EXISTS `kullanicilar_roller` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_kullanici` int(11) NOT NULL,
  `id_rol` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=7 ;

--
-- Dumping data for table `kullanicilar_roller`
--

INSERT INTO `kullanicilar_roller` (`id`, `id_kullanici`, `id_rol`) VALUES
(1, 1, 0),
(2, 2, 1),
(3, 3, 2),
(5, 5, 1),
(6, 6, 2);

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

-- --------------------------------------------------------

--
-- Table structure for table `kullanicilar_sirket`
--

CREATE TABLE IF NOT EXISTS `kullanicilar_sirket` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_kullanici` int(11) NOT NULL,
  `id_sirket` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=6 ;

--
-- Dumping data for table `kullanicilar_sirket`
--

INSERT INTO `kullanicilar_sirket` (`id`, `id_kullanici`, `id_sirket`) VALUES
(1, 2, 1),
(2, 3, 1),
(4, 5, 2),
(5, 6, 1);

-- --------------------------------------------------------

--
-- Table structure for table `musteriler`
--

CREATE TABLE IF NOT EXISTS `musteriler` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Kullanıcı d''si',
  `id_sirket` int(11) NOT NULL COMMENT 'Kullanıcı d''si',
  `adi` varchar(100) COLLATE utf8_bin NOT NULL COMMENT 'Kullanıcı adı.',
  `soyadi` varchar(100) COLLATE utf8_bin NOT NULL COMMENT 'Kullanıcı soyadı.',
  `mail` varchar(100) COLLATE utf8_bin NOT NULL,
  `telefon` varchar(14) COLLATE utf8_bin DEFAULT NULL,
  `sifre` varchar(32) COLLATE utf8_bin NOT NULL COMMENT 'Kullanıcı şifresi',
  `tarih_kayit` datetime NOT NULL COMMENT 'Kullanıcı kayıt tarihi.',
  `tarih_son_giris` datetime NOT NULL COMMENT 'Kullanıcı son giriş.',
  `aktif` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=3 ;

--
-- Dumping data for table `musteriler`
--

INSERT INTO `musteriler` (`id`, `id_sirket`, `adi`, `soyadi`, `mail`, `telefon`, `sifre`, `tarih_kayit`, `tarih_son_giris`, `aktif`) VALUES
(1, 1, 'Yasinin', 'Musterisi', 'musteri@yasin.com', '', '827ccb0eea8a706c4c34a16891f84e7b', '2015-04-12 00:00:00', '2015-04-13 00:00:00', 1),
(2, 1, 'Yasinin Diger', 'Musterisi', 'musteri1@yasin.com', '', '827ccb0eea8a706c4c34a16891f84e7b', '2015-04-12 00:00:00', '2015-04-12 00:00:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `reklamlar`
--

CREATE TABLE IF NOT EXISTS `reklamlar` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_sirket` int(11) NOT NULL,
  `adi` varchar(100) COLLATE utf8_bin NOT NULL,
  `gosterim` int(11) NOT NULL,
  `tiklama` int(11) NOT NULL,
  `tarih_baslangic` datetime NOT NULL,
  `tarih_bitis` datetime NOT NULL,
  `tarih_yukleme` datetime NOT NULL,
  `dosya` varchar(250) COLLATE utf8_bin NOT NULL,
  `kod` varchar(1000) COLLATE utf8_bin NOT NULL,
  `href` varchar(1000) COLLATE utf8_bin NOT NULL,
  `aktif` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=9 ;

--
-- Dumping data for table `reklamlar`
--

INSERT INTO `reklamlar` (`id`, `id_sirket`, `adi`, `gosterim`, `tiklama`, `tarih_baslangic`, `tarih_bitis`, `tarih_yukleme`, `dosya`, `kod`, `href`, `aktif`) VALUES
(1, 1, 'Laaaaa', 100, 30, '2015-04-16 00:00:00', '2015-04-17 00:00:00', '2015-04-14 00:00:00', 'admin/sirket/upload/2015-04/MQ==_20150422155910.png', '', 'http://www.google.com', 1),
(5, 1, 'adad', 0, 0, '2015-12-31 12:59:00', '2015-12-31 12:59:00', '2015-04-22 16:11:19', 'admin/sirket/upload/2015-04/MQ==_20150422162149.png', 'sdaa', 'sdada', 1),
(6, 1, 'adada', 0, 0, '2015-12-31 12:59:00', '2015-12-31 12:59:00', '2015-04-22 16:34:10', 'admin/sirket/upload/2015-04/MQ==_20150422163410.png', 'asdad', 'adadad', 1),
(7, 1, 'asdads', 0, 0, '2015-12-31 12:59:00', '2015-12-31 12:59:00', '2015-04-22 16:54:10', 'admin/sirket/upload/2015-04/MQ==_20150422165410.jpg', 'asdasda', 'asdada', 1),
(8, 1, '11111111111', 0, 0, '2015-11-01 12:59:00', '2015-12-31 12:59:00', '2015-04-22 17:01:46', 'admin/sirket/upload/2015-04/MQ==_20150422170146.png', 'asda', 'sdada', 1);

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
  `aktif` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=3 ;

--
-- Dumping data for table `sirket`
--

INSERT INTO `sirket` (`id`, `id_sektor`, `adi`, `adres`, `tel`, `logo`, `premium`, `ref_kod`, `yetkili_adi`, `yetkili_soyadi`, `yetkili_mail`, `yetkili_sifre`, `tarih_kayit`, `aktif`) VALUES
(1, 4, 'Yasin EMLAK', 'Karşıda bir yerler. Kartal.', '+90 212 999 99 88', 'upload/2015-04/MQ==_20150412001952.jpg', 1, 'yasin_ref_kod', 'Yasin', 'Kesim', 'yasin@yasin.com', '827ccb0eea8a706c4c34a16891f84e7b', '2015-04-09 00:00:00', 1),
(2, 1, 'Serkan LTD.', 'Çıkmaz sokak.', '+90 212 999 99 88', 'upload/2015-04/MQ==_20150412001952.jpg', 0, 'serkan_ref_kod', 'Serkan', 'Serkan', 'serkan.ongan.web@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', '2015-04-10 00:00:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `urunler`
--

CREATE TABLE IF NOT EXISTS `urunler` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_sirket` int(11) NOT NULL,
  `id_category` varchar(100) COLLATE utf8_bin NOT NULL,
  `urun_adi` varchar(100) COLLATE utf8_bin NOT NULL,
  `kisa_aciklama` varchar(255) COLLATE utf8_bin NOT NULL,
  `aciklama` text COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=9 ;

--
-- Dumping data for table `urunler`
--

INSERT INTO `urunler` (`id`, `id_sirket`, `id_category`, `urun_adi`, `kisa_aciklama`, `aciklama`) VALUES
(1, 1, '6', 'urun 1', 'urun kisa', 'urun 1 uzun'),
(2, 1, '6', 'urun 2', 'urun 2 kisa', 'urun 2 uzun'),
(3, 1, '6', 'urun 3', 'urun 3 kisa', 'urun 3 uzun'),
(4, 1, '6', 'urun 4', 'urun 4 kisa', 'urun 4 uzun'),
(5, 1, '6', 'urun 5', 'urun 5 kisa', 'urun 5 uzun'),
(6, 1, '6', 'urun 3', 'urun 3 kisa', 'urun 3 uzun'),
(7, 1, '6', 'urun 4', 'urun 4 kisa', 'urun 4 uzun'),
(8, 1, '6', 'urun 5', 'urun 5 kisa', 'urun 5 uzun');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

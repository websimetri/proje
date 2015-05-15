-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 15 May 2015, 11:13:44
-- Sunucu sürümü: 5.6.21
-- PHP Sürümü: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Veritabanı: `bulut`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `anket_oy_kontrol`
--

CREATE TABLE IF NOT EXISTS `anket_oy_kontrol` (
  `id` int(11) NOT NULL,
  `anket_id` int(11) NOT NULL,
  `must_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Tablo döküm verisi `anket_oy_kontrol`
--

INSERT INTO `anket_oy_kontrol` (`id`, `anket_id`, `must_id`) VALUES
(6, 6, 2),
(7, 6, 1);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `anket_secenek`
--

CREATE TABLE IF NOT EXISTS `anket_secenek` (
`id` int(11) NOT NULL,
  `sirket_id` int(11) NOT NULL,
  `anket_id` int(11) NOT NULL,
  `secenek` varchar(300) COLLATE utf8_bin NOT NULL COMMENT 'ankete verilecek cevaplar',
  `tercih_sayisi` int(11) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=25 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Tablo döküm verisi `anket_secenek`
--

INSERT INTO `anket_secenek` (`id`, `sirket_id`, `anket_id`, `secenek`, `tercih_sayisi`) VALUES
(18, 1, 8, '1231231', 0),
(21, 1, 8, 'asdq', 0),
(17, 1, 6, 'adadada', 0),
(16, 1, 6, 'adadad', 0),
(24, 1, 9, '1231', 0),
(23, 1, 9, '2', 5);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `anket_yonetimi`
--

CREATE TABLE IF NOT EXISTS `anket_yonetimi` (
`anket_id` int(11) NOT NULL,
  `sirket_id` int(11) NOT NULL,
  `anket_baslik` varchar(500) COLLATE utf8_bin NOT NULL COMMENT 'anket soruları'
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Tablo döküm verisi `anket_yonetimi`
--

INSERT INTO `anket_yonetimi` (`anket_id`, `sirket_id`, `anket_baslik`) VALUES
(6, 1, 'asdada'),
(8, 1, 'Anketadasdad'),
(9, 1, '65465');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `begenme_yonetimi`
--

CREATE TABLE IF NOT EXISTS `begenme_yonetimi` (
`id` int(11) NOT NULL,
  `sirket_id` int(11) NOT NULL,
  `kul_id` varchar(50) NOT NULL,
  `urun_id` varchar(50) NOT NULL,
  `eklenme_tarihi` datetime NOT NULL,
  `oylama` int(3) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;

--
-- Tablo döküm verisi `begenme_yonetimi`
--

INSERT INTO `begenme_yonetimi` (`id`, `sirket_id`, `kul_id`, `urun_id`, `eklenme_tarihi`, `oylama`) VALUES
(1, 1, '1', '1', '2015-04-30 09:15:12', 1),
(16, 1, '5', '1', '2015-05-13 10:44:12', 1),
(15, 1, '4', '1', '2015-05-13 10:44:12', -1),
(14, 1, '3', '1', '2015-05-13 10:44:12', -1),
(13, 1, '2', '1', '2015-05-13 10:44:12', 1),
(12, 1, '1', '1', '2015-05-13 10:44:12', 1),
(17, 1, '6', '1', '2015-05-13 10:44:12', 1),
(18, 1, '7', '1', '2015-05-13 10:44:12', 1),
(19, 1, '8', '1', '2015-05-13 10:44:12', -1),
(20, 1, '9', '2', '2015-05-13 10:44:12', 1),
(21, 1, '10', '2', '2015-05-13 10:44:12', 1),
(22, 1, '11', '2', '2015-05-13 10:44:12', 1);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `duyuru`
--

CREATE TABLE IF NOT EXISTS `duyuru` (
`id` int(11) NOT NULL,
  `sirket_id` int(11) NOT NULL,
  `duyuru_baslik` varchar(300) COLLATE utf8_bin NOT NULL,
  `duyuru_detay` varchar(500) COLLATE utf8_bin NOT NULL,
  `durum` enum('0','1') COLLATE utf8_bin NOT NULL,
  `tarih` datetime NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Tablo döküm verisi `duyuru`
--

INSERT INTO `duyuru` (`id`, `sirket_id`, `duyuru_baslik`, `duyuru_detay`, `durum`, `tarih`) VALUES
(1, 1, 'aasdadsaAAAAA', '<p><strong>bdasdasdadad</strong></p>', '0', '0000-00-00 00:00:00'),
(7, 1, 'adadsa', '<p>dasdadadad adsa</p>', '1', '0000-00-00 00:00:00'),
(8, 2, 'aaaaaaaa', '<p>aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa<strong>aaaaaaaaaaaaaaaaaaaaaaaaaaaaaa</strong>aaaaaaaaaaaaaaaaaaaaaaaaaaa<em>aaaaaaaaaaaaaaaaaaaaa</em></p>', '1', '0000-00-00 00:00:00'),
(9, 1, 'asdadasda', '<p>asdasdada<strong>dasdasdasdasda</strong></p>', '1', '0000-00-00 00:00:00'),
(10, 1, '11111', '<p>1111111111111111111111111111</p>', '1', '0000-00-00 00:00:00'),
(11, 1, '1231231', '<p>12312312313131132123</p>', '1', '2015-05-13 09:27:08');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `duyurular`
--

CREATE TABLE IF NOT EXISTS `duyurular` (
`id` int(11) NOT NULL,
  `id_kullanici` int(11) NOT NULL,
  `okunma` tinyint(1) NOT NULL DEFAULT '0',
  `konu` varchar(150) COLLATE utf8_bin NOT NULL,
  `mesaj` text COLLATE utf8_bin NOT NULL,
  `tarih_gonderi` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Tablo döküm verisi `duyurular`
--

INSERT INTO `duyurular` (`id`, `id_kullanici`, `okunma`, `konu`, `mesaj`, `tarih_gonderi`) VALUES
(1, 2, 1, 'Yasin Merhaba.', 'Burada mesaj yer alacak.', '2015-04-21 03:08:08'),
(9, 1, 0, 'Bütün Kullanıcılar', 'Bütün kullanıcılara deneme mesajı', '2015-04-21 13:56:57'),
(10, 2, 1, 'Bütün Kullanıcılar', 'Bütün kullanıcılara deneme mesajı', '2015-04-21 13:56:57'),
(11, 3, 0, 'Bütün Kullanıcılar', 'Bütün kullanıcılara deneme mesajı', '2015-04-21 13:56:57'),
(12, 5, 0, 'Bütün Kullanıcılar', 'Bütün kullanıcılara deneme mesajı', '2015-04-21 13:56:57'),
(17, 2, 1, 'Bütün Şirket Adminleri', 'Bütün şirket adminlerine deneme mesajı. <p>Deneme kullanıcılar.&nbsp;</p>\n<p>&nbsp;</p>\n<p><strong>asdadsasdasda</strong></p>\n<p>&nbsp;</p>\n<p>14:36:32</p> <p>Deneme kullanıcılar.&nbsp;</p>\n<p>&nbsp;</p>\n<p><strong>asdadsasdasda</strong></p>\n<p>&nbsp;</p>\n<p>14:36:32</p><p>Deneme kullanıcılar.&nbsp;</p>\n<p>&nbsp;</p>\n<p><strong>asdadsasdasda</strong></p>\n<p>&nbsp;</p>\n<p>14:36:32</p>', '2015-04-21 13:57:46'),
(18, 5, 1, 'Bütün Şirket Adminleri', 'Bütün şirket adminlerine deneme mesajı', '2015-04-21 13:57:46'),
(30, 5, 0, 'Şirket Adminlerine mesaj', 'Bütün şirket adminlerine mesaj.', '2015-04-21 14:11:53'),
(32, 5, 0, 'Şirket adminleri TinyMCE', '<p>TinyMCE ile&nbsp;<strong>mesaj yollama</strong> işlemi.</p>', '2015-04-21 14:18:54'),
(33, 1, 0, 'Kullanıcılar', '<p>Deneme kullanıcılar.&nbsp;</p>\n<p>&nbsp;</p>\n<p><strong>asdadsasdasda</strong></p>\n<p>&nbsp;</p>\n<p>14:36:32</p>\n\n', '2015-04-21 14:36:44'),
(34, 2, 1, 'Kullanıcılar', '<p>Deneme kullanıcılar.&nbsp;</p>\n<p>&nbsp;</p>\n<p><strong>asdadsasdasda</strong></p>\n<p>&nbsp;</p>\n<p>14:36:32</p>', '2015-04-21 14:36:44'),
(35, 3, 0, 'Kullanıcılar', '<p>Deneme kullanıcılar.&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<p><strong>asdadsasdasda</strong></p>\r\n<p>&nbsp;</p>\r\n<p>14:36:32</p>', '2015-04-21 14:36:44'),
(36, 5, 0, 'Kullanıcılar', '<p>Deneme kullanıcılar.&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<p><strong>asdadsasdasda</strong></p>\r\n<p>&nbsp;</p>\r\n<p>14:36:32</p>', '2015-04-21 14:36:44'),
(38, 5, 0, 'Merhaba Şirket Adminleri', '<p><strong>nabersiniz?</strong></p>\r\n<p>lorem falan ipsum.</p>', '2015-04-21 17:32:49');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `formlar`
--

CREATE TABLE IF NOT EXISTS `formlar` (
`id` int(11) NOT NULL,
  `id_sirket` int(11) NOT NULL,
  `adi` varchar(100) COLLATE utf8_bin NOT NULL,
  `html` text COLLATE utf8_bin NOT NULL,
  `json` text COLLATE utf8_bin NOT NULL,
  `tarih` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Tablo döküm verisi `formlar`
--

INSERT INTO `formlar` (`id`, `id_sirket`, `adi`, `html`, `json`, `tarih`) VALUES
(6, 1, 'New Form', '<form class="form-horizontal" >\r\n<fieldset>\r\n\r\n\r\n<legend>New Form</legend>\r\n\r\n\r\n<div class="control-group">\r\n  <label class="control-label" for="textinput-0">Text Input</label>\r\n  <div class="controls">\r\n    <input id="textinput-0" name="textinput-0" type="text" placeholder="placeholder" class="input-xlarge">\r\n    <p class="help-block">help</p>\r\n  </div>\r\n</div>\r\n\r\n\r\n<div class="control-group">\r\n  <label class="control-label" for="passwordinput-0">Password Input</label>\r\n  <div class="controls">\r\n    <input id="passwordinput-0" name="passwordinput-0" type="password" placeholder="placeholder" class="input-xlarge">\r\n    <p class="help-block">help</p>\r\n  </div>\r\n</div>\r\n\r\n</fieldset>\r\n</form>\r\n', '{\n    "tag": "html",\n    "children": [\n        {\n            "tag": "body",\n            "children": [\n                {\n                    "tag": "form",\n                    "class": "form-horizontal",\n                    "html": "\\r\\n",\n                    "children": [\n                        {\n                            "tag": "fieldset",\n                            "children": [\n                                {\n                                    "tag": "legend",\n                                    "html": "New Form"\n                                },\n                                {\n                                    "tag": "div",\n                                    "class": "control-group",\n                                    "html": "\\r\\n",\n                                    "children": [\n                                        {\n                                            "tag": "label",\n                                            "class": "control-label",\n                                            "for": "textinput-0",\n                                            "html": "Text Input"\n                                        },\n                                        {\n                                            "tag": "div",\n                                            "class": "controls",\n                                            "html": "\\r\\n  ",\n                                            "children": [\n                                                {\n                                                    "tag": "input",\n                                                    "id": "textinput-0",\n                                                    "name": "textinput-0",\n                                                    "type": "text",\n                                                    "placeholder": "placeholder",\n                                                    "class": "input-xlarge"\n                                                },\n                                                {\n                                                    "tag": "p",\n                                                    "class": "help-block",\n                                                    "html": "help"\n                                                }\n                                            ]\n                                        }\n                                    ]\n                                },\n                                {\n                                    "tag": "div",\n                                    "class": "control-group",\n                                    "html": "\\r\\n",\n                                    "children": [\n                                        {\n                                            "tag": "label",\n                                            "class": "control-label",\n                                            "for": "passwordinput-0",\n                                            "html": "Password Input"\n                                        },\n                                        {\n                                            "tag": "div",\n                                            "class": "controls",\n                                            "html": "\\r\\n  ",\n                                            "children": [\n                                                {\n                                                    "tag": "input",\n                                                    "id": "passwordinput-0",\n                                                    "name": "passwordinput-0",\n                                                    "type": "password",\n                                                    "placeholder": "placeholder",\n                                                    "class": "input-xlarge"\n                                                },\n                                                {\n                                                    "tag": "p",\n                                                    "class": "help-block",\n                                                    "html": "help"\n                                                }\n                                            ]\n                                        }\n                                    ]\n                                }\n                            ],\n                            "html": "\\r\\n\\r\\n"\n                        }\n                    ]\n                }\n            ]\n        }\n    ]\n}', '2015-04-27 16:47:35'),
(7, 1, 'Form Name', '<form class="form-horizontal" >\r\n<fieldset>\r\n\r\n\r\n<legend>Form Name</legend>\r\n\r\n\r\n<div class="control-group">\r\n  <label class="control-label" for="textinput-0">Text Input</label>\r\n  <div class="controls">\r\n    <input id="textinput-0" name="textinput-0" type="text" placeholder="placeholder" class="input-xlarge">\r\n    <p class="help-block">help</p>\r\n  </div>\r\n</div>\r\n\r\n</fieldset>\r\n</form>\r\n', '{\n    "tag": "html",\n    "children": [\n        {\n            "tag": "body",\n            "children": [\n                {\n                    "tag": "form",\n                    "class": "form-horizontal",\n                    "html": "\\r\\n",\n                    "children": [\n                        {\n                            "tag": "fieldset",\n                            "children": [\n                                {\n                                    "tag": "legend",\n                                    "html": "Form Name"\n                                },\n                                {\n                                    "tag": "div",\n                                    "class": "control-group",\n                                    "html": "\\r\\n",\n                                    "children": [\n                                        {\n                                            "tag": "label",\n                                            "class": "control-label",\n                                            "for": "textinput-0",\n                                            "html": "Text Input"\n                                        },\n                                        {\n                                            "tag": "div",\n                                            "class": "controls",\n                                            "html": "\\r\\n  ",\n                                            "children": [\n                                                {\n                                                    "tag": "input",\n                                                    "id": "textinput-0",\n                                                    "name": "textinput-0",\n                                                    "type": "text",\n                                                    "placeholder": "placeholder",\n                                                    "class": "input-xlarge"\n                                                },\n                                                {\n                                                    "tag": "p",\n                                                    "class": "help-block",\n                                                    "html": "help"\n                                                }\n                                            ]\n                                        }\n                                    ]\n                                }\n                            ],\n                            "html": "\\r\\n\\r\\n"\n                        }\n                    ]\n                }\n            ]\n        }\n    ]\n}', '2015-04-27 16:56:00'),
(8, 1, 'Form Name', '<form class="form-horizontal" >\r\n<fieldset>\r\n\r\n\r\n<legend>Form Name</legend>\r\n\r\n\r\n<div class="control-group">\r\n  <label class="control-label" for="textinput-0">Text Input</label>\r\n  <div class="controls">\r\n    <input id="textinput-0" name="textinput-0" type="text" placeholder="placeholder" class="input-xlarge">\r\n    <p class="help-block">help</p>\r\n  </div>\r\n</div>\r\n\r\n\r\n<div class="control-group">\r\n  <label class="control-label" for="singlebutton-0">Single Button</label>\r\n  <div class="controls">\r\n    <button id="singlebutton-0" name="singlebutton-0" class="btn btn-primary">Button</button>\r\n  </div>\r\n</div>\r\n\r\n</fieldset>\r\n</form>\r\n', '{\n    "tag": "html",\n    "children": [\n        {\n            "tag": "body",\n            "children": [\n                {\n                    "tag": "form",\n                    "class": "form-horizontal",\n                    "html": "\\r\\n",\n                    "children": [\n                        {\n                            "tag": "fieldset",\n                            "children": [\n                                {\n                                    "tag": "legend",\n                                    "html": "Form Name"\n                                },\n                                {\n                                    "tag": "div",\n                                    "class": "control-group",\n                                    "html": "\\r\\n",\n                                    "children": [\n                                        {\n                                            "tag": "label",\n                                            "class": "control-label",\n                                            "for": "textinput-0",\n                                            "html": "Text Input"\n                                        },\n                                        {\n                                            "tag": "div",\n                                            "class": "controls",\n                                            "html": "\\r\\n  ",\n                                            "children": [\n                                                {\n                                                    "tag": "input",\n                                                    "id": "textinput-0",\n                                                    "name": "textinput-0",\n                                                    "type": "text",\n                                                    "placeholder": "placeholder",\n                                                    "class": "input-xlarge"\n                                                },\n                                                {\n                                                    "tag": "p",\n                                                    "class": "help-block",\n                                                    "html": "help"\n                                                }\n                                            ]\n                                        }\n                                    ]\n                                },\n                                {\n                                    "tag": "div",\n                                    "class": "control-group",\n                                    "html": "\\r\\n",\n                                    "children": [\n                                        {\n                                            "tag": "label",\n                                            "class": "control-label",\n                                            "for": "singlebutton-0",\n                                            "html": "Single Button"\n                                        },\n                                        {\n                                            "tag": "div",\n                                            "class": "controls",\n                                            "html": "\\r\\n  ",\n                                            "children": [\n                                                {\n                                                    "tag": "button",\n                                                    "id": "singlebutton-0",\n                                                    "name": "singlebutton-0",\n                                                    "class": "btn btn-primary",\n                                                    "html": "Button"\n                                                }\n                                            ]\n                                        }\n                                    ]\n                                }\n                            ],\n                            "html": "\\r\\n\\r\\n"\n                        }\n                    ]\n                }\n            ]\n        }\n    ]\n}', '2015-04-28 17:26:20'),
(9, 1, 'Form Name', '<form class="form-horizontal" >\r\n<fieldset>\r\n\r\n\r\n<legend>Form Name</legend>\r\n\r\n\r\n<div class="control-group">\r\n  <label class="control-label" for="textinput-0">Text Input</label>\r\n  <div class="controls">\r\n    <input id="textinput-0" name="textinput-0" type="text" placeholder="placeholder" class="input-xlarge">\r\n    <p class="help-block">help</p>\r\n  </div>\r\n</div>\r\n\r\n\r\n<div class="control-group">\r\n  <label class="control-label" for="textinput-0">Text Input</label>\r\n  <div class="controls">\r\n    <input id="textinput-0" name="textinput-0" type="text" placeholder="placeholder" class="input-xlarge">\r\n    <p class="help-block">help</p>\r\n  </div>\r\n</div>\r\n\r\n</fieldset>\r\n</form>\r\n', '{\n    "tag": "html",\n    "children": [\n        {\n            "tag": "body",\n            "children": [\n                {\n                    "tag": "form",\n                    "class": "form-horizontal",\n                    "html": "\\r\\n",\n                    "children": [\n                        {\n                            "tag": "fieldset",\n                            "children": [\n                                {\n                                    "tag": "legend",\n                                    "html": "Form Name"\n                                },\n                                {\n                                    "tag": "div",\n                                    "class": "control-group",\n                                    "html": "\\r\\n",\n                                    "children": [\n                                        {\n                                            "tag": "label",\n                                            "class": "control-label",\n                                            "for": "textinput-0",\n                                            "html": "Text Input"\n                                        },\n                                        {\n                                            "tag": "div",\n                                            "class": "controls",\n                                            "html": "\\r\\n  ",\n                                            "children": [\n                                                {\n                                                    "tag": "input",\n                                                    "id": "textinput-0",\n                                                    "name": "textinput-0",\n                                                    "type": "text",\n                                                    "placeholder": "placeholder",\n                                                    "class": "input-xlarge"\n                                                },\n                                                {\n                                                    "tag": "p",\n                                                    "class": "help-block",\n                                                    "html": "help"\n                                                }\n                                            ]\n                                        }\n                                    ]\n                                },\n                                {\n                                    "tag": "div",\n                                    "class": "control-group",\n                                    "html": "\\r\\n",\n                                    "children": [\n                                        {\n                                            "tag": "label",\n                                            "class": "control-label",\n                                            "for": "textinput-0",\n                                            "html": "Text Input"\n                                        },\n                                        {\n                                            "tag": "div",\n                                            "class": "controls",\n                                            "html": "\\r\\n  ",\n                                            "children": [\n                                                {\n                                                    "tag": "input",\n                                                    "id": "textinput-0",\n                                                    "name": "textinput-0",\n                                                    "type": "text",\n                                                    "placeholder": "placeholder",\n                                                    "class": "input-xlarge"\n                                                },\n                                                {\n                                                    "tag": "p",\n                                                    "class": "help-block",\n                                                    "html": "help"\n                                                }\n                                            ]\n                                        }\n                                    ]\n                                }\n                            ],\n                            "html": "\\r\\n\\r\\n"\n                        }\n                    ]\n                }\n            ]\n        }\n    ]\n}', '2015-05-04 09:58:53'),
(10, 1, 'denwnw', '<form class="form-horizontal" >\r\n<fieldset>\r\n\r\n\r\n<legend>denwnw</legend>\r\n\r\n\r\n<div class="control-group">\r\n  <label class="control-label" for="textinput-0">Text Input</label>\r\n  <div class="controls">\r\n    <input id="textinput-0" name="textinput-0" type="text" placeholder="placeholder" class="input-xlarge">\r\n    <p class="help-block">help</p>\r\n  </div>\r\n</div>\r\n\r\n</fieldset>\r\n</form>\r\n', '{\n    "tag": "html",\n    "children": [\n        {\n            "tag": "body",\n            "children": [\n                {\n                    "tag": "form",\n                    "class": "form-horizontal",\n                    "html": "\\r\\n",\n                    "children": [\n                        {\n                            "tag": "fieldset",\n                            "children": [\n                                {\n                                    "tag": "legend",\n                                    "html": "denwnw"\n                                },\n                                {\n                                    "tag": "div",\n                                    "class": "control-group",\n                                    "html": "\\r\\n",\n                                    "children": [\n                                        {\n                                            "tag": "label",\n                                            "class": "control-label",\n                                            "for": "textinput-0",\n                                            "html": "Text Input"\n                                        },\n                                        {\n                                            "tag": "div",\n                                            "class": "controls",\n                                            "html": "\\r\\n  ",\n                                            "children": [\n                                                {\n                                                    "tag": "input",\n                                                    "id": "textinput-0",\n                                                    "name": "textinput-0",\n                                                    "type": "text",\n                                                    "placeholder": "placeholder",\n                                                    "class": "input-xlarge"\n                                                },\n                                                {\n                                                    "tag": "p",\n                                                    "class": "help-block",\n                                                    "html": "help"\n                                                }\n                                            ]\n                                        }\n                                    ]\n                                }\n                            ],\n                            "html": "\\r\\n\\r\\n"\n                        }\n                    ]\n                }\n            ]\n        }\n    ]\n}', '2015-05-04 10:01:40');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `forum`
--

CREATE TABLE IF NOT EXISTS `forum` (
`id` int(11) NOT NULL,
  `gonderen_id` int(11) NOT NULL,
  `konu` varchar(255) COLLATE utf8_bin NOT NULL,
  `mesaj` varchar(255) COLLATE utf8_bin NOT NULL,
  `tarih` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Tablo döküm verisi `forum`
--

INSERT INTO `forum` (`id`, `gonderen_id`, `konu`, `mesaj`, `tarih`) VALUES
(20, 2, 'asdasdas', 'dasdasdasdasd', '2015-05-06 09:33:52'),
(21, 2, 'İlk Konu', 'sasd', '2015-05-06 09:35:01');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `galeriler`
--

CREATE TABLE IF NOT EXISTS `galeriler` (
`id` int(11) NOT NULL,
  `id_sirket` int(11) NOT NULL,
  `isim` varchar(100) COLLATE utf8_bin NOT NULL,
  `aciklama` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `aktif` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Tablo döküm verisi `galeriler`
--

INSERT INTO `galeriler` (`id`, `id_sirket`, `isim`, `aciklama`, `aktif`) VALUES
(2, 2, 'bu da deneme', 'bunu da deniyoruz :)', 1),
(13, 1, 'Yeni', 'Yeni galeri açıklaması.', 1);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `galeriler_resimler`
--

CREATE TABLE IF NOT EXISTS `galeriler_resimler` (
`id` int(11) NOT NULL,
  `id_galeri` int(11) NOT NULL,
  `url` text COLLATE utf8_bin NOT NULL,
  `alt` varchar(255) COLLATE utf8_bin DEFAULT NULL COMMENT 'resim açıklaması'
) ENGINE=MyISAM AUTO_INCREMENT=31 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Tablo döküm verisi `galeriler_resimler`
--

INSERT INTO `galeriler_resimler` (`id`, `id_galeri`, `url`, `alt`) VALUES
(29, 13, 'upload/2015-05/MQ==_20150513090251.jpg', '....'),
(30, 13, 'upload/2015-05/MQ==_20150513090403.jpg', '...');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `haberler`
--

CREATE TABLE IF NOT EXISTS `haberler` (
`id` int(11) NOT NULL,
  `id_sirket` int(11) NOT NULL,
  `kategori_id` int(11) NOT NULL,
  `baslik` varchar(200) COLLATE utf8_bin NOT NULL,
  `kisa_aciklama` varchar(500) COLLATE utf8_bin NOT NULL,
  `uzun_aciklama` text COLLATE utf8_bin NOT NULL,
  `resim` varchar(500) COLLATE utf8_bin NOT NULL,
  `tarih` datetime NOT NULL,
  `durum` int(11) NOT NULL DEFAULT '1' COMMENT '1 aktif, 2 pasif'
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Tablo döküm verisi `haberler`
--

INSERT INTO `haberler` (`id`, `id_sirket`, `kategori_id`, `baslik`, `kisa_aciklama`, `uzun_aciklama`, `resim`, `tarih`, `durum`) VALUES
(1, 1, 3, 'Haberlerin 1.', 'Haber kısa açıklama. Değişik.', 'Buralar değişecek. Umarım.\r\n\r\nBakalım.', '', '2015-04-22 00:00:00', 1),
(2, 1, 5, 'İkinci Haber', '2. Kısa', '2. Uzun', '', '2015-04-13 00:00:00', 1),
(3, 1, 1, 'Pasif Haber', 'Pasif Kısa', 'Pasif Uzun', 'http://www.followingthenerd.com/site/wp-content/uploads/avatar.jpg_274898881.jpg', '2015-04-07 00:00:00', 2),
(4, 1, 5, 'sdada', 'dsada', 'dasdadadad', 'collide1.jpg', '2015-04-30 18:00:28', 1),
(5, 1, 5, 'Son Haber', 'Son Haber Açıklama', 'Deneme bir iki. Dosyasız.', '', '2015-04-30 18:01:25', 1),
(6, 1, 1, 'Dosyalı', 'asdadad', 'asdadsadadsadsada', 'collide1.jpg', '2015-04-30 18:01:45', 2),
(7, 1, 4, 'asdad', 'asdasd', 'asdasdadsasda', 'collide.png', '2015-04-30 18:28:01', 1),
(8, 1, 4, 'asdadada', 'asdad', '<p>adadad</p>', 'Jup_bw.jpg', '2015-05-12 09:05:45', 1);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `haber_kategori`
--

CREATE TABLE IF NOT EXISTS `haber_kategori` (
`id` int(11) NOT NULL,
  `id_sirket` int(11) NOT NULL,
  `adi` varchar(100) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Tablo döküm verisi `haber_kategori`
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
-- Tablo için tablo yapısı `icerik_yonetimi`
--

CREATE TABLE IF NOT EXISTS `icerik_yonetimi` (
`id` int(11) NOT NULL,
  `sirket_id` int(11) NOT NULL,
  `baslik` varchar(100) COLLATE utf8_bin NOT NULL,
  `kisa_aciklama` varchar(255) COLLATE utf8_bin NOT NULL,
  `detay` varchar(500) COLLATE utf8_bin NOT NULL,
  `eklenme_tarihi` datetime NOT NULL,
  `durum` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Tablo döküm verisi `icerik_yonetimi`
--

INSERT INTO `icerik_yonetimi` (`id`, `sirket_id`, `baslik`, `kisa_aciklama`, `detay`, `eklenme_tarihi`, `durum`) VALUES
(1, 1, 'ID:1', 'KISA', '<p>ADasdasda</p>', '2015-05-19 00:00:00', 1),
(2, 1, 'adfasf', 'asdadad', '0', '2015-05-03 15:39:39', 1),
(13, 1, 'asdadsadq', 'qewqeqe', '<p>adadadsadadasda&nbsp;</p>\r\n<p>asda sd</p>\r\n<p>asd&nbsp;</p>\r\n<p>asd</p>\r\n<p>&nbsp;asda&nbsp;</p>\r\n<p>asd asd</p>\r\n<p>&nbsp;adsa dad</p>\r\n<p>adadadsadadasda&nbsp;</p>\r\n<p>asda sd</p>\r\n<p>asd&nbsp;</p>\r\n<p>asd</p>\r\n<p>&nbsp;asda&nbsp;</p>\r\n<p>asd asd</p>\r\n<p>&nbsp;adsa dad</p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<p>adadadsadadasda&nbsp;</p>\r\n<p>asda sd</p>\r\n<p>asd&nbsp;</p>\r\n<p>asd</p>\r\n<p>&nbsp;asda&nbsp;</p>\r\n<p>asd asd</p>\r\n<p>&nbsp;adsa dad</p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<p>adadadsadadasda&n', '2015-05-03 16:50:42', 1),
(15, 1, 'YYYYYY', 'asdassda', '<p>adadab&nbsp;<strong>afasdasd&nbsp;</strong></p>', '2015-05-03 16:52:26', 1);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `kategoriler`
--

CREATE TABLE IF NOT EXISTS `kategoriler` (
`id` int(11) NOT NULL,
  `id_sirket` int(11) NOT NULL,
  `id_ust_kategori` int(11) NOT NULL,
  `kategori_adi` varchar(100) COLLATE utf8_bin NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=23 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Tablo döküm verisi `kategoriler`
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
(15, 1, 6, 'Galaxy S'),
(20, 1, 0, 'ASD'),
(22, 1, 0, 'Bisiklet');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `kullanicilar`
--

CREATE TABLE IF NOT EXISTS `kullanicilar` (
`id` int(11) NOT NULL COMMENT 'Kullanıcı d''si',
  `adi` varchar(100) COLLATE utf8_bin NOT NULL COMMENT 'Kullanıcı adı.',
  `soyadi` varchar(100) COLLATE utf8_bin NOT NULL COMMENT 'Kullanıcı soyadı.',
  `mail` varchar(100) COLLATE utf8_bin NOT NULL COMMENT 'Kullanıcı mail''i.',
  `sifre` varchar(32) COLLATE utf8_bin NOT NULL COMMENT 'Kullanıcı şifresi',
  `tarih_kayit` datetime NOT NULL COMMENT 'Kullanıcı kayıt tarihi.',
  `tarih_son_giris` datetime NOT NULL COMMENT 'Kullanıcı son giriş.'
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Tablo döküm verisi `kullanicilar`
--

INSERT INTO `kullanicilar` (`id`, `adi`, `soyadi`, `mail`, `sifre`, `tarih_kayit`, `tarih_son_giris`) VALUES
(1, 'Serkan', 'Mail', 'mail@mail.com', '827ccb0eea8a706c4c34a16891f84e7b', '2015-04-07 05:08:09', '2015-04-10 00:00:00'),
(2, 'Yasin', 'Kesim', 'yasin@yasin.com', '827ccb0eea8a706c4c34a16891f84e7b', '2015-04-09 00:00:00', '2015-04-09 00:00:00'),
(3, 'Yasinin', 'Çalışanııı', 'calisan@yasin.com', '827ccb0eea8a706c4c34a16891f84e7b', '2015-04-10 00:00:00', '2015-04-10 00:00:00'),
(5, 'Serkan', 'Serkan', 'serkan.ongan.web@gmail.co', '827ccb0eea8a706c4c34a16891f84e7b', '2015-04-10 00:00:00', '2015-04-10 00:00:00'),
(6, 'Yasin''in Diğer', 'Çalışanı', 'yasin@calisan2.com', '827ccb0eea8a706c4c34a16891f84e7b', '2015-04-14 00:00:00', '2015-04-15 00:00:00');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `kullanicilar_roller`
--

CREATE TABLE IF NOT EXISTS `kullanicilar_roller` (
`id` int(11) NOT NULL,
  `id_kullanici` int(11) NOT NULL,
  `id_rol` int(11) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Tablo döküm verisi `kullanicilar_roller`
--

INSERT INTO `kullanicilar_roller` (`id`, `id_kullanici`, `id_rol`) VALUES
(1, 1, 0),
(2, 2, 1),
(3, 3, 2),
(5, 5, 1),
(6, 6, 2);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `kullanicilar_sifre_reset`
--

CREATE TABLE IF NOT EXISTS `kullanicilar_sifre_reset` (
`id` int(11) NOT NULL,
  `kul_id` int(11) NOT NULL COMMENT 'kullanıcının kullanıcılar tablosundaki id si',
  `reset_key` varchar(50) COLLATE utf8_bin NOT NULL COMMENT 'kullanıcıya gönderdiğimiz random key',
  `reset_time` datetime NOT NULL COMMENT 'kullanıcının şifre yenileme isteği yaptığı tarih',
  `kullanildi` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='şifre yenileme isteği yapan kullanıcıya ait bilgiler';

--
-- Tablo döküm verisi `kullanicilar_sifre_reset`
--

INSERT INTO `kullanicilar_sifre_reset` (`id`, `kul_id`, `reset_key`, `reset_time`, `kullanildi`) VALUES
(1, 5, 'qweasd', '2015-04-28 16:35:14', 1);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `kullanicilar_sirket`
--

CREATE TABLE IF NOT EXISTS `kullanicilar_sirket` (
`id` int(11) NOT NULL,
  `id_kullanici` int(11) NOT NULL,
  `id_sirket` int(11) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Tablo döküm verisi `kullanicilar_sirket`
--

INSERT INTO `kullanicilar_sirket` (`id`, `id_kullanici`, `id_sirket`) VALUES
(1, 2, 1),
(2, 3, 1),
(4, 5, 2),
(5, 6, 1);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `mesajlar`
--

CREATE TABLE IF NOT EXISTS `mesajlar` (
`id` int(11) NOT NULL,
  `sirket_id` int(11) NOT NULL,
  `gonderen_id` int(11) NOT NULL,
  `alan_id` int(11) NOT NULL,
  `konu` varchar(500) NOT NULL,
  `mesaj` varchar(500) NOT NULL,
  `tarih` datetime NOT NULL,
  `durum` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

--
-- Tablo döküm verisi `mesajlar`
--

INSERT INTO `mesajlar` (`id`, `sirket_id`, `gonderen_id`, `alan_id`, `konu`, `mesaj`, `tarih`, `durum`) VALUES
(1, 1, 1, 2, '', 'sdasdasd', '2015-05-04 10:56:53', 1),
(2, 1, 1, 2, '', 'yasin oguzz :D', '2015-05-04 10:59:11', 0),
(3, 2, 1, 2, '', 'SERKAN', '2015-05-04 11:01:01', 0),
(4, 1, 1, 1, '', 'sdfsdfsdf', '2015-05-05 09:01:48', 0),
(5, 1, 2, 1, '', 'adasdasdasd', '2015-05-05 09:03:24', 0),
(6, 1, 2, 1, '', 'asdasdasdaasdaaa', '2015-05-05 09:04:10', 0),
(7, 1, 2, 1, '?lk Konu', 'O?uz :D', '2015-05-05 09:14:02', 0),
(8, 1, 2, 2, 'konu 2', 'mesaj son', '2015-05-05 09:17:12', 0),
(9, 1, 2, 1, 'konu3', 'Konusuz', '2015-05-05 09:17:52', 0),
(10, 1, 2, 2, 'konu4', ':çççç :D', '2015-05-05 09:18:08', 0),
(11, 1, 2, 2, 'konu son', 'konuasdasdasdasd', '2015-05-05 09:18:26', 0),
(12, 1, 2, 2, 'asdasd', 'asdasdasd', '2015-05-05 09:26:21', 0),
(13, 1, 2, 2, 'asdasd', 'asdasdasdasdasdasd', '2015-05-05 09:27:15', 0),
(14, 1, 2, 1, 'Deneme', '123124123123', '2015-05-06 11:15:14', 0),
(15, 1, 2, 1, 'serkan', 'deneme', '2015-05-06 11:24:30', 0),
(16, 1, 2, 1, 'adsada', 'dsadsasda', '2015-05-07 09:10:54', 0);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `musteriler`
--

CREATE TABLE IF NOT EXISTS `musteriler` (
`id` int(11) NOT NULL COMMENT 'Kullanıcı d''si',
  `id_sirket` int(11) NOT NULL COMMENT 'Kullanıcı d''si',
  `adi` varchar(100) COLLATE utf8_bin NOT NULL COMMENT 'Kullanıcı adı.',
  `soyadi` varchar(100) COLLATE utf8_bin NOT NULL COMMENT 'Kullanıcı soyadı.',
  `mail` varchar(100) COLLATE utf8_bin NOT NULL,
  `telefon` varchar(14) COLLATE utf8_bin DEFAULT NULL,
  `sifre` varchar(32) COLLATE utf8_bin NOT NULL COMMENT 'Kullanıcı şifresi',
  `tarih_kayit` datetime NOT NULL COMMENT 'Kullanıcı kayıt tarihi.',
  `tarih_son_giris` datetime NOT NULL COMMENT 'Kullanıcı son giriş.',
  `aktif` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Tablo döküm verisi `musteriler`
--

INSERT INTO `musteriler` (`id`, `id_sirket`, `adi`, `soyadi`, `mail`, `telefon`, `sifre`, `tarih_kayit`, `tarih_son_giris`, `aktif`) VALUES
(1, 1, 'Yasinin', 'Musterisi', 'musteri@yasin.com', '', '827ccb0eea8a706c4c34a16891f84e7b', '2015-04-12 00:00:00', '2015-04-13 00:00:00', 1),
(2, 1, 'Yasinin Diger', 'Musterisi', 'musteri1@yasin.com', '', '827ccb0eea8a706c4c34a16891f84e7b', '2015-04-12 00:00:00', '2015-04-12 00:00:00', 1);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `reklamlar`
--

CREATE TABLE IF NOT EXISTS `reklamlar` (
`id` int(11) NOT NULL,
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
  `genislik` int(5) NOT NULL,
  `yukseklik` int(5) NOT NULL,
  `aktif` tinyint(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Tablo döküm verisi `reklamlar`
--

INSERT INTO `reklamlar` (`id`, `id_sirket`, `adi`, `gosterim`, `tiklama`, `tarih_baslangic`, `tarih_bitis`, `tarih_yukleme`, `dosya`, `kod`, `href`, `genislik`, `yukseklik`, `aktif`) VALUES
(1, 1, 'Laaaaa', 100, 30, '2015-04-16 00:00:00', '2015-04-17 00:00:00', '2015-04-14 00:00:00', 'admin/sirket/upload/2015-04/MQ==_20150422155910.png', '', 'http://www.google.com', 0, 0, 1),
(5, 1, 'adad', 0, 0, '2015-12-31 12:59:00', '2015-12-31 12:59:00', '2015-04-22 16:11:19', 'admin/sirket/upload/2015-04/MQ==_20150422162149.png', 'sdaa', 'sdada', 0, 0, 1),
(6, 1, 'adada', 0, 0, '2015-12-31 12:59:00', '2015-12-31 12:59:00', '2015-04-22 16:34:10', 'admin/sirket/upload/2015-04/MQ==_20150422163410.png', 'asdad', 'adadad', 0, 0, 1),
(7, 1, 'asdads', 0, 0, '2015-12-31 12:59:00', '2015-12-31 12:59:00', '2015-04-22 16:54:10', 'admin/sirket/upload/2015-04/MQ==_20150422165410.jpg', 'asdasda', 'asdada', 0, 0, 1),
(8, 1, '11111111111', 0, 0, '2015-11-01 12:59:00', '2015-12-31 12:59:00', '2015-04-22 17:01:46', 'admin/sirket/upload/2015-04/MQ==_20150422170146.png', 'asda', 'sdada', 0, 0, 1),
(9, 1, 'asdasdasdad', 12, 0, '0012-02-13 15:00:00', '2015-12-31 12:59:00', '2015-05-04 10:12:08', 'admin/sirket/upload/2015-05/MQ==_20150504091208.jpg', 'eqeqe', 'qeqe', 0, 0, 1),
(10, 1, 'df', 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2015-05-11 09:45:27', 'admin/sirket/upload/2015-05/MQ==_20150511084527.jpg', '', '', 0, 0, 1),
(11, 1, 'son reklam', 11, 0, '2015-12-31 12:59:00', '2015-12-31 12:59:00', '2015-05-15 09:53:24', 'admin/sirket/upload/2015-05/MQ==_20150515085324.jpg', '<inframe></inframe>', 'href', 12, 132, 1);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `roller`
--

CREATE TABLE IF NOT EXISTS `roller` (
  `id` int(11) NOT NULL,
  `rol` varchar(50) COLLATE utf8_bin NOT NULL,
  `aciklama` text COLLATE utf8_bin NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Tablo döküm verisi `roller`
--

INSERT INTO `roller` (`id`, `rol`, `aciklama`) VALUES
(0, 'Super Admin', 'Süper Admin.Biziz yani.'),
(1, 'Şirket Admin', 'Şirketin admini veya sahibi.'),
(2, 'Şirket Kullanıcısı', 'Şirketin çalışanları.'),
(3, 'Şirket Müşterisi', 'Şirketlerin Müşterileri.');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `sektor`
--

CREATE TABLE IF NOT EXISTS `sektor` (
`id` int(11) NOT NULL,
  `sektor_adi` varchar(100) COLLATE utf8_bin NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Tablo döküm verisi `sektor`
--

INSERT INTO `sektor` (`id`, `sektor_adi`) VALUES
(1, 'Enerji'),
(2, 'Mobilya'),
(3, 'Teknoloji'),
(4, 'Emlak');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `siparis`
--

CREATE TABLE IF NOT EXISTS `siparis` (
`id` int(11) NOT NULL,
  `sirket_id` int(11) NOT NULL,
  `must_id` int(11) NOT NULL,
  `urun_id` int(11) NOT NULL,
  `siparis_bilgisi` text COLLATE utf8_bin NOT NULL,
  `eklenme_tarihi` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Tablo döküm verisi `siparis`
--

INSERT INTO `siparis` (`id`, `sirket_id`, `must_id`, `urun_id`, `siparis_bilgisi`, `eklenme_tarihi`) VALUES
(10, 1, 1, 12, 'hello<br><p>asda</p>', '2015-05-11 10:48:34'),
(11, 1, 1, 12, 'hello<br><p>asda</p>', '2015-05-11 10:49:04'),
(12, 1, 1, 12, 'hello<br><p>asda</p>', '2015-05-11 11:03:46'),
(13, 1, 1, 1, 'hello<br><p>asda</p>', '2015-05-12 09:27:36');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `sirket`
--

CREATE TABLE IF NOT EXISTS `sirket` (
`id` int(11) NOT NULL COMMENT 'Şirket id.',
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
  `enlem` varchar(25) COLLATE utf8_bin NOT NULL,
  `boylam` varchar(25) COLLATE utf8_bin NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Tablo döküm verisi `sirket`
--

INSERT INTO `sirket` (`id`, `id_sektor`, `adi`, `adres`, `tel`, `logo`, `premium`, `ref_kod`, `yetkili_adi`, `yetkili_soyadi`, `yetkili_mail`, `yetkili_sifre`, `tarih_kayit`, `aktif`, `enlem`, `boylam`) VALUES
(1, 3, 'Yasin LTD.', 'Karşıda bir yerler. Kartal falan.', '+90 212 999 99 89', 'upload/2015-04/MQ==_20150412001952.jpg', 1, 'e55c79b6dfdd90e9a9b0177e6a80813a', 'Yasin', 'Kesim', 'yasin@yasin.com', '827ccb0eea8a706c4c34a16891f84e7b', '2015-04-09 00:00:00', 1, '41.310824', '27.773438'),
(2, 1, 'Serkan LTD.', 'Çıkmaz sokak.', '+90 212 999 99 88', 'upload/2015-04/MQ==_20150412001952.jpg', 0, 'serkan_ref_kod', 'Serkan', 'Serkan', 'serkan.ongan.web@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', '2015-04-10 00:00:00', 1, '', '');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `urunler`
--

CREATE TABLE IF NOT EXISTS `urunler` (
`id` int(11) NOT NULL,
  `id_sirket` int(11) NOT NULL,
  `id_category` varchar(100) COLLATE utf8_bin NOT NULL,
  `urun_adi` varchar(100) COLLATE utf8_bin NOT NULL,
  `kisa_aciklama` varchar(255) COLLATE utf8_bin NOT NULL,
  `aciklama` text COLLATE utf8_bin NOT NULL,
  `tarih` datetime NOT NULL,
  `fiyat` float(8,2) NOT NULL,
  `satis_tipi` int(11) NOT NULL,
  `kampanya` tinyint(1) NOT NULL,
  `kampanya_baslik` varchar(250) COLLATE utf8_bin NOT NULL,
  `kampanya_detay` text COLLATE utf8_bin NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Tablo döküm verisi `urunler`
--

INSERT INTO `urunler` (`id`, `id_sirket`, `id_category`, `urun_adi`, `kisa_aciklama`, `aciklama`, `tarih`, `fiyat`, `satis_tipi`, `kampanya`, `kampanya_baslik`, `kampanya_detay`) VALUES
(3, 1, '2,7,16', 'vaio', 'vaio ', 'Açıklamalar', '2015-04-28 09:34:04', 0.00, 0, 0, '', ''),
(4, 1, '2,8', 'Lenovo', 'LEnovo pc', 'pc Açıklama', '2015-04-28 09:44:04', 0.00, 0, 0, '', ''),
(5, 1, '1,6,15', 'Galaxy S3', 'Beyaz', 'Beyaz S3 Mini', '2015-04-28 09:48:04', 0.00, 0, 0, '', ''),
(9, 1, '2,7,16', 'aa', 'aa', 'aa', '2015-04-28 10:37:04', 0.00, 0, 0, '', ''),
(10, 1, '2,8', 'hp', 'desktop', 'açıklama hp', '2015-04-28 10:51:04', 0.00, 0, 0, '', ''),
(11, 1, '2,8', 'hp', 'desktop', 'açıklama hp', '2015-04-28 10:52:04', 0.00, 0, 0, '', ''),
(12, 1, '2,8', 'hp', 'desktop', 'açıklama hp', '2015-04-28 10:54:04', 0.00, 0, 0, '', ''),
(13, 1, '2,8', 'hp', 'desktop', 'açıklama hp', '2015-04-28 10:55:04', 0.00, 0, 0, '', ''),
(14, 1, '1,6', 's6++', 's6++', 'sdfdgm', '2015-05-04 09:47:05', 1900.00, 2, 1, '', ''),
(16, 1, '1,5,6,15,21,9', 'dsaads', 'adasd', 'asdasdsa', '2015-05-07 10:28:05', 123132.00, 1, 1, '', '');

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `anket_secenek`
--
ALTER TABLE `anket_secenek`
 ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `anket_yonetimi`
--
ALTER TABLE `anket_yonetimi`
 ADD PRIMARY KEY (`anket_id`);

--
-- Tablo için indeksler `begenme_yonetimi`
--
ALTER TABLE `begenme_yonetimi`
 ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `duyuru`
--
ALTER TABLE `duyuru`
 ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `duyurular`
--
ALTER TABLE `duyurular`
 ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `formlar`
--
ALTER TABLE `formlar`
 ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `forum`
--
ALTER TABLE `forum`
 ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `galeriler`
--
ALTER TABLE `galeriler`
 ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `galeriler_resimler`
--
ALTER TABLE `galeriler_resimler`
 ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `haberler`
--
ALTER TABLE `haberler`
 ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `haber_kategori`
--
ALTER TABLE `haber_kategori`
 ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `icerik_yonetimi`
--
ALTER TABLE `icerik_yonetimi`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `id` (`id`), ADD KEY `id_2` (`id`);

--
-- Tablo için indeksler `kategoriler`
--
ALTER TABLE `kategoriler`
 ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `kullanicilar`
--
ALTER TABLE `kullanicilar`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `mail` (`mail`);

--
-- Tablo için indeksler `kullanicilar_roller`
--
ALTER TABLE `kullanicilar_roller`
 ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `kullanicilar_sifre_reset`
--
ALTER TABLE `kullanicilar_sifre_reset`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `reset_key` (`reset_key`);

--
-- Tablo için indeksler `kullanicilar_sirket`
--
ALTER TABLE `kullanicilar_sirket`
 ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `mesajlar`
--
ALTER TABLE `mesajlar`
 ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `musteriler`
--
ALTER TABLE `musteriler`
 ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `reklamlar`
--
ALTER TABLE `reklamlar`
 ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `roller`
--
ALTER TABLE `roller`
 ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `sektor`
--
ALTER TABLE `sektor`
 ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `siparis`
--
ALTER TABLE `siparis`
 ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `sirket`
--
ALTER TABLE `sirket`
 ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `urunler`
--
ALTER TABLE `urunler`
 ADD PRIMARY KEY (`id`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `anket_secenek`
--
ALTER TABLE `anket_secenek`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=25;
--
-- Tablo için AUTO_INCREMENT değeri `anket_yonetimi`
--
ALTER TABLE `anket_yonetimi`
MODIFY `anket_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- Tablo için AUTO_INCREMENT değeri `begenme_yonetimi`
--
ALTER TABLE `begenme_yonetimi`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=23;
--
-- Tablo için AUTO_INCREMENT değeri `duyuru`
--
ALTER TABLE `duyuru`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- Tablo için AUTO_INCREMENT değeri `duyurular`
--
ALTER TABLE `duyurular`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=39;
--
-- Tablo için AUTO_INCREMENT değeri `formlar`
--
ALTER TABLE `formlar`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- Tablo için AUTO_INCREMENT değeri `forum`
--
ALTER TABLE `forum`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=22;
--
-- Tablo için AUTO_INCREMENT değeri `galeriler`
--
ALTER TABLE `galeriler`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=14;
--
-- Tablo için AUTO_INCREMENT değeri `galeriler_resimler`
--
ALTER TABLE `galeriler_resimler`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=31;
--
-- Tablo için AUTO_INCREMENT değeri `haberler`
--
ALTER TABLE `haberler`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- Tablo için AUTO_INCREMENT değeri `haber_kategori`
--
ALTER TABLE `haber_kategori`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- Tablo için AUTO_INCREMENT değeri `icerik_yonetimi`
--
ALTER TABLE `icerik_yonetimi`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=18;
--
-- Tablo için AUTO_INCREMENT değeri `kategoriler`
--
ALTER TABLE `kategoriler`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=23;
--
-- Tablo için AUTO_INCREMENT değeri `kullanicilar`
--
ALTER TABLE `kullanicilar`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Kullanıcı d''si',AUTO_INCREMENT=10;
--
-- Tablo için AUTO_INCREMENT değeri `kullanicilar_roller`
--
ALTER TABLE `kullanicilar_roller`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- Tablo için AUTO_INCREMENT değeri `kullanicilar_sifre_reset`
--
ALTER TABLE `kullanicilar_sifre_reset`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- Tablo için AUTO_INCREMENT değeri `kullanicilar_sirket`
--
ALTER TABLE `kullanicilar_sirket`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- Tablo için AUTO_INCREMENT değeri `mesajlar`
--
ALTER TABLE `mesajlar`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=17;
--
-- Tablo için AUTO_INCREMENT değeri `musteriler`
--
ALTER TABLE `musteriler`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Kullanıcı d''si',AUTO_INCREMENT=3;
--
-- Tablo için AUTO_INCREMENT değeri `reklamlar`
--
ALTER TABLE `reklamlar`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- Tablo için AUTO_INCREMENT değeri `sektor`
--
ALTER TABLE `sektor`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- Tablo için AUTO_INCREMENT değeri `siparis`
--
ALTER TABLE `siparis`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=14;
--
-- Tablo için AUTO_INCREMENT değeri `sirket`
--
ALTER TABLE `sirket`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Şirket id.',AUTO_INCREMENT=3;
--
-- Tablo için AUTO_INCREMENT değeri `urunler`
--
ALTER TABLE `urunler`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=17;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

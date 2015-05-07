-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 30 Nis 2015, 12:13:05
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
-- Tablo için tablo yapısı `anket_secenek`
--

CREATE TABLE IF NOT EXISTS `anket_secenek` (
  `id` int(11) NOT NULL,
  `sirket_id` int(11) NOT NULL,
  `anket_id` int(11) NOT NULL,
  `secenek` varchar(300) COLLATE utf8_bin NOT NULL COMMENT 'ankete verilecek cevaplar'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `anket_yonetimi`
--

CREATE TABLE IF NOT EXISTS `anket_yonetimi` (
  `anket_id` int(11) NOT NULL,
  `sirket_id` int(11) NOT NULL,
  `anket_baslik` varchar(500) COLLATE utf8_bin NOT NULL COMMENT 'anket soruları'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `duyuru`
--

CREATE TABLE IF NOT EXISTS `duyuru` (
  `id` int(11) NOT NULL,
  `sirket_id` int(11) NOT NULL,
  `duyuru_baslik` varchar(300) COLLATE utf8_bin NOT NULL,
  `duyuru_detay` varchar(500) COLLATE utf8_bin NOT NULL,
  `durum` enum('0','1') COLLATE utf8_bin NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

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
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Tablo döküm verisi `duyurular`
--

INSERT INTO `duyurular` (`id`, `id_kullanici`, `okunma`, `konu`, `mesaj`, `tarih_gonderi`) VALUES
(1, 2, 1, 'Yasin Merhaba.', 'Burada mesaj yer alacak.', '2015-04-21 03:08:08'),
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
(36, 5, 0, 'Kullanıcılar', '<p>Deneme kullanıcılar.&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<p><strong>asdadsasdasda</strong></p>\r\n<p>&nbsp;</p>\r\n<p>14:36:32</p>', '2015-04-21 14:36:44'),
(37, 2, 1, 'Kullanıcılar!', '<p><strong>Akıllı olun!</strong></p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<p>&lt;?php</p>\r\n<p>echo "LAAaan";</p>\r\n<p>?&gt;</p>', '2015-04-22 10:14:32'),
(38, 5, 0, 'Kullanıcılar!', '<p><strong>Akıllı olun!</strong></p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<p>&lt;?php</p>\r\n<p>echo "LAAaan";</p>\r\n<p>?&gt;</p>', '2015-04-22 10:14:32'),
(39, 2, 0, 'Body akap', '<p>Merbaba..</p>\r\n<p>&nbsp;</p>\r\n<p>&lt;script&gt; alert("asdfa");&lt;/script&gt;</p>\r\n<p>&nbsp;</p>\r\n<p>&lt;/body&gt;</p>', '2015-04-22 10:17:36'),
(40, 5, 0, 'Body akap', '<p>Merbaba..</p>\r\n<p>&nbsp;</p>\r\n<p>&lt;script&gt; alert("asdfa");&lt;/script&gt;</p>\r\n<p>&nbsp;</p>\r\n<p>&lt;/body&gt;</p>', '2015-04-22 10:17:36');

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
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Tablo döküm verisi `formlar`
--

INSERT INTO `formlar` (`id`, `id_sirket`, `adi`, `html`, `json`, `tarih`) VALUES
(7, 1, 'Form Name', '<form class="form-horizontal" >\r\n<fieldset>\r\n\r\n\r\n<legend>Form Name</legend>\r\n\r\n\r\n<div class="control-group">\r\n  <label class="control-label" for="textinput-0">Text Input</label>\r\n  <div class="controls">\r\n    <input id="textinput-0" name="textinput-0" type="text" placeholder="placeholder" class="input-xlarge">\r\n    <p class="help-block">help</p>\r\n  </div>\r\n</div>\r\n\r\n</fieldset>\r\n</form>\r\n', '{\n    "tag": "html",\n    "children": [\n        {\n            "tag": "body",\n            "children": [\n                {\n                    "tag": "form",\n                    "class": "form-horizontal",\n                    "html": "\\r\\n",\n                    "children": [\n                        {\n                            "tag": "fieldset",\n                            "children": [\n                                {\n                                    "tag": "legend",\n                                    "html": "Form Name"\n                                },\n                                {\n                                    "tag": "div",\n                                    "class": "control-group",\n                                    "html": "\\r\\n",\n                                    "children": [\n                                        {\n                                            "tag": "label",\n                                            "class": "control-label",\n                                            "for": "textinput-0",\n                                            "html": "Text Input"\n                                        },\n                                        {\n                                            "tag": "div",\n                                            "class": "controls",\n                                            "html": "\\r\\n  ",\n                                            "children": [\n                                                {\n                                                    "tag": "input",\n                                                    "id": "textinput-0",\n                                                    "name": "textinput-0",\n                                                    "type": "text",\n                                                    "placeholder": "placeholder",\n                                                    "class": "input-xlarge"\n                                                },\n                                                {\n                                                    "tag": "p",\n                                                    "class": "help-block",\n                                                    "html": "help"\n                                                }\n                                            ]\n                                        }\n                                    ]\n                                }\n                            ],\n                            "html": "\\r\\n\\r\\n"\n                        }\n                    ]\n                }\n            ]\n        }\n    ]\n}', '2015-04-27 16:56:00'),
(8, 1, 'Form Name', '<form class="form-horizontal" >\r\n<fieldset>\r\n\r\n\r\n<legend>Form Name</legend>\r\n\r\n\r\n<div class="control-group">\r\n  <label class="control-label" for="textinput-1">Text Input</label>\r\n  <div class="controls">\r\n    <input id="textinput-1" name="textinput-1" type="text" placeholder="placeholder" class="input-xlarge">\r\n    <p class="help-block">help</p>\r\n  </div>\r\n</div>\r\n\r\n\r\n<div class="control-group">\r\n  <label class="control-label" for="textinput-0">Text Input</label>\r\n  <div class="controls">\r\n    <input id="textinput-0" name="textinput-0" type="text" placeholder="placeholder" class="input-xlarge">\r\n    <p class="help-block">help</p>\r\n  </div>\r\n</div>\r\n\r\n</fieldset>\r\n</form>\r\n', '{\n    "tag": "html",\n    "children": [\n        {\n            "tag": "body",\n            "children": [\n                {\n                    "tag": "form",\n                    "class": "form-horizontal",\n                    "html": "\\r\\n",\n                    "children": [\n                        {\n                            "tag": "fieldset",\n                            "children": [\n                                {\n                                    "tag": "legend",\n                                    "html": "Form Name"\n                                },\n                                {\n                                    "tag": "div",\n                                    "class": "control-group",\n                                    "html": "\\r\\n",\n                                    "children": [\n                                        {\n                                            "tag": "label",\n                                            "class": "control-label",\n                                            "for": "textinput-1",\n                                            "html": "Text Input"\n                                        },\n                                        {\n                                            "tag": "div",\n                                            "class": "controls",\n                                            "html": "\\r\\n  ",\n                                            "children": [\n                                                {\n                                                    "tag": "input",\n                                                    "id": "textinput-1",\n                                                    "name": "textinput-1",\n                                                    "type": "text",\n                                                    "placeholder": "placeholder",\n                                                    "class": "input-xlarge"\n                                                },\n                                                {\n                                                    "tag": "p",\n                                                    "class": "help-block",\n                                                    "html": "help"\n                                                }\n                                            ]\n                                        }\n                                    ]\n                                },\n                                {\n                                    "tag": "div",\n                                    "class": "control-group",\n                                    "html": "\\r\\n",\n                                    "children": [\n                                        {\n                                            "tag": "label",\n                                            "class": "control-label",\n                                            "for": "textinput-0",\n                                            "html": "Text Input"\n                                        },\n                                        {\n                                            "tag": "div",\n                                            "class": "controls",\n                                            "html": "\\r\\n  ",\n                                            "children": [\n                                                {\n                                                    "tag": "input",\n                                                    "id": "textinput-0",\n                                                    "name": "textinput-0",\n                                                    "type": "text",\n                                                    "placeholder": "placeholder",\n                                                    "class": "input-xlarge"\n                                                },\n                                                {\n                                                    "tag": "p",\n                                                    "class": "help-block",\n                                                    "html": "help"\n                                                }\n                                            ]\n                                        }\n                                    ]\n                                }\n                            ],\n                            "html": "\\r\\n\\r\\n"\n                        }\n                    ]\n                }\n            ]\n        }\n    ]\n}', '2015-04-28 09:09:55'),
(9, 1, 'Form Name', '<form class="form-horizontal" >\r\n<fieldset>\r\n\r\n\r\n<legend>Form Name</legend>\r\n\r\n\r\n<div class="control-group">\r\n  <label class="control-label" for="textinput-0">Text Input</label>\r\n  <div class="controls">\r\n    <input id="textinput-0" name="textinput-0" type="text" placeholder="placeholder" class="input-xlarge">\r\n    <p class="help-block">help</p>\r\n  </div>\r\n</div>\r\n\r\n\r\n<div class="control-group">\r\n  <label class="control-label" for="passwordinput-0">Password Input</label>\r\n  <div class="controls">\r\n    <input id="passwordinput-0" name="passwordinput-0" type="password" placeholder="placeholder" class="input-xlarge">\r\n    <p class="help-block">help</p>\r\n  </div>\r\n</div>\r\n\r\n\r\n<div class="control-group">\r\n  <label class="control-label" for="singlebutton-0">Single Button</label>\r\n  <div class="controls">\r\n    <button id="singlebutton-0" name="singlebutton-0" class="btn btn-primary">Button</button>\r\n  </div>\r\n</div>\r\n\r\n</fieldset>\r\n</form>\r\n', '{\n    "tag": "html",\n    "children": [\n        {\n            "tag": "body",\n            "children": [\n                {\n                    "tag": "form",\n                    "class": "form-horizontal",\n                    "html": "\\r\\n",\n                    "children": [\n                        {\n                            "tag": "fieldset",\n                            "children": [\n                                {\n                                    "tag": "legend",\n                                    "html": "Form Name"\n                                },\n                                {\n                                    "tag": "div",\n                                    "class": "control-group",\n                                    "html": "\\r\\n",\n                                    "children": [\n                                        {\n                                            "tag": "label",\n                                            "class": "control-label",\n                                            "for": "textinput-0",\n                                            "html": "Text Input"\n                                        },\n                                        {\n                                            "tag": "div",\n                                            "class": "controls",\n                                            "html": "\\r\\n  ",\n                                            "children": [\n                                                {\n                                                    "tag": "input",\n                                                    "id": "textinput-0",\n                                                    "name": "textinput-0",\n                                                    "type": "text",\n                                                    "placeholder": "placeholder",\n                                                    "class": "input-xlarge"\n                                                },\n                                                {\n                                                    "tag": "p",\n                                                    "class": "help-block",\n                                                    "html": "help"\n                                                }\n                                            ]\n                                        }\n                                    ]\n                                },\n                                {\n                                    "tag": "div",\n                                    "class": "control-group",\n                                    "html": "\\r\\n",\n                                    "children": [\n                                        {\n                                            "tag": "label",\n                                            "class": "control-label",\n                                            "for": "passwordinput-0",\n                                            "html": "Password Input"\n                                        },\n                                        {\n                                            "tag": "div",\n                                            "class": "controls",\n                                            "html": "\\r\\n  ",\n                                            "children": [\n                                                {\n                                                    "tag": "input",\n                                                    "id": "passwordinput-0",\n                                                    "name": "passwordinput-0",\n                                                    "type": "password",\n                                                    "placeholder": "placeholder",\n                                                    "class": "input-xlarge"\n                                                },\n                                                {\n                                                    "tag": "p",\n                                                    "class": "help-block",\n                                                    "html": "help"\n                                                }\n                                            ]\n                                        }\n                                    ]\n                                },\n                                {\n                                    "tag": "div",\n                                    "class": "control-group",\n                                    "html": "\\r\\n",\n                                    "children": [\n                                        {\n                                            "tag": "label",\n                                            "class": "control-label",\n                                            "for": "singlebutton-0",\n                                            "html": "Single Button"\n                                        },\n                                        {\n                                            "tag": "div",\n                                            "class": "controls",\n                                            "html": "\\r\\n  ",\n                                            "children": [\n                                                {\n                                                    "tag": "button",\n                                                    "id": "singlebutton-0",\n                                                    "name": "singlebutton-0",\n                                                    "class": "btn btn-primary",\n                                                    "html": "Button"\n                                                }\n                                            ]\n                                        }\n                                    ]\n                                }\n                            ],\n                            "html": "\\r\\n\\r\\n"\n                        }\n                    ]\n                }\n            ]\n        }\n    ]\n}', '2015-04-28 10:01:20'),
(10, 1, 'Form Name', '<form class="form-horizontal" >\r\n<fieldset>\r\n\r\n\r\n<legend>Form Name</legend>\r\n\r\n\r\n<div class="control-group">\r\n  <label class="control-label" for="multipleradios-0">Multiple Radios</label>\r\n  <div class="controls">\r\n    <label class="radio" for="multipleradios-0-0">\r\n      <input type="radio" name="multipleradios-0" id="multipleradios-0-0" value="Option one" checked="checked">\r\n      Option one\r\n    </label>\r\n    <label class="radio" for="multipleradios-0-1">\r\n      <input type="radio" name="multipleradios-0" id="multipleradios-0-1" value="Option two">\r\n      Option two\r\n    </label>\r\n  </div>\r\n</div>\r\n\r\n</fieldset>\r\n</form>\r\n', '{\n    "tag": "html",\n    "children": [\n        {\n            "tag": "body",\n            "children": [\n                {\n                    "tag": "form",\n                    "class": "form-horizontal",\n                    "html": "\\r\\n",\n                    "children": [\n                        {\n                            "tag": "fieldset",\n                            "children": [\n                                {\n                                    "tag": "legend",\n                                    "html": "Form Name"\n                                },\n                                {\n                                    "tag": "div",\n                                    "class": "control-group",\n                                    "html": "\\r\\n",\n                                    "children": [\n                                        {\n                                            "tag": "label",\n                                            "class": "control-label",\n                                            "for": "multipleradios-0",\n                                            "html": "Multiple Radios"\n                                        },\n                                        {\n                                            "tag": "div",\n                                            "class": "controls",\n                                            "html": "\\r\\n  ",\n                                            "children": [\n                                                {\n                                                    "tag": "label",\n                                                    "class": "radio",\n                                                    "for": "multipleradios-0-0",\n                                                    "html": "\\r\\n      Option one\\r\\n    ",\n                                                    "children": [\n                                                        {\n                                                            "tag": "input",\n                                                            "type": "radio",\n                                                            "name": "multipleradios-0",\n                                                            "id": "multipleradios-0-0",\n                                                            "value": "Option one",\n                                                            "checked": "checked"\n                                                        }\n                                                    ]\n                                                },\n                                                {\n                                                    "tag": "label",\n                                                    "class": "radio",\n                                                    "for": "multipleradios-0-1",\n                                                    "html": "\\r\\n      Option two\\r\\n    ",\n                                                    "children": [\n                                                        {\n                                                            "tag": "input",\n                                                            "type": "radio",\n                                                            "name": "multipleradios-0",\n                                                            "id": "multipleradios-0-1",\n                                                            "value": "Option two"\n                                                        }\n                                                    ]\n                                                }\n                                            ]\n                                        }\n                                    ]\n                                }\n                            ],\n                            "html": "\\r\\n\\r\\n"\n                        }\n                    ]\n                }\n            ]\n        }\n    ]\n}', '2015-04-29 11:32:12'),
(11, 1, 'ASD', '<form class="form-horizontal" >\r\n<fieldset>\r\n\r\n\r\n<legend>ASD</legend>\r\n\r\n\r\n<div class="control-group">\r\n  <label class="control-label" for="textinput-0">Text Input</label>\r\n  <div class="controls">\r\n    <input id="textinput-0" name="textinput-0" type="text" placeholder="placeholder" class="input-xlarge">\r\n    <p class="help-block">help</p>\r\n  </div>\r\n</div>\r\n\r\n\r\n<div class="control-group">\r\n  <label class="control-label" for="passwordinput-0">Password Input</label>\r\n  <div class="controls">\r\n    <input id="passwordinput-0" name="passwordinput-0" type="password" placeholder="placeholder" class="input-xlarge">\r\n    <p class="help-block">help</p>\r\n  </div>\r\n</div>\r\n\r\n</fieldset>\r\n</form>\r\n', '{\n    "tag": "html",\n    "children": [\n        {\n            "tag": "body",\n            "children": [\n                {\n                    "tag": "form",\n                    "class": "form-horizontal",\n                    "html": "\\r\\n",\n                    "children": [\n                        {\n                            "tag": "fieldset",\n                            "children": [\n                                {\n                                    "tag": "legend",\n                                    "html": "ASD"\n                                },\n                                {\n                                    "tag": "div",\n                                    "class": "control-group",\n                                    "html": "\\r\\n",\n                                    "children": [\n                                        {\n                                            "tag": "label",\n                                            "class": "control-label",\n                                            "for": "textinput-0",\n                                            "html": "Text Input"\n                                        },\n                                        {\n                                            "tag": "div",\n                                            "class": "controls",\n                                            "html": "\\r\\n  ",\n                                            "children": [\n                                                {\n                                                    "tag": "input",\n                                                    "id": "textinput-0",\n                                                    "name": "textinput-0",\n                                                    "type": "text",\n                                                    "placeholder": "placeholder",\n                                                    "class": "input-xlarge"\n                                                },\n                                                {\n                                                    "tag": "p",\n                                                    "class": "help-block",\n                                                    "html": "help"\n                                                }\n                                            ]\n                                        }\n                                    ]\n                                },\n                                {\n                                    "tag": "div",\n                                    "class": "control-group",\n                                    "html": "\\r\\n",\n                                    "children": [\n                                        {\n                                            "tag": "label",\n                                            "class": "control-label",\n                                            "for": "passwordinput-0",\n                                            "html": "Password Input"\n                                        },\n                                        {\n                                            "tag": "div",\n                                            "class": "controls",\n                                            "html": "\\r\\n  ",\n                                            "children": [\n                                                {\n                                                    "tag": "input",\n                                                    "id": "passwordinput-0",\n                                                    "name": "passwordinput-0",\n                                                    "type": "password",\n                                                    "placeholder": "placeholder",\n                                                    "class": "input-xlarge"\n                                                },\n                                                {\n                                                    "tag": "p",\n                                                    "class": "help-block",\n                                                    "html": "help"\n                                                }\n                                            ]\n                                        }\n                                    ]\n                                }\n                            ],\n                            "html": "\\r\\n\\r\\n"\n                        }\n                    ]\n                }\n            ]\n        }\n    ]\n}', '2015-04-29 11:32:37');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `galeriler`
--

CREATE TABLE IF NOT EXISTS `galeriler` (
`id` int(11) NOT NULL,
  `id_sirket` int(11) NOT NULL,
  `isim` varchar(100) COLLATE utf8_bin NOT NULL,
  `aciklama` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `on_resim` int(11) NOT NULL,
  `aktif` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `galeriler_resimler`
--

CREATE TABLE IF NOT EXISTS `galeriler_resimler` (
`id` int(11) NOT NULL,
  `id_galeri` int(11) NOT NULL,
  `url` text COLLATE utf8_bin NOT NULL,
  `alt` varchar(255) COLLATE utf8_bin DEFAULT NULL COMMENT 'resim açıklaması'
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

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
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `kategoriler`
--

CREATE TABLE IF NOT EXISTS `kategoriler` (
`id` int(11) NOT NULL,
  `id_sirket` int(11) NOT NULL,
  `id_ust_kategori` int(11) NOT NULL,
  `kategori_adi` varchar(100) COLLATE utf8_bin NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

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
(15, 1, 6, 'Galaxy S3');

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
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Tablo döküm verisi `kullanicilar`
--

INSERT INTO `kullanicilar` (`id`, `adi`, `soyadi`, `mail`, `sifre`, `tarih_kayit`, `tarih_son_giris`) VALUES
(1, 'Serkan', 'Serkan', 'mail@mail.com', '827ccb0eea8a706c4c34a16891f84e7b', '2015-04-07 05:08:09', '2015-04-10 00:00:00'),
(2, 'Yasin', 'Kesim', 'yasin@yasin.com', '827ccb0eea8a706c4c34a16891f84e7b', '2015-04-09 00:00:00', '2015-04-09 00:00:00'),
(3, 'Yasinin', 'Çalışanı', 'calisan@yasin.com', '827ccb0eea8a706c4c34a16891f84e7b', '2015-04-10 00:00:00', '2015-04-10 00:00:00'),
(5, 'Serkan', 'Serkan', 'serkan.ongan.web@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', '2015-04-10 00:00:00', '2015-04-10 00:00:00');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `kullanicilar_roller`
--

CREATE TABLE IF NOT EXISTS `kullanicilar_roller` (
`id` int(11) NOT NULL,
  `id_kullanici` int(11) NOT NULL,
  `id_rol` int(11) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Tablo döküm verisi `kullanicilar_roller`
--

INSERT INTO `kullanicilar_roller` (`id`, `id_kullanici`, `id_rol`) VALUES
(1, 1, 0),
(2, 2, 1),
(3, 3, 2),
(5, 5, 1);

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
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='şifre yenileme isteği yapan kullanıcıya ait bilgiler';

--
-- Tablo döküm verisi `kullanicilar_sifre_reset`
--

INSERT INTO `kullanicilar_sifre_reset` (`id`, `kul_id`, `reset_key`, `reset_time`, `kullanildi`) VALUES
(1, 5, 'QNTmlo8nY6XusgNN1JDSnQWRKsGiQTkjU0QuD9IVf9SdtmPrwD', '2015-04-28 11:36:18', 0),
(2, 5, 'VP2w7nZUQaYltF53QRVJidzCGGEqkKdm6nTak2L2RGpH2NXoIm', '2015-04-28 11:49:32', 0),
(3, 5, 'XOdOxbo9hdAPh8EO7FVzU2g5eWYOcBWJnLuiSCtuiTdLINA6J4', '2015-04-28 11:50:13', 0),
(4, 5, 'UZrU1mr3iHOHyXaA9EAVVHGqdAwkSiHkfglEav02ZrOFx5libR', '2015-04-28 11:50:40', 0),
(5, 5, 'G7LMrQBhHJyl3tYrChGwXT35bvU4SRBY9aXJz9lQg0BgNu4tgM', '2015-04-28 11:51:47', 0),
(6, 5, 'AqhCuAVeEWNjnWZ6xz5jtiba14Tnxoi9QcYejY3PLG5ExNcVvh', '2015-04-28 11:53:18', 0);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `kullanicilar_sirket`
--

CREATE TABLE IF NOT EXISTS `kullanicilar_sirket` (
`id` int(11) NOT NULL,
  `id_kullanici` int(11) NOT NULL,
  `id_sirket` int(11) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Tablo döküm verisi `kullanicilar_sirket`
--

INSERT INTO `kullanicilar_sirket` (`id`, `id_kullanici`, `id_sirket`) VALUES
(1, 2, 1),
(2, 3, 1),
(4, 5, 2);

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
  `aktif` tinyint(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Tablo döküm verisi `reklamlar`
--

INSERT INTO `reklamlar` (`id`, `id_sirket`, `adi`, `gosterim`, `tiklama`, `tarih_baslangic`, `tarih_bitis`, `tarih_yukleme`, `dosya`, `kod`, `href`, `aktif`) VALUES
(1, 1, 'reklam 1 adi', 100, 30, '2015-04-16 00:00:00', '2015-04-17 00:00:00', '2015-04-14 00:00:00', 'upload/reklamlar/reklam1.jpg', '', 'http://www.google.com', 1),
(2, 1, 'reklam 2', 1, 0, '2015-04-17 00:00:00', '2015-04-18 00:00:00', '2015-04-14 00:00:00', 'upload/reklamlar/reklam2.jpg', '', 'http://www.google.com', 1);

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
  `aktif` tinyint(1) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Tablo döküm verisi `sirket`
--

INSERT INTO `sirket` (`id`, `id_sektor`, `adi`, `adres`, `tel`, `logo`, `premium`, `ref_kod`, `yetkili_adi`, `yetkili_soyadi`, `yetkili_mail`, `yetkili_sifre`, `tarih_kayit`, `aktif`) VALUES
(1, 4, 'Yasin EMLAK', 'Karşıda bir yerler. Kartal.', '+90 212 999 99 88', 'upload/2015-04/MQ==_20150412001952.jpg', 1, 'yasin_ref_kod', 'Yasin', 'Kesim', 'yasin@yasin.com', '827ccb0eea8a706c4c34a16891f84e7b', '2015-04-09 00:00:00', 1),
(2, 1, 'Serkan LTD.', 'Çıkmaz sokak.', '+90 212 999 99 88', 'upload/2015-04/MQ==_20150412001952.jpg', 0, 'serkan_ref_kod', 'Serkan', 'Serkan', 'serkan.ongan.web@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', '2015-04-10 00:00:00', 1);

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
  `tarih` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

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
-- Tablo için AUTO_INCREMENT değeri `duyurular`
--
ALTER TABLE `duyurular`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=41;
--
-- Tablo için AUTO_INCREMENT değeri `formlar`
--
ALTER TABLE `formlar`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- Tablo için AUTO_INCREMENT değeri `galeriler`
--
ALTER TABLE `galeriler`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- Tablo için AUTO_INCREMENT değeri `galeriler_resimler`
--
ALTER TABLE `galeriler_resimler`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
--
-- Tablo için AUTO_INCREMENT değeri `icerik_yonetimi`
--
ALTER TABLE `icerik_yonetimi`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- Tablo için AUTO_INCREMENT değeri `kategoriler`
--
ALTER TABLE `kategoriler`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=17;
--
-- Tablo için AUTO_INCREMENT değeri `kullanicilar`
--
ALTER TABLE `kullanicilar`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Kullanıcı d''si',AUTO_INCREMENT=6;
--
-- Tablo için AUTO_INCREMENT değeri `kullanicilar_roller`
--
ALTER TABLE `kullanicilar_roller`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- Tablo için AUTO_INCREMENT değeri `kullanicilar_sifre_reset`
--
ALTER TABLE `kullanicilar_sifre_reset`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- Tablo için AUTO_INCREMENT değeri `kullanicilar_sirket`
--
ALTER TABLE `kullanicilar_sirket`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- Tablo için AUTO_INCREMENT değeri `musteriler`
--
ALTER TABLE `musteriler`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Kullanıcı d''si',AUTO_INCREMENT=3;
--
-- Tablo için AUTO_INCREMENT değeri `reklamlar`
--
ALTER TABLE `reklamlar`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- Tablo için AUTO_INCREMENT değeri `sektor`
--
ALTER TABLE `sektor`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- Tablo için AUTO_INCREMENT değeri `sirket`
--
ALTER TABLE `sirket`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Şirket id.',AUTO_INCREMENT=3;
--
-- Tablo için AUTO_INCREMENT değeri `urunler`
--
ALTER TABLE `urunler`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

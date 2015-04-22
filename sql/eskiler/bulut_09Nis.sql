-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 09 Nis 2015, 09:31:42
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
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Tablo döküm verisi `kullanicilar`
--

INSERT INTO `kullanicilar` (`id`, `adi`, `soyadi`, `mail`, `sifre`, `tarih_kayit`, `tarih_son_giris`) VALUES
(1, 'Yasin', 'Kesim', 'yasin@yasin.com', '827ccb0eea8a706c4c34a16891f84e7b', '2015-04-02 03:09:08', '2015-04-03 02:03:01'),
(2, 'Süper', 'Kahraman', 'super.kahraman@mail.com', '827ccb0eea8a706c4c34a16891f84e7b', '2015-04-01 00:00:00', '2015-04-03 01:04:09');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `kullanicilar_roller`
--

CREATE TABLE IF NOT EXISTS `kullanicilar_roller` (
`id` int(11) NOT NULL,
  `id_kullanici` int(11) NOT NULL,
  `id_rol` int(11) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Tablo döküm verisi `kullanicilar_roller`
--

INSERT INTO `kullanicilar_roller` (`id`, `id_kullanici`, `id_rol`) VALUES
(1, 1, 1),
(2, 2, 0);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `kullanicilar_sifre_reset`
--

CREATE TABLE IF NOT EXISTS `kullanicilar_sifre_reset` (
`id` int(11) NOT NULL,
  `kul_id` int(11) NOT NULL COMMENT 'kullanıcının kullanıcılar tablosundaki id si',
  `reset_key` varchar(50) COLLATE utf8_bin NOT NULL COMMENT 'kullanıcıya gönderdiğimiz random key',
  `reset_time` datetime NOT NULL COMMENT 'kullanıcının şifre yenileme isteği yaptığı tarih'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='şifre yenileme isteği yapan kullanıcıya ait bilgiler';

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `kullanicilar_sirket`
--

CREATE TABLE IF NOT EXISTS `kullanicilar_sirket` (
`id` int(11) NOT NULL,
  `id_kullanici` int(11) NOT NULL,
  `id_sirket` int(11) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Tablo döküm verisi `kullanicilar_sirket`
--

INSERT INTO `kullanicilar_sirket` (`id`, `id_kullanici`, `id_sirket`) VALUES
(1, 1, 1);

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
(0, 'Süper Kahraman', 'Biziz bu. (HP +10)'),
(1, 'Şirket Admin', 'Şirketi oluşturan kişi. Patron.'),
(2, 'Normal Kullanıcı', 'Şirketin normal kullanıcısı.');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `sektor`
--

CREATE TABLE IF NOT EXISTS `sektor` (
`id` int(11) NOT NULL,
  `sektor_adi` varchar(100) COLLATE utf8_bin NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Tablo döküm verisi `sektor`
--

INSERT INTO `sektor` (`id`, `sektor_adi`) VALUES
(1, 'Emlak');

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
  `tarih_kayit` datetime NOT NULL COMMENT 'Şirket kayıt tarihi.'
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Tablo döküm verisi `sirket`
--

INSERT INTO `sirket` (`id`, `id_sektor`, `adi`, `adres`, `tel`, `logo`, `premium`, `ref_kod`, `tarih_kayit`) VALUES
(1, 1, 'Yasin Holding', 'Karşıda bir yerlerde.', '+90 (216) 999 99 99', 'http://app.nedir.com/content_imgs/resim.jpg', 0, '646ae72b89eb812677ea06b31b12a86e', '2015-04-03 06:07:06');

--
-- Dökümü yapılmış tablolar için indeksler
--

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
 ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `kullanicilar_sirket`
--
ALTER TABLE `kullanicilar_sirket`
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
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `adi` (`adi`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `kullanicilar`
--
ALTER TABLE `kullanicilar`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Kullanıcı d''si',AUTO_INCREMENT=3;
--
-- Tablo için AUTO_INCREMENT değeri `kullanicilar_roller`
--
ALTER TABLE `kullanicilar_roller`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- Tablo için AUTO_INCREMENT değeri `kullanicilar_sifre_reset`
--
ALTER TABLE `kullanicilar_sifre_reset`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- Tablo için AUTO_INCREMENT değeri `kullanicilar_sirket`
--
ALTER TABLE `kullanicilar_sirket`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- Tablo için AUTO_INCREMENT değeri `sektor`
--
ALTER TABLE `sektor`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- Tablo için AUTO_INCREMENT değeri `sirket`
--
ALTER TABLE `sirket`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Şirket id.',AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

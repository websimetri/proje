-- phpMyAdmin SQL Dump
-- version 4.3.9
-- http://www.phpmyadmin.net
--
-- Anamakine: localhost
-- Üretim Zamanı: 13 Nis 2015, 11:55:04
-- Sunucu sürümü: 5.5.40-log
-- PHP Sürümü: 5.3.28

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
-- Tablo için tablo yapısı `icerik_yonetimi`
--

CREATE TABLE IF NOT EXISTS `icerik_yonetimi` (
  `id` int(11) NOT NULL,
  `sirket_id` int(11) NOT NULL,
  `baslik` varchar(100) COLLATE utf8_bin NOT NULL,
  `kisa_aciklama` varchar(255) COLLATE utf8_bin NOT NULL,
  `detay` varchar(500) COLLATE utf8_bin NOT NULL,
  `eklenme_tarihi` datetime NOT NULL,
  `durum` enum('0','1') COLLATE utf8_bin NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `icerik_yonetimi`
--
ALTER TABLE `icerik_yonetimi`
  ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `id` (`id`), ADD KEY `id_2` (`id`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `icerik_yonetimi`
--
ALTER TABLE `icerik_yonetimi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

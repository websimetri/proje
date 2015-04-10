-- phpMyAdmin SQL Dump
-- version 4.3.9
-- http://www.phpmyadmin.net
--
-- Anamakine: localhost
-- Üretim Zamanı: 07 Nis 2015, 13:00:31
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
-- Tablo için tablo yapısı `kullanicilar_sifre_reset`
--

CREATE TABLE IF NOT EXISTS `kullanicilar_sifre_reset` (
  `id` int(11) NOT NULL,
  `kul_id` int(11) NOT NULL COMMENT 'kullanıcının kullanıcılar tablosundaki id si',
  `reset_key` varchar(50) COLLATE utf8_bin NOT NULL COMMENT 'kullanıcıya gönderdiğimiz random key',
  `reset_time` datetime NOT NULL COMMENT 'kullanıcının şifre yenileme isteği yaptığı tarih'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='şifre yenileme isteği yapan kullanıcıya ait bilgiler';

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `kullanicilar_sifre_reset`
--
ALTER TABLE `kullanicilar_sifre_reset`
  ADD PRIMARY KEY (`id`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `kullanicilar_sifre_reset`
--
ALTER TABLE `kullanicilar_sifre_reset`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

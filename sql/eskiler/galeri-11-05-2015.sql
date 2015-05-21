-- phpMyAdmin SQL Dump
-- version 4.3.9
-- http://www.phpmyadmin.net
--
-- Anamakine: localhost
-- Üretim Zamanı: 11 May 2015, 12:10:17
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
-- Tablo için tablo yapısı `galeriler`
--

CREATE TABLE IF NOT EXISTS `galeriler` (
  `id` int(11) NOT NULL,
  `id_sirket` int(11) NOT NULL,
  `isim` varchar(100) COLLATE utf8_bin NOT NULL,
  `aciklama` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `aktif` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Tablo döküm verisi `galeriler`
--

INSERT INTO `galeriler` (`id`, `id_sirket`, `isim`, `aciklama`, `aktif`) VALUES
(1, 1, 'deneme galeri', 'bunu deniyorum', 1),
(2, 2, 'bu da deneme', 'bunu da deniyoruz :)', 1),
(3, 1, 'bunun içi boş', 'boş çünkü', 1),
(4, 1, 'bu boş olacak', 'içinde birşey yok', 1);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `galeriler_resimler`
--

CREATE TABLE IF NOT EXISTS `galeriler_resimler` (
  `id` int(11) NOT NULL,
  `id_galeri` int(11) NOT NULL,
  `url` text COLLATE utf8_bin NOT NULL,
  `alt` varchar(255) COLLATE utf8_bin DEFAULT NULL COMMENT 'resim açıklaması'
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Tablo döküm verisi `galeriler_resimler`
--

INSERT INTO `galeriler_resimler` (`id`, `id_galeri`, `url`, `alt`) VALUES
(1, 1, 'http://static.guim.co.uk/sys-images/Guardian/Pix/pictures/2014/4/11/1397210130748/Spring-Lamb.-Image-shot-2-011.jpg', 'dolly'),
(2, 3, 'http://www.keenthemes.com/preview/metronic/theme/assets/global/plugins/jcrop/demos/demo_files/image1.jpg', 'yaprak'),
(3, 1, 'http://www.keenthemes.com/preview/metronic/theme/assets/global/plugins/jcrop/demos/demo_files/image1.jpg', 'yaprak'),
(4, 1, 'http://static.guim.co.uk/sys-images/Guardian/Pix/pictures/2014/4/11/1397210130748/Spring-Lamb.-Image-shot-2-011.jpg', 'dolly'),
(19, 1, 'upload/2015-05/MQ==_20150511103638.jpg', 'deneme');

--
-- Dökümü yapılmış tablolar için indeksler
--

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
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `galeriler`
--
ALTER TABLE `galeriler`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- Tablo için AUTO_INCREMENT değeri `galeriler_resimler`
--
ALTER TABLE `galeriler_resimler`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=20;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

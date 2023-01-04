-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Anamakine: localhost
-- Üretim Zamanı: 20 Eki 2012, 17:03:09
-- Sunucu sürümü: 5.5.16
-- PHP Sürümü: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Veritabanı: `ajax`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `veri`
--

CREATE TABLE IF NOT EXISTS `veri` (
  `veri_id` int(11) NOT NULL AUTO_INCREMENT,
  `veri_text` varchar(300) NOT NULL,
  PRIMARY KEY (`veri_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=16 ;

--
-- Tablo döküm verisi `veri`
--

INSERT INTO `veri` (`veri_id`, `veri_text`) VALUES
(1, 'Tayfun Erbilen'),
(2, 'Güner Erbilen'),
(3, 'Prototurk.com'),
(4, 'UzmanVideo.Org'),
(5, 'Erbilen.NET'),
(6, 'UzmanCevap.Org'),
(11, 'yeni değer'),
(12, 'erbilen');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

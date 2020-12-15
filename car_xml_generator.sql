-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hostiteľ: 127.0.0.1:3308
-- Čas generovania: Út 15.Dec 2020, 09:57
-- Verzia serveru: 5.7.31
-- Verzia PHP: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Databáza: `car_xml_generator`
--

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `cars`
--

DROP TABLE IF EXISTS `cars`;
CREATE TABLE IF NOT EXISTS `cars` (
  `car_id` int(11) NOT NULL AUTO_INCREMENT,
  `car_brand` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `car_model` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `7_pin` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `13_pin` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `car_order` int(11) NOT NULL,
  PRIMARY KEY (`car_id`)
) ENGINE=MyISAM AUTO_INCREMENT=28 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Sťahujem dáta pre tabuľku `cars`
--

INSERT INTO `cars` (`car_id`, `car_brand`, `car_model`, `7_pin`, `13_pin`, `car_order`) VALUES
(9, 'Audi', 'A6', '87501881 - 12500601CD-JS AUDI A3 ab 08-12.pdf', '0123456789635', 1),
(18, 'Embečka', 'A6', '8888888', '1313131313131', 12),
(11, 'BMW', 'M5', '4dg634sd', 'dg846sg', 2),
(12, 'Bentley', 'Continental', 'f4s5f54', '53sf6', 4),
(13, 'Citroen', 'C5', '4g3dfv', '56565gs', 6),
(20, 'Škodaaaaa', 'Continental', '7777777', 'dg846sg', 13),
(16, 'Fiat', 'Multipla', '4gd343dv', '6666', 7),
(21, 'Bentley', 'Favorit', '8888888', '2525252525252', 14),
(22, 'Škoda', '5616', '1234567', 'dg846sg', 15),
(23, 'Audi', 'A4', '7777777', 'gdffdgfdg', 16);

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `menu`
--

DROP TABLE IF EXISTS `menu`;
CREATE TABLE IF NOT EXISTS `menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `seo_name` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `module_filename` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Sťahujem dáta pre tabuľku `menu`
--

INSERT INTO `menu` (`id`, `name`, `seo_name`, `module_filename`) VALUES
(1, 'Pridať záznam', 'pridat-zaznam', 'mod_pridat-zaznam.php'),
(2, 'Spravovať záznamy', 'spravovat-zaznamy', 'mod_spravovat-zaznamy.php');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

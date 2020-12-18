-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hostiteľ: 127.0.0.1:3308
-- Čas generovania: Pi 18.Dec 2020, 08:57
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
) ENGINE=MyISAM AUTO_INCREMENT=38 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Sťahujem dáta pre tabuľku `cars`
--

INSERT INTO `cars` (`car_id`, `car_brand`, `car_model`, `7_pin`, `13_pin`, `car_order`) VALUES
(37, 'Dacia', 'Duster', '1234567', 'dg846sg', 4),
(35, 'Embečka', 'A6', '8888888', '1313131313131', 1),
(36, 'Škoda', 'Favorit', '7777777', '1313131313131', 4),
(34, 'Citroen', 'C3', 'dasdas', 'asdasd', 1),
(30, 'Audi', 'A6', '88888889', '1313131313131', 1),
(31, 'Audi', 'Q7', '8888888', '1313131313131', 1),
(32, 'BMW', 'M5', '567', '2525252525252', 2);

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `cd`
--

DROP TABLE IF EXISTS `cd`;
CREATE TABLE IF NOT EXISTS `cd` (
  `cd_id` int(11) NOT NULL AUTO_INCREMENT,
  `cd_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `cd_number` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cd_date` date DEFAULT NULL,
  `codierung` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`cd_id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Sťahujem dáta pre tabuľku `cd`
--

INSERT INTO `cd` (`cd_id`, `cd_name`, `cd_number`, `cd_date`, `codierung`) VALUES
(1, 'CD1', '1234', '2020-11-30', 0),
(3, 'CD2', '5678', '2020-12-15', 1),
(6, 'Jaeger', '158', '2020-12-12', 0),
(5, 'CD5', '1', '2021-01-09', 1);

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `cd_cars`
--

DROP TABLE IF EXISTS `cd_cars`;
CREATE TABLE IF NOT EXISTS `cd_cars` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `cd_id` int(11) NOT NULL,
  `car_id` int(11) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=302 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Sťahujem dáta pre tabuľku `cd_cars`
--

INSERT INTO `cd_cars` (`ID`, `cd_id`, `car_id`) VALUES
(299, 1, 36),
(301, 5, 37),
(300, 3, 37),
(298, 5, 34);

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
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Sťahujem dáta pre tabuľku `menu`
--

INSERT INTO `menu` (`id`, `name`, `seo_name`, `module_filename`) VALUES
(1, 'Pridať záznam', 'pridat-zaznam', 'mod_pridat-zaznam.php'),
(2, 'Spravovať záznamy', 'spravovat-zaznamy', 'mod_spravovat-zaznamy.php'),
(3, 'Pridať CD', 'pridat-cd', 'mod_pridat-cd.php'),
(4, 'Spravovať CD', 'spravovat-cd', 'mod_spravovat-cd.php');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

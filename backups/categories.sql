-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 66062.m.tld.pl
-- Czas generowania: 24 Lip 2021, 16:24
-- Wersja serwera: 5.7.28-31-log
-- Wersja PHP: 7.3.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `baza66062_nata`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `categories`
--

CREATE TABLE `categories` (
  `id` int(11) UNSIGNED NOT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `title` text COLLATE utf8_polish_ci,
  `slug` text COLLATE utf8_polish_ci,
  `description` text COLLATE utf8_polish_ci,
  `photo` text COLLATE utf8_polish_ci,
  `alt` text COLLATE utf8_polish_ci,
  `priority` int(11) DEFAULT NULL,
  `active` text COLLATE utf8_polish_ci,
  `name_photo_1` text COLLATE utf8_polish_ci,
  `category_key` text COLLATE utf8_polish_ci,
  `dimension` int(11) NOT NULL DEFAULT '0' COMMENT 'Subcategory dimension from 0 to 3\r\n'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `categories`
--

INSERT INTO `categories` (`id`, `created`, `title`, `slug`, `description`, `photo`, `alt`, `priority`, `active`, `name_photo_1`, `category_key`, `dimension`) VALUES
(2, '2020-10-19 10:07:40', 'Ochrona rąk', 'ochrona-rak', NULL, '2021-04-06/013-gloves.svg', '', 1, '1', NULL, 'HANDS', 0),
(3, '2020-10-19 10:12:36', 'Ochrona ciała', 'ochrona-ciala', NULL, '2021-04-06/029-shirt.svg', 'biuro', 2, '1', NULL, 'BODY', 0),
(4, '2020-10-19 10:12:53', 'Ochrona nóg', 'ochrona-nog', NULL, '2021-04-06/007-boots.svg', '', 3, '1', NULL, 'LEGS', 0),
(5, '2020-10-19 10:13:25', 'Ochrona dróg oddechowych', 'ochrona-drog-oddechowych', NULL, '2021-04-06/medical-mask_(1).svg', '', 4, '1', NULL, 'LUNGS', 0),
(6, '2020-10-19 10:13:58', 'Ochrona oczu', 'ochrona-oczu', NULL, '2021-04-06/Winter_Glasses.svg', '', 7, '1', NULL, 'EYES', 0),
(7, '2020-10-19 10:14:21', 'Ochrona głowy', 'ochrona-glowy', NULL, '2021-04-06/001-helmet.svg', '', 5, '1', NULL, 'HEAD', 0),
(8, '2020-10-19 10:14:50', 'Ochrona słuchu', 'ochrona-sluchu', NULL, '2021-04-06/002-headphone-symbol.svg', '', 6, '1', NULL, 'HEARING', 0),
(9, '2020-11-23 11:08:25', 'Ochrona przeciwpożarowa', 'ochrona-przeciwpozarowa', NULL, '2021-04-06/XMLID_200_.svg', '', 9, '1', NULL, 'FIRE_PROTECTION', 0),
(10, '2021-02-08 11:02:20', 'Ochrona przed upadkiem', 'ochrona-przed-upadkiem', NULL, '2021-04-06/004-carabiner.svg', '', 8, '1', NULL, 'FALL', 0),
(11, '2021-04-06 13:39:02', 'Higiena i czystość', 'higiena-i-czystosc', NULL, '2021-04-06/006-spray.svg', '', 10, '1', NULL, 'HYGIENE', 0),
(12, '2021-04-06 13:40:09', 'Wyposażenie zakładów', 'wyposazenie-zakladow', NULL, '2021-04-06/007-support.svg', '', 11, '1', NULL, 'EQUIPMENT', 0),
(13, '2021-04-06 13:40:38', 'Pozostałe produkty', 'pozostale-produkty', NULL, '2021-04-06/008-portfolio.svg', '', 12, '1', NULL, 'OTHER', 0);

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT dla zrzuconych tabel
--

--
-- AUTO_INCREMENT dla tabeli `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

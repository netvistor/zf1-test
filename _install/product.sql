-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Czas generowania: 01 Lut 2022, 00:28
-- Wersja serwera: 10.1.19-MariaDB
-- Wersja PHP: 5.5.38

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `product`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `tax` int(11) NOT NULL DEFAULT '23'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `products`
--

INSERT INTO `products` (`id`, `status`, `name`, `description`, `price`, `tax`) VALUES
(1, 1, 'Samolot wielozadaniowy F-16 C/D BLOCK 52+', 'F-16 to jeden z najbardziej zaawansowanych i wszechstronnie sprawdzonych w walce wspÃ³Å‚czesnych samolotÃ³w bojowych. Jest przystosowany do przenoszenia najwiÄ™kszej iloÅ›ci lotniczych Å›rodkÃ³w bojowych. Ma duÅ¼y potencjaÅ‚ modernizacyjny i podlega ciÄ…gÅ‚emu unowoczeÅ›nianiu. \r\n\r\nDane taktyczno-techniczne:\r\n\r\n- dÅ‚ugoÅ›Ä‡ 15,03 m;\r\n- rozpiÄ™toÅ›Ä‡ skrzydeÅ‚ 9,45 m;\r\n- masa maks. 21,77 t;\r\n- prÄ™dkoÅ›Ä‡ maks. 2,2 Ma;\r\n- maks. zasiÄ™g okoÅ‚o 5000 km.', '1203003.03', 2),
(2, 0, 'Samolot transportowy C-295M CASA', 'Samolot nowej generacji, bardzo wytrzymaÅ‚y i niezawodny. Wszechstronny taktycznie transportowiec, ktÃ³ry jest w stanie przewieÅºÄ‡ do 5 ton Å‚adunku lub okoÅ‚o 70 Å¼oÅ‚nierzy, z maksymalnÄ… prÄ™dkoÅ›ciÄ… przelotowÄ… 480 km/h. To dwusilnikowy gÃ³rnopÅ‚at z chowanym podwoziem i kabinÄ… ciÅ›nieniowÄ….\r\n \r\nDane taktyczno-techniczne:\r\n\r\n- rozpiÄ™toÅ›Ä‡ â€“ 25,81 m;\r\n- dÅ‚ugoÅ›Ä‡ â€“ 24,45 m;\r\n- wysokoÅ›Ä‡ â€“ 8,66 m, \r\n- masa wÅ‚asna â€“ 18 500 kg; \r\n- masa caÅ‚kowita â€“ 23 200 kg; \r\n- prÄ™dkoÅ›Ä‡ przelotowa â€“ 480 km/h; \r\n- zasiÄ™g z Å‚adunkiem maksymalnym â€“ 2300 km;  \r\n- napÄ™d â€“ dwa silniki turboÅ›migÅ‚owe Pratt Whitney Canada PW127G o mocy 1972 kW kaÅ¼dy;\r\n- uzbrojenie â€“ maszyny wyposaÅ¼ono w obronny system walki radioelektronicznej Indra ALR 300Y2B zintegrowany z wyrzutnikami flar i dipoli AN/ALE-47.', '1584000.00', 0);

--
-- Indeksy dla zrzutów tabel
--

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

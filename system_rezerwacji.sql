-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 03, 2026 at 07:05 PM
-- Wersja serwera: 10.4.32-MariaDB
-- Wersja PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `system_rezerwacji`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `miejsca`
--

CREATE TABLE `miejsca` (
  `id` int(11) NOT NULL,
  `nazwa` varchar(200) NOT NULL,
  `adres` varchar(200) NOT NULL,
  `pojemnosc` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `miejsca`
--

INSERT INTO `miejsca` (`id`, `nazwa`, `adres`, `pojemnosc`) VALUES
(1, 'Stadion Narodowy', 'al. Ks. J. Poniatowskiego 1, Warszawa', 58000),
(2, 'Hala Widowiskowa Arena', 'ul. Sportowa 22, Kraków', 12000),
(3, 'Centrum Konferencyjne', 'ul. Biznesowa 5, Gdańsk', 800);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `rezerwacje`
--

CREATE TABLE `rezerwacje` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_wydarzenia` int(11) NOT NULL,
  `ilosc_biletow` int(11) NOT NULL CHECK (`ilosc_biletow` > 0)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `login` varchar(200) NOT NULL,
  `email` varchar(70) NOT NULL,
  `haslo` varchar(200) NOT NULL,
  `rola` enum('admin','user') NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `login`, `email`, `haslo`, `rola`) VALUES
(1, 'admin', 'admin@example.com', 'admin123', 'admin'),
(2, 'jan', 'jan@example.com', 'jan123', 'user');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `wydarzenia`
--

CREATE TABLE `wydarzenia` (
  `id` int(11) NOT NULL,
  `nazwa` varchar(200) NOT NULL,
  `opis` varchar(250) DEFAULT NULL,
  `data` datetime NOT NULL,
  `id_miejsca` int(11) NOT NULL,
  `limit_biletow` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `wydarzenia`
--

INSERT INTO `wydarzenia` (`id`, `nazwa`, `opis`, `data`, `id_miejsca`, `limit_biletow`) VALUES
(1, 'Koncert Rockowy', 'Największy koncert rockowy w kraju', '2026-06-20 19:00:00', 2, 12000),
(2, 'Mecz Polska vs Niemcy', 'Towarzyski mecz reprezentacji', '2026-07-05 20:45:00', 1, 58000),
(3, 'Konferencja Technologiczna 2026', 'Spotkanie specjalistów IT', '2026-05-15 10:00:00', 3, 800);

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `miejsca`
--
ALTER TABLE `miejsca`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `rezerwacje`
--
ALTER TABLE `rezerwacje`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_wydarzenia` (`id_wydarzenia`);

--
-- Indeksy dla tabeli `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `login` (`login`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indeksy dla tabeli `wydarzenia`
--
ALTER TABLE `wydarzenia`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_miejsca` (`id_miejsca`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `miejsca`
--
ALTER TABLE `miejsca`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `rezerwacje`
--
ALTER TABLE `rezerwacje`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `wydarzenia`
--
ALTER TABLE `wydarzenia`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `rezerwacje`
--
ALTER TABLE `rezerwacje`
  ADD CONSTRAINT `rezerwacje_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `rezerwacje_ibfk_2` FOREIGN KEY (`id_wydarzenia`) REFERENCES `wydarzenia` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `wydarzenia`
--
ALTER TABLE `wydarzenia`
  ADD CONSTRAINT `wydarzenia_ibfk_1` FOREIGN KEY (`id_miejsca`) REFERENCES `miejsca` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

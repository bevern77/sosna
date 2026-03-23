-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 23, 2026 at 02:49 PM
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
(3, 'Centrum Konferencyjne', 'ul. Biznesowa 5, Gdańsk', 800),
(4, 'Hala Stulecia', 'Wystawowa 1, Wrocław', 10000),
(5, 'Opera Nova', 'Marszałka Focha 5, Bydgoszcz', 850),
(6, 'Arena Lublin', 'Stadionowa 1, Lublin', 15500),
(7, 'Amfiteatr', 'Festiwalowa 3, Zielona Góra', 4000),
(8, 'Atlas Arena', 'Bandurskiego 7, Łódź', 13800),
(9, 'ICE Kraków', 'Marii Konopnickiej 17, Kraków', 2000),
(10, 'COS Torwar', 'Łazienkowska 6a, Warszawa', 4800),
(11, 'Amfiteatr Tysiąclecia', 'Piastowska 14A, Opole', 3600),
(12, 'Hala Podpromie', 'Podpromie 10, Rzeszów', 4300),
(13, 'Stadion Miejski', 'Słoneczna 1, Białystok', 22400),
(14, 'Ergo Arena', 'Plac Dwóch Miast 1, Gdańsk', 11400),
(15, 'Spodek', 'Korfantego 35, Katowice', 11000),
(16, 'Amfiteatr Kadzielnia', 'Legionów 1, Kielce', 5500),
(17, 'Hala Urania', 'Piłsudskiego 44, Olsztyn', 2500),
(18, 'Enea Stadion', 'Bułgarska 17, Poznań', 42800),
(19, 'Filharmonia', 'Małopolska 48, Szczecin', 950);

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
  `kategoria` varchar(50) NOT NULL,
  `data` datetime NOT NULL,
  `id_miejsca` int(11) NOT NULL,
  `limit_biletow` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `wydarzenia`
--

INSERT INTO `wydarzenia` (`id`, `nazwa`, `opis`, `kategoria`, `data`, `id_miejsca`, `limit_biletow`) VALUES
(1, 'Koncert Rockowy', 'Największy koncert rockowy w kraju', 'Koncerty', '2026-06-20 19:00:00', 2, 12000),
(2, 'Mecz Polska vs Niemcy', 'Towarzyski mecz reprezentacji', 'Sport', '2026-07-05 20:45:00', 1, 58000),
(3, 'Konferencja Technologiczna 2026', 'Spotkanie specjalistów IT', 'Biznes', '2026-05-15 10:00:00', 3, 800),
(4, 'Wielki Koncert Hip-Hopowy', 'Czołówka polskiej sceny rapowej na jednej scenie.', 'Koncerty', '2026-05-10 20:00:00', 4, 9500),
(5, 'Targi Książki i Fantastyki', 'Spotkania z autorami, prelekcje i ogromne stoiska wydawnictw.', 'Biznes', '2026-06-15 09:00:00', 4, 10000),
(6, 'Wystawa Psów Rasowych', 'Międzynarodowa wystawa z udziałem tysięcy wystawców.', 'Rodzinne', '2026-07-20 10:00:00', 4, 8000),
(7, 'Jezioro Łabędzie', 'Klasyczny balet w wykonaniu mistrzów z Europy.', 'Teatr', '2026-09-05 19:00:00', 5, 850),
(8, 'Koncert Muzyki Filmowej', 'Najpiękniejsze ścieżki dźwiękowe z udziałem orkiestry symfonicznej.', 'Koncerty', '2026-10-12 18:30:00', 5, 850),
(9, 'Stand-up: Nowa fala', 'Wieczór mocnego humoru na deskach opery.', 'Stand-up', '2026-11-20 20:00:00', 5, 850),
(10, 'Mecz Reprezentacji U-21', 'Polska zmierzy się z Hiszpanią w meczu eliminacyjnym.', 'Sport', '2026-08-14 20:45:00', 6, 15000),
(11, 'Festiwal Kolorów', 'Najbardziej kolorowa impreza w mieście z muzyką DJ-ów.', 'Rodzinne', '2026-06-25 15:00:00', 6, 12000),
(12, 'Koncert Rockowy: Legendy', 'Wielki powrót starych rockowych brzmień na żywo.', 'Koncerty', '2026-07-30 19:00:00', 6, 15500),
(13, 'Polska Noc Kabaretowa', 'Najlepsze polskie kabarety w plenerze.', 'Stand-up', '2026-05-22 19:30:00', 7, 3800),
(14, 'Koncert Pop na Lato', 'Rozpoczęcie wakacji z największymi hitami z radia.', 'Koncerty', '2026-06-30 20:00:00', 7, 4000),
(15, 'Spektakl Plenerowy dla Dzieci', 'Magiczna podróż do świata baśni i czarów.', 'Rodzinne', '2026-08-15 16:00:00', 7, 2000),
(16, 'Mistrzostwa Świata w Siatkówce', 'Półfinałowe starcie gigantów siatkówki.', 'Sport', '2026-09-18 20:00:00', 8, 13800),
(17, 'Targi Gier i Popkultury', 'Esport, planszówki i najnowsze gry wideo w jednym miejscu.', 'Biznes', '2026-10-25 10:00:00', 8, 10000),
(18, 'Wielki Koncert Światowej Gwiazdy', 'Ekskluzywny przystanek na europejskiej trasie koncertowej.', 'Koncerty', '2026-11-05 21:00:00', 8, 13800),
(19, 'Gala Stand-upu w Łodzi', 'Czterech komików, jeden mikrofon, tysiące śmiejących się widzów.', 'Stand-up', '2026-12-10 19:00:00', 8, 12000),
(20, 'Kongres Nowoczesnych Technologii', 'AI, Machine Learning i przyszłość branży IT.', 'Biznes', '2026-04-10 09:00:00', 9, 2000),
(21, 'Wieczór Jazzowy', 'Klimatyczny koncert legend jazzu.', 'Koncerty', '2026-05-15 20:00:00', 9, 1900),
(22, 'Spektakl: Dziady', 'Klasyka polskiej literatury w nowoczesnym wydaniu.', 'Teatr', '2026-10-31 19:00:00', 9, 2000),
(23, 'Rewia na Lodzie', 'Zjawiskowe akrobacje łyżwiarskie dla całej rodziny.', 'Rodzinne', '2026-12-05 17:00:00', 10, 4500),
(24, 'Koncert K-Pop', 'Pierwszy występ koreańskiego boysbandu w Warszawie.', 'Koncerty', '2026-07-12 19:00:00', 10, 4800),
(25, 'Finał Ligi Koszykówki', 'Decydujący mecz o mistrzostwo kraju.', 'Sport', '2026-06-18 18:30:00', 10, 4800),
(26, 'Krajowy Festiwal Piosenki', 'Święto polskiej muzyki na kultowej scenie.', 'Koncerty', '2026-06-05 20:00:00', 11, 3600),
(27, 'Kabareton Opolski', 'Wieczór pełen śmiechu z udziałem ulubieńców publiczności.', 'Stand-up', '2026-06-06 21:00:00', 11, 3600),
(28, 'Koncert Muzyki Klasycznej', 'Letni wieczór przy dźwiękach Chopina i Mozarta.', 'Koncerty', '2026-08-20 18:00:00', 11, 3000),
(29, 'Mecz Siatkówki - PlusLiga', 'Starcie na szczycie tabeli ligowej.', 'Sport', '2026-10-10 17:30:00', 12, 4300),
(30, 'Targi Budownictwa', 'Wszystko dla domu, ogrodu i nowoczesnego budownictwa.', 'Biznes', '2026-04-25 09:00:00', 12, 3000),
(31, 'Wielka Wystawa Kotów', 'Pokaz najpiękniejszych i najrzadszych ras z całego świata.', 'Rodzinne', '2026-05-30 10:00:00', 12, 2500),
(32, 'Mecz Ekstraklasy', 'Derby regionu o cenne punkty.', 'Sport', '2026-08-22 20:00:00', 13, 22400),
(33, 'Zlot Food Trucków', 'Piknik rodzinny z jedzeniem z całego świata i muzyką na żywo.', 'Rodzinne', '2026-07-15 12:00:00', 13, 10000),
(34, 'Wielki Koncert Plenerowy', 'Zakończenie lata z gwiazdami polskiej sceny.', 'Koncerty', '2026-08-29 19:00:00', 13, 20000),
(35, 'Gala MMA Sopot/Gdańsk', 'Spektakularne walki w klatce na granicy dwóch miast.', 'Sport', '2026-11-14 20:00:00', 14, 11400),
(36, 'Festiwal Muzyki Elektronicznej', 'Całonocna impreza z najlepszymi DJ-ami.', 'Koncerty', '2026-10-24 22:00:00', 14, 11000),
(37, 'Targi Pracy IT', 'Spotkaj najlepszych pracodawców z branży technologicznej.', 'Biznes', '2026-03-20 09:00:00', 14, 8000),
(38, 'Mistrzostwa E-sportowe', 'Finały największego turnieju CS:GO i League of Legends.', 'Sport', '2026-02-15 10:00:00', 15, 11000),
(39, 'Festiwal Metalu', 'Ciężkie brzmienia w kultowym \"Spodku\".', 'Koncerty', '2026-04-18 18:00:00', 15, 10500),
(40, 'Stand-up bez cenzury', 'Najostrzejsze żarty bez trzymanki.', 'Stand-up', '2026-09-25 20:00:00', 15, 9000),
(41, 'Śląski Festiwal Nauki', 'Fascynujące pokazy i eksperymenty dla małych i dużych.', 'Rodzinne', '2026-11-10 09:00:00', 15, 10000),
(42, 'Noc Kabaretowa pod Gwiazdami', 'Śmiech do łez w unikalnej scenerii dawnego kamieniołomu.', 'Stand-up', '2026-07-11 20:00:00', 16, 5500),
(43, 'Koncert Symfoniczny: Queen', 'Utwory zespołu Queen w aranżacjach orkiestrowych.', 'Koncerty', '2026-08-08 19:30:00', 16, 5000),
(44, 'Zlot Motocyklowy - Koncert Finałowy', 'Wielka feta na zakończenie sezonu motocyklowego.', 'Koncerty', '2026-09-12 18:00:00', 16, 5500),
(45, 'Finał Ligi Siatkówki', 'Walka o medale przy pełnych trybunach.', 'Sport', '2026-05-18 18:00:00', 17, 2500),
(46, 'Koncert Szantowy', 'Morskie opowieści i wspólne śpiewanie na żywo.', 'Koncerty', '2026-07-25 19:00:00', 17, 2500),
(47, 'Wystawa Pająków i Gadów', 'Egzotyczne zwierzęta na wyciągnięcie ręki.', 'Rodzinne', '2026-10-10 10:00:00', 17, 2000),
(48, 'Mecz Ekstraklasy: Lech Poznań', 'Wielkie emocje na poznańskim stadionie.', 'Sport', '2026-04-05 17:30:00', 18, 42000),
(49, 'Światowa Trasa Koncertowa', 'Jeden z nielicznych koncertów globalnej gwiazdy w Polsce.', 'Koncerty', '2026-07-08 20:00:00', 18, 42800),
(50, 'Maraton Poznański - Meta', 'Wielki finał biegu ulicznego na stadionie.', 'Sport', '2026-10-18 12:00:00', 18, 15000),
(51, 'Koncert Wiedeński', 'Najpiękniejsze walce Johanna Straussa w wykonaniu orkiestry.', 'Koncerty', '2026-01-10 18:00:00', 19, 950),
(52, 'Wieczór Chopinowski', 'Recital fortepianowy z muzyką Fryderyka Chopina.', 'Koncerty', '2026-03-01 19:00:00', 19, 950),
(53, 'Stand-up Symfonicznie', 'Eksperymentalne połączenie komedii z muzyką poważną.', 'Stand-up', '2026-04-15 20:00:00', 19, 950);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

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

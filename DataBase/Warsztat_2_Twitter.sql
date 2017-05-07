-- phpMyAdmin SQL Dump
-- version 4.6.6deb1+deb.cihar.com~xenial.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Czas generowania: 07 Maj 2017, 18:02
-- Wersja serwera: 5.7.18-0ubuntu0.16.04.1
-- Wersja PHP: 7.0.15-0ubuntu0.16.04.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `Warsztat_2_Twitter`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `Comments`
--

CREATE TABLE `Comments` (
  `id` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `postId` int(11) NOT NULL,
  `creationDate` datetime NOT NULL,
  `text` varchar(255) CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Zrzut danych tabeli `Comments`
--

INSERT INTO `Comments` (`id`, `userId`, `postId`, `creationDate`, `text`) VALUES
(9, 15, 20, '2017-05-05 15:14:53', 'To jest fajny post'),
(10, 15, 19, '2017-05-05 15:15:18', 'A ten teÅ¼ nie jest taki zÅ‚y'),
(11, 14, 20, '2017-05-05 15:19:16', 'Wiem o tym'),
(12, 14, 22, '2017-05-05 15:19:36', 'No to siÄ™ nazywa post'),
(13, 14, 21, '2017-05-05 15:19:53', 'A widze pierwszy post TwÃ³j'),
(14, 19, 26, '2017-05-06 10:31:59', 'Chyba dawna'),
(15, 19, 19, '2017-05-06 10:35:02', 'MusÅ¼e to skomentowaÄ‡'),
(16, 14, 26, '2017-05-06 10:36:30', 'NiezÅ‚y post'),
(17, 14, 33, '2017-05-07 15:25:46', 'to jest komentarz'),
(18, 14, 33, '2017-05-07 15:41:19', 'Sed gravida erat tristique tristique interdum. Quisque non a'),
(19, 14, 33, '2017-05-07 15:52:30', 'Proin in lobortis lacus. Mauris porttitor ante eget iaculis '),
(20, 23, 35, '2017-05-07 17:11:57', 'it amet lectus sodales iaculis. In a sapien posuere, pharetr'),
(21, 23, 35, '2017-05-07 17:37:42', 'Suspendisse imperdiet sapien ut sem elementum condimentum. S');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `Messages`
--

CREATE TABLE `Messages` (
  `id` int(11) NOT NULL,
  `senderId` int(11) NOT NULL,
  `receiverId` int(11) NOT NULL,
  `text` varchar(255) CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL,
  `creationDate` datetime NOT NULL,
  `see` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Zrzut danych tabeli `Messages`
--

INSERT INTO `Messages` (`id`, `senderId`, `receiverId`, `text`, `creationDate`, `see`) VALUES
(9, 15, 14, 'Tomaszu to jest wiadomoÅ›Ä‡ dla Ciebie', '2017-05-05 15:16:20', 1),
(10, 14, 15, 'DziÄ™kujÄ™ za TwojÄ… wiadomoÅ›Ä‡ byÅ‚a fajna', '2017-05-05 15:18:56', 1),
(11, 19, 15, 'To jest wiadomosc od Oli', '2017-05-06 10:30:49', 1),
(12, 14, 19, 'To wiadomoÅ›Ä‡ od Tomasza', '2017-05-06 10:36:52', 1),
(13, 14, 19, 'To jeszcze jedna wiadomosc', '2017-05-06 10:46:15', 1),
(14, 21, 14, ':;\"\'', '2017-05-06 14:03:20', 1),
(15, 15, 14, 'testowa wiadomosc', '2017-05-06 14:43:19', 1),
(16, 14, 19, 'Kolejny post Tomasza', '2017-05-06 14:56:33', 1),
(17, 14, 19, 'asa', '2017-05-06 14:58:43', 1),
(18, 14, 19, 'wiadomosc', '2017-05-06 20:21:30', 1),
(19, 19, 14, 'Tomasz woadomosc', '2017-05-06 20:22:47', 1),
(20, 14, 19, 'Sed gravida erat tristique tristique interdum. Quisque non aliquam massa, et tristique turpis. Duis pellentesque ipsum eu nisi accumsan ull', '2017-05-07 16:00:22', 1),
(21, 23, 14, 'Suspendisse imperdiet sapien ut sem elementum condimentum. Suspendisse potenti. Integer tincidunt leo porttitor est viverra ultrices. Mauris ac erat blandit lorem molestie dapibus. Nullam imperdiet ante vitae velit finibus, eget tempor magna scelerisque. ', '2017-05-07 17:34:57', 1),
(22, 23, 19, 'Suspendisse imperdiet sapien ut sem elementum condimentum. Suspendisse potenti. Integer tincidunt leo porttitor est viverra ultrices. Mauris ac erat blandit lorem molestie dapibus. Nullam imperdiet ante vitae velit finibus, eget tempor magna scelerisque. ', '2017-05-07 17:36:44', 1),
(23, 23, 19, 'Suspendisse imperdiet sapien ut sem elementum condimentum. Suspendisse potenti. Integer tincidunt leo porttitor est viverra ultrices. Mauris ac erat blandit lorem molestie dapibus. Nullam imperdiet ante vitae velit finibus, eget tempor magna scelerisque. ', '2017-05-07 17:36:50', 1),
(24, 14, 23, 'Sed gravida erat tristique tristique interdum. Quisque non aliquam massa, et tristique turpis. Duis pellentesque ipsum eu nisi accumsan ullamcorper. In vulputate nulla vel convallis porttitor. Phasellus vulputate eros magna. Suspendisse a tortor leo. In u', '2017-05-07 17:40:39', 1);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `Tweets`
--

CREATE TABLE `Tweets` (
  `id` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `text` varchar(255) CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL,
  `creationDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Zrzut danych tabeli `Tweets`
--

INSERT INTO `Tweets` (`id`, `userId`, `text`, `creationDate`) VALUES
(19, 14, 'Post Tomasza pierwszy', '2017-05-05 15:04:27'),
(20, 14, 'Post Tomasza drugi', '2017-05-05 15:04:44'),
(21, 15, 'Post Ulenki pierwszy', '2017-05-05 15:14:18'),
(22, 15, 'Post Ulenki drugi', '2017-05-05 15:14:34'),
(25, 19, 'Post Olci pierwszy', '2017-05-06 10:06:27'),
(26, 19, 'Post Oli dana Olcia', '2017-05-06 10:30:27'),
(27, 14, 'Kolejny post Tomasza', '2017-05-06 10:51:27'),
(28, 21, 'Post testa', '2017-05-06 13:59:15'),
(29, 21, ':&quot;&gt;&lt;', '2017-05-06 14:02:24'),
(30, 14, 'post jeden', '2017-05-06 20:21:06'),
(32, 14, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut pellentesque nisl et arcu vulputate efficitur. Duis maximus elit nec diam pharet', '2017-05-07 14:57:11'),
(33, 14, 'Sed gravida erat tristique tristique interdum. Quisque non aliquam massa, et tristique turpis. Duis pellentesque ipsum eu nisi accumsan ulla', '2017-05-07 15:11:33'),
(35, 14, 'Suspendisse vitae faucibus sem. Nam pellentesque, diam ut semper pulvinar, urna urna posuere dolor, imperdiet bibendum metus erat non arcu. ', '2017-05-07 16:44:15'),
(36, 23, 'Suspendisse imperdiet sapien ut sem elementum condimentum. Suspendisse potenti. Integer tincidunt leo porttitor est viverra ultrices. Mauris', '2017-05-07 17:10:16'),
(37, 19, 'Suspendisse imperdiet sapien ut sem elementum condimentum. Suspendisse potenti. Integer tincidunt leo porttitor est viverra ultrices. Mauris', '2017-05-07 17:39:52');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `Users`
--

CREATE TABLE `Users` (
  `id` int(11) NOT NULL,
  `email` varchar(255) CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL,
  `username` varchar(255) CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL,
  `hashed_password` varchar(60) CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Zrzut danych tabeli `Users`
--

INSERT INTO `Users` (`id`, `email`, `username`, `hashed_password`) VALUES
(14, 'tomasz@tomasz.pl', 'Tomasz', '$2y$10$XHRiWKwRbZaPeNFflsZKzuy4KW4uTeSVG0Xp/19QRpfRpi9pu05Nm'),
(15, 'ulenka@ulenka.pl', 'Ulenka', '$2y$10$nEP8nat2ghVgyMzD2HxhauS8ExKhWwJORWXCW/ke8ODqzMR1gJ2Wy'),
(19, 'ola@ola.pl', 'Ola', '$2y$10$YbhBGa2KnBt9emSQZ7nQPuWm41MezHI8y3/DPo.FAcuaQKPrpBlkm'),
(21, 'test@test.pl', 'test', '$2y$10$X3e21rVqL0/phskbQEDm3eiASfU70wxeIj8aiOMYMQ7rLgdQumnL2'),
(22, 'ulenka@o2.pl', 'Ulcia', '$2y$10$4OPMtg0GNsCNuEvv97idTehNBqKPZhhDG7S5DyBCRhA2fdvByDCEW'),
(23, 'marian@marian.pl', 'Marian', '$2y$10$aSDcIi1iTXs.Jm8n/a7hwuAgfVKIUS7zyUFhYEoJmaNS6LAIFagmm');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indexes for table `Comments`
--
ALTER TABLE `Comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userId` (`userId`),
  ADD KEY `postId` (`postId`);

--
-- Indexes for table `Messages`
--
ALTER TABLE `Messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `senderId` (`senderId`),
  ADD KEY `reciverId` (`receiverId`);

--
-- Indexes for table `Tweets`
--
ALTER TABLE `Tweets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userId` (`userId`);

--
-- Indexes for table `Users`
--
ALTER TABLE `Users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `Comments`
--
ALTER TABLE `Comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT dla tabeli `Messages`
--
ALTER TABLE `Messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT dla tabeli `Tweets`
--
ALTER TABLE `Tweets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;
--
-- AUTO_INCREMENT dla tabeli `Users`
--
ALTER TABLE `Users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `Comments`
--
ALTER TABLE `Comments`
  ADD CONSTRAINT `Comments_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `Users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Comments_ibfk_2` FOREIGN KEY (`postId`) REFERENCES `Tweets` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ograniczenia dla tabeli `Messages`
--
ALTER TABLE `Messages`
  ADD CONSTRAINT `Messages_ibfk_1` FOREIGN KEY (`senderId`) REFERENCES `Users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Messages_ibfk_2` FOREIGN KEY (`receiverId`) REFERENCES `Users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ograniczenia dla tabeli `Tweets`
--
ALTER TABLE `Tweets`
  ADD CONSTRAINT `Tweets_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `Users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

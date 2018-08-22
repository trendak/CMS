-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 22 Sie 2018, 11:53
-- Wersja serwera: 10.1.29-MariaDB
-- Wersja PHP: 7.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `php_cms_001`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Zrzut danych tabeli `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(1, 'Koty'),
(2, 'Psy'),
(3, 'test23'),
(4, 'test'),
(6, 'Å›winie');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `text` text NOT NULL,
  `post_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Zrzut danych tabeli `comments`
--

INSERT INTO `comments` (`id`, `text`, `post_id`, `user_id`, `created_at`) VALUES
(1, 'Funy text, i am stupid but i love banana', 2, 3, '2018-08-07 00:00:00'),
(2, 'OO i\'m to stupid like you bro but i love oranges', 2, 3, '2018-08-07 03:00:00'),
(3, 'lubie was', 2, 1, '2018-08-08 00:00:00'),
(4, 'lubie was', 2, 2, '2018-08-08 00:00:00'),
(5, 'i love you', 2, 3, '2018-08-08 00:00:00'),
(6, 'i love you', 2, 1, '2018-08-08 00:00:00'),
(7, 'dupa', 2, 2, '2018-08-08 00:00:00'),
(8, 'majtki', 2, 0, '2018-08-08 00:00:00'),
(9, 'tylek', 2, 0, '2018-08-08 00:00:00'),
(10, 'plackki', 2, 0, '2018-08-08 00:00:00'),
(11, 'dfss', 2, 0, '2018-08-08 00:00:00'),
(12, 'asddsa', 2, 0, '2018-08-08 00:00:00'),
(13, 'dsfs', 2, 2, '2018-08-08 00:00:00');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `pages`
--

CREATE TABLE `pages` (
  `id` int(11) NOT NULL,
  `title` varchar(191) NOT NULL,
  `body` text NOT NULL,
  `published` tinyint(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `meta_description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Zrzut danych tabeli `pages`
--

INSERT INTO `pages` (`id`, `title`, `body`, `published`, `created_at`, `meta_description`) VALUES
(1, 'Kontakt', '0700880 zadzwo? teraz', 0, '2018-07-18 14:14:35', 'gor?ca linia'),
(2, 'dgfz', '<p>gzf</p>\r\n', 0, '2018-07-23 12:47:46', 'zg'),
(3, 'dgfz', '<p>gzf</p>\r\n', 0, '2018-07-23 12:48:06', 'zg'),
(7, 'About', '<p>I am sexy duck</p>\r\n', 1, '2018-08-01 09:05:22', 'test'),
(8, 'About', '<p>I am sexy duck</p>\r\n', 1, '2018-08-01 09:05:26', 'test');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `title` varchar(255) CHARACTER SET cp1250 COLLATE cp1250_polish_ci NOT NULL,
  `body` text CHARACTER SET cp1250 COLLATE cp1250_polish_ci NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `published` tinyint(1) NOT NULL,
  `category_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `meta_description` varchar(255) CHARACTER SET cp1250 COLLATE cp1250_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Zrzut danych tabeli `posts`
--

INSERT INTO `posts` (`id`, `title`, `body`, `created_date`, `published`, `category_id`, `user_id`, `meta_description`) VALUES
(2, 'sda', 'test', '2018-07-27 13:34:38', 1, 1, 1, '#koty #coś #pornodrzewa'),
(3, 'zcx', '<p>zxc</p>\r\n', '2018-07-27 13:34:47', 0, 1, 1, ''),
(4, 'sdf', '<p>sdf</p>\r\n', '2018-07-27 14:21:21', 1, 1, 1, ''),
(5, 'dfs', '<p>sdf</p>\r\n', '2018-07-27 14:21:25', 1, 3, 1, ''),
(35, 'sdf', '<p>sdf</p>\r\n', '2018-07-27 14:21:29', 0, 1, 1, 'sdfsdf'),
(36, 'sdf', '<p>sdfsdf</p>\r\n', '2018-07-27 14:21:33', 0, 4, 1, 'sdfsdf'),
(37, 'dgfz', '<p>gzf</p>\r\n', '2018-07-27 14:21:37', 0, 1, 1, 'zg'),
(38, 'dgfz', '<p>gzf</p>\r\n', '2018-07-27 14:21:41', 0, 1, 1, 'zg'),
(39, 'test', '<p>test</p>\r\n', '2018-07-27 14:21:45', 0, 1, 1, 'test'),
(40, 'test', '<p>testasd</p>\r\n', '2018-07-27 14:21:48', 0, 1, 1, 'dads');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `login` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `admin` tinyint(1) NOT NULL,
  `password` varchar(191) NOT NULL,
  `photo` varchar(30) NOT NULL,
  `last_login_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `last_ip` varchar(191) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Zrzut danych tabeli `users`
--

INSERT INTO `users` (`id`, `login`, `email`, `admin`, `password`, `photo`, `last_login_date`, `last_ip`) VALUES
(1, 'admin', 'rydzyk@trwap.pl', 1, '8a3d372b54e12e3f580e0d1027cfa0877e2e0c0049cd425ab72e1e16c9db383a', '', '2018-08-22 09:52:50', '::1'),
(2, 'piotrek', '', 0, '8a3d372b54e12e3f580e0d1027cfa0877e2e0c0049cd425ab72e1e16c9db383a', '5b7d232295b678.31927633.jpg', '2018-08-21 22:00:00', '::1'),
(3, 'piotrk', 'piotrek@wp.pl', 0, '8a3d372b54e12e3f580e0d1027cfa0877e2e0c0049cd425ab72e1e16c9db383a', '', '2018-08-05 22:00:00', '::1'),
(4, 'kuba', 'kuba@wp.pl', 1, '8a3d372b54e12e3f580e0d1027cfa0877e2e0c0049cd425ab72e1e16c9db383a', '', '2018-08-07 22:00:00', '::1');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT dla tabeli `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT dla tabeli `pages`
--
ALTER TABLE `pages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT dla tabeli `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT dla tabeli `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

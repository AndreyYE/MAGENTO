-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Мар 19 2020 г., 22:00
-- Версия сервера: 10.4.10-MariaDB
-- Версия PHP: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `dnipro`
--

-- --------------------------------------------------------

--
-- Структура таблицы `contacts`
--

CREATE TABLE `contacts` (
  `id` int(6) UNSIGNED NOT NULL,
  `phone` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(150) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `contacts`
--

INSERT INTO `contacts` (`id`, `phone`, `name`) VALUES
(1, '1234', 'aaa'),
(2, '123456', 'sss'),
(3, '12345', 'qqq'),
(4, '12345678', 'www'),
(5, '1214214', 'eee'),
(6, '12412323', 'rrrr'),
(7, '124124124', 'ttt'),
(8, '34534534', 'yyyy'),
(9, '341234124', 'uuu'),
(10, '45645645', 'iii'),
(11, '45634643', 'ooo'),
(12, '3434234', 'ppp'),
(13, '523535', 'aaa'),
(14, '45235235', 'sss'),
(15, '52352353', 'fff'),
(16, '234234432', 'ddd');

-- --------------------------------------------------------

--
-- Структура таблицы `contact_user`
--

CREATE TABLE `contact_user` (
  `user_id` int(6) UNSIGNED NOT NULL,
  `contact_id` int(6) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `contact_user`
--

INSERT INTO `contact_user` (`user_id`, `contact_id`) VALUES
(19, 1),
(19, 2),
(20, 1),
(20, 2),
(21, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(6) UNSIGNED NOT NULL,
  `email` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `login` varchar(150) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `login`) VALUES
(3, 'test@gmail.com', '11111111', 'asds'),
(4, 'test1@gmail.com', '$2y$10$4nSJwoWIizlEUwBsP96yN.MWNqQ0hs0Ruop8dl5gBgSjYwfDXaH2G', 'new'),
(5, 'test2@gmail.com', '$2y$10$fnzxS3JkbZtImnFHe4Q1PePy4CQEyIncmHF//LXWRtWQY6ZFEM8EG', 'maclaren'),
(6, 'test3@gmail.com', '$2y$10$t0nMh3syGSEjhQisDZZo9.bfUHVE/EKkK320C8IE4CtZAehyQ3f5O', 'maclaren1'),
(7, 'test4@gmail.com', '$2y$10$cPbD70yBYEeBM/yj/tGc8uWq1bzf5NK25XmxaNOVoT1QT8T3hgilC', 'maclaren2'),
(8, 'test5@gmail.com', '$2y$10$FlRFfNMB0lzq.rlL45ECueXmLIBeD2K/Drb0QoK1WFEt0/XjueXlC', 'maclaren3'),
(9, 'test6@gmail.com', '$2y$10$fExA4Uuca9p09B7s9txRn.CZb2M4jTV/rdsN/24YzKFZDS2SlfIU2', 'maclaren5'),
(10, 'test7@gmail.com', '$2y$10$sZmJ/22HktOAeniR/mCmB.Yj/.8VRtu23Zm/ILQYSJb7GxWTANfhq', 'maclaren6'),
(11, 'test9@gmail.com', '$2y$10$jNGnpcpPDhwPAkbA6WRFxO3k/1VZAUKP82CkJqR50A98wQZaFTMWq', 'maclaren123'),
(12, 'test10@gmail.com', '$2y$10$RY7HqZMSR3uFFskgJb5Zsu7uv9pvKf6vMbYG0cmwDVLLRMJpn3FKW', 'maclaren444'),
(13, 'test12@gmail.com', '$2y$10$rUD9YdUDfGvkmQ3mqVBtUea0mKATJVW2bfUkz2F1cX0dm6VKf1xMa', 'maclaren123456'),
(14, 'test12345@gmail.com', '$2y$10$8WZ1lQb3bmC2rGg6PcU0Q.kfHrXSzAPUsFFhMcHcl0I20TTPa.YZW', 'maclaren123456'),
(15, 'tesst@gmail.com', '$2y$10$2gn5v0WFFibQqO8MvHelBOKWQ9EOctrP6l9hdUUvfR.m2bLnUR20y', 'maclaren'),
(16, 'tessst@gmail.com', '$2y$10$P2HkjmhyknIcNeD3p.EP0.2gcO1MX2eDNEvwIZ5mMwAHgoMqhQ7X6', 'maclaren'),
(17, 'tesssst@gmail.com', '$2y$10$sVlNFW.G9cFnAk9Y56rFmObGvWuoI7SF2W.n2b1/K0h/8CMErfcc.', 'maclaren'),
(18, 'tesssdddst@gmail.com', '$2y$10$ItnNSIirub2pauJXhy7wquKE9jI96vr9MflMs1a/O6mkcImQfiJOG', 'maclaren'),
(19, 'andreidan1986@gmail.com', '$2y$10$aZKmMJumkHFZm6/4oBqugOMNpqTJjVGB7B.RnwtTvzZjKcL84DGne', 'maclaren'),
(20, 'aaa@gmail.com', '$2y$10$JHDq0ovW57TqulwkeQNVNu/UdQ.Sv6u2fWvO6VVrGUUhWO.Qc1dT.', 'aaa'),
(21, 'sss@gmail.com', '$2y$10$T9TGFAhe91lkyNrrClfp8.6jgRxQa0Ez0SytHpy/OG4c3x/DEoX9e', 'sss');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `contact_user`
--
ALTER TABLE `contact_user`
  ADD PRIMARY KEY (`user_id`,`contact_id`),
  ADD KEY `FK_contact` (`contact_id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_email` (`email`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `contact_user`
--
ALTER TABLE `contact_user`
  ADD CONSTRAINT `FK__user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `FK_contact` FOREIGN KEY (`contact_id`) REFERENCES `contacts` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

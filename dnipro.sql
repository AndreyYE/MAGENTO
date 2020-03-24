-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Мар 24 2020 г., 10:17
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
-- Структура таблицы `permissions`
--

CREATE TABLE `permissions` (
  `id` int(6) UNSIGNED NOT NULL,
  `name` varchar(150) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `permissions`
--

INSERT INTO `permissions` (`id`, `name`) VALUES
(1, 'distribute'),
(3, 'done'),
(2, 'upload'),
(4, 'view');

-- --------------------------------------------------------

--
-- Структура таблицы `roles`
--

CREATE TABLE `roles` (
  `id` int(6) UNSIGNED NOT NULL,
  `name` varchar(150) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `roles`
--

INSERT INTO `roles` (`id`, `name`) VALUES
(3, 'Children'),
(2, 'Father'),
(1, 'Mother');

-- --------------------------------------------------------

--
-- Структура таблицы `role_permission`
--

CREATE TABLE `role_permission` (
  `role_id` int(6) UNSIGNED NOT NULL,
  `permission_id` int(6) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `role_permission`
--

INSERT INTO `role_permission` (`role_id`, `permission_id`) VALUES
(1, 2),
(1, 3),
(1, 4),
(2, 1),
(2, 3),
(2, 4),
(3, 3),
(3, 4);

-- --------------------------------------------------------

--
-- Структура таблицы `tasks`
--

CREATE TABLE `tasks` (
  `id` int(6) UNSIGNED NOT NULL,
  `mother_id` int(6) UNSIGNED NOT NULL,
  `father_id` int(6) UNSIGNED DEFAULT NULL,
  `child_id` int(6) UNSIGNED DEFAULT NULL,
  `title` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `status` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `file` char(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `tasks`
--

INSERT INTO `tasks` (`id`, `mother_id`, `father_id`, `child_id`, `title`, `status`, `file`) VALUES
(1, 1, 2, 3, 'one task', 'done', 'upload/0ed34bbe95bd2a9af64358bb13b92407.docx'),
(2, 1, 2, 4, 'task two', 'done', 'upload/0ed34bbe95bd2a9af64358bb13b92407.docx'),
(3, 1, 2, 5, 'task three', NULL, 'upload/0ed34bbe95bd2a9af64358bb13b92407.docx'),
(4, 1, 2, 3, 'task four', NULL, 'upload/0ed34bbe95bd2a9af64358bb13b92407.docx'),
(5, 1, 2, 4, 'task \r\nfive', 'done', 'upload/0ed34bbe95bd2a9af64358bb13b92407.docx'),
(6, 1, 2, 5, 'task \r\nsix', NULL, 'upload/0ed34bbe95bd2a9af64358bb13b92407.docx'),
(7, 1, NULL, NULL, 'task \r\nseven', NULL, 'upload/0ed34bbe95bd2a9af64358bb13b92407.docx'),
(8, 1, NULL, NULL, 'task\r\neight', NULL, 'upload/0ed34bbe95bd2a9af64358bb13b92407.docx'),
(9, 1, NULL, NULL, 'task\r\nnine', NULL, 'upload/0ed34bbe95bd2a9af64358bb13b92407.docx'),
(10, 1, NULL, NULL, 'task\r\nten', NULL, 'upload/0ed34bbe95bd2a9af64358bb13b92407.docx'),
(11, 1, NULL, NULL, 'task eleven', NULL, 'upload/0ed34bbe95bd2a9af64358bb13b92407.docx'),
(12, 1, NULL, NULL, ' task twelve', NULL, 'upload/bf67e1e199d14767aec776a298d35353.docx');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(6) UNSIGNED NOT NULL,
  `password` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `role_id` int(6) UNSIGNED DEFAULT NULL,
  `name` varchar(150) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `password`, `role_id`, `name`) VALUES
(1, '$2y$10$QTD.A9gr6pYi4rwSgdEGU.DvIZEGMW7xlGAwamg.LM6bJya4iN8ny', 1, 'aaa'),
(2, '$2y$10$gPRfhHN2CN6vsAkTDjWXK.vU/kYAQGDmFF8tt8hOWqF83IevBDiUe', 2, 'sss'),
(3, '$2y$10$iEd9RNWu1FzepW4bwy/p6ebAcNTzGtUM/dmXISV.cJxNAfHvF9n4K', 3, 'ddd'),
(4, '$2y$10$Sw4n4LH2Cv6q8AFKwEV4muI9KgYYCgY9nZYdm8nJE4p4ttfK4TKhq', 3, 'fff'),
(5, '$2y$10$GvH8g8HL6nBD2.FBWMFCA.XZ.r9ulUYEuxst13xOI3O4VFKCKqaNu', 3, 'ggg'),
(6, '$2y$10$29orhCqwC8lK494n8byam.83BtB73sQ22Ibqj4SQ/s5S8FY1L0E1W', 3, 'zzz');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_name` (`name`);

--
-- Индексы таблицы `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_name` (`name`);

--
-- Индексы таблицы `role_permission`
--
ALTER TABLE `role_permission`
  ADD PRIMARY KEY (`role_id`,`permission_id`),
  ADD KEY `FK_permission` (`permission_id`);

--
-- Индексы таблицы `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK__mother` (`mother_id`),
  ADD KEY `FK_father` (`father_id`),
  ADD KEY `FK_child` (`child_id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_name` (`name`),
  ADD KEY `FK__role_id` (`role_id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `role_permission`
--
ALTER TABLE `role_permission`
  ADD CONSTRAINT `FK__role` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_permission` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Ограничения внешнего ключа таблицы `tasks`
--
ALTER TABLE `tasks`
  ADD CONSTRAINT `FK__mother` FOREIGN KEY (`mother_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_child` FOREIGN KEY (`child_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `FK_father` FOREIGN KEY (`father_id`) REFERENCES `users` (`id`);

--
-- Ограничения внешнего ключа таблицы `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `FK__role_id` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

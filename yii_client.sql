-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Июл 09 2017 г., 08:22
-- Версия сервера: 5.7.14
-- Версия PHP: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `yii_client`
--

-- --------------------------------------------------------

--
-- Структура таблицы `client`
--

CREATE TABLE `client` (
  `id` int(10) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `middlename` varchar(255) NOT NULL,
  `birthday` date NOT NULL,
  `sex` set('male','female') NOT NULL DEFAULT 'male',
  `added` datetime NOT NULL,
  `updated` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `client`
--

INSERT INTO `client` (`id`, `lastname`, `name`, `middlename`, `birthday`, `sex`, `added`, `updated`) VALUES
(12, 'Жученко', 'Николай', 'Анатольевич', '1984-06-18', 'male', '2017-07-09 07:58:17', '2017-07-09 12:14:56'),
(13, 'Иванов', 'Иван', 'Иванович', '2000-01-01', 'male', '2017-07-09 07:58:55', '2017-07-09 07:58:55'),
(7, 'Петров', 'Петр', 'Петрович', '1900-01-02', 'male', '2017-07-08 17:20:14', '2017-07-09 07:53:53');

-- --------------------------------------------------------

--
-- Структура таблицы `client_phone`
--

CREATE TABLE `client_phone` (
  `id` int(10) NOT NULL,
  `client_id` int(10) NOT NULL,
  `phone` varchar(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `client_phone`
--

INSERT INTO `client_phone` (`id`, `client_id`, `phone`) VALUES
(1, 7, '77777777777'),
(2, 7, '11111111111'),
(4, 7, '22222222222'),
(18, 13, '66666666666'),
(17, 12, '89620000000');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `client_phone`
--
ALTER TABLE `client_phone`
  ADD PRIMARY KEY (`id`),
  ADD KEY `client_id` (`client_id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `client`
--
ALTER TABLE `client`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT для таблицы `client_phone`
--
ALTER TABLE `client_phone`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Хост: localhost
-- Время создания: Май 04 2020 г., 00:50
-- Версия сервера: 10.4.11-MariaDB
-- Версия PHP: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `chat`
--

-- --------------------------------------------------------

--
-- Структура таблицы `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `message_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `message` varchar(255) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `messages`
--

INSERT INTO `messages` (`id`, `id_user`, `message_date`, `message`) VALUES
(1, 2, '2020-05-01 20:40:13', 'hello'),
(2, 1, '2020-05-01 20:43:17', 'how are you'),
(3, 1, '2020-05-01 21:01:04', 'acasdasd'),
(4, 1, '2020-05-02 11:03:21', 'asdadasd'),
(5, 1, '2020-05-02 11:03:24', 'dcfsd,.fsd,'),
(6, 1, '2020-05-03 18:20:31', 'yyyyyy'),
(7, 1, '2020-05-03 18:39:50', 'ahjfhasd;lf'),
(8, 3, '2020-05-03 19:05:50', 'how are you'),
(9, 3, '2020-05-03 19:07:02', 'i am fine'),
(10, 1, '2020-05-03 19:07:29', 'dafasdfasdf'),
(11, 1, '2020-05-03 19:07:35', ':)\n'),
(12, 4, '2020-05-03 19:08:12', 'hello my freinds'),
(13, 1, '2020-05-03 19:08:24', '\nhello my freind'),
(14, 1, '2020-05-03 19:08:30', '\nsdds'),
(15, 4, '2020-05-03 19:08:43', '\ndjafsld;fjas'),
(16, 3, '2020-05-03 19:14:11', 'asdjflasd;jf'),
(17, 3, '2020-05-03 19:14:12', '\nv e rvle'),
(18, 3, '2020-05-03 19:14:57', ':(\n'),
(19, 5, '2020-05-03 19:26:02', 'hello my brothers'),
(20, 1, '2020-05-03 21:23:42', ''),
(21, 1, '2020-05-03 21:24:14', '\nalsdal'),
(22, 1, '2020-05-03 21:24:26', 'alsdmk;asd\';'),
(23, 1, '2020-05-03 21:24:29', '\nfjnasdjfnwe fpjiwcmwe f'),
(24, 1, '2020-05-03 21:24:32', '\nvnwremn jenverjkln ;orn;ojnre;ovn;rion voern vonrov'),
(25, 9, '2020-05-03 21:25:44', ':)'),
(26, 9, '2020-05-03 21:25:51', '\n:(');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `user_name` varchar(25) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `user_name`, `password`) VALUES
(1, 'yuriy', '$2y$10$lA9RjkX10RvHROg.HMDlB.bIdTocqwUQXkipJCUEGoZJVoQM7tWDe'),
(2, 'yuliya', '$2y$10$/N8HpEqo7u6csS/3iTB6VOVRS2/ECX73nN4I8MxvkCNW7TtuHfD2K'),
(3, 'tolya', '$2y$10$vDOEcpEJqYlbkKq3QLbm3u/fA4qqka1khBVVr/5Bt0/s2oNM/szV.'),
(4, 'misteryuki', '$2y$10$HyzSjVB1UVs8vLVZB5JFE.DBX8B5n6UMdYYl0UP6v8gEp1PFOW5HG'),
(5, 'terra', '$2y$10$jp4jtZK3mZU6IFqiimntrug8VOqq3E3iiTG.eg.oBeGKPfvhx5tt2'),
(6, '', '$2y$10$enJQJXpt7ThId7F2nx/sd.7GNiW4IUgzGF/0o3OyXgIgg6yQGXO4e'),
(7, '', '$2y$10$HOhz9EYuG5JCzOoXGGXBP.sRUw680f/Yrc1dQpfPUxUldAG/IdoLK'),
(8, '', '$2y$10$n66w.CH9bpV7clWxy/Sgx.QMQOlIcQnnK4C9vq5nDStI.ztG/cDM.'),
(9, 'petya', '$2y$10$03.M4QUFwO6gTkrsfVoVGuX21tjjopTiU/zfX8u8zvo0U3K5dkE0i');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

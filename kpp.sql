-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1
-- Время создания: Май 24 2016 г., 01:36
-- Версия сервера: 5.6.17
-- Версия PHP: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `kpp`
--

-- --------------------------------------------------------

--
-- Структура таблицы `dolzhnost`
--

CREATE TABLE IF NOT EXISTS `dolzhnost` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `dolzhnost` varchar(60) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- Дамп данных таблицы `dolzhnost`
--

INSERT INTO `dolzhnost` (`id`, `dolzhnost`) VALUES
(1, 'Генеральный директор'),
(2, 'Главный программист'),
(3, 'Системный аналитик'),
(4, 'Системный администртор'),
(5, 'Менеджер сети'),
(6, 'Sales-менеджер'),
(7, 'Программист'),
(8, 'Разработчик БД'),
(9, 'Администртор БД'),
(10, 'Директор по персоналу');

-- --------------------------------------------------------

--
-- Структура таблицы `dveri`
--

CREATE TABLE IF NOT EXISTS `dveri` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `dveri` varchar(70) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=14 ;

--
-- Дамп данных таблицы `dveri`
--

INSERT INTO `dveri` (`id`, `dveri`) VALUES
(1, 'Вход'),
(2, 'Кухня'),
(3, 'Уборная 1'),
(4, 'Отдел администрирования'),
(5, 'Кабинет руководства'),
(6, 'Отдел продаж'),
(7, 'Черный выход'),
(8, 'Юридический отдел'),
(9, 'Отдел финансов и бухгалтерии'),
(10, 'Отдел IT');

-- --------------------------------------------------------

--
-- Структура таблицы `otdel`
--

CREATE TABLE IF NOT EXISTS `otdel` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `otdel` varchar(70) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_2` (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

--
-- Дамп данных таблицы `otdel`
--

INSERT INTO `otdel` (`id`, `otdel`) VALUES
(1, 'Руководство'),
(2, 'Отдел продаж'),
(3, 'Отдел разработок'),
(4, 'Отдел маркетинга'),
(5, 'Отдел IT'),
(6, 'Финансы и бухгалтерия'),
(7, 'Юридический отдел'),
(8, 'Управление персоналом'),
(9, 'Отдел администрирования');

-- --------------------------------------------------------

--
-- Структура таблицы `otkritie`
--

CREATE TABLE IF NOT EXISTS `otkritie` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_dveri` int(11) NOT NULL,
  `id_karti` int(11) NOT NULL,
  `data_vhod` datetime NOT NULL,
  `data_vihod` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_dveri` (`id_dveri`),
  KEY `id_karti` (`id_karti`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Дамп данных таблицы `otkritie`
--

INSERT INTO `otkritie` (`id`, `id_dveri`, `id_karti`, `data_vhod`, `data_vihod`) VALUES
(1, 1, 111111, '2016-05-10 06:36:08', '2016-05-10 18:27:06'),
(2, 3, 142536, '2016-05-01 07:07:29', '2016-05-01 12:46:16'),
(3, 5, 264829, '2016-05-11 09:24:08', '2016-05-11 11:13:00'),
(4, 6, 381748, '2016-05-24 14:17:14', '2016-05-24 17:17:11');

-- --------------------------------------------------------

--
-- Структура таблицы `sotrudnik`
--

CREATE TABLE IF NOT EXISTS `sotrudnik` (
  `id` int(20) NOT NULL,
  `familia` varchar(50) NOT NULL,
  `imya` varchar(50) NOT NULL,
  `otchestvo` varchar(50) NOT NULL,
  `id_otdela` int(11) NOT NULL,
  `id_dolzhnosti` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_otdela` (`id_otdela`),
  KEY `id_dolzhnosti` (`id_dolzhnosti`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `sotrudnik`
--

INSERT INTO `sotrudnik` (`id`, `familia`, `imya`, `otchestvo`, `id_otdela`, `id_dolzhnosti`) VALUES
(111111, 'Нехаева', 'Ксения', 'Владимировна', 1, 1),
(142536, 'Чернецкая', 'Анна', 'Сергеевна', 2, 6),
(164528, 'Нехаева', 'Кира', 'Владимировна', 2, 10),
(264829, 'Калиниченко', 'Анна', 'Сергеевна', 4, 5),
(381748, 'Щербак', 'Богдан', 'Юрьевич', 7, 3),
(426432, 'Животова', 'Кристина', 'Дмитриевна', 3, 2);

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `otkritie`
--
ALTER TABLE `otkritie`
  ADD CONSTRAINT `otkritie_ibfk_1` FOREIGN KEY (`id_dveri`) REFERENCES `dveri` (`id`),
  ADD CONSTRAINT `otkritie_ibfk_2` FOREIGN KEY (`id_karti`) REFERENCES `sotrudnik` (`id`);

--
-- Ограничения внешнего ключа таблицы `sotrudnik`
--
ALTER TABLE `sotrudnik`
  ADD CONSTRAINT `sotrudnik_ibfk_1` FOREIGN KEY (`id_otdela`) REFERENCES `otdel` (`id`),
  ADD CONSTRAINT `sotrudnik_ibfk_2` FOREIGN KEY (`id_dolzhnosti`) REFERENCES `dolzhnost` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

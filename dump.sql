-- Версия сервера: 5.7.27-0ubuntu0.18.04.1
-- Версия PHP: 7.2.19-0ubuntu0.18.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";

--
-- База данных: `api`
--
CREATE DATABASE IF NOT EXISTS `api` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `api`;

-- --------------------------------------------------------

--
-- Структура таблицы `val`
--

CREATE TABLE IF NOT EXISTS `val` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `value` varchar(45) CHARACTER SET utf8 NOT NULL,
  `type` varchar(45) CHARACTER SET utf8 NOT NULL,
  `length` int(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

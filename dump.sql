SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

CREATE TABLE `rg_users_online` (
  `ssid` varchar(255) NOT NULL,
  `page` varchar(255) DEFAULT NULL,
  `useragent` varchar(255) DEFAULT NULL,
  `last_active` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

ALTER TABLE `rg_users_online`
  ADD PRIMARY KEY (`ssid`);
COMMIT;
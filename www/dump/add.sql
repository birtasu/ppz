-- Dumping database structure for Preproduction
CREATE DATABASE IF NOT EXISTS `Preproduction` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;
USE `Preproduction`;

-- Dumping structure for таблиця Preproduction.PPZ
CREATE TABLE IF NOT EXISTS `PPZ` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tema` mediumtext,
  `instrument` tinytext,
  `pidviddil` int(11) DEFAULT NULL,
  `zmina` varchar(5) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `my_id` varchar(50) DEFAULT NULL,
  `tab` varchar(50) DEFAULT NULL,
  `tab_2` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7626 DEFAULT CHARSET=utf8mb4 ROW_FORMAT=COMPRESSED;

INSERT INTO `PPZ` (`id`, `tema`, `instrument`, `pidviddil`, `zmina`, `date`, `my_id`, `tab`, `tab_2`) VALUES
	(108, 'Передано', 'Шуруповерт Bosch', 2, 'A', '2017-07-20', '2007171508', '6428', '2587'),
	(109, 'Передано', 'Мобільний телефон', 2, 'A', '2017-07-20', '2007171508', '6428', '2587'),
	(110, 'Передано', 'Паяльник', 2, 'A', '2017-07-20', '2007171508', '6428', '2587'),
	(122, 'передано', 'Шуруповерт Bosch', 2, 'B', '2017-07-20', '200717223323', '2587', '4921'),
	(123, 'передано', 'Мобільний телефон', 2, 'B', '2017-07-20', '200717223323', '2587', '4921'),
	(124, 'передано', 'Паяльник', 2, 'B', '2017-07-20', '200717223323', '2587', '4921'),
	(129, 'Передано', 'Шуруповерт Bosch', 2, 'C', '2017-07-21', '210717005515', '4921', '6428'),
	(130, 'Передано', 'Мобільний телефон', 2, 'C', '2017-07-21', '210717005515', '4921', '6428'),
	(131, 'Передано', 'Паяльник', 2, 'C', '2017-07-21', '210717005515', '4921', '6428'),
	(132, 'передано', 'Шуруповерт Bosch', 2, 'A', '2017-07-21', '210717133740', '6428', '2587'),
	(133, 'передано', 'Мобільний телефон', 2, 'A', '2017-07-21', '210717133740', '6428', '2587'),
	(134, 'передано', 'Паяльник', 2, 'A', '2017-07-21', '210717133740', '6428', '2587'),
	(7625, 'передав', 'Печатка', 2, 'B', '2018-04-02', '020418062616', '2657', NULL);

-- Dumping structure for таблиця Preproduction.PPZ_users
CREATE TABLE IF NOT EXISTS `PPZ_users` (
  `users_id` int(11) NOT NULL AUTO_INCREMENT,
  `users_login` varchar(30) NOT NULL DEFAULT '0',
  `users_password` varchar(32) NOT NULL DEFAULT '0',
  `pidviddil` int(11) NOT NULL DEFAULT '0',
  `admin` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`users_id`)
) ENGINE=InnoDB AUTO_INCREMENT=78 DEFAULT CHARSET=utf8mb4 ROW_FORMAT=COMPRESSED;

INSERT INTO `PPZ_users` (`users_id`, `users_login`, `users_password`, `pidviddil`, `admin`) VALUES
	(1, '111', '111', 0, 1),
	(2, '222', '222', 2, 0);
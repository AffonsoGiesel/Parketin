/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


DROP DATABASE IF EXISTS `parketin`;
CREATE DATABASE IF NOT EXISTS `parketin` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `parketin`;

DROP TABLE IF EXISTS `client`;
CREATE TABLE IF NOT EXISTS `client` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(150) NOT NULL,
  `cpf` varchar(15) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `parkinglot`;
CREATE TABLE IF NOT EXISTS `parkinglot` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `location` varchar(250) NOT NULL,
  `name` varchar(100) NOT NULL,
  `spaces` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `employee`;
CREATE TABLE IF NOT EXISTS `employee` (
  `cpf` varchar(15) NOT NULL,
  `name` varchar(150) NOT NULL,
  `rg` int(11) DEFAULT NULL,
  `age` int(11) DEFAULT NULL,
  `parkinglot` int(11) NOT NULL,
  PRIMARY KEY (`cpf`),
  KEY `FK_employee_parkinglot` (`parkinglot`),
  CONSTRAINT `FK_employee_parkinglot` FOREIGN KEY (`parkinglot`) REFERENCES `parkinglot` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `login`;
CREATE TABLE IF NOT EXISTS `login` (
  `email` varchar(100) NOT NULL,
  `password` varchar(50) NOT NULL,
  `access_level` int(11) NOT NULL,
  `session` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `pl_usage`;
CREATE TABLE IF NOT EXISTS `pl_usage` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `entry_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `exit_date` timestamp NULL DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `vehicle` int(11) DEFAULT NULL,
  `employee` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_pl_usage_vehicle` (`vehicle`),
  KEY `FK_pl_usage_employee` (`employee`),
  CONSTRAINT `FK_pl_usage_employee` FOREIGN KEY (`employee`) REFERENCES `employee` (`cpf`),
  CONSTRAINT `FK_pl_usage_vehicle` FOREIGN KEY (`vehicle`) REFERENCES `vehicle` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `vehicle`;
CREATE TABLE IF NOT EXISTS `vehicle` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `plate` varchar(50) NOT NULL,
  `owner` int(11) NOT NULL,
  `color` varchar(50) DEFAULT NULL,
  `type` varchar(50) DEFAULT NULL,
  `manufacture` varchar(50) DEFAULT NULL,
  `model` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_vehicle_client` (`owner`),
  CONSTRAINT `FK_vehicle_client` FOREIGN KEY (`owner`) REFERENCES `client` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Administrator credentials

INSERT INTO login (`email`, `password`, `access_level`) VALUES ('admin@parketin.com', 'd033e22ae348aeb5660fc2140aec35850c4da997', 0);

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;

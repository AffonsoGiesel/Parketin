-- --------------------------------------------------------
-- Servidor:                     127.0.0.1
-- Versão do servidor:           10.1.40-MariaDB - mariadb.org binary distribution
-- OS do Servidor:               Win64
-- HeidiSQL Versão:              10.1.0.5464
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Copiando estrutura do banco de dados para parketin
DROP DATABASE IF EXISTS `parketin`;
CREATE DATABASE IF NOT EXISTS `parketin` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `parketin`;

-- Copiando estrutura para tabela parketin.cliente
DROP TABLE IF EXISTS `cliente`;
CREATE TABLE IF NOT EXISTS `cliente` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(150) NOT NULL,
  `cpf` varchar(15) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Exportação de dados foi desmarcado.
-- Copiando estrutura para tabela parketin.estacionamento
DROP TABLE IF EXISTS `estacionamento`;
CREATE TABLE IF NOT EXISTS `estacionamento` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `local` varchar(250) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `vagas` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Exportação de dados foi desmarcado.
-- Copiando estrutura para tabela parketin.funcionario
DROP TABLE IF EXISTS `funcionario`;
CREATE TABLE IF NOT EXISTS `funcionario` (
  `cpf` varchar(15) NOT NULL,
  `nome` varchar(150) NOT NULL,
  `rg` int(11) DEFAULT NULL,
  `idade` int(11) DEFAULT NULL,
  `estacionamento` int(11) NOT NULL,
  PRIMARY KEY (`cpf`),
  KEY `FK_funcionario_estacionamento` (`estacionamento`),
  CONSTRAINT `FK_funcionario_estacionamento` FOREIGN KEY (`estacionamento`) REFERENCES `estacionamento` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Exportação de dados foi desmarcado.
-- Copiando estrutura para tabela parketin.login
DROP TABLE IF EXISTS `login`;
CREATE TABLE IF NOT EXISTS `login` (
  `email` varchar(100) NOT NULL,
  `senha` varchar(50) NOT NULL,
  `nivel` int(11) NOT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Exportação de dados foi desmarcado.
-- Copiando estrutura para tabela parketin.uso_do_estacionamento
DROP TABLE IF EXISTS `uso_do_estacionamento`;
CREATE TABLE IF NOT EXISTS `uso_do_estacionamento` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `dataEntrada` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `dataSaida` timestamp NULL DEFAULT NULL,
  `valorPagamento` int(11) DEFAULT NULL,
  `veiculo` int(11) DEFAULT NULL,
  `funcionario` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_uso_do_estacionamento_veiculo` (`veiculo`),
  KEY `FK_uso_do_estacionamento_funcionario` (`funcionario`),
  CONSTRAINT `FK_uso_do_estacionamento_funcionario` FOREIGN KEY (`funcionario`) REFERENCES `funcionario` (`cpf`),
  CONSTRAINT `FK_uso_do_estacionamento_veiculo` FOREIGN KEY (`veiculo`) REFERENCES `veiculo` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Exportação de dados foi desmarcado.
-- Copiando estrutura para tabela parketin.veiculo
DROP TABLE IF EXISTS `veiculo`;
CREATE TABLE IF NOT EXISTS `veiculo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `placa` varchar(50) NOT NULL,
  `dono` int(11) NOT NULL,
  `cor` varchar(50) DEFAULT NULL,
  `tipo` varchar(50) DEFAULT NULL,
  `fabricante` varchar(50) DEFAULT NULL,
  `modelo` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_veiculo_cliente` (`dono`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Exportação de dados foi desmarcado.
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;

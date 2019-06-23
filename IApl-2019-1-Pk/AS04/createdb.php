<?php



$sql = "
DROP DATABASE IF EXISTS `parketin`;
CREATE DATABASE IF NOT EXISTS `parketin`;
USE `parketin`;

CREATE TABLE IF NOT EXISTS `cliente` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(150) NOT NULL,
  `cpf` varchar(15) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHAR

CREATE TABLE IF NOT EXISTS `estacionamento` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `local` varchar(250) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `vagas` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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

CREATE TABLE IF NOT EXISTS `login` (
  `email` varchar(100) NOT NULL,
  `senha` varchar(50) NOT NULL,
  `nivel` int(11) NOT NULL,
  `session` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


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

";





// Connection configuration

$host = 'localhost';
$database = 'parketin';
$user = 'root';
$password = '';

// Connection object

$pdo = new PDO('mysql:dbname='.$database.';host='.$host.';charset=UTF8', $user, $password);

$pdo->query($sql);
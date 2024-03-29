-- --------------------------------------------------------
-- Servidor:                     127.0.0.1
-- Versão do servidor:           10.4.27-MariaDB - mariadb.org binary distribution
-- OS do Servidor:               Win64
-- HeidiSQL Versão:              12.4.0.6659
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Copiando estrutura do banco de dados para senaigames_new
CREATE DATABASE IF NOT EXISTS `senaigames_new` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;
USE `senaigames_new`;

-- Copiando estrutura para tabela senaigames_new.games
CREATE TABLE IF NOT EXISTS `games` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome_game` varchar(50) DEFAULT NULL,
  `qntd_votos` varchar(50) DEFAULT '0',
  `img_game` varchar(256) DEFAULT 'https://www.senaiac.org.br/images/2019/12/16/senai--web.jpg',
  `turma` varchar(50) DEFAULT NULL,
  `descricao` varchar(256) DEFAULT NULL,
  `link_iframe` varchar(256) DEFAULT NULL,
  `professor` varchar(50) DEFAULT NULL,
  `alunos` mediumtext DEFAULT NULL,
  `visivel` enum('Sim','Não') DEFAULT 'Não',
  `HoraDeRegistro` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- Exportação de dados foi desmarcado.

-- Copiando estrutura para tabela senaigames_new.imagens
CREATE TABLE IF NOT EXISTS `imagens` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `imagem` varchar(144) DEFAULT NULL,
  `Adicionado_por` varchar(5000) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Exportação de dados foi desmarcado.

-- Copiando estrutura para tabela senaigames_new.logs
CREATE TABLE IF NOT EXISTS `logs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(256) DEFAULT NULL,
  `usuario` varchar(256) DEFAULT NULL,
  `data` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Exportação de dados foi desmarcado.

-- Copiando estrutura para tabela senaigames_new.textos
CREATE TABLE IF NOT EXISTS `textos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(256) DEFAULT 'Titulo',
  `sobre` varchar(1000) DEFAULT 'Sobre',
  `titulo_carrosel` varchar(256) DEFAULT 'Titulo Carrosel',
  `sobre_carrosel` varchar(1000) DEFAULT 'Sobre Carrosel',
  `Modifcado_Por` varchar(50) DEFAULT 'Sem Modificações',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Exportação de dados foi desmarcado.

-- Copiando estrutura para tabela senaigames_new.turmas
CREATE TABLE IF NOT EXISTS `turmas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `turma` varchar(50) NOT NULL DEFAULT '0',
  `ano` varchar(50) DEFAULT NULL,
  `Professor` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- Exportação de dados foi desmarcado.

-- Copiando estrutura para tabela senaigames_new.web_login
CREATE TABLE IF NOT EXISTS `web_login` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(30) NOT NULL,
  `senha` varchar(30) NOT NULL,
  `nome` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `Funcao` varchar(50) DEFAULT NULL,
  `foto` varchar(2225) DEFAULT 'https://media.glassdoor.com/sqll/2485344/senai-sc-squarelogo-1649915441240.png',
  `status` enum('Pendente','Aprovado') NOT NULL DEFAULT 'Pendente',
  `permissao` enum('Administrador','Padrao') NOT NULL DEFAULT 'Padrao',
  `primeiro_login` int(11) NOT NULL DEFAULT 0,
  `token` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- Exportação de dados foi desmarcado.

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;

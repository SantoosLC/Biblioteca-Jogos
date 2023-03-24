-- --------------------------------------------------------
-- Servidor:                     127.0.0.1
-- Versão do servidor:           8.0.31 - MySQL Community Server - GPL
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


-- Copiando estrutura do banco de dados para impressa_senaigames
CREATE DATABASE IF NOT EXISTS `impressa_senaigames` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `impressa_senaigames`;

-- Copiando estrutura para tabela impressa_senaigames.games
CREATE TABLE IF NOT EXISTS `games` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome_game` varchar(50) DEFAULT NULL,
  `qntd_votos` varchar(50) DEFAULT '0',
  `img_game` varchar(256) DEFAULT 'https://www.senaiac.org.br/images/2019/12/16/senai--web.jpg',
  `turma` varchar(50) DEFAULT NULL,
  `descricao` varchar(256) DEFAULT NULL,
  `link_iframe` varchar(256) DEFAULT NULL,
  `professor` varchar(50) DEFAULT NULL,
  `alunos` mediumtext,
  `visivel` enum('Sim','Não') DEFAULT 'Não',
  `HoraDeRegistro` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb3;

-- Copiando dados para a tabela impressa_senaigames.games: ~0 rows (aproximadamente)
INSERT IGNORE INTO `games` (`id`, `nome_game`, `qntd_votos`, `img_game`, `turma`, `descricao`, `link_iframe`, `professor`, `alunos`, `visivel`, `HoraDeRegistro`) VALUES
	(14, 'Jogo Teste', '1', 'https://localhost/biblioteca-jogos/imagens-jogos/Jogo Teste.png', 'Turma Teste', 'Teste Jogo', 'Jogos/2GameTest/index.html', 'Lucas Santos', 'Lucas;Fredy', 'Sim', '2023-03-24'),
	(15, 'Jogo Teste', '1', 'https://localhost/biblioteca-jogos/imagens-jogos/Jogo Teste.png', 'Turma Teste', 'Teste Jogo', 'Jogos/2GameTest/index.html', 'Lucas Santos', 'Lucas;Fredy', 'Sim', '2023-03-24'),
	(16, 'Jogo Teste', '1', 'https://localhost/biblioteca-jogos/imagens-jogos/Jogo Teste.png', 'Turma Teste', 'Teste Jogo', 'Jogos/2GameTest/index.html', 'Lucas Santos', 'Lucas;Fredy', 'Sim', '2023-03-24'),
	(17, 'Jogo Teste', '1', 'https://localhost/biblioteca-jogos/imagens-jogos/Jogo Teste.png', 'Turma Teste', 'Teste Jogo', 'Jogos/2GameTest/index.html', 'Lucas Santos', 'Lucas;Fredy', 'Sim', '2023-03-24'),
	(18, 'Jogo Teste', '1', 'https://localhost/biblioteca-jogos/imagens-jogos/Jogo Teste.png', 'Turma Teste', 'Teste Jogo', 'Jogos/2GameTest/index.html', 'Lucas Santos', 'Lucas;Fredy', 'Sim', '2023-03-24'),
	(19, 'Jogo Teste', '1', 'https://localhost/biblioteca-jogos/imagens-jogos/Jogo Teste.png', 'Turma Teste', 'Teste Jogo', 'Jogos/2GameTest/index.html', 'Lucas Santos', 'Lucas;Fredy', 'Sim', '2023-03-24');

-- Copiando estrutura para tabela impressa_senaigames.logs
CREATE TABLE IF NOT EXISTS `logs` (
  `id` int NOT NULL AUTO_INCREMENT,
  `descricao` varchar(256) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `usuario` varchar(256) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `data` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Copiando dados para a tabela impressa_senaigames.logs: ~0 rows (aproximadamente)

-- Copiando estrutura para tabela impressa_senaigames.turmas
CREATE TABLE IF NOT EXISTS `turmas` (
  `id` int NOT NULL AUTO_INCREMENT,
  `turma` varchar(50) NOT NULL DEFAULT '0',
  `ano` varchar(50) DEFAULT NULL,
  `Professor` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb3;

-- Copiando dados para a tabela impressa_senaigames.turmas: ~0 rows (aproximadamente)
INSERT IGNORE INTO `turmas` (`id`, `turma`, `ano`, `Professor`) VALUES
	(8, 'Turma Teste', '2023', 'Lucas Santos');

-- Copiando estrutura para tabela impressa_senaigames.web_login
CREATE TABLE IF NOT EXISTS `web_login` (
  `id` int NOT NULL AUTO_INCREMENT,
  `login` varchar(30) NOT NULL,
  `senha` varchar(30) NOT NULL,
  `nome` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `Funcao` varchar(50) DEFAULT NULL,
  `foto` varchar(2225) DEFAULT 'https://media.glassdoor.com/sqll/2485344/senai-sc-squarelogo-1649915441240.png',
  `status` enum('Pendente','Aprovado') CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL DEFAULT 'Pendente',
  `permissao` enum('Administrador','Padrao') NOT NULL DEFAULT 'Padrao',
  `token` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb3;

-- Copiando dados para a tabela impressa_senaigames.web_login: ~1 rows (aproximadamente)
INSERT IGNORE INTO `web_login` (`id`, `login`, `senha`, `nome`, `email`, `Funcao`, `foto`, `status`, `permissao`, `token`) VALUES
	(3, 'lucas.santos', '123', 'Lucas Santos', 'lucas.santos@lksagenciadigital.com.br', 'Desenvolvedor', 'https://media.glassdoor.com/sqll/2485344/senai-sc-squarelogo-1649915441240.png', 'Aprovado', 'Administrador', NULL);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;

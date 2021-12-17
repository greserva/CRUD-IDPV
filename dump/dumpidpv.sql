-- --------------------------------------------------------
-- Servidor:                     127.0.0.1
-- Versão do servidor:           8.0.26 - MySQL Community Server - GPL
-- OS do Servidor:               Win64
-- HeidiSQL Versão:              11.3.0.6295
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Copiando estrutura para tabela idpv.cargo
CREATE TABLE IF NOT EXISTS `cargo` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) COLLATE utf8_general_mysql500_ci NOT NULL,
  `descricao` varchar(45) COLLATE utf8_general_mysql500_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb3 COLLATE=utf8_general_mysql500_ci;

-- Copiando dados para a tabela idpv.cargo: ~5 rows (aproximadamente)
/*!40000 ALTER TABLE `cargo` DISABLE KEYS */;
INSERT INTO `cargo` (`id`, `nome`, `descricao`) VALUES
	(1, 'Programador', 'Bug o dia inteiraço'),
	(2, 'Copeiro', 'Lavar louças'),
	(5, 'Frentista', 'Abastecer carros'),
	(8, 'Cientista de Dados', 'Mexe com dados dos bancos de dados.'),
	(9, 'Analista T.I', 'Analisa os bugs');
/*!40000 ALTER TABLE `cargo` ENABLE KEYS */;

-- Copiando estrutura para tabela idpv.centro_de_custo
CREATE TABLE IF NOT EXISTS `centro_de_custo` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) COLLATE utf8_general_mysql500_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb3 COLLATE=utf8_general_mysql500_ci;

-- Copiando dados para a tabela idpv.centro_de_custo: ~2 rows (aproximadamente)
/*!40000 ALTER TABLE `centro_de_custo` DISABLE KEYS */;
INSERT INTO `centro_de_custo` (`id`, `nome`) VALUES
	(1, 'Financeiro'),
	(2, 'Operações');
/*!40000 ALTER TABLE `centro_de_custo` ENABLE KEYS */;

-- Copiando estrutura para tabela idpv.departamento
CREATE TABLE IF NOT EXISTS `departamento` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) COLLATE utf8_general_mysql500_ci NOT NULL,
  `centro_de_custo_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_departamento_centro_de_custo1_idx` (`centro_de_custo_id`),
  CONSTRAINT `fk_departamento_centro_de_custo1` FOREIGN KEY (`centro_de_custo_id`) REFERENCES `centro_de_custo` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb3 COLLATE=utf8_general_mysql500_ci;

-- Copiando dados para a tabela idpv.departamento: ~3 rows (aproximadamente)
/*!40000 ALTER TABLE `departamento` DISABLE KEYS */;
INSERT INTO `departamento` (`id`, `nome`, `centro_de_custo_id`) VALUES
	(1, 'Centro de comando', 2),
	(7, 'Infraestrutura', 2),
	(11, 'Centro Financeiro', 1);
/*!40000 ALTER TABLE `departamento` ENABLE KEYS */;

-- Copiando estrutura para tabela idpv.endereco
CREATE TABLE IF NOT EXISTS `endereco` (
  `id` int NOT NULL AUTO_INCREMENT,
  `cep` char(8) COLLATE utf8_general_mysql500_ci NOT NULL,
  `endereco` varchar(200) COLLATE utf8_general_mysql500_ci NOT NULL,
  `numero` int NOT NULL,
  `bairro` varchar(100) COLLATE utf8_general_mysql500_ci NOT NULL,
  `uf` char(2) COLLATE utf8_general_mysql500_ci NOT NULL,
  `cidade` varchar(60) COLLATE utf8_general_mysql500_ci NOT NULL,
  `complemento` varchar(200) COLLATE utf8_general_mysql500_ci DEFAULT NULL,
  `departamento_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_endereco_departamento1_idx` (`departamento_id`),
  CONSTRAINT `fk_endereco_departamento1` FOREIGN KEY (`departamento_id`) REFERENCES `departamento` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_general_mysql500_ci;

-- Copiando dados para a tabela idpv.endereco: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `endereco` DISABLE KEYS */;
/*!40000 ALTER TABLE `endereco` ENABLE KEYS */;

-- Copiando estrutura para tabela idpv.sessao
CREATE TABLE IF NOT EXISTS `sessao` (
  `id` int NOT NULL AUTO_INCREMENT,
  `usuario_id` int NOT NULL,
  `created_at` timestamp NOT NULL,
  `expired_at` timestamp NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_table1_usuario1_idx` (`usuario_id`),
  CONSTRAINT `fk_table1_usuario1` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_general_mysql500_ci;

-- Copiando dados para a tabela idpv.sessao: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `sessao` DISABLE KEYS */;
/*!40000 ALTER TABLE `sessao` ENABLE KEYS */;

-- Copiando estrutura para tabela idpv.usuario
CREATE TABLE IF NOT EXISTS `usuario` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) COLLATE utf8_general_mysql500_ci NOT NULL,
  `senha` varchar(100) COLLATE utf8_general_mysql500_ci NOT NULL,
  `email` varchar(45) COLLATE utf8_general_mysql500_ci NOT NULL,
  `data_de_nascimento` date NOT NULL,
  `cpf` char(11) COLLATE utf8_general_mysql500_ci NOT NULL,
  `cargo_id` int NOT NULL,
  `departamento_id` int NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `cpf_UNIQUE` (`cpf`),
  UNIQUE KEY `email_UNIQUE` (`email`),
  KEY `fk_usuario_cargo_idx` (`cargo_id`),
  KEY `fk_usuario_departamento1_idx` (`departamento_id`),
  CONSTRAINT `fk_usuario_cargo` FOREIGN KEY (`cargo_id`) REFERENCES `cargo` (`id`),
  CONSTRAINT `fk_usuario_departamento1` FOREIGN KEY (`departamento_id`) REFERENCES `departamento` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8mb3 COLLATE=utf8_general_mysql500_ci;

-- Copiando dados para a tabela idpv.usuario: ~1 rows (aproximadamente)
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` (`id`, `nome`, `senha`, `email`, `data_de_nascimento`, `cpf`, `cargo_id`, `departamento_id`) VALUES
	(33, 'Admin', '$2y$10$QMqm1aPChOk4MDgIaq/W5Oy83pvumbPasgeFhy2uVcvIYJlqPRbYm', 'admin@admin.com', '2021-12-13', '55555555555', 1, 1);
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;

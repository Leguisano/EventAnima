-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 30/06/2023 às 07:48
-- Versão do servidor: 10.4.28-MariaDB
-- Versão do PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `eventos`
--

-- --------------------------------------------------------

--
-- Estrutura stand-in para view `continscritosecont`
-- (Veja abaixo para a visão atual)
--
CREATE TABLE `continscritosecont` (
`id` int(11)
,`dia` varchar(5)
,`nome` varchar(200)
,`Participantes` bigint(21)
,`Avaliação` varchar(18)
,`Nota Máxima` int(11)
,`Nota Mínima` int(11)
);

-- --------------------------------------------------------

--
-- Estrutura para tabela `event`
--

CREATE TABLE `event` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `date` date DEFAULT NULL,
  `hours` int(11) DEFAULT NULL,
  `token` varchar(100) NOT NULL DEFAULT password(concat(`date`,`name`,`expires`)),
  `expires` datetime NOT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `event`
--

INSERT INTO `event` (`id`, `name`, `date`, `hours`, `token`, `expires`, `user_id`) VALUES
(1, 'Evento de teste', '2023-07-03', 6, '*57FF67FCD60D61970F2805DCACB770C4B222362D', '2023-07-03 21:30:00', 1),
(2, 'Teste Teste Teste', '2023-06-23', 8, '*F114F2765F7A4778703C0815E528FAC54F3418AC', '2023-06-23 20:30:00', 1),
(4, 'Evento futuro', '2023-06-30', 5, '*029B128E68642C22BAA257ED75314FA3388BACE6', '2023-06-30 22:00:00', 1),
(5, 'Evento usuário teste', '2023-06-30', 5, '*0689FB00802A4F1686DB154393E360F004243C20', '2023-06-30 20:30:00', 4);

-- --------------------------------------------------------

--
-- Estrutura para tabela `eventos_econt`
--

CREATE TABLE `eventos_econt` (
  `id` int(11) NOT NULL,
  `nome` varchar(200) NOT NULL,
  `dia` date DEFAULT NULL,
  `horas` int(11) DEFAULT NULL,
  `token` varchar(100) NOT NULL DEFAULT password(concat(`dia`,`nome`,`expira`)),
  `expira` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `ies`
--

CREATE TABLE `ies` (
  `id` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `ies`
--

INSERT INTO `ies` (`id`, `nome`) VALUES
(1, 'UNA'),
(2, 'ANHEMBI MORUMBI'),
(3, 'UNISOCIESC'),
(4, 'UNIFACS'),
(5, 'MILTON CAMPOS'),
(6, 'SÃO JUDAS'),
(7, 'UNP'),
(8, 'UNIBH'),
(9, 'UNIRITTER'),
(10, 'AGES'),
(11, 'UNIFG-PE'),
(12, 'FADERGS'),
(13, 'UNICURITIBA'),
(14, 'FPB'),
(15, 'UNISUL'),
(16, 'FASEH'),
(17, 'UNIFG-BA'),
(18, 'IBMR'),
(19, 'INSPIRALI'),
(20, 'HSM'),
(21, 'HSMu'),
(22, 'BSP'),
(23, 'LEARNING VILLAGE'),
(24, 'EBRADI'),
(25, 'LE CORDON BLEU'),
(26, 'SINGULARITYu BRAZIL'),
(27, 'GAMA ACADEMY'),
(1000, '_Outra_'),
(1001, 'SINGULARITYu BRAZIL'),
(1002, 'GAMA ACADEMY');

-- --------------------------------------------------------

--
-- Estrutura stand-in para view `inscritosecont`
-- (Veja abaixo para a visão atual)
--
CREATE TABLE `inscritosecont` (
`id` int(11)
,`dia` varchar(5)
,`nome` varchar(200)
,`Participantes` bigint(21)
,`Avaliação` varchar(18)
,`Nota Máxima` int(11)
,`Nota Mínima` int(11)
);

-- --------------------------------------------------------

--
-- Estrutura para tabela `inscritos_econt`
--

CREATE TABLE `inscritos_econt` (
  `id` int(11) NOT NULL,
  `nome` varchar(200) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `matricula` varchar(50) DEFAULT NULL,
  `instrutor` tinyint(1) DEFAULT NULL,
  `evento_id` int(11) DEFAULT NULL,
  `token` varchar(100) NOT NULL DEFAULT password(concat(`email`,`matricula`,`evento_id`)),
  `cpf` varchar(20) DEFAULT NULL,
  `cidade` varchar(100) DEFAULT NULL,
  `estado` varchar(50) DEFAULT NULL,
  `nascimento` date DEFAULT NULL,
  `sexo` varchar(20) DEFAULT NULL,
  `nota` int(11) DEFAULT -1 COMMENT 'Campo para avaliação -1: Não Avaliar, de 0 a 10 nota válida'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `inscritos_fadergs`
--

CREATE TABLE `inscritos_fadergs` (
  `id` int(11) NOT NULL,
  `nome` varchar(200) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `matricula` varchar(50) DEFAULT NULL,
  `instrutor` tinyint(1) DEFAULT NULL,
  `evento_id` int(11) DEFAULT NULL,
  `token` varchar(100) NOT NULL DEFAULT password(concat(`email`,`matricula`,`evento_id`)),
  `cpf` varchar(20) DEFAULT NULL,
  `cidade` varchar(100) DEFAULT NULL,
  `estado` varchar(50) DEFAULT NULL,
  `nascimento` date DEFAULT NULL,
  `sexo` varchar(20) DEFAULT NULL,
  `nota` int(11) DEFAULT -1 COMMENT 'Campo para avaliação -1: Não Avaliar, de 0 a 10 nota válida'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `inscritos_fadergs`
--

INSERT INTO `inscritos_fadergs` (`id`, `nome`, `email`, `matricula`, `instrutor`, `evento_id`, `token`, `cpf`, `cidade`, `estado`, `nascimento`, `sexo`, `nota`) VALUES
(4, 'Zézinho', 'teste@teste.com', '', 0, 1, '*C84C84C4793E38BDCA4AACBEC8EB8C165D929596', '', 'Cidade Teste', 'ES', '0000-00-00', '', 9),
(5, 'Zézinho 2', 'email@email.com', '', 0, 1, '*F0A85DF5A1F8BC42887637F1850598C7B7C6E535', '', 'Cidade Teste', 'ES', '0000-00-00', '', 7),
(6, 'Nome Completo', 'nome@exemplo.com', '11111111111', 0, 1, '*345559F533DB7615C2756DD1253DB6D68A7E3671', '', 'Cidade Teste', 'ES', '0000-00-00', '', 5);

-- --------------------------------------------------------

--
-- Estrutura stand-in para view `listarparticipantesecont`
-- (Veja abaixo para a visão atual)
--
CREATE TABLE `listarparticipantesecont` (
`id` int(11)
,`nome` varchar(200)
,`email` varchar(100)
,`matricula` varchar(50)
,`cpf` varchar(20)
,`cidade` varchar(100)
,`estado` varchar(50)
,`nascimento` date
,`sexo` varchar(20)
,`nota` int(11)
);

-- --------------------------------------------------------

--
-- Estrutura para tabela `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `admin` tinyint(1) DEFAULT 0,
  `password` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `admin`, `password`) VALUES
(1, 'Admin', 'admin@admin.com', 1, '827ccb0eea8a706c4c34a16891f84e7b'),
(4, 'Usuário Teste', 'teste@teste.com', 0, 'd0970714757783e6cf17b26fb8e2298f');

-- --------------------------------------------------------

--
-- Estrutura stand-in para view `viewinscritosfadergs`
-- (Veja abaixo para a visão atual)
--
CREATE TABLE `viewinscritosfadergs` (
`id` int(11)
,`dia` varchar(5)
,`nome` varchar(200)
,`Participantes` bigint(21)
,`Avaliação` varchar(18)
,`Nota Máxima` int(11)
,`Nota Mínima` int(11)
);

-- --------------------------------------------------------

--
-- Estrutura para view `continscritosecont`
--
DROP TABLE IF EXISTS `continscritosecont`;

CREATE ALGORITHM=UNDEFINED DEFINER=`u501503736_anima_csa`@`127.0.0.1` SQL SECURITY DEFINER VIEW `continscritosecont`  AS SELECT `e`.`id` AS `id`, date_format(`e`.`dia`,'%d/%m') AS `dia`, `e`.`nome` AS `nome`, (select count(`i`.`id`) from `inscritos_econt` `i` where `i`.`evento_id` = `e`.`id`) AS `Participantes`, (select format(avg(`i2`.`nota`),2) from `inscritos_econt` `i2` where `i2`.`evento_id` = `e`.`id` and `i2`.`nota` >= 0) AS `Avaliação`, (select max(`i3`.`nota`) from `inscritos_econt` `i3` where `i3`.`evento_id` = `e`.`id`) AS `Nota Máxima`, (select min(`i4`.`nota`) from `inscritos_econt` `i4` where `i4`.`evento_id` = `e`.`id` and `i4`.`nota` >= 0) AS `Nota Mínima` FROM `eventos_econt` AS `e` ;

-- --------------------------------------------------------

--
-- Estrutura para view `inscritosecont`
--
DROP TABLE IF EXISTS `inscritosecont`;

CREATE ALGORITHM=UNDEFINED DEFINER=`u501503736_anima_csa`@`127.0.0.1` SQL SECURITY DEFINER VIEW `inscritosecont`  AS SELECT `e`.`id` AS `id`, date_format(`e`.`dia`,'%d/%m') AS `dia`, `e`.`nome` AS `nome`, (select count(`i`.`id`) from `inscritos_econt` `i` where `i`.`evento_id` = `e`.`id`) AS `Participantes`, (select format(avg(`i2`.`nota`),2) from `inscritos_econt` `i2` where `i2`.`evento_id` = `e`.`id` and `i2`.`nota` >= 0) AS `Avaliação`, (select max(`i3`.`nota`) from `inscritos_econt` `i3` where `i3`.`evento_id` = `e`.`id`) AS `Nota Máxima`, (select min(`i4`.`nota`) from `inscritos_econt` `i4` where `i4`.`evento_id` = `e`.`id` and `i4`.`nota` >= 0) AS `Nota Mínima` FROM `eventos_econt` AS `e` ;

-- --------------------------------------------------------

--
-- Estrutura para view `listarparticipantesecont`
--
DROP TABLE IF EXISTS `listarparticipantesecont`;

CREATE ALGORITHM=UNDEFINED DEFINER=`u501503736_anima_csa`@`127.0.0.1` SQL SECURITY DEFINER VIEW `listarparticipantesecont`  AS SELECT `inscritos_econt`.`id` AS `id`, `inscritos_econt`.`nome` AS `nome`, `inscritos_econt`.`email` AS `email`, `inscritos_econt`.`matricula` AS `matricula`, `inscritos_econt`.`cpf` AS `cpf`, `inscritos_econt`.`cidade` AS `cidade`, `inscritos_econt`.`estado` AS `estado`, `inscritos_econt`.`nascimento` AS `nascimento`, `inscritos_econt`.`sexo` AS `sexo`, `inscritos_econt`.`nota` AS `nota` FROM `inscritos_econt` ;

-- --------------------------------------------------------

--
-- Estrutura para view `viewinscritosfadergs`
--
DROP TABLE IF EXISTS `viewinscritosfadergs`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `viewinscritosfadergs`  AS SELECT `e`.`id` AS `id`, date_format(`e`.`dia`,'%d/%m') AS `dia`, `e`.`nome` AS `nome`, (select count(`i`.`id`) from `inscritos_econt` `i` where `i`.`evento_id` = `e`.`id`) AS `Participantes`, (select format(avg(`i2`.`nota`),2) from `inscritos_econt` `i2` where `i2`.`evento_id` = `e`.`id` and `i2`.`nota` >= 0) AS `Avaliação`, (select max(`i3`.`nota`) from `inscritos_econt` `i3` where `i3`.`evento_id` = `e`.`id`) AS `Nota Máxima`, (select min(`i4`.`nota`) from `inscritos_econt` `i4` where `i4`.`evento_id` = `e`.`id` and `i4`.`nota` >= 0) AS `Nota Mínima` FROM `eventos_econt` AS `e` ;

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `event`
--
ALTER TABLE `event`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `eventos_econt`
--
ALTER TABLE `eventos_econt`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `ies`
--
ALTER TABLE `ies`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `inscritos_econt`
--
ALTER TABLE `inscritos_econt`
  ADD PRIMARY KEY (`id`),
  ADD KEY `evento_id` (`evento_id`);

--
-- Índices de tabela `inscritos_fadergs`
--
ALTER TABLE `inscritos_fadergs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `evento_id` (`evento_id`);

--
-- Índices de tabela `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `event`
--
ALTER TABLE `event`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `eventos_econt`
--
ALTER TABLE `eventos_econt`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `ies`
--
ALTER TABLE `ies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1003;

--
-- AUTO_INCREMENT de tabela `inscritos_econt`
--
ALTER TABLE `inscritos_econt`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `inscritos_fadergs`
--
ALTER TABLE `inscritos_fadergs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de tabela `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `inscritos_econt`
--
ALTER TABLE `inscritos_econt`
  ADD CONSTRAINT `inscritos_econt_ibfk_1` FOREIGN KEY (`evento_id`) REFERENCES `eventos_econt` (`id`);

--
-- Restrições para tabelas `inscritos_fadergs`
--
ALTER TABLE `inscritos_fadergs`
  ADD CONSTRAINT `inscritos_fadergs_ibfk_1` FOREIGN KEY (`evento_id`) REFERENCES `event` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

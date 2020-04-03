-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 03-Abr-2020 às 13:17
-- Versão do servidor: 10.4.11-MariaDB
-- versão do PHP: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `covid-zero`
--
CREATE DATABASE IF NOT EXISTS `covid-zero` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `covid-zero`;

-- --------------------------------------------------------

--
-- Estrutura da tabela `chat_sms`
--

DROP TABLE IF EXISTS `chat_sms`;
CREATE TABLE `chat_sms` (
  `id` int(11) NOT NULL,
  `de` varchar(200) NOT NULL,
  `userId` int(11) NOT NULL,
  `psId` int(11) NOT NULL,
  `sms` text NOT NULL,
  `data` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `chat_sms`
--

INSERT INTO `chat_sms` (`id`, `de`, `userId`, `psId`, `sms`, `data`) VALUES
(2, '8', 8, 2, 'Boa noite Srº Nutricionista, preciso de uma informação urgente', '2020-04-03 05:11:13'),
(4, 'Adilson Futa', 8, 2, 'Olá boa noite, podes expor a sua questão', '2020-04-03 05:15:56'),
(5, '8', 8, 2, 'Eu preciso saber como posso nelhorar a minha dieta alimentar', '2020-04-03 06:07:05'),
(6, 'Adilson Futa', 8, 2, 'Primeira presico saber como é a tua alimentação, podes de explicar um pouco?', '2020-04-03 06:08:43'),
(7, '2', 8, 5, 'Boa noite Psicológo', '2020-04-03 06:11:05'),
(8, 'Delfino Torres', 8, 5, 'Boa noite carrissimo, tudo bem?', '2020-04-03 06:11:52'),
(9, '8', 8, 5, 'Tudo sim  obg...queria apenas confirmar a nossa consulta pra segunda', '2020-04-03 06:16:10'),
(10, 'Delfino Torres', 8, 5, 'Sim, está confrimado as 10h no meu consultório em viana', '2020-04-03 06:17:25'),
(11, '8', 8, 5, 'ok, obrigado..até segunda!', '2020-04-03 06:17:48');

-- --------------------------------------------------------

--
-- Estrutura da tabela `dados`
--

DROP TABLE IF EXISTS `dados`;
CREATE TABLE `dados` (
  `id` int(11) NOT NULL,
  `suspeitos` int(11) NOT NULL,
  `negativos` int(11) NOT NULL,
  `positivos` int(11) NOT NULL,
  `recuperados` int(11) NOT NULL,
  `mortes` int(11) NOT NULL,
  `quarentena` int(11) NOT NULL,
  `provincia` varchar(100) NOT NULL,
  `municipio` varchar(100) NOT NULL,
  `data_registro` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `dados`
--

INSERT INTO `dados` (`id`, `suspeitos`, `negativos`, `positivos`, `recuperados`, `mortes`, `quarentena`, `provincia`, `municipio`, `data_registro`) VALUES
(1, 10, 400, 8, 1, 2, 600, 'Luanda', '', '2020-04-02 00:50:17'),
(2, 3, 2, 4, 1, 1, 12, 'Namibe', 'Mucamedes', '2020-04-02 14:51:20');

-- --------------------------------------------------------

--
-- Estrutura da tabela `profissionais_saude`
--

DROP TABLE IF EXISTS `profissionais_saude`;
CREATE TABLE `profissionais_saude` (
  `id` int(11) NOT NULL,
  `nome` varchar(200) NOT NULL,
  `profissao` varchar(200) NOT NULL,
  `telefone` int(11) NOT NULL,
  `data_conta` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `profissionais_saude`
--

INSERT INTO `profissionais_saude` (`id`, `nome`, `profissao`, `telefone`, `data_conta`) VALUES
(1, 'Adilson Futa', 'Infecciológista', 992392875, '2020-04-03 03:09:38'),
(2, 'José Caseiro', 'Nutricionista', 999999999, '2020-04-03 03:10:48'),
(3, 'Ana Maria', 'Nutricionista', 999999999, '2020-04-03 03:11:36'),
(5, 'Delfino Torres', 'Cardiológista e Psicólogo', 999999999, '2020-04-03 03:46:55');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `telefone` int(11) NOT NULL,
  `senha` text NOT NULL,
  `addIn` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `telefone`, `senha`, `addIn`) VALUES
(8, 994300111, '$2a$07$asxx54ahjppf45sd87a5au5q0elvARS2JhvkLW.gN6PlPDvnF1o62', '2020-04-03 01:27:23');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `chat_sms`
--
ALTER TABLE `chat_sms`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `dados`
--
ALTER TABLE `dados`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `profissionais_saude`
--
ALTER TABLE `profissionais_saude`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `chat_sms`
--
ALTER TABLE `chat_sms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de tabela `dados`
--
ALTER TABLE `dados`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `profissionais_saude`
--
ALTER TABLE `profissionais_saude`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

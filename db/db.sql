-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 23-Maio-2022 às 02:53
-- Versão do servidor: 10.4.24-MariaDB
-- versão do PHP: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `NotryTv`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `accounts`
--

CREATE TABLE `accounts` (
  `id` int(11) NOT NULL,
  `hash` varchar(32) NOT NULL,
  `idmta` float NOT NULL,
  `email` varchar(255) NOT NULL,
  `user` text DEFAULT NULL,
  `pass` text DEFAULT NULL,
  `adm` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `accounts`
--

INSERT INTO `accounts` (`id`, `hash`, `idmta`, `email`, `user`, `pass`, `adm`) VALUES
(23, 'wQ23Thqs0lryV5hyKxwyKQTxWNEjtc3Y', 1, 'contatodanielsilvaoficial@gmail.com', 'leinad', '202cb962ac59075b964b07152d234b70', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `cupons`
--

CREATE TABLE `cupons` (
  `id` int(11) NOT NULL,
  `cupom` varchar(255) NOT NULL,
  `valor` float NOT NULL,
  `usos` float NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `cupons`
--

INSERT INTO `cupons` (`id`, `cupom`, `valor`, `usos`, `status`) VALUES
(8, 'teste', 20, 5, 'true');

-- --------------------------------------------------------

--
-- Estrutura da tabela `faturas`
--

CREATE TABLE `faturas` (
  `id` int(11) NOT NULL,
  `user` text DEFAULT NULL,
  `ref` text DEFAULT NULL,
  `date` text DEFAULT NULL,
  `valor` text DEFAULT NULL,
  `quantidade` float NOT NULL,
  `status` text DEFAULT NULL,
  `metodo` text DEFAULT NULL,
  `setado` text DEFAULT NULL,
  `cupom` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `faturas`
--

INSERT INTO `faturas` (`id`, `user`, `ref`, `date`, `valor`, `quantidade`, `status`, `metodo`, `setado`, `cupom`) VALUES

-- --------------------------------------------------------

--
-- Estrutura da tabela `total`
--

CREATE TABLE `total` (
  `valor` float NOT NULL,
  `pontos` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `total`
--

INSERT INTO `total` (`valor`, `pontos`) VALUES
(0, 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `totalclient`
--

CREATE TABLE `totalclient` (
  `valor` float NOT NULL,
  `pontos` float NOT NULL,
  `user` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `totalclient`
--

INSERT INTO `totalclient` (`valor`, `pontos`, `user`) VALUES

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `key` (`id`);

--
-- Índices para tabela `cupons`
--
ALTER TABLE `cupons`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `faturas`
--
ALTER TABLE `faturas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `key` (`id`);

--
-- Índices para tabela `total`
--
ALTER TABLE `total`
  ADD PRIMARY KEY (`valor`);

--
-- Índices para tabela `totalclient`
--
ALTER TABLE `totalclient`
  ADD PRIMARY KEY (`valor`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `accounts`
--
ALTER TABLE `accounts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=0;

--
-- AUTO_INCREMENT de tabela `cupons`
--
ALTER TABLE `cupons`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=0;

--
-- AUTO_INCREMENT de tabela `faturas`
--
ALTER TABLE `faturas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=0;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 05-Ago-2022 às 03:15
-- Versão do servidor: 10.4.22-MariaDB
-- versão do PHP: 8.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `bdmba`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbcategoria`
--

CREATE TABLE `tbcategoria` (
  `idCategoria` int(11) NOT NULL,
  `idUsuario` int(11) DEFAULT NULL,
  `nomeCategoria` varchar(80) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbtarefa`
--

CREATE TABLE `tbtarefa` (
  `idTarefa` int(11) NOT NULL,
  `idUsuario` int(11) NOT NULL,
  `dataOrigem` date NOT NULL,
  `dataLimite` date NOT NULL,
  `tituloTarefa` varchar(15) NOT NULL,
  `descricaoTarefa` text NOT NULL,
  `statusTarefa` tinyint(1) NOT NULL,
  `idCategoria` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbusuario`
--

CREATE TABLE `tbusuario` (
  `idUsuario` int(11) NOT NULL,
  `nomeUsuario` varchar(50) NOT NULL,
  `loginUsuario` varchar(10) NOT NULL,
  `emailUsuario` varchar(100) NOT NULL,
  `senhaUsuario` text NOT NULL,
  `caminhoFotoUsuario` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `tbcategoria`
--
ALTER TABLE `tbcategoria`
  ADD PRIMARY KEY (`idCategoria`),
  ADD KEY `idUsuario` (`idUsuario`);

--
-- Índices para tabela `tbtarefa`
--
ALTER TABLE `tbtarefa`
  ADD PRIMARY KEY (`idTarefa`),
  ADD KEY `idUsuario` (`idUsuario`),
  ADD KEY `idCategoria` (`idCategoria`);

--
-- Índices para tabela `tbusuario`
--
ALTER TABLE `tbusuario`
  ADD PRIMARY KEY (`idUsuario`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `tbcategoria`
--
ALTER TABLE `tbcategoria`
  MODIFY `idCategoria` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tbtarefa`
--
ALTER TABLE `tbtarefa`
  MODIFY `idTarefa` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tbusuario`
--
ALTER TABLE `tbusuario`
  MODIFY `idUsuario` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `tbcategoria`
--
ALTER TABLE `tbcategoria`
  ADD CONSTRAINT `tbcategoria_ibfk_1` FOREIGN KEY (`idUsuario`) REFERENCES `tbusuario` (`idUsuario`);

--
-- Limitadores para a tabela `tbtarefa`
--
ALTER TABLE `tbtarefa`
  ADD CONSTRAINT `tbtarefa_ibfk_1` FOREIGN KEY (`idUsuario`) REFERENCES `tbusuario` (`idUsuario`),
  ADD CONSTRAINT `tbtarefa_ibfk_2` FOREIGN KEY (`idCategoria`) REFERENCES `tbcategoria` (`idCategoria`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

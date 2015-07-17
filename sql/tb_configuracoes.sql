-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tempo de Geração: 24/11/2012 às 18h20min
-- Versão do Servidor: 5.5.16
-- Versão do PHP: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Banco de Dados: `ajs_cursos`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_configuracoes`
--

CREATE TABLE IF NOT EXISTS `tb_configuracoes` (
  `nome_empresa` varchar(255) NOT NULL,
  `endereco_empresa` varchar(255) NOT NULL,
  `telefone_empresa` varchar(21) NOT NULL,
  `email_empresa` varchar(255) NOT NULL,
  `frase_site` varchar(256) NOT NULL,
  `descricao_site` varchar(255) NOT NULL,
  `palavras_chave` varchar(255) NOT NULL,
  `mapa_google` longtext NOT NULL,
  `coordenadas_google` varchar(32) NOT NULL,
  `facebook` varchar(255) NOT NULL,
  `twitter` varchar(255) NOT NULL,
  `youtube` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tb_configuracoes`
--

INSERT INTO `tb_configuracoes` (`nome_empresa`, `endereco_empresa`, `telefone_empresa`, `email_empresa`, `frase_site`, `descricao_site`, `palavras_chave`, `mapa_google`, `coordenadas_google`, `facebook`, `twitter`, `youtube`) VALUES
('Ajs Cursos', 'Rua Júpter', '+55 (0xx51) 8475 - 80', 'marlonjferri@gmail.com', 'Ajs Cursos', 'Ajs Cursos', 'Ajs Cursos', 'Aliquam erat volutpat. Etiam aliquam libero vel libero pellentesque ut ultrices ante interdum? Duis pulvinar nibh ac libero bibendum fermentum. Aenean luctus porta lorem eu egestas. Cras id commodo lectus.', '-00,00000, -00,00000', 'www.facebook.com', 'www.twitter.com', 'www.youtube.com');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

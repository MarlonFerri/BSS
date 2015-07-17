-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tempo de Geração: 26/12/2012 às 16h41min
-- Versão do Servidor: 5.5.16
-- Versão do PHP: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Banco de Dados: `blueskytosmile`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `bss_config`
--

CREATE TABLE IF NOT EXISTS `bss_config` (
  `id_bss_config` int(11) NOT NULL AUTO_INCREMENT,
  `parametro` varchar(255) NOT NULL,
  `valor` varchar(255) NOT NULL,
  PRIMARY KEY (`id_bss_config`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Extraindo dados da tabela `bss_config`
--

INSERT INTO `bss_config` (`id_bss_config`, `parametro`, `valor`) VALUES
(1, 'tipo_usuario_inicial', 'inicial');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_breve_ap`
--

CREATE TABLE IF NOT EXISTS `tb_breve_ap` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fundo` int(11) NOT NULL,
  `logo` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=45 ;

--
-- Extraindo dados da tabela `tb_breve_ap`
--

INSERT INTO `tb_breve_ap` (`id`, `fundo`, `logo`) VALUES
(1, 1, 1),
(2, 1, 1),
(3, 1, 1),
(4, 2, 2),
(5, 2, 1),
(6, 2, 4),
(7, 2, 4),
(8, 2, 2),
(9, 1, 4),
(10, 2, 1),
(11, 2, 1),
(12, 2, 1),
(13, 1, 1),
(14, 2, 2),
(15, 2, 1),
(16, 2, 4),
(17, 1, 1),
(18, 1, 3),
(19, 2, 1),
(20, 2, 2),
(21, 2, 3),
(22, 1, 4),
(23, 1, 2),
(24, 1, 4),
(25, 2, 4),
(26, 1, 3),
(27, 1, 3),
(28, 2, 2),
(29, 2, 4),
(30, 2, 3),
(31, 2, 4),
(32, 1, 3),
(33, 1, 3),
(34, 1, 4),
(35, 1, 2),
(36, 2, 1),
(37, 1, 2),
(38, 1, 1),
(39, 2, 4),
(40, 1, 4),
(41, 1, 3),
(42, 1, 2),
(43, 2, 3),
(44, 1, 4);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_breve_news`
--

CREATE TABLE IF NOT EXISTS `tb_breve_news` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(250) NOT NULL,
  `fundo` int(11) NOT NULL,
  `logo` int(11) NOT NULL,
  `ip` varchar(250) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Extraindo dados da tabela `tb_breve_news`
--

INSERT INTO `tb_breve_news` (`id`, `email`, `fundo`, `logo`, `ip`) VALUES
(1, 'asdfasdf@fasdf.com', 2, 1, '::1'),
(2, 'marlonjferri@gmail.com', 1, 2, '::1');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_configuracoes`
--

CREATE TABLE IF NOT EXISTS `tb_configuracoes` (
  `nome_empresa` varchar(255) NOT NULL,
  `endereco_empresa` varchar(255) NOT NULL,
  `telefone_empresa` varchar(23) NOT NULL,
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
('Blue Sky to Smile', 'Rua Albino Kempf 500, ', '+55 (0xx51) 8475 - 8059', 'blueskytosmile@gmail.com', 'Site para criar lista de tarefas e ajudar você a organizar seu objetivos e metas.', 'Gerenciador de tarefas para organização pessoal. Possibilita a melhor planejamento de passo a passo para objetivos e metas.', 'sonhos, metas, objetivos, organização, planejamento estratégico, realização, sucesso', 'Aliquam erat volutpat. Etiam aliquam libero vel libero pellentesque ut ultrices ante interdum? Duis pulvinar nibh ac libero bibendum fermentum. Aenean luctus porta lorem eu egestas. Cras id commodo lectus.', '-00,00000, -00,00000', 'https://www.facebook.com/BlueSkyToSmile', 'www.twitter.com', 'http://www.youtube.com/user/blueskytosmile');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_conteudo`
--

CREATE TABLE IF NOT EXISTS `tb_conteudo` (
  `id_conteudo` int(11) NOT NULL AUTO_INCREMENT,
  `pagina` varchar(50) NOT NULL,
  `nome_conteudo` varchar(255) NOT NULL,
  `conteudo_pt_br` text NOT NULL,
  `conteudo_en-us` text NOT NULL,
  PRIMARY KEY (`id_conteudo`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Extraindo dados da tabela `tb_conteudo`
--

INSERT INTO `tb_conteudo` (`id_conteudo`, `pagina`, `nome_conteudo`, `conteudo_pt_br`, `conteudo_en-us`) VALUES
(1, 'home', 'saudacao1', 'Todos os teus sonhos são possíveis e nós ajudaremos você a alcança-los!<br>Deixe o teu céu azul também!', '');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_news`
--

CREATE TABLE IF NOT EXISTS `tb_news` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Extraindo dados da tabela `tb_news`
--

INSERT INTO `tb_news` (`id`, `email`) VALUES
(1, 'fasdf@eu.com'),
(2, 'asdfasdf@fasdf.com'),
(3, 'asdfasdf@fasdf.com'),
(4, 'asdfasdf@fasdf.com'),
(5, 'asdfasdf@fasdf.com'),
(6, 'asdfasdf@fasdf.com'),
(7, 'asdfasdfasdfasd@af.co'),
(8, 'marlonjferri@gmail.com'),
(9, 'marlonjfderri@gmail.com'),
(10, 'asdfasdf@fasdfd.com'),
(11, 'ddfas@d.comaasdfasdfasdf');

-- --------------------------------------------------------

--
-- Estrutura da tabela `users_dados`
--

CREATE TABLE IF NOT EXISTS `users_dados` (
  `id_user_dados` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `user_nome` varchar(70) NOT NULL,
  `user_pontuacao` int(11) NOT NULL,
  `user_foto` varchar(250) NOT NULL,
  `user_cidade` varchar(200) NOT NULL,
  `user_idade` int(11) NOT NULL,
  `user_ocupacao` varchar(200) NOT NULL,
  `user_descricao` text NOT NULL,
  `user_sexo` char(1) NOT NULL,
  `user_codigo_confirmacao` varchar(255) NOT NULL,
  `user_confirmacao` tinyint(1) NOT NULL,
  `user_confirmacao_data` datetime NOT NULL,
  `user_confirmacao_ip` varchar(50) NOT NULL,
  PRIMARY KEY (`id_user_dados`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Extraindo dados da tabela `users_dados`
--

INSERT INTO `users_dados` (`id_user_dados`, `id_user`, `user_nome`, `user_pontuacao`, `user_foto`, `user_cidade`, `user_idade`, `user_ocupacao`, `user_descricao`, `user_sexo`, `user_codigo_confirmacao`, `user_confirmacao`, `user_confirmacao_data`, `user_confirmacao_ip`) VALUES
(5, 5, 'Marlon Ferri', 0, '', '', 0, '', '', '', '73dd808a0789406d4ada93985a792c1f', 0, '0000-00-00 00:00:00', '::1'),
(11, 11, 'asdfasdf', 0, '', '', 0, '', '', '', 'ded3b9bc53b212615e841afdb41fa112', 0, '0000-00-00 00:00:00', '');

-- --------------------------------------------------------

--
-- Estrutura da tabela `users_login`
--

CREATE TABLE IF NOT EXISTS `users_login` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_email` varchar(250) NOT NULL,
  `user_senha` varchar(100) NOT NULL,
  `user_tipo` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Extraindo dados da tabela `users_login`
--

INSERT INTO `users_login` (`id`, `user_email`, `user_senha`, `user_tipo`) VALUES
(5, 'marlonjferri@gmail.com', 'asdfasdf', 'inicial'),
(11, 'marlonjfedrri@gmail.com', 'asdfasdf', 'inicial');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

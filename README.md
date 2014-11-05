Carrinho de Compras || PHP-POO
===========================

Sistema com Administrador do site e carrinho de compras funcional

Este é um sistema que foi criado focando apenas no carrinho de compras. 
O layout esta grosseiro, no ponto para ser aplicado ao seu sistema. 

Acompanha também de brinde um administrador do site.

Abaixo estão as tabelas e campos do banco de dados:

CREATE DATABASE IF NOT EXISTS `loja` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `loja`;

-- --------------------------------------------------------

--
-- Estrutura da tabela `administradores`
--

CREATE TABLE IF NOT EXISTS `administradores` (
  `idadministrador` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(150) NOT NULL,
  `senha` varchar(150) NOT NULL,
  PRIMARY KEY (`idadministrador`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;


CREATE TABLE IF NOT EXISTS `categorias` (
  `idcategoria` int(11) NOT NULL AUTO_INCREMENT,
  `categoria` varchar(100) NOT NULL,
  PRIMARY KEY (`idcategoria`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;


CREATE TABLE IF NOT EXISTS `cliente` (
  `id_cliente` int(11) NOT NULL AUTO_INCREMENT,
  `cpf` text NOT NULL,
  `nome` text NOT NULL,
  `endereco` text NOT NULL,
  `telefone` text NOT NULL,
  `data_nascimento` text NOT NULL,
  `login` text NOT NULL,
  `senha` text NOT NULL,
  PRIMARY KEY (`id_cliente`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;


CREATE TABLE IF NOT EXISTS `compra` (
  `id_compra` int(11) NOT NULL AUTO_INCREMENT,
  `produtoid` int(11) NOT NULL,
  `nome` varchar(150) NOT NULL,
  `valor` double(5,2) NOT NULL,
  `qtd` int(11) NOT NULL,
  `data_compra` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `total` double(5,2) NOT NULL,
  `clienteid` int(11) NOT NULL,
  `status` text NOT NULL,
  PRIMARY KEY (`id_compra`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `produtos` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(150) NOT NULL,
  `descricao` text NOT NULL,
  `preco` double(5,2) NOT NULL,
  `estoque` int(11) NOT NULL,
  `categoria` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- INSERINDO dados da tabela `produtos`
--

INSERT INTO `produtos` (`id`, `nome`, `descricao`, `preco`, `estoque`, `categoria`) VALUES
(3, 'Metallica - Master of Puppets', 'O melhor CD deles. Foi o Ãºltimo em que Cliff Burton tocava.', 23.60, 10, 1),
(4, 'Imago Mortis - Vida: The Play of Change', 'CD conceitual de uma das melhores bandas de SÃ£o Paulo', 22.50, 0, 1),
(5, '2 Dream Theater - Metropolis Pt.2 Scenes From A Memory 3', 'O melhor CD da banda Dream Theater.', 23.50, 4, 1),
(6, 'O Hobbit - A DesolaÃ§Ã£o de Smaug', 'O Hobbit: A DesolaÃ§Ã£o de Smaug Ã© um filme de fantasia e aventura estadunidense, dirigido por Peter Jackson. Ã‰ o segundo filme da trilogia que foi adaptada a partir da obra de mesmo nome do escritor britÃ¢nico J. R. R. Tolkien', 23.99, 4, 2);


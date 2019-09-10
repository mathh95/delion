-- phpMyAdmin SQL Dump
-- version 4.2.12deb2+deb8u2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: 10-Set-2019 às 09:28
-- Versão do servidor: 5.7.17
-- PHP Version: 5.6.30-0+deb8u1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `c39delioncafe`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `adicional`
--

CREATE TABLE IF NOT EXISTS `adicional` (
`cod_adicional` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `preco` decimal(4,2) NOT NULL,
  `desconto` int(11) NOT NULL,
  `flag_ativo` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `adicional`
--

INSERT INTO `adicional` (`cod_adicional`, `nome`, `preco`, `desconto`, `flag_ativo`) VALUES
(1, 'Queijo extra', 2.00, 1, 1),
(2, 'Bacon extra', 5.00, 1, 1),
(3, 'Chocolate extra', 3.00, 1, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `avaliacao`
--

CREATE TABLE IF NOT EXISTS `avaliacao` (
`cod_avaliacao` int(11) NOT NULL,
  `tipo_avaliacao` int(11) NOT NULL,
  `data` date NOT NULL,
  `hora` time NOT NULL,
  `nota` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `avaliacao`
--

INSERT INTO `avaliacao` (`cod_avaliacao`, `tipo_avaliacao`, `data`, `hora`, `nota`) VALUES
(20, 9, '2018-10-04', '14:30:21', 4),
(21, 10, '2018-10-04', '14:30:21', 3),
(22, 11, '2018-10-04', '14:30:21', 3),
(23, 9, '2018-10-04', '14:58:58', 5),
(24, 10, '2018-10-04', '14:58:58', 4),
(25, 11, '2018-10-04', '14:58:58', 3);

-- --------------------------------------------------------

--
-- Estrutura da tabela `banner`
--

CREATE TABLE IF NOT EXISTS `banner` (
`cod_banner` int(11) NOT NULL,
  `nome` varchar(255) COLLATE utf8_bin NOT NULL,
  `link` varchar(255) COLLATE utf8_bin NOT NULL,
  `legenda` varchar(100) COLLATE utf8_bin NOT NULL,
  `flag_tamanho` tinyint(1) NOT NULL,
  `foto` varchar(255) COLLATE utf8_bin NOT NULL,
  `pagina` varchar(255) COLLATE utf8_bin NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=23 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Extraindo dados da tabela `banner`
--

INSERT INTO `banner` (`cod_banner`, `nome`, `link`, `legenda`, `flag_tamanho`, `foto`, `pagina`) VALUES
(3, 'Cartão 1', '#', 'JÁ PEDIU O SEU CARTÃO FIDELIDADE?', 1, 'upload/2018/10/03/2e0d65c6c0c04fd558a77abce222cd26.jpg', '["sobre","historia","contato","localizacao"]'),
(4, 'Torta', '#', 'Receba as nossas delícias no conforto da sua casa', 1, 'upload/2018/10/03/72b778b49a83902c31fb4b2e7197820f.jpg', '["sobre","historia","contato","localizacao"]'),
(6, 'Superior 2', '#', '', 0, 'upload/2018/10/05/d36ceb534d490f6140624acdf70de57a.jpg', '["inicialInferior","sobre","historia"]'),
(7, 'sobre', '#', '', 0, 'upload/2018/01/09/edc3a99e555f51188412f937845bc409.png', '["sobre"]'),
(8, 'Tomar café', '#', 'Surpreenda alguém com o nosso vale café', 1, 'upload/2018/10/03/4dfbc3250bf79da87d532b1d7521b448.jpg', '["sobre","historia","contato","localizacao"]'),
(18, 'Hambúrguer Don Júlio', 'http://www.delioncafe.com.br/home/cardapio.php?search=Hamb%C3%BArguer+do+Don+J%C3%BAlio', '', 0, 'upload/2018/09/26/7f5d0f18c8a533bc48a8ee276175e60d.jpg', '["inicialSuperior"]'),
(19, 'Combo', 'http://delioncafe.com.br/home/cardapio.php#', '', 0, 'upload/2018/10/04/c41efb63ade5dc9e0b8a9217dca89fc2.jpg', '["inicialSuperior"]'),
(12, 'Café Americano', '', '', 0, 'upload/2018/02/07/097aebfd8d0d15240eb199095d83bb7c.png', '["inicialSuperior"]'),
(16, 'Sanduiche de linguica', 'http://www.delioncafe.com.br/home/cardapio.php?search=lingui', '', 0, 'upload/2018/09/20/ccb5a34f9f87b3308b9dda61a3190b5a.jpg', '["inicialSuperior"]'),
(15, 'Cervejas', '', '', 0, 'upload/2018/09/20/8786968d5b9fba122b77ebd264fd7c66.jpg', '["inicialSuperior"]'),
(20, 'Delivery', 'https://delioncafe.com.br/home/cardapio.php', '', 0, 'upload/2018/10/30/5ac07b61f81523c46be4ff261407e867.jpg', '["inicialSuperior"]'),
(22, 'Espaço DO', '', '', 0, 'upload/2019/07/26/246fd3fad0e352f8d5f875b2bb60462e.jpg', '["inicialSuperior"]');

-- --------------------------------------------------------

--
-- Estrutura da tabela `cardapio`
--

CREATE TABLE IF NOT EXISTS `cardapio` (
`cod_cardapio` int(11) NOT NULL,
  `nome` varchar(255) CHARACTER SET utf8 NOT NULL,
  `preco` decimal(4,2) NOT NULL,
  `descricao` text CHARACTER SET utf8 NOT NULL,
  `foto` varchar(255) CHARACTER SET utf8 NOT NULL,
  `categoria` int(11) NOT NULL,
  `flag_ativo` tinyint(1) NOT NULL,
  `slug` varchar(255) CHARACTER SET utf8 NOT NULL,
  `prioridade` tinyint(1) DEFAULT NULL,
  `delivery` tinyint(1) DEFAULT NULL,
  `desconto` int(11) DEFAULT NULL,
  `adicional` text COLLATE utf8_bin,
  `dias_semana` mediumtext COLLATE utf8_bin NOT NULL,
  `cardapio_turno` int(11) DEFAULT NULL,
  `cardapio_horas_inicio` int(11) DEFAULT NULL,
  `cardapio_horas_final` int(11) DEFAULT NULL
) ENGINE=MyISAM AUTO_INCREMENT=193 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Extraindo dados da tabela `cardapio`
--

INSERT INTO `cardapio` (`cod_cardapio`, `nome`, `preco`, `descricao`, `foto`, `categoria`, `flag_ativo`, `slug`, `prioridade`, `delivery`, `desconto`, `adicional`, `dias_semana`, `cardapio_turno`, `cardapio_horas_inicio`, `cardapio_horas_final`) VALUES
(14, 'Combo Delion 1', 5.00, '&lt;p&gt;Dois p&amp;atilde;es franceses na chapa e um caf&amp;eacute; expresso.&lt;br /&gt;&lt;br /&gt;Todos os combos s&amp;atilde;o preparados na hora e o tempo m&amp;eacute;dio de preparo &amp;eacute; entre 5 a 10 minutos.&lt;/p&gt;', 'upload/2018/09/19/5762d0f3c2e7148f7976ec092ae04df4.jpg', 34, 1, '', 0, 0, 1, NULL, '', NULL, NULL, NULL),
(15, 'Combo Delion 2', 6.00, '&lt;p&gt;Dois p&amp;atilde;es franceses na chapa e um caf&amp;eacute; com leite.&lt;br /&gt;&lt;br /&gt;Todos os combos s&amp;atilde;o preparados na hora e o tempo m&amp;eacute;dio de preparo &amp;eacute; entre 5 a 10 minutos.&lt;/p&gt;', 'upload/2018/09/19/91a09e96f0fb40447e1d04ae01637707.jpg', 34, 1, '', 0, 0, 1, NULL, '', NULL, NULL, NULL),
(16, 'Combo Delion 3', 6.50, '&lt;p&gt;Dois p&amp;atilde;es franceses na chapa com requeij&amp;atilde;o e um caf&amp;eacute; com leite.&lt;br /&gt;&lt;br /&gt;Todos os combos s&amp;atilde;o preparados na hora e o tempo m&amp;eacute;dio de preparo &amp;eacute; entre 5 a 10 minutos.&lt;/p&gt;', 'upload/2018/09/19/13da77c84e4cad21d6ad52d47db8b392.jpg', 34, 1, '', 0, 0, 1, NULL, '', NULL, NULL, NULL),
(17, 'Macarrão a Carbonara', 13.90, '&lt;p&gt;Espaguete com bacon, ovo e queijo.&lt;/p&gt;\r\n&lt;p&gt;Acompanha um refrigerante ca&amp;ccedil;ulinha.&lt;/p&gt;\r\n&lt;p&gt;Tempo de preparo &amp;eacute; de 15 minutos.&lt;/p&gt;', 'upload/2018/09/19/8729370d2007f43107e1f919a2d596eb.jpg', 37, 1, '', 1, 1, 1, NULL, '', NULL, NULL, NULL),
(18, 'Macarrão 3 Queijos', 13.90, '&lt;p&gt;Espaguete com queijo parmes&amp;atilde;o, provolone e gouda.&lt;/p&gt;\r\n&lt;p&gt;Acompanha um refrigerante ca&amp;ccedil;ulinha.&lt;/p&gt;\r\n&lt;p&gt;Tempo de preparo &amp;eacute; de 15 minutos.&lt;/p&gt;', 'upload/2018/09/19/43c2c408f2e25421bfe593ebbdacc063.jpg', 37, 1, '', 1, 1, 1, NULL, '', NULL, NULL, NULL),
(19, 'Prato Executivo com Mignion', 15.90, '&lt;p&gt;Arroz, salada de alface, tomate e pepino, batatas fritas e 150 gramas de fil&amp;eacute; mignon&lt;/p&gt;\r\n&lt;p&gt;O cliente poder&amp;aacute; tamb&amp;eacute;m optar por fil&amp;eacute; de frango.&lt;/p&gt;\r\n&lt;p&gt;Tempo de preparo &amp;eacute; de 15 minutos.&lt;/p&gt;', 'upload/2018/09/18/0df5150a38b8ca10ed7490554780af72.jpg', 37, 1, '', 1, 1, 1, NULL, '', NULL, NULL, NULL),
(20, 'Deppuccino de Chocolate ', 9.00, '&lt;p&gt;&lt;strong&gt;Bebida gelada.&lt;/strong&gt;&lt;/p&gt;\r\n&lt;p&gt;300ml de leite, shot de cafe, chocolate, chocolate em calda, chantilly.&lt;/p&gt;\r\n&lt;p&gt;Tempo de preparo é de 10 minutos.&lt;/p&gt;', 'upload/2018/03/08/30cdf928d38574f9775685826185ef33.jpg', 0, 1, '', 0, 0, 1, '["3"]', '[]', 0, 0, 0),
(21, 'Deppuccino de Oreo com Nutella ', 9.00, '&lt;p&gt;&lt;strong&gt;Bebida gelada.&lt;/strong&gt;&lt;/p&gt;\r\n&lt;p&gt;150 ml de leite, shot de expresso, oreo, nutella, calda de chocolate e chantilly.&lt;/p&gt;\r\n&lt;p&gt;Tempo de preparo &amp;eacute; de 10 minutos.&lt;/p&gt;\r\n&lt;p&gt;&amp;nbsp;&lt;/p&gt;', 'upload/2018/03/08/e09b6739a807a3a259358b9877511460.jpg', 22, 1, '', 0, 0, 1, NULL, '', NULL, NULL, NULL),
(178, 'Cheesecake Chocolate com Framboesa', 4.00, '&lt;p&gt;Base de bolacha leite e mel, creme de chocolate amargo, coulis de framboesa.&lt;/p&gt;', 'upload/2018/09/19/477f86e90012697040a149e1f93229b6.jpg', 25, 1, '', 0, 0, 1, NULL, '', NULL, NULL, NULL),
(23, 'Ice Cappuccino', 6.50, '&lt;div dir=&quot;auto&quot;&gt;&lt;strong&gt;Bebida gelada.&lt;/strong&gt;&lt;/div&gt;\r\n&lt;div dir=&quot;auto&quot;&gt;300 ml de leite, mix em pó de grãos de café e gelo.&lt;/div&gt;\r\n&lt;div dir=&quot;auto&quot;&gt;Batido no Liquidificador.&lt;/div&gt;\r\n&lt;div dir=&quot;auto&quot;&gt; &lt;/div&gt;\r\n&lt;div dir=&quot;auto&quot;&gt;Tempo de preparo é de 10 minutos.&lt;/div&gt;', 'upload/2018/09/19/1593e7eacb59621805594d03ba68de5e.jpg', 0, 1, '', 0, 0, 1, '["3"]', '[]', 0, 0, 0),
(24, 'Ice Cioccolato  ', 6.50, '&lt;p&gt;&lt;strong&gt;Bebida gelada.&lt;/strong&gt;&lt;/p&gt;\r\n&lt;p&gt;300 ml de leite, mix em p&amp;oacute; de chocolate e gelo.&lt;/p&gt;\r\n&lt;p&gt;Batido no liquidificador.&lt;/p&gt;\r\n&lt;p&gt;Tempo de preparo &amp;eacute; de 10 minutos.&lt;/p&gt;', 'upload/2018/09/19/ec8c0d96f597fb081597d5b58705b169.jpg', 22, 1, '', 0, 0, 1, NULL, '', NULL, NULL, NULL),
(25, 'Limonada Rosa (S/L)', 6.50, '&lt;p&gt;&lt;strong&gt;Bebida gelada.&lt;/strong&gt;&lt;/p&gt;\r\n&lt;p&gt;300 ml de limonada, a&amp;ccedil;&amp;uacute;car, gelo e ess&amp;ecirc;ncia de groselha.&lt;/p&gt;\r\n&lt;p&gt;A&amp;ccedil;&amp;uacute;car &amp;eacute; opcional.&lt;/p&gt;\r\n&lt;p&gt;Tempo de preparo &amp;eacute; de 10 minutos.&lt;/p&gt;', 'upload/2018/09/14/f650a375ac3ebdcc70808cd144d5a704.jpg', 22, 1, '', 0, 0, 1, NULL, '', NULL, NULL, NULL),
(26, 'Limonada de Morango (S/L)', 7.50, '&lt;p&gt;&lt;strong&gt;Bebida gelada.&lt;/strong&gt;&lt;/p&gt;\r\n&lt;p&gt;300 ml de limonada, 100 gr de morango, a&amp;ccedil;&amp;uacute;car.&lt;/p&gt;\r\n&lt;p&gt;Batido no liquidificador.&lt;/p&gt;\r\n&lt;p&gt;A&amp;ccedil;&amp;uacute;car &amp;eacute; opcional.&lt;/p&gt;\r\n&lt;p&gt;Tempo de preparo &amp;eacute; de 10 minutos.&lt;/p&gt;', 'upload/2018/09/19/1a94589b9367825ae76d4d938061b7b5.png', 22, 1, '', 0, 0, 1, NULL, '', NULL, NULL, NULL),
(27, 'Limonada (S/L)', 6.00, '&lt;p&gt;&lt;strong&gt;Bebida gelada.&lt;/strong&gt;&lt;/p&gt;\r\n&lt;p&gt;250 ml de limonada, 100 ml de &amp;aacute;gua, a&amp;ccedil;&amp;uacute;car e gelo.&lt;/p&gt;\r\n&lt;p&gt;Ac&amp;uacute;car &amp;eacute; opcional.&lt;/p&gt;\r\n&lt;p&gt;Tempo de preparo &amp;eacute; de 10 minutos.&lt;/p&gt;', 'upload/2018/09/19/ded3c27337cb27fc9919f753fe1e6a63.jpg', 22, 1, '', 0, 0, 1, NULL, '', NULL, NULL, NULL),
(28, 'Café Expresso ', 2.00, '&lt;p&gt;&lt;strong&gt;Bebida quente&lt;/strong&gt;&lt;/p&gt;\r\n&lt;p&gt;7 gr de caf&amp;eacute; mo&amp;iacute;do na hora, prensada e 30 ml de &amp;aacute;gua.&lt;/p&gt;\r\n&lt;p&gt;Tempo de preparo &amp;eacute; de 5 minutos.&lt;/p&gt;', 'upload/2018/09/14/38ae1ca6954824486d4894cda9338a98.jpg', 22, 1, '', 0, 0, 1, NULL, '', NULL, NULL, NULL),
(29, 'Café Expresso com Doce de Leite ', 3.00, '&lt;p&gt;&lt;strong&gt;Bebida quente.&lt;/strong&gt;&lt;/p&gt;\r\n&lt;p&gt;7 gr de caf&amp;eacute; mo&amp;iacute;do na hora, prensada e 30 ml de &amp;aacute;gua.&lt;/p&gt;\r\n&lt;p&gt;Uma colher de doce de leite da casa.&lt;/p&gt;\r\n&lt;p&gt;Tempo de preparo &amp;eacute; de 5 minutos.&lt;/p&gt;', 'upload/2018/09/14/eecb89d3cbc3369456e2430dc70c19bd.jpg', 22, 1, '', 0, 0, 1, NULL, '', NULL, NULL, NULL),
(30, 'Café Expresso Duplo ', 4.00, '&lt;p&gt;&lt;strong&gt;Bebida quente.&lt;/strong&gt;&lt;/p&gt;\r\n&lt;p&gt;14 gr de caf&amp;eacute; mo&amp;iacute;do na hora, prensado e 60 ml de &amp;aacute;gua.&lt;/p&gt;\r\n&lt;p&gt;Tempo de preparo &amp;eacute; de 5 minutos.&lt;/p&gt;', 'upload/2018/09/18/b735885d2213d2c4a9d609ec4ac763ea.jpg', 22, 1, '', 0, 0, 1, NULL, '', NULL, NULL, NULL),
(31, 'Café Carioca ', 2.00, '&lt;p&gt;&lt;strong&gt;Bebida quente.&lt;/strong&gt;&lt;/p&gt;\r\n&lt;p&gt;7 gr de caf&amp;eacute; mo&amp;iacute;do na hora, prensado e 40 ml de &amp;aacute;gua.&lt;/p&gt;\r\n&lt;p&gt;Tempo de preparo &amp;eacute; de 5 minutos.&lt;/p&gt;', 'upload/2018/09/18/f999392ebbde583f2e80fa072b5efb3a.jpg', 22, 1, '', 0, 0, 1, NULL, '', NULL, NULL, NULL),
(32, 'Café Carioca Duplo', 4.00, '&lt;p&gt;&lt;strong&gt;Bebida quente.&lt;/strong&gt;&lt;/p&gt;\r\n&lt;p&gt;14 gr de caf&amp;eacute; mo&amp;iacute;do na hora, prensado e 80 ml de &amp;aacute;gua.&lt;/p&gt;\r\n&lt;p&gt;Tempo de preparo &amp;eacute; de 5 minutos.&lt;/p&gt;', 'upload/2018/09/18/b895ee72c27e4a51da8b744135b7b828.jpg', 22, 1, '', 0, 0, 1, NULL, '', NULL, NULL, NULL),
(33, 'Café Expresso Machiatto ', 2.50, '&lt;p&gt;&lt;strong&gt;Bebida quente.&lt;/strong&gt;&lt;/p&gt;\r\n&lt;p&gt;1 shot de expresso e espuma de leite vaporizado.&lt;/p&gt;', 'upload/2018/09/19/ea665bf224d41f3767645f67779bb2f1.png', 22, 1, '', 0, 0, 1, NULL, '', NULL, NULL, NULL),
(34, 'Café com Leite ', 4.50, '&lt;p&gt;&lt;strong&gt;Bebida Quente.&lt;/strong&gt;&lt;/p&gt;\r\n&lt;p&gt;1 shot de expresso e 150 ml de leite vaporizado.&lt;/p&gt;\r\n&lt;p&gt;Tempo de preparo &amp;eacute; de 5 minutos.&lt;/p&gt;', 'upload/2018/09/19/eb34c96a8fa725fa359a08844856ba47.jpg', 22, 1, '', 0, 0, 1, NULL, '', NULL, NULL, NULL),
(35, 'Cappuccino Canela ', 6.50, '&lt;p&gt;&lt;strong&gt;Bebida quente.&lt;/strong&gt;&lt;/p&gt;\r\n&lt;p&gt;Canela em p&amp;oacute;, 1 shot de expresso e partes iguais de leite vaporizado e espuma do leite.&lt;/p&gt;\r\n&lt;p&gt;Pode ser acrescentado chantilly, como na foto.&lt;/p&gt;\r\n&lt;p&gt;Tempo de preparo &amp;eacute; de 5 minutos.&lt;/p&gt;', 'upload/2018/09/19/0c5efb5a56121026944cb4e7a67095cc.png', 22, 1, '', 0, 0, 1, NULL, '', NULL, NULL, NULL),
(36, 'Mocca', 6.50, '&lt;p&gt;&lt;strong&gt;Bebida quente.&lt;/strong&gt;&lt;/p&gt;\r\n&lt;p&gt;Calda de chocolate, 1 shot de expresso, leite vaporizado e espuma de leite.&lt;/p&gt;\r\n&lt;p&gt;Pode ser acrescentado chantilly.&lt;/p&gt;\r\n&lt;p&gt;Tempo de preparo &amp;eacute; de 10 minutos.&lt;/p&gt;', 'upload/2018/09/19/f058f6d990d09fc64667b7d706dac40b.jpg', 22, 1, '', 1, 0, 1, NULL, '', NULL, NULL, NULL),
(37, 'Mocca de Leite de Coco (S/L)', 8.50, '&lt;p&gt;&lt;strong&gt;Bebida quente.&lt;/strong&gt;&lt;/p&gt;\r\n&lt;p&gt;Calda de chocolate, 1 shot de expresso, leite de coco vaporizado.&lt;/p&gt;\r\n&lt;p&gt;Pode ser acrescentado chantilly.&lt;/p&gt;\r\n&lt;p&gt;Tempo de preparo &amp;eacute; de 10 minutos.&lt;/p&gt;', 'upload/2018/09/19/406705f577b2ef5dc47959a51f91d0f9.jpg', 22, 1, '', 0, 0, 1, NULL, '', NULL, NULL, NULL),
(38, 'Café Havaiano', 6.50, '&lt;p&gt;&lt;strong&gt;Bebida quente.&lt;/strong&gt;&lt;/p&gt;\r\n&lt;p&gt;1 shot de expresso, 1 shot de leite de coco, leite vaporizado e coco ralado.&lt;/p&gt;\r\n&lt;p&gt;Pode ser acrescentado chantilly como na foto.&lt;/p&gt;\r\n&lt;p&gt;Tempo de preparo &amp;eacute; de 5 minutos.&lt;/p&gt;', 'upload/2018/09/19/4804336674f431d9075664d4fca8e85b.jpg', 22, 1, '', 0, 0, 1, NULL, '', NULL, NULL, NULL),
(39, 'Chai Latte ', 5.00, '&lt;p&gt;&lt;strong&gt;Bebida quente.&lt;/strong&gt;&lt;/p&gt;\r\n&lt;p&gt;Mix de canela, chocolate e especiarias em p&amp;oacute; e 150 ml de leite vaporizado.&lt;/p&gt;\r\n&lt;p&gt;Tempo de preparo &amp;eacute; de 5 minutos.&lt;/p&gt;', 'upload/2018/09/20/e85d4bf215df9608a9d4f50d9a8ad6d4.jpg', 22, 1, '', 0, 0, 1, NULL, '', NULL, NULL, NULL),
(40, 'Café Nutella Latte', 6.50, '&lt;p&gt;&lt;strong&gt;Bebida quente.&lt;/strong&gt;&lt;/p&gt;\r\n&lt;p&gt;Nutella, 1 shot de expresso, leite vaporizado e espuma de leite.&lt;/p&gt;\r\n&lt;p&gt;Pode ser acrescentado chantilly.&lt;/p&gt;\r\n&lt;p&gt;Tempo de preparo &amp;eacute; de 10 minutos.&lt;/p&gt;', 'upload/2018/09/20/0aac0d123c565a435d5988128da4c671.jpg', 22, 1, '', 0, 0, 1, NULL, '', NULL, NULL, NULL),
(41, 'Café Doce de Leite', 7.50, '&lt;p&gt;&lt;strong&gt;Bebida quente.&lt;/strong&gt;&lt;/p&gt;\r\n&lt;p&gt;Doce de leite da casa, 1 shot de expresso, leite vaporizado e espuma de leite.&lt;/p&gt;\r\n&lt;p&gt;Pode ser acrescentado chantilly como na foto.&lt;/p&gt;\r\n&lt;p&gt;Tempo de preparo &amp;eacute; de 10 minutos.&lt;/p&gt;', 'upload/2018/09/19/bb6708c4d128b5a47a4561d331a4b0d5.jpg', 22, 1, '', 0, 0, 1, NULL, '', NULL, NULL, NULL),
(42, 'Prensa Francesa ( 350 ml)', 15.90, '&lt;p&gt;&lt;strong&gt;Bebida quente.&lt;/strong&gt;&lt;/p&gt;\r\n&lt;p&gt;20 gr de caf&amp;eacute; mo&amp;iacute;do na hora e 350 ml de &amp;aacute;gua quente.&lt;/p&gt;\r\n&lt;p&gt;Tempo de preparo &amp;eacute; de 5 minutos.&lt;/p&gt;', 'upload/2018/09/20/31a832becdc0e6f4b4cbb8477395b0a5.png', 22, 1, '', 0, 0, 1, NULL, '', NULL, NULL, NULL),
(43, 'Chá de Erva Doce', 3.50, '&lt;p&gt;&lt;strong&gt;Ch&amp;aacute; quente.&lt;/strong&gt;&lt;/p&gt;\r\n&lt;p&gt;Tempo de preparo &amp;eacute; de 5 minutos.&lt;/p&gt;', 'upload/2018/09/20/6e47cdec515631960897f62665f91599.jpg', 22, 1, '', 0, 0, 1, NULL, '', NULL, NULL, NULL),
(44, 'Lady Grey', 3.50, '&lt;p&gt;&lt;strong&gt;Ch&amp;aacute; quente.&lt;/strong&gt;&lt;/p&gt;\r\n&lt;p&gt;Tempo de preparo &amp;eacute; de 5 minutos.&lt;/p&gt;', 'upload/2018/09/20/bc00bc302d56cf34b41a18eaa8662967.jpg', 22, 1, '', 0, 0, 1, NULL, '', NULL, NULL, NULL),
(45, 'Chá de Hortelã', 3.50, '&lt;p&gt;&lt;strong&gt;Ch&amp;aacute; quente.&lt;/strong&gt;&lt;/p&gt;\r\n&lt;p&gt;Tempo de preparo &amp;eacute; de 5 minutos.&lt;/p&gt;', 'upload/2018/09/20/ffcfa22392f829ba1cd1f8928d5f1120.jpg', 22, 1, '', 0, 0, 1, NULL, '', NULL, NULL, NULL),
(46, 'Chá Preto com Frutas Vermelhas', 3.50, '&lt;p&gt;&lt;strong&gt;Ch&amp;aacute; quente.&lt;/strong&gt;&lt;/p&gt;\r\n&lt;p&gt;Tempo de preparo &amp;eacute; de 5 minutos.&lt;/p&gt;', 'upload/2018/09/20/2d76618ee06b0031edbcf9ad67e53227.jpg', 22, 1, '', 0, 0, 1, NULL, '', NULL, NULL, NULL),
(47, 'Earl Grey', 3.50, '&lt;p&gt;&lt;strong&gt;Ch&amp;aacute; quente.&lt;/strong&gt;&lt;/p&gt;\r\n&lt;p&gt;Tempo de preparo &amp;eacute; de 5 minutos.&lt;/p&gt;', 'upload/2018/09/20/af2d804940c25f0bc594096a61c07eb2.jpg', 22, 1, '', 0, 0, 1, NULL, '', NULL, NULL, NULL),
(48, 'Price of Wales', 3.50, '&lt;p&gt;&lt;strong&gt;Ch&amp;aacute; quente.&lt;/strong&gt;&lt;/p&gt;\r\n&lt;p&gt;Tempo de preparo &amp;eacute; de 5 minutos.&lt;/p&gt;', 'upload/2018/09/20/094b5149c5c2b0fe739578aba0e010b0.jpg', 22, 1, '', 0, 0, 1, NULL, '', NULL, NULL, NULL),
(49, 'English Breakfest', 3.50, '&lt;p&gt;&lt;strong&gt;Ch&amp;aacute; quente.&lt;/strong&gt;&lt;/p&gt;\r\n&lt;p&gt;Tempo de preparo &amp;eacute; de 5 minutos.&lt;/p&gt;', 'upload/2018/09/20/862b9041858705c308b24c57dff46113.jpg', 22, 1, '', 0, 0, 1, NULL, '', NULL, NULL, NULL),
(50, 'Camomila com Hortelã', 3.50, '&lt;p&gt;&lt;strong&gt;Ch&amp;aacute; quente.&lt;/strong&gt;&lt;/p&gt;\r\n&lt;p&gt;Tempo de preparo &amp;eacute; de 5 minutos.&lt;/p&gt;', 'upload/2018/09/20/247bde085a4b468df099b233144cb52c.jpg', 22, 1, '', 0, 0, 1, NULL, '', NULL, NULL, NULL),
(52, 'Camomila com Mel e Baunilha', 3.50, '&lt;p&gt;&lt;strong&gt;Ch&amp;aacute; quente.&lt;/strong&gt;&lt;/p&gt;\r\n&lt;p&gt;Tempo de preparo &amp;eacute; de 5 minutos.&lt;/p&gt;', 'upload/2018/09/20/a9d28482d01966f75c23f3e4ca973310.jpg', 22, 1, '', 0, 0, 1, NULL, '', NULL, NULL, NULL),
(53, 'Capim Limão', 3.50, '&lt;p&gt;&lt;strong&gt;Ch&amp;aacute; quente.&lt;/strong&gt;&lt;/p&gt;\r\n&lt;p&gt;Tempo de preparo &amp;eacute; de 5 minutos.&lt;/p&gt;', 'upload/2018/09/20/ae2ca17a55578f9765ebdfe573f7634c.jpg', 22, 1, '', 0, 0, 1, NULL, '', NULL, NULL, NULL),
(54, 'Chá Verde com Gengibre', 5.50, '&lt;p&gt;&lt;strong&gt;Bebida Gelada.&lt;/strong&gt;&lt;/p&gt;\r\n&lt;p&gt;200 ml de ch&amp;aacute; preparado na delion. Mix de gengibre, ch&amp;aacute; verde, hortel&amp;atilde;, mel e lim&amp;atilde;o.&amp;nbsp;&lt;/p&gt;\r\n&lt;p&gt;Batido no liquidifcador com gelo.&lt;/p&gt;\r\n&lt;p&gt;Tempo de preparo &amp;eacute; de 10 minutos.&lt;/p&gt;', 'upload/2018/09/19/0e52aae169bfdc1fb2d6a75ab66d2f0c.jpg', 22, 1, '', 0, 0, 1, NULL, '', NULL, NULL, NULL),
(55, 'Chá Matte', 4.00, '&lt;p&gt;&lt;strong&gt;Ch&amp;aacute; quente ou gelado.&lt;/strong&gt;&lt;/p&gt;\r\n&lt;p&gt;Mix de ervas, escolhidos pela Delion, em infus&amp;atilde;o em &amp;aacute;gua quente.&lt;/p&gt;\r\n&lt;p&gt;Pode ser consumido gelado ou quente.&lt;/p&gt;\r\n&lt;p&gt;Tempo de preparo &amp;eacute; de 5 minutos.&lt;/p&gt;', 'upload/2018/09/20/34a1e2e62990f99cc198157c80fba38d.png', 22, 1, '', 0, 0, 1, NULL, '', NULL, NULL, NULL),
(57, 'Mix Tea de Limão ', 5.00, '&lt;p&gt;&lt;strong&gt;Bebida Gelada.&lt;/strong&gt;&lt;/p&gt;\r\n&lt;p&gt;300 ml de &amp;aacute;gua, mix em p&amp;oacute; sabor lim&amp;atilde;o, gelo.&lt;/p&gt;\r\n&lt;p&gt;Batido em liquidificador.&lt;/p&gt;\r\n&lt;p&gt;J&amp;aacute; vem ado&amp;ccedil;ado.&lt;/p&gt;\r\n&lt;p&gt;Tempo de preparo &amp;eacute; de 10 minutos.&lt;/p&gt;', 'upload/2018/09/19/f620eddda4246999ee9d905620be632c.png', 22, 1, '', 0, 0, 1, NULL, '', NULL, NULL, NULL),
(58, 'Mix Tea de Pêssego ', 5.00, '&lt;p&gt;&lt;strong&gt;Bebida Gelada.&lt;/strong&gt;&lt;/p&gt;\r\n&lt;p&gt;300 ml de &amp;aacute;gua, mix em p&amp;oacute; sabor p&amp;ecirc;ssego, gelo.&lt;/p&gt;\r\n&lt;p&gt;Batido em liquidificador.&lt;/p&gt;\r\n&lt;p&gt;J&amp;aacute; vem ado&amp;ccedil;ado.&lt;/p&gt;\r\n&lt;p&gt;Tempo de preparo &amp;eacute; de 10 minutos.&lt;/p&gt;', 'upload/2018/09/19/0eec56a3a6928c551858bcac2c04ff01.png', 22, 1, '', 0, 0, 1, NULL, '', NULL, NULL, NULL),
(59, 'Chá Mate de Maracujá ', 6.00, '&lt;p&gt;&lt;strong&gt;Ch&amp;aacute; gelado.&lt;/strong&gt;&lt;/p&gt;\r\n&lt;p&gt;Ch&amp;aacute; mate, aromatizante de maracuj&amp;aacute;, leite condensado e gelo.&lt;/p&gt;\r\n&lt;p&gt;Batido no liquidificador.&lt;/p&gt;\r\n&lt;p&gt;Leite condensado &amp;eacute; opcional.&lt;/p&gt;\r\n&lt;p&gt;Tempo de preparo &amp;eacute; de 10 minutos.&lt;/p&gt;\r\n&lt;p&gt;&amp;nbsp;&lt;/p&gt;', 'upload/2018/09/20/a4fe6b3d691cebccea545e488b925a4e.png', 22, 1, '', 0, 0, 1, NULL, '', NULL, NULL, NULL),
(60, 'Chá Mate de Abacaxi ', 6.00, '&lt;p&gt;&lt;strong&gt;Ch&amp;aacute; gelado.&lt;/strong&gt;&lt;/p&gt;\r\n&lt;p&gt;Ch&amp;aacute; mate, aromatizante de abacaxi, leite condensado e gelo.&lt;/p&gt;\r\n&lt;p&gt;Batido no liquidificador.&lt;/p&gt;\r\n&lt;p&gt;Leite condensado &amp;eacute; opcional.&lt;/p&gt;\r\n&lt;p&gt;Tempo de preparo &amp;eacute; de 10 minutos.&lt;/p&gt;', 'upload/2018/09/20/ec4e35b4bab8df0d6b7141f1d8e515fd.png', 22, 1, '', 0, 0, 1, NULL, '', NULL, NULL, NULL),
(61, 'Chá de Hibisco com Canela', 5.50, '&lt;p&gt;&lt;strong&gt;Ch&amp;aacute; gelado ou quente.&lt;/strong&gt;&lt;/p&gt;\r\n&lt;p&gt;Ch&amp;aacute; de hibisco e canela preparado na casa. Batido com gelo.&lt;/p&gt;\r\n&lt;p&gt;Pode ser tomado quente tamb&amp;eacute;m.&amp;nbsp;&lt;/p&gt;\r\n&lt;p&gt;Tempo de preparo &amp;eacute; de 10 minutos.&lt;/p&gt;', 'upload/2018/09/18/e50da09128641608d4c69761ef9993e4.png', 22, 1, '', 0, 0, 1, NULL, '', NULL, NULL, NULL),
(62, 'Milkshake de Doce de Leite', 14.50, '&lt;p&gt;&lt;strong&gt;Bebida gelada.&lt;/strong&gt;&lt;/p&gt;\r\n&lt;p&gt;300 ml de leite, sorvete, doce de leite da casa, calda de caramelo e chantilly.&lt;/p&gt;\r\n&lt;p&gt;Tempo de preparo &amp;eacute; de 10 minutos.&lt;/p&gt;', 'upload/2018/09/19/0fb62202a509da5aad4fee89617495ea.jpg', 22, 1, '', 0, 0, 1, NULL, '', NULL, NULL, NULL),
(63, 'Milkshake de Nutella', 14.50, '&lt;p&gt;&lt;strong&gt;Bebida Gelada.&lt;/strong&gt;&lt;/p&gt;\r\n&lt;p&gt;300 ml de leite, sorvete, nutella, calda de chocolate e chantilly.&lt;/p&gt;\r\n&lt;p&gt;Tempo de preparo &amp;eacute; de 10 minutos.&lt;/p&gt;', 'upload/2018/09/20/387d9ee0c6f8b20f66a70614dac1d435.jpg', 22, 1, '', 0, 0, 1, NULL, '', NULL, NULL, NULL),
(64, 'Chocolate Quente Tradicional', 8.50, '&lt;p&gt;&lt;strong&gt;Bebida quente.&lt;/strong&gt;&lt;/p&gt;\r\n&lt;p&gt;200ml de leite, chocolate especial em p&amp;oacute;, a&amp;ccedil;&amp;uacute;car, baunilha, creme de leite, marshmallow e chantilly.&lt;/p&gt;\r\n&lt;p&gt;A&amp;ccedil;&amp;uacute;car, marshmallow e chantilly s&amp;atilde;o opcionais.&lt;/p&gt;\r\n&lt;p&gt;Tempo de preparo &amp;eacute; de 10 minutos.&lt;/p&gt;', 'upload/2018/09/19/9ad563ceddb1a347e0bee718cf3a2730.jpg', 22, 1, '', 0, 0, 1, NULL, '', NULL, NULL, NULL),
(65, 'Torta Holandesa Tradicional', 50.00, '&lt;p&gt;Base de bolacha, creme a base de manteiga, a&amp;ccedil;&amp;uacute;car e baunilha, ganache de chocolate ao leite.&lt;/p&gt;\r\n&lt;p&gt;Vendida por quilo.&lt;/p&gt;', 'upload/2018/09/20/f7deb5a6c0f37daafc609f531ec77a7f.jpg', 28, 1, '', 0, 0, 1, NULL, '', NULL, NULL, NULL),
(183, 'Cheesecake de Amora', 4.00, '&lt;p&gt;Base de bolacha de leite e mel, creme de queijo e gel&amp;eacute;ia de amora.&lt;/p&gt;', 'upload/2018/09/20/7c50cfa68e7d1d65e3740038958cd1cd.png', 25, 1, '', 0, 0, 1, NULL, '', NULL, NULL, NULL),
(75, 'Torta Trufada de Leite Ninho', 65.00, '&lt;p&gt;Base de bolacha, creme de leite ninho e chocolate amargo ao rum.&lt;/p&gt;', 'upload/2018/09/20/003da7db8e52b347267409c8615c3125.jpg', 28, 1, '', 1, 0, 1, NULL, '', NULL, NULL, NULL),
(176, 'Torta Charge (Por kg)', 65.00, '&lt;p&gt;Base de bolacha, doce de leite, creme a base de leite, creme de amendoim da casa, ganacha de chocolate amargo e amendoim.&lt;/p&gt;\r\n&lt;p&gt;Vendida por quilo.&lt;/p&gt;', 'upload/2018/09/19/0d4a4f4b27ec6535382848dad970e029.jpg', 28, 1, '', 0, 0, 1, NULL, '', NULL, NULL, NULL),
(174, 'BLT', 7.90, '&lt;p&gt;P&amp;atilde;o franc&amp;ecirc;s tostado, maionese da casa, 100 gr de bacon cozido por 44 horas, alface e tomate.&lt;/p&gt;\r\n&lt;p&gt;Tempo de preparo &amp;eacute; de 10 a 15 minutos.&lt;/p&gt;', 'upload/2018/09/19/66cb1150062b068cc1514b53a8d5ad18.jpg', 27, 1, '', 1, 1, 1, NULL, '', NULL, NULL, NULL),
(175, 'Café Brutus', 19.50, '&lt;p&gt;100 gr de bacon fatiado, ovos mexidos, 2 torradas, 3 panquecas, mel e 200 ml de suco de laranja.&lt;/p&gt;\r\n&lt;p&gt;10 a 20 minutos de preparo.&lt;/p&gt;', 'upload/2018/09/19/5ac656305f4dfe259e0c5a5bf859fe6d.jpg', 38, 1, '', 1, 0, 1, NULL, '', NULL, NULL, NULL),
(168, 'Sanduíche Toscana', 12.90, '&lt;p&gt;P&amp;atilde;o franc&amp;ecirc;s, lingui&amp;ccedil;a toscana, mix de queijos e pasta de alho.&lt;/p&gt;\r\n&lt;p&gt;Tempo de preparo de 10 a 15 minutos.&lt;/p&gt;', 'upload/2018/09/18/79775d3b67b2829fafacf59089039bff.jpg', 27, 1, '', 0, 1, 1, NULL, '', NULL, NULL, NULL),
(82, 'Empanada de Queijo e Tomate', 4.25, '&lt;p&gt;&lt;strong&gt;SALGADO ASSADO&lt;/strong&gt;&lt;br /&gt;Todos os produtos s&amp;atilde;o preparados na hora.&lt;br /&gt;Caso o sabor desejado n&amp;atilde;o esteja dispon&amp;iacute;vel no expositor, solicite a&amp;nbsp;sua atendente que o mesmo ser&amp;aacute; preparado.&lt;br /&gt;O tempo de espera &amp;eacute; de 5 minutos, dependendo do movimento e do tipo de salgado solicitado.&lt;/p&gt;', 'upload/2018/09/18/b976e0138c2a15f42c42f5f2fd48f935.jpg', 26, 1, '', 0, 0, 1, NULL, '', NULL, NULL, NULL),
(83, 'Empanada de Queijo com Alho Poró', 4.25, '&lt;p&gt;&lt;strong&gt;SALGADO ASSADO&lt;/strong&gt;&lt;br /&gt;Todos os produtos s&amp;atilde;o preparados na hora.&lt;br /&gt;Caso o sabor desejado n&amp;atilde;o esteja dispon&amp;iacute;vel no expositor, solicite a&amp;nbsp;sua atendente que o mesmo ser&amp;aacute; preparado.&lt;br /&gt;O tempo de espera &amp;eacute; de 5 minutos, dependendo do movimento e do tipo de salgado solicitado.&lt;/p&gt;', 'upload/2018/09/18/b57b6fdc5d6b0c8045661aab6d2e834f.jpg', 26, 1, '', 0, 0, 1, NULL, '', NULL, NULL, NULL),
(84, 'Empanada de Palmito', 4.25, '&lt;p&gt;&lt;strong&gt;SALGADO ASSADO&lt;/strong&gt;&lt;br /&gt;Todos os produtos s&amp;atilde;o preparados na hora.&lt;br /&gt;Caso o sabor desejado n&amp;atilde;o esteja dispon&amp;iacute;vel no expositor, solicite a&amp;nbsp;sua atendente que o mesmo ser&amp;aacute; preparado.&lt;br /&gt;O tempo de espera &amp;eacute; de 5 minutos, dependendo do movimento e do tipo de salgado solicitado.&lt;/p&gt;', 'upload/2018/09/18/7ab873b6049becbad33bb4cf7310fa37.jpg', 26, 1, '', 0, 0, 1, NULL, '', NULL, NULL, NULL),
(85, 'Empanada de 3 Queijos', 4.50, '&lt;p&gt;&lt;strong&gt;SALGADO ASSADO&lt;/strong&gt;&lt;br /&gt;Todos os produtos s&amp;atilde;o preparados na hora.&lt;br /&gt;Caso o sabor desejado n&amp;atilde;o esteja dispon&amp;iacute;vel no expositor, solicite a&amp;nbsp;sua atendente que o mesmo ser&amp;aacute; preparado.&lt;br /&gt;O tempo de espera &amp;eacute; de 5 minutos, dependendo do movimento e do tipo de salgado solicitado.&lt;/p&gt;', 'upload/2018/09/18/657fdf32a4131b8eeba58e7012658590.jpg', 26, 1, '', 0, 0, 1, NULL, '', NULL, NULL, NULL),
(86, 'Quiche de 3 Queijos', 9.90, '&lt;p&gt;&lt;strong&gt;SALGADO ASSADO&lt;/strong&gt;&lt;br /&gt;Todos os produtos s&amp;atilde;o preparados na hora.&lt;br /&gt;Caso o sabor desejado n&amp;atilde;o esteja dispon&amp;iacute;vel no expositor, solicite a&amp;nbsp;sua atendente que o mesmo ser&amp;aacute; preparado.&lt;br /&gt;O tempo de espera &amp;eacute; de 10 a 30 minutos, dependendo do movimento e do tipo de salgado solicitado.&lt;/p&gt;', 'upload/2018/03/07/5bc6f3e54b6a4373c66f9756508cbc4e.jpg', 26, 1, '', 0, 0, 1, NULL, '', NULL, NULL, NULL),
(87, 'Quiche de Frango', 9.90, '&lt;p&gt;&lt;strong&gt;SALGADO ASSADO&lt;/strong&gt;&lt;br /&gt;Todos os produtos s&amp;atilde;o preparados na hora.&lt;br /&gt;Caso o sabor desejado n&amp;atilde;o esteja dispon&amp;iacute;vel no expositor, solicite a&amp;nbsp;sua atendente que o mesmo ser&amp;aacute; preparado.&lt;br /&gt;O tempo de espera &amp;eacute; de 10 a 30 minutos, dependendo do movimento&amp;nbsp;e do tipo de salgado solicitado.&lt;/p&gt;', 'upload/2018/03/07/55891cf4a36d064fbd1ff786da5b73a6.jpg', 26, 1, '', 0, 0, 1, NULL, '', NULL, NULL, NULL),
(88, 'Quiche de Alho Poró', 9.90, '&lt;p&gt;&lt;strong&gt;SALGADO ASSADO&lt;/strong&gt;&lt;br /&gt;Todos os produtos s&amp;atilde;o preparados na hora.&lt;br /&gt;Caso o sabor desejado n&amp;atilde;o esteja dispon&amp;iacute;vel no expositor, solicite a&amp;nbsp;sua atendente que o mesmo ser&amp;aacute; preparado.&lt;br /&gt;O tempo de espera &amp;eacute; de 10 a 30 minutos, dependendo do movimento e do tipo de salgado solicitado.&lt;/p&gt;', 'upload/2018/09/20/e418ac5a7c2a7cc7fb1833a799023373.jpg', 26, 1, '', 0, 0, 1, NULL, '', NULL, NULL, NULL),
(169, 'Cheesecake de Chocolate', 9.90, '', 'upload/2018/09/18/c57fb4089a965753670321e191f13a80.jpg', 0, 1, '', 0, 0, 1, NULL, '', NULL, NULL, NULL),
(170, 'Prato Executivo com Frango', 14.90, '&lt;p&gt;Arroz, salada de alface, tomate e pepino, batatas fritas e 150 gramas de fil&amp;eacute; de frango.&lt;/p&gt;\r\n&lt;p&gt;O cliente poder&amp;aacute; tamb&amp;eacute;m optar por fil&amp;eacute; mignon.&lt;/p&gt;\r\n&lt;p&gt;Tempo de preparo &amp;eacute; de 15 minutos.&lt;/p&gt;', 'upload/2018/09/19/ae98c8b981329066b50fcfd633ddfea7.jpg', 37, 1, '', 1, 1, 1, NULL, '', NULL, NULL, NULL),
(171, 'Canolli de Ricota', 3.50, '&lt;p&gt;Massa doce frita produzida pela Delion com um creme de ricota, a&amp;ccedil;&amp;uacute;car e canela.&lt;/p&gt;', 'upload/2018/09/19/9d8e6ebe449ab1a19ef26da3a15d5acf.jpg', 25, 1, '', 1, 1, 1, NULL, '', NULL, NULL, NULL),
(172, 'Canolli de Doce de Leite', 3.50, '&lt;p&gt;Massa doce frita produzida pela Delion com doce de leite produzido pela Delion.&lt;/p&gt;', 'upload/2018/09/19/42fe1d738de1228ba161a526a609a693.jpg', 25, 1, '', 0, 1, 1, NULL, '', NULL, NULL, NULL),
(91, 'Pão de Queijo (Por kg)', 17.50, '&lt;p&gt;&lt;strong&gt;O p&amp;atilde;o de queijo &amp;eacute; vendido por quilo.&lt;/strong&gt;&lt;/p&gt;\r\n&lt;p&gt;Caso n&amp;atilde;o esteja dispon&amp;iacute;vel no expositor, solicite a&amp;nbsp;sua atendente que o mesmo ser&amp;aacute; preparado.&lt;br /&gt;O tempo de espera &amp;eacute; de 20 minutos, para assar.&lt;/p&gt;', 'upload/2018/09/14/017f219788eade7b2c5803ed6d715368.jpg', 26, 1, '', 0, 0, 1, NULL, '', NULL, NULL, NULL),
(92, 'Risole de Carne com Ovos', 4.50, '&lt;p&gt;&lt;strong&gt;SALGADO FRITO&lt;/strong&gt;&lt;/p&gt;\r\n&lt;p&gt;Risoles de carne com ovos.&lt;/p&gt;\r\n&lt;p&gt;Caso&amp;nbsp; n&amp;atilde;o esteja dispon&amp;iacute;vel no expositor, solicite a&amp;nbsp;sua atendente que o mesmo ser&amp;aacute; preparado.&lt;/p&gt;\r\n&lt;p&gt;O tempo de espera &amp;eacute; de 15 minutos.&lt;/p&gt;\r\n&lt;p&gt;se a fritadeira j&amp;aacute; estiver ligada o tempo de fritar &amp;eacute; de 5 minutos.&lt;/p&gt;', 'upload/2018/09/14/9efd1e615286fd38e803fb78231b1708.jpg', 26, 1, '', 0, 1, 1, NULL, '', NULL, NULL, NULL),
(93, 'Coxinha de Frango ', 4.50, '&lt;p&gt;&lt;strong&gt;SALGADO FRITO&lt;/strong&gt;&lt;/p&gt;\r\n&lt;p&gt;Coxinha de Frango com catup&amp;iacute;ry.&lt;/p&gt;\r\n&lt;p&gt;Caso&amp;nbsp; n&amp;atilde;o esteja dispon&amp;iacute;vel no expositor, solicite a&amp;nbsp;sua atendente que o mesmo ser&amp;aacute; preparado.&lt;/p&gt;\r\n&lt;p&gt;O tempo de espera &amp;eacute; de 15 minutos.&lt;/p&gt;\r\n&lt;p&gt;se a fritadeira j&amp;aacute; estiver ligada o tempo de fritar &amp;eacute; de 5 minutos.&lt;/p&gt;', 'upload/2018/09/18/cd83b5bd8f7b504cc773a526e6f50b28.jpg', 26, 1, '', 0, 1, 1, NULL, '', NULL, NULL, NULL),
(95, 'Empanada Frita de Carne com Ovos e Azeitona', 4.50, '&lt;p&gt;&lt;strong&gt;Salgado Assado.&lt;/strong&gt;&lt;/p&gt;\r\n&lt;p&gt;Todos os produtos s&amp;atilde;o preparados na hora.&lt;br /&gt;Caso o sabor desejado n&amp;atilde;o esteja dispon&amp;iacute;vel no expositor, solicite a&amp;nbsp;sua atendente que o mesmo ser&amp;aacute; preparado.&lt;br /&gt;O tempo de espera &amp;eacute; de 5 minutos, dependendo do movimento.&lt;/p&gt;', 'upload/2018/09/18/35943db64be55a93ff2d492149279f4b.jpg', 26, 1, '', 0, 0, 1, NULL, '', NULL, NULL, NULL),
(158, 'Empanada de Queijo, Presunto e Orégano', 4.25, '&lt;p&gt;&lt;strong&gt;SALGADO ASSADO&lt;/strong&gt;&lt;/p&gt;\r\n&lt;p&gt;Todos os produtos s&amp;atilde;o preparados na hora.&lt;br /&gt;Caso o sabor desejado n&amp;atilde;o esteja dispon&amp;iacute;vel no expositor, solicite a&amp;nbsp;sua atendente que o mesmo ser&amp;aacute; preparado.&lt;br /&gt;O tempo de espera &amp;eacute; de 5 minutos, dependendo do movimento e do tipo de salgado solicitado.&lt;/p&gt;', 'upload/2018/09/18/37bcadb1046f2a22d07e1ac1dc9efc0c.jpg', 26, 1, '', 0, 0, 1, NULL, '', NULL, NULL, NULL),
(96, 'Café Americano', 11.50, '&lt;p&gt;Duas torradas com manteiga, ovos mexidos e 100 gramas de bacon.&lt;/p&gt;\r\n&lt;p&gt;10 a 20 minutos &amp;eacute; o tempo de preparo.&lt;/p&gt;', 'upload/2018/09/18/a31ae908d944190a88e909b153f34995.jpg', 38, 1, '', 0, 0, 1, NULL, '', NULL, NULL, NULL),
(97, 'Café Americano Light', 11.50, '&lt;p&gt;Duas torradas com manteiga, ovos mexidos e caf&amp;eacute; com leite.&lt;/p&gt;\r\n&lt;p&gt;10 a 20 minutos &amp;eacute; o tempo de preparo.&lt;/p&gt;', 'upload/2018/09/19/1c914cad5f7a051b9af6ef200762a2da.jpg', 38, 1, '', 0, 0, 1, NULL, '', NULL, NULL, NULL),
(98, 'Pão na Chapa', 2.00, '&lt;p&gt;P&amp;atilde;o franc&amp;ecirc;s com manteiga na chapa.&lt;/p&gt;\r\n&lt;p&gt;tempo de preparo &amp;eacute; de 5 a 10 minutos&lt;/p&gt;', 'upload/2018/09/20/13ef44b0fbd39b6a5a79b3976e9ca0c1.jpg', 27, 1, '', 0, 1, 1, NULL, '', NULL, NULL, NULL),
(99, 'Misto Quente', 5.50, '&lt;p&gt;P&amp;atilde;o franc&amp;ecirc;s, manteiga, 2 fatias de queijo prato e 2 fatias de presunto.&lt;/p&gt;\r\n&lt;p&gt;Tempo de preparo &amp;eacute; de 5 a 10 minutos.&lt;/p&gt;', 'upload/2018/09/19/81f3e9354f3cf278ea6e58420e787f38.jpg', 27, 1, '', 0, 1, 1, NULL, '', NULL, NULL, NULL),
(100, 'Queijo Quente', 6.00, '&lt;p&gt;P&amp;atilde;o franc&amp;ecirc;s, queijo prato, queijo gouda, queijo parmes&amp;atilde;o e queijo provolone.&lt;/p&gt;\r\n&lt;p&gt;Tempo de preparo &amp;eacute; de 5 a 10 minutos.&lt;/p&gt;', 'upload/2018/09/14/ae82d34c9702b0184e4d76455b7808f6.jpg', 27, 1, '', 0, 1, 1, NULL, '', NULL, NULL, NULL),
(101, 'Bauru', 6.00, '&lt;p&gt;P&amp;atilde;o franc&amp;ecirc;s, manteiga, 2 fatias de queijo prato, 2 fatias de presunto e tomate.&lt;/p&gt;\r\n&lt;p&gt;Tempo de preparo &amp;eacute; de 5 a 10 minutos.&lt;/p&gt;', 'upload/2018/03/09/a4e3108bfda162b2389a9ead592b1134.jpg', 27, 1, '', 0, 1, 1, NULL, '', NULL, NULL, NULL),
(102, 'Pão com Ovo', 8.00, '&lt;p&gt;P&amp;atilde;o franc&amp;ecirc;s tostado, com ovos e ervas.&lt;/p&gt;\r\n&lt;p&gt;Tempo de preparo &amp;eacute; de 5 a 10 minutos.&lt;/p&gt;', 'upload/2018/09/20/d5853a0e8af4606260699656bf93088f.png', 27, 1, '', 0, 0, 1, NULL, '', NULL, NULL, NULL),
(103, 'Pão com Omelete', 9.00, '&lt;p&gt;P&amp;atilde;o franc&amp;ecirc;s tostado com omelete.&lt;/p&gt;\r\n&lt;p&gt;Tempo de preparo &amp;eacute; de 5 a 10 minutos.&lt;/p&gt;', 'upload/2018/09/20/8fce6de6ef42d2ac3761b5b79c20d78b.png', 27, 1, '', 0, 0, 1, NULL, '', NULL, NULL, NULL),
(181, 'Sanduíche de Linguiça Apimentada', 14.90, '&lt;p&gt;Pao baguete tostado, requeij&amp;atilde;o, 2 lingui&amp;ccedil;as apimentadas, cebola e piment&amp;atilde;o salteado na manteiga e pimenta do reino e queijo prato.&lt;/p&gt;\r\n&lt;p&gt;Tempo de preparo &amp;eacute; de 10 a 15 minutos.&lt;/p&gt;', 'upload/2018/09/20/507bf4a0e0ac9c3e05142eafd2bc93af.jpg', 27, 1, '', 1, 1, 1, NULL, '', NULL, NULL, NULL),
(182, 'Cheesecake de Oreo com Negresco.', 4.00, '&lt;p&gt;Base de bolacha oreo, creme de oreo e cobertura de negresco.&lt;/p&gt;', 'upload/2018/09/20/e6eb3df81bd69b3df61e3fd8e097360a.jpg', 25, 1, '', 0, 0, 1, NULL, '', NULL, NULL, NULL),
(107, 'Mortadela Tradicional', 12.90, '&lt;p&gt;P&amp;atilde;o franc&amp;ecirc;s, bacon fatiado, 75 gramas de mortadela Ceratti, maionese, queijo e molho especial.&lt;/p&gt;\r\n&lt;p&gt;Tempo de preparo &amp;eacute; de 10 a 15 minutos.&lt;/p&gt;', 'upload/2018/09/14/0c1b475f2fcad9a533aaf2e3ebf59fd7.jpg', 27, 1, '', 0, 1, 1, NULL, '', NULL, NULL, NULL),
(108, 'Linguiça Defumada', 14.90, '&lt;p&gt;P&amp;atilde;o franc&amp;ecirc;s, maionese de salsa, bacon fatiado e lingui&amp;ccedil;a defumada.&lt;/p&gt;\r\n&lt;p&gt;Tempo de preparo &amp;eacute; de 10 a 15minutos.&lt;/p&gt;', 'upload/2018/09/14/6c8b1a6fbf322c9e8507e947a0568744.jpg', 27, 1, '', 0, 1, 1, NULL, '', NULL, NULL, NULL),
(109, 'Sanduíche Mignon', 16.90, '&lt;p&gt;&amp;nbsp;Pao tostado, 100 gr de mignon e molho especial de parmesao&lt;/p&gt;\r\n&lt;p&gt;Tempo de preparo &amp;eacute; de 5 a 10 minutos.&lt;/p&gt;', 'upload/2018/09/20/4a35f74ed635ad96497cc69c1f13c021.jpg', 27, 1, '', 1, 1, 1, NULL, '', NULL, NULL, NULL),
(179, 'Milkshake de Morango', 14.50, '&lt;p&gt;&lt;strong&gt;Bebida gelada.&lt;/strong&gt;&lt;/p&gt;\r\n&lt;p&gt;300 ml de leite, sorvete, morango, calda de morango e chantilly.&lt;/p&gt;\r\n&lt;p&gt;Tempo de preparo &amp;eacute; de 10 minutos.&lt;/p&gt;', 'upload/2018/09/20/8b91ca66171f6c78f591c02e0ecfc6ce.png', 22, 1, '', 0, 0, 1, NULL, '', NULL, NULL, NULL),
(180, 'Milkshake de Amendoim (360 ml)', 14.50, '&lt;p&gt;&lt;strong&gt;Bebida gelada.&lt;/strong&gt;&lt;/p&gt;\r\n&lt;p&gt;300 ml de leite, sorvete, amendoim, calda de caramelo e chantilly.&lt;/p&gt;\r\n&lt;p&gt;Tempo de preparo &amp;eacute; de 10 minutos.&lt;/p&gt;', 'upload/2018/09/20/de1cab1514cc9a50a5a55da62e6448e1.jpg', 22, 1, '', 0, 0, 1, '[]', '', NULL, NULL, NULL),
(111, 'Vegetariano', 7.00, '&lt;p&gt;P&amp;atilde;o de forma, tomate, alface, cebola, alho-por&amp;oacute;, queijo branco e or&amp;eacute;gano.&lt;/p&gt;\r\n&lt;p&gt;Tempo de preparo &amp;eacute; de 5 a 10 minutos.&lt;/p&gt;', 'upload/2018/09/20/a7966903545e3ae09a60bd899dc8aca6.png', 27, 1, '', 0, 1, 1, NULL, '', NULL, NULL, NULL),
(173, 'Cueca Virada (Por kg)', 20.00, '&lt;p&gt;Massa feita a base de farinha e ovos, frita e polvilhada com a&amp;ccedil;&amp;uacute;car.&lt;/p&gt;\r\n&lt;p&gt;Vendida por quilo.&lt;/p&gt;', 'upload/2018/09/19/942b3224ff17e9e76beaf1e0bbc54ee6.jpg', 25, 1, '', 0, 1, 1, NULL, '', NULL, NULL, NULL),
(117, 'Cheesecake de Amendoim', 4.00, '&lt;p&gt;Base de negresco, creme de amendoim e ganache de chocolate ao leite.&lt;/p&gt;', 'upload/2018/09/20/9ceaac561793d249f0d2c511d2b371f2.jpg', 25, 1, '', 0, 0, 1, NULL, '', NULL, NULL, NULL),
(177, 'Torta Negra (por KG)', 65.00, '&lt;p&gt;Massa de brownie, creme de avel&amp;atilde;, cereja, creme de nata.&lt;/p&gt;\r\n&lt;p&gt;Vendida por quilo.&lt;/p&gt;', 'upload/2018/09/19/ae1bb018a005da452723fa3e44346439.png', 28, 1, '', 1, 0, 1, NULL, '', NULL, NULL, NULL),
(119, 'Palha Italiana de Chocolate (Por kg)', 40.00, '&lt;p&gt;Massa de brigadeiro, com chococolate especial e bolacha de leite e mel.&lt;/p&gt;\r\n&lt;p&gt;Vendida por quilo.&lt;/p&gt;', 'upload/2018/09/19/6c7236cd11e5613a894190c0f083c439.jpg', 25, 1, '', 0, 1, 1, NULL, '', NULL, NULL, NULL),
(120, 'Palha Italiana de Leite Ninho ', 45.00, '&lt;p&gt;Massa de brigadeiro de leite ninho com bolacha de leite e mel.&lt;/p&gt;\r\n&lt;p&gt;Vendida por quilo.&lt;/p&gt;', 'upload/2018/09/19/12b1cd8d3d288885fb37127b95dadfa7.jpg', 25, 1, '', 0, 1, 1, NULL, '', NULL, NULL, NULL),
(122, 'Cookies (Por kg)', 45.00, '&lt;p&gt;Massa a base de a&amp;ccedil;ucar mascavo, manteiga, ovos e farinha, com gotas de chocolate ao leite.&lt;/p&gt;\r\n&lt;p&gt;Vendido por quilo.&lt;/p&gt;', 'upload/2018/09/18/a62080801f146046010746ff8ca14910.jpg', 25, 1, '', 0, 0, 1, NULL, '', NULL, NULL, NULL),
(123, 'Bolo Molhado de Chocolate Preto', 7.50, '', 'upload/2018/09/14/d065c8c96125e579f93df2bdfe381015.jpg', 23, 1, '', 0, 0, 1, NULL, '', NULL, NULL, NULL),
(124, 'Bolo Molhado de Chocolate Branco', 8.50, '', 'upload/2018/02/16/71b249fd15f261a8918a45ab8004ef77.png', 23, 1, '', 0, 0, 1, NULL, '', NULL, NULL, NULL),
(125, 'Bolo de Cenoura (Por kg)', 35.00, '&lt;p&gt;Vendido por quilo.&lt;/p&gt;', 'upload/2018/02/16/29531701fcc9c5a2a1a1a089af10fccd.png', 23, 1, '', 0, 0, 1, NULL, '', NULL, NULL, NULL),
(126, 'Bolo de Iogurte (Por kg)', 30.00, '&lt;p&gt;Vendido por quilo.&lt;/p&gt;', 'upload/2018/09/14/aa2eef3daf101bf16d1ac9045b63e230.png', 23, 1, '', 0, 0, 1, NULL, '', NULL, NULL, NULL),
(127, 'Bolo de Milho (Por kg)', 30.00, '&lt;p&gt;Vendido por quilo.&lt;/p&gt;', 'upload/2018/09/14/db180e4453384e3f88c59295faefadea.png', 23, 1, '', 0, 0, 1, NULL, '', NULL, NULL, NULL),
(128, 'Sonho de Doce de Leite', 4.50, '&lt;p&gt;Massa a base de farinha, ovos e leite, frita e recheada com doce de leite da casa.&lt;/p&gt;\r\n&lt;p&gt;Polvilhado com a&amp;ccedil;&amp;uacute;car confeiteiro.&lt;/p&gt;', 'upload/2018/09/19/f94497fdc0ae1aeedf6d87f42c60f8dd.png', 25, 1, '', 0, 1, 1, NULL, '', NULL, NULL, NULL),
(129, 'Sonho de Nutella', 4.50, '&lt;p&gt;Massa a base de farinha, ovos e leite, frita e recheada com nutella.&lt;/p&gt;\r\n&lt;p&gt;Polvilhado com a&amp;ccedil;&amp;uacute;car confeiteiro.&lt;/p&gt;', 'upload/2018/09/19/0b07bd7fe5c9226b69b4fe12344ff46e.jpg', 25, 1, '', 0, 1, 1, NULL, '', NULL, NULL, NULL),
(131, 'Carolina de Doce de Leite (Por kg)', 35.00, '&lt;p&gt;Massa choux, recheado com doce de leite da casa e ganache de chocolate ao leite.&lt;/p&gt;\r\n&lt;p&gt;Vendida por quilo.&lt;/p&gt;', 'upload/2018/09/19/3352fc04184f96c538d1192426c5fef1.jpg', 25, 1, '', 0, 1, 1, NULL, '', NULL, NULL, NULL),
(133, 'Suco de Laranja', 7.50, '&lt;p&gt;&lt;strong&gt;Bebida Gelada.&lt;/strong&gt;&lt;/p&gt;\r\n&lt;p&gt;Suco natural de laranja, agua e gelo.&lt;/p&gt;\r\n&lt;p&gt;Tempo de preparo &amp;eacute; de 10 minutos.&lt;/p&gt;', 'upload/2018/09/19/dbae2b05a8dd20b2173d8a4dee4c1ff6.jpg', 22, 1, '', 0, 0, 1, NULL, '', NULL, NULL, NULL),
(134, 'Água Mineral ', 2.25, '&lt;p&gt;&lt;strong&gt;500 ml&lt;/strong&gt;&lt;/p&gt;', 'upload/2018/09/19/e7b915e426b628100b6eb2c5d24062ac.png', 22, 1, '', 0, 1, 1, NULL, '', NULL, NULL, NULL),
(135, 'Água Mineral com Gás', 2.50, '&lt;p&gt;&lt;strong&gt;500 ml&lt;/strong&gt;&lt;/p&gt;', 'upload/2018/09/19/02a3de42ea903e42ed9e984a1b6fab60.png', 22, 1, '', 0, 1, 1, NULL, '', NULL, NULL, NULL),
(136, 'Coca-Cola', 3.50, '&lt;p&gt;&lt;strong&gt;Lata&lt;/strong&gt;&lt;/p&gt;\r\n&lt;p&gt;&amp;nbsp;&lt;/p&gt;', 'upload/2018/09/18/0419e93b4b0fdffe06c619cd545adfbb.png', 22, 1, '', 0, 1, 1, NULL, '', NULL, NULL, NULL),
(137, 'Fanta Laranja ', 3.50, '&lt;p&gt;&lt;strong&gt;Lata&lt;/strong&gt;&lt;/p&gt;', 'upload/2018/09/19/ffbc57c3acdfdd1e012872a1a18ef652.jpg', 22, 1, '', 0, 1, 1, NULL, '', NULL, NULL, NULL),
(138, 'Sprite', 3.50, '&lt;p&gt;&lt;strong&gt;Lata&lt;/strong&gt;&lt;/p&gt;', 'upload/2018/09/19/eb5e28746e391e2430dd9425a62e37b4.jpg', 22, 1, '', 0, 0, 1, NULL, '', NULL, NULL, NULL),
(139, 'Guaraná Antártica ', 3.50, '&lt;p&gt;&lt;strong&gt;Lata&lt;/strong&gt;&lt;/p&gt;', 'upload/2018/09/19/bd6d6d4958297e3b88f1c7e34c590a7a.png', 22, 1, '', 0, 1, 1, NULL, '', NULL, NULL, NULL),
(140, 'Soda Limonada', 3.50, '&lt;p&gt;&lt;strong&gt;Lata&lt;/strong&gt;&lt;/p&gt;', 'upload/2018/09/19/a15e87b37cb1df71e4e376cf28ca1d54.jpg', 22, 1, '', 0, 0, 1, NULL, '', NULL, NULL, NULL),
(141, 'Água Tônica Schweppes ', 3.75, '&lt;p&gt;&lt;strong&gt;Lata&lt;/strong&gt;&lt;/p&gt;', 'upload/2018/09/19/96b69f44c462aa55be8c7556d3cf2956.png', 22, 1, '', 0, 1, 1, NULL, '', NULL, NULL, NULL),
(142, 'Schweppes Citrus ', 3.75, '&lt;p&gt;&lt;strong&gt;Lata&lt;/strong&gt;&lt;/p&gt;', 'upload/2018/09/18/e09fe69d86d23f28a9755a4e7ac59976.png', 22, 1, '', 0, 0, 1, NULL, '', NULL, NULL, NULL),
(143, 'Coca-Cola - Zero', 3.75, '&lt;p&gt;&lt;strong&gt;Lata&lt;/strong&gt;&lt;/p&gt;', 'upload/2018/11/20/a73920139b9b7a80c3d69d709d800c42.png', 22, 1, '', 0, 1, 1, NULL, '', NULL, NULL, NULL),
(144, 'Fanta Laranja - Zero', 3.75, '&lt;p&gt;&lt;strong&gt;Lata&lt;/strong&gt;&lt;/p&gt;', 'upload/2018/09/19/b68d903543ce373ec84c73aa6b863fce.jpg', 22, 1, '', 0, 1, 1, NULL, '', NULL, NULL, NULL),
(145, 'Sprite  - Zero', 3.75, '&lt;p&gt;&lt;strong&gt;Lata&lt;/strong&gt;&lt;/p&gt;', 'upload/2018/09/19/4263993b05281aaacc220d5dcfdc4880.jpg', 22, 1, '', 0, 0, 1, NULL, '', NULL, NULL, NULL),
(146, 'Guaraná Antártica - Zero', 3.75, '&lt;p&gt;&lt;strong&gt;Lata&lt;/strong&gt;&lt;/p&gt;', 'upload/2018/09/19/8e02d9af849e266e4e768157cf9d8856.jpg', 22, 1, '', 0, 1, 1, NULL, '', NULL, NULL, NULL),
(147, 'Soda Limonada - Zero', 3.75, '&lt;p&gt;&lt;strong&gt;Lata&lt;/strong&gt;&lt;/p&gt;', 'upload/2018/09/19/9dc95ab7ab5ee7f7ea9b56be0bf152d8.jpg', 22, 1, '', 0, 0, 1, NULL, '', NULL, NULL, NULL),
(148, 'Café Caramelo', 6.50, '&lt;p&gt;&lt;strong&gt;Bebida gelada.&lt;br /&gt;&lt;br /&gt;&lt;/strong&gt;300 ml de leite, 1 shot de caf&amp;eacute;, aromatizante de caramelo e a&amp;ccedil;&amp;uacute;car mascavo.&lt;/p&gt;\r\n&lt;p&gt;Batido no liquidificador.&lt;/p&gt;\r\n&lt;p&gt;Tempo de preparo &amp;eacute; de 10 minutos.&lt;/p&gt;', 'upload/2018/03/07/c628627b632188418732e03c8b3aef53.jpg', 22, 1, '', 0, 0, 1, NULL, '', NULL, NULL, NULL),
(149, 'Deppuccino de Coco', 9.00, '&lt;p&gt;&lt;strong&gt;Bebida gelada.&lt;/strong&gt;&lt;/p&gt;\r\n&lt;p&gt;100 ml leite de coco, 1 shot de caf&amp;eacute;, calda de chocolate, coco ralado, gelo e chantilly.&lt;/p&gt;\r\n&lt;p&gt;Batido no liquidificador.&lt;/p&gt;\r\n&lt;p&gt;Tempo de preparo &amp;eacute; de 10 minutos.&lt;/p&gt;', 'upload/2018/09/19/1dfa3a11578a1b5ce692a98474b37e5d.png', 22, 1, '', 0, 0, 1, NULL, '', NULL, NULL, NULL),
(150, 'Café com Leite Gelado', 5.00, '&lt;p&gt;&lt;strong&gt;Bebida gelada.&lt;/strong&gt;&lt;/p&gt;\r\n&lt;p&gt;150 ml de leite, 1 shot de caf&amp;eacute;, a&amp;ccedil;&amp;uacute;car mascavo e gelo.&lt;/p&gt;\r\n&lt;p&gt;Tempo de preparo &amp;eacute; de 10 minutos.&lt;/p&gt;', 'upload/2018/09/19/a76924a1e41dbb50e80dc6d17954e84c.jpg', 22, 1, '', 0, 0, 1, NULL, '', NULL, NULL, NULL),
(151, 'Cappuccino de Chocolate (200ml)', 6.50, '&lt;p&gt;&lt;strong&gt;Bebida quente.&lt;/strong&gt;&lt;/p&gt;\r\n&lt;p&gt;Chocolate em p&amp;oacute;, 1 shot de expresso e partes iguais de leite vaporizado e espuma do leite.&lt;/p&gt;\r\n&lt;p&gt;Pode ser acrescentado chantilly como na foto.&lt;/p&gt;\r\n&lt;p&gt;Tempo de preparo &amp;eacute; de 5 minutos.&lt;/p&gt;', 'upload/2018/09/19/1f13e21bb0e670c2a163713a010e88c9.png', 22, 1, '', 0, 0, 1, NULL, '', NULL, NULL, NULL),
(152, 'Café Irlandês ', 8.50, '&lt;p&gt;&lt;strong&gt;Bebida Alco&amp;oacute;lica&lt;/strong&gt;&lt;/p&gt;\r\n&lt;p&gt;150 ml de leite vaporizado, 1 shot de expresso e 1 shot de whisky e espuma de leite.&lt;/p&gt;\r\n&lt;p&gt;Tempo de preparo &amp;eacute; de 5 minutos.&lt;/p&gt;', 'upload/2018/09/18/583f15d69b35c86b0c84e740915e7507.jpg', 22, 1, '', 0, 0, 1, NULL, '', NULL, NULL, NULL),
(153, 'Chá Verde com Hortelã', 3.50, '&lt;p&gt;&lt;strong&gt;Ch&amp;aacute; Quente&lt;/strong&gt;&lt;/p&gt;\r\n&lt;p&gt;Tempo de preparo &amp;eacute; de 5 minutos.&lt;/p&gt;', 'upload/2018/09/20/d80fdc1b9a835d0a9d0c48eb678ef226.jpg', 22, 1, '', 0, 0, 1, NULL, '', NULL, NULL, NULL),
(154, 'Milkshake Amendoin (360ml)', 14.50, '', 'upload/2018/09/14/e76892f85a2a84df0493a632a0ad5156.png', 0, 1, '', 0, 0, 1, NULL, '', NULL, NULL, NULL),
(155, 'Empanada de Carne com Ovos', 4.00, '&lt;p&gt;&lt;strong&gt;SALGADO ASSADO&lt;/strong&gt;&lt;/p&gt;\r\n&lt;p&gt;Todos os produtos s&amp;atilde;o preparados na hora.&lt;br /&gt;Caso o sabor desejado n&amp;atilde;o esteja dispon&amp;iacute;vel no expositor, solicite a&amp;nbsp;sua atendente que o mesmo ser&amp;aacute; preparado.&lt;br /&gt;O tempo de espera &amp;eacute; de 5 minutos, dependendo do movimento e do tipo de salgado solicitado.&lt;/p&gt;', 'upload/2018/09/18/33681f64410336af177e656fce1b6d01.jpg', 26, 1, '', 0, 0, 1, NULL, '', NULL, NULL, NULL),
(156, 'Empanada de Frango', 4.00, '&lt;p&gt;&lt;strong&gt;SALGADO ASSADO&lt;/strong&gt;&lt;/p&gt;\r\n&lt;p&gt;Todos os produtos s&amp;atilde;o preparados na hora.&lt;br /&gt;Caso o sabor desejado n&amp;atilde;o esteja dispon&amp;iacute;vel no expositor, solicite a&amp;nbsp;sua atendente que o mesmo ser&amp;aacute; preparado.&lt;br /&gt;O tempo de espera &amp;eacute; de 5 minutos, dependendo do movimento e do tipo de salgado solicitado.&lt;/p&gt;', 'upload/2018/09/18/eebe6c77954410b8b279f4b04cf28969.jpg', 26, 1, '', 0, 0, 1, NULL, '', NULL, NULL, NULL),
(157, 'Empanada de Carne com Ovos e Uva Passas', 4.50, '&lt;p&gt;&lt;strong&gt;SALGADO ASSADO&lt;/strong&gt;&lt;/p&gt;\r\n&lt;p&gt;Todos os produtos s&amp;atilde;o preparados na hora.&lt;br /&gt;Caso o sabor desejado n&amp;atilde;o esteja dispon&amp;iacute;vel no expositor, solicite a&amp;nbsp;sua atendente que o mesmo ser&amp;aacute; preparado.&lt;br /&gt;O tempo de espera &amp;eacute; de 5 minutos, dependendo do movimento e do tipo de salgado solicitado.&lt;/p&gt;', 'upload/2018/09/18/a23dfc7e276f61aa9c2579494e80e631.jpg', 26, 1, '', 0, 0, 1, NULL, '', NULL, NULL, NULL),
(159, 'Quiche de Linguicinha', 9.90, '&lt;p&gt;&lt;strong&gt;SALGADO ASSADO&lt;/strong&gt;&lt;br /&gt;Todos os produtos s&amp;atilde;o preparados na hora.&lt;br /&gt;Caso o sabor desejado n&amp;atilde;o esteja dispon&amp;iacute;vel no expositor, solicite a&amp;nbsp;sua atendente que o mesmo ser&amp;aacute; preparado.&lt;br /&gt;O tempo de espera &amp;eacute; de 10 a 30 minutos, dependendo do movimento e do tipo de salgado solicitado.&lt;/p&gt;', 'upload/2018/09/18/c90411285847c64bac92cd9ca924dfcb.jpg', 26, 1, '', 0, 0, 1, NULL, '', NULL, NULL, NULL),
(160, 'Quiche de Espinafre com Ricota', 9.90, '&lt;p&gt;&lt;strong&gt;SALGADO ASSADO&lt;/strong&gt;&lt;br /&gt;Todos os produtos s&amp;atilde;o preparados na hora.&lt;br /&gt;Caso o sabor desejado n&amp;atilde;o esteja dispon&amp;iacute;vel no expositor, solicite a&amp;nbsp;sua atendente que o mesmo ser&amp;aacute; preparado.&lt;br /&gt;O tempo de espera &amp;eacute; de 10 a 30 minutos, dependendo do movimento e do tipo de salgado solicitado.&lt;/p&gt;', 'upload/2018/09/20/9e64c7efc952fd5e067f282c420d5c21.jpg', 26, 1, '', 0, 0, 1, NULL, '', NULL, NULL, NULL),
(163, 'Banoffe (Por kg)', 50.00, '&lt;p&gt;Massa a base de chocolate em p&amp;oacute; especial e manteiga, doce de leite da casa, banana, chantilly de leite ninho e calda de chocolate.&lt;/p&gt;', 'upload/2018/09/19/b123fb1011573a4b2b71ef4cb1432f3a.jpg', 25, 1, '', 0, 0, 1, NULL, '', NULL, NULL, NULL),
(164, 'Chocolate Quente Irlandês (200ml)', 9.50, '&lt;p&gt;&lt;strong&gt;Bebida quente.&lt;/strong&gt;&lt;/p&gt;\r\n&lt;p&gt;200ml de leite, chocolate especial em p&amp;oacute;, a&amp;ccedil;&amp;uacute;car, baunilha, creme de leite, 1 shot de whisky, marshmallow e chantilly.&lt;/p&gt;\r\n&lt;p&gt;Tempo de preparo &amp;eacute; de 10 minutos.&lt;/p&gt;', 'upload/2018/09/20/837e00c9fa7cfb16e243be904968362b.jpg', 22, 1, '', 0, 0, 1, NULL, '', NULL, NULL, NULL),
(165, 'Chocolate Quente com Leite de Coco (S/L 200ml)', 9.50, '&lt;p&gt;&lt;strong&gt;Bebida quente.&lt;/strong&gt;&lt;/p&gt;\r\n&lt;p&gt;200ml de leite de coco, chocolate especial em p&amp;oacute;, a&amp;ccedil;&amp;uacute;car, baunilha, creme de leite,&amp;nbsp; marshmallow e chantilly.&lt;/p&gt;\r\n&lt;p&gt;Tempo de preparo &amp;eacute; de 10 minutos.&lt;/p&gt;', 'upload/2018/09/20/573dc1d567b9938cd51036bf02f08e81.jpg', 22, 1, '', 0, 0, 1, NULL, '', NULL, NULL, NULL),
(166, 'Macarrão com Legumes e Frango', 13.90, '&lt;p&gt;Espaguete com frango, cebola, cenoura, piment&amp;atilde;o, alho-por&amp;oacute; e shoyo.&lt;/p&gt;\r\n&lt;p&gt;Acompanha um refrigerante ca&amp;ccedil;ulinha.&lt;/p&gt;\r\n&lt;p&gt;Tempo de preparo &amp;eacute; de 15 minutos.&lt;/p&gt;', 'upload/2018/09/19/ef31456ff8f92cd1e6bf925cb7ee8dbd.jpg', 37, 1, '', 0, 1, 1, NULL, '', NULL, NULL, NULL),
(184, 'Chá Mate de uva', 9.00, '&lt;p&gt;&lt;strong&gt;Bebida gelada.&lt;/strong&gt;&lt;/p&gt;\r\n&lt;p&gt;Ch&amp;aacute; mate, aromatizante de uva, leite condensado e gelo.&lt;/p&gt;\r\n&lt;p&gt;Batido no liquidificador.&lt;/p&gt;\r\n&lt;p&gt;Leite condensado &amp;eacute; opcional.&lt;/p&gt;\r\n&lt;p&gt;Tempo de preparo &amp;eacute; de 10 minutos.&lt;/p&gt;\r\n&lt;p&gt;&amp;nbsp;&lt;/p&gt;', 'upload/2018/09/20/1bb84c419a95b0e117b7c3302347fc1a.png', 22, 1, '', 0, 0, 1, NULL, '', NULL, NULL, NULL),
(185, 'Bolinha de 3 queijos.', 4.50, '&lt;p&gt;&lt;strong&gt;SALGADO FRITO&lt;/strong&gt;&lt;/p&gt;\r\n&lt;p&gt;Caso&amp;nbsp; n&amp;atilde;o esteja dispon&amp;iacute;vel no expositor, solicite a&amp;nbsp;sua atendente que o mesmo ser&amp;aacute; preparado.&lt;/p&gt;\r\n&lt;p&gt;O tempo de espera &amp;eacute; de 15 minutos.&lt;/p&gt;\r\n&lt;p&gt;se a fritadeira j&amp;aacute; estiver ligada o tempo de fritar &amp;eacute; de 5 minutos.&lt;/p&gt;', 'upload/2018/09/20/792083051cb54f9998f748376a899104.png', 26, 1, '', 0, 1, 1, NULL, '', NULL, NULL, NULL),
(186, 'Hambúrguer do Don Júlio', 17.90, '&lt;p&gt;P&amp;atilde;o Brioche, queijo coalho, blend da Delion Caf&amp;eacute; e molho especial.&lt;/p&gt;', 'upload/2018/09/26/299f87402dc518fb48914660039a206f.jpg', 27, 1, '', 0, 1, 1, NULL, '', NULL, NULL, NULL),
(187, 'Combo Don Júlio 1', 21.00, '&lt;p&gt;Hamb&amp;uacute;rguer Don J&amp;uacute;lio + Refrigerante&lt;/p&gt;', 'upload/2018/09/26/00e4a95f8e6143d500b6e50080698fae.jpg', 34, 1, '', 1, 1, 1, NULL, '', NULL, NULL, NULL),
(188, 'Combo Don Júlio 2', 24.00, '&lt;p&gt;Hamb&amp;uacute;rguer Don J&amp;uacute;lio + Cerveja&lt;/p&gt;', 'upload/2018/09/26/20519b9ab5cc27bcdf3c838f33c2d9f6.jpg', 34, 1, '', 0, 1, 1, NULL, '', NULL, NULL, NULL),
(189, 'Pulled Pork', 14.90, '&lt;p&gt;P&amp;atilde;o Curitibano tostado.&lt;/p&gt;\r\n&lt;p&gt;&lt;br /&gt;Preparado com carne de porco (em processo de cozimento de 56 horas &lt;br /&gt;e 1 hora e meia de defuma&amp;ccedil;&amp;atilde;o).&lt;/p&gt;', 'upload/2018/11/09/15a6e96cac89e331a303c88d34c18425.jpg', 27, 1, '', 0, 0, 1, NULL, '', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `cardapio_horas`
--

CREATE TABLE IF NOT EXISTS `cardapio_horas` (
`cod_cardapio_horas` int(11) NOT NULL,
  `horario` time NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `cardapio_horas`
--

INSERT INTO `cardapio_horas` (`cod_cardapio_horas`, `horario`) VALUES
(1, '08:30:00'),
(2, '09:00:00'),
(3, '09:30:00'),
(4, '10:00:00'),
(5, '10:30:00'),
(6, '11:00:00'),
(7, '11:30:00'),
(8, '12:00:00'),
(9, '12:30:00'),
(10, '13:00:00'),
(11, '13:30:00'),
(12, '14:00:00'),
(13, '14:30:00'),
(14, '15:00:00'),
(15, '15:30:00'),
(16, '16:00:00'),
(17, '16:30:00'),
(18, '17:00:00'),
(19, '17:30:00'),
(20, '18:00:00'),
(21, '18:30:00'),
(22, '19:00:00'),
(23, '19:30:00'),
(24, '20:00:00'),
(25, '20:30:00'),
(26, '21:00:00');

-- --------------------------------------------------------

--
-- Estrutura da tabela `cardapio_turno`
--

CREATE TABLE IF NOT EXISTS `cardapio_turno` (
`cod_cardapio_turno` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `cardapio_turno`
--

INSERT INTO `cardapio_turno` (`cod_cardapio_turno`, `nome`) VALUES
(1, '1º Turno'),
(2, '2º Turno'),
(3, '3º Turno');

-- --------------------------------------------------------

--
-- Estrutura da tabela `categoria`
--

CREATE TABLE IF NOT EXISTS `categoria` (
`cod_categoria` int(11) NOT NULL,
  `nome` varchar(255) COLLATE utf8_bin NOT NULL,
  `icone` varchar(255) COLLATE utf8_bin NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=39 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Extraindo dados da tabela `categoria`
--

INSERT INTO `categoria` (`cod_categoria`, `nome`, `icone`) VALUES
(22, 'BEBIDAS', 'upload/2018/02/08/f7e151d8382e33371ddc7bad5f0bb18e.png'),
(38, 'ESPECIAL', 'upload/2018/02/16/36488e1c4363d1302c70fdac6fb3fad1.png'),
(25, 'DOCES', 'upload/2018/02/07/a0104b4effe429905736271f6e79958a.png'),
(26, 'SALGADOS', 'upload/2018/02/07/15a28ab8c0da79f98fba13378d9b15fa.png'),
(27, 'SANDUÍCHES', 'upload/2018/02/07/cbebc01daf6b108be59b15e55ec44ca4.png'),
(28, 'TORTAS', 'upload/2018/02/07/9eacc77261bb78725997071a6384458e.png'),
(34, 'COMBOS', 'upload/2018/02/08/c27e11378151d89a4d7c037b73e1601c.png'),
(37, 'ALMOÇO', 'upload/2018/02/08/c0340d0946a9eb1db76191b84f9bfaee.png');

-- --------------------------------------------------------

--
-- Estrutura da tabela `cliente`
--

CREATE TABLE IF NOT EXISTS `cliente` (
`cod_cliente` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `login` varchar(30) NOT NULL,
  `senha` varchar(32) DEFAULT NULL,
  `telefone` varchar(15) DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `id_google` varchar(32) DEFAULT NULL,
  `id_facebook` varchar(255) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `cliente`
--

INSERT INTO `cliente` (`cod_cliente`, `nome`, `login`, `senha`, `telefone`, `status`, `id_google`, `id_facebook`) VALUES
(3, 'Vitor Baldacian', 'vitor@corp.kionux.com.br', NULL, NULL, 1, '102759409854022733312', NULL),
(4, 'vitor baldacin', 'vitormatheussb@gmail.com', NULL, NULL, 1, '102190150479546804771', NULL),
(5, 'Teste', 'teste@gmail.com', '879d374afa4179c5a0a3cf55fb899e8b', '998959665', 1, NULL, NULL),
(15, 'Arthur Kenji Rosa Haguiuda', 'arthurhaguiuda@hotmail.com', NULL, NULL, 1, NULL, '1228747850621032'),
(16, 'Arthur Haguiuda', 'arthur@corp.kionux.com.br', NULL, '12412412', 1, '113139107623040199715', NULL),
(17, 'teste1', 'teste@teste.com', '8d356bac191b24d92e6183518e3f40bc', '12312', 1, NULL, NULL),
(18, 'vitor', 'vitormatheussb@gmail.com', '879d374afa4179c5a0a3cf55fb899e8b', '12345678', 1, NULL, NULL),
(19, 'teste', 'teste@teste.com', '2aa43308916e39543a1f3f24c270a4c0', '12165846', 1, NULL, NULL),
(20, 'teste', 'teste@teste.com', '2aa43308916e39543a1f3f24c270a4c0', '123123', 1, NULL, NULL),
(21, 'Arthur Kenji', 'arthurhaguiuda@gmail.com', NULL, NULL, 1, '115462431362905694021', NULL),
(22, 'JESSICA APARECIDA SIMOES', 'jessicasimoes92@outlook.com.br', 'cdd4b3e28e75868c3c76f02419b65de8', '45991129876', 1, NULL, NULL),
(23, 'arthur', 'arthur@mail.com', '3b464bea6c494302981adba1cffc2910', '1092381092', 1, NULL, NULL),
(24, 'laila', 'lailamonteiroam@gmail.com', 'f5c9fb1c027e4cfb53439de582ad24c2', '30292574', 1, NULL, NULL),
(25, '1', '1&quot;\\''`--', 'fad2da68de14f568929ef5f71ab038ad', '1', 1, NULL, NULL),
(26, '1', '1', 'fad2da68de14f568929ef5f71ab038ad', '1&quot;\\''`--', 1, NULL, NULL),
(27, '1', '1', 'fad2da68de14f568929ef5f71ab038ad', '1)', 1, NULL, NULL),
(28, '1', '1', 'e782f3534b6fcb881aedf2e2c5d0ff4a', '1', 1, NULL, NULL),
(29, '1', '1', 'fad2da68de14f568929ef5f71ab038ad', '1', 1, NULL, NULL),
(30, '1', '1)', 'fad2da68de14f568929ef5f71ab038ad', '1', 1, NULL, NULL),
(31, '1&quot;\\''`--', '1', 'fad2da68de14f568929ef5f71ab038ad', '1', 1, NULL, NULL),
(32, '1)', '1', 'fad2da68de14f568929ef5f71ab038ad', '1', 1, NULL, NULL),
(33, '3', 'Smith', 'e8f7080dd806058fe3209ffaa1023474', '5234534558', 1, NULL, NULL),
(34, '1', '1', '628edff69845790aa8d2c61a7a9f4f57', '1', 1, NULL, NULL),
(35, 'Matheus Henrique', 'matheus@corp.kionux.com.br', 'd6692821ac08b1de509dca21b10ce889', '45998081179', 1, NULL, NULL),
(36, 'a', 'a@a', 'b41152fb0799b244e3d318a35073e372', '1', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `cliente_wpp`
--

CREATE TABLE IF NOT EXISTS `cliente_wpp` (
`cod_cliente_wpp` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `telefone` bigint(50) NOT NULL,
  `rua` varchar(255) NOT NULL,
  `numero` varchar(10) NOT NULL,
  `bairro` varchar(100) NOT NULL,
  `complemento` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `cliente_wpp`
--

INSERT INTO `cliente_wpp` (`cod_cliente_wpp`, `nome`, `telefone`, `rua`, `numero`, `bairro`, `complemento`) VALUES
(1, 'Matheus Teste', 4599985885, 'Avenida Felipe Wandscheer', '2310', 'Vila Yolanda', 'ap 09'),
(2, 'Harry Potter', 4535411787, 'Rua dos Alfineiros', '250', 'Parque', 'ap'),
(3, 'teste t', 45995575411, 'Rua Margarida', '255', 'Vila Yolanda', 'fundos'),
(4, 'Matheus Teste', 4599985885, 'Rua Flor', '255', 'Vila Yolanda', 'fundos'),
(5, 'Teste 1', 4599985885, 'Rua martelo', '2310', 'Bairro centro teste', 'fundos casa 2'),
(6, 'Teste 2', 4599985885, 'Rua Margarida', '255', 'bairro teste', 'fundos'),
(7, 'Teste 3', 45999805522, 'Rua Margarida', '125', 'Bairro centro teste', 'fundos'),
(8, 'danielli', 45991139093, 'avenida felipe wandscheerd', '2310', 'vila yolanda', 'apto. 01'),
(9, 'Matheus', 4599985885, 'Rua Flor', '2310', 'Bairro centro', 'fundos'),
(10, 'Matheus Teste 1', 4599985885, 'Avenida Felipe Wandscheer', '2310', 'bairro teste', 'fundos'),
(11, 'Matheus Teste 2', 4599985885, 'Rua Margarida', '255', 'bairro teste', 'fundos'),
(12, 'Matheus Teste 434', 4599985885, 'Rua Flor', '2310', 'bairro teste', 'fundos casa 2');

-- --------------------------------------------------------

--
-- Estrutura da tabela `combo`
--

CREATE TABLE IF NOT EXISTS `combo` (
`cod_combo` int(11) NOT NULL,
  `cliente` int(11) NOT NULL,
  `data` date NOT NULL,
  `valor` decimal(6,2) NOT NULL,
  `status` int(11) NOT NULL,
  `endereco` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `combo`
--

INSERT INTO `combo` (`cod_combo`, `cliente`, `data`, `valor`, `status`, `endereco`) VALUES
(28, 18, '2018-11-01', 49.30, 1, 7),
(29, 18, '2018-11-01', 51.38, 1, 0),
(30, 33, '2019-04-05', 620.53, 1, NULL),
(31, 33, '2019-04-05', 0.00, 1, 0),
(32, 33, '2019-04-05', 0.00, 1, 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `empresa`
--

CREATE TABLE IF NOT EXISTS `empresa` (
`cod_empresa` int(11) NOT NULL,
  `nome` varchar(255) COLLATE utf8_bin NOT NULL,
  `descricao` text COLLATE utf8_bin NOT NULL,
  `historia` text COLLATE utf8_bin NOT NULL,
  `endereco` varchar(255) COLLATE utf8_bin NOT NULL,
  `bairro` varchar(100) COLLATE utf8_bin NOT NULL,
  `cidade` varchar(100) COLLATE utf8_bin NOT NULL,
  `estado` varchar(30) COLLATE utf8_bin NOT NULL,
  `cep` varchar(10) COLLATE utf8_bin NOT NULL,
  `fone` varchar(20) COLLATE utf8_bin NOT NULL,
  `whats` varchar(20) COLLATE utf8_bin NOT NULL,
  `email` varchar(100) COLLATE utf8_bin NOT NULL,
  `facebook` varchar(255) COLLATE utf8_bin NOT NULL,
  `instagram` varchar(255) COLLATE utf8_bin NOT NULL,
  `pinterest` varchar(255) COLLATE utf8_bin NOT NULL,
  `foto` varchar(255) COLLATE utf8_bin NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Extraindo dados da tabela `empresa`
--

INSERT INTO `empresa` (`cod_empresa`, `nome`, `descricao`, `historia`, `endereco`, `bairro`, `cidade`, `estado`, `cep`, `fone`, `whats`, `email`, `facebook`, `instagram`, `pinterest`, `foto`) VALUES
(1, 'Delion Café', '&lt;p&gt;A Delion Caf&amp;eacute; foi idealizada no ano de 2015, seus idealizadores objetivavam levar aos clientes produtos de qualidade, elaborados dentro de um esmerado controle de qualidade e higiene, n&amp;atilde;o se esquecendo do fator pre&amp;ccedil;o. Tudo foi pensado para que os clientes desfrutacem de bons produtos, com um pre&amp;ccedil;o justo, em um ambiente amplo e agrad&amp;aacute;vel.&lt;/p&gt;\r\n&lt;p&gt;Hoje a Delion Caf&amp;eacute; &amp;eacute; uma realidade, trouxe para Foz do Igua&amp;ccedil;u um conceito novo, jovem e diferenciado. Servindo sempre produtos frescos, que saem direto do forno para mesa dos clientes, sem utiliza&amp;ccedil;&amp;atilde;o de reaquecimento, os produtos da Delion Caf&amp;eacute; s&amp;atilde;o elaborados no momento do pedido, por esse motivo o sabor &amp;eacute; iniqual&amp;aacute;vel.&lt;/p&gt;', '&lt;p&gt;&lt;strong&gt;Delion de Oliveira&lt;/strong&gt;, segundo filho de cinco irm&amp;atilde;os, nasceu em Jacare&amp;iacute;, interior de S&amp;atilde;o Paulo, no dia 31 de Mar&amp;ccedil;o de 1931. Filho de Juvenal de Oliveira, um funcion&amp;aacute;rio da extinta Central do Brasil e Ol&amp;iacute;via Miguel de Oliveira, uma mulher de fibra, benzedeira e de uma bondade impar.Foi casado por 43 anos com Nilse Maria de Azevedo de Oliveira com quem teve dois filhos, Marcia e Delion Jr. Quando faleceu, al&amp;eacute;m da esposa e dos filhos, deixou sete netos: Rodrigo, Thiago, Jeniffer, Denise, Ana Lu&amp;iacute;sa, Bruno e Leonardo.&lt;/p&gt;\r\n&lt;p&gt;Cursou a Escola Agr&amp;iacute;cola de Jacare&amp;iacute; C&amp;ocirc;nego Jos&amp;eacute; Bento, na vida profissional, trabalhou na Casa Michel, foi funcion&amp;aacute;rio do antigo Banco Mercantil de S&amp;atilde;o Paulo e se aposentou na Gates do Brasil. Paralelo aos trabalhos sempre fazia bicos de gar&amp;ccedil;om para refor&amp;ccedil;ar o or&amp;ccedil;amento domestico, ali&amp;aacute;s, o que lhe dava grande prazer, devido ao fato de gostar de tratar com o p&amp;uacute;blico. Ap&amp;oacute;s se aposentar, gerenciou uma lanchonete e sempre revelava em suas conversas que adoraria ter um estabelecimento ligado ao setor de gastronomia. N&amp;atilde;o foi poss&amp;iacute;vel realizar esse sonho, ele faleceu em Jacare&amp;iacute;, no dia 30 de Maio de 1996, aos 65 anos, v&amp;iacute;tima de uma diabetes que contraiu ainda na adolesc&amp;ecirc;ncia. Ele sempre foi lembrado como um homem trabalhador, de bom car&amp;aacute;ter, extremamente honesto, que amava sua fam&amp;iacute;lia e que tinha uma alegria contagiante. Seu sorriso largo e sua alegria de viver foram sua marca registrada.&lt;/p&gt;\r\n&lt;p&gt;Dezenove anos ap&amp;oacute;s seu falecimento, seu sonho se materializou, a Delion Caf&amp;eacute; &amp;eacute; uma realidade, um estabelecimento com nome desse que deixou saudades e in&amp;uacute;meras li&amp;ccedil;&amp;otilde;es de vida a todos que fizeram parte de seu conv&amp;iacute;vio&lt;/p&gt;', 'Rua Jorge Sanwais, 1137', 'Centro', 'Foz do Iguaçu', 'Paraná', '85851-150', '(45) 3027-0059', '45991075688', 'contato@delioncafe.com.br', 'www.facebook.com/delioncafe', 'www.instagram.com/delioncafe', 'br.pinterest.com/search/pins/?q=Delion%20Caf%C3%A9&amp;rs=typed&amp;term_meta[]=Delion%7Ctyped&amp;term_meta[]=Caf%C3%A9%7Ctyped', 'upload/2018/09/13/afb1bd5fa29d26ac8745bc0c05281da5.png');

-- --------------------------------------------------------

--
-- Estrutura da tabela `endereco`
--

CREATE TABLE IF NOT EXISTS `endereco` (
`cod_endereco` int(11) NOT NULL,
  `rua` varchar(255) NOT NULL,
  `numero` int(11) NOT NULL,
  `cep` varchar(10) NOT NULL,
  `complemento` varchar(255) DEFAULT NULL,
  `bairro` varchar(255) DEFAULT NULL,
  `cliente` int(11) DEFAULT NULL,
  `flag_cliente` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `endereco`
--

INSERT INTO `endereco` (`cod_endereco`, `rua`, `numero`, `cep`, `complemento`, `bairro`, `cliente`, `flag_cliente`) VALUES
(6, 'Rua Marechal Deodoro da Fonseca', 1121, '85851030', 'apto21', 'Centro', 21, 1),
(7, 'Rua Rio Grande do Sul', 528, '85870786', '', 'Loteamento Bela Vista', 18, 1),
(9, '', 0, '', '', '', 33, 0),
(10, '3', 3, '3', '3', '3', 33, 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `evento`
--

CREATE TABLE IF NOT EXISTS `evento` (
`cod_evento` int(11) NOT NULL,
  `nome` varchar(255) COLLATE utf8_bin NOT NULL,
  `data` date NOT NULL,
  `flag_antigo` tinyint(1) NOT NULL,
  `foto` varchar(255) COLLATE utf8_bin NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Extraindo dados da tabela `evento`
--

INSERT INTO `evento` (`cod_evento`, `nome`, `data`, `flag_antigo`, `foto`) VALUES
(4, 'Café com música', '2017-12-13', 1, 'upload/2017/12/27/4d5e56f74f9e927c9026aeffe3ca9c89.png'),
(8, 'CLUBE DA VITROLA', '0000-00-00', 0, 'upload/2018/02/20/c2debe893ec4196d259b45031b246d00.png');

-- --------------------------------------------------------

--
-- Estrutura da tabela `imagem`
--

CREATE TABLE IF NOT EXISTS `imagem` (
`cod_imagem` int(11) NOT NULL,
  `nome` varchar(255) CHARACTER SET utf8 NOT NULL,
  `foto` varchar(255) CHARACTER SET utf8 NOT NULL,
  `pagina` varchar(255) CHARACTER SET utf8 NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Extraindo dados da tabela `imagem`
--

INSERT INTO `imagem` (`cod_imagem`, `nome`, `foto`, `pagina`) VALUES
(1, 'Cardapio', 'upload/2018/01/08/0f61ab54d56b7777b3126743d7353dda.png', '["inicialCardapio","cardapio"]'),
(3, 'Cartão', 'upload/2018/10/03/d44a89f0c633e844421961fd6fb58dd1.png', '["inicialCartaoFidelidade"]'),
(4, 'pedido', 'upload/2018/10/03/6a25c0a0c862b9d31e0695a38bd8568e.png', '["inicialPedido"]'),
(5, 'sobre', 'upload/2018/01/09/16548982dc2e3f82e4defb1b90bd6a6a.png', '["sobre"]'),
(6, 'contato 1', 'upload/2018/01/09/860d93bcf684dd0035f3d06549b6b7ca.png', '["historia","contato"]'),
(7, 'contato 2', 'upload/2018/01/09/9b9c2db09d8c7e53c7f372ce94a96832.png', '["historia","contato"]'),
(8, 'Sanduba', 'upload/2018/02/08/38ed35cae335f03d3eaa498a8c32108d.png', '["inicialCardapio"]'),
(9, 'Suflê', 'upload/2018/02/08/adfc28c9b2c6430aea7c723898d425fe.png', '["inicialCardapio"]'),
(10, 'Café com Doce', 'upload/2018/02/08/aeca3bb3a6254bd91a04a718f4f24c6d.png', '["inicialCardapio","cardapio"]'),
(11, 'Combo', 'upload/2018/02/08/01db8fb0479a6ad12dafb6fd2c10c2f3.png', '["inicialCardapio"]'),
(12, 'Mortadela', 'upload/2018/02/08/3d4de8b7911b7f18499e5e17546ca5c1.png', '["inicialCardapio","cardapio"]'),
(17, 'Espaço DO', 'upload/2019/07/26/a9cc881d1887afa79afca996e4885bbf.jpg', '["inicialEvento"]'),
(15, 'popUp', 'upload/2018/10/19/39310f9deaf64b1effcb120ed3ddcd8d.jpg', '["popUp"]');

-- --------------------------------------------------------

--
-- Estrutura da tabela `item_adicional`
--

CREATE TABLE IF NOT EXISTS `item_adicional` (
`cod_item_adicional` int(11) NOT NULL,
  `cod_item_combo` int(11) NOT NULL,
  `cod_adicional` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `item_combo`
--

CREATE TABLE IF NOT EXISTS `item_combo` (
`cod_item_combo` int(11) NOT NULL,
  `cod_produto` int(11) NOT NULL,
  `cod_combo` int(11) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=500 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `item_combo`
--

INSERT INTO `item_combo` (`cod_item_combo`, `cod_produto`, `cod_combo`) VALUES
(399, 171, 28),
(400, 171, 28),
(401, 174, 28),
(402, 187, 28),
(403, 18, 28),
(404, 174, 29),
(405, 175, 29),
(406, 171, 29),
(407, 187, 29),
(408, 16, 30),
(409, 16, 30),
(410, 16, 30),
(411, 17, 30),
(412, 17, 30),
(413, 17, 30),
(414, 17, 30),
(415, 17, 30),
(416, 17, 30),
(417, 18, 30),
(418, 18, 30),
(419, 18, 30),
(420, 18, 30),
(421, 18, 30),
(422, 18, 30),
(423, 18, 30),
(424, 18, 30),
(425, 18, 30),
(426, 19, 30),
(427, 19, 30),
(428, 19, 30),
(429, 36, 30),
(430, 36, 30),
(431, 36, 30),
(432, 36, 30),
(433, 41, 30),
(434, 85, 30),
(435, 85, 30),
(436, 148, 30),
(437, 170, 30),
(438, 170, 30),
(439, 170, 30),
(440, 170, 30),
(441, 170, 30),
(442, 170, 30),
(443, 171, 30),
(444, 171, 30),
(445, 171, 30),
(446, 171, 30),
(447, 171, 30),
(448, 171, 30),
(449, 174, 30),
(450, 174, 30),
(451, 174, 30),
(452, 174, 30),
(453, 174, 30),
(454, 175, 30),
(455, 175, 30),
(456, 175, 30),
(457, 175, 30),
(458, 181, 30),
(459, 181, 30),
(460, 181, 30),
(461, 181, 30),
(462, 185, 30),
(463, 185, 30),
(464, 185, 30),
(465, 185, 30),
(466, 187, 30),
(467, 187, 30),
(468, 187, 30),
(469, 187, 30),
(470, 187, 30),
(471, 187, 30),
(472, 17, 31),
(473, 17, 31),
(474, 18, 31),
(475, 18, 31),
(476, 19, 31),
(477, 19, 31),
(478, 36, 31),
(479, 36, 31),
(480, 170, 31),
(481, 170, 31),
(482, 171, 31),
(483, 171, 31),
(484, 174, 31),
(485, 174, 31),
(486, 174, 31),
(487, 175, 31),
(488, 175, 31),
(489, 181, 31),
(490, 181, 31),
(491, 187, 31),
(492, 187, 31),
(493, 14, 32),
(494, 14, 32),
(495, 15, 32),
(496, 93, 32),
(497, 185, 32),
(498, 187, 32),
(499, 187, 32);

-- --------------------------------------------------------

--
-- Estrutura da tabela `item_pedido`
--

CREATE TABLE IF NOT EXISTS `item_pedido` (
`cod_item_pedido` int(11) NOT NULL,
  `cod_produto` int(11) NOT NULL,
  `cod_pedido` int(11) NOT NULL,
  `quantidade` int(11) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=340 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `item_pedido`
--

INSERT INTO `item_pedido` (`cod_item_pedido`, `cod_produto`, `cod_pedido`, `quantidade`) VALUES
(277, 18, 135, 1),
(278, 20, 135, 1),
(279, 20, 136, 1),
(280, 17, 136, 1),
(281, 17, 137, 1),
(282, 20, 137, 1),
(283, 20, 138, 3),
(284, 22, 138, 3),
(285, 18, 138, 1),
(286, 17, 139, 1),
(287, 18, 139, 1),
(288, 20, 140, 4),
(289, 18, 140, 2),
(290, 19, 141, 1),
(291, 17, 142, 3),
(292, 18, 142, 2),
(293, 20, 142, 1),
(294, 18, 143, 3),
(295, 19, 143, 2),
(296, 19, 144, 2),
(297, 18, 144, 1),
(298, 20, 145, 2),
(299, 18, 145, 1),
(300, 17, 146, 1),
(301, 20, 146, 1),
(302, 22, 146, 1),
(303, 36, 147, 1),
(304, 134, 147, 1),
(305, 135, 147, 1),
(306, 131, 147, 1),
(307, 171, 147, 1),
(308, 172, 147, 1),
(309, 134, 148, 2),
(310, 36, 148, 2),
(311, 36, 149, 1),
(312, 134, 150, 1),
(313, 134, 151, 1),
(314, 135, 152, 1),
(315, 134, 153, 1),
(316, 36, 154, 1),
(317, 36, 155, 1),
(318, 36, 156, 1),
(319, 36, 157, 1),
(320, 134, 157, 1),
(321, 141, 157, 1),
(322, 36, 158, 1),
(323, 134, 159, 1),
(324, 36, 159, 1),
(325, 134, 160, 2),
(326, 36, 160, 2),
(327, 135, 160, 3),
(328, 134, 161, 4),
(329, 36, 161, 2),
(330, 141, 161, 2),
(331, 174, 162, 1),
(332, 187, 163, 1),
(333, 174, 163, 1),
(334, 174, 164, 1),
(335, 171, 164, 1),
(336, 187, 164, 1),
(337, 18, 164, 1),
(338, 174, 165, 1),
(339, 187, 166, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `item_pedido_wpp`
--

CREATE TABLE IF NOT EXISTS `item_pedido_wpp` (
`cod_item_pedido_wpp` int(11) NOT NULL,
  `cod_produto` int(11) NOT NULL,
  `cod_pedido_wpp` int(11) NOT NULL,
  `quantidade` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `item_pedido_wpp`
--

INSERT INTO `item_pedido_wpp` (`cod_item_pedido_wpp`, `cod_produto`, `cod_pedido_wpp`, `quantidade`) VALUES
(1, 17, 1, 1),
(2, 18, 1, 2),
(3, 17, 2, 1),
(4, 18, 2, 2),
(5, 174, 2, 2),
(6, 17, 3, 1),
(7, 18, 3, 1),
(8, 17, 4, 2),
(9, 18, 4, 1),
(10, 17, 5, 2),
(11, 136, 5, 2),
(12, 17, 6, 1),
(13, 139, 6, 1),
(14, 19, 7, 1),
(15, 141, 7, 2),
(16, 174, 7, 1),
(17, 17, 9, 1),
(18, 18, 9, 1),
(19, 18, 10, 1),
(20, 172, 10, 4),
(21, 17, 11, 1),
(22, 134, 11, 1),
(23, 135, 11, 1),
(24, 99, 12, 1),
(25, 100, 12, 2),
(26, 101, 12, 2);

-- --------------------------------------------------------

--
-- Estrutura da tabela `minimo_combo`
--

CREATE TABLE IF NOT EXISTS `minimo_combo` (
  `minimo` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `minimo_combo`
--

INSERT INTO `minimo_combo` (`minimo`) VALUES
(4);

-- --------------------------------------------------------

--
-- Estrutura da tabela `pedido`
--

CREATE TABLE IF NOT EXISTS `pedido` (
`cod_pedido` int(11) NOT NULL,
  `cliente` int(11) NOT NULL,
  `data` date NOT NULL,
  `valor` decimal(6,2) NOT NULL,
  `status` int(11) NOT NULL,
  `endereco` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=167 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `pedido`
--

INSERT INTO `pedido` (`cod_pedido`, `cliente`, `data`, `valor`, `status`, `endereco`) VALUES
(135, 4, '2018-09-10', 21.00, 1, NULL),
(136, 4, '2018-09-10', 21.00, 1, NULL),
(137, 5, '2018-09-10', 21.00, 1, NULL),
(138, 4, '2018-09-10', 73.50, 1, NULL),
(139, 4, '2018-09-10', 21.00, 1, NULL),
(140, 4, '2018-09-11', 63.00, 1, NULL),
(141, 4, '2018-09-11', 10.50, 1, NULL),
(142, 4, '2018-09-11', 63.00, 1, NULL),
(143, 4, '2018-09-11', 52.50, 1, NULL),
(144, 3, '2018-09-11', 31.50, 1, NULL),
(145, 4, '2018-09-11', 31.50, 1, NULL),
(146, 5, '2018-09-13', 31.50, 1, NULL),
(147, 3, '2018-09-19', 53.25, 1, NULL),
(148, 3, '2018-09-19', 17.50, 1, NULL),
(149, 3, '2018-09-19', 6.50, 1, NULL),
(150, 3, '2018-09-19', 2.25, 1, NULL),
(151, 3, '2018-09-19', 2.25, 1, NULL),
(152, 3, '2018-09-19', 2.50, 1, NULL),
(153, 3, '2018-09-19', 2.25, 1, NULL),
(154, 3, '2018-09-19', 6.50, 1, NULL),
(155, 3, '2018-09-19', 6.50, 1, NULL),
(156, 3, '2018-09-19', 6.50, 1, NULL),
(157, 3, '2018-09-19', 12.50, 1, NULL),
(158, 3, '2018-09-19', 6.50, 1, NULL),
(159, 3, '2018-09-19', 8.75, 1, NULL),
(160, 3, '2018-09-19', 34.00, 1, NULL),
(161, 3, '2018-09-19', 57.50, 1, NULL),
(162, 21, '2018-09-27', 7.90, 1, NULL),
(163, 23, '2018-10-18', 28.90, 1, NULL),
(164, 21, '2018-11-01', 46.30, 1, NULL),
(165, 21, '2018-11-01', 7.90, 1, 6),
(166, 24, '2019-02-18', 21.00, 1, NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `pedido_wpp`
--

CREATE TABLE IF NOT EXISTS `pedido_wpp` (
`cod_pedido_wpp` int(11) NOT NULL,
  `cod_cliente_wpp` int(11) NOT NULL,
  `data` datetime NOT NULL,
  `formaPgt` varchar(255) NOT NULL,
  `valor` decimal(6,2) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `pedido_wpp`
--

INSERT INTO `pedido_wpp` (`cod_pedido_wpp`, `cod_cliente_wpp`, `data`, `formaPgt`, `valor`, `status`) VALUES
(1, 1, '2019-07-31 00:00:00', '', 41.70, 3),
(2, 2, '2019-07-31 00:00:00', '', 57.50, 2),
(3, 3, '2019-07-31 00:00:00', '', 27.80, 3),
(4, 4, '2019-08-08 15:29:27', '', 41.70, 2),
(5, 5, '2019-08-08 15:43:26', '', 34.80, 2),
(6, 6, '2019-08-08 15:56:51', '', 17.40, 2),
(7, 7, '2019-08-08 16:26:43', '', 31.30, 2),
(8, 8, '2019-08-08 16:53:00', '', 0.00, 2),
(9, 9, '2019-08-08 17:35:39', '', 27.80, 2),
(10, 10, '2019-08-14 15:00:32', '', 27.90, 2),
(11, 11, '2019-08-14 15:01:03', '', 18.65, 2),
(12, 12, '2019-08-14 16:25:09', '', 29.50, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tipo_avaliacao`
--

CREATE TABLE IF NOT EXISTS `tipo_avaliacao` (
`cod_tipo_avaliacao` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `flag_ativo` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tipo_avaliacao`
--

INSERT INTO `tipo_avaliacao` (`cod_tipo_avaliacao`, `nome`, `flag_ativo`) VALUES
(9, 'Atendimento', 1),
(10, 'Preço', 1),
(11, 'Agilidade', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

CREATE TABLE IF NOT EXISTS `usuario` (
`cod_usuario` int(11) NOT NULL,
  `nome` varchar(255) COLLATE utf8_bin NOT NULL,
  `login` varchar(255) COLLATE utf8_bin NOT NULL,
  `senha` varchar(32) COLLATE utf8_bin NOT NULL,
  `email` varchar(100) COLLATE utf8_bin NOT NULL,
  `flag_bloqueado` tinyint(1) NOT NULL,
  `cod_perfil` tinyint(4) NOT NULL,
  `permissao` text COLLATE utf8_bin NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`cod_usuario`, `nome`, `login`, `senha`, `email`, `flag_bloqueado`, `cod_perfil`, `permissao`) VALUES
(1, 'admin', 'admin', 'e10adc3949ba59abbe56e057f20f883e', 'admin@admin.com', 0, 0, '["usuario","empresa","banner","imagem","evento","categoria","cardapio"]'),
(3, 'douglas', 'douglas', '3b16dc694c38d04f7d7451cc37d3c654', 'douglas@douglas.com', 0, 0, '["usuario"]'),
(4, 'kionux', 'kionux', 'c37ea86ec45c587ae1950e8f5337d84b', 'thiago@corp.kionux.com.br', 0, 0, '["usuario","empresa","banner","imagem","evento","categoria","cardapio","cliente","pedido","avaliacao"]'),
(9, 'vitor', 'vitor', '997d13b90da22b35ce43bebdd332ad11', 'vitormatheussb@gmail.com', 0, 0, '["usuario","empresa","banner","imagem","evento","categoria","cardapio","cliente","pedido","avaliacao"]'),
(10, 'Matheus', 'matheus', '45339359513f09155110f63f7ca91c3e', '', 0, 0, '["usuario","empresa","banner","imagem","evento","categoria","cardapio","cliente","pedido","avaliacao","combo","adicional","pedidoWpp"]'),
(11, 'felipe', 'da Maia', '992ce73c8b7bdd59daa1de6ac995cad7', '', 0, 0, '["usuario","empresa","banner","imagem","evento","categoria","cardapio","cliente","pedido","avaliacao","combo","adicional","pedidoWpp"]'),
(12, 'thiago', 'thiago', '8c278462dc2f486dd9697edc17eff391', '', 0, 0, '["cardapio","pedidoWpp"]'),
(13, 'Isshak Darwich', 'isshak', '42b2badf4ae3869c80d253f5d10a95d9', '', 0, 0, '["usuario","empresa","banner","imagem","evento","categoria","cardapio","cliente","pedido","avaliacao","combo","adicional","pedidoWpp"]');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `adicional`
--
ALTER TABLE `adicional`
 ADD PRIMARY KEY (`cod_adicional`);

--
-- Indexes for table `avaliacao`
--
ALTER TABLE `avaliacao`
 ADD PRIMARY KEY (`cod_avaliacao`), ADD KEY `tipo_avaliacao` (`tipo_avaliacao`), ADD KEY `data` (`data`);

--
-- Indexes for table `banner`
--
ALTER TABLE `banner`
 ADD PRIMARY KEY (`cod_banner`);

--
-- Indexes for table `cardapio`
--
ALTER TABLE `cardapio`
 ADD PRIMARY KEY (`cod_cardapio`), ADD KEY `categoria` (`categoria`), ADD KEY `slug` (`slug`);

--
-- Indexes for table `cardapio_horas`
--
ALTER TABLE `cardapio_horas`
 ADD PRIMARY KEY (`cod_cardapio_horas`);

--
-- Indexes for table `cardapio_turno`
--
ALTER TABLE `cardapio_turno`
 ADD PRIMARY KEY (`cod_cardapio_turno`);

--
-- Indexes for table `categoria`
--
ALTER TABLE `categoria`
 ADD PRIMARY KEY (`cod_categoria`);

--
-- Indexes for table `cliente`
--
ALTER TABLE `cliente`
 ADD PRIMARY KEY (`cod_cliente`);

--
-- Indexes for table `cliente_wpp`
--
ALTER TABLE `cliente_wpp`
 ADD PRIMARY KEY (`cod_cliente_wpp`), ADD KEY `telefone` (`telefone`);

--
-- Indexes for table `combo`
--
ALTER TABLE `combo`
 ADD PRIMARY KEY (`cod_combo`), ADD KEY `cliente` (`cliente`), ADD KEY `endereco` (`endereco`);

--
-- Indexes for table `empresa`
--
ALTER TABLE `empresa`
 ADD PRIMARY KEY (`cod_empresa`);

--
-- Indexes for table `endereco`
--
ALTER TABLE `endereco`
 ADD PRIMARY KEY (`cod_endereco`), ADD KEY `cliente` (`cliente`);

--
-- Indexes for table `evento`
--
ALTER TABLE `evento`
 ADD PRIMARY KEY (`cod_evento`);

--
-- Indexes for table `imagem`
--
ALTER TABLE `imagem`
 ADD PRIMARY KEY (`cod_imagem`);

--
-- Indexes for table `item_adicional`
--
ALTER TABLE `item_adicional`
 ADD PRIMARY KEY (`cod_item_adicional`), ADD KEY `cod_item_combo` (`cod_item_combo`), ADD KEY `cod_adicional` (`cod_adicional`);

--
-- Indexes for table `item_combo`
--
ALTER TABLE `item_combo`
 ADD PRIMARY KEY (`cod_item_combo`), ADD KEY `item_combo` (`cod_produto`,`cod_combo`);

--
-- Indexes for table `item_pedido`
--
ALTER TABLE `item_pedido`
 ADD PRIMARY KEY (`cod_item_pedido`), ADD KEY `item_pedido` (`cod_produto`,`cod_pedido`);

--
-- Indexes for table `item_pedido_wpp`
--
ALTER TABLE `item_pedido_wpp`
 ADD PRIMARY KEY (`cod_item_pedido_wpp`), ADD KEY `item_pedido_wpp` (`cod_produto`,`cod_pedido_wpp`) USING BTREE;

--
-- Indexes for table `pedido`
--
ALTER TABLE `pedido`
 ADD PRIMARY KEY (`cod_pedido`), ADD KEY `cliente` (`cliente`), ADD KEY `endereco` (`endereco`);

--
-- Indexes for table `pedido_wpp`
--
ALTER TABLE `pedido_wpp`
 ADD PRIMARY KEY (`cod_pedido_wpp`), ADD KEY `cod_cliente_wpp` (`cod_cliente_wpp`);

--
-- Indexes for table `tipo_avaliacao`
--
ALTER TABLE `tipo_avaliacao`
 ADD PRIMARY KEY (`cod_tipo_avaliacao`);

--
-- Indexes for table `usuario`
--
ALTER TABLE `usuario`
 ADD PRIMARY KEY (`cod_usuario`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `adicional`
--
ALTER TABLE `adicional`
MODIFY `cod_adicional` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `avaliacao`
--
ALTER TABLE `avaliacao`
MODIFY `cod_avaliacao` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT for table `banner`
--
ALTER TABLE `banner`
MODIFY `cod_banner` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT for table `cardapio`
--
ALTER TABLE `cardapio`
MODIFY `cod_cardapio` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=193;
--
-- AUTO_INCREMENT for table `cardapio_horas`
--
ALTER TABLE `cardapio_horas`
MODIFY `cod_cardapio_horas` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=27;
--
-- AUTO_INCREMENT for table `cardapio_turno`
--
ALTER TABLE `cardapio_turno`
MODIFY `cod_cardapio_turno` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `categoria`
--
ALTER TABLE `categoria`
MODIFY `cod_categoria` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=39;
--
-- AUTO_INCREMENT for table `cliente`
--
ALTER TABLE `cliente`
MODIFY `cod_cliente` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=37;
--
-- AUTO_INCREMENT for table `cliente_wpp`
--
ALTER TABLE `cliente_wpp`
MODIFY `cod_cliente_wpp` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `combo`
--
ALTER TABLE `combo`
MODIFY `cod_combo` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=33;
--
-- AUTO_INCREMENT for table `empresa`
--
ALTER TABLE `empresa`
MODIFY `cod_empresa` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `endereco`
--
ALTER TABLE `endereco`
MODIFY `cod_endereco` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `evento`
--
ALTER TABLE `evento`
MODIFY `cod_evento` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `imagem`
--
ALTER TABLE `imagem`
MODIFY `cod_imagem` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `item_adicional`
--
ALTER TABLE `item_adicional`
MODIFY `cod_item_adicional` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `item_combo`
--
ALTER TABLE `item_combo`
MODIFY `cod_item_combo` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=500;
--
-- AUTO_INCREMENT for table `item_pedido`
--
ALTER TABLE `item_pedido`
MODIFY `cod_item_pedido` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=340;
--
-- AUTO_INCREMENT for table `item_pedido_wpp`
--
ALTER TABLE `item_pedido_wpp`
MODIFY `cod_item_pedido_wpp` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=27;
--
-- AUTO_INCREMENT for table `pedido`
--
ALTER TABLE `pedido`
MODIFY `cod_pedido` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=167;
--
-- AUTO_INCREMENT for table `pedido_wpp`
--
ALTER TABLE `pedido_wpp`
MODIFY `cod_pedido_wpp` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `tipo_avaliacao`
--
ALTER TABLE `tipo_avaliacao`
MODIFY `cod_tipo_avaliacao` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `usuario`
--
ALTER TABLE `usuario`
MODIFY `cod_usuario` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=14;
--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `avaliacao`
--
ALTER TABLE `avaliacao`
ADD CONSTRAINT `avaliacao_ibfk_1` FOREIGN KEY (`tipo_avaliacao`) REFERENCES `tipo_avaliacao` (`cod_tipo_avaliacao`);

--
-- Limitadores para a tabela `combo`
--
ALTER TABLE `combo`
ADD CONSTRAINT `combo_ibfk_1` FOREIGN KEY (`cliente`) REFERENCES `cliente` (`cod_cliente`);

--
-- Limitadores para a tabela `endereco`
--
ALTER TABLE `endereco`
ADD CONSTRAINT `endereco_ibfk_1` FOREIGN KEY (`cliente`) REFERENCES `cliente` (`cod_cliente`);

--
-- Limitadores para a tabela `pedido`
--
ALTER TABLE `pedido`
ADD CONSTRAINT `pedido_ibfk_1` FOREIGN KEY (`cliente`) REFERENCES `cliente` (`cod_cliente`);

--
-- Limitadores para a tabela `pedido_wpp`
--
ALTER TABLE `pedido_wpp`
ADD CONSTRAINT `pedido_wpp_ibfk_1` FOREIGN KEY (`cod_cliente_wpp`) REFERENCES `cliente_wpp` (`cod_cliente_wpp`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

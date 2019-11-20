-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 11-Nov-2019 às 14:30
-- Versão do servidor: 10.3.15-MariaDB
-- versão do PHP: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `delioncafe`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `adicional`
--

CREATE TABLE `adicional` (
  `cod_adicional` int(11) NOT NULL,
  `nome` varchar(50) COLLATE utf8_bin NOT NULL,
  `preco` decimal(5,2) NOT NULL,
  `desconto` tinyint(4) NOT NULL,
  `flag_ativo` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Extraindo dados da tabela `adicional`
--

INSERT INTO `adicional` (`cod_adicional`, `nome`, `preco`, `desconto`, `flag_ativo`) VALUES
(1, 'Queijo Extra', '2.00', 1, 1),
(2, 'Bacon Extra', '99.99', 1, 1),
(3, 'Chocolate Extra', '3.00', 1, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `avaliacao`
--

CREATE TABLE `avaliacao` (
  `cod_avaliacao` int(11) NOT NULL,
  `tipo_avaliacao` int(11) NOT NULL,
  `data` date NOT NULL,
  `hora` time NOT NULL,
  `nota` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

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

CREATE TABLE `banner` (
  `cod_banner` int(11) NOT NULL,
  `nome` varchar(255) COLLATE utf8_bin NOT NULL,
  `link` varchar(255) COLLATE utf8_bin NOT NULL,
  `legenda` varchar(100) COLLATE utf8_bin NOT NULL,
  `flag_tamanho` tinyint(1) NOT NULL,
  `foto` varchar(255) COLLATE utf8_bin NOT NULL,
  `pagina` varchar(255) COLLATE utf8_bin NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Extraindo dados da tabela `banner`
--

INSERT INTO `banner` (`cod_banner`, `nome`, `link`, `legenda`, `flag_tamanho`, `foto`, `pagina`) VALUES
(3, 'CartÃ£o 1', '#', 'JÃ PEDIU O SEU CARTÃƒO FIDELIDADE?', 1, 'upload/2018/10/03/2e0d65c6c0c04fd558a77abce222cd26.jpg', '[\"sobre\",\"historia\",\"contato\",\"localizacao\"]'),
(4, 'Torta', '#', 'Receba as nossas delÃ­cias no conforto da sua casa', 1, 'upload/2018/10/03/72b778b49a83902c31fb4b2e7197820f.jpg', '[\"sobre\",\"historia\",\"contato\",\"localizacao\"]'),
(6, 'Superior 2', '#', '', 0, 'upload/2018/10/05/d36ceb534d490f6140624acdf70de57a.jpg', '[\"inicialInferior\",\"sobre\",\"historia\"]'),
(7, 'sobre', '#', '', 0, 'upload/2018/01/09/edc3a99e555f51188412f937845bc409.png', '[\"sobre\"]'),
(8, 'Tomar cafÃ©', '#', 'Surpreenda alguÃ©m com o nosso vale cafÃ©', 1, 'upload/2018/10/03/4dfbc3250bf79da87d532b1d7521b448.jpg', '[\"sobre\",\"historia\",\"contato\",\"localizacao\"]'),
(18, 'HambÃºrguer Don JÃºlio', 'http://www.delioncafe.com.br/home/cardapio.php?search=Hamb%C3%BArguer+do+Don+J%C3%BAlio', '', 0, 'upload/2018/09/26/7f5d0f18c8a533bc48a8ee276175e60d.jpg', '[\"inicialSuperior\"]'),
(19, 'Combo', 'http://delioncafe.com.br/home/cardapio.php#', '', 0, 'upload/2018/10/04/c41efb63ade5dc9e0b8a9217dca89fc2.jpg', '[\"inicialSuperior\"]'),
(12, 'CafÃ© Americano', '', '', 0, 'upload/2018/02/07/097aebfd8d0d15240eb199095d83bb7c.png', '[\"inicialSuperior\"]'),
(16, 'Sanduiche de linguica', 'http://www.delioncafe.com.br/home/cardapio.php?search=lingui', '', 0, 'upload/2018/09/20/ccb5a34f9f87b3308b9dda61a3190b5a.jpg', '[\"inicialSuperior\"]'),
(15, 'Cervejas', '', '', 0, 'upload/2018/09/20/8786968d5b9fba122b77ebd264fd7c66.jpg', '[\"inicialSuperior\"]'),
(20, 'Delivery', 'https://delioncafe.com.br/home/cardapio.php', '', 0, 'upload/2018/10/30/5ac07b61f81523c46be4ff261407e867.jpg', '[\"inicialSuperior\"]');

-- --------------------------------------------------------

--
-- Estrutura da tabela `cardapio`
--

CREATE TABLE `cardapio` (
  `cod_cardapio` int(11) NOT NULL,
  `nome` varchar(255) COLLATE utf8_bin NOT NULL,
  `preco` decimal(6,2) NOT NULL,
  `descricao` mediumtext COLLATE utf8_bin NOT NULL,
  `foto` varchar(255) COLLATE utf8_bin NOT NULL,
  `categoria` int(11) NOT NULL,
  `flag_ativo` tinyint(1) NOT NULL,
  `flag_servindo` tinyint(1) NOT NULL,
  `slug` varchar(255) COLLATE utf8_bin NOT NULL,
  `prioridade` tinyint(1) DEFAULT NULL,
  `delivery` tinyint(1) DEFAULT NULL,
  `desconto` tinyint(4) DEFAULT NULL,
  `adicional` mediumtext COLLATE utf8_bin DEFAULT NULL,
  `dias_semana` mediumtext COLLATE utf8_bin NOT NULL,
  `cardapio_turno` int(11) DEFAULT NULL,
  `cardapio_horas_inicio` int(11) DEFAULT NULL,
  `cardapio_horas_final` int(11) DEFAULT NULL,
  `posicao` smallint(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Extraindo dados da tabela `cardapio`
--

INSERT INTO `cardapio` (`cod_cardapio`, `nome`, `preco`, `descricao`, `foto`, `categoria`, `flag_ativo`, `flag_servindo`, `slug`, `prioridade`, `delivery`, `desconto`, `adicional`, `dias_semana`, `cardapio_turno`, `cardapio_horas_inicio`, `cardapio_horas_final`, `posicao`) VALUES
(14, 'Combo Delion 1', '5.00', '&lt;p&gt;Dois p&amp;atilde;es franceses na chapa e um caf&amp;eacute; expresso.&lt;br /&gt;&lt;br /&gt;Todos os combos s&amp;atilde;o preparados na hora e o tempo m&amp;eacute;dio de preparo &amp;eacute; entre 5 a 10 minutos.&lt;/p&gt;', 'upload/2018/09/19/5762d0f3c2e7148f7976ec092ae04df4.jpg', 34, 1, 1, '', 0, 0, 1, NULL, '', NULL, NULL, NULL, 96),
(15, 'Combo Delion 2', '6.00', '&lt;p&gt;Dois p&amp;atilde;es franceses na chapa e um caf&amp;eacute; com leite.&lt;br /&gt;&lt;br /&gt;Todos os combos s&amp;atilde;o preparados na hora e o tempo m&amp;eacute;dio de preparo &amp;eacute; entre 5 a 10 minutos.&lt;/p&gt;', 'upload/2018/09/19/91a09e96f0fb40447e1d04ae01637707.jpg', 34, 1, 1, '', 0, 0, 1, NULL, '', NULL, NULL, NULL, 97),
(16, 'Combo Delion 3', '6.50', '&lt;p&gt;Dois p&amp;atilde;es franceses na chapa com requeij&amp;atilde;o e um caf&amp;eacute; com leite.&lt;br /&gt;&lt;br /&gt;Todos os combos s&amp;atilde;o preparados na hora e o tempo m&amp;eacute;dio de preparo &amp;eacute; entre 5 a 10 minutos.&lt;/p&gt;', 'upload/2018/09/19/13da77c84e4cad21d6ad52d47db8b392.jpg', 34, 1, 1, '', 0, 0, 1, NULL, '', NULL, NULL, NULL, 98),
(17, 'Macarrão a Carbonara', '13.90', '&lt;p&gt;Espaguete com bacon, ovo e queijo.&lt;/p&gt;\r\n&lt;p&gt;Acompanha um refrigerante ca&amp;ccedil;ulinha.&lt;/p&gt;\r\n&lt;p&gt;Tempo de preparo &amp;eacute; de 15 minutos.&lt;/p&gt;', 'upload/2018/09/19/8729370d2007f43107e1f919a2d596eb.jpg', 37, 1, 1, '', 1, 1, 1, NULL, '', NULL, NULL, NULL, 88),
(18, 'Macarrão 3 Queijos', '13.90', '&lt;p&gt;Espaguete com queijo parmes&amp;atilde;o, provolone e gouda.&lt;/p&gt;\r\n&lt;p&gt;Acompanha um refrigerante ca&amp;ccedil;ulinha.&lt;/p&gt;\r\n&lt;p&gt;Tempo de preparo &amp;eacute; de 15 minutos.&lt;/p&gt;', 'upload/2018/09/19/43c2c408f2e25421bfe593ebbdacc063.jpg', 37, 1, 1, '', 1, 1, 1, NULL, '', NULL, NULL, NULL, 89),
(19, 'Prato Executivo com Mignion', '15.90', '&lt;p&gt;Arroz, salada de alface, tomate e pepino, batatas fritas e 150 gramas de fil&amp;eacute; mignon&lt;/p&gt;\r\n&lt;p&gt;O cliente poder&amp;aacute; tamb&amp;eacute;m optar por fil&amp;eacute; de frango.&lt;/p&gt;\r\n&lt;p&gt;Tempo de preparo &amp;eacute; de 15 minutos.&lt;/p&gt;', 'upload/2018/09/18/0df5150a38b8ca10ed7490554780af72.jpg', 37, 1, 1, '', 1, 1, 1, NULL, '', NULL, NULL, NULL, 90),
(20, 'Deppuccino de Chocolate ', '9.00', '&lt;p&gt;&lt;strong&gt;Bebida gelada.&lt;/strong&gt;&lt;/p&gt;\r\n&lt;p&gt;300ml de leite, shot de cafe, chocolate, chocolate em calda, chantilly.&lt;/p&gt;\r\n&lt;p&gt;Tempo de preparo &amp;eacute; de 10 minutos.&lt;/p&gt;', 'upload/2018/03/08/30cdf928d38574f9775685826185ef33.jpg', 22, 1, 1, '', 0, 0, 1, '[\"3\"]', '[\"segunda\",\"terca\",\"quarta\",\"quinta\"]', 3, 17, 22, 69),
(21, 'Deppuccino de Oreo com Nutella ', '9.00', '&lt;p&gt;&lt;strong&gt;Bebida gelada.&lt;/strong&gt;&lt;/p&gt;\r\n&lt;p&gt;150 ml de leite, shot de expresso, oreo, nutella, calda de chocolate e chantilly.&lt;/p&gt;\r\n&lt;p&gt;Tempo de preparo &amp;eacute; de 10 minutos.&lt;/p&gt;\r\n&lt;p&gt;&amp;nbsp;&lt;/p&gt;', 'upload/2018/03/08/e09b6739a807a3a259358b9877511460.jpg', 22, 1, 1, '', 0, 0, 1, NULL, '', NULL, NULL, NULL, 1),
(23, 'Ice Cappuccino', '6.50', '&lt;div dir=&quot;auto&quot;&gt;&lt;strong&gt;Bebida gelada.&lt;/strong&gt;&lt;/div&gt;\r\n&lt;div dir=&quot;auto&quot;&gt;300 ml de leite, mix em p&amp;oacute; de gr&amp;atilde;os de caf&amp;eacute; e gelo.&lt;/div&gt;\r\n&lt;div dir=&quot;auto&quot;&gt;Batido no Liquidificador.&lt;/div&gt;\r\n&lt;div dir=&quot;auto&quot;&gt;&amp;nbsp;&lt;/div&gt;\r\n&lt;div dir=&quot;auto&quot;&gt;Tempo de preparo &amp;eacute; de 10 minutos.&lt;/div&gt;', 'upload/2018/09/19/1593e7eacb59621805594d03ba68de5e.jpg', 22, 1, 1, '', 0, 0, 1, NULL, '', NULL, NULL, NULL, 0),
(24, 'Ice Cioccolato  ', '6.50', '&lt;p&gt;&lt;strong&gt;Bebida gelada.&lt;/strong&gt;&lt;/p&gt;\r\n&lt;p&gt;300 ml de leite, mix em p&amp;oacute; de chocolate e gelo.&lt;/p&gt;\r\n&lt;p&gt;Batido no liquidificador.&lt;/p&gt;\r\n&lt;p&gt;Tempo de preparo &amp;eacute; de 10 minutos.&lt;/p&gt;', 'upload/2018/09/19/ec8c0d96f597fb081597d5b58705b169.jpg', 22, 1, 1, '', 0, 0, 1, NULL, '', NULL, NULL, NULL, 3),
(25, 'Limonada Rosa (S/L)', '6.50', '&lt;p&gt;&lt;strong&gt;Bebida gelada.&lt;/strong&gt;&lt;/p&gt;\r\n&lt;p&gt;300 ml de limonada, a&amp;ccedil;&amp;uacute;car, gelo e ess&amp;ecirc;ncia de groselha.&lt;/p&gt;\r\n&lt;p&gt;A&amp;ccedil;&amp;uacute;car &amp;eacute; opcional.&lt;/p&gt;\r\n&lt;p&gt;Tempo de preparo &amp;eacute; de 10 minutos.&lt;/p&gt;', 'upload/2018/09/14/f650a375ac3ebdcc70808cd144d5a704.jpg', 22, 1, 1, '', 0, 0, 1, NULL, '', NULL, NULL, NULL, 4),
(26, 'Limonada de Morango (S/L)', '7.50', '&lt;p&gt;&lt;strong&gt;Bebida gelada.&lt;/strong&gt;&lt;/p&gt;\r\n&lt;p&gt;300 ml de limonada, 100 gr de morango, a&amp;ccedil;&amp;uacute;car.&lt;/p&gt;\r\n&lt;p&gt;Batido no liquidificador.&lt;/p&gt;\r\n&lt;p&gt;A&amp;ccedil;&amp;uacute;car &amp;eacute; opcional.&lt;/p&gt;\r\n&lt;p&gt;Tempo de preparo &amp;eacute; de 10 minutos.&lt;/p&gt;', 'upload/2018/09/19/1a94589b9367825ae76d4d938061b7b5.png', 22, 1, 1, '', 0, 0, 1, NULL, '', NULL, NULL, NULL, 5),
(27, 'Limonada (S/L)', '6.00', '&lt;p&gt;&lt;strong&gt;Bebida gelada.&lt;/strong&gt;&lt;/p&gt;\r\n&lt;p&gt;250 ml de limonada, 100 ml de &amp;aacute;gua, a&amp;ccedil;&amp;uacute;car e gelo.&lt;/p&gt;\r\n&lt;p&gt;Ac&amp;uacute;car &amp;eacute; opcional.&lt;/p&gt;\r\n&lt;p&gt;Tempo de preparo &amp;eacute; de 10 minutos.&lt;/p&gt;', 'upload/2018/09/19/ded3c27337cb27fc9919f753fe1e6a63.jpg', 22, 1, 1, '', 0, 0, 1, NULL, '', NULL, NULL, NULL, 6),
(28, 'Café Expresso ', '2.00', '&lt;p&gt;&lt;strong&gt;Bebida quente&lt;/strong&gt;&lt;/p&gt;\r\n&lt;p&gt;7 gr de caf&amp;eacute; mo&amp;iacute;do na hora, prensada e 30 ml de &amp;aacute;gua.&lt;/p&gt;\r\n&lt;p&gt;Tempo de preparo &amp;eacute; de 5 minutos.&lt;/p&gt;', 'upload/2018/09/14/38ae1ca6954824486d4894cda9338a98.jpg', 22, 1, 1, '', 0, 0, 1, NULL, '', NULL, NULL, NULL, 7),
(29, 'Café Expresso com Doce de Leite ', '3.00', '&lt;p&gt;&lt;strong&gt;Bebida quente.&lt;/strong&gt;&lt;/p&gt;\r\n&lt;p&gt;7 gr de caf&amp;eacute; mo&amp;iacute;do na hora, prensada e 30 ml de &amp;aacute;gua.&lt;/p&gt;\r\n&lt;p&gt;Uma colher de doce de leite da casa.&lt;/p&gt;\r\n&lt;p&gt;Tempo de preparo &amp;eacute; de 5 minutos.&lt;/p&gt;', 'upload/2018/09/14/eecb89d3cbc3369456e2430dc70c19bd.jpg', 22, 1, 1, '', 0, 0, 1, NULL, '', NULL, NULL, NULL, 8),
(30, 'Café Expresso Duplo ', '4.00', '&lt;p&gt;&lt;strong&gt;Bebida quente.&lt;/strong&gt;&lt;/p&gt;\r\n&lt;p&gt;14 gr de caf&amp;eacute; mo&amp;iacute;do na hora, prensado e 60 ml de &amp;aacute;gua.&lt;/p&gt;\r\n&lt;p&gt;Tempo de preparo &amp;eacute; de 5 minutos.&lt;/p&gt;', 'upload/2018/09/18/b735885d2213d2c4a9d609ec4ac763ea.jpg', 22, 1, 1, '', 0, 0, 1, NULL, '', NULL, NULL, NULL, 9),
(31, 'Café Carioca ', '2.00', '&lt;p&gt;&lt;strong&gt;Bebida quente.&lt;/strong&gt;&lt;/p&gt;\r\n&lt;p&gt;7 gr de caf&amp;eacute; mo&amp;iacute;do na hora, prensado e 40 ml de &amp;aacute;gua.&lt;/p&gt;\r\n&lt;p&gt;Tempo de preparo &amp;eacute; de 5 minutos.&lt;/p&gt;', 'upload/2018/09/18/f999392ebbde583f2e80fa072b5efb3a.jpg', 22, 1, 1, '', 0, 0, 1, NULL, '', NULL, NULL, NULL, 10),
(32, 'Café Carioca Duplo', '4.00', '&lt;p&gt;&lt;strong&gt;Bebida quente.&lt;/strong&gt;&lt;/p&gt;\r\n&lt;p&gt;14 gr de caf&amp;eacute; mo&amp;iacute;do na hora, prensado e 80 ml de &amp;aacute;gua.&lt;/p&gt;\r\n&lt;p&gt;Tempo de preparo &amp;eacute; de 5 minutos.&lt;/p&gt;', 'upload/2018/09/18/b895ee72c27e4a51da8b744135b7b828.jpg', 22, 1, 1, '', 0, 0, 1, NULL, '', NULL, NULL, NULL, 11),
(33, 'Café Expresso Machiatto ', '2.50', '&lt;p&gt;&lt;strong&gt;Bebida quente.&lt;/strong&gt;&lt;/p&gt;\r\n&lt;p&gt;1 shot de expresso e espuma de leite vaporizado.&lt;/p&gt;', 'upload/2018/09/19/ea665bf224d41f3767645f67779bb2f1.png', 22, 1, 1, '', 0, 0, 1, NULL, '', NULL, NULL, NULL, 12),
(34, 'Café com Leite ', '4.50', '&lt;p&gt;&lt;strong&gt;Bebida Quente.&lt;/strong&gt;&lt;/p&gt;\r\n&lt;p&gt;1 shot de expresso e 150 ml de leite vaporizado.&lt;/p&gt;\r\n&lt;p&gt;Tempo de preparo &amp;eacute; de 5 minutos.&lt;/p&gt;', 'upload/2018/09/19/eb34c96a8fa725fa359a08844856ba47.jpg', 22, 1, 1, '', 0, 0, 1, NULL, '', NULL, NULL, NULL, 13),
(35, 'Cappuccino Canela ', '6.50', '&lt;p&gt;&lt;strong&gt;Bebida quente.&lt;/strong&gt;&lt;/p&gt;\r\n&lt;p&gt;Canela em p&amp;oacute;, 1 shot de expresso e partes iguais de leite vaporizado e espuma do leite.&lt;/p&gt;\r\n&lt;p&gt;Pode ser acrescentado chantilly, como na foto.&lt;/p&gt;\r\n&lt;p&gt;Tempo de preparo &amp;eacute; de 5 minutos.&lt;/p&gt;', 'upload/2018/09/19/0c5efb5a56121026944cb4e7a67095cc.png', 22, 1, 1, '', 0, 0, 1, NULL, '', NULL, NULL, NULL, 14),
(36, 'Mocca', '6.50', '&lt;p&gt;&lt;strong&gt;Bebida quente.&lt;/strong&gt;&lt;/p&gt;\r\n&lt;p&gt;Calda de chocolate, 1 shot de expresso, leite vaporizado e espuma de leite.&lt;/p&gt;\r\n&lt;p&gt;Pode ser acrescentado chantilly.&lt;/p&gt;\r\n&lt;p&gt;Tempo de preparo &amp;eacute; de 10 minutos.&lt;/p&gt;', 'upload/2018/09/19/f058f6d990d09fc64667b7d706dac40b.jpg', 22, 1, 1, '', 1, 0, 1, NULL, '', NULL, NULL, NULL, 15),
(37, 'Mocca de Leite de Coco (S/L)', '8.50', '&lt;p&gt;&lt;strong&gt;Bebida quente.&lt;/strong&gt;&lt;/p&gt;\r\n&lt;p&gt;Calda de chocolate, 1 shot de expresso, leite de coco vaporizado.&lt;/p&gt;\r\n&lt;p&gt;Pode ser acrescentado chantilly.&lt;/p&gt;\r\n&lt;p&gt;Tempo de preparo &amp;eacute; de 10 minutos.&lt;/p&gt;', 'upload/2018/09/19/406705f577b2ef5dc47959a51f91d0f9.jpg', 22, 1, 1, '', 0, 0, 1, NULL, '', NULL, NULL, NULL, 16),
(38, 'Café Havaiano', '6.50', '&lt;p&gt;&lt;strong&gt;Bebida quente.&lt;/strong&gt;&lt;/p&gt;\r\n&lt;p&gt;1 shot de expresso, 1 shot de leite de coco, leite vaporizado e coco ralado.&lt;/p&gt;\r\n&lt;p&gt;Pode ser acrescentado chantilly como na foto.&lt;/p&gt;\r\n&lt;p&gt;Tempo de preparo &amp;eacute; de 5 minutos.&lt;/p&gt;', 'upload/2018/09/19/4804336674f431d9075664d4fca8e85b.jpg', 22, 1, 1, '', 0, 0, 1, NULL, '', NULL, NULL, NULL, 17),
(39, 'Chai Latte ', '5.00', '&lt;p&gt;&lt;strong&gt;Bebida quente.&lt;/strong&gt;&lt;/p&gt;\r\n&lt;p&gt;Mix de canela, chocolate e especiarias em p&amp;oacute; e 150 ml de leite vaporizado.&lt;/p&gt;\r\n&lt;p&gt;Tempo de preparo &amp;eacute; de 5 minutos.&lt;/p&gt;', 'upload/2018/09/20/e85d4bf215df9608a9d4f50d9a8ad6d4.jpg', 22, 1, 1, '', 0, 0, 1, NULL, '', NULL, NULL, NULL, 18),
(40, 'Café Nutella Latte', '6.50', '&lt;p&gt;&lt;strong&gt;Bebida quente.&lt;/strong&gt;&lt;/p&gt;\r\n&lt;p&gt;Nutella, 1 shot de expresso, leite vaporizado e espuma de leite.&lt;/p&gt;\r\n&lt;p&gt;Pode ser acrescentado chantilly.&lt;/p&gt;\r\n&lt;p&gt;Tempo de preparo &amp;eacute; de 10 minutos.&lt;/p&gt;', 'upload/2018/09/20/0aac0d123c565a435d5988128da4c671.jpg', 22, 1, 1, '', 0, 0, 1, NULL, '', NULL, NULL, NULL, 19),
(41, 'Café Doce de Leite', '7.50', '&lt;p&gt;&lt;strong&gt;Bebida quente.&lt;/strong&gt;&lt;/p&gt;\r\n&lt;p&gt;Doce de leite da casa, 1 shot de expresso, leite vaporizado e espuma de leite.&lt;/p&gt;\r\n&lt;p&gt;Pode ser acrescentado chantilly como na foto.&lt;/p&gt;\r\n&lt;p&gt;Tempo de preparo &amp;eacute; de 10 minutos.&lt;/p&gt;', 'upload/2018/09/19/bb6708c4d128b5a47a4561d331a4b0d5.jpg', 22, 1, 1, '', 0, 0, 1, NULL, '', NULL, NULL, NULL, 20),
(42, 'Prensa Francesa ( 350 ml)', '15.90', '&lt;p&gt;&lt;strong&gt;Bebida quente.&lt;/strong&gt;&lt;/p&gt;\r\n&lt;p&gt;20 gr de caf&amp;eacute; mo&amp;iacute;do na hora e 350 ml de &amp;aacute;gua quente.&lt;/p&gt;\r\n&lt;p&gt;Tempo de preparo &amp;eacute; de 5 minutos.&lt;/p&gt;', 'upload/2018/09/20/31a832becdc0e6f4b4cbb8477395b0a5.png', 22, 1, 1, '', 0, 0, 1, NULL, '', NULL, NULL, NULL, 21),
(43, 'Chá de Erva Doce', '3.50', '&lt;p&gt;&lt;strong&gt;Ch&amp;aacute; quente.&lt;/strong&gt;&lt;/p&gt;\r\n&lt;p&gt;Tempo de preparo &amp;eacute; de 5 minutos.&lt;/p&gt;', 'upload/2018/09/20/6e47cdec515631960897f62665f91599.jpg', 22, 1, 1, '', 0, 0, 1, NULL, '', NULL, NULL, NULL, 22),
(44, 'Lady Grey', '3.50', '&lt;p&gt;&lt;strong&gt;Ch&amp;aacute; quente.&lt;/strong&gt;&lt;/p&gt;\r\n&lt;p&gt;Tempo de preparo &amp;eacute; de 5 minutos.&lt;/p&gt;', 'upload/2018/09/20/bc00bc302d56cf34b41a18eaa8662967.jpg', 22, 1, 1, '', 0, 0, 1, NULL, '', NULL, NULL, NULL, 23),
(45, 'Chá de Hortelã', '3.50', '&lt;p&gt;&lt;strong&gt;Ch&amp;aacute; quente.&lt;/strong&gt;&lt;/p&gt;\r\n&lt;p&gt;Tempo de preparo &amp;eacute; de 5 minutos.&lt;/p&gt;', 'upload/2018/09/20/ffcfa22392f829ba1cd1f8928d5f1120.jpg', 22, 1, 1, '', 0, 0, 1, NULL, '', NULL, NULL, NULL, 24),
(46, 'Chá Preto com Frutas Vermelhas', '3.50', '&lt;p&gt;&lt;strong&gt;Ch&amp;aacute; quente.&lt;/strong&gt;&lt;/p&gt;\r\n&lt;p&gt;Tempo de preparo &amp;eacute; de 5 minutos.&lt;/p&gt;', 'upload/2018/09/20/2d76618ee06b0031edbcf9ad67e53227.jpg', 22, 1, 1, '', 0, 0, 1, NULL, '', NULL, NULL, NULL, 25),
(47, 'Earl Grey', '3.50', '&lt;p&gt;&lt;strong&gt;Ch&amp;aacute; quente.&lt;/strong&gt;&lt;/p&gt;\r\n&lt;p&gt;Tempo de preparo &amp;eacute; de 5 minutos.&lt;/p&gt;', 'upload/2018/09/20/af2d804940c25f0bc594096a61c07eb2.jpg', 22, 1, 1, '', 0, 0, 1, NULL, '', NULL, NULL, NULL, 26),
(48, 'Price of Wales', '3.50', '&lt;p&gt;&lt;strong&gt;Ch&amp;aacute; quente.&lt;/strong&gt;&lt;/p&gt;\r\n&lt;p&gt;Tempo de preparo &amp;eacute; de 5 minutos.&lt;/p&gt;', 'upload/2018/09/20/094b5149c5c2b0fe739578aba0e010b0.jpg', 22, 1, 1, '', 0, 0, 1, NULL, '', NULL, NULL, NULL, 27),
(49, 'English Breakfest', '3.50', '&lt;p&gt;&lt;strong&gt;Ch&amp;aacute; quente.&lt;/strong&gt;&lt;/p&gt;\r\n&lt;p&gt;Tempo de preparo &amp;eacute; de 5 minutos.&lt;/p&gt;', 'upload/2018/09/20/862b9041858705c308b24c57dff46113.jpg', 22, 1, 1, '', 0, 0, 1, NULL, '', NULL, NULL, NULL, 28),
(50, 'Camomila com Hortelã', '3.50', '&lt;p&gt;&lt;strong&gt;Ch&amp;aacute; quente.&lt;/strong&gt;&lt;/p&gt;\r\n&lt;p&gt;Tempo de preparo &amp;eacute; de 5 minutos.&lt;/p&gt;', 'upload/2018/09/20/247bde085a4b468df099b233144cb52c.jpg', 22, 1, 1, '', 0, 0, 1, NULL, '', NULL, NULL, NULL, 29),
(52, 'Camomila com Mel e Baunilha', '3.50', '&lt;p&gt;&lt;strong&gt;Ch&amp;aacute; quente.&lt;/strong&gt;&lt;/p&gt;\r\n&lt;p&gt;Tempo de preparo &amp;eacute; de 5 minutos.&lt;/p&gt;', 'upload/2018/09/20/a9d28482d01966f75c23f3e4ca973310.jpg', 22, 1, 1, '', 0, 0, 1, NULL, '', NULL, NULL, NULL, 30),
(53, 'Capim Limão', '3.50', '&lt;p&gt;&lt;strong&gt;Ch&amp;aacute; quente.&lt;/strong&gt;&lt;/p&gt;\r\n&lt;p&gt;Tempo de preparo &amp;eacute; de 5 minutos.&lt;/p&gt;', 'upload/2018/09/20/ae2ca17a55578f9765ebdfe573f7634c.jpg', 22, 1, 1, '', 0, 0, 1, NULL, '', NULL, NULL, NULL, 31),
(54, 'Chá Verde com Gengibre', '5.50', '&lt;p&gt;&lt;strong&gt;Bebida Gelada.&lt;/strong&gt;&lt;/p&gt;\r\n&lt;p&gt;200 ml de ch&amp;aacute; preparado na delion. Mix de gengibre, ch&amp;aacute; verde, hortel&amp;atilde;, mel e lim&amp;atilde;o.&amp;nbsp;&lt;/p&gt;\r\n&lt;p&gt;Batido no liquidifcador com gelo.&lt;/p&gt;\r\n&lt;p&gt;Tempo de preparo &amp;eacute; de 10 minutos.&lt;/p&gt;', 'upload/2018/09/19/0e52aae169bfdc1fb2d6a75ab66d2f0c.jpg', 22, 1, 1, '', 0, 0, 1, NULL, '', NULL, NULL, NULL, 32),
(55, 'Chá Matte', '4.00', '&lt;p&gt;&lt;strong&gt;Ch&amp;aacute; quente ou gelado.&lt;/strong&gt;&lt;/p&gt;\r\n&lt;p&gt;Mix de ervas, escolhidos pela Delion, em infus&amp;atilde;o em &amp;aacute;gua quente.&lt;/p&gt;\r\n&lt;p&gt;Pode ser consumido gelado ou quente.&lt;/p&gt;\r\n&lt;p&gt;Tempo de preparo &amp;eacute; de 5 minutos.&lt;/p&gt;', 'upload/2018/09/20/34a1e2e62990f99cc198157c80fba38d.png', 22, 1, 1, '', 0, 0, 1, NULL, '', NULL, NULL, NULL, 33),
(57, 'Mix Tea de Limão ', '5.00', '&lt;p&gt;&lt;strong&gt;Bebida Gelada.&lt;/strong&gt;&lt;/p&gt;\r\n&lt;p&gt;300 ml de &amp;aacute;gua, mix em p&amp;oacute; sabor lim&amp;atilde;o, gelo.&lt;/p&gt;\r\n&lt;p&gt;Batido em liquidificador.&lt;/p&gt;\r\n&lt;p&gt;J&amp;aacute; vem ado&amp;ccedil;ado.&lt;/p&gt;\r\n&lt;p&gt;Tempo de preparo &amp;eacute; de 10 minutos.&lt;/p&gt;', 'upload/2018/09/19/f620eddda4246999ee9d905620be632c.png', 22, 1, 1, '', 0, 0, 1, NULL, '', NULL, NULL, NULL, 34),
(58, 'Mix Tea de Pêssego ', '5.00', '&lt;p&gt;&lt;strong&gt;Bebida Gelada.&lt;/strong&gt;&lt;/p&gt;\r\n&lt;p&gt;300 ml de &amp;aacute;gua, mix em p&amp;oacute; sabor p&amp;ecirc;ssego, gelo.&lt;/p&gt;\r\n&lt;p&gt;Batido em liquidificador.&lt;/p&gt;\r\n&lt;p&gt;J&amp;aacute; vem ado&amp;ccedil;ado.&lt;/p&gt;\r\n&lt;p&gt;Tempo de preparo &amp;eacute; de 10 minutos.&lt;/p&gt;', 'upload/2018/09/19/0eec56a3a6928c551858bcac2c04ff01.png', 22, 1, 1, '', 0, 0, 1, NULL, '', NULL, NULL, NULL, 35),
(59, 'Chá Mate de Maracujá ', '6.00', '&lt;p&gt;&lt;strong&gt;Ch&amp;aacute; gelado.&lt;/strong&gt;&lt;/p&gt;\r\n&lt;p&gt;Ch&amp;aacute; mate, aromatizante de maracuj&amp;aacute;, leite condensado e gelo.&lt;/p&gt;\r\n&lt;p&gt;Batido no liquidificador.&lt;/p&gt;\r\n&lt;p&gt;Leite condensado &amp;eacute; opcional.&lt;/p&gt;\r\n&lt;p&gt;Tempo de preparo &amp;eacute; de 10 minutos.&lt;/p&gt;\r\n&lt;p&gt;&amp;nbsp;&lt;/p&gt;', 'upload/2018/09/20/a4fe6b3d691cebccea545e488b925a4e.png', 22, 1, 1, '', 0, 0, 1, NULL, '', NULL, NULL, NULL, 36),
(60, 'Chá Mate de Abacaxi ', '6.00', '&lt;p&gt;&lt;strong&gt;Ch&amp;aacute; gelado.&lt;/strong&gt;&lt;/p&gt;\r\n&lt;p&gt;Ch&amp;aacute; mate, aromatizante de abacaxi, leite condensado e gelo.&lt;/p&gt;\r\n&lt;p&gt;Batido no liquidificador.&lt;/p&gt;\r\n&lt;p&gt;Leite condensado &amp;eacute; opcional.&lt;/p&gt;\r\n&lt;p&gt;Tempo de preparo &amp;eacute; de 10 minutos.&lt;/p&gt;', 'upload/2018/09/20/ec4e35b4bab8df0d6b7141f1d8e515fd.png', 22, 1, 1, '', 0, 0, 1, NULL, '', NULL, NULL, NULL, 37),
(61, 'Chá de Hibisco com Canela', '5.50', '&lt;p&gt;&lt;strong&gt;Ch&amp;aacute; gelado ou quente.&lt;/strong&gt;&lt;/p&gt;\r\n&lt;p&gt;Ch&amp;aacute; de hibisco e canela preparado na casa. Batido com gelo.&lt;/p&gt;\r\n&lt;p&gt;Pode ser tomado quente tamb&amp;eacute;m.&amp;nbsp;&lt;/p&gt;\r\n&lt;p&gt;Tempo de preparo &amp;eacute; de 10 minutos.&lt;/p&gt;', 'upload/2018/09/18/e50da09128641608d4c69761ef9993e4.png', 22, 1, 1, '', 0, 0, 1, NULL, '', NULL, NULL, NULL, 38),
(62, 'Milkshake de Doce de Leite', '14.50', '&lt;p&gt;&lt;strong&gt;Bebida gelada.&lt;/strong&gt;&lt;/p&gt;\r\n&lt;p&gt;300 ml de leite, sorvete, doce de leite da casa, calda de caramelo e chantilly.&lt;/p&gt;\r\n&lt;p&gt;Tempo de preparo &amp;eacute; de 10 minutos.&lt;/p&gt;', 'upload/2018/09/19/0fb62202a509da5aad4fee89617495ea.jpg', 22, 1, 1, '', 0, 0, 1, NULL, '', NULL, NULL, NULL, 39),
(63, 'Milkshake de Nutella', '14.50', '&lt;p&gt;&lt;strong&gt;Bebida Gelada.&lt;/strong&gt;&lt;/p&gt;\r\n&lt;p&gt;300 ml de leite, sorvete, nutella, calda de chocolate e chantilly.&lt;/p&gt;\r\n&lt;p&gt;Tempo de preparo &amp;eacute; de 10 minutos.&lt;/p&gt;', 'upload/2018/09/20/387d9ee0c6f8b20f66a70614dac1d435.jpg', 22, 1, 1, '', 0, 0, 1, NULL, '', NULL, NULL, NULL, 40),
(64, 'Chocolate Quente Tradicional', '8.50', '&lt;p&gt;&lt;strong&gt;Bebida quente.&lt;/strong&gt;&lt;/p&gt;\r\n&lt;p&gt;200ml de leite, chocolate especial em p&amp;oacute;, a&amp;ccedil;&amp;uacute;car, baunilha, creme de leite, marshmallow e chantilly.&lt;/p&gt;\r\n&lt;p&gt;A&amp;ccedil;&amp;uacute;car, marshmallow e chantilly s&amp;atilde;o opcionais.&lt;/p&gt;\r\n&lt;p&gt;Tempo de preparo &amp;eacute; de 10 minutos.&lt;/p&gt;', 'upload/2018/09/19/9ad563ceddb1a347e0bee718cf3a2730.jpg', 22, 1, 1, '', 0, 0, 1, NULL, '', NULL, NULL, NULL, 41),
(65, 'Torta Holandesa Tradicional', '50.00', '&lt;p&gt;Base de bolacha, creme a base de manteiga, a&amp;ccedil;&amp;uacute;car e baunilha, ganache de chocolate ao leite.&lt;/p&gt;\r\n&lt;p&gt;Vendida por quilo.&lt;/p&gt;', 'upload/2018/09/20/f7deb5a6c0f37daafc609f531ec77a7f.jpg', 28, 1, 1, '', 0, 0, 1, NULL, '', NULL, NULL, NULL, 136),
(75, 'Torta Trufada de Leite Ninho', '65.00', '&lt;p&gt;Base de bolacha, creme de leite ninho e chocolate amargo ao rum.&lt;/p&gt;', 'upload/2018/09/20/003da7db8e52b347267409c8615c3125.jpg', 28, 1, 1, '', 1, 0, 1, NULL, '', NULL, NULL, NULL, 137),
(82, 'Empanada de Queijo e Tomate', '4.25', '&lt;p&gt;&lt;strong&gt;SALGADO ASSADO&lt;/strong&gt;&lt;br /&gt;Todos os produtos s&amp;atilde;o preparados na hora.&lt;br /&gt;Caso o sabor desejado n&amp;atilde;o esteja dispon&amp;iacute;vel no expositor, solicite a&amp;nbsp;sua atendente que o mesmo ser&amp;aacute; preparado.&lt;br /&gt;O tempo de espera &amp;eacute; de 5 minutos, dependendo do movimento e do tipo de salgado solicitado.&lt;/p&gt;', 'upload/2018/09/18/b976e0138c2a15f42c42f5f2fd48f935.jpg', 26, 1, 1, '', 0, 0, 1, NULL, '', NULL, NULL, NULL, 70),
(83, 'Empanada de Queijo com Alho Poró', '4.25', '&lt;p&gt;&lt;strong&gt;SALGADO ASSADO&lt;/strong&gt;&lt;br /&gt;Todos os produtos s&amp;atilde;o preparados na hora.&lt;br /&gt;Caso o sabor desejado n&amp;atilde;o esteja dispon&amp;iacute;vel no expositor, solicite a&amp;nbsp;sua atendente que o mesmo ser&amp;aacute; preparado.&lt;br /&gt;O tempo de espera &amp;eacute; de 5 minutos, dependendo do movimento e do tipo de salgado solicitado.&lt;/p&gt;', 'upload/2018/09/18/b57b6fdc5d6b0c8045661aab6d2e834f.jpg', 26, 1, 1, '', 0, 0, 1, NULL, '', NULL, NULL, NULL, 71),
(84, 'Empanada de Palmito', '4.25', '&lt;p&gt;&lt;strong&gt;SALGADO ASSADO&lt;/strong&gt;&lt;br /&gt;Todos os produtos s&amp;atilde;o preparados na hora.&lt;br /&gt;Caso o sabor desejado n&amp;atilde;o esteja dispon&amp;iacute;vel no expositor, solicite a&amp;nbsp;sua atendente que o mesmo ser&amp;aacute; preparado.&lt;br /&gt;O tempo de espera &amp;eacute; de 5 minutos, dependendo do movimento e do tipo de salgado solicitado.&lt;/p&gt;', 'upload/2018/09/18/7ab873b6049becbad33bb4cf7310fa37.jpg', 26, 1, 1, '', 0, 0, 1, NULL, '', NULL, NULL, NULL, 72),
(85, 'Empanada de 3 Queijos', '4.50', '&lt;p&gt;&lt;strong&gt;SALGADO ASSADO&lt;/strong&gt;&lt;br /&gt;Todos os produtos s&amp;atilde;o preparados na hora.&lt;br /&gt;Caso o sabor desejado n&amp;atilde;o esteja dispon&amp;iacute;vel no expositor, solicite a&amp;nbsp;sua atendente que o mesmo ser&amp;aacute; preparado.&lt;br /&gt;O tempo de espera &amp;eacute; de 5 minutos, dependendo do movimento e do tipo de salgado solicitado.&lt;/p&gt;', 'upload/2018/09/18/657fdf32a4131b8eeba58e7012658590.jpg', 26, 1, 1, '', 0, 0, 1, NULL, '', NULL, NULL, NULL, 73),
(86, 'Quiche de 3 Queijos', '9.90', '&lt;p&gt;&lt;strong&gt;SALGADO ASSADO&lt;/strong&gt;&lt;br /&gt;Todos os produtos s&amp;atilde;o preparados na hora.&lt;br /&gt;Caso o sabor desejado n&amp;atilde;o esteja dispon&amp;iacute;vel no expositor, solicite a&amp;nbsp;sua atendente que o mesmo ser&amp;aacute; preparado.&lt;br /&gt;O tempo de espera &amp;eacute; de 10 a 30 minutos, dependendo do movimento e do tipo de salgado solicitado.&lt;/p&gt;', 'upload/2018/03/07/5bc6f3e54b6a4373c66f9756508cbc4e.jpg', 26, 1, 1, '', 0, 0, 1, NULL, '', NULL, NULL, NULL, 74),
(87, 'Quiche de Frango', '9.90', '&lt;p&gt;&lt;strong&gt;SALGADO ASSADO&lt;/strong&gt;&lt;br /&gt;Todos os produtos s&amp;atilde;o preparados na hora.&lt;br /&gt;Caso o sabor desejado n&amp;atilde;o esteja dispon&amp;iacute;vel no expositor, solicite a&amp;nbsp;sua atendente que o mesmo ser&amp;aacute; preparado.&lt;br /&gt;O tempo de espera &amp;eacute; de 10 a 30 minutos, dependendo do movimento&amp;nbsp;e do tipo de salgado solicitado.&lt;/p&gt;', 'upload/2018/03/07/55891cf4a36d064fbd1ff786da5b73a6.jpg', 26, 1, 1, '', 0, 0, 1, NULL, '', NULL, NULL, NULL, 75),
(88, 'Quiche de Alho Poró', '9.90', '&lt;p&gt;&lt;strong&gt;SALGADO ASSADO&lt;/strong&gt;&lt;br /&gt;Todos os produtos s&amp;atilde;o preparados na hora.&lt;br /&gt;Caso o sabor desejado n&amp;atilde;o esteja dispon&amp;iacute;vel no expositor, solicite a&amp;nbsp;sua atendente que o mesmo ser&amp;aacute; preparado.&lt;br /&gt;O tempo de espera &amp;eacute; de 10 a 30 minutos, dependendo do movimento e do tipo de salgado solicitado.&lt;/p&gt;', 'upload/2018/09/20/e418ac5a7c2a7cc7fb1833a799023373.jpg', 26, 1, 1, '', 0, 0, 1, NULL, '', NULL, NULL, NULL, 76),
(91, 'Pão de Queijo (Por kg)', '17.50', '&lt;p&gt;&lt;strong&gt;O p&amp;atilde;o de queijo &amp;eacute; vendido por quilo.&lt;/strong&gt;&lt;/p&gt;\r\n&lt;p&gt;Caso n&amp;atilde;o esteja dispon&amp;iacute;vel no expositor, solicite a&amp;nbsp;sua atendente que o mesmo ser&amp;aacute; preparado.&lt;br /&gt;O tempo de espera &amp;eacute; de 20 minutos, para assar.&lt;/p&gt;', 'upload/2018/09/14/017f219788eade7b2c5803ed6d715368.jpg', 26, 1, 1, '', 0, 0, 1, NULL, '', NULL, NULL, NULL, 77),
(92, 'Risole de Carne com Ovos', '4.50', '&lt;p&gt;&lt;strong&gt;SALGADO FRITO&lt;/strong&gt;&lt;/p&gt;\r\n&lt;p&gt;Risoles de carne com ovos.&lt;/p&gt;\r\n&lt;p&gt;Caso&amp;nbsp; n&amp;atilde;o esteja dispon&amp;iacute;vel no expositor, solicite a&amp;nbsp;sua atendente que o mesmo ser&amp;aacute; preparado.&lt;/p&gt;\r\n&lt;p&gt;O tempo de espera &amp;eacute; de 15 minutos.&lt;/p&gt;\r\n&lt;p&gt;se a fritadeira j&amp;aacute; estiver ligada o tempo de fritar &amp;eacute; de 5 minutos.&lt;/p&gt;', 'upload/2018/09/14/9efd1e615286fd38e803fb78231b1708.jpg', 26, 1, 1, '', 0, 1, 1, NULL, '', NULL, NULL, NULL, 78),
(93, 'Coxinha de Frango ', '4.50', '&lt;p&gt;&lt;strong&gt;SALGADO FRITO&lt;/strong&gt;&lt;/p&gt;\r\n&lt;p&gt;Coxinha de Frango com catup&amp;iacute;ry.&lt;/p&gt;\r\n&lt;p&gt;Caso&amp;nbsp; n&amp;atilde;o esteja dispon&amp;iacute;vel no expositor, solicite a&amp;nbsp;sua atendente que o mesmo ser&amp;aacute; preparado.&lt;/p&gt;\r\n&lt;p&gt;O tempo de espera &amp;eacute; de 15 minutos.&lt;/p&gt;\r\n&lt;p&gt;se a fritadeira j&amp;aacute; estiver ligada o tempo de fritar &amp;eacute; de 5 minutos.&lt;/p&gt;', 'upload/2018/09/18/cd83b5bd8f7b504cc773a526e6f50b28.jpg', 26, 1, 1, '', 0, 1, 1, NULL, '', NULL, NULL, NULL, 79),
(95, 'Empanada Frita de Carne com Ovos e Azeitona', '4.50', '&lt;p&gt;&lt;strong&gt;Salgado Assado.&lt;/strong&gt;&lt;/p&gt;\r\n&lt;p&gt;Todos os produtos s&amp;atilde;o preparados na hora.&lt;br /&gt;Caso o sabor desejado n&amp;atilde;o esteja dispon&amp;iacute;vel no expositor, solicite a&amp;nbsp;sua atendente que o mesmo ser&amp;aacute; preparado.&lt;br /&gt;O tempo de espera &amp;eacute; de 5 minutos, dependendo do movimento.&lt;/p&gt;', 'upload/2018/09/18/35943db64be55a93ff2d492149279f4b.jpg', 26, 1, 1, '', 0, 0, 1, NULL, '', NULL, NULL, NULL, 80),
(96, 'Café Americano', '11.50', '&lt;p&gt;Duas torradas com manteiga, ovos mexidos e 100 gramas de bacon.&lt;/p&gt;\r\n&lt;p&gt;10 a 20 minutos &amp;eacute; o tempo de preparo.&lt;/p&gt;', 'upload/2018/09/18/a31ae908d944190a88e909b153f34995.jpg', 38, 1, 1, '', 0, 0, 1, NULL, '', NULL, NULL, NULL, 93),
(97, 'Café Americano Light', '11.50', '&lt;p&gt;Duas torradas com manteiga, ovos mexidos e caf&amp;eacute; com leite.&lt;/p&gt;\r\n&lt;p&gt;10 a 20 minutos &amp;eacute; o tempo de preparo.&lt;/p&gt;', 'upload/2018/09/19/1c914cad5f7a051b9af6ef200762a2da.jpg', 38, 1, 1, '', 0, 0, 1, NULL, '', NULL, NULL, NULL, 94),
(98, 'Pão na Chapa', '2.00', '&lt;p&gt;P&amp;atilde;o franc&amp;ecirc;s com manteiga na chapa.&lt;/p&gt;\r\n&lt;p&gt;tempo de preparo &amp;eacute; de 5 a 10 minutos&lt;/p&gt;', 'upload/2018/09/20/13ef44b0fbd39b6a5a79b3976e9ca0c1.jpg', 27, 1, 1, '', 0, 1, 1, NULL, '', NULL, NULL, NULL, 101),
(99, 'Misto Quente', '5.50', '&lt;p&gt;P&amp;atilde;o franc&amp;ecirc;s, manteiga, 2 fatias de queijo prato e 2 fatias de presunto.&lt;/p&gt;\r\n&lt;p&gt;Tempo de preparo &amp;eacute; de 5 a 10 minutos.&lt;/p&gt;', 'upload/2018/09/19/81f3e9354f3cf278ea6e58420e787f38.jpg', 27, 1, 1, '', 0, 1, 1, NULL, '', NULL, NULL, NULL, 102),
(100, 'Queijo Quente', '6.00', '&lt;p&gt;P&amp;atilde;o franc&amp;ecirc;s, queijo prato, queijo gouda, queijo parmes&amp;atilde;o e queijo provolone.&lt;/p&gt;\r\n&lt;p&gt;Tempo de preparo &amp;eacute; de 5 a 10 minutos.&lt;/p&gt;', 'upload/2018/09/14/ae82d34c9702b0184e4d76455b7808f6.jpg', 27, 1, 1, '', 0, 1, 1, NULL, '', NULL, NULL, NULL, 103),
(101, 'Bauru', '6.00', '&lt;p&gt;P&amp;atilde;o franc&amp;ecirc;s, manteiga, 2 fatias de queijo prato, 2 fatias de presunto e tomate.&lt;/p&gt;\r\n&lt;p&gt;Tempo de preparo &amp;eacute; de 5 a 10 minutos.&lt;/p&gt;', 'upload/2018/03/09/a4e3108bfda162b2389a9ead592b1134.jpg', 27, 1, 1, '', 0, 1, 1, NULL, '', NULL, NULL, NULL, 104),
(102, 'Pão com Ovo', '8.00', '&lt;p&gt;P&amp;atilde;o franc&amp;ecirc;s tostado, com ovos e ervas.&lt;/p&gt;\r\n&lt;p&gt;Tempo de preparo &amp;eacute; de 5 a 10 minutos.&lt;/p&gt;', 'upload/2018/09/20/d5853a0e8af4606260699656bf93088f.png', 27, 1, 1, '', 0, 0, 1, NULL, '', NULL, NULL, NULL, 105),
(103, 'Pão com Omelete', '9.00', '&lt;p&gt;P&amp;atilde;o franc&amp;ecirc;s tostado com omelete.&lt;/p&gt;\r\n&lt;p&gt;Tempo de preparo &amp;eacute; de 5 a 10 minutos.&lt;/p&gt;', 'upload/2018/09/20/8fce6de6ef42d2ac3761b5b79c20d78b.png', 27, 1, 1, '', 0, 0, 1, NULL, '', NULL, NULL, NULL, 106),
(107, 'Mortadela Tradicional', '12.90', '&lt;p&gt;P&amp;atilde;o franc&amp;ecirc;s, bacon fatiado, 75 gramas de mortadela Ceratti, maionese, queijo e molho especial.&lt;/p&gt;\r\n&lt;p&gt;Tempo de preparo &amp;eacute; de 10 a 15 minutos.&lt;/p&gt;', 'upload/2018/09/14/0c1b475f2fcad9a533aaf2e3ebf59fd7.jpg', 27, 1, 1, '', 0, 1, 1, NULL, '', NULL, NULL, NULL, 107),
(108, 'Linguiça Defumada', '14.90', '&lt;p&gt;P&amp;atilde;o franc&amp;ecirc;s, maionese de salsa, bacon fatiado e lingui&amp;ccedil;a defumada.&lt;/p&gt;\r\n&lt;p&gt;Tempo de preparo &amp;eacute; de 10 a 15minutos.&lt;/p&gt;', 'upload/2018/09/14/6c8b1a6fbf322c9e8507e947a0568744.jpg', 27, 1, 1, '', 0, 1, 1, NULL, '', NULL, NULL, NULL, 108),
(109, 'Sanduíche Mignon', '16.90', '&lt;p&gt;&amp;nbsp;Pao tostado, 100 gr de mignon e molho especial de parmesao&lt;/p&gt;\r\n&lt;p&gt;Tempo de preparo &amp;eacute; de 5 a 10 minutos.&lt;/p&gt;', 'upload/2018/09/20/4a35f74ed635ad96497cc69c1f13c021.jpg', 27, 1, 1, '', 1, 1, 1, NULL, '', NULL, NULL, NULL, 109),
(111, 'Vegetariano', '7.00', '&lt;p&gt;P&amp;atilde;o de forma, tomate, alface, cebola, alho-por&amp;oacute;, queijo branco e or&amp;eacute;gano.&lt;/p&gt;\r\n&lt;p&gt;Tempo de preparo &amp;eacute; de 5 a 10 minutos.&lt;/p&gt;', 'upload/2018/09/20/a7966903545e3ae09a60bd899dc8aca6.png', 27, 1, 1, '', 0, 1, 1, NULL, '', NULL, NULL, NULL, 110),
(117, 'Cheesecake de Amendoim', '4.00', '&lt;p&gt;Base de negresco, creme de amendoim e ganache de chocolate ao leite.&lt;/p&gt;', 'upload/2018/09/20/9ceaac561793d249f0d2c511d2b371f2.jpg', 25, 1, 1, '', 0, 0, 1, NULL, '', NULL, NULL, NULL, 121),
(119, 'Palha Italiana de Chocolate (Por kg)', '40.00', '&lt;p&gt;Massa de brigadeiro, com chococolate especial e bolacha de leite e mel.&lt;/p&gt;\r\n&lt;p&gt;Vendida por quilo.&lt;/p&gt;', 'upload/2018/09/19/6c7236cd11e5613a894190c0f083c439.jpg', 25, 1, 1, '', 0, 1, 1, NULL, '', NULL, NULL, NULL, 123),
(120, 'Palha Italiana de Leite Ninho ', '45.00', '&lt;p&gt;Massa de brigadeiro de leite ninho com bolacha de leite e mel.&lt;/p&gt;\r\n&lt;p&gt;Vendida por quilo.&lt;/p&gt;', 'upload/2018/09/19/12b1cd8d3d288885fb37127b95dadfa7.jpg', 25, 1, 1, '', 0, 1, 1, NULL, '', NULL, NULL, NULL, 124),
(122, 'Cookies (Por kg)', '45.00', '&lt;p&gt;Massa a base de a&amp;ccedil;ucar mascavo, manteiga, ovos e farinha, com gotas de chocolate ao leite.&lt;/p&gt;\r\n&lt;p&gt;Vendido por quilo.&lt;/p&gt;', 'upload/2018/09/18/a62080801f146046010746ff8ca14910.jpg', 25, 1, 1, '', 0, 0, 1, NULL, '', NULL, NULL, NULL, 126),
(123, 'Bolo Molhado de Chocolate Preto', '7.50', '', 'upload/2018/09/14/d065c8c96125e579f93df2bdfe381015.jpg', 25, 1, 1, '', 0, 0, 1, NULL, '', NULL, NULL, NULL, 117),
(124, 'Bolo Molhado de Chocolate Branco', '8.50', '', 'upload/2018/02/16/71b249fd15f261a8918a45ab8004ef77.png', 25, 1, 1, '', 0, 0, 1, NULL, '', NULL, NULL, NULL, 118),
(125, 'Bolo de Cenoura (Por kg)', '35.00', '&lt;p&gt;Vendido por quilo.&lt;/p&gt;', 'upload/2018/02/16/29531701fcc9c5a2a1a1a089af10fccd.png', 25, 1, 1, '', 0, 0, 1, NULL, '', NULL, NULL, NULL, 116),
(126, 'Bolo de Iogurte (Por kg)', '30.00', '&lt;p&gt;Vendido por quilo.&lt;/p&gt;', 'upload/2018/09/14/aa2eef3daf101bf16d1ac9045b63e230.png', 25, 1, 1, '', 0, 0, 1, NULL, '', NULL, NULL, NULL, 119),
(127, 'Bolo de Milho (Por kg)', '30.00', '&lt;p&gt;Vendido por quilo.&lt;/p&gt;', 'upload/2018/09/14/db180e4453384e3f88c59295faefadea.png', 25, 1, 1, '', 0, 0, 1, NULL, '', NULL, NULL, NULL, 120),
(128, 'Sonho de Doce de Leite', '4.50', '&lt;p&gt;Massa a base de farinha, ovos e leite, frita e recheada com doce de leite da casa.&lt;/p&gt;\r\n&lt;p&gt;Polvilhado com a&amp;ccedil;&amp;uacute;car confeiteiro.&lt;/p&gt;', 'upload/2018/09/19/f94497fdc0ae1aeedf6d87f42c60f8dd.png', 25, 1, 1, '', 0, 1, 1, NULL, '', NULL, NULL, NULL, 127),
(129, 'Sonho de Nutella', '4.50', '&lt;p&gt;Massa a base de farinha, ovos e leite, frita e recheada com nutella.&lt;/p&gt;\r\n&lt;p&gt;Polvilhado com a&amp;ccedil;&amp;uacute;car confeiteiro.&lt;/p&gt;', 'upload/2018/09/19/0b07bd7fe5c9226b69b4fe12344ff46e.jpg', 25, 1, 1, '', 0, 1, 1, NULL, '', NULL, NULL, NULL, 125),
(131, 'Carolina de Doce de Leite (Por kg)', '35.00', '&lt;p&gt;Massa choux, recheado com doce de leite da casa e ganache de chocolate ao leite.&lt;/p&gt;\r\n&lt;p&gt;Vendida por quilo.&lt;/p&gt;', 'upload/2018/09/19/3352fc04184f96c538d1192426c5fef1.jpg', 25, 1, 1, '', 0, 1, 1, NULL, '', NULL, NULL, NULL, 128),
(133, 'Suco de Laranja', '7.50', '&lt;p&gt;&lt;strong&gt;Bebida Gelada.&lt;/strong&gt;&lt;/p&gt;\r\n&lt;p&gt;Suco natural de laranja, agua e gelo.&lt;/p&gt;\r\n&lt;p&gt;Tempo de preparo &amp;eacute; de 10 minutos.&lt;/p&gt;', 'upload/2018/09/19/dbae2b05a8dd20b2173d8a4dee4c1ff6.jpg', 22, 1, 1, '', 0, 0, 1, NULL, '', NULL, NULL, NULL, 42),
(134, 'Água Mineral ', '2.25', '&lt;p&gt;&lt;strong&gt;500 ml&lt;/strong&gt;&lt;/p&gt;', 'upload/2018/09/19/e7b915e426b628100b6eb2c5d24062ac.png', 22, 1, 1, '', 0, 1, 1, NULL, '', NULL, NULL, NULL, 43),
(135, 'Água Mineral com Gás', '2.50', '&lt;p&gt;&lt;strong&gt;500 ml&lt;/strong&gt;&lt;/p&gt;', 'upload/2018/09/19/02a3de42ea903e42ed9e984a1b6fab60.png', 22, 1, 1, '', 0, 1, 1, NULL, '', NULL, NULL, NULL, 44),
(136, 'Coca-Cola', '3.50', '&lt;p&gt;&lt;strong&gt;Lata&lt;/strong&gt;&lt;/p&gt;\r\n&lt;p&gt;&amp;nbsp;&lt;/p&gt;', 'upload/2018/09/18/0419e93b4b0fdffe06c619cd545adfbb.png', 22, 1, 1, '', 0, 1, 1, NULL, '', NULL, NULL, NULL, 45),
(137, 'Fanta Laranja ', '3.50', '&lt;p&gt;&lt;strong&gt;Lata&lt;/strong&gt;&lt;/p&gt;', 'upload/2018/09/19/ffbc57c3acdfdd1e012872a1a18ef652.jpg', 22, 1, 1, '', 0, 1, 1, NULL, '', NULL, NULL, NULL, 46),
(138, 'Sprite', '3.50', '&lt;p&gt;&lt;strong&gt;Lata&lt;/strong&gt;&lt;/p&gt;', 'upload/2018/09/19/eb5e28746e391e2430dd9425a62e37b4.jpg', 22, 1, 1, '', 0, 0, 1, NULL, '', NULL, NULL, NULL, 47),
(139, 'Guaraná Antártica ', '3.50', '&lt;p&gt;&lt;strong&gt;Lata&lt;/strong&gt;&lt;/p&gt;', 'upload/2018/09/19/bd6d6d4958297e3b88f1c7e34c590a7a.png', 22, 1, 1, '', 0, 1, 1, NULL, '', NULL, NULL, NULL, 48),
(140, 'Soda Limonada', '3.50', '&lt;p&gt;&lt;strong&gt;Lata&lt;/strong&gt;&lt;/p&gt;', 'upload/2018/09/19/a15e87b37cb1df71e4e376cf28ca1d54.jpg', 22, 1, 1, '', 0, 0, 1, NULL, '', NULL, NULL, NULL, 49),
(141, 'Água Tônica Schweppes ', '3.75', '&lt;p&gt;&lt;strong&gt;Lata&lt;/strong&gt;&lt;/p&gt;', 'upload/2018/09/19/96b69f44c462aa55be8c7556d3cf2956.png', 22, 1, 1, '', 0, 1, 1, NULL, '', NULL, NULL, NULL, 50),
(142, 'Schweppes Citrus ', '3.75', '&lt;p&gt;&lt;strong&gt;Lata&lt;/strong&gt;&lt;/p&gt;', 'upload/2018/09/18/e09fe69d86d23f28a9755a4e7ac59976.png', 22, 1, 1, '', 0, 0, 1, NULL, '', NULL, NULL, NULL, 51),
(143, 'Coca-Cola - Zero', '3.75', '&lt;p&gt;&lt;strong&gt;Lata&lt;/strong&gt;&lt;/p&gt;', 'upload/2018/11/20/a73920139b9b7a80c3d69d709d800c42.png', 22, 1, 1, '', 0, 1, 1, NULL, '', NULL, NULL, NULL, 52),
(144, 'Fanta Laranja - Zero', '3.75', '&lt;p&gt;&lt;strong&gt;Lata&lt;/strong&gt;&lt;/p&gt;', 'upload/2018/09/19/b68d903543ce373ec84c73aa6b863fce.jpg', 22, 1, 1, '', 0, 1, 1, NULL, '', NULL, NULL, NULL, 53),
(145, 'Sprite  - Zero', '3.75', '&lt;p&gt;&lt;strong&gt;Lata&lt;/strong&gt;&lt;/p&gt;', 'upload/2018/09/19/4263993b05281aaacc220d5dcfdc4880.jpg', 22, 1, 1, '', 0, 0, 1, NULL, '', NULL, NULL, NULL, 54),
(146, 'Guaraná Antártica - Zero', '3.75', '&lt;p&gt;&lt;strong&gt;Lata&lt;/strong&gt;&lt;/p&gt;', 'upload/2018/09/19/8e02d9af849e266e4e768157cf9d8856.jpg', 22, 1, 1, '', 0, 1, 1, NULL, '', NULL, NULL, NULL, 55),
(147, 'Soda Limonada - Zero', '3.75', '&lt;p&gt;&lt;strong&gt;Lata&lt;/strong&gt;&lt;/p&gt;', 'upload/2018/09/19/9dc95ab7ab5ee7f7ea9b56be0bf152d8.jpg', 22, 1, 1, '', 0, 0, 1, NULL, '', NULL, NULL, NULL, 56),
(148, 'Café Caramelo', '6.50', '&lt;p&gt;&lt;strong&gt;Bebida gelada.&lt;br /&gt;&lt;br /&gt;&lt;/strong&gt;300 ml de leite, 1 shot de caf&amp;eacute;, aromatizante de caramelo e a&amp;ccedil;&amp;uacute;car mascavo.&lt;/p&gt;\r\n&lt;p&gt;Batido no liquidificador.&lt;/p&gt;\r\n&lt;p&gt;Tempo de preparo &amp;eacute; de 10 minutos.&lt;/p&gt;', 'upload/2018/03/07/c628627b632188418732e03c8b3aef53.jpg', 22, 1, 1, '', 0, 0, 1, NULL, '', NULL, NULL, NULL, 57),
(149, 'Deppuccino de Coco', '9.00', '&lt;p&gt;&lt;strong&gt;Bebida gelada.&lt;/strong&gt;&lt;/p&gt;\r\n&lt;p&gt;100 ml leite de coco, 1 shot de caf&amp;eacute;, calda de chocolate, coco ralado, gelo e chantilly.&lt;/p&gt;\r\n&lt;p&gt;Batido no liquidificador.&lt;/p&gt;\r\n&lt;p&gt;Tempo de preparo &amp;eacute; de 10 minutos.&lt;/p&gt;', 'upload/2018/09/19/1dfa3a11578a1b5ce692a98474b37e5d.png', 22, 1, 1, '', 0, 0, 1, NULL, '', NULL, NULL, NULL, 58),
(150, 'Café com Leite Gelado', '5.00', '&lt;p&gt;&lt;strong&gt;Bebida gelada.&lt;/strong&gt;&lt;/p&gt;\r\n&lt;p&gt;150 ml de leite, 1 shot de caf&amp;eacute;, a&amp;ccedil;&amp;uacute;car mascavo e gelo.&lt;/p&gt;\r\n&lt;p&gt;Tempo de preparo &amp;eacute; de 10 minutos.&lt;/p&gt;', 'upload/2018/09/19/a76924a1e41dbb50e80dc6d17954e84c.jpg', 22, 1, 1, '', 0, 0, 1, NULL, '', NULL, NULL, NULL, 59),
(151, 'Cappuccino de Chocolate (200ml)', '6.50', '&lt;p&gt;&lt;strong&gt;Bebida quente.&lt;/strong&gt;&lt;/p&gt;\r\n&lt;p&gt;Chocolate em p&amp;oacute;, 1 shot de expresso e partes iguais de leite vaporizado e espuma do leite.&lt;/p&gt;\r\n&lt;p&gt;Pode ser acrescentado chantilly como na foto.&lt;/p&gt;\r\n&lt;p&gt;Tempo de preparo &amp;eacute; de 5 minutos.&lt;/p&gt;', 'upload/2018/09/19/1f13e21bb0e670c2a163713a010e88c9.png', 22, 1, 1, '', 0, 0, 1, NULL, '', NULL, NULL, NULL, 60),
(152, 'Café Irlandês ', '8.50', '&lt;p&gt;&lt;strong&gt;Bebida Alco&amp;oacute;lica&lt;/strong&gt;&lt;/p&gt;\r\n&lt;p&gt;150 ml de leite vaporizado, 1 shot de expresso e 1 shot de whisky e espuma de leite.&lt;/p&gt;\r\n&lt;p&gt;Tempo de preparo &amp;eacute; de 5 minutos.&lt;/p&gt;', 'upload/2018/09/18/583f15d69b35c86b0c84e740915e7507.jpg', 22, 1, 1, '', 0, 0, 1, NULL, '', NULL, NULL, NULL, 61),
(153, 'Chá Verde com Hortelã', '3.50', '&lt;p&gt;&lt;strong&gt;Ch&amp;aacute; Quente&lt;/strong&gt;&lt;/p&gt;\r\n&lt;p&gt;Tempo de preparo &amp;eacute; de 5 minutos.&lt;/p&gt;', 'upload/2018/09/20/d80fdc1b9a835d0a9d0c48eb678ef226.jpg', 22, 1, 1, '', 0, 0, 1, NULL, '', NULL, NULL, NULL, 62),
(154, 'Milkshake Amendoin (360ml)', '14.50', '', 'upload/2018/09/14/e76892f85a2a84df0493a632a0ad5156.png', 22, 1, 1, '', 0, 0, 1, NULL, '', NULL, NULL, NULL, 2),
(155, 'Empanada de Carne com Ovos', '4.00', '&lt;p&gt;&lt;strong&gt;SALGADO ASSADO&lt;/strong&gt;&lt;/p&gt;\r\n&lt;p&gt;Todos os produtos s&amp;atilde;o preparados na hora.&lt;br /&gt;Caso o sabor desejado n&amp;atilde;o esteja dispon&amp;iacute;vel no expositor, solicite a&amp;nbsp;sua atendente que o mesmo ser&amp;aacute; preparado.&lt;br /&gt;O tempo de espera &amp;eacute; de 5 minutos, dependendo do movimento e do tipo de salgado solicitado.&lt;/p&gt;', 'upload/2018/09/18/33681f64410336af177e656fce1b6d01.jpg', 26, 1, 1, '', 0, 0, 1, NULL, '', NULL, NULL, NULL, 81),
(156, 'Empanada de Frango', '4.00', '&lt;p&gt;&lt;strong&gt;SALGADO ASSADO&lt;/strong&gt;&lt;/p&gt;\r\n&lt;p&gt;Todos os produtos s&amp;atilde;o preparados na hora.&lt;br /&gt;Caso o sabor desejado n&amp;atilde;o esteja dispon&amp;iacute;vel no expositor, solicite a&amp;nbsp;sua atendente que o mesmo ser&amp;aacute; preparado.&lt;br /&gt;O tempo de espera &amp;eacute; de 5 minutos, dependendo do movimento e do tipo de salgado solicitado.&lt;/p&gt;', 'upload/2018/09/18/eebe6c77954410b8b279f4b04cf28969.jpg', 26, 1, 1, '', 0, 0, 1, NULL, '', NULL, NULL, NULL, 82),
(157, 'Empanada de Carne com Ovos e Uva Passas', '4.50', '&lt;p&gt;&lt;strong&gt;SALGADO ASSADO&lt;/strong&gt;&lt;/p&gt;\r\n&lt;p&gt;Todos os produtos s&amp;atilde;o preparados na hora.&lt;br /&gt;Caso o sabor desejado n&amp;atilde;o esteja dispon&amp;iacute;vel no expositor, solicite a&amp;nbsp;sua atendente que o mesmo ser&amp;aacute; preparado.&lt;br /&gt;O tempo de espera &amp;eacute; de 5 minutos, dependendo do movimento e do tipo de salgado solicitado.&lt;/p&gt;', 'upload/2018/09/18/a23dfc7e276f61aa9c2579494e80e631.jpg', 26, 1, 1, '', 0, 0, 1, NULL, '', NULL, NULL, NULL, 83),
(158, 'Empanada de Queijo, Presunto e Orégano', '4.25', '&lt;p&gt;&lt;strong&gt;SALGADO ASSADO&lt;/strong&gt;&lt;/p&gt;\r\n&lt;p&gt;Todos os produtos s&amp;atilde;o preparados na hora.&lt;br /&gt;Caso o sabor desejado n&amp;atilde;o esteja dispon&amp;iacute;vel no expositor, solicite a&amp;nbsp;sua atendente que o mesmo ser&amp;aacute; preparado.&lt;br /&gt;O tempo de espera &amp;eacute; de 5 minutos, dependendo do movimento e do tipo de salgado solicitado.&lt;/p&gt;', 'upload/2018/09/18/37bcadb1046f2a22d07e1ac1dc9efc0c.jpg', 26, 1, 1, '', 0, 0, 1, NULL, '', NULL, NULL, NULL, 84),
(159, 'Quiche de Linguicinha', '9.90', '&lt;p&gt;&lt;strong&gt;SALGADO ASSADO&lt;/strong&gt;&lt;br /&gt;Todos os produtos s&amp;atilde;o preparados na hora.&lt;br /&gt;Caso o sabor desejado n&amp;atilde;o esteja dispon&amp;iacute;vel no expositor, solicite a&amp;nbsp;sua atendente que o mesmo ser&amp;aacute; preparado.&lt;br /&gt;O tempo de espera &amp;eacute; de 10 a 30 minutos, dependendo do movimento e do tipo de salgado solicitado.&lt;/p&gt;', 'upload/2018/09/18/c90411285847c64bac92cd9ca924dfcb.jpg', 26, 1, 1, '', 0, 0, 1, NULL, '', NULL, NULL, NULL, 85),
(160, 'Quiche de Espinafre com Ricota', '9.90', '&lt;p&gt;&lt;strong&gt;SALGADO ASSADO&lt;/strong&gt;&lt;br /&gt;Todos os produtos s&amp;atilde;o preparados na hora.&lt;br /&gt;Caso o sabor desejado n&amp;atilde;o esteja dispon&amp;iacute;vel no expositor, solicite a&amp;nbsp;sua atendente que o mesmo ser&amp;aacute; preparado.&lt;br /&gt;O tempo de espera &amp;eacute; de 10 a 30 minutos, dependendo do movimento e do tipo de salgado solicitado.&lt;/p&gt;', 'upload/2018/09/20/9e64c7efc952fd5e067f282c420d5c21.jpg', 26, 1, 1, '', 0, 0, 1, NULL, '', NULL, NULL, NULL, 86),
(163, 'Banoffe (Por kg)', '50.00', '&lt;p&gt;Massa a base de chocolate em p&amp;oacute; especial e manteiga, doce de leite da casa, banana, chantilly de leite ninho e calda de chocolate.&lt;/p&gt;', 'upload/2018/09/19/b123fb1011573a4b2b71ef4cb1432f3a.jpg', 25, 1, 1, '', 0, 0, 1, NULL, '', NULL, NULL, NULL, 129),
(164, 'Chocolate Quente Irlandês (200ml)', '9.50', '&lt;p&gt;&lt;strong&gt;Bebida quente.&lt;/strong&gt;&lt;/p&gt;\r\n&lt;p&gt;200ml de leite, chocolate especial em p&amp;oacute;, a&amp;ccedil;&amp;uacute;car, baunilha, creme de leite, 1 shot de whisky, marshmallow e chantilly.&lt;/p&gt;\r\n&lt;p&gt;Tempo de preparo &amp;eacute; de 10 minutos.&lt;/p&gt;', 'upload/2018/09/20/837e00c9fa7cfb16e243be904968362b.jpg', 22, 1, 1, '', 0, 0, 1, NULL, '', NULL, NULL, NULL, 63),
(165, 'Chocolate Quente com Leite de Coco (S/L 200ml)', '9.50', '&lt;p&gt;&lt;strong&gt;Bebida quente.&lt;/strong&gt;&lt;/p&gt;\r\n&lt;p&gt;200ml de leite de coco, chocolate especial em p&amp;oacute;, a&amp;ccedil;&amp;uacute;car, baunilha, creme de leite,&amp;nbsp; marshmallow e chantilly.&lt;/p&gt;\r\n&lt;p&gt;Tempo de preparo &amp;eacute; de 10 minutos.&lt;/p&gt;', 'upload/2018/09/20/573dc1d567b9938cd51036bf02f08e81.jpg', 22, 1, 1, '', 0, 0, 1, NULL, '', NULL, NULL, NULL, 64),
(166, 'Macarrão com Legumes e Frango', '13.90', '&lt;p&gt;Espaguete com frango, cebola, cenoura, piment&amp;atilde;o, alho-por&amp;oacute; e shoyo.&lt;/p&gt;\r\n&lt;p&gt;Acompanha um refrigerante ca&amp;ccedil;ulinha.&lt;/p&gt;\r\n&lt;p&gt;Tempo de preparo &amp;eacute; de 15 minutos.&lt;/p&gt;', 'upload/2018/09/19/ef31456ff8f92cd1e6bf925cb7ee8dbd.jpg', 37, 1, 1, '', 0, 1, 1, NULL, '', NULL, NULL, NULL, 91),
(168, 'Sanduíche Toscana', '12.90', '&lt;p&gt;P&amp;atilde;o franc&amp;ecirc;s, lingui&amp;ccedil;a toscana, mix de queijos e pasta de alho.&lt;/p&gt;\r\n&lt;p&gt;Tempo de preparo de 10 a 15 minutos.&lt;/p&gt;', 'upload/2018/09/18/79775d3b67b2829fafacf59089039bff.jpg', 27, 1, 1, '', 0, 1, 1, NULL, '', NULL, NULL, NULL, 111),
(169, 'Cheesecake de Chocolate', '9.90', '', 'upload/2018/09/18/c57fb4089a965753670321e191f13a80.jpg', 25, 1, 1, '', 0, 0, 1, NULL, '', NULL, NULL, NULL, 122),
(170, 'Prato Executivo com Frango', '14.90', '&lt;p&gt;Arroz, salada de alface, tomate e pepino, batatas fritas e 150 gramas de fil&amp;eacute; de frango.&lt;/p&gt;\r\n&lt;p&gt;O cliente poder&amp;aacute; tamb&amp;eacute;m optar por fil&amp;eacute; mignon.&lt;/p&gt;\r\n&lt;p&gt;Tempo de preparo &amp;eacute; de 15 minutos.&lt;/p&gt;', 'upload/2018/09/19/ae98c8b981329066b50fcfd633ddfea7.jpg', 37, 1, 1, '', 1, 1, 1, NULL, '', NULL, NULL, NULL, 92),
(171, 'Canolli de Ricota', '3.50', '&lt;p&gt;Massa doce frita produzida pela Delion com um creme de ricota, a&amp;ccedil;&amp;uacute;car e canela.&lt;/p&gt;', 'upload/2018/09/19/9d8e6ebe449ab1a19ef26da3a15d5acf.jpg', 25, 1, 1, '', 1, 1, 1, NULL, '', NULL, NULL, NULL, 130),
(172, 'Canolli de Doce de Leite', '3.50', '&lt;p&gt;Massa doce frita produzida pela Delion com doce de leite produzido pela Delion.&lt;/p&gt;', 'upload/2018/09/19/42fe1d738de1228ba161a526a609a693.jpg', 25, 1, 1, '', 0, 1, 1, NULL, '', NULL, NULL, NULL, 131),
(173, 'Cueca Virada (Por kg)', '20.00', '&lt;p&gt;Massa feita a base de farinha e ovos, frita e polvilhada com a&amp;ccedil;&amp;uacute;car.&lt;/p&gt;\r\n&lt;p&gt;Vendida por quilo.&lt;/p&gt;', 'upload/2018/09/19/942b3224ff17e9e76beaf1e0bbc54ee6.jpg', 25, 1, 1, '', 0, 1, 1, NULL, '', NULL, NULL, NULL, 132),
(174, 'BLT', '7.90', '&lt;p&gt;P&amp;atilde;o franc&amp;ecirc;s tostado, maionese da casa, 100 gr de bacon cozido por 44 horas, alface e tomate.&lt;/p&gt;\r\n&lt;p&gt;Tempo de preparo &amp;eacute; de 10 a 15 minutos.&lt;/p&gt;', 'upload/2018/09/19/66cb1150062b068cc1514b53a8d5ad18.jpg', 27, 1, 1, '', 1, 1, 1, NULL, '', NULL, NULL, NULL, 112),
(175, 'Café Brutus', '19.50', '&lt;p&gt;100 gr de bacon fatiado, ovos mexidos, 2 torradas, 3 panquecas, mel e 200 ml de suco de laranja.&lt;/p&gt;\r\n&lt;p&gt;10 a 20 minutos de preparo.&lt;/p&gt;', 'upload/2018/09/19/5ac656305f4dfe259e0c5a5bf859fe6d.jpg', 38, 1, 1, '', 1, 0, 1, NULL, '', NULL, NULL, NULL, 95),
(176, 'Torta Charge (Por kg)', '65.00', '&lt;p&gt;Base de bolacha, doce de leite, creme a base de leite, creme de amendoim da casa, ganacha de chocolate amargo e amendoim.&lt;/p&gt;\r\n&lt;p&gt;Vendida por quilo.&lt;/p&gt;', 'upload/2018/09/19/0d4a4f4b27ec6535382848dad970e029.jpg', 28, 1, 1, '', 0, 0, 1, NULL, '', NULL, NULL, NULL, 138),
(177, 'Torta Negra (por KG)', '65.00', '&lt;p&gt;Massa de brownie, creme de avel&amp;atilde;, cereja, creme de nata.&lt;/p&gt;\r\n&lt;p&gt;Vendida por quilo.&lt;/p&gt;', 'upload/2018/09/19/ae1bb018a005da452723fa3e44346439.png', 28, 1, 1, '', 1, 0, 1, NULL, '', NULL, NULL, NULL, 139),
(178, 'Cheesecake Chocolate com Framboesa', '4.00', '&lt;p&gt;Base de bolacha leite e mel, creme de chocolate amargo, coulis de framboesa.&lt;/p&gt;', 'upload/2018/09/19/477f86e90012697040a149e1f93229b6.jpg', 25, 1, 1, '', 0, 0, 1, NULL, '', NULL, NULL, NULL, 133),
(179, 'Milkshake de Morango', '14.50', '&lt;p&gt;&lt;strong&gt;Bebida gelada.&lt;/strong&gt;&lt;/p&gt;\r\n&lt;p&gt;300 ml de leite, sorvete, morango, calda de morango e chantilly.&lt;/p&gt;\r\n&lt;p&gt;Tempo de preparo &amp;eacute; de 10 minutos.&lt;/p&gt;', 'upload/2018/09/20/8b91ca66171f6c78f591c02e0ecfc6ce.png', 22, 1, 1, '', 0, 0, 1, NULL, '', NULL, NULL, NULL, 65),
(180, 'Milkshake de Amendoim (360 ml)', '14.50', '&lt;p&gt;&lt;strong&gt;Bebida gelada.&lt;/strong&gt;&lt;/p&gt;\r\n&lt;p&gt;300 ml de leite, sorvete, amendoim, calda de caramelo e chantilly.&lt;/p&gt;\r\n&lt;p&gt;Tempo de preparo &amp;eacute; de 10 minutos.&lt;/p&gt;', 'upload/2018/09/20/de1cab1514cc9a50a5a55da62e6448e1.jpg', 22, 1, 1, '', 0, 0, 1, '[]', '', NULL, NULL, NULL, 66),
(181, 'Sanduíche de Linguiça Apimentada', '14.90', '&lt;p&gt;Pao baguete tostado, requeij&amp;atilde;o, 2 lingui&amp;ccedil;as apimentadas, cebola e piment&amp;atilde;o salteado na manteiga e pimenta do reino e queijo prato.&lt;/p&gt;\r\n&lt;p&gt;Tempo de preparo &amp;eacute; de 10 a 15 minutos.&lt;/p&gt;', 'upload/2018/09/20/507bf4a0e0ac9c3e05142eafd2bc93af.jpg', 27, 1, 1, '', 1, 1, 1, NULL, '', NULL, NULL, NULL, 113),
(182, 'Cheesecake de Oreo com Negresco.', '4.00', '&lt;p&gt;Base de bolacha oreo, creme de oreo e cobertura de negresco.&lt;/p&gt;', 'upload/2018/09/20/e6eb3df81bd69b3df61e3fd8e097360a.jpg', 25, 1, 1, '', 0, 0, 1, NULL, '', NULL, NULL, NULL, 134),
(183, 'Cheesecake de Amora', '4.00', '&lt;p&gt;Base de bolacha de leite e mel, creme de queijo e gel&amp;eacute;ia de amora.&lt;/p&gt;', 'upload/2018/09/20/7c50cfa68e7d1d65e3740038958cd1cd.png', 25, 1, 1, '', 0, 0, 1, NULL, '', NULL, NULL, NULL, 135),
(184, 'Chá Mate de uva', '9.00', '&lt;p&gt;&lt;strong&gt;Bebida gelada.&lt;/strong&gt;&lt;/p&gt;\r\n&lt;p&gt;Ch&amp;aacute; mate, aromatizante de uva, leite condensado e gelo.&lt;/p&gt;\r\n&lt;p&gt;Batido no liquidificador.&lt;/p&gt;\r\n&lt;p&gt;Leite condensado &amp;eacute; opcional.&lt;/p&gt;\r\n&lt;p&gt;Tempo de preparo &amp;eacute; de 10 minutos.&lt;/p&gt;\r\n&lt;p&gt;&amp;nbsp;&lt;/p&gt;', 'upload/2018/09/20/1bb84c419a95b0e117b7c3302347fc1a.png', 22, 1, 1, '', 0, 0, 1, NULL, '', NULL, NULL, NULL, 67);
INSERT INTO `cardapio` (`cod_cardapio`, `nome`, `preco`, `descricao`, `foto`, `categoria`, `flag_ativo`, `flag_servindo`, `slug`, `prioridade`, `delivery`, `desconto`, `adicional`, `dias_semana`, `cardapio_turno`, `cardapio_horas_inicio`, `cardapio_horas_final`, `posicao`) VALUES
(185, 'Bolinha de 3 queijos.', '4.50', '&lt;p&gt;&lt;strong&gt;SALGADO FRITO&lt;/strong&gt;&lt;/p&gt;\r\n&lt;p&gt;Caso&amp;nbsp; n&amp;atilde;o esteja dispon&amp;iacute;vel no expositor, solicite a&amp;nbsp;sua atendente que o mesmo ser&amp;aacute; preparado.&lt;/p&gt;\r\n&lt;p&gt;O tempo de espera &amp;eacute; de 15 minutos.&lt;/p&gt;\r\n&lt;p&gt;se a fritadeira j&amp;aacute; estiver ligada o tempo de fritar &amp;eacute; de 5 minutos.&lt;/p&gt;', 'upload/2018/09/20/792083051cb54f9998f748376a899104.png', 26, 1, 1, '', 0, 1, 1, NULL, '', NULL, NULL, NULL, 87),
(187, 'Combo Don Júlio 1', '21.00', '&lt;p&gt;Hamb&amp;uacute;rguer Don J&amp;uacute;lio + Refrigerante&lt;/p&gt;', 'upload/2018/09/26/00e4a95f8e6143d500b6e50080698fae.jpg', 34, 1, 1, '', 1, 1, 1, NULL, '', NULL, NULL, NULL, 99),
(188, 'Combo Don Júlio 2', '24.00', '&lt;p&gt;Hamb&amp;uacute;rguer Don J&amp;uacute;lio + Cerveja&lt;/p&gt;', 'upload/2018/09/26/20519b9ab5cc27bcdf3c838f33c2d9f6.jpg', 34, 1, 1, '', 0, 1, 1, NULL, '', NULL, NULL, NULL, 100),
(249, 'Pulled Pork', '14.90', '&lt;p&gt;P&amp;atilde;o Curitibano tostado.&lt;/p&gt;\r\n&lt;p&gt;&lt;br /&gt;Preparado com carne de porco (em processo de cozimento de 56 horas &lt;br /&gt;e 1 hora e meia de defuma&amp;ccedil;&amp;atilde;o).&lt;/p&gt;', 'upload/2018/11/09/15a6e96cac89e331a303c88d34c18425.jpg', 27, 1, 1, '', 0, 0, 1, NULL, '', 1, NULL, NULL, 114),
(250, 'Hambúrguer do Don Júlio', '17.90', '&lt;p&gt;P&amp;atilde;o Brioche, queijo coalho, blend da Delion Caf&amp;eacute; e molho especial.&lt;/p&gt;', 'upload/2018/09/26/299f87402dc518fb48914660039a206f.jpg', 27, 1, 1, '', 0, 1, 1, NULL, '', 1, NULL, NULL, 115),
(251, 'Cardapio Teste Adicional 15', '15.00', '', '', 22, 1, 1, '', 1, 1, 1, '[\"1\"]', '[\"quarta\",\"quinta\"]', 2, 2, 10, 68);

-- --------------------------------------------------------

--
-- Estrutura da tabela `cardapio_horas`
--

CREATE TABLE `cardapio_horas` (
  `cod_cardapio_horas` int(11) NOT NULL,
  `horario` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

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

CREATE TABLE `cardapio_turno` (
  `cod_cardapio_turno` int(11) NOT NULL,
  `nome` varchar(50) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

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

CREATE TABLE `categoria` (
  `cod_categoria` int(11) NOT NULL,
  `nome` varchar(30) COLLATE utf8_bin NOT NULL,
  `icone` varchar(255) COLLATE utf8_bin NOT NULL,
  `posicao` tinyint(4) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Extraindo dados da tabela `categoria`
--

INSERT INTO `categoria` (`cod_categoria`, `nome`, `icone`, `posicao`) VALUES
(22, 'BEBIDAS', 'upload/2018/02/08/f7e151d8382e33371ddc7bad5f0bb18e.png', 3),
(38, 'ESPECIAL', 'upload/2018/02/16/36488e1c4363d1302c70fdac6fb3fad1.png', 4),
(25, 'DOCES', 'upload/2018/02/07/a0104b4effe429905736271f6e79958a.png', 6),
(26, 'SALGADOS', 'upload/2018/02/07/15a28ab8c0da79f98fba13378d9b15fa.png', 2),
(27, 'SANDUÍCHES', 'upload/2018/02/07/cbebc01daf6b108be59b15e55ec44ca4.png', 5),
(28, 'TORTAS', 'upload/2018/02/07/9eacc77261bb78725997071a6384458e.png', 7),
(34, 'COMBOS + POR -', 'upload/2019/10/25/b172995c756b3fb35d31b312fd8309c6.png', 1),
(37, 'REFEIÇÕES', 'upload/2019/10/25/a64ffec338ebc5f200a8fc54188e03b8.png', 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `cliente`
--

CREATE TABLE `cliente` (
  `cod_cliente` int(11) NOT NULL,
  `cpf` varchar(15) COLLATE utf8_bin DEFAULT NULL,
  `nome` varchar(30) COLLATE utf8_bin NOT NULL,
  `sobrenome` varchar(30) COLLATE utf8_bin DEFAULT NULL,
  `login` varchar(60) COLLATE utf8_bin NOT NULL,
  `senha` varchar(32) COLLATE utf8_bin DEFAULT NULL,
  `telefone` varchar(20) COLLATE utf8_bin DEFAULT NULL,
  `data_nasc` date DEFAULT NULL,
  `fidelidade` smallint(6) DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `id_google` varchar(32) COLLATE utf8_bin DEFAULT NULL,
  `id_facebook` varchar(255) COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Extraindo dados da tabela `cliente`
--

INSERT INTO `cliente` (`cod_cliente`, `cpf`, `nome`, `sobrenome`, `login`, `senha`, `telefone`, `data_nasc`, `fidelidade`, `status`, `id_google`, `id_facebook`) VALUES
(3, '11', 'Vitor Baldacian', '', 'vitor@corp.kionux.com.br', '', NULL, '0000-00-00', 0, 1, '102759409854022733312', NULL),
(5, '9', 'Teste', '', 'teste@gmail.com', '6bfeb74f6009ddc03d9875e955785e07', '998959665', '0000-00-00', 0, 0, NULL, NULL),
(15, '3', 'Arthur Kenji Rosa Haguiuda', '', 'arthurhaguiuda@hotmail.com', '', NULL, '0000-00-00', 0, 1, NULL, '1228747850621032'),
(16, '0', 'Arthur Haguiuda', '', 'arthur@corp.kionux.com.br', '', '12412412', '0000-00-00', 0, 1, '113139107623040199715', NULL),
(18, '12', 'vitor', '', 'vitormatheussb@gmail.com', '879d374afa4179c5a0a3cf55fb899e8b', '12345678', '0000-00-00', 0, 1, NULL, NULL),
(19, '10', 'teste', '', 'teste@teste.com', '2aa43308916e39543a1f3f24c270a4c0', '12165846', '0000-00-00', 0, 1, NULL, NULL),
(21, '2', 'Arthur Kenji', '', 'arthurhaguiuda@gmail.com', '', NULL, '0000-00-00', 0, 1, '115462431362905694021', NULL),
(22, '5', 'JESSICA APARECIDA SIMOES', '', 'jessicasimoes92@outlook.com.br', 'cdd4b3e28e75868c3c76f02419b65de8', '45991129876', '0000-00-00', 0, 1, NULL, NULL),
(23, '1', 'arthur', '', 'arthur@mail.com', '3b464bea6c494302981adba1cffc2910', '1092381092', '0000-00-00', 0, 1, NULL, NULL),
(24, '6', 'laila', '', 'lailamonteiroam@gmail.com', 'f5c9fb1c027e4cfb53439de582ad24c2', '30292574', '0000-00-00', 0, 1, NULL, NULL),
(35, '8', 'Matheus Teste', '', 'matheus@corp.kionux.com.br', 'd6692821ac08b1de509dca21b10ce889', '45998081179', '0000-00-00', 0, 1, NULL, NULL),
(36, '7', 'Matheus Henrique', '', 'matheus', '27e37decb760fd6137bbdb1740eb2a28', '45998081179', '0000-00-00', 0, 1, NULL, NULL),
(68, '4', 'isshak', 'Daq', 'isshak@corp.kionux.com.br', '6bfeb74f6009ddc03d9875e955785e07', '45998293669', '0000-00-00', 0, 1, NULL, NULL),
(91, '794.322.870-76', 'isshak', 'afafa', 'isshak.mohamad@gmail.co', '25ddaf0fa489f1333cfccf4401bc383f', '(45) 99829-3669', '1997-07-30', 0, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `cupom`
--

CREATE TABLE `cupom` (
  `cod_cupom` int(11) NOT NULL,
  `codigo` varchar(255) COLLATE utf8_bin NOT NULL,
  `qtde_inicial` mediumint(9) NOT NULL,
  `valor` decimal(6,2) NOT NULL,
  `qtde_atual` int(11) NOT NULL,
  `vencimento_data` date NOT NULL,
  `status` tinyint(1) NOT NULL,
  `vencimento_hora` time NOT NULL,
  `valor_minimo` decimal(6,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Extraindo dados da tabela `cupom`
--

INSERT INTO `cupom` (`cod_cupom`, `codigo`, `qtde_inicial`, `valor`, `qtde_atual`, `vencimento_data`, `status`, `vencimento_hora`, `valor_minimo`) VALUES
(1, 'df1w1441j1q2', 123, '10.00', 122, '2020-07-30', 1, '00:00:00', NULL),
(2, 'df1w1451c1j8', 12, '50.00', 12, '2019-10-25', 1, '00:00:00', NULL),
(3, 'df1ya2lab2', 10000, '10.00', 10000, '2020-10-03', 1, '06:00:00', '15.00'),
(4, 'df72j1p7', 100, '5.00', 100, '2020-10-10', 1, '01:00:00', '15.00');

-- --------------------------------------------------------

--
-- Estrutura da tabela `cupom_cliente`
--

CREATE TABLE `cupom_cliente` (
  `cod_cupom_cliente` int(11) NOT NULL,
  `cod_cliente` int(11) NOT NULL,
  `cod_cupom` int(11) NOT NULL,
  `ultimo_uso` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `cupom_cliente`
--

INSERT INTO `cupom_cliente` (`cod_cupom_cliente`, `cod_cliente`, `cod_cupom`, `ultimo_uso`) VALUES
(1, 41, 1, '2019-09-26 13:49:09');

-- --------------------------------------------------------

--
-- Estrutura da tabela `empresa`
--

CREATE TABLE `empresa` (
  `cod_empresa` int(11) NOT NULL,
  `nome` varchar(255) COLLATE utf8_bin NOT NULL,
  `descricao` mediumtext COLLATE utf8_bin NOT NULL,
  `historia` mediumtext COLLATE utf8_bin NOT NULL,
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
  `foto` varchar(255) COLLATE utf8_bin NOT NULL,
  `dias_semana` varchar(30) COLLATE utf8_bin NOT NULL,
  `horario_semana` varchar(30) COLLATE utf8_bin NOT NULL,
  `dias_fim_semana` varchar(30) COLLATE utf8_bin NOT NULL,
  `horario_fim_semana` varchar(30) COLLATE utf8_bin NOT NULL,
  `aberto` tinyint(1) NOT NULL,
  `entregando` tinyint(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Extraindo dados da tabela `empresa`
--

INSERT INTO `empresa` (`cod_empresa`, `nome`, `descricao`, `historia`, `endereco`, `bairro`, `cidade`, `estado`, `cep`, `fone`, `whats`, `email`, `facebook`, `instagram`, `pinterest`, `foto`, `dias_semana`, `horario_semana`, `dias_fim_semana`, `horario_fim_semana`, `aberto`, `entregando`) VALUES
(1, 'Delion CafÃ©', '&lt;p&gt;A Delion Caf&amp;eacute; foi idealizada no ano de 2015, seus idealizadores objetivavam levar aos clientes produtos de qualidade, elaborados dentro de um esmerado controle de qualidade e higiene, n&amp;atilde;o se esquecendo do fator pre&amp;ccedil;o. Tudo foi pensado para que os clientes desfrutacem de bons produtos, com um pre&amp;ccedil;o justo, em um ambiente amplo e agrad&amp;aacute;vel.&lt;/p&gt;\r\n&lt;p&gt;Hoje a Delion Caf&amp;eacute; &amp;eacute; uma realidade, trouxe para Foz do Igua&amp;ccedil;u um conceito novo, jovem e diferenciado. Servindo sempre produtos frescos, que saem direto do forno para mesa dos clientes, sem utiliza&amp;ccedil;&amp;atilde;o de reaquecimento, os produtos da Delion Caf&amp;eacute; s&amp;atilde;o elaborados no momento do pedido, por esse motivo o sabor &amp;eacute; iniqual&amp;aacute;vel.&lt;/p&gt;', '&lt;p&gt;&lt;strong&gt;Delion de Oliveira&lt;/strong&gt;, segundo filho de cinco irm&amp;atilde;os, nasceu em Jacare&amp;iacute;, interior de S&amp;atilde;o Paulo, no dia 31 de Mar&amp;ccedil;o de 1931. Filho de Juvenal de Oliveira, um funcion&amp;aacute;rio da extinta Central do Brasil e Ol&amp;iacute;via Miguel de Oliveira, uma mulher de fibra, benzedeira e de uma bondade impar.Foi casado por 43 anos com Nilse Maria de Azevedo de Oliveira com quem teve dois filhos, Marcia e Delion Jr. Quando faleceu, al&amp;eacute;m da esposa e dos filhos, deixou sete netos: Rodrigo, Thiago, Jeniffer, Denise, Ana Lu&amp;iacute;sa, Bruno e Leonardo.&lt;/p&gt;\r\n&lt;p&gt;Cursou a Escola Agr&amp;iacute;cola de Jacare&amp;iacute; C&amp;ocirc;nego Jos&amp;eacute; Bento, na vida profissional, trabalhou na Casa Michel, foi funcion&amp;aacute;rio do antigo Banco Mercantil de S&amp;atilde;o Paulo e se aposentou na Gates do Brasil. Paralelo aos trabalhos sempre fazia bicos de gar&amp;ccedil;om para refor&amp;ccedil;ar o or&amp;ccedil;amento domestico, ali&amp;aacute;s, o que lhe dava grande prazer, devido ao fato de gostar de tratar com o p&amp;uacute;blico. Ap&amp;oacute;s se aposentar, gerenciou uma lanchonete e sempre revelava em suas conversas que adoraria ter um estabelecimento ligado ao setor de gastronomia. N&amp;atilde;o foi poss&amp;iacute;vel realizar esse sonho, ele faleceu em Jacare&amp;iacute;, no dia 30 de Maio de 1996, aos 65 anos, v&amp;iacute;tima de uma diabetes que contraiu ainda na adolesc&amp;ecirc;ncia. Ele sempre foi lembrado como um homem trabalhador, de bom car&amp;aacute;ter, extremamente honesto, que amava sua fam&amp;iacute;lia e que tinha uma alegria contagiante. Seu sorriso largo e sua alegria de viver foram sua marca registrada.&lt;/p&gt;\r\n&lt;p&gt;Dezenove anos ap&amp;oacute;s seu falecimento, seu sonho se materializou, a Delion Caf&amp;eacute; &amp;eacute; uma realidade, um estabelecimento com nome desse que deixou saudades e in&amp;uacute;meras li&amp;ccedil;&amp;otilde;es de vida a todos que fizeram parte de seu conv&amp;iacute;vio&lt;/p&gt;', 'Rua Jorge Sanwais, 1137', 'Centro', 'Foz do Iguaçu', 'Paraná', '85851-150', '(45) 3027-0059', '45991075688', 'contato@delioncafe.com.br', 'www.facebook.com/delioncafe', 'www.instagram.com/delioncafe', 'br.pinterest.com/search/pins/?q=Delion%20Caf%C3%A9&amp;rs=typed&amp;term_meta[]=Delion%7Ctyped&amp;term_meta[]=Caf%C3%A9%7Ctyped', 'upload/2018/09/13/afb1bd5fa29d26ac8745bc0c05281da5.png', 'Segunda a Sexta', '10:00h às 21:00h', 'Aos Sábados', '08:30h  às 19:00h', 0, 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `endereco`
--

CREATE TABLE `endereco` (
  `cod_endereco` int(11) NOT NULL,
  `rua` varchar(100) COLLATE utf8_bin NOT NULL,
  `numero` int(11) NOT NULL,
  `cep` varchar(10) COLLATE utf8_bin NOT NULL,
  `complemento` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `bairro` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `cidade` varchar(60) COLLATE utf8_bin NOT NULL,
  `referencia` varchar(100) COLLATE utf8_bin NOT NULL,
  `cliente` int(11) DEFAULT NULL,
  `flag_cliente` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Extraindo dados da tabela `endereco`
--

INSERT INTO `endereco` (`cod_endereco`, `rua`, `numero`, `cep`, `complemento`, `bairro`, `cidade`, `referencia`, `cliente`, `flag_cliente`) VALUES
(6, 'Rua Marechal Deodoro da Fonseca', 1121, '85851030', 'apto21', 'Centro', '', '', 21, 1),
(7, 'Rua Rio Grande do Sul', 528, '85870786', '', 'Loteamento Bela Vista', '', '', 18, 1),
(9, '', 0, '', '', '', '', '', 33, 0),
(10, '3', 3, '3', '3', '3', '', '', 33, 0),
(11, 'Avenida Felipe Wandscheer', 2310, '85853430', 'ap 09', 'Vila Yolanda', '', '', 35, 1),
(12, 'Rua Maraguari', 1, '85866360', '', 'Vila Residencial A', '', '', 39, 1),
(13, 'Rua Maraguari', 1, '85866360', '', 'Vila Residencial A', '', '', 39, 1),
(14, 'Rua Maraguari', 1, '85866360', '', 'Vila Residencial A', '', '', 39, 1),
(15, 'Rua Maraguari', 0, '85866360', '', 'Vila Residencial A', '', '', 39, 1),
(22, 'Rua Maraguari', 406, '85866-360', '', 'Vila A', '', '', NULL, 1),
(23, 'Rua Maraguari', 406, '85866-360', '', 'Vila A', '', '', NULL, 1),
(24, 'Maraguari', 40, '85866-360', '', 'Vila A', '', '', NULL, 1),
(25, 'Maraguari', 40, '85866-360', '', 'Vila A', '', '', NULL, 1),
(26, 'Rua Maraguari', 3, '85866360', '', 'Vila Residencial A', 'Foz do Iguaçu', '', 68, 1),
(27, 'Avenida Brasil', 46, '85851-000', '', 'Centro', '', '', NULL, 1),
(28, 'Avenida Brasil', 46, '85851-000', '', 'Centro', '', '', NULL, 1),
(29, 'Avenida Brasil', 46, '85851-000', '', 'Centro', '', '', NULL, 1),
(30, 'Avenida Brasil', 46, '85851-000', '', 'Centro', '', '', NULL, 1),
(31, 'Rua Maraguari', 40, '85866-360', '', 'Vila A', '', '', NULL, 1),
(32, 'Rua Maraguari', 40, '85866-360', '', 'Vila A', '', '', NULL, 1),
(33, 'Rua Maraguari', 40, '85866-360', '', 'Vila A', '', '', NULL, 1),
(34, 'Rua Maraguari', 40, '85866-360', '', 'Vila A', '', '', NULL, 1),
(35, 'Rua Maraguari', 40, '85866-360', '', 'Vila A', '', '', NULL, 1),
(38, 'Avenida Brasil', 1, '85851000', '', 'Centro', 'Foz do Iguaçu', '', 68, 1),
(41, 'Avenida Silvio Américo Sasdelli', 40, '85866-000', '', 'Vila A', 'Foz do Iguaçu', '', NULL, 1),
(42, 'Rua Maraguari', 40, '85866-360', '', 'Vila A', 'Foz do Iguaçu', '', NULL, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `entrega`
--

CREATE TABLE `entrega` (
  `cod_entrega` int(11) NOT NULL,
  `tempo` smallint(6) NOT NULL,
  `raio_km` tinyint(4) NOT NULL,
  `taxa_entrega` decimal(6,2) NOT NULL,
  `valor_minimo` decimal(6,2) NOT NULL,
  `min_taxa_gratis` decimal(6,2) DEFAULT NULL,
  `flag_ativo` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `entrega`
--

INSERT INTO `entrega` (`cod_entrega`, `tempo`, `raio_km`, `taxa_entrega`, `valor_minimo`, `min_taxa_gratis`, `flag_ativo`) VALUES
(1, 25, 1, '0.00', '10.00', '0.00', 1),
(2, 35, 3, '5.00', '10.00', '20.00', 1),
(4, 37, 5, '7.00', '15.00', '30.00', 1),
(5, 50, 15, '15.00', '50.00', '100.00', 0),
(6, 50, 10, '10.00', '20.00', '60.00', 0),
(10, 20, 20, '20.00', '100.00', '100.00', 0),
(11, 40, 7, '7.00', '20.00', '50.00', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `evento`
--

CREATE TABLE `evento` (
  `cod_evento` int(11) NOT NULL,
  `nome` varchar(255) COLLATE utf8_bin NOT NULL,
  `data` date NOT NULL,
  `flag_antigo` tinyint(1) NOT NULL,
  `foto` varchar(255) COLLATE utf8_bin NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Extraindo dados da tabela `evento`
--

INSERT INTO `evento` (`cod_evento`, `nome`, `data`, `flag_antigo`, `foto`) VALUES
(4, 'CafÃ© com mÃºsica', '2017-12-13', 1, 'upload/2017/12/27/4d5e56f74f9e927c9026aeffe3ca9c89.png'),
(8, 'CLUBE DA VITROLA', '0000-00-00', 0, 'upload/2018/02/20/c2debe893ec4196d259b45031b246d00.png');

-- --------------------------------------------------------

--
-- Estrutura da tabela `formapgt`
--

CREATE TABLE `formapgt` (
  `cod_formaPgt` int(11) NOT NULL,
  `tipoFormaPgt` varchar(60) NOT NULL,
  `flag_ativo` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `formapgt`
--

INSERT INTO `formapgt` (`cod_formaPgt`, `tipoFormaPgt`, `flag_ativo`) VALUES
(1, 'Crédito', 1),
(2, 'Sodex', 2),
(3, 'Nutricard', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `imagem`
--

CREATE TABLE `imagem` (
  `cod_imagem` int(11) NOT NULL,
  `nome` varchar(255) COLLATE utf8_bin NOT NULL,
  `foto` varchar(255) COLLATE utf8_bin NOT NULL,
  `pagina` varchar(255) COLLATE utf8_bin NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Extraindo dados da tabela `imagem`
--

INSERT INTO `imagem` (`cod_imagem`, `nome`, `foto`, `pagina`) VALUES
(1, 'Cardapio', 'upload/2018/01/08/0f61ab54d56b7777b3126743d7353dda.png', '[\"inicialCardapio\",\"cardapio\"]'),
(2, 'Evento', 'upload/2018/01/08/c0fe08cdb71a42972fe9072f9cd4fb4f.png', '[\"inicialEvento\"]'),
(3, 'CartÃ£o', 'upload/2018/10/03/d44a89f0c633e844421961fd6fb58dd1.png', '[\"inicialCartaoFidelidade\"]'),
(4, 'pedido', 'upload/2018/10/03/6a25c0a0c862b9d31e0695a38bd8568e.png', '[\"inicialPedido\"]'),
(5, 'sobre', 'upload/2018/01/09/16548982dc2e3f82e4defb1b90bd6a6a.png', '[\"sobre\"]'),
(6, 'contato 1', 'upload/2018/01/09/860d93bcf684dd0035f3d06549b6b7ca.png', '[\"historia\",\"contato\"]'),
(7, 'contato 2', 'upload/2018/01/09/9b9c2db09d8c7e53c7f372ce94a96832.png', '[\"historia\",\"contato\"]'),
(8, 'Sanduba', 'upload/2018/02/08/38ed35cae335f03d3eaa498a8c32108d.png', '[\"inicialCardapio\"]'),
(9, 'SuflÃª', 'upload/2018/02/08/adfc28c9b2c6430aea7c723898d425fe.png', '[\"inicialCardapio\"]'),
(10, 'CafÃ© com Doce', 'upload/2018/02/08/aeca3bb3a6254bd91a04a718f4f24c6d.png', '[\"inicialCardapio\",\"cardapio\"]'),
(11, 'Combo', 'upload/2018/02/08/01db8fb0479a6ad12dafb6fd2c10c2f3.png', '[\"inicialCardapio\"]'),
(12, 'Mortadela', 'upload/2018/02/08/3d4de8b7911b7f18499e5e17546ca5c1.png', '[\"inicialCardapio\",\"cardapio\"]'),
(14, 'CLUBE DA VITROLA', 'upload/2018/02/28/35228adbee6f18c9df32ba966452b1f9.jpg', '[\"inicialEvento\"]'),
(15, 'popUp', 'upload/2018/10/19/39310f9deaf64b1effcb120ed3ddcd8d.jpg', '[\"popUp\"]'),
(16, 'Topo Home', 'upload/2019/10/22/a809823534540bc6d3d28e4af378d203.png', '[\"homeTopo\"]'),
(17, 'Eventos', 'upload/2019/10/22/b4abe4edbbc62731ab3e347f1bc7cc76.png', '[\"homeEventos\"]'),
(18, 'Logo Home', 'upload/2019/10/22/280c3685ae41bd2f9e279dfc47f5e008.png', '[\"homeLogo\"]'),
(19, 'Fidelidade', 'upload/2019/10/22/57828dd8d199901365a4729885348b2c.png', '[\"homeFidelidade\"]'),
(20, 'Quem Somos', 'upload/2019/10/22/6481fec3b6c15885f0dce72c7c03cd16.png', '[\"homeQuemSomos\"]');

-- --------------------------------------------------------

--
-- Estrutura da tabela `item_pedido`
--

CREATE TABLE `item_pedido` (
  `cod_item_pedido` int(11) NOT NULL,
  `cod_produto` int(11) NOT NULL,
  `cod_pedido` int(11) NOT NULL,
  `quantidade` tinyint(4) NOT NULL,
  `observacao` varchar(255) COLLATE utf8_bin NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Extraindo dados da tabela `item_pedido`
--

INSERT INTO `item_pedido` (`cod_item_pedido`, `cod_produto`, `cod_pedido`, `quantidade`, `observacao`) VALUES
(281, 17, 137, 1, ''),
(282, 20, 137, 1, ''),
(283, 20, 138, 3, ''),
(284, 22, 138, 3, ''),
(285, 18, 138, 1, ''),
(286, 17, 139, 1, ''),
(287, 18, 139, 1, ''),
(288, 20, 140, 4, ''),
(289, 18, 140, 2, ''),
(290, 19, 141, 1, ''),
(291, 17, 142, 3, ''),
(292, 18, 142, 2, ''),
(293, 20, 142, 1, ''),
(294, 18, 143, 3, ''),
(295, 19, 143, 2, ''),
(296, 19, 144, 2, ''),
(297, 18, 144, 1, ''),
(298, 20, 145, 2, ''),
(299, 18, 145, 1, ''),
(300, 17, 146, 1, ''),
(301, 20, 146, 1, ''),
(302, 22, 146, 1, ''),
(303, 36, 147, 1, ''),
(304, 134, 147, 1, ''),
(305, 135, 147, 1, ''),
(306, 131, 147, 1, ''),
(307, 171, 147, 1, ''),
(308, 172, 147, 1, ''),
(309, 134, 148, 2, ''),
(310, 36, 148, 2, ''),
(311, 36, 149, 1, ''),
(312, 134, 150, 1, ''),
(313, 134, 151, 1, ''),
(314, 135, 152, 1, ''),
(315, 134, 153, 1, ''),
(316, 36, 154, 1, ''),
(317, 36, 155, 1, ''),
(318, 36, 156, 1, ''),
(319, 36, 157, 1, ''),
(320, 134, 157, 1, ''),
(321, 141, 157, 1, ''),
(322, 36, 158, 1, ''),
(323, 134, 159, 1, ''),
(324, 36, 159, 1, ''),
(325, 134, 160, 2, ''),
(326, 36, 160, 2, ''),
(327, 135, 160, 3, ''),
(328, 134, 161, 4, ''),
(329, 36, 161, 2, ''),
(330, 141, 161, 2, ''),
(331, 174, 162, 1, ''),
(332, 187, 163, 1, ''),
(333, 174, 163, 1, ''),
(334, 174, 164, 1, ''),
(335, 171, 164, 1, ''),
(336, 187, 164, 1, ''),
(337, 18, 164, 1, ''),
(338, 174, 165, 1, ''),
(339, 187, 166, 1, ''),
(340, 174, 167, 1, ''),
(341, 171, 167, 1, ''),
(342, 174, 168, 1, ''),
(343, 171, 168, 1, ''),
(344, 174, 169, 1, ''),
(345, 174, 170, 1, ''),
(346, 174, 171, 1, ''),
(347, 174, 172, 1, ''),
(348, 174, 173, 1, ''),
(349, 174, 174, 1, ''),
(350, 174, 175, 1, ''),
(351, 174, 176, 1, ''),
(352, 174, 0, 1, ''),
(353, 174, 0, 4, ''),
(354, 174, 0, 2, ''),
(355, 174, 194, 1, ''),
(356, 175, 194, 1, ''),
(357, 171, 194, 1, ''),
(358, 251, 194, 1, ''),
(359, 187, 194, 1, ''),
(360, 174, 195, 1, ''),
(361, 175, 195, 1, ''),
(362, 174, 196, 1, ''),
(363, 175, 196, 1, ''),
(364, 171, 196, 1, ''),
(365, 174, 197, 1, ''),
(366, 175, 197, 1, ''),
(367, 171, 197, 1, ''),
(368, 174, 198, 1, ''),
(369, 251, 198, 1, ''),
(370, 171, 199, 1, ''),
(371, 174, 199, 1, ''),
(372, 171, 200, 1, ''),
(373, 251, 200, 1, ''),
(374, 174, 200, 1, ''),
(375, 174, 201, 3, ''),
(376, 174, 202, 1, ''),
(377, 171, 202, 1, ''),
(378, 175, 203, 3, ''),
(379, 174, 203, 2, ''),
(380, 171, 203, 1, ''),
(381, 171, 204, 5, ''),
(382, 174, 204, 3, ''),
(383, 174, 205, 1, ''),
(384, 174, 206, 1, ''),
(385, 171, 206, 1, ''),
(386, 174, 207, 3, ''),
(387, 251, 207, 2, ''),
(388, 251, 208, 1, ''),
(389, 251, 209, 1, ''),
(390, 174, 210, 1, ''),
(391, 175, 210, 1, ''),
(392, 171, 210, 1, ''),
(393, 251, 210, 1, ''),
(394, 174, 211, 1, ''),
(395, 174, 212, 1, ''),
(396, 174, 213, 1, ''),
(397, 174, 214, 1, ''),
(398, 174, 215, 1, ''),
(399, 174, 216, 1, ''),
(400, 174, 217, 1, ''),
(401, 174, 218, 1, ''),
(402, 174, 219, 1, ''),
(403, 174, 220, 1, ''),
(404, 174, 221, 1, ''),
(405, 174, 222, 1, ''),
(406, 174, 223, 1, ''),
(407, 174, 224, 1, ''),
(408, 174, 225, 1, ''),
(409, 174, 226, 2, ''),
(410, 17, 227, 1, ''),
(411, 17, 228, 1, ''),
(412, 183, 229, 1, ''),
(413, 24, 230, 1, ''),
(414, 17, 231, 1, ''),
(415, 17, 232, 1, ''),
(416, 17, 233, 1, ''),
(417, 17, 234, 1, ''),
(418, 125, 235, 1, ''),
(419, 125, 236, 1, ''),
(420, 183, 236, 1, ''),
(421, 20, 236, 1, ''),
(422, 17, 237, 1, ''),
(423, 187, 238, 1, ''),
(424, 23, 238, 1, ''),
(425, 23, 239, 1, ''),
(426, 23, 240, 1, ''),
(427, 17, 241, 1, ''),
(428, 17, 242, 1, ''),
(429, 18, 242, 1, ''),
(430, 19, 242, 1, 'pasta');

-- --------------------------------------------------------

--
-- Estrutura da tabela `pedido`
--

CREATE TABLE `pedido` (
  `cod_pedido` int(11) NOT NULL,
  `cliente` int(11) NOT NULL,
  `data` datetime NOT NULL,
  `valor` decimal(6,2) NOT NULL,
  `taxa_entrega` decimal(6,2) NOT NULL,
  `subtotal` decimal(6,2) NOT NULL,
  `desconto` decimal(6,2) NOT NULL,
  `formaPgt` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `origem` varchar(30) NOT NULL,
  `hora_print` time NOT NULL,
  `hora_delivery` time NOT NULL,
  `hora_retirada` time NOT NULL,
  `endereco` int(11) DEFAULT NULL,
  `tempo_entrega` smallint(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `pedido`
--

INSERT INTO `pedido` (`cod_pedido`, `cliente`, `data`, `valor`, `taxa_entrega`, `subtotal`, `desconto`, `formaPgt`, `status`, `origem`, `hora_print`, `hora_delivery`, `hora_retirada`, `endereco`, `tempo_entrega`) VALUES
(163, 23, '2018-10-18 00:00:00', '28.90', '0.00', '0.00', '0.00', 10, 1, 'Site', '00:00:00', '00:00:00', '00:00:00', 17, NULL),
(164, 21, '2018-11-01 00:00:00', '46.30', '0.00', '0.00', '0.00', 10, 1, 'Site', '00:00:00', '00:00:00', '00:00:00', 17, NULL),
(165, 21, '2018-11-01 00:00:00', '7.90', '0.00', '0.00', '0.00', 12, 1, 'Site', '00:00:00', '00:00:00', '00:00:00', 17, NULL),
(166, 24, '2019-02-18 00:00:00', '21.00', '0.00', '0.00', '0.00', 10, 1, 'Site', '00:00:00', '00:00:00', '00:00:00', 17, NULL),
(167, 35, '2019-07-24 00:00:00', '11.40', '0.00', '0.00', '0.00', 10, 1, 'Site', '00:00:00', '00:00:00', '00:00:00', 17, NULL),
(168, 35, '2019-07-24 00:00:00', '11.40', '0.00', '0.00', '0.00', 10, 3, 'Site', '00:00:00', '00:00:00', '00:00:00', 17, NULL),
(169, 43, '2019-09-16 00:00:00', '27.40', '0.00', '0.00', '0.00', 10, 1, 'Site', '00:00:00', '00:00:00', '00:00:00', 17, NULL),
(170, 43, '2019-09-16 00:00:00', '7.90', '0.00', '0.00', '0.00', 10, 1, 'Site', '00:00:00', '00:00:00', '00:00:00', 17, NULL),
(171, 43, '2019-09-17 00:00:00', '7.90', '0.00', '0.00', '0.00', 10, 1, 'Site', '00:00:00', '00:00:00', '00:00:00', 17, NULL),
(172, 43, '2019-09-18 00:00:00', '30.90', '0.00', '0.00', '0.00', 10, 1, 'Site', '00:00:00', '00:00:00', '00:00:00', 17, NULL),
(173, 43, '2019-09-19 00:00:00', '7.90', '0.00', '0.00', '0.00', 10, 1, 'Site', '00:00:00', '00:00:00', '00:00:00', 17, NULL),
(174, 43, '2019-09-19 00:00:00', '7.90', '0.00', '0.00', '0.00', 10, 1, 'Site', '00:00:00', '00:00:00', '00:00:00', 17, NULL),
(175, 43, '2019-09-19 00:00:00', '7.90', '0.00', '0.00', '0.00', 10, 1, 'Site', '00:00:00', '00:00:00', '00:00:00', 17, NULL),
(176, 43, '2019-09-19 00:00:00', '19.50', '0.00', '0.00', '0.00', 10, 1, 'Site', '00:00:00', '00:00:00', '00:00:00', 17, NULL),
(194, 68, '2019-10-01 09:03:27', '66.90', '0.00', '0.00', '0.00', 10, 1, 'Site', '00:00:00', '00:00:00', '00:00:00', 17, NULL),
(195, 68, '2019-10-01 09:06:27', '27.40', '0.00', '0.00', '0.00', 10, 1, 'Site', '00:00:00', '00:00:00', '00:00:00', 17, NULL),
(196, 68, '2019-10-01 09:27:49', '30.90', '0.00', '0.00', '0.00', 10, 1, 'Site', '00:00:00', '00:00:00', '00:00:00', 17, NULL),
(197, 68, '2019-10-01 10:31:19', '30.90', '0.00', '0.00', '0.00', 10, 1, 'Site', '00:00:00', '00:00:00', '00:00:00', 17, NULL),
(198, 68, '2019-10-01 14:37:10', '22.90', '0.00', '0.00', '0.00', 0, 1, 'Site', '00:00:00', '00:00:00', '00:00:00', NULL, NULL),
(199, 68, '2019-10-01 15:46:03', '19.40', '0.00', '0.00', '0.00', 0, 1, 'Site', '00:00:00', '00:00:00', '00:00:00', 22, NULL),
(200, 68, '2019-10-01 15:48:04', '34.40', '0.00', '0.00', '0.00', 0, 2, 'Site', '16:51:00', '00:00:00', '00:00:00', 23, NULL),
(201, 68, '2019-10-01 16:02:24', '31.70', '0.00', '0.00', '0.00', 0, 3, 'Site', '00:00:00', '00:00:00', '00:00:00', 24, NULL),
(202, 68, '2019-10-01 16:13:44', '19.40', '0.00', '0.00', '0.00', 0, 2, 'Site', '00:00:00', '00:00:00', '00:00:00', 25, NULL),
(203, 68, '2019-10-02 11:02:36', '45.80', '0.00', '0.00', '0.00', 0, 2, 'Site', '00:00:00', '00:00:00', '00:00:00', NULL, NULL),
(204, 68, '2019-10-07 16:39:55', '47.20', '6.00', '41.20', '0.00', 0, 2, 'Site', '16:50:00', '00:00:00', '00:00:00', 27, NULL),
(205, 68, '2019-10-07 16:56:04', '7.90', '6.00', '7.90', '0.00', 0, 2, 'Site', '09:05:00', '00:00:00', '00:00:00', NULL, NULL),
(206, 68, '2019-10-07 17:12:50', '17.40', '6.00', '11.40', '0.00', 0, 2, 'Site', '08:44:00', '00:00:00', '00:00:00', 30, 35),
(207, 68, '2019-10-09 11:18:31', '64.70', '11.00', '53.70', '0.00', 0, 2, 'Site', '09:04:00', '00:00:00', '00:00:00', 33, 37),
(208, 68, '2019-10-09 11:20:44', '26.00', '11.00', '15.00', '0.00', 0, 2, 'Site', '08:59:00', '00:00:00', '00:00:00', 34, 37),
(209, 68, '2019-10-09 11:22:30', '26.00', '11.00', '15.00', '0.00', 0, 2, 'Site', '08:58:00', '00:00:00', '00:00:00', 35, 37),
(210, 68, '2019-10-11 16:14:54', '45.90', '0.00', '45.90', '0.00', 0, 1, 'Site', '00:00:00', '00:00:00', '00:00:00', NULL, NULL),
(211, 68, '2019-10-11 16:16:10', '7.90', '0.00', '7.90', '0.00', 0, 1, 'Site', '00:00:00', '00:00:00', '00:00:00', 26, 0),
(212, 68, '2019-10-11 16:18:24', '7.90', '0.00', '7.90', '0.00', 0, 1, 'Site', '00:00:00', '00:00:00', '00:00:00', NULL, NULL),
(213, 68, '2019-10-11 16:19:04', '7.90', '0.00', '7.90', '0.00', 0, 1, 'Site', '00:00:00', '00:00:00', '00:00:00', NULL, NULL),
(214, 68, '2019-10-11 16:20:02', '7.90', '0.00', '7.90', '0.00', 0, 1, 'Site', '00:00:00', '00:00:00', '00:00:00', NULL, NULL),
(215, 68, '2019-10-11 16:21:21', '7.90', '0.00', '7.90', '0.00', 0, 1, 'Site', '00:00:00', '00:00:00', '00:00:00', NULL, NULL),
(216, 68, '2019-10-11 16:30:02', '7.90', '0.00', '7.90', '0.00', 0, 1, 'Site', '00:00:00', '00:00:00', '00:00:00', NULL, NULL),
(217, 68, '2019-10-11 16:34:27', '7.90', '0.00', '7.90', '0.00', 0, 1, 'Site', '00:00:00', '00:00:00', '00:00:00', NULL, NULL),
(218, 68, '2019-10-11 16:35:42', '7.90', '0.00', '7.90', '0.00', 0, 1, 'Site', '00:00:00', '00:00:00', '00:00:00', NULL, NULL),
(219, 68, '2019-10-11 16:39:13', '7.90', '0.00', '7.90', '0.00', 0, 1, 'Site', '00:00:00', '00:00:00', '00:00:00', NULL, NULL),
(220, 68, '2019-10-11 16:39:50', '7.90', '0.00', '7.90', '0.00', 0, 1, 'Site', '00:00:00', '00:00:00', '00:00:00', NULL, NULL),
(221, 68, '2019-10-11 16:42:16', '7.90', '0.00', '7.90', '0.00', 0, 1, 'Site', '00:00:00', '00:00:00', '00:00:00', NULL, NULL),
(222, 68, '2019-10-11 16:45:57', '7.90', '0.00', '7.90', '0.00', 0, 1, 'Site', '00:00:00', '00:00:00', '00:00:00', NULL, NULL),
(223, 68, '2019-10-11 16:48:06', '7.90', '0.00', '7.90', '0.00', 0, 1, 'Site', '00:00:00', '00:00:00', '00:00:00', NULL, NULL),
(224, 68, '2019-10-14 08:40:24', '7.90', '0.00', '7.90', '0.00', 0, 1, 'Site', '00:00:00', '00:00:00', '00:00:00', NULL, NULL),
(225, 68, '2019-10-14 08:40:42', '7.90', '0.00', '7.90', '0.00', 0, 1, 'Site', '00:00:00', '00:00:00', '00:00:00', NULL, NULL),
(226, 68, '2019-10-14 10:52:35', '15.80', '0.00', '15.80', '0.00', 0, 1, 'Site', '00:00:00', '00:00:00', '00:00:00', NULL, NULL),
(227, 68, '2019-10-18 13:39:12', '14.90', '1.00', '13.90', '0.00', 0, 1, 'Site', '00:00:00', '00:00:00', '00:00:00', NULL, NULL),
(228, 68, '2019-10-18 13:53:53', '23.90', '10.00', '13.90', '0.00', 0, 1, 'Site', '00:00:00', '00:00:00', '00:00:00', 26, 37),
(229, 68, '2019-10-18 13:56:54', '14.00', '10.00', '4.00', '0.00', 1, 1, 'Site', '00:00:00', '00:00:00', '00:00:00', NULL, NULL),
(230, 68, '2019-10-18 13:59:27', '6.50', '10.00', '6.50', '0.00', 0, 1, 'Site', '00:00:00', '00:00:00', '00:00:00', NULL, NULL),
(231, 68, '2019-10-18 13:59:59', '23.90', '10.00', '13.90', '0.00', 3, 1, 'Site', '00:00:00', '00:00:00', '00:00:00', NULL, NULL),
(232, 68, '2019-10-18 14:01:10', '23.90', '10.00', '13.90', '0.00', 0, 1, 'Site', '00:00:00', '00:00:00', '00:00:00', NULL, NULL),
(233, 68, '2019-10-18 14:03:49', '23.90', '10.00', '13.90', '0.00', 0, 1, 'Site', '00:00:00', '00:00:00', '00:00:00', NULL, NULL),
(234, 68, '2019-10-18 14:14:26', '23.90', '10.00', '13.90', '0.00', 0, 1, 'Site', '00:00:00', '00:00:00', '00:00:00', 41, 37),
(235, 68, '2019-10-23 16:07:30', '35.00', '0.00', '35.00', '0.00', 0, 1, 'Site', '00:00:00', '00:00:00', '00:00:00', NULL, NULL),
(236, 68, '2019-10-24 17:17:34', '48.00', '0.00', '48.00', '0.00', 0, 3, 'Site', '17:18:00', '00:00:00', '17:18:00', NULL, NULL),
(237, 68, '2019-10-24 17:20:56', '23.90', '10.00', '13.90', '0.00', 0, 1, 'Site', '00:00:00', '00:00:00', '00:00:00', 26, 37),
(238, 68, '2019-10-25 17:27:04', '37.50', '10.00', '27.50', '0.00', 0, 1, 'Site', '00:00:00', '00:00:00', '00:00:00', 42, 37),
(239, 68, '2019-10-25 17:30:07', '6.50', '0.00', '6.50', '0.00', 0, 1, 'Site', '00:00:00', '00:00:00', '00:00:00', NULL, NULL),
(240, 68, '2019-10-25 17:30:44', '6.50', '0.00', '6.50', '0.00', 0, 1, 'Site', '00:00:00', '00:00:00', '00:00:00', NULL, NULL),
(241, 68, '2019-11-05 11:02:17', '13.90', '7.00', '13.90', '0.00', 0, 1, 'Site', '00:00:00', '00:00:00', '00:00:00', NULL, NULL),
(242, 90, '2019-11-07 16:08:50', '43.70', '0.00', '43.70', '0.00', 0, 1, 'Site', '00:00:00', '00:00:00', '00:00:00', NULL, NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `recupera_senha`
--

CREATE TABLE `recupera_senha` (
  `cod_recupera_senha` int(11) NOT NULL,
  `cod_cliente_fk` int(11) NOT NULL,
  `cod_recuperacao` varchar(20) NOT NULL,
  `recuperado` tinyint(1) NOT NULL DEFAULT 0,
  `data_expiracao` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `recupera_senha`
--

INSERT INTO `recupera_senha` (`cod_recupera_senha`, `cod_cliente_fk`, `cod_recuperacao`, `recuperado`, `data_expiracao`) VALUES
(1, 68, 'feab20119f08', 0, '2019-10-08 18:02:00'),
(2, 68, '3689e508932a', 0, '2019-10-08 18:03:00'),
(3, 68, 'd489adbe3092', 0, '2019-10-08 18:04:00'),
(4, 68, '1923c60e97ff', 0, '2019-10-08 18:08:00'),
(5, 68, 'd7dd137a580c', 0, '2019-10-09 09:25:00'),
(6, 68, 'e92245bea425', 0, '2019-10-09 09:28:00'),
(7, 68, '4aacd63ff4ff', 0, '2019-10-09 10:30:00'),
(8, 68, '9c4a0bf1d9f8', 0, '2019-10-09 10:59:00'),
(9, 68, '5c27196c27e9', 0, '2019-10-09 11:13:00'),
(10, 68, '00807cecc828', 0, '2019-10-09 11:15:00'),
(11, 68, 'd3807ecd5e9b', 1, '2019-10-09 11:17:00');

-- --------------------------------------------------------

--
-- Estrutura da tabela `sms`
--

CREATE TABLE `sms` (
  `cod_sms` int(11) NOT NULL,
  `telefone` varchar(15) NOT NULL,
  `codigo` mediumint(9) NOT NULL,
  `verificado` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `sms`
--

INSERT INTO `sms` (`cod_sms`, `telefone`, `codigo`, `verificado`) VALUES
(13, '45998293669', 89240, 1),
(15, '45998293669', 26672, 1),
(47, '45998293669', 9133, 1),
(52, '45998616601', 2237, 1),
(53, '45998616601', 3735, 0),
(54, '45998616601', 1234, 0),
(55, '45998616601', 3593, 0),
(56, '45998616601', 8394, 1),
(57, '45998293669', 9102, 1),
(58, '45998293669', 1985, 0),
(59, '45998293669', 8435, 1),
(60, '45998293669', 5538, 0),
(61, '45998293669', 1968, 1),
(62, '45998293669', 8467, 0),
(63, '45998293669', 2415, 0),
(64, '45998293669', 1470, 0),
(65, '45998293669', 9017, 0),
(66, '45998293669', 7107, 0),
(67, '45998293669', 3105, 0),
(68, '45998193669', 2698, 0),
(69, '45998193669', 8135, 0),
(70, '45998193669', 1860, 0),
(71, '45998193669', 7660, 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tipo_avaliacao`
--

CREATE TABLE `tipo_avaliacao` (
  `cod_tipo_avaliacao` int(11) NOT NULL,
  `nome` varchar(50) COLLATE utf8_bin NOT NULL,
  `flag_ativo` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Extraindo dados da tabela `tipo_avaliacao`
--

INSERT INTO `tipo_avaliacao` (`cod_tipo_avaliacao`, `nome`, `flag_ativo`) VALUES
(9, 'Atendimento', 1),
(10, 'PreÃ§o', 1),
(11, 'Agilidade', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

CREATE TABLE `usuario` (
  `cod_usuario` int(11) NOT NULL,
  `nome` varchar(60) COLLATE utf8_bin NOT NULL,
  `login` varchar(60) COLLATE utf8_bin NOT NULL,
  `senha` varchar(32) COLLATE utf8_bin NOT NULL,
  `email` varchar(100) COLLATE utf8_bin NOT NULL,
  `flag_bloqueado` tinyint(1) NOT NULL,
  `cod_perfil` tinyint(4) NOT NULL,
  `permissao` mediumtext COLLATE utf8_bin NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`cod_usuario`, `nome`, `login`, `senha`, `email`, `flag_bloqueado`, `cod_perfil`, `permissao`) VALUES
(1, 'admin', 'admin', 'e10adc3949ba59abbe56e057f20f883e', 'admin@admin.com', 0, 0, '[\"usuario\",\"empresa\",\"banner\",\"imagem\",\"evento\",\"categoria\",\"cardapio\"]'),
(3, 'douglas', 'douglas', '3b16dc694c38d04f7d7451cc37d3c654', 'douglas@douglas.com', 0, 0, '[\"usuario\"]'),
(4, 'kionux', 'kionux', 'c37ea86ec45c587ae1950e8f5337d84b', 'thiago@corp.kionux.com.br', 0, 0, '[\"usuario\",\"empresa\",\"banner\",\"imagem\",\"evento\",\"categoria\",\"cardapio\",\"cliente\",\"pedido\",\"avaliacao\"]'),
(9, 'vitor', 'vitor', '997d13b90da22b35ce43bebdd332ad11', 'vitormatheussb@gmail.com', 0, 0, '[\"usuario\",\"empresa\",\"banner\",\"imagem\",\"evento\",\"categoria\",\"cardapio\",\"cliente\",\"pedido\",\"avaliacao\"]'),
(10, 'Matheus', 'matheus', '45339359513f09155110f63f7ca91c3e', '', 0, 0, '[\"usuario\",\"empresa\",\"banner\",\"imagem\",\"evento\",\"categoria\",\"cardapio\",\"cliente\",\"pedido\",\"avaliacao\",\"combo\",\"adicional\", \"pedidoWpp\"]'),
(11, 'felipe', 'da Maia', '992ce73c8b7bdd59daa1de6ac995cad7', '', 0, 0, '[\"usuario\",\"empresa\",\"banner\",\"imagem\",\"evento\",\"categoria\",\"cardapio\",\"cliente\",\"pedido\",\"avaliacao\",\"combo\",\"adicional\",\"cupom\",\"forma_pgto\",\"info_entrega\"]'),
(12, 'Matheus Teste aaa', 'matheus1', '45339359513f09155110f63f7ca91c3e', '', 0, 0, '[\"usuario\",\"empresa\",\"banner\",\"imagem\",\"evento\",\"categoria\",\"cardapio\",\"cliente\",\"pedido\",\"avaliacao\",\"combo\",\"adicional\"]'),
(13, 'thiago', 'thiago', '8c278462dc2f486dd9697edc17eff391', '', 0, 0, '[\"pedidoWpp\"]'),
(14, 'Teste a', 'teste', '698dc19d489c4e4db73e28a713eab07b', 'example@email.com', 0, 0, '[]'),
(15, 'Isshak', 'isshak', '202cb962ac59075b964b07152d234b70', '', 0, 0, '[\"usuario\",\"empresa\",\"banner\",\"imagem\",\"evento\",\"categoria\",\"cardapio\",\"cliente\",\"pedido\",\"avaliacao\",\"combo\",\"adicional\",\"pedidoWpp\",\"forma_pgto\", \"info_entrega\", \"cupom\"]');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `adicional`
--
ALTER TABLE `adicional`
  ADD PRIMARY KEY (`cod_adicional`);

--
-- Índices para tabela `avaliacao`
--
ALTER TABLE `avaliacao`
  ADD PRIMARY KEY (`cod_avaliacao`),
  ADD KEY `tipo_avaliacao` (`tipo_avaliacao`),
  ADD KEY `data` (`data`);

--
-- Índices para tabela `banner`
--
ALTER TABLE `banner`
  ADD PRIMARY KEY (`cod_banner`);

--
-- Índices para tabela `cardapio`
--
ALTER TABLE `cardapio`
  ADD PRIMARY KEY (`cod_cardapio`),
  ADD KEY `categoria` (`categoria`),
  ADD KEY `slug` (`slug`(191)),
  ADD KEY `cardapio_turno` (`cardapio_turno`),
  ADD KEY `cardapio_horas_inicio` (`cardapio_horas_inicio`),
  ADD KEY `cardapio_horas_final` (`cardapio_horas_final`);

--
-- Índices para tabela `cardapio_horas`
--
ALTER TABLE `cardapio_horas`
  ADD PRIMARY KEY (`cod_cardapio_horas`);

--
-- Índices para tabela `cardapio_turno`
--
ALTER TABLE `cardapio_turno`
  ADD PRIMARY KEY (`cod_cardapio_turno`);

--
-- Índices para tabela `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`cod_categoria`);

--
-- Índices para tabela `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`cod_cliente`),
  ADD UNIQUE KEY `email` (`login`) USING BTREE,
  ADD UNIQUE KEY `cpf` (`cpf`) USING BTREE;

--
-- Índices para tabela `cupom`
--
ALTER TABLE `cupom`
  ADD PRIMARY KEY (`cod_cupom`);

--
-- Índices para tabela `cupom_cliente`
--
ALTER TABLE `cupom_cliente`
  ADD PRIMARY KEY (`cod_cupom_cliente`),
  ADD KEY `cod_cupom` (`cod_cupom`),
  ADD KEY `cod_cliente` (`cod_cliente`);

--
-- Índices para tabela `empresa`
--
ALTER TABLE `empresa`
  ADD PRIMARY KEY (`cod_empresa`);

--
-- Índices para tabela `endereco`
--
ALTER TABLE `endereco`
  ADD PRIMARY KEY (`cod_endereco`),
  ADD KEY `cliente` (`cliente`);

--
-- Índices para tabela `entrega`
--
ALTER TABLE `entrega`
  ADD PRIMARY KEY (`cod_entrega`),
  ADD UNIQUE KEY `raio_km` (`raio_km`);

--
-- Índices para tabela `evento`
--
ALTER TABLE `evento`
  ADD PRIMARY KEY (`cod_evento`);

--
-- Índices para tabela `formapgt`
--
ALTER TABLE `formapgt`
  ADD PRIMARY KEY (`cod_formaPgt`);

--
-- Índices para tabela `imagem`
--
ALTER TABLE `imagem`
  ADD PRIMARY KEY (`cod_imagem`);

--
-- Índices para tabela `item_pedido`
--
ALTER TABLE `item_pedido`
  ADD PRIMARY KEY (`cod_item_pedido`),
  ADD KEY `item_pedido` (`cod_produto`,`cod_pedido`);

--
-- Índices para tabela `pedido`
--
ALTER TABLE `pedido`
  ADD PRIMARY KEY (`cod_pedido`),
  ADD KEY `cliente` (`cliente`),
  ADD KEY `formaPgt` (`formaPgt`),
  ADD KEY `endereco` (`endereco`);

--
-- Índices para tabela `recupera_senha`
--
ALTER TABLE `recupera_senha`
  ADD PRIMARY KEY (`cod_recupera_senha`),
  ADD UNIQUE KEY `cod_recuperacao` (`cod_recuperacao`),
  ADD KEY `cod_cliente_fk` (`cod_cliente_fk`);

--
-- Índices para tabela `sms`
--
ALTER TABLE `sms`
  ADD PRIMARY KEY (`cod_sms`);

--
-- Índices para tabela `tipo_avaliacao`
--
ALTER TABLE `tipo_avaliacao`
  ADD PRIMARY KEY (`cod_tipo_avaliacao`);

--
-- Índices para tabela `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`cod_usuario`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `adicional`
--
ALTER TABLE `adicional`
  MODIFY `cod_adicional` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `avaliacao`
--
ALTER TABLE `avaliacao`
  MODIFY `cod_avaliacao` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT de tabela `banner`
--
ALTER TABLE `banner`
  MODIFY `cod_banner` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de tabela `cardapio`
--
ALTER TABLE `cardapio`
  MODIFY `cod_cardapio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=252;

--
-- AUTO_INCREMENT de tabela `cardapio_horas`
--
ALTER TABLE `cardapio_horas`
  MODIFY `cod_cardapio_horas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT de tabela `cardapio_turno`
--
ALTER TABLE `cardapio_turno`
  MODIFY `cod_cardapio_turno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `categoria`
--
ALTER TABLE `categoria`
  MODIFY `cod_categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT de tabela `cliente`
--
ALTER TABLE `cliente`
  MODIFY `cod_cliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=92;

--
-- AUTO_INCREMENT de tabela `cupom`
--
ALTER TABLE `cupom`
  MODIFY `cod_cupom` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `cupom_cliente`
--
ALTER TABLE `cupom_cliente`
  MODIFY `cod_cupom_cliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `empresa`
--
ALTER TABLE `empresa`
  MODIFY `cod_empresa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `endereco`
--
ALTER TABLE `endereco`
  MODIFY `cod_endereco` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT de tabela `entrega`
--
ALTER TABLE `entrega`
  MODIFY `cod_entrega` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de tabela `evento`
--
ALTER TABLE `evento`
  MODIFY `cod_evento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de tabela `formapgt`
--
ALTER TABLE `formapgt`
  MODIFY `cod_formaPgt` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `imagem`
--
ALTER TABLE `imagem`
  MODIFY `cod_imagem` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de tabela `item_pedido`
--
ALTER TABLE `item_pedido`
  MODIFY `cod_item_pedido` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=431;

--
-- AUTO_INCREMENT de tabela `pedido`
--
ALTER TABLE `pedido`
  MODIFY `cod_pedido` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=243;

--
-- AUTO_INCREMENT de tabela `recupera_senha`
--
ALTER TABLE `recupera_senha`
  MODIFY `cod_recupera_senha` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de tabela `sms`
--
ALTER TABLE `sms`
  MODIFY `cod_sms` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT de tabela `tipo_avaliacao`
--
ALTER TABLE `tipo_avaliacao`
  MODIFY `cod_tipo_avaliacao` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de tabela `usuario`
--
ALTER TABLE `usuario`
  MODIFY `cod_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `avaliacao`
--
ALTER TABLE `avaliacao`
  ADD CONSTRAINT `avaliacao_ibfk_1` FOREIGN KEY (`tipo_avaliacao`) REFERENCES `tipo_avaliacao` (`cod_tipo_avaliacao`);

--
-- Limitadores para a tabela `cardapio`
--
ALTER TABLE `cardapio`
  ADD CONSTRAINT `cardapio_ibfk_1` FOREIGN KEY (`cardapio_turno`) REFERENCES `cardapio_turno` (`cod_cardapio_turno`),
  ADD CONSTRAINT `cardapio_ibfk_2` FOREIGN KEY (`cardapio_horas_inicio`) REFERENCES `cardapio_horas` (`cod_cardapio_horas`),
  ADD CONSTRAINT `cardapio_ibfk_3` FOREIGN KEY (`cardapio_horas_final`) REFERENCES `cardapio_horas` (`cod_cardapio_horas`);

--
-- Limitadores para a tabela `cupom_cliente`
--
ALTER TABLE `cupom_cliente`
  ADD CONSTRAINT `cupom_cliente_ibfk_1` FOREIGN KEY (`cod_cupom`) REFERENCES `cupom` (`cod_cupom`),
  ADD CONSTRAINT `cupom_cliente_ibfk_2` FOREIGN KEY (`cod_cliente`) REFERENCES `cliente` (`cod_cliente`);

--
-- Limitadores para a tabela `endereco`
--
ALTER TABLE `endereco`
  ADD CONSTRAINT `endereco_ibfk_1` FOREIGN KEY (`cliente`) REFERENCES `cliente` (`cod_cliente`);

--
-- Limitadores para a tabela `recupera_senha`
--
ALTER TABLE `recupera_senha`
  ADD CONSTRAINT `recupera_senha_ibfk_1` FOREIGN KEY (`cod_cliente_fk`) REFERENCES `cliente` (`cod_cliente`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

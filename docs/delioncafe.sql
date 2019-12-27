-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 27-Dez-2019 às 21:54
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
-- Estrutura da tabela `rl_cliente_cupom`
--

CREATE TABLE `rl_cliente_cupom` (
  `clcu_pk_id` int(11) NOT NULL,
  `clcu_ultimo_uso` datetime NOT NULL,
  `clcu_fk_cliente` int(11) NOT NULL,
  `clcu_fk_cupom` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `rl_cliente_sms`
--

CREATE TABLE `rl_cliente_sms` (
  `clsm_pk_id` int(11) NOT NULL,
  `clsm_fk_sms_mensagem` int(11) NOT NULL,
  `clsm_fk_cliente` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `rl_pedido_produto`
--

CREATE TABLE `rl_pedido_produto` (
  `pepr_fk_produto` int(11) NOT NULL,
  `pepr_fk_pedido` int(11) NOT NULL,
  `pepr_quantidade` tinyint(4) NOT NULL,
  `pepr_observacao` varchar(255) NOT NULL,
  `pepr_preco` decimal(6,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `rl_pedido_produto`
--

INSERT INTO `rl_pedido_produto` (`pepr_fk_produto`, `pepr_fk_pedido`, `pepr_quantidade`, `pepr_observacao`, `pepr_preco`) VALUES
(20, 20, 1, '', '9.00'),
(20, 21, 1, '', '9.00');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_adicional`
--

CREATE TABLE `tb_adicional` (
  `adi_pk_id` int(11) NOT NULL,
  `adi_nome` varchar(50) NOT NULL,
  `adi_preco` decimal(5,2) NOT NULL,
  `adi_ck_desconto` tinyint(4) NOT NULL DEFAULT 0,
  `adi_flag_ativo` tinyint(1) NOT NULL DEFAULT 0,
  `adi_fk_empresa` int(11) DEFAULT NULL,
  `adi_fk_produto` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_avaliacao`
--

CREATE TABLE `tb_avaliacao` (
  `ava_pk_id` int(11) NOT NULL,
  `ava_data_hora` datetime NOT NULL DEFAULT current_timestamp(),
  `ava_nota` tinyint(1) UNSIGNED NOT NULL,
  `ava_fk_tipo_avaliacao` int(11) NOT NULL,
  `ava_fk_empresa` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_banner`
--

CREATE TABLE `tb_banner` (
  `ban_pk_id` int(11) NOT NULL,
  `ban_nome` varchar(255) NOT NULL,
  `ban_link` varchar(255) NOT NULL,
  `ban_legenda` varchar(100) NOT NULL,
  `ban_flag_tamanho` tinyint(1) NOT NULL,
  `ban_foto` varchar(255) NOT NULL,
  `ban_pagina` varchar(255) NOT NULL,
  `ban_fk_empresa` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_categoria`
--

CREATE TABLE `tb_categoria` (
  `cat_pk_id` int(11) NOT NULL,
  `cat_nome` varchar(30) NOT NULL,
  `cat_icone` varchar(255) NOT NULL,
  `cat_posicao` tinyint(4) NOT NULL,
  `cat_fk_empresa` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `tb_categoria`
--

INSERT INTO `tb_categoria` (`cat_pk_id`, `cat_nome`, `cat_icone`, `cat_posicao`, `cat_fk_empresa`) VALUES
(22, 'Bebidas', 'upload/2018/02/08/f7e151d8382e33371ddc7bad5f0bb18e.png', 0, NULL),
(25, 'Doces', 'upload/2018/02/07/a0104b4effe429905736271f6e79958a.png', 6, NULL),
(26, 'Salgados', 'upload/2018/02/07/15a28ab8c0da79f98fba13378d9b15fa.png', 3, NULL),
(27, 'Sanduíches', 'upload/2018/02/07/cbebc01daf6b108be59b15e55ec44ca4.png', 5, NULL),
(28, 'Tortas', 'upload/2018/02/07/9eacc77261bb78725997071a6384458e.png', 7, NULL),
(34, 'Combos + por -', 'upload/2019/10/25/b172995c756b3fb35d31b312fd8309c6.png', 2, NULL),
(37, 'Refeições', 'upload/2019/10/25/a64ffec338ebc5f200a8fc54188e03b8.png', 1, NULL),
(38, 'Especial', 'upload/2018/02/16/36488e1c4363d1302c70fdac6fb3fad1.png', 4, NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_cidade`
--

CREATE TABLE `tb_cidade` (
  `ci_pk_id` int(11) NOT NULL,
  `ci_cidade` varchar(60) NOT NULL,
  `ci_fk_estado` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_cliente`
--

CREATE TABLE `tb_cliente` (
  `cli_pk_id` int(11) NOT NULL,
  `cli_cpf` bigint(11) UNSIGNED ZEROFILL DEFAULT NULL,
  `cli_nome` varchar(30) NOT NULL,
  `cli_sobrenome` varchar(30) DEFAULT NULL,
  `cli_login_email` varchar(60) NOT NULL,
  `cli_senha` varchar(32) DEFAULT NULL,
  `cli_telefone` varchar(20) DEFAULT NULL,
  `cli_data_nasc` date DEFAULT NULL,
  `cli_status` tinyint(1) DEFAULT NULL,
  `cli_id_google` varchar(32) DEFAULT NULL,
  `cli_id_facebook` varchar(255) DEFAULT NULL,
  `cli_pontos_fidelidade` decimal(5,2) DEFAULT NULL,
  `cli_fk_empresa` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `tb_cliente`
--

INSERT INTO `tb_cliente` (`cli_pk_id`, `cli_cpf`, `cli_nome`, `cli_sobrenome`, `cli_login_email`, `cli_senha`, `cli_telefone`, `cli_data_nasc`, `cli_status`, `cli_id_google`, `cli_id_facebook`, `cli_pontos_fidelidade`, `cli_fk_empresa`) VALUES
(35, 83963178019, 'Matheus', 'Teste', 'matheus@corp.kionux.com.br', 'd6692821ac08b1de509dca21b10ce889', '45998081179', '1995-04-11', 1, NULL, NULL, NULL, NULL),
(68, 68078123027, 'isshak', 'Daq', 'isshak@corp.kionux.com.br', '6bfeb74f6009ddc03d9875e955785e07', '45998293669', '1997-11-19', 1, NULL, NULL, NULL, NULL),
(91, 79432287076, 'isshak', 'afafa', 'isshak.mohamad@gmail.co', '6bfeb74f6009ddc03d9875e955785e07', '45998293669', '1997-11-19', 1, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_cupom`
--

CREATE TABLE `tb_cupom` (
  `cup_pk_id` int(11) NOT NULL,
  `cup_codigo` varchar(255) NOT NULL,
  `cup_qtde_inicial` mediumint(9) NOT NULL,
  `cup_valor` decimal(6,2) NOT NULL,
  `cup_qtde_atual` int(11) NOT NULL,
  `cup_vencimento_data` date NOT NULL,
  `cup_status` tinyint(1) NOT NULL,
  `cup_vencimento_hora` time NOT NULL,
  `cup_valor_minimo` decimal(6,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_empresa`
--

CREATE TABLE `tb_empresa` (
  `emp_pk_id` int(11) NOT NULL,
  `emp_nome` varchar(255) NOT NULL,
  `emp_descricao` mediumtext NOT NULL,
  `emp_historia` mediumtext NOT NULL,
  `emp_endereco` varchar(255) NOT NULL,
  `emp_bairro` varchar(100) NOT NULL,
  `emp_cidade` varchar(100) NOT NULL,
  `emp_estado` varchar(30) NOT NULL,
  `emp_cep` varchar(10) NOT NULL,
  `emp_fone` varchar(20) NOT NULL,
  `emp_whats` varchar(20) NOT NULL,
  `emp_email` varchar(100) NOT NULL,
  `emp_facebook` varchar(255) NOT NULL,
  `emp_instagram` varchar(255) NOT NULL,
  `emp_pinterest` varchar(255) NOT NULL,
  `emp_foto` varchar(255) NOT NULL,
  `emp_txt_dias_semana` varchar(30) NOT NULL,
  `emp_txt_horario_semana` varchar(30) NOT NULL,
  `emp_txt_dias_fim_semana` varchar(30) NOT NULL,
  `emp_txt_horario_fim_semana` varchar(30) NOT NULL,
  `emp_arr_dias_semana` varchar(50) NOT NULL,
  `emp_arr_horarios_inicio` varchar(100) NOT NULL,
  `emp_arr_horarios_final` varchar(100) NOT NULL,
  `emp_aberto` tinyint(1) NOT NULL,
  `emp_entregando` tinyint(1) NOT NULL,
  `emp_taxa_conversao_fidelidade` decimal(2,1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `tb_empresa`
--

INSERT INTO `tb_empresa` (`emp_pk_id`, `emp_nome`, `emp_descricao`, `emp_historia`, `emp_endereco`, `emp_bairro`, `emp_cidade`, `emp_estado`, `emp_cep`, `emp_fone`, `emp_whats`, `emp_email`, `emp_facebook`, `emp_instagram`, `emp_pinterest`, `emp_foto`, `emp_txt_dias_semana`, `emp_txt_horario_semana`, `emp_txt_dias_fim_semana`, `emp_txt_horario_fim_semana`, `emp_arr_dias_semana`, `emp_arr_horarios_inicio`, `emp_arr_horarios_final`, `emp_aberto`, `emp_entregando`, `emp_taxa_conversao_fidelidade`) VALUES
(1, 'Delion Café', '&lt;p&gt;A Delion Caf&amp;eacute; foi idealizada no ano de 2015, seus idealizadores objetivavam levar aos clientes produtos de qualidade, elaborados dentro de um esmerado controle de qualidade e higiene, n&amp;atilde;o se esquecendo do fator pre&amp;ccedil;o. Tudo foi pensado para que os clientes desfrutacem de bons produtos, com um pre&amp;ccedil;o justo, em um ambiente amplo e agrad&amp;aacute;vel.&lt;/p&gt;\r\n&lt;p&gt;Hoje a Delion Caf&amp;eacute; &amp;eacute; uma realidade, trouxe para Foz do Igua&amp;ccedil;u um conceito novo, jovem e diferenciado. Servindo sempre produtos frescos, que saem direto do forno para mesa dos clientes, sem utiliza&amp;ccedil;&amp;atilde;o de reaquecimento, os produtos da Delion Caf&amp;eacute; s&amp;atilde;o elaborados no momento do pedido, por esse motivo o sabor &amp;eacute; iniqual&amp;aacute;vel.&lt;/p&gt;', '&lt;p&gt;&lt;strong&gt;Delion de Oliveira&lt;/strong&gt;, segundo filho de cinco irm&amp;atilde;os, nasceu em Jacare&amp;iacute;, interior de S&amp;atilde;o Paulo, no dia 31 de Mar&amp;ccedil;o de 1931. Filho de Juvenal de Oliveira, um funcion&amp;aacute;rio da extinta Central do Brasil e Ol&amp;iacute;via Miguel de Oliveira, uma mulher de fibra, benzedeira e de uma bondade impar.Foi casado por 43 anos com Nilse Maria de Azevedo de Oliveira com quem teve dois filhos, Marcia e Delion Jr. Quando faleceu, al&amp;eacute;m da esposa e dos filhos, deixou sete netos: Rodrigo, Thiago, Jeniffer, Denise, Ana Lu&amp;iacute;sa, Bruno e Leonardo.&lt;/p&gt;\r\n&lt;p&gt;Cursou a Escola Agr&amp;iacute;cola de Jacare&amp;iacute; C&amp;ocirc;nego Jos&amp;eacute; Bento, na vida profissional, trabalhou na Casa Michel, foi funcion&amp;aacute;rio do antigo Banco Mercantil de S&amp;atilde;o Paulo e se aposentou na Gates do Brasil. Paralelo aos trabalhos sempre fazia bicos de gar&amp;ccedil;om para refor&amp;ccedil;ar o or&amp;ccedil;amento domestico, ali&amp;aacute;s, o que lhe dava grande prazer, devido ao fato de gostar de tratar com o p&amp;uacute;blico. Ap&amp;oacute;s se aposentar, gerenciou uma lanchonete e sempre revelava em suas conversas que adoraria ter um estabelecimento ligado ao setor de gastronomia. N&amp;atilde;o foi poss&amp;iacute;vel realizar esse sonho, ele faleceu em Jacare&amp;iacute;, no dia 30 de Maio de 1996, aos 65 anos, v&amp;iacute;tima de uma diabetes que contraiu ainda na adolesc&amp;ecirc;ncia. Ele sempre foi lembrado como um homem trabalhador, de bom car&amp;aacute;ter, extremamente honesto, que amava sua fam&amp;iacute;lia e que tinha uma alegria contagiante. Seu sorriso largo e sua alegria de viver foram sua marca registrada.&lt;/p&gt;\r\n&lt;p&gt;Dezenove anos ap&amp;oacute;s seu falecimento, seu sonho se materializou, a Delion Caf&amp;eacute; &amp;eacute; uma realidade, um estabelecimento com nome desse que deixou saudades e in&amp;uacute;meras li&amp;ccedil;&amp;otilde;es de vida a todos que fizeram parte de seu conv&amp;iacute;vio&lt;/p&gt;', 'Rua Jorge Sanwais, 1137', 'Centro', 'Foz do Iguaçu', 'Paraná', '85851-150', '(45) 3027-0059', '45991075688', 'contato@delioncafe.com.br', 'www.facebook.com/delioncafe', 'www.instagram.com/delioncafe', 'br.pinterest.com/search/pins/?q=Delion%20Caf%C3%A9&amp;rs=typed&amp;term_meta[]=Delion%7Ctyped&amp;term_meta[]=Caf%C3%A9%7Ctyped', 'upload/2018/09/13/afb1bd5fa29d26ac8745bc0c05281da5.png', 'Segunda a Sexta', '10:00h às 21:00h', 'Aos Sábados', '08:30h  às 19:00h', '[\"2\",\"3\",\"4\",\"5\",\"6\",\"7\"]', '[\"\",\"10:00\",\"10:00\",\"09:00\",\"10:00\",\"10:00\",\"08:30\"]', '[\"\",\"21:00\",\"21:00\",\"21:00\",\"21:00\",\"21:00\",\"19:00\"]', 1, 1, NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_endereco`
--

CREATE TABLE `tb_endereco` (
  `end_pk_id` int(11) NOT NULL,
  `end_rua` varchar(100) NOT NULL,
  `end_numero` int(11) NOT NULL,
  `end_cep` varchar(10) NOT NULL,
  `end_complemento` varchar(255) DEFAULT NULL,
  `end_bairro` varchar(100) DEFAULT NULL,
  `end_referencia` varchar(100) DEFAULT NULL,
  `end_fk_cliente` int(11) DEFAULT NULL,
  `end_flag_cliente` tinyint(1) DEFAULT NULL,
  `end_fk_cidade` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_entrega`
--

CREATE TABLE `tb_entrega` (
  `ent_pk_id` int(11) NOT NULL,
  `ent_tempo` smallint(6) NOT NULL,
  `ent_raio_km` tinyint(4) NOT NULL,
  `ent_taxa_entrega` decimal(6,2) NOT NULL,
  `ent_valor_minimo` decimal(6,2) NOT NULL,
  `ent_min_taxa_gratis` decimal(6,2) DEFAULT NULL,
  `ent_flag_ativo` tinyint(1) NOT NULL,
  `ent_fk_empresa` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `tb_entrega`
--

INSERT INTO `tb_entrega` (`ent_pk_id`, `ent_tempo`, `ent_raio_km`, `ent_taxa_entrega`, `ent_valor_minimo`, `ent_min_taxa_gratis`, `ent_flag_ativo`, `ent_fk_empresa`) VALUES
(1, 25, 1, '0.00', '10.00', '0.00', 1, NULL),
(2, 35, 3, '5.00', '10.00', '20.00', 1, NULL),
(4, 37, 5, '7.00', '15.00', '30.00', 1, NULL),
(5, 50, 15, '15.00', '50.00', '100.00', 0, NULL),
(6, 50, 10, '10.00', '20.00', '60.00', 0, NULL),
(10, 20, 20, '20.00', '100.00', '100.00', 0, NULL),
(11, 40, 7, '7.00', '20.00', '50.00', 1, NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_estado`
--

CREATE TABLE `tb_estado` (
  `es_pk_id` int(11) NOT NULL,
  `es_estado` varchar(45) NOT NULL,
  `es_sigla` varchar(45) NOT NULL,
  `es_fk_pais` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_evento`
--

CREATE TABLE `tb_evento` (
  `eve_pk_id` int(11) NOT NULL,
  `eve_nome` varchar(255) NOT NULL,
  `eve_data` date NOT NULL,
  `eve_flag_antigo` tinyint(1) NOT NULL,
  `eve_foto` varchar(255) NOT NULL,
  `eve_fk_empresa` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_faixa_horario`
--

CREATE TABLE `tb_faixa_horario` (
  `faho_pk_id` int(11) NOT NULL,
  `faho_inicio` time NOT NULL,
  `faho_final` time NOT NULL,
  `faho_nome` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `tb_faixa_horario`
--

INSERT INTO `tb_faixa_horario` (`faho_pk_id`, `faho_inicio`, `faho_final`, `faho_nome`) VALUES
(1, '10:00:00', '21:00:00', 'Padrão funcionamento');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_forma_pgto`
--

CREATE TABLE `tb_forma_pgto` (
  `fopg_pk_id` int(11) NOT NULL,
  `fopg_nome` varchar(60) NOT NULL,
  `fopg_flag_ativo` tinyint(1) UNSIGNED NOT NULL,
  `fopg_fk_empresa` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `tb_forma_pgto`
--

INSERT INTO `tb_forma_pgto` (`fopg_pk_id`, `fopg_nome`, `fopg_flag_ativo`, `fopg_fk_empresa`) VALUES
(1, 'Dinheiro', 1, 1),
(2, 'Crédito', 1, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_imagem`
--

CREATE TABLE `tb_imagem` (
  `ima_pk_id` int(11) NOT NULL,
  `ima_nome` varchar(255) NOT NULL,
  `ima_foto` varchar(255) NOT NULL,
  `ima_pagina` varchar(255) NOT NULL,
  `ima_fk_empresa` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `tb_imagem`
--

INSERT INTO `tb_imagem` (`ima_pk_id`, `ima_nome`, `ima_foto`, `ima_pagina`, `ima_fk_empresa`) VALUES
(1, 'Cardapio', 'upload/2018/01/08/0f61ab54d56b7777b3126743d7353dda.png', '[\"inicialCardapio\",\"cardapio\"]', NULL),
(2, 'Evento', 'upload/2018/01/08/c0fe08cdb71a42972fe9072f9cd4fb4f.png', '[\"inicialEvento\"]', NULL),
(3, 'CartÃ£o', 'upload/2018/10/03/d44a89f0c633e844421961fd6fb58dd1.png', '[\"inicialCartaoFidelidade\"]', NULL),
(4, 'pedido', 'upload/2018/10/03/6a25c0a0c862b9d31e0695a38bd8568e.png', '[\"inicialPedido\"]', NULL),
(5, 'sobre', 'upload/2018/01/09/16548982dc2e3f82e4defb1b90bd6a6a.png', '[\"sobre\"]', NULL),
(6, 'contato 1', 'upload/2018/01/09/860d93bcf684dd0035f3d06549b6b7ca.png', '[\"historia\",\"contato\"]', NULL),
(7, 'contato 2', 'upload/2018/01/09/9b9c2db09d8c7e53c7f372ce94a96832.png', '[\"historia\",\"contato\"]', NULL),
(8, 'Sanduba', 'upload/2018/02/08/38ed35cae335f03d3eaa498a8c32108d.png', '[\"inicialCardapio\"]', NULL),
(9, 'SuflÃª', 'upload/2018/02/08/adfc28c9b2c6430aea7c723898d425fe.png', '[\"inicialCardapio\"]', NULL),
(10, 'CafÃ© com Doce', 'upload/2018/02/08/aeca3bb3a6254bd91a04a718f4f24c6d.png', '[\"inicialCardapio\",\"cardapio\"]', NULL),
(11, 'Combo', 'upload/2018/02/08/01db8fb0479a6ad12dafb6fd2c10c2f3.png', '[\"inicialCardapio\"]', NULL),
(12, 'Mortadela', 'upload/2018/02/08/3d4de8b7911b7f18499e5e17546ca5c1.png', '[\"inicialCardapio\",\"cardapio\"]', NULL),
(14, 'CLUBE DA VITROLA', 'upload/2018/02/28/35228adbee6f18c9df32ba966452b1f9.jpg', '[\"inicialEvento\"]', NULL),
(15, 'popUp', 'upload/2018/10/19/39310f9deaf64b1effcb120ed3ddcd8d.jpg', '[\"popUp\"]', NULL),
(16, 'Topo Home', 'upload/2019/10/22/a809823534540bc6d3d28e4af378d203.png', '[\"homeTopo\"]', NULL),
(17, 'Eventos', 'upload/2019/10/22/b4abe4edbbc62731ab3e347f1bc7cc76.png', '[\"homeEventos\"]', NULL),
(18, 'Logo Home', 'upload/2019/10/22/280c3685ae41bd2f9e279dfc47f5e008.png', '[\"homeLogo\"]', NULL),
(19, 'Fidelidade', 'upload/2019/10/22/57828dd8d199901365a4729885348b2c.png', '[\"homeFidelidade\"]', NULL),
(20, 'Quem Somos', 'upload/2019/10/22/6481fec3b6c15885f0dce72c7c03cd16.png', '[\"homeQuemSomos\"]', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_origem_pedido`
--

CREATE TABLE `tb_origem_pedido` (
  `orpe_pk_id` int(11) NOT NULL,
  `orpe_origem` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_pais`
--

CREATE TABLE `tb_pais` (
  `pa_pk_id` int(11) NOT NULL,
  `pa_pais` varchar(45) NOT NULL,
  `pa_sigla` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_pedido`
--

CREATE TABLE `tb_pedido` (
  `ped_pk_id` int(11) NOT NULL,
  `ped_data` datetime NOT NULL,
  `ped_valor` decimal(6,2) NOT NULL,
  `ped_taxa_entrega` decimal(6,2) NOT NULL,
  `ped_subtotal` decimal(6,2) NOT NULL,
  `ped_operacao_fidelidade` decimal(5,2) DEFAULT NULL,
  `ped_desconto` decimal(6,2) NOT NULL,
  `ped_status` tinyint(4) NOT NULL,
  `ped_hora_print` time NOT NULL,
  `ped_hora_delivery` time NOT NULL,
  `ped_hora_retirada` time NOT NULL,
  `ped_tempo_entrega` smallint(6) DEFAULT NULL,
  `ped_fk_empresa` int(11) DEFAULT NULL,
  `ped_fk_cliente` int(11) NOT NULL,
  `ped_fk_origem_pedido` int(11) DEFAULT NULL,
  `ped_fk_forma_pgto` int(11) NOT NULL,
  `ped_fk_endereco` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `tb_pedido`
--

INSERT INTO `tb_pedido` (`ped_pk_id`, `ped_data`, `ped_valor`, `ped_taxa_entrega`, `ped_subtotal`, `ped_operacao_fidelidade`, `ped_desconto`, `ped_status`, `ped_hora_print`, `ped_hora_delivery`, `ped_hora_retirada`, `ped_tempo_entrega`, `ped_fk_empresa`, `ped_fk_cliente`, `ped_fk_origem_pedido`, `ped_fk_forma_pgto`, `ped_fk_endereco`) VALUES
(14, '2019-12-19 17:03:07', '9.00', '0.00', '9.00', NULL, '0.00', 1, '00:00:00', '00:00:00', '00:00:00', NULL, NULL, 68, NULL, 1, NULL),
(19, '2019-12-19 17:21:26', '9.00', '0.00', '9.00', NULL, '0.00', 1, '00:00:00', '00:00:00', '00:00:00', NULL, NULL, 68, NULL, 1, NULL),
(20, '2019-12-19 17:22:32', '9.00', '0.00', '9.00', NULL, '0.00', 1, '00:00:00', '00:00:00', '00:00:00', NULL, NULL, 68, NULL, 1, NULL),
(21, '2019-12-27 14:44:40', '9.00', '0.00', '9.00', NULL, '0.00', 1, '00:00:00', '00:00:00', '00:00:00', NULL, NULL, 68, NULL, 1, NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_produto`
--

CREATE TABLE `tb_produto` (
  `pro_pk_id` int(11) NOT NULL,
  `pro_nome` varchar(255) NOT NULL,
  `pro_preco` decimal(6,2) NOT NULL,
  `pro_descricao` mediumtext NOT NULL,
  `pro_foto` varchar(255) NOT NULL,
  `pro_flag_ativo` tinyint(1) NOT NULL,
  `pro_flag_servindo` tinyint(1) NOT NULL,
  `pro_slug` varchar(255) NOT NULL,
  `pro_posicao` smallint(6) NOT NULL,
  `pro_flag_prioridade` tinyint(1) DEFAULT NULL,
  `pro_flag_delivery` tinyint(1) DEFAULT NULL,
  `pro_desconto` tinyint(4) DEFAULT NULL,
  `pro_arr_adicional` varchar(50) DEFAULT NULL,
  `pro_arr_dias_semana` varchar(50) DEFAULT NULL,
  `pro_fk_empresa` int(11) DEFAULT NULL,
  `pro_fk_categoria` int(11) DEFAULT NULL,
  `pro_fk_faixa_horario` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `tb_produto`
--

INSERT INTO `tb_produto` (`pro_pk_id`, `pro_nome`, `pro_preco`, `pro_descricao`, `pro_foto`, `pro_flag_ativo`, `pro_flag_servindo`, `pro_slug`, `pro_posicao`, `pro_flag_prioridade`, `pro_flag_delivery`, `pro_desconto`, `pro_arr_adicional`, `pro_arr_dias_semana`, `pro_fk_empresa`, `pro_fk_categoria`, `pro_fk_faixa_horario`) VALUES
(14, 'Combo Delion 1', '5.00', '&lt;p&gt;Dois p&amp;atilde;es franceses na chapa e um caf&amp;eacute; expresso.&lt;br /&gt;&lt;br /&gt;Todos os combos s&amp;atilde;o preparados na hora e o tempo m&amp;eacute;dio de preparo &amp;eacute; entre 5 a 10 minutos.&lt;/p&gt;', 'upload/2018/09/19/5762d0f3c2e7148f7976ec092ae04df4.jpg', 1, 1, '', 6, 0, 0, 1, NULL, '[\"2\",\"3\",\"4\",\"5\",\"6\",\"7\"]', NULL, 34, 1),
(15, 'Combo Delion 2', '6.00', '&lt;p&gt;Dois p&amp;atilde;es franceses na chapa e um caf&amp;eacute; com leite.&lt;br /&gt;&lt;br /&gt;Todos os combos s&amp;atilde;o preparados na hora e o tempo m&amp;eacute;dio de preparo &amp;eacute; entre 5 a 10 minutos.&lt;/p&gt;', 'upload/2018/09/19/91a09e96f0fb40447e1d04ae01637707.jpg', 1, 1, '', 7, 0, 0, 1, NULL, '[\"2\",\"3\",\"4\",\"5\",\"6\",\"7\"]', NULL, 34, 1),
(16, 'Combo Delion 3', '6.50', '&lt;p&gt;Dois p&amp;atilde;es franceses na chapa com requeij&amp;atilde;o e um caf&amp;eacute; com leite.&lt;br /&gt;&lt;br /&gt;Todos os combos s&amp;atilde;o preparados na hora e o tempo m&amp;eacute;dio de preparo &amp;eacute; entre 5 a 10 minutos.&lt;/p&gt;', 'upload/2018/09/19/13da77c84e4cad21d6ad52d47db8b392.jpg', 1, 1, '', 8, 0, 0, 1, NULL, '[\"2\",\"3\",\"4\",\"5\",\"6\",\"7\"]', NULL, 34, 1),
(17, 'Macarrão a Carbonara', '13.90', '&lt;p&gt;Espaguete com bacon, ovo e queijo.&lt;/p&gt;\r\n&lt;p&gt;Acompanha um refrigerante ca&amp;ccedil;ulinha.&lt;/p&gt;\r\n&lt;p&gt;Tempo de preparo &amp;eacute; de 15 minutos.&lt;/p&gt;', 'upload/2018/09/19/8729370d2007f43107e1f919a2d596eb.jpg', 1, 1, '', 1, 1, 1, 1, NULL, '[\"2\",\"3\",\"4\",\"5\",\"6\",\"7\"]', NULL, 37, 1),
(18, 'Macarrão 3 Queijos', '13.90', '&lt;p&gt;Espaguete com queijo parmes&amp;atilde;o, provolone e gouda.&lt;/p&gt;\r\n&lt;p&gt;Acompanha um refrigerante ca&amp;ccedil;ulinha.&lt;/p&gt;\r\n&lt;p&gt;Tempo de preparo &amp;eacute; de 15 minutos.&lt;/p&gt;', 'upload/2018/09/19/43c2c408f2e25421bfe593ebbdacc063.jpg', 1, 1, '', 2, 1, 1, 1, NULL, '[\"2\",\"3\",\"4\",\"5\",\"6\",\"7\"]', NULL, 37, 1),
(19, 'Prato Executivo com Mignion', '15.90', '&lt;p&gt;Arroz, salada de alface, tomate e pepino, batatas fritas e 150 gramas de fil&amp;eacute; mignon&lt;/p&gt;\r\n&lt;p&gt;O cliente poder&amp;aacute; tamb&amp;eacute;m optar por fil&amp;eacute; de frango.&lt;/p&gt;\r\n&lt;p&gt;Tempo de preparo &amp;eacute; de 15 minutos.&lt;/p&gt;', 'upload/2018/09/18/0df5150a38b8ca10ed7490554780af72.jpg', 1, 1, '', 3, 1, 1, 1, NULL, '[\"2\",\"3\",\"4\",\"5\",\"6\",\"7\"]', NULL, 37, 1),
(20, 'Deppuccino de Chocolate ', '9.00', '&lt;p&gt;Bebida gelada: 300ml de leite, shot de cafe, chocolate, chocolate em calda, chantilly.&lt;/p&gt;', 'upload/2018/03/08/30cdf928d38574f9775685826185ef33.jpg', 1, 1, '', 0, 0, 0, 1, '[\"3\"]', '[\"2\",\"3\",\"4\",\"5\",\"6\",\"7\"]', NULL, 22, 1),
(21, 'Deppuccino de Oreo com Nutella ', '9.00', '&lt;p&gt;&lt;strong&gt;Bebida gelada.&lt;/strong&gt;&lt;/p&gt;\r\n&lt;p&gt;150 ml de leite, shot de expresso, oreo, nutella, calda de chocolate e chantilly.&lt;/p&gt;\r\n&lt;p&gt;Tempo de preparo &amp;eacute; de 10 minutos.&lt;/p&gt;\r\n&lt;p&gt;&amp;nbsp;&lt;/p&gt;', 'upload/2018/03/08/e09b6739a807a3a259358b9877511460.jpg', 1, 1, '', 30, 0, 0, 1, '[\"3\"]', '[\"2\",\"3\",\"4\",\"5\",\"6\",\"7\"]', NULL, 22, 1),
(23, 'Ice Cappuccino', '6.50', '&lt;div dir=&quot;auto&quot;&gt;&lt;strong&gt;Bebida gelada.&lt;/strong&gt;&lt;/div&gt;\r\n&lt;div dir=&quot;auto&quot;&gt;300 ml de leite, mix em p&amp;oacute; de gr&amp;atilde;os de caf&amp;eacute; e gelo.&lt;/div&gt;\r\n&lt;div dir=&quot;auto&quot;&gt;Batido no Liquidificador.&lt;/div&gt;\r\n&lt;div dir=&quot;auto&quot;&gt;&amp;nbsp;&lt;/div&gt;\r\n&lt;div dir=&quot;auto&quot;&gt;Tempo de preparo &amp;eacute; de 10 minutos.&lt;/div&gt;', 'upload/2018/09/19/1593e7eacb59621805594d03ba68de5e.jpg', 1, 1, '', 29, 0, 0, 1, NULL, '[\"2\",\"3\",\"4\",\"5\",\"6\",\"7\"]', NULL, 22, 1),
(24, 'Ice Cioccolato  ', '6.50', '&lt;p&gt;&lt;strong&gt;Bebida gelada.&lt;/strong&gt;&lt;/p&gt;\r\n&lt;p&gt;300 ml de leite, mix em p&amp;oacute; de chocolate e gelo.&lt;/p&gt;\r\n&lt;p&gt;Batido no liquidificador.&lt;/p&gt;\r\n&lt;p&gt;Tempo de preparo &amp;eacute; de 10 minutos.&lt;/p&gt;', 'upload/2018/09/19/ec8c0d96f597fb081597d5b58705b169.jpg', 1, 1, '', 32, 0, 0, 1, NULL, '[\"2\",\"3\",\"4\",\"5\",\"6\",\"7\"]', NULL, 22, 1),
(25, 'Limonada Rosa (S/L)', '6.50', '&lt;p&gt;&lt;strong&gt;Bebida gelada.&lt;/strong&gt;&lt;/p&gt;\r\n&lt;p&gt;300 ml de limonada, a&amp;ccedil;&amp;uacute;car, gelo e ess&amp;ecirc;ncia de groselha.&lt;/p&gt;\r\n&lt;p&gt;A&amp;ccedil;&amp;uacute;car &amp;eacute; opcional.&lt;/p&gt;\r\n&lt;p&gt;Tempo de preparo &amp;eacute; de 10 minutos.&lt;/p&gt;', 'upload/2018/09/14/f650a375ac3ebdcc70808cd144d5a704.jpg', 1, 1, '', 33, 0, 0, 1, NULL, '[\"2\",\"3\",\"4\",\"5\",\"6\",\"7\"]', NULL, 22, 1),
(26, 'Limonada de Morango (S/L)', '7.50', '&lt;p&gt;&lt;strong&gt;Bebida gelada.&lt;/strong&gt;&lt;/p&gt;\r\n&lt;p&gt;300 ml de limonada, 100 gr de morango, a&amp;ccedil;&amp;uacute;car.&lt;/p&gt;\r\n&lt;p&gt;Batido no liquidificador.&lt;/p&gt;\r\n&lt;p&gt;A&amp;ccedil;&amp;uacute;car &amp;eacute; opcional.&lt;/p&gt;\r\n&lt;p&gt;Tempo de preparo &amp;eacute; de 10 minutos.&lt;/p&gt;', 'upload/2018/09/19/1a94589b9367825ae76d4d938061b7b5.png', 1, 1, '', 34, 0, 0, 1, NULL, '[\"2\",\"3\",\"4\",\"5\",\"6\",\"7\"]', NULL, 22, 1),
(27, 'Limonada (S/L)', '6.00', '&lt;p&gt;&lt;strong&gt;Bebida gelada.&lt;/strong&gt;&lt;/p&gt;\r\n&lt;p&gt;250 ml de limonada, 100 ml de &amp;aacute;gua, a&amp;ccedil;&amp;uacute;car e gelo.&lt;/p&gt;\r\n&lt;p&gt;Ac&amp;uacute;car &amp;eacute; opcional.&lt;/p&gt;\r\n&lt;p&gt;Tempo de preparo &amp;eacute; de 10 minutos.&lt;/p&gt;', 'upload/2018/09/19/ded3c27337cb27fc9919f753fe1e6a63.jpg', 1, 1, '', 35, 0, 0, 1, NULL, '[\"2\",\"3\",\"4\",\"5\",\"6\",\"7\"]', NULL, 22, 1),
(28, 'Café Expresso ', '2.00', '&lt;p&gt;&lt;strong&gt;Bebida quente&lt;/strong&gt;&lt;/p&gt;\r\n&lt;p&gt;7 gr de caf&amp;eacute; mo&amp;iacute;do na hora, prensada e 30 ml de &amp;aacute;gua.&lt;/p&gt;\r\n&lt;p&gt;Tempo de preparo &amp;eacute; de 5 minutos.&lt;/p&gt;', 'upload/2018/09/14/38ae1ca6954824486d4894cda9338a98.jpg', 1, 1, '', 36, 0, 0, 1, NULL, '[\"2\",\"3\",\"4\",\"5\",\"6\",\"7\"]', NULL, 22, 1),
(29, 'Café Expresso com Doce de Leite ', '3.00', '&lt;p&gt;&lt;strong&gt;Bebida quente.&lt;/strong&gt;&lt;/p&gt;\r\n&lt;p&gt;7 gr de caf&amp;eacute; mo&amp;iacute;do na hora, prensada e 30 ml de &amp;aacute;gua.&lt;/p&gt;\r\n&lt;p&gt;Uma colher de doce de leite da casa.&lt;/p&gt;\r\n&lt;p&gt;Tempo de preparo &amp;eacute; de 5 minutos.&lt;/p&gt;', 'upload/2018/09/14/eecb89d3cbc3369456e2430dc70c19bd.jpg', 1, 1, '', 37, 0, 0, 1, NULL, '[\"2\",\"3\",\"4\",\"5\",\"6\",\"7\"]', NULL, 22, 1),
(30, 'Café Expresso Duplo ', '4.00', '&lt;p&gt;&lt;strong&gt;Bebida quente.&lt;/strong&gt;&lt;/p&gt;\r\n&lt;p&gt;14 gr de caf&amp;eacute; mo&amp;iacute;do na hora, prensado e 60 ml de &amp;aacute;gua.&lt;/p&gt;\r\n&lt;p&gt;Tempo de preparo &amp;eacute; de 5 minutos.&lt;/p&gt;', 'upload/2018/09/18/b735885d2213d2c4a9d609ec4ac763ea.jpg', 1, 1, '', 38, 0, 0, 1, NULL, '[\"2\",\"3\",\"4\",\"5\",\"6\",\"7\"]', NULL, 22, 1),
(31, 'Café Carioca ', '2.00', '&lt;p&gt;&lt;strong&gt;Bebida quente.&lt;/strong&gt;&lt;/p&gt;\r\n&lt;p&gt;7 gr de caf&amp;eacute; mo&amp;iacute;do na hora, prensado e 40 ml de &amp;aacute;gua.&lt;/p&gt;\r\n&lt;p&gt;Tempo de preparo &amp;eacute; de 5 minutos.&lt;/p&gt;', 'upload/2018/09/18/f999392ebbde583f2e80fa072b5efb3a.jpg', 1, 1, '', 39, 0, 0, 1, NULL, '[\"2\",\"3\",\"4\",\"5\",\"6\",\"7\"]', NULL, 22, 1),
(32, 'Café Carioca Duplo', '4.00', '&lt;p&gt;&lt;strong&gt;Bebida quente.&lt;/strong&gt;&lt;/p&gt;\r\n&lt;p&gt;14 gr de caf&amp;eacute; mo&amp;iacute;do na hora, prensado e 80 ml de &amp;aacute;gua.&lt;/p&gt;\r\n&lt;p&gt;Tempo de preparo &amp;eacute; de 5 minutos.&lt;/p&gt;', 'upload/2018/09/18/b895ee72c27e4a51da8b744135b7b828.jpg', 1, 1, '', 40, 0, 0, 1, NULL, '[\"2\",\"3\",\"4\",\"5\",\"6\",\"7\"]', NULL, 22, 1),
(33, 'Café Expresso Machiatto ', '2.50', '&lt;p&gt;&lt;strong&gt;Bebida quente.&lt;/strong&gt;&lt;/p&gt;\r\n&lt;p&gt;1 shot de expresso e espuma de leite vaporizado.&lt;/p&gt;', 'upload/2018/09/19/ea665bf224d41f3767645f67779bb2f1.png', 1, 1, '', 41, 0, 0, 1, NULL, '[\"2\",\"3\",\"4\",\"5\",\"6\",\"7\"]', NULL, 22, 1),
(34, 'Café com Leite ', '4.50', '&lt;p&gt;&lt;strong&gt;Bebida Quente.&lt;/strong&gt;&lt;/p&gt;\r\n&lt;p&gt;1 shot de expresso e 150 ml de leite vaporizado.&lt;/p&gt;\r\n&lt;p&gt;Tempo de preparo &amp;eacute; de 5 minutos.&lt;/p&gt;', 'upload/2018/09/19/eb34c96a8fa725fa359a08844856ba47.jpg', 1, 1, '', 42, 0, 0, 1, NULL, '[\"2\",\"3\",\"4\",\"5\",\"6\",\"7\"]', NULL, 22, 1),
(35, 'Cappuccino Canela ', '6.50', '&lt;p&gt;&lt;strong&gt;Bebida quente.&lt;/strong&gt;&lt;/p&gt;\r\n&lt;p&gt;Canela em p&amp;oacute;, 1 shot de expresso e partes iguais de leite vaporizado e espuma do leite.&lt;/p&gt;\r\n&lt;p&gt;Pode ser acrescentado chantilly, como na foto.&lt;/p&gt;\r\n&lt;p&gt;Tempo de preparo &amp;eacute; de 5 minutos.&lt;/p&gt;', 'upload/2018/09/19/0c5efb5a56121026944cb4e7a67095cc.png', 1, 1, '', 43, 0, 0, 1, NULL, '[\"2\",\"3\",\"4\",\"5\",\"6\",\"7\"]', NULL, 22, 1),
(36, 'Mocca', '6.50', '&lt;p&gt;&lt;strong&gt;Bebida quente.&lt;/strong&gt;&lt;/p&gt;\r\n&lt;p&gt;Calda de chocolate, 1 shot de expresso, leite vaporizado e espuma de leite.&lt;/p&gt;\r\n&lt;p&gt;Pode ser acrescentado chantilly.&lt;/p&gt;\r\n&lt;p&gt;Tempo de preparo &amp;eacute; de 10 minutos.&lt;/p&gt;', 'upload/2018/09/19/f058f6d990d09fc64667b7d706dac40b.jpg', 1, 1, '', 44, 1, 0, 1, NULL, '[\"2\",\"3\",\"4\",\"5\",\"6\",\"7\"]', NULL, 22, 1),
(37, 'Mocca de Leite de Coco (S/L)', '8.50', '&lt;p&gt;&lt;strong&gt;Bebida quente.&lt;/strong&gt;&lt;/p&gt;\r\n&lt;p&gt;Calda de chocolate, 1 shot de expresso, leite de coco vaporizado.&lt;/p&gt;\r\n&lt;p&gt;Pode ser acrescentado chantilly.&lt;/p&gt;\r\n&lt;p&gt;Tempo de preparo &amp;eacute; de 10 minutos.&lt;/p&gt;', 'upload/2018/09/19/406705f577b2ef5dc47959a51f91d0f9.jpg', 1, 1, '', 45, 0, 0, 1, NULL, '[\"2\",\"3\",\"4\",\"5\",\"6\",\"7\"]', NULL, 22, 1),
(38, 'Café Havaiano', '6.50', '&lt;p&gt;&lt;strong&gt;Bebida quente.&lt;/strong&gt;&lt;/p&gt;\r\n&lt;p&gt;1 shot de expresso, 1 shot de leite de coco, leite vaporizado e coco ralado.&lt;/p&gt;\r\n&lt;p&gt;Pode ser acrescentado chantilly como na foto.&lt;/p&gt;\r\n&lt;p&gt;Tempo de preparo &amp;eacute; de 5 minutos.&lt;/p&gt;', 'upload/2018/09/19/4804336674f431d9075664d4fca8e85b.jpg', 1, 1, '', 46, 0, 0, 1, NULL, '[\"2\",\"3\",\"4\",\"5\",\"6\",\"7\"]', NULL, 22, 1),
(39, 'Chai Latte ', '5.00', '&lt;p&gt;&lt;strong&gt;Bebida quente.&lt;/strong&gt;&lt;/p&gt;\r\n&lt;p&gt;Mix de canela, chocolate e especiarias em p&amp;oacute; e 150 ml de leite vaporizado.&lt;/p&gt;\r\n&lt;p&gt;Tempo de preparo &amp;eacute; de 5 minutos.&lt;/p&gt;', 'upload/2018/09/20/e85d4bf215df9608a9d4f50d9a8ad6d4.jpg', 1, 1, '', 47, 0, 0, 1, NULL, '[\"2\",\"3\",\"4\",\"5\",\"6\",\"7\"]', NULL, 22, 1),
(40, 'Café Nutella Latte', '6.50', '&lt;p&gt;&lt;strong&gt;Bebida quente.&lt;/strong&gt;&lt;/p&gt;\r\n&lt;p&gt;Nutella, 1 shot de expresso, leite vaporizado e espuma de leite.&lt;/p&gt;\r\n&lt;p&gt;Pode ser acrescentado chantilly.&lt;/p&gt;\r\n&lt;p&gt;Tempo de preparo &amp;eacute; de 10 minutos.&lt;/p&gt;', 'upload/2018/09/20/0aac0d123c565a435d5988128da4c671.jpg', 1, 1, '', 48, 0, 0, 1, NULL, '[\"2\",\"3\",\"4\",\"5\",\"6\",\"7\"]', NULL, 22, 1),
(41, 'Café Doce de Leite', '7.50', '&lt;p&gt;&lt;strong&gt;Bebida quente.&lt;/strong&gt;&lt;/p&gt;\r\n&lt;p&gt;Doce de leite da casa, 1 shot de expresso, leite vaporizado e espuma de leite.&lt;/p&gt;\r\n&lt;p&gt;Pode ser acrescentado chantilly como na foto.&lt;/p&gt;\r\n&lt;p&gt;Tempo de preparo &amp;eacute; de 10 minutos.&lt;/p&gt;', 'upload/2018/09/19/bb6708c4d128b5a47a4561d331a4b0d5.jpg', 1, 1, '', 49, 0, 0, 1, NULL, '[\"2\",\"3\",\"4\",\"5\",\"6\",\"7\"]', NULL, 22, 1),
(42, 'Prensa Francesa ( 350 ml)', '15.90', '&lt;p&gt;&lt;strong&gt;Bebida quente.&lt;/strong&gt;&lt;/p&gt;\r\n&lt;p&gt;20 gr de caf&amp;eacute; mo&amp;iacute;do na hora e 350 ml de &amp;aacute;gua quente.&lt;/p&gt;\r\n&lt;p&gt;Tempo de preparo &amp;eacute; de 5 minutos.&lt;/p&gt;', 'upload/2018/09/20/31a832becdc0e6f4b4cbb8477395b0a5.png', 1, 1, '', 50, 0, 0, 1, NULL, '[\"2\",\"3\",\"4\",\"5\",\"6\",\"7\"]', NULL, 22, 1),
(43, 'Chá de Erva Doce', '3.50', '&lt;p&gt;&lt;strong&gt;Ch&amp;aacute; quente.&lt;/strong&gt;&lt;/p&gt;\r\n&lt;p&gt;Tempo de preparo &amp;eacute; de 5 minutos.&lt;/p&gt;', 'upload/2018/09/20/6e47cdec515631960897f62665f91599.jpg', 1, 1, '', 51, 0, 0, 1, NULL, '[\"2\",\"3\",\"4\",\"5\",\"6\",\"7\"]', NULL, 22, 1),
(44, 'Lady Grey', '3.50', '&lt;p&gt;&lt;strong&gt;Ch&amp;aacute; quente.&lt;/strong&gt;&lt;/p&gt;\r\n&lt;p&gt;Tempo de preparo &amp;eacute; de 5 minutos.&lt;/p&gt;', 'upload/2018/09/20/bc00bc302d56cf34b41a18eaa8662967.jpg', 1, 1, '', 52, 0, 0, 1, NULL, '[\"2\",\"3\",\"4\",\"5\",\"6\",\"7\"]', NULL, 22, 1),
(45, 'Chá de Hortelã', '3.50', '&lt;p&gt;&lt;strong&gt;Ch&amp;aacute; quente.&lt;/strong&gt;&lt;/p&gt;\r\n&lt;p&gt;Tempo de preparo &amp;eacute; de 5 minutos.&lt;/p&gt;', 'upload/2018/09/20/ffcfa22392f829ba1cd1f8928d5f1120.jpg', 1, 1, '', 53, 0, 0, 1, NULL, '[\"2\",\"3\",\"4\",\"5\",\"6\",\"7\"]', NULL, 22, 1),
(46, 'Chá Preto com Frutas Vermelhas', '3.50', '&lt;p&gt;&lt;strong&gt;Ch&amp;aacute; quente.&lt;/strong&gt;&lt;/p&gt;\r\n&lt;p&gt;Tempo de preparo &amp;eacute; de 5 minutos.&lt;/p&gt;', 'upload/2018/09/20/2d76618ee06b0031edbcf9ad67e53227.jpg', 1, 1, '', 54, 0, 0, 1, NULL, '[\"2\",\"3\",\"4\",\"5\",\"6\",\"7\"]', NULL, 22, 1),
(47, 'Earl Grey', '3.50', '&lt;p&gt;&lt;strong&gt;Ch&amp;aacute; quente.&lt;/strong&gt;&lt;/p&gt;\r\n&lt;p&gt;Tempo de preparo &amp;eacute; de 5 minutos.&lt;/p&gt;', 'upload/2018/09/20/af2d804940c25f0bc594096a61c07eb2.jpg', 1, 1, '', 55, 0, 0, 1, NULL, '[\"2\",\"3\",\"4\",\"5\",\"6\",\"7\"]', NULL, 22, 1),
(48, 'Price of Wales', '3.50', '&lt;p&gt;&lt;strong&gt;Ch&amp;aacute; quente.&lt;/strong&gt;&lt;/p&gt;\r\n&lt;p&gt;Tempo de preparo &amp;eacute; de 5 minutos.&lt;/p&gt;', 'upload/2018/09/20/094b5149c5c2b0fe739578aba0e010b0.jpg', 1, 1, '', 56, 0, 0, 1, NULL, '[\"2\",\"3\",\"4\",\"5\",\"6\",\"7\"]', NULL, 22, 1),
(49, 'English Breakfest', '3.50', '&lt;p&gt;&lt;strong&gt;Ch&amp;aacute; quente.&lt;/strong&gt;&lt;/p&gt;\r\n&lt;p&gt;Tempo de preparo &amp;eacute; de 5 minutos.&lt;/p&gt;', 'upload/2018/09/20/862b9041858705c308b24c57dff46113.jpg', 1, 1, '', 57, 0, 0, 1, NULL, '[\"2\",\"3\",\"4\",\"5\",\"6\",\"7\"]', NULL, 22, 1),
(50, 'Camomila com Hortelã', '3.50', '&lt;p&gt;&lt;strong&gt;Ch&amp;aacute; quente.&lt;/strong&gt;&lt;/p&gt;\r\n&lt;p&gt;Tempo de preparo &amp;eacute; de 5 minutos.&lt;/p&gt;', 'upload/2018/09/20/247bde085a4b468df099b233144cb52c.jpg', 1, 1, '', 58, 0, 0, 1, NULL, '[\"2\",\"3\",\"4\",\"5\",\"6\",\"7\"]', NULL, 22, 1),
(52, 'Camomila com Mel e Baunilha', '3.50', '&lt;p&gt;&lt;strong&gt;Ch&amp;aacute; quente.&lt;/strong&gt;&lt;/p&gt;\r\n&lt;p&gt;Tempo de preparo &amp;eacute; de 5 minutos.&lt;/p&gt;', 'upload/2018/09/20/a9d28482d01966f75c23f3e4ca973310.jpg', 1, 1, '', 59, 0, 0, 1, NULL, '[\"2\",\"3\",\"4\",\"5\",\"6\",\"7\"]', NULL, 22, 1),
(53, 'Capim Limão', '3.50', '&lt;p&gt;&lt;strong&gt;Ch&amp;aacute; quente.&lt;/strong&gt;&lt;/p&gt;\r\n&lt;p&gt;Tempo de preparo &amp;eacute; de 5 minutos.&lt;/p&gt;', 'upload/2018/09/20/ae2ca17a55578f9765ebdfe573f7634c.jpg', 1, 1, '', 60, 0, 0, 1, NULL, '[\"2\",\"3\",\"4\",\"5\",\"6\",\"7\"]', NULL, 22, 1),
(54, 'Chá Verde com Gengibre', '5.50', '&lt;p&gt;&lt;strong&gt;Bebida Gelada.&lt;/strong&gt;&lt;/p&gt;\r\n&lt;p&gt;200 ml de ch&amp;aacute; preparado na delion. Mix de gengibre, ch&amp;aacute; verde, hortel&amp;atilde;, mel e lim&amp;atilde;o.&amp;nbsp;&lt;/p&gt;\r\n&lt;p&gt;Batido no liquidifcador com gelo.&lt;/p&gt;\r\n&lt;p&gt;Tempo de preparo &amp;eacute; de 10 minutos.&lt;/p&gt;', 'upload/2018/09/19/0e52aae169bfdc1fb2d6a75ab66d2f0c.jpg', 1, 1, '', 61, 0, 0, 1, NULL, '[\"2\",\"3\",\"4\",\"5\",\"6\",\"7\"]', NULL, 22, 1),
(55, 'Chá Matte', '4.00', '&lt;p&gt;&lt;strong&gt;Ch&amp;aacute; quente ou gelado.&lt;/strong&gt;&lt;/p&gt;\r\n&lt;p&gt;Mix de ervas, escolhidos pela Delion, em infus&amp;atilde;o em &amp;aacute;gua quente.&lt;/p&gt;\r\n&lt;p&gt;Pode ser consumido gelado ou quente.&lt;/p&gt;\r\n&lt;p&gt;Tempo de preparo &amp;eacute; de 5 minutos.&lt;/p&gt;', 'upload/2018/09/20/34a1e2e62990f99cc198157c80fba38d.png', 1, 1, '', 62, 0, 0, 1, NULL, '[\"2\",\"3\",\"4\",\"5\",\"6\",\"7\"]', NULL, 22, 1),
(57, 'Mix Tea de Limão ', '5.00', '&lt;p&gt;&lt;strong&gt;Bebida Gelada.&lt;/strong&gt;&lt;/p&gt;\r\n&lt;p&gt;300 ml de &amp;aacute;gua, mix em p&amp;oacute; sabor lim&amp;atilde;o, gelo.&lt;/p&gt;\r\n&lt;p&gt;Batido em liquidificador.&lt;/p&gt;\r\n&lt;p&gt;J&amp;aacute; vem ado&amp;ccedil;ado.&lt;/p&gt;\r\n&lt;p&gt;Tempo de preparo &amp;eacute; de 10 minutos.&lt;/p&gt;', 'upload/2018/09/19/f620eddda4246999ee9d905620be632c.png', 1, 1, '', 63, 0, 0, 1, NULL, '[\"2\",\"3\",\"4\",\"5\",\"6\",\"7\"]', NULL, 22, 1),
(58, 'Mix Tea de Pêssego ', '5.00', '&lt;p&gt;&lt;strong&gt;Bebida Gelada.&lt;/strong&gt;&lt;/p&gt;\r\n&lt;p&gt;300 ml de &amp;aacute;gua, mix em p&amp;oacute; sabor p&amp;ecirc;ssego, gelo.&lt;/p&gt;\r\n&lt;p&gt;Batido em liquidificador.&lt;/p&gt;\r\n&lt;p&gt;J&amp;aacute; vem ado&amp;ccedil;ado.&lt;/p&gt;\r\n&lt;p&gt;Tempo de preparo &amp;eacute; de 10 minutos.&lt;/p&gt;', 'upload/2018/09/19/0eec56a3a6928c551858bcac2c04ff01.png', 1, 1, '', 64, 0, 0, 1, NULL, '[\"2\",\"3\",\"4\",\"5\",\"6\",\"7\"]', NULL, 22, 1),
(59, 'Chá Mate de Maracujá ', '6.00', '&lt;p&gt;&lt;strong&gt;Ch&amp;aacute; gelado.&lt;/strong&gt;&lt;/p&gt;\r\n&lt;p&gt;Ch&amp;aacute; mate, aromatizante de maracuj&amp;aacute;, leite condensado e gelo.&lt;/p&gt;\r\n&lt;p&gt;Batido no liquidificador.&lt;/p&gt;\r\n&lt;p&gt;Leite condensado &amp;eacute; opcional.&lt;/p&gt;\r\n&lt;p&gt;Tempo de preparo &amp;eacute; de 10 minutos.&lt;/p&gt;\r\n&lt;p&gt;&amp;nbsp;&lt;/p&gt;', 'upload/2018/09/20/a4fe6b3d691cebccea545e488b925a4e.png', 1, 1, '', 65, 0, 0, 1, NULL, '[\"2\",\"3\",\"4\",\"5\",\"6\",\"7\"]', NULL, 22, 1),
(60, 'Chá Mate de Abacaxi ', '6.00', '&lt;p&gt;&lt;strong&gt;Ch&amp;aacute; gelado.&lt;/strong&gt;&lt;/p&gt;\r\n&lt;p&gt;Ch&amp;aacute; mate, aromatizante de abacaxi, leite condensado e gelo.&lt;/p&gt;\r\n&lt;p&gt;Batido no liquidificador.&lt;/p&gt;\r\n&lt;p&gt;Leite condensado &amp;eacute; opcional.&lt;/p&gt;\r\n&lt;p&gt;Tempo de preparo &amp;eacute; de 10 minutos.&lt;/p&gt;', 'upload/2018/09/20/ec4e35b4bab8df0d6b7141f1d8e515fd.png', 1, 1, '', 66, 0, 0, 1, NULL, '[\"2\",\"3\",\"4\",\"5\",\"6\",\"7\"]', NULL, 22, 1),
(61, 'Chá de Hibisco com Canela', '5.50', '&lt;p&gt;&lt;strong&gt;Ch&amp;aacute; gelado ou quente.&lt;/strong&gt;&lt;/p&gt;\r\n&lt;p&gt;Ch&amp;aacute; de hibisco e canela preparado na casa. Batido com gelo.&lt;/p&gt;\r\n&lt;p&gt;Pode ser tomado quente tamb&amp;eacute;m.&amp;nbsp;&lt;/p&gt;\r\n&lt;p&gt;Tempo de preparo &amp;eacute; de 10 minutos.&lt;/p&gt;', 'upload/2018/09/18/e50da09128641608d4c69761ef9993e4.png', 1, 1, '', 67, 0, 0, 1, NULL, '[\"2\",\"3\",\"4\",\"5\",\"6\",\"7\"]', NULL, 22, 1),
(62, 'Milkshake de Doce de Leite', '14.50', '&lt;p&gt;&lt;strong&gt;Bebida gelada.&lt;/strong&gt;&lt;/p&gt;\r\n&lt;p&gt;300 ml de leite, sorvete, doce de leite da casa, calda de caramelo e chantilly.&lt;/p&gt;\r\n&lt;p&gt;Tempo de preparo &amp;eacute; de 10 minutos.&lt;/p&gt;', 'upload/2018/09/19/0fb62202a509da5aad4fee89617495ea.jpg', 1, 1, '', 68, 0, 0, 1, NULL, '[\"2\",\"3\",\"4\",\"5\",\"6\",\"7\"]', NULL, 22, 1),
(63, 'Milkshake de Nutella', '14.50', '&lt;p&gt;&lt;strong&gt;Bebida Gelada.&lt;/strong&gt;&lt;/p&gt;\r\n&lt;p&gt;300 ml de leite, sorvete, nutella, calda de chocolate e chantilly.&lt;/p&gt;\r\n&lt;p&gt;Tempo de preparo &amp;eacute; de 10 minutos.&lt;/p&gt;', 'upload/2018/09/20/387d9ee0c6f8b20f66a70614dac1d435.jpg', 1, 1, '', 69, 0, 0, 1, NULL, '[\"2\",\"3\",\"4\",\"5\",\"6\",\"7\"]', NULL, 22, 1),
(64, 'Chocolate Quente Tradicional', '8.50', '&lt;p&gt;&lt;strong&gt;Bebida quente.&lt;/strong&gt;&lt;/p&gt;\r\n&lt;p&gt;200ml de leite, chocolate especial em p&amp;oacute;, a&amp;ccedil;&amp;uacute;car, baunilha, creme de leite, marshmallow e chantilly.&lt;/p&gt;\r\n&lt;p&gt;A&amp;ccedil;&amp;uacute;car, marshmallow e chantilly s&amp;atilde;o opcionais.&lt;/p&gt;\r\n&lt;p&gt;Tempo de preparo &amp;eacute; de 10 minutos.&lt;/p&gt;', 'upload/2018/09/19/9ad563ceddb1a347e0bee718cf3a2730.jpg', 1, 1, '', 70, 0, 0, 1, NULL, '[\"2\",\"3\",\"4\",\"5\",\"6\",\"7\"]', NULL, 22, 1),
(65, 'Torta Holandesa Tradicional', '50.00', '&lt;p&gt;Base de bolacha, creme a base de manteiga, a&amp;ccedil;&amp;uacute;car e baunilha, ganache de chocolate ao leite.&lt;/p&gt;\r\n&lt;p&gt;Vendida por quilo.&lt;/p&gt;', 'upload/2018/09/20/f7deb5a6c0f37daafc609f531ec77a7f.jpg', 1, 1, '', 136, 0, 0, 1, NULL, '[\"2\",\"3\",\"4\",\"5\",\"6\",\"7\"]', NULL, 28, 1),
(75, 'Torta Trufada de Leite Ninho', '65.00', '&lt;p&gt;Base de bolacha, creme de leite ninho e chocolate amargo ao rum.&lt;/p&gt;', 'upload/2018/09/20/003da7db8e52b347267409c8615c3125.jpg', 1, 1, '', 137, 1, 0, 1, NULL, '[\"2\",\"3\",\"4\",\"5\",\"6\",\"7\"]', NULL, 28, 1),
(82, 'Empanada de Queijo e Tomate', '4.25', '&lt;p&gt;&lt;strong&gt;SALGADO ASSADO&lt;/strong&gt;&lt;br /&gt;Todos os produtos s&amp;atilde;o preparados na hora.&lt;br /&gt;Caso o sabor desejado n&amp;atilde;o esteja dispon&amp;iacute;vel no expositor, solicite a&amp;nbsp;sua atendente que o mesmo ser&amp;aacute; preparado.&lt;br /&gt;O tempo de espera &amp;eacute; de 5 minutos, dependendo do movimento e do tipo de salgado solicitado.&lt;/p&gt;', 'upload/2018/09/18/b976e0138c2a15f42c42f5f2fd48f935.jpg', 1, 1, '', 11, 0, 0, 1, NULL, '[\"2\",\"3\",\"4\",\"5\",\"6\",\"7\"]', NULL, 26, 1),
(83, 'Empanada de Queijo com Alho Poró', '4.25', '&lt;p&gt;&lt;strong&gt;SALGADO ASSADO&lt;/strong&gt;&lt;br /&gt;Todos os produtos s&amp;atilde;o preparados na hora.&lt;br /&gt;Caso o sabor desejado n&amp;atilde;o esteja dispon&amp;iacute;vel no expositor, solicite a&amp;nbsp;sua atendente que o mesmo ser&amp;aacute; preparado.&lt;br /&gt;O tempo de espera &amp;eacute; de 5 minutos, dependendo do movimento e do tipo de salgado solicitado.&lt;/p&gt;', 'upload/2018/09/18/b57b6fdc5d6b0c8045661aab6d2e834f.jpg', 1, 1, '', 12, 0, 0, 1, NULL, '[\"2\",\"3\",\"4\",\"5\",\"6\",\"7\"]', NULL, 26, 1),
(84, 'Empanada de Palmito', '4.25', '&lt;p&gt;&lt;strong&gt;SALGADO ASSADO&lt;/strong&gt;&lt;br /&gt;Todos os produtos s&amp;atilde;o preparados na hora.&lt;br /&gt;Caso o sabor desejado n&amp;atilde;o esteja dispon&amp;iacute;vel no expositor, solicite a&amp;nbsp;sua atendente que o mesmo ser&amp;aacute; preparado.&lt;br /&gt;O tempo de espera &amp;eacute; de 5 minutos, dependendo do movimento e do tipo de salgado solicitado.&lt;/p&gt;', 'upload/2018/09/18/7ab873b6049becbad33bb4cf7310fa37.jpg', 1, 1, '', 13, 0, 0, 1, NULL, '[\"2\",\"3\",\"4\",\"5\",\"6\",\"7\"]', NULL, 26, 1),
(85, 'Empanada de 3 Queijos', '4.50', '&lt;p&gt;&lt;strong&gt;SALGADO ASSADO&lt;/strong&gt;&lt;br /&gt;Todos os produtos s&amp;atilde;o preparados na hora.&lt;br /&gt;Caso o sabor desejado n&amp;atilde;o esteja dispon&amp;iacute;vel no expositor, solicite a&amp;nbsp;sua atendente que o mesmo ser&amp;aacute; preparado.&lt;br /&gt;O tempo de espera &amp;eacute; de 5 minutos, dependendo do movimento e do tipo de salgado solicitado.&lt;/p&gt;', 'upload/2018/09/18/657fdf32a4131b8eeba58e7012658590.jpg', 1, 1, '', 14, 0, 0, 1, NULL, '[\"2\",\"3\",\"4\",\"5\",\"6\",\"7\"]', NULL, 26, 1),
(86, 'Quiche de 3 Queijos', '9.90', '&lt;p&gt;&lt;strong&gt;SALGADO ASSADO&lt;/strong&gt;&lt;br /&gt;Todos os produtos s&amp;atilde;o preparados na hora.&lt;br /&gt;Caso o sabor desejado n&amp;atilde;o esteja dispon&amp;iacute;vel no expositor, solicite a&amp;nbsp;sua atendente que o mesmo ser&amp;aacute; preparado.&lt;br /&gt;O tempo de espera &amp;eacute; de 10 a 30 minutos, dependendo do movimento e do tipo de salgado solicitado.&lt;/p&gt;', 'upload/2018/03/07/5bc6f3e54b6a4373c66f9756508cbc4e.jpg', 1, 1, '', 15, 0, 0, 1, NULL, '[\"2\",\"3\",\"4\",\"5\",\"6\",\"7\"]', NULL, 26, 1),
(87, 'Quiche de Frango', '9.90', '&lt;p&gt;&lt;strong&gt;SALGADO ASSADO&lt;/strong&gt;&lt;br /&gt;Todos os produtos s&amp;atilde;o preparados na hora.&lt;br /&gt;Caso o sabor desejado n&amp;atilde;o esteja dispon&amp;iacute;vel no expositor, solicite a&amp;nbsp;sua atendente que o mesmo ser&amp;aacute; preparado.&lt;br /&gt;O tempo de espera &amp;eacute; de 10 a 30 minutos, dependendo do movimento&amp;nbsp;e do tipo de salgado solicitado.&lt;/p&gt;', 'upload/2018/03/07/55891cf4a36d064fbd1ff786da5b73a6.jpg', 1, 1, '', 16, 0, 0, 1, NULL, '[\"2\",\"3\",\"4\",\"5\",\"6\",\"7\"]', NULL, 26, 1),
(88, 'Quiche de Alho Poró', '9.90', '&lt;p&gt;&lt;strong&gt;SALGADO ASSADO&lt;/strong&gt;&lt;br /&gt;Todos os produtos s&amp;atilde;o preparados na hora.&lt;br /&gt;Caso o sabor desejado n&amp;atilde;o esteja dispon&amp;iacute;vel no expositor, solicite a&amp;nbsp;sua atendente que o mesmo ser&amp;aacute; preparado.&lt;br /&gt;O tempo de espera &amp;eacute; de 10 a 30 minutos, dependendo do movimento e do tipo de salgado solicitado.&lt;/p&gt;', 'upload/2018/09/20/e418ac5a7c2a7cc7fb1833a799023373.jpg', 1, 1, '', 17, 0, 0, 1, NULL, '[\"2\",\"3\",\"4\",\"5\",\"6\",\"7\"]', NULL, 26, 1),
(91, 'Pão de Queijo (Por kg)', '17.50', '&lt;p&gt;&lt;strong&gt;O p&amp;atilde;o de queijo &amp;eacute; vendido por quilo.&lt;/strong&gt;&lt;/p&gt;\r\n&lt;p&gt;Caso n&amp;atilde;o esteja dispon&amp;iacute;vel no expositor, solicite a&amp;nbsp;sua atendente que o mesmo ser&amp;aacute; preparado.&lt;br /&gt;O tempo de espera &amp;eacute; de 20 minutos, para assar.&lt;/p&gt;', 'upload/2018/09/14/017f219788eade7b2c5803ed6d715368.jpg', 1, 1, '', 18, 0, 0, 1, NULL, '[\"2\",\"3\",\"4\",\"5\",\"6\",\"7\"]', NULL, 26, 1),
(92, 'Risole de Carne com Ovos', '4.50', '&lt;p&gt;&lt;strong&gt;SALGADO FRITO&lt;/strong&gt;&lt;/p&gt;\r\n&lt;p&gt;Risoles de carne com ovos.&lt;/p&gt;\r\n&lt;p&gt;Caso&amp;nbsp; n&amp;atilde;o esteja dispon&amp;iacute;vel no expositor, solicite a&amp;nbsp;sua atendente que o mesmo ser&amp;aacute; preparado.&lt;/p&gt;\r\n&lt;p&gt;O tempo de espera &amp;eacute; de 15 minutos.&lt;/p&gt;\r\n&lt;p&gt;se a fritadeira j&amp;aacute; estiver ligada o tempo de fritar &amp;eacute; de 5 minutos.&lt;/p&gt;', 'upload/2018/09/14/9efd1e615286fd38e803fb78231b1708.jpg', 1, 1, '', 19, 0, 1, 1, NULL, '[\"2\",\"3\",\"4\",\"5\",\"6\",\"7\"]', NULL, 26, 1),
(93, 'Coxinha de Frango ', '4.50', '&lt;p&gt;&lt;strong&gt;SALGADO FRITO&lt;/strong&gt;&lt;/p&gt;\r\n&lt;p&gt;Coxinha de Frango com catup&amp;iacute;ry.&lt;/p&gt;\r\n&lt;p&gt;Caso&amp;nbsp; n&amp;atilde;o esteja dispon&amp;iacute;vel no expositor, solicite a&amp;nbsp;sua atendente que o mesmo ser&amp;aacute; preparado.&lt;/p&gt;\r\n&lt;p&gt;O tempo de espera &amp;eacute; de 15 minutos.&lt;/p&gt;\r\n&lt;p&gt;se a fritadeira j&amp;aacute; estiver ligada o tempo de fritar &amp;eacute; de 5 minutos.&lt;/p&gt;', 'upload/2018/09/18/cd83b5bd8f7b504cc773a526e6f50b28.jpg', 1, 1, '', 20, 0, 1, 1, NULL, '[\"2\",\"3\",\"4\",\"5\",\"6\",\"7\"]', NULL, 26, 1),
(95, 'Empanada Frita de Carne com Ovos e Azeitona', '4.50', '&lt;p&gt;&lt;strong&gt;Salgado Assado.&lt;/strong&gt;&lt;/p&gt;\r\n&lt;p&gt;Todos os produtos s&amp;atilde;o preparados na hora.&lt;br /&gt;Caso o sabor desejado n&amp;atilde;o esteja dispon&amp;iacute;vel no expositor, solicite a&amp;nbsp;sua atendente que o mesmo ser&amp;aacute; preparado.&lt;br /&gt;O tempo de espera &amp;eacute; de 5 minutos, dependendo do movimento.&lt;/p&gt;', 'upload/2018/09/18/35943db64be55a93ff2d492149279f4b.jpg', 1, 1, '', 21, 0, 0, 1, NULL, '[\"2\",\"3\",\"4\",\"5\",\"6\",\"7\"]', NULL, 26, 1),
(96, 'Café Americano', '11.50', '&lt;p&gt;Duas torradas com manteiga, ovos mexidos e 100 gramas de bacon.&lt;/p&gt;\r\n&lt;p&gt;10 a 20 minutos &amp;eacute; o tempo de preparo.&lt;/p&gt;', 'upload/2018/09/18/a31ae908d944190a88e909b153f34995.jpg', 1, 0, '', 98, 0, 0, 1, NULL, '[\"2\",\"3\",\"4\",\"5\",\"6\",\"7\"]', NULL, 38, 1),
(97, 'Café Americano Light', '11.50', '&lt;p&gt;Duas torradas com manteiga, ovos mexidos e caf&amp;eacute; com leite.&lt;/p&gt;\r\n&lt;p&gt;10 a 20 minutos &amp;eacute; o tempo de preparo.&lt;/p&gt;', 'upload/2018/09/19/1c914cad5f7a051b9af6ef200762a2da.jpg', 1, 0, '', 99, 0, 0, 1, NULL, '[\"2\",\"3\",\"4\",\"5\",\"6\",\"7\"]', NULL, 38, 1),
(98, 'Pão na Chapa', '2.00', '&lt;p&gt;P&amp;atilde;o franc&amp;ecirc;s com manteiga na chapa.&lt;/p&gt;\r\n&lt;p&gt;tempo de preparo &amp;eacute; de 5 a 10 minutos&lt;/p&gt;', 'upload/2018/09/20/13ef44b0fbd39b6a5a79b3976e9ca0c1.jpg', 1, 1, '', 101, 0, 1, 1, NULL, '[\"2\",\"3\",\"4\",\"5\",\"6\",\"7\"]', NULL, 27, 1),
(99, 'Misto Quente', '5.50', '&lt;p&gt;P&amp;atilde;o franc&amp;ecirc;s, manteiga, 2 fatias de queijo prato e 2 fatias de presunto.&lt;/p&gt;\r\n&lt;p&gt;Tempo de preparo &amp;eacute; de 5 a 10 minutos.&lt;/p&gt;', 'upload/2018/09/19/81f3e9354f3cf278ea6e58420e787f38.jpg', 1, 1, '', 102, 0, 1, 1, NULL, '[\"2\",\"3\",\"4\",\"5\",\"6\",\"7\"]', NULL, 27, 1),
(100, 'Queijo Quente', '6.00', '&lt;p&gt;P&amp;atilde;o franc&amp;ecirc;s, queijo prato, queijo gouda, queijo parmes&amp;atilde;o e queijo provolone.&lt;/p&gt;\r\n&lt;p&gt;Tempo de preparo &amp;eacute; de 5 a 10 minutos.&lt;/p&gt;', 'upload/2018/09/14/ae82d34c9702b0184e4d76455b7808f6.jpg', 1, 1, '', 103, 0, 1, 1, NULL, '[\"2\",\"3\",\"4\",\"5\",\"6\",\"7\"]', NULL, 27, 1),
(101, 'Bauru', '6.00', '&lt;p&gt;P&amp;atilde;o franc&amp;ecirc;s, manteiga, 2 fatias de queijo prato, 2 fatias de presunto e tomate.&lt;/p&gt;\r\n&lt;p&gt;Tempo de preparo &amp;eacute; de 5 a 10 minutos.&lt;/p&gt;', 'upload/2018/03/09/a4e3108bfda162b2389a9ead592b1134.jpg', 1, 1, '', 104, 0, 1, 1, NULL, '[\"2\",\"3\",\"4\",\"5\",\"6\",\"7\"]', NULL, 27, 1),
(102, 'Pão com Ovo', '8.00', '&lt;p&gt;P&amp;atilde;o franc&amp;ecirc;s tostado, com ovos e ervas.&lt;/p&gt;\r\n&lt;p&gt;Tempo de preparo &amp;eacute; de 5 a 10 minutos.&lt;/p&gt;', 'upload/2018/09/20/d5853a0e8af4606260699656bf93088f.png', 1, 1, '', 105, 0, 0, 1, NULL, '[\"2\",\"3\",\"4\",\"5\",\"6\",\"7\"]', NULL, 27, 1),
(103, 'Pão com Omelete', '9.00', '&lt;p&gt;P&amp;atilde;o franc&amp;ecirc;s tostado com omelete.&lt;/p&gt;\r\n&lt;p&gt;Tempo de preparo &amp;eacute; de 5 a 10 minutos.&lt;/p&gt;', 'upload/2018/09/20/8fce6de6ef42d2ac3761b5b79c20d78b.png', 1, 1, '', 106, 0, 0, 1, NULL, '[\"2\",\"3\",\"4\",\"5\",\"6\",\"7\"]', NULL, 27, 1),
(107, 'Mortadela Tradicional', '12.90', '&lt;p&gt;P&amp;atilde;o franc&amp;ecirc;s, bacon fatiado, 75 gramas de mortadela Ceratti, maionese, queijo e molho especial.&lt;/p&gt;\r\n&lt;p&gt;Tempo de preparo &amp;eacute; de 10 a 15 minutos.&lt;/p&gt;', 'upload/2018/09/14/0c1b475f2fcad9a533aaf2e3ebf59fd7.jpg', 1, 1, '', 107, 0, 1, 1, NULL, '[\"2\",\"3\",\"4\",\"5\",\"6\",\"7\"]', NULL, 27, 1),
(108, 'Linguiça Defumada', '14.90', '&lt;p&gt;P&amp;atilde;o franc&amp;ecirc;s, maionese de salsa, bacon fatiado e lingui&amp;ccedil;a defumada.&lt;/p&gt;\r\n&lt;p&gt;Tempo de preparo &amp;eacute; de 10 a 15minutos.&lt;/p&gt;', 'upload/2018/09/14/6c8b1a6fbf322c9e8507e947a0568744.jpg', 1, 1, '', 108, 0, 1, 1, NULL, '[\"2\",\"3\",\"4\",\"5\",\"6\",\"7\"]', NULL, 27, 1),
(109, 'Sanduíche Mignon', '16.90', '&lt;p&gt;&amp;nbsp;Pao tostado, 100 gr de mignon e molho especial de parmesao&lt;/p&gt;\r\n&lt;p&gt;Tempo de preparo &amp;eacute; de 5 a 10 minutos.&lt;/p&gt;', 'upload/2018/09/20/4a35f74ed635ad96497cc69c1f13c021.jpg', 1, 1, '', 109, 1, 1, 1, NULL, '[\"2\",\"3\",\"4\",\"5\",\"6\",\"7\"]', NULL, 27, 1),
(111, 'Vegetariano', '7.00', '&lt;p&gt;P&amp;atilde;o de forma, tomate, alface, cebola, alho-por&amp;oacute;, queijo branco e or&amp;eacute;gano.&lt;/p&gt;\r\n&lt;p&gt;Tempo de preparo &amp;eacute; de 5 a 10 minutos.&lt;/p&gt;', 'upload/2018/09/20/a7966903545e3ae09a60bd899dc8aca6.png', 1, 1, '', 110, 0, 1, 1, NULL, '[\"2\",\"3\",\"4\",\"5\",\"6\",\"7\"]', NULL, 27, 1),
(117, 'Cheesecake de Amendoim', '4.00', '&lt;p&gt;Base de negresco, creme de amendoim e ganache de chocolate ao leite.&lt;/p&gt;', 'upload/2018/09/20/9ceaac561793d249f0d2c511d2b371f2.jpg', 1, 1, '', 121, 0, 0, 1, NULL, '[\"2\",\"3\",\"4\",\"5\",\"6\",\"7\"]', NULL, 25, 1),
(119, 'Palha Italiana de Chocolate (Por kg)', '40.00', '&lt;p&gt;Massa de brigadeiro, com chococolate especial e bolacha de leite e mel.&lt;/p&gt;\r\n&lt;p&gt;Vendida por quilo.&lt;/p&gt;', 'upload/2018/09/19/6c7236cd11e5613a894190c0f083c439.jpg', 1, 1, '', 123, 0, 1, 1, NULL, '[\"2\",\"3\",\"4\",\"5\",\"6\",\"7\"]', NULL, 25, 1),
(120, 'Palha Italiana de Leite Ninho ', '45.00', '&lt;p&gt;Massa de brigadeiro de leite ninho com bolacha de leite e mel.&lt;/p&gt;\r\n&lt;p&gt;Vendida por quilo.&lt;/p&gt;', 'upload/2018/09/19/12b1cd8d3d288885fb37127b95dadfa7.jpg', 1, 1, '', 124, 0, 1, 1, NULL, '[\"2\",\"3\",\"4\",\"5\",\"6\",\"7\"]', NULL, 25, 1),
(122, 'Cookies (Por kg)', '45.00', '&lt;p&gt;Massa a base de a&amp;ccedil;ucar mascavo, manteiga, ovos e farinha, com gotas de chocolate ao leite.&lt;/p&gt;\r\n&lt;p&gt;Vendido por quilo.&lt;/p&gt;', 'upload/2018/09/18/a62080801f146046010746ff8ca14910.jpg', 1, 1, '', 126, 0, 0, 1, NULL, '[\"2\",\"3\",\"4\",\"5\",\"6\",\"7\"]', NULL, 25, 1),
(123, 'Bolo Molhado de Chocolate Preto', '7.50', '', 'upload/2018/09/14/d065c8c96125e579f93df2bdfe381015.jpg', 1, 1, '', 117, 0, 0, 1, NULL, '[\"2\",\"3\",\"4\",\"5\",\"6\",\"7\"]', NULL, 25, 1),
(124, 'Bolo Molhado de Chocolate Branco', '8.50', '', 'upload/2018/02/16/71b249fd15f261a8918a45ab8004ef77.png', 1, 1, '', 118, 0, 0, 1, NULL, '[\"2\",\"3\",\"4\",\"5\",\"6\",\"7\"]', NULL, 25, 1),
(125, 'Bolo de Cenoura (Por kg)', '35.00', '&lt;p&gt;Vendido por quilo.&lt;/p&gt;', 'upload/2018/02/16/29531701fcc9c5a2a1a1a089af10fccd.png', 1, 1, '', 116, 0, 0, 1, NULL, '[\"2\",\"3\",\"4\",\"5\",\"6\",\"7\"]', NULL, 25, 1),
(126, 'Bolo de Iogurte (Por kg)', '30.00', '&lt;p&gt;Vendido por quilo.&lt;/p&gt;', 'upload/2018/09/14/aa2eef3daf101bf16d1ac9045b63e230.png', 1, 1, '', 119, 0, 0, 1, NULL, '[\"2\",\"3\",\"4\",\"5\",\"6\",\"7\"]', NULL, 25, 1),
(127, 'Bolo de Milho (Por kg)', '30.00', '&lt;p&gt;Vendido por quilo.&lt;/p&gt;', 'upload/2018/09/14/db180e4453384e3f88c59295faefadea.png', 1, 1, '', 120, 0, 0, 1, NULL, '[\"2\",\"3\",\"4\",\"5\",\"6\",\"7\"]', NULL, 25, 1),
(128, 'Sonho de Doce de Leite', '4.50', '&lt;p&gt;Massa a base de farinha, ovos e leite, frita e recheada com doce de leite da casa.&lt;/p&gt;\r\n&lt;p&gt;Polvilhado com a&amp;ccedil;&amp;uacute;car confeiteiro.&lt;/p&gt;', 'upload/2018/09/19/f94497fdc0ae1aeedf6d87f42c60f8dd.png', 1, 1, '', 127, 0, 1, 1, NULL, '[\"2\",\"3\",\"4\",\"5\",\"6\",\"7\"]', NULL, 25, 1),
(129, 'Sonho de Nutella', '4.50', '&lt;p&gt;Massa a base de farinha, ovos e leite, frita e recheada com nutella.&lt;/p&gt;\r\n&lt;p&gt;Polvilhado com a&amp;ccedil;&amp;uacute;car confeiteiro.&lt;/p&gt;', 'upload/2018/09/19/0b07bd7fe5c9226b69b4fe12344ff46e.jpg', 1, 1, '', 125, 0, 1, 1, NULL, '[\"2\",\"3\",\"4\",\"5\",\"6\",\"7\"]', NULL, 25, 1),
(131, 'Carolina de Doce de Leite (Por kg)', '35.00', '&lt;p&gt;Massa choux, recheado com doce de leite da casa e ganache de chocolate ao leite.&lt;/p&gt;\r\n&lt;p&gt;Vendida por quilo.&lt;/p&gt;', 'upload/2018/09/19/3352fc04184f96c538d1192426c5fef1.jpg', 1, 1, '', 128, 0, 1, 1, NULL, '[\"2\",\"3\",\"4\",\"5\",\"6\",\"7\"]', NULL, 25, 1),
(133, 'Suco de Laranja', '7.50', '&lt;p&gt;&lt;strong&gt;Bebida Gelada.&lt;/strong&gt;&lt;/p&gt;\r\n&lt;p&gt;Suco natural de laranja, agua e gelo.&lt;/p&gt;\r\n&lt;p&gt;Tempo de preparo &amp;eacute; de 10 minutos.&lt;/p&gt;', 'upload/2018/09/19/dbae2b05a8dd20b2173d8a4dee4c1ff6.jpg', 1, 1, '', 71, 0, 0, 1, NULL, '[\"2\",\"3\",\"4\",\"5\",\"6\",\"7\"]', NULL, 22, 1),
(134, 'Água Mineral ', '2.25', '&lt;p&gt;&lt;strong&gt;500 ml&lt;/strong&gt;&lt;/p&gt;', 'upload/2018/09/19/e7b915e426b628100b6eb2c5d24062ac.png', 1, 1, '', 72, 0, 1, 1, NULL, '[\"2\",\"3\",\"4\",\"5\",\"6\",\"7\"]', NULL, 22, 1),
(135, 'Água Mineral com Gás', '2.50', '&lt;p&gt;&lt;strong&gt;500 ml&lt;/strong&gt;&lt;/p&gt;', 'upload/2018/09/19/02a3de42ea903e42ed9e984a1b6fab60.png', 1, 1, '', 73, 0, 1, 1, NULL, '[\"2\",\"3\",\"4\",\"5\",\"6\",\"7\"]', NULL, 22, 1),
(136, 'Coca-Cola', '3.50', '&lt;p&gt;&lt;strong&gt;Lata&lt;/strong&gt;&lt;/p&gt;\r\n&lt;p&gt;&amp;nbsp;&lt;/p&gt;', 'upload/2018/09/18/0419e93b4b0fdffe06c619cd545adfbb.png', 1, 1, '', 74, 0, 1, 1, NULL, '[\"2\",\"3\",\"4\",\"5\",\"6\",\"7\"]', NULL, 22, 1),
(137, 'Fanta Laranja ', '3.50', '&lt;p&gt;&lt;strong&gt;Lata&lt;/strong&gt;&lt;/p&gt;', 'upload/2018/09/19/ffbc57c3acdfdd1e012872a1a18ef652.jpg', 1, 1, '', 75, 0, 1, 1, NULL, '[\"2\",\"3\",\"4\",\"5\",\"6\",\"7\"]', NULL, 22, 1),
(138, 'Sprite', '3.50', '&lt;p&gt;&lt;strong&gt;Lata&lt;/strong&gt;&lt;/p&gt;', 'upload/2018/09/19/eb5e28746e391e2430dd9425a62e37b4.jpg', 1, 1, '', 76, 0, 0, 1, NULL, '[\"2\",\"3\",\"4\",\"5\",\"6\",\"7\"]', NULL, 22, 1),
(139, 'Guaraná Antártica ', '3.50', '&lt;p&gt;&lt;strong&gt;Lata&lt;/strong&gt;&lt;/p&gt;', 'upload/2018/09/19/bd6d6d4958297e3b88f1c7e34c590a7a.png', 1, 1, '', 77, 0, 1, 1, NULL, '[\"2\",\"3\",\"4\",\"5\",\"6\",\"7\"]', NULL, 22, 1),
(140, 'Soda Limonada', '3.50', '&lt;p&gt;&lt;strong&gt;Lata&lt;/strong&gt;&lt;/p&gt;', 'upload/2018/09/19/a15e87b37cb1df71e4e376cf28ca1d54.jpg', 1, 1, '', 78, 0, 0, 1, NULL, '[\"2\",\"3\",\"4\",\"5\",\"6\",\"7\"]', NULL, 22, 1),
(141, 'Água Tônica Schweppes ', '3.75', '&lt;p&gt;&lt;strong&gt;Lata&lt;/strong&gt;&lt;/p&gt;', 'upload/2018/09/19/96b69f44c462aa55be8c7556d3cf2956.png', 1, 1, '', 79, 0, 1, 1, NULL, '[\"2\",\"3\",\"4\",\"5\",\"6\",\"7\"]', NULL, 22, 1),
(142, 'Schweppes Citrus ', '3.75', '&lt;p&gt;&lt;strong&gt;Lata&lt;/strong&gt;&lt;/p&gt;', 'upload/2018/09/18/e09fe69d86d23f28a9755a4e7ac59976.png', 1, 1, '', 80, 0, 0, 1, NULL, '[\"2\",\"3\",\"4\",\"5\",\"6\",\"7\"]', NULL, 22, 1),
(143, 'Coca-Cola - Zero', '3.75', '&lt;p&gt;&lt;strong&gt;Lata&lt;/strong&gt;&lt;/p&gt;', 'upload/2018/11/20/a73920139b9b7a80c3d69d709d800c42.png', 1, 1, '', 81, 0, 1, 1, NULL, '[\"2\",\"3\",\"4\",\"5\",\"6\",\"7\"]', NULL, 22, 1),
(144, 'Fanta Laranja - Zero', '3.75', '&lt;p&gt;&lt;strong&gt;Lata&lt;/strong&gt;&lt;/p&gt;', 'upload/2018/09/19/b68d903543ce373ec84c73aa6b863fce.jpg', 1, 1, '', 82, 0, 1, 1, NULL, '[\"2\",\"3\",\"4\",\"5\",\"6\",\"7\"]', NULL, 22, 1),
(145, 'Sprite  - Zero', '3.75', '&lt;p&gt;&lt;strong&gt;Lata&lt;/strong&gt;&lt;/p&gt;', 'upload/2018/09/19/4263993b05281aaacc220d5dcfdc4880.jpg', 1, 1, '', 83, 0, 0, 1, NULL, '[\"2\",\"3\",\"4\",\"5\",\"6\",\"7\"]', NULL, 22, 1),
(146, 'Guaraná Antártica - Zero', '3.75', '&lt;p&gt;&lt;strong&gt;Lata&lt;/strong&gt;&lt;/p&gt;', 'upload/2018/09/19/8e02d9af849e266e4e768157cf9d8856.jpg', 1, 1, '', 84, 0, 1, 1, NULL, '[\"2\",\"3\",\"4\",\"5\",\"6\",\"7\"]', NULL, 22, 1),
(147, 'Soda Limonada - Zero', '3.75', '&lt;p&gt;&lt;strong&gt;Lata&lt;/strong&gt;&lt;/p&gt;', 'upload/2018/09/19/9dc95ab7ab5ee7f7ea9b56be0bf152d8.jpg', 1, 1, '', 85, 0, 0, 1, NULL, '[\"2\",\"3\",\"4\",\"5\",\"6\",\"7\"]', NULL, 22, 1),
(148, 'Café Caramelo', '6.50', '&lt;p&gt;&lt;strong&gt;Bebida gelada.&lt;br /&gt;&lt;br /&gt;&lt;/strong&gt;300 ml de leite, 1 shot de caf&amp;eacute;, aromatizante de caramelo e a&amp;ccedil;&amp;uacute;car mascavo.&lt;/p&gt;\r\n&lt;p&gt;Batido no liquidificador.&lt;/p&gt;\r\n&lt;p&gt;Tempo de preparo &amp;eacute; de 10 minutos.&lt;/p&gt;', 'upload/2018/03/07/c628627b632188418732e03c8b3aef53.jpg', 1, 1, '', 86, 0, 0, 1, NULL, '[\"2\",\"3\",\"4\",\"5\",\"6\",\"7\"]', NULL, 22, 1),
(149, 'Deppuccino de Coco', '9.00', '&lt;p&gt;&lt;strong&gt;Bebida gelada.&lt;/strong&gt;&lt;/p&gt;\r\n&lt;p&gt;100 ml leite de coco, 1 shot de caf&amp;eacute;, calda de chocolate, coco ralado, gelo e chantilly.&lt;/p&gt;\r\n&lt;p&gt;Batido no liquidificador.&lt;/p&gt;\r\n&lt;p&gt;Tempo de preparo &amp;eacute; de 10 minutos.&lt;/p&gt;', 'upload/2018/09/19/1dfa3a11578a1b5ce692a98474b37e5d.png', 1, 1, '', 87, 0, 0, 1, NULL, '[\"2\",\"3\",\"4\",\"5\",\"6\",\"7\"]', NULL, 22, 1),
(150, 'Café com Leite Gelado', '5.00', '&lt;p&gt;&lt;strong&gt;Bebida gelada.&lt;/strong&gt;&lt;/p&gt;\r\n&lt;p&gt;150 ml de leite, 1 shot de caf&amp;eacute;, a&amp;ccedil;&amp;uacute;car mascavo e gelo.&lt;/p&gt;\r\n&lt;p&gt;Tempo de preparo &amp;eacute; de 10 minutos.&lt;/p&gt;', 'upload/2018/09/19/a76924a1e41dbb50e80dc6d17954e84c.jpg', 1, 1, '', 88, 0, 0, 1, NULL, '[\"2\",\"3\",\"4\",\"5\",\"6\",\"7\"]', NULL, 22, 1),
(151, 'Cappuccino de Chocolate (200ml)', '6.50', '&lt;p&gt;&lt;strong&gt;Bebida quente.&lt;/strong&gt;&lt;/p&gt;\r\n&lt;p&gt;Chocolate em p&amp;oacute;, 1 shot de expresso e partes iguais de leite vaporizado e espuma do leite.&lt;/p&gt;\r\n&lt;p&gt;Pode ser acrescentado chantilly como na foto.&lt;/p&gt;\r\n&lt;p&gt;Tempo de preparo &amp;eacute; de 5 minutos.&lt;/p&gt;', 'upload/2018/09/19/1f13e21bb0e670c2a163713a010e88c9.png', 1, 1, '', 89, 0, 0, 1, NULL, '[\"2\",\"3\",\"4\",\"5\",\"6\",\"7\"]', NULL, 22, 1),
(152, 'Café Irlandês ', '8.50', '&lt;p&gt;&lt;strong&gt;Bebida Alco&amp;oacute;lica&lt;/strong&gt;&lt;/p&gt;\r\n&lt;p&gt;150 ml de leite vaporizado, 1 shot de expresso e 1 shot de whisky e espuma de leite.&lt;/p&gt;\r\n&lt;p&gt;Tempo de preparo &amp;eacute; de 5 minutos.&lt;/p&gt;', 'upload/2018/09/18/583f15d69b35c86b0c84e740915e7507.jpg', 1, 1, '', 90, 0, 0, 1, NULL, '[\"2\",\"3\",\"4\",\"5\",\"6\",\"7\"]', NULL, 22, 1),
(153, 'Chá Verde com Hortelã', '3.50', '&lt;p&gt;&lt;strong&gt;Ch&amp;aacute; Quente&lt;/strong&gt;&lt;/p&gt;\r\n&lt;p&gt;Tempo de preparo &amp;eacute; de 5 minutos.&lt;/p&gt;', 'upload/2018/09/20/d80fdc1b9a835d0a9d0c48eb678ef226.jpg', 1, 1, '', 91, 0, 0, 1, NULL, '[\"2\",\"3\",\"4\",\"5\",\"6\",\"7\"]', NULL, 22, 1),
(154, 'Milkshake Amendoin (360ml)', '14.50', '', 'upload/2018/09/14/e76892f85a2a84df0493a632a0ad5156.png', 1, 1, '', 31, 0, 0, 1, NULL, '[\"2\",\"3\",\"4\",\"5\",\"6\",\"7\"]', NULL, 22, 1),
(155, 'Empanada de Carne com Ovos', '4.00', '&lt;p&gt;&lt;strong&gt;SALGADO ASSADO&lt;/strong&gt;&lt;/p&gt;\r\n&lt;p&gt;Todos os produtos s&amp;atilde;o preparados na hora.&lt;br /&gt;Caso o sabor desejado n&amp;atilde;o esteja dispon&amp;iacute;vel no expositor, solicite a&amp;nbsp;sua atendente que o mesmo ser&amp;aacute; preparado.&lt;br /&gt;O tempo de espera &amp;eacute; de 5 minutos, dependendo do movimento e do tipo de salgado solicitado.&lt;/p&gt;', 'upload/2018/09/18/33681f64410336af177e656fce1b6d01.jpg', 1, 1, '', 22, 0, 0, 1, NULL, '[\"2\",\"3\",\"4\",\"5\",\"6\",\"7\"]', NULL, 26, 1),
(156, 'Empanada de Frango', '4.00', '&lt;p&gt;&lt;strong&gt;SALGADO ASSADO&lt;/strong&gt;&lt;/p&gt;\r\n&lt;p&gt;Todos os produtos s&amp;atilde;o preparados na hora.&lt;br /&gt;Caso o sabor desejado n&amp;atilde;o esteja dispon&amp;iacute;vel no expositor, solicite a&amp;nbsp;sua atendente que o mesmo ser&amp;aacute; preparado.&lt;br /&gt;O tempo de espera &amp;eacute; de 5 minutos, dependendo do movimento e do tipo de salgado solicitado.&lt;/p&gt;', 'upload/2018/09/18/eebe6c77954410b8b279f4b04cf28969.jpg', 1, 1, '', 23, 0, 0, 1, NULL, '[\"2\",\"3\",\"4\",\"5\",\"6\",\"7\"]', NULL, 26, 1),
(157, 'Empanada de Carne com Ovos e Uva Passas', '4.50', '&lt;p&gt;&lt;strong&gt;SALGADO ASSADO&lt;/strong&gt;&lt;/p&gt;\r\n&lt;p&gt;Todos os produtos s&amp;atilde;o preparados na hora.&lt;br /&gt;Caso o sabor desejado n&amp;atilde;o esteja dispon&amp;iacute;vel no expositor, solicite a&amp;nbsp;sua atendente que o mesmo ser&amp;aacute; preparado.&lt;br /&gt;O tempo de espera &amp;eacute; de 5 minutos, dependendo do movimento e do tipo de salgado solicitado.&lt;/p&gt;', 'upload/2018/09/18/a23dfc7e276f61aa9c2579494e80e631.jpg', 1, 1, '', 24, 0, 0, 1, NULL, '[\"2\",\"3\",\"4\",\"5\",\"6\",\"7\"]', NULL, 26, 1),
(158, 'Empanada de Queijo, Presunto e Orégano', '4.25', '&lt;p&gt;&lt;strong&gt;SALGADO ASSADO&lt;/strong&gt;&lt;/p&gt;\r\n&lt;p&gt;Todos os produtos s&amp;atilde;o preparados na hora.&lt;br /&gt;Caso o sabor desejado n&amp;atilde;o esteja dispon&amp;iacute;vel no expositor, solicite a&amp;nbsp;sua atendente que o mesmo ser&amp;aacute; preparado.&lt;br /&gt;O tempo de espera &amp;eacute; de 5 minutos, dependendo do movimento e do tipo de salgado solicitado.&lt;/p&gt;', 'upload/2018/09/18/37bcadb1046f2a22d07e1ac1dc9efc0c.jpg', 1, 1, '', 25, 0, 0, 1, NULL, '[\"2\",\"3\",\"4\",\"5\",\"6\",\"7\"]', NULL, 26, 1),
(159, 'Quiche de Linguicinha', '9.90', '&lt;p&gt;&lt;strong&gt;SALGADO ASSADO&lt;/strong&gt;&lt;br /&gt;Todos os produtos s&amp;atilde;o preparados na hora.&lt;br /&gt;Caso o sabor desejado n&amp;atilde;o esteja dispon&amp;iacute;vel no expositor, solicite a&amp;nbsp;sua atendente que o mesmo ser&amp;aacute; preparado.&lt;br /&gt;O tempo de espera &amp;eacute; de 10 a 30 minutos, dependendo do movimento e do tipo de salgado solicitado.&lt;/p&gt;', 'upload/2018/09/18/c90411285847c64bac92cd9ca924dfcb.jpg', 1, 1, '', 26, 0, 0, 1, NULL, '[\"2\",\"3\",\"4\",\"5\",\"6\",\"7\"]', NULL, 26, 1),
(160, 'Quiche de Espinafre com Ricota', '9.90', '&lt;p&gt;&lt;strong&gt;SALGADO ASSADO&lt;/strong&gt;&lt;br /&gt;Todos os produtos s&amp;atilde;o preparados na hora.&lt;br /&gt;Caso o sabor desejado n&amp;atilde;o esteja dispon&amp;iacute;vel no expositor, solicite a&amp;nbsp;sua atendente que o mesmo ser&amp;aacute; preparado.&lt;br /&gt;O tempo de espera &amp;eacute; de 10 a 30 minutos, dependendo do movimento e do tipo de salgado solicitado.&lt;/p&gt;', 'upload/2018/09/20/9e64c7efc952fd5e067f282c420d5c21.jpg', 1, 1, '', 27, 0, 0, 1, NULL, '[\"2\",\"3\",\"4\",\"5\",\"6\",\"7\"]', NULL, 26, 1),
(163, 'Banoffe (Por kg)', '50.00', '&lt;p&gt;Massa a base de chocolate em p&amp;oacute; especial e manteiga, doce de leite da casa, banana, chantilly de leite ninho e calda de chocolate.&lt;/p&gt;', 'upload/2018/09/19/b123fb1011573a4b2b71ef4cb1432f3a.jpg', 1, 1, '', 129, 0, 0, 1, NULL, '[\"2\",\"3\",\"4\",\"5\",\"6\",\"7\"]', NULL, 25, 1),
(164, 'Chocolate Quente Irlandês (200ml)', '9.50', '&lt;p&gt;&lt;strong&gt;Bebida quente.&lt;/strong&gt;&lt;/p&gt;\r\n&lt;p&gt;200ml de leite, chocolate especial em p&amp;oacute;, a&amp;ccedil;&amp;uacute;car, baunilha, creme de leite, 1 shot de whisky, marshmallow e chantilly.&lt;/p&gt;\r\n&lt;p&gt;Tempo de preparo &amp;eacute; de 10 minutos.&lt;/p&gt;', 'upload/2018/09/20/837e00c9fa7cfb16e243be904968362b.jpg', 1, 1, '', 92, 0, 0, 1, NULL, '[\"2\",\"3\",\"4\",\"5\",\"6\",\"7\"]', NULL, 22, 1),
(165, 'Chocolate Quente com Leite de Coco (S/L 200ml)', '9.50', '&lt;p&gt;&lt;strong&gt;Bebida quente.&lt;/strong&gt;&lt;/p&gt;\r\n&lt;p&gt;200ml de leite de coco, chocolate especial em p&amp;oacute;, a&amp;ccedil;&amp;uacute;car, baunilha, creme de leite,&amp;nbsp; marshmallow e chantilly.&lt;/p&gt;\r\n&lt;p&gt;Tempo de preparo &amp;eacute; de 10 minutos.&lt;/p&gt;', 'upload/2018/09/20/573dc1d567b9938cd51036bf02f08e81.jpg', 1, 1, '', 93, 0, 0, 1, NULL, '[\"2\",\"3\",\"4\",\"5\",\"6\",\"7\"]', NULL, 22, 1),
(166, 'Macarrão com Legumes e Frango', '13.90', '&lt;p&gt;Espaguete com frango, cebola, cenoura, piment&amp;atilde;o, alho-por&amp;oacute; e shoyo.&lt;/p&gt;\r\n&lt;p&gt;Acompanha um refrigerante ca&amp;ccedil;ulinha.&lt;/p&gt;\r\n&lt;p&gt;Tempo de preparo &amp;eacute; de 15 minutos.&lt;/p&gt;', 'upload/2018/09/19/ef31456ff8f92cd1e6bf925cb7ee8dbd.jpg', 1, 1, '', 4, 0, 1, 1, NULL, '[\"2\",\"3\",\"4\",\"5\",\"6\",\"7\"]', NULL, 37, 1),
(168, 'Sanduíche Toscana', '12.90', '&lt;p&gt;P&amp;atilde;o franc&amp;ecirc;s, lingui&amp;ccedil;a toscana, mix de queijos e pasta de alho.&lt;/p&gt;\r\n&lt;p&gt;Tempo de preparo de 10 a 15 minutos.&lt;/p&gt;', 'upload/2018/09/18/79775d3b67b2829fafacf59089039bff.jpg', 1, 1, '', 111, 0, 1, 1, NULL, '[\"2\",\"3\",\"4\",\"5\",\"6\",\"7\"]', NULL, 27, 1),
(169, 'Cheesecake de Chocolate', '9.90', '', 'upload/2018/09/18/c57fb4089a965753670321e191f13a80.jpg', 1, 1, '', 122, 0, 0, 1, NULL, '[\"2\",\"3\",\"4\",\"5\",\"6\",\"7\"]', NULL, 25, 1),
(170, 'Prato Executivo com Frango', '14.90', '&lt;p&gt;Arroz, salada de alface, tomate e pepino, batatas fritas e 150 gramas de fil&amp;eacute; de frango.&lt;/p&gt;\r\n&lt;p&gt;O cliente poder&amp;aacute; tamb&amp;eacute;m optar por fil&amp;eacute; mignon.&lt;/p&gt;\r\n&lt;p&gt;Tempo de preparo &amp;eacute; de 15 minutos.&lt;/p&gt;', 'upload/2018/09/19/ae98c8b981329066b50fcfd633ddfea7.jpg', 1, 1, '', 5, 1, 1, 1, NULL, '[\"2\",\"3\",\"4\",\"5\",\"6\",\"7\"]', NULL, 37, 1),
(171, 'Canolli de Ricota', '3.50', '&lt;p&gt;Massa doce frita produzida pela Delion com um creme de ricota, a&amp;ccedil;&amp;uacute;car e canela.&lt;/p&gt;', 'upload/2018/09/19/9d8e6ebe449ab1a19ef26da3a15d5acf.jpg', 1, 1, '', 130, 1, 1, 1, NULL, '[\"2\",\"3\",\"4\",\"5\",\"6\",\"7\"]', NULL, 25, 1),
(172, 'Canolli de Doce de Leite', '3.50', '&lt;p&gt;Massa doce frita produzida pela Delion com doce de leite produzido pela Delion.&lt;/p&gt;', 'upload/2018/09/19/42fe1d738de1228ba161a526a609a693.jpg', 1, 1, '', 131, 0, 1, 1, NULL, '[\"2\",\"3\",\"4\",\"5\",\"6\",\"7\"]', NULL, 25, 1),
(173, 'Cueca Virada (Por kg)', '20.00', '&lt;p&gt;Massa feita a base de farinha e ovos, frita e polvilhada com a&amp;ccedil;&amp;uacute;car.&lt;/p&gt;\r\n&lt;p&gt;Vendida por quilo.&lt;/p&gt;', 'upload/2018/09/19/942b3224ff17e9e76beaf1e0bbc54ee6.jpg', 1, 1, '', 132, 0, 1, 1, NULL, '[\"2\",\"3\",\"4\",\"5\",\"6\",\"7\"]', NULL, 25, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_recupera_senha`
--

CREATE TABLE `tb_recupera_senha` (
  `res_pk_id` int(11) NOT NULL,
  `res_cod_recuperacao` varchar(20) NOT NULL,
  `res_recuperado` tinyint(1) NOT NULL DEFAULT 0,
  `res_data_expiracao` datetime NOT NULL,
  `res_fk_cliente` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_sms`
--

CREATE TABLE `tb_sms` (
  `sms_pk_id` int(11) NOT NULL,
  `sms_msg` varchar(160) NOT NULL,
  `sms_descricao` varchar(60) NOT NULL,
  `sms_data_envio` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_sms_verificacao`
--

CREATE TABLE `tb_sms_verificacao` (
  `smve_pk_id` int(11) NOT NULL,
  `smve_telefone` varchar(15) NOT NULL,
  `smve_codigo` mediumint(6) UNSIGNED NOT NULL,
  `smve_verificado` tinyint(1) NOT NULL DEFAULT 0,
  `smve_fk_empresa` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_tipo_avaliacao`
--

CREATE TABLE `tb_tipo_avaliacao` (
  `tiva_pk_id` int(11) NOT NULL,
  `tiva_nome` varchar(50) NOT NULL,
  `tiva_flag_ativo` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_usuario`
--

CREATE TABLE `tb_usuario` (
  `usu_pk_id` int(11) NOT NULL,
  `usu_nome` varchar(60) NOT NULL,
  `usu_login` varchar(60) NOT NULL,
  `usu_senha` varchar(32) NOT NULL,
  `usu_email` varchar(100) NOT NULL,
  `usu_flag_bloqueado` tinyint(1) NOT NULL,
  `usu_cod_perfil` tinyint(4) NOT NULL,
  `usu_permissao` mediumtext NOT NULL,
  `usu_fk_empresa` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `tb_usuario`
--

INSERT INTO `tb_usuario` (`usu_pk_id`, `usu_nome`, `usu_login`, `usu_senha`, `usu_email`, `usu_flag_bloqueado`, `usu_cod_perfil`, `usu_permissao`, `usu_fk_empresa`) VALUES
(1, 'admin', 'admin', 'e10adc3949ba59abbe56e057f20f883e', 'admin@admin.com', 0, 0, '[\"usuario\",\"empresa\",\"banner\",\"imagem\",\"evento\",\"categoria\",\"cardapio\"]', NULL),
(3, 'douglas', 'douglas', '3b16dc694c38d04f7d7451cc37d3c654', 'douglas@douglas.com', 0, 0, '[\"usuario\"]', NULL),
(4, 'kionux', 'kionux', 'c37ea86ec45c587ae1950e8f5337d84b', 'thiago@corp.kionux.com.br', 0, 0, '[\"usuario\",\"empresa\",\"banner\",\"imagem\",\"evento\",\"categoria\",\"cardapio\",\"cliente\",\"pedido\",\"avaliacao\"]', NULL),
(9, 'vitor', 'vitor', '997d13b90da22b35ce43bebdd332ad11', 'vitormatheussb@gmail.com', 0, 0, '[\"usuario\",\"empresa\",\"banner\",\"imagem\",\"evento\",\"categoria\",\"cardapio\",\"cliente\",\"pedido\",\"avaliacao\"]', NULL),
(10, 'Matheus', 'matheus', '45339359513f09155110f63f7ca91c3e', '', 0, 0, '[\"usuario\",\"empresa\",\"banner\",\"imagem\",\"evento\",\"categoria\",\"cardapio\",\"cliente\",\"pedido\",\"avaliacao\",\"combo\",\"adicional\", \"pedidoWpp\"]', NULL),
(11, 'felipe', 'da Maia', '992ce73c8b7bdd59daa1de6ac995cad7', '', 0, 0, '[\"usuario\",\"empresa\",\"banner\",\"imagem\",\"evento\",\"categoria\",\"cardapio\",\"cliente\",\"pedido\",\"avaliacao\",\"combo\",\"adicional\",\"cupom\",\"forma_pgto\",\"info_entrega\"]', NULL),
(13, 'thiago', 'thiago', '8c278462dc2f486dd9697edc17eff391', '', 0, 0, '[\"usuario\",\"empresa\",\"banner\",\"imagem\",\"evento\",\"categoria\",\"cardapio\",\"cliente\",\"pedido\",\"avaliacao\",\"combo\",\"adicional\",\"cupom\",\"forma_pgto\",\"info_entrega\",\"enviar_sms\"]', NULL),
(15, 'Isshak', 'isshak', '202cb962ac59075b964b07152d234b70', '', 0, 0, '[\"usuario\",\"empresa\",\"banner\",\"imagem\",\"evento\",\"categoria\",\"cardapio\",\"cliente\",\"pedido\",\"avaliacao\",\"combo\",\"adicional\",\"cupom\",\"forma_pgto\",\"info_entrega\",\"enviar_sms\"]', NULL),
(16, 'teste', 'teste@teste', '202cb962ac59075b964b07152d234b70', '', 1, 0, '[\"usuario\",\"empresa\",\"imagem\",\"categoria\",\"cardapio\",\"cliente\",\"pedido\",\"avaliacao\",\"combo\",\"adicional\",\"cupom\",\"forma_pgto\",\"info_entrega\",\"enviar_sms\"]', NULL);

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `rl_cliente_cupom`
--
ALTER TABLE `rl_cliente_cupom`
  ADD PRIMARY KEY (`clcu_pk_id`),
  ADD KEY `clcu_fk_cupom` (`clcu_fk_cupom`),
  ADD KEY `clcu_fk_cliente` (`clcu_fk_cliente`);

--
-- Índices para tabela `rl_cliente_sms`
--
ALTER TABLE `rl_cliente_sms`
  ADD PRIMARY KEY (`clsm_pk_id`),
  ADD KEY `clsm_fk_sms_mensagem` (`clsm_fk_sms_mensagem`),
  ADD KEY `clsm_fk_cliente` (`clsm_fk_cliente`);

--
-- Índices para tabela `rl_pedido_produto`
--
ALTER TABLE `rl_pedido_produto`
  ADD PRIMARY KEY (`pepr_fk_produto`,`pepr_fk_pedido`),
  ADD KEY `fk_tb_produto_has_tb_pedido_tb_pedido1_idx` (`pepr_fk_pedido`),
  ADD KEY `fk_tb_produto_has_tb_pedido_tb_produto1_idx` (`pepr_fk_produto`);

--
-- Índices para tabela `tb_adicional`
--
ALTER TABLE `tb_adicional`
  ADD PRIMARY KEY (`adi_pk_id`),
  ADD KEY `fk_tb_adicional_tb_empresa1_idx` (`adi_fk_empresa`),
  ADD KEY `fk_tb_adicional_tb_produto1_idx` (`adi_fk_produto`);

--
-- Índices para tabela `tb_avaliacao`
--
ALTER TABLE `tb_avaliacao`
  ADD PRIMARY KEY (`ava_pk_id`),
  ADD KEY `ava_fk_tipo_avaliacao` (`ava_fk_tipo_avaliacao`),
  ADD KEY `fk_tb_avaliacao_tb_empresa1_idx` (`ava_fk_empresa`);

--
-- Índices para tabela `tb_banner`
--
ALTER TABLE `tb_banner`
  ADD PRIMARY KEY (`ban_pk_id`),
  ADD KEY `fk_tb_banner_tb_empresa1_idx` (`ban_fk_empresa`);

--
-- Índices para tabela `tb_categoria`
--
ALTER TABLE `tb_categoria`
  ADD PRIMARY KEY (`cat_pk_id`),
  ADD KEY `fk_tb_categoria_tb_empresa1_idx` (`cat_fk_empresa`);

--
-- Índices para tabela `tb_cidade`
--
ALTER TABLE `tb_cidade`
  ADD PRIMARY KEY (`ci_pk_id`),
  ADD KEY `fk_tb_cidade_tb_estado1_idx` (`ci_fk_estado`);

--
-- Índices para tabela `tb_cliente`
--
ALTER TABLE `tb_cliente`
  ADD PRIMARY KEY (`cli_pk_id`),
  ADD KEY `fk_tb_cliente_tb_empresa1_idx` (`cli_fk_empresa`);

--
-- Índices para tabela `tb_cupom`
--
ALTER TABLE `tb_cupom`
  ADD PRIMARY KEY (`cup_pk_id`);

--
-- Índices para tabela `tb_empresa`
--
ALTER TABLE `tb_empresa`
  ADD PRIMARY KEY (`emp_pk_id`);

--
-- Índices para tabela `tb_endereco`
--
ALTER TABLE `tb_endereco`
  ADD PRIMARY KEY (`end_pk_id`),
  ADD KEY `end_fk_cliente` (`end_fk_cliente`),
  ADD KEY `fk_tb_endereco_tb_cidade1_idx` (`end_fk_cidade`);

--
-- Índices para tabela `tb_entrega`
--
ALTER TABLE `tb_entrega`
  ADD PRIMARY KEY (`ent_pk_id`),
  ADD KEY `fk_tb_entrega_tb_empresa1_idx` (`ent_fk_empresa`);

--
-- Índices para tabela `tb_estado`
--
ALTER TABLE `tb_estado`
  ADD PRIMARY KEY (`es_pk_id`),
  ADD KEY `fk_tb_estado_tb_pais1_idx` (`es_fk_pais`);

--
-- Índices para tabela `tb_evento`
--
ALTER TABLE `tb_evento`
  ADD PRIMARY KEY (`eve_pk_id`),
  ADD KEY `fk_tb_evento_tb_empresa1_idx` (`eve_fk_empresa`);

--
-- Índices para tabela `tb_faixa_horario`
--
ALTER TABLE `tb_faixa_horario`
  ADD PRIMARY KEY (`faho_pk_id`);

--
-- Índices para tabela `tb_forma_pgto`
--
ALTER TABLE `tb_forma_pgto`
  ADD PRIMARY KEY (`fopg_pk_id`),
  ADD KEY `fk_tb_forma_pgto_tb_empresa1_idx` (`fopg_fk_empresa`);

--
-- Índices para tabela `tb_imagem`
--
ALTER TABLE `tb_imagem`
  ADD PRIMARY KEY (`ima_pk_id`),
  ADD KEY `fk_tb_imagem_tb_empresa1_idx` (`ima_fk_empresa`);

--
-- Índices para tabela `tb_origem_pedido`
--
ALTER TABLE `tb_origem_pedido`
  ADD PRIMARY KEY (`orpe_pk_id`);

--
-- Índices para tabela `tb_pais`
--
ALTER TABLE `tb_pais`
  ADD PRIMARY KEY (`pa_pk_id`);

--
-- Índices para tabela `tb_pedido`
--
ALTER TABLE `tb_pedido`
  ADD PRIMARY KEY (`ped_pk_id`),
  ADD KEY `fk_tb_pedido_tb_empresa1_idx` (`ped_fk_empresa`),
  ADD KEY `fk_tb_pedido_tb_cliente1_idx` (`ped_fk_cliente`),
  ADD KEY `fk_tb_pedido_tb_origem_pedido1_idx` (`ped_fk_origem_pedido`),
  ADD KEY `ped_fk_forma_pgto` (`ped_fk_forma_pgto`),
  ADD KEY `ped_fk_endereco` (`ped_fk_endereco`);

--
-- Índices para tabela `tb_produto`
--
ALTER TABLE `tb_produto`
  ADD PRIMARY KEY (`pro_pk_id`),
  ADD KEY `fk_tb_cardapio_tb_empresa1_idx` (`pro_fk_empresa`),
  ADD KEY `fk_tb_produto_tb_categoria1_idx` (`pro_fk_categoria`),
  ADD KEY `fk_tb_produto_tb_faixa_horario1_idx` (`pro_fk_faixa_horario`);

--
-- Índices para tabela `tb_recupera_senha`
--
ALTER TABLE `tb_recupera_senha`
  ADD PRIMARY KEY (`res_pk_id`),
  ADD KEY `res_fk_cliente` (`res_fk_cliente`);

--
-- Índices para tabela `tb_sms`
--
ALTER TABLE `tb_sms`
  ADD PRIMARY KEY (`sms_pk_id`);

--
-- Índices para tabela `tb_sms_verificacao`
--
ALTER TABLE `tb_sms_verificacao`
  ADD PRIMARY KEY (`smve_pk_id`),
  ADD KEY `fk_tb_sms_verificacao_tb_empresa1_idx` (`smve_fk_empresa`);

--
-- Índices para tabela `tb_tipo_avaliacao`
--
ALTER TABLE `tb_tipo_avaliacao`
  ADD PRIMARY KEY (`tiva_pk_id`);

--
-- Índices para tabela `tb_usuario`
--
ALTER TABLE `tb_usuario`
  ADD PRIMARY KEY (`usu_pk_id`),
  ADD KEY `fk_tb_usuario_tb_empresa1_idx` (`usu_fk_empresa`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `rl_cliente_cupom`
--
ALTER TABLE `rl_cliente_cupom`
  MODIFY `clcu_pk_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `rl_cliente_sms`
--
ALTER TABLE `rl_cliente_sms`
  MODIFY `clsm_pk_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tb_adicional`
--
ALTER TABLE `tb_adicional`
  MODIFY `adi_pk_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tb_avaliacao`
--
ALTER TABLE `tb_avaliacao`
  MODIFY `ava_pk_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tb_banner`
--
ALTER TABLE `tb_banner`
  MODIFY `ban_pk_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tb_categoria`
--
ALTER TABLE `tb_categoria`
  MODIFY `cat_pk_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT de tabela `tb_cliente`
--
ALTER TABLE `tb_cliente`
  MODIFY `cli_pk_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=92;

--
-- AUTO_INCREMENT de tabela `tb_cupom`
--
ALTER TABLE `tb_cupom`
  MODIFY `cup_pk_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tb_empresa`
--
ALTER TABLE `tb_empresa`
  MODIFY `emp_pk_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `tb_endereco`
--
ALTER TABLE `tb_endereco`
  MODIFY `end_pk_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tb_entrega`
--
ALTER TABLE `tb_entrega`
  MODIFY `ent_pk_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de tabela `tb_estado`
--
ALTER TABLE `tb_estado`
  MODIFY `es_pk_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tb_evento`
--
ALTER TABLE `tb_evento`
  MODIFY `eve_pk_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tb_faixa_horario`
--
ALTER TABLE `tb_faixa_horario`
  MODIFY `faho_pk_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `tb_forma_pgto`
--
ALTER TABLE `tb_forma_pgto`
  MODIFY `fopg_pk_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `tb_imagem`
--
ALTER TABLE `tb_imagem`
  MODIFY `ima_pk_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de tabela `tb_origem_pedido`
--
ALTER TABLE `tb_origem_pedido`
  MODIFY `orpe_pk_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tb_pais`
--
ALTER TABLE `tb_pais`
  MODIFY `pa_pk_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tb_pedido`
--
ALTER TABLE `tb_pedido`
  MODIFY `ped_pk_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de tabela `tb_produto`
--
ALTER TABLE `tb_produto`
  MODIFY `pro_pk_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=176;

--
-- AUTO_INCREMENT de tabela `tb_recupera_senha`
--
ALTER TABLE `tb_recupera_senha`
  MODIFY `res_pk_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tb_sms`
--
ALTER TABLE `tb_sms`
  MODIFY `sms_pk_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tb_sms_verificacao`
--
ALTER TABLE `tb_sms_verificacao`
  MODIFY `smve_pk_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tb_tipo_avaliacao`
--
ALTER TABLE `tb_tipo_avaliacao`
  MODIFY `tiva_pk_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tb_usuario`
--
ALTER TABLE `tb_usuario`
  MODIFY `usu_pk_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `rl_cliente_cupom`
--
ALTER TABLE `rl_cliente_cupom`
  ADD CONSTRAINT `rl_cliente_cupom_ibfk_1` FOREIGN KEY (`clcu_fk_cupom`) REFERENCES `tb_cupom` (`cup_pk_id`),
  ADD CONSTRAINT `rl_cliente_cupom_ibfk_2` FOREIGN KEY (`clcu_fk_cliente`) REFERENCES `tb_cliente` (`cli_pk_id`);

--
-- Limitadores para a tabela `rl_cliente_sms`
--
ALTER TABLE `rl_cliente_sms`
  ADD CONSTRAINT `rl_cliente_sms_ibfk_1` FOREIGN KEY (`clsm_fk_sms_mensagem`) REFERENCES `tb_sms` (`sms_pk_id`),
  ADD CONSTRAINT `rl_cliente_sms_ibfk_2` FOREIGN KEY (`clsm_fk_cliente`) REFERENCES `tb_cliente` (`cli_pk_id`);

--
-- Limitadores para a tabela `rl_pedido_produto`
--
ALTER TABLE `rl_pedido_produto`
  ADD CONSTRAINT `fk_tb_produto_has_tb_pedido_tb_pedido1` FOREIGN KEY (`pepr_fk_pedido`) REFERENCES `tb_pedido` (`ped_pk_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tb_produto_has_tb_pedido_tb_produto1` FOREIGN KEY (`pepr_fk_produto`) REFERENCES `tb_produto` (`pro_pk_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `tb_adicional`
--
ALTER TABLE `tb_adicional`
  ADD CONSTRAINT `fk_tb_adicional_tb_empresa1` FOREIGN KEY (`adi_fk_empresa`) REFERENCES `tb_empresa` (`emp_pk_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tb_adicional_tb_produto1` FOREIGN KEY (`adi_fk_produto`) REFERENCES `tb_produto` (`pro_pk_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `tb_avaliacao`
--
ALTER TABLE `tb_avaliacao`
  ADD CONSTRAINT `fk_tb_avaliacao_tb_empresa1` FOREIGN KEY (`ava_fk_empresa`) REFERENCES `tb_empresa` (`emp_pk_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `tb_avaliacao_ibfk_1` FOREIGN KEY (`ava_fk_tipo_avaliacao`) REFERENCES `tb_tipo_avaliacao` (`tiva_pk_id`);

--
-- Limitadores para a tabela `tb_banner`
--
ALTER TABLE `tb_banner`
  ADD CONSTRAINT `fk_tb_banner_tb_empresa1` FOREIGN KEY (`ban_fk_empresa`) REFERENCES `tb_empresa` (`emp_pk_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `tb_categoria`
--
ALTER TABLE `tb_categoria`
  ADD CONSTRAINT `fk_tb_categoria_tb_empresa1` FOREIGN KEY (`cat_fk_empresa`) REFERENCES `tb_empresa` (`emp_pk_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `tb_cidade`
--
ALTER TABLE `tb_cidade`
  ADD CONSTRAINT `fk_tb_cidade_tb_estado1` FOREIGN KEY (`ci_fk_estado`) REFERENCES `tb_estado` (`es_pk_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `tb_cliente`
--
ALTER TABLE `tb_cliente`
  ADD CONSTRAINT `fk_tb_cliente_tb_empresa1` FOREIGN KEY (`cli_fk_empresa`) REFERENCES `tb_empresa` (`emp_pk_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `tb_endereco`
--
ALTER TABLE `tb_endereco`
  ADD CONSTRAINT `fk_tb_endereco_tb_cidade1` FOREIGN KEY (`end_fk_cidade`) REFERENCES `tb_cidade` (`ci_pk_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `tb_endereco_ibfk_1` FOREIGN KEY (`end_fk_cliente`) REFERENCES `tb_cliente` (`cli_pk_id`);

--
-- Limitadores para a tabela `tb_entrega`
--
ALTER TABLE `tb_entrega`
  ADD CONSTRAINT `fk_tb_entrega_tb_empresa1` FOREIGN KEY (`ent_fk_empresa`) REFERENCES `tb_empresa` (`emp_pk_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `tb_estado`
--
ALTER TABLE `tb_estado`
  ADD CONSTRAINT `fk_tb_estado_tb_pais1` FOREIGN KEY (`es_fk_pais`) REFERENCES `tb_pais` (`pa_pk_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `tb_evento`
--
ALTER TABLE `tb_evento`
  ADD CONSTRAINT `fk_tb_evento_tb_empresa1` FOREIGN KEY (`eve_fk_empresa`) REFERENCES `tb_empresa` (`emp_pk_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `tb_forma_pgto`
--
ALTER TABLE `tb_forma_pgto`
  ADD CONSTRAINT `fk_tb_forma_pgto_tb_empresa1` FOREIGN KEY (`fopg_fk_empresa`) REFERENCES `tb_empresa` (`emp_pk_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `tb_imagem`
--
ALTER TABLE `tb_imagem`
  ADD CONSTRAINT `fk_tb_imagem_tb_empresa1` FOREIGN KEY (`ima_fk_empresa`) REFERENCES `tb_empresa` (`emp_pk_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `tb_pedido`
--
ALTER TABLE `tb_pedido`
  ADD CONSTRAINT `fk_tb_pedido_tb_cliente1` FOREIGN KEY (`ped_fk_cliente`) REFERENCES `tb_cliente` (`cli_pk_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tb_pedido_tb_empresa1` FOREIGN KEY (`ped_fk_empresa`) REFERENCES `tb_empresa` (`emp_pk_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tb_pedido_tb_endereco1` FOREIGN KEY (`ped_fk_endereco`) REFERENCES `tb_endereco` (`end_pk_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tb_pedido_tb_forma_pagamento1` FOREIGN KEY (`ped_fk_forma_pgto`) REFERENCES `tb_forma_pgto` (`fopg_pk_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tb_pedido_tb_origem_pedido1` FOREIGN KEY (`ped_fk_origem_pedido`) REFERENCES `tb_origem_pedido` (`orpe_pk_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `tb_produto`
--
ALTER TABLE `tb_produto`
  ADD CONSTRAINT `fk_tb_cardapio_tb_empresa1` FOREIGN KEY (`pro_fk_empresa`) REFERENCES `tb_empresa` (`emp_pk_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tb_produto_tb_categoria1` FOREIGN KEY (`pro_fk_categoria`) REFERENCES `tb_categoria` (`cat_pk_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tb_produto_tb_faixa_horario1` FOREIGN KEY (`pro_fk_faixa_horario`) REFERENCES `tb_faixa_horario` (`faho_pk_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `tb_recupera_senha`
--
ALTER TABLE `tb_recupera_senha`
  ADD CONSTRAINT `tb_recupera_senha_ibfk_1` FOREIGN KEY (`res_fk_cliente`) REFERENCES `tb_cliente` (`cli_pk_id`);

--
-- Limitadores para a tabela `tb_sms_verificacao`
--
ALTER TABLE `tb_sms_verificacao`
  ADD CONSTRAINT `fk_tb_sms_verificacao_tb_empresa1` FOREIGN KEY (`smve_fk_empresa`) REFERENCES `tb_empresa` (`emp_pk_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `tb_usuario`
--
ALTER TABLE `tb_usuario`
  ADD CONSTRAINT `fk_tb_usuario_tb_empresa1` FOREIGN KEY (`usu_fk_empresa`) REFERENCES `tb_empresa` (`emp_pk_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

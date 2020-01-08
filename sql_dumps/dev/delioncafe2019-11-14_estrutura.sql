-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 14-Nov-2019 às 17:51
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
  `dias_semana` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `cardapio_turno` int(11) DEFAULT NULL,
  `cardapio_horas_inicio` int(11) DEFAULT NULL,
  `cardapio_horas_final` int(11) DEFAULT NULL,
  `posicao` smallint(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estrutura da tabela `cardapio_horas`
--

CREATE TABLE `cardapio_horas` (
  `cod_cardapio_horas` int(11) NOT NULL,
  `horario` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estrutura da tabela `cardapio_turno`
--

CREATE TABLE `cardapio_turno` (
  `cod_cardapio_turno` int(11) NOT NULL,
  `nome` varchar(50) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

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
  `pontos_fidelidade` smallint(6) DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `id_google` varchar(32) COLLATE utf8_bin DEFAULT NULL,
  `id_facebook` varchar(255) COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

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
  `txt_dias_semana` varchar(30) COLLATE utf8_bin DEFAULT NULL,
  `txt_horario_semana` varchar(30) COLLATE utf8_bin NOT NULL,
  `txt_dias_fim_semana` varchar(30) COLLATE utf8_bin NOT NULL,
  `txt_horario_fim_semana` varchar(30) COLLATE utf8_bin NOT NULL,
  `arr_dias_semana` varchar(50) COLLATE utf8_bin NOT NULL,
  `arr_horarios_inicio` varchar(100) COLLATE utf8_bin NOT NULL,
  `arr_horarios_final` varchar(100) COLLATE utf8_bin NOT NULL,
  `aberto` tinyint(1) NOT NULL,
  `entregando` tinyint(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

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

-- --------------------------------------------------------

--
-- Estrutura da tabela `formapgt`
--

CREATE TABLE `formapgt` (
  `cod_formaPgt` int(11) NOT NULL,
  `tipoFormaPgt` varchar(60) NOT NULL,
  `flag_ativo` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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

-- --------------------------------------------------------

--
-- Estrutura da tabela `tipo_avaliacao`
--

CREATE TABLE `tipo_avaliacao` (
  `cod_tipo_avaliacao` int(11) NOT NULL,
  `nome` varchar(50) COLLATE utf8_bin NOT NULL,
  `flag_ativo` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

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
  MODIFY `cod_adicional` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `avaliacao`
--
ALTER TABLE `avaliacao`
  MODIFY `cod_avaliacao` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `banner`
--
ALTER TABLE `banner`
  MODIFY `cod_banner` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `cardapio`
--
ALTER TABLE `cardapio`
  MODIFY `cod_cardapio` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `cardapio_horas`
--
ALTER TABLE `cardapio_horas`
  MODIFY `cod_cardapio_horas` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `cardapio_turno`
--
ALTER TABLE `cardapio_turno`
  MODIFY `cod_cardapio_turno` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `categoria`
--
ALTER TABLE `categoria`
  MODIFY `cod_categoria` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `cliente`
--
ALTER TABLE `cliente`
  MODIFY `cod_cliente` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `cupom`
--
ALTER TABLE `cupom`
  MODIFY `cod_cupom` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `cupom_cliente`
--
ALTER TABLE `cupom_cliente`
  MODIFY `cod_cupom_cliente` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `empresa`
--
ALTER TABLE `empresa`
  MODIFY `cod_empresa` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `endereco`
--
ALTER TABLE `endereco`
  MODIFY `cod_endereco` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `entrega`
--
ALTER TABLE `entrega`
  MODIFY `cod_entrega` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `evento`
--
ALTER TABLE `evento`
  MODIFY `cod_evento` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `formapgt`
--
ALTER TABLE `formapgt`
  MODIFY `cod_formaPgt` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `imagem`
--
ALTER TABLE `imagem`
  MODIFY `cod_imagem` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `item_pedido`
--
ALTER TABLE `item_pedido`
  MODIFY `cod_item_pedido` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `pedido`
--
ALTER TABLE `pedido`
  MODIFY `cod_pedido` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `recupera_senha`
--
ALTER TABLE `recupera_senha`
  MODIFY `cod_recupera_senha` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `sms`
--
ALTER TABLE `sms`
  MODIFY `cod_sms` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tipo_avaliacao`
--
ALTER TABLE `tipo_avaliacao`
  MODIFY `cod_tipo_avaliacao` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `usuario`
--
ALTER TABLE `usuario`
  MODIFY `cod_usuario` int(11) NOT NULL AUTO_INCREMENT;

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

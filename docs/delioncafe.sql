-- MySQL Script generated by MySQL Workbench
-- Tue Dec 10 16:43:54 2019
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema delioncafe
-- -----------------------------------------------------
DROP SCHEMA IF EXISTS `delioncafe` ;

-- -----------------------------------------------------
-- Schema delioncafe
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `delioncafe` DEFAULT CHARACTER SET utf8mb4 ;
USE `delioncafe` ;

-- -----------------------------------------------------
-- Table `delioncafe`.`tb_empresa`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `delioncafe`.`tb_empresa` ;

CREATE TABLE IF NOT EXISTS `delioncafe`.`tb_empresa` (
  `emp_pk_id` INT(11) NOT NULL AUTO_INCREMENT,
  `emp_nome` VARCHAR(255) NOT NULL,
  `emp_descricao` MEDIUMTEXT NOT NULL,
  `emp_historia` MEDIUMTEXT NOT NULL,
  `emp_endereco` VARCHAR(255) NOT NULL,
  `emp_bairro` VARCHAR(100) NOT NULL,
  `emp_cidade` VARCHAR(100) NOT NULL,
  `emp_estado` VARCHAR(30) NOT NULL,
  `emp_cep` VARCHAR(10) NOT NULL,
  `emp_fone` VARCHAR(20) NOT NULL,
  `emp_whats` VARCHAR(20) NOT NULL,
  `emp_email` VARCHAR(100) NOT NULL,
  `emp_facebook` VARCHAR(255) NOT NULL,
  `emp_instagram` VARCHAR(255) NOT NULL,
  `emp_pinterest` VARCHAR(255) NOT NULL,
  `emp_foto` VARCHAR(255) NOT NULL,
  `emp_txt_dias_semana` VARCHAR(30) NOT NULL,
  `emp_txt_horario_semana` VARCHAR(30) NOT NULL,
  `emp_txt_dias_fim_semana` VARCHAR(30) NOT NULL,
  `emp_txt_horario_fim_semana` VARCHAR(30) NOT NULL,
  `emp_arr_dias_semana` VARCHAR(50) NOT NULL,
  `emp_arr_horarios_inicio` VARCHAR(100) NOT NULL,
  `emp_arr_horarios_final` VARCHAR(100) NOT NULL,
  `emp_aberto` TINYINT(1) NOT NULL,
  `emp_entregando` TINYINT(1) NOT NULL,
  `emp_taxa_conversao_fidelidade` DECIMAL(2,1) NULL,
  PRIMARY KEY (`emp_pk_id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4;


-- -----------------------------------------------------
-- Table `delioncafe`.`tb_sms_verificacao`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `delioncafe`.`tb_sms_verificacao` ;

CREATE TABLE IF NOT EXISTS `delioncafe`.`tb_sms_verificacao` (
  `smve_pk_id` INT(11) NOT NULL AUTO_INCREMENT,
  `smve_telefone` VARCHAR(15) NOT NULL,
  `smve_codigo` MEDIUMINT(9) UNSIGNED NOT NULL,
  `smve_verificado` TINYINT(1) NOT NULL DEFAULT 0,
  `smve_fk_empresa` INT(11) NULL,
  PRIMARY KEY (`smve_pk_id`),
  INDEX `fk_tb_sms_verificacao_tb_empresa1_idx` (`smve_fk_empresa` ASC),
  CONSTRAINT `fk_tb_sms_verificacao_tb_empresa1`
    FOREIGN KEY (`smve_fk_empresa`)
    REFERENCES `delioncafe`.`tb_empresa` (`emp_pk_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4;
<<<<<<< HEAD


-- -----------------------------------------------------
-- Table `delioncafe`.`tb_categoria`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `delioncafe`.`tb_categoria` ;

CREATE TABLE IF NOT EXISTS `delioncafe`.`tb_categoria` (
  `cat_pk_id` INT(11) NOT NULL AUTO_INCREMENT,
  `cat_nome` VARCHAR(30) NOT NULL,
  `cat_icone` VARCHAR(255) NOT NULL,
  `cat_posicao` TINYINT(4) NOT NULL,
  `cat_fk_empresa` INT(11) NULL,
  PRIMARY KEY (`cat_pk_id`),
  INDEX `fk_tb_categoria_tb_empresa1_idx` (`cat_fk_empresa` ASC),
  CONSTRAINT `fk_tb_categoria_tb_empresa1`
    FOREIGN KEY (`cat_fk_empresa`)
    REFERENCES `delioncafe`.`tb_empresa` (`emp_pk_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4;


-- -----------------------------------------------------
-- Table `delioncafe`.`tb_faixa_horario`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `delioncafe`.`tb_faixa_horario` ;

CREATE TABLE IF NOT EXISTS `delioncafe`.`tb_faixa_horario` (
  `faho_pk_id` INT NOT NULL AUTO_INCREMENT,
  `faho_inicio` TIME NOT NULL,
  `faho_final` TIME NOT NULL,
  `faho_nome` VARCHAR(45) NULL,
  PRIMARY KEY (`faho_pk_id`))
ENGINE = InnoDB;
=======
>>>>>>> 3a5d54faf87fae46eaaa77bb2b24db309390b58b


-- -----------------------------------------------------
-- Table `delioncafe`.`tb_produto`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `delioncafe`.`tb_produto` ;

CREATE TABLE IF NOT EXISTS `delioncafe`.`tb_produto` (
  `pro_pk_id` INT(11) NOT NULL AUTO_INCREMENT,
  `pro_nome` VARCHAR(255) NOT NULL,
  `pro_preco` DECIMAL(6,2) NOT NULL,
  `pro_descricao` MEDIUMTEXT NOT NULL,
  `pro_foto` VARCHAR(255) NOT NULL,
  `pro_categoria` INT(11) NOT NULL,
  `pro_flag_ativo` TINYINT(1) NOT NULL,
  `pro_flag_servindo` TINYINT(1) NOT NULL,
  `pro_slug` VARCHAR(255) NOT NULL,
  `pro_posicao` SMALLINT(6) NOT NULL,
  `pro_flag_prioridade` TINYINT(1) NULL DEFAULT NULL,
  `pro_flag_delivery` TINYINT(1) NULL DEFAULT NULL,
  `pro_desconto` TINYINT(4) NULL DEFAULT NULL,
  `pro_arr_adicional` VARCHAR(50) NULL DEFAULT NULL,
  `pro_arr_dias_semana` VARCHAR(50) NULL DEFAULT NULL,
  `pro_fk_empresa` INT(11) NULL,
  `pro_fk_categoria` INT(11) NULL,
  `pro_fk_faixa_horario` INT(11) NULL,
  PRIMARY KEY (`pro_pk_id`),
  INDEX `fk_tb_cardapio_tb_empresa1_idx` (`pro_fk_empresa` ASC),
  INDEX `fk_tb_produto_tb_categoria1_idx` (`pro_fk_categoria` ASC),
  INDEX `fk_tb_produto_tb_faixa_horario1_idx` (`pro_fk_faixa_horario` ASC),
  CONSTRAINT `fk_tb_cardapio_tb_empresa1`
    FOREIGN KEY (`pro_fk_empresa`)
    REFERENCES `delioncafe`.`tb_empresa` (`emp_pk_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_tb_produto_tb_categoria1`
    FOREIGN KEY (`pro_fk_categoria`)
    REFERENCES `delioncafe`.`tb_categoria` (`cat_pk_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_tb_produto_tb_faixa_horario1`
    FOREIGN KEY (`pro_fk_faixa_horario`)
    REFERENCES `delioncafe`.`tb_faixa_horario` (`faho_pk_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4;


-- -----------------------------------------------------
-- Table `delioncafe`.`tb_adicional`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `delioncafe`.`tb_adicional` ;

CREATE TABLE IF NOT EXISTS `delioncafe`.`tb_adicional` (
  `adi_pk_id` INT(11) NOT NULL AUTO_INCREMENT,
  `adi_nome` VARCHAR(50) NOT NULL,
  `adi_preco` DECIMAL(5,2) NOT NULL,
  `adi_ck_desconto` TINYINT(4) NOT NULL DEFAULT 0,
  `adi_flag_ativo` TINYINT(1) NOT NULL DEFAULT 0,
  `adi_fk_empresa` INT(11) NULL,
<<<<<<< HEAD
  `adi_fk_produto` INT(11) NULL,
=======
>>>>>>> 3a5d54faf87fae46eaaa77bb2b24db309390b58b
  PRIMARY KEY (`adi_pk_id`),
  INDEX `fk_tb_adicional_tb_empresa1_idx` (`adi_fk_empresa` ASC),
  INDEX `fk_tb_adicional_tb_produto1_idx` (`adi_fk_produto` ASC),
  CONSTRAINT `fk_tb_adicional_tb_empresa1`
    FOREIGN KEY (`adi_fk_empresa`)
    REFERENCES `delioncafe`.`tb_empresa` (`emp_pk_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_tb_adicional_tb_produto1`
    FOREIGN KEY (`adi_fk_produto`)
    REFERENCES `delioncafe`.`tb_produto` (`pro_pk_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4;


-- -----------------------------------------------------
-- Table `delioncafe`.`tb_tipo_avaliacao`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `delioncafe`.`tb_tipo_avaliacao` ;

CREATE TABLE IF NOT EXISTS `delioncafe`.`tb_tipo_avaliacao` (
  `tiva_pk_id` INT(11) NOT NULL AUTO_INCREMENT,
  `tiva_nome` VARCHAR(50) NOT NULL,
  `tiva_flag_ativo` TINYINT(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`tiva_pk_id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4;


-- -----------------------------------------------------
-- Table `delioncafe`.`tb_avaliacao`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `delioncafe`.`tb_avaliacao` ;

CREATE TABLE IF NOT EXISTS `delioncafe`.`tb_avaliacao` (
  `ava_pk_id` INT(11) NOT NULL AUTO_INCREMENT,
  `ava_data_hora` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP(),
  `ava_nota` TINYINT(1) UNSIGNED NOT NULL,
  `ava_fk_tipo_avaliacao` INT(11) NOT NULL,
  `ava_fk_empresa` INT(11) NULL,
  PRIMARY KEY (`ava_pk_id`),
  INDEX `ava_fk_tipo_avaliacao` (`ava_fk_tipo_avaliacao` ASC),
  INDEX `fk_tb_avaliacao_tb_empresa1_idx` (`ava_fk_empresa` ASC),
  CONSTRAINT `tb_avaliacao_ibfk_1`
    FOREIGN KEY (`ava_fk_tipo_avaliacao`)
    REFERENCES `delioncafe`.`tb_tipo_avaliacao` (`tiva_pk_id`),
  CONSTRAINT `fk_tb_avaliacao_tb_empresa1`
    FOREIGN KEY (`ava_fk_empresa`)
    REFERENCES `delioncafe`.`tb_empresa` (`emp_pk_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4;


-- -----------------------------------------------------
-- Table `delioncafe`.`tb_banner`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `delioncafe`.`tb_banner` ;

CREATE TABLE IF NOT EXISTS `delioncafe`.`tb_banner` (
  `ban_pk_id` INT(11) NOT NULL AUTO_INCREMENT,
  `ban_nome` VARCHAR(255) NOT NULL,
  `ban_link` VARCHAR(255) NOT NULL,
  `ban_legenda` VARCHAR(100) NOT NULL,
  `ban_flag_tamanho` TINYINT(1) NOT NULL,
  `ban_foto` VARCHAR(255) NOT NULL,
  `ban_pagina` VARCHAR(255) NOT NULL,
  `ban_fk_empresa` INT(11) NULL,
  PRIMARY KEY (`ban_pk_id`),
  INDEX `fk_tb_banner_tb_empresa1_idx` (`ban_fk_empresa` ASC),
  CONSTRAINT `fk_tb_banner_tb_empresa1`
    FOREIGN KEY (`ban_fk_empresa`)
    REFERENCES `delioncafe`.`tb_empresa` (`emp_pk_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4;
<<<<<<< HEAD
=======


-- -----------------------------------------------------
-- Table `delioncafe`.`tb_categoria`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `delioncafe`.`tb_categoria` ;

CREATE TABLE IF NOT EXISTS `delioncafe`.`tb_categoria` (
  `cat_pk_id` INT(11) NOT NULL AUTO_INCREMENT,
  `cat_nome` VARCHAR(30) NOT NULL,
  `cat_icone` VARCHAR(255) NOT NULL,
  `cat_posicao` TINYINT(4) NOT NULL,
  `cat_fk_empresa` INT(11) NULL,
  PRIMARY KEY (`cat_pk_id`),
  INDEX `fk_tb_categoria_tb_empresa1_idx` (`cat_fk_empresa` ASC),
  CONSTRAINT `fk_tb_categoria_tb_empresa1`
    FOREIGN KEY (`cat_fk_empresa`)
    REFERENCES `delioncafe`.`tb_empresa` (`emp_pk_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4;


-- -----------------------------------------------------
-- Table `delioncafe`.`tb_faixa_horario`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `delioncafe`.`tb_faixa_horario` ;

CREATE TABLE IF NOT EXISTS `delioncafe`.`tb_faixa_horario` (
  `faho_pk_id` INT NOT NULL AUTO_INCREMENT,
  `faho_inicio` TIME NOT NULL,
  `faho_final` TIME NOT NULL,
  `faho_nome` VARCHAR(45) NULL,
  PRIMARY KEY (`faho_pk_id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `delioncafe`.`tb_produto`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `delioncafe`.`tb_produto` ;

CREATE TABLE IF NOT EXISTS `delioncafe`.`tb_produto` (
  `pro_pk_id` INT(11) NOT NULL AUTO_INCREMENT,
  `pro_nome` VARCHAR(255) NOT NULL,
  `pro_preco` DECIMAL(6,2) NOT NULL,
  `pro_descricao` MEDIUMTEXT NOT NULL,
  `pro_foto` VARCHAR(255) NOT NULL,
  `pro_categoria` INT(11) NOT NULL,
  `pro_flag_ativo` TINYINT(1) NOT NULL,
  `pro_flag_servindo` TINYINT(1) NOT NULL,
  `pro_slug` VARCHAR(255) NOT NULL,
  `pro_posicao` SMALLINT(6) NOT NULL,
  `pro_flag_prioridade` TINYINT(1) NULL DEFAULT NULL,
  `pro_flag_delivery` TINYINT(1) NULL DEFAULT NULL,
  `pro_desconto` TINYINT(4) NULL DEFAULT NULL,
  `pro_arr_adicional` VARCHAR(50) NULL DEFAULT NULL,
  `pro_arr_dias_semana` VARCHAR(50) NULL DEFAULT NULL,
  `pro_fk_empresa` INT(11) NULL,
  `pro_fk_categoria` INT(11) NULL,
  `pro_fk_faixa_horario` INT(11) NULL,
  PRIMARY KEY (`pro_pk_id`),
  INDEX `fk_tb_cardapio_tb_empresa1_idx` (`pro_fk_empresa` ASC),
  INDEX `fk_tb_produto_tb_categoria1_idx` (`pro_fk_categoria` ASC),
  INDEX `fk_tb_produto_tb_faixa_horario1_idx` (`pro_fk_faixa_horario` ASC),
  CONSTRAINT `fk_tb_cardapio_tb_empresa1`
    FOREIGN KEY (`pro_fk_empresa`)
    REFERENCES `delioncafe`.`tb_empresa` (`emp_pk_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_tb_produto_tb_categoria1`
    FOREIGN KEY (`pro_fk_categoria`)
    REFERENCES `delioncafe`.`tb_categoria` (`cat_pk_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_tb_produto_tb_faixa_horario1`
    FOREIGN KEY (`pro_fk_faixa_horario`)
    REFERENCES `delioncafe`.`tb_faixa_horario` (`faho_pk_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4;
>>>>>>> 3a5d54faf87fae46eaaa77bb2b24db309390b58b


-- -----------------------------------------------------
-- Table `delioncafe`.`tb_cliente`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `delioncafe`.`tb_cliente` ;

CREATE TABLE IF NOT EXISTS `delioncafe`.`tb_cliente` (
  `cli_pk_id` INT(11) NOT NULL AUTO_INCREMENT,
  `cli_cpf` BIGINT(11) UNSIGNED ZEROFILL NULL DEFAULT NULL,
  `cli_cpf_txt` VARCHAR(15) NULL DEFAULT NULL,
  `cli_nome` VARCHAR(30) NOT NULL,
  `cli_sobrenome` VARCHAR(30) NULL DEFAULT NULL,
  `cli_login_email` VARCHAR(60) NOT NULL,
  `cli_senha` VARCHAR(32) NULL DEFAULT NULL,
  `cli_telefone` VARCHAR(20) NULL DEFAULT NULL,
  `cli_data_nasc` DATE NULL DEFAULT NULL,
  `cli_status` TINYINT(1) NULL DEFAULT NULL,
  `cli_id_google` VARCHAR(32) NULL DEFAULT NULL,
  `cli_id_facebook` VARCHAR(255) NULL DEFAULT NULL,
  `cli_pontos_fidelidade` DECIMAL(5,2) NOT NULL,
  `cli_fk_empresa` INT(11) NULL,
  PRIMARY KEY (`cli_pk_id`),
  INDEX `fk_tb_cliente_tb_empresa1_idx` (`cli_fk_empresa` ASC),
  CONSTRAINT `fk_tb_cliente_tb_empresa1`
    FOREIGN KEY (`cli_fk_empresa`)
    REFERENCES `delioncafe`.`tb_empresa` (`emp_pk_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4;


-- -----------------------------------------------------
-- Table `delioncafe`.`tb_cupom`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `delioncafe`.`tb_cupom` ;

CREATE TABLE IF NOT EXISTS `delioncafe`.`tb_cupom` (
  `cup_pk_id` INT(11) NOT NULL AUTO_INCREMENT,
  `cup_codigo` VARCHAR(255) NOT NULL,
  `cup_qtde_inicial` MEDIUMINT(9) NOT NULL,
  `cup_valor` DECIMAL(6,2) NOT NULL,
  `cup_qtde_atual` INT(11) NOT NULL,
  `cup_vencimento_data` DATE NOT NULL,
  `cup_status` TINYINT(1) NOT NULL,
  `cup_vencimento_hora` TIME NOT NULL,
  `cup_valor_minimo` DECIMAL(6,2) NULL DEFAULT NULL,
  PRIMARY KEY (`cup_pk_id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4;


-- -----------------------------------------------------
-- Table `delioncafe`.`tb_cliente_cupom`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `delioncafe`.`tb_cliente_cupom` ;

CREATE TABLE IF NOT EXISTS `delioncafe`.`tb_cliente_cupom` (
  `clcu_pk_id` INT(11) NOT NULL AUTO_INCREMENT,
  `clcu_ultimo_uso` DATETIME NOT NULL,
  `clcu_fk_cliente` INT(11) NOT NULL,
  `clcu_fk_cupom` INT(11) NOT NULL,
  PRIMARY KEY (`clcu_pk_id`),
  INDEX `clcu_fk_cupom` (`clcu_fk_cupom` ASC),
  INDEX `clcu_fk_cliente` (`clcu_fk_cliente` ASC),
  CONSTRAINT `tb_cliente_cupom_ibfk_1`
    FOREIGN KEY (`clcu_fk_cupom`)
    REFERENCES `delioncafe`.`tb_cupom` (`cup_pk_id`),
  CONSTRAINT `tb_cliente_cupom_ibfk_2`
    FOREIGN KEY (`clcu_fk_cliente`)
    REFERENCES `delioncafe`.`tb_cliente` (`cli_pk_id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4;


-- -----------------------------------------------------
-- Table `delioncafe`.`tb_sms`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `delioncafe`.`tb_sms` ;

CREATE TABLE IF NOT EXISTS `delioncafe`.`tb_sms` (
  `sms_pk_id` INT(11) NOT NULL AUTO_INCREMENT,
  `sms_msg` VARCHAR(160) NOT NULL,
  `sms_descricao` VARCHAR(60) NOT NULL,
  `sms_data_envio` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP(),
  PRIMARY KEY (`sms_pk_id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4;


-- -----------------------------------------------------
-- Table `delioncafe`.`tb_cliente_sms`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `delioncafe`.`tb_cliente_sms` ;

CREATE TABLE IF NOT EXISTS `delioncafe`.`tb_cliente_sms` (
  `clsm_pk_id` INT(11) NOT NULL AUTO_INCREMENT,
  `clsm_fk_sms_mensagem` INT(11) NOT NULL,
  `clsm_fk_cliente` INT(11) NOT NULL,
  PRIMARY KEY (`clsm_pk_id`),
  INDEX `clsm_fk_sms_mensagem` (`clsm_fk_sms_mensagem` ASC),
  INDEX `clsm_fk_cliente` (`clsm_fk_cliente` ASC),
  CONSTRAINT `tb_cliente_sms_ibfk_1`
    FOREIGN KEY (`clsm_fk_sms_mensagem`)
    REFERENCES `delioncafe`.`tb_sms` (`sms_pk_id`),
  CONSTRAINT `tb_cliente_sms_ibfk_2`
    FOREIGN KEY (`clsm_fk_cliente`)
    REFERENCES `delioncafe`.`tb_cliente` (`cli_pk_id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4;


-- -----------------------------------------------------
-- Table `delioncafe`.`tb_pais`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `delioncafe`.`tb_pais` ;

CREATE TABLE IF NOT EXISTS `delioncafe`.`tb_pais` (
  `pa_pk_id` INT NOT NULL AUTO_INCREMENT,
  `pa_pais` VARCHAR(45) NOT NULL,
  `pa_sigla` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`pa_pk_id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `delioncafe`.`tb_estado`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `delioncafe`.`tb_estado` ;

CREATE TABLE IF NOT EXISTS `delioncafe`.`tb_estado` (
  `es_pk_id` INT NOT NULL AUTO_INCREMENT,
  `es_estado` VARCHAR(45) NOT NULL,
  `es_sigla` VARCHAR(45) NOT NULL,
  `es_fk_pais` INT(11) NOT NULL,
  PRIMARY KEY (`es_pk_id`),
  INDEX `fk_tb_estado_tb_pais1_idx` (`es_fk_pais` ASC),
  CONSTRAINT `fk_tb_estado_tb_pais1`
    FOREIGN KEY (`es_fk_pais`)
    REFERENCES `delioncafe`.`tb_pais` (`pa_pk_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `delioncafe`.`tb_cidade`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `delioncafe`.`tb_cidade` ;

CREATE TABLE IF NOT EXISTS `delioncafe`.`tb_cidade` (
  `ci_pk_id` INT(11) NOT NULL,
  `ci_cidade` VARCHAR(60) NOT NULL,
  `ci_fk_estado` INT(11) NOT NULL,
  PRIMARY KEY (`ci_pk_id`),
  INDEX `fk_tb_cidade_tb_estado1_idx` (`ci_fk_estado` ASC),
  CONSTRAINT `fk_tb_cidade_tb_estado1`
    FOREIGN KEY (`ci_fk_estado`)
    REFERENCES `delioncafe`.`tb_estado` (`es_pk_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `delioncafe`.`tb_endereco`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `delioncafe`.`tb_endereco` ;

CREATE TABLE IF NOT EXISTS `delioncafe`.`tb_endereco` (
  `end_pk_id` INT(11) NOT NULL AUTO_INCREMENT,
  `end_rua` VARCHAR(100) NOT NULL,
  `end_numero` INT(11) NOT NULL,
  `end_cep` VARCHAR(10) NOT NULL,
  `end_complemento` VARCHAR(255) NULL DEFAULT NULL,
  `end_bairro` VARCHAR(100) NULL DEFAULT NULL,
  `end_referencia` VARCHAR(100) NULL,
  `end_fk_cliente` INT(11) NULL DEFAULT NULL,
  `end_flag_cliente` TINYINT(1) NULL DEFAULT NULL,
  `end_fk_cidade` INT(11) NOT NULL,
  PRIMARY KEY (`end_pk_id`),
  INDEX `end_fk_cliente` (`end_fk_cliente` ASC),
  INDEX `fk_tb_endereco_tb_cidade1_idx` (`end_fk_cidade` ASC),
  CONSTRAINT `tb_endereco_ibfk_1`
    FOREIGN KEY (`end_fk_cliente`)
    REFERENCES `delioncafe`.`tb_cliente` (`cli_pk_id`),
  CONSTRAINT `fk_tb_endereco_tb_cidade1`
    FOREIGN KEY (`end_fk_cidade`)
    REFERENCES `delioncafe`.`tb_cidade` (`ci_pk_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4;


-- -----------------------------------------------------
-- Table `delioncafe`.`tb_entrega`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `delioncafe`.`tb_entrega` ;

CREATE TABLE IF NOT EXISTS `delioncafe`.`tb_entrega` (
  `ent_pk_id` INT(11) NOT NULL AUTO_INCREMENT,
  `ent_tempo` SMALLINT(6) NOT NULL,
  `ent_raio_km` TINYINT(4) NOT NULL,
  `ent_taxa_entrega` DECIMAL(6,2) NOT NULL,
  `ent_valor_minimo` DECIMAL(6,2) NOT NULL,
  `ent_min_taxa_gratis` DECIMAL(6,2) NULL DEFAULT NULL,
  `ent_flag_ativo` TINYINT(1) NOT NULL,
  `ent_fk_empresa` INT(11) NULL,
  PRIMARY KEY (`ent_pk_id`),
  INDEX `fk_tb_entrega_tb_empresa1_idx` (`ent_fk_empresa` ASC),
  CONSTRAINT `fk_tb_entrega_tb_empresa1`
    FOREIGN KEY (`ent_fk_empresa`)
    REFERENCES `delioncafe`.`tb_empresa` (`emp_pk_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4;


-- -----------------------------------------------------
-- Table `delioncafe`.`tb_evento`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `delioncafe`.`tb_evento` ;

CREATE TABLE IF NOT EXISTS `delioncafe`.`tb_evento` (
  `eve_pk_id` INT(11) NOT NULL AUTO_INCREMENT,
  `eve_nome` VARCHAR(255) NOT NULL,
  `eve_data` DATE NOT NULL,
  `eve_flag_antigo` TINYINT(1) NOT NULL,
  `eve_foto` VARCHAR(255) NOT NULL,
  `eve_fk_empresa` INT(11) NULL,
  PRIMARY KEY (`eve_pk_id`),
  INDEX `fk_tb_evento_tb_empresa1_idx` (`eve_fk_empresa` ASC),
  CONSTRAINT `fk_tb_evento_tb_empresa1`
    FOREIGN KEY (`eve_fk_empresa`)
    REFERENCES `delioncafe`.`tb_empresa` (`emp_pk_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `delioncafe`.`tb_forma_pgto`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `delioncafe`.`tb_forma_pgto` ;

CREATE TABLE IF NOT EXISTS `delioncafe`.`tb_forma_pgto` (
  `fopg_pk_id` INT(11) NOT NULL AUTO_INCREMENT,
  `fopg_nome` VARCHAR(60) NOT NULL,
  `fopg_flag_ativo` TINYINT(1) UNSIGNED NOT NULL,
  `fopg_fk_empresa` INT(11) NULL,
  PRIMARY KEY (`fopg_pk_id`),
  INDEX `fk_tb_forma_pgto_tb_empresa1_idx` (`fopg_fk_empresa` ASC),
  CONSTRAINT `fk_tb_forma_pgto_tb_empresa1`
    FOREIGN KEY (`fopg_fk_empresa`)
    REFERENCES `delioncafe`.`tb_empresa` (`emp_pk_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4;


-- -----------------------------------------------------
-- Table `delioncafe`.`tb_imagem`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `delioncafe`.`tb_imagem` ;

CREATE TABLE IF NOT EXISTS `delioncafe`.`tb_imagem` (
  `ima_pk_id` INT(11) NOT NULL AUTO_INCREMENT,
  `ima_nome` VARCHAR(255) NOT NULL,
  `ima_foto` VARCHAR(255) NOT NULL,
  `ima_pagina` VARCHAR(255) NOT NULL,
  `ima_fk_empresa` INT(11) NULL,
  PRIMARY KEY (`ima_pk_id`),
  INDEX `fk_tb_imagem_tb_empresa1_idx` (`ima_fk_empresa` ASC),
  CONSTRAINT `fk_tb_imagem_tb_empresa1`
    FOREIGN KEY (`ima_fk_empresa`)
    REFERENCES `delioncafe`.`tb_empresa` (`emp_pk_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4;


-- -----------------------------------------------------
-- Table `delioncafe`.`tb_origem_pedido`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `delioncafe`.`tb_origem_pedido` ;

CREATE TABLE IF NOT EXISTS `delioncafe`.`tb_origem_pedido` (
  `orpe_pk_id` INT NOT NULL AUTO_INCREMENT,
  `orpe_origem` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`orpe_pk_id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `delioncafe`.`tb_pedido`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `delioncafe`.`tb_pedido` ;

CREATE TABLE IF NOT EXISTS `delioncafe`.`tb_pedido` (
  `ped_pk_id` INT(11) NOT NULL AUTO_INCREMENT,
  `ped_data` DATETIME NOT NULL,
  `ped_valor` DECIMAL(6,2) NOT NULL,
  `ped_taxa_entrega` DECIMAL(6,2) NOT NULL,
  `ped_subtotal` DECIMAL(6,2) NOT NULL,
  `ped_operacao_fidelidade` DECIMAL(5,2) NULL,
  `ped_desconto` DECIMAL(6,2) NOT NULL,
  `ped_forma_pgto` INT(11) NOT NULL,
  `ped_status` TINYINT(4) NOT NULL,
  `ped_hora_print` TIME NOT NULL,
  `ped_hora_delivery` TIME NOT NULL,
  `ped_hora_retirada` TIME NOT NULL,
  `ped_endereco` INT(11) NULL DEFAULT NULL,
  `ped_tempo_entrega` SMALLINT(6) NULL DEFAULT NULL,
  `ped_fk_empresa` INT(11) NULL,
  `ped_fk_cliente` INT(11) NOT NULL,
  `ped_fk_origem_pedido` INT(11) NOT NULL,
  PRIMARY KEY (`ped_pk_id`),
  INDEX `fk_tb_pedido_tb_empresa1_idx` (`ped_fk_empresa` ASC),
  INDEX `fk_tb_pedido_tb_cliente1_idx` (`ped_fk_cliente` ASC),
  INDEX `fk_tb_pedido_tb_origem_pedido1_idx` (`ped_fk_origem_pedido` ASC),
  CONSTRAINT `fk_tb_pedido_tb_empresa1`
    FOREIGN KEY (`ped_fk_empresa`)
    REFERENCES `delioncafe`.`tb_empresa` (`emp_pk_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_tb_pedido_tb_cliente1`
    FOREIGN KEY (`ped_fk_cliente`)
    REFERENCES `delioncafe`.`tb_cliente` (`cli_pk_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_tb_pedido_tb_origem_pedido1`
    FOREIGN KEY (`ped_fk_origem_pedido`)
    REFERENCES `delioncafe`.`tb_origem_pedido` (`orpe_pk_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4;


-- -----------------------------------------------------
-- Table `delioncafe`.`tb_recupera_senha`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `delioncafe`.`tb_recupera_senha` ;

CREATE TABLE IF NOT EXISTS `delioncafe`.`tb_recupera_senha` (
  `res_pk_id` INT(11) NOT NULL AUTO_INCREMENT,
  `res_cod_recuperacao` VARCHAR(20) NOT NULL,
  `res_recuperado` TINYINT(1) NOT NULL DEFAULT 0,
  `res_data_expiracao` DATETIME NOT NULL,
  `res_fk_cliente` INT(11) NOT NULL,
  PRIMARY KEY (`res_pk_id`),
  INDEX `res_fk_cliente` (`res_fk_cliente` ASC),
  CONSTRAINT `tb_recupera_senha_ibfk_1`
    FOREIGN KEY (`res_fk_cliente`)
    REFERENCES `delioncafe`.`tb_cliente` (`cli_pk_id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4;


-- -----------------------------------------------------
-- Table `delioncafe`.`tb_usuario`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `delioncafe`.`tb_usuario` ;

CREATE TABLE IF NOT EXISTS `delioncafe`.`tb_usuario` (
  `usu_pk_id` INT(11) NOT NULL AUTO_INCREMENT,
  `usu_nome` VARCHAR(60) NOT NULL,
  `usu_login` VARCHAR(60) NOT NULL,
  `usu_senha` VARCHAR(32) NOT NULL,
  `usu_email` VARCHAR(100) NOT NULL,
  `usu_flag_bloqueado` TINYINT(1) NOT NULL,
  `usu_cod_perfil` TINYINT(4) NOT NULL,
  `usu_permissao` MEDIUMTEXT NOT NULL,
  `usu_fk_empresa` INT(11) NULL,
  PRIMARY KEY (`usu_pk_id`),
  INDEX `fk_tb_usuario_tb_empresa1_idx` (`usu_fk_empresa` ASC),
  CONSTRAINT `fk_tb_usuario_tb_empresa1`
    FOREIGN KEY (`usu_fk_empresa`)
    REFERENCES `delioncafe`.`tb_empresa` (`emp_pk_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4;


-- -----------------------------------------------------
-- Table `delioncafe`.`tb_pedido_produto`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `delioncafe`.`tb_pedido_produto` ;

CREATE TABLE IF NOT EXISTS `delioncafe`.`tb_pedido_produto` (
  `pepr_fk_produto` INT(11) NOT NULL,
  `pepr_fk_pedido` INT(11) NOT NULL,
  `pepr_quantidade` TINYINT(4) NOT NULL,
  `pepr_observacao` VARCHAR(255) NOT NULL,
  INDEX `fk_tb_produto_has_tb_pedido_tb_pedido1_idx` (`pepr_fk_pedido` ASC),
  INDEX `fk_tb_produto_has_tb_pedido_tb_produto1_idx` (`pepr_fk_produto` ASC),
  PRIMARY KEY (`pepr_fk_produto`, `pepr_fk_pedido`),
  CONSTRAINT `fk_tb_produto_has_tb_pedido_tb_produto1`
    FOREIGN KEY (`pepr_fk_produto`)
    REFERENCES `delioncafe`.`tb_produto` (`pro_pk_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_tb_produto_has_tb_pedido_tb_pedido1`
    FOREIGN KEY (`pepr_fk_pedido`)
    REFERENCES `delioncafe`.`tb_pedido` (`ped_pk_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

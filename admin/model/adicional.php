<?php

    class adicional{

        private $adi_pk_id;

        private $adi_nome;

        private $adi_preco;

        private $adi_ck_desconto;

        private $adi_flag_ativo;

        function getPkId(){
            return $this->adi_pk_id;
        }

        function getNome(){
            return $this->adi_nome;
        }

        function getPreco(){
            return $this->adi_preco;
        }

        function getDesconto(){
            return $this->adi_ck_desconto;
        }

        function getFlag_ativo(){
            return $this->adi_flag_ativo;
        }

        function setPkId($adi_pk_id){
            $this->adi_pk_id = $adi_pk_id;
        }

        function setNome($adi_nome){
            $this->adi_nome = $adi_nome;
        }

        function setPreco($adi_preco){
            $this->adi_preco = $adi_preco;
        }

        function setDesconto($adi_ck_desconto){
            $this->adi_ck_desconto = $adi_ck_desconto;
        }

        function setFlag_ativo($adi_flag_ativo){
            $this->adi_flag_ativo = $adi_flag_ativo;
        }

        function __construct(){}

        function construct($adi_nome, $adi_preco, $adi_ck_desconto, $adi_flag_ativo){
            $this->adi_nome = $adi_nome;
            $this->adi_preco = $adi_preco;
            $this->adi_ck_desconto = $adi_ck_desconto;
            $this->adi_flag_ativo = $adi_flag_ativo;
        }
    }

?>
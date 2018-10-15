<?php

    class adicional{

        private $cod_adicional;

        private $nome;

        private $preco;

        private $desconto;

        private $flag_ativo;

        function getCod_adicional(){
            return $this->cod_adicional;
        }

        function getNome(){
            return $this->nome;
        }

        function getPreco(){
            return $this->preco;
        }

        function getDesconto(){
            return $this->desconto;
        }

        function getFlag_ativo(){
            return $this->flag_ativo;
        }

        function setCod_adicional($cod_adicional){
            $this->cod_adicional = $cod_adicional;
        }

        function setNome($nome){
            $this->nome = $nome;
        }

        function setPreco($preco){
            $this->preco = $preco;
        }

        function setDesconto($desconto){
            $this->desconto = $desconto;
        }

        function setFlag_ativo($flag_ativo){
            $this->flag_ativo = $flag_ativo;
        }

        function __construct(){}

        function construct($nome, $preco, $desconto, $flag_ativo){
            $this->nome = $nome;
            $this->preco = $preco;
            $this->desconto = $desconto;
            $this->flag_ativo = $flag_ativo;
        }
    }

?>
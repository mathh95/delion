<?php

    class adicional{

        private $cod_adicional;

        private $nome;

        private $preco;

        private $desconto;

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

        function __construct(){}

        function construct($nome, $preco, $desconto){
            $this->nome = $nome;
            $this->preco = $preco;
            $this->desconto = $desconto;
        }
    }

?>
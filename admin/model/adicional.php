<?php

    class adicional{

        private $adi_pk_id;

        private $adi_nome;

        private $adi_preco;

        private $adi_flag_ativo;

        private $adi_fk_categoria;

        function getPkId(){
            return $this->adi_pk_id;
        }

        function getNome(){
            return $this->adi_nome;
        }

        function getPreco(){
            return $this->adi_preco;
        }

        function getFlag_ativo(){
            return $this->adi_flag_ativo;
        }

        function getFkCategoria(){
            return $this->adi_fk_categoria;
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

        function setFlag_ativo($adi_flag_ativo){
            $this->adi_flag_ativo = $adi_flag_ativo;
        }

        function setFkCategoria($adi_fk_categoria){
            $this->adi_fk_categoria = $adi_fk_categoria;
        }

        function __construct(){}

        function construct($adi_nome, $adi_preco, $adi_flag_ativo,$adi_fk_categoria){
            $this->adi_nome = $adi_nome;
            $this->adi_preco = $adi_preco;
            $this->adi_flag_ativo = $adi_flag_ativo;
            $this->adi_fk_categoria = $adi_fk_categoria;
        }

        function show(){
            echo "Código do adicional:".$this->adi_pk_id."<br>";
            echo "Nome:".$this->adi_nome."<br>";
            echo "Categoria ID:".$this->adi_fk_categoria."<br>";
        }

    }

?>
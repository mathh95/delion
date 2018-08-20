<?php
/**
 *Classe de definição de cardapio
 */
    class cardapio {

        private $cod_cardapio;
        private $nome;
        private $descricao;
        private $foto;
        private $categoria;
        private $flag_ativo;


        function getCod_cardapio(){
            return $this->cod_cardapio;
        }
        function getNome(){
            return $this->nome;
        }
        function getDescricao(){
            return $this->descricao;
        }
        function getFotoAbsoluto(){
            return $this->foto;
        }
        function getFoto(){
            $pos = strpos($this->foto, "upload");
            return substr($this->foto, $pos);
        }
        function getCategoria(){
            return $this->categoria;
        }
        function getFlag_ativo(){
            return $this->flag_ativo;
        }

        function setCod_cardapio($cod_cardapio){
            $this->cod_cardapio=$cod_cardapio;
        }
        function setNome($nome){
            $this->nome=$nome;
        }
        function setDescricao($descricao){
            $this->descricao=$descricao;
        }
        function setFoto($foto){
            $this->foto=$foto;
        }
        function setCategoria($categoria){
            $this->categoria=$categoria;
        }
        function setFlag_ativo($flag_ativo){
            $this->flag_ativo=$flag_ativo;
        }

        function getDsAtivo(){
            $ativo = ($this->flag_ativo == 1) ? "Ativo" : "Não ativo" ;
            return $ativo;
        }

        function __construct(){
        }
        function construct($nome,$descricao,$foto,$categoria,$flag_ativo){
            $this->nome=$nome;
            $this->descricao=$descricao;
            $this->foto=$foto;
            $this->categoria=$categoria;
            $this->flag_ativo=$flag_ativo;
        }
        function show(){
            echo "Código do cardapio:".$this->cod_cardapio."<br>";
            echo "Nome:".$this->nome."<br>";
            echo "Descricao:".$this->descricao."<br>";
            echo "Foto:".$this->foto."<br>";
            echo "Categoria:".$this->categoria."<br>";
            echo "Ativo:".$this->flag_ativo."<br>";

        }
    }
?>
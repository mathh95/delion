<?php
/**
 *Classe de definição de categoria
 */
    class categoria {

        private $cat_pk_id;
        private $cat_nome;
        private $cat_icone;
        private $cat_posicao;


        function getPkId(){
            return $this->cat_pk_id;
        }
        function getNome(){
            return $this->cat_nome;
        }
        function getIconeAbsoluto(){
            return $this->cat_icone;
        }
        function getIcone(){
            $pos = strpos($this->cat_icone, "upload");
            return substr($this->cat_icone, $pos);
        }
        function getPosicao(){
            return $this->cat_posicao;
        }

        function setPkId($cat_pk_id){
            $this->cat_pk_id=$cat_pk_id;
        }
        function setNome($cat_nome){
            $this->cat_nome=$cat_nome;
        }
        function setIcone($cat_icone){
            $this->cat_icone=$cat_icone;
        }
        function setPosicao($cat_posicao){
            $this->cat_posicao=$cat_posicao;
        }

        function __construct(){
        }
        function construct($cat_nome, $cat_icone){
            $this->cat_nome=$cat_nome;
            $this->cat_icone=$cat_icone;
        }
        function show(){
            echo "Código do categoria:".$this->cat_pk_id."<br>";
            echo "Nome:".$this->cat_nome."<br>";
            echo "Ícone:".$this->cat_icone."<br>";
        }
    }
?>
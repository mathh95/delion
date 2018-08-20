<?php
/**
 *Classe de definição de categoria
 */
    class categoria {

        private $cod_categoria;
        private $nome;
        private $icone;


        function getCod_categoria(){
            return $this->cod_categoria;
        }
        function getNome(){
            return $this->nome;
        }
        function getIconeAbsoluto(){
            return $this->icone;
        }
        function getIcone(){
            $pos = strpos($this->icone, "upload");
            return substr($this->icone, $pos);
        }

        function setCod_categoria($cod_categoria){
            $this->cod_categoria=$cod_categoria;
        }
        function setNome($nome){
            $this->nome=$nome;
        }
        function setIcone($icone){
            $this->icone=$icone;
        }

        function __construct(){
        }
        function construct($nome, $icone){
            $this->nome=$nome;
            $this->icone=$icone;
        }
        function show(){
            echo "Código do categoria:".$this->cod_categoria."<br>";
            echo "Nome:".$this->nome."<br>";
            echo "Ícone:".$this->icone."<br>";
        }
    }
?>
<?php

/**
 * Classe de definição para o item que compõe o produto
 */

    class ingrediente {

        private $igr_pk_id;
        private $igr_nome;
        private $igr_unidade;
        private $igr_valor;

        function getPkId(){
            return $this->igr_pk_id;
        }

        function getNome(){
            return $this->igr_nome;
        }

        function getUnidade(){
            return $this->igr_unidade;
        }

        function getValor(){
            return $this->igr_valor;
        }

        function setPkId($igr_pk_id){
            $this->igr_pk_id=$igr_pk_id;
        }

        function setNome($igr_nome){
            $this->igr_nome=$igr_nome;
        }

        function setUnidade($igr_unidade){
            $this->igr_unidade=$igr_unidade;
        }

        function setValor($igr_valor){
            $this->igr_valor=$igr_valor;
        }


        function __construct(){
            
        }

        function construct($igr_nome, $igr_unidade, $igr_valor){   
            $this->igr_nome=$igr_nome;
            $this->igr_unidade=$igr_unidade;
            $this->igr_valor=$igr_valor;
        }

        function show(){
            echo "Código do Item Composição: ".$this->igr_pk_id."<br>";
            echo "Nome: ".$this->igr_nome."<br>";
            echo "Unidade: ".$this->igr_unidade."<br>";
            echo "Valor: ".$this->igr_valor."<br>";
        }


    }

?>
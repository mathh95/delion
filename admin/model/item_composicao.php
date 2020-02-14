<?php

/**
 * Classe de definição para o item que compõe o produto
 */

    class item_composicao {

        private $itco_pk_id;
        private $itco_nome;
        private $itco_unidade;
        private $itco_valor;
        private $itco_qtd;

        function getPkId(){
            return $this->itco_pk_id;
        }

        function getNome(){
            return $this->itco_nome;
        }

        function getUnidade(){
            return $this->itco_unidade;
        }

        function getValor(){
            return $this->itco_valor;
        }

        function getQtd(){
            return $this->itco_qtd;
        }


        function setPkId($itco_pk_id){
            $this->itco_pk_id=$itco_pk_id;
        }

        function setNome($itco_nome){
            $this->itco_nome=$itco_nome;
        }

        function setUnidade($itco_unidade){
            $this->itco_unidade=$itco_unidade;
        }

        function setValor($itco_valor){
            $this->itco_valor=$itco_valor;
        }

        function setQtd($itco_qtd){
            $this->itco_qtd=$itco_qtd;
        }


        function __construct(){
            
        }

        function construct($itco_nome, $itco_unidade, $itco_valor, $itco_qtd){   
            $this->itco_nome=$itco_nome;
            $this->itco_unidade=$itco_unidade;
            $this->itco_valor=$itco_valor;
            $this->itco_qtd=$itco_qtd;
        }

        function show(){
            echo "Código do Item Composição: ".$this->itco_pk_id."<br>";
            echo "Nome: ".$this->itco_nome."<br>";
            echo "Unidade: ".$this->itco_unidade."<br>";
            echo "Valor: ".$this->itco_valor."<br>";
            echo "Quantidade: ".$this->itco_qtd."<br>";
        }


    }

?>
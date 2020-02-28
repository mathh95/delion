<?php

    /**
     * Classe de definição da composição
     */

     class composicao {

        private $com_pk_id;
        private $com_fk_produto;
        private $com_valor_extra;

        function getPkId(){
            return $this->com_pk_id;
        }

        function getFkProduto(){
            return $this->com_fk_produto;
        }

        function getValorExtra(){
            return $this->com_valor_extra;
        }

        function setPkId($com_pk_id){
            $this->com_pk_id=$com_pk_id;
        }

        function setFkProduto($com_fk_produto){
            $this->com_fk_produto=$com_fk_produto;
        }

        function setValorExtra($com_valor_extra){
            $this->com_valor_extra=$com_valor_extra;
        }


        function contruct($com_fk_produto, $com_valor_extra){
            $this->com_fk_produto=$com_fk_produto;
            $this->com_valor_extra=$com_valor_extra;
        }

        function __construct(){
            
        }

        function show(){
            echo "Código da Composição: ".$this->com_pk_id."<br>";
            echo "Codigo Produto: ".$this->com_fk_produto."<br>";
            echo "Valor Extra: ".$this->com_valor_extra."<br>";
        }

     }

?>
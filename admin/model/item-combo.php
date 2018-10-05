<?php

    /**
     * Classe de definição de item
     */

        class itemCombo{
            
            private $cod_item_combo;
            
            private $cod_produto;
            
            private $cod_combo;
            
            private $quantidade;
            
            function getCod_item_combo(){
                return $this->getCod_item_combo;
            }

            function getCod_produto(){
                return $this->cod_produto;
            }

            function getCod_combo(){
                return $this->cod_combo;
            }

            function getQuantidade(){
                return $this->quantidade;
            }

            function setCod_item_combo($cod_item_combo){
                $this->cod_item_combo=$cod_item_combo;
            }

            function setProduto($cod_combo){
                $this->cod_produto=$cod_produto;
            }

            function setPedido($cod_combo){
                $this->cod_combo=$cod_combo;
            }

            function setQuantidade($quantidade){
                $this->quantidade=$quantidade;
            }

            function __construct(){

            }

            function construct($cod_item_combo,$cod_produto,$cod_combo,$quantidade){
                $this->cod_item_combo=$cod_item_combo;
                $this->cod_produto=$cod_produto;
                $this->cod_combo=$cod_combo;
                $this->quantidade=$quantidade;
            }

            function show(){
                echo "Código do Item: ".$this->cod_item_combo."<br>";
                echo "Produto: ".$this->cod_produto."<br>";
                echo "Combo: ".$this->cod_combo."<br>";
                echo "Quantidade: ".$this->quantidade."<br>";
            }
        }
?>
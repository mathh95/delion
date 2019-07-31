<?php

    /**
     * Classe de definição de item
     */

        class item{
            
            private $cod_item;
            
            private $produto;
            
            private $pedido_wpp;
            
            private $quantidade;
            
            function getCod_item(){
                return $this->cod_item;
            }

            function getProduto(){
                return $this->produto;
            }

            function getPedido_wpp(){
                return $this->pedido_wpp;
            }

            function getQuantidade(){
                return $this->quantidade;
            }

            function setCod_item($cod_item){
                $this->cod_item=$cod_item;
            }

            function setProduto($produto){
                $this->produto=$produto;
            }

            function setPedido_wpp($pedido_wpp){
                $this->pedido_wpp=$pedido_wpp;
            }

            function setQuantidade($quantidade){
                $this->quantidade=$quantidade;
            }

            function __construct(){

            }

            function construct($cod_item,$produto,$pedido_wpp,$quantidade){
                $this->cod_item=$cod_item;
                $this->produto=$produto;
                $this->pedido_wpp=$pedido_wpp;
                $this->quantidade=$quantidade;
            }

            function show(){
                echo "Código do Item: ".$this->cod_item."<br>";
                echo "Produto: ".$this->produto."<br>";
                echo "Pedido: ".$this->pedido_wpp."<br>";
                echo "Quantidade: ".$this->quantidade."<br>";
            }
        }
?>
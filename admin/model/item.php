<?php

    /**
     * Classe de definição de item
     */

        class item{
            
            private $cod_item;
            
            private $produto;
            
            private $pedido;
            
            private $quantidade;
            
            function getCod_item(){
                return $this->cod_item;
            }

            function getProduto(){
                return $this->produto;
            }

            function getPedido(){
                return $this->pedido;
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

            function setPedido($pedido){
                $this->pedido=$pedido;
            }

            function setQuantidade($quantidade){
                $this->quantidade=$quantidade;
            }

            function __construct(){

            }

            function construct($cod_item,$produto,$pedido,$quantidade){
                $this->cod_item=$cod_item;
                $this->produto=$produto;
                $this->pedido=$pedido;
                $this->quantidade=$quantidade;
            }

            function show(){
                echo "Código do Item: ".$this->cod_item."<br>";
                echo "Produto: ".$this->produto."<br>";
                echo "Pedido: ".$this->pedido."<br>";
                echo "Quantidade: ".$this->quantidade."<br>";
            }
        }
?>
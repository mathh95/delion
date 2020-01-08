<?php

    /**
     * Classe de definição de item
     */

        class pedido_produto{
                        
            private $pepr_pk_id;

            private $pepr_fk_produto;
            
            private $pepr_fk_pedido;
            
            private $pepr_quantidade;

            private $pepr_observacao;

            private $pepr_preco;
            

            function getPkId(){
                return $this->pepr_pk_id;
            }

            function getFkProduto(){
                return $this->pepr_fk_produto;
            }

            function getFkPedido(){
                return $this->pepr_fk_pedido;
            }

            function getQuantidade(){
                return $this->pepr_quantidade;
            }

            function getObservacao(){
                return $this->pepr_observacao;
            }

            function getPreco(){
                return $this->pepr_preco;
            }



            function setPkId($pepr_pk_id){
                $this->pepr_pk_id=$pepr_pk_id;
            }

            function setFkProduto($pepr_fk_produto){
                $this->pepr_fk_produto=$pepr_fk_produto;
            }

            function setFkPedido($pepr_fk_pedido){
                $this->pepr_pedido=$pepr_fk_pedido;
            }

            function setQuantidade($pepr_quantidade){
                $this->pepr_quantidade=$pepr_quantidade;
            }

            function setObservacao($pepr_observacao){
                $this->pepr_observacao=$pepr_observacao;
            }

            function setPreco($pepr_preco){
                $this->pepr_preco=$pepr_preco;
            }

            function __construct(){

            }

            function construct($pepr_fk_produto,$pepr_fk_pedido,$pepr_quantidade){
                $this->produto=$pepr_fk_produto;
                $this->pedido=$pepr_fk_pedido;
                $this->quantidade=$pepr_quantidade;
            }

            function show(){
                echo "Código do Item: ".$this->cod_item."<br>";
                echo "Produto: ".$this->produto."<br>";
                echo "Pedido: ".$this->pedido."<br>";
                echo "Quantidade: ".$this->quantidade."<br>";
            }
        }
?>
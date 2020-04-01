<?php

    /**
     * Classe de definição do pedido para o fornecedor
     */

    class pedido_fornecedor{

        private $pefo_pk_id;

        private $pefo_valor;

        private $pefo_forma_pgt;

        private $pefo_desc;

        private $pefo_dt_pedido;

        private $pefo_fk_fornecedor;

        


        function getPkId(){
            return $this->pefo_pk_id;
        }

        function getValor(){
            return $this->pefo_valor;
        }

        function getFormaPgt(){
            return $this->pefo_forma_pgt;
        }

        function getDesc(){
            return $this->pefo_desc;
        }

        function getDtPedido(){
            return $this->pefo_dt_pedido;
        }

        function getFkFornecedor(){
            return $this->pefo_fk_fornecedor;
        }

        
        function setPkId($pefo_pk_id){
            $this->pefo_pk_id=$pefo_pk_id;
        }

        function setValor($pefo_valor){
            $this->pefo_valor=$pefo_valor;
        }

        function setFormaPgt($pefo_forma_pgt){
            $this->pefo_forma_pgt=$pefo_forma_pgt;
        }

        function setDesc($pefo_desc){
            $this->pefo_desc=$pefo_desc;
        }

        function setDtPedido($pefo_dt_pedido){
            $this->pefo_dt_pedido=$pefo_dt_pedido;
        }

        function setFkFornecedor($pefo_fk_fornecedor){
            $this->pefo_fk_fornecedor=$pefo_fk_fornecedor;
        }

        function __construct(){
            
        }

        function construct($pefo_valor, $pefo_forma_pgt, $pefo_desc, $pefo_dt_pedido, $pefo_fk_fornecedor){
            $this->pefo_valor=$pefo_valor;
            $this->pefo_forma_pgt=$pefo_forma_pgt;
            $this->pefo_desc=$pefo_desc;
            $this->pefo_dt_pedido=$pefo_dt_pedido;
            $this->pefo_fk_fornecedor=$pefo_fk_fornecedor;
        }

        function show(){
            echo "Código do Pedido: ".$this->pefo_pk_id."<br>";
            echo "Valor: ".$this->pefo_valor."<br>";
            echo "Forma Pagamento: ".$this->pefo_forma_pgt."<br>";
            echo "Descrição: ".$this->pefo_desc."<br>";
            echo "Data Pedido: ".$this->pefo_dt_pedido."<br>";
        }


    }



?>
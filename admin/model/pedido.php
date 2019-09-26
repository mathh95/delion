<?php 
    /**
     *  Classe de definição de pedido
     */
        class pedido{

            private $cod_pedido;

            private $cliente;

            private $data;

            private $valor;

            private $status;

            private $formaPgt;

            private $origem;

            function getCod_pedido(){
                return $this->cod_pedido;
            }

            function getCliente(){
                return $this->cliente;
            }
            
            function getData(){
                return $this->data;
            }

            function getValor(){
                return $this->valor;
            }

            function getStatus(){
                return $this->status;
            }

            function getFormaPgt(){
                return $this->formaPgt;
            }

            function getOrigem(){
                return $this->origem;
            }

            function setCod_pedido($cod_pedido){
                $this->cod_pedido=$cod_pedido;
            }

            function setCliente($cliente){
                $this->cliente=$cliente;
            }

            function setData($data){
                $this->data=$data;
            }
            
            function setValor($valor){
                $this->valor=$valor;
            }

            function setStatus($status){
                $this->status=$status;
            }

            function setFormaPgt($formaPgt){
                $this->formaPgt=$formaPgt;
            }

            function setOrigem($origem){
                $this->origem=$origem;
            }

            function __construct(){

            }

            function construct($cod_pedido,$cliente,$data,$valor,$status,$formaPgt,$origem){
                $this->cod_pedido=$cod_pedido;
                $this->cliente=$cliente;
                $this->data=$data;
                $this->valor=$valor;
                $this->status=$status;
                $this->formaPgt=$formaPgt;
                $this->origem=$origem;
            }

            function show(){
                echo "Código do Pedido: ".$this->cod_pedido."<br>";
                echo "Cliente: ".$this->cliente."<br>";
                echo "Data: ".$this->data."<br>";
                echo "Valor: ".$this->valor."<br>";
                echo "Status: ".$this->status."<br>";
                echo "FormaPgt: ".$this->status."<br>";
                echo "Origem: ".$this->origem."<br>";
            }
        }
?>
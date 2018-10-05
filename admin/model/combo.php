<?php 
    /**
     *  Classe de definição de pedido
     */
        class pedido{

            private $cod_combo;

            private $cliente;

            private $data;

            private $valor;

            private $status;

            function getCod_pedido(){
                return $this->cod_combo;
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

            function setCod_pedido($cod_combo){
                $this->cod_combo=$cod_combo;
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

            function __construct(){

            }

            function construct($cod_combo,$cliente,$data,$valor,$status){
                $this->cod_combo=$cod_combo;
                $this->cliente=$cliente;
                $this->data=$data;
                $this->valor=$valor;
                $this->status=$status;
            }

            function show(){
                echo "Código do Combo: ".$this->cod_combo."<br>";
                echo "Cliente: ".$this->cliente."<br>";
                echo "Data: ".$this->data."<br>";
                echo "Valor: ".$this->valor."<br>";
                echo "Status: ".$this->status."<br>";
            }
        }
?>
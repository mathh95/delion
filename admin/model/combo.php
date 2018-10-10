<?php 
    /**
     *  Classe de definição de pedido
     */
        class combo{

            private $cod_combo;

            private $cliente;

            private $data;

            private $hora;

            private $valor;

            function getCod_combo(){
                return $this->cod_combo;
            }

            function getCliente(){
                return $this->cliente;
            }
            
            function getData(){
                return $this->data;
            }

            function getHora(){
                return $this->hora;
            }

            function getValor(){
                return $this->valor;
            }

            function setCod_combo($cod_combo){
                $this->cod_combo=$cod_combo;
            }

            function setCliente($cliente){
                $this->cliente=$cliente;
            }

            function setData($data){
                $this->data=$data;
            }

            function setHora($hora){
                $this->hora = $hora;
            }
            
            function setValor($valor){
                $this->valor=$valor;
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
        }
?>
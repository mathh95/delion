<?php
/**
 * Classe de definição do pedido unificado
 */

        class pedido_unificado{

            private $cod_pedido;
            private $cliente;
            private $data;
            private $valor;
            private $forma_pgt;
            private $status;
            private $origem;
            private $hora_print;
            private $hora_delivery;
            private $hora_retirada;

            /**
             * GET'S and SET'S
             */

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

            function getForma_pgt(){
                return $this->forma_pgt;
            }

            function getStatus(){
                return $this->status;
            }

            function getOrigem(){
                return $this->origem;
            }

            function getHora_print(){
                return $this->hora_print;
            }

            function getHora_delivery(){
                return $this->hora_delivery;
            }

            function getHora_retirada(){
                return $this->hora_retirada;
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

            function setForma_pgt($forma_pgt){
                $this->forma_pgt=$forma_pgt;
            }

            function setStatus($status){
                $this->status=$status;
            }

            function setOrigem($origem){
                $this->origem=$origem;
            }

            function setHora_print($hora_print){
                $this->hora_print=$hora_print;
            }

            function setHora_delivery($hora_delivery){
                $this->hora_delivery=$hora_delivery;
            }

            function setHora_retirada($hora_retirada){
                $this->hora_retirada=$hora_retirada;
            }

            function __construct(){
                
            }

            function construct($cod_pedido,$cliente,$data,$valor,$forma_pgt,$status,$origem,$hora_print,$hora_delivery,$hora_retirada){
                $this->cod_pedido=$cod_pedido;
                $this->cliente=$cliente;
                $this->data=$data;
                $this->valor=$valor;
                $this->forma_pgt=$forma_pgt;
                $this->status=$status;
                $this->origem=$origem;
                $this->hora_print=$hora_print;
                $this->hora_delivery=$hora_delivery;
                $this->hora_retirada=$hora_retirada;
            }

            function show(){
                echo "Código do Pedido".$this->cod_pedido."<br>";
                echo "Cliente".$this->cliente."<br>";
                echo "Data".$this->data."<br>";
                echo "Valor".$this->valor."<br>";
                echo "Forma de Pagamento".$this->forma_pgt."<br>";
                echo "Status".$this->status."<br>";
                echo "Origem".$this->origem."<br>";
                echo "Hora Impressão".$this->hora_print."<br>";
                echo "Hora Delivery".$this->hora_delivery."<br>";
                echo "Hora Retirada".$this->hora_retirada."<br>";
            }

        }

?>
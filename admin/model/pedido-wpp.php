<?php
class PedidoWpp {
    private $cod_pedido_wpp;
    private $cliente_wpp;
    private $data;
    //
    private $hora_print;
    //
    private $valor;
    private $status;

    function getCod_pedido_wpp(){
        return $this->cod_pedido_wpp;
    }

    function getCliente_wpp(){
        return $this->cliente_wpp;
    }

    function getData(){
        return $this->data;
    }

    function getHora_print(){
        return $this->hora_print;
    }

    function getValor(){
        return $this->valor;
    }

    function getStatus(){
        return $this->status;
    }

    function setCod_pedido_wpp($cod_pedido_wpp){
        $this->cod_pedido_wpp=$cod_pedido_wpp;
    }

    function setCliente_wpp($cliente_wpp){
        $this->cliente_wpp=$cliente_wpp;
    }

    function setData($data){
        $this->data=$data;
    }
    
    function setHora_print($hora_print){
        $this->hora_print=$hora_print;
    }

    function setValor($valor){
        $this->valor=$valor;
    }

    function setStatus($status){
        $this->status=$status;
    }

    function __construct(){
        
    }

    function construct($cliente_wpp, $carrinho, $status){

        $this->cliente_wpp = $cliente_wpp;
        $this->status = $status;
        $this->carrinho = $carrinho;
    }

    function show(){
        echo "Codigo Pedido Whatsapp: ".$this->cod_pedido_wpp."<br>";
        echo "Cliente Whatsapp: ".$this->cliente_wpp."<br>";
        echo "Status: ".$this->status."<br>";
    }

}
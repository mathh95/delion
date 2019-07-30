<?php
class PedidoWpp {
    private $cod_pedido_wpp;
    private $cliente_wpp;
    private $data;
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

    function getValor(){
        return $this->valor;
    }

    function getStatus(){
        return $this->status;
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
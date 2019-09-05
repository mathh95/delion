<?php
class PedidoWpp {
    private $cod_pedido_wpp;
    private $cliente_wpp;
    private $data;
    private $formaPgt;
    private $valor;
    private $status;
    private $hora_impressao;
    private $hora_delivery;

    function getCod_pedido_wpp(){
        return $this->cod_pedido_wpp;
    }

    function getCliente_wpp(){
        return $this->cliente_wpp;
    }

    function getData(){
        return $this->data;
    }


    function getFormaPgt(){
        return $this->formaPgt;
    }

    function getValor(){
        return $this->valor;
    }

    function getStatus(){
        return $this->status;
    }

    function getHora_impressao(){
        return $this->hora_impressao;
    }

    function getHora_delivery(){
        return $this->hora_delivery;
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
    

    function setFormaPgt($formaPgt){
        $this->formaPgt=$formaPgt;
    }

    function setValor($valor){
        $this->valor=$valor;
    }

    function setStatus($status){
        $this->status=$status;
    }

    function setHora_impressao($hora_impressao){
        $this->hora_impressao = $hora_impressao;
    }

    function setHora_delivery($hora_delivery){
        $this->hora_delivery = $hora_delivery;
    }

    function __construct(){
        
    }

    function construct($cliente_wpp, $carrinho, $status, $formaPgt){

        $this->cliente_wpp = $cliente_wpp;
        $this->status = $status;
        $this->carrinho = $carrinho;
        $this->formaPgt = $formaPgt;
    }

    function show(){
        echo "Codigo Pedido Whatsapp: ".$this->cod_pedido_wpp."<br>";
        echo "Cliente Whatsapp: ".$this->cliente_wpp."<br>";
        echo "Status: ".$this->status."<br>";
    }

}
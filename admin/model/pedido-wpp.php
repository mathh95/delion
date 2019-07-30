<?
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

    function construct($cod_pedido_wpp, $cliente_wpp, $data, $valor, $status){
        $this->cod_pedido_wpp = $cod_pedido_wpp;
        $this->cliente_wpp = $cliente_wpp;
        $this->data = $data;
        $this->valor = $valor;
        $this->status = $status;
    }

    function show(){
        echo "Codigo Pedido Whatsapp: ".$this->cod_pedido_wpp."<br>";
        echo "Cliente Whatsapp: ".$this->cliente_wpp."<br>";
        echo "Data: ".$this->data."<br>";
        echo "Valor: ".$this->valor."<br>";
        echo "Status: ".$this->status."<br>";
    }

}
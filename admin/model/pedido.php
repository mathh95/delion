<?php 
    /**
     *  Classe de definição de pedido
     */
        class pedido{

            private $cod_pedido;

            private $cliente;

            private $data;

            private $valor;

            private $desconto;

            private $taxa_entrega;
            
            private $tempo_entrega;

            private $subtotal;

            private $status;

            private $formaPgt;

            private $origem;

            private $hora_print;

            private $hora_delivery;

            private $hora_retirada;

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

            function getDesconto(){
                return $this->desconto;
            }

            function getTempo_entrega(){
                return $this->tempo_entrega;
            }

            function getTaxa_entrega(){
                return $this->taxa_entrega;
            }

            function getSubtotal(){
                return $this->subtotal;
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

            function setDesconto($desconto){
                $this->desconto=$desconto;
            }

            function setTaxa_entrega($taxa_entrega){
                $this->taxa_entrega=$taxa_entrega;
            }

            function setTempo_entrega($tempo_entrega){
                $this->tempo_entrega=$tempo_entrega;
            }

            function setSubtotal($subtotal){
                $this->subtotal=$subtotal;
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

            function construct($cod_pedido,$cliente,$data,$valor,$desconto,$taxa_entrega,$subtotal,$status,$formaPgt,$origem, $tempo_entrega){
                $this->cod_pedido=$cod_pedido;
                $this->cliente=$cliente;
                $this->data=$data;
                $this->valor=$valor;
                $this->desconto=$desconto;
                $this->taxa_entrega=$taxa_entrega;
                $this->tempo_entrega=$tempo_entrega;
                $this->subtotal=$subtotal;
                $this->status=$status;
                $this->formaPgt=$formaPgt;
                $this->origem=$origem;
            }

            function show(){
                echo "Código do Pedido: ".$this->cod_pedido."<br>";
                echo "Cliente: ".$this->cliente."<br>";
                echo "Data: ".$this->data."<br>";
                echo "Valor: ".$this->valor."<br>";
                echo "Desconto".$this->desconto."<br>";
                echo "Taxa de Entrega".$this->taxa_entrega."<br>";
                echo "Tempo de Entrega".$this->tempo_entrega."<br>";
                echo "Subtotal".$this->subtotal."<br>";
                echo "Status: ".$this->status."<br>";
                echo "FormaPgt: ".$this->status."<br>";
                echo "Origem: ".$this->origem."<br>";
            }
        }
?>
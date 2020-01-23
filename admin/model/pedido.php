<?php 
    /**
     *  Classe de definição de pedido
     */
        class pedido{

            private $ped_pk_id;

            private $ped_data;

            private $ped_total;

            private $ped_taxa_entrega;
            
            private $ped_subtotal;

            private $ped_operacao_fidelidade;
            
            private $ped_desconto;
            
            private $ped_status;

            private $ped_hora_print;
            
            private $ped_hora_delivery;            
        
            private $ped_hora_retirada;
            
            private $ped_tempo_entrega;

            private $ped_fk_empresa;
            
            private $ped_fk_cliente;

            private $ped_fk_origem_pedido;

            private $ped_fk_forma_pgto;

            private $ped_fk_endereco;



            function getPkId(){
                return $this->ped_pk_id;
            }

            function getCliente(){
                return $this->ped_fk_cliente;
            }
            
            function getData(){
                return $this->ped_data;
            }

            function getTotal(){
                return $this->ped_total;
            }

            function getDesconto(){
                return $this->ped_desconto;
            }

            function getTaxa_entrega(){
                return $this->ped_taxa_entrega;
            }

            function getSubtotal(){
                return $this->ped_subtotal;
            }

            function getOperacaoFidelidade(){
                return $this->ped_operacao_fidelidade;
            }

            function getStatus(){
                return $this->ped_status;
            }

            function getHora_print(){
                return $this->ped_hora_print;
            }

            function getHora_delivery(){
                return $this->ped_hora_delivery;
            }

            function getHora_retirada(){
                return $this->ped_hora_retirada;
            }

            function getTempo_entrega(){
                return $this->ped_tempo_entrega;
            }

            function getFkEmpresa(){
                return $this->ped_fk_empresa;
            }

            function getFkCliente(){
                return $this->ped_fk_cliente;
            }

            function getFkOrigemPedido(){
                return $this->ped_fk_origem_pedido;
            }

            function getFkFormaPgt(){
                return $this->ped_fk_forma_pgto;
            }

            function getFkEndereco(){
                return $this->ped_fk_endereco;
            }




            function setPkId($ped_pk_id){
                $this->ped_pk_id=$ped_pk_id;
            }

            function setData($ped_data){
                $this->ped_data=$ped_data;
            }
            
            function setTotal($ped_total){
                $this->ped_total=$ped_total;
            }

            function setDesconto($ped_desconto){
                $this->ped_desconto=$ped_desconto;
            }

            function setTaxa_entrega($ped_taxa_entrega){
                $this->ped_taxa_entrega=$ped_taxa_entrega;
            }

            function setTempo_entrega($ped_tempo_entrega){
                $this->ped_tempo_entrega=$ped_tempo_entrega;
            }

            function setSubtotal($ped_subtotal){
                $this->ped_subtotal=$ped_subtotal;
            }

            function setStatus($ped_status){
                $this->ped_status=$ped_status;
            }

            function setFormaPgt($ped_forma_pgto){
                $this->ped_forma_pgto=$ped_forma_pgto;
            }


            function setHora_print($ped_hora_print){
                $this->ped_hora_print=$ped_hora_print;
            }

            function setHora_delivery($hora_delivery){
                $this->ped_hora_delivery=$hora_delivery;
            }

            function setHora_retirada($ped_hora_retirada){
                $this->ped_hora_retirada=$ped_hora_retirada;
            }

            function setFkEmpresa($ped_fk_empresa){
                $this->ped_fk_empresa=$ped_fk_empresa;
            }

            function setFkCliente($ped_fk_cliente){
                $this->ped_fk_cliente=$ped_fk_cliente;
            }

            function setFkOrigemPedido($ped_fk_origem_pedido){
                $this->ped_fk_origem_pedido=$ped_fk_origem_pedido;
            }

            function setFkFormaPgt($ped_fk_forma_pgto){
                $this->ped_fk_forma_pgto=$ped_fk_forma_pgto;
            }

            function setFkEndereco($ped_fk_endereco){
                $this->ped_fk_endereco=$ped_fk_endereco;
            }



            function __construct(){

            }

            function construct($ped_pk_id,$ped_fk_cliente,$ped_data,$ped_total,$ped_desconto,$ped_taxa_entrega,$ped_subtotal,$ped_status,$ped_forma_pgto,$ped_fk_origem,$ped_tempo_entrega){
                $this->ped_pk_id=$ped_pk_id;
                $this->ped_fk_cliente=$ped_fk_cliente;
                $this->ped_data=$ped_data;
                $this->ped_total=$ped_total;
                $this->ped_desconto=$ped_desconto;
                $this->ped_taxa_entrega=$ped_taxa_entrega;
                $this->ped_tempo_entrega=$ped_tempo_entrega;
                $this->ped_subtotal=$ped_subtotal;
                $this->ped_status=$ped_status;
                $this->ped_formaPgt=$ped_forma_pgto;
                $this->ped_fk_origem=$ped_fk_origem;
            }

            function show(){
                echo "Código do Pedido: ".$this->ped_pk_id."<br>";
                echo "Cliente: ".$this->ped_cliente."<br>";
                echo "Data: ".$this->ped_data."<br>";
                echo "Valor: ".$this->ped_total."<br>";
                echo "Desconto".$this->ped_desconto."<br>";
                echo "Taxa de Entrega".$this->ped_taxa_entrega."<br>";
                echo "Tempo de Entrega".$this->ped_tempo_entrega."<br>";
                echo "Subtotal".$this->ped_subtotal."<br>";
                echo "Status: ".$this->ped_status."<br>";
                echo "FormaPgt: ".$this->ped_status."<br>";
                echo "Origem: ".$this->ped_fk_origem."<br>";
                echo "Observação: ".$this->ped_observacao."<br>";
            }
        }
?>
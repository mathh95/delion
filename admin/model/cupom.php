<?php
/**
 * Classe de definição do Cliente 
 */

        class cupom{
            private $cup_pk_id;

            private $cup_codigo;
            
            private $cup_valor;
            
            private $cup_qtde_inicial;
            
            private $cup_qtde_atual;

            private $cup_valor_minimo;

            private $cup_vencimento_data;

            private $cup_vencimento_hora;

            private $cup_status;
            
            /**
             * GET'S and SET'S
             */
            
            function getPkId(){
                return $this->cup_pk_id;
            }

            function getCodigo(){
                return $this->cup_codigo;
            }

            function getQtde_inicial(){
                return $this->cup_qtde_inicial;
            }

            function getQtde_atual(){
                return $this->cup_qtde_atual;
            }

            function getValor(){
                return $this->cup_valor;
            }

            function getValor_minimo(){
                return $this->cup_valor_minimo;
            }

            function getVencimento_data(){
                return $this->cup_vencimento_data;
            }

            function getVencimento_hora(){
                return $this->cup_vencimento_hora;
            }

            function getStatus(){
                return $this->cup_status;
            }


            
            function setPkId($pk_id){
                $this->cup_pk_id = $pk_id;
            }

            function setCodigo($codigo){
                $this->cup_codigo = $codigo;
            }
            
            function setQtde_inicial($qtde_inicial){
                $this->cup_qtde_inicial = $qtde_inicial;
            }

            function setQtde_atual($qtde_atual){
                $this->cup_qtde_atual = $qtde_atual;
            }

            function setValor($valor){
                $this->cup_valor = $valor;
            }

            function setValor_minimo($valor_minimo){
                $this->cup_valor_minimo = $valor_minimo;
            }

            function setVencimento_data($vencimento_data){
                $this->cup_vencimento_data=$vencimento_data;
            }

            function setVencimento_hora($vencimento_hora){
                $this->cup_vencimento_hora=$vencimento_hora;
            }

            function setStatus($status){
                $this->cup_status = $status;
            }

            function construct1($valor,$valor_minimo ,$vencimento_data, $vencimento_hora){
                $this->cup_valor = $valor;
                $this->cup_valor_minimo = $valor_minimo;
                $this->cup_vencimento_data = $vencimento_data;
                $this->cup_vencimento_hora = $vencimento_hora;
            }

            function construct($codigo,$qtde_inicial, $qtde_atual,$valor,$valor_minimo , $vencimento_data, $vencimento_hora, $status){
                $this->cup_codigo = $codigo;
                $this->cup_qtde_inicial = $qtde_inicial;
                $this->cup_qtde_atual = $qtde_atual;
                $this->cup_valor = $valor;
                $this->cup_valor_minimo = $valor_minimo;
                $this->cup_vencimento_data = $vencimento_data;
                $this->cup_vencimento_hora = $vencimento_hora;
                $this->cup_status = $status;
            }

            function __construct(){
                
            }

            function show(){
                echo "Código do Cupom: ".$this->cup_pk_id."<br>";
                echo "Código: ".$this->cup_codigo."<br>";
                echo "Quantidade inicial: ".$this->cup_qtde_inicial."<br>";
                echo "Quantidade atual: ".$this->cup_qtde_atual."<br>";
                echo "Valor: ".$this->cup_valor."<br>";
                echo "Valor Minimo:".$this->cup_valor_minimo."<br>";
                echo "Data de vencimento: ".$this->cup_vencimento_data."<br>";
                echo "Hora de vencimento: ".$this->cup_vencimento_hora."<br>";
                echo "Status: ".$this->cup_status."<br>";
            }
        }
?>
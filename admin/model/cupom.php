<?php
/**
 * Classe de definição do Cliente 
 */

        class cupom{
            private $cod_cupom;

            private $codigo;

            private $qtde_inicial;

            private $qtde_atual;

            private $valor;

            private $valor_minimo;

            private $vencimento_data;

            private $vencimento_hora;

            private $status;
            
            /**
             * GET'S and SET'S
             */
            
            function getCod_cupom(){
                return $this->cod_cupom;
            }

            function getCodigo(){
                return $this->codigo;
            }

            function getQtde_inicial(){
                return $this->qtde_inicial;
            }

            function getQtde_atual(){
                return $this->qtde_atual;
            }

            function getValor(){
                return $this->valor;
            }

            function getValor_minimo(){
                return $this->valor_minimo;
            }

            function getVencimento_data(){
                return $this->vencimento_data;
            }

            function getVencimento_hora(){
                return $this->vencimento_hora;
            }

            function getStatus(){
                return $this->status;
            }

            function setCod_cupom($cod_cupom){
                $this->cod_cupom = $cod_cupom;
            }

            function setCodigo($codigo){
                $this->codigo = $codigo;
            }
            
            function setQtde_inicial($qtde_inicial){
                $this->qtde_inicial = $qtde_inicial;
            }

            function setQtde_atual($qtde_atual){
                $this->qtde_atual = $qtde_atual;
            }

            function setValor($valor){
                $this->valor = $valor;
            }

            function setValor_minimo($valor_minimo){
                $this->valor_minimo = $valor_minimo;
            }

            function setVencimento_data($vencimento_data){
                $this->vencimento_data=$vencimento_data;
            }

            function setVencimento_hora($vencimento_hora){
                $this->vencimento_hora=$vencimento_hora;
            }

            function setStatus($status){
                $this->status = $status;
            }

            function construct1($valor,$valor_minimo ,$vencimento_data, $vencimento_hora){
                $this->valor = $valor;
                $this->valor_minimo = $valor_minimo;
                $this->vencimento_data = $vencimento_data;
                $this->vencimento_hora = $vencimento_hora;
            }

            function construct($codigo,$qtde_inicial, $qtde_atual,$valor,$valor_minimo , $vencimento_data, $vencimento_hora, $status){
                $this->codigo = $codigo;
                $this->qtde_inicial = $qtde_inicial;
                $this->qtde_atual = $qtde_atual;
                $this->valor = $valor;
                $this->valor_minimo = $valor_minimo;
                $this->vencimento_data = $vencimento_data;
                $this->vencimento_hora = $vencimento_hora;
                $this->status = $status;
            }

            function __construct(){
                
            }

            function show(){
                echo "Código do Cupom: ".$this->cod_cupom."<br>";
                echo "Código: ".$this->codigo."<br>";
                echo "Quantidade inicial: ".$this->qtde_inicial."<br>";
                echo "Quantidade atual: ".$this->qtde_atual."<br>";
                echo "Valor: ".$this->valor."<br>";
                echo "Valor Minimo:".$this->valor_minimo."<br>";
                echo "Data de vencimento: ".$this->vencimento_data."<br>";
                echo "Hora de vencimento: ".$this->vencimento_hora."<br>";
                echo "Status: ".$this->status."<br>";
            }
        }
?>
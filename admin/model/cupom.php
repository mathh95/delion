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

            private $vencimento;

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

            function getVencimento(){
                return $this->vencimento;
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
            function setVencimento($vencimento){
                $this->vencimento=$vencimento;
            }

            function setStatus($status){
                $this->status = $status;
            }

            function construct($cod_cupom,$codigo,$qtde_inicial, $qtde_atual,$valor, $vencimento, $status){
                $this->cod_cupom = $cod_cupom;
                $this->codigo = $codigo;
                $this->qtde_inicial = $qtde_inicial;
                $this->qtde_atual = $qtde_atual;
                $this->valor = $valor;
                $this->vencimento = $vencimento;
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
                echo "Data de vencimento: ".$this->vencimento."<br>";
                echo "Status: ".$this->status."<br>";
            }
        }
?>
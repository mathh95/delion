<?php
/**
 * Classe de definição do Cliente 
 */

        class cupom{
            private $cod_cupom;

            private $codigo;

            private $quantidade;

            private $valor;
            
            /**
             * GET'S and SET'S
             */
            
            function getCod_cupom(){
                return $this->cod_cupom;
            }

            function getCodigo(){
                return $this->codigo;
            }

            function getQuantidade(){
                return $this->quantidade;
            }

            function getValor(){
                return $this->valor;
            }

            function setCod_cupom($cod_cupom){
                $this->cod_cupom = $cod_cupom;
            }

            function setCodigo($codigo){
                $this->codigo = $codigo;
            }
            
            function setQuantidade($quantidade){
                $this->quantidade = $quantidade;
            }

            function setValor($valor){
                $this->valor = $valor;
            }

            function construct($cod_cupom,$codigo,$quantidade,$valor){
                $this->cod_cupom = $cod_cupom;
                $this->codigo = $codigo;
                $this->quantidade = $quantidade;
                $this->valor = $valor;
            }

            function __construct(){
                
            }

            function show(){
                echo "Código do Cupom: ".$this->cod_cupom."<br>";
                echo "Código: ".$this->codigo."<br>";
                echo "Quantidade: ".$this->quantidade."<br>";
                echo "Valor: ".$this->valor."<br>";
            }
        }
?>
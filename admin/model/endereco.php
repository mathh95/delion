<?php
    /**
     * Classe endereço
     */
        class endereco{

            private $cod_endereco;

            private $rua;

            private $numero;

            private $cep;

            private $complemento;

            private $bairro;

            private $cliente;

            private $flag_cliente;

            function getCodEndereco(){
                return $this->cod_endereco;
            }

            function getRua(){
                return $this->rua;
            }

            function getNumero(){
                return $this->numero;
            }

            function getCep(){
                return $this->cep;
            }

            function getComplemento(){
                return $this->complemento;
            }

            function getBairro(){
                return $this->bairro;
            }

            function getCliente(){
                return $this->cliente;
            }

            function getFlagCliente(){
                return $this->flag_cliente;
            }

            function setCodEndereco($cod_endereco){
                $this->cod_endereco = $cod_endereco;
            }

            function setRua($rua){
                $this->rua = $rua;
            }

            function setNumero($numero){
                $this->numero = $numero;
            }

            function setCep($cep){
                $this->cep = $cep;
            }

            function setComplemento($complemento){
                $this->complemento = $complemento;
            }

            function setBairro($bairro){
                $this->bairro = $bairro;
            }

            function setCliente($cliente){
                $this->cliente = $cliente;
            }
            
            function setFlagCliente($flag_cliente){
                $this->flag_cliente=$flag_cliente;
            }

            function __construct(){

            }

            function construct($rua,$numero,$cep,$complemento,$bairro,$cliente){
                $this->rua = $rua;
                $this->numero = $numero;
                $this->cep = $cep;
                $this->complemento = $complemento;
                $this->bairro = $bairro;
                $this->cliente = $cliente;
            }

            function show(){
                echo "Código do Endereço: ".$this->cod_endereco."<br>";
                echo "Rua: ".$this->rua."<br>";
                echo "Numero: ".$this->numero."<br>";
                echo "Cep: ".$this->cep."<br>";
                echo "Complemento: ".$this->complemento."<br>";
                echo "Bairro: ".$this->bairro."<br>";
                echo "Cliente: ".$this->cliente."<br>";
            }
        }
?>
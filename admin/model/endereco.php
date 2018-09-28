<?php
    /**
     * Classe endereço
     */
        class endereco{

            #cod_endereço int 
            
            #rua var char 255

            #numero int

            #cep varchar 9

            #complemento varchar 255

            #bairro varchar 255

            #cliente int

            private $cod_endereco;

            private $rua;

            private $numero;

            private $cep;

            private $complemento;

            private $bairro;

            private $cliente;

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
            
            function __construct(){

            }

            function construct($cod_endereco,$rua,$numero,$cep,$complemento,$bairro,$cliente){
                $this->cod_endereco=$cod_endereco;
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
                echo "Bairro: ".this->bairro."<br>";
                echo "Cliente: ".this->cliente."<br>";
            }
        }
?>
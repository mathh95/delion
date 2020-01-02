<?php
    /**
     * Classe endereço
     */
        class endereco{

            private $end_pk_id;

            private $end_rua;

            private $end_numero;

            private $end_cep;

            private $end_complemento;
            
            private $end_bairro;

            private $end_referencia;

            private $end_fk_cliente;

            private $end_flag_cliente;

            private $end_fk_cidade;

            function getCodEndereco(){
                return $this->end_pk_id;
            }

            function getRua(){
                return $this->end_rua;
            }

            function getNumero(){
                return $this->end_numero;
            }

            function getCep(){
                return $this->end_cep;
            }

            function getComplemento(){
                return $this->end_complemento;
            }

            function getBairro(){
                return $this->end_bairro;
            }

            function getReferencia(){
                return $this->end_referencia;
            }

            function getCliente(){
                return $this->end_fk_cliente;
            }

            function getFlagCliente(){
                return $this->end_flag_cliente;
            }

            function getCidade(){
                return $this->end_fk_cidade;
            }

            function setCodEndereco($end_pk_id){
                $this->end_pk_id = $end_pk_id;
            }

            function setRua($end_rua){
                $this->end_rua = $end_rua;
            }

            function setNumero($end_numero){
                $this->end_numero = $end_numero;
            }

            function setCep($end_cep){
                $this->end_cep = $end_cep;
            }

            function setComplemento($end_complemento){
                $this->end_complemento = $end_complemento;
            }
            
            function setBairro($end_bairro){
                $this->end_bairro = $end_bairro;
            }

            function setReferencia($end_referencia){
                $this->end_referencia = $end_referencia;
            }

            function setCliente($end_fk_cliente){
                $this->end_fk_cliente = $end_fk_cliente;
            }
            
            function setFlagCliente($flag_cliente){
                $this->flag_cliente=$flag_cliente;
            }

            function setCidade($end_fk_cidade){
                $this->end_fk_cidade = $end_fk_cidade;
            }

            function __construct(){

            }

            function getDsFlagCliente(){
                return $this->flag_cliente==0? 'Inativo': 'Ativo';
            }
            
            function construct($end_rua,$end_numero,$end_cep,$end_complemento,$end_bairro,$end_referencia,$end_fk_cliente,$end_fk_cidade){
                $this->end_rua = $end_rua;
                $this->end_numero = $end_numero;
                $this->end_cep = $end_cep;
                $this->end_complemento = $end_complemento;
                $this->end_bairro = $end_bairro;
                $this->end_referencia = $end_referencia;
                $this->end_fk_cliente = $end_fk_cliente;
                $this->end_fk_cidade = $end_fk_cidade;
            }

            function show(){
                echo "Código do Endereço: ".$this->cod_endereco."<br>";
                echo "Rua: ".$this->rua."<br>";
                echo "Numero: ".$this->numero."<br>";
                echo "Bairro: ".$this->bairro."<br>";
                echo "Cep: ".$this->cep."<br>";
                echo "Cidade: ".$this->cidade."<br>";
                echo "Referência: ".$this->referencia."<br>";
                echo "Complemento: ".$this->complemento."<br>";
                echo "Cliente: ".$this->cliente."<br>";
            }
        }
?>
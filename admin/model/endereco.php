<?php


    /**
     * Classe endereço
     */
        class endereco{

            private $end_pk_id;

            private $end_cep;
            
            private $end_logradouro;
            
            private $end_bairro;

            private $end_fk_cidade;



            function getPkId(){
                return $this->end_pk_id;
            }

            function getCep(){
                return $this->end_cep;
            }

            function getLogradouro(){
                return $this->end_logradouro;
            }

            function getBairro(){
                return $this->end_bairro;
            }

            function getFkCidade(){
                return $this->end_fk_cidade;
            }



            function setPkId($end_pk_id){
                $this->end_pk_id = $end_pk_id;
            }

            function setLogradouro($end_logradouro){
                $this->end_logradouro = $end_logradouro;
            }

            function setCep($end_cep){
                $this->end_cep = $end_cep;
            }
            
            function setBairro($end_bairro){
                $this->end_bairro = $end_bairro;
            }            

            function setFkCidade($end_fk_cidade){
                $this->end_fk_cidade = $end_fk_cidade;
            }

            function __construct(){

            }

            function getDsFlagCliente(){
                return $this->flag_cliente==0? 'Inativo': 'Ativo';
            }

            function construct($end_cep, $end_logradouro, $end_bairro, $end_fk_cidade){
                $this->end_cep = $end_cep;
                $this->end_logradouro = $end_logradouro;
                $this->end_bairro = $end_bairro;
                $this->end_fk_cidade = $end_fk_cidade;
            }

            function show(){
                echo "Código do Endereço: ".$this->end_pk_id."<br>";
                echo "Logradouro: ".$this->end_logradouro."<br>";
                echo "Cep: ".$this->end_cep."<br>";
                echo "Bairro: ".$this->end_bairro."<br>";
                echo "Cidade: ".$this->end_fk_cidade."<br>";
            }
        }
?>
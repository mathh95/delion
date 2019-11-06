<?php

    class sms{

        private $cod_sms;

        private $telefone;

        private $codigo; 
        
        private $verificado; 

        /**
        * GET'S sms
        */

        function getCod_sms(){
            return $this->cod_sms;
        }

        function getTelefone(){
            return $this->telefone;
        }

        function getCodigo(){
            return $this->codigo;
        }

        function getVerificado(){
            return $this->verificado;
        }

        /**
        * SET'S sms
        */

        function setCod_sms($cod_sms){
            $this->cod_sms = $cod_sms;
        }

        function setTelefone($telefone){
            $this->telefone = $telefone;
        }

        function setCodigo($codigo){
            $this->codigo = $codigo;
        }

        function setVerificado($verificado){
            $this->verificado = $verificado;
        }

        function __construct(){}
        
        function construct($telefone, $codigo){
            $this->telefone = $telefone;
            $this->codigo = $codigo;
        }
    }

?>
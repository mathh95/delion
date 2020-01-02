<?php

    class smsVerificacao{

        private $smve_pk_id;

        private $smve_telefone;

        private $smve_codigo; 
        
        private $smve_verificado; 

        /**
        * GET'S sms
        */

        function getCod_sms(){
            return $this->smve_pk_id;
        }

        function getTelefone(){
            return $this->smve_telefone;
        }

        function getCodigo(){
            return $this->smve_codigo;
        }

        function getVerificado(){
            return $this->smve_verificado;
        }

        /**
        * SET'S sms
        */

        function setCod_sms($smve_pk_id){
            $this->smve_pk_id = $smve_pk_id;
        }

        function setTelefone($smve_telefone){
            $this->smve_telefone = $smve_telefone;
        }

        function setCodigo($smve_codigo){
            $this->smve_codigo = $smve_codigo;
        }

        function setVerificado($smve_verificado){
            $this->smve_verificado = $smve_verificado;
        }

        function __construct(){}
        
        function construct($smve_telefone, $smve_codigo){
            $this->smve_telefone = $smve_telefone;
            $this->smve_codigo = $smve_codigo;
        }
    }

?>
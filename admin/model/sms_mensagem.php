<?php

    class smsMensagem{

        private $cod_sms_mensagem;

        private $msg;

        private $descricao;
        
        private $data_envio;

        /**
        * GET'S sms
        */

        function getCod_sms_mensagem(){
            return $this->cod_sms_mensagem;
        }

        function getMsg(){
            return $this->msg;
        }

        function getDescricao(){
            return $this->descricao;
        }

        function getData_envio(){
            return $this->data_envio;
        }

        /**
        * SET'S sms
        */

        function setCod_sms_mensagem($cod_sms_mensagem){
            $this->cod_sms_mensagem = $cod_sms_mensagem;
        }

        function setMsg($msg){
            $this->msg = $msg;
        }

        function setDescricao($descricao){
            $this->descricao = $descricao;
        }

        function setData_envio($data_envio){
            $this->data_envio = $data_envio;
        }

        function __construct(){}
        
        function construct($msg, $descricao){
            $this->msg = $msg;
            $this->descricao = $descricao;
        }
    }

?>
<?php

    class smsMensagem{

        private $sms_pk_id;

        private $sms_msg;

        private $sms_descricao;
        
        private $sms_data_envio;

        /**
        * GET'S sms
        */

        function getCod_sms_mensagem(){
            return $this->sms_pk_id;
        }

        function getMsg(){
            return $this->sms_msg;
        }

        function getDescricao(){
            return $this->sms_descricao;
        }

        function getData_envio(){
            return $this->sms_data_envio;
        }

        /**
        * SET'S sms
        */

        function setCod_sms_mensagem($sms_pk_id){
            $this->sms_pk_id = $sms_pk_id;
        }

        function setMsg($sms_msg){
            $this->sms_msg = $sms_msg;
        }

        function setDescricao($sms_descricao){
            $this->sms_descricao = $sms_descricao;
        }

        function setData_envio($sms_data_envio){
            $this->sms_data_envio = $sms_data_envio;
        }

        function __construct(){}
        
        function construct($sms_msg, $sms_descricao){
            $this->sms_msg = $sms_msg;
            $this->sms_descricao = $sms_descricao;
        }
    }

?>
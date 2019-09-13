<?php

    class formaPgt{

        private $cod_formaPgt;

        private $tipoFormaPgt;

        private $flag_ativo; 


        /**
        * GET'S forma de pagamento
        */

         function getCod_formaPgt(){
             return $this->cod_formaPgt;
         }

         function getTipoFormaPgt(){
             return $this->tipoFormaPgt;
         }

         function getFlag_ativo(){
             return $this->flag_ativo;
         }

        /**
        * SET'S forma de pagamento
        */

        function setCod_formaPgt($cod_formaPgt){
            $this->cod_formaPgt = $cod_formaPgt;
        }

        function setTipoFormaPgt($tipoFormaPgt){
            $this->tipoFormaPgt = $tipoFormaPgt;
        }

        function setFlag_ativo($flag_ativo){
            $this->flag_ativo = $flag_ativo;
        }

        function __construct(){}
        
        function construct($tipoFormaPgt,$flag_ativo){
            $this->tipoFormaPgt = $tipoFormaPgt;
            $this->flag_ativo = $flag_ativo;
        }
    }

?>
<?php

    class forma_pgto{

        private $fopg_pk_id;

        private $fopg_nome;

        private $fopg_flag_ativo; 


        /**
        * GET'S forma de pagamento
        */

        function getPkId(){
            return $this->fopg_pk_id;
        }

        function getNome(){
            return $this->fopg_nome;
        }

        function getFlag_ativo(){
            return $this->fopg_flag_ativo;
        }

        /**
        * SET'S forma de pagamento
        */

        function setPkId($fopg_pk_id){
            $this->fopg_pk_id = $fopg_pk_id;
        }

        function setNome($fopg_nome){
            $this->fopg_nome = $fopg_nome;
        }

        function setFlag_ativo($fopg_flag_ativo){
            $this->fopg_flag_ativo = $fopg_flag_ativo;
        }

        function __construct(){}
        
        function construct($fopg_nome,$fopg_flag_ativo){
            $this->fopg_nome = $fopg_nome;
            $this->fopg_flag_ativo = $fopg_flag_ativo;
        }
    }

?>
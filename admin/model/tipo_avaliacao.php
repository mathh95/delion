<?php 

    class tipoAvaliacao{

        private $tiva_pk_id;
        private $tiva_nome;
        private $tiva_flag_ativo;

        function getCod_tipo_avaliacao(){
            return $this->tiva_pk_id;
        }

        function getNome(){
            return $this->tiva_nome;
        }

        function getFlag_ativo(){
            return $this->tiva_flag_ativo;
        }

        function setCod_tipo_avaliacao($tiva_pk_id){
            $this->tiva_pk_id = $tiva_pk_id;
        }

        function setNome($tiva_nome){
            $this->tiva_nome = $tiva_nome;
        }

        function setFlag_ativo($tiva_flag_ativo){
            $this->tiva_flag_ativo = $tiva_flag_ativo;
        }
    }

?>

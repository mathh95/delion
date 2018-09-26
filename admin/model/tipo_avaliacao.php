<?php 

    class tipoAvaliacao{

        private $cod_tipo_avaliacao;
        private $nome;
        private $flag_ativo;

        function getCod_tipo_avaliacao(){
            return $this->cod_tipo_avaliacao;
        }

        function getNome(){
            return $this->nome;
        }

        function getFlag_ativo(){
            return $this->flag_ativo;
        }

        function setCod_tipo_avaliacao($cod_tipo_avaliacao){
            $this->cod_tipo_avaliacao = $cod_tipo_avaliacao;
        }

        function setNome($nome){
            $this->nome = $nome;
        }

        function setFlag_ativo($flag_ativo){
            $this->flag_ativo = $flag_ativo;
        }
    }

?>

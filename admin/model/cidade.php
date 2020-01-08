<?php 

    class cidade{

        private $ci_pk_id;
        private $ci_cidade;
        private $ci_fk_estado;

        function getPkId(){
            return $this->ci_pk_id;
        }

        function getCidade(){
            return $this->ci_cidade;
        }

        function getFkEstado(){
            return $this->ci_fk_estado;
        }


        function setPkId($ci_pk_id){
            $this->ci_pk_id = $ci_pk_id;
        }

        function setCidade($ci_cidade){
            $this->ci_cidade = $ci_cidade;
        }

        function setFkEstado($ci_fk_estado){
            $this->ci_fk_estado = $ci_fk_estado;
        }
    }

?>

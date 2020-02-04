<?php
    /**
     * Classe de definição do tipo de produto fornecido pelo fornecedor
     * Ex: frios, carnes, etc
     */

     class tipo_fornecedor{
        
        private $tifo_pk_id;
        private $tifo_nome;
        private $tifo_flag_ativo;
        private $tifo_fk_empresa;
        

        function getPkId(){
            return $this->tifo_pk_id;
        }

        function getNome(){
            return $this->tifo_nome;
        }

        function getFlag_ativo(){
            return $this->tifo_flag_ativo;
        }

        function getFkEmpresa(){
            return $this->tifo_fk_empresa;
        }

        function setPkId($tifo_pk_id){
            $this->tifo_pk_id=$tifo_pk_id;
        }

        function setNome($tifo_nome){
            $this->tifo_nome=$tifo_nome;
        }

        function setFlag_ativo($tifo_flag_ativo){
            $this->tifo_flag_ativo=$tifo_flag_ativo;
        }

        function setFkEmpresa($tifo_fk_empresa){
            $this->tifo_fk_empresa=$tifo_fk_empresa;
        }

        function __construct(){
            
        }

        function construct($tifo_nome, $tifo_flag_ativo){
            $this->tifo_nome=$tifo_nome;
            $this->tifo_flag_ativo=$tifo_flag_ativo;
        }

        function show(){
            echo "Código tipo fornecedor: ".$this->tifo_pk_id."<br>";
            echo "Nome: ".$this->tifo_nome."<br>";
            echo "Flag ativo: ".$this->tifo_flag_ativo."<br>";
        }


     }

?>
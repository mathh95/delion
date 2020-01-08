<?php
    /**
     * Classe endereço
     */
    class enderecoCliente{

        private $encl_pk_id;

        private $encl_numero;

        private $encl_nome;

        private $encl_referencia;
                    
        private $encl_complemento;
        
        private $encl_flag_ativo;
        
        private $encl_fk_endereco;

        private $encl_fk_cliente;


        function getPkId(){
            return $this->encl_pk_id;
        }

        function getNumero(){
            return $this->encl_numero;
        }

        function getNome(){
            return $this->encl_nome;
        }

        function getReferencia(){
            return $this->encl_referencia;
        }

        function getComplemento(){
            return $this->encl_complemento;
        }


        function getFlagAtivo(){
            return $this->encl_flag_ativo;
        }

        function getFkEndereco(){
            return $this->encl_fk_endereco;
        }

        function getFkCliente(){
            return $this->encl_fk_cliente;
        }



        function setPkId($encl_pk_id){
            $this->encl_pk_id = $encl_pk_id;
        }

        function setNumero($encl_numero){
            $this->encl_numero = $encl_numero;
        }

        function setNome($encl_nome){
            $this->encl_nome = $encl_nome;
        }
        
        function setBairro($encl_bairro){
            $this->encl_bairro = $encl_bairro;
        }

        function setReferencia($encl_referencia){
            $this->encl_referencia = $encl_referencia;
        }

        function setComplemento($encl_complemento){
            $this->encl_complemento = $encl_complemento;
        }
        
        function setFlagAtivo($flag_ativo){
            $this->flag_ativo=$flag_ativo;
        }

        function setFkEndereco($encl_fk_endereco){
            $this->encl_fk_endereco = $encl_fk_endereco;
        }

        function setFkCliente($encl_fk_cliente){
            $this->encl_fk_cliente = $encl_fk_cliente;
        }

        function __construct(){

        }

        function getDsFlagCliente(){
            return $this->flag_ativo==0? 'Inativo': 'Ativo';
        }

        function construct($encl_numero, $encl_referencia, $encl_complemento, $encl_fk_endereco, $encl_fk_cliente=null){
            $this->encl_numero = $encl_numero;
            // $this->encl_nome = $encl_nome;
            $this->encl_referencia = $encl_referencia;
            $this->encl_complemento = $encl_complemento;
            $this->encl_fk_endereco = $encl_fk_endereco;
            $this->encl_fk_cliente = $encl_fk_cliente;
        }

        function show(){
            echo "Código do Endereço: ".$this->encl_pk_id."<br>";
            echo "Numero: ".$this->encl_numero."<br>";
            echo "Referência: ".$this->encl_referencia."<br>";
            echo "Complemento: ".$this->encl_complemento."<br>";
            echo "Cliente: ".$this->encl_fk_cliente."<br>";
        }
    }
?>
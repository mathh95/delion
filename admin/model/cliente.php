<?php
    /**
     * Classe de definição de cliente
     */
        class cliente{

            private $cli_pk_id;

            private $cli_cpf;
                        
            private $cli_nome;
            
            private $cli_sobrenome;

            private $cli_login_email;
            
            private $cli_senha;
            
            private $cli_telefone;
            
            private $cli_data_nasc;

            private $cli_status;

            private $cli_idGoogle;

            private $cli_idFacebook;
            
            private $cli_pontos_fidelidade;

            private $cli_fk_empresa;



            function getPkId(){
                return $this->cli_pk_id;
            }

            function getNome(){
                return $this->cli_cli_nome;
            }

            function getSobrenome(){
                return $this->cli_sobrenome;
            }

            function getCpf(){
                return $this->cli_cpf;
            }

            function getData_nasc(){
                return $this->cli_data_nasc;
            }

            function getLogin(){
                return $this->cli_login_email;
            }

            function getSenha(){
                return $this->cli_senha;
            }

            function getTelefone(){
                return $this->cli_telefone;
            }
            
            function getStatus(){
                return $this->cli_status;
            }
            
            function getIdFacebook(){
                return $this->cli_idFacebook;
            }

            function getIdGoogle(){
                return $this->cli_idGoogle;
            }

            function getPontosFidelidade(){
                return $this->cli_pontos_fidelidade;
            }

            function getFkEmpresa(){
                return $this->cli_fk_empresa;
            }



            function setPkId($cli_pk_id){
                $this->cli_pk_id = $cli_pk_id;
            }

            function setNome($cli_nome){
                $this->cli_nome = $cli_nome;
            }

            function setSobrenome($cli_sobrenome){
                $this->cli_sobrenome = $cli_sobrenome;
            }

            function setCpf($cli_cpf){
                $this->cli_cpf = $cli_cpf;
            }

            function setData_nasc($cli_data_nasc){
                $this->cli_data_nasc = $cli_data_nasc;
            }

            function setLogin($cli_login){
                $this->cli_login = $cli_login;
            }

            function setSenha($cli_senha){
                $this->cli_senha = $cli_senha;
            }

            function setTelefone($cli_telefone){
                $this->cli_telefone = $cli_telefone;
            }

            function setStatus($cli_status){
                $this->cli_status= $cli_status;
            }

            function setIdGoogle($cli_idGoogle){
                $this->cli_idGoogle = $cli_idGoogle;
            }

            function setIdFacebook($cli_idFacebook){
                $this->cli_idFacebook = $cli_idFacebook;
            }

            function setPontosFidelidade($cli_pontos_fidelidade){
                $this->cli_pontos_fidelidade = $cli_pontos_fidelidade;
            }

            function setFkEmpresa($cli_fk_empresa){
                $this->cli_fk_empresa = $cli_fk_empresa;
            }


            function construct($cli_nome,$cli_sobrenome,$cli_cpf,$cli_data_nasc,$cli_login,$cli_senha,$cli_telefone,$cli_status){
                $this->cli_nome=$cli_nome;
                $this->cli_sobrenome=$cli_sobrenome;
                $this->cli_cpf=$cli_cpf;
                $this->cli_data_nasc=$cli_data_nasc;
                $this->cli_login=$cli_login;
                $this->cli_senha=$cli_senha;
                $this->cli_telefone=$cli_telefone;
                $this->cli_status=$cli_status;
            }

            function __construct(){

            }

            function show(){
                echo "Código do Cliente: ".$this->cli_pk_id."<br>";
                echo "Nome: ".$this->cli_nome."<br>";
                echo "Sobrenome: ".$this->cli_sobrenome."<br>";
                echo "Cpf: ".$this->cli_cpf."<br>";
                echo "Data Nasc: ".$this->cli_data_nasc."<br>";
                echo "Login: ".$this->cli_login."<br>";
                echo "Senha: ".$this->cli_senha."<br>";
                echo "Telefone: ".$this->cli_telefone."<br>";
            }
        }
?>
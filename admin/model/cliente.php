<?php
    /**
     * Classe de definição de cliente
     */
        class cliente{

            private $cod_cliente;

            private $nome;

            private $sobrenome;

            private $cpf;

            private $data_nasc;

            private $login;

            private $senha;
            
            private $telefone;

            private $dt_alteracao_fone;

            private $status;

            private $idGoogle;

            private $idFacebook;

            function getCod_cliente(){
                return $this->cod_cliente;
            }

            function getNome(){
                return $this->nome;
            }

            function getSobrenome(){
                return $this->sobrenome;
            }

            function getCpf(){
                return $this->cpf;
            }

            function getData_nasc(){
                return $this->data_nasc;
            }

            function getLogin(){
                return $this->login;
            }

            function getSenha(){
                return $this->senha;
            }

            function getTelefone(){
                return $this->telefone;
            }

            function getDtAlteracaoFone(){
                return $this->dt_alteracao_fone;
            }
            
            function getStatus(){
                return $this->status;
            }
            
            function getIdFacebook(){
                return $this->idFacebook;
            }

            function setCod_cliente($cod_cliente){
                $this->cod_cliente = $cod_cliente;
            }

            function setNome($nome){
                $this->nome = $nome;
            }

            function setSobrenome($sobrenome){
                $this->sobrenome = $sobrenome;
            }

            function setCpf($cpf){
                $this->cpf = $cpf;
            }

            function setData_nasc($data_nasc){
                $this->data_nasc = $data_nasc;
            }

            function setLogin($login){
                $this->login = $login;
            }

            function setSenha($senha){
                $this->senha = $senha;
            }

            function setTelefone($telefone){
                $this->telefone = $telefone;
            }

            function setDtAlteracaoFone($dt_alteracao_fone){
                $this->dt_alteracao_fone = $dt_alteracao_fone;
            }

            function setStatus($status){
                $this->status= $status;
            }

            function setIdGoogle($idGoogle){
                $this->idGoogle = $idGoogle;
            }

            function getIdGoogle(){
                return $this->idGoogle;
            }

            function setIdFacebook($idFacebook){
                $this->idFacebook=$idFacebook;
            }


            function construct($nome,$sobrenome,$cpf,$data_nasc,$login,$senha,$telefone,$status){
                $this->nome=$nome;
                $this->sobrenome=$sobrenome;
                $this->cpf=$cpf;
                $this->data_nasc=$data_nasc;
                $this->login=$login;
                $this->senha=$senha;
                $this->telefone=$telefone;
                $this->status=$status;
            }

            function __construct(){

            }

            function show(){
                echo "Código do Cliente: ".$this->cod_cliente."<br>";
                echo "Nome: ".$this->nome."<br>";
                echo "Sobrenome: ".$this->sobrenome."<br>";
                echo "Cpf: ".$this->cpf."<br>";
                echo "Data Nasc: ".$this->data_nasc."<br>";
                echo "Login: ".$this->login."<br>";
                echo "Senha: ".$this->senha."<br>";
                echo "Telefone: ".$this->telefone."<br>";
            }
        }
?>
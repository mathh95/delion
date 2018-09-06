<?php
    /**
     * Classe de definição de cliente
     */
        class cliente{

            private $cod_cliente;

            private $nome;

            private $login;

            private $senha;
            
            private $telefone;

            private $status;

            private $idGoogle;

            function getCod_cliente(){
                return $this->cod_cliente;
            }

            function getNome(){
                return $this->nome;
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
            
            function getStatus(){
                return $this->status;
            }

            function setCod_cliente($cod_cliente){
                $this->cod_cliente = $cod_cliente;
            }

            function setNome($nome){
                $this->nome = $nome;
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

            function setStatus($status){
                $this->status= $status;
            }

            function setIdGoogle($idGoogle){
                $this->idGoogle = $idGoogle;
            }

            function getIdGoogle(){
                return $this->idGoogle;
            }


            function construct($nome,$login,$senha,$telefone,$status){
                $this->nome=$nome;
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
                echo "Login: ".$this->login."<br>";
                echo "Senha: ".$this->senha."<br>";
                echo "Telefone: ".$this->telefone."<br>";
            }
        }
?>
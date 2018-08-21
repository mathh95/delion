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

            function construct($cod_cliente,$nome,$login,$senha,$telefone){
                $this->cod_cliente=$cod_cliente;
                $this->nome=$nome;
                $this->login=$login;
                $this->senha=$senha;
                $this->telefone=$telefone;
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
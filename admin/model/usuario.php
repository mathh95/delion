<?php
/**
 *Classe de definição de usuário
 */
    class usuario {

        private $cod_usuario;
        private $nome;
        private $login;
        private $senha;
        private $email;
        private $flag_bloqueado;
        private $cod_perfil;
        private $permissao;

        function getCod_usuario(){
            return $this->cod_usuario;
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
        function getEmail(){
            return $this->email;
        }
        function getFlag_bloqueado(){
            return $this->flag_bloqueado;
        }
        function getCod_perfil(){
            return $this->cod_perfil;
        }
        function getPermissao(){
            return $this->permissao;
        }

        function setCod_usuario($cod_usuario){
            $this->cod_usuario=$cod_usuario;
        }
        function setNome($nome){
            $this->nome=$nome;
        }
        function setLogin($login){
            $this->login=$login;
        }
        function setSenha($senha){
            $this->senha=$senha;
        }
        function setEmail($email){
            $this->email=$email;
        }
        function setFlag_bloqueado($flag_bloqueado){
            $this->flag_bloqueado=$flag_bloqueado;
        }
        function setCod_perfil($cod_perfil){
            $this->cod_perfil=$cod_perfil;
        }
        function setPermissao($permissao){
            $this->permissao=$permissao;
        }
        function __construct(){
        }
        function construct($nome,$login,$senha,$email,$flag_bloqueado,$cod_perfil, $permissao){
            $this->nome=$nome;
            $this->login=$login;
            $this->senha=$senha;
            $this->email=$email;
            $this->flag_bloqueado=$flag_bloqueado;
            $this->cod_perfil=$cod_perfil;
            $this->permissao=$permissao;
        }
        function show(){
            echo "Código do Usuário:".$this->cod_usuario."<br>";
            echo "Nome:".$this->nome."<br>";
            echo "Login:".$this->login."<br>";
            echo "Email:".$this->email."<br>";
            echo "Senha:".$this->senha."<br>";
            echo "Cod_perfil:".$this->cod_perfil."<br>";
            echo "Flag_bloqueado:".$this->flag_bloqueado."<br>";
            echo "Permissão:".$this->permissao."<br>";
        }

        function getDsCod_perfil(){    
            switch ((int)$this->cod_perfil) {
              case 0:
                return "Administrador";
                break;
              case 1:
                return "Funcionário";
                break;
            }
        return $this->cod_perfil; 
        }
        function getDsflag_bloqueado(){
            return $this->flag_bloqueado==0? 'Ativo': 'Inativo';
        }
        function validaUsuario(){
            $retorno =true;
            if(( ! isset($this->email) ) || !filter_var($this->email, FILTER_VALIDATE_EMAIL)){
                $retorno =false;
            }
            if( empty($this->login) ){
                $retorno =false;
            }
            if( empty($this->senha) ){
                $retorno =false;
            }
            return $retorno;
        }
    }
?>

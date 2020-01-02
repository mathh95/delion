<?php
/**
 *Classe de definição de usuário
 */
    class usuario {

        private $usu_pk_id;
        private $usu_nome;
        private $usu_login;
        private $usu_senha;
        private $usu_email;
        private $usu_flag_bloqueado;
        private $usu_cod_perfil;
        private $usu_permissao;

        function getCod_usuario(){
            return $this->usu_pk_id;
        }
        function getNome(){
            return $this->usu_nome;
        }
        function getLogin(){
            return $this->usu_login;
        }
        function getSenha(){
            return $this->usu_senha;
        }
        function getEmail(){
            return $this->usu_email;
        }
        function getFlag_bloqueado(){
            return $this->usu_flag_bloqueado;
        }
        function getCod_perfil(){
            return $this->usu_cod_perfil;
        }
        function getPermissao(){
            return $this->usu_permissao;
        }

        function setCod_usuario($usu_pk_id){
            $this->usu_pk_id=$usu_pk_id;
        }
        function setNome($usu_nome){
            $this->usu_nome=$usu_nome;
        }
        function setLogin($usu_login){
            $this->usu_login=$usu_login;
        }
        function setSenha($usu_senha){
            $this->usu_senha=$usu_senha;
        }
        function setEmail($usu_email){
            $this->usu_email=$usu_email;
        }
        function setFlag_bloqueado($usu_flag_bloqueado){
            $this->usu_flag_bloqueado=$usu_flag_bloqueado;
        }
        function setCod_perfil($usu_cod_perfil){
            $this->usu_cod_perfil=$usu_cod_perfil;
        }
        function setPermissao($usu_permissao){
            $this->usu_permissao=$usu_permissao;
        }
        function __construct(){
        }
        function construct($usu_nome,$usu_login,$usu_senha,$usu_email,$usu_flag_bloqueado,$usu_cod_perfil, $usu_permissao){
            $this->usu_nome=$usu_nome;
            $this->usu_login=$usu_login;
            $this->usu_senha=$usu_senha;
            $this->usu_email=$usu_email;
            $this->usu_flag_bloqueado=$usu_flag_bloqueado;
            $this->usu_cod_perfil=$usu_cod_perfil;
            $this->usu_permissao=$usu_permissao;
        }
        function show(){
            echo "Código do Usuário:".$this->usu_pk_id."<br>";
            echo "Nome:".$this->usu_nome."<br>";
            echo "Login:".$this->usu_login."<br>";
            echo "Email:".$this->usu_email."<br>";
            echo "Senha:".$this->usu_senha."<br>";
            echo "Cod_perfil:".$this->usu_cod_perfil."<br>";
            echo "Flag_bloqueado:".$this->usu_flag_bloqueado."<br>";
            echo "Permissão:".$this->usu_permissao."<br>";
        }

        function getDsCod_perfil(){    
            switch ((int)$this->usu_cod_perfil) {
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
            return $this->usu_flag_bloqueado==0? 'Ativo': 'Inativo';
        }
        function validaUsuario(){
            $retorno =true;
            if(( ! isset($this->usu_email) ) || !filter_var($this->usu_email, FILTER_VALIDATE_EMAIL)){
                $retorno =false;
            }
            if( empty($this->usu_login) ){
                $retorno =false;
            }
            if( empty($this->usu_senha) ){
                $retorno =false;
            }
            return $retorno;
        }
    }
?>

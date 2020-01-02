<?php
    include_once MODELPATH."/usuario.php";
    include_once "seguranca.php";
    protegePagina();

    class controlerUsuario {
        private $pdo;
        function insert($usuario){
            try{
                $login=$usuario->getLogin();
                $senha=md5($usuario->getSenha());
                $email=$usuario->getEmail();
                $nome=$usuario->getNome();
                $cod_perfil=$usuario->getCod_perfil();
                $flag_bloqueado=$usuario->getFlag_bloqueado();
                $permissao=$usuario->getPermissao();
                $stmte =$this->pdo->prepare("INSERT INTO tb_usuario(usu_nome, usu_login, usu_senha, usu_email, usu_flag_bloqueado, usu_cod_perfil, usu_permissao)
                VALUES (:nome, :login, :senha, :email, :flag_bloqueado, :cod_perfil, :permissao)");
                $stmte->bindParam(":nome", $nome, PDO::PARAM_STR);
                $stmte->bindParam(":login", $login, PDO::PARAM_STR);
                $stmte->bindParam(":senha", $senha, PDO::PARAM_STR);
                $stmte->bindParam(":email", $email, PDO::PARAM_STR);
                $stmte->bindParam(":flag_bloqueado", $flag_bloqueado , PDO::PARAM_INT);
                $stmte->bindParam(":cod_perfil", $cod_perfil , PDO::PARAM_INT);
                $stmte->bindParam(":permissao", $permissao, PDO::PARAM_STR);
                $executa = $stmte->execute();
                if($executa){
                    return 1;
                }
                else{
                    return -1;
                }
            }
           catch(PDOException $e){
                echo $e->getMessage();
                return -1;
           }
        }
        function update($usuario){
            try{
                $stmte =$this->pdo->prepare("UPDATE tb_usuario SET usu_nome=:usu_nome, usu_login=:usu_login, usu_email=:usu_email, usu_cod_perfil=:usu_cod_perfil, usu_permissao=:usu_permissao WHERE usu_pk_id=:usu_pk_id");
                $stmte->bindParam(":usu_pk_id", $usuario->getCod_usuario() , PDO::PARAM_INT);
                $stmte->bindParam(":usu_nome", $usuario->getNome() , PDO::PARAM_STR);
                $stmte->bindParam(":usu_login", $usuario->getLogin() , PDO::PARAM_STR);
                $stmte->bindParam(":usu_email", $usuario->getEmail() , PDO::PARAM_STR);
                $stmte->bindParam(":usu_cod_perfil", $usuario->getCod_perfil() , PDO::PARAM_INT);
                $stmte->bindParam(":usu_permissao", $usuario->getPermissao() , PDO::PARAM_STR);
                $executa = $stmte->execute();
                if($executa){
                    return 1;
                }
                else{
                    return -1;
                }
            }
            catch(PDOException $e){
                echo $e->getMessage();
                return -1;
            }
        }
        /*
          modo: 1-Nome, 2-id
        */
        function select($parametro,$modo){
            $usuario= new usuario();
            try{
                if($modo==1){
                    $stmte = $this->pdo->prepare("SELECT * FROM tb_usuario WHERE usu_nome LIKE :parametro");
                    $stmte->bindParam(":parametro", $parametro . "%" , PDO::PARAM_STR);
                }elseif ($modo==2) {
                    $stmte = $this->pdo->prepare("SELECT * FROM tb_usuario WHERE usu_pk_id = :parametro");
                    $stmte->bindParam(":parametro", $parametro , PDO::PARAM_INT);
                }
                if($stmte->execute()){
                    if($stmte->rowCount() > 0){
                        while($result = $stmte->fetch(PDO::FETCH_OBJ)){
                            $usuario->setCod_usuario($result->usu_pk_id);
                            $usuario->setNome($result->usu_nome);
                            $usuario->setLogin($result->usu_login);
                            $usuario->setSenha($result->usu_senha);
                            $usuario->setEmail($result->usu_email);
                            $usuario->setFlag_bloqueado($result->usu_flag_bloqueado);
                            $usuario->setCod_perfil($result->usu_cod_perfil);
                            $usuario->setPermissao($result->usu_permissao);
                        }
                    }
                }
                return $usuario;
            }
            catch(PDOException $e){
                echo $e->getMessage();
            }
        }

        function delete($cod_usuario){
            try{
                $block=1;
                $stmte =$this->pdo->prepare("UPDATE tb_usuario SET usu_flag_bloqueado=:usu_flag_bloqueado WHERE usu_pk_id= :usu_pk_id");
                $stmte->bindParam(":cod_usuario", $cod_usuario, PDO::PARAM_INT);
                $stmte->bindParam(":flag_bloqueado", $block , PDO::PARAM_INT);
                if ($stmte->execute()) {
                   if($stmte->rowCount() > 0){
                    return 1;
                   }else{
                        return -1;
                   }
                }else {
                    return -1;
                }
            }
            catch(PDOException $e){
                echo $e->getMessage();
                return -1;
            }
        }

        function selectAll(){
            $usuarios = array();
            try{
                $stmte = $this->pdo->prepare("SELECT * FROM tb_usuario");
                if($stmte->execute()){
                    if($stmte->rowCount() > 0){
                        while($result = $stmte->fetch(PDO::FETCH_OBJ)){
                            $usuario= new usuario();
                          	$usuario->setCod_usuario($result->usu_pk_id);
                            $usuario->setNome($result->usu_nome);
                            $usuario->setLogin($result->usu_login);
                            $usuario->setEmail($result->usu_senha);
                            $usuario->setSenha($result->usu_email);
                            $usuario->setFlag_bloqueado($result->usu_flag_bloqueado);
                            $usuario->setCod_perfil($result->usu_cod_perfil);
                            $usuario->setPermissao($result->usu_permissao);
                            array_push($usuarios, $usuario);
                        }
                    }
                }
                return $usuarios;
            }
            catch(PDOException $e){
                echo $e->getMessage();
            }
        }

        function countUsuario(){
            try{
                $stmte = $this->pdo->prepare("SELECT COUNT(*) AS usuarios FROM tb_usuario");
                $stmte->execute();
                $result = $stmte->fetch(PDO::FETCH_OBJ);
                return $result->usuarios;
            }
            catch(PDOException $e){
                echo $e->getMessage();
                return -1;
            }
        }

        function countAdmin(){
            try{
                $stmte = $this->pdo->prepare("SELECT COUNT(*) AS usuarios FROM tb_usuario WHERE usu_cod_perfil = 0");
                $stmte->execute();
                $result = $stmte->fetch(PDO::FETCH_OBJ);
                return $result->usuarios;
            }
            catch(PDOException $e){
                echo $e->getMessage();
                return -1;
            }
        }

        function updatePassword($usuario){
            try{
                 $stmte =$this->pdo->prepare("UPDATE tb_usuario SET usu_senha=:usu_senha WHERE usu_pk_id= :cod_usuario");
                  $vazio="";
                  $stmte->bindParam(":senha", md5($usuario->getSenha()) , PDO::PARAM_STR);
                  $stmte->bindParam(":cod_usuario", $usuario->getCod_Usuario() , PDO::PARAM_STR);
                 if($stmte->execute()){
                     return 1;
                 }
                 else{
                     return -1;
                 }
             }
             catch(PDOException $e){
                return $e->getMessage();
             }
        }

        function validaEmail($parametro){
          try{
              $stmte = $this->pdo->prepare("SELECT usu_pk_id FROM tb_usuario WHERE usu_email LIKE :parametro");
              $stmte->bindParam(":parametro", $parametro , PDO::PARAM_STR);
              if($stmte->execute()){
                     return 1;
                 }
                 else{
                     return -1;
                 }
             }
             catch(PDOException $e){
                return $e->getMessage();
             }
        }

        function recuperaPassword($email){
            try{
                $stmte =$this->pdo->prepare("UPDATE tb_usuario SET usu_senha=:usu_senha WHERE usu_pk_id = :cod_usuario");
                $token= password_hash($email);
                if($executa){
                    return $token;
                }
                else{
                    return -1;
                }
            }
            catch(PDOException $e){
                return $e->getMessage();
            }
        }


        function __construct($pdo){
            $this->pdo=$pdo;
        }
    }
?>
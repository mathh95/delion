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
                $stmte =$this->pdo->prepare("INSERT INTO usuario(login, senha, email, nome, cod_perfil, flag_bloqueado, permissao)
                VALUES (:login, :senha, :email, :nome, :cod_perfil, :flag_bloqueado, :permissao)");
                $stmte->bindParam(":login", $login, PDO::PARAM_STR);
                $stmte->bindParam(":senha", $senha, PDO::PARAM_STR);
                $stmte->bindParam(":email", $email, PDO::PARAM_STR);
                $stmte->bindParam(":nome", $nome, PDO::PARAM_STR);
                $stmte->bindParam(":cod_perfil", $cod_perfil , PDO::PARAM_INT);
                $stmte->bindParam(":flag_bloqueado", $flag_bloqueado , PDO::PARAM_INT);
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
                $stmte =$this->pdo->prepare("UPDATE usuario SET login=:login, email=:email, nome=:nome, cod_perfil=:cod_perfil, permissao=:permissao WHERE cod_usuario=:cod_usuario");
                $stmte->bindParam(":cod_usuario", $usuario->getCod_usuario() , PDO::PARAM_INT);
                $stmte->bindParam(":login", $usuario->getLogin() , PDO::PARAM_STR);
                $stmte->bindParam(":email", $usuario->getEmail() , PDO::PARAM_STR);
                $stmte->bindParam(":nome", $usuario->getNome() , PDO::PARAM_STR);
                $stmte->bindParam(":cod_perfil", $usuario->getCod_perfil() , PDO::PARAM_INT);
                $stmte->bindParam(":permissao", $usuario->getPermissao() , PDO::PARAM_STR);
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
            $stmte;
            $usuario= new usuario();
            try{
                if($modo==1){
                    $stmte = $this->pdo->prepare("SELECT * FROM usuario WHERE nome LIKE :parametro");
                    $stmte->bindParam(":parametro", $parametro . "%" , PDO::PARAM_STR);
                }elseif ($modo==2) {
                    $stmte = $this->pdo->prepare("SELECT * FROM usuario WHERE cod_usuario = :parametro");
                    $stmte->bindParam(":parametro", $parametro , PDO::PARAM_INT);
                }
                if($stmte->execute()){
                    if($stmte->rowCount() > 0){
                        while($result = $stmte->fetch(PDO::FETCH_OBJ)){
                            $usuario->setCod_usuario($result->cod_usuario);
                            $usuario->setNome($result->nome);
                            $usuario->setLogin($result->login);
                            $usuario->setSenha($result->senha);
                            $usuario->setEmail($result->email);
                            $usuario->setFlag_bloqueado($result->flag_bloqueado);
                            $usuario->setCod_perfil($result->cod_perfil);
                            $usuario->setPermissao($result->permissao);
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
                $stmte =$this->pdo->prepare("UPDATE usuario SET flag_bloqueado=:flag_bloqueado WHERE cod_usuario= :cod_usuario");
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
            $stmte;
            $usuarios = array();
            try{
                $stmte = $this->pdo->prepare("SELECT * FROM usuario");
                if($stmte->execute()){
                    if($stmte->rowCount() > 0){
                        while($result = $stmte->fetch(PDO::FETCH_OBJ)){
                            $usuario= new usuario();
                          	$usuario->setCod_usuario($result->cod_usuario);
                            $usuario->setNome($result->nome);
                            $usuario->setLogin($result->login);
                            $usuario->setEmail($result->email);
                            $usuario->setSenha($result->senha);
                            $usuario->setFlag_bloqueado($result->flag_bloqueado);
                            $usuario->setCod_perfil($result->cod_perfil);
                            $usuario->setPermissao($result->permissao);
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
            $stmte;
            try{
                $stmte = $this->pdo->prepare("SELECT COUNT(*) AS usuarios FROM usuario");
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
            $stmte;
            try{
                $stmte = $this->pdo->prepare("SELECT COUNT(*) AS usuarios FROM usuario WHERE cod_perfil = 0");
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
                 $stmte =$this->pdo->prepare("UPDATE usuario SET senha=:senha WHERE cod_usuario= :cod_usuario");
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
              $stmte = $this->pdo->prepare("SELECT cod_usuario FROM usuario WHERE email LIKE :parametro");
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
                $stmte =$this->pdo->prepare("UPDATE usuario SET senha=:senha WHERE cod_usuario = :cod_usuario");
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
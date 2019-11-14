<?php 
    include_once $_SERVER['DOCUMENT_ROOT']."/config.php"; 
    include_once MODELPATH."/cliente.php";
    include_once CONTROLLERPATH."/seguranca.php";
    class controlCliente{
        private $pdo;

            function insert($cliente){
                try{
                    $nome=$cliente->getNome();
                    $sobrenome=$cliente->getSobrenome();
                    $cpf=$cliente->getCpf();
                    $data_nasc=$cliente->getData_nasc();
                    $login=$cliente->getLogin();
                    $senha=hash_hmac("md5",$cliente->getSenha(), "senha");
                    $telefone=$cliente->getTelefone();
                    $status=$cliente->getStatus();
                    $stmt=$this->pdo->prepare("INSERT INTO cliente(nome, sobrenome, cpf, data_nasc, login, senha, telefone, status)
                    VALUES (:nome, :sobrenome, :cpf, :data_nasc, :login, :senha, :telefone, :status) ");
                    $stmt->bindParam(":nome", $nome, PDO::PARAM_STR);
                    $stmt->bindParam(":sobrenome", $sobrenome, PDO::PARAM_STR);
                    $stmt->bindParam(":cpf", $cpf, PDO::PARAM_STR);
                    $stmt->bindParam(":data_nasc", $data_nasc, PDO::PARAM_STR);
                    $stmt->bindParam(":login", $login, PDO::PARAM_STR);
                    $stmt->bindParam(":senha", $senha, PDO::PARAM_STR);
                    $stmt->bindParam(":telefone", $telefone, PDO::PARAM_STR);
                    $stmt->bindParam(":status", $status, PDO::PARAM_INT);
                    $executa=$stmt->execute();

                    if ($executa){
                        return 1;
                    }else{
                        return -1;
                    }

                }
                catch(PDOException $e){
                    //var_dump($e);
                    if ($e->errorInfo[1] == 1062) {
                        echo "Login já Cadastrado!\n";
                        return -2;
                    }else{
                        echo $e->getMessage();
                        return -1;
                    }
                }
            }

            function insertGoogle($cliente){
                try{
                    $nome = $cliente->getNome();
                    $login = $cliente->getLogin();
                    $idGoogle = $cliente->getIdGoogle();
                    $status = $cliente->getStatus();

                    $stmt = $this->pdo->prepare("INSERT INTO cliente(nome, login, status, id_google) VALUES (:nome, :login, :status, :idGoogle)");
                    $stmt->bindValue(":nome", $nome);
                    $stmt->bindValue(":login", $login);
                    $stmt->bindValue(":status", $status);
                    $stmt->bindValue(":idGoogle", $idGoogle);

                    $executa = $stmt->execute();

                    if($executa){
                        return 1;
                    }else{
                        return -1;
                    }
                }catch(PDOException $e){
                    echo $e->getMessage();
                    return -1;
                }
            }

            function insertFacebook($cliente){
                try{
                    $nome = $cliente->getNome();
                    $login = $cliente->getLogin();
                    $idFacebook = $cliente->getIdFacebook();
                    $status = $cliente->getStatus();

                    $stmt = $this->pdo->prepare("INSERT INTO cliente (nome, login, status, id_facebook) VALUES (:nome, :login, :status, :idFacebook)");
                    $stmt->bindParam("nome", $nome, PDO::PARAM_STR);
                    $stmt->bindParam("login", $login, PDO::PARAM_STR);
                    $stmt->bindParam("status", $status, PDO::PARAM_INT);
                    $stmt->bindParam("idFacebook", $idFacebook, PDO::PARAM_STR);

                    $executa = $stmt->execute();

                    if ($executa){
                        return 1;
                    }else{
                        return -1;
                    }
                }catch(PDOException $e){
                    echo $e->getMessage();
                    return -1;
                }
            }

            function update($cliente){
                try{
                    $cod_cliente=$cliente->getCod_cliente();
                    $nome=$cliente->getNome();
                    $sobrenome=$cliente->getSobrenome();
                    // $cpf=$cliente->getCpf();
                    // $data_nasc=$cliente->getData_nasc();
                    $login=$cliente->getLogin();
                    $telefone=$cliente->getTelefone();
                    $stmt=$this->pdo->prepare("UPDATE cliente
                    SET nome=:nome, sobrenome=:sobrenome, login=:login, telefone=:telefone WHERE cod_cliente=:cod_cliente ");
                    $stmt->bindParam(":nome", $nome, PDO::PARAM_STR);
                    $stmt->bindParam(":sobrenome", $sobrenome, PDO::PARAM_STR);
                    $stmt->bindParam(":login", $login, PDO::PARAM_STR);
                    $stmt->bindParam(":telefone", $telefone, PDO::PARAM_STR);
                    $stmt->bindParam(":cod_cliente", $cod_cliente, PDO::PARAM_STR);

                    $executa=$stmt->execute();

                    if ($executa){
                        return 1;
                    }else{
                        return -1;
                    }

                }
                catch(PDOException $e){
                    echo $e->getMessage();
                    return -1;
                }
            }

            function updateFacebook($cod_cliente,$idFacebook){
                try{
                    $stmt=$this->pdo->prepare("UPDATE cliente SET id_facebook=:idFacebook WHERE cod_cliente=:cod_cliente");
                    $stmt->bindParam(":idFacebook", $idFacebook, PDO::PARAM_STR);
                    $stmt->bindParam(":cod_cliente", $cod_cliente, PDO::PARAM_INT);
                    $executa=$stmt->execute();
                    if ($executa){
                        return 1;
                    }else{
                        return -1;
                    }
                }catch(PDOException $e){
                    echo $e->getMessage();
                    return -1;
                }
            }
            function selectAll(){
                try{
                    $clientes = array();
                    $stmt=$this->pdo->prepare("SELECT * FROM cliente");
                    $executa= $stmt->execute();
                    if ($executa){
                        if ($stmt->rowCount() > 0 ){
                            while($result=$stmt->fetch(PDO::FETCH_OBJ)){
                                $cliente = new cliente();
                                $cliente->setCod_cliente($result->cod_cliente);
                                $cliente->setLogin($result->login);
                                $cliente->setNome($result->nome);
                                $cliente->setSobrenome($result->sobrenome);
                                $cliente->setCpf($result->cpf);
                                $cliente->setData_nasc($result->data_nasc);
                                $cliente->setTelefone($result->telefone);
                                $cliente->setStatus($result->status);
                                array_push($clientes,$cliente);
                            }
                        }else{
                            echo "Sem resultados";
                            return -1;
                        }
                        return $clientes;
                    }else{
                        return -1;
                    }

                }
                catch(PDOException $e){
                    echo $e->getMessage();
                    return -1;
                }
            }

            function select($parametro,$modo){
                $stmt;
                $cliente= new cliente;
                try{
                    if($modo==1){
                        $nome= "%" . $parametro;
                        $stmt=$this->pdo->prepare("SELECT * FROM cliente WHERE nome LIKE :parametro");
                        $stmt->bindParam(":parametro", $nome, PDO::PARAM_STR);
                    }elseif($modo==2){
                        $cod_cliente=$parametro;
                        $stmt=$this->pdo->prepare("SELECT * FROM cliente WHERE cod_cliente=:parametro");
                        $stmt->bindParam(":parametro", $cod_cliente, PDO::PARAM_INT);
                    }elseif ($modo == 3) {
                        $login = $parametro;
                        $stmt=$this->pdo->prepare("SELECT * FROM cliente WHERE login = :login");
                        $stmt->bindParam(":login", $login, PDO::PARAM_STR);
                    }elseif ($modo == 4) {
                        $idFacebook= $parametro;
                        $stmt=$this->pdo->prepare("SELECT * FROM cliente WHERE id_facebook=:parametro");
                        $stmt->bindParam(":parametro", $parametro, PDO::PARAM_INT);
                    }
                    $executa=$stmt->execute();
                    if ($executa){
                        if($stmt->rowCount() > 0){
                            while($result=$stmt->fetch(PDO::FETCH_OBJ)){
                                $cliente->setCod_cliente($result->cod_cliente);
                                $cliente->setLogin($result->login);
                                $cliente->setNome($result->nome);
                                $cliente->setSobrenome($result->sobrenome);
                                $cliente->setCpf($result->cpf);
                                $cliente->setData_nasc($result->data_nasc);
                                $cliente->setTelefone($result->telefone);
                                $cliente->setStatus($result->status);
                                $cliente->setIdFacebook($result->id_facebook);
                            }
                        }
                        return $cliente;
                    }else{
                        return -1;
                    }
                }
                catch(PDOException $e){
                    echo $e->getMessage();
                    return -1;
                }
            }

            function filter($parametro){
                $stmt;
                $clientes= array();
                try{
                    $parametro= "%" . $parametro . "%";
                    $stmt=$this->pdo->prepare("SELECT * FROM cliente WHERE nome LIKE :parametro OR login LIKE :login OR telefone LIKE :telefone");
                    $stmt->bindParam(":parametro", $parametro, PDO::PARAM_STR);
                    $stmt->bindParam(":login", $parametro, PDO::PARAM_STR);
                    $stmt->bindValue(":telefone", $parametro);    
                    $executa=$stmt->execute();
                    if ($executa){
                        if($stmt->rowCount() > 0){
                            while($result=$stmt->fetch(PDO::FETCH_OBJ)){
                                $cliente= new cliente;
                                $cliente->setCod_cliente($result->cod_cliente);
                                $cliente->setLogin($result->login);
                                $cliente->setNome($result->nome);
                                $cliente->setSobrenome($result->sobrenome);
                                $cliente->setCpf($result->cpf);
                                $cliente->setData_nasc($result->data_nasc);
                                $cliente->setTelefone($result->telefone);
                                $cliente->setStatus($result->status);
                                $cliente->setIdFacebook($result->id_facebook);
                                array_push($clientes, $cliente);
                            }
                        }
                        return $clientes;
                    }else{
                        return -1;
                    }
                }
                catch(PDOException $e){
                    echo $e->getMessage();
                    return -1;
                }
            }

            function countCliente(){
                try{
                    $stmt=$this->pdo->prepare("SELECT COUNT(*) AS clientes FROM cliente");
                    $stmt->execute();
                    $result=$stmt->fetch(PDO::FETCH_OBJ);
                    return $result->clientes;
                }catch(PDOException $e){
                    echo $e->getMessage();
                    return -1;
                }
            }
            
            function validaCliente($login,$senha){
                try{
                    $stmt=$this->pdo->prepare("SELECT * FROM cliente WHERE login=:login");
                    $stmt->bindParam(":login", $login, PDO::PARAM_STR);
                    $executa=$stmt->execute();
                    if ($executa){
                        if($stmt->rowCount()>0){
                            $result=$stmt->fetch(PDO::FETCH_OBJ);
                            $senhah=$result->senha;
                            $status = $result->status;
                            $senha=hash_hmac("md5",$senha, "senha");                            
                            if(hash_equals($senha,$senhah) && $status == 1){
                                $_SESSION['cod_cliente']=$result->cod_cliente;
                                $_SESSION['nome']=$result->nome;
                                $_SESSION['sobrenome']=$result->sobrenome;
                                $_SESSION['login']=$result->login;
                                $_SESSION['telefone']=$result->telefone;
                                $_SESSION['cod_status_cliente']=$result->status;
                                
                                return 2;
                            }else if( $status == 0){
                                return 3;
                            }
                        }else{
                                return 1;
                            
                        }
                        return 0;
                    }
                }catch(PDOException $e){
                    echo $e->getMessage();
                    return -1;
                }
            }

            //valida cliente pelas redes sociais
            //MODO 0 = FACEBOOK
            //MODO 1 = GOOGLE
            function validaRedeSocial($login,$parametro,$modo){
                try{
                    $stmt=$this->pdo->prepare("SELECT * FROM cliente WHERE login=:login");
                    $stmt->bindParam(":login", $login, PDO::PARAM_STR);
                    $executa=$stmt->execute();
                    if ($executa){
                        if($stmt->rowCount()>0){
                            $result=$stmt->fetch(PDO::FETCH_OBJ);
                            if($modo == 0){
                                $idFacebook=$result->id_facebook;
                                if ($parametro == $idFacebook){
                                    $_SESSION['cod_cliente']=$result->cod_cliente;
                                    $_SESSION['nome']=$result->nome;
                                    $_SESSION['sobrenome']=$result->sobrenome;
                                    $_SESSION['login']=$result->login;
                                    $_SESSION['telefone']=$result->telefone;
                                    return 2;
                                }else{
                                    return 1;
                                }
                            }elseif ($modo == 1) {
                                $idGoogle=$result->id_google;
                                if ($parametro == $idGoogle){
                                    $_SESSION['cod_cliente']=$result->cod_cliente;
                                    $_SESSION['nome']=$result->nome;
                                    $_SESSION['sobrenome']=$result->sobrenome;
                                    $_SESSION['login']=$result->login;
                                    $_SESSION['telefone']=$result->telefone;
                                    return 2;
                                }else{
                                    return 1;
                                }
                            }
                        }
                        return 0;
                    }
                }catch(PDOException $e){
                    echo $e->getMessage();
                    return -1;
                }
            }

            function updateSenha($cod_cliente, $senha, $novaSenha){
                try{       
                    $cliente=new cliente;
                    $senha = hash_hmac("md5", $senha, "senha");
                    $novaSenha = hash_hmac("md5", $novaSenha, "senha");         
                    $stmt=$this->pdo->prepare("SELECT * FROM cliente WHERE cod_cliente=:parametro");
                    $stmt->bindParam(":parametro", $cod_cliente, PDO::PARAM_INT);
                    $executa=$stmt->execute();
                    if ($executa){
                        if($stmt->rowCount() > 0){
                            while($result=$stmt->fetch(PDO::FETCH_OBJ)){
                                $cliente->setCod_cliente($result->cod_cliente);
                                $cliente->setLogin($result->login);
                                $cliente->setNome($result->nome);
                                $cliente->setSobrenome($result->sobrenome);
                                $cliente->setCpf($result->cpf);
                                $cliente->setData_nasc($result->data_nasc);
                                $cliente->setSenha($result->senha);
                                $cliente->setTelefone($result->telefone);
                            }
                            if ($cliente->getSenha() == $senha){
                                $stmt=$this->pdo->prepare("UPDATE cliente SET senha=:novaSenha WHERE cod_cliente=:parametro");
                                $stmt->bindParam(":parametro", $cod_cliente, PDO::PARAM_INT);
                                $stmt->bindParam(":novaSenha", $novaSenha, PDO::PARAM_STR);
                                $executa=$stmt->execute();
                                if ($executa){
                                    return 2;
                                }else{
                                    return -1;
                                }
                            }else{
                                return -2;
                            }
                        }
                                                
                    }else{
                        return -1;
                    }
                    
                }catch(PDOException $e){
                    echo $e->getMessage();
                    return -1;
                }
            }

            function updateSenhaEsquecida($cod_cliente, $novaSenha){
                try{       
                    $novaSenha = hash_hmac("md5", $novaSenha, "senha");

                    $stmt=$this->pdo->prepare("SELECT * FROM cliente WHERE cod_cliente=:parametro");
                    $stmt->bindParam(":parametro", $cod_cliente, PDO::PARAM_INT);
                    
                    $executa=$stmt->execute();
                    if ($executa){

                        if($stmt->rowCount() > 0){

                            $stmt=$this->pdo->prepare("UPDATE cliente SET senha=:novaSenha WHERE cod_cliente=:parametro");
                            $stmt->bindParam(":parametro", $cod_cliente, PDO::PARAM_INT);
                            $stmt->bindParam(":novaSenha", $novaSenha, PDO::PARAM_STR);
                            $executa=$stmt->execute();
                            if ($executa){
                                return 2;
                            }else{
                                return -1;
                            }
                        }
                                                
                    }else{
                        return -1;
                    }
                    
                }catch(PDOException $e){
                    echo $e->getMessage();
                    return -1;
                }
            }

            function delete($cod_cliente){
                try{
                    $status=0;
                    $parametro=$cod_cliente;
                    $stmt=$this->pdo->prepare("UPDATE cliente SET status=:status WHERE cod_cliente=:parametro");
                    $stmt->bindParam("status",$status,PDO::PARAM_INT);
                    $stmt->bindParam("parametro",$parametro,PDO::PARAM_INT);
                    $executa=$stmt->execute();
                    if ($executa){
                        return 1;
                    }else{
                        return -1;
                    }
                }catch(PDOException $e){
                    echo $e->getMessage();
                    return -1;
                }
            }

            function insertRecuperaSenha($cod_cliente_fk, $cod_recuperacao, $data_expiracao){
                try{
                    $stmt=$this->pdo->prepare("INSERT INTO recupera_senha(cod_cliente_fk, cod_recuperacao, data_expiracao)
                    VALUES (:cod_cliente_fk, :cod_recuperacao, :data_expiracao) ");
                    $stmt->bindParam(":cod_cliente_fk", $cod_cliente_fk, PDO::PARAM_INT);
                    $stmt->bindParam(":cod_recuperacao", $cod_recuperacao, PDO::PARAM_STR);
                    $stmt->bindParam(":data_expiracao", $data_expiracao, PDO::PARAM_STR);
                    $executa=$stmt->execute();

                    if ($executa){
                        return 1;
                    }else{
                        return -1;
                    }

                }
                catch(PDOException $e){
                    echo $e->getMessage();
                    return -1;
                }
            }

            function getCodRecuperacao($cod_recuperacao){
                try{

                    $stmt=$this->pdo->prepare("SELECT * FROM recupera_senha WHERE cod_recuperacao = :cod_recuperacao");
                    $stmt->bindParam(":cod_recuperacao", $cod_recuperacao, PDO::PARAM_STR);
                    $executa=$stmt->execute();

                    if($stmt->rowCount() > 0){
                        $result=$stmt->fetchAll(PDO::FETCH_ASSOC);
                    }else{
                        $result = 0;
                    }

                    if ($executa && ($result != 0)){
                        return $result;
                    }else{
                        return -1;
                    }

                }
                catch(PDOException $e){
                    echo $e->getMessage();
                    return -1;
                }
            }

            
            function setRecuperacao($cod_recuperacao){
                try{       

                    $stmt=$this->pdo->prepare("UPDATE recupera_senha SET recuperado=1 WHERE cod_recuperacao=:cod_recuperacao");
                    $stmt->bindParam(":cod_recuperacao", $cod_recuperacao, PDO::PARAM_STR);
                    $executa=$stmt->execute();
                    
                    if ($executa){
                        return 1;
                    }else{
                        return -1;
                    }
                            
                }catch(PDOException $e){
                    echo $e->getMessage();
                    return -1;
                }
            }
        function __construct($pdo){
            $this->pdo=$pdo;
        }
    }
?>

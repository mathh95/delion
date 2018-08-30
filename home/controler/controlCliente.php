<?php 
    include_once $_SERVER['DOCUMENT_ROOT']."/config.php"; 
    include_once MODELPATH."/cliente.php";
    include_once CONTROLLERPATH."/seguranca.php";
    class controlCliente{
        private $pdo;

            function insert($cliente){
                try{
                    $nome=$cliente->getNome();
                    $login=$cliente->getLogin();
                    $senha=hash_hmac("md5",$cliente->getSenha(), "senha");
                    $telefone=$cliente->getTelefone();
                    $status=$cliente->getStatus();
                    $stmt=$this->pdo->prepare("INSERT INTO cliente(nome, login, senha, telefone, status)
                    VALUES (:nome, :login, :senha, :telefone, :status) ");
                    $stmt->bindParam(":nome", $nome, PDO::PARAM_STR);
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
                    echo $e->getMessage();
                    return -1;
                }
            }

            function update($cliente){
                try{
                    $cod_cliente=$cliente->getCod_cliente();
                    $nome=$cliente->getNome();
                    $login=$cliente->getLogin();
                    $telefone=$cliente->getTelefone();
                    $stmt=$this->pdo->prepare("UPDATE cliente
                    SET nome=:nome, login=:login, telefone=:telefone WHERE cod_cliente=:cod_cliente ");
                    $stmt->bindParam(":nome", $nome, PDO::PARAM_STR);
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
                        $nome=$parametro . "%";
                        $stmt=$this->pdo->prepare("SELECT * FROM cliente WHERE nome LIKE :parametro");
                        $stmt->bindParam(":parametro", $nome, PDO::PARAM_STR);
                    }elseif($modo==2){
                        $cod_cliente=$parametro;
                        $stmt=$this->pdo->prepare("SELECT * FROM cliente WHERE cod_cliente=:parametro");
                        $stmt->bindParam(":parametro", $cod_cliente, PDO::PARAM_INT);
                    }
                    $executa=$stmt->execute();
                    if ($executa){
                        if($stmt->rowCount() > 0){
                            while($result=$stmt->fetch(PDO::FETCH_OBJ)){
                                $cliente->setCod_cliente($result->cod_cliente);
                                $cliente->setLogin($result->login);
                                $cliente->setNome($result->nome);
                                $cliente->setTelefone($result->telefone);
                                $cliente->setStatus($result->status);
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
                            $senha=hash_hmac("md5",$senha, "senha");                            
                            if(hash_equals($senha,$senhah)){
                                $_SESSION['cod_cliente']=$result->cod_cliente;
                                $_SESSION['nome']=$result->nome;
                                $_SESSION['login']=$result->login;
                                $_SESSION['telefone']=$result->telefone;
                                return 2;
                            }
                        }
                        return 1;
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
  // Cria tabela cliente no banco      
/*         function createTable(){
            try{
                $stmt= $this->pdo->prepare("CREATE TABLE cliente(
                    cod_cliente INT PRIMARY KEY AUTO_INCREMENT,
                    nome VARCHAR(255) NOT NULL,
                    login VARCHAR(255) NOT NULL UNIQUE,
                    senha VARCHAR(32) NOT NULL,
                    telefone VARCHAR(15) NOT NULL,
                    status BOOLEAN NOT NULL
                )");
                $exec= $stmt->execute();
                if ($exec){
                    echo "sucess";
                }else {
                    echo "fail";
                }

            }
            catch(PDOException $e){
                echo $e->getMessage();
                return -1;
           }

        }
 */
        function __construct($pdo){
            $this->pdo=$pdo;
        }
    }
?>

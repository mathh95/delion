<?php 
    include_once $_SERVER['DOCUMENT_ROOT']."/config.php"; 
    include_once MODELPATH."/cliente.php";
    include_once CONTROLLERPATH."/seguranca.php";
    protegePagina();

    class controlCliente{
        private $pdo;

            function insert($cliente){
                try{
                    $nome=$cliente->getNome();
                    $login=$cliente->getLogin();
                    $senha=md5(password_hash($cliente->getSenha(), PASSWORD_DEFAULT));
                    $telefone=$cliente->getTelefone();
                    $stmt=$this->pdo->prepare("INSERT INTO cliente(nome, login, senha, telefone)
                    VALUES (:nome, :login, :senha, :telefone) ");
                    $stmt->bindParam(":nome", $nome, PDO::PARAM_STR);
                    $stmt->bindParam(":login", $login, PDO::PARAM_STR);
                    $stmt->bindParam(":senha", $senha, PDO::PARAM_STR);
                    $stmt->bindParam(":telefone", $telefone, PDO::PARAM_STR);

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
                                $cliente->setSenha($result->senha);
                                $cliente->setTelefone($result->telefone);
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
                    }elseif ($modo==2) {
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
                                $cliente->setSenha($result->senha);
                                $cliente->setTelefone($result->telefone);
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

  // Cria tabela cliente no banco      
/*         function createTable(){
            try{
                $stmt= $this->pdo->prepare("CREATE TABLE cliente(
                    cod_cliente INT PRIMARY KEY AUTO_INCREMENT,
                    nome VARCHAR(255) NOT NULL,
                    login VARCHAR(255) NOT NULL,
                    senha VARCHAR(32) NOT NULL,
                    telefone VARCHAR(15) NOT NULL 
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

    $teste=new controlCliente($_SG['link']);
    $clientet= new cliente;
/*     $clientet->setCod_cliente(5);
    $clientet->setLogin("teste2");
    $clientet->setNome("teste2");
    $clientet->setTelefone("22222");
    $clientet->setSenha("teste2"); */
    $cliente=$teste->select("ar", 1);
    echo $cliente->getNome();


?>
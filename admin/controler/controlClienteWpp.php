<?php 
    include_once $_SERVER['DOCUMENT_ROOT']."/config.php"; 
    include_once MODELPATH."/cliente-wpp.php";
    include_once CONTROLLERPATH."/seguranca.php";
    class controlClienteWpp{
        private $pdo;

            function insert($clientewpp){
                try{
                    $nome=$clientewpp->getNome();
                    $telefone=$clientewpp->getTelefone();
                    $rua=$clientewpp->getRua();
                    $numero=$clientewpp->getNumero();
                    $bairro=$clientewpp->getBairro();
                    $complemento=$clientewpp->getComplemento();
                    $stmt=$this->pdo->prepare("INSERT INTO cliente_wpp(nome, telefone, rua, numero, bairro , complemento)
                    VALUES (:nome, :telefone, :rua, :numero, :bairro, :complemento) ");
                    $stmt->bindParam(":nome", $nome, PDO::PARAM_STR);
                    $stmt->bindParam(":telefone", $telefone, PDO::PARAM_INT);
                    $stmt->bindParam(":rua", $rua, PDO::PARAM_STR);
                    $stmt->bindParam(":numero", $numero, PDO::PARAM_STR);
                    $stmt->bindParam(":bairro", $bairro, PDO::PARAM_STR);
                    $stmt->bindParam(":complemento", $complemento, PDO::PARAM_STR);
                    $executa=$stmt->execute();
                    return $this->pdo->lastInsertId();

                }
                catch(PDOException $e){
                    echo $e->getMessage();
                    return -1;
                }
            }

           


            function update($clientewpp){
                try{
                    $cod_cliente_wpp=$clientewpp->getCod_cliente_wpp();
                    $nome=$clientewpp->getNome();
                    $telefone=$clientewpp->getTelefone();
                    $rua=$clientewpp->getRua();
                    $numero=$clientewpp->getNumero();
                    $bairro=$clientewpp->getBairro();
                    $complemento=$clientewpp->getComplemento();
                    $stmt=$this->pdo->prepare("UPDATE cliente_wpp
                    SET nome=:nome, telefone=:telefone, rua=:rua, numero=:numero, bairro=:bairro, complemento=:complemento WHERE cod_cliente_wpp=:cod_cliente_wpp ");
                    $stmt->bindParam(":nome", $nome, PDO::PARAM_STR);
                    $stmt->bindParam(":telefone", $telefone, PDO::PARAM_INT);
                    $stmt->bindParam(":rua", $rua, PDO::PARAM_STR);
                    $stmt->bindParam(":numero", $numero, PDO::PARAM_STR);
                    $stmt->bindParam(":bairro", $bairro, PDO::PARAM_STR);
                    $stmt->bindParam(":complemento", $complemento, PDO::PARAM_STR);
                    $stmt->bindParam(":cod_cliente_wpp", $cod_cliente_wpp, PDO::PARAM_INT);

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
                    $stmt=$this->pdo->prepare("SELECT * FROM cliente_wpp");
                    $executa= $stmt->execute();
                    if ($executa){
                        if ($stmt->rowCount() > 0 ){
                            while($result=$stmt->fetch(PDO::FETCH_OBJ)){
                                $clientewpp = new ClienteWpp();
                                $clientewpp->setCod_cliente_wpp($result->cod_cliente_wpp);
                                $clientewpp->setNome($result->nome);
                                $clientewpp->setTelefone($result->telefone);
                                $clientewpp->setRua($result->rua);
                                $clientewpp->setNumero($result->numero);
                                $clientewpp->setBairro($result->bairro);
                                $clientewpp->setComplemento($result->complemento);
                                array_push($clientes, $clientewpp);
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

            function select($parametro){
                $stmt;
                $clientewpp= new ClienteWpp;
                try{
                    
                    $cod_cliente_wpp=$parametro;
                    $stmt=$this->pdo->prepare("SELECT * FROM cliente_wpp WHERE cod_cliente_wpp=:parametro");
                    $stmt->bindParam(":parametro", $cod_cliente_wpp, PDO::PARAM_INT);
                   
                    $executa=$stmt->execute();
                    if ($executa){
                        if($stmt->rowCount() > 0){
                            while($result=$stmt->fetch(PDO::FETCH_OBJ)){
                                $clientewpp = new ClienteWpp();
                                $clientewpp->setCod_cliente_wpp($result->cod_cliente_wpp);
                                $clientewpp->setNome($result->nome);
                                $clientewpp->setTelefone($result->telefone);
                                $clientewpp->setRua($result->rua);
                                $clientewpp->setNumero($result->numero);
                                $clientewpp->setBairro($result->bairro);
                                $clientewpp->setComplemento($result->complemento);
                            }
                        }
                        return $clientewpp;
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
                    $stmt=$this->pdo->prepare("SELECT * FROM cliente_wpp WHERE nome LIKE :parametro OR telefone LIKE :telefone");
                    $stmt->bindParam(":parametro", $parametro, PDO::PARAM_STR);
                    $stmt->bindValue(":telefone", $parametro);    
                    $executa=$stmt->execute();
                    if ($executa){
                        if($stmt->rowCount() > 0){
                            while($result=$stmt->fetch(PDO::FETCH_OBJ)){
                                $clientewpp = new clienteWpp;
                                $clientewpp->setCod_cliente_wpp($result->cod_cliente_wpp);
                                $clientewpp->setNome($result->nome);
                                $clientewpp->setTelefone($result->telefone);
                                $clientewpp->setRua($result->rua);
                                $clientewpp->setNumero($result->numero);
                                $clientewpp->setBairro($result->bairro);
                                $clientewpp->setComplemento($result->complemento);
                                array_push($clientes, $clientewpp);
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
                    $stmt=$this->pdo->prepare("SELECT COUNT(*) AS clientes FROM cliente_wpp");
                    $stmt->execute();
                    $result=$stmt->fetch(PDO::FETCH_OBJ);
                    return $result->clientes;
                }catch(PDOException $e){
                    echo $e->getMessage();
                    return -1;
                }
            }
            

            /* function delete($cod_cliente){
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
            } */
 
        function __construct($pdo){
            $this->pdo=$pdo;
        }
    }
?>

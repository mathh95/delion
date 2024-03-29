<?php 
    include_once $_SERVER['DOCUMENT_ROOT']."/config.php"; 
    include_once MODELPATH."/cliente.php";
    include_once CONTROLLERPATH."/seguranca.php";
    class controlCliente{
        private $pdo;

            function insert($cliente){
                try{
                    $nome = $cliente->getNome();
                    $sobrenome = $cliente->getSobrenome();
                    $cpf = $cliente->getCpf();
                    $data_nasc = $cliente->getData_nasc();
                    $login = $cliente->getLogin();
                    $senha = hash_hmac("sha256" , $cliente->getSenha(), HASHKEY);
                    $telefone = $cliente->getTelefone();
                    $status = $cliente->getStatus();

                    $stmt=$this->pdo->prepare("INSERT INTO tb_cliente(cli_nome, cli_sobrenome, cli_cpf, cli_data_nasc, cli_login_email, cli_senha, cli_telefone, cli_status)
                    VALUES (:nome, :sobrenome, :cpf, :data_nasc, :login, :senha, :telefone, :status) ");
                    
                    $stmt->bindParam(":nome", $nome, PDO::PARAM_STR);
                    $stmt->bindParam(":sobrenome", $sobrenome, PDO::PARAM_STR);
                    $stmt->bindParam(":cpf", $cpf, PDO::PARAM_INT);
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
                    $sobrenome = $cliente->getSobrenome();
                    $login = $cliente->getLogin();
                    $id_google = $cliente->getIdGoogle();
                    $status = $cliente->getStatus();

                    $stmt = $this->pdo->prepare("INSERT INTO tb_cliente(cli_nome, cli_sobrenome, cli_login_email, cli_status, cli_id_google) VALUES (:nome, :sobrenome, :login, :status, :id_google)");
                    $stmt->bindValue(":nome", $nome, PDO::PARAM_STR);
                    $stmt->bindValue(":sobrenome", $sobrenome, PDO::PARAM_STR);
                    $stmt->bindValue(":login", $login, PDO::PARAM_STR);
                    $stmt->bindValue(":status", $status, PDO::PARAM_INT);
                    $stmt->bindValue(":id_google", $id_google, PDO::PARAM_STR);

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
                    $sobrenome = $cliente->getSobrenome();
                    $login_email = $cliente->getLogin();
                    $id_facebook = $cliente->getIdFacebook();
                    $status = $cliente->getStatus();

                    $stmt = $this->pdo->prepare("INSERT INTO tb_cliente (cli_nome, cli_sobrenome, cli_login_email, cli_status, cli_id_facebook) VALUES (:nome, :sobrenome, :login, :status, :idFacebook)");

                    $stmt->bindParam("nome", $nome, PDO::PARAM_STR);
                    $stmt->bindParam("sobrenome", $sobrenome, PDO::PARAM_STR);
                    $stmt->bindParam("login", $login_email, PDO::PARAM_STR);
                    $stmt->bindParam("status", $status, PDO::PARAM_INT);
                    $stmt->bindParam("idFacebook", $id_facebook, PDO::PARAM_STR);

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
                    $cli_pk_id=$cliente->getPkId();
                    $nome=$cliente->getNome();
                    $sobrenome=$cliente->getSobrenome();
                    $login=$cliente->getLogin();
                    $telefone=$cliente->getTelefone();
                    
                    $stmt=$this->pdo->prepare("UPDATE tb_cliente
                    SET cli_nome=:nome, cli_sobrenome=:sobrenome, cli_login_email=:login, cli_telefone=:telefone WHERE cli_pk_id=:cli_pk_id ");
                    $stmt->bindParam(":nome", $nome, PDO::PARAM_STR);
                    $stmt->bindParam(":sobrenome", $sobrenome, PDO::PARAM_STR);
                    $stmt->bindParam(":login", $login, PDO::PARAM_STR);
                    $stmt->bindParam(":telefone", $telefone, PDO::PARAM_STR);
                    $stmt->bindParam(":cli_pk_id", $cli_pk_id, PDO::PARAM_STR);

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

            function completarCadastro($cliente){
                try{
                    $cli_pk_id = $cliente->getPkId();
                    $cpf = $cliente->getCpf();
                    $data_nasc = $cliente->getData_nasc();
                    $telefone = $cliente->getTelefone();
                    
                    $stmt=$this->pdo->prepare("UPDATE tb_cliente
                    SET cli_cpf=:cpf, cli_data_nasc=:data_nasc, cli_telefone=:telefone
                    WHERE cli_pk_id=:pk_id");

                    $stmt->bindParam(":pk_id", $cli_pk_id, PDO::PARAM_INT);
                    $stmt->bindParam(":cpf", $cpf, PDO::PARAM_INT);
                    $stmt->bindParam(":data_nasc", $data_nasc, PDO::PARAM_STR);
                    $stmt->bindParam(":telefone", $telefone, PDO::PARAM_STR);

                    $executa = $stmt->execute();

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

            function updateDate($cliente){
                try{
                    $cli_pk_id=$cliente->getPkId();
                    $nome=$cliente->getNome();
                    $sobrenome=$cliente->getSobrenome();
                    $login=$cliente->getLogin();
                    $telefone=$cliente->getTelefone();

                    $stmt=$this->pdo->prepare("UPDATE tb_cliente
                    SET cli_nome=:nome, cli_sobrenome=:sobrenome, cli_login_email=:login, cli_telefone=:telefone, cli_dt_alteracao_fone=NOW() WHERE cli_pk_id=:cli_pk_id");
                    $stmt->bindParam(":nome", $nome, PDO::PARAM_STR);
                    $stmt->bindParam(":sobrenome", $sobrenome, PDO::PARAM_STR);
                    $stmt->bindParam(":login", $login, PDO::PARAM_STR);
                    $stmt->bindParam(":telefone", $telefone, PDO::PARAM_STR);
                    $stmt->bindParam(":cli_pk_id", $cli_pk_id, PDO::PARAM_STR);

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

            function verifyDate($parametro){
                $cliente= new cliente;
                try{
                    $cli_pk_id=$parametro;
                    $stmt=$this->pdo->prepare("SELECT * FROM tb_cliente WHERE cli_pk_id=:cli_pk_id");
                    $stmt->bindParam(":cli_pk_id", $cli_pk_id, PDO::PARAM_INT);
                    $executa=$stmt->execute();

                    if($executa){
                        if($stmt->rowCount() > 0){
                            while($result=$stmt->fetch(PDO::FETCH_OBJ)){
                                $cliente->setPkId($result->cli_pk_id);
                                $cliente->setLogin($result->cli_login_email);
                                $cliente->setNome($result->cli_nome);
                                $cliente->setSobrenome($result->cli_sobrenome);
                                $cliente->setCpf($result->cli_cpf);
                                $cliente->setData_nasc($result->cli_data_nasc);
                                $cliente->setSenha($result->cli_senha);
                                $cliente->setTelefone($result->cli_telefone);
                                $cliente->setDtAlteracaoFone($result->cli_dt_alteracao_fone);
                                $cliente->setStatus($result->cli_status);
                                $cliente->setIdFacebook($result->cli_id_facebook);
                            }
                        }
                        
                        $data_atual = date("Y-m-d");
                        $data_alteracao = $cliente->getDtAlteracaoFone();

                        // Calcula a diferença em segundos entre as datas
                        $diferenca = strtotime($data_atual) - strtotime($data_alteracao);

                        //Calcula a diferença em dias
                        $dias = floor($diferenca / (60 * 60 * 24));

                        return $dias;

                    }else{
                        return $dias;
                    }

                }
                catch(PDOException $e){
                    echo $e->getMessage();
                    return -1;
                }
            }

            function verifyFone($parametro,$fone){
                $cliente= new cliente;
                try{
                    $cli_pk_id=$parametro;
                    $stmt=$this->pdo->prepare("SELECT * FROM tb_cliente WHERE cli_pk_id=:cli_pk_id");
                    $stmt->bindParam(":cli_pk_id", $cli_pk_id, PDO::PARAM_INT);
                    $executa=$stmt->execute();

                    if($executa){
                        if($stmt->rowCount() > 0){
                            while($result=$stmt->fetch(PDO::FETCH_OBJ)){
                                $cliente->setPkId($result->cli_pk_id);
                                $cliente->setLogin($result->cli_login_email);
                                $cliente->setNome($result->cli_nome);
                                $cliente->setSobrenome($result->cli_sobrenome);
                                $cliente->setCpf($result->cli_cpf);
                                $cliente->setData_nasc($result->cli_data_nasc);
                                $cliente->setSenha($result->cli_senha);
                                $cliente->setTelefone($result->cli_telefone);
                                $cliente->setDtAlteracaoFone($result->cli_dt_alteracao_fone);
                                $cliente->setStatus($result->cli_status);
                                $cliente->setIdFacebook($result->cli_id_facebook);
                            }
                        }

                        $fone_salvo = $cliente->getTelefone();

                        if($fone_salvo === $fone){
                            $flag_controle = 1;
                        }else{
                            $flag_controle = -1;
                        }

                        return $flag_controle;

                    }else{
                        return $flag_controle;
                    }

                }
                catch(PDOException $e){
                    echo $e->getMessage();
                    return -1;
                }
            }

            function updateEmail($cli_pk_id, $login_email){
                try{
                    $stmt = $this->pdo->prepare("UPDATE tb_cliente SET cli_login_email=:login_email WHERE cli_pk_id=:cli_pk_id");
                    $stmt->bindParam(":login_email", $login_email, PDO::PARAM_STR);
                    $stmt->bindParam(":cli_pk_id", $cli_pk_id, PDO::PARAM_INT);
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

            function updateIdFacebook($cli_pk_id, $id_facebook){
                try{
                    $stmt=$this->pdo->prepare("UPDATE tb_cliente SET cli_id_facebook=:id_facebook WHERE cli_pk_id=:cli_pk_id");
                    $stmt->bindParam(":id_facebook", $id_facebook, PDO::PARAM_STR);
                    $stmt->bindParam(":cli_pk_id", $cli_pk_id, PDO::PARAM_INT);
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

            function updateIdGoogle($cli_pk_id, $id_google){
                try{
                    $stmt=$this->pdo->prepare("UPDATE tb_cliente SET cli_id_google=:id_google WHERE cli_pk_id=:cli_pk_id");
                    $stmt->bindParam(":id_google", $id_google, PDO::PARAM_STR);
                    $stmt->bindParam(":cli_pk_id", $cli_pk_id, PDO::PARAM_INT);
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

            function selectAll(){
                try{
                    $clientes = array();
                    $stmt=$this->pdo->prepare("SELECT * FROM tb_cliente ORDER BY cli_status DESC");
                    $executa= $stmt->execute();
                    if ($executa){
                        if ($stmt->rowCount() > 0 ){
                            while($result=$stmt->fetch(PDO::FETCH_OBJ)){
                                $cliente = new cliente();
                                $cliente->setPkId($result->cli_pk_id);
                                $cliente->setLogin($result->cli_login_email);
                                $cliente->setNome($result->cli_nome);
                                $cliente->setSobrenome($result->cli_sobrenome);
                                $cliente->setCpf($result->cli_cpf);
                                $cliente->setData_nasc($result->cli_data_nasc);
                                $cliente->setTelefone($result->cli_telefone);
                                $cliente->setStatus($result->cli_status);
                                $cliente->setPontosFidelidade($result->cli_pontos_fidelidade);
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

            function selectAllAtivos(){
                try{
                    $clientes = array();
                    $stmt=$this->pdo->prepare("SELECT *
                    FROM tb_cliente
                    WHERE cli_status = 1 ORDER by cli_nome");
                    $executa= $stmt->execute();
                    if ($executa){
                        if ($stmt->rowCount() > 0 ){
                            while($result=$stmt->fetch(PDO::FETCH_OBJ)){
                                $cliente = new cliente();
                                $cliente->setPkId($result->cli_pk_id);
                                $cliente->setLogin($result->cli_login_email);
                                $cliente->setNome($result->cli_nome);
                                $cliente->setSobrenome($result->cli_sobrenome);
                                $cliente->setCpf($result->cli_cpf);
                                $cliente->setData_nasc($result->cli_data_nasc);
                                $cliente->setTelefone($result->cli_telefone);
                                $cliente->setStatus($result->cli_status);
                                $cliente->setPontosFidelidade($result->cli_pontos_fidelidade);
                                array_push($clientes, $cliente);
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


            function selectAllAtivosCountPedidos(){
                try{

                    $clientes = array();
                    $stmt = $this->pdo->prepare("SELECT *, MAX(ped_data) AS ultimo_pedido, COUNT(ped_fk_cliente) AS n_pedidos
                    FROM tb_cliente
                    LEFT JOIN tb_pedido
                    ON cli_pk_id = ped_fk_cliente
                    WHERE cli_status = 1
                    GROUP BY cli_pk_id");

                    $executa = $stmt->execute();
                    if ($executa){
                        if ($stmt->rowCount() > 0 ){
                            while($result=$stmt->fetch(PDO::FETCH_OBJ)){

                                $cliente = new cliente();
                                $cliente->setPkId($result->cli_pk_id);
                                $cliente->setLogin($result->cli_login_email);
                                $cliente->setNome($result->cli_nome);
                                $cliente->setSobrenome($result->cli_sobrenome);
                                $cliente->setCpf($result->cli_cpf);
                                $cliente->setData_nasc($result->cli_data_nasc);
                                $cliente->setTelefone($result->cli_telefone);
                                $cliente->setStatus($result->cli_status);
                                $cliente->setPontosFidelidade($result->cli_pontos_fidelidade);

                                $cliente->n_pedidos = $result->n_pedidos;
                                $cliente->ultimo_pedido = $result->ultimo_pedido;

                                array_push($clientes, $cliente);
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

            function select($parametro, $modo){

                $cliente = new cliente;
                try{
                    if($modo==1){
                        $nome= "%" . $parametro;
                        $stmt=$this->pdo->prepare("SELECT * FROM tb_cliente WHERE cli_nome LIKE :parametro");
                        $stmt->bindParam(":parametro", $nome, PDO::PARAM_STR);

                    }elseif($modo==2){
                        $cli_pk_id=$parametro;
                        $stmt=$this->pdo->prepare("SELECT * FROM tb_cliente WHERE cli_pk_id=:parametro");
                        $stmt->bindParam(":parametro", $cli_pk_id, PDO::PARAM_INT);

                    }elseif ($modo == 3) {
                        $login = $parametro;
                        $stmt=$this->pdo->prepare("SELECT * FROM tb_cliente WHERE cli_login_email = :login");
                        $stmt->bindParam(":login", $login, PDO::PARAM_STR);

                    }elseif ($modo == 4) {
                        $idFacebook= $parametro;
                        $stmt=$this->pdo->prepare("SELECT * FROM tb_cliente WHERE cli_id_facebook=:parametro");
                        $stmt->bindParam(":parametro", $idFacebook, PDO::PARAM_INT);
                    }
                    
                    $executa=$stmt->execute();
                    if ($executa){
                        if($stmt->rowCount() > 0){
                            while($result=$stmt->fetch(PDO::FETCH_OBJ)){
                                $cliente->setPkId($result->cli_pk_id);
                                $cliente->setLogin($result->cli_login_email);
                                $cliente->setNome($result->cli_nome);
                                $cliente->setSobrenome($result->cli_sobrenome);
                                $cliente->setCpf($result->cli_cpf);
                                $cliente->setData_nasc($result->cli_data_nasc);
                                $cliente->setTelefone($result->cli_telefone);
                                $cliente->setStatus($result->cli_status);
                                $cliente->setIdFacebook($result->cli_id_facebook);
                                $cliente->setIdGoogle($result->cli_id_facebook);
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

            function selectByEmail($login_email){

                $cliente = new cliente;
                try{                    
                    $stmt=$this->pdo->prepare("SELECT *
                    FROM tb_cliente
                    WHERE cli_login_email=:parametro");
                    $stmt->bindParam(":parametro", $login_email, PDO::PARAM_STR);
                    
                    $executa=$stmt->execute();
                    if ($executa){
                        if($stmt->rowCount() > 0){
                            while($result=$stmt->fetch(PDO::FETCH_OBJ)){
                                $cliente->setPkId($result->cli_pk_id);
                                $cliente->setLogin($result->cli_login_email);
                                $cliente->setNome($result->cli_nome);
                                $cliente->setSobrenome($result->cli_sobrenome);
                                $cliente->setCpf($result->cli_cpf);
                                $cliente->setData_nasc($result->cli_data_nasc);
                                $cliente->setTelefone($result->cli_telefone);
                                $cliente->setStatus($result->cli_status);
                                $cliente->setIdFacebook($result->cli_id_facebook);
                                $cliente->setIdGoogle($result->cli_id_facebook);
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

            function selectByIdFacebook($id_facebook){

                $cliente = new cliente;
                try{                    
                    $stmt=$this->pdo->prepare("SELECT *
                    FROM tb_cliente
                    WHERE cli_id_facebook=:parametro");
                    $stmt->bindParam(":parametro", $id_facebook, PDO::PARAM_INT);
                    
                    $executa=$stmt->execute();
                    if ($executa){
                        if($stmt->rowCount() > 0){
                            while($result=$stmt->fetch(PDO::FETCH_OBJ)){
                                $cliente->setPkId($result->cli_pk_id);
                                $cliente->setLogin($result->cli_login_email);
                                $cliente->setNome($result->cli_nome);
                                $cliente->setSobrenome($result->cli_sobrenome);
                                $cliente->setCpf($result->cli_cpf);
                                $cliente->setData_nasc($result->cli_data_nasc);
                                $cliente->setTelefone($result->cli_telefone);
                                $cliente->setStatus($result->cli_status);
                                $cliente->setIdFacebook($result->cli_id_facebook);
                                $cliente->setPontosFidelidade($result->cli_pontos_fidelidade);
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

            function selectByIdGoogle($id_google){

                $cliente = new cliente;
                try{                    
                    $stmt=$this->pdo->prepare("SELECT *
                    FROM tb_cliente
                    WHERE cli_id_google=:parametro");
                    $stmt->bindParam(":parametro", $id_google, PDO::PARAM_INT);
                    
                    $executa=$stmt->execute();
                    if ($executa){
                        if($stmt->rowCount() > 0){
                            while($result=$stmt->fetch(PDO::FETCH_OBJ)){
                                $cliente->setPkId($result->cli_pk_id);
                                $cliente->setLogin($result->cli_login_email);
                                $cliente->setNome($result->cli_nome);
                                $cliente->setSobrenome($result->cli_sobrenome);
                                $cliente->setCpf($result->cli_cpf);
                                $cliente->setData_nasc($result->cli_data_nasc);
                                $cliente->setTelefone($result->cli_telefone);
                                $cliente->setStatus($result->cli_status);
                                $cliente->setIdFacebook($result->cli_id_google);
                                $cliente->setPontosFidelidade($result->cli_pontos_fidelidade);
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

            function selectById($pk_id){

                $cliente = new cliente;
                try{                    
                    $stmt=$this->pdo->prepare("SELECT *
                    FROM tb_cliente
                    WHERE cli_pk_id=:pk_id");

                    $stmt->bindParam(":pk_id", $pk_id, PDO::PARAM_INT);
                    
                    $executa=$stmt->execute();
                    if ($executa){
                        if($stmt->rowCount() > 0){
                            while($result=$stmt->fetch(PDO::FETCH_OBJ)){
                                $cliente->setPkId($result->cli_pk_id);
                                $cliente->setLogin($result->cli_login_email);
                                $cliente->setNome($result->cli_nome);
                                $cliente->setSobrenome($result->cli_sobrenome);
                                $cliente->setCpf($result->cli_cpf);
                                $cliente->setData_nasc($result->cli_data_nasc);
                                $cliente->setTelefone($result->cli_telefone);
                                $cliente->setStatus($result->cli_status);
                                $cliente->setIdFacebook($result->cli_id_google);
                                $cliente->setPontosFidelidade($result->cli_pontos_fidelidade);
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

                $clientes= array();
                try{
                    $stmt=$this->pdo->prepare("SELECT * FROM tb_cliente WHERE cli_nome LIKE :parametro OR cli_login_email LIKE :login OR cli_telefone LIKE :telefone");
                    
                    $stmte->bindValue(":parametro","%".$parametro."%");
                    $stmt->bindParam(":login", $parametro, PDO::PARAM_STR);
                    $stmt->bindValue(":telefone", $parametro);    
                    $executa=$stmt->execute();
                    if ($executa){
                        if($stmt->rowCount() > 0){
                            while($result=$stmt->fetch(PDO::FETCH_OBJ)){
                                $cliente= new cliente;
                                $cliente->setPkId($result->cli_pk_id);
                                $cliente->setLogin($result->cli_login_email);
                                $cliente->setNome($result->cli_nome);
                                $cliente->setSobrenome($result->cli_sobrenome);
                                $cliente->setCpf($result->cli_cpf);
                                $cliente->setData_nasc($result->cli_data_nasc);
                                $cliente->setTelefone($result->cli_telefone);
                                $cliente->setStatus($result->cli_status);
                                $cliente->setIdFacebook($result->cli_id_facebook);
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
                    $stmt=$this->pdo->prepare("SELECT COUNT(*) AS clientes FROM tb_cliente");
                    $stmt->execute();
                    $result=$stmt->fetch(PDO::FETCH_OBJ);
                    return $result->cli_clientes;
                }catch(PDOException $e){
                    echo $e->getMessage();
                    return -1;
                }
            }
            
            function validaCliente($login, $senha){
                try{
                    $stmt=$this->pdo->prepare("SELECT * FROM tb_cliente WHERE cli_login_email=:login");
                    $stmt->bindParam(":login", $login, PDO::PARAM_STR);
                    $executa=$stmt->execute();
                    if ($executa){
                        if($stmt->rowCount()>0){
                            $result=$stmt->fetch(PDO::FETCH_OBJ);
                            $senhah=$result->cli_senha;
                            $status = $result->cli_status;
                            $senha=hash_hmac("sha256",$senha, HASHKEY);                            
                            if(hash_equals($senha,$senhah) && $status == 1){
                                $_SESSION['cod_cliente']=$result->cli_pk_id;
                                $_SESSION['nome']=$result->cli_nome;
                                $_SESSION['sobrenome']=$result->cli_sobrenome;
                                $_SESSION['login']=$result->cli_login_email;
                                $_SESSION['telefone']=$result->cli_telefone;
                                $_SESSION['data_nasc']=$result->cli_data_nasc;
                                $_SESSION['cod_status_cliente']=$result->cli_status;
                                
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
            function validaRedeSocial($login, $parametro, $modo){
                try{
                    $stmt=$this->pdo->prepare("SELECT * FROM tb_cliente WHERE cli_login_email=:login");
                    $stmt->bindParam(":login", $login, PDO::PARAM_STR);
                    $executa=$stmt->execute();
                    if ($executa){
                        if($stmt->rowCount() > 0){
                            $result=$stmt->fetch(PDO::FETCH_OBJ);
                            if($modo == 0){
                                $idFacebook = $result->cli_id_facebook;
                                if ($parametro == $idFacebook){
                                    $_SESSION['cod_cliente']=$result->cli_pk_id;
                                    $_SESSION['nome']=$result->cli_nome;
                                    $_SESSION['sobrenome']=$result->cli_sobrenome;
                                    $_SESSION['login']=$result->cli_login_email;
                                    $_SESSION['telefone']=$result->cli_telefone;
                                    $_SESSION['data_nasc']=$result->cli_data_nasc;
                                    $_SESSION['cod_status_cliente']=$result->cli_status;
                                    return 2;
                                }else{
                                    return 1;
                                }
                            }elseif ($modo == 1) {
                                $idGoogle = $result->cli_id_google;
                                if ($parametro == $idGoogle){
                                    $_SESSION['cod_cliente']=$result->cli_pk_id;
                                    $_SESSION['nome']=$result->cli_nome;
                                    $_SESSION['sobrenome']=$result->cli_sobrenome;
                                    $_SESSION['login']=$result->cli_login_email;
                                    $_SESSION['telefone']=$result->cli_telefone;
                                    $_SESSION['data_nasc']=$result->cli_data_nasc;
                                    $_SESSION['cod_status_cliente']=$result->cli_status;
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

            function updateSenha($cli_pk_id, $senha, $novaSenha){
                try{       
                    $cliente=new cliente;
                    $senha = hash_hmac("sha256", $senha, HASHKEY);
                    $novaSenha = hash_hmac("sha256", $novaSenha, HASHKEY);         
                    $stmt=$this->pdo->prepare("SELECT * FROM tb_cliente WHERE cli_pk_id=:parametro");
                    $stmt->bindParam(":parametro", $cli_pk_id, PDO::PARAM_INT);
                    $executa=$stmt->execute();
                    if ($executa){
                        if($stmt->rowCount() > 0){
                            while($result=$stmt->fetch(PDO::FETCH_OBJ)){
                                $cliente->setPkId($result->cli_pk_id);
                                $cliente->setLogin($result->cli_login_email);
                                $cliente->setNome($result->cli_nome);
                                $cliente->setSobrenome($result->cli_sobrenome);
                                $cliente->setCpf($result->cli_cpf);
                                $cliente->setData_nasc($result->cli_data_nasc);
                                $cliente->setSenha($result->cli_senha);
                                $cliente->setTelefone($result->cli_telefone);
                            }
                            if ($cliente->getSenha() == $senha){
                                $stmt=$this->pdo->prepare("UPDATE tb_cliente SET cli_senha=:novaSenha WHERE cli_pk_id=:parametro");
                                $stmt->bindParam(":parametro", $cli_pk_id, PDO::PARAM_INT);
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

            function updateSenhaEsquecida($cli_pk_id, $novaSenha){
                try{       
                    $novaSenha = hash_hmac("sha256", $novaSenha, HASHKEY);

                    $stmt=$this->pdo->prepare("SELECT * FROM tb_cliente WHERE cli_pk_id=:parametro");
                    $stmt->bindParam(":parametro", $cli_pk_id, PDO::PARAM_INT);
                    
                    $executa=$stmt->execute();
                    if ($executa){

                        if($stmt->rowCount() > 0){

                            $stmt=$this->pdo->prepare("UPDATE tb_cliente SET senha=:novaSenha WHERE cli_pk_id=:parametro");
                            $stmt->bindParam(":parametro", $cli_pk_id, PDO::PARAM_INT);
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

            function delete($cli_pk_id){
                try{
                    $status=0;
                    $parametro=$cli_pk_id;
                    $stmt=$this->pdo->prepare("UPDATE tb_cliente SET cli_status=:status WHERE cli_pk_id=:parametro");
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

            function insertRecuperaSenha($res_fk_cliente, $cod_recuperacao, $data_expiracao){
                try{
                    $stmt=$this->pdo->prepare("INSERT INTO tb_recupera_senha(res_fk_cliente, cod_recuperacao, data_expiracao)
                    VALUES (:res_fk_cliente, :cod_recuperacao, :data_expiracao) ");
                    $stmt->bindParam(":res_fk_cliente", $res_fk_cliente, PDO::PARAM_INT);
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

                    $stmt=$this->pdo->prepare("SELECT * FROM tb_recupera_senha WHERE res_cod_recuperacao = :cod_recuperacao");
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

                    $stmt=$this->pdo->prepare("UPDATE tb_recupera_senha SET res_recuperado=1 WHERE res_cod_recuperacao=:cod_recuperacao");
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

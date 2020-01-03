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
                    $stmt=$this->pdo->prepare("INSERT INTO tb_cliente(cli_nome, cli_sobrenome, cli_cpf, cli_data_nasc, cli_login_email, cli_senha, cli_telefone, cli_status)
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

                    $stmt = $this->pdo->prepare("INSERT INTO tb_cliente(cli_nome, cli_login_email, cli_status, cli_id_google) VALUES (:nome, :login, :status, :idGoogle)");
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

                    $stmt = $this->pdo->prepare("INSERT INTO tb_cliente (cli_nome, cli_login_email, cli_status, cli_id_facebook) VALUES (:nome, :login, :status, :idFacebook)");
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

            function updateFacebook($cli_pk_id,$idFacebook){
                try{
                    $stmt=$this->pdo->prepare("UPDATE tb_cliente SET cli_id_facebook=:idFacebook WHERE cli_pk_id=:cli_pk_id");
                    $stmt->bindParam(":idFacebook", $idFacebook, PDO::PARAM_STR);
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
                                $cliente->setLogin($result->cli_login_email_email);
                                $cliente->setNome($result->cli_nome);
                                $cliente->setSobrenome($result->cli_sobrenome);
                                $cliente->setCpf($result->cli_cpf);
                                $cliente->setData_nasc($result->cli_data_nasc);
                                $cliente->setTelefone($result->cli_telefone);
                                $cliente->setStatus($result->cli_status);
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
                    $stmt=$this->pdo->prepare("SELECT * FROM tb_cliente WHERE cli_status = 1 ORDER by cli_nome");
                    $executa= $stmt->execute();
                    if ($executa){
                        if ($stmt->rowCount() > 0 ){
                            while($result=$stmt->fetch(PDO::FETCH_OBJ)){
                                $cliente = new cliente();
                                $cliente->setPkId($result->cli_pk_id);
                                $cliente->setLogin($result->cli_login_email_email);
                                $cliente->setNome($result->cli_nome);
                                $cliente->setSobrenome($result->cli_sobrenome);
                                $cliente->setCpf($result->cli_cpf);
                                $cliente->setData_nasc($result->cli_data_nasc);
                                $cliente->setTelefone($result->cli_telefone);
                                $cliente->setStatus($result->cli_status);
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

                $cliente= new cliente;
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
                                $cliente->setLogin($result->cli_login_email_email);
                                $cliente->setNome($result->cli_nome);
                                $cliente->setSobrenome($result->cli_sobrenome);
                                $cliente->setCpf($result->cli_cpf);
                                $cliente->setData_nasc($result->cli_data_nasc);
                                $cliente->setTelefone($result->cli_telefone);
                                $cliente->setStatus($result->cli_status);
                                $cliente->setIdFacebook($result->cli_id_facebook);
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
                    $parametro= "%" . $parametro . "%";
                    $stmt=$this->pdo->prepare("SELECT * FROM tb_cliente WHERE cli_nome LIKE :parametro OR cli_login_email LIKE :login OR cli_telefone LIKE :telefone");
                    $stmt->bindParam(":parametro", $parametro, PDO::PARAM_STR);
                    $stmt->bindParam(":login", $parametro, PDO::PARAM_STR);
                    $stmt->bindValue(":telefone", $parametro);    
                    $executa=$stmt->execute();
                    if ($executa){
                        if($stmt->rowCount() > 0){
                            while($result=$stmt->fetch(PDO::FETCH_OBJ)){
                                $cliente= new cliente;
                                $cliente->setPkId($result->cli_pk_id);
                                $cliente->setLogin($result->cli_login_email_email);
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
            
            function validaCliente($login,$senha){
                try{
                    $stmt=$this->pdo->prepare("SELECT * FROM tb_cliente WHERE cli_login_email=:login");
                    $stmt->bindParam(":login", $login, PDO::PARAM_STR);
                    $executa=$stmt->execute();
                    if ($executa){
                        if($stmt->rowCount()>0){
                            $result=$stmt->fetch(PDO::FETCH_OBJ);
                            $senhah=$result->cli_senha;
                            $status = $result->cli_status;
                            $senha=hash_hmac("md5",$senha, "senha");                            
                            if(hash_equals($senha,$senhah) && $status == 1){
                                $_SESSION['cod_cliente']=$result->cli_pk_id;
                                $_SESSION['nome']=$result->cli_nome;
                                $_SESSION['sobrenome']=$result->cli_sobrenome;
                                $_SESSION['login']=$result->cli_login_email_email;
                                $_SESSION['telefone']=$result->cli_telefone;
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
            function validaRedeSocial($login,$parametro,$modo){
                try{
                    $stmt=$this->pdo->prepare("SELECT * FROM tb_cliente WHERE cli_login_email=:login");
                    $stmt->bindParam(":login", $login, PDO::PARAM_STR);
                    $executa=$stmt->execute();
                    if ($executa){
                        if($stmt->rowCount()>0){
                            $result=$stmt->fetch(PDO::FETCH_OBJ);
                            if($modo == 0){
                                $idFacebook=$result->cli_id_facebook;
                                if ($parametro == $idFacebook){
                                    $_SESSION['cod_cliente']=$result->cli_pk_id;
                                    $_SESSION['nome']=$result->cli_nome;
                                    $_SESSION['sobrenome']=$result->cli_sobrenome;
                                    $_SESSION['login']=$result->cli_login_email_email;
                                    $_SESSION['telefone']=$result->cli_telefone;
                                    return 2;
                                }else{
                                    return 1;
                                }
                            }elseif ($modo == 1) {
                                $idGoogle=$result->cli_id_google;
                                if ($parametro == $idGoogle){
                                    $_SESSION['cod_cliente']=$result->cli_pk_id;
                                    $_SESSION['nome']=$result->cli_nome;
                                    $_SESSION['sobrenome']=$result->cli_sobrenome;
                                    $_SESSION['login']=$result->cli_login_email_email;
                                    $_SESSION['telefone']=$result->cli_telefone;
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
                    $senha = hash_hmac("md5", $senha, "senha");
                    $novaSenha = hash_hmac("md5", $novaSenha, "senha");         
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
                    $novaSenha = hash_hmac("md5", $novaSenha, "senha");

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

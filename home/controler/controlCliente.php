<?php 
    //include_once MODELPATH."/cliente.php";
    include_once "/xampp/htdocs/delion/admin/model/cliente.php";
    include_once "/xampp/htdocs/delion/admin/controler/seguranca.php";
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
    $teste->update($clientet);
?>
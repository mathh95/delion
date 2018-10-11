<?php
    include_once $_SERVER['DOCUMENT_ROOT']."/config.php"; 
    include_once MODELPATH."/endereco.php";
    include_once CONTROLLERPATH."/seguranca.php";
    class controlEndereco{
        private $pdo;

        function insert($endereco){
            try{
                $stmt=$this->pdo->prepare("INSERT INTO endereco(rua, numero, cep, complemento, bairro, cliente, flag_cliente)
                VALUES (:rua, :numero, :cep, :complemento, :bairro, :cliente, 1) ");
                $stmt->bindParam(":rua", $endereco->getRua(), PDO::PARAM_STR);
                $stmt->bindParam(":numero",$endereco->getNumero(), PDO::PARAM_INT);
                $stmt->bindParam(":cep", $endereco->getCep(), PDO::PARAM_STR);
                $stmt->bindParam(":complemento", $endereco->getComplemento(), PDO::PARAM_STR);
                $stmt->bindParam(":bairro", $endereco->getBairro(), PDO::PARAM_STR);
                $stmt->bindParam(":cliente", $endereco->getCliente(), PDO::PARAM_INT);

                $executa=$stmt->execute();
                if ($executa){
                    return 1;
                }else{
                    return -1;
                }
            }catch(PDOException $e){

                echo $e->getMessage();

            }
        }

        function update($endereco){
            try{
                $stmt=$this->pdo->prepare("UPDATE endereco SET rua=:rua, numero=:numero, cep=:cep, complemento=:complemento, bairro=:bairro, cliente=:cliente WHERE cod_endereco=:cod_endereco;");
                $stmt->bindParam(":rua", $endereco->getRua(), PDO::PARAM_STR);
                $stmt->bindParam(":numero",$endereco->getNumero(), PDO::PARAM_INT);
                $stmt->bindParam(":cep", $endereco->getCep(), PDO::PARAM_STR);
                $stmt->bindParam(":complemento", $endereco->getComplemento(), PDO::PARAM_STR);
                $stmt->bindParam(":bairro", $endereco->getBairro(), PDO::PARAM_STR);
                $stmt->bindParam(":cliente", $endereco->getCliente(), PDO::PARAM_INT);
                $stmt->bindParam(":cod_endereco",$endereco->getCodEndereco(),PDO::PARAM_INT);

                $executa=$stmt->execute();

                if ($executa) {
                    return 1;
                }else {
                    return -1;
                }

            }catch(PDOException $e){

                echo $e->getMessage();

            }
        }

        function deleteCliente($cod_endereco){
            try{
                $stmt=$this->pdo->prepare("UPDATE endereco SET flag_cliente=0 WHERE cod_endereco=:cod_endereco");
                $stmt->bindParam(":cod_endereco", $cod_endereco, PDO::PARAM_INT);
                $executa=$stmt->execute();
                if ($executa) {
                    return 1;
                }else {
                    return -1;
                }
            }catch(PDOException $e){

                echo $e->getMessage();

            }    
        }

        function ativarCliente($cod_endereco){
            try{
                $stmt=$this->pdo->prepare("UPDATE endereco SET flag_cliente=1 WHERE cod_endereco=:cod_endereco");
                $stmt->bindParam(":cod_endereco", $cod_endereco, PDO::PARAM_INT);
                $executa=$stmt->execute();
                if ($executa) {
                    return 1;
                }else {
                    return -1;
                }
            }catch(PDOException $e){

                echo $e->getMessage();

            }    
        }

        function selectAll($parametro){
            try{
                $parametro = "%" . $parametro . "%";
                $enderecos = array();
                $stmt=$this->pdo->prepare("SELECT endereco.cod_endereco, endereco.rua, endereco.numero, endereco.cep, endereco.complemento, endereco.bairro, endereco.flag_cliente, cliente.cod_cliente, cliente.nome FROM endereco INNER JOIN cliente ON endereco.cliente = cliente.cod_cliente WHERE cliente.nome like :nome OR endereco.rua LIKE :rua OR endereco.numero LIKE :numero OR endereco.bairro LIKE :bairro OR endereco.cep LIKE :cep OR endereco.complemento LIKE :complemento");
                $stmt->bindValue(":nome", $parametro);
                $stmt->bindValue(":rua", $parametro);
                $stmt->bindValue(":cep", $parametro);
                $stmt->bindValue(":numero", $parametro);
                $stmt->bindValue(":complemento", $parametro);
                $stmt->bindValue(":bairro", $parametro);
                $executa= $stmt->execute();
                if ($executa){
                    if ($stmt->rowCount() > 0 ){
                        while($result=$stmt->fetch(PDO::FETCH_OBJ)){
                            $endereco = new endereco();
                            $endereco->setCodEndereco($result->cod_endereco);
                            $endereco->setRua($result->rua);
                            $endereco->setNumero($result->numero);
                            $endereco->setCep($result->cep);
                            $endereco->setComplemento($result->complemento);
                            $endereco->setBairro($result->bairro);
                            $endereco->setCliente($result->cod_cliente);
                            $endereco->clienteNome=$result->nome;
                            $endereco->setFlagCliente($result->flag_cliente);
                            array_push($enderecos,$endereco);
                        }
                    }else{
                        return -1;
                    }
                    return $enderecos;
                }else{
                    return -1;
                }

            }
            catch(PDOException $e){
                echo $e->getMessage();
                return -1;
            }
        }
        //modo 1= endereços ativos
        //modo 2= endereços inativos
        function selectByCliente($cliente, $modo){
            try{
                $enderecos = array();
                if ($modo==1) {
                    $stmt=$this->pdo->prepare("SELECT * FROM endereco WHERE cliente=:cliente AND flag_cliente=1");
                }elseif ($modo==2) {
                    $stmt=$this->pdo->prepare("SELECT * FROM endereco WHERE cliente=:cliente AND flag_cliente=0");
                }
                $stmt->bindParam(":cliente", $cliente, PDO::PARAM_INT);
                $executa= $stmt->execute();
                if ($executa){
                    if ($stmt->rowCount() > 0 ){
                        while($result=$stmt->fetch(PDO::FETCH_OBJ)){
                            $endereco = new endereco();
                            $endereco->setCodEndereco($result->cod_endereco);
                            $endereco->setRua($result->rua);
                            $endereco->setNumero($result->numero);
                            $endereco->setCep($result->cep);
                            $endereco->setComplemento($result->complemento);
                            $endereco->setBairro($result->bairro);
                            $endereco->setCliente($result->cliente);
                            $endereco->setFlagCliente($result->flag_cliente);
                            array_push($enderecos,$endereco);
                        }
                    }else{
                        return -1;
                    }
                    return $enderecos;
                }else{
                    return -1;
                }

            }
            catch(PDOException $e){
                echo $e->getMessage();
                return -1;
            }
        }

        #modo 1=codigo do endereço
        #modo 2=codigo do pedido
        function select($parametro,$modo){
            try{
                $enderecos = array();
                if ($modo == 1) {
                    $stmt=$this->pdo->prepare("SELECT * FROM endereco WHERE cod_endereco=:parametro");
                }elseif ($modo == 2) {
                    $stmt=$this->pdo->prepare("SELECT * FROM pedido WHERE cod_endereco=:parametro");
                }
                $stmt->bindParam(":parametro", $parametro, PDO::PARAM_INT);
                $executa= $stmt->execute();
                if ($executa){
                    if ($stmt->rowCount() > 0 ){
                        while($result=$stmt->fetch(PDO::FETCH_OBJ)){
                            $endereco = new endereco();
                            $endereco->setCodEndereco($result->cod_endereco);
                            $endereco->setRua($result->rua);
                            $endereco->setNumero($result->numero);
                            $endereco->setCep($result->cep);
                            $endereco->setComplemento($result->complemento);
                            $endereco->setBairro($result->bairro);
                            $endereco->setCliente($result->cliente);
                            $endereco->setFlagCliente($result->flag_cliente);
                            array_push($enderecos,$endereco);
                        }
                    }else{
                        return -1;
                    }
                    return $enderecos;
                }else{
                    return -1;
                }

            }
            catch(PDOException $e){
                echo $e->getMessage();
                return -1;
            }
        }

        function __construct($pdo){
            $this->pdo=$pdo;
        }
    }


#Criação da tabela endereco
/*  CREATE TABLE endereco ( cod_endereco INT PRIMARY KEY AUTO_INCREMENT,
 rua VARCHAR(255) NOT NULL,
 numero INT NOT NULL,
 cep VARCHAR(10) NOT NULL,
 complemento VARCHAR(255),
 bairro VARCHAR(255),
 cliente INT,
 FOREIGN KEY (cliente) REFERENCES cliente(cod_cliente)
 ) */
?>
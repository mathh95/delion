<?php
    include_once $_SERVER['DOCUMENT_ROOT']."/config.php"; 
    include_once MODELPATH."/endereco.php";
    include_once CONTROLLERPATH."/seguranca.php";
    class controlEndereco{
        private $pdo;

        function insert($endereco){
            try{
                $stmt=$this->pdo->prepare("INSERT INTO endereco(rua, numero, cep, complemento, bairro, cliente)
                VALUES (:rua, :numero, :cep, :complemento, :bairro, :cliente) ");
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
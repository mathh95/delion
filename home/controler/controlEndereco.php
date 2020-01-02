<?php
    include_once $_SERVER['DOCUMENT_ROOT']."/config.php"; 
    include_once MODELPATH."/endereco.php";
    include_once CONTROLLERPATH."/seguranca.php";
    class controlEndereco{
        private $pdo;

        function insert($endereco){
            try{

                //tb_endereco
                $stmt=$this->pdo->prepare("INSERT INTO tb_endereco(end_logradouro, end_cep, end_bairro, end_fk_cidade)
                VALUES (:logradouro, :cep, :bairro, :fk_cidade) ");
                
                $rua = $endereco->getRua();
                $numero = $endereco->getNumero();
                $cep = $endereco->getCep();
                $complemento = $endereco->getComplemento();
                $bairro = $endereco->getBairro();
                $cidade = $endereco->getCidade();
                $referencia = $endereco->getReferencia();
                $cliente = $endereco->getCliente();
                
                $stmt->bindParam(":rua", $rua, PDO::PARAM_STR);
                $stmt->bindParam(":numero",$numero, PDO::PARAM_INT);
                $stmt->bindParam(":cep", $cep, PDO::PARAM_STR);
                $stmt->bindParam(":complemento", $complemento, PDO::PARAM_STR);
                $stmt->bindParam(":bairro", $bairro, PDO::PARAM_STR);
                $stmt->bindParam(":cidade", $cidade, PDO::PARAM_STR);
                $stmt->bindParam(":referencia", $referencia, PDO::PARAM_STR);
                $stmt->bindParam(":cliente", $cliente, PDO::PARAM_INT);

                //rl_endereco_cliente
                $stmt=$this->pdo->prepare("INSERT INTO tb_endereco(rua, numero, cep, complemento, bairro, cidade, referencia, cliente, flag_cliente)
                VALUES (:rua, :numero, :cep, :complemento, :bairro, :cidade, :referencia, :cliente, 1) ");
                
                $rua = $endereco->getRua();
                $numero = $endereco->getNumero();
                $cep = $endereco->getCep();
                $complemento = $endereco->getComplemento();
                $bairro = $endereco->getBairro();
                $cidade = $endereco->getCidade();
                $referencia = $endereco->getReferencia();
                $cliente = $endereco->getCliente();
                
                $stmt->bindParam(":rua", $rua, PDO::PARAM_STR);
                $stmt->bindParam(":numero",$numero, PDO::PARAM_INT);
                $stmt->bindParam(":cep", $cep, PDO::PARAM_STR);
                $stmt->bindParam(":complemento", $complemento, PDO::PARAM_STR);
                $stmt->bindParam(":bairro", $bairro, PDO::PARAM_STR);
                $stmt->bindParam(":cidade", $cidade, PDO::PARAM_STR);
                $stmt->bindParam(":referencia", $referencia, PDO::PARAM_STR);
                $stmt->bindParam(":cliente", $cliente, PDO::PARAM_INT);

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

        function insertSemFkCli($endereco){
            try{
                $stmt=$this->pdo->prepare("INSERT INTO tb_endereco(rua, numero, cep, complemento, bairro, cidade, referencia, flag_cliente)
                VALUES (:rua, :numero, :cep, :complemento, :bairro, :cidade, :referencia, 1) ");
                
                $rua = $endereco->getRua();
                $numero = $endereco->getNumero();
                $cep = $endereco->getCep();
                $complemento = $endereco->getComplemento();
                $bairro = $endereco->getBairro();
                $cidade = $endereco->getCidade();
                $referencia = $endereco->getReferencia();
                
                $stmt->bindParam(":rua", $rua, PDO::PARAM_STR);
                $stmt->bindParam(":numero",$numero, PDO::PARAM_INT);
                $stmt->bindParam(":cep", $cep, PDO::PARAM_STR);
                $stmt->bindParam(":complemento", $complemento, PDO::PARAM_STR);
                $stmt->bindParam(":bairro", $bairro, PDO::PARAM_STR);
                $stmt->bindParam(":cidade", $cidade, PDO::PARAM_STR);
                $stmt->bindParam(":referencia", $referencia, PDO::PARAM_STR);

                $executa=$stmt->execute();
                                
                $cod_endereco = $this->pdo->lastInsertId();
                
                if ($executa){
                    return $cod_endereco;
                }else{
                    return -1;
                }
            }catch(PDOException $e){

                echo $e->getMessage();

            }
        }

        function update($endereco){
            try{
                $stmt=$this->pdo->prepare("UPDATE tb_endereco SET end_rua=:end_rua, end_numero=:end_numero, end_cep=:end_cep, end_complemento=:end_complemento, end_bairro=:end_bairro, end_fk_cidade=:end_fk_cidade, end_referencia=:end_referencia, end_fk_cliente=:end_fk_cliente WHERE end_pk_id=:end_pk_id;");
                $stmt->bindParam(":end_rua", $endereco->getRua(), PDO::PARAM_STR);
                $stmt->bindParam(":end_numero",$endereco->getNumero(), PDO::PARAM_INT);
                $stmt->bindParam(":end_cep", $endereco->getCep(), PDO::PARAM_STR);
                $stmt->bindParam(":end_complemento", $endereco->getComplemento(), PDO::PARAM_STR);
                $stmt->bindParam(":end_bairro", $endereco->getBairro(), PDO::PARAM_STR);
                $stmt->bindParam(":end_fk_cidade", $endereco->getCidade(), PDO::PARAM_STR);
                $stmt->bindParam(":end_referencia", $endereco->getReferencia(), PDO::PARAM_STR);
                $stmt->bindParam(":end_fk_cliente", $endereco->getCliente(), PDO::PARAM_INT);
                $stmt->bindParam(":end_pk_id",$endereco->getCodEndereco(),PDO::PARAM_INT);

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

        function deleteCliente($end_pk_id){
            try{
                $stmt=$this->pdo->prepare("UPDATE tb_endereco SET end_flag_cliente=0 WHERE end_pk_id=:end_pk_id");
                $stmt->bindParam(":end_pk_id", $end_pk_id, PDO::PARAM_INT);
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

        function ativarCliente($end_pk_id){
            try{
                $stmt=$this->pdo->prepare("UPDATE tb_endereco SET end_flag_cliente=1 WHERE end_pk_id=:end_pk_id");
                $stmt->bindParam(":end_pk_id", $end_pk_id, PDO::PARAM_INT);
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
                $stmt=$this->pdo->prepare("SELECT endereco.end_pk_id, endereco.end_rua, endereco.end_numero, endereco.end_cep, endereco.end_complemento, endereco.end_bairro, endereco.end_referencia, endereco.end_fk_cidade, endereco.end_flag_cliente, cliente.cli_pk_id, cliente.cli_nome 
                FROM tb_endereco INNER JOIN tb_cliente ON endereco.end_fk_cliente = cliente.cli_pk_id WHERE cliente.cli_nome like :cli_nome OR endereco.rua LIKE :rua OR endereco.end_numero LIKE :end_numero OR endereco.end_bairro LIKE :end_bairro OR endereco.end_cep LIKE :end_cep OR endereco.end_complemento LIKE :end_complemento OR endereco.end_fk_cidade LIKE :end_fk_cidade OR endereco.end_referencia LIKE :end_referencia");
                $stmt->bindValue(":cli_nome", $parametro);
                $stmt->bindValue(":end_rua", $parametro);
                $stmt->bindValue(":end_cep", $parametro);
                $stmt->bindValue(":end_numero", $parametro);
                $stmt->bindValue(":end_complemento", $parametro);
                $stmt->bindValue(":end_bairro", $parametro);
                $stmt->bindValue(":end_fk_cidade", $parametro);
                $stmt->bindValue(":end_referencia", $parametro);
                $executa= $stmt->execute();
                if ($executa){
                    if ($stmt->rowCount() > 0 ){
                        while($result=$stmt->fetch(PDO::FETCH_OBJ)){
                            $endereco = new endereco();
                            $endereco->setCodEndereco($result->end_pk_id);
                            $endereco->setRua($result->end_rua);
                            $endereco->setNumero($result->end_numero);
                            $endereco->setCep($result->end_cep);
                            $endereco->setComplemento($result->end_complemento);
                            $endereco->setBairro($result->end_bairro);
                            $endereco->setCidade($result->end_fk_cidade);
                            $endereco->setReferencia($result->end_referencia);
                            $endereco->setCliente($result->cli_pk_id);
                            $endereco->clienteNome=$result->cli_nome;
                            $endereco->setFlagCliente($result->end_flag_cliente);
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
        function selectByCliente($end_fk_cliente, $modo){
            try{
                $enderecos = array();
                if ($modo==1) {
                    $stmt=$this->pdo->prepare("SELECT * FROM tb_endereco WHERE end_fk_cliente=:end_fk_cliente AND end_flag_cliente=1");
                }elseif ($modo==2) {
                    $stmt=$this->pdo->prepare("SELECT * FROM tb_endereco WHERE end_fk_cliente=:end_fk_cliente AND end_flag_cliente=0");
                }
                $stmt->bindParam(":end_fk_cliente", $end_fk_cliente, PDO::PARAM_INT);
                $executa= $stmt->execute();
                if ($executa){
                    if ($stmt->rowCount() > 0 ){
                        while($result=$stmt->fetch(PDO::FETCH_OBJ)){
                            $endereco = new endereco();
                            $endereco->setCodEndereco($result->end_pk_id);
                            $endereco->setRua($result->end_rua);
                            $endereco->setNumero($result->end_numero);
                            $endereco->setCep($result->end_cep);
                            $endereco->setComplemento($result->end_complemento);
                            $endereco->setBairro($result->end_bairro);
                            $endereco->setReferencia($result->end_referencia);
                            $endereco->setCliente($result->cliente);
                            $endereco->setCidade($result->cidade);
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
                    $stmt=$this->pdo->prepare("SELECT *
                    FROM rl_endereco_cliente AS ENCL ON
                    PED.ped_fk_endereco_cliente = ENCL.encl_pk_id
                    INNER JOIN
                    tb_endereco AS ENCO ON
                    ENCO.end_pk_id = ENCL.encl_pk_id
                    WHERE ENCL.encl_pk_id=:parametro");

                }elseif ($modo == 2) {
                    $stmt=$this->pdo->prepare("SELECT *
                    FROM tb_pedido
                    WHERE ped_pk_id=:parametro");
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
                            $endereco->setCidade($result->cidade);
                            $endereco->setReferencia($result->referencia);
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
?>
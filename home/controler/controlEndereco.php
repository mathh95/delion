<?php
    include_once $_SERVER['DOCUMENT_ROOT']."/config.php"; 
    include_once MODELPATH."/endereco.php";
    include_once MODELPATH."/endereco_cliente.php";
    include_once MODELPATH."/cidade.php";
    include_once CONTROLLERPATH."/seguranca.php";
    class controlEndereco{
        private $pdo;

        function insert($endereco){
            try{

                //Insere endereco
                $stmt=$this->pdo->prepare("INSERT INTO tb_endereco(end_cep, end_logradouro, end_bairro, end_fk_cidade)
                VALUES (:cep, :logradouro, :bairro, :fk_cidade) ");
                
                $cep = $endereco->getCep();
                $logradouro = $endereco->getLogradouro();
                $bairro = $endereco->getBairro();
                $cidade = $endereco->getFkCidade();
                
                $stmt->bindParam(":cep", $cep, PDO::PARAM_INT);
                $stmt->bindParam(":logradouro", $logradouro, PDO::PARAM_STR);
                $stmt->bindParam(":bairro", $bairro, PDO::PARAM_STR);
                $stmt->bindParam(":fk_cidade", $cidade, PDO::PARAM_INT);
            
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

        function insertEnderecoCliente($endereco_cliente){
            try{

                //rl_endereco_cliente
                $stmt=$this->pdo->prepare("INSERT INTO rl_endereco_cliente(encl_numero, encl_referencia, encl_complemento, encl_fk_endereco, encl_fk_cliente, encl_flag_ativo)
                VALUES (:numero, :referencia, :complemento, :fk_endereco, :fk_cliente, 1) ");
                
                $numero = $endereco_cliente->getNumero();
                $referencia = $endereco_cliente->getReferencia();
                $complemento = $endereco_cliente->getComplemento();
                $fk_endereco = $endereco_cliente->getFkEndereco();
                $fk_cliente = $endereco_cliente->getFkCliente();
                
                $stmt->bindParam(":numero",$numero, PDO::PARAM_INT);
                $stmt->bindParam(":referencia", $referencia, PDO::PARAM_STR);
                $stmt->bindParam(":complemento", $complemento, PDO::PARAM_STR);
                $stmt->bindParam(":fk_endereco", $fk_endereco, PDO::PARAM_INT);
                $stmt->bindParam(":fk_cliente", $fk_cliente, PDO::PARAM_INT);

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

        function insertEnderecoSemFkCliente($endereco_cliente){
            try{

                //rl_endereco_cliente
                $stmt=$this->pdo->prepare("INSERT INTO rl_endereco_cliente(encl_numero, encl_referencia, encl_complemento, encl_fk_endereco, encl_flag_ativo)
                VALUES (:numero, :referencia, :complemento, :fk_endereco, 1) ");
                
                $numero = $endereco_cliente->getNumero();
                $referencia = $endereco_cliente->getReferencia();
                $complemento = $endereco_cliente->getComplemento();
                $fk_endereco = $endereco_cliente->getFkEndereco();
                
                $stmt->bindParam(":numero",$numero, PDO::PARAM_INT);
                $stmt->bindParam(":referencia", $referencia, PDO::PARAM_STR);
                $stmt->bindParam(":complemento", $complemento, PDO::PARAM_STR);
                $stmt->bindParam(":fk_endereco", $fk_endereco, PDO::PARAM_INT);

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

        function update($endereco_cliente){

            try{

                $stmt = $this->pdo->prepare("UPDATE rl_endereco_cliente
                SET encl_numero=:numero, encl_referencia=:referencia, encl_complemento=:complemento, encl_fk_endereco=:fk_endereco, encl_fk_cliente=:fk_cliente
                WHERE encl_pk_id=:pk_id;");

                $pk_id = $endereco_cliente->getPkId();
                $numero = $endereco_cliente->getNumero();
                $referencia = $endereco_cliente->getReferencia();
                $complemento = $endereco_cliente->getComplemento();
                $fk_endereco = $endereco_cliente->getFkEndereco();
                $fk_cliente = $endereco_cliente->getFkCliente();

                $stmt->bindParam(":pk_id", $pk_id, PDO::PARAM_INT);
                $stmt->bindParam(":numero", $numero, PDO::PARAM_INT);
                $stmt->bindParam(":referencia", $referencia, PDO::PARAM_STR);
                $stmt->bindParam(":complemento", $complemento, PDO::PARAM_STR);
                $stmt->bindParam(":fk_endereco", $fk_endereco, PDO::PARAM_INT);
                $stmt->bindParam(":fk_cliente", $fk_cliente, PDO::PARAM_INT);

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

        function selectAll(){
            try{
                $enderecos_cliente = array();

                $stmt=$this->pdo->prepare("SELECT *
                FROM rl_endereco_cliente AS ENCL
                INNER JOIN
                tb_endereco AS ENCO ON
                ENCO.end_pk_id = ENCL.encl_fk_endereco
                INNER JOIN
                tb_cidade ON
                end_fk_cidade = ci_pk_id
                WHERE encl_flag_ativo=1");
                
                $executa= $stmt->execute();
                if ($executa){
                    if ($stmt->rowCount() > 0 ){
                        while($result=$stmt->fetch(PDO::FETCH_OBJ)){

                            $endereco_cliente = new enderecoCliente();
                            $endereco_cliente->setPkId($result->encl_pk_id);
                            $endereco_cliente->setNumero($result->encl_numero);
                            $endereco_cliente->setNome($result->encl_nome);
                            $endereco_cliente->setReferencia($result->encl_referencia);
                            $endereco_cliente->setComplemento($result->encl_complemento);
                            $endereco_cliente->setFlagAtivo($result->encl_flag_ativo);
                            $endereco_cliente->setFkEndereco($result->encl_fk_endereco);
                            $endereco_cliente->setFkCliente($result->encl_fk_cliente);

                            $endereco_cliente->cep = $result->end_cep;
                            $endereco_cliente->logradouro= $result->end_logradouro;
                            $endereco_cliente->bairro =$result->end_bairro;
                            $endereco_cliente->fkCidade = $result->end_fk_cidade;
                            $endereco_cliente->cidade = $result->ci_cidade;
                            array_push($enderecos_cliente, $endereco_cliente);

                        }
                    }else{
                        return -1;
                    }
                    return $enderecos_cliente;
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
        function selectByCliente($encl_fk_cliente, $modo){
            try{
                $enderecos_cliente = array();
                if ($modo==1) {
                    $stmt=$this->pdo->prepare("SELECT *
                    FROM rl_endereco_cliente AS ENCL
                    INNER JOIN
                    tb_endereco AS ENCO ON
                    ENCO.end_pk_id = ENCL.encl_fk_endereco
                    INNER JOIN
                    tb_cidade ON
                    ENCO.end_fk_cidade = ci_pk_id
                    WHERE encl_fk_cliente=:encl_fk_cliente AND encl_flag_ativo=1");

                }elseif ($modo==2) {
                    $stmt=$this->pdo->prepare("SELECT *
                    FROM rl_endereco_cliente AS ENCL
                    INNER JOIN
                    tb_endereco AS ENCO ON
                    ENCO.end_pk_id = ENCL.encl_fk_endereco
                    INNER JOIN
                    tb_cidade ON
                    ENCO.end_fk_cidade = ci_pk_id
                    WHERE encl_fk_cliente=:encl_fk_cliente AND encl_flag_ativo=0");
                }
                
                $stmt->bindParam(":encl_fk_cliente", $encl_fk_cliente, PDO::PARAM_INT);
                $executa= $stmt->execute();
                if ($executa){
                    if ($stmt->rowCount() > 0 ){
                        while($result=$stmt->fetch(PDO::FETCH_OBJ)){
                            $endereco_cliente = new enderecoCliente();
                            $endereco_cliente->setPkId($result->encl_pk_id);
                            $endereco_cliente->setNumero($result->encl_numero);
                            $endereco_cliente->setNome($result->encl_nome);
                            $endereco_cliente->setReferencia($result->encl_referencia);
                            $endereco_cliente->setComplemento($result->encl_complemento);
                            $endereco_cliente->setFlagAtivo($result->encl_flag_ativo);
                            $endereco_cliente->setFkEndereco($result->encl_fk_endereco);
                            $endereco_cliente->setFkCliente($result->encl_fk_cliente);

                            $endereco_cliente->cep = $result->end_cep;
                            $endereco_cliente->logradouro= $result->end_logradouro;
                            $endereco_cliente->bairro =$result->end_bairro;
                            $endereco_cliente->fkCidade = $result->end_fk_cidade;
                            $endereco_cliente->cidade = $result->ci_cidade;

                            array_push($enderecos_cliente, $endereco_cliente);
                        }
                    }else{
                        return -1;
                    }
                    return $enderecos_cliente;
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
            try{

                $stmt=$this->pdo->prepare("SELECT *
                FROM rl_endereco_cliente AS ENCL
                INNER JOIN
                tb_endereco AS ENCO ON
                ENCO.end_pk_id = ENCL.encl_fk_endereco
                INNER JOIN
                tb_cidade ON
                end_fk_cidade = ci_pk_id
                WHERE encl_pk_id=:encl_pk_id AND encl_flag_ativo=1");

                
                $stmt->bindParam(":encl_pk_id", $pk_id, PDO::PARAM_INT);
                $executa= $stmt->execute();
                if ($executa){
                    if ($stmt->rowCount() > 0 ){
                        $result=$stmt->fetch(PDO::FETCH_OBJ);

                        $endereco_cliente = new enderecoCliente();
                        $endereco_cliente->setPkId($result->encl_pk_id);
                        $endereco_cliente->setNumero($result->encl_numero);
                        $endereco_cliente->setNome($result->encl_nome);
                        $endereco_cliente->setReferencia($result->encl_referencia);
                        $endereco_cliente->setComplemento($result->encl_complemento);
                        $endereco_cliente->setFlagAtivo($result->encl_flag_ativo);
                        $endereco_cliente->setFkEndereco($result->encl_fk_endereco);
                        $endereco_cliente->setFkCliente($result->encl_fk_cliente);

                        $endereco_cliente->cep = $result->end_cep;
                        $endereco_cliente->logradouro= $result->end_logradouro;
                        $endereco_cliente->bairro =$result->end_bairro;
                        $endereco_cliente->fkCidade = $result->end_fk_cidade;
                        $endereco_cliente->cidade = $result->ci_cidade;

                    }else{
                        return -1;
                    }
                    return $endereco_cliente;
                }else{
                    return -1;
                }

            }
            catch(PDOException $e){
                echo $e->getMessage();
                return -1;
            }
        }


        function selectNomeCidade($end_fk_cidade){
            try{
                $stmt=$this->pdo->prepare("SELECT * 
                FROM tb_cidade
                WHERE ci_pk_id=:end_fk_cidade");

                $stmt->bindValue(":end_fk_cidade", $end_fk_cidade);

                $executa= $stmt->execute();
                if ($executa){
                    if ($stmt->rowCount() > 0 ){
                        $result = $stmt->fetch(PDO::FETCH_OBJ);
                        $cidade = new cidade;
                        $cidade->setPkId($result->ci_pk_id);
                        $cidade->setCidade($result->ci_cidade);
                        $cidade->setFkEstado($result->ci_fk_estado);                        
                    }else{
                        return -1;
                    }
                    return $cidade->getCidade();
                }else{
                    return -1;
                }

            }
            catch(PDOException $e){
                echo $e->getMessage();
                return -1;
            }
        }

        function selectCidadeByNome($end_cidade){
            try{
                $stmt=$this->pdo->prepare("SELECT * 
                FROM tb_cidade
                WHERE ci_cidade LIKE :end_cidade");

                $stmt->bindValue(":end_cidade", "%".$end_cidade."%");

                $executa = $stmt->execute();
                if ($executa){
                    if ($stmt->rowCount() > 0 ){
                        $result = $stmt->fetch(PDO::FETCH_OBJ);
                        $cidade = new cidade;
                        $cidade->setPkId($result->ci_pk_id);
                        $cidade->setCidade($result->ci_cidade);
                        $cidade->setFkEstado($result->ci_fk_estado);                        
                    }else{
                        return -1;
                    }
                    return $cidade;
                }else{
                    return -1;
                }

            }
            catch(PDOException $e){
                echo $e->getMessage();
                return -1;
            }
        }      
        
        function selectByCep($cep){
            try{
                $stmt=$this->pdo->prepare("SELECT *
                FROM tb_endereco
                WHERE end_cep = :end_cep");

                $stmt->bindValue(":end_cep", $cep);
                $executa = $stmt->execute();
                if ($executa){
                    if ($stmt->rowCount() > 0 ){

                        $result = $stmt->fetch(PDO::FETCH_OBJ);

                        $endereco = new endereco();
                        $endereco->setPkId($result->end_pk_id);
                        $endereco->setCep($result->end_cep);
                        $endereco->setLogradouro($result->end_logradouro);
                        $endereco->setBairro($result->end_bairro);
                        $endereco->setFkCidade($result->end_fk_cidade);                     
                    }else{
                        return 0;
                    }

                    return $endereco;

                }else{
                    return 0;
                }

            }
            catch(PDOException $e){
                echo $e->getMessage();
                return 0;
            }
        }





        function deleteEndereco($encl_pk_id){
            try{
                $stmt=$this->pdo->prepare("UPDATE rl_endereco_cliente SET encl_flag_ativo=0 WHERE encl_pk_id=:encl_pk_id");
                $stmt->bindParam(":encl_pk_id", $encl_pk_id, PDO::PARAM_INT);
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

        function ativarEndereco($encl_pk_id){
            try{
                $stmt=$this->pdo->prepare("UPDATE rl_endereco_cliente SET encl_flag_ativo=1 WHERE encl_pk_id=:encl_pk_id");
                $stmt->bindParam(":end_pk_id", $encl_pk_id, PDO::PARAM_INT);
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
?>
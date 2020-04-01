<?php

include_once MODELPATH. "/tipo_fornecedor.php";
include_once "seguranca.php";
protegePagina();


    class controlerTipoFornecedor{
        private $pdo;

        function insert($tipo_fornecedor){
            try{
                $stmte =$this->pdo->prepare("INSERT INTO tb_tipo_fornecedor(tifo_nome, tifo_flag_ativo)
                VALUES (:tipoFornecedor, :flag_ativo)");
                $stmte->bindParam(":tipoFornecedor", $tipo_fornecedor->getNome(), PDO::PARAM_STR);
                $stmte->bindParam(":flag_ativo", $tipo_fornecedor->getFlag_ativo());
                $executa = $stmte->execute();
                if($executa){
                    return 1;
                }
                else{
                    return -1;
                }
            }
            catch(PDOException $e){
                echo $e->getMessage();
                return -1;
            }

        }

        function update($tipo_fornecedor){
            try{
                $stmte =$this->pdo->prepare("UPDATE tb_tipo_fornecedor SET tifo_nome=:tipo_fornecedor, tifo_flag_ativo=:flag_ativo WHERE tifo_pk_id=:tifo_pk_id");
                $stmte->bindParam(":tifo_pk_id",$tipo_fornecedor->getPkId(), PDO::PARAM_INT);
                $stmte->bindParam(":tipo_fornecedor", $tipo_fornecedor->getNome(), PDO::PARAM_STR);
                $stmte->bindParam(":flag_ativo", $tipo_fornecedor->getFlag_ativo());
                $executa = $stmte->execute();
                if($executa){
                    return 1;
                }
                else{
                    return -1;
                }
            }
            catch(PDOException $e){
                echo $e->getMessage();
                return -1;
            }
        }

        function select($parametro, $modo){
            $tipo_fornecedor = new tipo_fornecedor();
            try{
                if($modo == 1){
                    $stmte = $this->pdo->prepare("SELECT * FROM tb_tipo_fornecedor WHERE tifo_nome LIKE :parametro");
                    $stmte->bindParam(":parametro", $parametro . "%", PDO::PARAM_STR);
                }elseif($modo == 2){
                    $stmte = $this->pdo->prepare("SELECT * FROM tb_tipo_fornecedor WHERE tifo_pk_id = :parametro");
                    $stmte->bindParam(":parametro", $parametro , PDO::PARAM_INT);
                }
                if($stmte->execute()){
                    if($stmte->rowCount() > 0){
                        while($result = $stmte->fetch(PDO::FETCH_OBJ)){
                            $tipo_fornecedor->setPkId($result->tifo_pk_id);
                            $tipo_fornecedor->setNome($result->tifo_nome);
                            $tipo_fornecedor->setFlag_ativo($result->tifo_flag_ativo);
                        }
                    }
                }
                return $tipo_fornecedor;

            }
            catch(PDOException $e){
                echo $e->getMessage();
                return -1;
            }
        }

        function delete($parametro){
            try{
                $stmt = $this->pdo->prepare("DELETE FROM tb_tipo_fornecedor WHERE for_pk_id = :parametro");
                $stmt->bindParam(":parametro", $parametro , PDO::PARAM_INT);
                $stmt->execute();
                return 1;
            }
            catch(PDOException $e){
                echo $e->getMessage();
                return -1;
            }
        }

        function selectAll(){
            $tipo_fornecedores = array();
            try{
                $stmte = $this->pdo->prepare("SELECT * FROM tb_tipo_fornecedor");
                $executa= $stmte->execute();
                if($executa){
                    while($result = $stmte->fetch(PDO::FETCH_OBJ)){
                        $tipo_fornecedor = new tipo_fornecedor();
                        $tipo_fornecedor->setPkId($result->tifo_pk_id);
                        $tipo_fornecedor->setNome($result->tifo_nome);
                        $tipo_fornecedor->setFlag_ativo($result->tifo_flag_ativo);

                        array_push($tipo_fornecedores, $tipo_fornecedor);
                    }
                }else{
                    return -1;
                }
                return $tipo_fornecedores;
            }
            catch(PDOException $e){
                echo $e->getMessage();
                return -1;
            }
        }

        function selectId($tifo_pk_id){

            $tipo_fornecedor = new tipo_fornecedor();

            try{
                $stmte = $this->pdo->prepare("SELECT * FROM tb_tipo_fornecedor WHERE tifo_pk_id = :tifo_pk_id");
                $stmte->bindParam(":tifo_pk_id",$tifo_pk_id, PDO::PARAM_INT);
                if($stmte->execute()){
                    if($stmte->rowCount() > 0){
                        while($result = $stmte->fetch(PDO::FETCH_OBJ)){
                            $tipo_fornecedor->setPkId($result->tifo_pk_id);
                            $tipo_fornecedor->setNome($result->tifo_nome);
                            $tipo_fornecedor->setFlag_ativo($result->tifo_flag_ativo);
                        }
                    }
                }
                return $tipo_fornecedor;
            }
            catch(PDOException $e){
                echo $e->getMessage();
            }

        }

        function countTipoFornecedor(){
            try{
                $stmte = $this->pdo->prepare("SELECT COUNT(*) AS tipo_fornecedores FROM tb_tipo_fornecedor");
                $stmte->execute();
                $result = $stmte->fetch(PDO::FETCH_OBJ);
                return $result->tipo_fornecedores;
            }
            catch(PDOException $e){
                echo $e->getMessage();
                return -1;
            }
        }

        function desativaTipoFornecedor($parametro){
            try{
                $stmt = $this->pdo->prepare("UPDATE tb_tipo_fornecedor SET tifo_flag_ativo = 0 WHERE tifo_pk_id = :parametro");
                $stmt->bindParam(":parametro", $parametro , PDO::PARAM_INT);
                $stmt->execute();
                return 1;
            }
            catch(PDOException $e){
                echo $e->getMessage();
                return -1;
            }
        }

        function ativaTipoFornecedor($parametro){
            try{
                $stmt = $this->pdo->prepare("UPDATE tb_tipo_fornecedor SET tifo_flag_ativo = 1 WHERE tifo_pk_id = :parametro");
                $stmt->bindParam(":parametro", $parametro , PDO::PARAM_INT);
                $stmt->execute();
                return 1;
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
<?php

include_once $_SERVER['DOCUMENT_ROOT']."/config.php"; 
include_once MODELPATH."/composicao.php";
include_once CONTROLLERPATH."/seguranca.php";

    class controlerComposicao{

        private $pdo;

        function insert($composicao){
            try{
                $stmt=$this->pdo->prepare("INSERT INTO tb_composicao (com_fk_produto, com_valor_extra)
                VALUES (:fk_produto, :valor_extra)");

                $stmt->bindParam(":fk_produto", $composicao->getFkProduto(), PDO::PARAM_INT);
                $stmt->bindParam(":valor_extra", $composicao->getValorExtra());
                $cod_composicao = $this->pdo->lastInsertId();

                $executa=$stmt->execute();

                if($executa){
                    return $cod_composicao;
                }
                else{
                    return -1;
                }


            }
            catch(PDOException $e){
                echo $e->getMessage();
            }
        }


        function update(){
            try{
                $stmt=$this->pdo->prepare("UPDATE tb_composicao SET ");
            }
            catch(PDOException $e){
                return $e->getMessage();
            }
        }

        function selectAll(){
            $composicoes = array();
            try{
                $stmt=$this->pdo->prepare("SELECT * 
                FROM tb_composicao AS COM
                INNER JOIN rl_composicao_ingrediente AS COIN
                ON COM.com_pk_id = COIN.coig_fk_composicao
                INNER JOIN tb_produto AS PRO
                ON COM.com_fk_produto = PRO.pro_pk_id");


                if($stmt->execute()){
                    if($stmt->rowCount() > 0){
                        while($result = $stmt->fetch(PDO::FETCH_OBJ)){
                            $composicao = new composicao();
                            $composicao->setPkId($result->com_pk_id);
                            $composicao->setFkProduto($result->com_fk_produto);
                            $composicao->setValorExtra($result->com_valor_extra);
                            $composicao->qtd_utilizada=$result->coig_qtde_utilizada;
                            $composicao->valor_calculado=$result->coig_valor_calculado;
                            $composicao->nome_prod=$result->pro_nome;

                            array_push($composicoes, $composicao);
                        }
                    }else{
                        return -1;
                    }
                    return $composicoes;
                }


            }
            catch(PDOException $e){
                return $e->getMessage();
            }
        }

        function sumValorTotal($cod_composicao){
            $cod_composicao = $cod_composicao;
            try{
                $stmt=$this->pdo->prepare("SELECT
                SUM(coig_valor_calculado) AS soma_valores
                FROM rl_composicao_ingrediente
                WHERE coig_fk_composicao =:cod_composicao");

                $stmt->bindParam(":cod_composicao", $cod_composicao , PDO::PARAM_INT);

                if($stmt->execute()){
                    if($stmt->rowCount() > 0){
                        $result = $stmt->fetchAll();
                    }else{
                        return -1;
                    }
                    return $result;
                }


            }
            catch(PDOException $e){
                return $e->getMessage();
            }
        }

        function selectByFkComposicao($cod_composicao){
            $cod_composicao = $cod_composicao;
            try{
                $stmt=$this->pdo->prepare("SELECT * 
                FROM tb_composicao AS COM
                INNER JOIN rl_composicao_ingrediente AS COIN
                ON COIN.coig_fk_composicao = COM.com_pk_id
                INNER JOIN tb_ingrediente AS ING
                ON ING.igr_pk_id = COIN.coig_fk_ingrediente
                WHERE COM.com_pk_id = :cod_composicao");

                $stmt->bindParam(":cod_composicao", $cod_composicao , PDO::PARAM_INT);

                if($stmt->execute()){
                    if($stmt->rowCount() > 0){
                        $result = $stmt->fetchAll();
                    }else{
                        return -1;
                    }
                    return $result;
                }


            }
            catch(PDOException $e){
                return $e->getMessage();
            }
        }

        function delete(){
            try{

            }
            catch(PDOException $e){
                return $e->getMessage();
            }
        }

        function __construct($pdo){
            $this->pdo=$pdo;
        }

    }


?>
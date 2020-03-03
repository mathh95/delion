<?php

include_once $_SERVER['DOCUMENT_ROOT']."/config.php";
include_once MODELPATH."/composicao.php";
include_once CONTROLLERPATH."/seguranca.php";

    class controlerComposicao{

        private $pdo;

        function insert(
            $composicao,
            $arr_ingredientes,
            $arr_qtd_utilizada
        ){
            try{

                $stmt=$this->pdo->prepare("INSERT INTO tb_composicao (com_fk_produto, com_valor_extra)
                VALUES (:fk_produto, :valor_extra)");

                $stmt->bindParam(":fk_produto", $composicao->getFkProduto(), PDO::PARAM_INT);
                $stmt->bindParam(":valor_extra", $composicao->getValorExtra());
                
                if(!$stmt->execute()) return FALSE;


                $fk_composicao = $this->pdo->lastInsertId();

                //set ingredientes a Composição
                foreach($arr_ingredientes as $key => $fk_ingrediente){
                    
                    $sql = $this->pdo->prepare("INSERT INTO rl_composicao_ingrediente SET coig_fk_composicao = :fk_composicao, coig_fk_ingrediente = :fk_ingrediente, coig_qtde_utilizada = :qtde_utilizada");

                    $sql->bindValue(":fk_composicao", $fk_composicao);
                    $sql->bindValue(":fk_ingrediente", $fk_ingrediente);
                    $sql->bindValue(":qtde_utilizada", $arr_qtd_utilizada[$key]);                    

                    if(!$sql->execute()) return FALSE;
                }
            
                return TRUE;
            }
            catch(PDOException $e){
                echo $e->getMessage();
            }
        }


        function update($composicao){
            try{
                $stmt=$this->pdo->prepare("UPDATE tb_composicao (com_fk_produto, com_valor_extra)
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

        function selectAll(){
            $composicoes = array();
            try{
                $stmt=$this->pdo->prepare("SELECT * 
                FROM tb_composicao AS COM
                INNER JOIN tb_produto AS PRO
                ON COM.com_fk_produto = PRO.pro_pk_id");
                if($stmt->execute()){
                    if($stmt->rowCount() > 0){
                        while($result = $stmt->fetch(PDO::FETCH_OBJ)){
                            $composicao = new composicao();
                            $composicao->setPkId($result->com_pk_id);
                            $composicao->setFkProduto($result->com_fk_produto);
                            $composicao->setValorExtra($result->com_valor_extra);
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


        function selectHistorico(){
            $composicoes = array();
            try{
                $stmt=$this->pdo->prepare("SELECT * 
                FROM tb_composicao AS COM
                INNER JOIN tb_produto AS PRO
                ON COM.com_fk_produto = PRO.pro_pk_id
                INNER JOIN rl_composicao_ingrediente AS COIN
                ON COM.com_pk_id = COIN.coig_fk_composicao
                INNER JOIN tb_ingrediente AS ING
                ON COIN.coig_fk_ingrediente = ING.igr_pk_id
                INNER JOIN tb_historico_ingrediente AS HIS
                ON ING.igr_pk_id = HIS.higr_fk_ingrediente
                ORDER BY HIS.higr_data DESC");


                if($stmt->execute()){
                    if($stmt->rowCount() > 0){
                        while($result = $stmt->fetch(PDO::FETCH_OBJ)){
                            $composicao = new composicao();
                            $composicao->setPkId($result->com_pk_id);
                            $composicao->setFkProduto($result->com_fk_produto);
                            $composicao->setValorExtra($result->com_valor_extra);
                            $composicao->nome_ingrediente=$result->igr_nome;
                            $composicao->nome_prod=$result->pro_nome;
                            $composicao->ingrediente_valor=$result->higr_valor;
                            $composicao->ingrediente_data=$result->higr_data;

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

        function selectValores($cod_ingrediente){
            $cod_ingrediente = $cod_ingrediente;
            try{
                $stmt=$this->pdo->prepare("SELECT *
                FROM tb_ingrediente
                WHERE igr_pk_id =:cod_ingrediente");
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

        function selectHistory($cod_composicao){
            $cod_composicao = $cod_composicao;
            try{
                $stmt=$this->pdo->prepare("SELECT * 
                FROM tb_composicao AS COM
                INNER JOIN rl_composicao_ingrediente AS COIN
                ON COIN.coig_fk_composicao = COM.com_pk_id
                INNER JOIN tb_ingrediente AS ING
                ON ING.igr_pk_id = COIN.coig_fk_ingrediente
                INNER JOIN tb_historico_ingrediente AS HIS
                ON HIS.higr_fk_ingrediente = ING.igr_pk_id
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


        function selectByPkIngrediente($cod_ingrediente){
            $cod_ingrediente = $cod_ingrediente;
            try{
                $stmt=$this->pdo->prepare("SELECT * 
                FROM tb_ingrediente AS ING
                INNER JOIN tb_historico_ingrediente AS HIS
                ON ING.igr_pk_id = HIS.higr_fk_ingrediente
                WHERE HIS.higr_fk_ingrediente = :cod_ingrediente");

                $stmt->bindParam(":cod_ingrediente", $cod_ingrediente , PDO::PARAM_INT);

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
                echo $e->getMessage();
                return -1;
            }
        }

        function __construct($pdo){
            $this->pdo=$pdo;
        }

    }


?>
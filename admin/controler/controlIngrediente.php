<?php
    include_once MODELPATH. "/ingrediente.php";
    include_once "seguranca.php";
    protegePagina();


    class controlerIngrediente{
        private $pdo;

        //Insere os dados na tb_item_composicao
        function insert($ingrediente){
            try{
                $stmte =$this->pdo->prepare("INSERT INTO tb_ingrediente(igr_nome, igr_unidade, igr_valor)
                VALUES (:nome, :unidade, :valor)");

                $stmte->bindParam(":nome", $ingrediente->getNome(), PDO::PARAM_STR);
                $stmte->bindParam(":unidade", $ingrediente->getUnidade(), PDO::PARAM_STR);
                $stmte->bindParam(":valor", $ingrediente->getValor(), PDO::PARAM_INT);

                $executa = $stmte->execute();
                $higr_fk_ingrediente = $this->pdo->lastInsertId();

                if($executa){
                    return $higr_fk_ingrediente;
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

        function insertHistorico($cod_ingrediente, $ingrediente){
            try{
                $stmte =$this->pdo->prepare("INSERT INTO tb_historico_ingrediente SET higr_valor = :valor, higr_data = NOW(), higr_fk_ingrediente = :cod_ingrediente");

                $stmte->bindValue(":valor", $ingrediente->getValor(), PDO::PARAM_INT);
                $stmte->bindValue(":cod_ingrediente", $cod_ingrediente);

                $executa = $stmte->execute();

                if($executa){
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

        function insertHistoricoProduto($cod_produto, $ingrediente){
            try{
                $stmte =$this->pdo->prepare("INSERT INTO tb_historico_produto SET hipr_valor = :valor, hipr_data = NOW(), hipr_fk_produto = :cod_produto");

                $stmte->bindValue(":valor", $ingrediente->getValor(), PDO::PARAM_INT);
                $stmte->bindValue(":cod_produto", $cod_produto);

                $executa = $stmte->execute();

                if($executa){
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


        //Altera os dados na tb_item_composicao
        function update($ingrediente){
            try{
                $stmte = $this->pdo->prepare("UPDATE tb_ingrediente SET igr_nome=:nome, igr_unidade=:unidade, igr_valor=:valor WHERE igr_pk_id=:cod_ingrediente");

                $stmte->bindParam(":cod_ingrediente",$ingrediente->getPkId(), PDO::PARAM_INT);
                $stmte->bindParam(":nome", $ingrediente->getNome(), PDO::PARAM_STR);
                $stmte->bindParam(":unidade", $ingrediente->getUnidade(), PDO::PARAM_STR);
                $stmte->bindParam(":valor", $ingrediente->getValor(), PDO::PARAM_INT);
                
                // $cod_ingrediente = $ingrediente->getPkId();

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

        //Seleciona um determinado item_composicao
        function select($parametro, $modo){
            $ingrediente = new ingrediente();
            try{
                if($modo == 1){
                    $stmte = $this->pdo->prepare("SELECT * FROM tb_ingrediente WHERE igr_nome LIKE :parametro");
                    $stmte->bindParam(":parametro", $parametro . "%", PDO::PARAM_STR);
                }elseif ($modo == 2) {
                    $stmte = $this->pdo->prepare("SELECT * FROM tb_ingrediente WHERE igr_pk_id = :parametro");
                    $stmte->bindParam(":parametro", $parametro , PDO::PARAM_INT);
                }
                if($stmte->execute()){
                    if($stmte->rowCount() > 0){
                        while($result = $stmte->fetch(PDO::FETCH_OBJ)){
                            $ingrediente->setPkId($result->igr_pk_id);
                            $ingrediente->setNome($result->igr_nome);
                            $ingrediente->setUnidade($result->igr_unidade);
                            $ingrediente->setValor($result->igr_valor);
                        }
                    }
                }
                return $ingrediente;
            }
            catch(PDOException $e){
                echo $e->getMessage();
                return -1;
            }
        }

        //Seleciona todos
        function selectAll(){
            $ingredientes = array();
            try{
                $stmte = $this->pdo->prepare("SELECT * FROM tb_ingrediente");
                if($stmte->execute()){
                    if($stmte->rowCount() > 0){
                        while($result = $stmte->fetch(PDO::FETCH_OBJ)){
                            $ingrediente = new ingrediente();
                            $ingrediente->setPkId($result->igr_pk_id);
                            $ingrediente->setNome($result->igr_nome);
                            $ingrediente->setUnidade($result->igr_unidade);
                            $ingrediente->setValor($result->igr_valor);
                            array_push($ingredientes, $ingrediente);
                        }
                    }
                }
                return $ingredientes;
            }
            catch(PDOException $e){
                echo $e->getMessage();
            }
        }

        function selectByFkComposicao($fk_composicao){
            $array = array();

            $stmte = $this->pdo->prepare("SELECT *
            FROM tb_ingrediente
            INNER JOIN rl_composicao_ingrediente
            ON coig_fk_ingrediente = igr_pk_id
            INNER JOIN tb_composicao
            ON coig_fk_composicao = com_pk_id
            WHERE coig_fk_composicao =:fk_composicao");

            $stmte->bindParam(":fk_composicao", $fk_composicao);

            if($stmte->execute()){
                if($stmte->rowCount() > 0){
                    $array = $stmte->fetchAll();
                }
            }

            return $array;
        }

        //Deleta um determinado registro
        function delete($parametro){
            try{
                $stmte = $this->pdo->prepare("DELETE FROM tb_ingrediente WHERE igr_pk_id = :parametro");
                $stmte->bindParam(":parametro", $parametro, PDO::PARAM_INT);
                $stmte->execute();
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
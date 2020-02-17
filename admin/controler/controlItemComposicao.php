<?php
    include_once MODELPATH. "/item_composicao.php";
    include_once "seguranca.php";
    protegePagina();


    class controlerItemComposicao{
        private $pdo;

        //Insere os dados na tb_item_composicao
        function insert($itemComposicao){
            try{
                $stmte =$this->pdo->prepare("INSERT INTO tb_item_composicao(itco_nome, itco_unidade, itco_valor, itco_qtd)
                VALUES (:nome, :unidade, :valor, :qtd)");

                $stmte->bindParam(":nome", $itemComposicao->getNome(), PDO::PARAM_STR);
                $stmte->bindParam(":unidade", $itemComposicao->getUnidade(), PDO::PARAM_STR);
                $stmte->bindParam(":valor", $itemComposicao->getValor(), PDO::PARAM_INT);
                $stmte->bindParam(":qtd", $itemComposicao->getQtd(), PDO::PARAM_INT);

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

        //Altera os dados na tb_item_composicao
        function update($itemComposicao){
            try{
                $stmte = $this->pdo->prepare("UPDATE tb_item_composicao SET itco_nome=:nome, itco_unidade=:unidade, itco_valor=:valor, itco_qtd=:qtd WHERE itco_pk_id=:cod_item_composicao");

                $stmte->bindParam(":cod_item_composicao",$itemComposicao->getPkId(), PDO::PARAM_INT);
                $stmte->bindParam(":nome", $itemComposicao->getNome(), PDO::PARAM_STR);
                $stmte->bindParam(":unidade", $itemComposicao->getCnpj(), PDO::PARAM_STR);
                $stmte->bindParam(":valor", $itemComposicao->getFone(), PDO::PARAM_INT);
                $stmte->bindParam(":qtd", $itemComposicao->getQtdDias(), PDO::PARAM_INT);
                

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
            $item_composicao = new item_composicao();
            try{
                if($modo == 1){
                    $stmte = $this->pdo->prepare("SELECT * FROM tb_item_composicao WHERE itco_nome LIKE :parametro");
                    $stmte->bindParam(":parametro", $parametro . "%", PDO::PARAM_STR);
                }elseif ($modo == 2) {
                    $stmte = $this->pdo->prepare("SELECT * FROM tb_item_composicao WHERE itco_pk_id = :parametro");
                    $stmte->bindParam(":parametro", $parametro , PDO::PARAM_INT);
                }
                if($stmte->execute()){
                    if($stmte->rowCount() > 0){
                        while($result = $stmte->fetch(PDO::FETCH_OBJ)){
                            $item_composicao->setPkId($result->itco_pk_id);
                            $item_composicao->setNome($result->itco_nome);
                            $item_composicao->setUnidade($result->itco_unidade);
                            $item_composicao->setValor($result->itco_valor);
                            $item_composicao->setQtd($result->itco_qtd);
                        }
                    }
                }
                return $item_composicao;
            }
            catch(PDOException $e){
                echo $e->getMessage();
                return -1;
            }
        }

        //Seleciona todos
        function selectAll(){
            $itens_composicao = array();
            try{
                $stmte= $this->pdo->prepare("SELECT * FROM tb_item_composicao");
                $executa= $stmte->execute();
                if($executa){
                    if($stmte->rowCount() > 0){
                        while($result = $stmte->fetch(PDO::FETCH_OBJ)){
                            $item_composicao = new item_composicao();
                            $item_composicao->setPkId($result->itco_pk_id);
                            $item_composicao->setNome($result->itco_nome);
                            $item_composicao->setUnidade($result->itco_unidade);
                            $item_composicao->setValor($result->itco_valor);
                            $item_composicao->setQtd($result->itco_qtd);

                            array_push($itens_composicao, $item_composicao);
                        }
                    }else{
                        return -1;
                    }
                    return -1;
                }
            }
            catch(PDOException $e){
                echo $e->getMessage();
                return -1;
            }
        }

        //Deleta um determinado registro
        function delete($parametro){
            try{
                $stmte = $this->pdo->prepare("DELETE FROM tb_item_composicao WHERE itco_pk_id = :parametro");
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
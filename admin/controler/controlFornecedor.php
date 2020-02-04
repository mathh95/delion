<?php
    include_once MODELPATH. "/fornecedor.php";
    include_once "seguranca.php";
    protegePagina();


    class controlerFornecedor{
        private $pdo;

        function insert($fornecedor){
            try{
                $stmte =$this->pdo->prepare("INSERT INTO tb_fornecedor(for_nome, for_cnpj, for_fone, for_qtd_dias_pgto, for_endereco, for_referencia, for_fk_tipo_fornecedor)
                VALUES (:nome, :cnpj, :fone, :qtd_dias_pgto, :endereco, :referencia, :tipo_fornecedor)");

                $stmte->bindParam(":nome", $fornecedor->getNome(), PDO::PARAM_STR);
                $stmte->bindParam(":cnpj", $fornecedor->getCnpj(), PDO::PARAM_STR);
                $stmte->bindParam(":fone", $fornecedor->getFone(), PDO::PARAM_STR);
                $stmte->bindParam(":qtd_dias_pgto", $fornecedor->getQtdDias(), PDO::PARAM_INT);
                $stmte->bindParam(":endereco", $fornecedor->getTxtEndereco(), PDO::PARAM_STR);
                $stmte->bindParam(":referencia", $fornecedor->getEndRef(), PDO::PARAM_STR);
                $stmte->bindParam(":tipo_fornecedor", $fornecedor->getPkTipoFornecedor(), PDO::PARAM_INT);

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

        function update($fornecedor){
            try{
                $stmte = $this->pdo->prepare("UPDATE tb_fornecedor SET for_nome=:nome, for_cnpj=:cnpj, for_fone=:fone, for_qtd_dias_pgto=:qtd_dias_pgto, for_endereco=:endereco, for_referencia=:referencia, for_fk_tipo_fornecedor=:fk_tipo_fornecedor WHERE for_pk_id=:cod_fornecedor");

                $stmte->bindParam(":cod_fornecedor",$fornecedor->getPkId(), PDO::PARAM_INT);
                $stmte->bindParam(":nome", $fornecedor->getNome(), PDO::PARAM_STR);
                $stmte->bindParam(":cnpj", $fornecedor->getCnpj(), PDO::PARAM_STR);
                $stmte->bindParam(":fone", $fornecedor->getFone(), PDO::PARAM_STR);
                $stmte->bindParam(":qtd_dias_pgto", $fornecedor->getQtdDias(), PDO::PARAM_INT);
                $stmte->bindParam(":endereco", $fornecedor->getTxtEndereco(), PDO::PARAM_STR);
                $stmte->bindParam(":referencia", $fornecedor->getEndRef(), PDO::PARAM_STR);
                $stmte->bindParam(":fk_tipo_fornecedor", $fornecedor->getPkTipoFornecedor(), PDO::PARAM_INT);
                

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
            $fornecedor = new fornecedor();
            try{
                if($modo == 1){
                    $stmte = $this->pdo->prepare("SELECT * FROM tb_fornecedor WHERE for_nome LIKE :parametro");
                    $stmte->bindParam(":parametro", $parametro . "%", PDO::PARAM_STR);
                }elseif ($modo == 2) {
                    $stmte = $this->pdo->prepare("SELECT * FROM tb_fornecedor WHERE for_pk_id = :parametro");
                    $stmte->bindParam(":parametro", $parametro , PDO::PARAM_INT);
                }
                if($stmte->execute()){
                    if($stmte->rowCount() > 0){
                        while($result = $stmte->fetch(PDO::FETCH_OBJ)){
                            $fornecedor->setPkId($result->for_pk_id);
                            $fornecedor->setNome($result->for_nome);
                            $fornecedor->setCnpj($result->for_cnpj);
                            $fornecedor->setTxtEndereco($result->for_endereco);
                            $fornecedor->setEndRef($result->for_referencia);
                            $fornecedor->setFone($result->for_fone);
                            $fornecedor->setQtdDias($result->for_qtd_dias_pgto);
                            $fornecedor->setPkTipoFornecedor($result->for_fk_tipo_fornecedor);
                        }
                    }
                }
                return $fornecedor;
            }
            catch(PDOException $e){
                echo $e->getMessage();
                return -1;
            }
        } 

        function delete($parametro){
            try{
                $stmt = $this->pdo->prepare("DELETE FROM tb_fornecedor WHERE for_pk_id = :parametro");
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
            $fornecedores = array();
            try{   
                $stmte= $this->pdo->prepare("SELECT * FROM tb_fornecedor");
                $executa= $stmte->execute();
                if($executa){
                    if($stmte->rowCount() > 0){
                        while($result = $stmte->fetch(PDO::FETCH_OBJ)){
                            $fornecedor = new fornecedor();
                            $fornecedor->setPkId($result->for_pk_id);
                            $fornecedor->setNome($result->for_nome);
                            $fornecedor->setCnpj($result->for_cnpj);
                            $fornecedor->setFone($result->for_fone);
                            $fornecedor->setQtdDias($result->for_qtd_dias_pgto);
                            $fornecedor->setTxtEndereco($result->for_endereco);
                            $fornecedor->setEndRef($result->for_referencia);
                            $fornecedor->setPkTipoFornecedor($result->for_fk_tipo_fornecedor);

                            array_push($fornecedores, $fornecedor);
                        }
                    }else{
                        return -1;
                    }
                    return $fornecedores;
                }

            }
            catch(PDOException $e){
                echo $e->getMessage();
                return -1;
            }

        }

        function countFornecedor(){
            try{
                $stmte = $this->pdo->prepare("SELECT COUNT(*) AS fornecedores FROM tb_fornecedores");
                $stmte->execute();
                $result = $stmte->fetch(PDO::FETCH_OBJ);
                return $result->fornecedores;
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
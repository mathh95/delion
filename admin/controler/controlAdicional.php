<?php
    include_once ROOTPATH."/config.php";
    include_once MODELPATH."/adicional.php";
    include_once "seguranca.php";

    protegePagina("cross_call");

    class controlerAdicional {
        private $pdo;
        function insert($adicional){
            try{
                $stmte =$this->pdo->prepare("INSERT INTO tb_adicional(adi_nome, adi_preco, adi_flag_ativo)
                VALUES (:nome, :preco, :flag_ativo)");
                $stmte->bindParam(":nome", $adicional->getNome(), PDO::PARAM_STR);
                $stmte->bindParam(":preco", $adicional->getPreco());
                $stmte->bindParam(":flag_ativo", $adicional->getFlag_ativo());
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

        function update($adicional){
            try{
                $stmte =$this->pdo->prepare("UPDATE tb_adicional SET adi_nome=:nome, adi_preco=:preco, adi_flag_ativo = :flag_ativo WHERE adi_pk_id=:cod_adicional");
                $stmte->bindParam(":cod_adicional", $adicional->getPkId() , PDO::PARAM_INT);
                $stmte->bindParam(":nome", $adicional->getNome(), PDO::PARAM_STR);
                $stmte->bindParam(":preco", $adicional->getPreco());
                $stmte->bindParam(":flag_ativo", $adicional->getFlag_ativo());
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

        /*

          modo: 1-Nome, 2-id

        */

        function selectId($cod){
            $adicional = new adicional();

            try{
                $stmte = $this->pdo->prepare("SELECT * FROM tb_adicional WHERE adi_pk_id = :cod");
                $stmte->bindParam(":cod", $cod , PDO::PARAM_INT);
                if($stmte->execute()){
                    if($stmte->rowCount() > 0){
                        while($result = $stmte->fetch(PDO::FETCH_OBJ)){
                            $adicional->setPkId($result->adi_pk_id);
                            $adicional->setNome($result->adi_nome);
                            $adicional->setPreco($result->adi_preco); 
                            $adicional->setFlag_ativo($result->adi_flag_ativo); 
                        }
                    }
                }
                return $adicional;
            }
            catch(PDOException $e){
                echo $e->getMessage();
            }
        }

        function verificaIgual($parametro){
            $adicional = new adicional();
            try{
                $stmte = $this->pdo->prepare("SELECT * FROM tb_adicional WHERE adi_nome = :parametro");
                $stmte->bindValue(":parametro", $parametro, PDO::PARAM_STR);
                if($stmte->execute()){
                        if($stmte->rowCount() > 0){
                            while($result = $stmte->fetch(PDO::FETCH_OBJ)){
                                $adicional->setPkId($result->adi_pk_id);
                                $adicional->setNome($result->adi_nome);
                            }
                        }
                }
                return $adicional;
            }
            catch(PDOException $e){
                echo $e->getMessage();
            }
        }

        function filter($parametro, $flag_ativo, $delivery, $prioridade){
            try{
                $stmte = $this->pdo->prepare("SELECT *
                FROM tb_produto AS PRO
                INNER JOIN tb_categoria AS CAT
                ON PRO.pro_fk_categoria = CAT.cat_pk_id
                WHERE PRO.pro_nome LIKE :parametro AND PRO.pro_flag_ativo LIKE :flag_ativo AND PRO.pro_flag_delivery LIKE :delivery AND PRO.pro_flag_prioridade LIKE :prioridade");

                $stmte->bindValue(":parametro","%".$parametro."%");
                $stmte->bindValue(":flag_ativo","%" .$flag_ativo);
                $stmte->bindValue(":delivery","%".$delivery);
                $stmte->bindValue(":prioridade","%".$prioridade);

                $produtos = array();
                if($stmte->execute()){
                    if($stmte->rowCount() > 0){
                        while($result = $stmte->fetch(PDO::FETCH_OBJ)){
                            $produto = new produto();
                            $produto->setPkId($result->pro_pk_id);
                            $produto->setNome($result->pro_nome);
                            $produto->setPreco($result->pro_preco);
                            $produto->setDesconto($result->pro_desconto);
                            $produto->setDescricao($result->pro_descricao);
                            $produto->setFoto($result->pro_foto);
                            $produto->setCategoria($result->cat_nome);
                            $produto->setFlag_ativo($result->pro_flag_ativo);
                            $produto->setFlag_servindo($result->pro_flag_servindo);
                            $produto->setPrioridade($result->pro_flag_prioridade);
                            $produto->setDelivery($result->pro_flag_delivery);
                            $produto->setPosicao($result->pro_posicao);
                            $produto->setDias_semana($result->pro_arr_dias_semana);
                            $produto->setProduto_horas_inicio($result->faho_inicio);
                            $produto->setProduto_horas_final($result->faho_final);
                            array_push($produtos, $produto);
                        }
                    }
                }
                return $produtos;
                
            }
            catch(PDOException $e){
                echo $e->getMessage();
            }
        }

        function delete($parametro){
            try{
                $stmt = $this->pdo->prepare("UPDATE tb_adicional SET adi_flag_ativo = 0 WHERE adi_pk_id = :parametro");
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
            $adicionais = array();
            try{
                $stmte = $this->pdo->prepare("SELECT * FROM tb_adicional");
                if($stmte->execute()){
                    if($stmte->rowCount() > 0){
                        while($result = $stmte->fetch(PDO::FETCH_OBJ)){
                            $adicional = new adicional();
                            $adicional->setPkId($result->adi_pk_id);
                            $adicional->setNome($result->adi_nome);
                            $adicional->setPreco($result->adi_preco);
                            $adicional->setFlag_ativo($result->adi_flag_ativo);
                            array_push($adicionais, $adicional);
                        }
                    }else{
                        return NULL;
                    }
                    return $adicionais;
                }
                else{
                    return NULL;
                }
            }
            catch(PDOException $e){
                echo $e->getMessage();
            }
        }


        function buscarVariosId($itens){
            $array = array();

            $sql = "SELECT * FROM tb_adicional WHERE adi_pk_id IN (".implode(',', $itens).")";
            $sql = $this->pdo->query($sql);

            if($sql -> rowCount() > 0){
                $array = $sql->fetchAll();
            }

            return $array;
        }

        function __construct($pdo){
            $this->pdo=$pdo;
        }
    }
?>
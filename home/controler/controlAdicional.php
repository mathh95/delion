<?php
    include_once ROOTPATH."/config.php";
    include_once MODELPATH."/adicional.php";

    class controlerAdicional {
        private $pdo;
        function insert($adicional){
            try{
                $stmte =$this->pdo->prepare("INSERT INTO tb_adicional(adi_nome, adi_preco, adi_desconto, adi_flag_ativo)
                VALUES (:nome, :preco, :desconto, :flag_ativo)");
                $stmte->bindParam(":nome", $adicional->getNome(), PDO::PARAM_STR);
                $stmte->bindParam(":preco", $adicional->getPreco());
                $stmte->bindParam(":desconto", $adicional->getDesconto());
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
                $stmte =$this->pdo->prepare("UPDATE tb_adicional SET adi_nome=:nome, adi_preco=:preco, adi_desconto = :desconto, adi_flag_ativo = :flag_ativo WHERE adi_cod_adicional=:cod_adicional");
                $stmte->bindParam(":cod_adicional", $adicional->getPkId() , PDO::PARAM_INT);
                $stmte->bindParam(":nome", $adicional->getNome(), PDO::PARAM_STR);
                $stmte->bindParam(":preco", $adicional->getPreco());
                $stmte->bindParam(":desconto", $adicional->getDesconto());
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

        function selectId($id){

            $adicional = new adicional();
            try{
                $stmte = $this->pdo->prepare("SELECT * FROM tb_adicional WHERE adi_pk_id = :id");
                $stmte->bindParam(":id", $id , PDO::PARAM_INT);
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
                    }
                }
                return $adicionais;
            }
            catch(PDOException $e){
                echo $e->getMessage();
            }
        }

        function selectAllF(){
            $array_adicionais = array();

            $sql = "SELECT * FROM tb_adicional";

            $sql = $this->pdo->query($sql);

            if($sql -> rowCount() > 0){
                $array_adicionais = $sql->fetchAll();
            }

            return $array_adicionais;
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
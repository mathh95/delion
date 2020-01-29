<?php
    include_once MODELPATH."/fidelidade.php";
    include_once "seguranca.php";
    protegePagina();

    class controlerFidelidade {
        private $pdo;
        
        function insert($fidelidade){
            try{
                $stmte =$this->pdo->prepare("INSERT INTO tb_fidelidade(fid_descricao, fid_historia)
                VALUES (:taxa_conversao_pts, :fk_empresa)");

                $stmte->bindParam(":taxa_conversao_pts", $fidelidade->getTaxaConversaoPts(), PDO::PARAM_STR);
                $stmte->bindParam(":fk_empresa", $fidelidade->getFkEmpresa(), PDO::PARAM_INT);

                
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


        function update($fidelidade){

            try{
                $stmte =$this->pdo->prepare("UPDATE tb_fidelidade
                SET fid_taxa_conversao_pts=:taxa_conversao_pts
                WHERE fid_pk_id=:pk_id");

                $stmte->bindParam(":pk_id", $fidelidade->getPkId() , PDO::PARAM_INT);
                $stmte->bindParam(":taxa_conversao_pts", $fidelidade->getTaxaConversaoPts(), PDO::PARAM_STR);


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


        function selectById($pk_id){

            $fidelidade = new fidelidade();
            try{
                
                $stmte = $this->pdo->prepare("SELECT * 
                    FROM tb_fidelidade
                    WHERE fid_pk_id = :pk_id");

                    $stmte->bindParam(":pk_id", $pk_id , PDO::PARAM_INT);
               
                if($stmte->execute()){
                    if($stmte->rowCount() > 0){
                        while($result = $stmte->fetch(PDO::FETCH_OBJ)){
                            $fidelidade->setPkId($result->fid_pk_id);
                            $fidelidade->setTaxaConversaoPts($result->fid_taxa_conversao_pts);
                            $fidelidade->setFkEmpresa($result->fid_fk_empresa);
                        }
                    }
                }
                return $fidelidade;
            }
            catch(PDOException $e){
                echo $e->getMessage();
            }
        }

        function selectByFkEmpresa($fk_empresa){

            $fidelidade = new fidelidade();
            try{
                
                $stmte = $this->pdo->prepare("SELECT * 
                    FROM tb_fidelidade
                    WHERE fid_fk_empresa = :fk_empresa");

                $stmte->bindParam(":fk_empresa", $fk_empresa , PDO::PARAM_INT);
               
                if($stmte->execute()){
                    if($stmte->rowCount() > 0){
                        while($result = $stmte->fetch(PDO::FETCH_OBJ)){
                            $fidelidade->setPkId($result->fid_pk_id);
                            $fidelidade->setTaxaConversaoPts($result->fid_taxa_conversao_pts);
                            $fidelidade->setFkEmpresa($result->fid_fk_empresa);
                        }
                    }
                }
                return $fidelidade;
            }
            catch(PDOException $e){
                echo $e->getMessage();
            }
        }


        function delete($pk_id){
            try{
                $stmt = $this->pdo->prepare("DELETE FROM tb_fidelidade
                    WHERE fid_pk_id = :pk_id");
                $stmt->bindParam(":pk_id", $pk_id , PDO::PARAM_INT);
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
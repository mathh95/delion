<?php
    include_once ROOTPATH. "/config.php";
    include_once MODELPATH. "/forma_pgto.php";
    include_once "seguranca.php";

    protegePagina("carrinho_call");//flag de exceção, permite acessar control sem login

    class controlerFormaPgt{

        private $pdo;

        function insert($formaPgt){
            try{
                $stmte =$this->pdo->prepare("INSERT INTO tb_forma_pgto(fopg_nome, fopg_flag_ativo)
                VALUES (:tipoFormaPgt, :flag_ativo)");
                $stmte->bindParam(":tipoFormaPgt", $formaPgt->getNome(), PDO::PARAM_STR);
                $stmte->bindParam(":flag_ativo", $formaPgt->getFlag_ativo());
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
    
        function update($formapgt){
            try{
                $stmte =$this->pdo->prepare("UPDATE tb_forma_pgto SET fopg_nome=:tipoFormaPgt, fopg_flag_ativo=:flag_ativo WHERE fopg_pk_id=:fopg_pk_id");
                $stmte->bindParam(":fopg_pk_id",$formapgt->getPkId(), PDO::PARAM_INT);
                $stmte->bindParam(":tipoFormaPgt", $formapgt->getNome(), PDO::PARAM_INT);
                $stmte->bindParam(":flag_ativo", $formapgt->getFlag_ativo());
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

        function selectId($fopg_pk_id){

            $formaPgt = new forma_pgto();

            try{
                $stmte = $this->pdo->prepare("SELECT * FROM tb_forma_pgto WHERE fopg_pk_id = :fopg_pk_id");
                $stmte->bindParam(":fopg_pk_id",$fopg_pk_id, PDO::PARAM_INT);
                if($stmte->execute()){
                    if($stmte->rowCount() > 0){
                        while($result = $stmte->fetch(PDO::FETCH_OBJ)){
                            $formaPgt->setPkId($result->fopg_pk_id);
                            $formaPgt->setNome($result->fopg_nome);
                            $formaPgt->setFlag_ativo($result->fopg_flag_ativo);
                        }
                    }
                }
                return $formaPgt;
            }
            catch(PDOException $e){
                echo $e->getMessage();
            }

        }

        function delete($parametro){
            try{
                $stmt = $this->pdo->prepare("UPDATE tb_forma_pgto SET fopg_flag_ativo = 0 WHERE fopg_pk_id = :parametro");
                $stmt->bindParam(":parametro", $parametro , PDO::PARAM_INT);
                $stmt->execute();
                return 1;
            }
            catch(PDOException $e){
                echo $e->getMessage();
                return -1;
            }
        }

        function desativaFormaPgt($parametro){
            try{
                $stmt = $this->pdo->prepare("UPDATE tb_forma_pgto SET fopg_flag_ativo = 0 WHERE fopg_pk_id = :parametro");
                $stmt->bindParam(":parametro", $parametro , PDO::PARAM_INT);
                $stmt->execute();
                return 1;
            }
            catch(PDOException $e){
                echo $e->getMessage();
                return -1;
            }
        }

        function ativaFormaPgt($parametro){
            try{
                $stmt = $this->pdo->prepare("UPDATE tb_forma_pgto SET fopg_flag_ativo = 1 WHERE fopg_pk_id = :parametro");
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

            $formapgts = array();
            try{
                $stmte = $this->pdo->prepare("SELECT * FROM tb_forma_pgto");
                $executa= $stmte->execute();
                if($executa){
                    if($stmte->rowCount() > 0){
                        while($result = $stmte->fetch(PDO::FETCH_OBJ)){
                            $formapgt = new forma_pgto();
                            $formapgt->setPkId($result->fopg_pk_id);
                            $formapgt->setNome($result->fopg_nome);
                            $formapgt->setFlag_ativo($result->fopg_flag_ativo);
                            array_push($formapgts, $formapgt);
                        }
                    }else{
                        // echo "Sem resultados";
                        return -1;
                    }
                    return $formapgts;
                }else{
                    return -1;
                }
            }
            catch(PDOException $e){
                echo $e->getMessage();
            }
        }
        
        function __construct($pdo){
            $this->pdo=$pdo;
        }
    }

?>
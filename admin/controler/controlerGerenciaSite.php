<?php
include_once MODELPATH."/gerencia_site.php";
include_once "seguranca.php";

protegePagina();

class controlerGerenciarSite{
    private $pdo;
        function insert($config){
                try{
                    $stmte =$this->pdo->prepare("INSERT INTO tb_gerencia_site(geren_nome, geren_ima_foto, geren_flag_ativo ,geren_cor_primaria, geren_cor_secundaria)
                    VALUES (:nome, :foto, :flag_ativo, :cor_primaria, :cor_secundaria)");
                    $stmte->bindParam("nome", $config->getNome(), PDO::PARAM_STR);
                    $stmte->bindParam("foto", $config->getFoto(), PDO::PARAM_STR);
                    $stmte->bindParam("flag_ativo", $config->getFlag_ativo(), PDO::PARAM_INT);
                    $stmte->bindParam("cor_primaria", $config->getCorPrimaria(), PDO::PARAM_STR);
                    $stmte->bindParam("cor_secundaria", $config->getCorSecundaria(), PDO::PARAM_STR);
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
        

        function update($config){
            try{
                $stmte =$this->pdo->prepare("UPDATE tb_gerencia_site SET geren_nome=:nome, geren_ima_foto=:foto, geren_cor_primaria=:cor_primaria, garen_cor_secundaria=:cor_secundaria WHERE geren_pk_id=:cod_geren");
                $stmte->bindParam("cod_geren", $config->getPkId(), PDO::PARAM_INT);
                $stmte->bindParam(":nome", $config->getNome(), PDO::PARAM_STR);
                $stmte->bindParam(":foto", $config->getFoto(), PDO::PARAM_STR);
                $stmte->bindParam(":cor_primaria", $config->getCorPrimaria(), PDO::PARAM_STR);
                $stmte->bindParam(":cor_secundaria", $config->getCorSecundaria(), PDO::PARAM_STR);
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
        
        function desativaAllConfig($parametro){
            try{
                $stmt = $this->pdo->prepare("UPDATE tb_gerencia_site SET geren_flag_ativo = 0 WHERE geren_pk_id <> :parametro");
                $stmt->bindParam(":parametro", $parametro , PDO::PARAM_INT);
                $stmt->execute();
                return 1;
            }
            catch(PDOException $e){
                echo $e->getMessage();
                return -1;
            }
        }

        function ativaConfig($parametro){
            try{
                $stmt = $this->pdo->prepare("UPDATE tb_gerencia_site SET geren_flag_ativo = 1 WHERE geren_pk_id = :parametro");
                $stmt->bindParam(":parametro", $parametro , PDO::PARAM_INT);
                $stmt->execute();
                return 1;
            }
            catch(PDOException $e){
                echo $e->getMessage();
                return -1;
            }
        }

        function desativaOneConfig($parametro){
            try{
                $stmt = $this->pdo->prepare("UPDATE tb_gerencia_site SET geren_flag_ativo = 0 WHERE geren_pk_id = :parametro");
                $stmt->bindParam(":parametro", $parametro , PDO::PARAM_INT);
                $stmt->execute();
                return 1;
            }
            catch(PDOException $e){
                echo $e->getMessage();
                return -1;
            }
        }

        function select($parametro,$modo){
            $config= new gerencia_site();
            try{
                if($modo==1){
                    $stmte = $this->pdo->prepare("SELECT * FROM tb_gerencia_site WHERE geren_nome LIKE :parametro");
                    $stmte->bindParam(":parametro", $parametro . "%" , PDO::PARAM_STR);
                }elseif ($modo==2) {
                    $stmte = $this->pdo->prepare("SELECT * FROM tb_gerencia_site WHERE geren_pk_id = :parametro");
                    $stmte->bindParam(":parametro", $parametro , PDO::PARAM_INT);
                }
                if($stmte->execute()){
                    if($stmte->rowCount() > 0){
                        while($result = $stmte->fetch(PDO::FETCH_OBJ)){
                            $config->setPkId($result->geren_pk_id);
                            $config->setNome($result->geren_nome);
                            $config->setFoto($result->geren_ima_foto);
                            $config->setFlag_ativo($result->geren_flag_ativo);
                            $config->setCorPrimaria($result->geren_cor_primaria);
                            $config->setCorSecundaria($result->geren_cor_secundaria);
                        }
                    }
                }
                return $config;
            }
            catch(PDOException $e){
                echo $e->getMessage();
            }
        }

        function selectConfigValida(){
            $config = new gerencia_site();
            try{
                $stmte = $this->pdo->prepare("SELECT * FROM tb_gerencia_site WHERE geren_flag_ativo LIKE 1");
                if($stmte->execute()){
                    if($stmte->rowCount() > 0){
                        while($result = $stmte->fetch(PDO::FETCH_OBJ)){
                            $config->setPkId($result->geren_pk_id);
                            $config->setNome($result->geren_nome);
                            $config->setFoto($result->geren_ima_foto);
                            $config->setFlag_ativo($result->geren_flag_ativo);
                            $config->setCorPrimaria($result->geren_cor_primaria);
                            $config->setCorSecundaria($result->geren_cor_secundaria);
                        }
                    }
                }
                return $config;
            }
            catch(PDOException $e){
                echo $e->getMessage();
                return -1;
            }
        }

        function delete($parametro){
            try{
                $stmt = $this->pdo->prepare("DELETE FROM tb_gerencia_site WHERE geren_pk_id = :parametro");
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
            $configs = array();
            try{
                $stmte = $this->pdo->prepare("SELECT * FROM tb_gerencia_site");
                if($stmte->execute()){
                    if($stmte->rowCount() > 0){
                        while($result = $stmte->fetch(PDO::FETCH_OBJ)){
                            $config= new gerencia_site();
                            $config->setPkId($result->geren_pk_id);
                            $config->setNome($result->geren_nome);
                            $config->setFoto($result->geren_ima_foto);
                            $config->setFlag_ativo($result->geren_flag_ativo);
                            $config->setCorPrimaria($result->geren_cor_primaria);
                            $config->setCorSecundaria($result->geren_cor_secundaria);
                            array_push($configs, $config);
                        }
                    }
                }
                return $configs;
            }
            catch(PDOException $e){
                echo $e->getMessage();
            }
        }


        function countImagem(){
            try{
                $stmte = $this->pdo->prepare("SELECT COUNT(*) AS configs FROM tb_gerencia_site");
                $stmte->execute();
                $result = $stmte->fetch(PDO::FETCH_OBJ);
                return $result->configs;
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
<?php
    include_once MODELPATH."/tipo_avaliacao.php";
    include_once "seguranca.php";

    protegePagina();

    class controlerTipoAvaliacao{
        private $pdo;

        function __construct($pdo){
            $this->pdo=$pdo;
        }

        function insert($tipoAvaliacao){
            try{
                $stmte = $this->pdo->prepare("INSERT INTO tb_tipo_avaliacao(tiva_nome, tiva_flag_ativo) VALUES (:tiva_nome, :tiva_flag_ativo)");
                $stmte->bindValue("nome", $tipoAvaliacao->getNome(), PDO::PARAM_STR);
                $stmte->bindValue("flag", $tipoAvaliacao->getFlag_ativo());
                $executa = $stmte->execute();
                if($executa){
                    return 1;
                }else{
                    return -1;
                }
            }catch(PDOException $e){
                echo $e->getMessage();
                return -1;
            }
        }

        function update($tipoAvaliacao){
            try{
                $stmte = $this->pdo->prepare("UPDATE tb_tipo_avaliacao SET tiva_nome = :tiva_nome, tiva_flag_ativo = :tiva_flag_ativo WHERE tiva_pk_id = :tiva_pk_id");
                $stmte->bindValue(":nome", $tipoAvaliacao->getNome());
                $stmte->bindValue(":flag_ativo", $tipoAvaliacao->getFlag_ativo());
                $stmte->bindValue(":cod_tipo_avaliacao", $tipoAvaliacao->getCod_tipo_avaliacao());

                $executa = $stmte->execute();
                if($executa){
                    return 1;
                }else{
                    return -1;
                }

            }catch(PDOException $e){
                echo $e->getMessage();
                return -1;
            }
        }

        function delete($parametro){
            try{
                $stmt = $this->pdo->prepare("DELETE FROM tb_tipo_avaliacao WHERE tiva_pk_id = :parametro");
                $stmt->bindValue(":parametro", $parametro , PDO::PARAM_INT);
                if($stmt->execute()){
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

        function selectAtivo(){
            $tipos = array();
            try{
                $stmte = $this->pdo->prepare("SELECT * FROM tb_tipo_avaliacao WHERE tiva_flag_ativo = 1");
                if($stmte->execute()){
                    if($stmte->rowCount() > 0){
                        while($result = $stmte->fetch(PDO::FETCH_OBJ)){
                            $tipoAvaliacao = new tipoAvaliacao();
                            $tipoAvaliacao->setCod_tipo_avaliacao($result->tiva_pk_id); 
                            $tipoAvaliacao->setNome($result->tiva_nome);  
                            $tipoAvaliacao->setFlag_ativo($result->tiva_flag_ativo); 
                            array_push($tipos, $tipoAvaliacao);  
                        }
                    }
                }
                return $tipos;
            }catch(PDOException $e){
                echo $e->getMessage();
            }
        }

        function select(){
            $tipos = array();
            try{
                $stmte = $this->pdo->prepare("SELECT * FROM tb_tipo_avaliacao");
                if($stmte->execute()){
                    if($stmte->rowCount() > 0){
                        while($result = $stmte->fetch(PDO::FETCH_OBJ)){
                            $tipoAvaliacao = new tipoAvaliacao();
                            $tipoAvaliacao->setCod_tipo_avaliacao($result->tiva_pk_id); 
                            $tipoAvaliacao->setNome($result->tiva_nome);  
                            $tipoAvaliacao->setFlag_ativo($result->tiva_flag_ativo); 
                            array_push($tipos, $tipoAvaliacao);                       
                        }
                    }
                }
                return $tipos;    
            }catch(PDOException $e){
                echo $e->getMessage();
            }
        }

        function mediaPorId($id){
            $media = 0;
            try{
                $stmte = $this->pdo->prepare("SELECT SUM(ava_nota) / COUNT(tb_tipo_avaliacao) AS media FROM tb_avaliacao WHERE tb_tipo_avaliacao = :id");
                $stmte->bindValue(":id", $id);
                if($stmte->execute()){
                    if($stmte->rowCount() > 0){
                        $media = $stmte->fetch();
                    }
                }
                return $media;
            }catch(PDOException $e){
                echo $e->getMessage();
                return 0;
            }
        }

        function mediaPorData($data, $id){
            $media = 0;
            try{
                $stmte = $this->pdo->prepare("SELECT SUM(ava_nota) / COUNT(tb_tipo_avaliacao) AS media FROM tb_avaliacao WHERE data = :data AND tb_tipo_avaliacao = :id");
                $stmte->bindValue(":data", $data);
                $stmte->bindValue(":id", $id);
                if($stmte->execute()){
                    if($stmte->rowCount() > 0){
                        $media = $stmte->fetch();
                    }
                }
                return $media;
            }catch(PDOException $e){
                echo $e->getMessage();
                return 0;
            }
        }

        function mediaPorMes($mes, $id){
            $media = 0;
            try{
                $stmte = $this->pdo->prepare("SELECT SUM(ava_nota) / COUNT(tb_tipo_avaliacao) AS media FROM tb_avaliacao WHERE data LIKE :mes AND tb_tipo_avaliacao = :id");
                $stmte->bindValue(":mes","%-".$mes."-%");
                $stmte->bindValue(":id", $id);
                if($stmte->execute()){
                    if($stmte->rowCount() > 0){
                        $media = $stmte->fetch();
                    }
                }
                return $media;
            }catch(PDOException $e){
                echo $e->getMessage();
                return 0;
            }
        }

        function selectSemCategoria($parametro,$modo){
            $tipo= new tipoAvaliacao();
            try{
                if($modo==1){
                    $stmte = $this->pdo->prepare("SELECT * FROM tb_tipo_avaliacao WHERE tiva_nome LIKE :parametro");
                    $stmte->bindParam(":parametro", $parametro . "%" , PDO::PARAM_STR);
                }elseif ($modo==2) {
                    $stmte = $this->pdo->prepare("SELECT * FROM tb_tipo_avaliacao WHERE tiva_pk_id = :parametro");
                    $stmte->bindParam(":parametro", $parametro , PDO::PARAM_INT);
                }
                if($stmte->execute()){
                    if($stmte->rowCount() > 0){
                        while($result = $stmte->fetch(PDO::FETCH_OBJ)){
                            $tipo->setCod_tipo_avaliacao($result->tiva_pk_id);
                            $tipo->setNome($result->tiva_nome);
                            $tipo->setFlag_ativo($result->tiva_flag_ativo);
                        }
                    }
                }
                return $tipo;
            }
            catch(PDOException $e){
                echo $e->getMessage();
            }
        }

    }


?>
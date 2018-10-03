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
                $stmte = $this->pdo->prepare("INSERT INTO tipo_avaliacao(nome, flag_ativo) VALUES (:nome, :flag)");
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
                $stmte = $this->pdo->prepare("UPDATE tipo_avaliacao SET nome = :nome, flag_ativo = :flag_ativo WHERE cod_tipo_avaliacao = :cod_tipo_avaliacao");
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
                $stmt = $this->pdo->prepare("DELETE FROM tipo_avaliacao WHERE cod_tipo_avaliacao = :parametro");
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
                $stmte = $this->pdo->prepare("SELECT * FROM tipo_avaliacao WHERE flag_ativo = 1");
                if($stmte->execute()){
                    if($stmte->rowCount() > 0){
                        while($result = $stmte->fetch(PDO::FETCH_OBJ)){
                            $tipoAvaliacao = new tipoAvaliacao();
                            $tipoAvaliacao->setCod_tipo_avaliacao($result->cod_tipo_avaliacao); 
                            $tipoAvaliacao->setNome($result->nome);  
                            $tipoAvaliacao->setFlag_ativo($result->flag_ativo); 
                            array_push($tipos, $tipoAvaliacao);  
                        }
                    }
                }
                return $tipos;
            }catch(PODException $e){
                echo $e->getMessage();
            }
        }

        function select(){
            $tipos = array();
            try{
                $stmte = $this->pdo->prepare("SELECT * FROM tipo_avaliacao");
                if($stmte->execute()){
                    if($stmte->rowCount() > 0){
                        while($result = $stmte->fetch(PDO::FETCH_OBJ)){
                            $tipoAvaliacao = new tipoAvaliacao();
                            $tipoAvaliacao->setCod_tipo_avaliacao($result->cod_tipo_avaliacao); 
                            $tipoAvaliacao->setNome($result->nome);  
                            $tipoAvaliacao->setFlag_ativo($result->flag_ativo); 
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
                $stmte = $this->pdo->prepare("SELECT SUM(nota) / COUNT(tipo_avaliacao) AS media FROM avaliacao WHERE tipo_avaliacao = :id");
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
            $stmte;
            $tipo= new tipoAvaliacao();
            try{
                if($modo==1){
                    $stmte = $this->pdo->prepare("SELECT * FROM tipo_avaliacao WHERE nome LIKE :parametro");
                    $stmte->bindParam(":parametro", $parametro . "%" , PDO::PARAM_STR);
                }elseif ($modo==2) {
                    $stmte = $this->pdo->prepare("SELECT * FROM tipo_avaliacao WHERE cod_tipo_avaliacao = :parametro");
                    $stmte->bindParam(":parametro", $parametro , PDO::PARAM_INT);
                }
                if($stmte->execute()){
                    if($stmte->rowCount() > 0){
                        while($result = $stmte->fetch(PDO::FETCH_OBJ)){
                            $tipo->setCod_tipo_avaliacao($result->cod_tipo_avaliacao);
                            $tipo->setNome($result->nome);
                            $tipo->setFlag_ativo($result->flag_ativo);
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
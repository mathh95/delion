<?php
    include_once MODELPATH."/evento.php";
    include_once "seguranca.php";

    protegePagina();

    class controlerEvento {
        private $pdo;
        function insert($evento){
            try{
                $stmte =$this->pdo->prepare("INSERT INTO tb_evento(eve_nome, eve_data, eve_flag_antigo, eve_foto)
                VALUES (:nome, :data, :flag_antigo, :foto)");
                $stmte->bindParam("nome", $evento->getNome(), PDO::PARAM_STR);
                $stmte->bindParam("data", $evento->getData(), PDO::PARAM_STR);
                $stmte->bindParam("flag_antigo", $evento->getFlag_antigo(), PDO::PARAM_INT);
                $stmte->bindParam("foto", $evento->getFoto(), PDO::PARAM_STR);
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

        function update($evento){
            try{
                $stmte =$this->pdo->prepare("UPDATE tb_evento SET eve_nome=:nome, eve_data=:data, eve_flag_antigo=:flag_antigo, eve_foto=:foto WHERE eve_pk_id=:cod_evento");
                $stmte->bindParam(":cod_evento", $evento->getCod_evento() , PDO::PARAM_INT);
                $stmte->bindParam(":nome", $evento->getNome(), PDO::PARAM_STR);
                $stmte->bindParam(":data", $evento->getData(), PDO::PARAM_STR);
                $stmte->bindParam(":flag_antigo", $evento->getFlag_antigo(), PDO::PARAM_INT);
                $stmte->bindParam("foto", $evento->getFoto(), PDO::PARAM_STR);
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

        function select($parametro,$modo){
            $evento= new evento();
            try{
                if($modo==1){
                    $stmte = $this->pdo->prepare("SELECT * FROM tb_evento WHERE eve_nome LIKE :parametro");
                    $stmte->bindParam(":parametro", $parametro . "%" , PDO::PARAM_STR);
                }elseif ($modo==2) {
                    $stmte = $this->pdo->prepare("SELECT * FROM tb_evento WHERE eve_pk_id = :parametro");
                    $stmte->bindParam(":parametro", $parametro , PDO::PARAM_INT);
                }
                if($stmte->execute()){
                    if($stmte->rowCount() > 0){
                        while($result = $stmte->fetch(PDO::FETCH_OBJ)){
                            $evento->setCod_evento($result->eve_pk_id);
                            $evento->setNome($result->eve_nome);
                            $evento->setData($result->eve_data);
                            $evento->setFlag_antigo($result->eve_flag_antigo);
                            $evento->setFoto($result->eve_foto);
                        }
                    }
                }
                return $evento;
            }
            catch(PDOException $e){
                echo $e->getMessage();
            }
        }

        function delete($parametro){
            try{
                $stmt = $this->pdo->prepare("DELETE FROM tb_evento WHERE eve_pk_id = :parametro");
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
            $eventos = array();
            try{
                $stmte = $this->pdo->prepare("SELECT * FROM tb_evento");
                if($stmte->execute()){
                    if($stmte->rowCount() > 0){
                        while($result = $stmte->fetch(PDO::FETCH_OBJ)){
                            $evento= new evento();
                            $evento->setCod_evento($result->eve_pk_id);
                            $evento->setNome($result->eve_nome);
                            $evento->setData($result->eve_data);
                            $evento->setFlag_antigo($result->eve_flag_antigo);
                            $evento->setFoto($result->eve_foto);
                            array_push($eventos, $evento);
                        }
                    }else{
                        return NULL;
                    }
                    return $eventos;
                }else{
                    return NULL;
                }
            }
            catch(PDOException $e){
                echo $e->getMessage();
            }
        }

        function countEvento(){
            try{
                $stmte = $this->pdo->prepare("SELECT COUNT(*) AS eventos FROM tb_evento");
                $stmte->execute();
                $result = $stmte->fetch(PDO::FETCH_OBJ);
                return $result->eventos;
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
<?php

    include_once $_SERVER['DOCUMENT_ROOT']."/config.php";
    include_once MODELPATH."/evento.php";

    class controlerEvento {

        private $pdo;

        /*
          modo: 1-Nome, 2-id

        */

        function select($parametro,$modo){
            $evento = new evento();
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

        function selectAllAntigo(){
            $eventos = array();
            try{
                $stmte = $this->pdo->prepare("SELECT *
                FROM tb_evento
                WHERE eve_flag_antigo = 1
                ORDER BY eve_data ASC");
                
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
                    }
                }
                return $eventos;
            }
            catch(PDOException $e){
                echo $e->getMessage();
            }
        }

        function selectAllNovo(){
            $eventos = array();
            try{
                $stmte = $this->pdo->prepare("SELECT *
                FROM tb_evento
                WHERE eve_flag_antigo = 0
                ORDER BY eve_pk_id ASC LIMIT 1");

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
                    }
                }
                return $eventos;
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
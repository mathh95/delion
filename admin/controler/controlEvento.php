<?php
    include_once MODELPATH."/evento.php";
    include_once "seguranca.php";

    protegePagina();

    class controlerEvento {
        private $pdo;
        function insert($evento){
            try{
                $stmte =$this->pdo->prepare("INSERT INTO evento(nome, data, flag_antigo, foto)
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
                $stmte =$this->pdo->prepare("UPDATE evento SET nome=:nome, data=:data, flag_antigo=:flag_antigo, foto=:foto WHERE cod_evento=:cod_evento");
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
            $stmte;
            $evento= new evento();
            try{
                if($modo==1){
                    $stmte = $this->pdo->prepare("SELECT * FROM evento WHERE nome LIKE :parametro");
                    $stmte->bindParam(":parametro", $parametro . "%" , PDO::PARAM_STR);
                }elseif ($modo==2) {
                    $stmte = $this->pdo->prepare("SELECT * FROM evento WHERE cod_evento = :parametro");
                    $stmte->bindParam(":parametro", $parametro , PDO::PARAM_INT);
                }
                if($stmte->execute()){
                    if($stmte->rowCount() > 0){
                        while($result = $stmte->fetch(PDO::FETCH_OBJ)){
                            $evento->setCod_evento($result->cod_evento);
                            $evento->setNome($result->nome);
                            $evento->setData($result->data);
                            $evento->setFlag_antigo($result->flag_antigo);
                            $evento->setFoto($result->foto);
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
                $stmt = $this->pdo->prepare("DELETE FROM evento WHERE cod_evento = :parametro");
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
            $stmte;
            $eventos = array();
            try{
                $stmte = $this->pdo->prepare("SELECT * FROM evento");
                if($stmte->execute()){
                    if($stmte->rowCount() > 0){
                        while($result = $stmte->fetch(PDO::FETCH_OBJ)){
                            $evento= new evento();
                            $evento->setCod_evento($result->cod_evento);
                            $evento->setNome($result->nome);
                            $evento->setData($result->data);
                            $evento->setFlag_antigo($result->flag_antigo);
                            $evento->setFoto($result->foto);
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
            $stmte;
            try{
                $stmte = $this->pdo->prepare("SELECT COUNT(*) AS eventos FROM evento");
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
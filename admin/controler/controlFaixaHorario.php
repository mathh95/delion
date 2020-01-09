<?php
    include_once MODELPATH."/faixa_horario.php";
    include_once "seguranca.php";

    protegePagina();

    class controlerFaixaHorario {
        private $pdo;

        function insert($faixa_horario){
            try{
                $stmte =$this->pdo->prepare("INSERT INTO tb_faixa_horario(faho_inicio, faho_final, faho_nome)
                VALUES (:faho_inicio, :faho_final, :faho_nome)");
                $stmte->bindParam("faho_inicio", $faixa_horario->getInicio(), PDO::PARAM_STR);
                $stmte->bindParam("faho_final", $faixa_horario->getFinal(), PDO::PARAM_STR);
                $stmte->bindParam("faho_nome", $faixa_horario->getIcone(), PDO::PARAM_STR);
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

        function update($faixa_horario){
            try{
                $stmte =$this->pdo->prepare("UPDATE tb_faixa_horario SET faho_inicio=:inicio, faho_final=:final, faho_nome=:nome WHERE faho_pk_id=:pk_id");
                $stmte->bindParam(":pk_id", $faixa_horario->getPkId() , PDO::PARAM_INT);
                $stmte->bindParam("faho_inicio", $faixa_horario->getInicio(), PDO::PARAM_STR);
                $stmte->bindParam("faho_final", $faixa_horario->getFinal(), PDO::PARAM_STR);
                $stmte->bindParam("faho_nome", $faixa_horario->getNome(), PDO::PARAM_STR);
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

            $faixa_horario = new faixaHorario();
            try{
                if($modo==1){
                    $stmte = $this->pdo->prepare("SELECT * FROM tb_faixa_horario WHERE faho_nome LIKE :parametro");
                    $stmte->bindValue(":parametro", $parametro . "%" , PDO::PARAM_STR);
                }elseif ($modo==2) {
                    $stmte = $this->pdo->prepare("SELECT * FROM tb_faixa_horario WHERE faho_pk_id = :parametro");
                    $stmte->bindParam(":parametro", $parametro , PDO::PARAM_INT);
                }
                if($stmte->execute()){
                    if($stmte->rowCount() > 0){
                        while($result = $stmte->fetch(PDO::FETCH_OBJ)){
                            $faixa_horario->setPkId($result->faho_pk_id);
                            $faixa_horario->setInicio($result->faho_icone);
                            $faixa_horario->setFinal($result->faho_icone);
                            $faixa_horario->setNome($result->faho_nome);
                        }
                    }
                }
                return $faixa_horario;
            }
            catch(PDOException $e){
                echo $e->getMessage();
            }
        }

        function delete($parametro){
            try{
                $stmt = $this->pdo->prepare("DELETE FROM tb_faixa_horario WHERE faho_pk_id = :parametro");
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

            $faixas_horario = array();
            try{
                $stmte = $this->pdo->prepare("SELECT * FROM tb_faixa_horario");
                if($stmte->execute()){
                    if($stmte->rowCount() > 0){
                        while($result = $stmte->fetch(PDO::FETCH_OBJ)){

                            $faixa_horario= new faixaHorario();
                            $faixa_horario->setPkId($result->faho_pk_id);
                            $faixa_horario->setInicio($result->faho_inicio);
                            $faixa_horario->setFinal($result->faho_final);
                            $faixa_horario->setNome($result->faho_nome);
                            array_push($faixas_horario, $faixa_horario);
                        }
                    }
                }
                return $faixas_horario;
            }
            catch(PDOException $e){
                echo $e->getMessage();
            }
        }

        function countFaixaHorario(){

            try{
                $stmte = $this->pdo->prepare("SELECT COUNT(*) AS faixas FROM tb_faixa_horario");
                $stmte->execute();
                $result = $stmte->fetch(PDO::FETCH_OBJ);
                return $result->faixas;
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
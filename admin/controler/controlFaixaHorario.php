<?php
    include_once MODELPATH."/faixa_horario.php";
    include_once "seguranca.php";

    protegePagina("cross_call");

    class controlerFaixaHorario {
        private $pdo;

        function insert($faixa_horario){
            try{
                $stmte =$this->pdo->prepare("INSERT INTO tb_faixa_horario(faho_inicio, faho_final, faho_turno)
                VALUES (:faho_inicio, :faho_final, :faho_turno)");
                $stmte->bindParam(":faho_inicio", $faixa_horario->getInicio(), PDO::PARAM_STR);
                $stmte->bindParam(":faho_final", $faixa_horario->getFinal(), PDO::PARAM_STR);
                $stmte->bindParam(":faho_turno", $faixa_horario->getTurno(), PDO::PARAM_INT);
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

        function insertFaixas($fk_produto, $numero_turnos, $arr_faho_inicio, $arr_faho_final){

            try{
                // Insert turnos
                $inserted_faho = true;
                for ($i = 1; $i <= $numero_turnos; $i++) {

                    $i_aux = $i - 1;

                    $faho_turno = $i;
                    $faho_inicio = $arr_faho_inicio[$i_aux];
                    $faho_final = $arr_faho_final[$i_aux];


                    $stmte = $this->pdo->prepare("INSERT INTO tb_faixa_horario(faho_turno, faho_inicio, faho_final, faho_fk_produto)
                                VALUES (:faho_turno, :faho_inicio, :faho_final, :faho_fk_produto)");
                    $stmte->bindParam(":faho_turno", $faho_turno, PDO::PARAM_INT);
                    $stmte->bindParam(":faho_inicio", $faho_inicio, PDO::PARAM_STR);
                    $stmte->bindParam(":faho_final", $faho_final, PDO::PARAM_STR);
                    $stmte->bindParam(":faho_fk_produto", $fk_produto);

                    $inserted_faho = $stmte->execute();
                }

                if (!$inserted_faho) {
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
                $stmte =$this->pdo->prepare("UPDATE tb_faixa_horario SET faho_inicio=:inicio, faho_final=:final, faho_turno=:tuno WHERE faho_pk_id=:pk_id");

                $stmte->bindParam(":pk_id", $faixa_horario->getPkId() , PDO::PARAM_INT);
                $stmte->bindParam(":inicio", $faixa_horario->getInicio(), PDO::PARAM_STR);
                $stmte->bindParam(":final", $faixa_horario->getFinal(), PDO::PARAM_STR);
                $stmte->bindParam(":turno", $faixa_horario->getTurno(), PDO::PARAM_INT);
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
                    $stmte = $this->pdo->prepare("SELECT * FROM tb_faixa_horario WHERE faho_turno LIKE :parametro");
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
                            $faixa_horario->setTurno($result->faho_turno);
                        }
                    }
                }
                return $faixa_horario;
            }
            catch(PDOException $e){
                echo $e->getMessage();
            }
        }

        function selectByFkProduto($fk_produto){

            $faixas_horario = array();

            try{
                
                $stmte = $this->pdo->prepare("SELECT * FROM tb_faixa_horario WHERE faho_fk_produto = :fk_produto");
                $stmte->bindParam(":fk_produto", $fk_produto , PDO::PARAM_INT);
                
                if($stmte->execute()){
                    if($stmte->rowCount() > 0){
                        while($result = $stmte->fetch(PDO::FETCH_OBJ)){
                            
                            $faixa_horario = new faixaHorario();
                            $faixa_horario->setPkId($result->faho_pk_id);
                            $faixa_horario->setTurno($result->faho_turno);
                            $faixa_horario->setInicio($result->faho_inicio);
                            $faixa_horario->setFinal($result->faho_final);
                            $faixa_horario->setFkProduto($result->faho_fk_produto);

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

        function deleteByFkProduto($fk_produto){
            try{
                $stmt = $this->pdo->prepare("DELETE FROM tb_faixa_horario WHERE faho_fk_produto = :fk_produto");
                $stmt->bindParam(":fk_produto", $fk_produto , PDO::PARAM_INT);
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
                            $faixa_horario->setTurno($result->faho_turno);
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
<?php
    include_once MODELPATH."/cardapio_turno.php";
    include_once "seguranca.php";

    protegePagina();

    class controlerCardapioTurno {
        private $pdo;
        
        function selectAll(){
            $stmte;
            $turnos = array();
            try{
                $stmte = $this->pdo->prepare("SELECT * FROM cardapio_turno");
                if($stmte->execute()){
                    if($stmte->rowCount() > 0){
                        while($result = $stmte->fetch(PDO::FETCH_OBJ)){
                            $turno= new cardapio_turno();
                            $turno->setCod_cardapio_turno($result->cod_cardapio_turno);
                            $turno->setNome($result->nome);
                            array_push($turnos, $turno);
                        }
                    }
                }
                return $turnos;
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
<?php
    include_once MODELPATH."/cardapio_horas.php";
    include_once "seguranca.php";

    protegePagina();

    class controlerCardapioHoras {
        private $pdo;
        
        function selectAll(){
            $stmte;
            $horas = array();
            try{
                $stmte = $this->pdo->prepare("SELECT * FROM cardapio_horas");
                if($stmte->execute()){
                    if($stmte->rowCount() > 0){
                        while($result = $stmte->fetch(PDO::FETCH_OBJ)){
                            $hora= new cardapio_horas();
                            $hora->setCod_cardapio_horas($result->cod_cardapio_horas);
                            $hora->setHorario($result->horario);
                            array_push($horas, $hora);
                        }
                    }
                }
                return $horas;
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
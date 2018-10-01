<?php

ini_set("allow_url_include", true);
include_once $_SERVER['DOCUMENT_ROOT']."/config.php";  

    class controlerAvaliacao{


        private $pdo;

        function __construct($pdo){

            $this->pdo=$pdo;

        }

        function insert($tipo, $nota){
            try{
                $stmte = $this->pdo->prepare("INSERT INTO avaliacao(tipo_avaliacao, data, hora, nota) VALUES (:tipo, NOW(), NOW(), :nota)");
                $stmte->bindValue(":tipo", $tipo);
                $stmte->bindValue(":nota", $nota);
                
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
    }

?>

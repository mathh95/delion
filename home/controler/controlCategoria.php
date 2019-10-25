<?php

    include_once MODELPATH."/categoria.php";



    class controlerCategoria {

        private $pdo;



        /*



          modo: 1-Nome, 2-id



        */



        function select($parametro,$modo){

            $stmte;

            $categoria= new categoria();

            try{

                if($modo==1){

                    $stmte = $this->pdo->prepare("SELECT * FROM categoria WHERE nome LIKE :parametro");

                    $stmte->bindValue(":parametro", $parametro . "%" , PDO::PARAM_STR);

                }elseif ($modo==2) {

                    $stmte = $this->pdo->prepare("SELECT * FROM categoria WHERE cod_categoria = :parametro");

                    $stmte->bindParam(":parametro", $parametro , PDO::PARAM_INT);

                }

                if($stmte->execute()){

                    if($stmte->rowCount() > 0){

                        while($result = $stmte->fetch(PDO::FETCH_OBJ)){

                            $categoria->setCod_categoria($result->cod_categoria);

                            $categoria->setNome($result->nome);

                            $categoria->setIcone($result->icone);

                        }

                    }

                }

                return $categoria;

            }

            catch(PDOException $e){

                echo $e->getMessage();

            }

        }



        function selectAllByPos(){
            $categorias = array();
            try{
                $stmte = $this->pdo->prepare("SELECT * FROM categoria ORDER BY posicao ASC");
                if($stmte->execute()){
                    if($stmte->rowCount() > 0){
                        while($result = $stmte->fetch(PDO::FETCH_OBJ)){
                            $categoria= new categoria();
                            $categoria->setCod_categoria($result->cod_categoria);
                            $categoria->setNome($result->nome);
                            $categoria->setIcone($result->icone);
                            $categoria->setPosicao($result->posicao);
                            array_push($categorias, $categoria);
                        }
                    }
                }
                return $categorias;
            }
            catch(PDOException $e){
                echo $e->getMessage();
            }
        }

        function selectAll(){

            $stmte;

            $categorias = array();

            try{

                $stmte = $this->pdo->prepare("SELECT * FROM categoria ORDER BY nome ASC");

                if($stmte->execute()){

                    if($stmte->rowCount() > 0){

                        while($result = $stmte->fetch(PDO::FETCH_OBJ)){

                            $categoria= new categoria();

                            $categoria->setCod_categoria($result->cod_categoria);

                            $categoria->setNome($result->nome);

                            $categoria->setIcone($result->icone);

                            array_push($categorias, $categoria);

                        }

                    }

                }

                return $categorias;

            }

            catch(PDOException $e){

                echo $e->getMessage();

            }

        }



        function countCategoria(){

            $stmte;

            try{

                $stmte = $this->pdo->prepare("SELECT COUNT(*) AS categorias FROM categoria");

                $stmte->execute();

                $result = $stmte->fetch(PDO::FETCH_OBJ);

                return $result->categorias;

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
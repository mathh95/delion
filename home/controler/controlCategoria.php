<?php

    include_once MODELPATH."/categoria.php";



    class controlerCategoria {

        private $pdo;

        /*
          modo: 1-Nome, 2-id
        */

        function select($parametro,$modo){

            $categoria= new categoria();

            try{

                if($modo==1){

                    $stmte = $this->pdo->prepare("SELECT * FROM tb_categoria WHERE cat_nome LIKE :parametro");

                    $stmte->bindValue(":parametro", $parametro . "%" , PDO::PARAM_STR);

                }elseif ($modo==2) {

                    $stmte = $this->pdo->prepare("SELECT * FROM tb_categoria WHERE cat_pk_id = :parametro");

                    $stmte->bindParam(":parametro", $parametro , PDO::PARAM_INT);

                }

                if($stmte->execute()){

                    if($stmte->rowCount() > 0){

                        while($result = $stmte->fetch(PDO::FETCH_OBJ)){

                            $categoria->setPkId($result->cat_pk_id);

                            $categoria->setNome($result->cat_nome);

                            $categoria->setIcone($result->cat_icone);

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
                $stmte = $this->pdo->prepare("SELECT * FROM tb_categoria ORDER BY cat_posicao ASC");
                if($stmte->execute()){
                    if($stmte->rowCount() > 0){
                        while($result = $stmte->fetch(PDO::FETCH_OBJ)){
                            $categoria= new categoria();
                            $categoria->setPkId($result->cat_pk_id);
                            $categoria->setNome($result->cat_nome);
                            $categoria->setIcone($result->cat_icone);
                            $categoria->setPosicao($result->cat_posicao);
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

            $categorias = array();

            try{

                $stmte = $this->pdo->prepare("SELECT * FROM tb_categoria ORDER BY cat_nome ASC");

                if($stmte->execute()){

                    if($stmte->rowCount() > 0){

                        while($result = $stmte->fetch(PDO::FETCH_OBJ)){

                            $categoria= new categoria();

                            $categoria->setPkId($result->cat_pk_id);

                            $categoria->setNome($result->cat_nome);

                            $categoria->setIcone($result->cat_icone);

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

            try{

                $stmte = $this->pdo->prepare("SELECT COUNT(*) AS categorias FROM tb_categoria");

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
<?php

    include_once $_SERVER['DOCUMENT_ROOT']."/config.php";

    include_once MODELPATH."/evento.php";



    class controlerEvento {

        private $pdo;

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



        function selectAllAntigo(){

            $stmte;

            $eventos = array();

            try{

                $stmte = $this->pdo->prepare("SELECT * FROM evento WHERE flag_antigo = 1 ORDER BY data ASC");

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

        function selectAllNovo(){

            $stmte;

            $eventos = array();

            try{

                $stmte = $this->pdo->prepare("SELECT * FROM evento WHERE flag_antigo = 0 ORDER BY cod_evento ASC LIMIT 1");

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
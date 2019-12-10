<?php

    include_once MODELPATH."/imagem.php";



    class controlerImagem {

        private $pdo;

        /*

          modo: 1-Nome, 2-id

        */

        function select($parametro,$modo){

            $imagem= new imagem();

            try{

                if($modo==1){

                    $stmte = $this->pdo->prepare("SELECT * FROM tb_imagem WHERE ima_nome LIKE :parametro");

                    $stmte->bindParam(":parametro", $parametro . "%" , PDO::PARAM_STR);

                }elseif ($modo==2) {

                    $stmte = $this->pdo->prepare("SELECT * FROM tb_imagem WHERE ima_pk_id = :parametro");

                    $stmte->bindParam(":parametro", $parametro , PDO::PARAM_INT);

                }

                if($stmte->execute()){

                    if($stmte->rowCount() > 0){

                        while($result = $stmte->fetch(PDO::FETCH_OBJ)){

                            $imagem->setPkId($result->ima_pk_id);

                            $imagem->setNome($result->ima_nome);

                            $imagem->setFoto($result->ima_foto);

                            $imagem->setPagina($result->ima_pagina);

                        }

                    }

                }

                return $imagem;

            }

            catch(PDOException $e){

                echo $e->getMessage();

            }

        }



        function selectAll(){

            $imagens = array();

            try{

                $stmte = $this->pdo->prepare("SELECT * FROM tb_imagem ORDER BY ima_pk_id DESC");

                if($stmte->execute()){

                    if($stmte->rowCount() > 0){

                        while($result = $stmte->fetch(PDO::FETCH_OBJ)){

                            $imagem= new imagem();

                            $imagem->setPkId($result->ima_pk_id);

                            $imagem->setNome($result->ima_nome);

                            $imagem->setFoto($result->ima_foto);

                            $imagem->setPagina($result->ima_pagina);

                            array_push($imagens, $imagem);

                        }

                    }

                }

                return $imagens;

            }

            catch(PDOException $e){

                echo $e->getMessage();

            }

        }



        function countImagem(){

            try{

                $stmte = $this->pdo->prepare("SELECT COUNT(*) AS imagens FROM tb_imagem");

                $stmte->execute();

                $result = $stmte->fetch(PDO::FETCH_OBJ);

                return $result->imagens;

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
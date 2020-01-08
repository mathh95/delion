<?php

    include_once ROOTPATH."/config.php";

    include_once MODELPATH."/banner.php";



    class controlerBanner {

        private $pdo;

        /*
          modo: 1-Nome, 2-id
        */

        function select($parametro,$modo){

            $banner= new banner();

            try{

                if($modo==1){

                    $stmte = $this->pdo->prepare("SELECT * FROM tb_banner WHERE ban_nome LIKE :parametro and ban_flag_tamanho = 0");

                    $stmte->bindParam(":parametro", $parametro . "%" , PDO::PARAM_STR);

                }elseif ($modo==2) {

                    $stmte = $this->pdo->prepare("SELECT * FROM tb_banner WHERE ban_pk_id = :parametro and ban_flag_tamanho = 0");

                    $stmte->bindParam(":parametro", $parametro , PDO::PARAM_INT);

                }

                if($stmte->execute()){

                    if($stmte->rowCount() > 0){

                        while($result = $stmte->fetch(PDO::FETCH_OBJ)){

                            $banner->setPkId($result->ban_pk_id);

                            $banner->setNome($result->ban_nome);

                            $banner->setLink($result->ban_link);

                            // $banner->setLegenda($result->ban_legenda);

                            $banner->setFlag_tamanho($result->ban_flag_tamanho);

                            $banner->setFoto($result->ban_foto);

                            $banner->setPagina($result->ban_pagina);

                        }

                    }

                }

                return $banner;

            }

            catch(PDOException $e){

                echo $e->getMessage();

            }

        }

        function selectMini($parametro,$modo){

            $banner= new banner();

            try{

                if($modo==1){

                    $stmte = $this->pdo->prepare("SELECT * FROM tb_banner WHERE ban_nome LIKE :parametro and ban_flag_tamanho = 1");

                    $stmte->bindParam(":parametro", $parametro . "%" , PDO::PARAM_STR);

                }elseif ($modo==2) {

                    $stmte = $this->pdo->prepare("SELECT * FROM tb_banner WHERE ban_pk_id = :parametro and ban_flag_tamanho = 1");

                    $stmte->bindParam(":parametro", $parametro , PDO::PARAM_INT);

                }

                if($stmte->execute()){

                    if($stmte->rowCount() > 0){

                        while($result = $stmte->fetch(PDO::FETCH_OBJ)){

                            $banner->setPkId($result->ban_pk_id);

                            $banner->setNome($result->ban_nome);

                            $banner->setLink($result->ban_link);

                            // $banner->setLegenda($result->ban_legenda);

                            $banner->setFlag_tamanho($result->ban_flag_tamanho);

                            $banner->setFoto($result->ban_foto);

                            $banner->setPagina($result->ban_pagina);

                        }
                    }
                }

                return $banner;

            }

            catch(PDOException $e){
                echo $e->getMessage();
            }
        }





        function selectAll(){

            $banners = array();

            try{

                $stmte = $this->pdo->prepare("SELECT * FROM tb_banner WHERE ban_flag_tamanho = 0 ORDER BY RAND()");

                if($stmte->execute()){

                    if($stmte->rowCount() > 0){

                        while($result = $stmte->fetch(PDO::FETCH_OBJ)){

                            $banner= new banner();

                            $banner->setPkId($result->ban_pk_id);

                            $banner->setNome($result->nome);

                            $banner->setLink($result->link);

                            // $banner->setLegenda($result->legenda);

                            $banner->setFlag_tamanho($result->ban_flag_tamanho);

                            $banner->setFoto($result->foto);

                            $banner->setPagina($result->pagina);

                            array_push($banners, $banner);

                        }

                    }

                }

            // die('aqui');

                return $banners;

            }

            catch(PDOException $e){

                echo $e->getMessage();

            }

        }

        function selectAllMini(){

            $banners = array();

            try{

                $stmte = $this->pdo->prepare("SELECT * FROM tb_banner WHERE ban_flag_tamanho = 1 ORDER BY RAND()");

                if($stmte->execute()){

                    if($stmte->rowCount() > 0){

                        while($result = $stmte->fetch(PDO::FETCH_OBJ)){

                            $banner= new banner();

                            $banner->setPkId($result->ban_pk_id);

                            $banner->setNome($result->ban_nome);

                            $banner->setLink($result->ban_link);

                            // $banner->setLegenda($result->ban_legenda);

                            $banner->setFlag_tamanho($result->ban_flag_tamanho);

                            $banner->setFoto($result->ban_foto);

                            $banner->setPagina($result->ban_pagina);

                            array_push($banners, $banner);

                        }

                    }

                }

                return $banners;

            }

            catch(PDOException $e){

                echo $e->getMessage();

            }

        }



        function countBanner(){

            try{

                $stmte = $this->pdo->prepare("SELECT COUNT(*) AS banners FROM tb_banner");

                $stmte->execute();

                $result = $stmte->fetch(PDO::FETCH_OBJ);

                return $result->banners;

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
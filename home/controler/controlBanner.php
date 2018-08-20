<?php

    include_once ROOTPATH."/config.php";

    include_once MODELPATH."/banner.php";



    class controlerBanner {

        private $pdo;



        /*



          modo: 1-Nome, 2-id



        */



        function select($parametro,$modo){

            $stmte;

            $banner= new banner();

            try{

                if($modo==1){

                    $stmte = $this->pdo->prepare("SELECT * FROM banner WHERE nome LIKE :parametro and flag_tamanho = 0");

                    $stmte->bindParam(":parametro", $parametro . "%" , PDO::PARAM_STR);

                }elseif ($modo==2) {

                    $stmte = $this->pdo->prepare("SELECT * FROM banner WHERE cod_banner = :parametro and flag_tamanho = 0");

                    $stmte->bindParam(":parametro", $parametro , PDO::PARAM_INT);

                }

                if($stmte->execute()){

                    if($stmte->rowCount() > 0){

                        while($result = $stmte->fetch(PDO::FETCH_OBJ)){

                            $banner->setCod_banner($result->cod_banner);

                            $banner->setNome($result->nome);

                            $banner->setLink($result->link);

                            // $banner->setLegenda($result->legenda);

                            $banner->setFlag_tamanho($result->flag_tamanho);

                            $banner->setFoto($result->foto);

                            $banner->setPagina($result->pagina);

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

            $stmte;

            $banner= new banner();

            try{

                if($modo==1){

                    $stmte = $this->pdo->prepare("SELECT * FROM banner WHERE nome LIKE :parametro and flag_tamanho = 1");

                    $stmte->bindParam(":parametro", $parametro . "%" , PDO::PARAM_STR);

                }elseif ($modo==2) {

                    $stmte = $this->pdo->prepare("SELECT * FROM banner WHERE cod_banner = :parametro and flag_tamanho = 1");

                    $stmte->bindParam(":parametro", $parametro , PDO::PARAM_INT);

                }

                if($stmte->execute()){

                    if($stmte->rowCount() > 0){

                        while($result = $stmte->fetch(PDO::FETCH_OBJ)){

                            $banner->setCod_banner($result->cod_banner);

                            $banner->setNome($result->nome);

                            $banner->setLink($result->link);

                            // $banner->setLegenda($result->legenda);

                            $banner->setFlag_tamanho($result->flag_tamanho);

                            $banner->setFoto($result->foto);

                            $banner->setPagina($result->pagina);

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

            $stmte;

            $banners = array();

            try{

                $stmte = $this->pdo->prepare("SELECT * FROM banner WHERE flag_tamanho = 0 ORDER BY RAND()");

                if($stmte->execute()){

                    if($stmte->rowCount() > 0){

                        while($result = $stmte->fetch(PDO::FETCH_OBJ)){

                            $banner= new banner();

                            $banner->setCod_banner($result->cod_banner);

                            $banner->setNome($result->nome);

                            $banner->setLink($result->link);

                            // $banner->setLegenda($result->legenda);

                            $banner->setFlag_tamanho($result->flag_tamanho);

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

            $stmte;

            $banners = array();

            try{

                $stmte = $this->pdo->prepare("SELECT * FROM banner WHERE flag_tamanho = 1 ORDER BY RAND()");

                if($stmte->execute()){

                    if($stmte->rowCount() > 0){

                        while($result = $stmte->fetch(PDO::FETCH_OBJ)){

                            $banner= new banner();

                            $banner->setCod_banner($result->cod_banner);

                            $banner->setNome($result->nome);

                            $banner->setLink($result->link);

                            // $banner->setLegenda($result->legenda);

                            $banner->setFlag_tamanho($result->flag_tamanho);

                            $banner->setFoto($result->foto);

                            $banner->setPagina($result->pagina);

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

            $stmte;

            try{

                $stmte = $this->pdo->prepare("SELECT COUNT(*) AS banners FROM banner");

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
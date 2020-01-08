<?php

    include_once MODELPATH."/banner.php";

    include_once "seguranca.php";



    protegePagina();



    class controlerBanner {

        private $pdo;

        function insert($banner){
            try{
                $stmte =$this->pdo->prepare("INSERT INTO tb_banner(ban_nome, ban_link, ban_flag_tamanho, ban_foto, ban_pagina)
                VALUES (:nome, :link, :flag_tamanho, :foto, :pagina)");
                $stmte->bindParam(":nome", $banner->getNome(), PDO::PARAM_STR);
                $stmte->bindParam(":link", $banner->getLink(), PDO::PARAM_STR);
                $stmte->bindParam(":flag_tamanho", $banner->getFlag_tamanho(), PDO::PARAM_INT);
                $stmte->bindParam(":foto", $banner->getFoto(), PDO::PARAM_STR);
                $stmte->bindParam(":pagina", $banner->getPagina(), PDO::PARAM_STR);
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

        function update($banner){
            try{
                $stmte =$this->pdo->prepare("UPDATE tb_banner SET ban_link=:link, ban_flag_tamanho=:flag_tamanho, ban_nome=:nome, ban_foto=:foto, ban_pagina=:pagina WHERE ban_pk_id=:cod_banner");
                $stmte->bindParam(":cod_banner", $banner->getPkId() , PDO::PARAM_INT);
                $stmte->bindParam(":nome", $banner->getNome(), PDO::PARAM_STR);
                $stmte->bindParam(":link", $banner->getLink(), PDO::PARAM_STR);
                $stmte->bindParam(":flag_tamanho", $banner->getFlag_tamanho(), PDO::PARAM_INT);
                $stmte->bindParam(":foto", $banner->getFoto(), PDO::PARAM_STR);
                $stmte->bindParam(":pagina", $banner->getPagina(), PDO::PARAM_STR);
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
                            // $banner->setLegenda($result->legenda);
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
                            // $banner->setLegenda($result->legenda);
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

        function delete($parametro){
            try{
                $stmt = $this->pdo->prepare("DELETE FROM tb_banner WHERE ban_pk_id = :parametro");
                $stmt->bindParam(":parametro", $parametro , PDO::PARAM_INT);
                $stmt->execute();
                return 1;
            }
            catch(PDOException $e){
                echo $e->getMessage();
                return -1;
            }

        }

        function selectAll(){
            $banners = array();
            try{
                $stmte = $this->pdo->prepare("SELECT * FROM tb_banner WHERE ban_flag_tamanho = 0");
                if($stmte->execute()){
                    if($stmte->rowCount() > 0){
                        while($result = $stmte->fetch(PDO::FETCH_OBJ)){
                            $banner= new banner();
                            $banner->setPkId($result->ban_pk_id);
                            $banner->setNome($result->ban_nome);
                            $banner->setLink($result->ban_link);
                            // $banner->setLegenda($result->legenda);
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

        function selectAllMini(){
            $banners = array();
            try{
                $stmte = $this->pdo->prepare("SELECT * FROM tb_banner WHERE ban_flag_tamanho = 1");
                if($stmte->execute()){
                    if($stmte->rowCount() > 0){
                        while($result = $stmte->fetch(PDO::FETCH_OBJ)){
                            $banner= new banner();
                            $banner->setPkId($result->ban_pk_id);
                            $banner->setNome($result->ban_nome);
                            $banner->setLink($result->ban_link);
                            // $banner->setLegenda($result->legenda);
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
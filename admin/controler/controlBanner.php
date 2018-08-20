<?php
    include_once MODELPATH."/banner.php";
    include_once "seguranca.php";

    protegePagina();

    class controlerBanner {
        private $pdo;
        function insert($banner){
            try{
                $stmte =$this->pdo->prepare("INSERT INTO banner(nome, link,/* legenda,*/ flag_tamanho, foto, pagina)
                VALUES (:nome, :link,/* :legenda,*/ :flag_tamanho, :foto, :pagina)");
                $stmte->bindParam(":nome", $banner->getNome(), PDO::PARAM_STR);
                $stmte->bindParam(":link", $banner->getLink(), PDO::PARAM_STR);
                // $stmte->bindParam(":legenda", $banner->getLegenda(), PDO::PARAM_STR);
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
                $stmte =$this->pdo->prepare("UPDATE banner SET link=:link,/* legenda=:legenda,*/ flag_tamanho=:flag_tamanho, nome=:nome, foto=:foto, pagina=:pagina WHERE cod_banner=:cod_banner");
                $stmte->bindParam(":cod_banner", $banner->getCod_banner() , PDO::PARAM_INT);
                $stmte->bindParam(":nome", $banner->getNome(), PDO::PARAM_STR);
                $stmte->bindParam(":link", $banner->getLink(), PDO::PARAM_STR);
                // $stmte->bindParam(":legenda", $banner->getLegenda(), PDO::PARAM_STR);
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

        function delete($parametro){
            try{
                $stmt = $this->pdo->prepare("DELETE FROM banner WHERE cod_banner = :parametro");
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
            $stmte;
            $banners = array();
            try{
                $stmte = $this->pdo->prepare("SELECT * FROM banner WHERE flag_tamanho = 0");
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
        function selectAllMini(){
            $stmte;
            $banners = array();
            try{
                $stmte = $this->pdo->prepare("SELECT * FROM banner WHERE flag_tamanho = 1");
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
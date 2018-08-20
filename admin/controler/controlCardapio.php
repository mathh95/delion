<?php
    include_once ROOTPATH."/config.php";
    include_once MODELPATH."/cardapio.php";
    include_once "seguranca.php";

    protegePagina();

    class controlerCardapio {
        private $pdo;
        function insert($cardapio){
            try{
                $stmte =$this->pdo->prepare("INSERT INTO cardapio(nome, descricao, foto, categoria, flag_ativo)
                VALUES (:nome, :descricao, :foto, :categoria, :flag_ativo)");
                $stmte->bindParam("nome", $cardapio->getNome(), PDO::PARAM_STR);
                $stmte->bindParam("descricao", $cardapio->getDescricao(), PDO::PARAM_STR);
                $stmte->bindParam("foto", $cardapio->getFoto(), PDO::PARAM_STR);
                $stmte->bindParam("categoria", $cardapio->getCategoria(), PDO::PARAM_INT);
                $stmte->bindParam("flag_ativo", $cardapio->getFlag_ativo(), PDO::PARAM_INT);
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

        function update($cardapio){
            try{
                $stmte =$this->pdo->prepare("UPDATE cardapio SET nome=:nome, descricao=:descricao, foto=:foto, categoria=:categoria, flag_ativo=:flag_ativo WHERE cod_cardapio=:cod_cardapio");
                $stmte->bindParam(":cod_cardapio", $cardapio->getCod_cardapio() , PDO::PARAM_INT);
                $stmte->bindParam(":nome", $cardapio->getNome(), PDO::PARAM_STR);
                $stmte->bindParam(":descricao", $cardapio->getDescricao(), PDO::PARAM_STR);
                $stmte->bindParam("foto", $cardapio->getFoto(), PDO::PARAM_STR);
                $stmte->bindParam("categoria", $cardapio->getCategoria(), PDO::PARAM_INT);
                $stmte->bindParam("flag_ativo", $cardapio->getFlag_ativo(), PDO::PARAM_INT);
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

        function selectSemCategoria($parametro,$modo){
            $stmte;
            $cardapio= new cardapio();
            try{
                if($modo==1){
                    $stmte = $this->pdo->prepare("SELECT * FROM cardapio WHERE nome LIKE :parametro");
                    $stmte->bindParam(":parametro", $parametro . "%" , PDO::PARAM_STR);
                }elseif ($modo==2) {
                    $stmte = $this->pdo->prepare("SELECT * FROM cardapio WHERE cod_cardapio = :parametro");
                    $stmte->bindParam(":parametro", $parametro , PDO::PARAM_INT);
                }
                if($stmte->execute()){
                    if($stmte->rowCount() > 0){
                        while($result = $stmte->fetch(PDO::FETCH_OBJ)){
                            $cardapio->setCod_cardapio($result->cod_cardapio);
                            $cardapio->setNome($result->nome);
                            $cardapio->setDescricao($result->descricao);
                            $cardapio->setFoto($result->foto);
                            $cardapio->setCategoria($result->categoria);
                            $cardapio->setFlag_ativo($result->flag_ativo);
                        }
                    }
                }
                return $cardapio;
            }
            catch(PDOException $e){
                echo $e->getMessage();
            }
        }
        function select($parametro,$modo){
            $stmte;
            try{
                if($modo==1){
                    $stmte = $this->pdo->prepare("SELECT A.cod_cardapio AS cod_cardapio, A.nome AS nome, A.descricao AS descricao, A.foto AS foto, A.flag_ativo AS flag_ativo, B.nome AS categoria FROM cardapio AS A inner join categoria AS B ON A.categoria = B.cod_categoria WHERE A.nome LIKE :parametro AND A.flag_ativo == 1");
                    $stmte->bindParam(":parametro", $parametro . "%" , PDO::PARAM_STR);
                    $cardapios = array();
                    if($stmte->execute()){
                        if($stmte->rowCount() > 0){
                            while($result = $stmte->fetch(PDO::FETCH_OBJ)){
                                $cardapio= new cardapio();
                                $cardapio->setCod_cardapio($result->cod_cardapio);
                                $cardapio->setNome($result->nome);
                                $cardapio->setDescricao($result->descricao);
                                $cardapio->setFoto($result->foto);
                                $cardapio->setCategoria($result->categoria);
                                $cardapio->setFlag_ativo($result->flag_ativo);
                                array_push($cardapios, $cardapio);
                            }
                        }
                    }
                    return $cardapios;
                }elseif ($modo==2) {
                    $stmte = $this->pdo->prepare("SELECT A.cod_cardapio AS cod_cardapio, A.nome AS nome, A.descricao AS descricao, A.foto AS foto, A.flag_ativo AS flag_ativo, B.nome AS categoria FROM cardapio AS A inner join categoria AS B ON A.categoria = B.cod_categoria WHERE A.cod_cardapio = :parametro");
                    $stmte->bindParam(":parametro", $parametro , PDO::PARAM_INT);
                    $cardapio= new cardapio();
                    if($stmte->execute()){
                        if($stmte->rowCount() > 0){
                            while($result = $stmte->fetch(PDO::FETCH_OBJ)){
                                $cardapio->setCod_cardapio($result->cod_cardapio);
                                $cardapio->setNome($result->nome);
                                $cardapio->setDescricao($result->descricao);
                                $cardapio->setFoto($result->foto);
                                $cardapio->setCategoria($result->categoria);
                                $cardapio->setFlag_ativo($result->flag_ativo);
                            }
                        }
                    }
                    return $cardapio;
                }
            }
            catch(PDOException $e){
                echo $e->getMessage();
            }
        }

        function selectPaginadoNome($parametro,$offset, $por_pagina){
            $stmte;
            $cardapios = array();
            try{
                $stmte = $this->pdo->prepare("SELECT * FROM cardapio WHERE nome LIKE :parametro AND flag_ativo = 1 ORDER BY categoria DESC LIMIT :offset, :por_pagina");
                $stmte->bindValue(":parametro","%". $parametro . "%" , PDO::PARAM_STR);
                $stmte->bindParam(":offset", $offset, PDO::PARAM_INT);
                $stmte->bindParam(":por_pagina", $por_pagina, PDO::PARAM_INT);
                if($stmte->execute()){
                    if($stmte->rowCount() > 0){
                        while($result = $stmte->fetch(PDO::FETCH_OBJ)){
                            $cardapio= new cardapio();
                            $cardapio->setCod_cardapio($result->cod_cardapio);
                            $cardapio->setNome($result->nome);
                            $cardapio->setDescricao($result->descricao);
                            $cardapio->setFoto($result->foto);
                            $cardapio->setCategoria($result->categoria);
                            $cardapio->setFlag_ativo($result->flag_ativo);
                            array_push($cardapios, $cardapio);
                        }
                    }
                }
                return $cardapios;
            }
            catch(PDOException $e){
                echo $e->getMessage();
            }
        }

        function selectPaginadoCategoria($parametro,$offset, $por_pagina){
            $stmte;
            $cardapios = array();
            try{
                $stmte = $this->pdo->prepare("SELECT * FROM cardapio WHERE nome LIKE :parametro AND flag_ativo = 1 ORDER BY categoria DESC LIMIT :offset, :por_pagina");
                $stmte->bindValue(":parametro","%". $parametro . "%" , PDO::PARAM_STR);
                $stmte->bindParam(":offset", $offset, PDO::PARAM_INT);
                $stmte->bindParam(":por_pagina", $por_pagina, PDO::PARAM_INT);
                if($stmte->execute()){
                    if($stmte->rowCount() > 0){
                        while($result = $stmte->fetch(PDO::FETCH_OBJ)){
                            $cardapio= new cardapio();
                            $cardapio->setCod_cardapio($result->cod_cardapio);
                            $cardapio->setNome($result->nome);
                            $cardapio->setDescricao($result->descricao);
                            $cardapio->setFoto($result->foto);
                            $cardapio->setCategoria($result->categoria);
                            $cardapio->setFlag_ativo($result->flag_ativo);
                            array_push($cardapios, $cardapio);
                        }
                    }
                }
                return $cardapios;
            }
            catch(PDOException $e){
                echo $e->getMessage();
            }
        }

        function delete($parametro){
            try{
                $stmt = $this->pdo->prepare("DELETE FROM cardapio WHERE cod_cardapio = :parametro");
                $stmt->bindParam(":parametro", $parametro , PDO::PARAM_INT);
                $stmt->execute();
                return 1;
            }
            catch(PDOException $e){
                echo $e->getMessage();
                return -1;
            }
        }



        function selectAllSemCategoria(){
            $stmte;
            $cardapios = array();
            try{
                $stmte = $this->pdo->prepare("SELECT * FROM cardapio");
                if($stmte->execute()){
                    if($stmte->rowCount() > 0){
                        while($result = $stmte->fetch(PDO::FETCH_OBJ)){
                            $cardapio= new cardapio();
                            $cardapio->setCod_cardapio($result->cod_cardapio);
                            $cardapio->setNome($result->nome);
                            $cardapio->setDescricao($result->descricao);
                            $cardapio->setFoto($result->foto);
                            $cardapio->setCategoria($result->categoria);
                            $cardapio->setFlag_ativo($result->flag_ativo);
                            array_push($cardapios, $cardapio);
                        }
                    }
                }
                return $cardapios;
            }
            catch(PDOException $e){
                echo $e->getMessage();
            }
        }

        function selectAll(){
            $stmte;
            $cardapios = array();
            try{
                $stmte = $this->pdo->prepare("SELECT A.cod_cardapio AS cod_cardapio, A.nome AS nome, A.descricao AS descricao, A.foto AS foto, A.flag_ativo AS flag_ativo, B.nome AS categoria FROM cardapio AS A inner join categoria AS B ON A.categoria = B.cod_categoria");
                if($stmte->execute()){
                    if($stmte->rowCount() > 0){
                        while($result = $stmte->fetch(PDO::FETCH_OBJ)){
                            $cardapio= new cardapio();
                            $cardapio->setCod_cardapio($result->cod_cardapio);
                            $cardapio->setNome($result->nome);
                            $cardapio->setDescricao($result->descricao);
                            $cardapio->setFoto($result->foto);
                            $cardapio->setCategoria($result->categoria);
                            $cardapio->setFlag_ativo($result->flag_ativo);
                            array_push($cardapios, $cardapio);
                        }
                    }
                }
                return $cardapios;
            }
            catch(PDOException $e){
                echo $e->getMessage();
            }
        }

        function countCardapio(){
            $stmte;
            try{
                $stmte = $this->pdo->prepare("SELECT COUNT(*) AS cardapios FROM cardapio WHERE flag_ativo = 1 ");
                $stmte->execute();
                $result = $stmte->fetch(PDO::FETCH_OBJ);
                return $result->cardapios;
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
<?php

ini_set("allow_url_include", true);
include_once $_SERVER['DOCUMENT_ROOT']."/config.php";    
include_once MODELPATH."/cardapio.php";


    class controlerCardapio {

        private $pdo;



        /*



          modo: 1-Nome, 2-id



        */

        function buscarVariosId($itens){
            $array = array();

            $sql = "SELECT * FROM cardapio WHERE cod_cardapio IN (".implode(',', $itens).")";
            // print_r($sql);
            // exit;
            $sql = $this->pdo->query($sql);

            if($sql -> rowCount() > 0){
                $array = $sql->fetchAll();
            }

            return $array;
        } 

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

                            $cardapio->setPreco($result->preco);

                            $cardapio->setDescricao($result->descricao);

                            $cardapio->setFoto($result->foto);

                            $cardapio->setCategoria($result->categoria);

                            $cardapio->setFlag_ativo($result->flag_ativo);

                            $cardapio->setDesconto($result->desconto);

                            $cardapio->setAdicional($result->adicional);

                            $cardapio->setDelivery($result->delivery);

                        }

                    }

                }

                return $cardapio;

            }

            catch(PDOException $e){

                echo $e->getMessage();

            }

        }



        // modo  1 = busca / 2 = categoria



        function select($parametro,$modo){

            $stmte;

            try{

                if($modo==1){

                    $stmte = $this->pdo->prepare("SELECT A.cod_cardapio AS cod_cardapio, A.nome AS nome, A.preco AS preco, A.descricao AS descricao, A.foto AS foto, A.flag_ativo AS flag_ativo, A.adicional AS adicional, B.nome AS categoria FROM cardapio AS A inner join categoria AS B ON A.categoria = B.cod_categoria WHERE A.nome LIKE :parametro AND A.flag_ativo = 1 ORDER BY nome ASC");

                    $stmte->bindValue(":parametro", $parametro . "%" , PDO::PARAM_STR);

                    $cardapios = array();

                    if($stmte->execute()){

                        if($stmte->rowCount() > 0){

                            while($result = $stmte->fetch(PDO::FETCH_OBJ)){

                                $cardapio= new cardapio();

                                $cardapio->setCod_cardapio($result->cod_cardapio);

                                $cardapio->setNome($result->nome);

                                $cardapio->setPreco($result->preco);

                                $cardapio->setDescricao($result->descricao);

                                $cardapio->setFoto($result->foto);

                                $cardapio->setCategoria($result->categoria);

                                $cardapio->setFlag_ativo($result->flag_ativo);

                                $cardapio->setAdicional($result->adicional);

                                array_push($cardapios, $cardapio);

                            }

                        }

                    }

                    return $cardapios;

                }elseif ($modo==2) {

                    $stmte = $this->pdo->prepare("SELECT A.cod_cardapio AS cod_cardapio, A.nome AS nome, A.preco AS preco,  A.descricao AS descricao, A.foto AS foto, A.flag_ativo AS flag_ativo, A.adicional AS adicional, B.nome AS categoria FROM cardapio AS A inner join categoria AS B ON A.categoria = B.cod_categoria WHERE B.cod_categoria = :parametro AND A.flag_ativo = 1 ORDER BY nome ASC");

                    $stmte->bindParam(":parametro", $parametro , PDO::PARAM_INT);

                    $cardapios = array();

                    if($stmte->execute()){

                        if($stmte->rowCount() > 0){

                            while($result = $stmte->fetch(PDO::FETCH_OBJ)){

                                $cardapio= new cardapio();

                                $cardapio->setCod_cardapio($result->cod_cardapio);

                                $cardapio->setNome($result->nome);

                                $cardapio->setPreco($result->preco);

                                $cardapio->setDescricao($result->descricao);

                                $cardapio->setFoto($result->foto);

                                $cardapio->setFlag_ativo($result->flag_ativo);

                                $cardapio->setCategoria($result->categoria);

                                $cardapio->setAdicional($result->adicional);

                                array_push($cardapios, $cardapio);

                            }

                        }

                    }

                    return $cardapios;

                }

            }

            catch(PDOException $e){

                echo $e->getMessage();

            }

        }

        //modo 1=busca/2=categoria

        function selectDelivery($parametro,$modo){

            $stmte;

            try{

                if($modo==1){

                    $stmte = $this->pdo->prepare("SELECT A.cod_cardapio AS cod_cardapio, A.nome AS nome, A.preco AS preco, A.descricao AS descricao, A.foto AS foto, A.flag_ativo AS flag_ativo, A.delivery AS delivery, A.adicional AS adicional, B.nome AS categoria FROM cardapio AS A inner join categoria AS B ON A.categoria = B.cod_categoria WHERE A.nome LIKE :parametro AND A.flag_ativo = 1 AND delivery = 1 ORDER BY nome ASC");

                    $stmte->bindValue(":parametro", $parametro . "%" , PDO::PARAM_STR);

                    $cardapios = array();

                    if($stmte->execute()){

                        if($stmte->rowCount() > 0){

                            while($result = $stmte->fetch(PDO::FETCH_OBJ)){

                                $cardapio= new cardapio();

                                $cardapio->setCod_cardapio($result->cod_cardapio);

                                $cardapio->setNome($result->nome);

                                $cardapio->setPreco($result->preco);

                                $cardapio->setDescricao($result->descricao);

                                $cardapio->setFoto($result->foto);

                                $cardapio->setCategoria($result->categoria);

                                $cardapio->setFlag_ativo($result->flag_ativo);

                                $cardapio->setDelivery($result->delivery);

                                $cardapio->setAdicional($result->adicional);

                                array_push($cardapios, $cardapio);

                            }

                        }

                    }

                    return $cardapios;

                }elseif ($modo==2) {

                    $stmte = $this->pdo->prepare("SELECT A.cod_cardapio AS cod_cardapio, A.nome AS nome, A.preco AS preco,  A.descricao AS descricao, A.foto AS foto, A.flag_ativo AS flag_ativo, A.delivery AS delivery, A.adicional AS adicional, B.nome AS categoria FROM cardapio AS A inner join categoria AS B ON A.categoria = B.cod_categoria WHERE B.cod_categoria = :parametro AND A.flag_ativo = 1 AND delivery = 1 ORDER BY nome ASC");

                    $stmte->bindParam(":parametro", $parametro , PDO::PARAM_INT);

                    $cardapios = array();

                    if($stmte->execute()){

                        if($stmte->rowCount() > 0){

                            while($result = $stmte->fetch(PDO::FETCH_OBJ)){

                                $cardapio= new cardapio();

                                $cardapio->setCod_cardapio($result->cod_cardapio);

                                $cardapio->setNome($result->nome);

                                $cardapio->setPreco($result->preco);

                                $cardapio->setDescricao($result->descricao);

                                $cardapio->setFoto($result->foto);

                                $cardapio->setFlag_ativo($result->flag_ativo);

                                $cardapio->setCategoria($result->categoria);

                                $cardapio->setAdicional($result->adicional);

                                array_push($cardapios, $cardapio);

                            }

                        }

                    }

                    return $cardapios;

                }

            }

            catch(PDOException $e){

                echo $e->getMessage();

            }

        }



        function selectPaginadoNome($parametro,$offset, $por_pagina, $delivery){

            $stmte;

            $cardapios = array();

            try{

                if ($delivery == true){
                    $stmte = $this->pdo->prepare("SELECT A.cod_cardapio AS cod_cardapio, A.nome AS nome, A.preco AS preco, A.descricao AS descricao, A.foto AS foto, A.flag_ativo AS flag_ativo, A.delivery AS delivery, A.adicional AS adicional, A.categoria AS categoria FROM cardapio AS A inner join categoria AS B ON A.categoria = B.cod_categoria WHERE A.nome LIKE :parametro AND A.flag_ativo = 1 AND A.delivery = 1 ORDER BY prioridade DESC, nome ASC LIMIT :offset, :por_pagina");
    
                    $stmte->bindValue(":parametro","%". $parametro . "%" , PDO::PARAM_STR);
    
                    $stmte->bindParam(":offset", $offset, PDO::PARAM_INT);
    
                    $stmte->bindParam(":por_pagina", $por_pagina, PDO::PARAM_INT);
                }else{
                    $stmte = $this->pdo->prepare("SELECT A.cod_cardapio AS cod_cardapio, A.nome AS nome, A.preco AS preco, A.descricao AS descricao, A.foto AS foto, A.flag_ativo AS flag_ativo, A.delivery AS delivery, A.adicional AS adicional, A.categoria AS categoria FROM cardapio AS A inner join categoria AS B ON A.categoria = B.cod_categoria WHERE A.nome LIKE :parametro AND A.flag_ativo = 1 ORDER BY prioridade DESC, nome ASC LIMIT :offset, :por_pagina");
    
                    $stmte->bindValue(":parametro","%". $parametro . "%" , PDO::PARAM_STR);
    
                    $stmte->bindParam(":offset", $offset, PDO::PARAM_INT);
    
                    $stmte->bindParam(":por_pagina", $por_pagina, PDO::PARAM_INT);
                }

                if($stmte->execute()){

                    if($stmte->rowCount() > 0){

                        while($result = $stmte->fetch(PDO::FETCH_OBJ)){

                            $cardapio= new cardapio();

                            $cardapio->setCod_cardapio($result->cod_cardapio);

                            $cardapio->setNome($result->nome);

                            $cardapio->setPreco($result->preco);

                            $cardapio->setDescricao($result->descricao);

                            $cardapio->setFoto($result->foto);

                            $cardapio->setCategoria($result->categoria);

                            $cardapio->setFlag_ativo($result->flag_ativo);

                            $cardapio->setDelivery($result->delivery);

                            $cardapio->setAdicional($result->adicional);

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



        function selectPaginadoCategoria($parametro,$offset, $por_pagina, $delivery){

            $stmte;

            $cardapios = array();

            try{
                if ($delivery == true){
                    $stmte = $this->pdo->prepare("SELECT * FROM cardapio WHERE categoria = :parametro AND flag_ativo = 1 AND delivery = 1 ORDER BY prioridade DESC, nome ASC LIMIT :offset, :por_pagina");
    
                    $stmte->bindValue(":parametro", $parametro , PDO::PARAM_INT);
    
                    $stmte->bindParam(":offset", $offset, PDO::PARAM_INT);
    
                    $stmte->bindParam(":por_pagina", $por_pagina, PDO::PARAM_INT);
                }else{
                    $stmte = $this->pdo->prepare("SELECT * FROM cardapio WHERE categoria = :parametro AND flag_ativo = 1 ORDER BY prioridade DESC, nome ASC LIMIT :offset, :por_pagina");
    
                    $stmte->bindValue(":parametro", $parametro , PDO::PARAM_INT);
    
                    $stmte->bindParam(":offset", $offset, PDO::PARAM_INT);
    
                    $stmte->bindParam(":por_pagina", $por_pagina, PDO::PARAM_INT);
                }

                if($stmte->execute()){

                    if($stmte->rowCount() > 0){

                        while($result = $stmte->fetch(PDO::FETCH_OBJ)){

                            $cardapio= new cardapio();

                            $cardapio->setCod_cardapio($result->cod_cardapio);

                            $cardapio->setNome($result->nome);

                            $cardapio->setPreco($result->preco);

                            $cardapio->setDescricao($result->descricao);

                            $cardapio->setFoto($result->foto);

                            $cardapio->setCategoria($result->categoria);

                            $cardapio->setFlag_ativo($result->flag_ativo);

                            $cardapio->setDelivery($result->delivery);

                            $cardapio->setAdicional($result->adicional);

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

                            $cardapio->setPreco($result->preco);

                            $cardapio->setDescricao($result->descricao);

                            $cardapio->setFoto($result->foto);

                            $cardapio->setCategoria($result->categoria);

                            $cardapio->setFlag_ativo($result->flag_ativo);

                            $cardapio->setAdicional($result->adicional);

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

                $stmte = $this->pdo->prepare("SELECT A.cod_cardapio AS cod_cardapio, A.nome AS nome, A.preco AS preco, A.descricao AS descricao, A.foto AS foto, A.flag_ativo AS flag_ativo, A.adicional AS adicional, B.nome AS categoria FROM cardapio AS A inner join categoria AS B ON A.categoria = B.cod_categoria ORDER BY nome ASC");

                if($stmte->execute()){

                    if($stmte->rowCount() > 0){

                        while($result = $stmte->fetch(PDO::FETCH_OBJ)){

                            $cardapio= new cardapio();

                            $cardapio->setCod_cardapio($result->cod_cardapio);

                            $cardapio->setNome($result->nome);

                            $cardapio->setPreco($result->preco);

                            $cardapio->setDescricao($result->descricao);

                            $cardapio->setFoto($result->foto);

                            $cardapio->setCategoria($result->categoria);

                            $cardapio->setFlag_ativo($result->flag_ativo);

                            $cardapio->setAdicional($result->adicional);

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
<?php

ini_set("allow_url_include", true);
include_once $_SERVER['DOCUMENT_ROOT']."/config.php";    
include_once MODELPATH."/produto.php";


    class controlerProduto {

        private $pdo;
        /*
          modo: 1-Nome, 2-id
        */

        function buscarVariosId($itens){
            $array = array();

            $sql = 
                "SELECT *, FAHO.faho_inicio, FAHO.faho_final
                FROM tb_produto AS PRO 
                INNER JOIN tb_faixa_horario AS FAHO
                ON PRO.pro_fk_faixa_horario = FAHO.faho_pk_id 
                WHERE pro_pk_id IN (".implode(',', $itens).")";

            $sql = $this->pdo->query($sql);

            if($sql -> rowCount() > 0){
                $array = $sql->fetchAll();
            }

            return $array;
        }
        
        function selectObs($parametro){

            $produto= new produto();
            try{
                    $stmte = $this->pdo->prepare("SELECT * FROM tb_produto WHERE pro_pk_id LIKE :parametro");
                    $stmte->bindParam(":parametro", $parametro , PDO::PARAM_INT);
                if($stmte->execute()){
                    if($stmte->rowCount() > 0){
                        while($result = $stmte->fetch(PDO::FETCH_OBJ)){
                            $produto->setPkId($result->pro_pk_id);
                            $produto->setNome($result->pro_nome);
                            $produto->setPreco($result->pro_preco);
                            $produto->setDescricao($result->pro_descricao);
                            $produto->setFoto($result->pro_foto);
                            $produto->setCategoria($result->pro_fk_categoria);
                            $produto->setFlag_ativo($result->pro_flag_ativo);
                            $produto->setDesconto($result->pro_desconto);
                            $produto->setAdicional($result->pro_arr_adicional);
                            $produto->setDelivery($result->pro_flag_delivery);
                        }
                    }
                }
                return $produto;
            }
            catch(PDOException $e){
                echo $e->getMessage();
            }
        }


        function selectSemCategoria($parametro,$modo){

            $produto= new produto();

            try{

                if($modo==1){

                    $stmte = $this->pdo->prepare("SELECT * FROM tb_produto WHERE pro_nome LIKE :parametro");

                    $stmte->bindParam(":parametro", $parametro . "%" , PDO::PARAM_STR);

                }elseif ($modo==2) {

                    $stmte = $this->pdo->prepare("SELECT * FROM tb_produto WHERE pro_pk_id = :parametro");

                    $stmte->bindParam(":parametro", $parametro , PDO::PARAM_INT);
                }

                if($stmte->execute()){

                    if($stmte->rowCount() > 0){

                        while($result = $stmte->fetch(PDO::FETCH_OBJ)){

                            $produto->setPkId($result->pro_pk_id);
                            $produto->setNome($result->pro_nome);
                            $produto->setPreco($result->pro_preco);
                            $produto->setDescricao($result->pro_descricao);
                            $produto->setFoto($result->pro_foto);
                            $produto->setCategoria($result->pro_fk_categoria);
                            $produto->setFlag_ativo($result->pro_flag_ativo);
                            $produto->setDesconto($result->pro_desconto);
                            $produto->setAdicional($result->pro_arr_adicional);
                            $produto->setDelivery($result->pro_flag_delivery);

                        }
                    }
                }
                return $produto;
            }
            catch(PDOException $e){

                echo $e->getMessage();
            }
        }

        // modo  1 = busca / 2 = categoria
        function select($parametro,$modo){

            try{

                if($modo==1){

                    $stmte = $this->pdo->prepare("SELECT PRO.pro_pk_id, PRO.pro_nome, PRO.pro_preco, PRO.pro_descricao, PRO.pro_foto, PRO.pro_flag_ativo, PRO.pro_arr_adicional, CA.cat_nome FROM tb_produto AS PRO inner join tb_categoria AS CA ON PRO.pro_fk_categoria = CA.cat_pk_id WHERE PRO.pro_nome LIKE :parametro AND PRO.pro_flag_ativo = 1 ORDER BY nome ASC");

                    $stmte->bindValue(":parametro", $parametro . "%" , PDO::PARAM_STR);

                    $produtos = array();

                    if($stmte->execute()){

                        if($stmte->rowCount() > 0){

                            while($result = $stmte->fetch(PDO::FETCH_OBJ)){

                                $produto= new produto();
                                $produto->setPkId($result->pro_pk_id);
                                $produto->setNome($result->pro_nome);
                                $produto->setPreco($result->pro_preco);
                                $produto->setDescricao($result->pro_descricao);
                                $produto->setFoto($result->pro_foto);
                                $produto->setCategoria($result->cat_nome);
                                $produto->setFlag_ativo($result->pro_flag_ativo);
                                $produto->setAdicional($result->pro_arr_adicional);

                                array_push($produtos, $produto);

                            }
                        }
                    }

                    return $produtos;
                
                //by categoria id
                }elseif ($modo==2) {

                    $stmte = $this->pdo->prepare("SELECT PRO.pro_pk_id, PRO.pro_nome, PRO.pro_preco, PRO.pro_descricao, PRO.pro_foto, PRO.pro_flag_ativo, PRO.pro_arr_adicional, CA.cat_nome FROM tb_produto AS PRO inner join tb_categoria AS CA ON PRO.pro_fk_categoria = CA.cat_pk_id WHERE CA.cat_pk_id = :parametro AND PRO.pro_flag_ativo = 1 ORDER BY nome ASC");

                    $stmte->bindParam(":parametro", $parametro , PDO::PARAM_INT);

                    $produtos = array();

                    if($stmte->execute()){

                        if($stmte->rowCount() > 0){

                            while($result = $stmte->fetch(PDO::FETCH_OBJ)){

                                $produto= new produto();
                                $produto->setPkId($result->pro_pk_id);
                                $produto->setNome($result->pro_nome);
                                $produto->setPreco($result->pro_preco);
                                $produto->setDescricao($result->pro_descricao);
                                $produto->setFoto($result->pro_foto);
                                $produto->setFlag_ativo($result->pro_flag_ativo);
                                $produto->setCategoria($result->cat_nome);
                                $produto->setAdicional($result->pro_arr_adicional);

                                array_push($produtos, $produto);

                            }
                        }
                    }

                    return $produtos;
                }
            }

            catch(PDOException $e){
                echo $e->getMessage();
            }
        }

        function selectDelivery($parametro,$modo){

            try{
                //modo 1=busca
                if($modo==1){

                    $stmte = $this->pdo->prepare("SELECT PRO.pro_pk_id, PRO.pro_nome, PRO.pro_preco, PRO.pro_descricao, PRO.pro_foto, PRO.pro_flag_ativo, PRO.pro_flag_delivery, PRO.pro_adicional, CA.cat_nome FROM tb_produto AS PRO inner join tb_categoria AS CA ON PRO.pro_fk_categoria = CA.cat_pk_id WHERE PRO.pro_nome LIKE :parametro AND PRO.pro_flag_ativo = 1 AND PRO.pro_flag_delivery = 1 ORDER BY PRO.pro_nome ASC");

                    $stmte->bindValue(":parametro", $parametro . "%" , PDO::PARAM_STR);

                    $produtos = array();

                    if($stmte->execute()){

                        if($stmte->rowCount() > 0){

                            while($result = $stmte->fetch(PDO::FETCH_OBJ)){

                                $produto= new produto();

                                $produto->setPkId($result->pro_pk_id);
                                $produto->setNome($result->pro_nome);
                                $produto->setPreco($result->pro_preco);
                                $produto->setDescricao($result->pro_descricao);
                                $produto->setFoto($result->pro_foto);
                                $produto->setCategoria($result->cat_nome);
                                $produto->setFlag_ativo($result->pro_flag_ativo);
                                $produto->setDelivery($result->pro_flag_delivery);
                                $produto->setAdicional($result->pro_arr_adicional);

                                array_push($produtos, $produto);

                            }
                        }
                    }

                    return $produtos;
                
                //2=categoria
                }elseif ($modo==2) {

                    $stmte = $this->pdo->prepare("SELECT PRO.pro_pk_id, PRO.pro_nome, PRO.pro_preco, PRO.pro_descricao, PRO.pro_foto, PRO.pro_flag_ativo, PRO.pro_flag_delivery, PRO.pro_adicional, CA.cat_nome FROM tb_produto AS PRO inner join tb_categoria AS CA ON PRO.pro_fk_categoria = CA.cat_pk_id WHERE CA.pk_id = :parametro AND PRO.pro_flag_ativo = 1 AND PRO.pro_flag_delivery = 1 ORDER BY nome ASC");

                    $stmte->bindParam(":parametro", $parametro , PDO::PARAM_INT);

                    $produtos = array();

                    if($stmte->execute()){

                        if($stmte->rowCount() > 0){

                            while($result = $stmte->fetch(PDO::FETCH_OBJ)){

                                $produto= new produto();

                                $produto->setPkId($result->pro_pk_id);
                                $produto->setNome($result->pro_nome);
                                $produto->setPreco($result->pro_preco);
                                $produto->setDescricao($result->pro_descricao);
                                $produto->setFoto($result->pro_foto);
                                $produto->setFlag_ativo($result->pro_flag_ativo);
                                $produto->setCategoria($result->cat_nome);
                                $produto->setAdicional($result->pro_arr_adicional);

                                array_push($produtos, $produto);

                            }
                        }
                    }

                    return $produtos;
                }
            }
            catch(PDOException $e){
                echo $e->getMessage();
            }
        }



        function selectPaginadoNome($parametro,$offset, $por_pagina, $delivery){

            $produtos = array();

            try{

                if ($delivery == true){
                    $stmte = $this->pdo->prepare("SELECT PRO.pro_pk_id, PRO.pro_nome, PRO.pro_preco PRO.pro_descricao, PRO.pro_foto, PRO.pro_flag_ativo, PRO.pro_delivery, PRO.pro_adicional, PRO.pro_fk_categoria FROM tb_produto AS PRO inner join tb_categoria AS CA ON PRO.pro_fk_categoria = CA.cod_categoria WHERE PRO.pro_nome LIKE :parametro AND PRO.pro_flag_ativo = 1 AND PRO.pro_flag_delivery = 1 ORDER BY prioridade DESC, nome ASC LIMIT :offset, :por_pagina");
    
                    $stmte->bindValue(":parametro","%". $parametro . "%" , PDO::PARAM_STR);
                    $stmte->bindParam(":offset", $offset, PDO::PARAM_INT);
                    $stmte->bindParam(":por_pagina", $por_pagina, PDO::PARAM_INT);

                }else{
                    $stmte = $this->pdo->prepare("SELECT PRO.pro_pk_id, PRO.pro_nome, PRO.pro_preco, PRO.pro_descricao, PRO.pro_foto, PRO.pro_flag_ativo, PRO.pro_delivery, PRO.pro_adicional, PRO.pro_fk_categoria FROM tb_produto AS PRO inner join tb_categoria AS CA ON PRO.pro_fk_categoria = CA.cod_categoria WHERE PRO.pro_nome LIKE :parametro AND PRO.pro_flag_ativo = 1 ORDER BY prioridade DESC, nome ASC LIMIT :offset, :por_pagina");
    
                    $stmte->bindValue(":parametro","%". $parametro . "%" , PDO::PARAM_STR);
                    $stmte->bindParam(":offset", $offset, PDO::PARAM_INT);
                    $stmte->bindParam(":por_pagina", $por_pagina, PDO::PARAM_INT);

                }

                if($stmte->execute()){

                    if($stmte->rowCount() > 0){

                        while($result = $stmte->fetch(PDO::FETCH_OBJ)){

                            $produto= new produto();

                            $produto->setPkId($result->pro_pk_id);
                            $produto->setNome($result->pro_nome);
                            $produto->setPreco($result->pro_preco);
                            $produto->setDescricao($result->pro_descricao);
                            $produto->setFoto($result->pro_foto);
                            $produto->setCategoria($result->cat_nome);
                            $produto->setFlag_ativo($result->pro_flag_ativo);
                            $produto->setDelivery($result->pro_flag_delivery);
                            $produto->setAdicional($result->pro_arr_adicional);

                            array_push($produtos, $produto);

                        }
                    }
                }

                return $produtos;
            }

            catch(PDOException $e){
                echo $e->getMessage();
            }
        }

        //Seleciona apenas os itens que estão sendo servidos no momento
        function selectItensServidos($parametro,$offset, $por_pagina, $delivery){

            $produtos = array();
            try{
                if ($delivery == true){
                    $stmte = $this->pdo->prepare("SELECT * FROM tb_produto WHERE pro_flag_servindo = 1 AND pro_flag_delivery = 1 ORDER BY pro_nome ASC");
                    $stmte->bindValue(":parametro","%". $parametro . "%" , PDO::PARAM_STR);
                    $stmte->bindParam(":offset", $offset, PDO::PARAM_INT);
                    $stmte->bindParam(":por_pagina", $por_pagina, PDO::PARAM_INT);
                }else{
                    $stmte = $this->pdo->prepare("SELECT * FROM tb_produto WHERE pro_flag_servindo = 1 ORDER BY pro_nome ASC");
                    $stmte->bindValue(":parametro","%". $parametro . "%" , PDO::PARAM_STR);
                    $stmte->bindParam(":offset", $offset, PDO::PARAM_INT);
                    $stmte->bindParam(":por_pagina", $por_pagina, PDO::PARAM_INT);
                }
                if($stmte->execute()){
                    if($stmte->rowCount() > 0){
                        while($result = $stmte->fetch(PDO::FETCH_OBJ)){
                            $produto= new produto();
                            $produto->setPkId($result->pro_pk_id);
                            $produto->setNome($result->pro_nome);
                            $produto->setPreco($result->pro_preco);
                            $produto->setDescricao($result->pro_descricao);
                            $produto->setFoto($result->pro_foto);
                            $produto->setCategoria($result->cat_nome);
                            $produto->setFlag_ativo($result->pro_flag_ativo);
                            $produto->setDelivery($result->pro_flag_delivery);
                            $produto->setAdicional($result->pro_arr_adicional);
                            array_push($produtos, $produto);
                        }
                    }
                }
                return $produtos;
            }
            catch(PDOException $e){
                echo $e->getMessage();
            }
        }



        function selectPaginadoCategoria($parametro,$offset, $por_pagina, $delivery){

            $produtos = array();
            try{
                if ($delivery == true){
                    $stmte = $this->pdo->prepare("SELECT *
                    FROM tb_produto
                    WHERE pro_fk_categoria = :parametro AND pro_flag_ativo = 1 AND pro_flag_delivery = 1 ORDER BY pro_flag_prioridade DESC, nome ASC LIMIT :offset, :por_pagina");
    
                    $stmte->bindValue(":parametro", $parametro , PDO::PARAM_INT);
                    $stmte->bindParam(":offset", $offset, PDO::PARAM_INT);
                    $stmte->bindParam(":por_pagina", $por_pagina, PDO::PARAM_INT);

                }else{
                    $stmte = $this->pdo->prepare("SELECT *
                    FROM tb_produto
                    WHERE pro_fk_categoria = :parametro AND pro_flag_ativo = 1 ORDER BY pro_flag_prioridade DESC, pro_nome ASC LIMIT :offset, :por_pagina");
    
                    $stmte->bindValue(":parametro", $parametro , PDO::PARAM_INT);
                    $stmte->bindParam(":offset", $offset, PDO::PARAM_INT);
                    $stmte->bindParam(":por_pagina", $por_pagina, PDO::PARAM_INT);
                }

                if($stmte->execute()){

                    if($stmte->rowCount() > 0){

                        while($result = $stmte->fetch(PDO::FETCH_OBJ)){

                            $produto= new produto();

                            $produto->setPkId($result->pro_pk_id);
                            $produto->setNome($result->pro_nome);
                            $produto->setPreco($result->pro_preco);
                            $produto->setDescricao($result->pro_descricao);
                            $produto->setFoto($result->pro_foto);
                            $produto->setCategoria($result->pro_fk_categoria);
                            $produto->setFlag_ativo($result->pro_flag_ativo);
                            $produto->setDelivery($result->pro_flag_delivery);
                            $produto->setAdicional($result->pro_arr_adicional);

                            array_push($produtos, $produto);

                        }
                    }
                }

                return $produtos;
            }
            catch(PDOException $e){
                echo $e->getMessage();
            }
        }

        //Select composto(categoria, posicao, servindo, disponibilidade dias/horas)
        function selectByCategoriaByPosServindo($cat_pk_id){
            $produtos = array();
            try{
                $stmte = $this->pdo->prepare(
                    "SELECT PRO.pro_pk_id, PRO.pro_nome, PRO.pro_preco, PRO.pro_desconto, PRO.pro_descricao, PRO.pro_foto, PRO.pro_flag_ativo, PRO.pro_flag_servindo, PRO.pro_flag_prioridade, PRO.pro_posicao, PRO.pro_flag_delivery, PRO.pro_arr_dias_semana, CA.cat_nome, FAHO.faho_inicio, FAHO.faho_final
                    FROM tb_produto AS PRO 
                    INNER JOIN tb_categoria AS CA ON PRO.pro_fk_categoria = CA.cat_pk_id
                    INNER JOIN tb_faixa_horario AS FAHO ON PRO.pro_fk_faixa_horario = FAHO.faho_pk_id
                    WHERE PRO.pro_fk_categoria = :cat_pk_id AND PRO.pro_flag_ativo = 1 AND PRO.pro_flag_servindo = 1 
                    ORDER BY CA.cat_posicao ASC, PRO.pro_posicao ASC");

                $stmte->bindValue(":cat_pk_id", $cat_pk_id , PDO::PARAM_INT);

                if($stmte->execute()){
                    if($stmte->rowCount() > 0){
                        while($result = $stmte->fetch(PDO::FETCH_OBJ)){

                            $produto= new produto();
                            $produto->setPkId($result->pro_pk_id);
                            $produto->setNome($result->pro_nome);
                            $produto->setPreco($result->pro_preco);
                            $produto->setDesconto($result->pro_desconto);
                            $produto->setDescricao($result->pro_descricao);
                            $produto->setFoto($result->pro_foto);
                            $produto->setCategoria($result->cat_nome);
                            $produto->setFlag_ativo($result->pro_flag_ativo);
                            $produto->setFlag_servindo($result->pro_flag_servindo);
                            $produto->setPrioridade($result->pro_flag_prioridade);
                            $produto->setDelivery($result->pro_flag_delivery);
                            $produto->setPosicao($result->pro_posicao);
                            $produto->setDias_semana($result->pro_arr_dias_semana);
                            $produto->setProduto_horas_inicio($result->faho_inicio);
                            $produto->setProduto_horas_final($result->faho_final);
                            array_push($produtos, $produto);
                        }
                    }
                }
                return $produtos;
            }
            catch(PDOException $e){
                echo $e->getMessage();
            }
        }


        function selectAll(){

            $produtos = array();

            try{

                $stmte = $this->pdo->prepare("SELECT PRO.pro_pk_id, PRO.pro_nome, PRO.pro_preco, PRO.pro_descricao, PRO.pro_foto, PRO.pro_flag_ativo, PRO.pro_arr_adicional, CA.cat_nome FROM tb_produto AS PRO inner join tb_categoria AS CA ON PRO.pro_fk_categoria = CA.cat_pk_id ORDER BY nome ASC");

                if($stmte->execute()){

                    if($stmte->rowCount() > 0){

                        while($result = $stmte->fetch(PDO::FETCH_OBJ)){

                            $produto= new produto();

                            $produto->setPkId($result->pro_pk_id);
                            $produto->setNome($result->pro_nome);
                            $produto->setPreco($result->pro_preco);
                            $produto->setDescricao($result->pro_descricao);
                            $produto->setFoto($result->pro_foto);
                            $produto->setCategoria($result->cat_nome);
                            $produto->setFlag_ativo($result->pro_flag_ativo);
                            $produto->setAdicional($result->pro_arr_adicional);

                            array_push($produtos, $produto);
                        }
                    }
                }
                return $produtos;
            }

            catch(PDOException $e){

                echo $e->getMessage();
            }
        }

        function selectAllByPtsResgate($pts_resgate_fidelidade){
            $produtos = array();
            try{

                $stmte = $this->pdo->prepare("SELECT *
                FROM tb_produto AS PRO
                INNER JOIN tb_fidelidade AS FID
                ON PRO.pro_pts_resgate_fidelidade = :pts_resgate_fidelidade
                INNER JOIN tb_faixa_horario AS FAHO
                ON PRO.pro_fk_faixa_horario = FAHO.faho_pk_id
                ORDER BY pro_pts_resgate_fidelidade ASC");

                $stmte->bindParam(":pts_resgate_fidelidade", $pts_resgate_fidelidade , PDO::PARAM_INT);

                if($stmte->execute()){
                    if($stmte->rowCount() > 0){
                        while($result = $stmte->fetch(PDO::FETCH_OBJ)){
                        
                            $produto = new produto();

                            $produto->setPkId($result->pro_pk_id);
                            $produto->setNome($result->pro_nome);
                            $produto->setPreco($result->pro_preco);
                            $produto->setDesconto($result->pro_desconto);
                            $produto->setDescricao($result->pro_descricao);
                            $produto->setFoto($result->pro_foto);
                            $produto->setFlag_ativo($result->pro_flag_ativo);
                            $produto->setFlag_servindo($result->pro_flag_servindo);
                            $produto->setPrioridade($result->pro_flag_prioridade);
                            $produto->setDelivery($result->pro_flag_delivery);
                            $produto->setPosicao($result->pro_posicao);
                            $produto->setDias_semana($result->pro_arr_dias_semana);
                            $produto->setProduto_horas_inicio($result->faho_inicio);
                            $produto->setProduto_horas_final($result->faho_final);
                            $produto->setPtsResgateFidelidade($result->pro_pts_resgate_fidelidade);

                            $produto->setCategoria($result->pro_fk_categoria);

                            array_push($produtos, $produto);

                        }
                    }
                }

                return $produtos;
            }
            catch(PDOException $e){

                echo $e->getMessage();
            }
        }


        function countProdutos(){

            try{

                $stmte = $this->pdo->prepare("SELECT COUNT(*) AS produtos FROM tb_produto WHERE pro_flag_ativo = 1 ");

                $stmte->execute();

                $result = $stmte->fetch(PDO::FETCH_OBJ);

                return $result->produtos;
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
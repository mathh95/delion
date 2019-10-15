<?php
    include_once ROOTPATH."/config.php";
    include_once MODELPATH."/cardapio.php";
    include_once "seguranca.php";

    protegePagina();

    class controlerCardapio {
        private $pdo;
        function insert($cardapio){
            try{
                $stmte =$this->pdo->prepare("INSERT INTO cardapio(nome, preco, descricao, foto, categoria, flag_ativo, flag_servindo ,prioridade, delivery, desconto, adicional, dias_semana, cardapio_turno, cardapio_horas_inicio, cardapio_horas_final)
                VALUES (:nome, :preco, :descricao, :foto, :categoria, :flag_ativo, :flag_servindo, :prioridade, :delivery, :desconto, :adicional, :dias_semana, :cardapio_turno, :cardapio_horas_inicio, :cardapio_horas_final)");
                $stmte->bindParam(":nome", $cardapio->getNome(), PDO::PARAM_STR);
                $stmte->bindParam(":preco", $cardapio->getPreco());
                $stmte->bindParam(":descricao", $cardapio->getDescricao(), PDO::PARAM_STR);
                $stmte->bindParam(":foto", $cardapio->getFoto(), PDO::PARAM_STR);
                $stmte->bindParam(":categoria", $cardapio->getCategoria(), PDO::PARAM_INT);
                $stmte->bindParam(":flag_ativo", $cardapio->getFlag_ativo(), PDO::PARAM_INT);
                $stmte->bindParam(":flag_servindo", $cardapio->getFlag_servindo(), PDO::PARAM_INT);
                $stmte->bindParam(":prioridade", $cardapio->getPrioridade(),PDO::PARAM_INT);
                $stmte->bindParam(":delivery", $cardapio->getDelivery(),PDO::PARAM_INT);
                $stmte->bindParam(":desconto", $cardapio->getDesconto());
                $stmte->bindParam(":adicional", $cardapio->getAdicional(), PDO::PARAM_STR);
                $stmte->bindParam(":dias_semana", $cardapio->getDias_semana(), PDO::PARAM_STR);
                $stmte->bindParam(":cardapio_turno", $cardapio->getCardapio_turno(), PDO::PARAM_INT);
                $stmte->bindParam(":cardapio_horas_inicio", $cardapio->getCardapio_horas_inicio(), PDO::PARAM_INT);
                $stmte->bindParam(":cardapio_horas_final", $cardapio->getCardapio_horas_final(), PDO::PARAM_INT);
                $executa = $stmte->execute();
                if($executa){
                    return 1;
                }
               else{
                    return -1;
                }
            }
           catch(PDOException $e){
                return  $e->getMessage();
           }
        }

        function update($cardapio){
            try{
                $stmte =$this->pdo->prepare("UPDATE cardapio SET nome=:nome, preco=:preco, desconto = :desconto, descricao=:descricao, foto=:foto, categoria=:categoria, flag_ativo=:flag_ativo, prioridade=:prioridade, delivery=:delivery, adicional=:adicional, dias_semana=:dias_semana, cardapio_turno=:cardapio_turno, cardapio_horas_inicio=:cardapio_horas_inicio, cardapio_horas_final=:cardapio_horas_final WHERE cod_cardapio=:cod_cardapio");
                $stmte->bindParam(":cod_cardapio", $cardapio->getCod_cardapio() , PDO::PARAM_INT);
                $stmte->bindParam(":nome", $cardapio->getNome(), PDO::PARAM_STR);
                $stmte->bindParam(":preco", $cardapio->getPreco());
                $stmte->bindParam(":desconto", $cardapio->getDesconto());
                $stmte->bindParam(":descricao", $cardapio->getDescricao(), PDO::PARAM_STR);
                $stmte->bindParam("foto", $cardapio->getFoto(), PDO::PARAM_STR);
                $stmte->bindParam("categoria", $cardapio->getCategoria(), PDO::PARAM_INT);
                $stmte->bindParam("flag_ativo", $cardapio->getFlag_ativo(), PDO::PARAM_INT);
                $stmte->bindParam("prioridade", $cardapio->getPrioridade(),PDO::PARAM_INT);
                $stmte->bindParam("delivery", $cardapio->getDelivery(),PDO::PARAM_INT);
                $stmte->bindParam("adicional", $cardapio->getAdicional(), PDO::PARAM_STR);
                $stmte->bindParam(":dias_semana", $cardapio->getDias_semana(), PDO::PARAM_STR);
                $stmte->bindParam(":cardapio_turno", $cardapio->getCardapio_turno(), PDO::PARAM_INT);
                $stmte->bindParam(":cardapio_horas_inicio", $cardapio->getCardapio_horas_inicio(), PDO::PARAM_INT);
                $stmte->bindParam(":cardapio_horas_final", $cardapio->getCardapio_horas_final(), PDO::PARAM_INT);
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
                            $cardapio->setDesconto($result->desconto);
                            $cardapio->setDescricao($result->descricao);
                            $cardapio->setFoto($result->foto);
                            $cardapio->setCategoria($result->categoria);
                            $cardapio->setFlag_ativo($result->flag_ativo);
                            $cardapio->setPrioridade($result->prioridade);
                            $cardapio->setDelivery($result->delivery);
                            $cardapio->setAdicional($result->adicional);
                            $cardapio->setDias_semana($result->dias_semana);
                            $cardapio->setCardapio_turno($result->cardapio_turno);
                            $cardapio->setCardapio_horas_inicio($result->cardapio_horas_inicio);
                            $cardapio->setCardapio_horas_final($result->cardapio_horas_final);
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
                    $stmte = $this->pdo->prepare("SELECT A.cod_cardapio AS cod_cardapio, A.nome AS nome, A.preco AS preco, A.desconto AS desconto, A.descricao AS descricao, A.foto AS foto, A.flag_ativo AS flag_ativo, B.nome AS categoria, A.dias_semana AS dias_semana, C.nome AS cardapio_turno, D.horario AS cardapio_horas_inicio, D.horario AS cardapio_horas_final
                        FROM cardapio AS A 
                        INNER JOIN categoria AS B ON A.categoria = B.cod_categoria
                        INNER JOIN cardapio_turno AS C ON A.cardapio_turno = C.cod_cardapio_turno
                        INNER JOIN cardapio_horas AS D ON A.cardapio_horas_inicio AND A.cardapio_horas_final = D.cod_cardapio_horas 
                        WHERE A.nome 
                        LIKE :parametro AND A.flag_ativo = 1");
                    $stmte->bindValue(":parametro","%".$parametro."%");
                    $cardapios = array();
                    if($stmte->execute()){
                        if($stmte->rowCount() > 0){
                            while($result = $stmte->fetch(PDO::FETCH_OBJ)){
                                $cardapio= new cardapio();
                                $cardapio->setCod_cardapio($result->cod_cardapio);
                                $cardapio->setNome($result->nome);
                                $cardapio->setPreco($result->preco);
                                $cardapio->setDesconto($result->desconto);
                                $cardapio->setDescricao($result->descricao);
                                $cardapio->setFoto($result->foto);
                                $cardapio->setCategoria($result->categoria);
                                $cardapio->setFlag_ativo($result->flag_ativo);
                                $cardapio->setPrioridade($result->prioridade);
                                $cardapio->setDelivery($result->delivery);
                                $cardapio->setDias_semana($result->dias_semana);
                                $cardapio->setCardapio_turno($result->cardapio_turno);
                                $cardapio->setCardapio_horas_inicio($result->cardapio_horas_inicio);
                                $cardapio->setCardapio_horas_final($result->cardapio_horas_final);
                                array_push($cardapios, $cardapio);
                            }
                        }
                    }
                    return $cardapios;
                }elseif ($modo==2) {
                    $stmte = $this->pdo->prepare("SELECT A.cod_cardapio AS cod_cardapio, A.nome AS nome, A.preco AS preco, A.descricao AS descricao, A.foto AS foto, A.flag_ativo AS flag_ativo, B.nome AS categoria, A.dias_semana AS dias_semana, C.nome AS cardapio_turno, D.horario AS cardapio_horas_inicio, D.horario AS cardapio_horas_final 
                    FROM cardapio AS A 
                    INNER JOIN categoria AS B ON A.categoria = B.cod_categoria
                    INNER JOIN cardapio_turno AS C ON A.cardapio_turno = C.cod_cardapio_turno
                    INNER JOIN cardapio_horas AS D ON A.cardapio_horas_inicio AND A.cardapio_horas_final = D.cod_cardapio_horas 
                    WHERE A.cod_cardapio = :parametro");
                    $stmte->bindParam(":parametro", $parametro , PDO::PARAM_INT);
                    $cardapio= new cardapio();
                    if($stmte->execute()){
                        if($stmte->rowCount() > 0){
                            while($result = $stmte->fetch(PDO::FETCH_OBJ)){
                                $cardapio->setCod_cardapio($result->cod_cardapio);
                                $cardapio->setNome($result->nome);
                                $cardapio->setPreco($result->preco);
                                $cardapio->setDescricao($result->descricao);
                                $cardapio->setFoto($result->foto);
                                $cardapio->setFlag_ativo($result->flag_ativo);
                                $cardapio->setPrioridade($result->prioridade);
                                $cardapio->setDelivery($result->delivery);
                                $cardapio->setDias_semana($result->dias_semana);
                                $cardapio->setCardapio_turno($result->cardapio_turno);
                                $cardapio->setCardapio_horas_inicio($result->cardapio_horas_inicio);
                                $cardapio->setCardapio_horas_final($result->cardapio_horas_final);
                            }
                        }
                    }
                    return $cardapio;
                                // echo "<pre>";
                                // print_r($cardapio);
                                // echo "</pre>";
                }
            }
            catch(PDOException $e){
                echo $e->getMessage();
            }
        }

        //Pausa a produção de um item no cardapio
        function desativaItemCardapio($parametro){
            try{
                $stmt = $this->pdo->prepare("UPDATE cardapio SET flag_servindo = 0 WHERE cod_cardapio = :parametro");
                $stmt->bindParam(":parametro", $parametro , PDO::PARAM_INT);
                $stmt->execute();
                return 1;
            }
            catch(PDOException $e){
                echo $e->getMessage();
                return -1;
            }
        }

        //Retoma a produção de um item no cardapio
        function ativaItemCardapio($parametro){
            try{
                $stmt = $this->pdo->prepare("UPDATE cardapio SET flag_servindo = 1 WHERE cod_cardapio = :parametro");
                $stmt->bindParam(":parametro", $parametro , PDO::PARAM_INT);
                $stmt->execute();
                return 1;
            }
            catch(PDOException $e){
                echo $e->getMessage();
                return -1;
            }
        }

        //Faz um filtro atraves de uma palavra da descrição
        function filterDescricao($parametro){
            $stmte;
            try{
                $stmte = $this->pdo->prepare("SELECT * FROM cardapio WHERE descricao LIKE :parametro");
                $stmte->bindValue(":parametro","% ".$parametro."%");
                $cardapios = array();
                if($stmte->execute()){
                    if($stmte->rowCount() > 0){
                        while($result = $stmte->fetch(PDO::FETCH_OBJ)){
                            $cardapio= new cardapio();
                            $cardapio->setCod_cardapio($result->cod_cardapio);
                            $cardapio->setNome($result->nome);
                            $cardapio->setPreco($result->preco);
                            $cardapio->setDesconto($result->desconto);
                            $cardapio->setDescricao($result->descricao);
                            $cardapio->setFoto($result->foto);
                            $cardapio->setCategoria($result->categoria);
                            $cardapio->setFlag_ativo($result->flag_ativo);
                            $cardapio->setFlag_servindo($result->flag_servindo);
                            $cardapio->setPrioridade($result->prioridade);
                            $cardapio->setDelivery($result->delivery);
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

        //Alterar para mostrar o select Em Produção
        //Todos -> Pausada -> Servido
        function filter($parametro, $flag_ativo, $flag_servindo , $delivery, $prioridade, $categoria){
            $stmte;
            try{
                $stmte = $this->pdo->prepare("SELECT A.cod_cardapio AS cod_cardapio, A.nome AS nome, A.preco AS preco, A.desconto AS desconto, A.descricao AS descricao, A.foto AS foto, A.flag_ativo AS flag_ativo, A.flag_servindo AS flag_servindo ,A.prioridade AS prioridade, A.delivery AS delivery, B.nome AS categoria FROM cardapio AS A inner join categoria AS B ON A.categoria = B.cod_categoria WHERE A.nome LIKE :parametro AND A.flag_ativo LIKE :flag_ativo AND A.flag_servindo LIKE :flag_servindo AND A.delivery LIKE :delivery AND A.prioridade LIKE :prioridade AND B.nome LIKE :categoria");
                $stmte->bindValue(":parametro","%".$parametro."%");
                $stmte->bindValue(":flag_ativo","%" .$flag_ativo);
                $stmte->bindValue(":flag_servindo","%" .$flag_servindo);
                $stmte->bindValue(":delivery","%".$delivery);
                $stmte->bindValue(":prioridade","%".$prioridade);
                $stmte->bindValue(":categoria","%".$categoria."%");
                $cardapios = array();
                if($stmte->execute()){
                    if($stmte->rowCount() > 0){
                        while($result = $stmte->fetch(PDO::FETCH_OBJ)){
                            $cardapio= new cardapio();
                            $cardapio->setCod_cardapio($result->cod_cardapio);
                            $cardapio->setNome($result->nome);
                            $cardapio->setPreco($result->preco);
                            $cardapio->setDesconto($result->desconto);
                            $cardapio->setDescricao($result->descricao);
                            $cardapio->setFoto($result->foto);
                            $cardapio->setCategoria($result->categoria);
                            $cardapio->setFlag_ativo($result->flag_ativo);
                            $cardapio->setFlag_servindo($result->flag_servindo);
                            $cardapio->setPrioridade($result->prioridade);
                            $cardapio->setDelivery($result->delivery);
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

        function filterDelivery($parametro, $flag_ativo, $prioridade, $categoria){
            $stmte;
            try{
                $stmte = $this->pdo->prepare("SELECT A.cod_cardapio AS cod_cardapio, A.nome AS nome, A.preco AS preco, A.desconto AS desconto, A.descricao AS descricao, A.foto AS foto, A.flag_ativo AS flag_ativo, A.prioridade AS prioridade, A.delivery AS delivery, B.nome AS categoria FROM cardapio AS A inner join categoria AS B ON A.categoria = B.cod_categoria WHERE A.nome LIKE :parametro AND A.flag_ativo LIKE :flag_ativo AND A.delivery = 1 AND A.prioridade LIKE :prioridade AND B.nome LIKE :categoria");
                $stmte->bindValue(":parametro","%".$parametro."%");
                $stmte->bindValue(":flag_ativo","%" .$flag_ativo);
                $stmte->bindValue(":prioridade","%".$prioridade);
                $stmte->bindValue(":categoria","%".$categoria."%");
                $cardapios = array();
                if($stmte->execute()){
                    if($stmte->rowCount() > 0){
                        while($result = $stmte->fetch(PDO::FETCH_OBJ)){
                            $cardapio= new cardapio();
                            $cardapio->setCod_cardapio($result->cod_cardapio);
                            $cardapio->setNome($result->nome);
                            $cardapio->setPreco($result->preco);
                            $cardapio->setDesconto($result->desconto);
                            $cardapio->setDescricao($result->descricao);
                            $cardapio->setFoto($result->foto);
                            $cardapio->setCategoria($result->categoria);
                            $cardapio->setFlag_ativo($result->flag_ativo);
                            $cardapio->setPrioridade($result->prioridade);
                            $cardapio->setDelivery($result->delivery);
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
                            $cardapio->setPreco($result->preco);
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
                            $cardapio->stPreco($result->preco);
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
                            $cardapio->setPreco($result->preco);
                            $cardapio->setDescricao($result->descricao);
                            $cardapio->setFoto($result->foto);
                            $cardapio->setCategoria($result->categoria);
                            $cardapio->setFlag_ativo($result->flag_ativo);
                            $cardapio->setPrioridade($result->prioridade);
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
                $stmte = $this->pdo->prepare("SELECT A.cod_cardapio AS cod_cardapio, A.nome AS nome, A.preco AS preco, A.desconto AS desconto, A.descricao AS descricao, A.foto AS foto, A.flag_ativo AS flag_ativo, A.flag_servindo AS flag_servindo ,A.prioridade AS prioridade, A.delivery AS delivery, B.nome AS categoria FROM cardapio AS A inner join categoria AS B ON A.categoria = B.cod_categoria");
                if($stmte->execute()){
                    if($stmte->rowCount() > 0){
                        while($result = $stmte->fetch(PDO::FETCH_OBJ)){
                            $cardapio= new cardapio();
                            $cardapio->setCod_cardapio($result->cod_cardapio);
                            $cardapio->setNome($result->nome);
                            $cardapio->setPreco($result->preco);
                            $cardapio->setDesconto($result->desconto);
                            $cardapio->setDescricao($result->descricao);
                            $cardapio->setFoto($result->foto);
                            $cardapio->setCategoria($result->categoria);
                            $cardapio->setFlag_ativo($result->flag_ativo);
                            $cardapio->setFlag_servindo($result->flag_servindo);
                            $cardapio->setPrioridade($result->prioridade);
                            $cardapio->setDelivery($result->delivery);
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

        function selectAllByPos(){
            $cardapios = array();
            try{
                $stmte = $this->pdo->prepare("SELECT A.cod_cardapio AS cod_cardapio, A.nome AS nome, A.preco AS preco, A.desconto AS desconto, A.descricao AS descricao, A.foto AS foto, A.flag_ativo AS flag_ativo, A.flag_servindo AS flag_servindo ,A.prioridade AS prioridade, A.posicao AS posicao, A.delivery AS delivery, B.nome AS categoria FROM cardapio AS A inner join categoria AS B ON A.categoria = B.cod_categoria ORDER BY B.posicao ASC, A.posicao ASC");
                if($stmte->execute()){
                    if($stmte->rowCount() > 0){
                        while($result = $stmte->fetch(PDO::FETCH_OBJ)){
                            $cardapio= new cardapio();
                            $cardapio->setCod_cardapio($result->cod_cardapio);
                            $cardapio->setNome($result->nome);
                            $cardapio->setPreco($result->preco);
                            $cardapio->setDesconto($result->desconto);
                            $cardapio->setDescricao($result->descricao);
                            $cardapio->setFoto($result->foto);
                            $cardapio->setCategoria($result->categoria);
                            $cardapio->setFlag_ativo($result->flag_ativo);
                            $cardapio->setFlag_servindo($result->flag_servindo);
                            $cardapio->setPrioridade($result->prioridade);
                            $cardapio->setDelivery($result->delivery);
                            $cardapio->setPosicao($result->posicao);
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

        function selectByCategoriaByPos($cod_categoria){
            $cardapios = array();
            try{
                $stmte = $this->pdo->prepare("SELECT A.cod_cardapio AS cod_cardapio, A.nome AS nome, A.preco AS preco, A.desconto AS desconto, A.descricao AS descricao, A.foto AS foto, A.flag_ativo AS flag_ativo, A.flag_servindo AS flag_servindo ,A.prioridade AS prioridade, A.posicao AS posicao, A.delivery AS delivery, B.nome AS categoria FROM cardapio AS A inner join categoria AS B ON A.categoria = B.cod_categoria WHERE A.categoria = :cod_categoria ORDER BY B.posicao ASC, A.posicao ASC");

                $stmte->bindValue(":cod_categoria", $cod_categoria , PDO::PARAM_INT);

                if($stmte->execute()){
                    if($stmte->rowCount() > 0){
                        while($result = $stmte->fetch(PDO::FETCH_OBJ)){
                            $cardapio= new cardapio();
                            $cardapio->setCod_cardapio($result->cod_cardapio);
                            $cardapio->setNome($result->nome);
                            $cardapio->setPreco($result->preco);
                            $cardapio->setDesconto($result->desconto);
                            $cardapio->setDescricao($result->descricao);
                            $cardapio->setFoto($result->foto);
                            $cardapio->setCategoria($result->categoria);
                            $cardapio->setFlag_ativo($result->flag_ativo);
                            $cardapio->setFlag_servindo($result->flag_servindo);
                            $cardapio->setPrioridade($result->prioridade);
                            $cardapio->setDelivery($result->delivery);
                            $cardapio->setPosicao($result->posicao);
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

        function selectAllDelivery(){
            $stmte;
            $cardapios = array();
            try{
                $stmte = $this->pdo->prepare("SELECT A.cod_cardapio AS cod_cardapio, A.nome AS nome, A.preco AS preco, A.desconto AS desconto, A.descricao AS descricao, A.foto AS foto, A.flag_ativo AS flag_ativo, A.prioridade AS prioridade, A.delivery AS delivery, B.nome AS categoria FROM cardapio AS A inner join categoria AS B ON A.categoria = B.cod_categoria WHERE delivery = 1");
                if($stmte->execute()){
                    if($stmte->rowCount() > 0){
                        while($result = $stmte->fetch(PDO::FETCH_OBJ)){
                            $cardapio= new cardapio();
                            $cardapio->setCod_cardapio($result->cod_cardapio);
                            $cardapio->setNome($result->nome);
                            $cardapio->setPreco($result->preco);
                            $cardapio->setDesconto($result->desconto);
                            $cardapio->setDescricao($result->descricao);
                            $cardapio->setFoto($result->foto);
                            $cardapio->setCategoria($result->categoria);
                            $cardapio->setFlag_ativo($result->flag_ativo);
                            $cardapio->setPrioridade($result->prioridade);
                            $cardapio->setDelivery($result->delivery);
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
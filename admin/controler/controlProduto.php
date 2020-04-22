<?php
    include_once ROOTPATH."/config.php";
    include_once MODELPATH."/produto.php";
    include_once "seguranca.php";

    protegePagina();

    class controlerProduto {
        private $pdo;

        function insert($produto){

            try{
                $stmte =$this->pdo->prepare("INSERT INTO tb_produto(pro_nome, pro_preco, pro_flag_deletado, pro_flag_ativo, pro_flag_servindo,  pro_foto, pro_descricao, pro_flag_prioridade, pro_flag_delivery, pro_desconto, pro_arr_adicional, pro_arr_dias_semana, pro_fk_categoria, pro_fk_faixa_horario)
                VALUES (:nome, :preco, :flag_deletado, :flag_ativo, :flag_servindo, :foto, :descricao, :flag_prioridade, :flag_delivery, :desconto, :arr_adicional, :arr_dias_semana, :fk_categoria, :fk_faixa_horario)" );

                $stmte->bindParam(":nome", $produto->getNome(), PDO::PARAM_STR);
                $stmte->bindParam(":preco", $produto->getPreco(), PDO::PARAM_STR);
                $stmte->bindParam(":flag_deletado", $produto->getFlag_deletado(), PDO::PARAM_INT);
                $stmte->bindParam(":flag_ativo", $produto->getFlag_ativo(), PDO::PARAM_INT);
                $stmte->bindParam(":flag_servindo", $produto->getFlag_servindo(), PDO::PARAM_INT);
                $stmte->bindParam(":foto", $produto->getFoto(), PDO::PARAM_STR);
                $stmte->bindParam(":descricao", $produto->getDescricao(), PDO::PARAM_STR);
                $stmte->bindParam(":flag_prioridade", $produto->getPrioridade(),PDO::PARAM_INT);
                $stmte->bindParam(":flag_delivery", $produto->getDelivery(),PDO::PARAM_INT);
                $stmte->bindParam(":desconto", $produto->getDesconto(), PDO::PARAM_INT);
                $stmte->bindParam(":arr_adicional", $produto->getAdicional(), PDO::PARAM_STR);
                $stmte->bindParam(":arr_dias_semana", $produto->getDias_semana(), PDO::PARAM_STR);
                $stmte->bindParam(":fk_categoria", $produto->getCategoria(), PDO::PARAM_INT);
                $stmte->bindParam(":fk_faixa_horario", $produto->getFkFaixaHorario(), PDO::PARAM_INT);

                
                $executa = $stmte->execute();
                $hipr_fk_produto = $this->pdo->lastInsertId();

                if($executa){
                    return $hipr_fk_produto;
                }
               else{
                    return -1;
                }
            }
           catch(PDOException $e){
                return  $e->getMessage();
           }
        }

        function update($produto){
            try{

                $stmte = $this->pdo->prepare("UPDATE tb_produto SET pro_nome=:nome, pro_preco=:preco, pro_flag_deletado=:flag_deletado, pro_flag_ativo=:flag_ativo, pro_flag_servindo=:flag_servindo, pro_foto=:foto, pro_descricao=:descricao, pro_flag_prioridade=:flag_prioridade, pro_flag_delivery=:flag_delivery, pro_desconto=:desconto, pro_arr_adicional=:arr_adicional, pro_arr_dias_semana=:arr_dias_semana, pro_fk_categoria=:fk_categoria, pro_fk_faixa_horario=:fk_faixa_horario WHERE pro_pk_id=:pk_id");

                $stmte->bindParam(":nome", $produto->getNome(), PDO::PARAM_STR);
                $stmte->bindParam(":preco", $produto->getPreco(), PDO::PARAM_STR);
                $stmte->bindParam(":flag_deletado", $produto->getFlag_deletado(), PDO::PARAM_INT);
                $stmte->bindParam(":flag_ativo", $produto->getFlag_ativo(), PDO::PARAM_INT);
                $stmte->bindParam(":flag_servindo", $produto->getFlag_servindo(), PDO::PARAM_INT);
                $stmte->bindParam(":foto", $produto->getFoto(), PDO::PARAM_STR);
                $stmte->bindParam(":descricao", $produto->getDescricao(), PDO::PARAM_STR);
                $stmte->bindParam(":flag_prioridade", $produto->getPrioridade(),PDO::PARAM_INT);
                $stmte->bindParam(":flag_delivery", $produto->getDelivery(),PDO::PARAM_INT);
                $stmte->bindParam(":desconto", $produto->getDesconto(), PDO::PARAM_INT);
                $stmte->bindParam(":arr_adicional", $produto->getAdicional(), PDO::PARAM_STR);
                $stmte->bindParam(":arr_dias_semana", $produto->getDias_semana(), PDO::PARAM_STR);
                $stmte->bindParam(":fk_categoria", $produto->getCategoria(), PDO::PARAM_INT);
                $stmte->bindParam(":fk_faixa_horario", $produto->getFkFaixaHorario(), PDO::PARAM_INT);

                $stmte->bindParam(":pk_id", $produto->getPkId(), PDO::PARAM_INT);

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

        function updatePos($pk_id, $posicao){
            try{
                $stmte =$this->pdo->prepare("UPDATE tb_produto SET pro_posicao=:posicao WHERE pro_pk_id=:pk_id");

                $stmte->bindParam(":pk_id", $pk_id, PDO::PARAM_INT);
                $stmte->bindParam(":posicao", $posicao, PDO::PARAM_INT);
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

        function updateFidelidade($pk_id, $pts_resgate_fidelidade, $fk_fidelidade){

            try{
                $stmte =$this->pdo->prepare("UPDATE tb_produto SET pro_pts_resgate_fidelidade=:pts_resgate_fidelidade, pro_fk_fidelidade=:fk_fidelidade
                WHERE pro_pk_id=:pk_id");

                $stmte->bindParam(":pk_id", $pk_id, PDO::PARAM_INT);
                $stmte->bindParam(":pts_resgate_fidelidade", $pts_resgate_fidelidade, PDO::PARAM_STR);
                $stmte->bindParam(":fk_fidelidade", $fk_fidelidade, PDO::PARAM_INT);
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

        function buscarVariosId($itens){
            $array = array();

            $sql = "SELECT * FROM tb_produto WHERE pro_pk_id IN (".implode(',', $itens).")";
            // print_r($sql);
            // exit;
            $sql = $this->pdo->query($sql);

            if($sql -> rowCount() > 0){
                $array = $sql->fetchAll();
            }

            return $array;
        }

        function selectAllHistorico(){
            $array = array();

            $sql = "SELECT *
            FROM tb_historico_produto
            ORDER BY hipr_data ASC";
            
            $sql = $this->pdo->query($sql);

            if($sql -> rowCount() > 0){
                $array = $sql->fetchAll();
            }

            return $array;
        }

        function selectHistoricoByFkPro($fk_produto){
            $array = array();

            $stmte = $this->pdo->prepare("SELECT *
            FROM tb_historico_produto
            WHERE hipr_fk_produto =:fk_produto
            ORDER BY hipr_data ASC");

            $stmte->bindParam(":fk_produto", $fk_produto);

            if($stmte->execute()){
                if($stmte->rowCount() > 0){
                    $array = $stmte->fetchAll();
                }
            }

            return $array;
        }

        function selectById($pk_id){

            try{

                $stmte = $this->pdo->prepare("SELECT *
                FROM tb_produto AS PRO
                LEFT JOIN tb_faixa_horario AS FAHO
                ON PRO.pro_fk_faixa_horario = FAHO.faho_pk_id
                WHERE pro_pk_id = :pk_id");

                $stmte->bindParam(":pk_id", $pk_id , PDO::PARAM_INT);

                if($stmte->execute()){
                    if($stmte->rowCount() > 0){
                        $result = $stmte->fetch(PDO::FETCH_OBJ);

                        $produto= new produto();
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
                        $produto->setAdicional($result->pro_arr_adicional);
                        $produto->setDias_semana($result->pro_arr_dias_semana);

                        $produto->setCategoria($result->pro_fk_categoria);

                        $produto->setFkFaixaHorario($result->pro_fk_faixa_horario);
                        $produto->setProduto_horas_inicio($result->faho_inicio);
                        $produto->setProduto_horas_final($result->faho_final);
                    }
                }

                return $produto;
            }
            catch(PDOException $e){

                echo $e->getMessage();
            }
        }

        function selectAllByFidelidade($fk_fidelidade = 1){
            $produtos = array();
            try{

                $stmte = $this->pdo->prepare("SELECT *
                FROM tb_produto AS PRO
                INNER JOIN tb_fidelidade AS FID
                ON PRO.pro_fk_fidelidade = :fk_fidelidade
                ORDER BY pro_pts_resgate_fidelidade ASC");

                $stmte->bindParam(":fk_fidelidade", $fk_fidelidade , PDO::PARAM_INT);

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
                            $produto->setPtsResgateFidelidade($result->pro_pts_resgate_fidelidade);

                            $produto->setCategoria($result->pro_fk_categoria);

                            array_push($produtos, $produto);

                        }
                    }else{
                        return NULL;
                    }
                    return $produtos;
                }else{
                    return NULL;
                }

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

                            $produto= new produto();
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

                            $produto->setFkFaixaHorario($result->pro_fk_faixa_horario);
                            $produto->setProduto_horas_inicio($result->faho_inicio);
                            $produto->setProduto_horas_final($result->faho_final);
                            array_push($produtos, $produto);
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

                    $stmte = $this->pdo->prepare("SELECT *
                    FROM tb_produto AS PRO
                    LEFT JOIN tb_categoria AS CA
                    ON PRO.pro_fk_categoria = CA.cat_pk_id WHERE PRO.pro_nome LIKE :parametro AND PRO.pro_flag_ativo = 1 ORDER BY nome ASC");

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

                    $stmte = $this->pdo->prepare("SELECT PRO.pro_pk_id, PRO.pro_nome, PRO.pro_preco, PRO.pro_descricao, PRO.pro_foto, PRO.pro_flag_ativo, PRO.pro_arr_adicional, CA.cat_nome FROM tb_produto AS PRO
                    LEFT JOIN tb_categoria AS CA
                    ON PRO.pro_fk_categoria = CA.cat_pk_id WHERE CA.cat_pk_id = :parametro AND PRO.pro_flag_ativo = 1 ORDER BY nome ASC");

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

        function delete($pk_id){
            try{
                $stmt = $this->pdo->prepare("UPDATE tb_produto SET pro_flag_deletado = 1 WHERE pro_pk_id = :pk_id");
                $stmt->bindParam(":pk_id", $pk_id , PDO::PARAM_INT);
                $stmt->execute();
                return 1;
            }
            catch(PDOException $e){
                echo $e->getMessage();
                return -1;
            }
        }

        function deleteFidelidade($pk_id){
            try{
                $stmt = $this->pdo->prepare("UPDATE tb_produto
                SET pro_fk_fidelidade = null, pro_pts_resgate_fidelidade = null
                WHERE pro_pk_id = :pk_id");

                $stmt->bindParam(":pk_id", $pk_id , PDO::PARAM_INT);
                $stmt->execute();
                return 1;
            }
            catch(PDOException $e){
                echo $e->getMessage();
                return -1;
            }
        }

        function desativa($pk_id){
            try{
                $stmt = $this->pdo->prepare("UPDATE tb_produto
                SET pro_flag_ativo = 0
                WHERE pro_pk_id = :pk_id");

                $stmt->bindParam(":pk_id", $pk_id , PDO::PARAM_INT);
                $stmt->execute();
                return 1;
            }
            catch(PDOException $e){
                echo $e->getMessage();
                return -1;
            }
        }

        //Pausa o serviço de um item no cardapio
        function desativaServindo($pk_id){
            try{
                $stmt = $this->pdo->prepare("UPDATE tb_produto SET pro_flag_servindo = 0 WHERE pro_pk_id = :pk_id");
                $stmt->bindParam(":pk_id", $pk_id , PDO::PARAM_INT);
                $stmt->execute();
                return 1;
            }
            catch(PDOException $e){
                echo $e->getMessage();
                return -1;
            }
        }

        //Retoma o serviço de um item no cardapio
        function ativaServindo($pk_id){
            try{
                $stmt = $this->pdo->prepare("UPDATE tb_produto SET pro_flag_servindo = 1 WHERE pro_pk_id = :pk_id");
                $stmt->bindParam(":pk_id", $pk_id , PDO::PARAM_INT);
                $stmt->execute();
                return 1;
            }
            catch(PDOException $e){
                echo $e->getMessage();
                return -1;
            }
        }

        //Pausa o Serviço dos itens listados na pesquisa
        function pausaServico($parametro){
            $parametro = "%".$parametro."%";
            try{
                $stmt = $this->pdo->prepare("UPDATE tb_produto SET pro_flag_servindo = 0 WHERE pro_descricao LIKE :parametro");
                $stmt->bindParam(":parametro", $parametro , PDO::PARAM_STR);
                $stmt->execute();
                return 1;
            }
            catch(PDOException $e){
                echo $e->getMessage();
                return -1;
            }
        }

        //Alterar para mostrar o select Em Produção
        //Todos -> Pausada -> Servido
        function filter($parametro, $flag_ativo, $flag_servindo , $delivery, $prioridade, $categoria){
            try{
                $stmte = $this->pdo->prepare("SELECT *
                FROM tb_produto AS PRO
                LEFT JOIN
                tb_categoria AS CAT
                ON PRO.pro_fk_categoria = CAT.cat_pk_id
                WHERE PRO.pro_nome LIKE :parametro AND PRO.pro_flag_ativo LIKE :flag_ativo 
                AND PRO.pro_flag_servindo LIKE :flag_servindo AND PRO.pro_flag_delivery LIKE :delivery 
                AND PRO.pro_flag_prioridade LIKE :prioridade AND PRO.pro_fk_categoria = :categoria
                AND PRO.pro_flag_deletado = 0");

                $stmte->bindValue(":parametro","%".$parametro."%");
                $stmte->bindValue(":flag_ativo","%" .$flag_ativo);
                $stmte->bindValue(":flag_servindo","%" .$flag_servindo);
                $stmte->bindValue(":delivery","%".$delivery);
                $stmte->bindValue(":prioridade","%".$prioridade);
                $stmte->bindValue(":categoria", $categoria);

                $produtos = array();
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
                            $produto->setFlag_ativo($result->pro_flag_ativo);
                            $produto->setFlag_servindo($result->pro_flag_servindo);
                            $produto->setPrioridade($result->pro_flag_prioridade);
                            $produto->setDelivery($result->pro_flag_delivery);
                            $produto->setPosicao($result->pro_posicao);
                            $produto->setDias_semana($result->pro_arr_dias_semana);
                            
                            //atribuição por referencia
                            $produto->setCategoria($result->cat_nome);

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

        function filterProducao($parametro, $flag_servindo){
            try{
                $stmte = $this->pdo->prepare("SELECT *
                FROM tb_produto
                AS PRO
                LEFT JOIN tb_categoria AS CAT
                ON PRO.pro_fk_categoria = CAT.cat_pk_id
                WHERE PRO.pro_descricao LIKE :parametro
                AND PRO.pro_flag_servindo LIKE :flag_servindo");

                $stmte->bindValue(":parametro","%".$parametro."%");
                $stmte->bindValue(":flag_servindo","%" .$flag_servindo);

                $produtos = array();
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
                            $produto->setFlag_ativo($result->pro_flag_ativo);
                            $produto->setFlag_servindo($result->pro_flag_servindo);
                            $produto->setPrioridade($result->pro_flag_prioridade);
                            $produto->setDelivery($result->pro_flag_delivery);
                            $produto->setPosicao($result->pro_posicao);
                            $produto->setDias_semana($result->pro_arr_dias_semana);
                            
                            //atribuição por referencia
                            $produto->setCategoria($result->cat_nome);
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

        function filterProducaoByPos($parametro, $flag_servindo){

            try{
                $stmte = $this->pdo->prepare("SELECT *
                FROM tb_produto AS PRO
                LEFT JOIN tb_categoria AS CAT
                ON A.categoria = B.cod_categoria WHERE A.descricao LIKE :parametro AND A.flag_servindo LIKE :flag_servindo");

                $stmte->bindValue(":parametro", "%".$parametro."%");
                $stmte->bindValue(":flag_servindo", "%" .$flag_servindo);

                $produtos = array();
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
                            
                            //atribuição por referencia
                            $produto->setCategoria($result->cat_nome);
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

        function filterDelivery($parametro, $flag_ativo, $prioridade, $categoria){
            try{
                $stmte = $this->pdo->prepare("SELECT *
                FROM tb_produto AS PRO
                LEFT JOIN tb_categoria AS CAT
                ON PRO.pro_fk_categoria = CAT.cat_pk_id
                WHERE PRO.pro_nome LIKE :parametro AND PRO.pro_flag_ativo LIKE :flag_ativo AND PRO.pro_delivery = 1 AND PRO.pro_prioridade LIKE :prioridade AND CAT.cat_nome LIKE :categoria");

                $stmte->bindValue(":parametro","%".$parametro."%");
                $stmte->bindValue(":flag_ativo","%" .$flag_ativo);
                $stmte->bindValue(":prioridade","%".$prioridade);
                $stmte->bindValue(":categoria","%".$categoria."%");
                $produtos = array();
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
                            $produto->setFlag_ativo($result->pro_flag_ativo);
                            $produto->setFlag_servindo($result->pro_flag_servindo);
                            $produto->setPrioridade($result->pro_flag_prioridade);
                            $produto->setDelivery($result->pro_flag_delivery);
                            $produto->setPosicao($result->pro_posicao);
                            $produto->setDias_semana($result->pro_arr_dias_semana);
                            
                            //atribuição por referencia
                            $produto->setCategoria($result->cat_nome);
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

        function selectPaginadoNome($parametro,$offset, $por_pagina){
            $produtos = array();
            try{
                $stmte = $this->pdo->prepare("SELECT *
                FROM tb_produto
                WHERE pro_nome LIKE :parametro AND pro_flag_ativo = 1
                ORDER BY pro_categoria DESC LIMIT :offset, :por_pagina");

                $stmte->bindValue(":parametro","%". $parametro . "%" , PDO::PARAM_STR);
                $stmte->bindParam(":offset", $offset, PDO::PARAM_INT);
                $stmte->bindParam(":por_pagina", $por_pagina, PDO::PARAM_INT);

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
                            $produto->setFlag_ativo($result->pro_flag_ativo);
                            $produto->setFlag_servindo($result->pro_flag_servindo);
                            $produto->setPrioridade($result->pro_flag_prioridade);
                            $produto->setDelivery($result->pro_flag_delivery);
                            $produto->setPosicao($result->pro_posicao);
                            $produto->setDias_semana($result->pro_arr_dias_semana);
                            
                            //atribuição por referencia
                            $produto->setCategoria($result->cat_nome);
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

        function verificaIgual($parametro){
            $produto= new produto();
            try{
                $stmte = $this->pdo->prepare("SELECT * FROM tb_produto WHERE pro_nome = :parametro");
                $stmte->bindValue(":parametro", $parametro, PDO::PARAM_STR);
                if($stmte->execute()){
                        if($stmte->rowCount() > 0){
                            while($result = $stmte->fetch(PDO::FETCH_OBJ)){
                                $produto->setPkId($result->pro_pk_id);
                                $produto->setNome($result->pro_nome);
                            }
                        }
                }
                return $produto;
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
                            $produto->setDesconto($result->pro_desconto);
                            $produto->setDescricao($result->pro_descricao);
                            $produto->setFoto($result->pro_foto);
                            $produto->setFlag_ativo($result->pro_flag_ativo);
                            $produto->setFlag_servindo($result->pro_flag_servindo);
                            $produto->setPrioridade($result->pro_flag_prioridade);
                            $produto->setDelivery($result->pro_flag_delivery);
                            $produto->setPosicao($result->pro_posicao);
                            $produto->setDias_semana($result->pro_arr_dias_semana);
                            
                            //atribuição por referencia
                            $produto->setCategoria($result->cat_nome);

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
                $stmte = $this->pdo->prepare("SELECT *
                FROM tb_produto AS A
                LEFT JOIN tb_categoria AS B
                ON A.pro_fk_categoria = B.cat_pk_id
                LEFT JOIN tb_composicao
                ON pro_pk_id = com_fk_produto
                WHERE pro_flag_deletado = 0
                ORDER BY pro_nome ASC");

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
                            $produto->setFlag_deletado($result->pro_flag_deletado);
                            $produto->setFlag_ativo($result->pro_flag_ativo);
                            $produto->setFlag_servindo($result->pro_flag_servindo);
                            $produto->setPrioridade($result->pro_flag_prioridade);
                            $produto->setDelivery($result->pro_flag_delivery);
                            $produto->setPosicao($result->pro_posicao);
                            $produto->setAdicional($result->pro_arr_adicional);
                            $produto->setDias_semana($result->pro_arr_dias_semana);
                            $produto->setCategoria($result->cat_nome);
                            
                            //atribuição por referencia
                            $produto->pk_composicao = $result->com_pk_id;

                            array_push($produtos, $produto);
                        }
                    }else{
                        return NULL;
                    }
                    return $produtos;
                }else{
                    return NULL;
                }
            }
            catch(PDOException $e){
                echo $e->getMessage();
            }
        }

        function selectAllByPos(){
            $produtos = array();
            try{
                $stmte = $this->pdo->prepare("SELECT *
                FROM tb_produto AS PRO
                LEFT JOIN tb_categoria AS CAT
                ON PRO.pro_fk_categoria = CAT.cat_pk_id
                ORDER BY CAT.posicao ASC, PRO.posicao ASC");
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
                            $produto->setFlag_ativo($result->pro_flag_ativo);
                            $produto->setFlag_servindo($result->pro_flag_servindo);
                            $produto->setPrioridade($result->pro_flag_prioridade);
                            $produto->setDelivery($result->pro_flag_delivery);
                            $produto->setPosicao($result->pro_posicao);
                            $produto->setDias_semana($result->pro_arr_dias_semana);

                            $produto->categoria = $result->cat_nome;
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

        function selectByCategoriaByPos($fk_categoria){
            $produtos = array();
            try{
                $stmte = $this->pdo->prepare("SELECT *
                FROM tb_produto AS PRO
                LEFT JOIN tb_categoria AS CAT
                ON PRO.pro_fk_categoria = CAT.cat_pk_id
                WHERE PRO.pro_fk_categoria = :fk_categoria
                AND PRO.pro_flag_deletado = 0
                ORDER BY CAT.cat_posicao ASC, PRO.pro_posicao ASC");

                $stmte->bindValue(":fk_categoria", $fk_categoria , PDO::PARAM_INT);

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
                            $produto->setFlag_ativo($result->pro_flag_ativo);
                            $produto->setFlag_servindo($result->pro_flag_servindo);
                            $produto->setPrioridade($result->pro_flag_prioridade);
                            $produto->setDelivery($result->pro_flag_delivery);
                            $produto->setPosicao($result->pro_posicao);
                            $produto->setDias_semana($result->pro_arr_dias_semana);

                            $produto->categoria = $result->cat_nome;
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

        function selectPrint($fk_categoria){
            $produtos = array();
            try{
                $stmte = $this->pdo->prepare("SELECT *
                FROM tb_produto AS PRO
                LEFT JOIN tb_categoria AS CAT
                ON PRO.pro_fk_categoria = CAT.cat_pk_id
                WHERE PRO.pro_fk_categoria = :fk_categoria
                AND PRO.pro_flag_deletado = 0
                AND PRO.pro_flag_ativo = 1
                ORDER BY CAT.cat_posicao ASC, PRO.pro_posicao ASC");

                $stmte->bindValue(":fk_categoria", $fk_categoria , PDO::PARAM_INT);

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
                            $produto->setFlag_ativo($result->pro_flag_ativo);
                            $produto->setFlag_servindo($result->pro_flag_servindo);
                            $produto->setPrioridade($result->pro_flag_prioridade);
                            $produto->setDelivery($result->pro_flag_delivery);
                            $produto->setPosicao($result->pro_posicao);
                            $produto->setDias_semana($result->pro_arr_dias_semana);

                            $produto->categoria = $result->cat_nome;
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


        function selectPrintAll($fk_categoria){
            $produtos = array();
            try{
                $stmte = $this->pdo->prepare("SELECT *
                FROM tb_produto AS PRO
                LEFT JOIN tb_categoria AS CAT
                ON PRO.pro_fk_categoria = CAT.cat_pk_id
                WHERE PRO.pro_fk_categoria = :fk_categoria
                AND PRO.pro_flag_deletado = 0

                ORDER BY CAT.cat_posicao ASC, PRO.pro_posicao ASC");

                $stmte->bindValue(":fk_categoria", $fk_categoria , PDO::PARAM_INT);

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
                            $produto->setFlag_ativo($result->pro_flag_ativo);
                            $produto->setFlag_servindo($result->pro_flag_servindo);
                            $produto->setPrioridade($result->pro_flag_prioridade);
                            $produto->setDelivery($result->pro_flag_delivery);
                            $produto->setPosicao($result->pro_posicao);
                            $produto->setDias_semana($result->pro_arr_dias_semana);

                            $produto->categoria = $result->cat_nome;
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

        function selectByCategoriaFilterPos($fk_categoria, $filtro ,$flag_servindo){
            $produtos = array();
            try{
                if($flag_servindo == null && $flag_ativo == null){
                    $stmte = $this->pdo->prepare("SELECT *
                    FROM tb_produto AS PRO
                    LEFT JOIN tb_categoria AS CAT
                    ON PRO.pro_fk_categoria = CAT.cat_pk_id WHERE PRO.pro_fk_categoria = :fk_categoria AND PRO.pro_descricao LIKE :filtro AND PRO.pro_flag_deletado = 0
                    ORDER BY CAT.cat_posicao ASC, PRO.pro_posicao ASC");
                }else{
                    $stmte = $this->pdo->prepare("SELECT *
                    FROM tb_produto AS PRO
                    LEFT JOIN tb_categoria AS CAT
                    ON PRO.pro_fk_categoria = CAT.cat_pk_id
                    WHERE PRO.pro_fk_categoria = :fk_categoria AND PRO.pro_descricao LIKE :filtro AND PRO.pro_flag_servindo = :flag_servindo AND PRO.pro_flag_deletado = 0
                    ORDER BY CAT.cat_posicao ASC, PRO.pro_posicao ASC");
                    $stmte->bindValue(":flag_servindo", $flag_servindo , PDO::PARAM_INT);
                }
                
                $stmte->bindValue(":fk_categoria", $fk_categoria , PDO::PARAM_INT);
                $stmte->bindValue(":filtro", "%".$filtro."%" , PDO::PARAM_STR);

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
                            $produto->setFlag_ativo($result->pro_flag_ativo);
                            $produto->setFlag_servindo($result->pro_flag_servindo);
                            $produto->setPrioridade($result->pro_flag_prioridade);
                            $produto->setDelivery($result->pro_flag_delivery);
                            $produto->setPosicao($result->pro_posicao);
                            $produto->setDias_semana($result->pro_arr_dias_semana);
                            
                            //atribuição por referencia
                            $produto->setCategoria($result->cat_nome);
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

        function selectAllDelivery(){
            $produtos = array();
            try{
                $stmte = $this->pdo->prepare("SELECT *
                FROM tb_produto AS PRO
                LEFT JOIN tb_categoria AS CAT
                ON PRO.pro_fk_categoria = CAT.cat_pk_id WHERE pro_flag_delivery = 1");
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
                            $produto->setFlag_ativo($result->pro_flag_ativo);
                            $produto->setFlag_servindo($result->pro_flag_servindo);
                            $produto->setPrioridade($result->pro_flag_prioridade);
                            $produto->setDelivery($result->pro_flag_delivery);
                            $produto->setPosicao($result->pro_posicao);
                            $produto->setDias_semana($result->pro_arr_dias_semana);
                            
                            //atribuição por referencia
                            $produto->setCategoria($result->cat_nome);
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

        function insertHistoricoProduto($cod_produto, $produto){
            try{
                $stmte =$this->pdo->prepare("INSERT INTO tb_historico_produto SET hipr_valor = :valor, hipr_data = NOW(), hipr_fk_produto = :cod_produto");

                $stmte->bindValue(":valor", $produto->getPreco(), PDO::PARAM_INT);
                $stmte->bindValue(":cod_produto", $cod_produto);

                $executa = $stmte->execute();

                if($executa){
                    return 1;
                }else{
                    return -1;
                }
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
<?php
    include_once "../../config.php";
    include_once MODELPATH."/adicional.php";

    class controlerAdicional {
        private $pdo;
        function insert($adicional){
            try{
                $stmte =$this->pdo->prepare("INSERT INTO adicional(nome, preco, desconto, flag_ativo)
                VALUES (:nome, :preco, :desconto, :flag_ativo)");
                $stmte->bindParam(":nome", $adicional->getNome(), PDO::PARAM_STR);
                $stmte->bindParam(":preco", $adicional->getPreco());
                $stmte->bindParam(":desconto", $adicional->getDesconto());
                $stmte->bindParam(":flag_ativo", $adicional->getFlag_ativo());
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

        function update($adicional){
            try{
                $stmte =$this->pdo->prepare("UPDATE adicional SET nome=:nome, preco=:preco, desconto = :desconto, flag_ativo = :flag_ativo WHERE cod_adicional=:cod_adicional");
                $stmte->bindParam(":cod_adicional", $adicional->getCod_adicional() , PDO::PARAM_INT);
                $stmte->bindParam(":nome", $adicional->getNome(), PDO::PARAM_STR);
                $stmte->bindParam(":preco", $adicional->getPreco());
                $stmte->bindParam(":desconto", $adicional->getDesconto());
                $stmte->bindParam(":flag_ativo", $adicional->getFlag_ativo());
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

        function selectId($cod){
            $stmte;
            $adicional = new adicional();

            try{
                $stmte = $this->pdo->prepare("SELECT * FROM adicional WHERE cod_adicional = :cod");
                $stmte->bindParam(":cod", $cod , PDO::PARAM_INT);
                if($stmte->execute()){
                    if($stmte->rowCount() > 0){
                        while($result = $stmte->fetch(PDO::FETCH_OBJ)){
                            $adicional->setCod_adicional($result->cod_adicional);
                            $adicional->setNome($result->nome);
                            $adicional->setPreco($result->preco);
                            $adicional->setDesconto($result->desconto);  
                            $adicional->setFlag_ativo($result->flag_ativo); 
                        }
                    }
                }
                return $adicional;
            }
            catch(PDOException $e){
                echo $e->getMessage();
            }
        }

        function filter($parametro, $flag_ativo, $delivery, $prioridade){
            $stmte;
            try{
                $stmte = $this->pdo->prepare("SELECT A.cod_cardapio AS cod_cardapio, A.nome AS nome, A.preco AS preco, A.desconto AS desconto, A.descricao AS descricao, A.foto AS foto, A.flag_ativo AS flag_ativo, A.prioridade AS prioridade, A.delivery AS delivery, B.nome AS categoria FROM cardapio AS A inner join categoria AS B ON A.categoria = B.cod_categoria WHERE A.nome LIKE :parametro AND A.flag_ativo LIKE :flag_ativo AND A.delivery LIKE :delivery AND A.prioridade LIKE :prioridade");
                $stmte->bindValue(":parametro","%".$parametro."%");
                $stmte->bindValue(":flag_ativo","%" .$flag_ativo);
                $stmte->bindValue(":delivery","%".$delivery);
                $stmte->bindValue(":prioridade","%".$prioridade);
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

        function delete($parametro){
            try{
                $stmt = $this->pdo->prepare("UPDATE adicional SET flag_ativo = 0 WHERE cod_adicional = :parametro");
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
            $adicionais = array();
            try{
                $stmte = $this->pdo->prepare("SELECT * FROM adicional");
                if($stmte->execute()){
                    if($stmte->rowCount() > 0){
                        while($result = $stmte->fetch(PDO::FETCH_OBJ)){
                            $adicional = new adicional();
                            $adicional->setCod_adicional($result->cod_adicional);
                            $adicional->setNome($result->nome);
                            $adicional->setPreco($result->preco);
                            $adicional->setDesconto($result->desconto);
                            $adicional->setFlag_ativo($result->flag_ativo);
                            array_push($adicionais, $adicional);
                        }
                    }
                }
                return $adicionais;
            }
            catch(PDOException $e){
                echo $e->getMessage();
            }
        }

        function buscarVariosId($itens){
            $array = array();

            $sql = "SELECT * FROM adicional WHERE cod_adicional IN (".implode(',', $itens).")";
            // print_r($sql);
            // exit;
            $sql = $this->pdo->query($sql);

            if($sql -> rowCount() > 0){
                $array = $sql->fetchAll();
            }

            return $array;
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
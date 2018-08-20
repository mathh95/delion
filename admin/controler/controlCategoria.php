<?php
    include_once MODELPATH."/categoria.php";
    include_once "seguranca.php";

    protegePagina();

    class controlerCategoria {
        private $pdo;
        function insert($categoria){
            try{
                $stmte =$this->pdo->prepare("INSERT INTO categoria(nome, icone)
                VALUES (:nome, :icone)");
                $stmte->bindParam("nome", $categoria->getNome(), PDO::PARAM_STR);
                $stmte->bindParam("icone", $categoria->getIcone(), PDO::PARAM_STR);
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

        function update($categoria){
            try{
                $stmte =$this->pdo->prepare("UPDATE categoria SET nome=:nome, icone=:icone WHERE cod_categoria=:cod_categoria");
                $stmte->bindParam(":cod_categoria", $categoria->getCod_categoria() , PDO::PARAM_INT);
                $stmte->bindParam(":nome", $categoria->getNome(), PDO::PARAM_STR);
                $stmte->bindParam(":icone", $categoria->getIcone(), PDO::PARAM_STR);
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
            $categoria= new categoria();
            try{
                if($modo==1){
                    $stmte = $this->pdo->prepare("SELECT * FROM categoria WHERE nome LIKE :parametro");
                    $stmte->bindValue(":parametro", $parametro . "%" , PDO::PARAM_STR);
                }elseif ($modo==2) {
                    $stmte = $this->pdo->prepare("SELECT * FROM categoria WHERE cod_categoria = :parametro");
                    $stmte->bindParam(":parametro", $parametro , PDO::PARAM_INT);
                }
                if($stmte->execute()){
                    if($stmte->rowCount() > 0){
                        while($result = $stmte->fetch(PDO::FETCH_OBJ)){
                            $categoria->setCod_categoria($result->cod_categoria);
                            $categoria->setNome($result->nome);
                            $categoria->setIcone($result->icone);
                        }
                    }
                }
                return $categoria;
            }
            catch(PDOException $e){
                echo $e->getMessage();
            }
        }

        function delete($parametro){
            try{
                $stmt = $this->pdo->prepare("DELETE FROM categoria WHERE cod_categoria = :parametro");
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
            $categorias = array();
            try{
                $stmte = $this->pdo->prepare("SELECT * FROM categoria");
                if($stmte->execute()){
                    if($stmte->rowCount() > 0){
                        while($result = $stmte->fetch(PDO::FETCH_OBJ)){
                            $categoria= new categoria();
                            $categoria->setCod_categoria($result->cod_categoria);
                            $categoria->setNome($result->nome);
                            $categoria->setIcone($result->icone);
                            array_push($categorias, $categoria);
                        }
                    }
                }
                return $categorias;
            }
            catch(PDOException $e){
                echo $e->getMessage();
            }
        }

        function countCategoria(){
            $stmte;
            try{
                $stmte = $this->pdo->prepare("SELECT COUNT(*) AS categorias FROM categoria");
                $stmte->execute();
                $result = $stmte->fetch(PDO::FETCH_OBJ);
                return $result->categorias;
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
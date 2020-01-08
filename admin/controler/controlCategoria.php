<?php
    include_once MODELPATH."/categoria.php";
    include_once "seguranca.php";

    protegePagina();

    class controlerCategoria {
        private $pdo;
        function insert($categoria){
            try{
                $stmte =$this->pdo->prepare("INSERT INTO tb_categoria(cat_nome, cat_icone)
                VALUES (:cat_nome, :cat_icone)");
                $stmte->bindParam("cat_nome", $categoria->getNome(), PDO::PARAM_STR);
                $stmte->bindParam("cat_icone", $categoria->getIcone(), PDO::PARAM_STR);
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
                $stmte =$this->pdo->prepare("UPDATE tb_categoria SET cat_nome=:nome, cat_icone=:icone WHERE cat_pk_id=:cod_categoria");
                $stmte->bindParam(":cod_categoria", $categoria->getPkId() , PDO::PARAM_INT);
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

        function updatePos($cat_pk_id, $cat_posicao){
            try{
                $stmte =$this->pdo->prepare("UPDATE tb_categoria SET cat_posicao=:cat_posicao WHERE cat_pk_id=:cat_pk_id");

                $stmte->bindParam(":cod_categoria", $cat_pk_id, PDO::PARAM_INT);
                $stmte->bindParam(":cat_posicao", $cat_posicao, PDO::PARAM_INT);
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

            $categoria= new categoria();
            try{
                if($modo==1){
                    $stmte = $this->pdo->prepare("SELECT * FROM tb_categoria WHERE cat_nome LIKE :parametro");
                    $stmte->bindValue(":parametro", $parametro . "%" , PDO::PARAM_STR);
                }elseif ($modo==2) {
                    $stmte = $this->pdo->prepare("SELECT * FROM tb_categoria WHERE cat_pk_id = :parametro");
                    $stmte->bindParam(":parametro", $parametro , PDO::PARAM_INT);
                }
                if($stmte->execute()){
                    if($stmte->rowCount() > 0){
                        while($result = $stmte->fetch(PDO::FETCH_OBJ)){
                            $categoria->setPkId($result->cat_pk_id);
                            $categoria->setNome($result->cat_nome);
                            $categoria->setIcone($result->cat_icone);
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
                $stmt = $this->pdo->prepare("DELETE FROM tb_categoria WHERE cat_pk_id = :parametro");
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

            $categorias = array();
            try{
                $stmte = $this->pdo->prepare("SELECT * FROM tb_categoria");
                if($stmte->execute()){
                    if($stmte->rowCount() > 0){
                        while($result = $stmte->fetch(PDO::FETCH_OBJ)){
                            $categoria= new categoria();
                            $categoria->setPkId($result->cat_pk_id);
                            $categoria->setNome($result->cat_nome);
                            $categoria->setIcone($result->cat_icone);
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

        function selectAllByPos(){
            $categorias = array();
            try{
                $stmte = $this->pdo->prepare("SELECT * FROM tb_categoria ORDER BY cat_posicao ASC");
                if($stmte->execute()){
                    if($stmte->rowCount() > 0){
                        while($result = $stmte->fetch(PDO::FETCH_OBJ)){
                            $categoria= new categoria();
                            $categoria->setPkId($result->cat_pk_id);
                            $categoria->setNome($result->cat_nome);
                            $categoria->setIcone($result->cat_icone);
                            $categoria->setPosicao($result->cat_posicao);
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

            try{
                $stmte = $this->pdo->prepare("SELECT COUNT(*) AS categorias FROM tb_categoria");
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
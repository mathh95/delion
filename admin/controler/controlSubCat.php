<?php
    include_once MODELPATH."/subcat.php";
    include_once "seguranca.php";

    protegePagina();

    class controlerSubCat {
        private $pdo;

        function insert($subcat){
            try{
                    $stmte =$this->pdo->prepare("INSERT INTO tb_subcategoria(sub_cat_nome, sub_cat_icone, sub_cat_fk_cat)
                    VALUES (:nome, :fk_categoria , :icone)");
                    $stmte->bindParam("nome", $subcat->getNome(), PDO::PARAM_STR);
                    $stmte->bindParam("fk_categoria", $subcat->getFkcategoria(), PDO::PARAM_INT);
                    $stmte->bindParam("icone", $subcat->getIcone(), PDO::PARAM_STR);
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


        
        function update($subcat){
            try{
                $stmte =$this->pdo->prepare("UPDATE tb_subcategoria SET sub_cat_nome=:nome, sub_cat_icone=:icone, sub_cat_fk_cat=:categoria WHERE sub_cat_pk_id=:cod_sub_categoria");
                $stmte->bindParam(":cod_sub_categoria", $subcat->getPkId() , PDO::PARAM_INT);
                $stmte->bindParam(":nome", $subcat->getNome(), PDO::PARAM_STR);
                $stmte->bindParam(":icone", $subcat->getIcone(), PDO::PARAM_STR);
                $stmte->bindParam(":categoria", $subcat->getFkcategoria(), PDO::PARAM_INT);
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

        function updatePos($pk_id, $cat_posicao){
            try{
                $stmte =$this->pdo->prepare("UPDATE tb_categoria SET cat_posicao=:posicao WHERE cat_pk_id=:pk_id");

                $stmte->bindParam(":pk_id", $pk_id, PDO::PARAM_INT);
                $stmte->bindParam(":posicao", $cat_posicao, PDO::PARAM_INT);
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


        function verificaIgual($parametro){
            $categoria= new categoria();
            try{
                $stmte = $this->pdo->prepare("SELECT * FROM tb_categoria WHERE cat_nome = :parametro");
                $stmte->bindValue(":parametro", $parametro, PDO::PARAM_STR);
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

        /*
          modo: 1-Nome, 2-id
        */
        function select($parametro,$modo){

            $subcategoria= new subcat();
            try{
                if($modo==1){
                    $stmte = $this->pdo->prepare("SELECT * FROM tb_subcategoria WHERE sub_cat_nome LIKE :parametro");
                    $stmte->bindValue(":parametro", $parametro . "%" , PDO::PARAM_STR);
                }elseif ($modo==2) {
                    $stmte = $this->pdo->prepare("SELECT * FROM tb_subcategoria WHERE sub_cat_pk_id = :parametro");
                    $stmte->bindParam(":parametro", $parametro , PDO::PARAM_INT);
                }
                if($stmte->execute()){
                    if($stmte->rowCount() > 0){
                        while($result = $stmte->fetch(PDO::FETCH_OBJ)){
                            $subcategoria->setPkId($result->sub_cat_pk_id);
                            $subcategoria->setNome($result->sub_cat_nome);
                            $subcategoria->setIcone($result->sub_cat_icone);
                        }
                    }
                }
                return $subcategoria;
            }
            catch(PDOException $e){
                echo $e->getMessage();
            }
        }

        function delete($parametro){
            try{
                $stmt = $this->pdo->prepare("DELETE FROM tb_subcategoria WHERE sub_cat_pk_id = :parametro");
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
            $subcategorias = array();
            try{
                $stmte = $this->pdo->prepare("SELECT * FROM tb_subcategoria");
                if($stmte->execute()){
                    if($stmte->rowCount() > 0){
                        while($result = $stmte->fetch(PDO::FETCH_OBJ)){
                            $subCategoria= new subcat();
                            $subCategoria->setPkId($result->sub_cat_pk_id);
                            $subCategoria->setNome($result->sub_cat_nome);
                            $subCategoria->setIcone($result->sub_cat_icone);
                            $subCategoria->setFkCategoria($result->sub_cat_fk_cat);
                            array_push($subcategorias, $subCategoria);
                        }
                    }
                }
                return $subcategorias;
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
                    }else{
                        return NULL;
                    }
                    return $categorias;
                }else{
                    return NULL;
                }
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
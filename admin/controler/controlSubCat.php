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
                            $subcategoria->setFkCategoria($result->sub_cat_fk_cat);
                        }
                    }
                }
                return $subcategoria;
            }
            catch(PDOException $e){
                echo $e->getMessage();
            }
        }

        function selectByFkCategoria($parametro,$modo){

            $subcategoria= new subcat();
            try{
                if($modo==1){
                    $stmte = $this->pdo->prepare("SELECT * FROM tb_subcategoria WHERE sub_cat_nome LIKE :parametro");
                    $stmte->bindValue(":parametro", $parametro . "%" , PDO::PARAM_STR);
                }elseif ($modo==2) {
                    $stmte = $this->pdo->prepare("SELECT * FROM tb_subcategoria WHERE sub_cat_fk_cat = :parametro");
                    $stmte->bindParam(":parametro", $parametro , PDO::PARAM_INT);
                }
                if($stmte->execute()){
                    if($stmte->rowCount() > 0){
                        while($result = $stmte->fetch(PDO::FETCH_OBJ)){
                            $subcategoria->setPkId($result->sub_cat_pk_id);
                            $subcategoria->setNome($result->sub_cat_nome);
                            $subcategoria->setIcone($result->sub_cat_icone);
                            $subcategoria->setFkCategoria($result->sub_cat_fk_cat);
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

        function __construct($pdo){
            $this->pdo=$pdo;
        }
    }
?>
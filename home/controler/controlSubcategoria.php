<?php

    include_once MODELPATH."/subcat.php";


    class controlerSubcategoria {

        private $pdo;

        function selectSubCatAssociada($parametro){

            $subcategorias = array();

            try{
                $stmte=$this->pdo->prepare("SELECT * FROM tb_subcategoria WHERE sub_cat_fk_cat = :parametro");
                $stmte->bindParam(":parametro", $parametro, PDO::PARAM_INT);

                if($stmte->execute()){
                    if($stmte->rowCount() > 0){
                        while($result = $stmte->fetch(PDO::FETCH_OBJ)){
                            $subcategoria = new subcat();
                            $subcategoria->setPkId($result->sub_cat_pk_id);
                            $subcategoria->setNome($result->sub_cat_nome);
                            $subcategoria->setFkCategoria($result->sub_cat_fk_cat);
                            array_push($subcategorias, $subcategoria);
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
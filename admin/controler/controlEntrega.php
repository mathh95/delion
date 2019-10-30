<?php
    include_once $_SERVER['DOCUMENT_ROOT']."/config.php"; 
    include_once MODELPATH. "/entrega.php";
    include_once CONTROLLERPATH."/seguranca.php";
    
    protegePagina("carrinho_call");//flag de exceção, permite acessar control sem login

    class controlEntrega{
        private $pdo;

        function insert($entrega){
            try{
                $tempo=$entrega->getTempo();
                $raio_km=$entrega->getRaio_km();
                $taxa_entrega=$entrega->getTaxa_entrega();
                $valor_minimo=$entrega->getValor_minimo();
                $min_taxa_gratis=$entrega->getMin_taxa_gratis();
                $flag_ativo=$entrega->getFlag_ativo();

                $stmt=$this->pdo->prepare("INSERT INTO entrega(tempo, raio_km, taxa_entrega, valor_minimo, min_taxa_gratis, flag_ativo) VALUES (:tempo, :raio_km, :taxa_entrega, :valor_minimo, :min_taxa_gratis, :flag_ativo)");
                
                $stmt->bindParam(":tempo",$tempo, PDO::PARAM_INT);
                $stmt->bindParam(":raio_km",$raio_km, PDO::PARAM_INT);
                $stmt->bindParam(":taxa_entrega",$taxa_entrega, PDO::PARAM_STR);
                $stmt->bindParam(":valor_minimo",$valor_minimo, PDO::PARAM_STR);
                $stmt->bindParam(":min_taxa_gratis",$min_taxa_gratis, PDO::PARAM_STR);
                $stmt->bindParam(":flag_ativo",$flag_ativo, PDO::PARAM_INT);
        
                $executa = $stmt->execute();

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
    function update($entrega){
        try{
            
            $stmt=$this->pdo->prepare("UPDATE entrega SET tempo=:tempo, raio_km=:raio_km, taxa_entrega=:taxa_entrega, valor_minimo=:valor_minimo, min_taxa_gratis=:min_taxa_gratis, flag_ativo=:flag_ativo WHERE cod_entrega=:cod_entrega");
            
            $cod_entrega = $entrega->getCod_entrega();
            $tempo  = $entrega->getTempo();
            $raio_km = $entrega->getRaio_km();
            $taxa_entrega = $entrega->getTaxa_entrega();
            $valor_minimo=$entrega->getValor_minimo();
            $min_taxa_gratis = $entrega->getMin_taxa_gratis();
            $flag_ativo = $entrega->getFlag_ativo();

            $stmt->bindParam(":cod_entrega", $cod_entrega, PDO::PARAM_INT);
            $stmt->bindParam(":tempo", $tempo, PDO::PARAM_INT);
            $stmt->bindParam(":raio_km", $raio_km, PDO::PARAM_INT);
            $stmt->bindParam(":taxa_entrega", $taxa_entrega, PDO::PARAM_STR);
            $stmt->bindParam(":valor_minimo", $valor_minimo, PDO::PARAM_STR);
            $stmt->bindParam(":min_taxa_gratis", $min_taxa_gratis, PDO::PARAM_STR);
            $stmt->bindParam(":flag_ativo",$flag_ativo, PDO::PARAM_INT);

            $executa = $stmt->execute();
            
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
    function select($parametro){
        $stmt;
        $entrega = new entrega;
        try{
            
            $cod_entrega=$parametro;
            $stmt=$this->pdo->prepare("SELECT * FROM entrega WHERE cod_entrega=:parametro");
            $stmt->bindParam(":parametro", $cod_entrega, PDO::PARAM_INT);
           
            $executa=$stmt->execute();
            if ($executa){
                if($stmt->rowCount() > 0){
                    while($result=$stmt->fetch(PDO::FETCH_OBJ)){
                        $entrega = new entrega;

                        $entrega->setCod_entrega($result->cod_entrega);
                        $entrega->setTempo($result->tempo);
                        $entrega->setRaio_km($result->raio_km);
                        $entrega->setTaxa_entrega($result->taxa_entrega);
                        $entrega->setValor_minimo($result->valor_minimo);
                        $entrega->setMin_taxa_gratis($result->min_taxa_gratis);
                        $entrega->setFlag_ativo($result->flag_ativo);
                    }
                }
                return $entrega;
            }else{
                return -1;
            }
        }
        catch(PDOException $e){
            echo $e->getMessage();
            return -1;
        }
    }

    function selectAll(){
        try{
            $entregas = array();

            $stmt=$this->pdo->prepare("SELECT * FROM entrega ORDER BY raio_km ASC");
            $executa = $stmt->execute();

            if($executa){
                if($stmt->rowCount() > 0){

                    while($result=$stmt->fetch(PDO::FETCH_OBJ)){
                        $entrega = new entrega();
                        $entrega->setCod_entrega($result->cod_entrega);
                        $entrega->setTempo($result->tempo);
                        $entrega->setRaio_km($result->raio_km);
                        $entrega->setTaxa_entrega($result->taxa_entrega);
                        $entrega->setValor_minimo($result->valor_minimo);
                        $entrega->setMin_taxa_gratis($result->min_taxa_gratis);
                        $entrega->setFlag_ativo($result->flag_ativo);
                        array_push($entregas, $entrega);
                    }
                }else{
                    // echo "Sem resultados";
                    return -1;
                }
                return $entregas;
            }else{
                return -1;
            }
        }
        catch(PDOException $e){
            echo $e->getMessage();
            return -1;
        }
    }

    function selectByDist($dist){
        $entrega = new entrega;
        try{
                        
            $stmt=$this->pdo->prepare("SELECT * FROM `entrega` WHERE raio_km >= :dist AND flag_ativo = 1 ORDER BY raio_km ASC LIMIT 0,1");
            $stmt->bindParam(":dist", $dist, PDO::PARAM_INT);
           
            $executa=$stmt->execute();
            if ($executa){
                if($stmt->rowCount() > 0){
                    while($result=$stmt->fetch(PDO::FETCH_OBJ)){
                        $entrega = new entrega;

                        $entrega->setCod_entrega($result->cod_entrega);
                        $entrega->setTempo($result->tempo);
                        $entrega->setRaio_km($result->raio_km);
                        $entrega->setTaxa_entrega($result->taxa_entrega);
                        $entrega->setValor_minimo($result->valor_minimo);
                        $entrega->setMin_taxa_gratis($result->min_taxa_gratis);
                        $entrega->setFlag_ativo($result->flag_ativo);
                    }
                }else{
                    return -1;
                }
                return $entrega;
            }else{
                return -1;
            }
        }
        catch(PDOException $e){
            echo $e->getMessage();
            return -1;
        }
    }

    function delete($cod_entrega){
        try{
            $stmte =$this->pdo->prepare("DELETE FROM entrega WHERE cod_entrega=:cod_entrega");
            $stmte->bindParam(":cod_entrega", $cod_entrega , PDO::PARAM_INT);
            
            if ($stmte->execute()) {
               if($stmte->rowCount() > 0){
                return 1;
               }else{
                    return -1;
               }
            }else {
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
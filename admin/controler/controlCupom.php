<?php
    include_once $_SERVER['DOCUMENT_ROOT']."/config.php"; 
    include_once MODELPATH. "/cupom.php";
    include_once CONTROLLERPATH."/seguranca.php";
    protegePagina();

    class controlCupom{
        private $pdo;

        function insert($cupom){
            try{
                $codigo=$cupom->getCodigo();
                $qtde_inicial=$cupom->getQtde_inicial();
                $qtde_atual=$cupom->getQtde_atual();
                $valor=$cupom->getValor();
                $vencimento_data=$cupom->getVencimento_data();
                $vencimento_hora=$cupom->getVencimento_hora();
                $status = $cupom->getStatus();
                $stmt=$this->pdo->prepare("INSERT INTO cupom(codigo, qtde_inicial, qtde_atual, valor, vencimento_data, vencimento_hora, status) VALUES (:codigo, :qtde_inicial, :qtde_atual, :valor, :vencimento_data, :vencimento_hora, :status)");
                $stmt->bindParam(":codigo",$codigo, PDO::PARAM_STR);
                $stmt->bindParam(":qtde_inicial",$qtde_inicial, PDO::PARAM_INT);
                $stmt->bindParam(":qtde_atual",$qtde_atual, PDO::PARAM_INT);
                $stmt->bindParam(":valor",$valor, PDO::PARAM_STR);
                $stmt->bindParam(":vencimento_data", $vencimento_data, PDO::PARAM_STR);
                $stmt->bindParam(":vencimento_hora", $vencimento_hora, PDO::PARAM_STR);
                $stmt->bindParam(":status",$status, PDO::PARAM_INT);
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
    function update($cupom){
        try{
            $stmt=$this->pdo->prepare("UPDATE cupom SET valor=:valor, vencimento_data=:vencimento_data, vencimento_hora=:vencimento_hora WHERE cod_cupom=:cod_cupom");
            $stmt->bindParam(":cod_cupom",$cupom->getCod_cupom(), PDO::PARAM_INT);
            $stmt->bindParam(":valor",$cupom->getValor(), PDO::PARAM_STR);
            $stmt->bindParam(":vencimento_data",$cupom->getVencimento_data(), PDO::PARAM_STR);
            $stmt->bindParam(":vencimento_hora", $cupom->getVencimento_hora(), PDO::PARAM_STR);
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
        $cupom= new cupom;
        try{
            
            $cod_cupom=$parametro;
            $stmt=$this->pdo->prepare("SELECT * FROM cupom WHERE cod_cupom=:parametro");
            $stmt->bindParam(":parametro", $cod_cupom, PDO::PARAM_INT);
           
            $executa=$stmt->execute();
            if ($executa){
                if($stmt->rowCount() > 0){
                    while($result=$stmt->fetch(PDO::FETCH_OBJ)){
                        $cupom = new cupom;
                        $cupom->setCod_Cupom($result->cod_cupom);
                        $cupom->setCodigo($result->codigo);
                        $cupom->setQtde_inicial($result->qtde_inicial);
                        $cupom->setQtde_atual($result->qtde_atual);
                        $cupom->setValor($result->valor);
                        $cupom->setVencimento_data($result->vencimento_data);
                        $cupom->setVencimento_hora($result->vencimento_hora);
                        $cupom->setStatus($result->status);
                    }
                }
                return $cupom;
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
            $cupons = array();
            $stmt=$this->pdo->prepare("SELECT * FROM cupom ORDER BY status ASC, cod_cupom ASC");
            $executa = $stmt->execute();
            if($executa){
                if($stmt->rowCount() > 0){
                    while($result=$stmt->fetch(PDO::FETCH_OBJ)){
                        $cupom = new cupom();
                        $cupom->setCod_Cupom($result->cod_cupom);
                        $cupom->setCodigo($result->codigo);
                        $cupom->setQtde_inicial($result->qtde_inicial);
                        $cupom->setQtde_atual($result->qtde_atual);
                        $cupom->setValor($result->valor);
                        $cupom->setVencimento_data($result->vencimento_data);
                        $cupom->setVencimento_hora($result->vencimento_hora);
                        $cupom->setStatus($result->status);
                        array_push($cupons, $cupom);
                    }
                }else{
                    // echo "Sem resultados";
                    return -1;
                }
                return $cupons;
            }else{
                return -1;
            }
        }
        catch(PDOException $e){
            echo $e->getMessage();
            return -1;
        }
    }
    

    function updateStatusCancel($cod_cupom,$status){
        try{
            if($status == 1){
                $parametro=$cod_cupom;
                $stmt=$this->pdo->prepare("UPDATE cupom SET status= 4 WHERE cod_cupom=:parametro");
                $stmt->bindParam(":parametro",$parametro,PDO::PARAM_INT);
                $stmt->execute();
                return 1;
            }else {
                return 0;
            }
        }catch(PDOException $e){
            return $e->getMessage();
        }
    }
    function __construct($pdo){
        $this->pdo=$pdo;
    }
}
?>
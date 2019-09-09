<?php
    include_once MODELPATH. "/cupom.php";
    include_once "seguranca.php";
    protegePagina();

    class controlerCupom{
        private $pdo;
        function insert($cupom){
            try{
                $codigo=$cupom->getCodigo();
                $quantidade=$cupom->getQuantidade();
                $valor=$cupom->getValor();
                $stmt =$this->pdo->prepare("INSERT INTO cupom(codigo, quantidade, valor) VALUES (:codigo, :quantidade, :valor)");
                $stmt->bindParam(":codigo",$codigo, PDO::PARAM_STR);
                $stmt->bindParam(":quantidade",$quantidade, PDO::PARAM_INT);
                $stmt->bindParam(":valor",$valor, PDO::PARAM_INT);
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
            $stmt=$this->pdo->prepare("UPDATE cupom SET codigo=:codigo, quantidade=:quantidade, valor=:valor WHERE cod_cupom=:cod_cupom");
            $stmt->bindParam(":cod_cupom",$cupom->getCod_cupom(), PDO::PARAM_INT);
            $stmt->bindParam(":codigo",$cupom->getCodigo(), PDO::PARAM_STR);
            $stmt->bindParam(":quantidade",$cupom->getQuantidade(), PDO::PARAM_INT);
            $stmt->bindParam(":valor",$cupom->getValor(), PDO::PARAM_INT);
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
    //
    function selectAll(){
        try{
            $cupons = array();
            $stmt=$this->pdo->prepare("SELECT * FROM cupom");
            $executa = $stmt->execute();
            if($executa){
                if($stmt->rowCount() > 0){
                    while($result=$stmt->fetch(PDO::FETCH_OBJ)){
                        $cupom = new cupom();
                        $cupom->setCod_Cupom($result->cod_cliente);
                        $cupom->setCodigo($result->codigo);
                        $cupom->setQuantidade($result->quantidade);
                        $cupom->setValor($result->valor);
                    }
                }else{
                    echo "Sem resultados";
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
}
?>
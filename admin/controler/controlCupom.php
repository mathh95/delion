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
                $stmte =$this->pdo->prepare("INSERT INTO cupom(codigo, quantidade, valor) VALUES (:codigo, :quantidade, :valor)");
                $stmte->bindParam(":codigo",$codigo, PDO::PARAM_STR);
                $stmte->bindParam(":quantidade",$quantidade, PDO::PARAM_INT);
                $stmte->bindParam(":valor",$valor, PDO::PARAM_INT);
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
    function update($cupom){
        try{
            $stmte=$this->pdo->prepare("UPDATE cupom SET codigo=:codigo, quantidade=:quantidade, valor=:valor WHERE cod_cupom=:cod_cupom");
            $stmte->bindParam(":cod_cupom",$cupom->getCod_cupom(), PDO::PARAM_INT);
            $stmte->bindParam(":codigo",$cupom->getCodigo(), PDO::PARAM_STR);
            $stmte->bindParam(":quantidade",$cupom->getQuantidade(), PDO::PARAM_INT);
            $stmte->bindParam(":valor",$cupom->getValor(), PDO::PARAM_INT);
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

}
?>
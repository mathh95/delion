<?php
    include_once $_SERVER['DOCUMENT_ROOT']."/config.php"; 
    include_once MODELPATH. "/cupom.php";
    include_once CONTROLLERPATH."/seguranca.php";
    
    protegePagina("cross_call");//flag de exceção, permite acessar control sem login

    class controlCupom{
        private $pdo;

        function insert($cupom){
            try{
                $codigo=$cupom->getCodigo();
                $qtde_inicial=$cupom->getQtde_inicial();
                $valor=$cupom->getValor();
                $valor_minimo=$cupom->getValor_minimo();
                $qtde_atual=$cupom->getQtde_atual();
                $vencimento_data=$cupom->getVencimento_data();
                $vencimento_hora=$cupom->getVencimento_hora();
                $status = $cupom->getStatus();

                $stmt=$this->pdo->prepare("INSERT INTO tb_cupom(cup_codigo, cup_qtde_inicial, cup_qtde_atual, cup_valor, cup_valor_minimo, cup_vencimento_data, cup_vencimento_hora, cup_status) VALUES (:codigo, :qtde_inicial, :qtde_atual, :valor, :valor_minimo,  :vencimento_data, :vencimento_hora, :status)");

                $stmt->bindParam(":codigo",$codigo, PDO::PARAM_STR);
                $stmt->bindParam(":qtde_inicial",$qtde_inicial, PDO::PARAM_INT);
                $stmt->bindParam(":qtde_atual",$qtde_atual, PDO::PARAM_INT);
                $stmt->bindParam(":valor",$valor, PDO::PARAM_STR);
                $stmt->bindParam(":valor_minimo",$valor_minimo, PDO::PARAM_STR);
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
            $stmt=$this->pdo->prepare("UPDATE tb_cupom SET cup_valor=:valor, cup_valor_minimo=:valor_minimo, cup_vencimento_data=:vencimento_data, cup_vencimento_hora=:vencimento_hora WHERE cup_pk_id=:pk_id");
            $stmt->bindParam(":pk_id",$cupom->getPkId(), PDO::PARAM_INT);
            $stmt->bindParam(":valor",$cupom->getValor(), PDO::PARAM_STR);
            $stmt->bindParam(":valor_minimo",$cupom->getValor_minimo(), PDO::PARAM_STR);
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
    function selectByPk($cup_pk_id){

        $cupom = new cupom;
        try{
            
            $stmt=$this->pdo->prepare("SELECT * FROM tb_cupom WHERE cup_pk_id=:cup_pk_id");
            $stmt->bindParam(":cup_pk_id", $cup_pk_id, PDO::PARAM_INT);
           
            $executa=$stmt->execute();
            if ($executa){
                if($stmt->rowCount() > 0){
                    while($result=$stmt->fetch(PDO::FETCH_OBJ)){

                        $cupom = new cupom;
                        $cupom->setPkId($result->cup_pk_id);
                        $cupom->setCodigo($result->cup_codigo);
                        $cupom->setQtde_inicial($result->cup_qtde_inicial);
                        $cupom->setQtde_atual($result->cup_qtde_atual);
                        $cupom->setValor($result->cup_valor);
                        $cupom->setValor_minimo($result->cup_valor_minimo);
                        $cupom->setVencimento_data($result->cup_vencimento_data);
                        $cupom->setVencimento_hora($result->cup_vencimento_hora);
                        $cupom->setStatus($result->cup_status);
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

    function selectPorCodigo($codigo_inserido){

        $cupom = new cupom;
        try{
            
            $stmt=$this->pdo->prepare("SELECT * FROM tb_cupom WHERE cup_codigo=:codigo_inserido");
            $stmt->bindParam(":codigo_inserido", $codigo_inserido, PDO::PARAM_INT);
           
            $executa=$stmt->execute();
            if ($executa){
                if($stmt->rowCount() > 0){
                    while($result=$stmt->fetch(PDO::FETCH_OBJ)){
                        $cupom = new cupom;
                        $cupom->setPkId($result->cup_pk_id);
                        $cupom->setCodigo($result->cup_codigo);
                        $cupom->setQtde_inicial($result->cup_qtde_inicial);
                        $cupom->setQtde_atual($result->cup_qtde_atual);
                        $cupom->setValor($result->cup_valor);
                        $cupom->setValor_minimo($result->cup_valor_minimo);
                        $cupom->setVencimento_data($result->cup_vencimento_data);
                        $cupom->setVencimento_hora($result->cup_vencimento_hora);
                        $cupom->setStatus($result->cup_status);
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
            $stmt=$this->pdo->prepare("SELECT * FROM tb_cupom ORDER BY cup_status ASC, cup_pk_id ASC");
            $executa = $stmt->execute();
            if($executa){
                if($stmt->rowCount() > 0){
                    while($result=$stmt->fetch(PDO::FETCH_OBJ)){

                        $cupom = new cupom();
                        $cupom->setPkId($result->cup_pk_id);
                        $cupom->setCodigo($result->cup_codigo);
                        $cupom->setQtde_inicial($result->cup_qtde_inicial);
                        $cupom->setQtde_atual($result->cup_qtde_atual);
                        $cupom->setValor($result->cup_valor);
                        $cupom->setValor_minimo($result->cup_valor_minimo);
                        $cupom->setVencimento_data($result->cup_vencimento_data);
                        $cupom->setVencimento_hora($result->cup_vencimento_hora);
                        $cupom->setStatus($result->cup_status);
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
    

    function updateStatusCancel($cod_cupom, $status){
        try{
            if($status == 1){
                
                $parametro=$cod_cupom;

                $stmt=$this->pdo->prepare("UPDATE tb_cupom SET cup_status= 4 WHERE cup_pk_id=:parametro");
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
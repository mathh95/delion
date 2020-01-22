<?php

include_once $_SERVER['DOCUMENT_ROOT']."/config.php"; 
include_once MODELPATH. "/cliente_cupom.php";
include_once CONTROLLERPATH."/seguranca.php";
protegePagina("cross_call");

class controlClienteCupom{
    private $pdo;


function selectByFkCod($fk_cliente, $codigo_cupom){

    $cliente_cupom = new cliente_cupom;
    try{
        
        $stmt=$this->pdo->prepare("SELECT * FROM rl_cliente_cupom AS CLCU
        INNER JOIN tb_cupom AS CUP
        ON CLCU.clcu_fk_cupom = CUP.cup_pk_id
        INNER JOIN tb_cliente AS CLI 
        ON CLCU.clcu_fk_cliente = CLI.cli_pk_id
        WHERE CLCU.clcu_fk_cliente =:fk_cliente AND CUP.cup_codigo=:codigo_cupom");
        $stmt->bindParam(":fk_cliente", $fk_cliente, PDO::PARAM_INT);
        $stmt->bindParam(":codigo_cupom", $codigo_cupom, PDO::PARAM_STR);
       
        $executa=$stmt->execute();
        if ($executa){
            if($stmt->rowCount() > 0){
                while($result=$stmt->fetch(PDO::FETCH_OBJ)){
                    $cliente_cupom = new cliente_cupom();
                    $cliente_cupom->setFkCliente($result->clcu_fk_cliente);
                    $cliente_cupom->setFkCupom($result->clcu_fk_cupom);
                    $cliente_cupom->setUltimo_uso($result->clcu_ultimo_uso);
                }
            }
            return $cliente_cupom;
        }else{
            return -1;
        }
    }
    catch(PDOException $e){
        echo $e->getMessage();
        return -1;
    }
}    

function selectUltimaDataUso($fk_cliente){

    $cliente_cupom = new cliente_cupom;

    try{

        $stmt=$this->pdo->prepare("SELECT * FROM rl_cliente_cupom 
        WHERE clcu_fk_cliente=:fk_cliente AND DATE(clcu_ultimo_uso) = CURDATE()");
        $stmt->bindParam(":fk_cliente", $fk_cliente, PDO::PARAM_INT);
       
        $executa=$stmt->execute();
        if ($executa){
            if($stmt->rowCount() > 0){
                $cliente_cupom = new cliente_cupom();

                $result=$stmt->fetch(PDO::FETCH_OBJ);
                $cliente_cupom->setFkCliente($result->clcu_fk_cliente);
                $cliente_cupom->setFkCupom($result->clcu_fk_cupom);
                $cliente_cupom->setUltimo_uso($result->clcu_ultimo_uso);
            }
            return $cliente_cupom;
        }else{
            return -1;
        }
    }catch(PDOException $e){
        echo $e->getMessage();
        exit;
    }
}    


function selectAll(){

        try{
            $cliente_cupom = array();

            $stmt=$this->pdo->prepare("SELECT *  
            FROM rl_cliente_cupom CLCU
            INNER JOIN tb_cliente CLI ON CLI.cli_pk_id = CLCU.clcu_fk_cliente
            INNER JOIN tb_cupom CUP ON CUP.cup_pk_id = CLCU.clcu_fk_cupom
            ");
            $stmt->execute();
                if($stmt->rowCount() > 0){
                    while($result=$stmt->fetch(PDO::FETCH_OBJ)){

                        $cliente_cupom = new cliente_cupom;
                        $cliente_cupom->setPkId($result->clcu_pk_id);
                        $cliente_cupom->setFkCliente($result->clcu_fk_cliente);
                        $cliente_cupom->setFkCupom($result->clcu_fk_cupom);
                        $cliente_cupom->setUltimo_uso($result->clcu_ultimo_uso);

                        // $cliente_cupom->setCodigo($result->cup_codigo);
                        
                        array_push($cliente_cupom, $cliente_cupom);
                    }
                    
                }else{
                    return "Sem Resultados!";
                }
                return $cliente_cupom;
        }
        catch(PDOException $e){
            echo $e->getMessage();
        }
    }
    function __construct($pdo){
        $this->pdo=$pdo;
    }
}

    
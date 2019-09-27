<?php

include_once $_SERVER['DOCUMENT_ROOT']."/config.php"; 
include_once MODELPATH. "/cupom_cliente.php";
include_once CONTROLLERPATH."/seguranca.php";
protegePagina("carrinho_call");

class controlCupom_cliente{
    private $pdo;

//     function insert($cupom_cliente){
//         try{
//             $cod_cliente=$cupom_cliente->getCod_cliente();
//             $cod_cupom=$cupom_cliente->getCod_cupom();
//             $uso = $cupom_cliente->getUso();
//             $stmt=$this->pdo->prepare("INSERT INTO cupom_cliente(cod_cliente, cod_cupom, uso) VALUES (:cod_cliente, :cod_cupom, :uso)");
//             $stmt->bindParam(":cod_cliente",$cod_cliente, PDO::PARAM_INT);
//             $stmt->bindParam(":cod_cupom",$cod_cupom, PDO::PARAM_INT);
//             $stmt->bindParam(":uso",$uso, PDO::PARAM_STR);
//             $stmt->execute();
        
//         } 
//     catch(PDOException $e){
//         echo $e->getMessage();
//     }
// }



function select($parametro, $parametro1){
    $stmt;
    $cupom_cliente1= new cupom_cliente;
    try{
        
        $cod_cliente=$parametro;
        $codigo = $parametro1;
        $stmt=$this->pdo->prepare("SELECT * FROM cupom_cliente 
        INNER JOIN cupom ON cupom_cliente.cod_cupom = cupom.cod_cupom
        INNER JOIN cliente ON cupom_cliente.cod_cliente = cliente.cod_cliente WHERE cupom_cliente.cod_cliente =:parametro AND codigo=:parametro1");
        $stmt->bindParam(":parametro", $cod_cliente, PDO::PARAM_INT);
        $stmt->bindParam(":parametro1", $codigo, PDO::PARAM_STR);
       
        $executa=$stmt->execute();
        if ($executa){
            if($stmt->rowCount() > 0){
                while($result=$stmt->fetch(PDO::FETCH_OBJ)){
                    $cupom_cliente1 = new cupom_cliente();
                        $cupom_cliente1->setCod_cliente($result->cod_cliente);
                        $cupom_cliente1->setNome($result->nome);
                        $cupom_cliente1->setCod_cupom($result->cod_cupom);
                        $cupom_cliente1->setCodigo($result->codigo);
                        $cupom_cliente1->setUltimo_uso($result->ultimo_uso);
                }
            }
            return $cupom_cliente1;
        }else{
            return -1;
        }
    }
    catch(PDOException $e){
        echo $e->getMessage();
        return -1;
    }
}    

function selectDataUso($parametro){
    $stmt;
    $cupom_cliente1= new cupom_cliente;
    try{
        
        $cod_cliente=$parametro;
        $stmt=$this->pdo->prepare("SELECT * FROM cupom_cliente 
        WHERE cod_cliente=:parametro AND DATE(ultimo_uso) = CURDATE()");
        $stmt->bindParam(":parametro", $cod_cliente, PDO::PARAM_INT);
       
        $executa=$stmt->execute();
        if ($executa){
            if($stmt->rowCount() > 0){
                while($result=$stmt->fetch(PDO::FETCH_OBJ)){
                    $cupom_cliente1 = new cupom_cliente();
                        $cupom_cliente1->setCod_cliente($result->cod_cliente);
                        $cupom_cliente1->setCod_cupom($result->cod_cupom);
                        $cupom_cliente1->setUltimo_uso($result->ultimo_uso);
            }
            return $cupom_cliente1;
            }else{
                return -1;
            }
        }
    }
    catch(PDOException $e){
        echo $e->getMessage();
        return -1;
    }
}    


function selectAll(){
        try{
            $cupom_cliente = array();
            $stmt=$this->pdo->prepare("SELECT cp.cod_cupom_cliente, cp.cod_cliente, cl.nome, cp.cod_cupom, cu.codigo, cp.uso  
            FROM cupom_cliente cp
            INNER JOIN cliente cl ON cl.cod_cliente = cp.cod_cliente
            INNER JOIN cupom cu ON cu.cod_cupom = cp.cod_cupom
            ");
            $stmt->execute();
                if($stmt->rowCount() > 0){
                    while($result=$stmt->fetch(PDO::FETCH_OBJ)){
                        $cupom_cliente1 = new cupom_cliente();
                        $cupom_cliente1->setCod_cliente($result->cod_cliente);
                        $cupom_cliente1->setNome($result->nome);
                        $cupom_cliente1->setCod_cupom($result->cod_cupom);
                        $cupom_cliente1->setCodigo($result->codigo);
                        $cupom_cliente1->setUltimo_uso($result->ultimo_uso);
                        array_push($cupom_cliente, $cupom_cliente1);
                    }
                    
                }else{
                    return "Sem Resultados!";
                }
                return $cupom_cliente;
        }
        catch(PDOException $e){
            echo $e->getMessage();
        }
    }
    function __construct($pdo){
        $this->pdo=$pdo;
    }
}

    
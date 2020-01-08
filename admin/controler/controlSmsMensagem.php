<?php
  
include_once $_SERVER['DOCUMENT_ROOT']."/config.php"; 
include_once MODELPATH."/sms_mensagem.php";
include_once CONTROLLERPATH."/seguranca.php";

class controlerSmsMensagem {

    private $pdo;

    function insert($sms){
        try{
            $stmt=$this->pdo->prepare("INSERT INTO tb_sms (sms_msg, sms_descricao) VALUES (:msg, :descricao) ");
            $msg = $sms->getMsg();
            $descricao = $sms->getDescricao();
            $stmt->bindParam(":msg", $msg, PDO::PARAM_STR);
            $stmt->bindParam(":descricao", $descricao, PDO::PARAM_STR);
            $executa=$stmt->execute();
            $sms_pk_id = $this->pdo->lastInsertId();


            if ($executa){
                return $sms_pk_id;
            }else{
                return -1;
            }
        }catch(PDOException $e){

            echo $e->getMessage();

        }
    }

    function insertSmsCli($cod_sms_mensagem, $cod_cliente){

        try{
            $sql = $this->pdo->prepare("INSERT INTO rl_cliente_sms SET clsm_fk_sms_mensagem = :cod_sms_mensagem, clsm_fk_cliente = :cod_cliente");

            $sql->bindValue(":cod_sms_mensagem", $cod_sms_mensagem);
            $sql->bindValue(":cod_cliente", $cod_cliente);

            $executa = $sql->execute();

            if ($executa){
                return 1;
            }else{
                return -1;
            }
        }catch(PDOException $e){

            echo $e->getMessage();

        }
    }


    function selectAll(){
        try{
            $envios = array();
            $stmte = $this->pdo->prepare("SELECT * FROM tb_sms ORDER BY sms_data_envio DESC");
            if($stmte->execute()){
                if($stmte->rowCount() > 0){
                    while($result = $stmte->fetch(PDO::FETCH_OBJ)){
                        $sms = new smsMensagem();
                        $sms->setCod_sms_mensagem($result->sms_pk_id);
                        $sms->setMsg($result->sms_msg);
                        $sms->setDescricao($result->sms_descricao);
                        $sms->setData_envio($result->sms_data_envio);
                        array_push($envios, $sms);
                    }
                }
            }
            return $envios;

        }catch(PDOException $e){
            echo $e->getMessage();
        }
    }

    function __construct($pdo){
        $this->pdo=$pdo;
    }
}

?>
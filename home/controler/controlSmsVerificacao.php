<?php
  
include_once $_SERVER['DOCUMENT_ROOT']."/config.php"; 
include_once MODELPATH."/sms_verificacao.php";
include_once CONTROLLERPATH."/seguranca.php";

class controlSmsVerificacao {

    private $pdo;

    function insert($sms){

        try{
            $stmt=$this->pdo->prepare("INSERT INTO tb_sms_verificacao (smve_telefone, smve_codigo, smve_verificado) VALUES (:telefone, :codigo, 0) ");
            
            $telefone = $sms->getTelefone();
            $codigo = $sms->getCodigo();

            $stmt->bindParam(":telefone", $telefone, PDO::PARAM_STR);
            $stmt->bindParam(":codigo", $codigo, PDO::PARAM_INT);

            $executa=$stmt->execute();
            if ($executa){
                return 1;
            }else{
                return -1;
            }
        }catch(PDOException $e){

            echo $e->getMessage();

        }
    }

    function selectByTelefoneCodigo($telefone, $codigo){

        $sms = new smsVerificacao();

        try{

            $stmte = $this->pdo->prepare("SELECT * FROM tb_sms_verificacao WHERE smve_telefone = :telefone AND smve_codigo = :codigo");

            $stmte->bindParam(":telefone", $telefone , PDO::PARAM_STR);
            $stmte->bindParam(":codigo", $codigo , PDO::PARAM_INT);

            if($stmte->execute()){

                if($stmte->rowCount() > 0){

                    while($result = $stmte->fetch(PDO::FETCH_OBJ)){
                        $sms->setCod_sms($result->smve_pk_id);
                        $sms->setTelefone($result->smve_telefone);
                        $sms->setCodigo($result->smve_codigo);
                        $sms->setVerificado($result->smve_verificado);
                    }
                }
            }
            return $sms;
        }

        catch(PDOException $e){
            echo $e->getMessage();
        }
    }

    function updateVerificado($cod_sms){

        try{
            $stmt=$this->pdo->prepare("UPDATE tb_sms_verificacao SET smve_verificado = 1 WHERE smve_pk_id=:cod_sms");
            $stmt->bindParam(":cod_sms", $cod_sms, PDO::PARAM_INT);

            $executa=$stmt->execute();
            
            if ($executa){
                return 2;
            }else{
                return -1;
            }            
        }catch(PDOException $e){
            echo $e->getMessage();
            return -1;
        }
    }

    function __construct($pdo){
        $this->pdo=$pdo;
    }
}

?>
<?php
  
include_once $_SERVER['DOCUMENT_ROOT']."/config.php"; 
include_once MODELPATH."/sms.php";
include_once CONTROLLERPATH."/seguranca.php";

class controlSMS {

    private $pdo;

    function insert($sms){

        try{
            $stmt=$this->pdo->prepare("INSERT INTO sms (telefone, codigo, verificado) VALUES (:telefone, :codigo, 0) ");
            
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

        $sms = new sms();

        try{

            $stmte = $this->pdo->prepare("SELECT * FROM sms WHERE telefone = :telefone AND codigo = :codigo");

            $stmte->bindParam(":telefone", $telefone , PDO::PARAM_STR);
            $stmte->bindParam(":codigo", $codigo , PDO::PARAM_INT);

            if($stmte->execute()){

                if($stmte->rowCount() > 0){

                    while($result = $stmte->fetch(PDO::FETCH_OBJ)){
                        $sms->setCod_sms($result->cod_sms);
                        $sms->setTelefone($result->telefone);
                        $sms->setCodigo($result->codigo);
                        $sms->setVerificado($result->verificado);
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
            $stmt=$this->pdo->prepare("UPDATE sms SET verificado = 1 WHERE cod_sms=:cod_sms");
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
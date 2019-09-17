<?php
include_once "seguranca.php";
include_once $_SERVER['DOCUMENT_ROOT']."/config.php"; 
include_once MODELPATH. "/cupom.php";
include_once CONTROLLERPATH."/controlCupom.php";
include_once "../lib/alert.php";
protegePagina();

if (in_array('pedidoWpp', json_decode($_SESSION['permissao']))) {
    if (!isset($_POST)||empty($_POST)){
        echo 'Nada foi postado.';
    }
    $codigo= addslashes(htmlspecialchars($_POST['codigo']));
    $qntde = $_POST['qtdcupom'];
    if(isset($qntde) && !empty($qntde)){
        $qtde_inicial=addslashes(htmlspecialchars($qntde));
        $qtde_atual = $qtde_inicial;
    }
    $valor1 = $_POST['valor'];
    if(isset($valor1) && !empty($valor1) && $valor1 >= '0.00'){
        $valor=addslashes(htmlspecialchars($valor1));
    }
    $dv = explode("-", $_POST['vencimento_data']);
    if(isset($_POST['vencimento_data']) && !empty($_POST['vencimento_data'] 
    && preg_match("/^(19|20)\d\d[\-\/.](0[1-9]|1[012])[\-\/.](0[1-9]|[12][0-9]|3[01])$/", $_POST['vencimento_data'])
    && checkdate($dv[1], $dv[2], $dv[0])==true)){
        $vencimento_data= addslashes(htmlspecialchars($_POST['vencimento_data']));
    }

    if(isset($_POST['vencimento_hora']) && !empty($_POST['vencimento_hora']) 
    && preg_match("/^(?:2[0-3]|[01][0-9]):[0-5][0-9]$/", $_POST['vencimento_hora'])){
        $vencimento_hora= addslashes(htmlspecialchars($_POST['vencimento_hora']));
    }

    $status=1;
    $cupom = new cupom;
    $cupom->construct($codigo,$qtde_inicial, $qtde_atual, $valor, $vencimento_data, $vencimento_hora, $status);
    $control = new controlCupom($_SG['link']);
    $result=$control->insert($cupom);
    
    if($result > -1){
        msgRedireciona('Cadastro Realizado!','Cupom cadastrado com sucesso!',1,'../view/admin/cupomLista.php');
    }else{
        alertJSVoltarPagina('Erro!','Erro ao cadastrar cliente!',2);
    }
}else{
    expulsaVisitante();
}
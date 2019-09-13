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
    $dv = explode("-", $_POST['vencimento']);
    if(isset($_POST['vencimento']) && !empty($_POST['vencimento'] 
    && preg_match("/^(19|20)\d\d[\-\/.](0[1-9]|1[012])[\-\/.](0[1-9]|[12][0-9]|3[01])$/", $_POST['vencimento'])
    && checkdate($dv[1], $dv[2], $dv[0])==true)){
        $vencimento= addslashes(htmlspecialchars($_POST['vencimento']));
    }

    $status=1;
    $cupom = new cupom;
    $cupom->construct($codigo,$qtde_inicial, $qtde_atual, $valor, $vencimento, $status);
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
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
    $qtde_inicial=addslashes(htmlspecialchars($_POST['qtdcupom']));
    $qtde_atual = $qtde_inicial;
    $valor=addslashes(htmlspecialchars($_POST['valor']));
    $vencimento=addslashes(htmlspecialchars($_POST['vencimento']));
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
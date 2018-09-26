<?php

include_once "seguranca.php";
protegePagina();

mysql_set_charset('utf8');
date_default_timezone_set('America/Sao_Paulo');

include_once "controlTipoAvaliacao.php";
include_once "../model/tipo_avaliacao.php";
include_once "../lib/alert.php";
include_once "upload.php";

if (in_array('avaliacao', json_decode($_SESSION['permissao']))) {
    if (!isset($_POST)||empty($_POST)){
        echo 'Nada foi postado.';
    }

    $id= addslashes(htmlspecialchars($_POST['cod']));
    $nome= addslashes(htmlspecialchars($_POST['nome']));
    $flag = (isset($_POST['flag_ativo'])||!empty($_POST['flag_ativo'])) && $_POST['flag_ativo'] == 1 ? 1 : 0 ;
    
    $tipo= new tipoAvaliacao();
    $controle=new controlerTipoAvaliacao($_SG['link']);

    if($controle->update($tipo) > -1){
        msgRedireciona('Alteração Realizada!','Tipo de avaliação alterado com sucesso!',1,'../view/admin/tipoAvaliacaoLista.php');
    }else{
        alertJSVoltarPagina('Erro!','Erro ao alterar tipo de avaliação!',2);
        $cardapio->show();
    }
}else{
    expulsaVisitante();
}

?>
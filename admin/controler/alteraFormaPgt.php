<?php
    include_once "seguranca.php";
    protegePagina();

    // mysql_set_charset('utf8');
    date_default_timezone_set('America/Sao_Paulo');

    include_once "controlFormaPgt.php";
    include_once "../model/formaPgt.php";
    include_once "../lib/alert.php";
    include_once "upload.php";
    if (in_array('forma_pgto', json_decode($_SESSION['permissao']))) {
        if (!isset($_POST)||empty($_POST)){
            echo 'Nada foi postado.';
        }

        $cod_formaPgt= addslashes(htmlspecialchars($_POST['cod']));
        $tipoFormaPgt= addslashes(htmlspecialchars($_POST['tipoFormaPgt']));
        if(isset($_POST['flag_ativo']) && !empty($_POST['flag_ativo'])){
            $flag_ativo = 1;
        }else{
            $flag_ativo = 0;
        }
        
        $formaPgt = new formaPgt();
        $formaPgt->construct($tipoFormaPgt,$flag_ativo);

        $formaPgt->setCod_formaPgt($cod_formaPgt);
        $controle = new controlerFormaPgt($_SG['link']);
        if($controle->update($formaPgt) > -1){
            msgRedireciona('Alteração Realizada!','Forma de Pagamento alterado com sucesso!',1,'../view/admin/formaPgtLista.php');
        }else{
            alertJSVoltarPagina('Erro!','Erro ao alterar forma de pagamento!',2);
            $formaPgt->show();
        }
    }else{
        expulsaVisitante();
    }
?>
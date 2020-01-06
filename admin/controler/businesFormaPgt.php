<?php
    include_once "seguranca.php";
    protegePagina();

    //mysql_set_charset('utf8')
    date_default_timezone_set('America/Sao_Paulo');

    include_once "controlFormaPgt.php";
    include_once "../lib/alert.php";
    include_once "upload.php";

    if(in_array('forma_pgto', json_decode($_SESSION['permissao']))) {
        if(!isset($_POST) || empty($_POST)){
            echo 'Nada foi postado.';
        }
        $tipoFormaPgt= addslashes(htmlspecialchars($_POST['tipoFormaPgt']));
        if(isset($_POST['flag_ativo']) && !empty($_POST['flag_ativo'])){
            $flag_ativo = 1;    //ativo
        }else{
            $flag_ativo = 2;    //nao ativo
        }


        $formaPgt= new forma_pgto();
        $formaPgt->construct($tipoFormaPgt, $flag_ativo);

        $controle= new controlerFormaPgt($_SG['link']);
        if($controle->insert($formaPgt)> -1){
            msgRedireciona('Cadastro Realizado!','Forma de Pagamento cadastrada!',1,'../view/admin/formaPgt.php');
        }else{
            alertJSVoltarPagina('Erro','Erro ao cadastrar forma de pagamento!',2);
            // $formaPgt->show();
        }
    }else{
        expulsaVisitante();
    }
?>

<?php
    include_once "seguranca.php";
    protegePagina();

    //mysql_set_charset('utf8')
    date_default_timezone_set('America/Sao_Paulo');

    include_once "controlEntrega.php";
    include_once "../lib/alert.php";
    include_once "upload.php";

    if(in_array('info_entrega', json_decode($_SESSION['permissao']))) {
        if(!isset($_POST) || empty($_POST)){
            echo 'Nada foi postado.';
        }        
    
        $raio_km = addslashes(htmlspecialchars($_POST['raio_km']));
        $taxa_entrega = addslashes(htmlspecialchars($_POST['taxa_entrega']));
        $tempo = addslashes(htmlspecialchars($_POST['tempo']));
        $min_frete_gratis = addslashes(htmlspecialchars($_POST['min_frete_gratis']));

        if(isset($_POST['flag_ativo']) && !empty($_POST['flag_ativo'])){
            $flag_ativo = 1;
        }else{
            $flag_ativo = 0;
        }

        $entrega = new entrega();
        $entrega->construct($raio_km, $taxa_entrega, $tempo, $min_frete_gratis, $flag_ativo);

        $controle = new controlEntrega($_SG['link']);
        if($controle->insert($entrega)> -1){
            msgRedireciona('Cadastro Realizado!','Forma de Pagamento cadastrada!',1,'../view/admin/entrega.php');
        }else{
            alertJSVoltarPagina('Erro','Erro ao cadastrar forma de pagamento!',2);
            $entrega->show();
        }
    }else{
        expulsaVisitante();
    }
?>

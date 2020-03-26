<?php

    include_once "seguranca.php";
    protegePagina();

    include_once "controlTipoFornecedor.php";
    include_once "../lib/alert.php";
    include_once "upload.php";

    if(in_array('gerenciar_fornecedor', json_decode($_SESSION['permissao']))){
        if(!isset($_POST) || empty($_POST)){
            echo 'Nada foi postado';
        }
        
        $tipo= addslashes(htmlspecialchars($_POST['tipoFornecedor']));
        
        if(isset($_POST['flag_ativo']) && !empty($_POST['flag_ativo'])){
            $flag_ativo = 1;    //ativo
        }else{
            $flag_ativo = 2;    //nao ativo
        }

        $tipoFornecedor = new tipo_fornecedor();
        $tipoFornecedor->construct($tipo,$flag_ativo);

        $controle= new controlerTipoFornecedor($_SG['link']);
        if($controle->insert($tipoFornecedor)> -1){
            msgRedireciona('Cadastro Realizado!','Tipo de fornecedor cadastrado!',1,'../view/admin/tipoFornecedorLista.php');
        }else{
            alertJSVoltarPagina('Erro','Erro ao cadastrar tipo de fornecedor!',2);
            $tipoFornecedor->show();
        }
    }else {
        expulsaVisitante();
    }

?>
<?php

    include_once "seguranca.php";
    protegePagina();

    include_once "controlItemComposicao.php";
    include_once "../lib/alert.php";
    include_once "upload.php";

    if(in_array('gerenciar_composicao', json_decode($_SESSION['permissao']))){
        if(!isset($_POST) || empty($_POST)){
            echo 'Nada foi postado';
        }
        
        $nome= addslashes(htmlspecialchars($_POST['itemComposicao']));
        $unidade= addslashes(htmlspecialchars($_POST['medidaItem']));
        $qtd= addslashes(htmlspecialchars($_POST['qtdComposicao']));
        $valor= addslashes(htmlspecialchars($_POST['valor']));
        

        $itemComposicao = new item_composicao();
        $itemComposicao->construct($nome,$unidade,$valor,$qtd);

        $controle= new controlerItemComposicao($_SG['link']);
        if($controle->insert($itemComposicao)> -1){
            msgRedireciona('Cadastro Realizado!','Item cadastrado!',1,'../view/admin/itemComposicaoLista.php');
        }else{
            alertJSVoltarPagina('Erro','Erro ao cadastrar item!',2);
            $itemComposicao->show();
        }
    }else {
        expulsaVisitante();
    }

?>
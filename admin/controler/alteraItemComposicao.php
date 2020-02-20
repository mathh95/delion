<?php
    include_once "seguranca.php";
    protegePagina();

    // mysql_set_charset('utf8');
    date_default_timezone_set('America/Sao_Paulo');

    include_once "controlItemComposicao.php";
    include_once "../model/item_composicao.php";
    include_once "../lib/alert.php";
    include_once "upload.php";
    if (in_array('gerenciar_fornecedor', json_decode($_SESSION['permissao']))) {
        if (!isset($_POST)||empty($_POST)){
            echo 'Nada foi postado.';
        }
        
        $cod_item = addslashes(htmlspecialchars($_POST['cod']));
        $nome= addslashes(htmlspecialchars($_POST['nome']));
        $medida= addslashes(htmlspecialchars($_POST['medidaItem']));
        $qtdComposicao= addslashes(htmlspecialchars($_POST['qtdComposicao']));
        $valor= addslashes(htmlspecialchars($_POST['valor']));

        
        $item_composicao = new item_composicao();
        $item_composicao->construct($nome,$medida,$qtdComposicao,$valor);

        $item_composicao->setPkId($cod_item);
        $controle = new controlerItemComposicao($_SG['link']);
        if($controle->update($item_composicao) > -1){
            msgRedireciona('Alteração Realizada!','Composição do Item alterada!',1,'../view/admin/itemComposicaoLista.php');
        }else{
            alertJSVoltarPagina('Erro!','Erro ao alterar composição do item!',2);
            $tipo_fornecedor->show();
        }
    }else{
        expulsaVisitante();
    }
?>
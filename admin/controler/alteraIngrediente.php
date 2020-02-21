<?php
    include_once "seguranca.php";
    protegePagina();

    // mysql_set_charset('utf8');
    date_default_timezone_set('America/Sao_Paulo');

    include_once "controlIngrediente.php";
    include_once "../model/ingrediente.php";
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

        
        $ingrediente = new ingrediente();
        $ingrediente->construct($nome,$medida,$qtdComposicao,$valor);

        $ingrediente->setPkId($cod_item);
        $controle = new controlerIngrediente($_SG['link']);
        if($controle->update($ingrediente) > -1){
            msgRedireciona('Alteração Realizada!','Ingrediente Alterado!',1,'../view/admin/ingredientesLista.php');
        }else{
            alertJSVoltarPagina('Erro!','Erro ao alterar ingrediente!',2);
            $ingrediente->show();
        }
    }else{
        expulsaVisitante();
    }
?>
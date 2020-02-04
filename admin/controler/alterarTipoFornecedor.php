<?php
    include_once "seguranca.php";
    protegePagina();

    // mysql_set_charset('utf8');
    date_default_timezone_set('America/Sao_Paulo');

    include_once "controlTipoFornecedor.php";
    include_once "../model/tipo_fornecedor.php";
    include_once "../lib/alert.php";
    include_once "upload.php";
    if (in_array('gerenciar_fornecedor', json_decode($_SESSION['permissao']))) {
        if (!isset($_POST)||empty($_POST)){
            echo 'Nada foi postado.';
        }

        $cod_tipo_fornecedor= addslashes(htmlspecialchars($_POST['cod']));
        $nome_tipo_fornecedor= addslashes(htmlspecialchars($_POST['tipoFornecedor']));

        if(isset($_POST['flag_ativo']) && !empty($_POST['flag_ativo'])){
            $flag_ativo = 1;
        }else{
            $flag_ativo = 0;
        }
        
        $tipo_fornecedor = new tipo_fornecedor();
        $tipo_fornecedor->construct($nome_tipo_fornecedor,$flag_ativo);

        $tipo_fornecedor->setPkId($cod_tipo_fornecedor);
        $controle = new controlerTipoFornecedor($_SG['link']);
        if($controle->update($tipo_fornecedor) > -1){
            msgRedireciona('Alteração Realizada!','Tipo de fornecedor alterado com sucesso!',1,'../view/admin/tipoFornecedorLista.php');
        }else{
            alertJSVoltarPagina('Erro!','Erro ao alterar tipo de fornecedor!',2);
            $tipo_fornecedor->show();
        }
    }else{
        expulsaVisitante();
    }
?>
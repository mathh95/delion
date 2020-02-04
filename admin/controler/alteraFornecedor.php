<?php
    include_once "seguranca.php";
    protegePagina();

    include_once "controlFornecedor.php";
    include_once "../model/fornecedor.php";
    include_once "../lib/alert.php";
    include_once "upload.php";

    if(in_array('gerenciar_fornecedor', json_decode($_SESSION['permissao']))){
        if(!isset($_POST) || empty($_POST)){
            echo 'Nada foi postado';
        }

        // Alterar o POST
        $cod_fornecedor = addslashes(htmlspecialchars($_POST['cod']));
        $nome = addslashes(htmlspecialchars($_POST['nome']));
        $endereco = addslashes(htmlspecialchars($_POST['endereco']));
        $referencia = addslashes(htmlspecialchars($_POST['referencia']));
        $cnpj = addslashes(htmlspecialchars($_POST['cnpj']));
        $telefone = addslashes(htmlspecialchars($_POST['telefone']));;
        $qtdias = addslashes(htmlspecialchars($_POST['qtddias']));
        $tipoFornecedor = addslashes(htmlspecialchars($_POST['tipoFornecedor']));

        $fornecedor = new fornecedor();
        $fornecedor->construct($nome,$cnpj,$telefone,$qtdias,$endereco,$referencia,$tipoFornecedor);

        $fornecedor->setPkId($cod_fornecedor);
        $controle= new controlerFornecedor($_SG['link']);
        if($controle->update($fornecedor) > -1){
            msgRedireciona('Cadastro Realizado!','Fornecedor Alterado!',1,'../view/admin/fornecedoresLista.php');
            // $fornecedor->show();
        }else{
            alertJSVoltarPagina('Erro','Erro ao cadastrar fornecedor!',2);
            $fornecedor->show();
        }

    }
    else{
        expulsaVisitante();
    }



?>
<?php

    include_once "seguranca.php";
    protegePagina();

    include_once "controlPedidoFornecedor.php";
    include_once "../lib/alert.php";
    include_once "upload.php";

    if(in_array('gerenciar_fornecedor', json_decode($_SESSION['permissao']))){
        if(!isset($_POST) || empty($_POST)){
            echo 'Nada foi postado';
        }

        $tipoFornecedor = addslashes(htmlspecialchars($_POST['tipoFornecedor']));
        $valor = addslashes(htmlspecialchars($_POST['valor']));
        $tipoPagamento = addslashes(htmlspecialchars($_POST['tipoPagamento']));
        $data_pedido_fornecedor = addslashes(htmlspecialchars($_POST['data_pedido_fornecedor']));
        $descricao = addslashes(htmlspecialchars($_POST['descricao']));


        $pedido_fornecedor = new pedido_fornecedor();
        $pedido_fornecedor->construct($valor,$tipoPagamento,$descricao,$data_pedido_fornecedor,$tipoFornecedor);

        $controle= new controlerPedidoFornecedor($_SG['link']);
        if($controle->insert($pedido_fornecedor) > -1){
            msgRedireciona('Cadastro Realizado!','Pedido cadastrado!',1,'../view/admin/pedidoFornecedorLista.php');
        }else{
            alertJSVoltarPagina('Erro','Erro ao cadastrar fornecedor!',2);
            $pedido_fornecedor->show();
        }

    }
    else{
        expulsaVisitante();
    }


?>
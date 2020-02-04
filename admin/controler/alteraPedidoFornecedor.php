<?php
    include_once "seguranca.php";
    protegePagina();

    include_once "controlPedidoFornecedor.php";
    include_once "../model/pedido_fornecedor.php";
    include_once "../lib/alert.php";
    include_once "upload.php";

    if(in_array('gerenciar_fornecedor', json_decode($_SESSION['permissao']))){
        if(!isset($_POST) || empty($_POST)){
            echo 'Nada foi postado';
        }

        // Alterar o POST
        $cod_pedido_fornecedor = addslashes(htmlspecialchars($_POST['cod']));
        $valor = addslashes(htmlspecialchars($_POST['valor']));
        $forma_pgt = addslashes(htmlspecialchars($_POST['tipoPagamento']));
        $descricao = addslashes(htmlspecialchars($_POST['descricao']));
        $dt_pedido = addslashes(htmlspecialchars($_POST['data_pedido_fornecedor']));
        $tipo_fornecedor = addslashes(htmlspecialchars($_POST['tipoFornecedor']));;

        $pedido_fornecedor = new pedido_fornecedor();
        $pedido_fornecedor->construct($valor,$forma_pgt,$descricao,$dt_pedido,$tipo_fornecedor);

        $pedido_fornecedor->setPkId($cod_pedido_fornecedor);
        $controle= new controlerPedidoFornecedor($_SG['link']);
        if($controle->update($pedido_fornecedor) > -1){
            msgRedireciona('Pedido Alterado!','Pedido Alterado com sucesso!',1,'../view/admin/pedidoFornecedorLista.php');
        }else{
            alertJSVoltarPagina('Erro','Erro ao alterar pedido!',2);
            $pedido_fornecedor->show();
        }

    }
    else{
        expulsaVisitante();
    }



?>
<?php

    include_once "seguranca.php";
    protegePagina();

	include_once "controlComposicao.php";
	include_once MODELPATH."/composicao.php";
    include_once "../lib/alert.php";
    include_once "upload.php";

    if(in_array('gerenciar_composicao', json_decode($_SESSION['permissao']))){
        if(!isset($_POST) || empty($_POST)){
            echo 'Nada foi postado';
        }
		

		$cod_produto = addslashes(htmlspecialchars($_POST['item_cardapio']));


		$composicao = new composicao();
		$valor_extra = $_POST['valor_extra'];
		$composicao->construct($cod_produto, $valor_extra);

		if(isset($_POST['ingrediente'])){
			$arr_ingredientes = $_POST['ingrediente'];
		}
		if(isset($_POST['qtd_utilizada'])){
			$arr_qtd_utilizada = $_POST['qtd_utilizada'];
		}
		if(isset($_POST['valor'])){
			$arr_valores = $_POST['valor'];
		}


		$controle = new controlerComposicao($_SG['link']);
		$result = $controle->insert(
			$composicao,
			$arr_ingredientes,
			$arr_qtd_utilizada
		);

		if($result){
			msgRedireciona('Gravado!','Composição Gravada!',1,'../view/admin/composicaoLista.php');
		}else{
			alertJSVoltarPagina('Erro!','Erro ao gravar!',2);
		}

		// if($controle->delete($composicao) > -1){
		// 	if($controle->update($composicao) > -1){
		// 		msgRedireciona('Gravado!','Composição Gravada!',1,'../view/admin/composicaoLista.php');
		// 	}else{
		// 		alertJSVoltarPagina('Erro!','Erro ao gravar :/!',2);
		// 	}
		// }else{
		// 	alertJSVoltarPagina('Erro!','Erro ao gravar!',2);
		// }

    }else {
        expulsaVisitante();
    }

?>
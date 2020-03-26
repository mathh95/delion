<?php

    include_once "seguranca.php";
    protegePagina();

	include_once "controlComposicao.php";
	include_once MODELPATH."/composicao.php";
    include_once "../lib/alert.php";
	include_once "upload.php";
	
	$controle_composicao = new controlerComposicao($_SG['link']);

    if(in_array('gerenciar_composicao', json_decode($_SESSION['permissao']))){
        if(!isset($_POST) || empty($_POST)){
            echo 'Nada foi postado';
        }
		

		$cod_produto = addslashes(htmlspecialchars($_POST['item_cardapio']));
		$valor_extra = $_POST['valor_extra'];

		if(isset($_POST['ingrediente'])){
			$arr_ingredientes = $_POST['ingrediente'];

			//remove id nulo do field default (para clone)
			array_shift($arr_ingredientes);
		}
		if(isset($_POST['qtde_utilizada'])){
			$arr_qtde_utilizada = $_POST['qtde_utilizada'];
			array_shift($arr_qtde_utilizada);
		}
		if(isset($_POST['valor'])){
			$arr_valores = $_POST['valor'];
			array_shift($arr_valores);
		}

		$composicao = new composicao();
		$composicao->construct($cod_produto, $valor_extra);

		//verifica se composição já existe
		if(1){
			$result = $controle_composicao->delete();
		}

		$result = $controle_composicao->insert(
			$composicao,
			$arr_ingredientes,
			$arr_qtde_utilizada
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
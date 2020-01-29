<?php
	include_once "seguranca.php";
	protegePagina();

	// mysql_set_charset('utf8');
	date_default_timezone_set('America/Sao_Paulo');

	include_once "controlProduto.php";
	include_once "../lib/alert.php";
	include_once "upload.php";

	if (in_array('gerenciar_fidelidade', json_decode($_SESSION['permissao']))) {
		if (!isset($_POST)||empty($_POST) ){
			echo 'Nada foi postado.';
		}

		$fk_fidelidade = addslashes(htmlspecialchars($_POST['fk_fidelidade']));
		$pk_id = addslashes(htmlspecialchars($_POST['pk_id']));
		$pontos_resgate = addslashes(htmlspecialchars($_POST['pontos_resgate']));

		$controle = new controlerProduto($_SG['link']);
		if($controle->updateFidelidade($pk_id, $pontos_resgate, $fk_fidelidade) > -1){

			msgRedireciona('Cadastro Realizado!','Produto cadastrado com sucesso!',1,'../view/admin/cadastrarFidelidade.php');

		}else{

			alertJSVoltarPagina('Erro!','Erro ao cadastrar item do produto!',2);
		}
	}else{
		expulsaVisitante();
	}
?>
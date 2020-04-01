<?php
	include_once "seguranca.php";
	protegePagina();

	//mysql_set_charset('utf8');
	date_default_timezone_set('America/Sao_Paulo');

	include_once "controlFidelidade.php";
	include_once "../model/fidelidade.php";
	include_once "../lib/alert.php";
	
	if (in_array('gerenciar_fidelidade', json_decode($_SESSION['permissao']))) {

		if (!isset($_POST)||empty($_POST)){
			echo 'Nada foi postado.';
		}

		$pk_id = addslashes(htmlspecialchars($_POST['cod_fidelidade']));
		$taxa_conversao_pts = addslashes(htmlspecialchars($_POST['taxa_conversao_pts']));


		$fidelidade = new fidelidade();
		$fidelidade->construct($taxa_conversao_pts);
		$fidelidade->setPkId($pk_id);

		$controle = new controlerFidelidade($_SG['link']);
		if($controle->update($fidelidade) > -1){
			msgRedireciona('Alteração Realizada!','Fidelidade alterada com sucesso!',1,'../view/admin/gerenciarFidelidade.php');

		}else{
			alertJSVoltarPagina('Erro!','Erro ao alterar fidelidade!',2);
			$fidelidade->show();
		}
	}else{
		expulsaVisitante();
	}
?>
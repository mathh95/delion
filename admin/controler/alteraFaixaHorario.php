<?php
	include_once "seguranca.php";

	protegePagina();

	date_default_timezone_set('America/Sao_Paulo');
	
	include_once "./controlFaixaHorario.php";
	include_once "../model/faixa_horario.php";
	include_once "../lib/alert.php";
	include_once "upload.php";

	$controle = new controlerFaixaHorario($_SG['link']);

	if (in_array('cardapio', json_decode($_SESSION['permissao']))) {
		if (!isset($_POST)||empty($_POST)){
			echo 'Nada foi postado.';
		}

		$erros=0;

		$arr_faho_pk_id = $_POST['faho_pk_id'];
		$arr_faho_nome = $_POST['faho_nome'];
		$arr_faho_inicio = $_POST['faho_inicio'];
		$arr_faho_final = $_POST['faho_final'];

		for($i = 0; $i < count($arr_faho_pk_id); $i++){
			
			$faho_pk_id = addslashes(htmlspecialchars($arr_faho_pk_id[$i]));
			$faho_nome = addslashes(htmlspecialchars($arr_faho_nome[$i]));
			$faho_inicio = addslashes(htmlspecialchars($arr_faho_inicio[$i]));
			$faho_final = addslashes(htmlspecialchars($arr_faho_final[$i]));

			$faixa_horario = new faixaHorario();
			$faixa_horario->construct($faho_inicio, $faho_final, $faho_nome);
			$faixa_horario->setPkId($faho_pk_id);
						
			if($controle->update($faixa_horario) == -1){
				$erros++;
			}
		}

		if($erros == 0){
			msgRedireciona('Alteração Realizada!','Informações de Faixa de Horário alterada com sucesso!',1,'../view/admin/gerenciarFaixaHorarios.php');
		}else{
			alertJSVoltarPagina('Erro!','Erro ao alterar Informações de Faixa de Horário!',2);
		}

	}else{
		expulsaVisitante();
	}
?>
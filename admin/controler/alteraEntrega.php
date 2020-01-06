<?php
	include_once "seguranca.php";

	protegePagina();

	date_default_timezone_set('America/Sao_Paulo');
	
	include_once "./controlEntrega.php";
	include_once "../model/entrega.php";
	include_once "../lib/alert.php";
	include_once "upload.php";

	$controle = new controlEntrega($_SG['link']);

	if (in_array('info_entrega', json_decode($_SESSION['permissao']))) {
		if (!isset($_POST)||empty($_POST)){
			echo 'Nada foi postado.';
		}

		$erros=0;

		$arr_cod_entrega = $_POST['cod_entrega'];
		$arr_raio_km = $_POST['raio_km'];
		$arr_taxa_entrega = $_POST['taxa_entrega'];
		$arr_tempo = $_POST['tempo'];
		$arr_valor_minimo = $_POST['valor_minimo'];
		$arr_min_taxa_gratis = $_POST['min_taxa_gratis'];
		$arr_flag_ativo = $_POST['flag_ativo'];
		

		for($i = 0; $i < count($arr_cod_entrega); $i++){
			
			$cod_entrega = addslashes(htmlspecialchars($arr_cod_entrega[$i]));
			$raio_km = addslashes(htmlspecialchars($arr_raio_km[$i]));
			$taxa_entrega = addslashes(htmlspecialchars($arr_taxa_entrega[$i]));
			$tempo = addslashes(htmlspecialchars($arr_tempo[$i]));
			$valor_minimo = addslashes(htmlspecialchars($arr_valor_minimo[$i]));
			$min_taxa_gratis = addslashes(htmlspecialchars($arr_min_taxa_gratis[$i]));
			$flag_ativo = addslashes(htmlspecialchars($arr_flag_ativo[$i]));

			if(isset($flag_ativo) && !empty($flag_ativo)){
				$flag_ativo = 1;
			}else{
				$flag_ativo = 0;
			}

			$entrega = new entrega();
			$entrega->construct($raio_km, $taxa_entrega, $tempo, $valor_minimo, $min_taxa_gratis, $flag_ativo);
			$entrega->setPkId($cod_entrega);
						
			if($controle->update($entrega) == -1){
				$erros++;
			}
		}

		if($erros == 0){
			msgRedireciona('Alteração Realizada!','Informações de Entrega alterada com sucesso!',1,'../view/admin/entrega.php');
		}else{
			alertJSVoltarPagina('Erro!','Erro ao alterar Informações de entrega!',2);
			// $entrega->show();
			//var_dump($entrega);
		}

	}else{
		//var_dump($_SESSION['permissao']);
		expulsaVisitante();
	}
?>
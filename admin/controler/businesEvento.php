<?php

	include_once "seguranca.php";

	protegePagina();



	// mysql_set_charset('utf8');

	date_default_timezone_set('America/Sao_Paulo');



	include_once "controlEvento.php";

	include_once "../lib/alert.php";

	include_once "upload.php";

	if (in_array('evento', json_decode($_SESSION['permissao']))) {

		if (!isset($_POST)||empty($_POST)){

			echo 'Nada foi postado.';

		}

		$nome= addslashes(htmlspecialchars($_POST['nome']));

		$data= addslashes(htmlspecialchars($_POST['data']));

		$flag_antigo = (isset($_POST['flag_antigo'])||!empty($_POST['flag_antigo'])) && $_POST['flag_antigo'] == 1 ? 1 : 0 ;

		$data = ($flag_antigo == 1) ? $data : "00/00/0000" ;

		if (!empty($_FILES['arquivo']['name'])) {

	   		$foto = upload("arquivo");

		}else{

			$foto = "";

		}

		$evento= new evento();

		$evento->construct($nome, $data, $flag_antigo, $foto);

		$controle=new controlerEvento($_SG['link']);

		if($controle->insert($evento)> -1){

			msgRedireciona('Cadastro Realizado!','Evento cadastrado com sucesso!',1,'../view/admin/evento.php');

		}else{

			alertJSVoltarPagina('Erro!','Erro ao cadastrar evento!',2);

			$evento->show();

		}

	}else{

		expulsaVisitante();

	}

?>
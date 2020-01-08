<?php

	include_once "seguranca.php";

	protegePagina();



	//mysql_set_charset('utf8');

	date_default_timezone_set('America/Sao_Paulo');



	include_once "controlBanner.php";

	include_once "../model/banner.php";

	include_once "../lib/alert.php";

	include_once "upload.php";



	if (in_array('banner', json_decode($_SESSION['permissao']))) {

		if (!isset($_POST)||empty($_POST)){

			echo 'Nada foi postado.';

		}

		$cod_banner= addslashes(htmlspecialchars($_POST['cod']));

		$nome= addslashes(htmlspecialchars($_POST['nome']));

		$link= addslashes(htmlspecialchars($_POST['link']));

		// $legenda= "";

		$pagina = array();

		for ($i=1; $i <= 7; $i++) { 

			if (!empty($_POST[$i."pagina"])) {

				array_push($pagina, addslashes(htmlspecialchars($_POST[$i."pagina"])));

			}

		}

		$pagina = json_encode($pagina);

		if (isset($_POST['pagina'])) {

	    	$pagina= $_POST['pagina'];

		}

		if (!empty($_FILES['arquivo']['name'])) {

	   		$anexo = addslashes(htmlspecialchars($_POST['imagem']));

	   		unlink($anexo);

	   		$foto = upload("arquivo");

		}else{

			$foto = addslashes(htmlspecialchars($_POST['imagem']));

		}

		$banner= new banner();

		$banner->construct($nome, $link,/* $legenda,*/ 0, $foto, $pagina);

		$banner->setPkId($cod_banner);

		$controle=new controlerBanner($_SG['link']);

		if($controle->update($banner)> -1){

			msgRedireciona('Alteração Realizada!','Banner alterado com sucesso!',1,'../view/admin/bannerLista.php');

		}else{

			alertJSVoltarPagina('Erro!','Erro ao alterar banner!',2);

			$banner->show();

		}

	}else{

		expulsaVisitante();

	}

?>
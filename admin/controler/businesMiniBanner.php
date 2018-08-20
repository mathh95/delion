<?php
	include_once "seguranca.php";
	protegePagina();

	mysql_set_charset('utf8');
	date_default_timezone_set('America/Sao_Paulo');

	include_once "controlBanner.php";
	include_once "../lib/alert.php";
	include_once "upload.php";
	if (in_array('banner', json_decode($_SESSION['permissao']))) {
		if (!isset($_POST)||empty($_POST)){
			echo 'Nada foi postado.';
		}
		$nome= addslashes(htmlspecialchars($_POST['nome']));
		$link= addslashes(htmlspecialchars($_POST['link']));
		// $legenda= addslashes(htmlspecialchars($_POST['legenda']));
		$pagina = array();
		for ($i=1; $i <= 7; $i++) { 
			if (!empty($_POST[$i."pagina"])) {
				array_push($pagina, addslashes(htmlspecialchars($_POST[$i."pagina"])));
			}
		}
		$pagina = json_encode($pagina);
		if (!empty($_FILES['arquivo']['name'])) {
	   		$foto = upload("arquivo");
		}else{
			$foto = "";
		}
		$banner= new banner();
		$banner->construct($nome, $link,/* $legenda,*/ 1, $foto, $pagina);
		$controle=new controlerBanner($_SG['link']);
		if($controle->insert($banner)> -1){
			msgRedireciona('Cadastro Realizado!','Mini banner cadastrado com sucesso!',1,'../view/admin/miniBanner.php');
		}else{
			alertJSVoltarPagina('Erro!','Erro ao cadastrar mini banner!',2);
			$banner->show();
		}
	}else{
		expulsaVisitante();
	}
?>
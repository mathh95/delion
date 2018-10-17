<?php
	include_once "seguranca.php";
	protegePagina();

	mysql_set_charset('utf8');
	date_default_timezone_set('America/Sao_Paulo');

	include_once "controlImagem.php";
	include_once "../lib/alert.php";
	include_once "upload.php";
	if (in_array('imagem', json_decode($_SESSION['permissao']))) {
		if (!isset($_POST)||empty($_POST)){
			echo 'Nada foi postado.';
		}
		$nome= addslashes(htmlspecialchars($_POST['nome']));
		$pagina = array();
		for ($i=1; $i <= 8; $i++) { 
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
		$imagem= new imagem();
		$imagem->construct($nome, $foto, $pagina);
		$controle=new controlerImagem($_SG['link']);
		if($controle->insert($imagem)> -1){
			msgRedireciona('Cadastro Realizado!','Imagem cadastrada com sucesso!',1,'../view/admin/imagem.php');
		}else{
			alertJSVoltarPagina('Erro!','Erro ao cadastrar imagem!',2);
			$imagem->show();
		}
	}else{
		expulsaVisitante();
	}
?>
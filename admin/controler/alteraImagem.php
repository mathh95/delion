<?php
	include_once "seguranca.php";
	protegePagina();

	// mysql_set_charset('utf8');
	date_default_timezone_set('America/Sao_Paulo');

	include_once "controlImagem.php";
	include_once "../model/imagem.php";
	include_once "../lib/alert.php";
	include_once "upload.php";

	if (in_array('imagem', json_decode($_SESSION['permissao']))) {
		if (!isset($_POST)||empty($_POST)){
			echo 'Nada foi postado.';
		}
		$cod_imagem= addslashes(htmlspecialchars($_POST['cod']));
		$nome= addslashes(htmlspecialchars($_POST['nome']));
		if(isset($_POST['paginas']) && !empty($_POST['paginas'])){
			$arr_paginas = json_encode($_POST['paginas']);
		}else{
			$arr_paginas = "";
		}
		if (!empty($_FILES['arquivo']['name'])) {
	   		$anexo = addslashes(htmlspecialchars($_POST['imagem']));
	   		unlink($anexo);
	   		$foto = upload("arquivo");
		}else{
			$foto = addslashes(htmlspecialchars($_POST['imagem']));
		}
		$imagem= new imagem();
		$imagem->construct($nome, $foto, $arr_paginas);
		$imagem->setPkId($cod_imagem);
		$controle=new controlerImagem($_SG['link']);
		if($controle->update($imagem)> -1){
			msgRedireciona('Alteração Realizada!','Imagem alterada com sucesso!',1,'../view/admin/imagemLista.php');
		}else{
			alertJSVoltarPagina('Erro!','Erro ao alterar imagem!',2);
			$imagem->show();
		}
	}else{
		expulsaVisitante();
	}
?>
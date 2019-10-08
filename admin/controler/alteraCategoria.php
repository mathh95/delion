<?php
	include_once "seguranca.php";
	protegePagina();

	//mysql_set_charset('utf8');
	date_default_timezone_set('America/Sao_Paulo');

	include_once "controlCategoria.php";
	include_once "../model/categoria.php";
	include_once "../lib/alert.php";
	include_once "upload.php";
	if (in_array('categoria', json_decode($_SESSION['permissao']))) {
		if (!isset($_POST)||empty($_POST)){
			echo 'Nada foi postado.';
		}
		$cod_categoria= addslashes(htmlspecialchars($_POST['cod']));
		$nome= addslashes(htmlspecialchars($_POST['nome']));
		if (!empty($_FILES['arquivo']['name'])) {
	   		$icone = upload("arquivo");
		}else{
			$icone = "";
		}
		$categoria= new categoria();
		$categoria->construct($nome, $icone);
		$categoria->setCod_categoria($cod_categoria);
		$controle=new controlerCategoria($_SG['link']);
		if($controle->update($categoria)> -1){
			msgRedireciona('Alteração Realizada!','Categoria alterada com sucesso!',1,'../view/admin/categoriaLista.php');
		}else{
			alertJSVoltarPagina('Erro!','Erro ao alterar categoria!',2);
			$categoria->show();
		}
	}else{
		expulsaVisitante();
	}
?>
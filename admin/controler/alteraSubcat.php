<?php
	include_once "seguranca.php";
	protegePagina();

	//mysql_set_charset('utf8');
	date_default_timezone_set('America/Sao_Paulo');

	include_once "controlSubCat.php";
	include_once "../model/subcat.php";
	include_once "../lib/alert.php";
	include_once "upload.php";
	if (in_array('categoria', json_decode($_SESSION['permissao']))) {
		if (!isset($_POST)||empty($_POST)){
			echo 'Nada foi postado.';
		}
		$cod_sub_categoria= addslashes(htmlspecialchars($_POST['cod']));
        $nome= addslashes(htmlspecialchars($_POST['nome']));
        $categoria = addslashes(htmlspecialchars($_POST['categoria']));

		if (!empty($_FILES['arquivo']['name'])) {

			$anexo = ADMINPATH."/".addslashes(htmlspecialchars($_POST['imagem']));
	
			if(file_exists($anexo)) unlink($anexo);
	
			$icone = upload("arquivo");
		}else{
			$icone = addslashes(htmlspecialchars($_POST['imagem']));
		}


		$subcategoria= new subcat();
		$subcategoria->construct($nome, $icone, $categoria);
		$subcategoria->setPkId($cod_sub_categoria);
		$controle=new controlerSubCat($_SG['link']);

		// $categoria->show();
		// exit;

		if($controle->update($subcategoria)> -1){
			msgRedireciona('Alteração Realizada!','Categoria alterada com sucesso!',1,'../view/admin/subcatLista.php');
		}else{
			alertJSVoltarPagina('Erro!','Erro ao alterar categoria!',2);
			$categoria->show();
		}
	}else{
		expulsaVisitante();
	}
?>
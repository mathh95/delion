<?php
	include_once "seguranca.php";
	protegePagina();

	// mysql_set_charset('utf8');
	date_default_timezone_set('America/Sao_Paulo');

	include_once "controlSubCat.php";
	include_once "../lib/alert.php";
	include_once "upload.php";
	if (in_array('categoria', json_decode($_SESSION['permissao']))) {
		if (!isset($_POST)||empty($_POST) ){
			echo 'Nada foi postado.';
		}
        //nome da subcategoria
        $nome= addslashes(htmlspecialchars($_POST['nome']));
        
        //categoria associada
        $categoria= addslashes(htmlspecialchars($_POST['categoria']));

        //icone da subcategoria
        if (!empty($_FILES['arquivo']['name'])) {
	   		$icone = upload("arquivo");
		}else{
			$icone = "";
        }
        
        
        $subCat= new subcat();
		$subCat->construct($nome, $categoria, $icone);
		$controle=new controlerSubCat($_SG['link']);

		if($controle->insert($subCat)> -1){
			msgRedireciona('Cadastro Realizado!','Categoria cadastrado com sucesso!',1,'../view/admin/subcat.php');
		}else{
			alertJSVoltarPagina('Erro!','Erro ao cadastrar item do categoria!',2);
			$subCat->show();
		}
	}else{
		expulsaVisitante();
	}
?>
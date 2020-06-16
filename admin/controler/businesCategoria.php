<?php
	include_once "seguranca.php";
	protegePagina();

	// mysql_set_charset('utf8');
	date_default_timezone_set('America/Sao_Paulo');

	include_once "controlCategoria.php";
	include_once "../lib/alert.php";
	include_once "upload.php";
	if (in_array('categoria', json_decode($_SESSION['permissao']))) {
		if (!isset($_POST)||empty($_POST) ){
			echo 'Nada foi postado.';
		}
		$nome= addslashes(htmlspecialchars($_POST['nome']));
		if (!empty($_FILES['arquivo']['name'])) {
	   		$icone = upload("arquivo");
		}else{
			$icone = "";
		}
		if(isset($_POST['flag_ativo']) && !empty($_POST['flag_ativo'])){
			$flag_ativo = 1;
		}else{
			$flag_ativo = 2;
		}
		$categoria= new categoria();
		$categoria->construct($nome, $icone, $flag_ativo);
		$controle=new controlerCategoria($_SG['link']);
		$verificador = $controle->verificaIgual($nome);
		$nomeComp = $verificador->getNome();
		$nomeCadastro = $nome;

		$nomeComp = trim(strtolower($nomeComp));
		$nomeCadastro = trim(strtolower($nomeCadastro));


		$verificacaoNome = strcmp($nomeComp, $nomeCadastro);

		if($verificacaoNome != 0){
			if($controle->insert($categoria)> -1){
				msgRedireciona('Cadastro Realizado!','Categoria cadastrado com sucesso!',1,'../view/admin/categoria.php');
			}else{
				alertJSVoltarPagina('Erro!','Erro ao cadastrar item do categoria!',2);
				$categoria->show();
			}
		}else{
			alertJSVoltarPagina('Erro!','Categoria já cadastrada!',2);
		}
	}else{
		expulsaVisitante();
	}
?>
<?php
	include_once "seguranca.php";
	protegePagina();

	// mysql_set_charset('utf8');
	date_default_timezone_set('America/Sao_Paulo');

	include_once "controlImagem.php";
	include_once "../lib/alert.php";
	include_once "upload.php";


	if (in_array('imagem', json_decode($_SESSION['permissao']))) {
		if (!isset($_POST)||empty($_POST)){
			echo 'Nada foi postado.';
		}

		$nome= addslashes(htmlspecialchars($_POST['nome']));

		if(isset($_POST['paginas']) && !empty($_POST['paginas'])){
			$arr_paginas = json_encode($_POST['paginas']);
		}else{
			$arr_paginas = "";
		}

		if (!empty($_FILES['arquivo']['name'])) {
	   		$foto = upload("arquivo");
		}else{
			$foto = "";
		}

		$imagem= new imagem();
		$imagem->construct($nome, $foto, $arr_paginas);
		$controle=new controlerImagem($_SG['link']);

		$verificador = $controle->verificaIgual($nome);
		$nomeComp = $verificador->getNome();
		$nomeCadastro = $nome;

		$nomeComp = trim(strtolower($nomeComp));
		$nomeCadastro = trim(strtolower($nomeCadastro));

		$verificacaoNome = strcmp($nomeComp, $nomeCadastro);

        if($verificacaoNome != 0){
			if($controle->insert($imagem)> -1){
				msgRedireciona('Cadastro Realizado!','Imagem cadastrada com sucesso!',1,'../view/admin/imagem.php');
			}else{
				alertJSVoltarPagina('Erro!','Erro ao cadastrar imagem!',2);
				$imagem->show();
			}
		}else{
			alertJSVoltarPagina('Erro!','Imagem já cadastrada com esse nome!',2);
		}
	}else{
		expulsaVisitante();
	}
?>
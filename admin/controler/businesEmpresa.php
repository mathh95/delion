<?php
	include_once "seguranca.php";
	protegePagina();

	// mysql_set_charset('utf8');
	date_default_timezone_set('America/Sao_Paulo');

	include_once "controlEmpresa.php";
	include_once "../model/empresa.php";
	include_once "../lib/alert.php";
	include_once "upload.php";
	if (in_array('empresa', json_decode($_SESSION['permissao']))) {
		if (!isset($_POST)||empty($_POST)){
			echo 'Nada foi postado.';
		}
		$nome= addslashes(htmlspecialchars($_POST['nome']));
		$descricao = addslashes(htmlspecialchars($_POST['descricao']));
		$historia = addslashes(htmlspecialchars($_POST['historia']));
		$endereco = addslashes(htmlspecialchars($_POST['endereco']));
		$cep = addslashes(htmlspecialchars($_POST['cep']));
		$bairro  = addslashes(htmlspecialchars($_POST['bairro']));
		$cidade = addslashes(htmlspecialchars($_POST['cidade']));
		$estado = addslashes(htmlspecialchars($_POST['estado']));
		$fone = addslashes(htmlspecialchars($_POST['fone']));
		$whats = addslashes(htmlspecialchars($_POST['whats']));
		$email  = addslashes(htmlspecialchars($_POST['email']));
		$facebook = addslashes(htmlspecialchars($_POST['facebook']));
		$instagram = addslashes(htmlspecialchars($_POST['instagram']));
		$pinterest = addslashes(htmlspecialchars($_POST['pinterest']));
		if (!empty($_FILES['arquivo']['name'])) {
			$foto = upload("arquivo");
		}else{
			$foto = "";
		}
		

		$empresa= new empresa();
		$empresa->construct($nome, $descricao, $historia, $endereco, $bairro, $cidade, $estado, $cep, $fone, $whats, $email, $facebook, $instagram, $pinterest, $foto);

		$empresa->setPkId($cod_empresa);
		$controle=new controlerEmpresa($_SG['link']);
		if($controle->update($empresa)> -1){
			msgRedireciona('Cadastro Realizado!','Empresa cadastrada com sucesso!',1,'../view/admin/empresa.php');
		}else{
			alertJSVoltarPagina('Erro!','Erro ao alterar empresa!',2);
			$empresa->show();
		}
	}else{
		expulsaVisitante();
	}
?>
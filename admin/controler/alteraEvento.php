<?php
	include_once "seguranca.php";
	protegePagina();

	//mysql_set_charset('utf8');
	date_default_timezone_set('America/Sao_Paulo');

	include_once "controlEvento.php";
	include_once "../model/evento.php";
	include_once "../lib/alert.php";
	include_once "upload.php";
	if (in_array('evento', json_decode($_SESSION['permissao']))) {
		if (!isset($_POST)||empty($_POST)){
			echo 'Nada foi postado.';
		}
		$cod_evento= addslashes(htmlspecialchars($_POST['cod']));
		$nome= addslashes(htmlspecialchars($_POST['nome']));
		$data= addslashes(htmlspecialchars($_POST['data']));
		$flag_antigo = (isset($_POST['flag_antigo'])||!empty($_POST['flag_antigo'])) && $_POST['flag_antigo'] == 1 ? 1 : 0 ;
		$data = ($flag_antigo == 1) ? $data : "00/00/0000" ;
		if (!empty($_FILES['arquivo']['name'])) {
	   		$anexo = addslashes(htmlspecialchars($_POST['imagem']));
	   		unlink($anexo);
	   		$foto = upload("arquivo");
		}else{
			$foto = addslashes(htmlspecialchars($_POST['imagem']));
		}
		$evento= new evento();
		$evento->construct($nome, $data, $flag_antigo, $foto);
		$evento->setCod_evento($cod_evento);
		$controle=new controlerEvento($_SG['link']);
		if($controle->update($evento)> -1){
			msgRedireciona('Alteração Realizada!','Evento alterado com sucesso!',1,'../view/admin/eventoLista.php');
		}else{
			alertJSVoltarPagina('Erro!','Erro ao alterar evento!',2);
			$evento->show();
		}
	}else{
		expulsaVisitante();
	}
?>
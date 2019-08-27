<?php
	include_once "seguranca.php";
	protegePagina();

	// mysql_set_charset('utf8');
	// date_default_timezone_set('America/Sao_Paulo');

	include_once "controlCardapio.php";
	include_once "../model/cardapio.php";
	include_once "../lib/alert.php";
	include_once "upload.php";
	if (in_array('cardapio', json_decode($_SESSION['permissao']))) {
		if (!isset($_POST)||empty($_POST)){
			echo 'Nada foi postado.';
		}

		$cod_cardapio= addslashes(htmlspecialchars($_POST['cod']));
		$nome= addslashes(htmlspecialchars($_POST['nome']));
		$preco = addslashes(htmlspecialchars($_POST['preco']));
		$desconto = addslashes(htmlspecialchars($_POST['desconto']));
		$descricao= addslashes(htmlspecialchars($_POST['descricao']));

		if (!empty($_FILES['arquivo']['name'])) {
			   $anexo = addslashes(htmlspecialchars($_POST['imagem']));
			   echo '<pre>';
			   print_r($anexo);
			   echo '</pre>';
			   //exit;
	   		unlink($anexo);
	   		$foto = upload("arquivo");
		}else{
			$foto = addslashes(htmlspecialchars($_POST['imagem']));
		}
		$categoria= addslashes(htmlspecialchars($_POST['categoria']));

		$adicional = array();
		for ($i=1; $i <= $_POST['quantidadeAdicionais']; $i++){
			if(isset($_POST[$i."adicional"]) && !empty($_POST[$i."adicional"])){
				array_push($adicional, addslashes(htmlspecialchars($_POST[$i."adicional"])));
			}
		}

		$adicional = json_encode($adicional);
		$dias_semana = array();
		for ($i=1; $i <= 6; $i++) { 
			if (!empty($_POST[$i."dia"]) && isset($_POST[$i."dia"])) {
				array_push($dias_semana, addslashes(htmlspecialchars($_POST[$i."dia"])));
			}
		}
		
		$dias_semana = json_encode($dias_semana);


		$turnos_semana = array();
		for ($i=1; $i <= 3; $i++) { 
			if (!empty($_POST[$i."turno"]) && isset($_POST[$i."turno"])) {
				array_push($turnos_semana, addslashes(htmlspecialchars($_POST[$i."turno"])));
			}
		}
		$turnos_semana = json_encode($turnos_semana);

		$flag_ativo = (isset($_POST['flag_ativo'])||!empty($_POST['flag_ativo'])) && $_POST['flag_ativo'] == 1 ? 1 : 0 ;
		$prioridade = (isset($_POST['prioridade'])||!empty($_POST['prioridade'])) && $_POST['prioridade'] == 1 ? 1 : 0 ;
		$delivery = (isset($_POST['delivery'])||!empty($_POST['delivery'])) && $_POST['delivery'] == 1 ? 1 : 0 ;
		$cardapio= new cardapio();
		$cardapio->construct($nome, $preco, $desconto, $descricao, $foto, $categoria, $flag_ativo, $prioridade,$delivery,$adicional, $dias_semana, $turnos_semana);

		$cardapio->setCod_cardapio($cod_cardapio);
		$controle=new controlerCardapio($_SG['link']);
		if($controle->update($cardapio)> -1){
			msgRedireciona('Alteração Realizada!','Item do cardápio alterado com sucesso!',1,'../view/admin/cardapioLista.php');
		}else{
			alertJSVoltarPagina('Erro!','Erro ao alterar item do cardápio!',2);
			$cardapio->show();
		}
	}else{
		expulsaVisitante();
	}
?>
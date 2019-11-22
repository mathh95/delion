<?php
	include_once "seguranca.php";
	protegePagina();

	// mysql_set_charset('utf8');
	// date_default_timezone_set('America/Sao_Paulo');

	include_once "controlCardapio.php";
	include_once "../lib/alert.php";
	include_once "upload.php";
	/*$dados_post= filter_input_array(INPUT_POST);
	echo "<pre>";
	print_r($dados_post);
	echo "</pre>";
	die();*/
	if (in_array('cardapio', json_decode($_SESSION['permissao']))) {
		if (!isset($_POST)||empty($_POST)){
			echo 'Nada foi postado.';
		}
		$nome= addslashes(htmlspecialchars($_POST['nome']));
		$preco = addslashes(htmlspecialchars($_POST['preco']));
		$desconto = addslashes(htmlspecialchars($_POST['desconto']));
		$descricao= addslashes(htmlspecialchars($_POST['descricao']));
		if (!empty($_FILES['arquivo']['name'])) {
			$foto = upload("arquivo");
		}else{
			$foto = "";
		}
		$categoria= addslashes(htmlspecialchars($_POST['categoria']));

		$adicional = array();
		for ($i=1; $i <= $_POST['quantidadeAdicionais']; $i++){
			if(isset($_POST[$i."adicional"]) && !empty($_POST[$i."adicional"])){
				array_push($adicional, addslashes(htmlspecialchars($_POST[$i."adicional"])));
			}
		}
		$adicional = json_encode($adicional);

		if(isset($_POST['dias'])){
			$arr_dias = $_POST['dias'];
			$dias_semana = json_encode($arr_dias);
		}else{
			$dias_semana = NULL;
		}
		
		
		$cardapio_turno = addslashes(htmlspecialchars($_POST['turnos']));
		
		$cardapio_horas_inicio = addslashes(htmlspecialchars($_POST['horario1']));

		$cardapio_horas_final = addslashes(htmlspecialchars($_POST['horario2']));
		

		$flag_ativo = (isset($_POST['flag_ativo'])||!empty($_POST['flag_ativo'])) && $_POST['flag_ativo'] == 1 ? 1 : 0 ;

		$flag_servindo = (isset($_POST['servindo'])||!empty($_POST['servindo'])) && $_POST['servindo'] == 1 ? 1 : 0 ;

		$prioridade = (isset($_POST['prioridade'])||!empty($_POST['prioridade'])) && $_POST['prioridade'] == 1 ? 1 : 0 ;

		$delivery = (isset($_POST['delivery'])||!empty($_POST['delivery'])) && $_POST['delivery'] == 1 ? 1 : 0 ;

		$cardapio= new cardapio();
		$cardapio->construct($nome, $preco, $desconto, $descricao, $foto, $categoria, $flag_ativo, $flag_servindo ,$prioridade,$delivery, $adicional, $dias_semana, $cardapio_turno, $cardapio_horas_inicio, $cardapio_horas_final);
		
		$controle=new controlerCardapio($_SG['link']);
		if($controle->insert($cardapio) > -1 && $cardapio_horas_inicio != $cardapio_horas_final && $dias_semana != NULL && $cardapio_horas_inicio != 0 && $cardapio_horas_final != 0 ){
			msgRedireciona('Cadastro Realizado!','Item do cardápio cadastrado com sucesso!',1,'../view/admin/cardapio.php');
		}else{
			alertJSVoltarPagina('Erro!', 'Erro ao inserir item no cardapio',2);
			$cardapio->show();
		}
	}else{
		expulsaVisitante();
	}
?>
<?php
	session_start();

	$_SESSION['endereco'] = array();
	
	//get endereco
	$admin_area_lv1 = $_POST['administrative_area_level_1'];
	$admin_area_lv2 = $_POST['administrative_area_level_2'];
	$postal_code = $_POST['postal_code'];
	$sublocality_lv1 = $_POST['sublocality_level_1'];
	$route = $_POST['route'];
	$street_number = $_POST['street_number'];
	$complemento = $_POST['complemento'];
	$referencia = $_POST['referencia'];

	$endereco_valido = true;

	//verifica cep
	$response = file_get_contents('https://viacep.com.br/ws/'.$postal_code.'/json');
	$response = json_decode($response);
	//var_dump($response);
	if($response->localidade != "Foz do Iguaçu"){
		echo "Não entregamos nessa região...";
		return;
	}
	
	//valida street_number
	if(strlen($street_number) == 0){
		echo "Número inválido";
		$endereco_valido == false;
	}else if(strlen($street_number) > 10){
		echo "Número inválido";
		$endereco_valido == false;
	}

	if($endereco_valido){
		//set endereco
		$_SESSION['endereco']['administrative_area_level_1'] = $admin_area_lv1;
		$_SESSION['endereco']['administrative_area_level_2'] = $admin_area_lv2;
		$_SESSION['endereco']['postal_code'] = $postal_code;
		$_SESSION['endereco']['sublocality_level_1'] = $sublocality_lv1;
		$_SESSION['endereco']['route'] = $route;
		$_SESSION['endereco']['street_number'] = $street_number;
		$_SESSION['endereco']['complemento'] = $complemento;
		$_SESSION['endereco']['referencia'] = $referencia;
		
		echo "valido";
	}else{

	}

	return;
?>
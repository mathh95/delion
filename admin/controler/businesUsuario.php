<?php
	include_once "seguranca.php";
	protegePagina();

	mysql_set_charset('utf8');
	date_default_timezone_set('America/Sao_Paulo');

	include_once "controlUsuario.php";
	include_once "../model/usuario.php";
	include_once "../lib/alert.php";
	if (in_array('usuario', json_decode($_SESSION['permissao']))) {
		if (!isset($_POST)||empty($_POST)){
			echo 'Nada foi postado.';
		}
		$login= addslashes(htmlspecialchars($_POST['login']));
		$senha= addslashes(htmlspecialchars($_POST['senha']));
		$email= addslashes(htmlspecialchars($_POST['email']));
		$nome= addslashes(htmlspecialchars($_POST['nome']));
		$cod_perfil= addslashes(htmlspecialchars($_POST['perfil']));
		// $status= addslashes(htmlspecialchars($_POST['flag_bloqueado']));
		$permissao = array();
		for ($i=1; $i <= 11; $i++) { 
			if (!empty($_POST[$i."permissao"])) {
				array_push($permissao, addslashes(htmlspecialchars($_POST[$i."permissao"])));
			}
		}
		$permissao = json_encode($permissao);
		$usuario= new usuario();
		$usuario->construct($nome,$login,$senha,$email,"0",$cod_perfil, $permissao);
		$controle=new controlerUsuario($_SG['link']);
		if($controle->insert($usuario)> -1){
			msgRedireciona('Cadastro Realizado!','Usuário cadastrado com sucesso!',1,'../view/admin/usuario.php');
		}else{
			alertJSVoltarPagina('Erro!','Erro ao cadastrar usuário!',2);
			$usuario->show();
		}
	}else{
		expulsaVisitante();
	}
?>
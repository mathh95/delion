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
		$email= addslashes(htmlspecialchars($_POST['email']));
		$nome= addslashes(htmlspecialchars($_POST['nome']));
		$cod_usuario = addslashes(htmlspecialchars($_POST['cod']));
		$cod_perfil= addslashes(htmlspecialchars($_POST['perfil']));
		$permissao = array();
		for ($i=1; $i <= 11; $i++) { 
			if (!empty($_POST[$i."permissao"])) {
				array_push($permissao, addslashes(htmlspecialchars($_POST[$i."permissao"])));
			}
		}
		$permissao = json_encode($permissao);
		$usuario= new usuario();
		$usuario->construct($nome,$login,"0",$email,"0",$cod_perfil, $permissao);
		$usuario->setCod_usuario($cod_usuario);
		$controle=new controlerUsuario($_SG['link']);
		if($controle->update($usuario)> -1){
			msgRedireciona('Alteração Realizada!','Usuário alterado com sucesso!',1,'../view/admin/usuariosLista.php');
		}else{
			alertJSVoltarPagina('Erro!','Erro ao alterar usuário!',2);
			$usuario->show();
		}
	}else{
		expulsaVisitante();
	}
?>
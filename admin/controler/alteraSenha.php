<?php
ROOTPATH
include_once $_SERVER['DOCUMENT_ROOT']."/config.php";

include_once CONTROLLERPATH."/seguranca.php";

protegePagina();



date_default_timezone_set('America/Sao_Paulo');



include_once MODELPATH."/usuario.php";

include_once "controlUsuario.php";

include_once LIBSPATH."/alert.php";



if ( !isset( $_POST ) || empty( $_POST ) ) {

	echo 'Nada foi postado.';

	header(ROOTPATH."/sistema.php");

}



$perfil = isset($_GET['tp']) ? (int) $_GET['tp'] : 2;



$cadastro = date("Y-m-d");



$_SESSION['usuario']->setSenha(addslashes(htmlspecialchars($_POST['senha1'])));



$controle=new controlerUsuario($_SG['link']);



  if($controle->updatePassword($_SESSION['usuario'])>-1){

    	alertJSVoltarPagina('Alteração Realizada!','Senha alterada com sucesso!',1);

  }else{

    alertJSVoltarPagina('Erro!','Erro ao alterar usuário!',2);

  }

?>


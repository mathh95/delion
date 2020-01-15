<?php

date_default_timezone_set('America/Sao_Paulo');

include_once $_SERVER['DOCUMENT_ROOT']."/config.php";
include_once CONTROLLERPATH."/seguranca.php";
include_once MODELPATH."/usuario.php";
include_once LIBSPATH."/alert.php";
include_once "controlUsuario.php";

$controle = new controlerUsuario($_SG['link']);

protegePagina();


if ( !isset( $_POST ) || empty( $_POST ) ) {
	// echo 'Nada foi postado.';
  header("Location: /admin/view/admin/empresaHorarios.php");
}

$perfil = isset($_GET['tp']) ? (int) $_GET['tp'] : 2;
$cadastro = date("Y-m-d");

$senha_antiga = $_POST['atual'];
$senha_nova = $_POST['senha1'];
$pk_id = $_SESSION['usuario']->getCod_usuario();

$usuario = $controle->selectById($pk_id);

if($usuario->getSenha() == md5($senha_antiga)){

  $_SESSION['usuario']->setSenha(addslashes(htmlspecialchars($_POST['senha1'])));

  if($controle->updatePassword($pk_id, $senha_nova) > 0){
    alertJSVoltarPagina('Alteração Realizada!','Senha alterada com sucesso!',1);
  }else{
    alertJSVoltarPagina('Erro!','Erro ao alterar usuário!',2);
  }

}else{
  alertJSVoltarPagina('Erro!','Senha incorreta!...esqueceu? contate o suporte.',2);
}

?>


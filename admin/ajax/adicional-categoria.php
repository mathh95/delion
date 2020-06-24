<?php
include_once $_SERVER['DOCUMENT_ROOT']."/config.php";
include_once CONTROLLERPATH."/seguranca.php";
include_once CONTROLLERPATH."/controlUsuario.php";
include_once CONTROLLERPATH."/controlAdicional.php";
include_once MODELPATH."/usuario.php";
protegePagina();

$controle=new controlerAdicional($_SG['link']);
$controleUsuario = new controlerUsuario($_SG['link']);
$usuarioPermissao = $controleUsuario->select($_SESSION['usuarioID'], 2);

$id = $_GET['id'];
$adicionais = $controle->selectAdiCategoria($id);

$permissao =  json_decode($usuarioPermissao->getPermissao());	
    if(in_array('cardapio', $permissao)){
      foreach ($adicionais as $adicional) {
            echo  "<input type='checkbox' name='adicional[]' value='".$adicional->getPkId()."'> ".$adicional->getNome();
            echo "<br>";
        }
    }

?>
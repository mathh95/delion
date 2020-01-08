<?php
include_once "../../admin/controler/conexao.php";
include_once "../controler/controlEndereco.php";
$controleEndereco=new controlEndereco(conecta());
$cod_endereco=$_GET['endereco'];
$result=$controleEndereco->deleteEndereco($cod_endereco);
echo $result;
?>
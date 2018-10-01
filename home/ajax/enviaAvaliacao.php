<?php
session_start();
ini_set('display_errors', true);
date_default_timezone_set('America/Sao_Paulo');

include_once "../../admin/controler/conexao.php";
include_once "../lib/alert.php";
require_once "../controler/controlAvaliacao.php";

$avaliacao = new controlerAvaliacao(conecta());

if(isset($_POST['tipos']) && !empty($_POST['tipos'])){
    $tipos = $_POST['tipos'];
    $notas = $_POST['notas'];

    foreach($tipos as $key => $tipo){
        $avaliacao->insert($tipo, $notas[$key]);
    }

    echo 1;
}else{
    echo -1;
}

?>
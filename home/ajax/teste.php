<?php
session_start();

// ini_set('display_errors', true);

// date_default_timezone_set('America/Sao_Paulo');



// include_once "../../admin/controler/conexao.php";

// require_once "../controler/controlCarrinho.php";

// require_once "../controler/controlCardapio.php";

// include_once "../lib/alert.php";
 $id = 0;

if(isset($_POST['item']) && !empty($_POST['item'])){
    $item = $_POST['item'];
    $adicionais = $_POST['adicionais'];
    echo $item;
    print_r($adicionais);  
}
?>
<?php
session_start();
// ini_set('display_errors', true);

// date_default_timezone_set('America/Sao_Paulo');



// include_once "../../admin/controler/conexao.php";

// require_once "../controler/controlCarrinho.php";

// require_once "../controler/controlCardapio.php";

// include_once "../lib/alert.php";
 $id = 0;

if(isset($_GET['id']) && !empty($_GET['id'])){
    $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
    if(!isset($_SESSION['carrinho'])){
        $_SESSION['carrinho'] = array();
        $_SESSION['qtd'] = array();
        // print_r($_SESSION['carrinho']);
        // exit;
    }

    // $_SESSION['carrinho'][] = $id;

    if(!in_array($id, $_SESSION['carrinho'], true)){
        
        array_push($_SESSION['carrinho'], $id);
        array_push($_SESSION['qtd'], 1);
        //essa sessão está sendo startada na index do projeto
    }
}



?>
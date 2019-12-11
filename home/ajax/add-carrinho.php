<?php
session_start();
// session_destroy();
// exit;

// print_r($_SESSION);
// exit;

// ini_set('display_errors', true);

// date_default_timezone_set('America/Sao_Paulo');



// include_once "../../admin/controler/conexao.php";

// require_once "../controler/controlCarrinho.php";

// require_once "../controler/controlProduto.php";

// include_once "../lib/alert.php";
$id = 0;
$obs = '';

if(isset($_GET['id']) && !empty($_GET['id'])){
    $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
    if(isset($_GET['observacaoItem']) && !empty($_GET['observacaoItem'])){
        $obs = $_GET['observacaoItem'];
    }
    if(!isset($_SESSION['carrinho']) || empty($_SESSION['carrinho'])){
        $_SESSION['carrinho'] = array();
        $_SESSION['qtd'] = array();
        $_SESSION['observacao'] = array();

        // print_r($_SESSION['carrinho']);
        // exit;
    }

    if(!in_array($id, $_SESSION['carrinho'], true)){

        array_push($_SESSION['carrinho'], $id);
        array_push($_SESSION['observacao'], $obs);
        //seta unidade de itens p/ 1 unidade
        array_push($_SESSION['qtd'], 1);
        //essa sessão está sendo startada na index do projeto

        echo count($_SESSION['carrinho']);
    }else{
        echo count($_SESSION['carrinho']);
    }
}



?>
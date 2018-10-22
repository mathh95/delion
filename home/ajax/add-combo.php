<?php
session_start();

// ini_set('display_errors', true);

// date_default_timezone_set('America/Sao_Paulo');



// include_once "../../admin/controler/conexao.php";

// require_once "../controler/controlCarrinho.php";

// require_once "../controler/controlCardapio.php";

// include_once "../lib/alert.php";
$id = 0;
$adicional = array();

if(isset($_POST['item']) && !empty($_POST['item'])){
    $id = filter_input(INPUT_POST, 'item', FILTER_SANITIZE_NUMBER_INT);
    if(isset($_POST['adicionais']) && !empty($_POST['adicionais'])){
        $adicional = $_POST['adicionais'];
    }
    if(!isset($_SESSION['combo'])){
        $_SESSION['combo'] = array();
        $_SESSION['adicionalCombo'] = array();
    }
        
    array_push($_SESSION['combo'], $id);
    array_push($_SESSION['adicionalCombo'], $adicional);

    echo count($_SESSION['combo']);
    // print_r($_SESSION['combo']);
    // print_r($_SESSION['adicionalCombo']);

    // session_destroy();
}



?>
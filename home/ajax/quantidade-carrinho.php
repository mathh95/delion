<?php
session_start();
// ini_set('display_errors', true);

// date_default_timezone_set('America/Sao_Paulo');



// include_once "../../admin/controler/conexao.php";

// require_once "../controler/controlCarrinho.php";

// require_once "../controler/controlCardapio.php";

// include_once "../lib/alert.php";

$qtdAtual = $_GET['qtdAtual'];
$preco = $_GET['preco'];
$acao = $_GET['acao'];

if($acao == "+"){
    $qtdAtual += 1;
    $_SESSION['totalCarrinho'] += $preco;
    echo "<p id='total'>Valor total do pedido: R$".$_SESSION['totalCarrinho']."</p>";
}elseif($acao == "-"){
    $qtdAtual -= 1;
    $_SESSION['totalCarrinho'] -= $preco;
    echo "<p id='total'>Valor total do pedido: R$".$_SESSION['totalCarrinho']."</p>";
}



?>
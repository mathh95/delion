<?php
session_start();
// ini_set('display_errors', true);

// date_default_timezone_set('America/Sao_Paulo');



// include_once "../../admin/controler/conexao.php";

// require_once "../controler/controlCarrinho.php";

// require_once "../controler/controlCardapio.php";

// include_once "../lib/alert.php";

$preco = $_GET['preco'];
$acao = $_GET['acao'];

if($acao == "+"){
    $_SESSION['totalCarrinho'] += $preco;
    echo "<p id='total'>Valor total do pedido: R$".$_SESSION['totalCarrinho']."</p>";
}elseif($acao == "-"){
    if(isset($_GET['id']) && !empty($_GET['id'])){
        $id = $_GET['id'];
        foreach($_SESSION['carrinho'] as $key => $value){
            if($id == $value){
                unset($_SESSION['carrinho'][$key]);
            }
        }
        $_SESSION['totalCarrinho'] -= $preco;
        echo "<p id='total'>Valor total do pedido: R$".$_SESSION['totalCarrinho']."</p>";
    }else{
        $_SESSION['totalCarrinho'] -= $preco;
        echo "<p id='total'>Valor total do pedido: R$".$_SESSION['totalCarrinho']."</p>";
    }
}



?>
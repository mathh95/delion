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


//função pra aumentar a quantidade de um item no carrinho
if($acao == "+"){
    $qtdAtual = $_GET['qtdAtual'];
    $linha = $_GET['linha'];
    $_SESSION['qtd'][$linha] = $qtdAtual+1;
    $_SESSION['totalCarrinho'] += $preco;
    echo "<p id='total'>Valor total do pedido: R$".$_SESSION['totalCarrinho']."</p>";
//função para diminuir uma quantidade de um item no carrinho
}elseif($acao == "-"){
    if(isset($_GET['id']) && !empty($_GET['id'])){
        $id = $_GET['id'];
        foreach($_SESSION['carrinho'] as $key => $value){
            if($id == $value){
                unset($_SESSION['carrinho'][$key]);
                unset($_SESSION['qtd'][$key]);
                sort($_SESSION['carrinho']);
                sort($_SESSION['qtd']);
            }
        }
        $_SESSION['totalCarrinho'] -= $preco;
        echo "<p id='total'>Valor total do pedido: R$".$_SESSION['totalCarrinho']."</p>";
    }else{
        $qtdAtual = $_GET['qtdAtual'];
        $linha = $_GET['linha'];
        $_SESSION['qtd'][$linha] = $qtdAtual-1;
        $_SESSION['totalCarrinho'] -= $preco;
        echo "<p id='total'>Valor total do pedido: R$".$_SESSION['totalCarrinho']."</p>";
    }
//função para remover todas as unidades de um item do carrinho
}elseif($acao == "rem"){
    if(isset($_GET['id']) && !empty($_GET['id'])){
        $id = $_GET['id'];
        $qtd = $_GET['qtdAtual'];
        foreach($_SESSION['carrinho'] as $key => $value){
            if($id == $value){
                unset($_SESSION['carrinho'][$key]);
                unset($_SESSION['qtd'][$key]);
                sort($_SESSION['carrinho']);
                sort($_SESSION['qtd']);
            }
        }
        $aux = $qtd * $preco;
        $_SESSION['totalCarrinho']-= $aux;
        echo "<p id='total'>Valor total do pedido: R$".$_SESSION['totalCarrinho']."</p>";
    }
}
// função para esvaziar o carrinho
elseif($acao == "esv"){
    $_SESSION['totalCarrinho'] = 0;
    $_SESSION['carrinho'] = array();
}
?>
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

if (isset($_GET['delivery']) && !empty($_GET['delivery'])){
    $_SESSION['delivery'] = $_GET['delivery'];
}


//função pra aumentar a quantidade de um item no carrinho
if($acao == "+"){
    $qtdAtual = $_GET['qtdAtual'];
    $linha = $_GET['linha'];
    $_SESSION['qtdCombo'][$linha] = $qtdAtual+1;
    $desconto = $_GET['desconto'];
    $desconto = $desconto / 100;
    $desconto = $preco * $desconto;
    $preco = $preco - $desconto;
    $_SESSION['totalCombo'] += $preco;
    echo "<p id='total'>Valor total do pedido: R$".number_format($_SESSION['totalCombo'], 2)."</p>";
//função para diminuir uma quantidade de um item no carrinho
}elseif($acao == "-"){
    if(isset($_GET['id']) && !empty($_GET['id'])){
        $id = $_GET['id'];
        foreach($_SESSION['combo'] as $key => $value){
            if($id == $value){
                unset($_SESSION['combo'][$key]);
                unset($_SESSION['qtdCombo'][$key]);
                sort($_SESSION['combo']);
                sort($_SESSION['qtdCombo']);

                if(count($_SESSION['combo']) < 1){
                    echo "<script>swal('Combo vazio!!').then((value) => {window.location='/home/cardapio.php'});</script>";
                }
            }
        }
        $desconto = $_GET['desconto'];
        $desconto = $desconto / 100;
        $desconto = $preco * $desconto;
        $preco = $preco - $desconto;
        $_SESSION['totalCombo'] -= $preco;
        echo "<p id='total'>Valor total do pedido: R$".number_format($_SESSION['totalCombo'], 2)."</p>";
    }else{
        $qtdAtual = $_GET['qtdAtual'];
        $linha = $_GET['linha'];
        $desconto = $_GET['desconto'];
        $desconto = $desconto / 100;
        $desconto = $preco * $desconto;
        $preco -= $desconto;
        $_SESSION['totalCombo'] -= $preco;
        $_SESSION['qtdCombo'][$linha] = $qtdAtual-1;
        echo "<p id='total'>Valor total do pedido: R$".number_format($_SESSION['totalCombo'], 2)."</p>";
    }
//função para remover todas as unidades de um item do carrinho
}elseif($acao == "rem"){
    if(isset($_GET['id']) && !empty($_GET['id'])){
        $id = $_GET['id'];
        $qtd = $_GET['qtdAtual'];
        foreach($_SESSION['combo'] as $key => $value){
            if($id == $value){
                unset($_SESSION['combo'][$key]);
                unset($_SESSION['qtdCombo'][$key]);
                sort($_SESSION['combo']);
                sort($_SESSION['qtdCombo']);

                if(count($_SESSION['combo']) < 1){
                    echo "<script>swal('Combo vazio!!').then((value) => {window.location='/home/cardapio.php'});</script>";
                }
            }
        }
        $desconto = $_GET['desconto'];
        $desconto = $desconto / 100;
        $sub = $qtd * $preco;
        $desconto = $desconto * $sub;
        $sub -= $desconto;
        $_SESSION['totalCombo']-= $sub;
        echo "<p id='total'>Valor total do pedido: R$".number_format($_SESSION['totalCombo'], 2)."</p>";
    }
}
// função para esvaziar o carrinho
elseif($acao == "esv"){
    $_SESSION['totalCombo'] = 0;
    $_SESSION['combo'] = array();
}
?>
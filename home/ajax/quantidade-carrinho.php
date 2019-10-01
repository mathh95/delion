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
// $valorcupom = $_GET['valorcupom'];
// echo "<pre>";
// print_r($valorcupom);
// echo "</pre>";
if (isset($_GET['delivery']) && !empty($_GET['delivery'])){
    $_SESSION['delivery'] = $_GET['delivery'];
}
//função pra aumentar a quantidade de um item no carrinho
if($acao == "+"){
    $qtdAtual = $_GET['qtdAtual'];
    $linha = $_GET['linha'];
    $_SESSION['qtd'][$linha] = $qtdAtual+1;
    $_SESSION['totalCarrinho'] += $preco;
    $_SESSION['totalComDesconto'] = ((float)$_SESSION['totalCarrinho'] - (float)$_SESSION['valorcupom']);
    
    $_SESSION['totalCorrigido'] += $preco;

    // if($_SESSION['is_delivery'] == true){
    //     $_SESSION['totalCorrigido'] += $_SESSION['delivery_price'];
    // }

    echo json_encode(
        array(
            "valorcupom" => $_SESSION['valorcupom'],
            "totalCarrinho" => $_SESSION['totalCarrinho'],
            "totalComDesconto" => $_SESSION['totalComDesconto'],
            "totalCorrigido" => $_SESSION['totalCorrigido']
            )
        );
        
    return;
    
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

                if(count($_SESSION['carrinho']) < 1){
                    $_SESSION['valorcupom'] = 0.00;
                    
                    echo "<script>swal('Carrinho vazio!!').then((value) => {window.location='/home/cardapio.php'});</script> ";
                }
            }
        }
        $_SESSION['totalCarrinho'] -= (float)$preco;
        $_SESSION['totalComDesconto'] = ((float)$_SESSION['totalCarrinho'] - (float)$_SESSION['valorcupom']);
        
        $_SESSION['totalCorrigido'] -= (float)$preco;

        echo json_encode(
            array(
                "valorcupom" => $_SESSION['valorcupom'],
                "totalCarrinho" => $_SESSION['totalCarrinho'],
                "totalComDesconto" => $_SESSION['totalComDesconto'],
                "totalCorrigido" => $_SESSION['totalCorrigido']
                )
            );
            
        return;


    }else{
        $qtdAtual = $_GET['qtdAtual'];
        $linha = $_GET['linha'];
        $_SESSION['qtd'][$linha] = $qtdAtual-1;
        $_SESSION['totalCarrinho'] -= $preco;
        $_SESSION['totalComDesconto'] = ((float)$_SESSION['totalCarrinho'] - (float)$_SESSION['valorcupom']);
        
        $_SESSION['totalCorrigido'] -= (float)$preco;

        echo json_encode(
            array(
            "valorcupom" => $_SESSION['valorcupom'],
            "totalCarrinho" => $_SESSION['totalCarrinho'],
            "totalComDesconto" => $_SESSION['totalComDesconto'],
            "totalCorrigido" => $_SESSION['totalCorrigido']
            )
        );
            
        return;
    }
//função para remover todas as unidades de um item do carrinho
}
elseif($acao == "rem"){
    if(isset($_GET['id']) && !empty($_GET['id'])){
        $id = $_GET['id'];
        $qtd = $_GET['qtdAtual'];
        foreach($_SESSION['carrinho'] as $key => $value){
            if($id == $value){
                unset($_SESSION['carrinho'][$key]);
                unset($_SESSION['qtd'][$key]);
                sort($_SESSION['carrinho']);
                sort($_SESSION['qtd']);

                if(count($_SESSION['carrinho']) < 1){
                    $_SESSION['valorcupom'] = 0.00;
                    echo "<script>swal('Carrinho vazio!!').then((value) => {window.location='/home/cardapio.php'});</script> ";
                }
            }
        }
        $aux = $qtd * $preco;
        $_SESSION['totalCarrinho']-= $aux;
        $_SESSION['totalComDesconto'] = ($_SESSION['totalCarrinho'] - $_SESSION['valorcupom']);
        
    }
}
// função para esvaziar o carrinho
elseif($acao == "esv"){
    $_SESSION['totalCarrinho'] = 0;
    $_SESSION['carrinho'] = array();
}
?>
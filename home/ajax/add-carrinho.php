<?php

session_start();

$id = 0;
$obs = '';


if(!isset($_SESSION['carrinho']) || empty($_SESSION['carrinho'])){
    $_SESSION['carrinho'] = array();
    $_SESSION['qtd'] = array();
    $_SESSION['observacao'] = array();
}

if(!isset($_SESSION['carrinho_resgate']) || empty($_SESSION['carrinho_resgate'])){
    $_SESSION['carrinho_resgate'] = array();
}

if(isset($_GET['id']) && !empty($_GET['id'])){

    $id = intval(filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT));

    if(isset($_GET['observacaoItem']) && !empty($_GET['observacaoItem'])){
        $obs = $_GET['observacaoItem'];
    }

    if(!in_array($id, $_SESSION['carrinho'], true)){

        array_push($_SESSION['carrinho'], $id);
        array_push($_SESSION['observacao'], $obs);
        
        //seta unidade de itens p/ 1 unidade
        array_push($_SESSION['qtd'], 1);

        echo count($_SESSION['carrinho']) + count($_SESSION['carrinho_resgate']);
    }else{
        echo count($_SESSION['carrinho']) + count($_SESSION['carrinho_resgate']);
    }


//Resgate Fidelidade
}else if(isset($_GET['is_array']) && $_GET['is_array'] == true){

    if (isset($_GET['itens_resgate'])){

        //zera caso haja resgate anterior
        $_SESSION['carrinho_resgate'] = array();

        //$itens = {cod_produto: qtd}
        $itens = $_GET['itens_resgate'];
        foreach($itens as $cod_item => $qtd_item){

            $_SESSION['carrinho_resgate'][$cod_item]['qtd'] = $qtd_item;
        }

        // var_dump($_SESSION['carrinho_resgate']);
        echo count($_SESSION['carrinho_resgate']);
    }
}



?>
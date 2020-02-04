<?php

session_start();

$id = 0;
$obs = '';


if(!isset($_SESSION['carrinho']) || empty($_SESSION['carrinho'])){
    $_SESSION['carrinho'] = array();
    $_SESSION['qtd'] = array();
    $_SESSION['observacao'] = array();
}


if(isset($_GET['id']) && !empty($_GET['id'])){

    $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

    if(isset($_GET['observacaoItem']) && !empty($_GET['observacaoItem'])){
        $obs = $_GET['observacaoItem'];
    }

    if(!in_array($id, $_SESSION['carrinho'], true)){

        array_push($_SESSION['carrinho'], $id);
        array_push($_SESSION['observacao'], $obs);
        
        //seta unidade de itens p/ 1 unidade
        array_push($_SESSION['qtd'], 1);

        echo count($_SESSION['carrinho']);
    }else{
        echo count($_SESSION['carrinho']);
    }


//Resgate Fidelidade
}else if(isset($_GET['is_array']) && $_GET['is_array'] == true){

    if (isset($_GET['itens_resgate'])){

        //$itens = {cod_produto: qtd}
        $itens = $_GET['itens_resgate'];
        foreach($itens as $cod_item => $qtd_item){
            if(!in_array($cod_item, $_SESSION['carrinho'], true)){

                array_push($_SESSION['carrinho'], $cod_item);
                array_push($_SESSION['observacao'], "");
                
                //seta qtd de itens
                array_push($_SESSION['qtd'], $qtd_item);
        
                echo count($_SESSION['carrinho']);
            }else{
                echo count($_SESSION['carrinho']);
            }
        }
    }
}



?>
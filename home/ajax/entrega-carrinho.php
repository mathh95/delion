<?php
session_start();


$acao = $_POST['acao'];

if($acao == "delivery"){

    $_SESSION['delivery'] = 1;
    if(isset($_SESSION['is_delivery_home'])) $_SESSION['is_delivery_home'] = 1;

    if($_SESSION['delivery_price'] > 0){

        $_SESSION['valor_total'] = (float)$_SESSION['total_com_desconto'] + (float)$_SESSION['delivery_price'];
        
    }

    echo json_encode(
        array(
            "delivery_price" => (float)$_SESSION['delivery_price'],
            "totalCorrigido" => (float)$_SESSION['valor_total']
            )
        );
    return;

}else if($acao == "balcao"){
    
    $_SESSION['delivery'] = -1;
    if(isset($_SESSION['is_delivery_home'])) $_SESSION['is_delivery_home'] = 0;

    if($_SESSION['delivery_price'] > 0){
        $_SESSION['valor_total'] = (float)$_SESSION['total_com_desconto'];
    }
    echo json_encode(
        array(
            "delivery_price" => 0.00,
            "totalCorrigido" => (float)$_SESSION['valor_total']
            )
        );
    return;

}else if($acao == "rem_endereco"){
    unset($_SESSION['endereco']);
    unset($_SESSION['cod_endereco']);

    return;
}

//echo $_SESSION['valor_total'];
//echo $_SESSION['total_com_desconto'];

?>
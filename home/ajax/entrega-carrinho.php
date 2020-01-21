<?php
session_start();


$acao = $_POST['acao'];

if($acao == "delivery"){

    $_SESSION['delivery'] = 1;
    if($_SESSION['delivery_price'] > 0){

        $_SESSION['valor_total'] = (float)$_SESSION['totalComDesconto'] + (float)$_SESSION['delivery_price'];
        
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
    $_SESSION['is_delivery_home'] = 0;

    if($_SESSION['delivery_price'] > 0){
        $_SESSION['valor_total'] = (float)$_SESSION['totalComDesconto'];
    }
    echo json_encode(
        array(
            "delivery_price" => 0.00,
            "totalCorrigido" => (float)$_SESSION['valor_total']
            )
        );
    return;
}

//echo $_SESSION['valor_total'];
//echo $_SESSION['totalComDesconto'];

?>
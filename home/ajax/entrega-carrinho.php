<?php
session_start();


$acao = $_POST['acao'];
if($acao == "delivery"){

    $_SESSION['is_delivery'] = 1;
    if($_SESSION['delivery_price'] > 0){

        $_SESSION['totalCorrigido'] = (float)$_SESSION['totalComDesconto'] + (float)$_SESSION['delivery_price'];
        
    }

    echo json_encode(
        array(
            "delivery_price" => (float)$_SESSION['delivery_price'],
            "totalCorrigido" => (float)$_SESSION['totalCorrigido']
            )
        );
    return;

}else if($acao == "balcao"){
    
    $_SESSION['is_delivery'] = 0;
    if($_SESSION['delivery_price'] > 0){
        $_SESSION['totalCorrigido'] = (float)$_SESSION['totalComDesconto'];
    }
    echo json_encode(
        array(
            "delivery_price" => 0.00,
            "totalCorrigido" => (float)$_SESSION['totalCorrigido']
            )
        );
    return;
}

//echo $_SESSION['totalCorrigido'];
//echo $_SESSION['totalComDesconto'];

?>
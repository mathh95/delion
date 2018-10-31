<?php
session_start();
// ini_set('display_errors', true);

// date_default_timezone_set('America/Sao_Paulo');



// include_once "../../admin/controler/conexao.php";

// require_once "../controler/controlCarrinho.php";

// require_once "../controler/controlCardapio.php";

// include_once "../lib/alert.php";
$acao = $_POST['acao'];

if (isset($_GET['delivery']) && !empty($_GET['delivery'])){
    $_SESSION['delivery'] = $_GET['delivery'];
    if($_GET['delivery'] == -1){
        $_SESSION['cod_endereco'] = "";
    }
}

if($acao == "addAdicional"){

    $subtotal = $_POST['subtotal'];
    $precoAdicional = $_POST['precoAdicional'];
    $desconto = $_POST['desconto'];
    $descontoBruto = $_POST['descontoBruto'];
    
    $descontoBrutoFinal = $descontoBruto / 100;
    $descontoBrutoFinal = $descontoBrutoFinal * $subtotal;
    $total = $subtotal - $descontoBrutoFinal;
    $_SESSION['totalCombo'] -= $total;

    $subtotal = $subtotal + $precoAdicional;
    $descontoBruto = $descontoBruto + $desconto;
    $descontoBruto = $descontoBruto / 100;
    $descontoBruto = $descontoBruto * $subtotal;
    $total2 = $subtotal - $descontoBruto;
    $_SESSION['totalCombo'] += $total2; 

    
    echo "<strong><p id='total'>Valor total do pedido: R$ ".number_format($_SESSION['totalCombo'], 2);
}elseif($acao == "removeAdicional"){

    $subtotal = $_POST['subtotal'];
    $precoAdicional = $_POST['precoAdicional'];
    $desconto = $_POST['desconto'];
    $descontoBruto = $_POST['descontoBruto'];
    
    $descontoBrutoFinal = $descontoBruto / 100;
    $descontoBrutoFinal = $descontoBrutoFinal * $subtotal;
    $total = $subtotal - $descontoBrutoFinal;
    $_SESSION['totalCombo'] -= $total;

    $subtotal = $subtotal - $precoAdicional;
    $descontoBruto = $descontoBruto - $desconto;
    $descontoBruto = $descontoBruto / 100;
    $descontoBruto = $descontoBruto * $subtotal;
    $total2 = $subtotal - $descontoBruto;
    $_SESSION['totalCombo'] += $total2; 
    
    echo "<strong><p id='total'>Valor total do pedido: R$ ".number_format($_SESSION['totalCombo'], 2);
}elseif($acao == "rem"){
    $subtotal = $_POST['subtotal'];
    $desconto = $_POST['desconto'];
    $linha = $_POST['linha'];

    $desconto = $desconto / 100;
    $desconto = $desconto * $subtotal;
    $subtotal = $subtotal - $desconto;
    $_SESSION['totalCombo'] -= $subtotal;

    unset($_SESSION['combo'][$linha]);
    unset($_SESSION['adicionalCombo'][$linha]);
    sort($_SESSION['combo']);
    sort($_SESSION['adicionalCombo']);

    echo "<strong><p id='total'>Valor total do pedido: R$ ".number_format($_SESSION['totalCombo'], 2);

}elseif($acao == "esv"){
    $_SESSION['combo'] = array();
    $_SESSION['totalCombo'] = array();
    $_SESSION['adicionalCombo'] = array();
}
?>
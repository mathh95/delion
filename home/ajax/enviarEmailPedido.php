<?php

include_once $_SERVER['DOCUMENT_ROOT']."/config.php"; 
include_once HELPERPATH."/mask.php";

//session_start();
include_once "../../admin/controler/conexao.php";

require_once "../controler/controlCarrinho.php";

require_once "../controler/controlProduto.php";

include_once "../lib/alert.php";


require_once "../controler/controlCarrinho.php";
require_once "../controler/controlEndereco.php";
require_once "../../phpmailer/src/PHPMailer.php";
require_once '../../phpmailer/src/Exception.php';
require_once '../../phpmailer/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;


$pedido = new controlerCarrinho(conecta());
$cardapio = new controlerProduto(conecta());
$mail = new PHPMailer();

$itens = $_SESSION['carrinho'];
if ($itens > 0) {

    $itens = $cardapio->buscarVariosId($itens);

}else{
    //redireciona cliente
    if(isset($_SESSION['cod_cliente'])){
        header("Location: /home/listarPedidos.php");
    }else{
        header("Location: /home/cardapio.php");
    }
}


$fk_endereco = null;
//endereco cadastrado previamente POST
if (isset($_POST['endereco']) and !empty($_POST['endereco'])) {
    $fk_endereco = $_POST['endereco'];

//endereco homepage
}else if(($_SESSION['is_delivery_home'])){
    
    include_once "../controler/businesEndereco.php";

    if($_SESSION['cod_endereco'] != -1){
        $fk_endereco = $_SESSION['cod_endereco'];
    }else{
        echo "Error Endereco Insert";
        echo $fk_endereco;
    }
}


//Server Settings
$mail->CharSet = 'UTF-8';
$mail->isSMTP();
$mail->SMTPDebug = 0;
$mail->Host = MAIL_HOST;
$mail->SMTPSecure = 'tls';
$mail->SMTPAuth  =  true;
$mail->Username = MAIL_SERVER;
$mail->Password = MAIL_SERVER_PASS;
$mail->Port = 587;
$mail->SMTPOptions = array(
    'ssl' => array(
        'verify_peer' => false,
        'verify_peer_name' => false,
        'allow_self_signed' => true
    )
);
//Recipients
$mail->setFrom(MAIL_SERVER, "Site - Delion Café");
$mail->addAddress(MAIL_SERVER, "Delion Café");

//content
$html = 
    "<head>
        <script src=https://unpkg.com/sweetalert/dist/sweetalert.min.js></script>
        <style>
            .swal-overlay {
                background-color: black;
            }
        </style>
    </head><body></body>";

$nome = $_SESSION['nome']." ".$_SESSION['sobrenome'];

$mask = new Mask;
$masked_phone = $mask->addMaskPhone($_SESSION['telefone']);
$subject = $nome." | ".$masked_phone;

$date = new DateTime();
$date = $date->format('d-m-Y H:i');

$body_pedido = 
    "<h2>Produtos</h2>
    <table width='100%' border='1px' style='text-align:center;'>
        <thead>
            <tr>
                <th width='15%' height='20%'>Nº Item</th>
                <th width='15%'>Produto</th>
                <th width='15%'>Quantidade</th>
                <th width='15%'>Unidade</th>
                <th width='15%'>Subtotal</th>
            </tr>
        </thead>
        <tbody>";
    foreach ($_SESSION['carrinho'] as $key => $value) {
        $subtotal = $_SESSION['qtd'][$key] * $itens[$key]['pro_preco'];
        
        $body_pedido .= "<tr>
            <td height='15%'>" . $_SESSION['carrinho'][$key] . "</td>
            <td height='15%'>" . $itens[$key]['pro_nome'] . "</td>
            <td height='15%'>" . $_SESSION['qtd'][$key] . "</td> 
            <td height='15%'>R$ " . number_format($itens[$key]['pro_preco'], 2) . "</td>
            <td height='15%'>R$ " . number_format($subtotal, 2) . "</td>
        </tr>";
    }
    $body_pedido .= "</tbody>
    </table>
    <p>Subtotal: R$ " . number_format($_SESSION['valor_subtotal'], 2) . "</p>
    <p>Taxa de Entrega: R$ " . number_format($_SESSION['delivery_price'], 2) . "</p>
    <p>Desconto do Cupom: R$ " . number_format($_SESSION['valor_cupom'], 2) . "</p>
    <p><b>Total: R$ " . number_format($_SESSION['valor_total'], 2) . "</b></p>";



//Balcao
if ($fk_endereco == null) {

    try {
        //Content
        $mail->isHTML(true);
        $mail->Subject = "[Pedido - Retirada] ".$subject;

        $mail->Body = "Data: <b>". $date . "</b><br>";
        $mail->Body .= "Cliente: <b>".$_SESSION['nome']." ".$_SESSION['sobrenome']. "</b>";

        $mail->Body .= $body_pedido;

        $mail->AltBody = '';
        

        $fk_origem_pedido = 1;
        $produtos = $itens;
        
        $salvo = $pedido->setPedido(null, $fk_origem_pedido, $produtos, TRUE);
            

        if ($salvo){
            $html .= "<script>swal('Pedido efetuado com sucesso! 😄', 'Obrigado!', 'success').then((value) => {window.location='/home/listarPedidos.php'});</script>";
        }else{
            $mail->Body .= "<p>*Erro ao salvar pedido na base de dados.</p>";
            
            $html .= "<script>swal('Tivemos um problema aqui...😕', 'Tente novamente.', 'info').then((value) => {window.location='/home/carrinho.php'});</script>";
        }
        
        
        $mail->send();
        
    } catch (Exception $e) {
        $html .= "<script>swal('Tivemos um problema aqui...😕', 'Tente novamente.', 'info').then((value) => {window.location='/home/carrinho.php'});</script>";
        echo $e;
    }
    
    echo $html;


//***************delivery**************   
} else {
    
    $control_endereco = new controlEndereco(conecta());
    $endereco_cliente = $control_endereco->selectById($fk_endereco);

    try {

        //Content
        $mail->isHTML(true);
        $mail->Subject = "[Pedido - Delivery] ".$subject;

        $num = $endereco_cliente->getNumero();
        $rua = $endereco_cliente->logradouro;
        $bairro = $endereco_cliente->bairro;

        $mail->Body = "Data: <b>". $date . "</b><br>";
        $mail->Body .= "Cliente: <b>".$_SESSION['nome']." ".$_SESSION['sobrenome']. "</b><br>";
        $mail->Body .= "Endereço: <b>".$rua.", ".$num." - ".$bairro."</b>";

        $mail->Body .= $body_pedido;

        $mail->AltBody = '';


        $fk_origem_pedido = 1;
        $produtos = $itens;
        $salvo = $pedido->setPedido($fk_endereco, $fk_origem_pedido, $produtos, TRUE);


        if ($salvo){
            $html .= "<script>swal('Pedido efetuado com sucesso! 😄', 'Obrigado!', 'success').then((value) => {window.location='/home/listarPedidos.php'});</script>";
        }else{
            $mail->Body .= "<p>*Erro ao salvar pedido na base de dados.</p>";
            
            $html .= "<script>swal('Tivemos um problema aqui...😕', 'Tente novamente.', 'info').then((value) => {window.location='/home/carrinho.php'});</script>";
        }
        

        $mail->send();

    } catch (Exception $e) {
        $html .= "<script>swal('Tivemos um problema aqui...😕', 'Tente novamente.', 'info').then((value) => {window.location='/home/carrinho.php'});</script>";

        // echo $mail->ErrorInfo;
    }

    echo $html;
}

//reset vars
$_SESSION['flag_combo'] = "";
$_SESSION['valor_cupom'] = 0.00;

unset($_SESSION['carrinho']);
unset($_SESSION['qtd']);
unset($_SESSION['observacao']);
unset($_SESSION['valor_subtotal']);

unset($_SESSION['cod_endereco']);
unset($_SESSION['endereco']);
$_SESSION['delivery'] = -1;
unset($_SESSION['delivery_indisponivel']);
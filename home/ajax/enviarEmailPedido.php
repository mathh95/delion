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


if(isset($_SESSION['carrinho'])){
    $itens_id_carrinho = $_SESSION['carrinho'];
}

if(isset($_SESSION['carrinho_resgate'])){
    $itens_id_resgate =  array_keys($_SESSION['carrinho_resgate']);
}

if(isset($_SESSION['adicionais_selecionados']) && !empty($_SESSION['adicionais_selecionados'])){
    $adicionais_selecionados = $_SESSION['adicionais_selecionados'];
}else{
    $adicionais_selecionados = "";
}

$empty = true;
if (!empty($itens_id_carrinho)) {
    $itens_carrinho = $cardapio->buscarVariosId($itens_id_carrinho);
    $empty = false;

}else{
    $itens_carrinho = array();
}

if(!empty($itens_id_resgate)){
    $itens_resgate = $cardapio->buscarVariosId($itens_id_resgate);
    $empty = false;

}else{
    $itens_resgate = array();
}


if($empty){
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
    
        
    //itens Carrinho convencional
    foreach ($itens_carrinho as $key => $item) {

        $subtotal_item = $_SESSION['qtd'][$key] * $item['pro_preco'];
        
        $valor_adicional_item = 0;
        $adicionais_txt = "";
        if(!empty($adicionais_selecionados) && isset($adicionais_selecionados[$item['pro_pk_id']])){

            foreach($adicionais_selecionados[$item['pro_pk_id']] as $item_adc){

                //preço * qtd_adicional
                $adc_precofinal = ($item_adc[2] * $item_adc[3]);
                $adc_precofinal_format = number_format($adc_precofinal, 2, ',', ' ');

                $valor_adicional_item += $adc_precofinal;

                if(!empty($item_adc) && $item_adc !== ''){
                    $adicionais_txt .= "<br> <span style='font-size:14px;'>+ ".$item_adc[3]." x ".$item_adc[1]." - R$ ".$adc_precofinal_format."</span>";
                }
            }
        }

        $subtotal_item += $valor_adicional_item;
        $subtotal_item_txt = number_format($subtotal_item, '2', ',', ' ');
        

        $body_pedido .= "<tr>
            <td height='15%'>" . $item['pro_pk_id'] . "</td>
            <td height='15%'>" . $item['pro_nome'].$adicionais_txt . "</td>
            <td height='15%'>" . $_SESSION['qtd'][$key] . "</td> 
            <td height='15%'>R$ " . number_format($item['pro_preco'], 2) . "</td>
            <td height='15%'>R$ " . $subtotal_item_txt . "</td>
        </tr>";
    }
    
    //itens de Resgate
    foreach ($itens_resgate as $key => $item) {

        $qtd_aux = $_SESSION['carrinho_resgate'][$item['pro_pk_id']]['qtd'];
        $subtotal_item = $qtd_aux * $item['pro_pts_resgate_fidelidade'];
        
        $body_pedido .= "<tr>
            <td height='15%'>" . $item['pro_pk_id'] . "</td>
            <td height='15%'>" . $item['pro_nome'] . "</td>
            <td height='15%'>" . $qtd_aux . "</td>
            <td height='15%'>" . $item['pro_pts_resgate_fidelidade']. " Pts Fidelidade</td>
            <td height='15%'>" . $subtotal_item . " Pts Fidelidade</td>
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
        $salvo = $pedido->setPedido(
            null,
            $fk_origem_pedido,
            $itens_carrinho,
            $adicionais_selecionados,
            TRUE,
            $itens_resgate
        );
        
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
        $salvo = $pedido->setPedido(
            $fk_endereco,
            $fk_origem_pedido,
            $itens_carrinho,
            $adicionais_selecionados,
            TRUE,
            $itens_resgate
        );


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
unset($_SESSION['adicionais_selecionados']);
unset($_SESSION['valor_subtotal']);

unset($_SESSION['carrinho_resgate']);

unset($_SESSION['cod_endereco']);
unset($_SESSION['endereco']);
$_SESSION['delivery'] = -1;
unset($_SESSION['delivery_indisponivel']);
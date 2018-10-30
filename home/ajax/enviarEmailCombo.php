<?php
session_start();
include_once "../../admin/controler/conexao.php";

require_once "../controler/controlAdicional.php";

require_once "../controler/controlCombo.php";

require_once "../controler/controlCardapio.php";

require_once "../controler/controlEndereco.php";

include_once "../lib/alert.php";

require_once "../../phpmailer/src/PHPMailer.php";
require_once '../../phpmailer/src/Exception.php';
require_once '../../phpmailer/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
    
$html = "<head>
            <script src=https://unpkg.com/sweetalert/dist/sweetalert.min.js></script>
            
         </head>
         <body>";
$pedido = new controlerCombo(conecta());
$cardapio = new controlerCardapio(conecta());
$controleAdicional = new controlerAdicional(conecta());
$mail = new PHPMailer();
if(isset($_SESSION['combo']) && !empty($_SESSION['combo'])){
    $itens = $_SESSION['combo'];

    if(isset($_POST['adicionais']) && !empty($_POST['adicionais'])){
        $adicionais = $_POST['adicionais'];
    }

    if($itens > 0){
        $itensCombo = array();
        foreach($itens as $item){
            array_push($itensCombo, $cardapio->selectSemCategoria($item, 2));
        }
    }

    if (isset($_SESSION['cod_endereco']) and !empty($_SESSION['cod_endereco'])){
        $cod_endereco = $_SESSION['cod_endereco'];
    }else{
        $cod_endereco = null;
    }

    if(count($itensCombo) >= 3){
        
        if(isset($_SESSION['cod_cliente']) && !empty($_SESSION['cod_cliente'])){
            
            if($_SESSION['delivery'] < 0){
                
                try{
                    //Server Settings
                    $mail->CharSet = 'UTF-8';
                    $mail->isSMTP();
                    $mail->SMTPDebug = 0;
                    $mail->Host = 'smtp.compubras.com.br';
                    $mail->SMTPSecure = 'tls';
                    $mail ->SMTPAuth  =  true; 
                    $mail->Username = 'sitefacil@compubras.com.br';
                    $mail->Password = 'http#2017';
                    $mail->Port = 587;

                    $mail->SMTPOptions = array(
                        'ssl' => array(
                        'verify_peer' => false,
                        'verify_peer_name' => false,
                        'allow_self_signed' => true
                        )
                    );
            
                    //Recipients
                    $mail->setFrom('teste@gmail.com', $_SESSION['nome']);
                    $mail->addAddress('delion_cafe@kionux.com.br', 'Delion Café');
            
                    //Content
                    $mail->isHTML(true);
                    $mail->Subject = 'Pedido Delion Café!';
                    $mail->Body = "<h1>Lista de produtos</h1>
                                        <table width='100%' border='1px'>
                                            <thead>
                                                <tr>
                                                    <th width='15%' height='20%'>Item</th>
                                                    <th width='15%'>Data</th>
                                                    <th width='15%'>Cliente</th>
                                                    <th width='15%'>Produto</th>
                                                    <th width='15%'>Adicionais</th>
                                                </tr>
                                            </thead>
                                            <tbody>";
                    foreach($itensCombo as $key => $value){
                        if(!empty($itensCombo[$key]->getAdicional())){
                            $adicionaisItem = $controleAdicional->buscarVariosId(json_decode($itensCombo[$key]->getAdicional()));
                        }else{
                            $adicionaisItem = array();
                        }
                        $mail->Body.= "<tr>
                                            <td height='15%'>".$_SESSION['combo'][$key]."</td>
                                            <td height='15%'>".date("r")."</td>
                                            <td height='15%'>".$_SESSION['nome']."</td>
                                            <td height='15%'>".$itensCombo[$key]->getNome()."</td>
                                            <td height='15%'>";
                                            foreach($adicionaisItem as $ad){
                                                if(!empty($adicionais[$key])){
                                                    if(in_array($ad['cod_adicional'], $adicionais[$key])){
                                                        $nomeAdicional = $ad['nome'];
                                                        $precoAdicional = $ad['preco'];
                                                        $mail->Body.= $nomeAdicional." R$ ".$precoAdicional."<br>";
                                                    }
                                                }
                                            }                  
                                            $mail->Body.="</td>
                                        </tr>";
                    }
                    $mail->Body.="</tbody>
                                </table>
                                <p>Valor total do pedido: ".number_format($_SESSION['totalCombo'], 2)."</p>";
                               
                                // echo '<pre>';
                                // print_r($mail->Body);
                                // echo '</pre>';
                                // exit;
                                
                    $mail->AltBody = 'Nem sei oque é isso kkkkkk';
                    $mail->send();
                }catch(Exception $e){
                    echo $mail->ErrorInfo;
                }
            
                $pedido->setCombo($adicionais);
            
                $html.= "<script>swal('Pedido efetuado com sucesso!!', 'Obrigado :)', 'success').then((value) => {window.location='/home'});</script></body>";
                echo $html;

            }else if(($_SESSION['delivery'] > 0 && $_SESSION['pedidoBalcaoCombo'] == 0)){

                if($cod_endereco != null){

                    $controlEndereco=new controlEndereco(conecta());
                    $endereco=$controlEndereco->select($cod_endereco,1)[0];
                    
                    try{
                        //Server Settings
                        $mail->CharSet = 'UTF-8';
                        $mail->isSMTP();
                        $mail->SMTPDebug = 0;
                        $mail->Host = 'smtp.compubras.com.br';
                        $mail->SMTPSecure = 'tls';
                        $mail ->SMTPAuth  =  true; 
                        $mail->Username = 'sitefacil@compubras.com.br';
                        $mail->Password = 'http#2017';
                        $mail->Port = 587;

                        $mail->SMTPOptions = array(
                            'ssl' => array(
                            'verify_peer' => false,
                            'verify_peer_name' => false,
                            'allow_self_signed' => true
                            )
                        );
                
                        //Recipients
                        $mail->setFrom('teste@gmail.com', $_SESSION['nome']);
                        $mail->addAddress('delion_cafe@kionux.com.br', 'Delion Café');
                
                        //Content
                        $mail->isHTML(true);
                        $mail->Subject = 'Pedido Delion Café!';
                        $mail->Body = "<h1>Lista de produtos</h1>
                                            <table width='100%' border='1px'>
                                                <thead>
                                                    <tr>
                                                        <th width='15%' height='20%'>Item</th>
                                                        <th width='15%'>Data</th>
                                                        <th width='15%'>Cliente</th>
                                                        <th width='15%'>Rua</th>
                                                        <th width='15%'>Produto</th>
                                                        <th width='15%'>Adicionais</th>
                                                    </tr>
                                                </thead>
                                                <tbody>";
                        foreach($itensCombo as $key => $value){
                            if(!empty($itensCombo[$key]->getAdicional())){
                                $adicionaisItem = $controleAdicional->buscarVariosId(json_decode($itensCombo[$key]->getAdicional()));
                            }else{
                                $adicionaisItem = array();
                            }
                            $mail->Body.= "<tr>
                                                <td height='15%'>".$_SESSION['combo'][$key]."</td>
                                                <td height='15%'>".date("r")."</td>
                                                <td height='15%'>".$_SESSION['nome']."</td>
                                                <td heght='15%'>".$endereco->getRua()."</td>
                                                <td height='15%'>".$itensCombo[$key]->getNome()."</td>
                                                <td height='15%'>";
                                                foreach($adicionaisItem as $ad){
                                                    if(!empty($adicionais[$key])){
                                                        if(in_array($ad['cod_adicional'], $adicionais[$key])){
                                                            $nomeAdicional = $ad['nome'];
                                                            $precoAdicional = $ad['preco'];
                                                            $mail->Body.= $nomeAdicional." R$ ".$precoAdicional."<br>";
                                                        }
                                                    }
                                                }                  
                                                $mail->Body.="</td>
                                            </tr>";
                        }
                        $mail->Body.="</tbody>
                                    </table>
                                    <p>Valor total do pedido: ".number_format($_SESSION['totalCombo'], 2)."</p>";
                                   
                                    // echo '<pre>';
                                    // print_r($mail->Body);
                                    // echo '</pre>';
                                    // exit;
                                    
                        $mail->AltBody = 'Nem sei oque é isso kkkkkk';
                        $mail->send();
                    }catch(Exception $e){
                        echo $mail->ErrorInfo;
                    }
                
                    $pedido->setCombo($adicionais);

                    $_SESSION['flag_combo'] = "";
                    $_SESSION['cod_endereco'] = "";
                
                    $html.= "<script>swal('Pedido efetuado com sucesso!!', 'Obrigado :)', 'success').then((value) => {window.location='/home'});</script></body>";
                    echo $html;

                }else{
                    $_SESSION['flag_combo'] = 1;
                    $html.= "<script>swal('Escolha um endereço!!', 'Estamos te enviando para tela de seleção de endereços!', 'info').then((value) => {window.location='/home/endereco.php'});</script></body>";
                    echo $html; 
                }


            }else{
                $html.= "<script>swal('Acesso negado!!', 'Seu pedido contém produtos que não podem ser entregues delivery', 'info').then((value) => {window.location='/home/combo.php'});</script></body>";
                echo $html; 
            }
            
        }else{
            $html.= "<script>swal('Acesso negado!!', 'É preciso estar logado pra finalizar o pedido!', 'error').then((value) => {window.location='/home/login.php'});</script></body>";
            echo $html;
        }

    }else{
        $html.= "<script>swal('Acesso negado!!', 'É preciso ter no minimo 3 itens no combo!', 'error').then((value) => {window.location='/home/combo.php'});</script></body>";
        echo $html;  
    }

}else {
    $html.= "<script>swal('Acesso negado!!', 'É preciso ter itens no combo!', 'error').then((value) => {window.location='/home/cardapio.php'});</script></body>";
    echo $html;
}

?>
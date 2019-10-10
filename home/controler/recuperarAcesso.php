<?php  
    //session_start();
    include "controlCliente.php";
    include_once "../lib/alert.php";

    require_once "../../phpmailer/src/PHPMailer.php";
    require_once '../../phpmailer/src/Exception.php';
    require_once '../../phpmailer/src/SMTP.php';

    use PHPMailer\PHPMailer\PHPMailer;


    if (isset($_POST) and !empty($_POST)){

        $erro = 0;

        $control=new controlCliente($_SG['link']);
        
        $login = addslashes(htmlspecialchars($_POST['login']));
        $cod_recuperacao = bin2hex(openssl_random_pseudo_bytes(6));//12 chars

        $cliente = $control->select($login, 3);
        $cod_cliente = $cliente->getCod_cliente();

        $date = new DateTime('now', new DateTimeZone('America/Sao_Paulo'));

        $date = $date->format('Y-m-d H:i');

        $time = new DateTime($date);
        $time->add(new DateInterval('PT10M'));

        $stamp = $time->format('Y-m-d H:i');
        $data_expiracao = $stamp;

        $recuperacao = $control->insertRecuperaSenha($cod_cliente, $cod_recuperacao, $data_expiracao);

        if($recuperacao == 1) {
            $enviado = enviarEmailRecuperacao($cod_cliente, $login, $cod_recuperacao);

            if($enviado < 1){
                $erro++;
            }

        }else{
            $erro ++;
        }

        if ($erro > 0 ){
             alertJSVoltarPagina("Erro!","Erro, não foi possível recuperar, tente novamente.", 2);
             header("Location:../recuperaSenha.php");
        }else{
            alertJS("E-mail de recuperação enviado!");

            header("Location:../login.php?recuperacao_enviada=true");
        }

    }else {
        header("Location:../");
    }



    function enviarEmailRecuperacao($cod_cliente, $login, $cod_recuperacao){
        $mail = new PHPMailer();

        $parts = explode("@", $login);
        $nome = $parts[0];

        $url_site = "http://delion.test/home";

        try {
            //Server Settings
            $mail->CharSet = 'UTF-8';
            $mail->isSMTP();
            $mail->SMTPDebug = 0;
            $mail->Host = 'smtp.compubras.com.br';
            $mail->SMTPSecure = 'tls';
            $mail->SMTPAuth  =  true;
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
            $mail->setFrom('delion_recuperacao_teste@gmail.com', 'Delion Café');
            $mail->addAddress($login, $nome);
            
            //Content
            $mail->isHTML(true);
            $mail->Subject = 'Recuperação de Senha - Delion Café';
            $mail->Body = "<h1>Link para Recuperar Acesso...Expira em 10 minutos.</h1><br>";

            $mail->Body .= "<p>".$url_site."/alterarSenhaRecuperacao.php?cli=".$cod_cliente."&cod=".$cod_recuperacao."</p>";

            $mail->AltBody = "";

            $mail->send();
            
            return 1;

        } catch (Exception $e) {
            echo $mail->ErrorInfo;

            return -1;
        }

        //unset($_SESSION['']);
    }

?>

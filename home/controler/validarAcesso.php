<?php  
    //session_start();
    include "controlCliente.php";
    include_once "../lib/alert.php";

    include_once "../utils/GoogleRecaptcha.php";


    $html = "<head>
            <meta name='viewport' content='width=device-width, initial-scale=1.0'>  
            <style>
                @media only screen and (max-width: 767px) {
                    .modal-dialog{
                        width: 95%;
                        height: 25%;
                        margin-top: 50%;
                        text-align: center;
                    }
                    .bootstrap-dialog-header {
                        text-align: center;
                    }
                    .bootstrap-dialog-title{
                        font-size: 50px;
                    }
                    .bootstrap-dialog-message{
                        font-size: 40px;
                    }
                    .btn btn-lg btn-default{
                        font-size: 50px;
                    }
                }
            </style>
         </head>";

    if (isset($_POST) and !empty($_POST)){

        $control=new controlCliente($_SG['link']);
        $login = addslashes(htmlspecialchars($_POST['login']));
        $senha = addslashes(htmlspecialchars($_POST['senha']));
        
        $token_login=addslashes(htmlspecialchars($_POST['grecaptcha_token_login'])); 
            
        $google_recaptcha = new GoogleRecaptcha();
        //Valida reCAPTCHAv3            
        $valid_token = $google_recaptcha->verificaToken($token_login);

        if($valid_token){
            
            $result = $control->validaCliente($login, $senha);
            
            if ($result == 2 ){

                if (isset($_SESSION['carrinho']) and !empty($_SESSION['carrinho'])){
                    if (isset($_SESSION['delivery']) and $_SESSION['delivery'] > 0){
                        header("Location:../endereco.php?is_selecao_end=true"); 
                    }else{
                        header("Location:../carrinho.php"); 
                    }

                }else{
                    header("Location: ../cardapio.php");
                }

            }elseif ($result == 1) {
                alertJSVoltarPagina("Erro!","Erro, sua senha não confere.", 2);
            }elseif ($result == 0) {
                alertJSVoltarPagina("Erro!","Erro, login não cadastrado.", 2);
            }elseif ($result == 3) {
                alertJSVoltarPagina("Erro!","Erro, sua conta está desativada. Entre em contato com o suporte.", 2);
            }else{
                alertJSVoltarPagina("Erro!","Erro, não foi possível logar.", 2);
            }
        }else{
            echo "reCAPTCHA inválido!";
            return;
        }

        echo $html;

        
    }else {
        header("Location:../");
    }
?>

<?php  
    //session_start();
    include "controlCliente.php";
    include_once "../lib/alert.php";

    include_once "../utils/GoogleRecaptcha.php";

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
                        header("Location:../endereco.php"); 
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
                alertJSVoltarPagina("Erro!","Erro, cadastro desativado.", 2);
            }else{
                alertJSVoltarPagina("Erro!","Erro, não foi possível logar.", 2);
            }
        }else{
            echo "reCAPTCHA inválido!";
            return;
        }

        
    }else {
        header("Location:../");
    }
?>

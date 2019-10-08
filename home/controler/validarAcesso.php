<?php  
    //session_start();
    include "controlCliente.php";
    include_once "../lib/alert.php";

    if (isset($_POST) and !empty($_POST)){

        $control=new controlCliente($_SG['link']);
        $login = addslashes(htmlspecialchars($_POST['login']));
        $senha = addslashes(htmlspecialchars($_POST['senha']));
        
        $result=$control->validaCliente($login, $senha);

        if ($result == 2 ){
            if (isset($_SESSION['carrinho']) and !empty($_SESSION['carrinho'])){
                if (isset($_SESSION['delivery']) and $_SESSION['delivery'] > 0){
                    header("Location:../endereco.php"); 
                }else{
                    header("Location:../carrinho.php"); 
                }
            }else{
                header("Location: ../");
            }
        }elseif ($result == 1) {
            alertJSVoltarPagina("Erro!","Erro, sua senha não confere.", 2);
        }elseif ($result == 0) {
            alertJSVoltarPagina("Erro!","Erro, login não cadastrado.", 2);
        }else{
            alertJSVoltarPagina("Erro!","Erro, não foi possível logar.", 2);
        }
    }else {
        header("Location:../");
    }
?>

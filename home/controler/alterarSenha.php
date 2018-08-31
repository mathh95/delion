<?php 
    include_once("controlCliente.php");
    include_once "../lib/alert.php";
    $cod_cliente = $_POST['cod_cliente'];
    $senha = addslashes(htmlspecialchars($_POST['senha']));
    $confirma = addslashes(htmlspecialchars($_POST['confirma']));
    $novaSenha = addslashes(htmlspecialchars($_POST['novaSenha']));
    if ( $confirma === $novaSenha ){
        $control = new controlCliente($_SG['link']);
        $result=$control->updateSenha($cod_cliente,$senha,$novaSenha);
        if ($result == 2){
            alertJSVoltarPagina("Sucesso!","Sua senha foi alterada com sucesso.", 1);
        }elseif($result == -2){
            alertJSVoltarPagina("Erro!","Erro, sua senha não confere", 2);
        }else{
            alertJSVoltarPagina("Erro!","Erro, não foi possível alterar sua senha.", 2);
        }
    }else {
        alertJSVoltarPagina("Erro!","Erro, sua nova senha e a confirmação não conferem.", 2);
    }
?>
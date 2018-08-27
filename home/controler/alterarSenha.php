<?php 
    include_once("controlCliente.php");
    $cod_cliente = $_POST['cod_cliente'];
    $senha = addslashes(htmlspecialchars($_POST['senha']));
    $confirma = addslashes(htmlspecialchars($_POST['confirma']));
    $novaSenha = addslashes(htmlspecialchars($_POST['novaSenha']));
    if ( $confirma === $novaSenha ){
        $control = new controlCliente($_SG['link']);
        $result=$control->updateSenha($cod_cliente,$senha,$novaSenha);
        if ($result == 2){
            header("Location: ../alterarSenha.php");
        }else{
            echo "erro";
        }
    }else {
        echo "a nova senha e a confirmação não conferem";
    }
?>
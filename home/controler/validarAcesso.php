<?php  
    //session_start();
    include "controlCliente.php";
    $control=new controlCliente($_SG['link']);
    $login = addslashes(htmlspecialchars($_POST['login']));
    $senha = addslashes(htmlspecialchars($_POST['senha']));
    $teste=$control->validaCliente($login, $senha);
    if ($teste==2){
        header("Location: ../");
    }
?>

<?php  
    session_start();
    include "controlCliente.php";
    $control=new controlCliente($_SG['link']);
    $teste=$control->validaCliente($_POST['login'], $_POST['senha']);
    if ($teste=2){
        header("Location: ../");
    }
?>

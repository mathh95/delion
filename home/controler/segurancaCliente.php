<?php 
    function protegeCliente(){
        if (!isset($_SESSION['cod_cliente']) OR !isset($_SESSION['nome'])) {
            session_destroy();
            header('Location:../home/login.php');
        }
    }
?>
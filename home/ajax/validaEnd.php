<?php
    session_start();

    if(isset($_GET['endereco']) && !empty($_GET['endereco'])){
        $_SESSION['cod_endereco'] = $_GET['endereco'];
    }else{
        $_SESSION['cod_endereco'] = '';
    }
?>
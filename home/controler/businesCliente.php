<?php 
    include_once $_SERVER['DOCUMENT_ROOT']."/config.php"; 
    include_once MODELPATH."/cliente.php";
    include_once LIBSPATH."/alert.php";
    include_once "controlCliente.php";
        $nome= $_POST['nome'];
        $login=$_POST['login'];
        $senha=$_POST['senha'];
        $telefone=$_POST['telefone'];
        $cliente = new cliente;
        $cliente->construct($nome,$login,$senha,$telefone);
        $control = new controlCliente($_SG['link']);
        $result=$control->insert($cliente);
        if ($result > 0){
            $control->validaCliente($cliente->getLogin(),$cliente->getSenha());
            header("Location: ../");
        }else{
            echo "erro";
        }
?>
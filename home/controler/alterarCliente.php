<?php 
    include_once $_SERVER['DOCUMENT_ROOT']."/config.php"; 
    include_once MODELPATH."/cliente.php";
    include_once "controlCliente.php";
        $cod_cliente= $_POST['cod_cliente'];
        $nome= $_POST['nome'];
        $login=$_POST['login'];
        $telefone=$_POST['telefone'];
        $cliente = new cliente;
        $cliente->setLogin($login);
        $cliente->setNome($nome);
        $cliente->setTelefone($telefone);
        $cliente->setCod_cliente($cod_cliente);
        $control = new controlCliente($_SG['link']);
        $result=$control->update($cliente);
        if ($result > 0){
            echo "sucesso";
            //header("Location: ../");
        }else{
            echo "erro";
        }
?>
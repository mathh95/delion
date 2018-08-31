<?php 
    include_once $_SERVER['DOCUMENT_ROOT']."/config.php"; 
    include_once MODELPATH."/cliente.php";
    include_once "controlCliente.php";
    include_once "../lib/alert.php";
    
        $cod_cliente= $_POST['cod_cliente'];
        $nome= addslashes(htmlspecialchars($_POST['nome']));
        $login=addslashes(htmlspecialchars($_POST['login']));
        $telefone=addslashes(htmlspecialchars($_POST['telefone']));
        $cliente = new cliente;
        $cliente->setLogin($login);
        $cliente->setNome($nome);
        $cliente->setTelefone($telefone);
        $cliente->setCod_cliente($cod_cliente);
        $control = new controlCliente($_SG['link']);
        $result=$control->update($cliente);
        if ($result > 0){
            alertJSVoltarPagina("Sucesso!","Seus dados foram alterados com sucesso!",1);
        }else{
            alertJSVoltarPagina("Erro!","Não foi possível alterar seus dados.",1);
        }
?>
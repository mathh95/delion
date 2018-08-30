<?php 
    include_once $_SERVER['DOCUMENT_ROOT']."/config.php"; 
    include_once MODELPATH."/cliente.php";
    include_once "controlCliente.php";
        $nome= addslashes(htmlspecialchars($_POST['nome']));
        $login=addslashes(htmlspecialchars($_POST['login']));
        $senha=addslashes(htmlspecialchars($_POST['senha']));
        $telefone=addslashes(htmlspecialchars($_POST['telefone']));
        $status=1;
        $cliente = new cliente;
        $cliente->construct($nome,$login,$senha,$telefone,$status);
        $control = new controlCliente($_SG['link']);
        $result=$control->insert($cliente);
        if ($result > 0){
            $control->validaCliente($cliente->getLogin(),$cliente->getSenha());
            header("Location: ../");
        }else{
            echo "erro";
        }
?>
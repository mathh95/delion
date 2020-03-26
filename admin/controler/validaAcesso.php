<?php
    include "log.php";
    include_once "../lib/alert.php";

    // Verifica se houve POST e se o usuário ou a senha é(são) vazio(s)
    if (!empty($_POST) AND (empty($_POST['usuario']) OR empty($_POST['senha']))) {
        header("Location: ../view/login.php"); exit;
    }

    $_SESSION['pagina']=1;
    $_SESSION['acao']=1;
    $password=$_POST['senha'];
    $usuario=$_POST['usuario'];

    include_once "seguranca.php";
    $retorno=validaUsuario($usuario,$password);
    if ($retorno==1) {
       
        header("Location: ../sistema.php");
    } else {
        if ($retorno==-1) {
            msgRedireciona('Erro ao acessar!','Senha incorreta!',2,'../view/login.php');
        }elseif($retorno==-2){
            msgRedireciona('Erro ao acessar!','Usuário bloqueado!',2,'../view/login.php');
        }elseif ($retorno==-3) {
            msgRedireciona('Erro ao acessar!','Login ou senha incorretos!',2,'../view/login.php');
        }
    }
?>
<?php 
    include_once $_SERVER['DOCUMENT_ROOT']."/config.php"; 
    include_once MODELPATH."/cliente.php";
    include_once HOMEPATH."home/controler/controlCliente.php";
    include_once "seguranca.php";
    include_once "../lib/alert.php";
	protegePagina();
        if (in_array('cliente', json_decode($_SESSION['permissao']))) {
            if (!isset($_POST)||empty($_POST)){
                echo 'Nada foi postado.';
            }
            $cod_cliente= $_POST['cod_cliente'];
            $nome= addslashes(htmlspecialchars($_POST['nome']));
            $login=addslashes(htmlspecialchars($_POST['login']));
            $telefone=addslashes(htmlspecialchars($_POST['telefone']));
            $cliente = new cliente;
            $cliente->setLogin($login);
            $cliente->setNome($nome);
            $cliente->setTelefone($telefone);
            $cliente->setPkId($cod_cliente);
            $control = new controlCliente($_SG['link']);
            $result=$control->update($cliente);
            
            if($result> -1){
                msgRedireciona('Alteração Realizada!','Usuário alterado com sucesso!',1,'../view/admin/clienteLista.php');
            }else{
                alertJSVoltarPagina('Erro!','Erro ao alterar cliente!',2);
            }
        }else{
            expulsaVisitante();
        }
?>
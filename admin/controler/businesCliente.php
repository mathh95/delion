<?php 
    include_once $_SERVER['DOCUMENT_ROOT']."/config.php"; 
    include_once MODELPATH."/cliente.php";
    include_once HOMEPATH."home/controler/controlCliente.php";
    include_once "../lib/alert.php";
    protegePagina();	
	if (in_array('cliente', json_decode($_SESSION['permissao']))) {
		if (!isset($_POST)||empty($_POST)){
			echo 'Nada foi postado.';
        }
        $nome= addslashes(htmlspecialchars($_POST['nome']));
        $login=addslashes(htmlspecialchars($_POST['login']));
        $senha=addslashes(htmlspecialchars($_POST['senha']));
        $telefone=addslashes(htmlspecialchars($_POST['telefone']));
        $status=1;
        $cliente = new cliente;
        $cliente->construct($nome,$login,$senha,$telefone,$status);
        $control = new controlCliente($_SG['link']);
        $result=$control->insert($cliente);
		
		if($result > -1){
			msgRedireciona('Cadastro Realizado!','Cliente cadastrado com sucesso!',1,'../view/admin/cliente.php');
		}else{
			alertJSVoltarPagina('Erro!','Erro ao cadastrar cliente!',2);
		}
	}else{
		expulsaVisitante();
	}
?>
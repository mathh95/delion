<?php 
    include_once "seguranca.php";
    include_once $_SERVER['DOCUMENT_ROOT']."/config.php"; 
    include_once MODELPATH. "/cliente-wpp.php";
    include_once CONTROLLERPATH."/controlClienteWpp.php";
    include_once "../lib/alert.php";
    protegePagina();
    // echo ("<pre>");
    // print_r($_SESSION['permissao']);
    // echo("</pre>");
	if (in_array('pedidoWpp', json_decode($_SESSION['permissao']))) {
		if (!isset($_POST)||empty($_POST)){
			echo 'Nada foi postado.';
        }
        $nome= addslashes(htmlspecialchars($_POST['nome']));
        $telefone=addslashes(htmlspecialchars($_POST['telefone']));
        $rua=addslashes(htmlspecialchars($_POST['rua']));
        $numero=addslashes(htmlspecialchars($_POST['numero']));
        $bairro=addslashes(htmlspecialchars($_POST['bairro']));
        $complemento=addslashes(htmlspecialchars($_POST['complemento']));
        $status=1;
        $clienteWpp = new ClienteWpp;
        $clienteWpp->construct($nome, $telefone, $rua, $numero, $bairro, $complemento);

        
        // echo ("<pre>");
        // print_r($clienteWpp);
        // echo("</pre>");
        $control = new controlClienteWpp($_SG['link']);
        $result=$control->insert($clienteWpp);
		
		if($result > -1){
			msgRedireciona('Pedido realizado!','Pedido cadastrado com sucesso!', 1,'../view/admin/pedidoWppLista.php');
		}else{
			alertJSVoltarPagina('Erro!','Erro ao cadastrar pedido!',2);
		}
	}else{
		expulsaVisitante();
    }
?>
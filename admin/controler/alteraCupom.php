<?php
	include_once "seguranca.php";
	protegePagina();

	include_once "controlCupom.php";
	include_once "../model/cupom.php";
	include_once "../lib/alert.php";
	if (in_array('pedidoWpp', json_decode($_SESSION['permissao']))) {
		if (!isset($_POST)||empty($_POST)){
			echo 'Nada foi postado.';
		}
        
		$cod_cupom= addslashes(htmlspecialchars($_POST['cod']));
        if(isset($_POST['valor']) && !empty($_POST['valor'] && $_POST['valor'] >= '0.00')){
            $valor = addslashes(htmlspecialchars($_POST['valor']));
        }
        $dv = explode("-", $_POST['vencimento_data']);
            if(isset($_POST['vencimento_data']) && !empty($_POST['vencimento_data'] 
            && preg_match("/^(19|20)\d\d[\-\/.](0[1-9]|1[012])[\-\/.](0[1-9]|[12][0-9]|3[01])$/", $_POST['vencimento_data'])
            && checkdate($dv[1], $dv[2], $dv[0])==true)){
                $vencimento_data= addslashes(htmlspecialchars($_POST['vencimento_data']));
		}
		
		if(isset($_POST['vencimento_hora']) && !empty($_POST['vencimento_hora']) 
    	&& preg_match("/^(?:2[0-3]|[01][0-9]):[0-5][0-9]$/", $_POST['vencimento_hora'])){
        	$vencimento_hora= addslashes(htmlspecialchars($_POST['vencimento_hora']));
    	}
		
		$cupom= new cupom();
		$cupom->construct1($valor, $vencimento_data, $vencimento_hora);

		$cupom->setCod_cupom($cod_cupom);
		$controle=new controlCupom($_SG['link']);
		if($controle->update($cupom)> -1 ){
			msgRedireciona('Alteração Realizada!','Cupom alterado com sucesso!',1,'../view/admin/cupomLista.php');
		}else{
			alertJSVoltarPagina('Erro!','Erro ao alterar cupom!',2);
		}
	}else{
		expulsaVisitante();
	}
?>
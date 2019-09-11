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
        $dv = explode("-", $_POST['vencimento']);
            if(isset($_POST['vencimento']) && !empty($_POST['vencimento'] 
            && preg_match("/^(19|20)\d\d[\-\/.](0[1-9]|1[012])[\-\/.](0[1-9]|[12][0-9]|3[01])$/", $_POST['vencimento'])
            && checkdate($dv[1], $dv[2], $dv[0])==true)){
                $vencimento= addslashes(htmlspecialchars($_POST['vencimento']));
        }
		

		

		
	
		$cupom= new cupom();
		$cupom->construct1($valor, $vencimento);

		$cupom->setCod_cupom($cod_cupom);
		$controle=new controlCupom($_SG['link']);
		if($controle->update($cupom)> -1 ){
			msgRedireciona('Alteração Realizada!','Cupom alterado com sucesso!',1,'../view/admin/cupomLista.php');
		}else{
			alertJSVoltarPagina('Erro!','Erro ao alterar cupom!',2);
			$cupom->show();
		}
	}else{
		expulsaVisitante();
	}
?>
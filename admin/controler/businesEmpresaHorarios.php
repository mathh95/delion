<?php
	include_once "seguranca.php";
	protegePagina();

	// mysql_set_charset('utf8');
	date_default_timezone_set('America/Sao_Paulo');

	include_once "controlEmpresa.php";
	include_once "../model/empresa.php";
	include_once "../lib/alert.php";
	include_once "upload.php";
	
	if (in_array('empresa', json_decode($_SESSION['permissao']))) {
		if (!isset($_POST)||empty($_POST)){
			echo 'Nada foi postado.';
		}
		
		if(isset($_POST['aberto']) && !empty($_POST['aberto'])){
            $aberto = 1;
        }else{
			$aberto = 0;
		}
		if(isset($_POST['entregando']) && !empty($_POST['entregando'])){
            $entregando = 1;
        }else{
			$entregando = 0;
		}

		$dias_semana = addslashes(htmlspecialchars($_POST['dias_semana']));
		$horario_semana = addslashes(htmlspecialchars($_POST['horario_semana']));
		$dias_fim_semana = addslashes(htmlspecialchars($_POST['dias_fim_semana']));
		$horario_fim_semana = addslashes(htmlspecialchars($_POST['horario_fim_semana']));

		
		$empresa= new empresa();
		$empresa->constructFuncionamento($dias_semana, $horario_semana, $dias_fim_semana, $horario_fim_semana, $arr_dias, $arr_horarios_inicio, $arr_horarios_final, $aberto, $entregando);

		$empresa->setCod_empresa($cod_empresa);
		$controle=new controlerEmpresa($_SG['link']);
		if($controle->updateFuncionamento($empresa) > -1){
			msgRedireciona('Cadastro Realizado!','Horáios de Funcionamento da Empresa cadastrada com sucesso!',1,'../view/admin/empresa.php');
		}else{
			alertJSVoltarPagina('Erro!','Erro ao alterar empresa!',2);
			$empresa->show();
		}
	}else{
		expulsaVisitante();
	}
?>
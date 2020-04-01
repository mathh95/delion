<?php
    include_once "seguranca.php";
    protegePagina();

    //mysql_set_charset('utf8')
    date_default_timezone_set('America/Sao_Paulo');

    include_once "controlFaixaHorario.php";
    include_once "../lib/alert.php";
    include_once "upload.php";

    if(in_array('cardapio', json_decode($_SESSION['permissao']))) {
        if(!isset($_POST) || empty($_POST)){
            echo 'Nada foi postado.';
        }        
    
		$faho_nome = $_POST['nome'];
		$faho_inicio = $_POST['inicio'];
		$faho_final = $_POST['final'];


        $faixa_horario = new faixaHorario();
        $faixa_horario->construct($faho_inicio, $faho_final, $faho_nome);

        $controle = new controlerFaixaHorario($_SG['link']);
        if($controle->insert($faixa_horario)> -1){
            msgRedireciona('Cadastro Realizado!','Faixa de Horário cadastrada!',1,'../view/admin/gerenciarFaixaHorarios.php');
        }else{
            alertJSVoltarPagina('Erro','Erro ao cadastrar Faixa de Horário!',2);
            $faixa_horario->show();
        }
    }else{
        expulsaVisitante();
    }
?>

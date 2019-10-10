<?php

include_once "seguranca.php";
protegePagina();

// mysql_set_charset('utf8');
date_default_timezone_set('America/Sao_Paulo');

include_once "controlTipoAvaliacao.php";
include_once "../lib/alert.php";

    if(in_array('avaliacao', json_decode($_SESSION['permissao']))){
        if(!isset($_POST) || empty($_POST)){
            echo "Nada foi postado";
        }else{
            $nome = addslashes(htmlspecialchars($_POST['nome']));
            $flag = (isset($_POST['flag'])||!empty($_POST['flag'])) && $_POST['flag'] == "ativo" ? 1 : 0 ;

            $avaliacao = new tipoAvaliacao();
            $avaliacao->setNome($nome);
            $avaliacao->setFlag_ativo($flag);

            $controle = new controlerTipoAvaliacao($_SG['link']);

            if($controle->insert($avaliacao) > -1){
                msgRedireciona('Cadastro Realizado!','Tipo de avaliação cadastrado com sucesso!',1,'../view/admin/tipoAvaliacao.php');
            }else{
                alertJSVoltarPagina('Erro!','Erro ao cadastrar tipo de avaliação!',2);
                $cardapio->show();
            }
        }
    }else{
        expulsaVisitante();
    }

?>
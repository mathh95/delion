<?php

    include_once "seguranca.php";
    protegePagina();

    include_once "controlIngrediente.php";
    include_once "../lib/alert.php";
    include_once "upload.php";

    if(in_array('gerenciar_composicao', json_decode($_SESSION['permissao']))){
        if(!isset($_POST) || empty($_POST)){
            echo 'Nada foi postado';
        }
        
        $nome= addslashes(htmlspecialchars($_POST['itemComposicao']));
        $unidade= addslashes(htmlspecialchars($_POST['medidaItem']));
        $valor= addslashes(htmlspecialchars($_POST['valor']));
        

        $ingrediente = new ingrediente();
        $ingrediente->construct($nome,$unidade,$valor);

        $controle= new controlerIngrediente($_SG['link']);
        $cod_ingrediente = $controle->insert($ingrediente);
        // $result = $controle->insertHistorico($cod_ingrediente, $ingrediente);
        if($cod_ingrediente> -1){
            $controle->insertHistorico($cod_ingrediente, $ingrediente);
            msgRedireciona('Cadastro Realizado!','Ingrediente cadastrado!',1,'../view/admin/ingredientesLista.php');
            // echo $cod_ingrediente;
        }else{
            alertJSVoltarPagina('Erro','Erro ao cadastrar ingrediente!',2);
            $ingrediente->show();
        }
    }else {
        expulsaVisitante();
    }

?>
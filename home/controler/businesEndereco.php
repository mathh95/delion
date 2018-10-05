<?php 
    include_once $_SERVER['DOCUMENT_ROOT']."/config.php"; 
    include_once MODELPATH."/endereco.php";
    include_once "controlEndereco.php";
    include_once CONTROLLERPATH."/seguranca.php";
    include_once "../lib/alert.php";
    $control= new controlEndereco($_SG['link']);
    $endereco= new endereco();
    $rua=addslashes(htmlspecialchars($_POST['rua']));
    $cep=addslashes(htmlspecialchars($_POST['cep']));
    $numero=addslashes(htmlspecialchars($_POST['numero']));
    $bairro=addslashes(htmlspecialchars($_POST['bairro']));
    $complemento=addslashes(htmlspecialchars($_POST['complemento']));
    $cliente= addslashes(htmlspecialchars($_POST['cod_cliente']));
    $endereco->construct($rua,$numero,$cep,$complemento,$bairro,$cliente);
    $result=$control->insert($endereco);
    if ($result > 0){
        alertJSVoltarPagina("Sucesso!","O endereço foi cadastrado com sucesso!",1);
    }else{
        alertJSVoltarPagina("Erro!","Não foi cadastrar o endereço.",1);
    }
?>
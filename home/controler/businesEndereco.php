<?php 
    include_once $_SERVER['DOCUMENT_ROOT']."/config.php"; 
    include_once MODELPATH."/endereco.php";
    include_once "controlEndereco.php";
    include_once CONTROLLERPATH."/seguranca.php";
    include_once "../lib/alert.php";
    $control= new controlEndereco($_SG['link']);
    $endereco= new endereco();
    $rua=$_POST['rua'];
    $numero=$_POST['numero'];
    $cep=$_POST['cep'];
    $complemento=$_POST['complemento'];
    $bairro=$_POST['bairro'];
    //pegar cliente da sessao
    $cliente=5;
    $endereco->construct($rua,$numero,$cep,$complemento,$bairro,$cliente);
    $result=$control->insert($endereco);
    if ($result > 0){
        alertJSVoltarPagina("Sucesso!","O endereço foi cadastrado com sucesso!",1);
    }else{
        alertJSVoltarPagina("Erro!","Não foi cadastrar o endereço.",1);
    }
?>
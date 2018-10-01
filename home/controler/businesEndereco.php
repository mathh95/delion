<?php 
    include_once $_SERVER['DOCUMENT_ROOT']."/config.php"; 
    include_once MODELPATH."/endereco.php";
    include_once "controlEndereco.php";
    include_once CONTROLLERPATH."/seguranca.php";
    include_once "../lib/alert.php";
    $control= new controlEndereco($_SG['link']);
    $endereco= new endereco();
    $rua="asdasd";
    $numero="123";
    $cep="85851-030";
    $complemento="sdfsd";
    $bairro="tijuca";
    $cliente=5;
    $endereco->construct($rua,$numero,$cep,$complemento,$bairro,$cliente);
    $result=$control->insert($endereco);
    echo $result;
/*     if (isset($_POST) and !empty($_POST)){

    }else{
        echo -1;
    }    */
?>
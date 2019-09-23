<?php
include_once $_SERVER['DOCUMENT_ROOT']."/config.php"; 
include_once MODELPATH. "/cupom.php";
include_once CONTROLLERPATH."/seguranca.php";

include_once "../../admin/controler/controlCupom.php";
include_once "../../admin/controler/controlCupom_cliente.php";
protegePagina();

date_default_timezone_set('America/Sao_Paulo');

// session_start();
$controlcupom = new controlCupom($_SG['link']);
$cupom = $controlcupom->selectAll();
$cupom1 = array_shift($cupom);

$controlcheck = new controlCupom_cliente($_SG['link']);
$check = $controlcheck->selectAll();
$check1 = array_shift($check);

$acao = $_GET['acao'];
$codigo = $_GET['codigocupom'];

echo "<pre>";
var_dump($codigo);
echo "</pre>";
echo "<pre>";
var_dump($check1);
echo "</pre>";
echo "<pre>";
var_dump($cupom);
echo "</pre>";
if($acao == "checar"){
    if( $codigo == $check1[0]['codigo'] && $codigo != ""){
        echo "<b>CODIGO DIGITADO IGUAL AO DO CUPOM.</b>";
    }elseif($codigo != $check1[0]['codigo'] & $codigo != ""){
        echo "<b>CODIGOS DIFERENTES!!</b>";
    }else {
        echo "<b>BOTAO CLICADO SEM VALOR</b>";
    }
    

    

    
}



<?php
include_once CONTROLLERPATH."/controlerGerenciaSite.php";
include_once MODELPATH."/gerencia_site.php";

    /*
        Arquivo para selecionar o 
        esquema de cores escolhido pelo usuário,
        eliminando assim a replicação de código
    */

    $controle=new controlerGerenciarSite($_SG['link']);
    $config = $controle->selectConfigValida();
    $imagemLink = $config->getFoto();
    
    
        if(empty($imagemLink) && !isset($imagemLink)){
            $imagemLink = "home/img/Logo_branca.png";
            $corPrim = "#D22730";
            $corSec = "#C6151F";

        }else{
            $imagemLink = "admin/".$imagemLink;
            $corPrim = $config->getCorPrimaria();
            $corSec = $config->getCorSecundaria();
        }


?>
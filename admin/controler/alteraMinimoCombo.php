<?php
	include_once "seguranca.php";
	protegePagina();
	include_once "../model/adicional.php";
	include_once "../lib/alert.php";
    include_once HOMEPATH."home/controler/controlCombo.php";

    $controlerCombo= new controlerCombo(conecta());
    $minimo = $_POST['minimo'];
    $result= $controlerCombo->updateMinCombo($minimo);
    echo $result;
?>
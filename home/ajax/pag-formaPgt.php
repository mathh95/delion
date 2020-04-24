<?php
include_once "../../admin/controler/controlFormaPgt.php";
include_once "../../admin/model/forma_pgto.php";

$controlFormaPgt = new controlerFormaPgt($_SG['link']);
$formasPgt = $controlFormaPgt->selectAll();

$formaPgtFiltro = array();


    if(!isset($_SESSION['valor_total'])){
        $valorAtualizado = 0;
    }else{
        $valorAtualizado = number_format($_SESSION['valor_total'], 2);
    }

$valorAtualizado = floatval($valorAtualizado);

        foreach ($formasPgt as $formaPgt) {
            if ($formaPgt->getFlag_ativo() == 1) {
                if(strpos($formaPgt->getNome(),"2x") || strpos($formaPgt->getNome(),"3x")){
                    if(strpos($formaPgt->getNome(),"2x") && $valorAtualizado >= 30){
                        array_push($formaPgtFiltro,$formaPgt);
                    }
                    else if(strpos($formaPgt->getNome(),"3x") && $valorAtualizado >= 45){
                        array_push($formaPgtFiltro,$formaPgt);
                    }  
                }
                else{
                    array_push($formaPgtFiltro,$formaPgt);
                }
            }
        }

        foreach ($formaPgtFiltro as $formaPgt) {
            if ($formaPgt->getFlag_ativo() == 1) {
                echo "<option value ='" . $formaPgt->getPkId() . "'>" . $formaPgt->getNome()  ."</option>";
                }
        }

?>
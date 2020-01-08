<?php

date_default_timezone_set('America/Sao_Paulo');

include_once "controlEmpresa.php";


class FuncionamentoEmpresa{
    
    function aberto(){

        $controleEmpresa = new controlerEmpresa(conecta());
        $empresa = $controleEmpresa->select(1,2);

        // $hora_atual = date('H:i', time() - 3600);// horário de verão extinto
        $hora_atual = date('H:i', time());// horário de verão extinto
        $hoje = (date('w')+1); // 1 == domingo, 7 == sábado

        $arr_hora_inicio = json_decode($empresa->getArrHorariosInicio());
        $hora_inicio = $arr_hora_inicio[$hoje-1];//pos array 0->6

        $arr_hora_final = json_decode($empresa->getArrHorariosFinal());
        $hora_final = $arr_hora_final[$hoje-1];//pos array 0->6

        if(!$empresa->getAberto()){
            return false;

        }else if(!in_array($hoje, json_decode($empresa->getArrDiasSemana()))){
           return false;

        }else if(
            (strtotime($hora_atual) < strtotime($hora_inicio))
            || (strtotime($hora_atual) >= strtotime($hora_final))
        ){
            return false;

        }else{
            return true;

        }
    }
}

?>
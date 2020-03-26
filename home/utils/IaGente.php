<?php

include_once $_SERVER['DOCUMENT_ROOT']."/config.php"; 


class IaGente{

    private $http = IAGENTE_HTTP;
    private $user = IAGENTE_AUTH_USER;
    private $pass = IAGENTE_AUTH_PASS;
    

    function enviaVerificacaoSMS($telefone_int, $cod_sms){
        
        $msg = urlencode("Delion Cafe - Seu Codigo: ".$cod_sms);

        $api_http = file_get_contents(
            $this->http."?metodo=envio&usuario=".$this->user."&senha=".$this->pass."&celular=".$telefone_int."&mensagem=".$msg
        );

        return $api_http;

    }

    function enviaSMSLote($arr_telefones_int, $msg){

        $msg = urlencode($msg); 

        $api_http = file_get_contents(
            $this->http."?metodo=lote&usuario=".$this->user."&senha=".$this->pass."&celular=".$arr_telefones_int."&mensagem=".$msg
        );

        return $api_http;

    }

    function consultaSaldo(){

        $api_http = file_get_contents(
            $this->http."?metodo=creditos&usuario=".$this->user."&senha=".$this->pass
        );

        return $api_http;
    }
}

?>
	
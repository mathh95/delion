<?php

include_once $_SERVER['DOCUMENT_ROOT']."/config.php"; 

class GoogleRecaptcha {

    private $secretKey = GOOGLE_reCAPTCHA_SECRET;

    function verificaToken($token){
        
        // post request to server
        $url = 'https://www.google.com/recaptcha/api/siteverify';
        $data = array('secret' => $this->secretKey, 'response' => $token);
        
        $options = array(
            'http' => array(
                'header' => "Content-type: application/x-www-form-urlencoded\r\n",
                'method' => 'POST',
                'content' => http_build_query($data)
            )
        );

        $context = stream_context_create($options);
        $response = file_get_contents($url, false, $context);
        $responseKeys = json_decode($response, true);
        
        if($responseKeys["success"] && $responseKeys["score"] >= 0.5) {
            return true;
        } else {
            return false;
        }
    }
}

?>
<?php

require '../../vendor/autoload.php';

class VerificaTelefone{

    function valida($phone, $region){

        //remove localidade do numero e verifica
        $phone_only = substr($phone, 2);
        if ($phone_only == '000000000' || 
            $phone_only == '111111111' || 
            $phone_only == '222222222' || 
            $phone_only == '333333333' || 
            $phone_only == '444444444' || 
            $phone_only == '555555555' || 
            $phone_only == '666666666' || 
            $phone_only == '777777777' || 
            $phone_only == '888888888' || 
            $phone_only == '999999999') {
        
                return false;
        }

        $phoneUtil = \libphonenumber\PhoneNumberUtil::getInstance();

        try {
            $phoneNumberObject = $phoneUtil->parse($phone, $region);

            return $phoneUtil->isValidNumberForRegion($phoneNumberObject, $region);

        } catch (\libphonenumber\NumberParseException $e) {
            var_dump($e);
        }
    }

}

?>
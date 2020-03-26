<?php

class Mask{
	
	function addMaskPhone($phone) {
	
		$tam = strlen(preg_replace("/[^0-9]/", "", $phone));
		
		if ($tam == 13) { // COM CÓDIGO DE ÁREA NACIONAL E DO PAIS e 9 dígitos
			return "+".substr($phone,0,$tam-11)."(".substr($phone,$tam-11,2).") ".substr($phone,$tam-9,5)."-".substr($phone,-4);
		}
		if ($tam == 12) { // COM CÓDIGO DE ÁREA NACIONAL E DO PAIS
			return "+".substr($phone,0,$tam-10)."(".substr($phone,$tam-10,2).") ".substr($phone,$tam-8,4)."-".substr($phone,-4);
		}
		if ($tam == 11) { // COM CÓDIGO DE ÁREA NACIONAL e 9 dígitos
			return "(".substr($phone,0,2).") ".substr($phone,2,5)."-".substr($phone,7,11);
		}
		if ($tam == 10) { // COM CÓDIGO DE ÁREA NACIONAL
			return "(".substr($phone,0,2).") ".substr($phone,2,4)."-".substr($phone,6,10);
		}
		if ($tam <= 9) { // SEM CÓDIGO DE ÁREA
			return substr($phone,0,$tam-4)."-".substr($phone,-4);
		}
	}

	//Remove mascara
	function rmMaskPhone($telefone){
        $telefone_int = preg_replace('/\D/', '', $telefone);
        
        return $telefone_int;
	}
	
	function sanitizeString($str) {
		$str = preg_replace('/[áàãâä]/ui', 'a', $str);
		$str = preg_replace('/[éèêë]/ui', 'e', $str);
		$str = preg_replace('/[íìîï]/ui', 'i', $str);
		$str = preg_replace('/[óòõôö]/ui', 'o', $str);
		$str = preg_replace('/[úùûü]/ui', 'u', $str);
		$str = preg_replace('/[ç]/ui', 'c', $str);
		// $str = preg_replace('/[,(),;:|!"#$%&/=?~^><ªº-]/', '_', $str);
		//$str = preg_replace('/[^a-z0-9]/i', '_', $str);
		$str = preg_replace('/_+/', ' ', $str);
		return $str;
	}


	function rmMaskCpf($cpf){
		//Remove mascara
		$cpf_int = str_replace('-', '', $cpf);
		$cpf_int = preg_replace('/[^A-Za-z0-9\-]/', '', $cpf_int);
		
		return $cpf_int;
	}
}


?>
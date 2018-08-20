<?
function lembra_variavel($variavel,$origem) {	
	//verifica se a variavel esta registrada
	if (!session_is_registered("sessao_$variavel")) {
	   session_register("sessao_$variavel");
	   if (isset($_POST["$variavel"])) {
	   	  $_SESSION["sessao_$variavel"] = $_POST["$variavel"];
	   } else {
	   	$_SESSION["sessao_$variavel"];
	   }
    }else {
	  //caso nao esteja vindo da busca
	  if (!isset($_POST["$origem"])) {
		$_POST["$variavel"] = $_SESSION["sessao_$variavel"];
	  } else {
		$_SESSION["sessao_$variavel"] = $_POST["$variavel"];
	  }
    }
} 
  
//A quick function to calculate the number of working days between two dates in YYYY-MM-DD format *without* 
//iterating through every day and comparing it to the weekday. 
//The start and end dates are included in the calculation. 
//I don't know how to easily explain the final calculation, 
//I just happened to notice the pattern in the test data and this is how I ended up expressing it. :)
  
function CalcWorkingDays ($start, $end) {
  $starttime = gmmktime (0, 0, 0, substr ($start, 5, 2), substr ($start, 8, 2), substr ($start, 0, 4));
  $endtime = gmmktime (0, 0, 0, substr ($end, 5, 2), substr ($end, 8, 2), substr ($end, 0, 4));
  $days = (($endtime - $starttime) / 86400) + 1;
  $d = $days % 7;
  $w = date("w", $starttime);
  $result = floor ($days / 7) * 5;
  $result = $result + $d - (($d + $w) >= 7) - (($d + $w) >= 8) - ($w == 0);
  return $result;
}


/**
**  Retorna nro de dias entre duas datas
**  Sintaxe: EntreDatas( "01/12/2002","02/12/2002" );
**  Retorno: 1  
**/
function EntreDatas( $inicio, $fim )
{
    $aInicio = Explode( "/",$inicio );
    $aFim    = Explode( "/",$fim    );
    $nTempo = mktime(0,0,0,$aFim[1],$aFim[0],$aFim[2]);
    $nTempo1= mktime(0,0,0,$aInicio[1],$aInicio[0],$aInicio[2]);
    return round(($nTempo-$nTempo1)/86400)+1;
}

function valorPorExtenso($valor=0) {
	$singular = array("centavo", "real", "mil", "milhão", "bilhão", "trilhão", "quatrilhão");
	$plural = array("centavos", "reais", "mil", "milhões", "bilhões", "trilhões",
"quatrilhões");

	$c = array("", "cem", "duzentos", "trezentos", "quatrocentos",
"quinhentos", "seiscentos", "setecentos", "oitocentos", "novecentos");
	$d = array("", "dez", "vinte", "trinta", "quarenta", "cinquenta",
"sessenta", "setenta", "oitenta", "noventa");
	$d10 = array("dez", "onze", "doze", "treze", "quatorze", "quinze",
"dezesseis", "dezesete", "dezoito", "dezenove");
	$u = array("", "um", "dois", "três", "quatro", "cinco", "seis",
"sete", "oito", "nove");

	$z=0;

	$valor = number_format($valor, 2, ".", ".");
	$inteiro = explode(".", $valor);
	for($i=0;$i<count($inteiro);$i++)
		for($ii=strlen($inteiro[$i]);$ii<3;$ii++)
			$inteiro[$i] = "0".$inteiro[$i];

	// $fim identifica onde que deve se dar junção de centenas por "e" ou por "," ;)
	$fim = count($inteiro) - ($inteiro[count($inteiro)-1] > 0 ? 1 : 2);
	for ($i=0;$i<count($inteiro);$i++) {
		$valor = $inteiro[$i];
		$rc = (($valor > 100) && ($valor < 200)) ? "cento" : $c[$valor[0]];
		$rd = ($valor[1] < 2) ? "" : $d[$valor[1]];
		$ru = ($valor > 0) ? (($valor[1] == 1) ? $d10[$valor[2]] : $u[$valor[2]]) : "";
	
		$r = $rc.(($rc && ($rd || $ru)) ? " e " : "").$rd.(($rd &&
$ru) ? " e " : "").$ru;
		$t = count($inteiro)-1-$i;
		$r .= $r ? " ".($valor > 1 ? $plural[$t] : $singular[$t]) : "";
		if ($valor == "000")$z++; elseif ($z > 0) $z--;
		if (($t==1) && ($z>0) && ($inteiro[0] > 0)) $r .= (($z>1) ? " de " : "").$plural[$t]; 
		if ($r) $rt = $rt . ((($i > 0) && ($i <= $fim) &&
($inteiro[0] > 0) && ($z < 1)) ? ( ($i < $fim) ? ", " : " e ") : " ") . $r;
	}

	return($rt ? $rt : "zero");
}


function getmicrotime(){
    list($usec, $sec) = explode(" ", microtime());
 return ((float)$usec + (float)$sec);
}


function RemoveAcentos($Msg)
  {
  $a = array(
   '/[ÂÀÁÄÃ]/'=>'A',
   '/[âãàáä]/'=>'a',
  '/[ÊÈÉË]/'=>'E',
  '/[êèéë]/'=>'e',
  '/[ÎÍÌÏ]/'=>'I',
  '/[îíìï]/'=>'i',
  '/[ÔÕÒÓÖ]/'=>'O',
  '/[ôõòóö]/'=>'o',
  '/[ÛÙÚÜ]/'=>'U',
 '/[ûúùü]/'=>'u',
  '/ç/'=>'c',
    '/Ç/'=> 'C',
    '/º/'=> '');
 // Tira o acento pela chave do array
  return preg_replace(array_keys($a), array_values($a), $Msg);
 }






?>
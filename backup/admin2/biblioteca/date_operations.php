<?
/*********************************************************************************
- Date operations by Andr� Cupini - andre@neobiz.com.br
- Sum or subtract day, months or years from any date
- Ex:
require_once("class_dt.php");
$dt = new DT;
$date = $dt->operations("06/01/2003", "sum", "day", "4")   // Return 10/01/2003
$date = $dt->operations("06/01/2003", "sub", "day", "4")   // Return 02/01/2003
$date = $dt->operations("06/01/2003", "sum", "month", "4") // Return 10/05/2003
*********************************************************************************/
class DT
{
	// Fun��o que soma ou subtrai, dias, meses ou anos de uma data qualquer
	function operations($date, $operation, $where = FALSE, $quant, $return_format = FALSE)
	{
		// Verifica erros
		$warning = "<br>Warning! Date Operations Fail... ";
		if(!$date || !$operation) {
			return "$warning invalid or inexistent arguments<br>";
		}else{
			if(!($operation == "sub" || $operation == "-" || $operation == "sum" || $operation == "+")) return "<br>$warning Invalid Operation...<br>";
			else {
				// Separa dia, m�s e ano
				list($year, $month, $day) = split("-", $date);

				// Determina a opera��o (Soma ou Subtra��o)
				($operation == "sub" || $operation == "-") ? $op = "-" : $op = '';
				
				$sum_day = '';
				$sum_month = '';
				$sum_year = '';
				
				// Determina aonde ser� efetuada a opera��o (dia, m�s, ano)
				if($where == "day")   $sum_day	 = $op."$quant";
				if($where == "month") $sum_month = $op."$quant";
				if($where == "year")  $sum_year	 = $op."$quant";
				
				// Gera o timestamp
				$date = mktime(0, 0, 0, $month + $sum_month, $day + $sum_day, $year + $sum_year);
				
				// Retorna o timestamp ou extended
				($return_format == "timestamp" || $return_format == "ts") ? $date = $date : $date = date("Y-m-d", "$date");

				// Retorna a data
				return $date;
			}
		}
	}
}
?>
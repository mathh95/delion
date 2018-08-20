<? include("../biblioteca/online.php");?>
<table width="100%" border="0" cellspacing="7" cellpadding="0">
  <tr> 
	<td bgcolor="#DCE7ED"> <table width="100%" border="0" align="center" cellpadding="4" cellspacing="0">
		<?
		
		if ($_GET['data_fim']) {
			$db->sql("SELECT U.id_usuario, U.nome, data_cad, date_format(data_cad, '%d/%m/%Y') as data, month(data_cad) as mes , year(data_cad) as ano FROM log_usuario LU inner join usuario U on (LU.id_usuario = U.id_usuario) where data_cad between '".$_GET['data_inicio'] ."' and  '".$_GET['data_fim'] ."' group by U.id_usuario order by U.nome");
		} else {		
			$db->sql("SELECT U.id_usuario, U.nome, data_cad, date_format(data_cad, '%d/%m/%Y') as data, month(data_cad) as mes , year(data_cad) as ano FROM log_usuario LU inner join usuario U on (LU.id_usuario = U.id_usuario) where data_cad = '".$_GET['data_inicio'] ."' group by U.id_usuario order by U.nome");
		}
		
		//Verifica ate aonde encontra os dados
		while ($valor = $db->fetch_array()) {
		
				
			if ($_GET['data_fim']) {
			 	
				   $data_inicio = "01/". $valor['mes'] ."/". $valor['ano'] ;
				 
				  //meses com 31
				  if (in_array($valor['mes'], array('01','03','05','06','07','08','10','12'))) {
					$data_fim = "31/" . $valor['mes'] . "/" . $valor['ano'];
				  }
				  //meses com 30
				  if (in_array($valor['mes'], array('04','06','09','11'))) {
					$data_fim = "30/" . $valor['mes'] . "/" . $valor['ano'];
				  }
				  //mes com 28
				  if (in_array($valor['mes'], array('02'))) {
					$data_fim = "28/" . $valor['mes'] . "/" . $valor['ano'];
				  }
			 } else {
			 	$data_inicio = $valor['data'];
			 	$data_fim = "";
			 }
		?>
		<tr> 
		  <td width="50%"><a href="javascript:carrega_log('<? echo $valor['id_usuario'];?>','','','<? echo $data_inicio ;?>','<? echo $data_fim;?>','','');" class="titulo"><? echo $valor['nome'];?></a> </td>
		</tr>
		<? } ?>
	  </table></td>
  </tr>
</table>
<? include("../biblioteca/online.php");?>
<table width="100%" border="0" cellspacing="7" cellpadding="0">
  <tr> 
	<td bgcolor="#DCE7ED"> <table width="100%" border="0" align="center" cellpadding="4" cellspacing="0">
		<tr> 
		  <td width="50%" class="titulo2">DATA</td>
		</tr>
		<?
		
		$data_base =   date('Y') . "-" .  date('m') . "-01";
					
		$db->sql("SELECT id_usuario, date_format(data_cad, '%d/%m/%Y') as data_cad FROM log_usuario where id_usuario = ".$_GET['id_usuario']." and data_cad >= '$data_base' group by data_cad order by data_cad desc");
		
		//Verifica ate aonde encontra os dados
		while ($valor = $db->fetch_array()) {
		?>
		<tr> 
		  <td width="50%"><a href="javascript:carrega_log('<? echo $valor['id_usuario'];?>','','','<? echo $valor['data_cad'];?>','','','');" class="titulo"><? echo $valor['data_cad'];?></a></td>
		</tr>
		<? } ?>
		<?
					
		$db->sql("SELECT id_usuario, date_format(data_cad, '%d/%m/%Y') as data_cad, month(data_cad) as mes , year(data_cad) as ano FROM log_usuario where id_usuario = ".$_GET['id_usuario']." and data_cad < '$data_base'  group by month(data_cad) order by month(data_cad) desc, year(data_cad) desc ");
		
		//Verifica ate aonde encontra os dados
		while ($valor = $db->fetch_array()) {
		
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
		?>
		<tr> 
		  <td width="50%"><a href="javascript:carrega_log('<? echo $valor['id_usuario'];?>','','','<? echo "01/". $valor['mes'] ."/". $valor['ano'] ;?>','<? echo $data_fim;?>','','');" class="titulo"><? echo $valor['mes'];?>/<? echo $valor['ano'];?></a></td>
		</tr>
		<? } ?>
	  </table></td>
  </tr>
</table>
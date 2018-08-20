<? include("../biblioteca/online.php");?>
<table width="100%" border="0" cellspacing="7" cellpadding="0">
  <tr> 
	<td bgcolor="#DCE7ED"> <table width="100%" border="0" align="center" cellpadding="4" cellspacing="0">
		<?
					
		$db->sql("SELECT consulta FROM log_usuario  where id_log_usuario = '".$_GET['id_log_usuario'] ."' limit 0,1");
		
		
		//Verifica ate aonde encontra os dados
		$valor = $db->fetch_array();
		?>
		<tr> 
		  <td width="50%"><div class="titulo"><b><? echo $valor['consulta'];?></b></div> </td>
		</tr>
	  </table></td>
  </tr>
</table>
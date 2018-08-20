<?
include("../biblioteca/online.php");

$db->sql("SELECT cod_perfil_usuario, cod_tela FROM perfil_usuario WHERE tipo = '$_GET[tipo]' ");

$campos = array();
while ($valor = $db->fetch_array()) {

	$campos[] = $valor['cod_tela'];

}
?>
   
	<div id="divpermissao">
	<table width="100%" border="0" cellpadding="0" cellspacing="0">
	  
		<?
		$res = $db->sql("SELECT cod_tela, nome, caminho, ordem FROM tela where sub_ordem = 0 and ordem > 0 order by ordem ");
		
		
		
		
		$i = 0;
		while ($array_menu = mysql_fetch_array($res)) {	
		
		$i++;					
		?>
		<tr>
		<td width="51%" valign="top" class="textp"> 
		  <ul>
			
			<li> 
			  <? 
													
				$res1 = $db->sql("SELECT cod_tela, nome, caminho FROM tela where ordem = $array_menu[ordem] and sub_ordem > 0 and ordem > 0 order by sub_ordem ");
				
				$count = mysql_num_rows($res1);	
				?>
				<div> 
				<input name="super_categoria<? echo $i;?>" type="checkbox" id="super_categoria<? echo $i;?>" value="<? echo $array_menu['cod_tela']; ?>"  <? if (in_array($array_menu['cod_tela'], $campos)) { echo "checked"; }?> onClick="javascript:gravar_super_categoria(<? echo $i;?>,<? echo $count;?>);" />
				<? echo $array_menu['nome']; ?></div>
				<?
				$j=0;
				while ($array_menu1 = mysql_fetch_array($res1)) {		
				$j++;
				?>
			  <ul>
				<li> 
				  <input name="categoria<? echo $i;?><? echo $j;?>" type="checkbox" id="categoria<? echo $i;?><? echo $j;?>" value="<? echo $array_menu1['cod_tela']; ?>" <? if (in_array($array_menu1['cod_tela'], $campos)) { echo "checked"; }?> onClick="javascript:gravar_categoria(<? echo $i;?>,<? echo $j;?>,<? echo $count;?>);" />
				  <label for="categoria11"><? echo $array_menu1['nome']; ?></label>
				</li>
			  </ul>
			  <? } ?>
			  
			</li>
		  
		  </ul>
		  
		</td>
		</tr>
		<? } ?>  
	
  </table>
  </div>

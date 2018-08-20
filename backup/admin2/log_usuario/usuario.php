<?php 

include("../biblioteca/online.php");

?> 
<table width="265" border="0" align="left" cellpadding="0" cellspacing="0">
<tr> 
  <td width="1" background="../img/abas/bg.jpg"><img src="../img/spacer.gif" width="1" height="1"></td>
  <td width="301" background="../img/abas/bg.jpg"> 
	<table border="0" align="left" cellpadding="0" cellspacing="0">
	  <tr> 
		<td width="4"><img src="../img/spacer.gif" width="8" height="2"></td>
		<td>
<table border="0" cellspacing="0" cellpadding="0">
			<tr> 
			  <td width="1"><img src="../img/abas/atual1.jpg" width="3" height="25"></td>
			  <td width="65" background="../img/abas/atualbg.jpg" class="titulo2"> 
				<div align="center" class="caixaAbaon">USU&Aacute;RIO</div></td>
			  <td width="1"><img src="../img/abas/atual2.jpg" width="3" height="25"></td>
			</tr>
		  </table>
		</td>
		<td width="4"><img src="../img/spacer.gif" width="4" height="2"></td>
		<td>
<table border="0" cellspacing="0" cellpadding="0">
			<tr>
<td width="1"><img src="../img/abas/aba1.jpg" width="5" height="25"></td>
			  <td width="75" background="../img/abas/ababg.jpg" class="textp" > 
				<div align="center"><a href="javascript:carrega('data.php');" class="titulo">DATAS</a></div></td>
<td width="1"><img src="../img/abas/aba2.jpg" width="5" height="25"></td>
</tr>
</table></td>
		<td width="4"><img src="../img/spacer.gif" width="4" height="2"></td>
		<td><table border="0" cellspacing="0" cellpadding="0">
			<tr> 
			  <td width="1"><img src="../img/abas/aba1.jpg" width="5" height="25"></td>
			  <td width="75" background="../img/abas/ababg.jpg"> 
				<div align="center"><a href="javascript:carrega('busca.php');" class="titulo">BUSCA</a></div></td>
			  <td width="1"><img src="../img/abas/aba2.jpg" width="5" height="25"></td>
			  <td width="1"><img src="../img/spacer.gif" width="8" height="2"></td>
			</tr>
		  </table></td>
	  </tr>
	</table></td>
  <td width="1" background="../img/abas/bg.jpg"><img src="../img/spacer.gif" width="1" height="1"></td>
</tr>
<tr> 
  <td width="1" bgcolor="#D2DEEC"><img src="../img/spacer.gif" width="1" height="1"></td>
  <td bgcolor="#F5F8FA">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
	  <tr> 
		<td>
<table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
              <tr> 
                <td height="1"> <div align="center"><img src="../img/spacer.gif" width="2" height="8"></div></td>
              </tr>
              <tr> 
                <td><table width="100%" border="0" cellspacing="0" cellpadding="2">
                    <?
					
					$db->sql("SELECT U.id_usuario, U.nome FROM log_usuario LU inner join usuario U on (LU.id_usuario = U.id_usuario) group by U.id_usuario order by U.nome");
					
					$i = 0;
					//Verifica ate aonde encontra os dados
					while ($valor = $db->fetch_array()) {
					?>
					<tr> 
                      <td><a href="javascript:carrega_usuario(<? echo $i;?>,<? echo $valor['id_usuario'];?>)" class="textp"><? echo  $valor['nome'];?></a></td>
                    </tr>
                    <tr> 
                      <td><img src="../img/spacer.gif" width="2" height="1">
                        <div id="data_<? echo $i;?>" class="hide"></div></td>
                    </tr>
					<? 
					$i++;
					} ?>
                    
                  </table></td>
              </tr>
            </table></td>
	  </tr>
	  <tr> 
		<td><img src="../img/spacer.gif" width="2" height="5"></td>
	  </tr>
	</table></td>
  <td width="1" bgcolor="#D2DEEC"><img src="../img/spacer.gif" width="1" height="1"></td>
</tr>
<tr> 
  <td bgcolor="#D2DEEC"><img src="../img/spacer.gif" width="1" height="1"></td>
  <td bgcolor="#D2DEEC"><img src="../img/spacer.gif" width="1" height="1"></td>
  <td bgcolor="#D2DEEC"><img src="../img/spacer.gif" width="1" height="1"></td>
</tr>
</table>
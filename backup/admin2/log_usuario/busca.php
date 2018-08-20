<?php @header("Content-Type: text/html;  charset=ISO-8859-1",true) ?> 
<script>

function busca(){

	//carrega_log('',document.formulario.nome.value,document.formulario.hora.value, document.formulario.data_inicio.value,document.formulario.data_fim.value, '');
	carrega_log('','','','','','');
	

}

</script>
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
		<td width="1"><img src="../img/abas/aba1.jpg" width="5" height="25"></td>
					  <td width="75" background="../img/abas/ababg.jpg" class="textp" > 
						<div align="center"><a href="javascript:carrega('usuario.php');" class="titulo">USUÁRIO</a></div></td>
		<td width="1"><img src="../img/abas/aba2.jpg" width="5" height="25"></td>
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
		</table>
</td>
		<td width="4"><img src="../img/spacer.gif" width="4" height="2"></td>
		<td>
		<table border="0" cellspacing="0" cellpadding="0">
			<tr> 
			  <td width="1"><img src="../img/abas/atual1.jpg" width="3" height="25"></td>
			  <td width="65" background="../img/abas/atualbg.jpg" class="titulo2"> 
				<div align="center" class="caixaAbaon">BUSCA</div></td>
			  <td width="1"><img src="../img/abas/atual2.jpg" width="3" height="25"></td>
			</tr>
		  </table>
		  </td>
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
                <td>
				<form name="formulario" id="formulario" action="">
				    <table width="100%" border="0" cellspacing="0" cellpadding="3">
                      <tr> 
                        <td width="80" class="titulo2">BUSCA</td>
                        <td>&nbsp;</td>
                      </tr>
                      <tr> 
                        <td width="80" valign="top" class="titulo"> <div align="right">Usu&aacute;rio:</div></td>
                        <td><input name="nome" type="text" class="form" id="nome"></td>
                      </tr>
                      <tr> 
                        <td width="80" valign="top" class="titulo"> <div align="right">Data 
                            Inicio:</div></td>
                        <td><table border="0" cellspacing="0" cellpadding="0">
                            <tr> 
                              <td> <input name="data_inicio" type="text" class="form"> 
                              </td>
                              <td width="50"><div align="center"><a href="javascript:void(0)" onclick="if(self.gfPop)gfPop.fPopCalendar(document.formulario.data_inicio);return false;" HIDEFOCUS><img src="../scripts/calendario/calbtn.gif" width="34" height="22" border="0"></a></div></td>
                            </tr>
                          </table></td>
                      </tr>
                      <tr> 
                        <td valign="top" class="titulo"> <div align="right">Data 
                            Fim:</div></td>
                        <td><table border="0" cellspacing="0" cellpadding="0">
                            <tr> 
                              <td> <input name="data_fim" type="text" class="form" id="data_fim"> 
                              </td>
                              <td width="50"><div align="center"><a href="javascript:void(0)" onclick="if(self.gfPop)gfPop.fPopCalendar(document.formulario.data_fim);return false;" HIDEFOCUS><img src="../scripts/calendario/calbtn.gif" width="34" height="22" border="0"></a></div></td>
                            </tr>
                          </table></td>
                      </tr>
                      <tr> 
                        <td width="80" class="titulo"><div align="right"></div></td>
                        <td><input name="Button" type="button" class="botao" value="OK" onClick="javascript:carrega_log('',document.formulario.nome.value,'', document.formulario.data_inicio.value,document.formulario.data_fim.value, '','');"></td>
                      </tr>
                    </table>
				  </form>
				  </td>
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
<iframe width=174 height=189 name="gToday:normal:agenda.js" id="gToday:normal:agenda.js" src="../scripts/calendario/ipopeng.htm" scrolling="no" frameborder="0" style="visibility:visible; z-index:999; position:absolute; top:-500px; left:-500px;">
</iframe>
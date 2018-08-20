<table width="303" border="0" cellspacing="0" cellpadding="0">
  <tr> 
    <td width="1" background="themes/<? echo $_GET['theme']; ?>/caixa_arquivos/bg.jpg"><img src="file:///X|/pixlog_novo/include_pix/img/spacer.gif" width="1" height="1"></td>
    <td width="301" background="themes/<? echo $_GET['theme']; ?>/caixa_arquivos/bg.jpg">
<table border="0" align="left" cellpadding="0" cellspacing="0">
        <tr>
		  <td width="4"><img src="file:///X|/pixlog_novo/include_pix/img/spacer.gif" width="8" height="2"></td>
          <td>
		   <? if ($click == 'arquivo') { ?>
		    <table border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="1"><img src="themes/<? echo $_GET['theme']; ?>/caixa_arquivos/atual1.jpg" width="3" height="25"></td>
                <td width="65" background="themes/<? echo $_GET['theme']; ?>/caixa_arquivos/atual_bg.jpg"> 
                  <div align="center" class="caixaAbaon">Arquivo</div></td>
                <td width="1"><img src="themes/<? echo $_GET['theme']; ?>/caixa_arquivos/atual2.jpg" width="3" height="25"></td>
              </tr>
            </table>
			<? } else {?>
			<table border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="1"><img src="themes/<? echo $_GET['theme']; ?>/caixa_arquivos/caixa1.jpg" width="5" height="25"></td>
                <td width="65" background="themes/<? echo $_GET['theme']; ?>/caixa_arquivos/caixa_bg.jpg"> 
                  <div align="center"><a href="javascript:abre_arquivo('/home/include_pix/arquivo.php','theme=<? echo $_GET['theme'] ?>&login_usuario=<? echo $login_usuario ?>&id_user=<? echo $id_user ?>&click=arquivo');" class="caixaAba">Arquivo</a></div></td>
                <td width="1"><img src="themes/<? echo $_GET['theme']; ?>/caixa_arquivos/caixa2.jpg" width="5" height="25"></td>
              </tr>
            </table>
			<? } ?>
		  </td>
          
		  <? 
		  
		  if (@$_SESSION['logado']) {
			  
		  
		  ?>
		  
		  <td width="4"><img src="file:///X|/pixlog_novo/include_pix/img/spacer.gif" width="4" height="2"></td>
		  <td>
		  
		  <? if ($click == 'privado') { ?>
		    <table border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="1"><img src="themes/<? echo $_GET['theme']; ?>/caixa_arquivos/atual1.jpg" width="3" height="25"></td>
                <td width="75" background="themes/<? echo $_GET['theme']; ?>/caixa_arquivos/atual_bg.jpg"> 
                  <div align="center" class="caixaAbaon">
                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr> 
                        <td width="20"><div align="center"><img src="file:///X|/pixlog_novo/include_pix/img/chave.gif" width="14" height="11"></div></td>
                        <td><div align="center" class="caixaAbaon">Privado</div></td>
                      </tr>
                    </table>
                  </div></td>
                <td width="1"><img src="themes/<? echo $_GET['theme']; ?>/caixa_arquivos/atual2.jpg" width="3" height="25"></td>
              </tr>
            </table>
			<? } else {?>
			<table border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="1"><img src="themes/<? echo $_GET['theme']; ?>/caixa_arquivos/caixa1.jpg" width="5" height="25"></td>
                <td background="themes/<? echo $_GET['theme']; ?>/caixa_arquivos/caixa_bg.jpg" width="75"> 
                  <table width="100%" border="0" cellspacing="0" cellpadding="0">
					  <tr>
						<td width="20"><div align="center"><img src="file:///X|/pixlog_novo/include_pix/img/chave.gif" width="14" height="11"></div></td>
						<td><div align="center"><a href="javascript:abre_arquivo('/home/include_pix/arquivo.php','theme=<? echo $_GET['theme'] ?>&login_usuario=<? echo $login_usuario ?>&id_user=<? echo $id_user ?>&click=privado');" class="caixaAba">Privado</a></div></td>
					  </tr>
					</table>
				</td>
                <td width="1"><img src="themes/<? echo $_GET['theme']; ?>/caixa_arquivos/caixa2.jpg" width="5" height="25"></td>
              </tr>
            </table>
			<? } ?>
			
			</td>
			<? 
				}
			
			?>
          <td width="4"><img src="file:///X|/pixlog_novo/include_pix/img/spacer.gif" width="4" height="2"></td>
          <td>
		  <? if ($click == 'favoritos') { ?>
		    <table border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="1"><img src="themes/<? echo $_GET['theme']; ?>/caixa_arquivos/atual1.jpg" width="3" height="25"></td>
                <td width="65" background="themes/<? echo $_GET['theme']; ?>/caixa_arquivos/atual_bg.jpg"> 
                  <div align="center" class="caixaAbaon">Favoritos</div></td>
                <td width="1"><img src="themes/<? echo $_GET['theme']; ?>/caixa_arquivos/atual2.jpg" width="3" height="25"></td>
              </tr>
            </table>
			<? } else {?>
			<table border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="1"><img src="themes/<? echo $_GET['theme']; ?>/caixa_arquivos/caixa1.jpg" width="5" height="25"></td>
                <td width="65" background="themes/<? echo $_GET['theme']; ?>/caixa_arquivos/caixa_bg.jpg"> 
                  <div align="center"><a href="javascript:abre_arquivo('/home/include_pix/arquivo.php','theme=<? echo $_GET['theme'] ?>&login_usuario=<? echo $login_usuario ?>&id_user=<? echo $id_user ?>&click=favoritos');" class="caixaAba">Favoritos</a></div></td>
                <td width="1"><img src="themes/<? echo $_GET['theme']; ?>/caixa_arquivos/caixa2.jpg" width="5" height="25"></td>
              </tr>
            </table>
			<? } ?>
			
			</td>
        </tr>
      </table></td>
    <td width="1" background="themes/<? echo $_GET['theme']; ?>/caixa_arquivos/bg.jpg"><img src="file:///X|/pixlog_novo/include_pix/img/spacer.gif" width="1" height="1"></td>
  </tr>
  <tr> 
    <td width="1" bgcolor="<? echo $cor_linha; ?>"><img src="file:///X|/pixlog_novo/include_pix/img/spacer.gif" width="1" height="1"></td>
    <td bgcolor="<? echo $cor_quadro; ?>">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr> 
          <td>
<table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
              <tr> 
                <td height="1"> <div align="center"><img src="file:///X|/pixlog_novo/include_pix/img/spacer.gif" width="2" height="8"></div></td>
              </tr>
              <tr> 
                <td>
<table width="290" border="0" align="center" cellpadding="3" cellspacing="3">
<td><table width="110" height="100" border="0" align="center" cellpadding="0" cellspacing="1" bgcolor="<? echo $foto_linha; ?>">
                        <tr> 
                          <td valign="top" bgcolor="<? echo $foto; ?>"> <div align="center"> 
                              <table width="100%" border="0" cellspacing="2" cellpadding="0">
                                <tr> 
                                  <td><table width="100%" border="0" cellspacing="1" cellpadding="0">
                                      <tr> 
                                        <td><div align="center"> 
                                            <? if ($click != 'favoritos') {?>
                                            <a href="javascript:carrega_foto('<? echo $valores['id_pic']?>','<? echo $click?>');" ><img src="http://www.pixlog.us/users/<?  echo $valores['login'][0] ."/". $valores['login'][1] ."/". $valores['login'] ."/sm/". $valores['picnome'] . $valores['picext']?>" width="100" height="75" border="0"></a> 
                                            <? } else {?>
                                            <a href="/home/pix.php?usuario=<? echo $valores['login']?>" ><img src="http://www.pixlog.us/users/<?  echo $valores['login'][0] ."/". $valores['login'][1] ."/". $valores['login'] ."/sm/". $valores['picnome'] . $valores['picext']?>" width="100" height="75" border="0"></a> 
                                            <? } ?>
                                          </div></td>
                                      </tr>
                                      <tr> 
                                        <td><table width="97%" border="0" align="center" cellpadding="0" cellspacing="0">
                                            <? if ($click == 'favoritos') {?>
                                            <tr> 
                                              <td><div align="left"><a href="/home/pix.php?usuario=<? echo $valores['login']?>" class="nomesPix"><? echo $valores['login']?></a></div></td>
                                            </tr>
                                            <tr> 
                                              <td><div align="left"><a href="#" class="nomesPix"><? echo $valores['data']?> 
                                                  - <? echo $valores['hora']?></a></div></td>
                                              <td width="14"><img src="/home/img/cliente_gold.gif" width="12" height="12"></td>
                                            </tr>
                                            <? } else { ?>
                                            <tr> 
                                              <td><div align="left"><a href="#" class="nomesPix"><? echo $valores['data']?> 
                                                  - <? echo $valores['hora']?></a></div></td>
                                            </tr>
                                            <? } ?>
                                          </table></td>
                                      </tr>
                                    </table></td>
                                </tr>
                              </table>
                            </div></td>
                        </tr>
                      </table></td>
                    <?
							$col++;	
							//se for a quantidade de colunas entao fecha a </tr>
							if ($col == 2){
								echo "</tr>";
							}
						
						}
						
						?>
                  </table>
                  
                </td>
              </tr>
            </table></td>
        </tr>
        <tr> 
          <td><img src="file:///X|/pixlog_novo/include_pix/img/spacer.gif" width="2" height="5"></td>
        </tr>
      </table></td>
    <td width="1" bgcolor="<? echo $cor_linha; ?>"><img src="file:///X|/pixlog_novo/include_pix/img/spacer.gif" width="1" height="1"></td>
  </tr>
  <tr> 
    <td bgcolor="<? echo $cor_linha; ?>"><img src="file:///X|/pixlog_novo/include_pix/img/spacer.gif" width="1" height="1"></td>
    <td bgcolor="<? echo $cor_linha; ?>"><img src="file:///X|/pixlog_novo/include_pix/img/spacer.gif" width="1" height="1"></td>
    <td bgcolor="<? echo $cor_linha; ?>"><img src="file:///X|/pixlog_novo/include_pix/img/spacer.gif" width="1" height="1"></td>
  </tr>
</table>


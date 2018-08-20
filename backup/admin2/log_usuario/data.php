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
                                  <td width="1"><img src="../img/abas/aba1.jpg" width="5" height="25"></td>
                                  <td width="75" background="../img/abas/ababg.jpg"> 
                                    <div align="center"><a href="javascript:carrega('usuario.php');" class="titulo">USUÁRIO</a></div></td>
                                  <td width="1"><img src="../img/abas/aba2.jpg" width="5" height="25"></td>
                                  <td width="1"><img src="../img/spacer.gif" width="8" height="2"></td>
                                </tr>
                              </table>
                            </td>
                            <td width="4"><img src="../img/spacer.gif" width="4" height="2"></td>
                            <td>
								<table border="0" cellspacing="0" cellpadding="0">
                                <tr> 
                                  <td width="1"><img src="../img/abas/atual1.jpg" width="3" height="25"></td>
                                  <td width="65" background="../img/abas/atualbg.jpg" class="titulo2"> 
                                    <div align="center" class="caixaAbaon">DATAS</div></td>
                                  <td width="1"><img src="../img/abas/atual2.jpg" width="3" height="25"></td>
                                </tr>
                              </table>
							</td>
                            <td width="4"><img src="../img/spacer.gif" width="4" height="2"></td>
                            <td>
							<table border="0" cellspacing="0" cellpadding="0">
                                <tr> 
                                  <td width="1"><img src="../img/abas/aba1.jpg" width="5" height="25"></td>
                                  <td width="75" background="../img/abas/ababg.jpg"> 
                                    <div align="center"><a href="javascript:carrega('busca.php');" class="titulo">BUSCA</a></div></td>
                                  <td width="1"><img src="../img/abas/aba2.jpg" width="5" height="25"></td>
                                  <td width="1"><img src="../img/spacer.gif" width="8" height="2"></td>
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
                <td><table width="100%" border="0" cellspacing="0" cellpadding="2">
                    <?
					
					$data_base =   date('Y') . "-" .  date('m') . "-01";
					
					$db->sql("SELECT U.id_usuario, U.nome, data_cad, date_format(data_cad, '%d/%m/%Y') as data FROM log_usuario LU inner join usuario U on (LU.id_usuario = U.id_usuario) where data_cad >= '$data_base' group by data_cad order by data_cad desc");
					
					$i = 0;
					//Verifica ate aonde encontra os dados
					while ($valor = $db->fetch_array()) {
					?>
					<tr> 
                      <td><a href="javascript:carrega_data(<? echo $i;?>,'<? echo $valor['data_cad'];?>', '');" class="titulo2"><? echo $valor['data'];?></a></td>
                    </tr>
                    <tr> 
                      <td><img src="../img/spacer.gif" width="2" height="1"> <div id="usuario_<? echo $i;?>" class="hide"></div></td>
                    </tr>
                    <? 
					$i++;
					} ?>
					
					<?
					
					$db->sql("SELECT U.id_usuario, U.nome, data_cad, date_format(data_cad, '%d/%m/%Y') as data, month(data_cad) as mes , year(data_cad) as ano FROM log_usuario LU inner join usuario U on (LU.id_usuario = U.id_usuario) where data_cad <= '$data_base' group by month(data_cad) order by month(data_cad), year(data_cad)");
					
					//Verifica ate aonde encontra os dados
					while ($valor = $db->fetch_array()) {
					
						  //meses com 31
						  if (in_array($valor['mes'], array('01','03','05','06','07','08','10','12'))) {
							$data_fim = $valor['ano'] . "-" . $valor['mes'] . "-31";
						  }
						  //meses com 30
						  if (in_array($valor['mes'], array('04','06','09','11'))) {
							$data_fim = $valor['ano'] . "-" . $valor['mes'] . "-30";
						  }
						  //mes com 28
						  if (in_array($valor['mes'], array('02'))) {
							$data_fim = $valor['ano'] . "-" . $valor['mes'] . "-28";
						  }
					?>
					<tr> 
                      <td><a href="javascript:carrega_data(<? echo $i;?>,'<? echo $valor['ano'] . "-" . $valor['mes'] . "-01";?>', '<? echo $data_fim;?>');" class="titulo2"><? echo $valor['mes'];?>/<? echo $valor['ano'];?></a></td>
                    </tr>
                    <tr> 
                      <td><img src="../img/spacer.gif" width="2" height="1"> <div id="usuario_<? echo $i;?>" class="hide"></div></td>
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
<table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="1"><img src="../img/topo1.jpg" width="10" height="48"></td>
                <td background="../img/topo1bg.jpg"><table width="100%" border="0" cellspacing="0" cellpadding="2">
                    <tr> 
                      <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                          <tr> 
                            <td width="224" class="texto">Seja bem vindo, <strong><? echo $_SESSION['nomeusuario'];?></strong>.</td>
                            <td width="80"><div align="center"><a href="../sair.php"><img src="../img/btn_logof.jpg" width="60" height="19" border="0"></a></div></td>
                            <td width="62"> <div align="center"><a href="../usuario/meus_dados.php"><img src="../img/btn_account.jpg" width="86" height="19" border="0" /></a> 
                        </div></td>
                            <td width="619">&nbsp;</td>
                          </tr>
                        </table></td>
                    </tr>
                  </table></td>
              </tr>
              <tr>
                <td width="1"><img src="../img/menu1.jpg" width="10" height="20"></td>
                <td background="../img/menu1bg.jpg"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      
                <td> <div align="left">
                    <script language="JavaScript" src="../scripts/stmenu.js"></script>
                    
					<script >						
						stm_bm(["menu728c",660,"","../include/menu.jpg",0,"","",0,0,250,0,1000,1,0,0,"","",0,0,1,2,"hand","hand",""],this);
						stm_bp("p0",[0,4,0,0,0,1,0,0,77,"",-2,"",-2,50,0,0,"#999999","#DEDEDE","",3,0,0,"#000000"]);
							
							<?
							$res = $db->sql("SELECT T.cod_tela, nome, caminho, ordem FROM tela T inner join permissao P on (T.cod_tela = P.cod_tela)  where sub_ordem = 0 and P.cod_usuario = ".$_SESSION['cod_usuario']." order by T.ordem ");							
							
							
							while ($array_menu = mysql_fetch_array($res)) {							
							?>
								
							stm_ai("p0i0",[0,"<? echo $array_menu['nome']; ?>","","",-1,-1,0,"<? echo $array_menu['caminho']; ?>","_parent","","Administração","","",0,0,0,"","",0,0,0,1,1,"#999999",0,"#7CCCEA",1,"","../include/bg_menu_sob.jpg",3,3,0,0,"#FFFFF7","#000000","#333333","#333333","bold 9px 'Tahoma','Verdana'","bold 9px 'Tahoma','Verdana'",0,0],150,20);
							stm_bpx("p1","p0",[1,4,0,0,2,1,0,0,90,"progid:DXImageTransform.Microsoft.Fade(overlap=.5,enabled=0,Duration=0.60)"]);
							
							<? 
							
							$res1 = $db->sql("SELECT T.cod_tela, nome, caminho FROM tela T inner join permissao P on (T.cod_tela = P.cod_tela) where ordem = $array_menu[ordem] and sub_ordem > 0 and P.cod_usuario = ".$_SESSION['cod_usuario']." order by T.sub_ordem ");
							
							while ($array_menu1 = mysql_fetch_array($res1)) {		?>
														
							stm_aix("p1i0","p0i0",[0," <? echo $array_menu1['nome']; ?>","","",-1,-1,0,"<? echo $array_menu1['caminho']; ?>","_parent","","","","",0,0,0,"","",0,0,0,0,1,"#F3F3F3",0,"#E6E6E6",0,"","",3,3,0,0,"#FFFFF7","#000000","#333333","#333333","11px 'Tahoma','Verdana'","11px 'Tahoma','Verdana'"],175,0);
							
							<? } ?>
							stm_ep();
							stm_ai("p0i1",[6,1,"#000000","../include/separador.gif",3,20,0]);
							
							<? } ?>
							
						stm_cf([0,0,0,"Principal","topFrame",1]);
						stm_em();						
						

						</script>
                    </div></td>
                      <td width="1">
<div align="right"><img src="../img/menu_canto.jpg" width="19" height="20"></div></td>
                    </tr>
                  </table></td>
              </tr>
            </table></td>
          <td width="250" background="../img/topo_bg.jpg"> 
            <table border="0" align="right" cellpadding="0" cellspacing="0">
              <tr>
                <td width="1">
<div align="right"><img src="../img/log.jpg" width="192" height="68"></div></td>
                <td width="1">
<div align="right"><img src="../img/topo_canto.jpg" width="8" height="68"></div></td>
              </tr>
            </table></td>
        </tr>
      </table>
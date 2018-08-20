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
                    <?
					/*$db->sql("SELECT cod_permissao, nome FROM permissao WHERE cod_usuario = ".$_SESSION['cod_usuario']);
					
					$permissao = array();
					while ($valor1 = $db->fetch_array()) {
					
						$permissao[] = $valor1['nome'];
					
					}*/
					?>
					<script >						
						stm_bm(["menu728c",660,"","../include/menu.jpg",0,"","",0,0,250,0,1000,1,0,0,"","",0,0,1,2,"hand","hand",""],this);
						stm_bp("p0",[0,4,0,0,0,1,0,0,77,"",-2,"",-2,50,0,0,"#999999","#DEDEDE","",3,0,0,"#000000"]);
						
							stm_ai("p0i0",[0,"RELATÓRIOS","","",-1,-1,0,"../index.php","_parent","","Administração","","",0,0,0,"","",0,0,0,1,1,"#999999",0,"#7CCCEA",1,"","../include/bg_menu_sob.jpg",3,3,0,0,"#FFFFF7","#000000","#333333","#333333","bold 9px 'Tahoma','Verdana'","bold 9px 'Tahoma','Verdana'",0,0],110,20);
							stm_bpx("p1","p0",[1,4,0,0,2,1,0,0,90,"progid:DXImageTransform.Microsoft.Fade(overlap=.5,enabled=0,Duration=0.60)"]);
							stm_aix("p1i0","p0i0",[0," Exportar Clientes","","",-1,-1,0,"../relatorio/busca.php","_parent","","","","",0,0,0,"","",0,0,0,0,1,"#F3F3F3",0,"#E6E6E6",0,"","",3,3,0,0,"#FFFFF7","#000000","#333333","#333333","11px 'Tahoma','Verdana'","11px 'Tahoma','Verdana'"],175,0);
							//stm_aix("p1i0","p0i0",[0," Relatório de Desconexão","","",-1,-1,0,"#","_parent","","","","",0,0,0,"","",0,0,0,0,1,"#F3F3F3",0,"#E6E6E6",0,"","",3,3,0,0,"#FFFFF7","#000000","#333333","#333333","11px 'Tahoma','Verdana'","11px 'Tahoma','Verdana'"],175,0);
							//stm_aix("p1i0","p0i0",[0," Relatório de Evolução de Consumo","","",-1,-1,0,"#","_parent","","","","",0,0,0,"","",0,0,0,0,1,"#F3F3F3",0,"#E6E6E6",0,"","",3,3,0,0,"#FFFFF7","#000000","#333333","#333333","11px 'Tahoma','Verdana'","11px 'Tahoma','Verdana'"],175,0);
							stm_ep();
							stm_ai("p0i1",[6,1,"#000000","../include/separador.gif",3,20,0]);						
					   							
							stm_ai("p3i0",[0,"CADASTRO DE CLIENTES","","",-1,-1,0,"../index.php","_parent","","Administração","","",0,0,0,"","",0,0,0,1,1,"#999999",0,"#7CCCEA",1,"","../include/bg_menu_sob.jpg",3,3,0,0,"#FFFFF7","#000000","#333333","#333333","bold 9px 'Tahoma','Verdana'","bold 9px 'Tahoma','Verdana'",0,0],150,20);
							stm_bpx("p1","p0",[1,4,0,0,2,1,0,0,90,"progid:DXImageTransform.Microsoft.Fade(overlap=.5,enabled=0,Duration=0.60)"]);
						    
								
							stm_aix("p1i0","p3i0",[0," Cadastro de Cliente","","",-1,-1,0,"../cliente_novo/cadastro.php","_parent","","","","",0,0,0,"","",0,0,0,0,1,"#F3F3F3",0,"#E6E6E6",0,"","",3,3,0,0,"#FFFFF7","#000000","#333333","#333333","11px 'Tahoma','Verdana'","11px 'Tahoma','Verdana'"],200,0);
								
							
							stm_aix("p1i0","p3i0",[0," Aprovação de Cadastro","","",-1,-1,0,"../cliente_novo/consulta_aprovacao.php","_parent","","","","",0,0,0,"","",0,0,0,0,1,"#F3F3F3",0,"#E6E6E6",0,"","",3,3,0,0,"#FFFFF7","#000000","#333333","#333333","11px 'Tahoma','Verdana'","11px 'Tahoma','Verdana'"],200,0);
							
							stm_aix("p1i0","p3i0",[0," Pré-ativação Técnica","","",-1,-1,0,"../cliente_novo/consulta_pre_ativacao.php","_parent","","","","",0,0,0,"","",0,0,0,0,1,"#F3F3F3",0,"#E6E6E6",0,"","",3,3,0,0,"#FFFFF7","#000000","#333333","#333333","11px 'Tahoma','Verdana'","11px 'Tahoma','Verdana'"],200,0);
							
							stm_aix("p1i0","p3i0",[0," Ativação Técnica","","",-1,-1,0,"../cliente_novo/consulta_ativacao.php","_parent","","","","",0,0,0,"","",0,0,0,0,1,"#F3F3F3",0,"#E6E6E6",0,"","",3,3,0,0,"#FFFFF7","#000000","#333333","#333333","11px 'Tahoma','Verdana'","11px 'Tahoma','Verdana'"],200,0);
							
							stm_aix("p1i0","p3i0",[0," Aprovação Controladoria","","",-1,-1,0,"../cliente_novo/consulta_controladoria.php","_parent","","","","",0,0,0,"","",0,0,0,0,1,"#F3F3F3",0,"#E6E6E6",0,"","",3,3,0,0,"#FFFFF7","#000000","#333333","#333333","11px 'Tahoma','Verdana'","11px 'Tahoma','Verdana'"],200,0);
							
							stm_ep();
							stm_ai("p0i1",[6,1,"#000000","../include/separador.gif",3,20,0]);
							
							stm_ai("p3i0",[0,"ALTERAÇÃO DE TARIFAS","","",-1,-1,0,"../index.php","_parent","","Administração","","",0,0,0,"","",0,0,0,1,1,"#999999",0,"#7CCCEA",1,"","../include/bg_menu_sob.jpg",3,3,0,0,"#FFFFF7","#000000","#333333","#333333","bold 9px 'Tahoma','Verdana'","bold 9px 'Tahoma','Verdana'",0,0],150,20);
							stm_bpx("p1","p0",[1,4,0,0,2,1,0,0,90,"progid:DXImageTransform.Microsoft.Fade(overlap=.5,enabled=0,Duration=0.60)"]);
						    
								
							stm_aix("p1i0","p3i0",[0," Solicitação da Alteração de Tarifa","","",-1,-1,0,"#","_parent","","","","",0,0,0,"","",0,0,0,0,1,"#F3F3F3",0,"#E6E6E6",0,"","",3,3,0,0,"#FFFFF7","#000000","#333333","#333333","11px 'Tahoma','Verdana'","11px 'Tahoma','Verdana'"],200,0);
								
							
							stm_aix("p1i0","p3i0",[0," Aprovação da Solicitação","","",-1,-1,0,"#","_parent","","","","",0,0,0,"","",0,0,0,0,1,"#F3F3F3",0,"#E6E6E6",0,"","",3,3,0,0,"#FFFFF7","#000000","#333333","#333333","11px 'Tahoma','Verdana'","11px 'Tahoma','Verdana'"],200,0);
							
							stm_aix("p1i0","p3i0",[0," Pré-ativação Técnica","","",-1,-1,0,"#","_parent","","","","",0,0,0,"","",0,0,0,0,1,"#F3F3F3",0,"#E6E6E6",0,"","",3,3,0,0,"#FFFFF7","#000000","#333333","#333333","11px 'Tahoma','Verdana'","11px 'Tahoma','Verdana'"],200,0);
							
							stm_aix("p1i0","p3i0",[0," Ativação Técnica","","",-1,-1,0,"#","_parent","","","","",0,0,0,"","",0,0,0,0,1,"#F3F3F3",0,"#E6E6E6",0,"","",3,3,0,0,"#FFFFF7","#000000","#333333","#333333","11px 'Tahoma','Verdana'","11px 'Tahoma','Verdana'"],200,0);
							
							stm_aix("p1i0","p3i0",[0," Aprovação Controladoria","","",-1,-1,0,"#","_parent","","","","",0,0,0,"","",0,0,0,0,1,"#F3F3F3",0,"#E6E6E6",0,"","",3,3,0,0,"#FFFFF7","#000000","#333333","#333333","11px 'Tahoma','Verdana'","11px 'Tahoma','Verdana'"],200,0);
							
							stm_ep();
							stm_ai("p0i1",[6,1,"#000000","../include/separador.gif",3,20,0]);
							
							
							stm_ai("p3i0",[0,"ALTERAÇÃO DE CADASTRO","","",-1,-1,0,"../index.php","_parent","","Administração","","",0,0,0,"","",0,0,0,1,1,"#999999",0,"#7CCCEA",1,"","../include/bg_menu_sob.jpg",3,3,0,0,"#FFFFF7","#000000","#333333","#333333","bold 9px 'Tahoma','Verdana'","bold 9px 'Tahoma','Verdana'",0,0],150,20);
							stm_bpx("p1","p0",[1,4,0,0,2,1,0,0,90,"progid:DXImageTransform.Microsoft.Fade(overlap=.5,enabled=0,Duration=0.60)"]);
						    
								
							stm_aix("p1i0","p3i0",[0," Solicitação da Alteração de Cadastro","","",-1,-1,0,"#","_parent","","","","",0,0,0,"","",0,0,0,0,1,"#F3F3F3",0,"#E6E6E6",0,"","",3,3,0,0,"#FFFFF7","#000000","#333333","#333333","11px 'Tahoma','Verdana'","11px 'Tahoma','Verdana'"],200,0);
								
							
							stm_aix("p1i0","p3i0",[0," Aprovação da Solicitação","","",-1,-1,0,"#","_parent","","","","",0,0,0,"","",0,0,0,0,1,"#F3F3F3",0,"#E6E6E6",0,"","",3,3,0,0,"#FFFFF7","#000000","#333333","#333333","11px 'Tahoma','Verdana'","11px 'Tahoma','Verdana'"],200,0);
							
							stm_aix("p1i0","p3i0",[0," Pré-ativação Técnica","","",-1,-1,0,"#","_parent","","","","",0,0,0,"","",0,0,0,0,1,"#F3F3F3",0,"#E6E6E6",0,"","",3,3,0,0,"#FFFFF7","#000000","#333333","#333333","11px 'Tahoma','Verdana'","11px 'Tahoma','Verdana'"],200,0);
							
							stm_aix("p1i0","p3i0",[0," Ativação Técnica","","",-1,-1,0,"#","_parent","","","","",0,0,0,"","",0,0,0,0,1,"#F3F3F3",0,"#E6E6E6",0,"","",3,3,0,0,"#FFFFF7","#000000","#333333","#333333","11px 'Tahoma','Verdana'","11px 'Tahoma','Verdana'"],200,0);
							
							stm_aix("p1i0","p3i0",[0," Aprovação Controladoria","","",-1,-1,0,"#","_parent","","","","",0,0,0,"","",0,0,0,0,1,"#F3F3F3",0,"#E6E6E6",0,"","",3,3,0,0,"#FFFFF7","#000000","#333333","#333333","11px 'Tahoma','Verdana'","11px 'Tahoma','Verdana'"],200,0);
							
							stm_ep();
							stm_ai("p0i1",[6,1,"#000000","../include/separador.gif",3,20,0]);
							
							
							stm_ai("p3i0",[0,"ADMINISTRAÇÃO","","",-1,-1,0,"../index.php","_parent","","Administração","","",0,0,0,"","",0,0,0,1,1,"#999999",0,"#7CCCEA",1,"","../include/bg_menu_sob.jpg",3,3,0,0,"#FFFFF7","#000000","#333333","#333333","bold 9px 'Tahoma','Verdana'","bold 9px 'Tahoma','Verdana'",0,0],150,20);
							stm_bpx("p1","p0",[1,4,0,0,2,1,0,0,90,"progid:DXImageTransform.Microsoft.Fade(overlap=.5,enabled=0,Duration=0.60)"]);
						    
								
							stm_aix("p1i0","p3i0",[0," Cadastro de Usuário","","",-1,-1,0,"#","_parent","","","","",0,0,0,"","",0,0,0,0,1,"#F3F3F3",0,"#E6E6E6",0,"","",3,3,0,0,"#FFFFF7","#000000","#333333","#333333","11px 'Tahoma','Verdana'","11px 'Tahoma','Verdana'"],200,0);
								
							
							stm_aix("p1i0","p3i0",[0," Consulta de Log","","",-1,-1,0,"#","_parent","","","","",0,0,0,"","",0,0,0,0,1,"#F3F3F3",0,"#E6E6E6",0,"","",3,3,0,0,"#FFFFF7","#000000","#333333","#333333","11px 'Tahoma','Verdana'","11px 'Tahoma','Verdana'"],200,0);
							
							stm_ep();
							stm_ai("p0i1",[6,1,"#000000","../include/separador.gif",3,20,0]);
							
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
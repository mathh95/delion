<?php 

	  include("../biblioteca/online.php");      
	  
	  $where = '';
	  $entrou = '';
	  $parametro = '';
	  
	  if (!isset($_REQUEST['id_usuario'])) {
	  	$_REQUEST['id_usuario'] = '';
	  } else {
	  	 if  ($_REQUEST['id_usuario'] != '') {
			 $where = "where U.id_usuario = " . $_REQUEST['id_usuario'];
			 $entrou = 'sim';
			 $parametro .= '&id_usuario=' . $_REQUEST['id_usuario'];
		 }
		 
	  }
	  
	  if (!isset($_REQUEST['nome'])) {
	  	$_REQUEST['nome'] = '';
		$nome = '';
	  } else {
	  	if  ($_REQUEST['nome'] != '') {	
			if (!$entrou) {
				$where = " where U.nome like '%".$_REQUEST['nome'] ."%'";
			} else {
				$where .=	" and U.nome like '%".$_REQUEST['nome'] ."%'";
			}
			$parametro .= '&nome=' . $_REQUEST['nome'];
		}
	  }
	  
	  if (!isset($_REQUEST['hora'])) {
	  	$_REQUEST['hora'] = '';
	  } else {
	  	if  ($_REQUEST['hora'] != '') {	
			if (!$entrou) {
				$where = " where hora = '".$_REQUEST['hora'] ."'";
			} else {
				$where .=	" and hora = '".$_REQUEST['hora'] ."'";
			}
			
		}
	  }
	  
	  if (!isset($_REQUEST['tipo'])) {
	  	$_REQUEST['tipo'] = '';
	  } else {
	 	if  ($_REQUEST['tipo'] != '') {	
			if (!$entrou) {
				$where = " where tipo = '".$_REQUEST['tipo'] ."'";
			} else {
				$where .=	" and tipo = '".$_REQUEST['tipo'] ."'";
			}
		}
	  }
	  
	  
	  if  (($_REQUEST['data_inicio'] == '') || ($_REQUEST['data_fim'] == '')) {
	  
		  if (!isset($_REQUEST['data_inicio'])) {
			$_REQUEST['data_inicio'] = '';
			$data_inicio = '';
		  } else {
			if  ($_REQUEST['data_inicio'] != '') {
				$data = explode("/", $_REQUEST['data_inicio']);
				$data_inicio = $data[2] . "-" . $data[1] . "-" . $data[0];				
				if (!$entrou) {
					$where = " where data_cad = '".$data_inicio."'";
				 } else {
					$where .=	" and data_cad = '".$data_inicio."'";
				 }
				$parametro .= '&data_inicio=' . $_REQUEST['data_inicio'];
			}
		  }
		  
		  if (!isset($_REQUEST['data_fim'])){
			$_REQUEST['data_fim'] = '';
			$data_fim = '';
		  } else {
			if  ($_REQUEST['data_fim'] != '') {
				$data = explode("/", $_REQUEST['data_fim']);
				$data_fim = $data[2] . "-" . $data[1] . "-" . $data[0];				
				if (!$entrou) {
					$where = " where data_cad = '".$data_fim."'";
				 } else {
					$where .=	" and data_cad = '".$data_fim."'";
				 }
				 $parametro .= '&data_fim=' . $_REQUEST['data_fim'];
			}
		  }
	  
	  } else {
	  	 
		 
			 $data = explode("/", $_REQUEST['data_inicio']);
			 $data_inicio = $data[2] . "-" . $data[1] . "-" . $data[0];
			 
			 $data = explode("/", $_REQUEST['data_fim']);
			 $data_fim = $data[2] . "-" . $data[1] . "-" . $data[0];
				
			 if (!$entrou) {
				$where = " where data_cad between '".$data_inicio."' and '".$data_fim."' ";
			 } else {
				$where .=	" and data_cad between '".$data_inicio."' and '".$data_fim."' ";
			 }
			 $parametro .= '&data_inicio=' . $_REQUEST['data_inicio'];
			 $parametro .= '&data_fim=' . $_REQUEST['data_fim'];		
	  
	  }
	  
	  /*print_r($_REQUEST);
	  echo $where;
	  exit;*/
	  
	  
	  //Prepara o sql
	  $sql = "SELECT U.id_usuario, U.nome, LU.hora_cad, LU.data_cad, LU.ip, LU.tipo_acao, LU.acao, id_log_usuario, LU.consulta FROM log_usuario LU inner join usuario U on (LU.id_usuario = U.id_usuario) $where order by LU.data_cad desc, LU.hora_cad desc";
	  
	  $where = addslashes($where);
	  
	  
	  if (!isset($_GET["id"])) {
	  	$_GET["id"] = '';
		//grava no log que o usuário entrou na consulta
	 	$db->sql("insert into log_usuario (id_usuario, ip,  hora_cad, data_cad, tipo_acao, consulta, acao) values (".$_SESSION["id_usuario"]."  , '".$_SERVER["REMOTE_ADDR"]."' ,  '".date('H:i:s')."' , '".date('Y-m-d')."','Consulta' ,'SELECT U.id_usuario, U.nome, LU.hora_cad, LU.data_cad, LU.ip, LU.tipo, LU.descricao FROM log_usuario LU inner join usuario U on (LU.id_usuario = U.id_usuario) $where order by LU.data_cad desc, LU.hora_cad desc', 'Consulta no Log') ");
	  }
	  
	  $p = new paginacao_ajax($db,$sql,13,5,$_GET["id"],$t_adm_log,$_SESSION);
	  
	  $res2 = $p->db->get_result();  

?> 
<table width="99%" border="0" align="center" cellpadding="0" cellspacing="0">
                    <tr> 
                      <td height="1"><img src="../img/spacer.gif" width="5" height="10"></td>
                    </tr>
                    <tr> 
                      <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                          <tr> 
                            <td width="1" height="1"><img src="../img/form1.jpg" width="14" height="14"></td>
                            <td height="1" bgcolor="#F5F8FA"><img src="../img/spacer.gif" width="5" height="5"></td>
                            <td width="1" height="1"><img src="../img/form2.jpg" width="14" height="14"></td>
                          </tr>
                        </table></td>
                    </tr>
                    <tr> 
                      <td bgcolor="#F5F8FA"><table width="98%" border="0" align="center" cellpadding="3" cellspacing="0">
                          <tr> 
                            <td class="titulo2">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <form name="busca" action="consulta.php">
                                  <tr> 
                                    <td width="1"><img src="../img/ico.jpg" width="19" height="9"></td>
                                    <td class="titulo2">RELAT&Oacute;RIO DE LOG 
                                      DE USU&Aacute;RIOS</td>
                                  </tr>
                                </form>
                              </table></td>
                          </tr>
                          <tr> 
                            <td><table width="100%" border="0" align="center" cellpadding="3" cellspacing="0">
                                <tr bgcolor="#D8E3EB" class="textp"> 
                                  <td><table width="100%" border="0" align="center" cellpadding="3" cellspacing="0">
                                      <tr bgcolor="#D8E3EB" class="textp"> 
                                        <td width="20%"><strong>Usu&aacute;rio</strong></td>
                                        <td width="11%"><strong>Hora</strong></td>
                                        <td width="11%"><strong>Data</strong></td>
                                        <td width="9%"><strong>IP</strong></td>
										<td width="10%"><div align="center"><strong>SQL</strong></div></td>
                                        <td width="15%"><strong>TIPO</strong></td>
                                        <td width="24%"><strong>DESCRI&Ccedil;&Atilde;O</strong></td>
                                      </tr>
                                    </table></td>
                                </tr>
                                <tr> 
                                  <td><table width="100%" border="0" align="center" cellpadding="3" cellspacing="0" class="realce">
                    <? 
								    if (mysql_num_rows($res2)){
									
									$bg = 'bgcolor=\"#FFFFFF\"';
									$i = 0;
									while ($resultado = mysql_fetch_array($res2)) { 
									$i++;
									if ($bg == '') {
										$bg = "bgcolor=\"#FFFFFF\"";
									} else {
										$bg = "";
									}
									
								?>
                    <tr class="textp" <? echo $bg;?>> 
                      <td width="20%" ><div class="textp"><? echo $resultado[1];?></div></td>
                      <td width="11%" ><div class="textp"><? echo $resultado[2];?></div></td>
                      <td width="11%" ><div class="textp"><? echo $resultado[3];?></div></td>
                      <td width="9%" ><div class="textp"><? echo $resultado[4];?></div></td>
                      <td width="10%" ><div align="center"><? if ($resultado['consulta'] != '') { ?><a href="javascript:mostra_sql(<? echo $i;?>,<? echo $resultado['id_log_usuario'];?>)" class="textp">SQL</a><? } ?></div>
                        <div id="sql_<? echo $i;?>" class="hide"></td>
                      <td width="15%" ><div class="textp"><? echo $resultado[5];?></div></td>
                      <td width="24%" ><div class="textp"><? echo $resultado[6];?></div></td>
                    </tr>
                    <? } 
								
								} else {
								?>
                    <tr class="textp"> 
                      <td colspan="7" bgcolor="#CCCCCC"> <div align="center">Nenhum 
                          Registro encontrado</div></td>
                    </tr>
                    <? } ?>
                  </table></td>
                                </tr>
                              </table></td>
                          </tr>
                        </table></td>
                    </tr>
                    <tr> 
                      <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                          <tr> 
                            <td width="1" height="1"><img src="../img/form4.jpg" width="14" height="14"></td>
                            <td height="1" background="../img/form5.jpg"><img src="../img/form5.jpg" width="14" height="14"></td>
                            <td width="1" height="1"><img src="../img/form3.jpg" width="14" height="14"></td>
                          </tr>
                        </table></td>
                    </tr>
					<tr> 
                <td height="2" align="right"><img src="../img/spacer.gif" width="5" height="5"></td>
              </tr>
              <tr> 
                <td height="1" align="right"><table width="98%" border="0" align="center" cellpadding="0" cellspacing="0">
                    <tr> 
                      <td width="50" height="20"> <div align="left"></div></td>
                      <td width="419" height="20"> <div align="center"></div></td>
                      <td width="296" height="20"> 
                       
                        <div align="center">
						 <?
  
						$p->escreve_paginacao("../img/btn_anterior.jpg", "../img/btn_proxima.jpg", "textp", $parametro );
						
						$p->db->free_result();
					  
					  ?>
						</div></td>
                    </tr>
                  </table></td>
              </tr>
                    <tr> 
                      <td height="2" align="right"><img src="../img/spacer.gif" width="5" height="5"></td>
                    </tr>
                  </table>
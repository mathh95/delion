<?php

  include("../biblioteca/online.php");
  
	   		
		
	   //pega o nome da tela
	   $sql = "SELECT * FROM tela where cod_tela = " . $t_categoria . ' limit 0,1';	  
	   $res = $db->sql($sql);
	   $valor_tela = $db->fetch_array();	
  
	  if (!isset($_REQUEST['nome'])) {
	  	$_REQUEST['nome'] = '';
	  }
	  
	  //Prepara o sql	
		if ($_REQUEST['nome'] != '') {
			$sql = "SELECT cod_categoria, C.nome FROM categoria C  where C.nome like '%".$_REQUEST['nome']."%' order by C.nome";
		} else {
			$sql = "SELECT cod_categoria, C.nome FROM categoria C order by C.nome";
		}
	 
	  
	  if (!isset($_GET["id"])) {
	  	$_GET["id"] = '';
	  }
	  
	  
	  $p = new paginacao($db,$sql,50,10,$_GET["id"],$t_categoria, $_SESSION);
	  
	  $res2 = $p->db->get_result(); 
	  
	  
  
?>

<title><? echo $nome_empresa?></title>
<link href="../css/fontes.css" rel="stylesheet" type="text/css">
<style type="text/css">
body {
	behavior: url(../css/csshover.htc);
}

table.realce tr:hover {
	background: #FFFAB4;
}
</style>
<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" onLoad="javascript:document.busca.nome.focus();">
<table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0">
  <tr> 
    <td height="28" background="../img/cantobg.jpg"><table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="18"><img src="../img/canto1.jpg" width="10" height="28"></td>
          <td width="400" class="titulo"><strong><? echo $nome_empresa?></strong></td>
		  <td width="538" class="texto">
<div align="right">
              <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr> 
                  <td height="1" colspan="3"><img src="../img/spacer.gif" width="5" height="5"></td>
                </tr>
                <tr> 
                  <td class="texto"> 
                    <div align="right"> 
                      <script language="JavaScript" src="../scripts/date2.js"></script>
                    </div></td>
                  <td width="20" class="texto"> 
                    <div align="center"><img src="../img/relogio.gif" width="10" height="10"></div></td>
                  <td width="10" class="texto">&nbsp;</td>
                </tr>
              </table>
            </div></td>
          <td width="30">
<div align="right"><img src="../img/canto2.jpg" width="30" height="28"></div></td>
        </tr>
      </table></td>
  </tr>
  <tr>
     <td height="68"> <? include ("../include/topo.php"); ?> </td>
  </tr>
  <tr>
    <td height="11">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="1" height="11"><img src="../img/sombra1.jpg" width="10" height="11"></td>
          <td height="11" background="../img/sombra2.jpg"><img src="../img/sombra2.jpg" width="3" height="11"></td>
          <td width="1" height="11"> 
            <div align="right"><img src="../img/sombra3.jpg" width="8" height="11"></div></td>
        </tr>
      </table>
    </td>
  </tr>
  <tr> 
    <td valign="top">
<table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td width="1" background="../img/bg1.jpg"><img src="../img/bg1.jpg" width="10" height="11"></td>
          <td valign="top">
<table width="98%" border="0" align="center" cellpadding="0" cellspacing="0">
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
                <td bgcolor="#F5F8FA">
				<? 
					if (!isset($_GET['msg']))
					$_GET['msg'] = '';
					$saida = $_GET['msg'];
					if ($saida <> '')
					$saida = $$saida;
					echo "<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"2\">
							<tr>
								<td class=\"texto\"><font color=\"#CC0000\">$saida</font></td>
							</tr>
						  </table>"; 
				  ?>
				<table width="98%" border="0" align="center" cellpadding="3" cellspacing="0">
                    <tr> 
                      <td class="titulo2"> <table width="100%" border="0" cellspacing="0" cellpadding="0">
                          <form name="busca" action="consulta.php">
						  <tr> 
                            <td width="1"><img src="../img/ico.jpg" width="19" height="9"></td>
                            <td class="titulo2">Consulta de <? echo $valor_tela['nome'];?></td>
                            <td width="50" class="titulo2">BUSCA:</td>
                            <td width="1" class="titulo2"> 
                              <input name="nome" type="text" class="form2" id="nome" value="<? echo $_REQUEST['nome'];?>">
                            </td>
                            <td width="45" class="titulo2"> 
                              <div align="center">
                                <input name="Submit" type="submit" class="botao" value="OK">
                              </div></td>
                          </tr>
						  </form>
                        </table></td>
                    </tr>
                    <tr> 
                      <td><table width="100%" border="0" align="center" cellpadding="3" cellspacing="0">
                          <tr bgcolor="#D8E3EB" class="textp"> 
                            <td><table width="100%" border="0" align="center" cellpadding="3" cellspacing="0">
                                <tr bgcolor="#D8E3EB" class="textp"> 
                                  <td width="20%"><strong>Codigo</strong></td>
								  <td width="60%"><strong>Nome</strong></td>
                                  <td width="20%">&nbsp;</td>
                                </tr>
                              </table></td>
                          </tr>
                          <tr> 
                            <td><table width="100%" border="0" align="center" cellpadding="3" cellspacing="0" class="realce">
								<? 
								    if (mysql_num_rows($res2)){
									
									$bg = 'bgcolor=\"#FFFFFF\"';
									while ($resultado = mysql_fetch_array($res2)) { 
									
									if ($bg == '') {
										$bg = "bgcolor=\"#FFFFFF\"";
									} else {
										$bg = "";
									}
									
									
									
								?>
								<tr class="textp" <? echo $bg;?>> 
                                  <td width="20%" ><a href="alteracao.php?codigo=<? echo $resultado[0];?>&id=<? echo $_REQUEST["id"]?>" class="textp"><? echo $resultado[0];?></a></td>
                                  <td width="60%" ><a href="alteracao.php?codigo=<? echo $resultado[0];?>&id=<? echo $_REQUEST["id"]?>" class="textp"><? echo $resultado[1];?></a></td>
                                  
                                  <td width="20%">
                                  <table width="114" border="0" align="center" cellpadding="0" cellspacing="0">
                                      <script src="../scripts/all.js"></script>
									  <tr> 
                                        <td width="53"><a href="alteracao.php?codigo=<? echo $resultado[0];?>&id=<? echo $_REQUEST["id"]?>"><img src="../img/btn_editar.jpg" width="53" height="19" border="0"> </a></td>
                                        <td width="53"><a href="javascript:verifica_deletar('delecao_bd.php?cod_categoria=<? echo $resultado[0];?>')"><img src="../img/btn_apagar.jpg" width="53" height="19" border="0"></a></td>
                                      </tr>
                                    </table>
									</td>
                                  
                                </tr>
								<? } 
								
								} else {
								?>
								<tr class="textp"> 
                                  <td colspan="7" bgcolor="#CCCCCC">
										<div align="center">Nenhum Registro encontrado</div></td>
                                </tr>
								<? } ?>
                              </table></td>
                          </tr>
                        </table></td>
                    </tr>
                  </table>
                  
                </td>
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
                      <td width="71" height="20"> <div align="left"><a href="../include/index.php"><img src="../img/btn_voltar.jpg" width="47" height="17" border="0"></a></div></td>
                      <td width="791" height="20"> <div align="center">
                      
                      <a href="alteracao.php"><img src="../img/btn_cad.jpg" width="161" height="19" border="0"></a>
                      
                      </div></td>
                      <td width="213" height="20"> 
                       
                        <div align="center">
						 <?
  
						$p->escreve_paginacao("../img/btn_anterior.jpg", "../img/btn_proxima.jpg", "textp", "&nome=" . $_REQUEST['nome'] );
						
						$p->db->free_result();
					  
					  ?>
						</div></td>
                    </tr>
                  </table></td>
              </tr>
              <tr>
                <td height="1" align="right"><img src="../img/spacer.gif" width="5" height="12"></td>
              </tr>
            </table></td>
          <td width="1" background="../img/bg2.jpg"><img src="../img/bg2.jpg" width="8" height="11"></td>
        </tr>
      </table></td>
  </tr>
  <tr> 
    <td height="1"><? include("../include/rodape.php") ?></td>
  </tr>
</table>


<?

include("../biblioteca/online.php");

$db->sql("SELECT * FROM usuario WHERE cod_usuario = ".$_SESSION['cod_usuario']);
$valor = $db->fetch_array();



?>
<head>
<title><? echo $nome_empresa?></title>
<link href="../css/fontes.css" rel="stylesheet" type="text/css">
<script src="../scripts/prototype.js"></script>
<script>

function gravar_super_categoria(cod_usuario,numero_item) {
	
  var i;
  if (numero_item == 1) {
  	
		for (i=1;i<=9;i++){
		
			document.getElementById("categoria" + numero_item+ i).checked = document.getElementById("super_categoria" + numero_item).checked;
		
		}
  }
  if (numero_item == 2) {
  	
		for (i=1;i<=3;i++){
		
			document.getElementById("categoria" + numero_item+ i).checked = document.getElementById("super_categoria" + numero_item).checked;
		
		}
  }
  if (numero_item == 3) {
  	
		for (i=1;i<=7;i++){
		
			document.getElementById("categoria" + numero_item+ i).checked = document.getElementById("super_categoria" + numero_item).checked;
		
		}
  }
  if (numero_item == 4) {
  	
		for (i=1;i<=22;i++){
		
			document.getElementById("categoria" + numero_item+ i).checked = document.getElementById("super_categoria" + numero_item).checked;
		
		}
  }
  
  if (numero_item == 5) {
  	
		for (i=1;i<=3;i++){
		
			document.getElementById("categoria" + numero_item+ i).checked = document.getElementById("super_categoria" + numero_item).checked;
		
		}
  }

}

function gravar_categoria(numero_item, numero_sub_item) {
	
  var i, j;
  if (numero_item == 1) {
  		j = 0;
		for (i=1;i<=9;i++){
		
			if (document.getElementById("categoria" + numero_item+ i).checked == false) {
				j++;
			}
		
		}
		if (j == 3) {
			document.getElementById("super_categoria" + numero_item).checked = false;
		} else {
			document.getElementById("super_categoria" + numero_item).checked = true;
		}
  }
  if (numero_item == 2) {
  	
		j = 0;
		for (i=1;i<=3;i++){
		
			if (document.getElementById("categoria" + numero_item+ i).checked == false) {
				j++;
			}
		
		}
		if (j == 16) {
			document.getElementById("super_categoria" + numero_item).checked = false;
		} else {
			document.getElementById("super_categoria" + numero_item).checked = true;
		}
  }
  if (numero_item == 3) {
  	
		j = 0;
		for (i=1;i<=7;i++){
		
			if (document.getElementById("categoria" + numero_item+ i).checked == false) {
				j++;
			}
		
		}
		if (j == 8) {
			document.getElementById("super_categoria" + numero_item).checked = false;
		} else {
			document.getElementById("super_categoria" + numero_item).checked = true;
		}
  }
  if (numero_item == 4) {
  	
		j = 0;
		for (i=1;i<=22;i++){
		
			if (document.getElementById("categoria" + numero_item+ i).checked == false) {
				j++;
			}
		
		}
		if (j == 4) {
			document.getElementById("super_categoria" + numero_item).checked = false;
		} else {
			document.getElementById("super_categoria" + numero_item).checked = true;
		}
  }
  if (numero_item == 5) {
  	
		j = 0;
		for (i=1;i<=3;i++){
		
			if (document.getElementById("categoria" + numero_item+ i).checked == false) {
				j++;
			}
		
		}
		if (j == 4) {
			document.getElementById("super_categoria" + numero_item).checked = false;
		} else {
			document.getElementById("super_categoria" + numero_item).checked = true;
		}
  }

}

function envia_permissao(cod_usuario){
   if (confirm("Você tem certeza que deseja realizar essa operação?")) 
   {
		var url;
		url = "cadastro_permissao_bd.php?cod_usuario=" + cod_usuario;
		for (i = 0; i < document.permissao.elements.length; i++) {
			if (document.permissao.elements[i].type == "checkbox") {
				
				if (document.permissao.elements[i].checked == true) {
					url = url + "&permissao[" + i + "]=" + escape(document.permissao.elements[i].value);
				}
				
			}
			
		}
		
		window.open(url,"_self","") ;
	}

}

</script>

</head>
<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0">
  <tr> 
    <td height="28" background="../img/cantobg.jpg"><table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="18"><img src="../img/canto1.jpg" width="10" height="28"></td>
          <td width="150" class="titulo"><strong></strong></td>
		  <td class="texto">
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
          <td width="10">
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
    <td valign="top"><table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td width="1" background="../img/bg1.jpg"><img src="../img/bg1.jpg" width="10" height="11"></td>
          <td valign="top">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr> 
                <td width="50%" align="center" valign="top"> 
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
                      <td valign="top" bgcolor="#F5F8FA"> <table width="95%" border="0" align="center" cellpadding="3" cellspacing="0">
                          <form name="formulario" action="meus_dados_alteracao_bd.php" method="post">
                            <tr> 
                              <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                  <tr> 
                                    <td width="1"><img src="../img/ico.jpg" width="19" height="9"></td>
                                    <td class="titulo2">ALTERA&Ccedil;&Atilde;O 
                                      DE USU&Aacute;RIO</td>
                                  </tr>
                                </table></td>
                            </tr>
                            <tr> 
                              <td bgcolor="#D8E3EB"> <table width="100%" border="0" cellspacing="0" cellpadding="2">
                                  <tr> 
                                    <td width="100" class="textp"> <div align="right">Nome:</div></td>
                                    <td><input name="nome" type="text" class="form" id="nome" value="<? echo $valor['nome'];?>"></td>
                                  </tr>
                                </table></td>
                            </tr>
                            <tr> 
                              <td bgcolor="#D8E3EB"> <table width="100%" border="0" cellspacing="0" cellpadding="2">
                                  <tr> 
                                    <td width="100" class="textp"> <div align="right"> 
                                        Senha:</div></td>
                                    <td><input name="senha" type="password" class="form" id="senha" value="<? $senha = $valor['senha']; echo $senha;?>"></td>
                                  </tr>
                                </table></td>
                            </tr>
                            <tr> 
                              <td><table width="100%" border="0" cellspacing="0" cellpadding="2">
                                  <tr> 
                                    <td width="100" class="textp"> <div align="right">E-mail:</div></td>
                                    <td><input name="email" type="text" class="form" id="email" value="<? echo $valor['email'];?>"></td>
                                  </tr>
                                </table></td>
                            </tr>
                            <tr> 
                              <td bgcolor="#D8E3EB"> <table width="100%" border="0" cellspacing="0" cellpadding="2">
                                  <tr> 
                                    <td width="100" class="textp"> <div align="right">Telefone 
                                        1:</div></td>
                                    <td><input name="telefone1" type="text" class="form" id="telefone1" value="<? echo $valor['telefone1'];?>"></td>
                                  </tr>
                                </table></td>
                            </tr>
                            <tr> 
                              <td><table width="100%" border="0" cellspacing="0" cellpadding="2">
                                  <tr> 
                                    <td width="100" class="textp"> <div align="right">Telefone 
                                        2 :</div></td>
                                    <td><input name="telefone2" type="text" class="form" id="telefone2" value="<? echo $valor['telefone2'];?>"></td>
                                  </tr>
                                </table></td>
                            </tr>
                            <tr> 
                              <td height="1"><img src="../img/spacer.gif" width="5" height="5"></td>
                            </tr>
                            <tr> 
                              <td> <div align="left"> 
                                  <script src="valida_meus_dados.js"></script>
                                  <input type="hidden" name="cod_usuario" value="<? echo $_SESSION['cod_usuario']; ?>" >
                                  <input name="Button" type="button" class="texto" value="Alterar" onClick="envia()">
                                  <input name="Submit2" type="button" class="texto" value="Cancelar" onClick='javascript:history.go(-1);'>
                                </div></td>
                            </tr>
                          </form>
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
                  </table>                
                  </td>
              </tr>
              <tr> 
                <td height="1"><img src="../img/spacer.gif" width="5" height="10"></td>
                <td><img src="../img/spacer.gif" width="5" height="10"></td>
              </tr>
              <tr> 
                <td colspan="2"><table width="98%" border="0" align="center" cellpadding="0" cellspacing="0">
                    <tr> 
                      <td width="48"> <div align="left"><a href="consulta.php"><img src="../img/btn_voltar.jpg" width="47" height="17" border="0"></a></div></td>
                      <td width="718" height="20"> <div align="center"></div></td>
                      <td width="1" height="20">&nbsp;</td>
                    </tr>
                  </table></td>
              </tr>
              <tr>
                <td height="1" colspan="2"><img src="../img/spacer.gif" width="5" height="10"></td>
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

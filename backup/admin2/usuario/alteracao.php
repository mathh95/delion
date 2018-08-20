<?

include("../biblioteca/online.php");

$db->sql("SELECT * FROM usuario WHERE cod_usuario = '".$_GET['codigo'] . "'");
$valor = $db->fetch_array();


//pega o nome da tela
$sql = "SELECT * FROM tela where cod_tela = " . $t_adm_usuario . ' limit 0,1';	  
$res = $db->sql($sql);
$valor_tela = $db->fetch_array();



?>
<head>
<title><? echo $nome_empresa?></title>
<link href="../css/fontes.css" rel="stylesheet" type="text/css">
<script src="../scripts/jquery.js" type="text/javascript"></script>
<script src="../scripts/jquery.validate.js" type="text/javascript"></script>

<!-- for styling the form -->
<script src="../scripts/cmxforms.js" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" media="screen" href="../scripts/css/screen.css" />

<script>

function gravar_super_categoria(numero_item, total) {
	
  var i;
	for (i=1;i<=total;i++){
	
		document.getElementById("categoria" + numero_item+ i).checked = document.getElementById("super_categoria" + numero_item).checked;
	
	}

}

function gravar_categoria(numero_item, numero_sub_item, total) {
	
  var i, j;
  
	j = 0;
	for (i=1;i<=total;i++){
	
		if (document.getElementById("categoria" + numero_item+ i).checked == false) {
			j++;
		}
	
	}
	if (j == total) {
		document.getElementById("super_categoria" + numero_item).checked = false;
	} else {
		document.getElementById("super_categoria" + numero_item).checked = true;
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

<script type="text/javascript">
$().ready(function() {

	$("select[@name=tipo]").change(function(){
		$('#divpermissao]').html('Carregando :::::::');
		// Passa os parametros por POST 
		// $.post('nome do arquivo', { variavel: valor, variavel2: valor2 }, funcao de resposta);
		$.get('permissao.php',
		{ tipo : $(this).val() },
		function(resp){
				$('#divpermissao').html(resp);
				//alert (resposta);
				}
		);
	});
	
	
	// overwrite default messages
	$.extend($.validator.messages, {
		required: "É necessário preencher esse campo. ",
		digits: "Somente números são permitidos",
		email: "Informe um email válido"
	});

	
	// validate signup form on keyup and submit
	$("#formulario").validate({
		
	});

});
</script>

</head>
<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0">
  <tr> 
    <td height="28" background="../img/cantobg.jpg"><table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="18"><img src="../img/canto1.jpg" width="10" height="28"></td>
          <td width="399" class="titulo"><strong><? echo $nome_empresa?></strong></td>
		  <td width="539" class="texto">
<div align="right">
              <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr> 
                  <td height="1" colspan="3"><img src="../img/spacer.gif" width="5" height="5"></td>
                </tr>
                <tr> 
                  <td class="texto"> 
                    <div align="right"> 
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
    <td valign="top"><table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td width="1" background="../img/bg1.jpg"><img src="../img/bg1.jpg" width="10" height="11"></td>
          <td valign="top">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr> 
                <td width="50%" valign="top"> 
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
                      <td valign="top" bgcolor="#F5F8FA"> 
                      <form name="formulario" id="formulario" action="alteracao_bd.php" method="post">
                      <fieldset id="set1">
                      <table width="95%" border="0" align="center" cellpadding="3" cellspacing="0">
                          
                            
                            <tr> 
                              <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                  <tr> 
                                    <td width="1"><img src="../img/ico.jpg" width="19" height="9"></td>
                                    <td class="titulo2"> <? echo $valor_tela["nome"];?></td>
                                  </tr>
                                </table></td>
                            </tr>
                            <tr> 
                              <td bgcolor="#D8E3EB"> <table width="100%" border="0" cellspacing="0" cellpadding="2">
                                  <tr> 
                                    <td width="100" class="textp"> <div align="right">Nome:</div></td>
                                    <td><input name="nome" type="text" class="required" id="nome" value="<? echo $valor['nome'];?>"></td>
                                  </tr>
                                </table></td>
                            </tr>
                            <tr> 
                              <td> <table width="100%" border="0" cellspacing="0" cellpadding="2">
                                  <tr> 
                                    <td width="100" class="textp"> <div align="right">Login:</div></td>
                                    <td><input name="login" type="text" class="required id="login" value="<? echo $valor['login'];?>"></td>
                                  </tr>
                                </table></td>
                            </tr>
                            <tr> 
                              <td bgcolor="#D8E3EB"> <table width="100%" border="0" cellspacing="0" cellpadding="2">
                                  <tr> 
                                    <td width="100" class="textp"> <div align="right"> 
                                        Senha:</div></td>
                                    <td><input name="senha" type="password" class="required" id="senha" value="<? $senha = $valor['senha']; echo $senha;?>"></td>
                                  </tr>
                                </table></td>
                            </tr>
                            <tr> 
                              <td><table width="100%" border="0" cellspacing="0" cellpadding="2">
                                  <tr> 
                                    <td width="100" class="textp"> <div align="right">E-mail:</div></td>
                                    <td><input name="email" type="text" class="email" id="email" value="<? echo $valor['email'];?>"></td>
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
                              <td> <table width="100%" border="0" cellspacing="0" cellpadding="2">
                                  <tr> 
                                    <td width="98" class="textp"> <div align="right">Tipo 
                                        :</div></td>
                                    <td width="462"><b> 
                                      <select name="tipo" id="tipo" class="form" >
                                        <option value="ADM" <? if ($valor['tipo'] == 'ADMI') { echo 'selected'; }?> >Administrador</option>
                                        <option value="COME" <? if ($valor['tipo'] == 'COME') { echo 'selected'; }?> >Comercial</option>
                                        <option value="CONT" <? if ($valor['tipo'] == 'CONT') { echo 'selected'; }?> >Contabilidade</option>
                                        <option value="ATIV" <? if ($valor['tipo'] == 'ATIV') { echo 'selected'; }?> >Ativação</option>
                                        <option value="AUDT" <? if ($valor['tipo'] == 'AUDT') { echo 'selected'; }?> >Auditoria Técnica</option>
                                        <option value="PROD" <? if ($valor['tipo'] == 'PROD') { echo 'selected'; }?> >Produto</option>
                                        <option value="CTRL" <? if ($valor['tipo'] == 'CTRL') { echo 'selected'; }?> >Controladoria</option>
                                        <option value="ADMI" <? if ($valor['tipo'] == 'ADMI') { echo 'selected'; }?> >Administrativo</option>
                                      </select>
                                      <b> </b> </b></td>
                                  </tr>
                                </table></td>
                            </tr>
                            <tr> 
                              <td height="1"><img src="../img/spacer.gif" width="5" height="5"></td>
                            </tr>
                            <tr> 
                              <td> <div align="left"> 
                                  <input type="hidden" name="cod_usuario" value="<? echo $_GET['codigo']; ?>" >
                                  <input name="Submit" type="submit" class="texto" value="Gravar" >
                                  <input name="Submit2" type="button" class="texto" value="Cancelar" onClick='javascript:history.go(-1);'>
                                </div></td>
                            </tr>
                            
                      </table>
                      </fieldset>
                          </form>
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
                  </table>
                </td>
                <? if ($_GET['codigo']){?>
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
                      <td valign="top" bgcolor="#F5F8FA"> <table width="98%" border="0" align="center" cellpadding="3" cellspacing="0">
                          <tr> 
                            <td class="titulo2"> <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tr> 
                                  <td width="1"><img src="../img/ico.jpg" width="19" height="9"></td>
                                  <td class="titulo2"> PERMISS&Otilde;ES</td>
                                </tr>
                              </table></td>
                          </tr>
                          <tr> 
                            <td> 
                              <?
							$db->sql("SELECT cod_permissao, cod_tela FROM permissao WHERE cod_usuario = ".$_GET['codigo']);
							
							$campos = array();
							while ($valor = $db->fetch_array()) {
							
								$campos[] = $valor['cod_tela'];
							
							}
							?>
                               
                              <form name="permissao">
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
                                </form></td>
                          </tr>
                          <tr>
                            <td><div align="center">
                                <input name="Button2" type="button" class="texto" value="Salvar" onClick="envia_permissao(<? echo $_GET['codigo'];?>)">
                              </div></td>
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
                  </table></td>
                <? } ?>
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

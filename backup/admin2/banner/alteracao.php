<?

include("../biblioteca/online.php");

$db->sql("SELECT * FROM banner WHERE cod_banner = '".$_GET['codigo'] . "'");
$valor = $db->fetch_array();


//pega o modelo da tela
$sql = "SELECT * FROM tela where cod_tela = " . $t_banner . ' limit 0,1';	  
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

function envia_permissao(cod_banner){
   if (confirm("Você tem certeza que deseja realizar essa operação?")) 
   {
		var url;
		url = "cadastro_permissao_bd.php?cod_banner=" + cod_banner;
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

	$("select[@name=super_categoria]").change(function(){
		$('#categoria').html('');
		// Passa os parametros por POST 
		// $.post('modelo do arquivo', { variavel: valor, variavel2: valor2 }, funcao de resposta);
		$.get('categoria.php',
		{ super_categoria : $(this).val(), categoria : '<? echo $valor['categoria']?>' },
		function(resp){
				$('#categoria').html(resp);
				//alert (resposta);
				}
		);
		
		if ($(this).val() == 0) {
			$('#categoria').attr('class','');
		} else {
			$('#categoria').attr('class','required');
		}
	});
	
	<? if ($valor['categoria']) {?>
	$.get('categoria.php',
		{ super_categoria : $("select[@name=super_categoria]").val(), categoria : '<? echo $valor['categoria']?>' },
		function(resp){
				$('#categoria').html(resp);
				//alert (resposta);
				}
		);
	<? } ?>
	
	
	if ($("select[@name=super_categoria]").val() == 0) {
			$('#categoria').attr('class','');
		} else {
			$('#categoria').attr('class','required');
		}
	
	$("select[@name=tipo]").change(function(){
		$('#divpermissao]').html('Carregando :::::::');
		// Passa os parametros por POST 
		// $.post('modelo do arquivo', { variavel: valor, variavel2: valor2 }, funcao de resposta);
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
		date: "Data inválida",
		email: "Informe um email válido"
	});

	
	// validate signup form on keyup and submit
	$("#formulario").validate({
		
	});

});

function deletar_foto(cod_galeria, cod_foto) {

	//$('#foto_' + cod_foto).html('Carregando :::::::');
	$('#foto_' + cod_foto).hide();
	$('#deletar_' + cod_foto).hide();
	// Passa os parametros por POST 
	// $.post('nome do arquivo', { variavel: valor, variavel2: valor2 }, funcao de resposta);
	$.get("fotos.php",
	{ cod_foto : cod_foto, cod_galeria:cod_galeria}
	
	);

}
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
<table width="70%" border="0" align="center" cellpadding="0" cellspacing="0">
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
                      <form name="formulario" id="formulario" action="../banner/alteracao_bd.php" method="post" enctype="multipart/form-data">
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
                                    <td class="textp"><div align="right">Nome:</div></td>
                                    <td><b>
                                      <input name="nome" type="text" class="required" id="nome" value="<? echo $valor['nome'];   ?>" size="80">
                                    </b></td>
                                    </tr> 
                                    
                                    <tr>
                                      <td class="textp"><div align="right">Link:</div></td>
                                      <td><b>
                                        <input name="link" type="text" class="" id="link" value="<? echo $valor['link'];   ?>">
                                      </b></td>
                                    </tr>  
                                    
                                    <tr>
                                      <td class="textp"><div align="right">Tipo:</div></td>
                                      <td><b>
                                        <select name="tipo" id="tipo" class="required">
                                        	<option value="top" <? if ($valor["tipo"] == "top") { echo "selected"; } ?> >Topo(Largura: 1140px x Altura: 400px)</option>
                                            <!--<option value="meio" <? if ($valor["tipo"] == "meio") { echo "selected"; } ?> >Meio(Largura: 180px x Altura: 264px)</option>-->
                                        </select>
                                        
                                      </b></td>
                                    </tr>                
          							
                                  <tr>
                                    <td class="textp"><div align="right">Banner:</div></td>
                                    <td><label>
                                      <input type="file" name="arquivo" id="arquivo">
                                    </label></td>
                                    </tr>
                                  <tr>
                                    <td class="textp"><div align="right">Banner:</div></td>
                                    <td colspan="2">
                                    <div id="fotos">
									<?php                                        
                                          //executa query
                                          $db->sql("SELECT * FROM foto where codigo = '".$_GET['codigo']."' and tabela LIKE 'banner' order by cod_foto ");
                                          //echo $db;
										  $i = 0;      
                                        //Verifica ate aonde encontra os dados
                                          while ($valores = $db->fetch_array()) { 
                                                echo "<img id=\"foto_$valores[cod_foto]\" src=\"/$valores[foto_md]\" style=\"margin: 5px; opacity: 1;\" ><img src=\"../img/deletar.png\" id=\"deletar_$valores[cod_foto]\"  style=\"margin-left: -20px;\" onclick=\"deletar_foto($_GET[codigo], $valores[cod_foto])\">";
												
												$i++;
												if ($i == 6) {
													echo "<br>";
													$i = 0;
												}
                                             	
                                          }								
                                        
                                                  
                                       ?>
                                       </div>                                    </td>
                                  </tr>
                                  
                                  
                                  
                              </table></td>
                            </tr>
                            <tr> 
                              <td height="1"><img src="../img/spacer.gif" width="5" height="5"></td>
                            </tr>
                            <tr> 
                              <td> <div align="left"> 
                                  <input type="hidden" name="cod_banner" value="<? echo $_GET['codigo']; ?>" >
                                  <input name="Submit" type="submit" class="texto" value="Gravar" >
                                  <input name="Submit2" type="button" class="texto" value="Cancelar" onClick='javascript:history.go(-1);'>
                                </div></td>
                            </tr>
                      </table>
                      </fieldset>
                      </form>                      </td>
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
                  </table>                </td>
              </tr>
              <tr> 
                <td height="1"><img src="../img/spacer.gif" width="5" height="10"></td>
              </tr>
              <tr> 
                <td colspan="2"><table width="98%" border="0" align="center" cellpadding="0" cellspacing="0">
                    <tr> 
                      <td width="48"> <div align="left"><a href="../banner/consulta.php"><img src="../img/btn_voltar.jpg" width="47" height="17" border="0"></a></div></td>
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

<?

include("../biblioteca/online.php");

$db->sql("SELECT * FROM faq WHERE cod_faq = '".$_GET['codigo'] . "'");
$valor = $db->fetch_array();


//pega o nome da tela
$sql = "SELECT * FROM tela where cod_tela = " . $t_faq . ' limit 0,1';	  
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

function openDiv(elemento) {
	if (document.getElementById(elemento).className == 'hide') {
		document.getElementById(elemento).className = 'show';
} else if (document.getElementById(elemento).className == 'show') {
		document.getElementById(elemento).className = 'hide';
	}
}


function abrir(id, arquivo){

	openDiv(id);
	
	$('#' + id).html('Carregando :::::::');
	// Passa os parametros por POST 
	// $.post('nome do arquivo', { variavel: valor, variavel2: valor2 }, funcao de resposta);
	$.get(arquivo,
	{ id : id},
	function(resp){
			$('#' + id).html(resp);
			//alert (resposta);
			}
	);

}

function salvar(id, arquivo, saida){

	if ($('#' + id + '_nome').val() != '') {
		
		openDiv(id);
		
		$("select[name='"+saida+"']").html('Carregando :::::::');
		// Passa os parametros por POST 
		// $.post('nome do arquivo', { variavel: valor, variavel2: valor2 }, funcao de resposta);
		$.post(arquivo,
		{ id : id, nome : $('#' + id + '_nome').val() },
		function(resp){
				$("select[name='"+saida+"']").html(resp);
				//alert (resposta);
				}
		);
	} else {
		$('#' + id + '_nome').focus();
		alert('Nome Vazio');
		
	}

}

</script>

<script type="text/javascript">
$().ready(function() {
		
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
                              <td bgcolor="#D8E3EB"><table width="100%" border="0" cellspacing="0" cellpadding="2"><tr><td width="482"><table width="100%" border="0" cellspacing="0" cellpadding="2">
                                <tr>
                                  <td class="textp"><div align="right">Pergunta:</div></td>
                                  <td width="903"><label>
                                    <textarea name="pergunta" id="pergunta" class="required" cols="45" rows="5"><? echo $valor['pergunta'];?></textarea>
                                    </label></td>
                                </tr>
                                <tr>
                                  <td   class="textp"><div align="right">Resposta:</div></td>
                                  <td width="482"><label>
                                    <textarea name="resposta" id="resposta" class="required" cols="45" rows="5"><? echo $valor['resposta'];?></textarea>
                                  </label></td>
                                </tr>
                              </table>                                <label></label></td>
                                  </tr>
                              </table></td>
                            </tr>
                            <tr> 
                              <td height="1"><img src="../img/spacer.gif" width="5" height="5"></td>
                            </tr>
                            <tr> 
                              <td> <div align="left"> 
                                  <input type="hidden" name="cod_faq" value="<? echo $_GET['codigo']; ?>" >
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

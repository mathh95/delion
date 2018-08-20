<?

include("../biblioteca/online.php");

include_once("../fckeditor/fckeditor.php");

$db->sql("SELECT * FROM produto  WHERE cod_produto = '".$_GET['codigo'] . "'");
$valor = $db->fetch_array();


//pega o modelo da tela
$sql = "SELECT * FROM tela where cod_tela = " . $t_produto . ' limit 0,1';	  
$res = $db->sql($sql);
$valor_tela = $db->fetch_array();

//deleta a tabela temporaria do usuario
$db->sql("delete from temp  where sessao ='".session_id()."'");



?>
<head>
<title><? echo $nome_empresa?></title>
<link href="../css/fontes.css" rel="stylesheet" type="text/css">


<script type="text/javascript" src="../scripts/jquery-validation/lib/jquery-1.6.4.js"></script>
<script src="../scripts/jquery.validate.js" type="text/javascript"></script>

<script src="../scripts/jquery.limit-1.2.source.js" type="text/javascript"></script>

<script src="../scripts/maskmoney/jquery.maskMoney.js" type="text/javascript"></script>

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

function deletar_upload(id) {
	
	$('#' + id).hide();
	$('#' + id + '_del').hide();
	// Passa os parametros por POST 
	// $.post('nome do arquivo', { variavel: valor, variavel2: valor2 }, funcao de resposta);
	$.get("deleta_thumbnail.php",
	{ id : id}
	);	
}
</script>
<style type="text/css">
#sortable {
	list-style-type: none;
	margin: 0;
	padding: 0;
}
#sortable li {
	margin: 3px 3px 3px 0;
	padding: 1px;
	float: left;
	width: 135px;
	height: 110px;
	font-size: 4em;
	text-align: center;
}
</style>



<script type="text/javascript">
$().ready(function() {

	
	
	
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
	
	$('#valor').maskMoney({thousands:'.', decimal:','});
	
	
	
	$('#descricao_resumida').limit('400','#descricao_resumida_falta');
	
	$('#meta_tag_titulo').limit('70','#titulo_falta');
	$('#meta_tag_descricao').limit('156','#descricao_falta');
	

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


<script type="text/javascript" src="../scripts/SWFUpload_Samples/demos/swfupload/swfupload.js"></script>
<script type="text/javascript" src="../scripts/SWFUpload_Samples/demos/applicationdemo/js/handlers.js"></script>
<script type="text/javascript">
	var swfu;
	window.onload = function () {
		swfu = new SWFUpload({
			// Backend Settings
			upload_url: "/admin/scripts/SWFUpload_Samples/demos/applicationdemo/upload.php",	// Relative to the SWF file or absolute
			post_params: {"PHPSESSID": "<?php echo session_id(); ?>"},

			// File Upload Settings
			file_size_limit : "2 MB",	// 2MB
			file_types : "*.jpg",
			file_types_description : "JPG Images",
			file_upload_limit : "0",

			// Event Handler Settings - these functions as defined in Handlers.js
			//  The handlers are not part of SWFUpload but are part of my website and control how
			//  my website reacts to the SWFUpload events.
			file_queue_error_handler : fileQueueError,
			file_dialog_complete_handler : fileDialogComplete,
			upload_progress_handler : uploadProgress,
			upload_error_handler : uploadError,
			upload_success_handler : uploadSuccess,
			upload_complete_handler : uploadComplete,

			// Button Settings
			button_image_url : "../scripts/SWFUpload_Samples/demos/applicationdemo/images/SmallSpyGlassWithTransperancy_17x18.png",	// Relative to the SWF file
			button_placeholder_id : "spanButtonPlaceholder",
			button_width: 180,
			button_height: 18,
			button_text : '<span class="button">Selecione as Imagens <span class="buttonSmall">(2 MB Max)</span></span>',
			button_text_style : '.button { font-family: Helvetica, Arial, sans-serif; font-size: 12pt; } .buttonSmall { font-size: 10pt; }',
			button_text_top_padding: 0,
			button_text_left_padding: 18,
			button_window_mode: SWFUpload.WINDOW_MODE.TRANSPARENT,
			button_cursor: SWFUpload.CURSOR.HAND,
			
			// Flash Settings
			flash_url : "../scripts/SWFUpload_Samples/demos/swfupload/swfupload.swf",

			custom_settings : {
				upload_target : "divFileProgressContainer"
			},
			
			// Debug Settings
			debug: false
		});
	};
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
                      <form name="formulario" id="formulario" action="../produto/alteracao_bd.php" method="post" enctype="multipart/form-data">
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
                                        <input type="text" id="nome" name="nome" class="required" value="<? echo $valor['nome']; ?>" size="80" >
                                      </b></td>
                                    </tr>
                                    
                                    <tr>
                                      <td class="textp"><div align="right">Valor:</div></td>
                                      <td><b>
                                        <input type="text" id="valor" name="valor" class="required" value="<? echo number_format($valor['valor'],2,",","."); ?>" size="15" >
                                      </b></td>
                                    </tr>
                                    
                                    <tr>
                                      <td class="textp"><div align="right"> Categoria:</div></td>
                                      <td><b>
                                        <select name="cod_categoria" id="cod_categoria" class="required">
                                          <option value=""></option>
                                          <?php
                                                                    
                                            
                                            //executa query
                                            $db->sql("SELECT cod_categoria, C.nome FROM categoria C order by C.nome ");
                                                  
                                          //Verifica ate aonde encontra os dados
                                            while ($valores = $db->fetch_array()) { 
                                                if ($valores['cod_categoria'] == $valor['cod_categoria']) {
                                                  echo "<option value=\"$valores[0]\" selected>$valores[1]</option>";
                                                } else {
                                                  echo "<option value=\"$valores[0]\">$valores[1]</option>";
                                                }
                                            }								
                                          
                                                    
                                         ?>
                                        </select>
                                      </b></td>
                                    </tr>
                                    
                                    <tr>
                                      <td class="textp"><div align="right">Descrição Resumida:</div></td>
                                      <td>
                                        <textarea name="descricao_resumida" cols="65" rows="10" class="required" id="descricao_resumida"><? echo stripslashes($valor['descricao_resumida']);   ?></textarea>
                                        Faltam: <span id="descricao_resumida_falta"></span> Caracteres
                                      </td>
                                    </tr>
                                    
                                    <tr>
                                      <td class="textp"><div align="right">Descrição:</div></td>
                                      <td><b>
                                       <?php
										
										$oFCKeditor = new FCKeditor('descricao') ;
										$oFCKeditor->BasePath = '/admin/fckeditor/' ;
										$oFCKeditor->Height = 300;	
										$oFCKeditor->Value = (stripslashes( html_entity_decode($valor['descricao']) ));
										$oFCKeditor->Create() ;
										?>
                                       
                                        
                                      </b></td>
                                    </tr>
                                    
                                    
                                    <tr> 
                                      <td width="162" class="textp"> <div align="right">Titulo SEO:</div></td>
                                      <td colspan="2"><label>
                                        <textarea name="meta_tag_titulo" id="meta_tag_titulo" cols="65" rows="5"><? echo stripslashes($valor['meta_tag_titulo']);?></textarea>
                                        Faltam: <span id="titulo_falta"></span> Caracteres
                                      </label></td>
                                    </tr>
                                  
                                   <tr> 
                                    <td width="162" class="textp"> <div align="right">Meta Descrição:</div></td>
                                    <td colspan="2"><label>
                                       
                                        
                                        <textarea name="meta_tag_descricao" cols="65" rows="10" class="required" id="meta_tag_descricao"><? echo stripslashes($valor['meta_tag_descricao']);   ?></textarea>
                                        Faltam: <span id="descricao_falta"></span> Caracteres
                                    
                                    </label></td>
                                  </tr>
                                  <tr>
                                      <td class="textp"><div align="right">Url Amigável:</div></td>
                                      <td><b>
                                        <input type="text" id="slug" name="slug" class="required" value="<? echo $valor['slug']; ?>" size="80" >
                                      </b></td>
                                    </tr> 
                                                     
          
                                  <tr>
                                      <td width="162" class="textp"><div align="right">Fotos:</div></td>
                                      <td><!--<div id="content">
                                        
                                        <form>-->
                                        
                                        <div style="display: inline; border: solid 1px #7FAAFF; background-color: #C5D9FF; padding: 2px;"> <span id="spanButtonPlaceholder"></span> </div>
                                        
                                        <!--</form>-->
                                        
                                        <div id="divFileProgressContainer" style="height: 75px;"></div>
                                        <div id="thumbnails"></div>
                                        
                                        <!--</div>   --></td>
                                    </tr>
                                  <tr>
                                    <td class="textp"><div align="right">Fotos:</div></td>
                                    <td colspan="2">
                                    <div id="fotos">
									<?php                                        
                                          //executa query
                                          $db->sql("SELECT * FROM foto where codigo = '".$_GET['codigo']."' and tabela = 'produto' order by cod_foto ");
                                          //echo $db;
										  $i = 0;      
                                        //Verifica ate aonde encontra os dados
                                          while ($valores = $db->fetch_array()) { 
                                                echo "<img id=\"foto_$valores[cod_foto]\" src=\"/$valores[foto_md]\" style=\"margin: 5px; opacity: 1;\" ><img src=\"../img/deletar.png\" id=\"deletar_$valores[cod_foto]\"  style=\"margin-left: -20px;cursor:pointer;\" onclick=\"deletar_foto($_GET[codigo], $valores[cod_foto])\">";
												
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
                                  <input type="hidden" name="cod_produto" value="<? echo $_GET['codigo']; ?>" >
                                  
                                  
                                  <input type="hidden" name="id" value="<? echo $_REQUEST['id']; ?>" >
                                  <input type="hidden" name="busca_cod_super_categoria" value="<? echo $_REQUEST['cod_super_categoria']; ?>" >
                                  <input type="hidden" name="busca_cod_categoria" value="<? echo $_REQUEST['cod_categoria']; ?>" >
                                  <input type="hidden" name="busca_cod_marca" value="<? echo $_REQUEST['cod_marca']; ?>" >
                                  <input type="hidden" name="busca_nome" value="<? echo $_REQUEST['nome']; ?>" >
                                  <input type="hidden" name="busca_flag_foto" value="<? echo $_REQUEST['flag_foto']; ?>" >
                                  <input type="hidden" name="busca_flag_mostrar_preco" value="<? echo $_REQUEST['flag_mostrar_preco']; ?>" >
                                  <input type="hidden" name="busca_flag_ativo" value="<? echo $_REQUEST['flag_ativo']; ?>" >
                                  <input type="hidden" name="busca_flag_destaque" value="<? echo $_REQUEST['flag_destaque']; ?>" >
                                  <input type="hidden" name="busca_flag_oferta" value="<? echo $_REQUEST['flag_oferta']; ?>" >
                                  <input type="hidden" name="busca_flag_lancamento" value="<? echo $_REQUEST['flag_lancamento']; ?>" >
                                  
                                  
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
                      <td width="48"> <div align="left"><a href="../produto/consulta.php?id=<? echo $_REQUEST['id']; ?>&cod_super_categoria=<? echo $_REQUEST['cod_super_categoria']; ?>&cod_categoria=<? echo $_REQUEST['cod_categoria']; ?>&cod_marca=<? echo $_REQUEST['cod_marca']; ?>&nome=<? echo $_REQUEST['nome']; ?>&flag_foto=<? echo $_REQUEST['flag_foto']; ?>&flag_mostrar_preco=<? echo $_REQUEST['flag_mostrar_preco'] ?>&flag_ativo=<? echo $_REQUEST['flag_ativo'];?>"><img src="../img/btn_voltar.jpg" width="47" height="17" border="0"></a></div></td>
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

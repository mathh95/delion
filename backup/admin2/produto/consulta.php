<?php

  include("../biblioteca/online.php");
	
	   //pega o modelo da tela
	   $sql = "SELECT * FROM tela where cod_tela = " . $t_produto . ' limit 0,1';	  
	   $res = $db->sql($sql);
	   $valor_tela = $db->fetch_array();	
  	  
	  $where = " where 1=1 ";
	  
	  
	  if ($_REQUEST['cod_categoria'] != '') {
	  	
		$where .= " and C.cod_categoria = '" . (int)$_REQUEST["cod_categoria"] . "'";
		
	  }
	  
	  
	  if ($_REQUEST['nome']!= '') {
	  	
		$where .= " and (P.codigo like '%" . addslashes($_REQUEST["nome"]) . "%' or P.nome like '%" . addslashes($_REQUEST["nome"]) . "%')";
		
	  } 
	  
	  
	  if ($_REQUEST['flag_ativo']!= '') {
	  	
		if ($_REQUEST['flag_ativo'] == 'sim') {
			$where .= " and flag_ativo = '1'";
		} else {
			$where .= " and flag_ativo = '0'";	
		}
		
	  }
	  
	  if ($_REQUEST['flag_destaque']!= '') {
	  	
		if ($_REQUEST['flag_destaque'] == 'sim') {
			$where .= " and flag_destaque = '1'";
		}
		
	  }
	  
	   
	  
	  if ($_REQUEST['flag_foto'] == '') {
	  
      	$sql = "SELECT P.cod_produto, P.nome as produto, C.nome as categoria, P.descricao_resumida, P.valor, P.flag_destaque, P.flag_ativo  FROM 
				produto P 
				left join categoria C on (P.cod_categoria = C.cod_categoria ) 
				$where order by P.nome";
	  
	   } else {
		
		if ($_REQUEST['flag_foto'] == 'com_foto') {
		
			$sql = "SELECT P.cod_produto, P.nome as produto, C.nome as categoria, P.descricao_resumida, P.valor, P.flag_destaque, P.flag_ativo  FROM 
				produto P 
				left join categoria C on (P.cod_categoria = C.cod_categoria ) 
				left join foto F on (F.codigo = P.cod_produto and tabela = 'produto')
				$where and F.foto_pq is not null
				group by P.cod_produto
				order by P.nome";
			
		} else {
			$sql = "SELECT P.cod_produto, P.nome as produto, C.nome as categoria, P.descricao_resumida, P.valor, P.flag_destaque, P.flag_ativo  FROM 
				produto P  
				left join categoria C on (P.cod_categoria = C.cod_categoria ) 
				left join foto F on (F.codigo = P.cod_produto and tabela = 'produto')
				$where and F.foto_pq is null
				group by P.cod_produto
				order by P.nome"; 
		}
		   
	   }
	 
	 //echo $sql;
	  
	  if (!isset($_GET["id"])) {
	  	$_GET["id"] = '';
	  }
	  
	  $p = new paginacao($db,$sql,30,10,$_GET["id"],$t_produto, $_SESSION);
	  
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


<script src="../scripts/jquery.js" type="text/javascript"></script>
<script>

$().ready(function() {
	
	$(".flag_mostrar_preco").click ( function () {
		
		if ( $(this).is(":checked") ) {
		  $.get("atualizar_flag.php",
		  { cod_produto : $(this).val(), flag_mostrar_preco :1}
		  
		  );
		} else {
		  $.get("atualizar_flag.php",
		  { cod_produto : $(this).val(), flag_mostrar_preco :0}
		  
		  );	
			
		}
	
	});
	
	$(".flag_mostrar_preco_todos").click ( function () {
		
		if ( $(this).is(":checked") ) {
		
		  $(".flag_mostrar_preco").each ( function () {
			  
			  $(this).attr("checked",true);
			  
			  $.get("atualizar_flag.php",
			  { cod_produto : $(this).val(), flag_mostrar_preco :1}
			  
			  );
			  
		  });
		
		} else {
			
		   $(".flag_mostrar_preco").each ( function () {
			  
			  $(this).attr("checked",false);
			  
			  $.get("atualizar_flag.php",
			  { cod_produto : $(this).val(), flag_mostrar_preco :0}
			  
			  );
			  
		  });
			
		}
		
	});
	
	$(".flag_ativo").click ( function () {
		
		if ( $(this).is(":checked") ) {
		  $.get("atualizar_flag.php",
		  { cod_produto : $(this).val(), flag_ativo :1}
		  
		  );
		} else {
		  $.get("atualizar_flag.php",
		  { cod_produto : $(this).val(), flag_ativo :0}
		  
		  );	
			
		}
	
	});
	
	$(".flag_ativo_todos").click ( function () {
		
		if ( $(this).is(":checked") ) {
		
		  $(".flag_ativo").each ( function () {
			  
			  $(this).attr("checked",true);
			  
			  $.get("atualizar_flag.php",
			  { cod_produto : $(this).val(), flag_ativo :1}
			  
			  );
			  
		  });
		
		} else {
			
			
			$(".flag_ativo").each ( function () {
			  
			  $(this).attr("checked",false);
			  
			  $.get("atualizar_flag.php",
			  { cod_produto : $(this).val(), flag_ativo :0}
			  
			  );
			  
		  });
			
		}
		
	});
	
	
	$(".flag_destaque").click ( function () {
		
		if ( $(this).is(":checked") ) {
		  $.get("atualizar_flag.php",
		  { cod_produto : $(this).val(), flag_destaque :1}
		  
		  );
		} else {
		  $.get("atualizar_flag.php",
		  { cod_produto : $(this).val(), flag_destaque :0}
		  
		  );	
			
		}
	
	});
	
	$(".flag_destaque_todos").click ( function () {
		
		if ( $(this).is(":checked") ) {
		
		  $(".flag_destaque").each ( function () {
			  
			  $(this).attr("checked",true);
			  
			  $.get("atualizar_flag.php",
			  { cod_produto : $(this).val(), flag_destaque :1}
			  
			  );
			  
		  });
		
		} else {
			
			
			$(".flag_destaque").each ( function () {
			  
			  $(this).attr("checked",false);
			  
			  $.get("atualizar_flag.php",
			  { cod_produto : $(this).val(), flag_destaque :0}
			  
			  );
			  
		  });
			
		}
		
	});
	
	
	$(".flag_oferta").click ( function () {
		
		if ( $(this).is(":checked") ) {
		  $.get("atualizar_flag.php",
		  { cod_produto : $(this).val(), flag_oferta :1}
		  
		  );
		} else {
		  $.get("atualizar_flag.php",
		  { cod_produto : $(this).val(), flag_oferta :0}
		  
		  );	
			
		}
	
	});
	
	$(".flag_oferta_todos").click ( function () {
		
		if ( $(this).is(":checked") ) {
		
		  $(".flag_oferta").each ( function () {
			  
			  $(this).attr("checked",true);
			  
			  $.get("atualizar_flag.php",
			  { cod_produto : $(this).val(), flag_oferta :1}
			  
			  );
			  
		  });
		
		} else {
			
			
			$(".flag_oferta").each ( function () {
			  
			  $(this).attr("checked",false);
			  
			  $.get("atualizar_flag.php",
			  { cod_produto : $(this).val(), flag_oferta :0}
			  
			  );
			  
		  });
			
		}
		
	});
	
	
	$(".flag_lancamento").click ( function () {
		
		if ( $(this).is(":checked") ) {
		  $.get("atualizar_flag.php",
		  { cod_produto : $(this).val(), flag_lancamento :1}
		  
		  );
		} else {
		  $.get("atualizar_flag.php",
		  { cod_produto : $(this).val(), flag_lancamento :0}
		  
		  );	
			
		}
	
	});
	
	$(".flag_lancamento_todos").click ( function () {
		
		if ( $(this).is(":checked") ) {
		
		  $(".flag_lancamento").each ( function () {
			  
			  $(this).attr("checked",true);
			  
			  $.get("atualizar_flag.php",
			  { cod_produto : $(this).val(), flag_lancamento :1}
			  
			  );
			  
		  });
		
		} else {
			
			
			$(".flag_lancamento").each ( function () {
			  
			  $(this).attr("checked",false);
			  
			  $.get("atualizar_flag.php",
			  { cod_produto : $(this).val(), flag_lancamento :0}
			  
			  );
			  
		  });
			
		}
		
	});
	
	
	
	
});	


</script>


<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" onLoad="javascript:document.busca.modelo.focus();">
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
          
          <table width="40%" border="0" align="center" cellpadding="0" cellspacing="0">
              <tr> 
                <td width="50%" valign="top"> 
				
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
                      <form name="formulario" id="formulario" action="<? echo $_SERVER['PHP_SELF'];?>" method="get" enctype="multipart/form-data">
                      <fieldset id="set1">
                      <table width="95%" border="0" align="center" cellpadding="3" cellspacing="0">
                          
                            
                            <tr> 
                              <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                  <tr> 
                                    <td width="1"><img src="../img/ico.jpg" width="19" height="9"></td>
                                    <td class="titulo2"> Filtro</td>
                                  </tr>
                                </table></td>
                            </tr>
                            <tr> 
                              <td bgcolor="#D8E3EB"> <table width="100%" border="0" cellspacing="0" cellpadding="2">
                                  <tr>
                                    <td class="textp"><div align="right">Categoria:</div></td>
                                    <td>
                                      <select name="cod_categoria" id="cod_categoria">
                                        <option value="" <? if ( $_GET["cod_categoria"] == '' ) {?> selected <? } ?>  >Todos</option>
                                        <?
                                            
											$sql = "SELECT cod_categoria, nome as categoria FROM categoria order by nome";
											
											$res_combo = $db->sql($sql);
											
											while ($valores_combo = mysql_fetch_array($res_combo) ) {											
											?>
                                        <option value="<? echo $valores_combo["cod_categoria"]?>" <? if ( $_GET["cod_categoria"] == $valores_combo["cod_categoria"] ) {?> selected <? } ?>  ><? echo $valores_combo["categoria"]?> </option>
                                        <? } ?>
                                        </select>
                                      </td>
                                  </tr>
                                  
                                  <tr>
                                    <td class="textp"><div align="right">Nome:</div></td>
                                    <td>
                                    	<input name="nome" type="text" class="form2" id="nome" value="<? echo $_REQUEST['nome'];?>">
                                    </td>
                                  </tr>
                                  <tr>
                                    <td class="textp"><div align="right">Foto:</div></td>
                                    <td>
                                    <select name="flag_foto" id="flag_foto">
                                      <option value="" <? if ( $_GET["flag_foto"] == '' ) {?> selected <? } ?>  >Todos</option>
                                      <option value="com_foto" <? if ( $_GET["flag_foto"] == 'com_foto' ) {?> selected <? } ?>  >Com Foto</option>
                                      <option value="sem_foto" <? if ( $_GET["flag_foto"] == 'sem_foto' ) {?> selected <? } ?>  >Sem Foto</option>
                                    </select>
                                    </td>
                                  </tr>
                                  
                                                                    
                                  <tr>
                                    <td class="textp"><div align="right">Destaque:</div></td>
                                    <td>
                                    <select name="flag_destaque" id="flag_destaque">
                                      <option value="" <? if ( $_GET["flag_destaque"] == '' ) {?> selected <? } ?>  >Todos</option>
                                      <option value="sim" <? if ( $_GET["flag_destaque"] == 'sim' ) {?> selected <? } ?>  >Sim</option>
                                      <option value="nao" <? if ( $_GET["flag_destaque"] == 'nao' ) {?> selected <? } ?>  >Nao</option>
                                    </select>
                                    </td>
                                  </tr>
                                  
                                  <tr>
                                    <td class="textp"><div align="right">Ativo:</div></td>
                                    <td>
                                    <select name="flag_ativo" id="flag_ativo">
                                      <option value="" <? if ( $_GET["flag_ativo"] == '' ) {?> selected <? } ?>  >Todos</option>
                                      <option value="sim" <? if ( $_GET["flag_ativo"] == 'sim' ) {?> selected <? } ?>  >Sim</option>
                                      <option value="nao" <? if ( $_GET["flag_ativo"] == 'nao' ) {?> selected <? } ?>  >Nao</option>
                                    </select>
                                    </td>
                                  </tr>
                                  
                                  
                                  
                              </table></td>
                            </tr>
                            <tr> 
                              <td height="1"><img src="../img/spacer.gif" width="5" height="5"></td>
                            </tr>
                            <tr> 
                              <td> <div align="left"> 
                                  <input name="Submit" type="submit" class="texto" value="Filtrar" >
                                  <input name="Submit2" type="button" class="texto" value="Cancelar" onClick='javascript:history.go(-1);'>
                                </div></td>
                            </tr>
                      </table>
                      </fieldset>
                      </form>                      </td>
                    </tr>
                  </table>                </td>
              </tr>
              <tr> 
                <td height="1"><img src="../img/spacer.gif" width="5" height="10"></td>
              </tr>
              <tr>
                <td height="1" colspan="2"><img src="../img/spacer.gif" width="5" height="10"></td>
              </tr>
          </table>
          
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
						  <tr> 
                            <td width="1"><img src="../img/ico.jpg" width="19" height="9"></td>
                            <td class="titulo2">Consulta de <? echo $valor_tela['nome'];?></td>
                            
                          </tr>
                        </table></td>
                    </tr>
                    <tr> 
                      <td><table width="100%" border="0" align="center" cellpadding="3" cellspacing="0">
                          <tr bgcolor="#D8E3EB" class="textp"> 
                            <td><table width="100%" border="0" align="center" cellpadding="3" cellspacing="0">
                                <tr bgcolor="#D8E3EB" class="textp"> 
                                  <td width="20%"><strong>Nome</strong></td>
                                  <td width="10%"><strong>Categoria</strong></td>
                                  <td width="20%"><strong>Descricao</strong></td>
                                  <td width="20%"><strong>Valor</strong></td>
                                  <td width="10%"><strong>Foto</strong></td>       
                                  <td width="5%"><strong><input type="checkbox" class="flag_destaque_todos" value="<? echo $resultado[0];?>" > Destaque</strong></td>   
                                  <td width="5%"><strong><input type="checkbox" class="flag_ativo_todos" value="<? echo $resultado[0];?>" > Ativo</strong></td>                             
                                  <td width="10%">&nbsp;</td>
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
										
										$sql = "SELECT * FROM foto where codigo = '".$resultado[0]."' and tabela = 'produto' order by cod_foto limit 1";
										
										$res_foto = $db->sql($sql);
										
										$valores_foto = mysql_fetch_array($res_foto);
										
										
									
								?>
								<tr class="textp" <? echo $bg;?>> 
                                  <td width="20%" ><a href="../produto/alteracao.php?codigo=<? echo $resultado[0];?>&id=<? echo $_REQUEST['id']; ?>&cod_categoria=<? echo $_REQUEST['cod_categoria']; ?>&nome=<? echo $_REQUEST['nome']; ?>&flag_foto=<? echo $_REQUEST['flag_foto']; ?>" class="textp"><? echo $resultado[1];?></a></td>
                                  <td width="10%" ><a href="../produto/alteracao.php?codigo=<? echo $resultado[0];?>&id=<? echo $_REQUEST['id']; ?>&cod_categoria=<? echo $_REQUEST['cod_categoria']; ?>&nome=<? echo $_REQUEST['nome']; ?>&flag_foto=<? echo $_REQUEST['flag_foto']; ?>" class="textp"><? echo $resultado[2];?></a></td>
                                  <td width="20%" ><a href="../produto/alteracao.php?codigo=<? echo $resultado[0];?>&id=<? echo $_REQUEST['id']; ?>&cod_categoria=<? echo $_REQUEST['cod_categoria']; ?>&nome=<? echo $_REQUEST['nome']; ?>&flag_foto=<? echo $_REQUEST['flag_foto']; ?>" class="textp"><? echo $resultado[3];?></a></td>
                                  <td width="20%" ><a href="../produto/alteracao.php?codigo=<? echo $resultado[0];?>&id=<? echo $_REQUEST['id']; ?>&cod_categoria=<? echo $_REQUEST['cod_categoria']; ?>&nome=<? echo $_REQUEST['nome']; ?>&flag_foto=<? echo $_REQUEST['flag_foto']; ?>" class="textp"><? echo number_format($resultado[4],2,',', '.');?></a></td>
                                  <td width="10%" ><? if ($valores_foto["foto_pq"] != '') { ?><img src="/<? echo $valores_foto["foto_pq"];?>"> <? } ?></td>
                                  
                                  <td width="5%" ><input type="checkbox" class="flag_destaque" value="<? echo $resultado[0];?>" <? if ($resultado["flag_destaque"] == 1) { ?> checked <? } ?> ></td>
                                  <td width="5%" ><input type="checkbox" class="flag_ativo" value="<? echo $resultado[0];?>" <? if ($resultado["flag_ativo"] == 1) { ?> checked <? } ?> ></td>
                                  
								  <td width="10%">
								  <table border="0" align="center" cellpadding="0" cellspacing="0">
                                      <script src="../scripts/all.js"></script>
									  <tr> 
                                        <td width="53"><a href="../produto/alteracao.php?codigo=<? echo $resultado[0];?>&id=<? echo $_REQUEST['id']; ?>&cod_categoria=<? echo $_REQUEST['cod_categoria']; ?>&nome=<? echo $_REQUEST['nome']; ?>&flag_foto=<? echo $_REQUEST['flag_foto']; ?>"><img src="../img/btn_editar.jpg" width="53" height="19" border="0"></a></td>
                                        <td width="53"><a href="javascript:verifica_deletar('delecao_bd.php?cod_produto=<? echo $resultado[0];?>')"><img src="../img/btn_apagar.jpg" width="53" height="19" border="0"></a></td>
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
                      <a href="../produto/alteracao.php"><img src="../img/btn_cad.jpg" width="161" height="19" border="0"></a>
                      </div></td>
                      <td width="213" height="20"> 
                       
                        <div align="center">
						 <?
  
						$p->escreve_paginacao("../img/btn_anterior.jpg", "../img/btn_proxima.jpg", "textp", "&cod_super_categoria=".$_REQUEST['cod_super_categoria']."&cod_categoria=".$_REQUEST['cod_categoria']."&cod_marca=".$_REQUEST['cod_marca']."&nome=".$_REQUEST['nome']."&flag_foto=".$_REQUEST['flag_foto']."&flag_mostrar_preco=".$_REQUEST['flag_mostrar_preco']."&flag_ativo=".$_REQUEST['flag_ativo']."&flag_destaque=".$_REQUEST['flag_destaque']."&flag_oferta=".$_REQUEST['flag_oferta']."&flag_lancamento=".$_REQUEST['flag_lancamento']  );
						
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


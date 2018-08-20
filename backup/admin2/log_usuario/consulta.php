<?php

  include("../biblioteca/online.php");
  
  //grava no log que o usuário entrou na consulta
  $db->sql("insert into log_usuario (id_usuario, ip,  hora_cad, data_cad, tipo_acao, consulta, acao) values (".$_SESSION["id_usuario"]."  , '".$_SERVER["REMOTE_ADDR"]."' ,  '".date('H:i:s')."' , '".date('Y-m-d')."','Entrou' ,'', 'Entrou na Consulta de Log do Usuário') ");
?>
<title></title>
<link href="../css/fontes.css" rel="stylesheet" type="text/css">
<script src="../scripts/prototype.js"></script>
<script>

function carrega(url) {	
	$('pagina').innerHTML='<table width="100%" height="100%"><tr><td><div align="center"><img src="../img/carregando.gif"></div></td></tr></table>';
	new Ajax.Request(url, {
			method: 'get',    		               					  			
				onComplete:function( txt ) {
					Element.update("pagina", txt.responseText);								 								
				}
		});
}

function carrega_usuario(i,id_usuario) {	
	if (openDiv("data_"+i) == true) {
		var url = "usuario_data.php?id_usuario=" + id_usuario;
		$("data_"+i).innerHTML='<table width="100%" height="100%"><tr><td><div align="center"><img src="../img/carregando.gif"></div></td></tr></table>';
		new Ajax.Request(url, {
				method: 'get',    		               					  			
					onComplete:function( txt ) {
						Element.update("data_"+i, txt.responseText);								 								
					}
			});
	}
}

function carrega_data(i,data_inicio, data_fim) {	
	if (openDiv("usuario_"+i) == true) {
		var url = "data_usuario.php?data_inicio=" + data_inicio + "&data_fim=" + data_fim;
		$("usuario_"+i).innerHTML='<table width="100%" height="100%"><tr><td><div align="center"><img src="../img/carregando.gif"></div></td></tr></table>';
		new Ajax.Request(url, {
				method: 'get',    		               					  			
					onComplete:function( txt ) {
						Element.update("usuario_"+i, txt.responseText);								 								
					}
			});
	}
}

function carrega_log(id_usuario,nome, hora, data_inicio,data_fim, tipo, id) {	
	
		var url = "log.php?id_usuario="+id_usuario+"&nome="+nome+"&hora="+hora+"&data_inicio="+data_inicio+"&data_fim="+data_fim+"&tipo="+tipo+"&id="+id;
		$("log").innerHTML='<table width="100%" height="100%"><tr><td><div align="center"><img src="../img/carregando.gif"></div></td></tr></table>';
		new Ajax.Request(url, {
				method: 'get',    		               					  			
					onComplete:function( txt ) {
						Element.update("log", txt.responseText);								 								
					}
			});
	
}

function mostra_sql(i,id_log_usuario) {	
	if (openDiv2("sql_"+i) == true) {
		var url = "sql.php?id_log_usuario=" + id_log_usuario;
		$("sql_"+i).innerHTML='<table width="100%" height="100%"><tr><td><div align="center"><img src="../img/carregando.gif"></div></td></tr></table>';
		new Ajax.Request(url, {
				method: 'get',    		               					  			
					onComplete:function( txt ) {
						Element.update("sql_"+i, txt.responseText);								 								
					}
			});
	}
}

function inicio(){

	carrega("usuario.php");
	carrega_log('','','','','','','');	

}



function openDiv(elemento) {
	if (document.getElementById(elemento).className == 'hide') {
		document.getElementById(elemento).className = 'show2';
		return true;
} else if (document.getElementById(elemento).className == 'show2') {
		document.getElementById(elemento).className = 'hide';
		return false;
	}
}

function openDiv2(elemento) {
	if (document.getElementById(elemento).className == 'hide') {
		document.getElementById(elemento).className = 'show';
		return true;
} else if (document.getElementById(elemento).className == 'show') {
		document.getElementById(elemento).className = 'hide';
		return false;
	}
}

</script>
<style type="text/css">
body {
	behavior: url(../css/csshover.htc);
}

table.realce tr:hover {
	background: #FFFAB4;
}
</style>
<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" onLoad="javascript:inicio();">
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
    <td valign="top">
<table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td width="1" background="../img/bg1.jpg"><img src="../img/bg1.jpg" width="10" height="11"></td>
          <td valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="2">
              <tr> 
                <td width="270" valign="top"><div id="pagina"></div> </td>
                <td valign="top"><div id="log"></div></td>
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

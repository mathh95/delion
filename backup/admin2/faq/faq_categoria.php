<?php header("Content-Type: text/html;  charset=ISO-8859-1",true) ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Untitled Document</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>

<body bgcolor="#CCCCCC" >
<table width="95%" border="0" align="center" cellpadding="3" cellspacing="0">
	<tr> 
      <td> <table width="100%" border="0" cellspacing="0" cellpadding="2">
          <tr> 
            <td width="100" class="textp"> <div align="right">Nome:</div></td>
            <td>
			<input name="<? echo $_GET['id']?>_nome" type="text" class="required" id="<? echo $_GET['id']?>_nome"></td>
          </tr>
        </table></td>
    </tr>
    <tr> 
      <td height="1"><img src="../img/spacer.gif" width="5" height="5"></td>
  </tr>
    <tr> 
      <td> <div align="left"> 
          <input name="Button" type="button" class="texto" value="Cadatrar" onClick="javascript:salvar('<? echo $_GET['id']?>', 'salvar_faq_categoria.php', 'cod_faq_categoria')">
          <input name="Submit2" type="button" class="texto" value="Cancelar" onClick="javascript:openDiv('<? echo $_GET['id']?>');">
        </div></td>
    </tr>
</table>
</body>
</html>
